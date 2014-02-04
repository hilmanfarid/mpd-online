<?php
//Include Common Files @1-66BD7EAE
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_rep_lap_bpps_piutang.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_rep_bppsSearch { //t_rep_bppsSearch Class @3-C18ACE8B

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

//Class_Initialize Event @3-D244FE79
    function clsRecordt_rep_bppsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_rep_bppsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_rep_bppsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->tgl_penerimaan = & new clsControl(ccsTextBox, "tgl_penerimaan", "tgl_penerimaan", ccsDate, array("dd", "-", "mm", "-", "yyyy"), CCGetRequestParam("tgl_penerimaan", $Method, NULL), $this);
            $this->tgl_penerimaan->Required = true;
            $this->year_code = & new clsControl(ccsTextBox, "year_code", "year_code", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->year_code->Required = true;
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsText, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->ListBox1 = & new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsListOfValues;
            $this->ListBox1->Values = array(array("1", "Pokok"), array("2", "Denda"));
            $this->ListBox1->Required = true;
            $this->DatePicker_tgl_penerimaan = & new clsDatePicker("DatePicker_tgl_penerimaan", "t_rep_bppsSearch", "tgl_penerimaan", $this);
            $this->tgl_penerimaan_last = & new clsControl(ccsTextBox, "tgl_penerimaan_last", "tgl_penerimaan_last", ccsDate, array("dd", "-", "mm", "-", "yyyy"), CCGetRequestParam("tgl_penerimaan_last", $Method, NULL), $this);
            $this->tgl_penerimaan_last->Required = true;
            $this->DatePicker_tgl_penerimaan_last1 = & new clsDatePicker("DatePicker_tgl_penerimaan_last1", "t_rep_bppsSearch", "tgl_penerimaan_last", $this);
            $this->jenis_laporan = & new clsControl(ccsListBox, "jenis_laporan", "jenis_laporan", ccsText, "", CCGetRequestParam("jenis_laporan", $Method, NULL), $this);
            $this->jenis_laporan->DSType = dsListOfValues;
            $this->jenis_laporan->Values = array(array("all", "SEMUA"), array("piutang", "PIUTANG"), array("murni", "MURNI"));
            $this->jenis_laporan->Required = true;
        }
    }
//End Class_Initialize Event

//Validate Method @3-4707A0BB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->tgl_penerimaan->Validate() && $Validation);
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->tgl_penerimaan_last->Validate() && $Validation);
        $Validation = ($this->jenis_laporan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tgl_penerimaan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tgl_penerimaan_last->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jenis_laporan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-7D2F89DF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->tgl_penerimaan_last->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan_last1->Errors->Count());
        $errors = ($errors || $this->jenis_laporan->Errors->Count());
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

//Operation Method @3-092A1A21
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
        $Redirect = "t_rep_lap_bpps_piutang.php";
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

//Show Method @3-CDBF55E3
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

        $this->ListBox1->Prepare();
        $this->jenis_laporan->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tgl_penerimaan_last->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan_last1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jenis_laporan->Errors->ToString());
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

        $this->tgl_penerimaan->Show();
        $this->year_code->Show();
        $this->vat_code->Show();
        $this->p_vat_type_id->Show();
        $this->p_year_period_id->Show();
        $this->Button_DoSearch->Show();
        $this->ListBox1->Show();
        $this->DatePicker_tgl_penerimaan->Show();
        $this->tgl_penerimaan_last->Show();
        $this->DatePicker_tgl_penerimaan_last1->Show();
        $this->jenis_laporan->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_rep_bppsSearch Class @3-FCB6E20C

//Initialize Page @1-28B3FBF6
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
$TemplateFileName = "t_rep_lap_bpps_piutang.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A380E252
include_once("./t_rep_lap_bpps_piutang_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9736B044
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_bppsSearch = & new clsRecordt_rep_bppsSearch("", $MainPage);
$MainPage->t_rep_bppsSearch = & $t_rep_bppsSearch;

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

//Execute Components @1-7C9D6A75
$t_rep_bppsSearch->Operation();
//End Execute Components

//Go to destination page @1-6F16113A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_rep_bppsSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9F33A748
$t_rep_bppsSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9D08ED39
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_rep_bppsSearch);
unset($Tpl);
//End Unload Page


?>
