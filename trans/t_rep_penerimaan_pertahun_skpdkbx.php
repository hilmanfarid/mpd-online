<?php
//Include Common Files @1-96E8437B
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_rep_penerimaan_pertahun_skpdkbx.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_rep_penerimaan_pertahunSearch { //t_rep_penerimaan_pertahunSearch Class @3-2D944169

//Variables @3-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @3-7364A9A4
    function clsRecordt_rep_penerimaan_pertahunSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_rep_penerimaan_pertahunSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_rep_penerimaan_pertahunSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->year_code = & new clsControl(ccsTextBox, "year_code", "year_code", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsText, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->tgl_penerimaan = & new clsControl(ccsTextBox, "tgl_penerimaan", "tgl_penerimaan", ccsDate, array("dd", "-", "mm", "-", "yyyy"), CCGetRequestParam("tgl_penerimaan", $Method, NULL), $this);
            $this->DatePicker_tgl_penerimaan = & new clsDatePicker("DatePicker_tgl_penerimaan", "t_rep_penerimaan_pertahunSearch", "tgl_penerimaan", $this);
            $this->code = & new clsControl(ccsTextBox, "code", "code", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->p_account_status_id = & new clsControl(ccsHidden, "p_account_status_id", "p_account_status_id", ccsText, "", CCGetRequestParam("p_account_status_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-7F630050
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->tgl_penerimaan->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->p_account_status_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tgl_penerimaan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-AE9862BC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->p_account_status_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @3-028984DA
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "t_rep_penerimaan_pertahun_skpdkbx.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-ACBA8B56
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->year_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->year_code->Show();
        $this->vat_code->Show();
        $this->p_vat_type_id->Show();
        $this->p_year_period_id->Show();
        $this->tgl_penerimaan->Show();
        $this->DatePicker_tgl_penerimaan->Show();
        $this->code->Show();
        $this->p_account_status_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_rep_penerimaan_pertahunSearch Class @3-FCB6E20C

//Initialize Page @1-D8CC89D9
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
$TemplateFileName = "t_rep_penerimaan_pertahun_skpdkbx.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-15F810D9
include_once("./t_rep_penerimaan_pertahun_skpdkbx_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A6954445
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_penerimaan_pertahunSearch = & new clsRecordt_rep_penerimaan_pertahunSearch("", $MainPage);
$MainPage->t_rep_penerimaan_pertahunSearch = & $t_rep_penerimaan_pertahunSearch;

BindEvents();

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

//Execute Components @1-1590F3D1
$t_rep_penerimaan_pertahunSearch->Operation();
//End Execute Components

//Go to destination page @1-FC5C3CD7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_rep_penerimaan_pertahunSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D45EB650
$t_rep_penerimaan_pertahunSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9E6707A6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_rep_penerimaan_pertahunSearch);
unset($Tpl);
//End Unload Page


?>
