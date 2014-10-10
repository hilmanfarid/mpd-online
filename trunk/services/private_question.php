<?php
//Include Common Files @1-7347FA1D
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "private_question.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridSELECT_FROM_p_private_que { //SELECT_FROM_p_private_que class @2-3B943B45

//Variables @2-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @2-458FE6DC
    function clsGridSELECT_FROM_p_private_que($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SELECT_FROM_p_private_que";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SELECT_FROM_p_private_que";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSELECT_FROM_p_private_queDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->p_private_question_id = & new clsControl(ccsLabel, "p_private_question_id", "p_private_question_id", ccsFloat, "", CCGetRequestParam("p_private_question_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->page_output = & new clsControl(ccsLabel, "page_output", "page_output", ccsText, "", CCGetRequestParam("page_output", ccsGet, NULL), $this);
        $this->total_page = & new clsControl(ccsLabel, "total_page", "total_page", ccsText, "", CCGetRequestParam("total_page", ccsGet, NULL), $this);
        $this->total_records = & new clsControl(ccsLabel, "total_records", "total_records", ccsText, "", CCGetRequestParam("total_records", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-D1BBD41B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["p_private_question_id"] = $this->p_private_question_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["page_output"] = $this->page_output->Visible;
            $this->ControlsVisible["total_page"] = $this->total_page->Visible;
            $this->ControlsVisible["total_records"] = $this->total_records->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->p_private_question_id->SetValue($this->DataSource->p_private_question_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->page_output->SetValue($this->DataSource->page_output->GetValue());
                $this->total_page->SetValue($this->DataSource->total_page->GetValue());
                $this->total_records->SetValue($this->DataSource->total_records->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->p_private_question_id->Show();
                $this->description->Show();
                $this->page_output->Show();
                $this->total_page->Show();
                $this->total_records->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-C58A54B1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->p_private_question_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->page_output->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_page->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_records->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SELECT_FROM_p_private_que Class @2-FCB6E20C

class clsSELECT_FROM_p_private_queDataSource extends clsDBConnSIKP {  //SELECT_FROM_p_private_queDataSource Class @2-D188F3C1

//DataSource Variables @2-C8915A10
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $p_private_question_id;
    var $description;
    var $page_output;
    var $total_page;
    var $total_records;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D6E51CD2
    function clsSELECT_FROM_p_private_queDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SELECT_FROM_p_private_que";
        $this->Initialize();
        $this->p_private_question_id = new clsField("p_private_question_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->page_output = new clsField("page_output", ccsText, "");
        
        $this->total_page = new clsField("total_page", ccsText, "");
        
        $this->total_records = new clsField("total_records", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-F8A68F17
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM \"SELECT\" \"* \n\n" .
        "FROM p_private_question\"";
        $this->SQL = "SELECT * \n\n" .
        "FROM \"SELECT\" \"* \n\n" .
        "FROM p_private_question\" {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-7B5786A4
    function SetValues()
    {
        $this->p_private_question_id->SetDBValue(trim($this->f("p_private_question_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->page_output->SetDBValue($this->f("label"));
        $this->total_page->SetDBValue($this->f("total_page"));
        $this->total_records->SetDBValue($this->f("total_records"));
    }
//End SetValues Method

} //End SELECT_FROM_p_private_queDataSource Class @2-FCB6E20C

//Initialize Page @1-46970101
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "private_question.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DD10B4DA
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$SELECT_FROM_p_private_que = & new clsGridSELECT_FROM_p_private_que("", $MainPage);
$MainPage->SELECT_FROM_p_private_que = & $SELECT_FROM_p_private_que;
$SELECT_FROM_p_private_que->Initialize();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-52F9C312
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-81B66898
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($SELECT_FROM_p_private_que);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4E17994E
$SELECT_FROM_p_private_que->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0D1E5FC6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($SELECT_FROM_p_private_que);
unset($Tpl);
//End Unload Page


?>
