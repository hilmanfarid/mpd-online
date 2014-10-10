<?php
//Include Common Files @1-788B0863
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_penutupan_wp_ver.php");
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

//Class_Initialize Event @629-81F1053E
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
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->order_no = & new clsControl(ccsTextBox, "order_no", "Nomor Order", ccsText, "", CCGetRequestParam("order_no", $Method, NULL), $this);
            $this->status_request_date = & new clsControl(ccsTextBox, "status_request_date", "Tanggal Pendaftaran", ccsText, "", CCGetRequestParam("status_request_date", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "Id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->Label1 = & new clsControl(ccsLabel, "Label1", "Label1", ccsText, "", CCGetRequestParam("Label1", $Method, NULL), $this);
            $this->p_hotel_grade_id = & new clsControl(ccsListBox, "p_hotel_grade_id", "p_hotel_grade_id", ccsFloat, "", CCGetRequestParam("p_hotel_grade_id", $Method, NULL), $this);
            $this->p_hotel_grade_id->DSType = dsTable;
            $this->p_hotel_grade_id->DataSource = new clsDBConnSIKP();
            $this->p_hotel_grade_id->ds = & $this->p_hotel_grade_id->DataSource;
            $this->p_hotel_grade_id->DataSource->SQL = "SELECT * \n" .
"FROM p_hotel_grade {SQL_Where} {SQL_OrderBy}";
            list($this->p_hotel_grade_id->BoundColumn, $this->p_hotel_grade_id->TextColumn, $this->p_hotel_grade_id->DBFormat) = array("p_hotel_grade_id", "grade_name", "");
            $this->p_rest_service_type_id = & new clsControl(ccsListBox, "p_rest_service_type_id", "p_rest_service_type_id", ccsFloat, "", CCGetRequestParam("p_rest_service_type_id", $Method, NULL), $this);
            $this->p_rest_service_type_id->DSType = dsTable;
            $this->p_rest_service_type_id->DataSource = new clsDBConnSIKP();
            $this->p_rest_service_type_id->ds = & $this->p_rest_service_type_id->DataSource;
            $this->p_rest_service_type_id->DataSource->SQL = "SELECT * \n" .
"FROM p_rest_service_type {SQL_Where} {SQL_OrderBy}";
            list($this->p_rest_service_type_id->BoundColumn, $this->p_rest_service_type_id->TextColumn, $this->p_rest_service_type_id->DBFormat) = array("p_rest_service_type_id", "code", "");
            $this->p_entertaintment_type_id = & new clsControl(ccsListBox, "p_entertaintment_type_id", "p_entertaintment_type_id", ccsFloat, "", CCGetRequestParam("p_entertaintment_type_id", $Method, NULL), $this);
            $this->p_entertaintment_type_id->DSType = dsTable;
            $this->p_entertaintment_type_id->DataSource = new clsDBConnSIKP();
            $this->p_entertaintment_type_id->ds = & $this->p_entertaintment_type_id->DataSource;
            $this->p_entertaintment_type_id->DataSource->SQL = "SELECT * \n" .
"FROM p_entertaintment_type {SQL_Where} {SQL_OrderBy}";
            list($this->p_entertaintment_type_id->BoundColumn, $this->p_entertaintment_type_id->TextColumn, $this->p_entertaintment_type_id->DBFormat) = array("p_entertaintment_type_id", "entertaintment_name", "");
            $this->p_parking_classification_id = & new clsControl(ccsListBox, "p_parking_classification_id", "p_parking_classification_id", ccsFloat, "", CCGetRequestParam("p_parking_classification_id", $Method, NULL), $this);
            $this->p_parking_classification_id->DSType = dsTable;
            $this->p_parking_classification_id->DataSource = new clsDBConnSIKP();
            $this->p_parking_classification_id->ds = & $this->p_parking_classification_id->DataSource;
            $this->p_parking_classification_id->DataSource->SQL = "SELECT * \n" .
"FROM p_parking_classification {SQL_Where} {SQL_OrderBy}";
            list($this->p_parking_classification_id->BoundColumn, $this->p_parking_classification_id->TextColumn, $this->p_parking_classification_id->DBFormat) = array("p_parking_classification_id", "code", "");
            $this->p_rqst_type_code = & new clsControl(ccsTextBox, "p_rqst_type_code", "Jenis Permohonan", ccsText, "", CCGetRequestParam("p_rqst_type_code", $Method, NULL), $this);
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
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->Button6 = & new clsButton("Button6", $Method, $this);
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->npwd = & new clsControl(ccsTextBox, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", $Method, NULL), $this);
            $this->npwd->Required = true;
            $this->p_vat_type_code = & new clsControl(ccsTextBox, "p_vat_type_code", "p_vat_type_code", ccsText, "", CCGetRequestParam("p_vat_type_code", $Method, NULL), $this);
            $this->p_vat_type_code->Required = true;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->company_brand = & new clsControl(ccsTextBox, "company_brand", "company_brand", ccsText, "", CCGetRequestParam("company_brand", $Method, NULL), $this);
            $this->company_brand->Required = true;
            $this->p_account_status_mut = & new clsControl(ccsTextBox, "p_account_status_mut", "p_account_status_mut", ccsText, "", CCGetRequestParam("p_account_status_mut", $Method, NULL), $this);
            $this->p_account_status_mut->Required = true;
            $this->p_account_status_id = & new clsControl(ccsHidden, "p_account_status_id", "p_account_status_id", ccsFloat, "", CCGetRequestParam("p_account_status_id", $Method, NULL), $this);
            $this->reason_code = & new clsControl(ccsTextBox, "reason_code", "reason_code", ccsText, "", CCGetRequestParam("reason_code", $Method, NULL), $this);
            $this->reason_code->Required = true;
            $this->reason_status_id = & new clsControl(ccsHidden, "reason_status_id", "reason_status_id", ccsFloat, "", CCGetRequestParam("reason_status_id", $Method, NULL), $this);
            $this->reason_description = & new clsControl(ccsTextBox, "reason_description", "keterangan alasan penutupan", ccsText, "", CCGetRequestParam("reason_description", $Method, NULL), $this);
            $this->t_cust_acc_status_modif_id = & new clsControl(ccsHidden, "t_cust_acc_status_modif_id", "Id", ccsFloat, "", CCGetRequestParam("t_cust_acc_status_modif_id", $Method, NULL), $this);
            $this->p_account_status_curr = & new clsControl(ccsTextBox, "p_account_status_curr", "p_account_status_curr", ccsText, "", CCGetRequestParam("p_account_status_curr", $Method, NULL), $this);
            $this->p_account_status_curr->Required = true;
            $this->bap_employee_name_1 = & new clsControl(ccsTextBox, "bap_employee_name_1", "Nama Petugas 1", ccsText, "", CCGetRequestParam("bap_employee_name_1", $Method, NULL), $this);
            $this->bap_employee_no_1 = & new clsControl(ccsTextBox, "bap_employee_no_1", "NIP Petugas 1", ccsText, "", CCGetRequestParam("bap_employee_no_1", $Method, NULL), $this);
            $this->bap_employee_job_pos_1 = & new clsControl(ccsTextBox, "bap_employee_job_pos_1", "Jabatan Petugas 1", ccsText, "", CCGetRequestParam("bap_employee_job_pos_1", $Method, NULL), $this);
            $this->bap_employee_name_2 = & new clsControl(ccsTextBox, "bap_employee_name_2", "Nama Petugas 2", ccsText, "", CCGetRequestParam("bap_employee_name_2", $Method, NULL), $this);
            $this->bap_employee_no_2 = & new clsControl(ccsTextBox, "bap_employee_no_2", "NIP Petugas 2", ccsText, "", CCGetRequestParam("bap_employee_no_2", $Method, NULL), $this);
            $this->bap_employee_job_pos_2 = & new clsControl(ccsTextBox, "bap_employee_job_pos_2", "Jabatan Petugas 2", ccsText, "", CCGetRequestParam("bap_employee_job_pos_2", $Method, NULL), $this);
            $this->doc_no = & new clsControl(ccsTextBox, "doc_no", "Nama Petugas 1", ccsText, "", CCGetRequestParam("doc_no", $Method, NULL), $this);
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "vat", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->status_request_date->Value) && !strlen($this->status_request_date->Value) && $this->status_request_date->Value !== false)
                    $this->status_request_date->SetText(date("d-M-Y h:i:s"));
            }
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

//Validate Method @629-66FB6545
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->order_no->Validate() && $Validation);
        $Validation = ($this->status_request_date->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->p_hotel_grade_id->Validate() && $Validation);
        $Validation = ($this->p_rest_service_type_id->Validate() && $Validation);
        $Validation = ($this->p_entertaintment_type_id->Validate() && $Validation);
        $Validation = ($this->p_parking_classification_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_code->Validate() && $Validation);
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
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->npwd->Validate() && $Validation);
        $Validation = ($this->p_vat_type_code->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->company_brand->Validate() && $Validation);
        $Validation = ($this->p_account_status_mut->Validate() && $Validation);
        $Validation = ($this->p_account_status_id->Validate() && $Validation);
        $Validation = ($this->reason_code->Validate() && $Validation);
        $Validation = ($this->reason_status_id->Validate() && $Validation);
        $Validation = ($this->reason_description->Validate() && $Validation);
        $Validation = ($this->t_cust_acc_status_modif_id->Validate() && $Validation);
        $Validation = ($this->p_account_status_curr->Validate() && $Validation);
        $Validation = ($this->bap_employee_name_1->Validate() && $Validation);
        $Validation = ($this->bap_employee_no_1->Validate() && $Validation);
        $Validation = ($this->bap_employee_job_pos_1->Validate() && $Validation);
        $Validation = ($this->bap_employee_name_2->Validate() && $Validation);
        $Validation = ($this->bap_employee_no_2->Validate() && $Validation);
        $Validation = ($this->bap_employee_job_pos_2->Validate() && $Validation);
        $Validation = ($this->doc_no->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->order_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->status_request_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_hotel_grade_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rest_service_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_entertaintment_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_parking_classification_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_code->Errors->Count() == 0);
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
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_brand->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_mut->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reason_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reason_status_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->reason_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_acc_status_modif_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_account_status_curr->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bap_employee_name_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bap_employee_no_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bap_employee_job_pos_1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bap_employee_name_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bap_employee_no_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bap_employee_job_pos_2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->doc_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @629-31A4F063
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->order_no->Errors->Count());
        $errors = ($errors || $this->status_request_date->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->p_hotel_grade_id->Errors->Count());
        $errors = ($errors || $this->p_rest_service_type_id->Errors->Count());
        $errors = ($errors || $this->p_entertaintment_type_id->Errors->Count());
        $errors = ($errors || $this->p_parking_classification_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_code->Errors->Count());
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
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->npwd->Errors->Count());
        $errors = ($errors || $this->p_vat_type_code->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->company_brand->Errors->Count());
        $errors = ($errors || $this->p_account_status_mut->Errors->Count());
        $errors = ($errors || $this->p_account_status_id->Errors->Count());
        $errors = ($errors || $this->reason_code->Errors->Count());
        $errors = ($errors || $this->reason_status_id->Errors->Count());
        $errors = ($errors || $this->reason_description->Errors->Count());
        $errors = ($errors || $this->t_cust_acc_status_modif_id->Errors->Count());
        $errors = ($errors || $this->p_account_status_curr->Errors->Count());
        $errors = ($errors || $this->bap_employee_name_1->Errors->Count());
        $errors = ($errors || $this->bap_employee_no_1->Errors->Count());
        $errors = ($errors || $this->bap_employee_job_pos_1->Errors->Count());
        $errors = ($errors || $this->bap_employee_name_2->Errors->Count());
        $errors = ($errors || $this->bap_employee_no_2->Errors->Count());
        $errors = ($errors || $this->bap_employee_job_pos_2->Errors->Count());
        $errors = ($errors || $this->doc_no->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
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

//Operation Method @629-D65E5C1E
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
            } else if($this->Button6->Pressed) {
                $this->PressedButton = "Button6";
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
            } else if($this->PressedButton == "Button6") {
                if(!CCGetEvent($this->Button6->CCSEvents, "OnClick", $this->Button6)) {
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

//Show Method @629-2C786BD8
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

        $this->p_hotel_grade_id->Prepare();
        $this->p_rest_service_type_id->Prepare();
        $this->p_entertaintment_type_id->Prepare();
        $this->p_parking_classification_id->Prepare();

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
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->order_no->SetValue($this->DataSource->order_no->GetValue());
                    $this->status_request_date->SetValue($this->DataSource->status_request_date->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                    $this->p_hotel_grade_id->SetValue($this->DataSource->p_hotel_grade_id->GetValue());
                    $this->p_rest_service_type_id->SetValue($this->DataSource->p_rest_service_type_id->GetValue());
                    $this->p_entertaintment_type_id->SetValue($this->DataSource->p_entertaintment_type_id->GetValue());
                    $this->p_parking_classification_id->SetValue($this->DataSource->p_parking_classification_id->GetValue());
                    $this->p_rqst_type_code->SetValue($this->DataSource->p_rqst_type_code->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->t_customer_id->SetValue($this->DataSource->t_customer_id->GetValue());
                    $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                    $this->p_vat_type_code->SetValue($this->DataSource->p_vat_type_code->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->company_brand->SetValue($this->DataSource->company_brand->GetValue());
                    $this->p_account_status_mut->SetValue($this->DataSource->p_account_status_mut->GetValue());
                    $this->p_account_status_id->SetValue($this->DataSource->p_account_status_id->GetValue());
                    $this->reason_code->SetValue($this->DataSource->reason_code->GetValue());
                    $this->reason_status_id->SetValue($this->DataSource->reason_status_id->GetValue());
                    $this->reason_description->SetValue($this->DataSource->reason_description->GetValue());
                    $this->t_cust_acc_status_modif_id->SetValue($this->DataSource->t_cust_acc_status_modif_id->GetValue());
                    $this->p_account_status_curr->SetValue($this->DataSource->p_account_status_curr->GetValue());
                    $this->bap_employee_name_1->SetValue($this->DataSource->bap_employee_name_1->GetValue());
                    $this->bap_employee_no_1->SetValue($this->DataSource->bap_employee_no_1->GetValue());
                    $this->bap_employee_job_pos_1->SetValue($this->DataSource->bap_employee_job_pos_1->GetValue());
                    $this->bap_employee_name_2->SetValue($this->DataSource->bap_employee_name_2->GetValue());
                    $this->bap_employee_no_2->SetValue($this->DataSource->bap_employee_no_2->GetValue());
                    $this->bap_employee_job_pos_2->SetValue($this->DataSource->bap_employee_job_pos_2->GetValue());
                    $this->doc_no->SetValue($this->DataSource->doc_no->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->order_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->status_request_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_hotel_grade_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rest_service_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_entertaintment_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_parking_classification_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_code->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_brand->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_mut->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reason_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reason_status_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->reason_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_acc_status_modif_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_account_status_curr->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bap_employee_name_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bap_employee_no_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bap_employee_job_pos_1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bap_employee_name_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bap_employee_no_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bap_employee_job_pos_2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->doc_no->Errors->ToString());
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
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->order_no->Show();
        $this->status_request_date->Show();
        $this->t_customer_order_id->Show();
        $this->p_rqst_type_id->Show();
        $this->Label1->Show();
        $this->p_hotel_grade_id->Show();
        $this->p_rest_service_type_id->Show();
        $this->p_entertaintment_type_id->Show();
        $this->p_parking_classification_id->Show();
        $this->p_rqst_type_code->Show();
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
        $this->wp_name->Show();
        $this->Button6->Show();
        $this->t_customer_id->Show();
        $this->npwd->Show();
        $this->p_vat_type_code->Show();
        $this->t_cust_account_id->Show();
        $this->p_vat_type_id->Show();
        $this->wp_address_name->Show();
        $this->company_brand->Show();
        $this->p_account_status_mut->Show();
        $this->p_account_status_id->Show();
        $this->reason_code->Show();
        $this->reason_status_id->Show();
        $this->reason_description->Show();
        $this->t_cust_acc_status_modif_id->Show();
        $this->p_account_status_curr->Show();
        $this->bap_employee_name_1->Show();
        $this->bap_employee_no_1->Show();
        $this->bap_employee_job_pos_1->Show();
        $this->bap_employee_name_2->Show();
        $this->bap_employee_no_2->Show();
        $this->bap_employee_job_pos_2->Show();
        $this->doc_no->Show();
        $this->t_vat_registration_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_registrationForm Class @629-FCB6E20C

class clst_vat_registrationFormDataSource extends clsDBConnSIKP {  //t_vat_registrationFormDataSource Class @629-5993B12E

//DataSource Variables @629-D54155EE
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $order_no;
    var $status_request_date;
    var $t_customer_order_id;
    var $p_rqst_type_id;
    var $Label1;
    var $p_hotel_grade_id;
    var $p_rest_service_type_id;
    var $p_entertaintment_type_id;
    var $p_parking_classification_id;
    var $p_rqst_type_code;
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
    var $wp_name;
    var $t_customer_id;
    var $npwd;
    var $p_vat_type_code;
    var $t_cust_account_id;
    var $p_vat_type_id;
    var $wp_address_name;
    var $company_brand;
    var $p_account_status_mut;
    var $p_account_status_id;
    var $reason_code;
    var $reason_status_id;
    var $reason_description;
    var $t_cust_acc_status_modif_id;
    var $p_account_status_curr;
    var $bap_employee_name_1;
    var $bap_employee_no_1;
    var $bap_employee_job_pos_1;
    var $bap_employee_name_2;
    var $bap_employee_no_2;
    var $bap_employee_job_pos_2;
    var $doc_no;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @629-62AC7AA7
    function clst_vat_registrationFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_registrationForm/Error";
        $this->Initialize();
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->status_request_date = new clsField("status_request_date", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->p_hotel_grade_id = new clsField("p_hotel_grade_id", ccsFloat, "");
        
        $this->p_rest_service_type_id = new clsField("p_rest_service_type_id", ccsFloat, "");
        
        $this->p_entertaintment_type_id = new clsField("p_entertaintment_type_id", ccsFloat, "");
        
        $this->p_parking_classification_id = new clsField("p_parking_classification_id", ccsFloat, "");
        
        $this->p_rqst_type_code = new clsField("p_rqst_type_code", ccsText, "");
        
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
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->t_customer_id = new clsField("t_customer_id", ccsFloat, "");
        
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->p_vat_type_code = new clsField("p_vat_type_code", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->company_brand = new clsField("company_brand", ccsText, "");
        
        $this->p_account_status_mut = new clsField("p_account_status_mut", ccsText, "");
        
        $this->p_account_status_id = new clsField("p_account_status_id", ccsFloat, "");
        
        $this->reason_code = new clsField("reason_code", ccsText, "");
        
        $this->reason_status_id = new clsField("reason_status_id", ccsFloat, "");
        
        $this->reason_description = new clsField("reason_description", ccsText, "");
        
        $this->t_cust_acc_status_modif_id = new clsField("t_cust_acc_status_modif_id", ccsFloat, "");
        
        $this->p_account_status_curr = new clsField("p_account_status_curr", ccsText, "");
        
        $this->bap_employee_name_1 = new clsField("bap_employee_name_1", ccsText, "");
        
        $this->bap_employee_no_1 = new clsField("bap_employee_no_1", ccsText, "");
        
        $this->bap_employee_job_pos_1 = new clsField("bap_employee_job_pos_1", ccsText, "");
        
        $this->bap_employee_name_2 = new clsField("bap_employee_name_2", ccsText, "");
        
        $this->bap_employee_no_2 = new clsField("bap_employee_no_2", ccsText, "");
        
        $this->bap_employee_job_pos_2 = new clsField("bap_employee_job_pos_2", ccsText, "");
        
        $this->doc_no = new clsField("doc_no", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

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

//Open Method @629-6F7793FA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM v_t_cust_acc_status_modif\n" .
        "WHERE t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @629-5209BD47
    function SetValues()
    {
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->status_request_date->SetDBValue($this->f("status_request_date"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->p_rqst_type_id->SetDBValue(trim($this->f("p_rqst_type_id")));
        $this->p_hotel_grade_id->SetDBValue(trim($this->f("p_hotel_grade_id")));
        $this->p_rest_service_type_id->SetDBValue(trim($this->f("p_rest_service_type_id")));
        $this->p_entertaintment_type_id->SetDBValue(trim($this->f("p_entertaintment_type_id")));
        $this->p_parking_classification_id->SetDBValue(trim($this->f("p_parking_classification_id")));
        $this->p_rqst_type_code->SetDBValue($this->f("p_rqst_type_code"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->t_customer_id->SetDBValue(trim($this->f("t_customer_id")));
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->p_vat_type_code->SetDBValue($this->f("p_vat_type_code"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->company_brand->SetDBValue($this->f("company_brand"));
        $this->p_account_status_mut->SetDBValue($this->f("p_account_status_mut"));
        $this->p_account_status_id->SetDBValue(trim($this->f("p_account_status_id")));
        $this->reason_code->SetDBValue($this->f("reason_code"));
        $this->reason_status_id->SetDBValue(trim($this->f("reason_status_id")));
        $this->reason_description->SetDBValue($this->f("reason_description"));
        $this->t_cust_acc_status_modif_id->SetDBValue(trim($this->f("t_cust_acc_status_modif_id")));
        $this->p_account_status_curr->SetDBValue($this->f("p_account_status_curr"));
        $this->bap_employee_name_1->SetDBValue($this->f("bap_employee_name_1"));
        $this->bap_employee_no_1->SetDBValue($this->f("bap_employee_no_1"));
        $this->bap_employee_job_pos_1->SetDBValue($this->f("bap_employee_job_pos_1"));
        $this->bap_employee_name_2->SetDBValue($this->f("bap_employee_name_2"));
        $this->bap_employee_no_2->SetDBValue($this->f("bap_employee_no_2"));
        $this->bap_employee_job_pos_2->SetDBValue($this->f("bap_employee_job_pos_2"));
        $this->doc_no->SetDBValue($this->f("doc_no"));
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

//Initialize Page @1-F616238B
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
$TemplateFileName = "t_penutupan_wp_ver.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D0C97750
include_once("./t_penutupan_wp_ver_events.php");
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
