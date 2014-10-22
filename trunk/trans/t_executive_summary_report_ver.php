<?php
//Include Common Files @1-B29B73A8
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_executive_summary_report_ver.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_registrationForm { //t_vat_registrationForm Class @629-5A819737

//Variables @629-D6FF3E86

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

//Class_Initialize Event @629-FFEF7858
    function clsRecordt_vat_registrationForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_registrationForm/Error";
        $this->DataSource = new clst_vat_registrationFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_registrationForm";
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
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "Id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->TAKEN_CTL = & new clsControl(ccsHidden, "TAKEN_CTL", "TAKEN_CTL", ccsText, "", CCGetRequestParam("TAKEN_CTL", $Method, NULL), $this);
            $this->IS_TAKEN = & new clsControl(ccsHidden, "IS_TAKEN", "IS_TAKEN", ccsText, "", CCGetRequestParam("IS_TAKEN", $Method, NULL), $this);
            $this->CURR_DOC_ID = & new clsControl(ccsHidden, "CURR_DOC_ID", "CURR_DOC_ID", ccsText, "", CCGetRequestParam("CURR_DOC_ID", $Method, NULL), $this);
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
            $this->Button2 = & new clsButton("Button2", $Method, $this);
            $this->Button3 = & new clsButton("Button3", $Method, $this);
            $this->Button4 = & new clsButton("Button4", $Method, $this);
            $this->Button5 = & new clsButton("Button5", $Method, $this);
            $this->t_execution_summary_id = & new clsControl(ccsHidden, "t_execution_summary_id", "vat", ccsFloat, "", CCGetRequestParam("t_execution_summary_id", $Method, NULL), $this);
            $this->year_code = & new clsControl(ccsTextBox, "year_code", "Periode Tahun", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->year_code->Required = true;
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "Ayat Pajak", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->p_vat_type_id1 = & new clsControl(ccsHidden, "p_vat_type_id1", "p_vat_type_id1", ccsText, "", CCGetRequestParam("p_vat_type_id1", $Method, NULL), $this);
            $this->ListBox1 = & new clsControl(ccsListBox, "ListBox1", "ListBox1", ccsText, "", CCGetRequestParam("ListBox1", $Method, NULL), $this);
            $this->ListBox1->DSType = dsListOfValues;
            $this->ListBox1->Values = array(array("1", "Per Bulan"), array("2", "Per Triwulan"), array("3", "Per Semester"));
            $this->period_code = & new clsControl(ccsTextBox, "period_code", "Bulan", ccsText, "", CCGetRequestParam("period_code", $Method, NULL), $this);
            $this->period_code->Required = true;
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsText, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
            $this->ListBox2 = & new clsControl(ccsListBox, "ListBox2", "ListBox2", ccsText, "", CCGetRequestParam("ListBox2", $Method, NULL), $this);
            $this->ListBox2->DSType = dsListOfValues;
            $this->ListBox2->Values = array(array("1", "I"), array("2", "II"), array("3", "III"), array("4", "IV"));
            $this->ListBox3 = & new clsControl(ccsListBox, "ListBox3", "ListBox3", ccsText, "", CCGetRequestParam("ListBox3", $Method, NULL), $this);
            $this->ListBox3->DSType = dsListOfValues;
            $this->ListBox3->Values = array(array("1", "I"), array("2", "II"));
            $this->vat_code_dtl = & new clsControl(ccsTextBox, "vat_code_dtl", "Ayat Pajak", ccsText, "", CCGetRequestParam("vat_code_dtl", $Method, NULL), $this);
            $this->vat_code_dtl->Required = true;
            $this->p_vat_type_dtl_id = & new clsControl(ccsHidden, "p_vat_type_dtl_id", "p_vat_type_dtl_id", ccsText, "", CCGetRequestParam("p_vat_type_dtl_id", $Method, NULL), $this);
            $this->Button7 = & new clsButton("Button7", $Method, $this);
            $this->saran = & new clsControl(ccsTextArea, "saran", "Nilai Transaksi", ccsText, "", CCGetRequestParam("saran", $Method, NULL), $this);
            $this->saran->Required = true;
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->penjelasan = & new clsControl(ccsTextArea, "penjelasan", "Nilai Transaksi", ccsText, "", CCGetRequestParam("penjelasan", $Method, NULL), $this);
            $this->penjelasan->Required = true;
            $this->permasalahan = & new clsControl(ccsTextArea, "permasalahan", "Nilai Transaksi", ccsText, "", CCGetRequestParam("permasalahan", $Method, NULL), $this);
            $this->permasalahan->Required = true;
            $this->kesimpulan = & new clsControl(ccsTextArea, "kesimpulan", "Nilai Transaksi", ccsText, "", CCGetRequestParam("kesimpulan", $Method, NULL), $this);
            $this->kesimpulan->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @629-830DBF3E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlCURR_DOC_ID"] = CCGetFromGet("CURR_DOC_ID", NULL);
    }
//End Initialize Method

//Validate Method @629-2C6A9F0A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->TAKEN_CTL->Validate() && $Validation);
        $Validation = ($this->IS_TAKEN->Validate() && $Validation);
        $Validation = ($this->CURR_DOC_ID->Validate() && $Validation);
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
        $Validation = ($this->t_execution_summary_id->Validate() && $Validation);
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id1->Validate() && $Validation);
        $Validation = ($this->ListBox1->Validate() && $Validation);
        $Validation = ($this->period_code->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $Validation = ($this->ListBox2->Validate() && $Validation);
        $Validation = ($this->ListBox3->Validate() && $Validation);
        $Validation = ($this->vat_code_dtl->Validate() && $Validation);
        $Validation = ($this->p_vat_type_dtl_id->Validate() && $Validation);
        $Validation = ($this->saran->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->penjelasan->Validate() && $Validation);
        $Validation = ($this->permasalahan->Validate() && $Validation);
        $Validation = ($this->kesimpulan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->TAKEN_CTL->Errors->Count() == 0);
        $Validation =  $Validation && ($this->IS_TAKEN->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CURR_DOC_ID->Errors->Count() == 0);
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
        $Validation =  $Validation && ($this->t_execution_summary_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->period_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ListBox3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code_dtl->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_dtl_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->saran->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->penjelasan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->permasalahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kesimpulan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @629-22F896AF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->TAKEN_CTL->Errors->Count());
        $errors = ($errors || $this->IS_TAKEN->Errors->Count());
        $errors = ($errors || $this->CURR_DOC_ID->Errors->Count());
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
        $errors = ($errors || $this->t_execution_summary_id->Errors->Count());
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id1->Errors->Count());
        $errors = ($errors || $this->ListBox1->Errors->Count());
        $errors = ($errors || $this->period_code->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->ListBox2->Errors->Count());
        $errors = ($errors || $this->ListBox3->Errors->Count());
        $errors = ($errors || $this->vat_code_dtl->Errors->Count());
        $errors = ($errors || $this->p_vat_type_dtl_id->Errors->Count());
        $errors = ($errors || $this->saran->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->penjelasan->Errors->Count());
        $errors = ($errors || $this->permasalahan->Errors->Count());
        $errors = ($errors || $this->kesimpulan->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @629-ED598703
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

//Operation Method @629-8B64F8BC
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
            } else if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            } else if($this->Button3->Pressed) {
                $this->PressedButton = "Button3";
            } else if($this->Button4->Pressed) {
                $this->PressedButton = "Button4";
            } else if($this->Button5->Pressed) {
                $this->PressedButton = "Button5";
            } else if($this->Button7->Pressed) {
                $this->PressedButton = "Button7";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_registration_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "t_customer_order.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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
            } else if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button3") {
                if(!CCGetEvent($this->Button3->CCSEvents, "OnClick", $this->Button3)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button4") {
                if(!CCGetEvent($this->Button4->CCSEvents, "OnClick", $this->Button4)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button5") {
                if(!CCGetEvent($this->Button5->CCSEvents, "OnClick", $this->Button5)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button7") {
                if(!CCGetEvent($this->Button7->CCSEvents, "OnClick", $this->Button7)) {
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

//UpdateRow Method @629-60A5F8C5
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->doc_no->SetValue($this->doc_no->GetValue(true));
        $this->DataSource->t_cust_acc_status_modif_id->SetValue($this->t_cust_acc_status_modif_id->GetValue(true));
        $this->DataSource->bap_employee_no_1->SetValue($this->bap_employee_no_1->GetValue(true));
        $this->DataSource->bap_employee_no_2->SetValue($this->bap_employee_no_2->GetValue(true));
        $this->DataSource->bap_employee_job_pos_1->SetValue($this->bap_employee_job_pos_1->GetValue(true));
        $this->DataSource->bap_employee_job_pos_2->SetValue($this->bap_employee_job_pos_2->GetValue(true));
        $this->DataSource->bap_employee_name_1->SetValue($this->bap_employee_name_1->GetValue(true));
        $this->DataSource->bap_employee_name_2->SetValue($this->bap_employee_name_2->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @629-D80E0CCE
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

        $this->ListBox1->Prepare();
        $this->ListBox2->Prepare();
        $this->ListBox3->Prepare();

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
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                    $this->t_execution_summary_id->SetValue($this->DataSource->t_execution_summary_id->GetValue());
                    $this->year_code->SetValue($this->DataSource->year_code->GetValue());
                    $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                    $this->p_vat_type_id1->SetValue($this->DataSource->p_vat_type_id1->GetValue());
                    $this->ListBox1->SetValue($this->DataSource->ListBox1->GetValue());
                    $this->period_code->SetValue($this->DataSource->period_code->GetValue());
                    $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                    $this->ListBox2->SetValue($this->DataSource->ListBox2->GetValue());
                    $this->ListBox3->SetValue($this->DataSource->ListBox3->GetValue());
                    $this->vat_code_dtl->SetValue($this->DataSource->vat_code_dtl->GetValue());
                    $this->p_vat_type_dtl_id->SetValue($this->DataSource->p_vat_type_dtl_id->GetValue());
                    $this->saran->SetValue($this->DataSource->saran->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->penjelasan->SetValue($this->DataSource->penjelasan->GetValue());
                    $this->permasalahan->SetValue($this->DataSource->permasalahan->GetValue());
                    $this->kesimpulan->SetValue($this->DataSource->kesimpulan->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TAKEN_CTL->Errors->ToString());
            $Error = ComposeStrings($Error, $this->IS_TAKEN->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CURR_DOC_ID->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->t_execution_summary_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->period_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ListBox3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code_dtl->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_dtl_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->saran->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->penjelasan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->permasalahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kesimpulan->Errors->ToString());
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
        $this->t_customer_order_id->Show();
        $this->p_rqst_type_id->Show();
        $this->TAKEN_CTL->Show();
        $this->IS_TAKEN->Show();
        $this->CURR_DOC_ID->Show();
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
        $this->Button2->Show();
        $this->Button3->Show();
        $this->Button4->Show();
        $this->Button5->Show();
        $this->t_execution_summary_id->Show();
        $this->year_code->Show();
        $this->p_year_period_id->Show();
        $this->vat_code->Show();
        $this->p_vat_type_id1->Show();
        $this->ListBox1->Show();
        $this->period_code->Show();
        $this->p_finance_period_id->Show();
        $this->ListBox2->Show();
        $this->ListBox3->Show();
        $this->vat_code_dtl->Show();
        $this->p_vat_type_dtl_id->Show();
        $this->Button7->Show();
        $this->saran->Show();
        $this->p_vat_type_id->Show();
        $this->penjelasan->Show();
        $this->permasalahan->Show();
        $this->kesimpulan->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_registrationForm Class @629-FCB6E20C

class clst_vat_registrationFormDataSource extends clsDBConnSIKP {  //t_vat_registrationFormDataSource Class @629-5993B12E

//DataSource Variables @629-66A0E639
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_customer_order_id;
    var $p_rqst_type_id;
    var $TAKEN_CTL;
    var $IS_TAKEN;
    var $CURR_DOC_ID;
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
    var $t_execution_summary_id;
    var $year_code;
    var $p_year_period_id;
    var $vat_code;
    var $p_vat_type_id1;
    var $ListBox1;
    var $period_code;
    var $p_finance_period_id;
    var $ListBox2;
    var $ListBox3;
    var $vat_code_dtl;
    var $p_vat_type_dtl_id;
    var $saran;
    var $p_vat_type_id;
    var $penjelasan;
    var $permasalahan;
    var $kesimpulan;
//End DataSource Variables

//DataSourceClass_Initialize Event @629-47370F6E
    function clst_vat_registrationFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_registrationForm/Error";
        $this->Initialize();
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->TAKEN_CTL = new clsField("TAKEN_CTL", ccsText, "");
        
        $this->IS_TAKEN = new clsField("IS_TAKEN", ccsText, "");
        
        $this->CURR_DOC_ID = new clsField("CURR_DOC_ID", ccsText, "");
        
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
        
        $this->t_execution_summary_id = new clsField("t_execution_summary_id", ccsFloat, "");
        
        $this->year_code = new clsField("year_code", ccsText, "");
        
        $this->p_year_period_id = new clsField("p_year_period_id", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->p_vat_type_id1 = new clsField("p_vat_type_id1", ccsText, "");
        
        $this->ListBox1 = new clsField("ListBox1", ccsText, "");
        
        $this->period_code = new clsField("period_code", ccsText, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsText, "");
        
        $this->ListBox2 = new clsField("ListBox2", ccsText, "");
        
        $this->ListBox3 = new clsField("ListBox3", ccsText, "");
        
        $this->vat_code_dtl = new clsField("vat_code_dtl", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsText, "");
        
        $this->saran = new clsField("saran", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->penjelasan = new clsField("penjelasan", ccsText, "");
        
        $this->permasalahan = new clsField("permasalahan", ccsText, "");
        
        $this->kesimpulan = new clsField("kesimpulan", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @629-72CC4444
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlCURR_DOC_ID", ccsFloat, "", "", $this->Parameters["urlCURR_DOC_ID"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @629-B8D5E33A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select x.vat_code,y.year_code,z.code as period_code, a.* from t_executive_summary a\n" .
        "left join p_vat_type x on x.p_vat_type_id= a.p_vat_type_id\n" .
        "left join p_year_period y on y.p_year_period_id= a.p_year_period_id\n" .
        "left join p_finance_period z on z.p_finance_period_id = a.p_finance_period_id\n" .
        "where t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @629-61CAB8CF
    function SetValues()
    {
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->p_rqst_type_id->SetDBValue(trim($this->f("p_rqst_type_id")));
        $this->t_execution_summary_id->SetDBValue(trim($this->f("t_execution_summary_id")));
        $this->year_code->SetDBValue($this->f("year_code"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->p_vat_type_id1->SetDBValue($this->f("p_vat_type_id"));
        $this->ListBox1->SetDBValue($this->f("period_type"));
        $this->period_code->SetDBValue($this->f("period_code"));
        $this->p_finance_period_id->SetDBValue($this->f("p_finance_period_id"));
        $this->ListBox2->SetDBValue($this->f("triwulan"));
        $this->ListBox3->SetDBValue($this->f("semester"));
        $this->vat_code_dtl->SetDBValue($this->f("vat_code_dtl"));
        $this->p_vat_type_dtl_id->SetDBValue($this->f("p_vat_type_dtl_id"));
        $this->saran->SetDBValue($this->f("saran"));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->penjelasan->SetDBValue($this->f("penjelasan"));
        $this->permasalahan->SetDBValue($this->f("permasalahan"));
        $this->kesimpulan->SetDBValue($this->f("kesimpulan"));
    }
//End SetValues Method

//Update Method @629-33DCFE01
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["doc_no"] = new clsSQLParameter("ctrldoc_no", ccsText, "", "", $this->doc_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_cust_acc_status_modif_id"] = new clsSQLParameter("ctrlt_cust_acc_status_modif_id", ccsInteger, "", "", $this->t_cust_acc_status_modif_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bap_employee_no_1"] = new clsSQLParameter("ctrlbap_employee_no_1", ccsText, "", "", $this->bap_employee_no_1->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["bap_employee_no_2"] = new clsSQLParameter("ctrlbap_employee_no_2", ccsText, "", "", $this->bap_employee_no_2->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["bap_employee_job_pos_1"] = new clsSQLParameter("ctrlbap_employee_job_pos_1", ccsText, "", "", $this->bap_employee_job_pos_1->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["bap_employee_job_pos_2"] = new clsSQLParameter("ctrlbap_employee_job_pos_2", ccsText, "", "", $this->bap_employee_job_pos_2->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["bap_employee_name_1"] = new clsSQLParameter("ctrlbap_employee_name_1", ccsText, "", "", $this->bap_employee_name_1->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["bap_employee_name_2"] = new clsSQLParameter("ctrlbap_employee_name_2", ccsText, "", "", $this->bap_employee_name_2->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user"] = new clsSQLParameter("expr959", ccsText, "", "", CCGEtUserLogin(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["doc_no"]->GetValue()) and !strlen($this->cp["doc_no"]->GetText()) and !is_bool($this->cp["doc_no"]->GetValue())) 
            $this->cp["doc_no"]->SetValue($this->doc_no->GetValue(true));
        if (!is_null($this->cp["t_cust_acc_status_modif_id"]->GetValue()) and !strlen($this->cp["t_cust_acc_status_modif_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_status_modif_id"]->GetValue())) 
            $this->cp["t_cust_acc_status_modif_id"]->SetValue($this->t_cust_acc_status_modif_id->GetValue(true));
        if (!strlen($this->cp["t_cust_acc_status_modif_id"]->GetText()) and !is_bool($this->cp["t_cust_acc_status_modif_id"]->GetValue(true))) 
            $this->cp["t_cust_acc_status_modif_id"]->SetText(0);
        if (!is_null($this->cp["bap_employee_no_1"]->GetValue()) and !strlen($this->cp["bap_employee_no_1"]->GetText()) and !is_bool($this->cp["bap_employee_no_1"]->GetValue())) 
            $this->cp["bap_employee_no_1"]->SetValue($this->bap_employee_no_1->GetValue(true));
        if (!is_null($this->cp["bap_employee_no_2"]->GetValue()) and !strlen($this->cp["bap_employee_no_2"]->GetText()) and !is_bool($this->cp["bap_employee_no_2"]->GetValue())) 
            $this->cp["bap_employee_no_2"]->SetValue($this->bap_employee_no_2->GetValue(true));
        if (!is_null($this->cp["bap_employee_job_pos_1"]->GetValue()) and !strlen($this->cp["bap_employee_job_pos_1"]->GetText()) and !is_bool($this->cp["bap_employee_job_pos_1"]->GetValue())) 
            $this->cp["bap_employee_job_pos_1"]->SetValue($this->bap_employee_job_pos_1->GetValue(true));
        if (!is_null($this->cp["bap_employee_job_pos_2"]->GetValue()) and !strlen($this->cp["bap_employee_job_pos_2"]->GetText()) and !is_bool($this->cp["bap_employee_job_pos_2"]->GetValue())) 
            $this->cp["bap_employee_job_pos_2"]->SetValue($this->bap_employee_job_pos_2->GetValue(true));
        if (!is_null($this->cp["bap_employee_name_1"]->GetValue()) and !strlen($this->cp["bap_employee_name_1"]->GetText()) and !is_bool($this->cp["bap_employee_name_1"]->GetValue())) 
            $this->cp["bap_employee_name_1"]->SetValue($this->bap_employee_name_1->GetValue(true));
        if (!is_null($this->cp["bap_employee_name_2"]->GetValue()) and !strlen($this->cp["bap_employee_name_2"]->GetText()) and !is_bool($this->cp["bap_employee_name_2"]->GetValue())) 
            $this->cp["bap_employee_name_2"]->SetValue($this->bap_employee_name_2->GetValue(true));
        if (!is_null($this->cp["user"]->GetValue()) and !strlen($this->cp["user"]->GetText()) and !is_bool($this->cp["user"]->GetValue())) 
            $this->cp["user"]->SetValue(CCGEtUserLogin());
        $this->SQL = "UPDATE t_cust_acc_status_modif SET \n" .
        "doc_no='" . $this->SQLValue($this->cp["doc_no"]->GetDBValue(), ccsText) . "', \n" .
        "bap_employee_no_1='" . $this->SQLValue($this->cp["bap_employee_no_1"]->GetDBValue(), ccsText) . "', \n" .
        "bap_employee_no_2='" . $this->SQLValue($this->cp["bap_employee_no_2"]->GetDBValue(), ccsText) . "', \n" .
        "bap_employee_job_pos_1='" . $this->SQLValue($this->cp["bap_employee_job_pos_1"]->GetDBValue(), ccsText) . "', \n" .
        "bap_employee_job_pos_2='" . $this->SQLValue($this->cp["bap_employee_job_pos_2"]->GetDBValue(), ccsText) . "', \n" .
        "bap_employee_name_1='" . $this->SQLValue($this->cp["bap_employee_name_1"]->GetDBValue(), ccsText) . "', \n" .
        "bap_employee_name_2='" . $this->SQLValue($this->cp["bap_employee_name_2"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate,\n" .
        "updated_by='" . $this->SQLValue($this->cp["user"]->GetDBValue(), ccsText) . "' \n" .
        "WHERE  \n" .
        "t_cust_acc_status_modif_id = \n" .
        "" . $this->SQLValue($this->cp["t_cust_acc_status_modif_id"]->GetDBValue(), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_vat_registrationFormDataSource Class @629-FCB6E20C



//Initialize Page @1-887D5AB4
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
$TemplateFileName = "t_executive_summary_report_ver.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-BC5AFB4A
include_once("./t_executive_summary_report_ver_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7E1E5A5D
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_registrationForm = & new clsRecordt_vat_registrationForm("", $MainPage);
$MainPage->t_vat_registrationForm = & $t_vat_registrationForm;
$t_vat_registrationForm->Initialize();

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

//Execute Components @1-205D58B6
$t_vat_registrationForm->Operation();
//End Execute Components

//Go to destination page @1-75BFB244
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_registrationForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A0C12D87
$t_vat_registrationForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-ACE70B91
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_registrationForm);
unset($Tpl);
//End Unload Page


?>
