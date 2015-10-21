<?php
//Include Common Files @1-2DFAB52C
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_monitoring_pendaftaran_new_per_tanggal.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_rep_lap_spjpSearch { //t_rep_lap_spjpSearch Class @3-FE45B59C

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

//Class_Initialize Event @3-6B96EC85
    function clsRecordt_rep_lap_spjpSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_rep_lap_spjpSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_rep_lap_spjpSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->nilai = & new clsControl(ccsListBox, "nilai", "nilai", ccsText, "", CCGetRequestParam("nilai", $Method, NULL), $this);
            $this->nilai->DSType = dsListOfValues;
            $this->nilai->Values = array(array("0", "SEMUA"), array("2", "PROSES"), array("3", "SELESAI"));
            $this->nilai->Required = true;
            $this->date_start_laporan = & new clsControl(ccsTextBox, "date_start_laporan", "date_start_laporan", ccsText, "", CCGetRequestParam("date_start_laporan", $Method, NULL), $this);
            $this->date_start_laporan->Required = true;
            $this->DatePicker_date_start_laporan1 = & new clsDatePicker("DatePicker_date_start_laporan1", "t_rep_lap_spjpSearch", "date_start_laporan", $this);
            $this->date_end_laporan = & new clsControl(ccsTextBox, "date_end_laporan", "date_end_laporan", ccsText, "", CCGetRequestParam("date_end_laporan", $Method, NULL), $this);
            $this->date_end_laporan->Required = true;
            $this->DatePicker_end_start_laporan1 = & new clsDatePicker("DatePicker_end_start_laporan1", "t_rep_lap_spjpSearch", "date_end_laporan", $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-3F43D223
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->nilai->Validate() && $Validation);
        $Validation = ($this->date_start_laporan->Validate() && $Validation);
        $Validation = ($this->date_end_laporan->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nilai->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_start_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_end_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-29C2D98F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->nilai->Errors->Count());
        $errors = ($errors || $this->date_start_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_date_start_laporan1->Errors->Count());
        $errors = ($errors || $this->date_end_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_start_laporan1->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
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

//Operation Method @3-04144A27
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
        $Redirect = "t_monitoring_pendaftaran_new_per_tanggal.php";
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

//Show Method @3-92390D4A
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

        $this->nilai->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nilai->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_start_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_date_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_end_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
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
        $this->vat_code->Show();
        $this->nilai->Show();
        $this->date_start_laporan->Show();
        $this->DatePicker_date_start_laporan1->Show();
        $this->date_end_laporan->Show();
        $this->DatePicker_end_start_laporan1->Show();
        $this->p_vat_type_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_rep_lap_spjpSearch Class @3-FCB6E20C

//Initialize Page @1-E50A28CC
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
$TemplateFileName = "t_monitoring_pendaftaran_new_per_tanggal.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E037E848
include_once("./t_monitoring_pendaftaran_new_per_tanggal_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8CB565E8
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_lap_spjpSearch = & new clsRecordt_rep_lap_spjpSearch("", $MainPage);
$Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $MainPage);
$Label1->HTML = true;
$MainPage->t_rep_lap_spjpSearch = & $t_rep_lap_spjpSearch;
$MainPage->Label1 = & $Label1;

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

//Execute Components @1-D6BA083D
$t_rep_lap_spjpSearch->Operation();
//End Execute Components

//Go to destination page @1-05822388
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_rep_lap_spjpSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D028F073
$t_rep_lap_spjpSearch->Show();
$Label1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-528B55E6
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_rep_lap_spjpSearch);
unset($Tpl);
//End Unload Page


?>
