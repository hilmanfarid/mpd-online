<?php
//Include Common Files @1-F0021A9D
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_rep_lap_harian_teller.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_rep_lap_harian_bdhrSearch { //t_rep_lap_harian_bdhrSearch Class @3-E100DA96

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

//Class_Initialize Event @3-C04C0F73
    function clsRecordt_rep_lap_harian_bdhrSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_rep_lap_harian_bdhrSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_rep_lap_harian_bdhrSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->tgl_penerimaan = & new clsControl(ccsTextBox, "tgl_penerimaan", "tgl_penerimaan", ccsDate, array("dd", "-", "mm", "-", "yyyy"), CCGetRequestParam("tgl_penerimaan", $Method, NULL), $this);
            $this->DatePicker_tgl_penerimaan = & new clsDatePicker("DatePicker_tgl_penerimaan", "t_rep_lap_harian_bdhrSearch", "tgl_penerimaan", $this);
            $this->kabid = & new clsControl(ccsHidden, "kabid", "kabid", ccsText, "", CCGetRequestParam("kabid", $Method, NULL), $this);
            $this->Button_DoSearch1 = & new clsButton("Button_DoSearch1", $Method, $this);
            $this->nama_teller = & new clsControl(ccsListBox, "nama_teller", "nama_teller", ccsText, "", CCGetRequestParam("nama_teller", $Method, NULL), $this);
            $this->nama_teller->DSType = dsListOfValues;
            $this->nama_teller->Values = array(array("ESSYBKP", "ESSYBKP"), array("HERIBKP", "HERIBKP"), array("PAINCEBKP", "PAINCEBKP"));
            $this->Button_DoSearch2 = & new clsButton("Button_DoSearch2", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-5712E20A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->tgl_penerimaan->Validate() && $Validation);
        $Validation = ($this->kabid->Validate() && $Validation);
        $Validation = ($this->nama_teller->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tgl_penerimaan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kabid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nama_teller->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-A675072A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->DatePicker_tgl_penerimaan->Errors->Count());
        $errors = ($errors || $this->kabid->Errors->Count());
        $errors = ($errors || $this->nama_teller->Errors->Count());
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

//Operation Method @3-23190CCC
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
        $Redirect = "t_rep_lap_harian_teller.php";
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

//Show Method @3-05B1AB4B
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

        $this->nama_teller->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tgl_penerimaan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kabid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nama_teller->Errors->ToString());
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
        $this->DatePicker_tgl_penerimaan->Show();
        $this->kabid->Show();
        $this->Button_DoSearch1->Show();
        $this->nama_teller->Show();
        $this->Button_DoSearch2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_rep_lap_harian_bdhrSearch Class @3-FCB6E20C

//Initialize Page @1-5770489A
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
$TemplateFileName = "t_rep_lap_harian_teller.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E8B5EB1F
include_once("./t_rep_lap_harian_teller_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1C9E65A8
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_rep_lap_harian_bdhrSearch = & new clsRecordt_rep_lap_harian_bdhrSearch("", $MainPage);
$Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", ccsGet, NULL), $MainPage);
$Label1->HTML = true;
$MainPage->t_rep_lap_harian_bdhrSearch = & $t_rep_lap_harian_bdhrSearch;
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

//Execute Components @1-AD886EB2
$t_rep_lap_harian_bdhrSearch->Operation();
//End Execute Components

//Go to destination page @1-32AAB6F7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_rep_lap_harian_bdhrSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1F5BAE74
$t_rep_lap_harian_bdhrSearch->Show();
$Label1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BF231CAD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_rep_lap_harian_bdhrSearch);
unset($Tpl);
//End Unload Page


?>
