<?php
//Include Common Files @1-B1528462
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_laporan_penerimaan_bphtb.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_laporan_penerimaan_bphtb { //t_laporan_penerimaan_bphtb Class @2-00779F1A

//Variables @2-D6FF3E86

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

//Class_Initialize Event @2-4198806C
    function clsRecordt_laporan_penerimaan_bphtb($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_laporan_penerimaan_bphtb/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_laporan_penerimaan_bphtb";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->date_start_laporan = & new clsControl(ccsTextBox, "date_start_laporan", "date_start_laporan", ccsText, "", CCGetRequestParam("date_start_laporan", $Method, NULL), $this);
            $this->date_start_laporan->Required = true;
            $this->DatePicker_date_start_laporan1 = & new clsDatePicker("DatePicker_date_start_laporan1", "t_laporan_penerimaan_bphtb", "date_start_laporan", $this);
            $this->date_end_laporan = & new clsControl(ccsTextBox, "date_end_laporan", "date_end_laporan", ccsText, "", CCGetRequestParam("date_end_laporan", $Method, NULL), $this);
            $this->date_end_laporan->Required = true;
            $this->DatePicker_end_start_laporan1 = & new clsDatePicker("DatePicker_end_start_laporan1", "t_laporan_penerimaan_bphtb", "date_end_laporan", $this);
            $this->cetak_laporan = & new clsControl(ccsHidden, "cetak_laporan", "cetak_laporan", ccsText, "", CCGetRequestParam("cetak_laporan", $Method, NULL), $this);
            $this->receipt_no = & new clsControl(ccsTextBox, "receipt_no", "receipt_no", ccsText, "", CCGetRequestParam("receipt_no", $Method, NULL), $this);
            $this->njop_pbb = & new clsControl(ccsTextBox, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->p_region_id_kecamatan = & new clsControl(ccsHidden, "p_region_id_kecamatan", "p_region_id_kecamatan", ccsText, "", CCGetRequestParam("p_region_id_kecamatan", $Method, NULL), $this);
            $this->nama_kecamatan = & new clsControl(ccsTextBox, "nama_kecamatan", "Kecamatan", ccsText, "", CCGetRequestParam("nama_kecamatan", $Method, NULL), $this);
            $this->nama_kecamatan->Required = true;
            $this->p_region_id_kelurahan = & new clsControl(ccsHidden, "p_region_id_kelurahan", "p_region_id_kelurahan", ccsText, "", CCGetRequestParam("p_region_id_kelurahan", $Method, NULL), $this);
            $this->nama_kelurahan = & new clsControl(ccsTextBox, "nama_kelurahan", "Kelurahan", ccsText, "", CCGetRequestParam("nama_kelurahan", $Method, NULL), $this);
            $this->nama_kelurahan->Required = true;
            $this->Button2 = & new clsButton("Button2", $Method, $this);
            $this->Button3 = & new clsButton("Button3", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-3755B497
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->date_start_laporan->Validate() && $Validation);
        $Validation = ($this->date_end_laporan->Validate() && $Validation);
        $Validation = ($this->cetak_laporan->Validate() && $Validation);
        $Validation = ($this->receipt_no->Validate() && $Validation);
        $Validation = ($this->njop_pbb->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->p_region_id_kecamatan->Validate() && $Validation);
        $Validation = ($this->nama_kecamatan->Validate() && $Validation);
        $Validation = ($this->p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->nama_kelurahan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->date_start_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_end_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cetak_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->receipt_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_pbb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_kelurahan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-8C15FD1F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->date_start_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_date_start_laporan1->Errors->Count());
        $errors = ($errors || $this->date_end_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_start_laporan1->Errors->Count());
        $errors = ($errors || $this->cetak_laporan->Errors->Count());
        $errors = ($errors || $this->receipt_no->Errors->Count());
        $errors = ($errors || $this->njop_pbb->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->p_region_id_kecamatan->Errors->Count());
        $errors = ($errors || $this->nama_kecamatan->Errors->Count());
        $errors = ($errors || $this->p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->nama_kelurahan->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-4E5FB586
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
            $this->PressedButton = "Button1";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            } else if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            } else if($this->Button3->Pressed) {
                $this->PressedButton = "Button3";
            }
        }
        $Redirect = "t_laporan_penerimaan_bphtb.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button3") {
                if(!CCGetEvent($this->Button3->CCSEvents, "OnClick", $this->Button3)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-01FB3416
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
            $Error = ComposeStrings($Error, $this->date_start_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_date_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_end_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cetak_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->receipt_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_pbb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_kelurahan->Errors->ToString());
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

        $this->Button1->Show();
        $this->date_start_laporan->Show();
        $this->DatePicker_date_start_laporan1->Show();
        $this->date_end_laporan->Show();
        $this->DatePicker_end_start_laporan1->Show();
        $this->cetak_laporan->Show();
        $this->receipt_no->Show();
        $this->njop_pbb->Show();
        $this->wp_name->Show();
        $this->p_region_id_kecamatan->Show();
        $this->nama_kecamatan->Show();
        $this->p_region_id_kelurahan->Show();
        $this->nama_kelurahan->Show();
        $this->Button2->Show();
        $this->Button3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_laporan_penerimaan_bphtb Class @2-FCB6E20C

//Initialize Page @1-36DE4740
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
$TemplateFileName = "t_laporan_penerimaan_bphtb.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B9F4F9FC
include_once("./t_laporan_penerimaan_bphtb_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E8DE51E6
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_laporan_penerimaan_bphtb = & new clsRecordt_laporan_penerimaan_bphtb("", $MainPage);
$MainPage->t_laporan_penerimaan_bphtb = & $t_laporan_penerimaan_bphtb;

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

//Execute Components @1-C7C9B507
$t_laporan_penerimaan_bphtb->Operation();
//End Execute Components

//Go to destination page @1-04E0FFFD
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($t_laporan_penerimaan_bphtb);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CBBA41A9
$t_laporan_penerimaan_bphtb->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-40D624C0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($t_laporan_penerimaan_bphtb);
unset($Tpl);
//End Unload Page


?>
