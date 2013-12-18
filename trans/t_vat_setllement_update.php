<?php
//Include Common Files @1-C1F825D4
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_setllement_update.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_setllementForm { //t_vat_setllementForm Class @23-D94969C3

//Variables @23-D6FF3E86

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

//Class_Initialize Event @23-20077A91
    function clsRecordt_vat_setllementForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->DataSource = new clst_vat_setllementFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_setllementForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = & new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = & new clsButton("Button_Delete", $Method, $this);
            $this->total_trans_amount = & new clsControl(ccsTextBox, "total_trans_amount", "total_trans_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_trans_amount", $Method, NULL), $this);
            $this->total_trans_amount->Required = true;
            $this->total_vat_amount = & new clsControl(ccsTextBox, "total_vat_amount", "total_vat_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_vat_amount", $Method, NULL), $this);
            $this->total_vat_amount->Required = true;
            $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "Id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", $Method, NULL), $this);
            $this->debt_vat_amt = & new clsControl(ccsTextBox, "debt_vat_amt", "debt_vat_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("debt_vat_amt", $Method, NULL), $this);
            $this->debt_vat_amt->Required = true;
            $this->cr_adjustment = & new clsControl(ccsTextBox, "cr_adjustment", "cr_adjustment", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_adjustment", $Method, NULL), $this);
            $this->cr_adjustment->Required = true;
            $this->cr_others = & new clsControl(ccsTextBox, "cr_others", "cr_others", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_others", $Method, NULL), $this);
            $this->cr_others->Required = true;
            $this->cr_payment = & new clsControl(ccsTextBox, "cr_payment", "cr_payment", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_payment", $Method, NULL), $this);
            $this->cr_payment->Required = true;
            $this->cr_stp = & new clsControl(ccsTextBox, "cr_stp", "cr_stp", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("cr_stp", $Method, NULL), $this);
            $this->cr_stp->Required = true;
            $this->db_interest_charge = & new clsControl(ccsTextBox, "db_interest_charge", "db_interest_charge", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("db_interest_charge", $Method, NULL), $this);
            $this->db_interest_charge->Required = true;
            $this->db_increasing_charge = & new clsControl(ccsTextBox, "db_increasing_charge", "db_increasing_charge", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("db_increasing_charge", $Method, NULL), $this);
            $this->db_increasing_charge->Required = true;
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->total_penalty_amount = & new clsControl(ccsTextBox, "total_penalty_amount", "total_penalty_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_penalty_amount", $Method, NULL), $this);
            $this->total_penalty_amount->Required = true;
            $this->due_date = & new clsControl(ccsTextBox, "due_date", "due_date", ccsText, "", CCGetRequestParam("due_date", $Method, NULL), $this);
            $this->due_date->Required = true;
            $this->DatePicker_due_date = & new clsDatePicker("DatePicker_due_date", "t_vat_setllementForm", "due_date", $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->total_trans_amount->Value) && !strlen($this->total_trans_amount->Value) && $this->total_trans_amount->Value !== false)
                    $this->total_trans_amount->SetText(0);
                if(!is_array($this->total_vat_amount->Value) && !strlen($this->total_vat_amount->Value) && $this->total_vat_amount->Value !== false)
                    $this->total_vat_amount->SetText(0);
                if(!is_array($this->debt_vat_amt->Value) && !strlen($this->debt_vat_amt->Value) && $this->debt_vat_amt->Value !== false)
                    $this->debt_vat_amt->SetText(0);
                if(!is_array($this->cr_adjustment->Value) && !strlen($this->cr_adjustment->Value) && $this->cr_adjustment->Value !== false)
                    $this->cr_adjustment->SetText(0);
                if(!is_array($this->cr_others->Value) && !strlen($this->cr_others->Value) && $this->cr_others->Value !== false)
                    $this->cr_others->SetText(0);
                if(!is_array($this->cr_payment->Value) && !strlen($this->cr_payment->Value) && $this->cr_payment->Value !== false)
                    $this->cr_payment->SetText(0);
                if(!is_array($this->cr_stp->Value) && !strlen($this->cr_stp->Value) && $this->cr_stp->Value !== false)
                    $this->cr_stp->SetText(0);
                if(!is_array($this->db_interest_charge->Value) && !strlen($this->db_interest_charge->Value) && $this->db_interest_charge->Value !== false)
                    $this->db_interest_charge->SetText(0);
                if(!is_array($this->db_increasing_charge->Value) && !strlen($this->db_increasing_charge->Value) && $this->db_increasing_charge->Value !== false)
                    $this->db_increasing_charge->SetText(0);
                if(!is_array($this->total_penalty_amount->Value) && !strlen($this->total_penalty_amount->Value) && $this->total_penalty_amount->Value !== false)
                    $this->total_penalty_amount->SetText(0);
                if(!is_array($this->due_date->Value) && !strlen($this->due_date->Value) && $this->due_date->Value !== false)
                    $this->due_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-F2D2DDB3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_vat_setllement_id"] = CCGetFromGet("t_vat_setllement_id", NULL);
    }
//End Initialize Method

//Validate Method @23-25A489CA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->total_trans_amount->Validate() && $Validation);
        $Validation = ($this->total_vat_amount->Validate() && $Validation);
        $Validation = ($this->t_vat_setllement_id->Validate() && $Validation);
        $Validation = ($this->debt_vat_amt->Validate() && $Validation);
        $Validation = ($this->cr_adjustment->Validate() && $Validation);
        $Validation = ($this->cr_others->Validate() && $Validation);
        $Validation = ($this->cr_payment->Validate() && $Validation);
        $Validation = ($this->cr_stp->Validate() && $Validation);
        $Validation = ($this->db_interest_charge->Validate() && $Validation);
        $Validation = ($this->db_increasing_charge->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->total_penalty_amount->Validate() && $Validation);
        $Validation = ($this->due_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->total_trans_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_vat_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_setllement_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->debt_vat_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_adjustment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_others->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_payment->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cr_stp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->db_interest_charge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->db_increasing_charge->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_penalty_amount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->due_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-B60333BB
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->total_trans_amount->Errors->Count());
        $errors = ($errors || $this->total_vat_amount->Errors->Count());
        $errors = ($errors || $this->t_vat_setllement_id->Errors->Count());
        $errors = ($errors || $this->debt_vat_amt->Errors->Count());
        $errors = ($errors || $this->cr_adjustment->Errors->Count());
        $errors = ($errors || $this->cr_others->Errors->Count());
        $errors = ($errors || $this->cr_payment->Errors->Count());
        $errors = ($errors || $this->cr_stp->Errors->Count());
        $errors = ($errors || $this->db_interest_charge->Errors->Count());
        $errors = ($errors || $this->db_increasing_charge->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->total_penalty_amount->Errors->Count());
        $errors = ($errors || $this->due_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_due_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @23-ED598703
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

//Operation Method @23-525B7855
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_setllement_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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

//UpdateRow Method @23-1188F476
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->total_trans_amount->SetValue($this->total_trans_amount->GetValue(true));
        $this->DataSource->total_vat_amount->SetValue($this->total_vat_amount->GetValue(true));
        $this->DataSource->total_penalty_amount->SetValue($this->total_penalty_amount->GetValue(true));
        $this->DataSource->due_date->SetValue($this->due_date->GetValue(true));
        $this->DataSource->debt_vat_amt->SetValue($this->debt_vat_amt->GetValue(true));
        $this->DataSource->cr_adjustment->SetValue($this->cr_adjustment->GetValue(true));
        $this->DataSource->cr_payment->SetValue($this->cr_payment->GetValue(true));
        $this->DataSource->cr_others->SetValue($this->cr_others->GetValue(true));
        $this->DataSource->cr_stp->SetValue($this->cr_stp->GetValue(true));
        $this->DataSource->db_interest_charge->SetValue($this->db_interest_charge->GetValue(true));
        $this->DataSource->db_increasing_charge->SetValue($this->db_increasing_charge->GetValue(true));
        $this->DataSource->t_vat_setllement_id->SetValue($this->t_vat_setllement_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-7BF969AE
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-EC2BD7ED
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
                    $this->total_trans_amount->SetValue($this->DataSource->total_trans_amount->GetValue());
                    $this->total_vat_amount->SetValue($this->DataSource->total_vat_amount->GetValue());
                    $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                    $this->debt_vat_amt->SetValue($this->DataSource->debt_vat_amt->GetValue());
                    $this->cr_adjustment->SetValue($this->DataSource->cr_adjustment->GetValue());
                    $this->cr_others->SetValue($this->DataSource->cr_others->GetValue());
                    $this->cr_payment->SetValue($this->DataSource->cr_payment->GetValue());
                    $this->cr_stp->SetValue($this->DataSource->cr_stp->GetValue());
                    $this->db_interest_charge->SetValue($this->DataSource->db_interest_charge->GetValue());
                    $this->db_increasing_charge->SetValue($this->DataSource->db_increasing_charge->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->total_penalty_amount->SetValue($this->DataSource->total_penalty_amount->GetValue());
                    $this->due_date->SetValue($this->DataSource->due_date->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->total_trans_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_vat_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_setllement_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->debt_vat_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_adjustment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_others->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_payment->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cr_stp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->db_interest_charge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->db_increasing_charge->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_penalty_amount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->due_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_due_date->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->total_trans_amount->Show();
        $this->total_vat_amount->Show();
        $this->t_vat_setllement_id->Show();
        $this->debt_vat_amt->Show();
        $this->cr_adjustment->Show();
        $this->cr_others->Show();
        $this->cr_payment->Show();
        $this->cr_stp->Show();
        $this->db_interest_charge->Show();
        $this->db_increasing_charge->Show();
        $this->t_customer_order_id->Show();
        $this->Button_Cancel->Show();
        $this->total_penalty_amount->Show();
        $this->due_date->Show();
        $this->DatePicker_due_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_setllementForm Class @23-FCB6E20C

class clst_vat_setllementFormDataSource extends clsDBConnSIKP {  //t_vat_setllementFormDataSource Class @23-AF9958CC

//DataSource Variables @23-252F80D5
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $total_trans_amount;
    var $total_vat_amount;
    var $t_vat_setllement_id;
    var $debt_vat_amt;
    var $cr_adjustment;
    var $cr_others;
    var $cr_payment;
    var $cr_stp;
    var $db_interest_charge;
    var $db_increasing_charge;
    var $t_customer_order_id;
    var $total_penalty_amount;
    var $due_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-3D1273B5
    function clst_vat_setllementFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_setllementForm/Error";
        $this->Initialize();
        $this->total_trans_amount = new clsField("total_trans_amount", ccsFloat, "");
        
        $this->total_vat_amount = new clsField("total_vat_amount", ccsFloat, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->debt_vat_amt = new clsField("debt_vat_amt", ccsFloat, "");
        
        $this->cr_adjustment = new clsField("cr_adjustment", ccsFloat, "");
        
        $this->cr_others = new clsField("cr_others", ccsFloat, "");
        
        $this->cr_payment = new clsField("cr_payment", ccsFloat, "");
        
        $this->cr_stp = new clsField("cr_stp", ccsFloat, "");
        
        $this->db_interest_charge = new clsField("db_interest_charge", ccsFloat, "");
        
        $this->db_increasing_charge = new clsField("db_increasing_charge", ccsFloat, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->total_penalty_amount = new clsField("total_penalty_amount", ccsFloat, "");
        
        $this->due_date = new clsField("due_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-1736D257
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_setllement_id", ccsFloat, "", "", $this->Parameters["urlt_vat_setllement_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_setllement_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-ACB07381
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_setllement {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-4FDAD9B9
    function SetValues()
    {
        $this->total_trans_amount->SetDBValue(trim($this->f("total_trans_amount")));
        $this->total_vat_amount->SetDBValue(trim($this->f("total_vat_amount")));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->debt_vat_amt->SetDBValue(trim($this->f("debt_vat_amt")));
        $this->cr_adjustment->SetDBValue(trim($this->f("cr_adjustment")));
        $this->cr_others->SetDBValue(trim($this->f("cr_others")));
        $this->cr_payment->SetDBValue(trim($this->f("cr_payment")));
        $this->cr_stp->SetDBValue(trim($this->f("cr_stp")));
        $this->db_interest_charge->SetDBValue(trim($this->f("db_interest_charge")));
        $this->db_increasing_charge->SetDBValue(trim($this->f("db_increasing_charge")));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->total_penalty_amount->SetDBValue(trim($this->f("total_penalty_amount")));
        $this->due_date->SetDBValue($this->f("due_date"));
    }
//End SetValues Method

//Update Method @23-86637418
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["o_result_msg"] = new clsSQLParameter("urlo_result_msg", ccsText, "", "", CCGetFromGet("o_result_msg", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_finance_period_id"] = new clsSQLParameter("urli_finance_period_id", ccsFloat, "", "", CCGetFromGet("i_finance_period_id", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_start_period"] = new clsSQLParameter("urli_start_period", ccsText, "", "", CCGetFromGet("i_start_period", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_end_period"] = new clsSQLParameter("urli_end_period", ccsText, "", "", CCGetFromGet("i_end_period", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_total_trans_amount"] = new clsSQLParameter("ctrltotal_trans_amount", ccsFloat, "", "", $this->total_trans_amount->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_total_vat_amount"] = new clsSQLParameter("ctrltotal_vat_amount", ccsFloat, "", "", $this->total_vat_amount->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_total_penalty_amount"] = new clsSQLParameter("ctrltotal_penalty_amount", ccsFloat, "", "", $this->total_penalty_amount->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_due_date"] = new clsSQLParameter("ctrldue_date", ccsText, "", "", $this->due_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_debt_vat_amt"] = new clsSQLParameter("ctrldebt_vat_amt", ccsFloat, "", "", $this->debt_vat_amt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_adjustment"] = new clsSQLParameter("ctrlcr_adjustment", ccsFloat, "", "", $this->cr_adjustment->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_payment"] = new clsSQLParameter("ctrlcr_payment", ccsFloat, "", "", $this->cr_payment->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_others"] = new clsSQLParameter("ctrlcr_others", ccsFloat, "", "", $this->cr_others->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_cr_stp"] = new clsSQLParameter("ctrlcr_stp", ccsFloat, "", "", $this->cr_stp->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_db_interest_charge"] = new clsSQLParameter("ctrldb_interest_charge", ccsFloat, "", "", $this->db_interest_charge->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_db_increasing_charge"] = new clsSQLParameter("ctrldb_increasing_charge", ccsFloat, "", "", $this->db_increasing_charge->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_vat_setllement_id"] = new clsSQLParameter("ctrlt_vat_setllement_id", ccsFloat, "", "", $this->t_vat_setllement_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_user"] = new clsSQLParameter("exprKey365", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["i_status"] = new clsSQLParameter("exprKey366", ccsText, "", "", '2', "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["o_result_msg"]->GetValue()) and !strlen($this->cp["o_result_msg"]->GetText()) and !is_bool($this->cp["o_result_msg"]->GetValue())) 
            $this->cp["o_result_msg"]->SetText(CCGetFromGet("o_result_msg", NULL));
        if (!is_null($this->cp["i_finance_period_id"]->GetValue()) and !strlen($this->cp["i_finance_period_id"]->GetText()) and !is_bool($this->cp["i_finance_period_id"]->GetValue())) 
            $this->cp["i_finance_period_id"]->SetText(CCGetFromGet("i_finance_period_id", NULL));
        if (!is_null($this->cp["i_start_period"]->GetValue()) and !strlen($this->cp["i_start_period"]->GetText()) and !is_bool($this->cp["i_start_period"]->GetValue())) 
            $this->cp["i_start_period"]->SetText(CCGetFromGet("i_start_period", NULL));
        if (!is_null($this->cp["i_end_period"]->GetValue()) and !strlen($this->cp["i_end_period"]->GetText()) and !is_bool($this->cp["i_end_period"]->GetValue())) 
            $this->cp["i_end_period"]->SetText(CCGetFromGet("i_end_period", NULL));
        if (!is_null($this->cp["i_total_trans_amount"]->GetValue()) and !strlen($this->cp["i_total_trans_amount"]->GetText()) and !is_bool($this->cp["i_total_trans_amount"]->GetValue())) 
            $this->cp["i_total_trans_amount"]->SetValue($this->total_trans_amount->GetValue(true));
        if (!is_null($this->cp["i_total_vat_amount"]->GetValue()) and !strlen($this->cp["i_total_vat_amount"]->GetText()) and !is_bool($this->cp["i_total_vat_amount"]->GetValue())) 
            $this->cp["i_total_vat_amount"]->SetValue($this->total_vat_amount->GetValue(true));
        if (!is_null($this->cp["i_total_penalty_amount"]->GetValue()) and !strlen($this->cp["i_total_penalty_amount"]->GetText()) and !is_bool($this->cp["i_total_penalty_amount"]->GetValue())) 
            $this->cp["i_total_penalty_amount"]->SetValue($this->total_penalty_amount->GetValue(true));
        if (!is_null($this->cp["i_due_date"]->GetValue()) and !strlen($this->cp["i_due_date"]->GetText()) and !is_bool($this->cp["i_due_date"]->GetValue())) 
            $this->cp["i_due_date"]->SetValue($this->due_date->GetValue(true));
        if (!is_null($this->cp["i_debt_vat_amt"]->GetValue()) and !strlen($this->cp["i_debt_vat_amt"]->GetText()) and !is_bool($this->cp["i_debt_vat_amt"]->GetValue())) 
            $this->cp["i_debt_vat_amt"]->SetValue($this->debt_vat_amt->GetValue(true));
        if (!is_null($this->cp["i_cr_adjustment"]->GetValue()) and !strlen($this->cp["i_cr_adjustment"]->GetText()) and !is_bool($this->cp["i_cr_adjustment"]->GetValue())) 
            $this->cp["i_cr_adjustment"]->SetValue($this->cr_adjustment->GetValue(true));
        if (!is_null($this->cp["i_cr_payment"]->GetValue()) and !strlen($this->cp["i_cr_payment"]->GetText()) and !is_bool($this->cp["i_cr_payment"]->GetValue())) 
            $this->cp["i_cr_payment"]->SetValue($this->cr_payment->GetValue(true));
        if (!is_null($this->cp["i_cr_others"]->GetValue()) and !strlen($this->cp["i_cr_others"]->GetText()) and !is_bool($this->cp["i_cr_others"]->GetValue())) 
            $this->cp["i_cr_others"]->SetValue($this->cr_others->GetValue(true));
        if (!is_null($this->cp["i_cr_stp"]->GetValue()) and !strlen($this->cp["i_cr_stp"]->GetText()) and !is_bool($this->cp["i_cr_stp"]->GetValue())) 
            $this->cp["i_cr_stp"]->SetValue($this->cr_stp->GetValue(true));
        if (!is_null($this->cp["i_db_interest_charge"]->GetValue()) and !strlen($this->cp["i_db_interest_charge"]->GetText()) and !is_bool($this->cp["i_db_interest_charge"]->GetValue())) 
            $this->cp["i_db_interest_charge"]->SetValue($this->db_interest_charge->GetValue(true));
        if (!is_null($this->cp["i_db_increasing_charge"]->GetValue()) and !strlen($this->cp["i_db_increasing_charge"]->GetText()) and !is_bool($this->cp["i_db_increasing_charge"]->GetValue())) 
            $this->cp["i_db_increasing_charge"]->SetValue($this->db_increasing_charge->GetValue(true));
        if (!is_null($this->cp["i_vat_setllement_id"]->GetValue()) and !strlen($this->cp["i_vat_setllement_id"]->GetText()) and !is_bool($this->cp["i_vat_setllement_id"]->GetValue())) 
            $this->cp["i_vat_setllement_id"]->SetValue($this->t_vat_setllement_id->GetValue(true));
        if (!is_null($this->cp["i_user"]->GetValue()) and !strlen($this->cp["i_user"]->GetText()) and !is_bool($this->cp["i_user"]->GetValue())) 
            $this->cp["i_user"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["i_status"]->GetValue()) and !strlen($this->cp["i_status"]->GetText()) and !is_bool($this->cp["i_status"]->GetValue())) 
            $this->cp["i_status"]->SetValue('2');
        $this->SQL = "SELECT f_crud_setllement_update (" . $this->ToSQL($this->cp["i_finance_period_id"]->GetDBValue(), $this->cp["i_finance_period_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_start_period"]->GetDBValue(), $this->cp["i_start_period"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_end_period"]->GetDBValue(), $this->cp["i_end_period"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_total_trans_amount"]->GetDBValue(), $this->cp["i_total_trans_amount"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_total_vat_amount"]->GetDBValue(), $this->cp["i_total_vat_amount"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_total_penalty_amount"]->GetDBValue(), $this->cp["i_total_penalty_amount"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_due_date"]->GetDBValue(), $this->cp["i_due_date"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_debt_vat_amt"]->GetDBValue(), $this->cp["i_debt_vat_amt"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_adjustment"]->GetDBValue(), $this->cp["i_cr_adjustment"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_payment"]->GetDBValue(), $this->cp["i_cr_payment"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_others"]->GetDBValue(), $this->cp["i_cr_others"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_cr_stp"]->GetDBValue(), $this->cp["i_cr_stp"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_db_interest_charge"]->GetDBValue(), $this->cp["i_db_interest_charge"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_db_increasing_charge"]->GetDBValue(), $this->cp["i_db_increasing_charge"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_vat_setllement_id"]->GetDBValue(), $this->cp["i_vat_setllement_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_user"]->GetDBValue(), $this->cp["i_user"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_status"]->GetDBValue(), $this->cp["i_status"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-1F6E5C2C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["UserName"] = new clsSQLParameter("expr343", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue(true))) 
            $this->cp["t_customer_order_id"]->SetText(0);
        if (!is_null($this->cp["UserName"]->GetValue()) and !strlen($this->cp["UserName"]->GetText()) and !is_bool($this->cp["UserName"]->GetValue())) 
            $this->cp["UserName"]->SetValue(CCGetUserLogin());
        $this->SQL = "select o_result_code, o_result_msg from f_first_submit_engine(501," . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ",'" . $this->SQLValue($this->cp["UserName"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_setllementFormDataSource Class @23-FCB6E20C

//Initialize Page @1-0B28405D
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
$TemplateFileName = "t_vat_setllement_update.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C9D3A350
include_once("./t_vat_setllement_update_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1DDE5A19
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_setllementForm = & new clsRecordt_vat_setllementForm("", $MainPage);
$MainPage->t_vat_setllementForm = & $t_vat_setllementForm;
$t_vat_setllementForm->Initialize();

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

//Execute Components @1-066D187A
$t_vat_setllementForm->Operation();
//End Execute Components

//Go to destination page @1-41353ACE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_setllementForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-5746EF7A
$t_vat_setllementForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-825C45A1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_setllementForm);
unset($Tpl);
//End Unload Page


?>
