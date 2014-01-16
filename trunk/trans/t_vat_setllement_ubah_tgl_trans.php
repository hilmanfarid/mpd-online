<?php
//Include Common Files @1-97176C16
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ubah_tgl_trans.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordformPerubahanTglTrans { //formPerubahanTglTrans Class @3-F829026D

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

//Class_Initialize Event @3-CAA59963
    function clsRecordformPerubahanTglTrans($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record formPerubahanTglTrans/Error";
        $this->DataSource = new clsformPerubahanTglTransDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "formPerubahanTglTrans";
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
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsText, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->alasan = & new clsControl(ccsTextArea, "alasan", "alasan", ccsText, "", CCGetRequestParam("alasan", $Method, NULL), $this);
            $this->alasan->Required = true;
            $this->settlement_date = & new clsControl(ccsTextBox, "settlement_date", "settlement_date", ccsText, "", CCGetRequestParam("settlement_date", $Method, NULL), $this);
            $this->DatePicker_settlement_date1 = & new clsDatePicker("DatePicker_settlement_date1", "formPerubahanTglTrans", "settlement_date", $this);
            $this->settlement_date_new = & new clsControl(ccsTextBox, "settlement_date_new", "settlement_date_new", ccsText, "", CCGetRequestParam("settlement_date_new", $Method, NULL), $this);
            $this->settlement_date_new->Required = true;
            $this->DatePicker_settlement_date_new1 = & new clsDatePicker("DatePicker_settlement_date_new1", "formPerubahanTglTrans", "settlement_date_new", $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-F2D2DDB3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_vat_setllement_id"] = CCGetFromGet("t_vat_setllement_id", NULL);
    }
//End Initialize Method

//Validate Method @3-75F49687
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->alasan->Validate() && $Validation);
        $Validation = ($this->settlement_date->Validate() && $Validation);
        $Validation = ($this->settlement_date_new->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alasan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->settlement_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->settlement_date_new->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-A6829B5D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->alasan->Errors->Count());
        $errors = ($errors || $this->settlement_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date1->Errors->Count());
        $errors = ($errors || $this->settlement_date_new->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date_new1->Errors->Count());
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

//Operation Method @3-394DB515
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
            $this->PressedButton = $this->EditMode ? "Button1" : "";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = "t_vat_setllement_ubah_tgl_trans.php";
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

//UpdateRow Method @3-AA32C996
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->settlement_date_new->SetValue($this->settlement_date_new->GetValue(true));
        $this->DataSource->alasan->SetValue($this->alasan->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-48D20109
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
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                    $this->alasan->SetValue($this->DataSource->alasan->GetValue());
                    $this->settlement_date->SetValue($this->DataSource->settlement_date->GetValue());
                    $this->settlement_date_new->SetValue($this->DataSource->settlement_date_new->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alasan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->settlement_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->settlement_date_new->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date_new1->Errors->ToString());
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
        $this->t_vat_setllement_id->Show();
        $this->alasan->Show();
        $this->settlement_date->Show();
        $this->DatePicker_settlement_date1->Show();
        $this->settlement_date_new->Show();
        $this->DatePicker_settlement_date_new1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End formPerubahanTglTrans Class @3-FCB6E20C

class clsformPerubahanTglTransDataSource extends clsDBConnSIKP {  //formPerubahanTglTransDataSource Class @3-4D4510BD

//DataSource Variables @3-17E0FDB4
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_vat_setllement_id;
    var $alasan;
    var $settlement_date;
    var $settlement_date_new;
//End DataSource Variables
	var $itemResult;
//DataSourceClass_Initialize Event @3-375BF9FC
    function clsformPerubahanTglTransDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record formPerubahanTglTrans/Error";
        $this->Initialize();
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsText, "");
        
        $this->alasan = new clsField("alasan", ccsText, "");
        
        $this->settlement_date = new clsField("settlement_date", ccsText, "");
        
        $this->settlement_date_new = new clsField("settlement_date_new", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-1B814BF5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsText, "", "", $this->Parameters["urlt_vat_setllement_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-AF614208
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT t_vat_setllement_id, t_customer_order_id,\n" .
        "to_char(settlement_date,'YYYY-MM-DD') AS settlement_date, p_finance_period_id, t_cust_account_id,\n" .
        "npwd, total_trans_amount, total_vat_amount, creation_date,\n" .
        "created_by, updated_date, updated_by, is_anomali,\n" .
        "is_authorized, no_kohir, p_settlement_type_id,\n" .
        "debt_vat_amt, cr_adjustment, cr_payment, cr_others,\n" .
        "cr_stp, db_interest_charge, db_increasing_charge,\n" .
        "db_admin_penalty, due_date, is_settled, start_period,\n" .
        "end_period, qty_room_sold, total_penalty_amount, doc_no,\n" .
        "p_vat_type_dtl_id, old_id\n" .
        "FROM t_vat_setllement\n" .
        "WHERE t_vat_setllement_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-DE767512
    function SetValues()
    {
        $this->t_vat_setllement_id->SetDBValue($this->f("t_vat_setllement_id"));
        $this->alasan->SetDBValue($this->f("alasan"));
        $this->settlement_date->SetDBValue($this->f("settlement_date"));
        $this->settlement_date_new->SetDBValue($this->f("settlement_date_new"));
    }
//End SetValues Method

//Update Method @3-35C05C83
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsInteger, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["settlement_date_new"] = new clsSQLParameter("ctrlsettlement_date_new", ccsText, "", "", $this->settlement_date_new->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->cp["alasan"] = new clsSQLParameter("ctrlalasan", ccsText, "", "", $this->alasan->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["settlement_date_new"]->GetValue()) and !strlen($this->cp["settlement_date_new"]->GetText()) and !is_bool($this->cp["settlement_date_new"]->GetValue())) 
            $this->cp["settlement_date_new"]->SetValue($this->settlement_date_new->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["alasan"]->GetValue()) and !strlen($this->cp["alasan"]->GetText()) and !is_bool($this->cp["alasan"]->GetValue())) 
            $this->cp["alasan"]->SetValue($this->alasan->GetValue(true));
        $this->SQL = "SELECT f_update_tgl_trans(" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsInteger) . ",'" . $this->SQLValue($this->cp["settlement_date_new"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["alasan"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "') AS msg";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->itemResult = $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End formPerubahanTglTransDataSource Class @3-FCB6E20C

//Initialize Page @1-5DDFB1F1
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
$TemplateFileName = "t_vat_setllement_ubah_tgl_trans.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-5CAC1408
include_once("./t_vat_setllement_ubah_tgl_trans_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5FA414E9
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$formPerubahanTglTrans = & new clsRecordformPerubahanTglTrans("", $MainPage);
$MainPage->formPerubahanTglTrans = & $formPerubahanTglTrans;
$formPerubahanTglTrans->Initialize();

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

//Execute Components @1-3B2F1799
$formPerubahanTglTrans->Operation();
//End Execute Components

//Go to destination page @1-139AAD86
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($formPerubahanTglTrans);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C8B4BA2F
$formPerubahanTglTrans->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8D121923
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($formPerubahanTglTrans);
unset($Tpl);
//End Unload Page


?>
