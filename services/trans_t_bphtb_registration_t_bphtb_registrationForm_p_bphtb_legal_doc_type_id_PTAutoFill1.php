<?php
//Include Common Files @1-63327D1E
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_bphtb_legal_doc_type_p { //p_bphtb_legal_doc_type_p class @2-08406C09

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

//Class_Initialize Event @2-3436EC62
    function clsGridp_bphtb_legal_doc_type_p($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_bphtb_legal_doc_type_p";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_bphtb_legal_doc_type_p";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_bphtb_legal_doc_type_pDataSource($this);
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

        $this->p_bphtb_legal_doc_type_id = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_id", "p_bphtb_legal_doc_type_id", ccsFloat, "", CCGetRequestParam("p_bphtb_legal_doc_type_id", ccsGet, NULL), $this);
        $this->p_bphtb_legal_doc_type_p_legal_doc_type_id = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_p_legal_doc_type_id", "p_bphtb_legal_doc_type_p_legal_doc_type_id", ccsFloat, "", CCGetRequestParam("p_bphtb_legal_doc_type_p_legal_doc_type_id", ccsGet, NULL), $this);
        $this->npoptkp = & new clsControl(ccsLabel, "npoptkp", "npoptkp", ccsFloat, "", CCGetRequestParam("npoptkp", ccsGet, NULL), $this);
        $this->p_bphtb_legal_doc_type_description = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_description", "p_bphtb_legal_doc_type_description", ccsText, "", CCGetRequestParam("p_bphtb_legal_doc_type_description", ccsGet, NULL), $this);
        $this->p_bphtb_legal_doc_type_creation_date = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_creation_date", "p_bphtb_legal_doc_type_creation_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("p_bphtb_legal_doc_type_creation_date", ccsGet, NULL), $this);
        $this->p_bphtb_legal_doc_type_created_by = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_created_by", "p_bphtb_legal_doc_type_created_by", ccsText, "", CCGetRequestParam("p_bphtb_legal_doc_type_created_by", ccsGet, NULL), $this);
        $this->p_bphtb_legal_doc_type_updated_date = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_updated_date", "p_bphtb_legal_doc_type_updated_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("p_bphtb_legal_doc_type_updated_date", ccsGet, NULL), $this);
        $this->p_bphtb_legal_doc_type_updated_by = & new clsControl(ccsLabel, "p_bphtb_legal_doc_type_updated_by", "p_bphtb_legal_doc_type_updated_by", ccsText, "", CCGetRequestParam("p_bphtb_legal_doc_type_updated_by", ccsGet, NULL), $this);
        $this->p_legal_doc_type_p_legal_doc_type_id = & new clsControl(ccsLabel, "p_legal_doc_type_p_legal_doc_type_id", "p_legal_doc_type_p_legal_doc_type_id", ccsFloat, "", CCGetRequestParam("p_legal_doc_type_p_legal_doc_type_id", ccsGet, NULL), $this);
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_legal_doc_type_description = & new clsControl(ccsLabel, "p_legal_doc_type_description", "p_legal_doc_type_description", ccsText, "", CCGetRequestParam("p_legal_doc_type_description", ccsGet, NULL), $this);
        $this->p_legal_doc_type_creation_date = & new clsControl(ccsLabel, "p_legal_doc_type_creation_date", "p_legal_doc_type_creation_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("p_legal_doc_type_creation_date", ccsGet, NULL), $this);
        $this->p_legal_doc_type_created_by = & new clsControl(ccsLabel, "p_legal_doc_type_created_by", "p_legal_doc_type_created_by", ccsText, "", CCGetRequestParam("p_legal_doc_type_created_by", ccsGet, NULL), $this);
        $this->p_legal_doc_type_updated_date = & new clsControl(ccsLabel, "p_legal_doc_type_updated_date", "p_legal_doc_type_updated_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("p_legal_doc_type_updated_date", ccsGet, NULL), $this);
        $this->p_legal_doc_type_updated_by = & new clsControl(ccsLabel, "p_legal_doc_type_updated_by", "p_legal_doc_type_updated_by", ccsText, "", CCGetRequestParam("p_legal_doc_type_updated_by", ccsGet, NULL), $this);
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

//Show Method @2-E99C563A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlkeyword"] = CCGetFromGet("keyword", NULL);

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
            $this->ControlsVisible["p_bphtb_legal_doc_type_id"] = $this->p_bphtb_legal_doc_type_id->Visible;
            $this->ControlsVisible["p_bphtb_legal_doc_type_p_legal_doc_type_id"] = $this->p_bphtb_legal_doc_type_p_legal_doc_type_id->Visible;
            $this->ControlsVisible["npoptkp"] = $this->npoptkp->Visible;
            $this->ControlsVisible["p_bphtb_legal_doc_type_description"] = $this->p_bphtb_legal_doc_type_description->Visible;
            $this->ControlsVisible["p_bphtb_legal_doc_type_creation_date"] = $this->p_bphtb_legal_doc_type_creation_date->Visible;
            $this->ControlsVisible["p_bphtb_legal_doc_type_created_by"] = $this->p_bphtb_legal_doc_type_created_by->Visible;
            $this->ControlsVisible["p_bphtb_legal_doc_type_updated_date"] = $this->p_bphtb_legal_doc_type_updated_date->Visible;
            $this->ControlsVisible["p_bphtb_legal_doc_type_updated_by"] = $this->p_bphtb_legal_doc_type_updated_by->Visible;
            $this->ControlsVisible["p_legal_doc_type_p_legal_doc_type_id"] = $this->p_legal_doc_type_p_legal_doc_type_id->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_legal_doc_type_description"] = $this->p_legal_doc_type_description->Visible;
            $this->ControlsVisible["p_legal_doc_type_creation_date"] = $this->p_legal_doc_type_creation_date->Visible;
            $this->ControlsVisible["p_legal_doc_type_created_by"] = $this->p_legal_doc_type_created_by->Visible;
            $this->ControlsVisible["p_legal_doc_type_updated_date"] = $this->p_legal_doc_type_updated_date->Visible;
            $this->ControlsVisible["p_legal_doc_type_updated_by"] = $this->p_legal_doc_type_updated_by->Visible;
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
                $this->p_bphtb_legal_doc_type_id->SetValue($this->DataSource->p_bphtb_legal_doc_type_id->GetValue());
                $this->p_bphtb_legal_doc_type_p_legal_doc_type_id->SetValue($this->DataSource->p_bphtb_legal_doc_type_p_legal_doc_type_id->GetValue());
                $this->npoptkp->SetValue($this->DataSource->npoptkp->GetValue());
                $this->p_bphtb_legal_doc_type_description->SetValue($this->DataSource->p_bphtb_legal_doc_type_description->GetValue());
                $this->p_bphtb_legal_doc_type_creation_date->SetValue($this->DataSource->p_bphtb_legal_doc_type_creation_date->GetValue());
                $this->p_bphtb_legal_doc_type_created_by->SetValue($this->DataSource->p_bphtb_legal_doc_type_created_by->GetValue());
                $this->p_bphtb_legal_doc_type_updated_date->SetValue($this->DataSource->p_bphtb_legal_doc_type_updated_date->GetValue());
                $this->p_bphtb_legal_doc_type_updated_by->SetValue($this->DataSource->p_bphtb_legal_doc_type_updated_by->GetValue());
                $this->p_legal_doc_type_p_legal_doc_type_id->SetValue($this->DataSource->p_legal_doc_type_p_legal_doc_type_id->GetValue());
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_legal_doc_type_description->SetValue($this->DataSource->p_legal_doc_type_description->GetValue());
                $this->p_legal_doc_type_creation_date->SetValue($this->DataSource->p_legal_doc_type_creation_date->GetValue());
                $this->p_legal_doc_type_created_by->SetValue($this->DataSource->p_legal_doc_type_created_by->GetValue());
                $this->p_legal_doc_type_updated_date->SetValue($this->DataSource->p_legal_doc_type_updated_date->GetValue());
                $this->p_legal_doc_type_updated_by->SetValue($this->DataSource->p_legal_doc_type_updated_by->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->p_bphtb_legal_doc_type_id->Show();
                $this->p_bphtb_legal_doc_type_p_legal_doc_type_id->Show();
                $this->npoptkp->Show();
                $this->p_bphtb_legal_doc_type_description->Show();
                $this->p_bphtb_legal_doc_type_creation_date->Show();
                $this->p_bphtb_legal_doc_type_created_by->Show();
                $this->p_bphtb_legal_doc_type_updated_date->Show();
                $this->p_bphtb_legal_doc_type_updated_by->Show();
                $this->p_legal_doc_type_p_legal_doc_type_id->Show();
                $this->code->Show();
                $this->p_legal_doc_type_description->Show();
                $this->p_legal_doc_type_creation_date->Show();
                $this->p_legal_doc_type_created_by->Show();
                $this->p_legal_doc_type_updated_date->Show();
                $this->p_legal_doc_type_updated_by->Show();
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

//GetErrors Method @2-B8BB6163
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_p_legal_doc_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npoptkp->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_creation_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_created_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bphtb_legal_doc_type_updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_legal_doc_type_p_legal_doc_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_legal_doc_type_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_legal_doc_type_creation_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_legal_doc_type_created_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_legal_doc_type_updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_legal_doc_type_updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_bphtb_legal_doc_type_p Class @2-FCB6E20C

class clsp_bphtb_legal_doc_type_pDataSource extends clsDBConnSIKP {  //p_bphtb_legal_doc_type_pDataSource Class @2-BAFD5D02

//DataSource Variables @2-955F76DF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $p_bphtb_legal_doc_type_id;
    var $p_bphtb_legal_doc_type_p_legal_doc_type_id;
    var $npoptkp;
    var $p_bphtb_legal_doc_type_description;
    var $p_bphtb_legal_doc_type_creation_date;
    var $p_bphtb_legal_doc_type_created_by;
    var $p_bphtb_legal_doc_type_updated_date;
    var $p_bphtb_legal_doc_type_updated_by;
    var $p_legal_doc_type_p_legal_doc_type_id;
    var $code;
    var $p_legal_doc_type_description;
    var $p_legal_doc_type_creation_date;
    var $p_legal_doc_type_created_by;
    var $p_legal_doc_type_updated_date;
    var $p_legal_doc_type_updated_by;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-944AEB66
    function clsp_bphtb_legal_doc_type_pDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_bphtb_legal_doc_type_p";
        $this->Initialize();
        $this->p_bphtb_legal_doc_type_id = new clsField("p_bphtb_legal_doc_type_id", ccsFloat, "");
        
        $this->p_bphtb_legal_doc_type_p_legal_doc_type_id = new clsField("p_bphtb_legal_doc_type_p_legal_doc_type_id", ccsFloat, "");
        
        $this->npoptkp = new clsField("npoptkp", ccsFloat, "");
        
        $this->p_bphtb_legal_doc_type_description = new clsField("p_bphtb_legal_doc_type_description", ccsText, "");
        
        $this->p_bphtb_legal_doc_type_creation_date = new clsField("p_bphtb_legal_doc_type_creation_date", ccsDate, $this->DateFormat);
        
        $this->p_bphtb_legal_doc_type_created_by = new clsField("p_bphtb_legal_doc_type_created_by", ccsText, "");
        
        $this->p_bphtb_legal_doc_type_updated_date = new clsField("p_bphtb_legal_doc_type_updated_date", ccsDate, $this->DateFormat);
        
        $this->p_bphtb_legal_doc_type_updated_by = new clsField("p_bphtb_legal_doc_type_updated_by", ccsText, "");
        
        $this->p_legal_doc_type_p_legal_doc_type_id = new clsField("p_legal_doc_type_p_legal_doc_type_id", ccsFloat, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_legal_doc_type_description = new clsField("p_legal_doc_type_description", ccsText, "");
        
        $this->p_legal_doc_type_creation_date = new clsField("p_legal_doc_type_creation_date", ccsDate, $this->DateFormat);
        
        $this->p_legal_doc_type_created_by = new clsField("p_legal_doc_type_created_by", ccsText, "");
        
        $this->p_legal_doc_type_updated_date = new clsField("p_legal_doc_type_updated_date", ccsDate, $this->DateFormat);
        
        $this->p_legal_doc_type_updated_by = new clsField("p_legal_doc_type_updated_by", ccsText, "");
        

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

//Prepare Method @2-391F8022
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("2", "urlkeyword", ccsFloat, "", "", $this->Parameters["urlkeyword"], "", false);
        $this->wp->AddParameter("3", "urlkeyword", ccsFloat, "", "", $this->Parameters["urlkeyword"], "", true);
        $this->wp->Criterion[1] = "( p_bphtb_legal_doc_type.p_legal_doc_type_id =p_legal_doc_type.p_legal_doc_type_id )";
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "p_bphtb_legal_doc_type.p_bphtb_legal_doc_type_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "p_bphtb_legal_doc_type_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsFloat),true);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-870D839D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM p_bphtb_legal_doc_type INNER JOIN p_legal_doc_type ON\n\n" .
        "p_bphtb_legal_doc_type.p_legal_doc_type_id = p_legal_doc_type.p_legal_doc_type_id";
        $this->SQL = "SELECT * \n\n" .
        "FROM p_bphtb_legal_doc_type INNER JOIN p_legal_doc_type ON\n\n" .
        "p_bphtb_legal_doc_type.p_legal_doc_type_id = p_legal_doc_type.p_legal_doc_type_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-50D868C2
    function SetValues()
    {
        $this->p_bphtb_legal_doc_type_id->SetDBValue(trim($this->f("p_bphtb_legal_doc_type_id")));
        $this->p_bphtb_legal_doc_type_p_legal_doc_type_id->SetDBValue(trim($this->f("p_legal_doc_type_id")));
        $this->npoptkp->SetDBValue(trim($this->f("npoptkp")));
        $this->p_bphtb_legal_doc_type_description->SetDBValue($this->f("description"));
        $this->p_bphtb_legal_doc_type_creation_date->SetDBValue(trim($this->f("creation_date")));
        $this->p_bphtb_legal_doc_type_created_by->SetDBValue($this->f("created_by"));
        $this->p_bphtb_legal_doc_type_updated_date->SetDBValue(trim($this->f("updated_date")));
        $this->p_bphtb_legal_doc_type_updated_by->SetDBValue($this->f("updated_by"));
        $this->p_legal_doc_type_p_legal_doc_type_id->SetDBValue(trim($this->f("p_legal_doc_type_id")));
        $this->code->SetDBValue($this->f("code"));
        $this->p_legal_doc_type_description->SetDBValue($this->f("description"));
        $this->p_legal_doc_type_creation_date->SetDBValue(trim($this->f("creation_date")));
        $this->p_legal_doc_type_created_by->SetDBValue($this->f("created_by"));
        $this->p_legal_doc_type_updated_date->SetDBValue(trim($this->f("updated_date")));
        $this->p_legal_doc_type_updated_by->SetDBValue($this->f("updated_by"));
    }
//End SetValues Method

} //End p_bphtb_legal_doc_type_pDataSource Class @2-FCB6E20C

//Initialize Page @1-CCDD4D80
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
$TemplateFileName = "trans_t_bphtb_registration_t_bphtb_registrationForm_p_bphtb_legal_doc_type_id_PTAutoFill1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-69DA1BEC
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_bphtb_legal_doc_type_p = & new clsGridp_bphtb_legal_doc_type_p("", $MainPage);
$MainPage->p_bphtb_legal_doc_type_p = & $p_bphtb_legal_doc_type_p;
$p_bphtb_legal_doc_type_p->Initialize();

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

//Go to destination page @1-890FF3A2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_bphtb_legal_doc_type_p);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-976EA042
$p_bphtb_legal_doc_type_p->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-28A0F3D7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_bphtb_legal_doc_type_p);
unset($Tpl);
//End Unload Page


?>
