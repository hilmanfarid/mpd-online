<?php
//Include Common Files @1-A2AFDBEB
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "target_realisasi_ws.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridSELECT_FROM_v_revenue_tar { //SELECT_FROM_v_revenue_tar class @2-BD6DFDE5

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

//Class_Initialize Event @2-A6EDB454
    function clsGridSELECT_FROM_v_revenue_tar($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SELECT_FROM_v_revenue_tar";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SELECT_FROM_v_revenue_tar";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSELECT_FROM_v_revenue_tarDataSource($this);
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

        $this->t_revenue_target_id = & new clsControl(ccsLabel, "t_revenue_target_id", "t_revenue_target_id", ccsFloat, "", CCGetRequestParam("t_revenue_target_id", ccsGet, NULL), $this);
        $this->p_vat_group_id = & new clsControl(ccsLabel, "p_vat_group_id", "p_vat_group_id", ccsFloat, "", CCGetRequestParam("p_vat_group_id", ccsGet, NULL), $this);
        $this->target_amount = & new clsControl(ccsLabel, "target_amount", "target_amount", ccsFloat, "", CCGetRequestParam("target_amount", ccsGet, NULL), $this);
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, "", CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->year_code = & new clsControl(ccsLabel, "year_code", "year_code", ccsText, "", CCGetRequestParam("year_code", ccsGet, NULL), $this);
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

//Show Method @2-D4D886C2
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlyear_code"] = CCGetFromGet("year_code", NULL);

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
            $this->ControlsVisible["t_revenue_target_id"] = $this->t_revenue_target_id->Visible;
            $this->ControlsVisible["p_vat_group_id"] = $this->p_vat_group_id->Visible;
            $this->ControlsVisible["target_amount"] = $this->target_amount->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["year_code"] = $this->year_code->Visible;
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
                $this->t_revenue_target_id->SetValue($this->DataSource->t_revenue_target_id->GetValue());
                $this->p_vat_group_id->SetValue($this->DataSource->p_vat_group_id->GetValue());
                $this->target_amount->SetValue($this->DataSource->target_amount->GetValue());
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->year_code->SetValue($this->DataSource->year_code->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->t_revenue_target_id->Show();
                $this->p_vat_group_id->Show();
                $this->target_amount->Show();
                $this->realisasi_amt->Show();
                $this->vat_code->Show();
                $this->year_code->Show();
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

//GetErrors Method @2-B54A0EE4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->t_revenue_target_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_group_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->year_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SELECT_FROM_v_revenue_tar Class @2-FCB6E20C

class clsSELECT_FROM_v_revenue_tarDataSource extends clsDBConnSIKP {  //SELECT_FROM_v_revenue_tarDataSource Class @2-BF75575E

//DataSource Variables @2-9D30AD4A
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $t_revenue_target_id;
    var $p_vat_group_id;
    var $target_amount;
    var $realisasi_amt;
    var $vat_code;
    var $year_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5956D805
    function clsSELECT_FROM_v_revenue_tarDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SELECT_FROM_v_revenue_tar";
        $this->Initialize();
        $this->t_revenue_target_id = new clsField("t_revenue_target_id", ccsFloat, "");
        
        $this->p_vat_group_id = new clsField("p_vat_group_id", ccsFloat, "");
        
        $this->target_amount = new clsField("target_amount", ccsFloat, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->year_code = new clsField("year_code", ccsText, "");
        

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

//Prepare Method @2-8497DCA0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlyear_code", ccsText, "", "", $this->Parameters["urlyear_code"], "", false);
    }
//End Prepare Method

//Open Method @2-F9880C99
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM v_revenue_target_vs_realisasi \n" .
        "WHERE year_code = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "') cnt";
        $this->SQL = "SELECT * \n" .
        "FROM v_revenue_target_vs_realisasi \n" .
        "WHERE year_code = '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "'";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-1EC63E94
    function SetValues()
    {
        $this->t_revenue_target_id->SetDBValue(trim($this->f("t_revenue_target_id")));
        $this->p_vat_group_id->SetDBValue(trim($this->f("p_vat_group_id")));
        $this->target_amount->SetDBValue(trim($this->f("target_amount")));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->year_code->SetDBValue($this->f("year_code"));
    }
//End SetValues Method

} //End SELECT_FROM_v_revenue_tarDataSource Class @2-FCB6E20C

//Initialize Page @1-F2AF57C6
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
$TemplateFileName = "target_realisasi_ws.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5E5A978E
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$SELECT_FROM_v_revenue_tar = & new clsGridSELECT_FROM_v_revenue_tar("", $MainPage);
$MainPage->SELECT_FROM_v_revenue_tar = & $SELECT_FROM_v_revenue_tar;
$SELECT_FROM_v_revenue_tar->Initialize();

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

//Go to destination page @1-975BE9EE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($SELECT_FROM_v_revenue_tar);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B3D35701
$SELECT_FROM_v_revenue_tar->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B8066C7B
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($SELECT_FROM_v_revenue_tar);
unset($Tpl);
//End Unload Page


?>
