<?php
//Include Common Files @1-BFE008AA
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_block_piutang.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_cust_acc_status_editForm { //t_cust_acc_status_editForm Class @3-6AEE7FF4

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

//Class_Initialize Event @3-AAD1AC38
    function clsRecordt_cust_acc_status_editForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_cust_acc_status_editForm/Error";
        $this->DataSource = new clst_cust_acc_status_editFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_cust_acc_status_editForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->block_status = & new clsControl(ccsListBox, "block_status", "block_status", ccsText, "", CCGetRequestParam("block_status", $Method, NULL), $this);
            $this->block_status->DSType = dsListOfValues;
            $this->block_status->Values = array(array("T", "BLOCK"), array("F", "BUKA BLOCK"));
            $this->alasan = & new clsControl(ccsTextArea, "alasan", "alasan", ccsText, "", CCGetRequestParam("alasan", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @3-063CB0D2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->block_status->Validate() && $Validation);
        $Validation = ($this->alasan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->block_status->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alasan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-5031116A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->block_status->Errors->Count());
        $errors = ($errors || $this->alasan->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
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

//Operation Method @3-90D63D57
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button1" : "";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = "t_block_piutang.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1) || !$this->UpdateRow()) {
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

//UpdateRow Method @3-3A391904
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->block_status->SetValue($this->block_status->GetValue(true));
        $this->DataSource->alasan->SetValue($this->alasan->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-701C3FB5
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

        $this->block_status->Prepare();

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
                    $this->block_status->SetValue($this->DataSource->block_status->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->block_status->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alasan->Errors->ToString());
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
        $this->Button1->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button1->Show();
        $this->block_status->Show();
        $this->alasan->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cust_acc_status_editForm Class @3-FCB6E20C

class clst_cust_acc_status_editFormDataSource extends clsDBConnSIKP {  //t_cust_acc_status_editFormDataSource Class @3-B007FFBE

//DataSource Variables @3-B49C90D8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $block_status;
    var $alasan;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-5C80B7F7
    function clst_cust_acc_status_editFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cust_acc_status_editForm/Error";
        $this->Initialize();
        $this->block_status = new clsField("block_status", ccsText, "");
        
        $this->alasan = new clsField("alasan", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @3-5DDEAAA6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select * from p_block_piutang where block_id=1";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-771E4251
    function SetValues()
    {
        $this->block_status->SetDBValue($this->f("block_status"));
    }
//End SetValues Method

//Update Method @3-6DEC46FE
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["block_status"] = new clsSQLParameter("ctrlblock_status", ccsText, "", "", $this->block_status->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["alasan"] = new clsSQLParameter("ctrlalasan", ccsText, "", "", $this->alasan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["username"] = new clsSQLParameter("expr47", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["block_status"]->GetValue()) and !strlen($this->cp["block_status"]->GetText()) and !is_bool($this->cp["block_status"]->GetValue())) 
            $this->cp["block_status"]->SetValue($this->block_status->GetValue(true));
        if (!is_null($this->cp["alasan"]->GetValue()) and !strlen($this->cp["alasan"]->GetText()) and !is_bool($this->cp["alasan"]->GetValue())) 
            $this->cp["alasan"]->SetValue($this->alasan->GetValue(true));
        if (!is_null($this->cp["username"]->GetValue()) and !strlen($this->cp["username"]->GetText()) and !is_bool($this->cp["username"]->GetValue())) 
            $this->cp["username"]->SetValue(CCGetUserLogin());
        $this->SQL = "select * from f_update_block_piutang\n" .
        "('" . $this->SQLValue($this->cp["block_status"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["alasan"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["username"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_cust_acc_status_editFormDataSource Class @3-FCB6E20C

//Initialize Page @1-730BF359
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
$TemplateFileName = "t_block_piutang.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D855D9BA
include_once("./t_block_piutang_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DA01B9B0
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_cust_acc_status_editForm = & new clsRecordt_cust_acc_status_editForm("", $MainPage);
$MainPage->t_cust_acc_status_editForm = & $t_cust_acc_status_editForm;
$t_cust_acc_status_editForm->Initialize();

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

//Execute Components @1-BFBC1E7E
$t_cust_acc_status_editForm->Operation();
//End Execute Components

//Go to destination page @1-DE66C555
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_cust_acc_status_editForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CEDD6662
$t_cust_acc_status_editForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7C358BC3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_cust_acc_status_editForm);
unset($Tpl);
//End Unload Page


?>
