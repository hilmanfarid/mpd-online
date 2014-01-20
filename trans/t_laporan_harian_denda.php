<?php
//Include Common Files @1-2FC3915E
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_laporan_harian_denda.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_laporan_harian_denda { //t_laporan_harian_denda Class @2-0082D9FD

//Variables @2-37BB2AF0

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
//End Variables

//Class_Initialize Event @2-33CD8398
    function clsRecordt_laporan_harian_denda($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_laporan_harian_denda/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_laporan_harian_denda";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
        }
    }
//End Class_Initialize Event

//Validate Method @2-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-E8CE9E37
    function CheckErrors()
    {
        $errors = false;
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

//Operation Method @2-3BB07479
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $Redirect = "t_laporan_harian_denda.php";
    }
//End Operation Method

//Show Method @2-D978379E
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

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
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

        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_laporan_harian_denda Class @2-FCB6E20C



//Initialize Page @1-014B8CE1
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
$TemplateFileName = "t_laporan_harian_denda.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D31FC476
include_once("./t_laporan_harian_denda_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3CF2637C
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_laporan_harian_denda = & new clsRecordt_laporan_harian_denda("", $MainPage);
$DatePicker_date_start_laporan1 = & new clsDatePicker("DatePicker_date_start_laporan1", "t_laporan_harian_denda", "date_start_laporan", $MainPage);
$date_end_laporan = & new clsControl(ccsTextBox, "date_end_laporan", "date_end_laporan", ccsText, "", CCGetRequestParam("date_end_laporan", ccsGet, NULL), $MainPage);
$date_end_laporan->Required = true;
$DatePicker_end_start_laporan1 = & new clsDatePicker("DatePicker_end_start_laporan1", "t_laporan_harian_denda", "date_end_laporan", $MainPage);
$vat_code = & new clsControl(ccsTextBox, "vat_code", "Ayat Pajak", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $MainPage);
$vat_code->Required = true;
$date_start_laporan = & new clsControl(ccsTextBox, "date_start_laporan", "date_start_laporan", ccsText, "", CCGetRequestParam("date_start_laporan", ccsGet, NULL), $MainPage);
$date_start_laporan->Required = true;
$p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $MainPage);
$MainPage->t_laporan_harian_denda = & $t_laporan_harian_denda;
$MainPage->DatePicker_date_start_laporan1 = & $DatePicker_date_start_laporan1;
$MainPage->date_end_laporan = & $date_end_laporan;
$MainPage->DatePicker_end_start_laporan1 = & $DatePicker_end_start_laporan1;
$MainPage->vat_code = & $vat_code;
$MainPage->date_start_laporan = & $date_start_laporan;
$MainPage->p_vat_type_id = & $p_vat_type_id;

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

//Execute Components @1-E9639E42
$t_laporan_harian_denda->Operation();
//End Execute Components

//Go to destination page @1-31E6C93C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($t_laporan_harian_denda);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FAC720A9
$t_laporan_harian_denda->Show();
$DatePicker_date_start_laporan1->Show();
$DatePicker_end_start_laporan1->Show();
$date_end_laporan->Show();
$vat_code->Show();
$date_start_laporan->Show();
$p_vat_type_id->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6DE3A297
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($t_laporan_harian_denda);
unset($Tpl);
//End Unload Page


?>
