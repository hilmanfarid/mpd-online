<?php
//Include Common Files @1-7F6904EC
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_send_sms_to_app_user.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordgrafik_pembayaran_form { //grafik_pembayaran_form Class @2-0F0D7DE3

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
 
//Class_Initialize Event @2-1118F853
    function clsRecordgrafik_pembayaran_form($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record grafik_pembayaran_form/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "grafik_pembayaran_form";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button2 = & new clsButton("Button2", $Method, $this);
            $this->app_user_name = & new clsControl(ccsTextBox, "app_user_name", "NPWD", ccsText, "", CCGetRequestParam("app_user_name", $Method, NULL), $this);
            $this->app_user_name->Required = true;
            $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_app_user_id", $Method, NULL), $this);
            $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "Nama Perusahaan", ccsText, "", CCGetRequestParam("mobile_no", $Method, NULL), $this);
            $this->message = & new clsControl(ccsTextArea, "message", "message", ccsText, "", CCGetRequestParam("message", $Method, NULL), $this);
            $this->message->Required = true;
        }
    }
//End Class_Initialize Event

//Validate Method @2-C491E060
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->app_user_name->Validate() && $Validation);
        $Validation = ($this->p_app_user_id->Validate() && $Validation);
        $Validation = ($this->mobile_no->Validate() && $Validation);
        $Validation = ($this->message->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->app_user_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->message->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-79D7AB7D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->app_user_name->Errors->Count());
        $errors = ($errors || $this->p_app_user_id->Errors->Count());
        $errors = ($errors || $this->mobile_no->Errors->Count());
        $errors = ($errors || $this->message->Errors->Count());
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

//Operation Method @2-E24409BD
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
            $this->PressedButton = "Button2";
            if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            }
        }
        $Redirect = "t_laporan_harian_denda.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-9A69DC57
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
            $Error = ComposeStrings($Error, $this->app_user_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->message->Errors->ToString());
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

        $this->Button2->Show();
        $this->app_user_name->Show();
        $this->p_app_user_id->Show();
        $this->mobile_no->Show();
        $this->message->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End grafik_pembayaran_form Class @2-FCB6E20C



//Initialize Page @1-7CA8CC70
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
$TemplateFileName = "t_send_sms_to_app_user.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-56DB8984
include_once("./t_send_sms_to_app_user_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1B034C5B
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$grafik_pembayaran_form = & new clsRecordgrafik_pembayaran_form("", $MainPage);
$MainPage->grafik_pembayaran_form = & $grafik_pembayaran_form;

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

//Execute Components @1-C960219B
$grafik_pembayaran_form->Operation();
//End Execute Components

//Go to destination page @1-9E3DED41
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($grafik_pembayaran_form);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9FB5719F
$grafik_pembayaran_form->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-45DA72BC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($grafik_pembayaran_form);
unset($Tpl);
//End Unload Page


?>
