<?php
//Include Common Files @1-96F5DD0D
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_laporan_ketetapan_dan_realisasi.php");
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

//Class_Initialize Event @3-46089BBD
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
            $this->DatePicker_tgl_penerimaan = & new clsDatePicker("DatePicker_tgl_penerimaan", "t_rep_bppsSearch", "tgl_penerimaan", $this);
            $this->tgl_penerimaan_last = & new clsControl(ccsTextBox, "tgl_penerimaan_last", "tgl_penerimaan_last", ccsDate, array("dd", "-", "mm", "-", "yyyy"), CCGetRequestParam("tgl_penerimaan_last", $Method, NULL), $this);
            $this->tgl_penerimaan_last->Required = true;
            $this->DatePicker_tgl_penerimaan_last1 = & new clsDatePicker("DatePicker_tgl_penerimaan_last1", "t_rep_bppsSearch", "tgl_penerimaan_last", $this);
            $this->Button_DoSearch1 = & new clsButton("Button_DoSearch1", $Method, $this);
            $this->Button_DoSearch2 = & new clsButton("Button_DoSearch2", $Method, $this);
            $this->kode_wilayah = & new clsControl(ccsListBox, "kode_wilayah", "kode_wilayah", ccsText, "", CCGetRequestParam("kode_wilayah", $Method, NULL), $this);
            $this->kode_wilayah->DSType = dsSQL;
            $this->kode_wilayah->DataSource = new clsDBConnSIKP();
            $this->kode_wilayah->ds = & $this->kode_wilayah->DataSource;
            list($this->kode_wilayah->BoundColumn, $this->kode_wilayah->TextColumn, $this->kode_wilayah->DBFormat) = array("", "", "");
            $this->kode_wilayah->DataSource->SQL = "select business_area_name, business_area_name\n" .
            "from p_business_area ";
            $this->kode_wilayah->DataSource->Order = "";
            $this->kode_wilayah->Required = true;
            $this->tgl_bayar = & new clsControl(ccsListBox, "tgl_bayar", "tgl_bayar", ccsText, "", CCGetRequestParam("tgl_bayar", $Method, NULL), $this);
            $this->tgl_bayar->DSType = dsListOfValues;
            $this->tgl_bayar->Values = array(array("1", "Ya"), array("0", "Tidak"));
            $this->tgl_bayar->Required = true;
        }
    }
//End Class_Initialize Event

//Validate Method @3-63150506
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
        $Validation = ($this->tgl_penerimaan_last->Validate() && $Validation);
        $Validation = ($this->kode_wilayah->Validate() && $Validation);
        $Validation = ($this->tgl_bayar->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tgl_penerimaan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tgl_penerimaan_last->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kode_wilayah->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tgl_bayar->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-9F0B0D3C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->tgl_penerimaan_last->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan_last1->Errors->Count());
        $errors = ($errors || $this->kode_wilayah->Errors->Count());
        $errors = ($errors || $this->tgl_bayar->Errors->Count());
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

//Operation Method @3-11E8DB6B
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
            $this->PressedButton = "Button_DoSearch1";
            if($this->Button_DoSearch1->Pressed) {
                $this->PressedButton = "Button_DoSearch1";
            } else if($this->Button_DoSearch2->Pressed) {
                $this->PressedButton = "Button_DoSearch2";
            }
        }
        $Redirect = "t_laporan_ketetapan_dan_realisasi.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch1") {
                if(!CCGetEvent($this->Button_DoSearch1->CCSEvents, "OnClick", $this->Button_DoSearch1)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_DoSearch2") {
                if(!CCGetEvent($this->Button_DoSearch2->CCSEvents, "OnClick", $this->Button_DoSearch2)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-29BDFB89
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

        $this->kode_wilayah->Prepare();
        $this->tgl_bayar->Prepare();

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
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tgl_penerimaan_last->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan_last1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kode_wilayah->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tgl_bayar->Errors->ToString());
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
        $this->DatePicker_tgl_penerimaan->Show();
        $this->tgl_penerimaan_last->Show();
        $this->DatePicker_tgl_penerimaan_last1->Show();
        $this->Button_DoSearch1->Show();
        $this->Button_DoSearch2->Show();
        $this->kode_wilayah->Show();
        $this->tgl_bayar->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_rep_bppsSearch Class @3-FCB6E20C

//Initialize Page @1-1D0CB1B2
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
$TemplateFileName = "t_laporan_ketetapan_dan_realisasi.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-259962CE
include_once("./t_laporan_ketetapan_dan_realisasi_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-944D12DC
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_bppsSearch = & new clsRecordt_rep_bppsSearch("", $MainPage);
$Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $MainPage);
$Label1->HTML = true;
$MainPage->t_rep_bppsSearch = & $t_rep_bppsSearch;
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

//Show Page @1-9A57D572
$t_rep_bppsSearch->Show();
$Label1->Show();
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
