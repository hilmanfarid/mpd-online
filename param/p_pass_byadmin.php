<?php
//Include Common Files @1-F6AC7A79
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_pass_byadmin.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordp_pass_byadminSearch { //p_pass_byadminSearch Class @4-AE3056AC

//Variables @4-D6FF3E86

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

//Class_Initialize Event @4-353DC3A7
    function clsRecordp_pass_byadminSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_pass_byadminSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_pass_byadminSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_app_user_id", $Method, NULL), $this);
            $this->s_keyword = & new clsControl(ccsHidden, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->p_app_userGridPage = & new clsControl(ccsHidden, "p_app_userGridPage", "p_app_userGridPage", ccsText, "", CCGetRequestParam("p_app_userGridPage", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @4-B9D575C1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_app_user_id->Validate() && $Validation);
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_app_userGridPage->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_app_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_userGridPage->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @4-E48BF3AF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_app_user_id->Errors->Count());
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_app_userGridPage->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @4-ED598703
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

//Operation Method @4-59D844F6
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $Redirect = "p_pass_byadmin.php";
    }
//End Operation Method

//Show Method @4-AB63C3A3
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
            $Error = ComposeStrings($Error, $this->p_app_user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_app_userGridPage->Errors->ToString());
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

        $this->p_app_user_id->Show();
        $this->s_keyword->Show();
        $this->p_app_userGridPage->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_pass_byadminSearch Class @4-FCB6E20C

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

//Class_Initialize Event @24-43CD7A60
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
        $this->UpdateAllowed = true;
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
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->n_user_pwd1 = & new clsControl(ccsTextBox, "n_user_pwd1", "n_user_pwd1", ccsText, "", CCGetRequestParam("n_user_pwd1", $Method, NULL), $this);
            $this->p_app_user_id = & new clsControl(ccsHidden, "p_app_user_id", "p_app_user_id", ccsFloat, "", CCGetRequestParam("p_app_user_id", $Method, NULL), $this);
            $this->n_user_pwd2 = & new clsControl(ccsTextBox, "n_user_pwd2", "n_user_pwd2", ccsText, "", CCGetRequestParam("n_user_pwd2", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @24-06ED8DF2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_app_user_id"] = CCGetFromGet("p_app_user_id", NULL);
    }
//End Initialize Method

//Validate Method @24-61957CBD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->n_user_pwd1->Validate() && $Validation);
        $Validation = ($this->p_app_user_id->Validate() && $Validation);
        $Validation = ($this->n_user_pwd2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->n_user_pwd1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_app_user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->n_user_pwd2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-419FB3B6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->n_user_pwd1->Errors->Count());
        $errors = ($errors || $this->p_app_user_id->Errors->Count());
        $errors = ($errors || $this->n_user_pwd2->Errors->Count());
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

//Operation Method @24-59A670AE
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = "p_app_user.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "p_app_user.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//UpdateRow Method @24-4ED67776
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->n_user_pwd1->SetValue($this->n_user_pwd1->GetValue(true));
        $this->DataSource->p_app_user_id->SetValue($this->p_app_user_id->GetValue(true));
        $this->DataSource->p_app_user_id->SetValue($this->p_app_user_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @24-F42CA86F
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->n_user_pwd1->Show();
        $this->p_app_user_id->Show();
        $this->n_user_pwd2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_pass_byadminForm Class @24-FCB6E20C

class clsp_pass_byadminFormDataSource extends clsDBConnSIKP {  //p_pass_byadminFormDataSource Class @24-994369A8

//DataSource Variables @24-44C57253
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $n_user_pwd1;
    var $p_app_user_id;
    var $n_user_pwd2;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-226F6AF4
    function clsp_pass_byadminFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_pass_byadminForm/Error";
        $this->Initialize();
        $this->n_user_pwd1 = new clsField("n_user_pwd1", ccsText, "");
        
        $this->p_app_user_id = new clsField("p_app_user_id", ccsFloat, "");
        
        $this->n_user_pwd2 = new clsField("n_user_pwd2", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-576B52F2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_app_user_id", ccsFloat, "", "", $this->Parameters["urlp_app_user_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_app_user_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
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

//SetValues Method @24-1C9C2B79
    function SetValues()
    {
        $this->p_app_user_id->SetDBValue(trim($this->f("p_app_user_id")));
    }
//End SetValues Method

//Update Method @24-5AC67EFA
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["n_user_pwd1"] = new clsSQLParameter("ctrln_user_pwd1", ccsText, "", "", $this->n_user_pwd1->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_app_user_id"] = new clsSQLParameter("ctrlp_app_user_id", ccsFloat, "", "", $this->p_app_user_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["n_user_pwd1"]->GetValue()) and !strlen($this->cp["n_user_pwd1"]->GetText()) and !is_bool($this->cp["n_user_pwd1"]->GetValue())) 
            $this->cp["n_user_pwd1"]->SetValue($this->n_user_pwd1->GetValue(true));
        if (!is_null($this->cp["p_app_user_id"]->GetValue()) and !strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue())) 
            $this->cp["p_app_user_id"]->SetValue($this->p_app_user_id->GetValue(true));
        if (!strlen($this->cp["p_app_user_id"]->GetText()) and !is_bool($this->cp["p_app_user_id"]->GetValue(true))) 
            $this->cp["p_app_user_id"]->SetText(0);
        $this->SQL = "UPDATE p_app_user SET \n" .
        "user_pwd=md5('" . $this->SQLValue($this->cp["n_user_pwd1"]->GetDBValue(), ccsText) . "') \n" .
        "WHERE  p_app_user_id = " . $this->SQLValue($this->cp["p_app_user_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End p_pass_byadminFormDataSource Class @24-FCB6E20C

//Initialize Page @1-A9FF9754
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
$TemplateFileName = "p_pass_byadmin.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-896AEA54
include_once("./p_pass_byadmin_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-91BE9101
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$app_user_name = & new clsControl(ccsLabel, "app_user_name", "app_user_name", ccsText, "", CCGetRequestParam("app_user_name", ccsGet, NULL), $MainPage);
$p_pass_byadminSearch = & new clsRecordp_pass_byadminSearch("", $MainPage);
$p_pass_byadminForm = & new clsRecordp_pass_byadminForm("", $MainPage);
$MainPage->app_user_name = & $app_user_name;
$MainPage->p_pass_byadminSearch = & $p_pass_byadminSearch;
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

//Execute Components @1-8BCF6079
$p_pass_byadminSearch->Operation();
$p_pass_byadminForm->Operation();
//End Execute Components

//Go to destination page @1-3A08BB28
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_pass_byadminSearch);
    unset($p_pass_byadminForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A052D503
$p_pass_byadminSearch->Show();
$p_pass_byadminForm->Show();
$app_user_name->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-954F55A5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_pass_byadminSearch);
unset($p_pass_byadminForm);
unset($Tpl);
//End Unload Page


?>
