<?php
//Include Common Files @1-B4E92A3C
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_ubah_register.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordLOV { //LOV Class @3-40E97705

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

//Class_Initialize Event @3-8088C5C7
    function clsRecordLOV($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record LOV/Error";
        $this->DataSource = new clsLOVDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "LOV";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->npwd->Required = true;
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsInteger, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->total_trans_amount = & new clsControl(ccsTextBox, "total_trans_amount", "total_trans_amount", ccsText, "", CCGetRequestParam("total_trans_amount", $Method, NULL), $this);
            $this->total_trans_amount->Required = true;
            $this->total_vat_amount = & new clsControl(ccsTextBox, "total_vat_amount", "total_vat_amount", ccsText, "", CCGetRequestParam("total_vat_amount", $Method, NULL), $this);
            $this->total_vat_amount->Required = true;
            $this->is_settled = & new clsControl(ccsListBox, "is_settled", "is_settled", ccsText, "", CCGetRequestParam("is_settled", $Method, NULL), $this);
            $this->is_settled->DSType = dsListOfValues;
            $this->is_settled->Values = array(array("Y", "Sudah Register"), array("N", "Belum Register"));
            $this->payment_amount = & new clsControl(ccsTextBox, "payment_amount", "payment_amount", ccsText, "", CCGetRequestParam("payment_amount", $Method, NULL), $this);
            $this->payment_amount->Required = true;
            $this->payment_vat_amount = & new clsControl(ccsTextBox, "payment_vat_amount", "payment_vat_amount", ccsText, "", CCGetRequestParam("payment_vat_amount", $Method, NULL), $this);
            $this->payment_vat_amount->Required = true;
            $this->receipt_no = & new clsControl(ccsTextBox, "receipt_no", "receipt_no", ccsText, "", CCGetRequestParam("receipt_no", $Method, NULL), $this);
            $this->receipt_no->Required = true;
            $this->no_kohir = & new clsControl(ccsTextBox, "no_kohir", "no_kohir", ccsText, "", CCGetRequestParam("no_kohir", $Method, NULL), $this);
            $this->no_kohir->Required = true;
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

//Validate Method @3-310AFCEE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->total_trans_amount->Validate() && $Validation);
        $Validation = ($this->total_vat_amount->Validate() && $Validation);
        $Validation = ($this->is_settled->Validate() && $Validation);
        $Validation = ($this->payment_amount->Validate() && $Validation);
        $Validation = ($this->payment_vat_amount->Validate() && $Validation);
        $Validation = ($this->receipt_no->Validate() && $Validation);
        $Validation = ($this->no_kohir->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_trans_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_vat_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_settled->Errors->Count() == 0);
        $Validation =  $Validation && ($this->payment_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->payment_vat_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->receipt_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->no_kohir->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-2E6BF2A1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->total_trans_amount->Errors->Count());
        $errors = ($errors || $this->total_vat_amount->Errors->Count());
        $errors = ($errors || $this->is_settled->Errors->Count());
        $errors = ($errors || $this->payment_amount->Errors->Count());
        $errors = ($errors || $this->payment_vat_amount->Errors->Count());
        $errors = ($errors || $this->receipt_no->Errors->Count());
        $errors = ($errors || $this->no_kohir->Errors->Count());
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

//Operation Method @3-E1AEF71B
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
        $Redirect = "t_vat_setllement_ubah_register.php";
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

//UpdateRow Method @3-D449117C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->total_trans_amount->SetValue($this->total_trans_amount->GetValue(true));
        $this->DataSource->total_vat_amount->SetValue($this->total_vat_amount->GetValue(true));
        $this->DataSource->is_settled->SetValue($this->is_settled->GetValue(true));
        $this->DataSource->receipt_no->SetValue($this->receipt_no->GetValue(true));
        $this->DataSource->payment_amount->SetValue($this->payment_amount->GetValue(true));
        $this->DataSource->payment_vat_amount->SetValue($this->payment_vat_amount->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @3-E1BF66FA
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

        $this->is_settled->Prepare();

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
                    $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                    $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                    $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                    $this->is_settled->SetValue($this->DataSource->is_settled->GetValue());
                    $this->payment_amount->SetValue($this->DataSource->payment_amount->GetValue());
                    $this->payment_vat_amount->SetValue($this->DataSource->payment_vat_amount->GetValue());
                    $this->receipt_no->SetValue($this->DataSource->receipt_no->GetValue());
                    $this->no_kohir->SetValue($this->DataSource->no_kohir->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_trans_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_vat_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_settled->Errors->ToString());
            $Error = ComposeStrings($Error, $this->payment_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->payment_vat_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->receipt_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->no_kohir->Errors->ToString());
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

        $this->npwd->Show();
        $this->t_vat_setllement_id->Show();
        $this->Button1->Show();
        $this->total_trans_amount->Show();
        $this->total_vat_amount->Show();
        $this->is_settled->Show();
        $this->payment_amount->Show();
        $this->payment_vat_amount->Show();
        $this->receipt_no->Show();
        $this->no_kohir->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End LOV Class @3-FCB6E20C

class clsLOVDataSource extends clsDBConnSIKP {  //LOVDataSource Class @3-D70026EF

//DataSource Variables @3-84C45522
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $npwd;
    var $t_vat_setllement_id;
    var $total_trans_amount;
    var $total_vat_amount;
    var $is_settled;
    var $payment_amount;
    var $payment_vat_amount;
    var $receipt_no;
    var $no_kohir;
//End DataSource Variables
	var $itemResult;
//DataSourceClass_Initialize Event @3-29FDF48E
    function clsLOVDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record LOV/Error";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsInteger, "");
        
        $this->total_trans_amount = new clsField("total_trans_amount", ccsText, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsText, "");
        
        $this->is_settled = new clsField("is_settled", ccsText, "");
        
        $this->payment_amount = new clsField("payment_amount", ccsText, "");
        
        $this->payment_vat_amount = new clsField("payment_vat_amount", ccsText, "");
        
        $this->receipt_no = new clsField("receipt_no", ccsText, "");
        
        $this->no_kohir = new clsField("no_kohir", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-2FF47077
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsFloat, "", "", $this->Parameters["urlt_vat_setllement_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @3-4433E409
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select a.t_vat_setllement_id, a.npwd,a.no_kohir, a.is_settled,a.total_trans_amount,a.total_vat_amount,\n" .
        "b.receipt_no,b.payment_amount,b.payment_vat_amount\n" .
        "from t_vat_setllement a\n" .
        "LEFT JOIN t_payment_receipt b on a.t_vat_setllement_id = b.t_vat_setllement_id\n" .
        "where a.t_vat_setllement_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-5F71A492
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->total_trans_amount->SetDBValue($this->f("total_trans_amount"));
        $this->total_vat_amount->SetDBValue($this->f("total_vat_amount"));
        $this->is_settled->SetDBValue($this->f("is_settled"));
        $this->payment_amount->SetDBValue($this->f("payment_amount"));
        $this->payment_vat_amount->SetDBValue($this->f("payment_vat_amount"));
        $this->receipt_no->SetDBValue($this->f("receipt_no"));
        $this->no_kohir->SetDBValue($this->f("no_kohir"));
    }
//End SetValues Method

//Update Method @3-1F7C9C7B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsInteger, "", "", $this->t_vat_setllement_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["total_trans_amount"] = new clsSQLParameter("ctrltotal_trans_amount", ccsFloat, "", "", $this->total_trans_amount->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["total_vat_amount"] = new clsSQLParameter("ctrltotal_vat_amount", ccsFloat, "", "", $this->total_vat_amount->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["is_settled"] = new clsSQLParameter("ctrlis_settled", ccsText, "", "", $this->is_settled->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["receipt_no"] = new clsSQLParameter("ctrlreceipt_no", ccsText, "", "", $this->receipt_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["payment_amount"] = new clsSQLParameter("ctrlpayment_amount", ccsFloat, "", "", $this->payment_amount->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["payment_vat_amount"] = new clsSQLParameter("ctrlpayment_vat_amount", ccsFloat, "", "", $this->payment_vat_amount->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_vat_setllement_id"]->GetValue()) and !strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue())) 
            $this->cp["t_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!strlen($this->cp["t_vat_setllement_id"]->GetText()) and !is_bool($this->cp["t_vat_setllement_id"]->GetValue(true))) 
            $this->cp["t_vat_setllement_id"]->SetText(0);
        if (!is_null($this->cp["total_trans_amount"]->GetValue()) and !strlen($this->cp["total_trans_amount"]->GetText()) and !is_bool($this->cp["total_trans_amount"]->GetValue())) 
            $this->cp["total_trans_amount"]->SetValue($this->total_trans_amount->GetValue(true));
        if (!strlen($this->cp["total_trans_amount"]->GetText()) and !is_bool($this->cp["total_trans_amount"]->GetValue(true))) 
            $this->cp["total_trans_amount"]->SetText(0);
        if (!is_null($this->cp["total_vat_amount"]->GetValue()) and !strlen($this->cp["total_vat_amount"]->GetText()) and !is_bool($this->cp["total_vat_amount"]->GetValue())) 
            $this->cp["total_vat_amount"]->SetValue($this->total_vat_amount->GetValue(true));
        if (!strlen($this->cp["total_vat_amount"]->GetText()) and !is_bool($this->cp["total_vat_amount"]->GetValue(true))) 
            $this->cp["total_vat_amount"]->SetText(0);
        if (!is_null($this->cp["is_settled"]->GetValue()) and !strlen($this->cp["is_settled"]->GetText()) and !is_bool($this->cp["is_settled"]->GetValue())) 
            $this->cp["is_settled"]->SetValue($this->is_settled->GetValue(true));
        if (!is_null($this->cp["receipt_no"]->GetValue()) and !strlen($this->cp["receipt_no"]->GetText()) and !is_bool($this->cp["receipt_no"]->GetValue())) 
            $this->cp["receipt_no"]->SetValue($this->receipt_no->GetValue(true));
        if (!is_null($this->cp["payment_amount"]->GetValue()) and !strlen($this->cp["payment_amount"]->GetText()) and !is_bool($this->cp["payment_amount"]->GetValue())) 
            $this->cp["payment_amount"]->SetValue($this->payment_amount->GetValue(true));
        if (!strlen($this->cp["payment_amount"]->GetText()) and !is_bool($this->cp["payment_amount"]->GetValue(true))) 
            $this->cp["payment_amount"]->SetText(0);
        if (!is_null($this->cp["payment_vat_amount"]->GetValue()) and !strlen($this->cp["payment_vat_amount"]->GetText()) and !is_bool($this->cp["payment_vat_amount"]->GetValue())) 
            $this->cp["payment_vat_amount"]->SetValue($this->payment_vat_amount->GetValue(true));
        if (!strlen($this->cp["payment_vat_amount"]->GetText()) and !is_bool($this->cp["payment_vat_amount"]->GetValue(true))) 
            $this->cp["payment_vat_amount"]->SetText(0);
        $this->SQL = "SELECT * from f_ubah_data_register(\n" .
        "" . $this->SQLValue($this->cp["t_vat_setllement_id"]->GetDBValue(), ccsInteger) . ", \n" .
        "" . $this->SQLValue($this->cp["total_trans_amount"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["total_vat_amount"]->GetDBValue(), ccsFloat) . ", \n" .
        "'" . $this->SQLValue($this->cp["is_settled"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["receipt_no"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["payment_amount"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["payment_vat_amount"]->GetDBValue(), ccsFloat) . "\n" .
        ") AS msg";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->itemResult = $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End LOVDataSource Class @3-FCB6E20C

//Initialize Page @1-B70535F9
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
$TemplateFileName = "t_vat_setllement_ubah_register.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-1CD5E8CB
include_once("./t_vat_setllement_ubah_register_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-39826719
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$LOV = & new clsRecordLOV("", $MainPage);
$MainPage->LOV = & $LOV;
$LOV->Initialize();

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

//Execute Components @1-0F06B063
$LOV->Operation();
//End Execute Components

//Go to destination page @1-4C2A1E6D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($LOV);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1CEBCD98
$LOV->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3F6169EB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($LOV);
unset($Tpl);
//End Unload Page


?>
