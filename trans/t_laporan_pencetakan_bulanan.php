<?php
//Include Common Files @1-3A1BAAAA
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_laporan_pencetakan_bulanan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_laporan_pencetakan_bulanan { //t_laporan_pencetakan_bulanan Class @2-BA14805A

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

//Class_Initialize Event @2-E651C8CC
    function clsRecordt_laporan_pencetakan_bulanan($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_laporan_pencetakan_bulanan/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_laporan_pencetakan_bulanan";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->year_code = & new clsControl(ccsTextBox, "year_code", "Periode Tahun", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->year_code->Required = true;
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->date_start_laporan = & new clsControl(ccsTextBox, "date_start_laporan", "date_start_laporan", ccsText, "", CCGetRequestParam("date_start_laporan", $Method, NULL), $this);
            $this->date_start_laporan->Required = true;
            $this->DatePicker_date_start_laporan1 = & new clsDatePicker("DatePicker_date_start_laporan1", "t_laporan_pencetakan_bulanan", "date_start_laporan", $this);
            $this->date_end_laporan = & new clsControl(ccsTextBox, "date_end_laporan", "date_end_laporan", ccsText, "", CCGetRequestParam("date_end_laporan", $Method, NULL), $this);
            $this->date_end_laporan->Required = true;
            $this->DatePicker_end_start_laporan1 = & new clsDatePicker("DatePicker_end_start_laporan1", "t_laporan_pencetakan_bulanan", "date_end_laporan", $this);
            $this->cetak_laporan = & new clsControl(ccsHidden, "cetak_laporan", "cetak_laporan", ccsText, "", CCGetRequestParam("cetak_laporan", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-F151ECB7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->date_start_laporan->Validate() && $Validation);
        $Validation = ($this->date_end_laporan->Validate() && $Validation);
        $Validation = ($this->cetak_laporan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_start_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->date_end_laporan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cetak_laporan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-B34A33D3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->date_start_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_date_start_laporan1->Errors->Count());
        $errors = ($errors || $this->date_end_laporan->Errors->Count());
        $errors = ($errors || $this->DatePicker_end_start_laporan1->Errors->Count());
        $errors = ($errors || $this->cetak_laporan->Errors->Count());
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

//Operation Method @2-98637A4D
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
            }
        }
        $Redirect = "t_laporan_pencetakan_bulanan.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-43D7432C
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
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_start_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_date_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->date_end_laporan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_end_start_laporan1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cetak_laporan->Errors->ToString());
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
        $this->year_code->Show();
        $this->p_year_period_id->Show();
        $this->date_start_laporan->Show();
        $this->DatePicker_date_start_laporan1->Show();
        $this->date_end_laporan->Show();
        $this->DatePicker_end_start_laporan1->Show();
        $this->cetak_laporan->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_laporan_pencetakan_bulanan Class @2-FCB6E20C



//Initialize Page @1-8626665C
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
$TemplateFileName = "t_laporan_pencetakan_bulanan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A97A4CDF
include_once("./t_laporan_pencetakan_bulanan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-67E2BEB9
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_laporan_pencetakan_bulanan = & new clsRecordt_laporan_pencetakan_bulanan("", $MainPage);
$MainPage->t_laporan_pencetakan_bulanan = & $t_laporan_pencetakan_bulanan;

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

//Execute Components @1-A76E55DD
$t_laporan_pencetakan_bulanan->Operation();
//End Execute Components

//Go to destination page @1-B14C6180
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($t_laporan_pencetakan_bulanan);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DD216E47
$t_laporan_pencetakan_bulanan->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5F71D612
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($t_laporan_pencetakan_bulanan);
unset($Tpl);
//End Unload Page


?>
