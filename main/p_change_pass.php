<?php
//Include Common Files @1-F3993E8C
define("RelativePath", "..");
define("PathToCurrentPage", "/main/");
define("FileName", "p_change_pass.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordp_pass_byadminForm { //p_pass_byadminForm Class @24-50769A3B

//Variables @24-D6FF3E86

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

//Class_Initialize Event @24-43B0A6CE
    function clsRecordp_pass_byadminForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_pass_byadminForm/Error";
        $this->DataSource = new clsp_pass_byadminFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_pass_byadminForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Ubah = & new clsButton("Button_Ubah", $Method, $this);
            $this->n_user_pwd1 = & new clsControl(ccsTextBox, "n_user_pwd1", "n_user_pwd1", ccsText, "", CCGetRequestParam("n_user_pwd1", $Method, NULL), $this);
            $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_app_user_id", $Method, NULL), $this);
            $this->n_user_pwd2 = & new clsControl(ccsTextBox, "n_user_pwd2", "n_user_pwd2", ccsText, "", CCGetRequestParam("n_user_pwd2", $Method, NULL), $this);
            $this->app_user_name = & new clsControl(ccsLabel, "app_user_name", "app_user_name", ccsText, "", CCGetRequestParam("app_user_name", $Method, NULL), $this);
            $this->o_user_pwd = & new clsControl(ccsTextBox, "o_user_pwd", "o_user_pwd", ccsText, "", CCGetRequestParam("o_user_pwd", $Method, NULL), $this);
            $this->Button_cancel = & new clsButton("Button_cancel", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @24-BC1D2020
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["expr30"] = CCGetUserLogin();
    }
//End Initialize Method

//Validate Method @24-43BBBFEE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->n_user_pwd1->Validate() && $Validation);
        $Validation = ($this->p_app_user_id->Validate() && $Validation);
        $Validation = ($this->n_user_pwd2->Validate() && $Validation);
        $Validation = ($this->o_user_pwd->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->n_user_pwd1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->n_user_pwd2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->o_user_pwd->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-499B3367
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->n_user_pwd1->Errors->Count());
        $errors = ($errors || $this->p_app_user_id->Errors->Count());
        $errors = ($errors || $this->n_user_pwd2->Errors->Count());
        $errors = ($errors || $this->app_user_name->Errors->Count());
        $errors = ($errors || $this->o_user_pwd->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @24-ED598703
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

//Operation Method @24-018B67F1
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Ubah";
            if($this->Button_Ubah->Pressed) {
                $this->PressedButton = "Button_Ubah";
            } else if($this->Button_cancel->Pressed) {
                $this->PressedButton = "Button_cancel";
            }
        }
        $Redirect = "p_app_user.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Ubah") {
                $Redirect = "p_app_user.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Ubah->CCSEvents, "OnClick", $this->Button_Ubah)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_cancel") {
                if(!CCGetEvent($this->Button_cancel->CCSEvents, "OnClick", $this->Button_cancel)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @24-EDD159E5
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->app_user_name->SetValue($this->DataSource->app_user_name->GetValue());
                if(!$this->FormSubmitted){
                    $this->p_app_user_id->SetValue($this->DataSource->p_app_user_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->n_user_pwd1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->n_user_pwd2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->app_user_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->o_user_pwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
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

        $this->Button_Ubah->Show();
        $this->n_user_pwd1->Show();
        $this->p_app_user_id->Show();
        $this->n_user_pwd2->Show();
        $this->app_user_name->Show();
        $this->o_user_pwd->Show();
        $this->Button_cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_pass_byadminForm Class @24-FCB6E20C

class clsp_pass_byadminFormDataSource extends clsDBConnSIKP {  //p_pass_byadminFormDataSource Class @24-994369A8

//DataSource Variables @24-ADE0F8B5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $n_user_pwd1;
    var $p_app_user_id;
    var $n_user_pwd2;
    var $app_user_name;
    var $o_user_pwd;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-813C8F34
    function clsp_pass_byadminFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_pass_byadminForm/Error";
        $this->Initialize();
        $this->n_user_pwd1 = new clsField("n_user_pwd1", ccsText, "");
        
        $this->p_app_user_id = new clsField("p_app_user_id", ccsFloat, "");
        
        $this->n_user_pwd2 = new clsField("n_user_pwd2", ccsText, "");
        
        $this->app_user_name = new clsField("app_user_name", ccsText, "");
        
        $this->o_user_pwd = new clsField("o_user_pwd", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-9AEA10CC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr30", ccsText, "", "", $this->Parameters["expr30"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "app_user_name", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @24-CAA13497
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM p_app_user {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-4CECD303
    function SetValues()
    {
        $this->p_app_user_id->SetDBValue(trim($this->f("p_app_user_id")));
        $this->app_user_name->SetDBValue($this->f("app_user_name"));
    }
//End SetValues Method

} //End p_pass_byadminFormDataSource Class @24-FCB6E20C

//Initialize Page @1-8DDDCFE5
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
$TemplateFileName = "p_change_pass.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-0E9D9259
include_once("./p_change_pass_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-89405684
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_pass_byadminForm = & new clsRecordp_pass_byadminForm("", $MainPage);
$MainPage->p_pass_byadminForm = & $p_pass_byadminForm;
$p_pass_byadminForm->Initialize();

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

//Execute Components @1-2E90BDDA
$p_pass_byadminForm->Operation();
//End Execute Components

//Go to destination page @1-BC4FEF18
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_pass_byadminForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-688DBD5B
$p_pass_byadminForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FA2CAC4E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_pass_byadminForm);
unset($Tpl);
//End Unload Page
?>