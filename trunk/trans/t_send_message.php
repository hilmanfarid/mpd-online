<?php
//Include Common Files @1-2C244E87
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_send_message.php");
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

//Class_Initialize Event @3-E84E8CF1
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
        $this->InsertAllowed = true;
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
            $this->message_body = & new clsControl(ccsTextArea, "message_body", "message_body", ccsText, "", CCGetRequestParam("message_body", $Method, NULL), $this);
            $this->message_body->Required = true;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsText, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->t_message_inbox_id = & new clsControl(ccsHidden, "t_message_inbox_id", "t_message_inbox_id", ccsText, "", CCGetRequestParam("t_message_inbox_id", $Method, NULL), $this);
            $this->message_type = & new clsControl(ccsListBox, "message_type", "message_type", ccsText, "", CCGetRequestParam("message_type", $Method, NULL), $this);
            $this->message_type->DSType = dsSQL;
            $this->message_type->DataSource = new clsDBConnSIKP();
            $this->message_type->ds = & $this->message_type->DataSource;
            list($this->message_type->BoundColumn, $this->message_type->TextColumn, $this->message_type->DBFormat) = array("", "", "");
            $this->message_type->DataSource->SQL = "select p_message_type.p_message_type_id,p_message_type.message_type from p_message_type LEFT JOIN p_msg_type_role_map on p_message_type.p_message_type_id = p_msg_type_role_map.p_message_type_id\n" .
            "where p_app_role_id_for = 26";
            $this->message_type->DataSource->Order = "";
        }
    }
//End Class_Initialize Event

//Initialize Method @3-2B96BD7E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);
    }
//End Initialize Method

//Validate Method @3-48A60451
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->message_body->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->t_message_inbox_id->Validate() && $Validation);
        $Validation = ($this->message_type->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->message_body->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_message_inbox_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->message_type->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-821C256B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->message_body->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->t_message_inbox_id->Errors->Count());
        $errors = ($errors || $this->message_type->Errors->Count());
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

//Operation Method @3-99AB1513
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
            $this->PressedButton = $this->EditMode ? "" : "Button1";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = "t_send_message.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1) || !$this->InsertRow()) {
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

//InsertRow Method @3-46639238
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->t_message_inbox_id->SetValue($this->t_message_inbox_id->GetValue(true));
        $this->DataSource->message_body->SetValue($this->message_body->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @3-918A8B90
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->p_account_status_id->SetValue($this->p_account_status_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-7AFD6AE9
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

        $this->message_type->Prepare();

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
                    $this->message_body->SetValue($this->DataSource->message_body->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->t_message_inbox_id->SetValue($this->DataSource->t_message_inbox_id->GetValue());
                    $this->message_type->SetValue($this->DataSource->message_type->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->message_body->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_message_inbox_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->message_type->Errors->ToString());
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
        $this->Button1->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button1->Show();
        $this->message_body->Show();
        $this->t_cust_account_id->Show();
        $this->t_message_inbox_id->Show();
        $this->message_type->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_cust_acc_status_editForm Class @3-FCB6E20C

class clst_cust_acc_status_editFormDataSource extends clsDBConnSIKP {  //t_cust_acc_status_editFormDataSource Class @3-B007FFBE

//DataSource Variables @3-443DE9BF
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $message_body;
    var $t_cust_account_id;
    var $t_message_inbox_id;
    var $message_type;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-1DB22FE9
    function clst_cust_acc_status_editFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_cust_acc_status_editForm/Error";
        $this->Initialize();
        $this->message_body = new clsField("message_body", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsText, "");
        
        $this->t_message_inbox_id = new clsField("t_message_inbox_id", ccsText, "");
        
        $this->message_type = new clsField("message_type", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-9E4FCC0F
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_account_id", ccsInteger, "", "", $this->Parameters["urlt_cust_account_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-0A43A81F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select * from t_cust_account where t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-47A8A763
    function SetValues()
    {
        $this->message_body->SetDBValue($this->f("message_body"));
        $this->t_cust_account_id->SetDBValue($this->f("t_cust_account_id"));
        $this->t_message_inbox_id->SetDBValue($this->f("t_message_inbox_id"));
        $this->message_type->SetDBValue($this->f("message_type"));
    }
//End SetValues Method

//Insert Method @3-6458B995
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["sender_message_id"] = new clsSQLParameter("ctrlt_message_inbox_id", ccsFloat, "", "", $this->t_message_inbox_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->cp["message_body"] = new clsSQLParameter("ctrlmessage_body", ccsText, "", "", $this->message_body->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["sender_message_id"]->GetValue()) and !strlen($this->cp["sender_message_id"]->GetText()) and !is_bool($this->cp["sender_message_id"]->GetValue())) 
            $this->cp["sender_message_id"]->SetValue($this->t_message_inbox_id->GetValue(true));
        if (!strlen($this->cp["sender_message_id"]->GetText()) and !is_bool($this->cp["sender_message_id"]->GetValue(true))) 
            $this->cp["sender_message_id"]->SetText(0);
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["message_body"]->GetValue()) and !strlen($this->cp["message_body"]->GetText()) and !is_bool($this->cp["message_body"]->GetValue())) 
            $this->cp["message_body"]->SetValue($this->message_body->GetValue(true));
        $this->SQL = "SELECT f_send_message_to_wp(" . $this->SQLValue($this->cp["sender_message_id"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["message_body"]->GetDBValue(), ccsText) . "',null) as pesan";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @3-397403F7
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsInteger, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_account_status_id"] = new clsSQLParameter("ctrlp_account_status_id", ccsInteger, "", "", $this->p_account_status_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["p_account_status_id"]->GetValue()) and !strlen($this->cp["p_account_status_id"]->GetText()) and !is_bool($this->cp["p_account_status_id"]->GetValue())) 
            $this->cp["p_account_status_id"]->SetValue($this->p_account_status_id->GetValue(true));
        if (!strlen($this->cp["p_account_status_id"]->GetText()) and !is_bool($this->cp["p_account_status_id"]->GetValue(true))) 
            $this->cp["p_account_status_id"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        $this->SQL = "select f_update_acc_status(" . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsInteger) . "," . $this->SQLValue($this->cp["p_account_status_id"]->GetDBValue(), ccsInteger) . ",'" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "','" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_cust_acc_status_editFormDataSource Class @3-FCB6E20C

//Initialize Page @1-D810D3FC
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
$TemplateFileName = "t_send_message.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-08295559
include_once("./t_send_message_events.php");
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
