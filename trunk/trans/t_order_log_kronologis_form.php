<?php
//Include Common Files @1-E8471515
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_order_log_kronologis_form.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_order_log_kronologisForm { //t_order_log_kronologisForm Class @94-ACE7DE1A

//Variables @94-D6FF3E86

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

//Class_Initialize Event @94-30B1817C
    function clsRecordt_order_log_kronologisForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_order_log_kronologisForm/Error";
        $this->DataSource = new clst_order_log_kronologisFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_order_log_kronologisForm";
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
            $this->Button_Cancel = & new clsButton("Button_Cancel", $Method, $this);
            $this->description = & new clsControl(ccsTextArea, "description", "Keterangan", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->description->Required = true;
            $this->create_by = & new clsControl(ccsTextBox, "create_by", "Created By", ccsText, "", CCGetRequestParam("create_by", $Method, NULL), $this);
            $this->update_by = & new clsControl(ccsTextBox, "update_by", "Updated By", ccsText, "", CCGetRequestParam("update_by", $Method, NULL), $this);
            $this->create_date = & new clsControl(ccsTextBox, "create_date", "Creation Date", ccsText, "", CCGetRequestParam("create_date", $Method, NULL), $this);
            $this->update_date = & new clsControl(ccsTextBox, "update_date", "Updated Date", ccsText, "", CCGetRequestParam("update_date", $Method, NULL), $this);
            $this->counter_no = & new clsControl(ccsHidden, "counter_no", "counter_no", ccsText, "", CCGetRequestParam("counter_no", $Method, NULL), $this);
            $this->TAKEN_CTL = & new clsControl(ccsHidden, "TAKEN_CTL", "TAKEN_CTL", ccsText, "", CCGetRequestParam("TAKEN_CTL", $Method, NULL), $this);
            $this->IS_TAKEN = & new clsControl(ccsHidden, "IS_TAKEN", "IS_TAKEN", ccsText, "", CCGetRequestParam("IS_TAKEN", $Method, NULL), $this);
            $this->activity = & new clsControl(ccsTextBox, "activity", "Aktifitas", ccsText, "", CCGetRequestParam("activity", $Method, NULL), $this);
            $this->activity->Required = true;
            $this->CURR_DOC_ID = & new clsControl(ccsHidden, "CURR_DOC_ID", "CURR_DOC_ID", ccsText, "", CCGetRequestParam("CURR_DOC_ID", $Method, NULL), $this);
            $this->log_date = & new clsControl(ccsTextBox, "log_date", "Tanggal", ccsText, "", CCGetRequestParam("log_date", $Method, NULL), $this);
            $this->CURR_DOC_TYPE_ID = & new clsControl(ccsHidden, "CURR_DOC_TYPE_ID", "CURR_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("CURR_DOC_TYPE_ID", $Method, NULL), $this);
            $this->CURR_PROC_ID = & new clsControl(ccsHidden, "CURR_PROC_ID", "CURR_PROC_ID", ccsText, "", CCGetRequestParam("CURR_PROC_ID", $Method, NULL), $this);
            $this->CURR_CTL_ID = & new clsControl(ccsHidden, "CURR_CTL_ID", "CURR_CTL_ID", ccsText, "", CCGetRequestParam("CURR_CTL_ID", $Method, NULL), $this);
            $this->USER_ID_DOC = & new clsControl(ccsHidden, "USER_ID_DOC", "USER_ID_DOC", ccsText, "", CCGetRequestParam("USER_ID_DOC", $Method, NULL), $this);
            $this->USER_ID_DONOR = & new clsControl(ccsHidden, "USER_ID_DONOR", "USER_ID_DONOR", ccsText, "", CCGetRequestParam("USER_ID_DONOR", $Method, NULL), $this);
            $this->USER_ID_LOGIN = & new clsControl(ccsHidden, "USER_ID_LOGIN", "USER_ID_LOGIN", ccsText, "", CCGetRequestParam("USER_ID_LOGIN", $Method, NULL), $this);
            $this->USER_ID_TAKEN = & new clsControl(ccsHidden, "USER_ID_TAKEN", "USER_ID_TAKEN", ccsText, "", CCGetRequestParam("USER_ID_TAKEN", $Method, NULL), $this);
            $this->IS_CREATE_DOC = & new clsControl(ccsHidden, "IS_CREATE_DOC", "IS_CREATE_DOC", ccsText, "", CCGetRequestParam("IS_CREATE_DOC", $Method, NULL), $this);
            $this->IS_MANUAL = & new clsControl(ccsHidden, "IS_MANUAL", "IS_MANUAL", ccsText, "", CCGetRequestParam("IS_MANUAL", $Method, NULL), $this);
            $this->CURR_PROC_STATUS = & new clsControl(ccsHidden, "CURR_PROC_STATUS", "CURR_PROC_STATUS", ccsText, "", CCGetRequestParam("CURR_PROC_STATUS", $Method, NULL), $this);
            $this->CURR_DOC_STATUS = & new clsControl(ccsHidden, "CURR_DOC_STATUS", "CURR_DOC_STATUS", ccsText, "", CCGetRequestParam("CURR_DOC_STATUS", $Method, NULL), $this);
            $this->PREV_DOC_ID = & new clsControl(ccsHidden, "PREV_DOC_ID", "PREV_DOC_ID", ccsText, "", CCGetRequestParam("PREV_DOC_ID", $Method, NULL), $this);
            $this->PREV_DOC_TYPE_ID = & new clsControl(ccsHidden, "PREV_DOC_TYPE_ID", "PREV_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("PREV_DOC_TYPE_ID", $Method, NULL), $this);
            $this->PREV_PROC_ID = & new clsControl(ccsHidden, "PREV_PROC_ID", "PREV_PROC_ID", ccsText, "", CCGetRequestParam("PREV_PROC_ID", $Method, NULL), $this);
            $this->PREV_CTL_ID = & new clsControl(ccsHidden, "PREV_CTL_ID", "PREV_CTL_ID", ccsText, "", CCGetRequestParam("PREV_CTL_ID", $Method, NULL), $this);
            $this->SLOT_1 = & new clsControl(ccsHidden, "SLOT_1", "SLOT_1", ccsText, "", CCGetRequestParam("SLOT_1", $Method, NULL), $this);
            $this->SLOT_2 = & new clsControl(ccsHidden, "SLOT_2", "SLOT_2", ccsText, "", CCGetRequestParam("SLOT_2", $Method, NULL), $this);
            $this->SLOT_3 = & new clsControl(ccsHidden, "SLOT_3", "SLOT_3", ccsText, "", CCGetRequestParam("SLOT_3", $Method, NULL), $this);
            $this->SLOT_4 = & new clsControl(ccsHidden, "SLOT_4", "SLOT_4", ccsText, "", CCGetRequestParam("SLOT_4", $Method, NULL), $this);
            $this->SLOT_5 = & new clsControl(ccsHidden, "SLOT_5", "SLOT_5", ccsText, "", CCGetRequestParam("SLOT_5", $Method, NULL), $this);
            $this->MESSAGE = & new clsControl(ccsHidden, "MESSAGE", "MESSAGE", ccsText, "", CCGetRequestParam("MESSAGE", $Method, NULL), $this);
            $this->input_type = & new clsControl(ccsHidden, "input_type", "input_type", ccsText, "", CCGetRequestParam("input_type", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->create_by->Value) && !strlen($this->create_by->Value) && $this->create_by->Value !== false)
                    $this->create_by->SetText(CCGetUserLogin());
                if(!is_array($this->update_by->Value) && !strlen($this->update_by->Value) && $this->update_by->Value !== false)
                    $this->update_by->SetText(CCGetUserLogin());
                if(!is_array($this->create_date->Value) && !strlen($this->create_date->Value) && $this->create_date->Value !== false)
                    $this->create_date->SetText(date("d-M-Y"));
                if(!is_array($this->update_date->Value) && !strlen($this->update_date->Value) && $this->update_date->Value !== false)
                    $this->update_date->SetText(date("d-M-Y"));
                if(!is_array($this->log_date->Value) && !strlen($this->log_date->Value) && $this->log_date->Value !== false)
                    $this->log_date->SetText(date("d-M-Y h:i:s"));
                if(!is_array($this->input_type->Value) && !strlen($this->input_type->Value) && $this->input_type->Value !== false)
                    $this->input_type->SetText("M");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-E8EEA720
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlCURR_DOC_ID"] = CCGetFromGet("CURR_DOC_ID", NULL);
        $this->DataSource->Parameters["urlcounter_no"] = CCGetFromGet("counter_no", NULL);
    }
//End Initialize Method

//Validate Method @94-01242D20
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->create_by->Validate() && $Validation);
        $Validation = ($this->update_by->Validate() && $Validation);
        $Validation = ($this->create_date->Validate() && $Validation);
        $Validation = ($this->update_date->Validate() && $Validation);
        $Validation = ($this->counter_no->Validate() && $Validation);
        $Validation = ($this->TAKEN_CTL->Validate() && $Validation);
        $Validation = ($this->IS_TAKEN->Validate() && $Validation);
        $Validation = ($this->activity->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_ID->Validate() && $Validation);
        $Validation = ($this->log_date->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->CURR_PROC_ID->Validate() && $Validation);
        $Validation = ($this->CURR_CTL_ID->Validate() && $Validation);
        $Validation = ($this->USER_ID_DOC->Validate() && $Validation);
        $Validation = ($this->USER_ID_DONOR->Validate() && $Validation);
        $Validation = ($this->USER_ID_LOGIN->Validate() && $Validation);
        $Validation = ($this->USER_ID_TAKEN->Validate() && $Validation);
        $Validation = ($this->IS_CREATE_DOC->Validate() && $Validation);
        $Validation = ($this->IS_MANUAL->Validate() && $Validation);
        $Validation = ($this->CURR_PROC_STATUS->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_STATUS->Validate() && $Validation);
        $Validation = ($this->PREV_DOC_ID->Validate() && $Validation);
        $Validation = ($this->PREV_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->PREV_PROC_ID->Validate() && $Validation);
        $Validation = ($this->PREV_CTL_ID->Validate() && $Validation);
        $Validation = ($this->SLOT_1->Validate() && $Validation);
        $Validation = ($this->SLOT_2->Validate() && $Validation);
        $Validation = ($this->SLOT_3->Validate() && $Validation);
        $Validation = ($this->SLOT_4->Validate() && $Validation);
        $Validation = ($this->SLOT_5->Validate() && $Validation);
        $Validation = ($this->MESSAGE->Validate() && $Validation);
        $Validation = ($this->input_type->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->create_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->create_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->counter_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TAKEN_CTL->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_TAKEN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->activity->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->log_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_CTL_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_DOC->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_DONOR->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_LOGIN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->USER_ID_TAKEN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_CREATE_DOC->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_MANUAL->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_PROC_STATUS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_STATUS->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_DOC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PREV_CTL_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SLOT_5->Errors->Count() == 0);
        $Validation =  $Validation && ($this->MESSAGE->Errors->Count() == 0);
        $Validation =  $Validation && ($this->input_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-665161DF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->create_by->Errors->Count());
        $errors = ($errors || $this->update_by->Errors->Count());
        $errors = ($errors || $this->create_date->Errors->Count());
        $errors = ($errors || $this->update_date->Errors->Count());
        $errors = ($errors || $this->counter_no->Errors->Count());
        $errors = ($errors || $this->TAKEN_CTL->Errors->Count());
        $errors = ($errors || $this->IS_TAKEN->Errors->Count());
        $errors = ($errors || $this->activity->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_ID->Errors->Count());
        $errors = ($errors || $this->log_date->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->CURR_PROC_ID->Errors->Count());
        $errors = ($errors || $this->CURR_CTL_ID->Errors->Count());
        $errors = ($errors || $this->USER_ID_DOC->Errors->Count());
        $errors = ($errors || $this->USER_ID_DONOR->Errors->Count());
        $errors = ($errors || $this->USER_ID_LOGIN->Errors->Count());
        $errors = ($errors || $this->USER_ID_TAKEN->Errors->Count());
        $errors = ($errors || $this->IS_CREATE_DOC->Errors->Count());
        $errors = ($errors || $this->IS_MANUAL->Errors->Count());
        $errors = ($errors || $this->CURR_PROC_STATUS->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_STATUS->Errors->Count());
        $errors = ($errors || $this->PREV_DOC_ID->Errors->Count());
        $errors = ($errors || $this->PREV_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->PREV_PROC_ID->Errors->Count());
        $errors = ($errors || $this->PREV_CTL_ID->Errors->Count());
        $errors = ($errors || $this->SLOT_1->Errors->Count());
        $errors = ($errors || $this->SLOT_2->Errors->Count());
        $errors = ($errors || $this->SLOT_3->Errors->Count());
        $errors = ($errors || $this->SLOT_4->Errors->Count());
        $errors = ($errors || $this->SLOT_5->Errors->Count());
        $errors = ($errors || $this->MESSAGE->Errors->Count());
        $errors = ($errors || $this->input_type->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @94-ED598703
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

//Operation Method @94-6D512D76
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
            $this->PressedButton = "Button_Insert";
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_reg_dtl_hotel_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
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
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
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

//InsertRow Method @94-0E42A963
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->activity->SetValue($this->activity->GetValue(true));
        $this->DataSource->CURR_DOC_ID->SetValue($this->CURR_DOC_ID->GetValue(true));
        $this->DataSource->USER_ID_LOGIN->SetValue($this->USER_ID_LOGIN->GetValue(true));
        $this->DataSource->CURR_PROC_ID->SetValue($this->CURR_PROC_ID->GetValue(true));
        $this->DataSource->input_type->SetValue($this->input_type->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @94-734C7F45
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
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->create_by->SetValue($this->DataSource->create_by->GetValue());
                    $this->update_by->SetValue($this->DataSource->update_by->GetValue());
                    $this->create_date->SetValue($this->DataSource->create_date->GetValue());
                    $this->update_date->SetValue($this->DataSource->update_date->GetValue());
                    $this->counter_no->SetValue($this->DataSource->counter_no->GetValue());
                    $this->activity->SetValue($this->DataSource->activity->GetValue());
                    $this->log_date->SetValue($this->DataSource->log_date->GetValue());
                    $this->input_type->SetValue($this->DataSource->input_type->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->create_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->create_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->counter_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TAKEN_CTL->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_TAKEN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->activity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_CTL_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_DOC->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_DONOR->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_LOGIN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->USER_ID_TAKEN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_CREATE_DOC->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_MANUAL->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_PROC_STATUS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_STATUS->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_DOC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PREV_CTL_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SLOT_5->Errors->ToString());
            $Error = ComposeStrings($Error, $this->MESSAGE->Errors->ToString());
            $Error = ComposeStrings($Error, $this->input_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_registration_id->Errors->ToString());
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
        $this->Button_Cancel->Show();
        $this->description->Show();
        $this->create_by->Show();
        $this->update_by->Show();
        $this->create_date->Show();
        $this->update_date->Show();
        $this->counter_no->Show();
        $this->TAKEN_CTL->Show();
        $this->IS_TAKEN->Show();
        $this->activity->Show();
        $this->CURR_DOC_ID->Show();
        $this->log_date->Show();
        $this->CURR_DOC_TYPE_ID->Show();
        $this->CURR_PROC_ID->Show();
        $this->CURR_CTL_ID->Show();
        $this->USER_ID_DOC->Show();
        $this->USER_ID_DONOR->Show();
        $this->USER_ID_LOGIN->Show();
        $this->USER_ID_TAKEN->Show();
        $this->IS_CREATE_DOC->Show();
        $this->IS_MANUAL->Show();
        $this->CURR_PROC_STATUS->Show();
        $this->CURR_DOC_STATUS->Show();
        $this->PREV_DOC_ID->Show();
        $this->PREV_DOC_TYPE_ID->Show();
        $this->PREV_PROC_ID->Show();
        $this->PREV_CTL_ID->Show();
        $this->SLOT_1->Show();
        $this->SLOT_2->Show();
        $this->SLOT_3->Show();
        $this->SLOT_4->Show();
        $this->SLOT_5->Show();
        $this->MESSAGE->Show();
        $this->input_type->Show();
        $this->t_customer_order_id->Show();
        $this->p_rqst_type_id->Show();
        $this->t_vat_registration_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_order_log_kronologisForm Class @94-FCB6E20C

class clst_order_log_kronologisFormDataSource extends clsDBConnSIKP {  //t_order_log_kronologisFormDataSource Class @94-1DFAC2DD

//DataSource Variables @94-27542C6F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $description;
    var $create_by;
    var $update_by;
    var $create_date;
    var $update_date;
    var $counter_no;
    var $TAKEN_CTL;
    var $IS_TAKEN;
    var $activity;
    var $CURR_DOC_ID;
    var $log_date;
    var $CURR_DOC_TYPE_ID;
    var $CURR_PROC_ID;
    var $CURR_CTL_ID;
    var $USER_ID_DOC;
    var $USER_ID_DONOR;
    var $USER_ID_LOGIN;
    var $USER_ID_TAKEN;
    var $IS_CREATE_DOC;
    var $IS_MANUAL;
    var $CURR_PROC_STATUS;
    var $CURR_DOC_STATUS;
    var $PREV_DOC_ID;
    var $PREV_DOC_TYPE_ID;
    var $PREV_PROC_ID;
    var $PREV_CTL_ID;
    var $SLOT_1;
    var $SLOT_2;
    var $SLOT_3;
    var $SLOT_4;
    var $SLOT_5;
    var $MESSAGE;
    var $input_type;
    var $t_customer_order_id;
    var $p_rqst_type_id;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-E88F0118
    function clst_order_log_kronologisFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_order_log_kronologisForm/Error";
        $this->Initialize();
        $this->description = new clsField("description", ccsText, "");
        
        $this->create_by = new clsField("create_by", ccsText, "");
        
        $this->update_by = new clsField("update_by", ccsText, "");
        
        $this->create_date = new clsField("create_date", ccsText, "");
        
        $this->update_date = new clsField("update_date", ccsText, "");
        
        $this->counter_no = new clsField("counter_no", ccsText, "");
        
        $this->TAKEN_CTL = new clsField("TAKEN_CTL", ccsText, "");
        
        $this->IS_TAKEN = new clsField("IS_TAKEN", ccsText, "");
        
        $this->activity = new clsField("activity", ccsText, "");
        
        $this->CURR_DOC_ID = new clsField("CURR_DOC_ID", ccsText, "");
        
        $this->log_date = new clsField("log_date", ccsText, "");
        
        $this->CURR_DOC_TYPE_ID = new clsField("CURR_DOC_TYPE_ID", ccsText, "");
        
        $this->CURR_PROC_ID = new clsField("CURR_PROC_ID", ccsText, "");
        
        $this->CURR_CTL_ID = new clsField("CURR_CTL_ID", ccsText, "");
        
        $this->USER_ID_DOC = new clsField("USER_ID_DOC", ccsText, "");
        
        $this->USER_ID_DONOR = new clsField("USER_ID_DONOR", ccsText, "");
        
        $this->USER_ID_LOGIN = new clsField("USER_ID_LOGIN", ccsText, "");
        
        $this->USER_ID_TAKEN = new clsField("USER_ID_TAKEN", ccsText, "");
        
        $this->IS_CREATE_DOC = new clsField("IS_CREATE_DOC", ccsText, "");
        
        $this->IS_MANUAL = new clsField("IS_MANUAL", ccsText, "");
        
        $this->CURR_PROC_STATUS = new clsField("CURR_PROC_STATUS", ccsText, "");
        
        $this->CURR_DOC_STATUS = new clsField("CURR_DOC_STATUS", ccsText, "");
        
        $this->PREV_DOC_ID = new clsField("PREV_DOC_ID", ccsText, "");
        
        $this->PREV_DOC_TYPE_ID = new clsField("PREV_DOC_TYPE_ID", ccsText, "");
        
        $this->PREV_PROC_ID = new clsField("PREV_PROC_ID", ccsText, "");
        
        $this->PREV_CTL_ID = new clsField("PREV_CTL_ID", ccsText, "");
        
        $this->SLOT_1 = new clsField("SLOT_1", ccsText, "");
        
        $this->SLOT_2 = new clsField("SLOT_2", ccsText, "");
        
        $this->SLOT_3 = new clsField("SLOT_3", ccsText, "");
        
        $this->SLOT_4 = new clsField("SLOT_4", ccsText, "");
        
        $this->SLOT_5 = new clsField("SLOT_5", ccsText, "");
        
        $this->MESSAGE = new clsField("MESSAGE", ccsText, "");
        
        $this->input_type = new clsField("input_type", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-40E58AEC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlCURR_DOC_ID", ccsFloat, "", "", $this->Parameters["urlCURR_DOC_ID"], "", false);
        $this->wp->AddParameter("2", "urlcounter_no", ccsFloat, "", "", $this->Parameters["urlcounter_no"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_customer_order_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "counter_no", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @94-008F5E92
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM t_order_log_kronologis {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-269B92C0
    function SetValues()
    {
        $this->description->SetDBValue($this->f("description"));
        $this->create_by->SetDBValue($this->f("create_by"));
        $this->update_by->SetDBValue($this->f("update_by"));
        $this->create_date->SetDBValue($this->f("create_date"));
        $this->update_date->SetDBValue($this->f("update_date"));
        $this->counter_no->SetDBValue($this->f("counter_no"));
        $this->activity->SetDBValue($this->f("activity"));
        $this->log_date->SetDBValue($this->f("log_date"));
        $this->input_type->SetDBValue($this->f("input_type"));
    }
//End SetValues Method

//Insert Method @94-857E4180
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["activity"] = new clsSQLParameter("ctrlactivity", ccsText, "", "", $this->activity->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["create_by"] = new clsSQLParameter("expr789", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("expr790", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["CURR_DOC_ID"] = new clsSQLParameter("ctrlCURR_DOC_ID", ccsFloat, "", "", $this->CURR_DOC_ID->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["USER_ID_LOGIN"] = new clsSQLParameter("ctrlUSER_ID_LOGIN", ccsFloat, "", "", $this->USER_ID_LOGIN->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["CURR_PROC_ID"] = new clsSQLParameter("ctrlCURR_PROC_ID", ccsFloat, "", "", $this->CURR_PROC_ID->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["input_type"] = new clsSQLParameter("ctrlinput_type", ccsText, "", "", $this->input_type->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["activity"]->GetValue()) and !strlen($this->cp["activity"]->GetText()) and !is_bool($this->cp["activity"]->GetValue())) 
            $this->cp["activity"]->SetValue($this->activity->GetValue(true));
        if (!is_null($this->cp["create_by"]->GetValue()) and !strlen($this->cp["create_by"]->GetText()) and !is_bool($this->cp["create_by"]->GetValue())) 
            $this->cp["create_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["CURR_DOC_ID"]->GetValue()) and !strlen($this->cp["CURR_DOC_ID"]->GetText()) and !is_bool($this->cp["CURR_DOC_ID"]->GetValue())) 
            $this->cp["CURR_DOC_ID"]->SetValue($this->CURR_DOC_ID->GetValue(true));
        if (!strlen($this->cp["CURR_DOC_ID"]->GetText()) and !is_bool($this->cp["CURR_DOC_ID"]->GetValue(true))) 
            $this->cp["CURR_DOC_ID"]->SetText(0);
        if (!is_null($this->cp["USER_ID_LOGIN"]->GetValue()) and !strlen($this->cp["USER_ID_LOGIN"]->GetText()) and !is_bool($this->cp["USER_ID_LOGIN"]->GetValue())) 
            $this->cp["USER_ID_LOGIN"]->SetValue($this->USER_ID_LOGIN->GetValue(true));
        if (!strlen($this->cp["USER_ID_LOGIN"]->GetText()) and !is_bool($this->cp["USER_ID_LOGIN"]->GetValue(true))) 
            $this->cp["USER_ID_LOGIN"]->SetText(0);
        if (!is_null($this->cp["CURR_PROC_ID"]->GetValue()) and !strlen($this->cp["CURR_PROC_ID"]->GetText()) and !is_bool($this->cp["CURR_PROC_ID"]->GetValue())) 
            $this->cp["CURR_PROC_ID"]->SetValue($this->CURR_PROC_ID->GetValue(true));
        if (!strlen($this->cp["CURR_PROC_ID"]->GetText()) and !is_bool($this->cp["CURR_PROC_ID"]->GetValue(true))) 
            $this->cp["CURR_PROC_ID"]->SetText(0);
        if (!is_null($this->cp["input_type"]->GetValue()) and !strlen($this->cp["input_type"]->GetText()) and !is_bool($this->cp["input_type"]->GetValue())) 
            $this->cp["input_type"]->SetValue($this->input_type->GetValue(true));
        $this->SQL = "INSERT INTO t_order_log_kronologis(\n" .
        " description, \n" .
        " create_date, \n" .
        " update_date, \n" .
        " activity, \n" .
        " create_by, \n" .
        " update_by, \n" .
        " counter_no, \n" .
        " t_customer_order_id, \n" .
        " p_app_user_id, \n" .
        " employee_no,\n" .
        " log_date,\n" .
        " p_procedure_id,\n" .
        " input_type) \n" .
        "VALUES(\n" .
        " '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        " SYSDATE, \n" .
        " SYSDATE, \n" .
        " '" . $this->SQLValue($this->cp["activity"]->GetDBValue(), ccsText) . "', \n" .
        " '" . $this->SQLValue($this->cp["create_by"]->GetDBValue(), ccsText) . "', \n" .
        " '" . $this->SQLValue($this->cp["update_by"]->GetDBValue(), ccsText) . "', \n" .
        " (SELECT NVL(MAX(counter_no),0)+1 FROM t_order_log_kronologis WHERE t_customer_order_id=" . $this->SQLValue($this->cp["CURR_DOC_ID"]->GetDBValue(), ccsFloat) . "), \n" .
        " " . $this->SQLValue($this->cp["CURR_DOC_ID"]->GetDBValue(), ccsFloat) . ", \n" .
        " " . $this->SQLValue($this->cp["USER_ID_LOGIN"]->GetDBValue(), ccsFloat) . ", \n" .
        " null,\n" .
        " SYSDATE,\n" .
        " " . $this->SQLValue($this->cp["CURR_PROC_ID"]->GetDBValue(), ccsFloat) . ",\n" .
        " '" . $this->SQLValue($this->cp["input_type"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End t_order_log_kronologisFormDataSource Class @94-FCB6E20C

//Initialize Page @1-4D952380
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
$TemplateFileName = "t_order_log_kronologis_form.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-770683A3
include_once("./t_order_log_kronologis_form_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F3F60688
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_order_log_kronologisForm = & new clsRecordt_order_log_kronologisForm("", $MainPage);
$MainPage->t_order_log_kronologisForm = & $t_order_log_kronologisForm;
$t_order_log_kronologisForm->Initialize();

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

//Execute Components @1-067C5593
$t_order_log_kronologisForm->Operation();
//End Execute Components

//Go to destination page @1-E75D8FC8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_order_log_kronologisForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8C176825
$t_order_log_kronologisForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C5F5C02E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_order_log_kronologisForm);
unset($Tpl);
//End Unload Page


?>
