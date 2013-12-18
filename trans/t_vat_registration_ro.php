<?php
//Include Common Files @1-C40FE407
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_registration_ro.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_registrationForm { //t_vat_registrationForm Class @94-5A819737

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

//Class_Initialize Event @94-9C6790A2
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
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
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
            $this->order_no->Required = true;
            $this->registration_date = & new clsControl(ccsTextBox, "registration_date", "Tanggal Pendaftaran", ccsText, "", CCGetRequestParam("registration_date", $Method, NULL), $this);
            $this->registration_date->Required = true;
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "Id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->kelurahan_code = & new clsControl(ccsTextBox, "kelurahan_code", "Kelurahan", ccsText, "", CCGetRequestParam("kelurahan_code", $Method, NULL), $this);
            $this->kelurahan_code->Required = true;
            $this->kecamatan_code = & new clsControl(ccsTextBox, "kecamatan_code", "Kecamatan", ccsText, "", CCGetRequestParam("kecamatan_code", $Method, NULL), $this);
            $this->kecamatan_code->Required = true;
            $this->kota_code = & new clsControl(ccsTextBox, "kota_code", "Kota/Kabupaten", ccsText, "", CCGetRequestParam("kota_code", $Method, NULL), $this);
            $this->kota_code->Required = true;
            $this->p_region_id_kelurahan = & new clsControl(ccsHidden, "p_region_id_kelurahan", "p_region_id_kelurahan", ccsFloat, "", CCGetRequestParam("p_region_id_kelurahan", $Method, NULL), $this);
            $this->p_region_id_kecamatan = & new clsControl(ccsHidden, "p_region_id_kecamatan", "p_region_id_kecamatan", ccsFloat, "", CCGetRequestParam("p_region_id_kecamatan", $Method, NULL), $this);
            $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "p_region_id", ccsFloat, "", CCGetRequestParam("p_region_id", $Method, NULL), $this);
            $this->kelurahan_own_code = & new clsControl(ccsTextBox, "kelurahan_own_code", "Kelurahan", ccsText, "", CCGetRequestParam("kelurahan_own_code", $Method, NULL), $this);
            $this->kelurahan_own_code->Required = true;
            $this->kecamatan_own_code = & new clsControl(ccsTextBox, "kecamatan_own_code", "Kecamatan", ccsText, "", CCGetRequestParam("kecamatan_own_code", $Method, NULL), $this);
            $this->kecamatan_own_code->Required = true;
            $this->kota_own_code = & new clsControl(ccsTextBox, "kota_own_code", "Kota/Kabupaten", ccsText, "", CCGetRequestParam("kota_own_code", $Method, NULL), $this);
            $this->kota_own_code->Required = true;
            $this->p_region_id_kel_owner = & new clsControl(ccsHidden, "p_region_id_kel_owner", "p_order_status_id", ccsFloat, "", CCGetRequestParam("p_region_id_kel_owner", $Method, NULL), $this);
            $this->p_region_id_kec_owner = & new clsControl(ccsHidden, "p_region_id_kec_owner", "p_order_status_id", ccsFloat, "", CCGetRequestParam("p_region_id_kec_owner", $Method, NULL), $this);
            $this->p_region_id_owner = & new clsControl(ccsHidden, "p_region_id_owner", "p_order_status_id", ccsFloat, "", CCGetRequestParam("p_region_id_owner", $Method, NULL), $this);
            $this->company_name = & new clsControl(ccsTextBox, "company_name", "Nama Badan/Perusahaan", ccsText, "", CCGetRequestParam("company_name", $Method, NULL), $this);
            $this->company_name->Required = true;
            $this->address_name = & new clsControl(ccsTextArea, "address_name", "Alamat", ccsText, "", CCGetRequestParam("address_name", $Method, NULL), $this);
            $this->address_name->Required = true;
            $this->job_position_code = & new clsControl(ccsTextBox, "job_position_code", "Jabatan", ccsText, "", CCGetRequestParam("job_position_code", $Method, NULL), $this);
            $this->job_position_code->Required = true;
            $this->p_job_position_id = & new clsControl(ccsHidden, "p_job_position_id", "p_order_status_id", ccsFloat, "", CCGetRequestParam("p_job_position_id", $Method, NULL), $this);
            $this->company_brand = & new clsControl(ccsTextBox, "company_brand", "Merek Usaha", ccsText, "", CCGetRequestParam("company_brand", $Method, NULL), $this);
            $this->company_brand->Required = true;
            $this->address_no = & new clsControl(ccsTextBox, "address_no", "No", ccsText, "", CCGetRequestParam("address_no", $Method, NULL), $this);
            $this->address_no->Required = true;
            $this->address_rt = & new clsControl(ccsTextBox, "address_rt", "Rt", ccsText, "", CCGetRequestParam("address_rt", $Method, NULL), $this);
            $this->address_rw = & new clsControl(ccsTextBox, "address_rw", "Rw", ccsText, "", CCGetRequestParam("address_rw", $Method, NULL), $this);
            $this->address_no_owner = & new clsControl(ccsTextBox, "address_no_owner", "No", ccsText, "", CCGetRequestParam("address_no_owner", $Method, NULL), $this);
            $this->address_no_owner->Required = true;
            $this->address_rt_owner = & new clsControl(ccsTextBox, "address_rt_owner", "Rt", ccsText, "", CCGetRequestParam("address_rt_owner", $Method, NULL), $this);
            $this->address_rw_owner = & new clsControl(ccsTextBox, "address_rw_owner", "Rw", ccsText, "", CCGetRequestParam("address_rw_owner", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "No. Telephon", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->fax_no = & new clsControl(ccsTextBox, "fax_no", "No. Fax", ccsText, "", CCGetRequestParam("fax_no", $Method, NULL), $this);
            $this->zip_code = & new clsControl(ccsTextBox, "zip_code", "Kode Pos", ccsText, "", CCGetRequestParam("zip_code", $Method, NULL), $this);
            $this->phone_no_owner = & new clsControl(ccsTextBox, "phone_no_owner", "No. Telephon", ccsText, "", CCGetRequestParam("phone_no_owner", $Method, NULL), $this);
            $this->company_owner = & new clsControl(ccsTextBox, "company_owner", "Nama Pemilik/Pengelola", ccsText, "", CCGetRequestParam("company_owner", $Method, NULL), $this);
            $this->company_owner->Required = true;
            $this->mobile_no_owner = & new clsControl(ccsTextBox, "mobile_no_owner", "No. Handphone", ccsText, "", CCGetRequestParam("mobile_no_owner", $Method, NULL), $this);
            $this->fax_no_owner = & new clsControl(ccsTextBox, "fax_no_owner", "No. Fax", ccsText, "", CCGetRequestParam("fax_no_owner", $Method, NULL), $this);
            $this->zip_code_owner = & new clsControl(ccsTextBox, "zip_code_owner", "Kode Pos", ccsText, "", CCGetRequestParam("zip_code_owner", $Method, NULL), $this);
            $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "No. Handphone", ccsText, "", CCGetRequestParam("mobile_no", $Method, NULL), $this);
            $this->address_name_owner = & new clsControl(ccsTextArea, "address_name_owner", "Alamat", ccsText, "", CCGetRequestParam("address_name_owner", $Method, NULL), $this);
            $this->address_name_owner->Required = true;
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->rqst_type_code = & new clsControl(ccsHidden, "rqst_type_code", "rqst_type_code", ccsText, "", CCGetRequestParam("rqst_type_code", $Method, NULL), $this);
            $this->email = & new clsControl(ccsTextBox, "email", "Email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
            $this->company_additional_addr = & new clsControl(ccsTextArea, "company_additional_addr", "Alamat Badan", ccsText, "", CCGetRequestParam("company_additional_addr", $Method, NULL), $this);
            $this->company_additional_addr->Required = true;
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
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->validation_code = & new clsControl(ccsTextBox, "validation_code", "Kode Validasi", ccsText, "", CCGetRequestParam("validation_code", $Method, NULL), $this);
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            $this->Label3 = & new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->registration_date->Value) && !strlen($this->registration_date->Value) && $this->registration_date->Value !== false)
                    $this->registration_date->SetText(date("d-M-Y h:i:s"));
                if(!is_array($this->kota_own_code->Value) && !strlen($this->kota_own_code->Value) && $this->kota_own_code->Value !== false)
                    $this->kota_own_code->SetText('KOTA BANDUNG');
                if(!is_array($this->p_region_id_owner->Value) && !strlen($this->p_region_id_owner->Value) && $this->p_region_id_owner->Value !== false)
                    $this->p_region_id_owner->SetText(749);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-E8596F60
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_customer_order_id"] = CCGetFromGet("t_customer_order_id", NULL);
    }
//End Initialize Method

//Validate Method @94-BB0EE2CF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email->GetText())) {
            $this->email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email"));
        }
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->order_no->Validate() && $Validation);
        $Validation = ($this->registration_date->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->kelurahan_code->Validate() && $Validation);
        $Validation = ($this->kecamatan_code->Validate() && $Validation);
        $Validation = ($this->kota_code->Validate() && $Validation);
        $Validation = ($this->p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->p_region_id_kecamatan->Validate() && $Validation);
        $Validation = ($this->p_region_id->Validate() && $Validation);
        $Validation = ($this->kelurahan_own_code->Validate() && $Validation);
        $Validation = ($this->kecamatan_own_code->Validate() && $Validation);
        $Validation = ($this->kota_own_code->Validate() && $Validation);
        $Validation = ($this->p_region_id_kel_owner->Validate() && $Validation);
        $Validation = ($this->p_region_id_kec_owner->Validate() && $Validation);
        $Validation = ($this->p_region_id_owner->Validate() && $Validation);
        $Validation = ($this->company_name->Validate() && $Validation);
        $Validation = ($this->address_name->Validate() && $Validation);
        $Validation = ($this->job_position_code->Validate() && $Validation);
        $Validation = ($this->p_job_position_id->Validate() && $Validation);
        $Validation = ($this->company_brand->Validate() && $Validation);
        $Validation = ($this->address_no->Validate() && $Validation);
        $Validation = ($this->address_rt->Validate() && $Validation);
        $Validation = ($this->address_rw->Validate() && $Validation);
        $Validation = ($this->address_no_owner->Validate() && $Validation);
        $Validation = ($this->address_rt_owner->Validate() && $Validation);
        $Validation = ($this->address_rw_owner->Validate() && $Validation);
        $Validation = ($this->phone_no->Validate() && $Validation);
        $Validation = ($this->fax_no->Validate() && $Validation);
        $Validation = ($this->zip_code->Validate() && $Validation);
        $Validation = ($this->phone_no_owner->Validate() && $Validation);
        $Validation = ($this->company_owner->Validate() && $Validation);
        $Validation = ($this->mobile_no_owner->Validate() && $Validation);
        $Validation = ($this->fax_no_owner->Validate() && $Validation);
        $Validation = ($this->zip_code_owner->Validate() && $Validation);
        $Validation = ($this->mobile_no->Validate() && $Validation);
        $Validation = ($this->address_name_owner->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->rqst_type_code->Validate() && $Validation);
        $Validation = ($this->email->Validate() && $Validation);
        $Validation = ($this->company_additional_addr->Validate() && $Validation);
        $Validation = ($this->p_hotel_grade_id->Validate() && $Validation);
        $Validation = ($this->p_rest_service_type_id->Validate() && $Validation);
        $Validation = ($this->p_entertaintment_type_id->Validate() && $Validation);
        $Validation = ($this->p_parking_classification_id->Validate() && $Validation);
        $Validation = ($this->validation_code->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->order_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->registration_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kelurahan_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kecamatan_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kota_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kelurahan_own_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kecamatan_own_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->kota_own_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kel_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_kec_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_region_id_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->job_position_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_job_position_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_brand->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rt_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_rw_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rqst_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->company_additional_addr->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_hotel_grade_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rest_service_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_entertaintment_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_parking_classification_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->validation_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-C3932144
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->order_no->Errors->Count());
        $errors = ($errors || $this->registration_date->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->kelurahan_code->Errors->Count());
        $errors = ($errors || $this->kecamatan_code->Errors->Count());
        $errors = ($errors || $this->kota_code->Errors->Count());
        $errors = ($errors || $this->p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->p_region_id_kecamatan->Errors->Count());
        $errors = ($errors || $this->p_region_id->Errors->Count());
        $errors = ($errors || $this->kelurahan_own_code->Errors->Count());
        $errors = ($errors || $this->kecamatan_own_code->Errors->Count());
        $errors = ($errors || $this->kota_own_code->Errors->Count());
        $errors = ($errors || $this->p_region_id_kel_owner->Errors->Count());
        $errors = ($errors || $this->p_region_id_kec_owner->Errors->Count());
        $errors = ($errors || $this->p_region_id_owner->Errors->Count());
        $errors = ($errors || $this->company_name->Errors->Count());
        $errors = ($errors || $this->address_name->Errors->Count());
        $errors = ($errors || $this->job_position_code->Errors->Count());
        $errors = ($errors || $this->p_job_position_id->Errors->Count());
        $errors = ($errors || $this->company_brand->Errors->Count());
        $errors = ($errors || $this->address_no->Errors->Count());
        $errors = ($errors || $this->address_rt->Errors->Count());
        $errors = ($errors || $this->address_rw->Errors->Count());
        $errors = ($errors || $this->address_no_owner->Errors->Count());
        $errors = ($errors || $this->address_rt_owner->Errors->Count());
        $errors = ($errors || $this->address_rw_owner->Errors->Count());
        $errors = ($errors || $this->phone_no->Errors->Count());
        $errors = ($errors || $this->fax_no->Errors->Count());
        $errors = ($errors || $this->zip_code->Errors->Count());
        $errors = ($errors || $this->phone_no_owner->Errors->Count());
        $errors = ($errors || $this->company_owner->Errors->Count());
        $errors = ($errors || $this->mobile_no_owner->Errors->Count());
        $errors = ($errors || $this->fax_no_owner->Errors->Count());
        $errors = ($errors || $this->zip_code_owner->Errors->Count());
        $errors = ($errors || $this->mobile_no->Errors->Count());
        $errors = ($errors || $this->address_name_owner->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->rqst_type_code->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->company_additional_addr->Errors->Count());
        $errors = ($errors || $this->Label1->Errors->Count());
        $errors = ($errors || $this->p_hotel_grade_id->Errors->Count());
        $errors = ($errors || $this->p_rest_service_type_id->Errors->Count());
        $errors = ($errors || $this->p_entertaintment_type_id->Errors->Count());
        $errors = ($errors || $this->p_parking_classification_id->Errors->Count());
        $errors = ($errors || $this->validation_code->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
        $errors = ($errors || $this->Label3->Errors->Count());
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

//Operation Method @94-74DD38D9
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
            } else if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_registration_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "t_customer_order.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG")) . "&msg=berhasil";
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
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

//InsertRow Method @94-0A015F26
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->registration_date->SetValue($this->registration_date->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->p_region_id_kelurahan->SetValue($this->p_region_id_kelurahan->GetValue(true));
        $this->DataSource->p_region_id_kecamatan->SetValue($this->p_region_id_kecamatan->GetValue(true));
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->p_region_id_kel_owner->SetValue($this->p_region_id_kel_owner->GetValue(true));
        $this->DataSource->p_region_id_kec_owner->SetValue($this->p_region_id_kec_owner->GetValue(true));
        $this->DataSource->p_region_id_owner->SetValue($this->p_region_id_owner->GetValue(true));
        $this->DataSource->company_name->SetValue($this->company_name->GetValue(true));
        $this->DataSource->address_name->SetValue($this->address_name->GetValue(true));
        $this->DataSource->p_job_position_id->SetValue($this->p_job_position_id->GetValue(true));
        $this->DataSource->company_brand->SetValue($this->company_brand->GetValue(true));
        $this->DataSource->address_no->SetValue($this->address_no->GetValue(true));
        $this->DataSource->address_rt->SetValue($this->address_rt->GetValue(true));
        $this->DataSource->address_rw->SetValue($this->address_rw->GetValue(true));
        $this->DataSource->address_no_owner->SetValue($this->address_no_owner->GetValue(true));
        $this->DataSource->address_rt_owner->SetValue($this->address_rt_owner->GetValue(true));
        $this->DataSource->address_rw_owner->SetValue($this->address_rw_owner->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->fax_no->SetValue($this->fax_no->GetValue(true));
        $this->DataSource->zip_code->SetValue($this->zip_code->GetValue(true));
        $this->DataSource->phone_no_owner->SetValue($this->phone_no_owner->GetValue(true));
        $this->DataSource->company_owner->SetValue($this->company_owner->GetValue(true));
        $this->DataSource->mobile_no_owner->SetValue($this->mobile_no_owner->GetValue(true));
        $this->DataSource->fax_no_owner->SetValue($this->fax_no_owner->GetValue(true));
        $this->DataSource->zip_code_owner->SetValue($this->zip_code_owner->GetValue(true));
        $this->DataSource->mobile_no->SetValue($this->mobile_no->GetValue(true));
        $this->DataSource->address_name_owner->SetValue($this->address_name_owner->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->company_additional_addr->SetValue($this->company_additional_addr->GetValue(true));
        $this->DataSource->p_hotel_grade_id->SetValue($this->p_hotel_grade_id->GetValue(true));
        $this->DataSource->p_rest_service_type_id->SetValue($this->p_rest_service_type_id->GetValue(true));
        $this->DataSource->p_entertaintment_type_id->SetValue($this->p_entertaintment_type_id->GetValue(true));
        $this->DataSource->p_parking_classification_id->SetValue($this->p_parking_classification_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-AEEE616E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->registration_date->SetValue($this->registration_date->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->p_region_id_kelurahan->SetValue($this->p_region_id_kelurahan->GetValue(true));
        $this->DataSource->p_region_id_kecamatan->SetValue($this->p_region_id_kecamatan->GetValue(true));
        $this->DataSource->p_region_id->SetValue($this->p_region_id->GetValue(true));
        $this->DataSource->p_region_id_kel_owner->SetValue($this->p_region_id_kel_owner->GetValue(true));
        $this->DataSource->p_region_id_kec_owner->SetValue($this->p_region_id_kec_owner->GetValue(true));
        $this->DataSource->p_region_id_owner->SetValue($this->p_region_id_owner->GetValue(true));
        $this->DataSource->company_name->SetValue($this->company_name->GetValue(true));
        $this->DataSource->address_name->SetValue($this->address_name->GetValue(true));
        $this->DataSource->p_job_position_id->SetValue($this->p_job_position_id->GetValue(true));
        $this->DataSource->company_brand->SetValue($this->company_brand->GetValue(true));
        $this->DataSource->address_no->SetValue($this->address_no->GetValue(true));
        $this->DataSource->address_rt->SetValue($this->address_rt->GetValue(true));
        $this->DataSource->address_rw->SetValue($this->address_rw->GetValue(true));
        $this->DataSource->address_no_owner->SetValue($this->address_no_owner->GetValue(true));
        $this->DataSource->address_rt_owner->SetValue($this->address_rt_owner->GetValue(true));
        $this->DataSource->address_rw_owner->SetValue($this->address_rw_owner->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->fax_no->SetValue($this->fax_no->GetValue(true));
        $this->DataSource->zip_code->SetValue($this->zip_code->GetValue(true));
        $this->DataSource->phone_no_owner->SetValue($this->phone_no_owner->GetValue(true));
        $this->DataSource->company_owner->SetValue($this->company_owner->GetValue(true));
        $this->DataSource->mobile_no_owner->SetValue($this->mobile_no_owner->GetValue(true));
        $this->DataSource->fax_no_owner->SetValue($this->fax_no_owner->GetValue(true));
        $this->DataSource->zip_code_owner->SetValue($this->zip_code_owner->GetValue(true));
        $this->DataSource->mobile_no->SetValue($this->mobile_no->GetValue(true));
        $this->DataSource->address_name_owner->SetValue($this->address_name_owner->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->company_additional_addr->SetValue($this->company_additional_addr->GetValue(true));
        $this->DataSource->p_hotel_grade_id->SetValue($this->p_hotel_grade_id->GetValue(true));
        $this->DataSource->p_rest_service_type_id->SetValue($this->p_rest_service_type_id->GetValue(true));
        $this->DataSource->p_entertaintment_type_id->SetValue($this->p_entertaintment_type_id->GetValue(true));
        $this->DataSource->p_parking_classification_id->SetValue($this->p_parking_classification_id->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-125C2F1A
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-565BC1E3
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
                    $this->registration_date->SetValue($this->DataSource->registration_date->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->kelurahan_code->SetValue($this->DataSource->kelurahan_code->GetValue());
                    $this->kecamatan_code->SetValue($this->DataSource->kecamatan_code->GetValue());
                    $this->kota_code->SetValue($this->DataSource->kota_code->GetValue());
                    $this->p_region_id_kelurahan->SetValue($this->DataSource->p_region_id_kelurahan->GetValue());
                    $this->p_region_id_kecamatan->SetValue($this->DataSource->p_region_id_kecamatan->GetValue());
                    $this->p_region_id->SetValue($this->DataSource->p_region_id->GetValue());
                    $this->kelurahan_own_code->SetValue($this->DataSource->kelurahan_own_code->GetValue());
                    $this->kecamatan_own_code->SetValue($this->DataSource->kecamatan_own_code->GetValue());
                    $this->kota_own_code->SetValue($this->DataSource->kota_own_code->GetValue());
                    $this->p_region_id_kel_owner->SetValue($this->DataSource->p_region_id_kel_owner->GetValue());
                    $this->p_region_id_kec_owner->SetValue($this->DataSource->p_region_id_kec_owner->GetValue());
                    $this->p_region_id_owner->SetValue($this->DataSource->p_region_id_owner->GetValue());
                    $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                    $this->address_name->SetValue($this->DataSource->address_name->GetValue());
                    $this->job_position_code->SetValue($this->DataSource->job_position_code->GetValue());
                    $this->p_job_position_id->SetValue($this->DataSource->p_job_position_id->GetValue());
                    $this->company_brand->SetValue($this->DataSource->company_brand->GetValue());
                    $this->address_no->SetValue($this->DataSource->address_no->GetValue());
                    $this->address_rt->SetValue($this->DataSource->address_rt->GetValue());
                    $this->address_rw->SetValue($this->DataSource->address_rw->GetValue());
                    $this->address_no_owner->SetValue($this->DataSource->address_no_owner->GetValue());
                    $this->address_rt_owner->SetValue($this->DataSource->address_rt_owner->GetValue());
                    $this->address_rw_owner->SetValue($this->DataSource->address_rw_owner->GetValue());
                    $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
                    $this->fax_no->SetValue($this->DataSource->fax_no->GetValue());
                    $this->zip_code->SetValue($this->DataSource->zip_code->GetValue());
                    $this->phone_no_owner->SetValue($this->DataSource->phone_no_owner->GetValue());
                    $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                    $this->mobile_no_owner->SetValue($this->DataSource->mobile_no_owner->GetValue());
                    $this->fax_no_owner->SetValue($this->DataSource->fax_no_owner->GetValue());
                    $this->zip_code_owner->SetValue($this->DataSource->zip_code_owner->GetValue());
                    $this->mobile_no->SetValue($this->DataSource->mobile_no->GetValue());
                    $this->address_name_owner->SetValue($this->DataSource->address_name_owner->GetValue());
                    $this->email->SetValue($this->DataSource->email->GetValue());
                    $this->company_additional_addr->SetValue($this->DataSource->company_additional_addr->GetValue());
                    $this->p_hotel_grade_id->SetValue($this->DataSource->p_hotel_grade_id->GetValue());
                    $this->p_rest_service_type_id->SetValue($this->DataSource->p_rest_service_type_id->GetValue());
                    $this->p_entertaintment_type_id->SetValue($this->DataSource->p_entertaintment_type_id->GetValue());
                    $this->p_parking_classification_id->SetValue($this->DataSource->p_parking_classification_id->GetValue());
                    $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->registration_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kelurahan_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kecamatan_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kota_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kelurahan_own_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kecamatan_own_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->kota_own_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kel_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_kec_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_region_id_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->job_position_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_job_position_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_brand->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rt_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_rw_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rqst_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->company_additional_addr->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_hotel_grade_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rest_service_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_entertaintment_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_parking_classification_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->validation_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_registration_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label3->Errors->ToString());
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
        $this->registration_date->Show();
        $this->t_customer_order_id->Show();
        $this->kelurahan_code->Show();
        $this->kecamatan_code->Show();
        $this->kota_code->Show();
        $this->p_region_id_kelurahan->Show();
        $this->p_region_id_kecamatan->Show();
        $this->p_region_id->Show();
        $this->kelurahan_own_code->Show();
        $this->kecamatan_own_code->Show();
        $this->kota_own_code->Show();
        $this->p_region_id_kel_owner->Show();
        $this->p_region_id_kec_owner->Show();
        $this->p_region_id_owner->Show();
        $this->company_name->Show();
        $this->address_name->Show();
        $this->job_position_code->Show();
        $this->p_job_position_id->Show();
        $this->company_brand->Show();
        $this->address_no->Show();
        $this->address_rt->Show();
        $this->address_rw->Show();
        $this->address_no_owner->Show();
        $this->address_rt_owner->Show();
        $this->address_rw_owner->Show();
        $this->phone_no->Show();
        $this->fax_no->Show();
        $this->zip_code->Show();
        $this->phone_no_owner->Show();
        $this->company_owner->Show();
        $this->mobile_no_owner->Show();
        $this->fax_no_owner->Show();
        $this->zip_code_owner->Show();
        $this->mobile_no->Show();
        $this->address_name_owner->Show();
        $this->p_rqst_type_id->Show();
        $this->rqst_type_code->Show();
        $this->email->Show();
        $this->company_additional_addr->Show();
        $this->Label1->Show();
        $this->p_hotel_grade_id->Show();
        $this->p_rest_service_type_id->Show();
        $this->p_entertaintment_type_id->Show();
        $this->p_parking_classification_id->Show();
        $this->Button1->Show();
        $this->validation_code->Show();
        $this->t_vat_registration_id->Show();
        $this->Label3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_registrationForm Class @94-FCB6E20C

class clst_vat_registrationFormDataSource extends clsDBConnSIKP {  //t_vat_registrationFormDataSource Class @94-5993B12E

//DataSource Variables @94-2574D80E
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $order_no;
    var $registration_date;
    var $t_customer_order_id;
    var $kelurahan_code;
    var $kecamatan_code;
    var $kota_code;
    var $p_region_id_kelurahan;
    var $p_region_id_kecamatan;
    var $p_region_id;
    var $kelurahan_own_code;
    var $kecamatan_own_code;
    var $kota_own_code;
    var $p_region_id_kel_owner;
    var $p_region_id_kec_owner;
    var $p_region_id_owner;
    var $company_name;
    var $address_name;
    var $job_position_code;
    var $p_job_position_id;
    var $company_brand;
    var $address_no;
    var $address_rt;
    var $address_rw;
    var $address_no_owner;
    var $address_rt_owner;
    var $address_rw_owner;
    var $phone_no;
    var $fax_no;
    var $zip_code;
    var $phone_no_owner;
    var $company_owner;
    var $mobile_no_owner;
    var $fax_no_owner;
    var $zip_code_owner;
    var $mobile_no;
    var $address_name_owner;
    var $p_rqst_type_id;
    var $rqst_type_code;
    var $email;
    var $company_additional_addr;
    var $Label1;
    var $p_hotel_grade_id;
    var $p_rest_service_type_id;
    var $p_entertaintment_type_id;
    var $p_parking_classification_id;
    var $validation_code;
    var $t_vat_registration_id;
    var $Label3;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-392FE0EA
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
        
        $this->registration_date = new clsField("registration_date", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->kelurahan_code = new clsField("kelurahan_code", ccsText, "");
        
        $this->kecamatan_code = new clsField("kecamatan_code", ccsText, "");
        
        $this->kota_code = new clsField("kota_code", ccsText, "");
        
        $this->p_region_id_kelurahan = new clsField("p_region_id_kelurahan", ccsFloat, "");
        
        $this->p_region_id_kecamatan = new clsField("p_region_id_kecamatan", ccsFloat, "");
        
        $this->p_region_id = new clsField("p_region_id", ccsFloat, "");
        
        $this->kelurahan_own_code = new clsField("kelurahan_own_code", ccsText, "");
        
        $this->kecamatan_own_code = new clsField("kecamatan_own_code", ccsText, "");
        
        $this->kota_own_code = new clsField("kota_own_code", ccsText, "");
        
        $this->p_region_id_kel_owner = new clsField("p_region_id_kel_owner", ccsFloat, "");
        
        $this->p_region_id_kec_owner = new clsField("p_region_id_kec_owner", ccsFloat, "");
        
        $this->p_region_id_owner = new clsField("p_region_id_owner", ccsFloat, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->address_name = new clsField("address_name", ccsText, "");
        
        $this->job_position_code = new clsField("job_position_code", ccsText, "");
        
        $this->p_job_position_id = new clsField("p_job_position_id", ccsFloat, "");
        
        $this->company_brand = new clsField("company_brand", ccsText, "");
        
        $this->address_no = new clsField("address_no", ccsText, "");
        
        $this->address_rt = new clsField("address_rt", ccsText, "");
        
        $this->address_rw = new clsField("address_rw", ccsText, "");
        
        $this->address_no_owner = new clsField("address_no_owner", ccsText, "");
        
        $this->address_rt_owner = new clsField("address_rt_owner", ccsText, "");
        
        $this->address_rw_owner = new clsField("address_rw_owner", ccsText, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->fax_no = new clsField("fax_no", ccsText, "");
        
        $this->zip_code = new clsField("zip_code", ccsText, "");
        
        $this->phone_no_owner = new clsField("phone_no_owner", ccsText, "");
        
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->mobile_no_owner = new clsField("mobile_no_owner", ccsText, "");
        
        $this->fax_no_owner = new clsField("fax_no_owner", ccsText, "");
        
        $this->zip_code_owner = new clsField("zip_code_owner", ccsText, "");
        
        $this->mobile_no = new clsField("mobile_no", ccsText, "");
        
        $this->address_name_owner = new clsField("address_name_owner", ccsText, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->rqst_type_code = new clsField("rqst_type_code", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->company_additional_addr = new clsField("company_additional_addr", ccsText, "");
        
        $this->Label1 = new clsField("Label1", ccsText, "");
        
        $this->p_hotel_grade_id = new clsField("p_hotel_grade_id", ccsFloat, "");
        
        $this->p_rest_service_type_id = new clsField("p_rest_service_type_id", ccsFloat, "");
        
        $this->p_entertaintment_type_id = new clsField("p_entertaintment_type_id", ccsFloat, "");
        
        $this->p_parking_classification_id = new clsField("p_parking_classification_id", ccsFloat, "");
        
        $this->validation_code = new clsField("validation_code", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->Label3 = new clsField("Label3", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-B866E959
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_order_id", ccsFloat, "", "", $this->Parameters["urlt_customer_order_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_customer_order_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @94-2A76B94C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_registration {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-E7DAE7B6
    function SetValues()
    {
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->registration_date->SetDBValue($this->f("registration_date"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->kelurahan_code->SetDBValue($this->f("kelurahan_code"));
        $this->kecamatan_code->SetDBValue($this->f("kecamatan_code"));
        $this->kota_code->SetDBValue($this->f("kota_code"));
        $this->p_region_id_kelurahan->SetDBValue(trim($this->f("p_region_id_kelurahan")));
        $this->p_region_id_kecamatan->SetDBValue(trim($this->f("p_region_id_kecamatan")));
        $this->p_region_id->SetDBValue(trim($this->f("p_region_id")));
        $this->kelurahan_own_code->SetDBValue($this->f("kelurahan_own_code"));
        $this->kecamatan_own_code->SetDBValue($this->f("kecamatan_own_code"));
        $this->kota_own_code->SetDBValue($this->f("kota_own_code"));
        $this->p_region_id_kel_owner->SetDBValue(trim($this->f("p_region_id_kel_owner")));
        $this->p_region_id_kec_owner->SetDBValue(trim($this->f("p_region_id_kec_owner")));
        $this->p_region_id_owner->SetDBValue(trim($this->f("p_region_id_owner")));
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->address_name->SetDBValue($this->f("address_name"));
        $this->job_position_code->SetDBValue($this->f("job_position_code"));
        $this->p_job_position_id->SetDBValue(trim($this->f("p_job_position_id")));
        $this->company_brand->SetDBValue($this->f("company_brand"));
        $this->address_no->SetDBValue($this->f("address_no"));
        $this->address_rt->SetDBValue($this->f("address_rt"));
        $this->address_rw->SetDBValue($this->f("address_rw"));
        $this->address_no_owner->SetDBValue($this->f("address_no_owner"));
        $this->address_rt_owner->SetDBValue($this->f("address_rt_owner"));
        $this->address_rw_owner->SetDBValue($this->f("address_rw_owner"));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->fax_no->SetDBValue($this->f("fax_no"));
        $this->zip_code->SetDBValue($this->f("zip_code"));
        $this->phone_no_owner->SetDBValue($this->f("phone_no_owner"));
        $this->company_owner->SetDBValue($this->f("company_owner"));
        $this->mobile_no_owner->SetDBValue($this->f("mobile_no_owner"));
        $this->fax_no_owner->SetDBValue($this->f("fax_no_owner"));
        $this->zip_code_owner->SetDBValue($this->f("zip_code_owner"));
        $this->mobile_no->SetDBValue($this->f("mobile_no"));
        $this->address_name_owner->SetDBValue($this->f("address_name_owner"));
        $this->email->SetDBValue($this->f("email"));
        $this->company_additional_addr->SetDBValue($this->f("company_additional_addr"));
        $this->p_hotel_grade_id->SetDBValue(trim($this->f("p_hotel_grade_id")));
        $this->p_rest_service_type_id->SetDBValue(trim($this->f("p_rest_service_type_id")));
        $this->p_entertaintment_type_id->SetDBValue(trim($this->f("p_entertaintment_type_id")));
        $this->p_parking_classification_id->SetDBValue(trim($this->f("p_parking_classification_id")));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

//Insert Method @94-8320B2E5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["created_by"] = new clsSQLParameter("expr695", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr696", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["registration_date"] = new clsSQLParameter("ctrlregistration_date", ccsText, "", "", $this->registration_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kelurahan"] = new clsSQLParameter("ctrlp_region_id_kelurahan", ccsFloat, "", "", $this->p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kecamatan"] = new clsSQLParameter("ctrlp_region_id_kecamatan", ccsFloat, "", "", $this->p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kel_owner"] = new clsSQLParameter("ctrlp_region_id_kel_owner", ccsFloat, "", "", $this->p_region_id_kel_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kec_owner"] = new clsSQLParameter("ctrlp_region_id_kec_owner", ccsFloat, "", "", $this->p_region_id_kec_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_owner"] = new clsSQLParameter("ctrlp_region_id_owner", ccsFloat, "", "", $this->p_region_id_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_name"] = new clsSQLParameter("ctrlcompany_name", ccsText, "", "", $this->company_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_job_position_id"] = new clsSQLParameter("ctrlp_job_position_id", ccsFloat, "", "", $this->p_job_position_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_brand"] = new clsSQLParameter("ctrlcompany_brand", ccsText, "", "", $this->company_brand->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no_owner"] = new clsSQLParameter("ctrladdress_no_owner", ccsText, "", "", $this->address_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt_owner"] = new clsSQLParameter("ctrladdress_rt_owner", ccsText, "", "", $this->address_rt_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw_owner"] = new clsSQLParameter("ctrladdress_rw_owner", ccsText, "", "", $this->address_rw_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no_owner"] = new clsSQLParameter("ctrlphone_no_owner", ccsText, "", "", $this->phone_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_owner"] = new clsSQLParameter("ctrlcompany_owner", ccsText, "", "", $this->company_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no_owner"] = new clsSQLParameter("ctrlmobile_no_owner", ccsText, "", "", $this->mobile_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no_owner"] = new clsSQLParameter("ctrlfax_no_owner", ccsText, "", "", $this->fax_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code_owner"] = new clsSQLParameter("ctrlzip_code_owner", ccsText, "", "", $this->zip_code_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name_owner"] = new clsSQLParameter("ctrladdress_name_owner", ccsText, "", "", $this->address_name_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_vat_registration_id"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["email"] = new clsSQLParameter("ctrlemail", ccsText, "", "", $this->email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_additional_addr"] = new clsSQLParameter("ctrlcompany_additional_addr", ccsText, "", "", $this->company_additional_addr->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_hotel_grade_id"] = new clsSQLParameter("ctrlp_hotel_grade_id", ccsFloat, "", "", $this->p_hotel_grade_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_rest_service_type_id"] = new clsSQLParameter("ctrlp_rest_service_type_id", ccsFloat, "", "", $this->p_rest_service_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_entertaintment_type_id"] = new clsSQLParameter("ctrlp_entertaintment_type_id", ccsFloat, "", "", $this->p_entertaintment_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_parking_classification_id"] = new clsSQLParameter("ctrlp_parking_classification_id", ccsFloat, "", "", $this->p_parking_classification_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["registration_date"]->GetValue()) and !strlen($this->cp["registration_date"]->GetText()) and !is_bool($this->cp["registration_date"]->GetValue())) 
            $this->cp["registration_date"]->SetValue($this->registration_date->GetValue(true));
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!is_null($this->cp["p_region_id_kelurahan"]->GetValue()) and !strlen($this->cp["p_region_id_kelurahan"]->GetText()) and !is_bool($this->cp["p_region_id_kelurahan"]->GetValue())) 
            $this->cp["p_region_id_kelurahan"]->SetValue($this->p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["p_region_id_kecamatan"]->GetValue()) and !strlen($this->cp["p_region_id_kecamatan"]->GetText()) and !is_bool($this->cp["p_region_id_kecamatan"]->GetValue())) 
            $this->cp["p_region_id_kecamatan"]->SetValue($this->p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["p_region_id_kel_owner"]->GetValue()) and !strlen($this->cp["p_region_id_kel_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kel_owner"]->GetValue())) 
            $this->cp["p_region_id_kel_owner"]->SetValue($this->p_region_id_kel_owner->GetValue(true));
        if (!is_null($this->cp["p_region_id_kec_owner"]->GetValue()) and !strlen($this->cp["p_region_id_kec_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kec_owner"]->GetValue())) 
            $this->cp["p_region_id_kec_owner"]->SetValue($this->p_region_id_kec_owner->GetValue(true));
        if (!is_null($this->cp["p_region_id_owner"]->GetValue()) and !strlen($this->cp["p_region_id_owner"]->GetText()) and !is_bool($this->cp["p_region_id_owner"]->GetValue())) 
            $this->cp["p_region_id_owner"]->SetValue($this->p_region_id_owner->GetValue(true));
        if (!is_null($this->cp["company_name"]->GetValue()) and !strlen($this->cp["company_name"]->GetText()) and !is_bool($this->cp["company_name"]->GetValue())) 
            $this->cp["company_name"]->SetValue($this->company_name->GetValue(true));
        if (!is_null($this->cp["address_name"]->GetValue()) and !strlen($this->cp["address_name"]->GetText()) and !is_bool($this->cp["address_name"]->GetValue())) 
            $this->cp["address_name"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["p_job_position_id"]->GetValue()) and !strlen($this->cp["p_job_position_id"]->GetText()) and !is_bool($this->cp["p_job_position_id"]->GetValue())) 
            $this->cp["p_job_position_id"]->SetValue($this->p_job_position_id->GetValue(true));
        if (!is_null($this->cp["company_brand"]->GetValue()) and !strlen($this->cp["company_brand"]->GetText()) and !is_bool($this->cp["company_brand"]->GetValue())) 
            $this->cp["company_brand"]->SetValue($this->company_brand->GetValue(true));
        if (!is_null($this->cp["address_no"]->GetValue()) and !strlen($this->cp["address_no"]->GetText()) and !is_bool($this->cp["address_no"]->GetValue())) 
            $this->cp["address_no"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["address_rt"]->GetValue()) and !strlen($this->cp["address_rt"]->GetText()) and !is_bool($this->cp["address_rt"]->GetValue())) 
            $this->cp["address_rt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["address_rw"]->GetValue()) and !strlen($this->cp["address_rw"]->GetText()) and !is_bool($this->cp["address_rw"]->GetValue())) 
            $this->cp["address_rw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["address_no_owner"]->GetValue()) and !strlen($this->cp["address_no_owner"]->GetText()) and !is_bool($this->cp["address_no_owner"]->GetValue())) 
            $this->cp["address_no_owner"]->SetValue($this->address_no_owner->GetValue(true));
        if (!is_null($this->cp["address_rt_owner"]->GetValue()) and !strlen($this->cp["address_rt_owner"]->GetText()) and !is_bool($this->cp["address_rt_owner"]->GetValue())) 
            $this->cp["address_rt_owner"]->SetValue($this->address_rt_owner->GetValue(true));
        if (!is_null($this->cp["address_rw_owner"]->GetValue()) and !strlen($this->cp["address_rw_owner"]->GetText()) and !is_bool($this->cp["address_rw_owner"]->GetValue())) 
            $this->cp["address_rw_owner"]->SetValue($this->address_rw_owner->GetValue(true));
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["fax_no"]->GetValue()) and !strlen($this->cp["fax_no"]->GetText()) and !is_bool($this->cp["fax_no"]->GetValue())) 
            $this->cp["fax_no"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zip_code"]->GetValue()) and !strlen($this->cp["zip_code"]->GetText()) and !is_bool($this->cp["zip_code"]->GetValue())) 
            $this->cp["zip_code"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["phone_no_owner"]->GetValue()) and !strlen($this->cp["phone_no_owner"]->GetText()) and !is_bool($this->cp["phone_no_owner"]->GetValue())) 
            $this->cp["phone_no_owner"]->SetValue($this->phone_no_owner->GetValue(true));
        if (!is_null($this->cp["company_owner"]->GetValue()) and !strlen($this->cp["company_owner"]->GetText()) and !is_bool($this->cp["company_owner"]->GetValue())) 
            $this->cp["company_owner"]->SetValue($this->company_owner->GetValue(true));
        if (!is_null($this->cp["mobile_no_owner"]->GetValue()) and !strlen($this->cp["mobile_no_owner"]->GetText()) and !is_bool($this->cp["mobile_no_owner"]->GetValue())) 
            $this->cp["mobile_no_owner"]->SetValue($this->mobile_no_owner->GetValue(true));
        if (!is_null($this->cp["fax_no_owner"]->GetValue()) and !strlen($this->cp["fax_no_owner"]->GetText()) and !is_bool($this->cp["fax_no_owner"]->GetValue())) 
            $this->cp["fax_no_owner"]->SetValue($this->fax_no_owner->GetValue(true));
        if (!is_null($this->cp["zip_code_owner"]->GetValue()) and !strlen($this->cp["zip_code_owner"]->GetText()) and !is_bool($this->cp["zip_code_owner"]->GetValue())) 
            $this->cp["zip_code_owner"]->SetValue($this->zip_code_owner->GetValue(true));
        if (!is_null($this->cp["mobile_no"]->GetValue()) and !strlen($this->cp["mobile_no"]->GetText()) and !is_bool($this->cp["mobile_no"]->GetValue())) 
            $this->cp["mobile_no"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["address_name_owner"]->GetValue()) and !strlen($this->cp["address_name_owner"]->GetText()) and !is_bool($this->cp["address_name_owner"]->GetValue())) 
            $this->cp["address_name_owner"]->SetValue($this->address_name_owner->GetValue(true));
        if (!is_null($this->cp["t_vat_registration_id"]->GetValue()) and !strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue())) 
            $this->cp["t_vat_registration_id"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!is_null($this->cp["email"]->GetValue()) and !strlen($this->cp["email"]->GetText()) and !is_bool($this->cp["email"]->GetValue())) 
            $this->cp["email"]->SetValue($this->email->GetValue(true));
        if (!is_null($this->cp["company_additional_addr"]->GetValue()) and !strlen($this->cp["company_additional_addr"]->GetText()) and !is_bool($this->cp["company_additional_addr"]->GetValue())) 
            $this->cp["company_additional_addr"]->SetValue($this->company_additional_addr->GetValue(true));
        if (!is_null($this->cp["p_hotel_grade_id"]->GetValue()) and !strlen($this->cp["p_hotel_grade_id"]->GetText()) and !is_bool($this->cp["p_hotel_grade_id"]->GetValue())) 
            $this->cp["p_hotel_grade_id"]->SetValue($this->p_hotel_grade_id->GetValue(true));
        if (!strlen($this->cp["p_hotel_grade_id"]->GetText()) and !is_bool($this->cp["p_hotel_grade_id"]->GetValue(true))) 
            $this->cp["p_hotel_grade_id"]->SetText(0);
        if (!is_null($this->cp["p_rest_service_type_id"]->GetValue()) and !strlen($this->cp["p_rest_service_type_id"]->GetText()) and !is_bool($this->cp["p_rest_service_type_id"]->GetValue())) 
            $this->cp["p_rest_service_type_id"]->SetValue($this->p_rest_service_type_id->GetValue(true));
        if (!strlen($this->cp["p_rest_service_type_id"]->GetText()) and !is_bool($this->cp["p_rest_service_type_id"]->GetValue(true))) 
            $this->cp["p_rest_service_type_id"]->SetText(0);
        if (!is_null($this->cp["p_entertaintment_type_id"]->GetValue()) and !strlen($this->cp["p_entertaintment_type_id"]->GetText()) and !is_bool($this->cp["p_entertaintment_type_id"]->GetValue())) 
            $this->cp["p_entertaintment_type_id"]->SetValue($this->p_entertaintment_type_id->GetValue(true));
        if (!strlen($this->cp["p_entertaintment_type_id"]->GetText()) and !is_bool($this->cp["p_entertaintment_type_id"]->GetValue(true))) 
            $this->cp["p_entertaintment_type_id"]->SetText(0);
        if (!is_null($this->cp["p_parking_classification_id"]->GetValue()) and !strlen($this->cp["p_parking_classification_id"]->GetText()) and !is_bool($this->cp["p_parking_classification_id"]->GetValue())) 
            $this->cp["p_parking_classification_id"]->SetValue($this->p_parking_classification_id->GetValue(true));
        if (!strlen($this->cp["p_parking_classification_id"]->GetText()) and !is_bool($this->cp["p_parking_classification_id"]->GetValue(true))) 
            $this->cp["p_parking_classification_id"]->SetText(0);
        $this->SQL = "INSERT INTO t_vat_registration(t_vat_registration_id, created_by, updated_by, creation_date, updated_date, registration_date, \n" .
        "t_customer_order_id, p_region_id_kelurahan, p_region_id_kecamatan, p_region_id, \n" .
        "p_region_id_kel_owner, p_region_id_kec_owner, p_region_id_owner, company_name, address_name, \n" .
        "p_job_position_id, company_brand, address_no, address_rt, address_rw, address_no_owner, address_rt_owner, \n" .
        "address_rw_owner, phone_no, fax_no, zip_code, phone_no_owner, company_owner, mobile_no_owner, \n" .
        "fax_no_owner, zip_code_owner, mobile_no, address_name_owner, email, company_additional_addr, p_hotel_grade_id, p_rest_service_type_id, p_entertaintment_type_id, p_parking_classification_id) \n" .
        "VALUES(generate_id('sikp','t_vat_registration','t_vat_registration_id'), '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, to_date('" . $this->SQLValue($this->cp["registration_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY HH24:MI:SS'), \n" .
        "" . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_region_id_kelurahan"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_region_id_kecamatan"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["p_region_id_kel_owner"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_region_id_kec_owner"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_region_id_owner"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["company_name"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_name"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["p_job_position_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["company_brand"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_rt"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_rw"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_no_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_rt_owner"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["address_rw_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["fax_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["zip_code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["phone_no_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["company_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["mobile_no_owner"]->GetDBValue(), ccsText) . "', \n" .
        "'" . $this->SQLValue($this->cp["fax_no_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["zip_code_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["mobile_no"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["address_name_owner"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["email"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["company_additional_addr"]->GetDBValue(), ccsText) . "', \n" .
        "decode(" . $this->SQLValue($this->cp["p_hotel_grade_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_hotel_grade_id"]->GetDBValue(), ccsFloat) . "), decode(" . $this->SQLValue($this->cp["p_rest_service_type_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_rest_service_type_id"]->GetDBValue(), ccsFloat) . "), decode(" . $this->SQLValue($this->cp["p_entertaintment_type_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_entertaintment_type_id"]->GetDBValue(), ccsFloat) . "), decode(" . $this->SQLValue($this->cp["p_parking_classification_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_parking_classification_id"]->GetDBValue(), ccsFloat) . "))";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        $idds="select LPAD(generate_id('sikp','t_vat_registration','t_vat_registration_id'),10,'0')as idd from dual";
		$this->query($idds);
		while($this->next_record()){
			$codeDB = $this->f("idd");
		}
		
		$code = CCGetFromPost("validation_code","");
		
		if($code == $codeDB){
	        if($this->Errors->Count() == 0 && $this->CmdExecution) {
	            $this->query($this->SQL);
	            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
	        }
		}else if(empty($code)){
			$this->Errors->addError("Kode Verifikasi Belum Diisi");			
		}else{
			$this->Errors->addError("Kode Verifikasi Salah");			
		}
    }
//End Insert Method


//Update Method @94-FBE786ED
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr780", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["registration_date"] = new clsSQLParameter("ctrlregistration_date", ccsText, "", "", $this->registration_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_region_id_kelurahan"] = new clsSQLParameter("ctrlp_region_id_kelurahan", ccsFloat, "", "", $this->p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kecamatan"] = new clsSQLParameter("ctrlp_region_id_kecamatan", ccsFloat, "", "", $this->p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kel_owner"] = new clsSQLParameter("ctrlp_region_id_kel_owner", ccsFloat, "", "", $this->p_region_id_kel_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_kec_owner"] = new clsSQLParameter("ctrlp_region_id_kec_owner", ccsFloat, "", "", $this->p_region_id_kec_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_region_id_owner"] = new clsSQLParameter("ctrlp_region_id_owner", ccsFloat, "", "", $this->p_region_id_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_name"] = new clsSQLParameter("ctrlcompany_name", ccsText, "", "", $this->company_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_job_position_id"] = new clsSQLParameter("ctrlp_job_position_id", ccsFloat, "", "", $this->p_job_position_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_brand"] = new clsSQLParameter("ctrlcompany_brand", ccsText, "", "", $this->company_brand->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_no_owner"] = new clsSQLParameter("ctrladdress_no_owner", ccsText, "", "", $this->address_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rt_owner"] = new clsSQLParameter("ctrladdress_rt_owner", ccsText, "", "", $this->address_rt_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_rw_owner"] = new clsSQLParameter("ctrladdress_rw_owner", ccsText, "", "", $this->address_rw_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no_owner"] = new clsSQLParameter("ctrlphone_no_owner", ccsText, "", "", $this->phone_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_owner"] = new clsSQLParameter("ctrlcompany_owner", ccsText, "", "", $this->company_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no_owner"] = new clsSQLParameter("ctrlmobile_no_owner", ccsText, "", "", $this->mobile_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fax_no_owner"] = new clsSQLParameter("ctrlfax_no_owner", ccsText, "", "", $this->fax_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zip_code_owner"] = new clsSQLParameter("ctrlzip_code_owner", ccsText, "", "", $this->zip_code_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_no"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["address_name_owner"] = new clsSQLParameter("ctrladdress_name_owner", ccsText, "", "", $this->address_name_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["t_vat_registration_id"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["email"] = new clsSQLParameter("ctrlemail", ccsText, "", "", $this->email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["company_additional_addr"] = new clsSQLParameter("ctrlcompany_additional_addr", ccsText, "", "", $this->company_additional_addr->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_hotel_grade_id"] = new clsSQLParameter("ctrlp_hotel_grade_id", ccsFloat, "", "", $this->p_hotel_grade_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_rest_service_type_id"] = new clsSQLParameter("ctrlp_rest_service_type_id", ccsFloat, "", "", $this->p_rest_service_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_entertaintment_type_id"] = new clsSQLParameter("ctrlp_entertaintment_type_id", ccsFloat, "", "", $this->p_entertaintment_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_parking_classification_id"] = new clsSQLParameter("ctrlp_parking_classification_id", ccsFloat, "", "", $this->p_parking_classification_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["registration_date"]->GetValue()) and !strlen($this->cp["registration_date"]->GetText()) and !is_bool($this->cp["registration_date"]->GetValue())) 
            $this->cp["registration_date"]->SetValue($this->registration_date->GetValue(true));
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue(true))) 
            $this->cp["t_customer_order_id"]->SetText(0);
        if (!is_null($this->cp["p_region_id_kelurahan"]->GetValue()) and !strlen($this->cp["p_region_id_kelurahan"]->GetText()) and !is_bool($this->cp["p_region_id_kelurahan"]->GetValue())) 
            $this->cp["p_region_id_kelurahan"]->SetValue($this->p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["p_region_id_kecamatan"]->GetValue()) and !strlen($this->cp["p_region_id_kecamatan"]->GetText()) and !is_bool($this->cp["p_region_id_kecamatan"]->GetValue())) 
            $this->cp["p_region_id_kecamatan"]->SetValue($this->p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["p_region_id"]->GetValue()) and !strlen($this->cp["p_region_id"]->GetText()) and !is_bool($this->cp["p_region_id"]->GetValue())) 
            $this->cp["p_region_id"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["p_region_id_kel_owner"]->GetValue()) and !strlen($this->cp["p_region_id_kel_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kel_owner"]->GetValue())) 
            $this->cp["p_region_id_kel_owner"]->SetValue($this->p_region_id_kel_owner->GetValue(true));
        if (!is_null($this->cp["p_region_id_kec_owner"]->GetValue()) and !strlen($this->cp["p_region_id_kec_owner"]->GetText()) and !is_bool($this->cp["p_region_id_kec_owner"]->GetValue())) 
            $this->cp["p_region_id_kec_owner"]->SetValue($this->p_region_id_kec_owner->GetValue(true));
        if (!is_null($this->cp["p_region_id_owner"]->GetValue()) and !strlen($this->cp["p_region_id_owner"]->GetText()) and !is_bool($this->cp["p_region_id_owner"]->GetValue())) 
            $this->cp["p_region_id_owner"]->SetValue($this->p_region_id_owner->GetValue(true));
        if (!is_null($this->cp["company_name"]->GetValue()) and !strlen($this->cp["company_name"]->GetText()) and !is_bool($this->cp["company_name"]->GetValue())) 
            $this->cp["company_name"]->SetValue($this->company_name->GetValue(true));
        if (!is_null($this->cp["address_name"]->GetValue()) and !strlen($this->cp["address_name"]->GetText()) and !is_bool($this->cp["address_name"]->GetValue())) 
            $this->cp["address_name"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["p_job_position_id"]->GetValue()) and !strlen($this->cp["p_job_position_id"]->GetText()) and !is_bool($this->cp["p_job_position_id"]->GetValue())) 
            $this->cp["p_job_position_id"]->SetValue($this->p_job_position_id->GetValue(true));
        if (!is_null($this->cp["company_brand"]->GetValue()) and !strlen($this->cp["company_brand"]->GetText()) and !is_bool($this->cp["company_brand"]->GetValue())) 
            $this->cp["company_brand"]->SetValue($this->company_brand->GetValue(true));
        if (!is_null($this->cp["address_no"]->GetValue()) and !strlen($this->cp["address_no"]->GetText()) and !is_bool($this->cp["address_no"]->GetValue())) 
            $this->cp["address_no"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["address_rt"]->GetValue()) and !strlen($this->cp["address_rt"]->GetText()) and !is_bool($this->cp["address_rt"]->GetValue())) 
            $this->cp["address_rt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["address_rw"]->GetValue()) and !strlen($this->cp["address_rw"]->GetText()) and !is_bool($this->cp["address_rw"]->GetValue())) 
            $this->cp["address_rw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["address_no_owner"]->GetValue()) and !strlen($this->cp["address_no_owner"]->GetText()) and !is_bool($this->cp["address_no_owner"]->GetValue())) 
            $this->cp["address_no_owner"]->SetValue($this->address_no_owner->GetValue(true));
        if (!is_null($this->cp["address_rt_owner"]->GetValue()) and !strlen($this->cp["address_rt_owner"]->GetText()) and !is_bool($this->cp["address_rt_owner"]->GetValue())) 
            $this->cp["address_rt_owner"]->SetValue($this->address_rt_owner->GetValue(true));
        if (!is_null($this->cp["address_rw_owner"]->GetValue()) and !strlen($this->cp["address_rw_owner"]->GetText()) and !is_bool($this->cp["address_rw_owner"]->GetValue())) 
            $this->cp["address_rw_owner"]->SetValue($this->address_rw_owner->GetValue(true));
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["fax_no"]->GetValue()) and !strlen($this->cp["fax_no"]->GetText()) and !is_bool($this->cp["fax_no"]->GetValue())) 
            $this->cp["fax_no"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zip_code"]->GetValue()) and !strlen($this->cp["zip_code"]->GetText()) and !is_bool($this->cp["zip_code"]->GetValue())) 
            $this->cp["zip_code"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["phone_no_owner"]->GetValue()) and !strlen($this->cp["phone_no_owner"]->GetText()) and !is_bool($this->cp["phone_no_owner"]->GetValue())) 
            $this->cp["phone_no_owner"]->SetValue($this->phone_no_owner->GetValue(true));
        if (!is_null($this->cp["company_owner"]->GetValue()) and !strlen($this->cp["company_owner"]->GetText()) and !is_bool($this->cp["company_owner"]->GetValue())) 
            $this->cp["company_owner"]->SetValue($this->company_owner->GetValue(true));
        if (!is_null($this->cp["mobile_no_owner"]->GetValue()) and !strlen($this->cp["mobile_no_owner"]->GetText()) and !is_bool($this->cp["mobile_no_owner"]->GetValue())) 
            $this->cp["mobile_no_owner"]->SetValue($this->mobile_no_owner->GetValue(true));
        if (!is_null($this->cp["fax_no_owner"]->GetValue()) and !strlen($this->cp["fax_no_owner"]->GetText()) and !is_bool($this->cp["fax_no_owner"]->GetValue())) 
            $this->cp["fax_no_owner"]->SetValue($this->fax_no_owner->GetValue(true));
        if (!is_null($this->cp["zip_code_owner"]->GetValue()) and !strlen($this->cp["zip_code_owner"]->GetText()) and !is_bool($this->cp["zip_code_owner"]->GetValue())) 
            $this->cp["zip_code_owner"]->SetValue($this->zip_code_owner->GetValue(true));
        if (!is_null($this->cp["mobile_no"]->GetValue()) and !strlen($this->cp["mobile_no"]->GetText()) and !is_bool($this->cp["mobile_no"]->GetValue())) 
            $this->cp["mobile_no"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["address_name_owner"]->GetValue()) and !strlen($this->cp["address_name_owner"]->GetText()) and !is_bool($this->cp["address_name_owner"]->GetValue())) 
            $this->cp["address_name_owner"]->SetValue($this->address_name_owner->GetValue(true));
        if (!is_null($this->cp["t_vat_registration_id"]->GetValue()) and !strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue())) 
            $this->cp["t_vat_registration_id"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue(true))) 
            $this->cp["t_vat_registration_id"]->SetText(0);
        if (!is_null($this->cp["email"]->GetValue()) and !strlen($this->cp["email"]->GetText()) and !is_bool($this->cp["email"]->GetValue())) 
            $this->cp["email"]->SetValue($this->email->GetValue(true));
        if (!is_null($this->cp["company_additional_addr"]->GetValue()) and !strlen($this->cp["company_additional_addr"]->GetText()) and !is_bool($this->cp["company_additional_addr"]->GetValue())) 
            $this->cp["company_additional_addr"]->SetValue($this->company_additional_addr->GetValue(true));
        if (!is_null($this->cp["p_hotel_grade_id"]->GetValue()) and !strlen($this->cp["p_hotel_grade_id"]->GetText()) and !is_bool($this->cp["p_hotel_grade_id"]->GetValue())) 
            $this->cp["p_hotel_grade_id"]->SetValue($this->p_hotel_grade_id->GetValue(true));
        if (!strlen($this->cp["p_hotel_grade_id"]->GetText()) and !is_bool($this->cp["p_hotel_grade_id"]->GetValue(true))) 
            $this->cp["p_hotel_grade_id"]->SetText(0);
        if (!is_null($this->cp["p_rest_service_type_id"]->GetValue()) and !strlen($this->cp["p_rest_service_type_id"]->GetText()) and !is_bool($this->cp["p_rest_service_type_id"]->GetValue())) 
            $this->cp["p_rest_service_type_id"]->SetValue($this->p_rest_service_type_id->GetValue(true));
        if (!strlen($this->cp["p_rest_service_type_id"]->GetText()) and !is_bool($this->cp["p_rest_service_type_id"]->GetValue(true))) 
            $this->cp["p_rest_service_type_id"]->SetText(0);
        if (!is_null($this->cp["p_entertaintment_type_id"]->GetValue()) and !strlen($this->cp["p_entertaintment_type_id"]->GetText()) and !is_bool($this->cp["p_entertaintment_type_id"]->GetValue())) 
            $this->cp["p_entertaintment_type_id"]->SetValue($this->p_entertaintment_type_id->GetValue(true));
        if (!strlen($this->cp["p_entertaintment_type_id"]->GetText()) and !is_bool($this->cp["p_entertaintment_type_id"]->GetValue(true))) 
            $this->cp["p_entertaintment_type_id"]->SetText(0);
        if (!is_null($this->cp["p_parking_classification_id"]->GetValue()) and !strlen($this->cp["p_parking_classification_id"]->GetText()) and !is_bool($this->cp["p_parking_classification_id"]->GetValue())) 
            $this->cp["p_parking_classification_id"]->SetValue($this->p_parking_classification_id->GetValue(true));
        if (!strlen($this->cp["p_parking_classification_id"]->GetText()) and !is_bool($this->cp["p_parking_classification_id"]->GetValue(true))) 
            $this->cp["p_parking_classification_id"]->SetText(0);
        $this->SQL = "UPDATE t_vat_registration SET \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "registration_date=to_date('" . $this->SQLValue($this->cp["registration_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY HH24:MI:SS'),  \n" .
        "p_region_id_kelurahan=" . $this->SQLValue($this->cp["p_region_id_kelurahan"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id_kecamatan=" . $this->SQLValue($this->cp["p_region_id_kecamatan"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id=" . $this->SQLValue($this->cp["p_region_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id_kel_owner=" . $this->SQLValue($this->cp["p_region_id_kel_owner"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id_kec_owner=" . $this->SQLValue($this->cp["p_region_id_kec_owner"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_region_id_owner=" . $this->SQLValue($this->cp["p_region_id_owner"]->GetDBValue(), ccsFloat) . ", \n" .
        "company_name='" . $this->SQLValue($this->cp["company_name"]->GetDBValue(), ccsText) . "', \n" .
        "address_name='" . $this->SQLValue($this->cp["address_name"]->GetDBValue(), ccsText) . "', \n" .
        "p_job_position_id=" . $this->SQLValue($this->cp["p_job_position_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "company_brand='" . $this->SQLValue($this->cp["company_brand"]->GetDBValue(), ccsText) . "', \n" .
        "address_no='" . $this->SQLValue($this->cp["address_no"]->GetDBValue(), ccsText) . "', \n" .
        "address_rt='" . $this->SQLValue($this->cp["address_rt"]->GetDBValue(), ccsText) . "', \n" .
        "address_rw='" . $this->SQLValue($this->cp["address_rw"]->GetDBValue(), ccsText) . "', \n" .
        "address_no_owner='" . $this->SQLValue($this->cp["address_no_owner"]->GetDBValue(), ccsText) . "', \n" .
        "address_rt_owner='" . $this->SQLValue($this->cp["address_rt_owner"]->GetDBValue(), ccsText) . "', \n" .
        "address_rw_owner='" . $this->SQLValue($this->cp["address_rw_owner"]->GetDBValue(), ccsText) . "', \n" .
        "phone_no='" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "', \n" .
        "fax_no='" . $this->SQLValue($this->cp["fax_no"]->GetDBValue(), ccsText) . "', \n" .
        "zip_code='" . $this->SQLValue($this->cp["zip_code"]->GetDBValue(), ccsText) . "', \n" .
        "phone_no_owner='" . $this->SQLValue($this->cp["phone_no_owner"]->GetDBValue(), ccsText) . "', \n" .
        "company_owner='" . $this->SQLValue($this->cp["company_owner"]->GetDBValue(), ccsText) . "', \n" .
        "mobile_no_owner='" . $this->SQLValue($this->cp["mobile_no_owner"]->GetDBValue(), ccsText) . "', \n" .
        "fax_no_owner='" . $this->SQLValue($this->cp["fax_no_owner"]->GetDBValue(), ccsText) . "', \n" .
        "zip_code_owner='" . $this->SQLValue($this->cp["zip_code_owner"]->GetDBValue(), ccsText) . "',\n" .
        "mobile_no='" . $this->SQLValue($this->cp["mobile_no"]->GetDBValue(), ccsText) . "', \n" .
        "address_name_owner='" . $this->SQLValue($this->cp["address_name_owner"]->GetDBValue(), ccsText) . "',\n" .
        "email='" . $this->SQLValue($this->cp["email"]->GetDBValue(), ccsText) . "',\n" .
        "company_additional_addr='" . $this->SQLValue($this->cp["company_additional_addr"]->GetDBValue(), ccsText) . "',\n" .
        "p_hotel_grade_id=decode(" . $this->SQLValue($this->cp["p_hotel_grade_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_hotel_grade_id"]->GetDBValue(), ccsFloat) . "),\n" .
        "p_rest_service_type_id=decode(" . $this->SQLValue($this->cp["p_rest_service_type_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_rest_service_type_id"]->GetDBValue(), ccsFloat) . "),\n" .
        "p_entertaintment_type_id=decode(" . $this->SQLValue($this->cp["p_entertaintment_type_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_entertaintment_type_id"]->GetDBValue(), ccsFloat) . "),\n" .
        "p_parking_classification_id=decode(" . $this->SQLValue($this->cp["p_parking_classification_id"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_parking_classification_id"]->GetDBValue(), ccsFloat) . ")\n" .
        "WHERE  t_customer_order_id = " . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . " \n" .
        "AND t_vat_registration_id = " . $this->SQLValue($this->cp["t_vat_registration_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-98C92772
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_registration_id"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["t_customer_order_id"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_vat_registration_id"]->GetValue()) and !strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue())) 
            $this->cp["t_vat_registration_id"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue(true))) 
            $this->cp["t_vat_registration_id"]->SetText(0);
        if (!is_null($this->cp["t_customer_order_id"]->GetValue()) and !strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue())) 
            $this->cp["t_customer_order_id"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!strlen($this->cp["t_customer_order_id"]->GetText()) and !is_bool($this->cp["t_customer_order_id"]->GetValue(true))) 
            $this->cp["t_customer_order_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_vat_registration \n" .
        "WHERE  t_vat_registration_id = " . $this->SQLValue($this->cp["t_vat_registration_id"]->GetDBValue(), ccsFloat) . " \n" .
        "AND t_customer_order_id = " . $this->SQLValue($this->cp["t_customer_order_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_registrationFormDataSource Class @94-FCB6E20C

//Initialize Page @1-45CB536B
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
$TemplateFileName = "t_vat_registration_ro.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-EB53BF64
include_once("./t_vat_registration_ro_events.php");
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
