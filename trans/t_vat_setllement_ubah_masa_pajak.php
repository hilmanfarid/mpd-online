<?php
//Include Common Files @1-C58ED726
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ubah_masa_pajak.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordformPerubahanMasaPajak { //formPerubahanMasaPajak Class @3-41295F21

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

//Class_Initialize Event @3-89DA882D
    function clsRecordformPerubahanMasaPajak($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record formPerubahanMasaPajak/Error";
        $this->DataSource = new clsformPerubahanMasaPajakDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "formPerubahanMasaPajak";
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
            $this->start_period = & new clsControl(ccsTextBox, "start_period", "start_period", ccsText, "", CCGetRequestParam("start_period", $Method, NULL), $this);
            $this->DatePicker_settlement_date1 = & new clsDatePicker("DatePicker_settlement_date1", "formPerubahanMasaPajak", "start_period", $this);
            $this->start_period_new = & new clsControl(ccsTextBox, "start_period_new", "start_period_new", ccsText, "", CCGetRequestParam("start_period_new", $Method, NULL), $this);
            $this->start_period_new->Required = true;
            $this->DatePicker_settlement_date_new1 = & new clsDatePicker("DatePicker_settlement_date_new1", "formPerubahanMasaPajak", "start_period_new", $this);
            $this->end_period = & new clsControl(ccsTextBox, "end_period", "end_period", ccsText, "", CCGetRequestParam("end_period", $Method, NULL), $this);
            $this->DatePicker_settlement_date2 = & new clsDatePicker("DatePicker_settlement_date2", "formPerubahanMasaPajak", "end_period", $this);
            $this->end_period_new = & new clsControl(ccsTextBox, "end_period_new", "end_period_new", ccsText, "", CCGetRequestParam("end_period_new", $Method, NULL), $this);
            $this->end_period_new->Required = true;
            $this->DatePicker_settlement_date_new2 = & new clsDatePicker("DatePicker_settlement_date_new2", "formPerubahanMasaPajak", "end_period_new", $this);
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

//Validate Method @3-6E52E230
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->alasan->Validate() && $Validation);
        $Validation = ($this->start_period->Validate() && $Validation);
        $Validation = ($this->start_period_new->Validate() && $Validation);
        $Validation = ($this->end_period->Validate() && $Validation);
        $Validation = ($this->end_period_new->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alasan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->start_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->start_period_new->Errors->Count() == 0);
        $Validation =  $Validation && ($this->end_period->Errors->Count() == 0);
        $Validation =  $Validation && ($this->end_period_new->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-CC2974D6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->alasan->Errors->Count());
        $errors = ($errors || $this->start_period->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date1->Errors->Count());
        $errors = ($errors || $this->start_period_new->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date_new1->Errors->Count());
        $errors = ($errors || $this->end_period->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date2->Errors->Count());
        $errors = ($errors || $this->end_period_new->Errors->Count());
        $errors = ($errors || $this->DatePicker_settlement_date_new2->Errors->Count());
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

//Operation Method @3-CE49FEAC
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
        $Redirect = "t_vat_setllement_ubah_masa_pajak.php";
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

//UpdateRow Method @3-D1106F2E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->start_period_new->SetValue($this->start_period_new->GetValue(true));
        $this->DataSource->alasan->SetValue($this->alasan->GetValue(true));
        $this->DataSource->end_period_new->SetValue($this->end_period_new->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-FB2C5D20
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
                    $this->start_period->SetValue($this->DataSource->start_period->GetValue());
                    $this->start_period_new->SetValue($this->DataSource->start_period_new->GetValue());
                    $this->end_period->SetValue($this->DataSource->end_period->GetValue());
                    $this->end_period_new->SetValue($this->DataSource->end_period_new->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alasan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->start_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->start_period_new->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date_new1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->end_period->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->end_period_new->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_settlement_date_new2->Errors->ToString());
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
        $this->start_period->Show();
        $this->DatePicker_settlement_date1->Show();
        $this->start_period_new->Show();
        $this->DatePicker_settlement_date_new1->Show();
        $this->end_period->Show();
        $this->DatePicker_settlement_date2->Show();
        $this->end_period_new->Show();
        $this->DatePicker_settlement_date_new2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End formPerubahanMasaPajak Class @3-FCB6E20C

class clsformPerubahanMasaPajakDataSource extends clsDBConnSIKP {  //formPerubahanMasaPajakDataSource Class @3-5BBED413

//DataSource Variables @3-01766CD5
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
    var $start_period;
    var $start_period_new;
    var $end_period;
    var $end_period_new;
//End DataSource Variables
	var $itemResult;
//DataSourceClass_Initialize Event @3-40E34C07
    function clsformPerubahanMasaPajakDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record formPerubahanMasaPajak/Error";
        $this->Initialize();
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsText, "");
        
        $this->alasan = new clsField("alasan", ccsText, "");
        
        $this->start_period = new clsField("start_period", ccsText, "");
        
        $this->start_period_new = new clsField("start_period_new", ccsText, "");
        
        $this->end_period = new clsField("end_period", ccsText, "");
        
        $this->end_period_new = new clsField("end_period_new", ccsText, "");
        

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

//SetValues Method @3-51CB5DB6
    function SetValues()
    {
        $this->t_vat_setllement_id->SetDBValue($this->f("t_vat_setllement_id"));
        $this->alasan->SetDBValue($this->f("alasan"));
        $this->start_period->SetDBValue($this->f("start_period"));
        $this->start_period_new->SetDBValue($this->f("start_period_new"));
        $this->end_period->SetDBValue($this->f("end_period"));
        $this->end_period_new->SetDBValue($this->f("end_period_new"));
    }
//End SetValues Method

//Update Method @3-5B1037D9
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsInteger, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["start_period_new"] = new clsSQLParameter("ctrlstart_period_new", ccsText, "", "", $this->start_period_new->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->cp["alasan"] = new clsSQLParameter("ctrlalasan", ccsText, "", "", $this->alasan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["end_period_new"] = new clsSQLParameter("ctrlend_period_new", ccsText, "", "", $this->end_period_new->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["start_period_new"]->GetValue()) and !strlen($this->cp["start_period_new"]->GetText()) and !is_bool($this->cp["start_period_new"]->GetValue())) 
            $this->cp["start_period_new"]->SetValue($this->start_period_new->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["alasan"]->GetValue()) and !strlen($this->cp["alasan"]->GetText()) and !is_bool($this->cp["alasan"]->GetValue())) 
            $this->cp["alasan"]->SetValue($this->alasan->GetValue(true));
        if (!is_null($this->cp["end_period_new"]->GetValue()) and !strlen($this->cp["end_period_new"]->GetText()) and !is_bool($this->cp["end_period_new"]->GetValue())) 
            $this->cp["end_period_new"]->SetValue($this->end_period_new->GetValue(true));
        $this->SQL = "SELECT f_update_masa_pajak(" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsInteger) . ",'" . $this->SQLValue($this->cp["start_period_new"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["end_period_new"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["alasan"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "') AS msg";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->itemResult = $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End formPerubahanMasaPajakDataSource Class @3-FCB6E20C

//Initialize Page @1-4855479A
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
$TemplateFileName = "t_vat_setllement_ubah_masa_pajak.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B5F8CA1E
include_once("./t_vat_setllement_ubah_masa_pajak_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CFC51940
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$formPerubahanMasaPajak = & new clsRecordformPerubahanMasaPajak("", $MainPage);
$MainPage->formPerubahanMasaPajak = & $formPerubahanMasaPajak;
$formPerubahanMasaPajak->Initialize();

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

//Execute Components @1-F6E7AE4D
$formPerubahanMasaPajak->Operation();
//End Execute Components

//Go to destination page @1-3655191F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($formPerubahanMasaPajak);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EEC4AADA
$formPerubahanMasaPajak->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7A5DFD6A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($formPerubahanMasaPajak);
unset($Tpl);
//End Unload Page


?>
