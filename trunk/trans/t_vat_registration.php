<?php
//Include Common Files @1-26A653EE
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_registration.php");
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

//Class_Initialize Event @94-B7FD3005
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
            $this->kelurahan_code = & new clsControl(ccsTextBox, "kelurahan_code", "Kelurahan - Badan", ccsText, "", CCGetRequestParam("kelurahan_code", $Method, NULL), $this);
            $this->kelurahan_code->Required = true;
            $this->kecamatan_code = & new clsControl(ccsTextBox, "kecamatan_code", "Kecamatan - Badan", ccsText, "", CCGetRequestParam("kecamatan_code", $Method, NULL), $this);
            $this->kecamatan_code->Required = true;
            $this->kota_code = & new clsControl(ccsTextBox, "kota_code", "Kota/Kabupaten - Badan", ccsText, "", CCGetRequestParam("kota_code", $Method, NULL), $this);
            $this->kota_code->Required = true;
            $this->p_region_id_kelurahan = & new clsControl(ccsHidden, "p_region_id_kelurahan", "Kelurahan - Badan", ccsFloat, "", CCGetRequestParam("p_region_id_kelurahan", $Method, NULL), $this);
            $this->p_region_id_kelurahan->Required = true;
            $this->p_region_id_kecamatan = & new clsControl(ccsHidden, "p_region_id_kecamatan", "Kecamatan - Badan", ccsFloat, "", CCGetRequestParam("p_region_id_kecamatan", $Method, NULL), $this);
            $this->p_region_id_kecamatan->Required = true;
            $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "Kota/Kabupaten - Badan", ccsFloat, "", CCGetRequestParam("p_region_id", $Method, NULL), $this);
            $this->p_region_id->Required = true;
            $this->kelurahan_own_code = & new clsControl(ccsTextBox, "kelurahan_own_code", "Kelurahan - Pemilk", ccsText, "", CCGetRequestParam("kelurahan_own_code", $Method, NULL), $this);
            $this->kelurahan_own_code->Required = true;
            $this->kecamatan_own_code = & new clsControl(ccsTextBox, "kecamatan_own_code", "Kecamatan - Pemilik", ccsText, "", CCGetRequestParam("kecamatan_own_code", $Method, NULL), $this);
            $this->kecamatan_own_code->Required = true;
            $this->kota_own_code = & new clsControl(ccsTextBox, "kota_own_code", "Kota/Kabupaten - Pemilik", ccsText, "", CCGetRequestParam("kota_own_code", $Method, NULL), $this);
            $this->kota_own_code->Required = true;
            $this->p_region_id_kel_owner = & new clsControl(ccsHidden, "p_region_id_kel_owner", "Kelurahan - Pemilk", ccsFloat, "", CCGetRequestParam("p_region_id_kel_owner", $Method, NULL), $this);
            $this->p_region_id_kel_owner->Required = true;
            $this->p_region_id_kec_owner = & new clsControl(ccsHidden, "p_region_id_kec_owner", "Kecamatan - Pemilik", ccsFloat, "", CCGetRequestParam("p_region_id_kec_owner", $Method, NULL), $this);
            $this->p_region_id_kec_owner->Required = true;
            $this->p_region_id_owner = & new clsControl(ccsHidden, "p_region_id_owner", "Kota/Kabupaten - Pemilik", ccsFloat, "", CCGetRequestParam("p_region_id_owner", $Method, NULL), $this);
            $this->p_region_id_owner->Required = true;
            $this->company_name = & new clsControl(ccsTextBox, "company_name", "Nama Badan/Perusahaan", ccsText, "", CCGetRequestParam("company_name", $Method, NULL), $this);
            $this->company_name->Required = true;
            $this->address_name = & new clsControl(ccsTextArea, "address_name", "Alamat Badan", ccsText, "", CCGetRequestParam("address_name", $Method, NULL), $this);
            $this->address_name->Required = true;
            $this->job_position_code = & new clsControl(ccsTextBox, "job_position_code", "Jabatan Pemilik", ccsText, "", CCGetRequestParam("job_position_code", $Method, NULL), $this);
            $this->job_position_code->Required = true;
            $this->p_job_position_id = & new clsControl(ccsHidden, "p_job_position_id", "p_order_status_id", ccsFloat, "", CCGetRequestParam("p_job_position_id", $Method, NULL), $this);
            $this->company_brand = & new clsControl(ccsTextBox, "company_brand", "Nama Merk Dagang", ccsText, "", CCGetRequestParam("company_brand", $Method, NULL), $this);
            $this->company_brand->Required = true;
            $this->address_no = & new clsControl(ccsTextBox, "address_no", "No - Badan", ccsText, "", CCGetRequestParam("address_no", $Method, NULL), $this);
            $this->address_no->Required = true;
            $this->address_rt = & new clsControl(ccsTextBox, "address_rt", "Rt - Badan", ccsText, "", CCGetRequestParam("address_rt", $Method, NULL), $this);
            $this->address_rw = & new clsControl(ccsTextBox, "address_rw", "Rw - Badan", ccsText, "", CCGetRequestParam("address_rw", $Method, NULL), $this);
            $this->address_no_owner = & new clsControl(ccsTextBox, "address_no_owner", "No - Pemilik", ccsText, "", CCGetRequestParam("address_no_owner", $Method, NULL), $this);
            $this->address_no_owner->Required = true;
            $this->address_rt_owner = & new clsControl(ccsTextBox, "address_rt_owner", "Rt - Pemilik", ccsText, "", CCGetRequestParam("address_rt_owner", $Method, NULL), $this);
            $this->address_rw_owner = & new clsControl(ccsTextBox, "address_rw_owner", "Rw - Pemilik", ccsText, "", CCGetRequestParam("address_rw_owner", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "No. Telephon - Badan", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->fax_no = & new clsControl(ccsTextBox, "fax_no", "No. Fax - Badan", ccsText, "", CCGetRequestParam("fax_no", $Method, NULL), $this);
            $this->zip_code = & new clsControl(ccsTextBox, "zip_code", "Kode Pos - Badan", ccsText, "", CCGetRequestParam("zip_code", $Method, NULL), $this);
            $this->company_owner = & new clsControl(ccsTextBox, "company_owner", "Nama Pemilik/Pengelola", ccsText, "", CCGetRequestParam("company_owner", $Method, NULL), $this);
            $this->company_owner->Required = true;
            $this->mobile_no_owner = & new clsControl(ccsTextBox, "mobile_no_owner", "No. Selular - Pemilk", ccsText, "", CCGetRequestParam("mobile_no_owner", $Method, NULL), $this);
            $this->mobile_no_owner->Required = true;
            $this->fax_no_owner = & new clsControl(ccsTextBox, "fax_no_owner", "No. Fax - Pemilk", ccsText, "", CCGetRequestParam("fax_no_owner", $Method, NULL), $this);
            $this->zip_code_owner = & new clsControl(ccsTextBox, "zip_code_owner", "Kode Pos - Pemilk", ccsText, "", CCGetRequestParam("zip_code_owner", $Method, NULL), $this);
            $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "No. Handphone", ccsText, "", CCGetRequestParam("mobile_no", $Method, NULL), $this);
            $this->address_name_owner = & new clsControl(ccsTextArea, "address_name_owner", "Alamat Tempat Tinggal", ccsText, "", CCGetRequestParam("address_name_owner", $Method, NULL), $this);
            $this->address_name_owner->Required = true;
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->rqst_type_code = & new clsControl(ccsHidden, "rqst_type_code", "rqst_type_code", ccsText, "", CCGetRequestParam("rqst_type_code", $Method, NULL), $this);
            $this->email = & new clsControl(ccsTextBox, "email", "Email - Pemilik", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->validation_code = & new clsControl(ccsTextBox, "validation_code", "Kode Validasi", ccsText, "", CCGetRequestParam("validation_code", $Method, NULL), $this);
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            $this->Label3 = & new clsControl(ccsLabel, "Label3", "Label3", ccsText, "", CCGetRequestParam("Label3", $Method, NULL), $this);
            $this->wp_user_name = & new clsControl(ccsTextBox, "wp_user_name", "User Name", ccsText, "", CCGetRequestParam("wp_user_name", $Method, NULL), $this);
            $this->wp_user_name->Required = true;
            $this->wp_user_pwd = & new clsControl(ccsTextBox, "wp_user_pwd", "Password", ccsText, "", CCGetRequestParam("wp_user_pwd", $Method, NULL), $this);
            $this->wp_user_pwd->Required = true;
            $this->pesan = & new clsControl(ccsLabel, "pesan", "pesan", ccsText, "", CCGetRequestParam("pesan", $Method, NULL), $this);
            $this->phone_no_owner = & new clsControl(ccsTextBox, "phone_no_owner", "No. Telephon - Pemilk", ccsText, "", CCGetRequestParam("phone_no_owner", $Method, NULL), $this);
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->wp_name->Required = true;
            $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->wp_address_name->Required = true;
            $this->wp_address_no = & new clsControl(ccsTextBox, "wp_address_no", "No - WP", ccsText, "", CCGetRequestParam("wp_address_no", $Method, NULL), $this);
            $this->wp_address_no->Required = true;
            $this->wp_address_rt = & new clsControl(ccsTextBox, "wp_address_rt", "Rt - WP", ccsText, "", CCGetRequestParam("wp_address_rt", $Method, NULL), $this);
            $this->wp_address_rw = & new clsControl(ccsTextBox, "wp_address_rw", "Rw - WP", ccsText, "", CCGetRequestParam("wp_address_rw", $Method, NULL), $this);
            $this->wp_kota = & new clsControl(ccsTextBox, "wp_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("wp_kota", $Method, NULL), $this);
            $this->wp_kota->Required = true;
            $this->wp_kecamatan = & new clsControl(ccsTextBox, "wp_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("wp_kecamatan", $Method, NULL), $this);
            $this->wp_kecamatan->Required = true;
            $this->wp_kelurahan = & new clsControl(ccsTextBox, "wp_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("wp_kelurahan", $Method, NULL), $this);
            $this->wp_kelurahan->Required = true;
            $this->brand_kelurahan = & new clsControl(ccsTextBox, "brand_kelurahan", "Kelurahan - Usaha", ccsText, "", CCGetRequestParam("brand_kelurahan", $Method, NULL), $this);
            $this->brand_kelurahan->Required = true;
            $this->brand_kota = & new clsControl(ccsTextBox, "brand_kota", "Kota/Kabupaten - Usaha", ccsText, "", CCGetRequestParam("brand_kota", $Method, NULL), $this);
            $this->brand_kota->Required = true;
            $this->brand_kecamatan = & new clsControl(ccsTextBox, "brand_kecamatan", "Kecamatan - Usaha", ccsText, "", CCGetRequestParam("brand_kecamatan", $Method, NULL), $this);
            $this->brand_kecamatan->Required = true;
            $this->brand_address_no = & new clsControl(ccsTextBox, "brand_address_no", "No - Usaha", ccsText, "", CCGetRequestParam("brand_address_no", $Method, NULL), $this);
            $this->brand_address_no->Required = true;
            $this->brand_address_rt = & new clsControl(ccsTextBox, "brand_address_rt", "Rt - Usaha", ccsText, "", CCGetRequestParam("brand_address_rt", $Method, NULL), $this);
            $this->brand_address_rw = & new clsControl(ccsTextBox, "brand_address_rw", "Rw - Usaha", ccsText, "", CCGetRequestParam("brand_address_rw", $Method, NULL), $this);
            $this->brand_phone_no = & new clsControl(ccsTextBox, "brand_phone_no", "No. Telephon - Usaha", ccsText, "", CCGetRequestParam("brand_phone_no", $Method, NULL), $this);
            $this->wp_phone_no = & new clsControl(ccsTextBox, "wp_phone_no", "No. Telephon - WP", ccsText, "", CCGetRequestParam("wp_phone_no", $Method, NULL), $this);
            $this->wp_zip_code = & new clsControl(ccsTextBox, "wp_zip_code", "Kode Pos - WP", ccsText, "", CCGetRequestParam("wp_zip_code", $Method, NULL), $this);
            $this->brand_zip_code = & new clsControl(ccsTextBox, "brand_zip_code", "Kode Pos - Usaha", ccsText, "", CCGetRequestParam("brand_zip_code", $Method, NULL), $this);
            $this->wp_mobile_no = & new clsControl(ccsTextBox, "wp_mobile_no", "No. Selular - WP", ccsText, "", CCGetRequestParam("wp_mobile_no", $Method, NULL), $this);
            $this->wp_p_region_id = & new clsControl(ccsHidden, "wp_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id", $Method, NULL), $this);
            $this->wp_p_region_id->Required = true;
            $this->brand_p_region_id = & new clsControl(ccsHidden, "brand_p_region_id", "Kota/Kabupaten - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id", $Method, NULL), $this);
            $this->brand_p_region_id->Required = true;
            $this->wp_p_region_id_kecamatan = & new clsControl(ccsHidden, "wp_p_region_id_kecamatan", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kecamatan", $Method, NULL), $this);
            $this->wp_p_region_id_kecamatan->Required = true;
            $this->brand_p_region_id_kec = & new clsControl(ccsHidden, "brand_p_region_id_kec", "Kecamatan - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id_kec", $Method, NULL), $this);
            $this->brand_p_region_id_kec->Required = true;
            $this->wp_p_region_id_kelurahan = & new clsControl(ccsHidden, "wp_p_region_id_kelurahan", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kelurahan", $Method, NULL), $this);
            $this->wp_p_region_id_kelurahan->Required = true;
            $this->brand_p_region_id_kel = & new clsControl(ccsHidden, "brand_p_region_id_kel", "Kelurahan - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id_kel", $Method, NULL), $this);
            $this->brand_p_region_id_kel->Required = true;
            $this->wp_email = & new clsControl(ccsTextBox, "wp_email", "Email - WP", ccsText, "", CCGetRequestParam("wp_email", $Method, NULL), $this);
            $this->wp_fax_no = & new clsControl(ccsTextBox, "wp_fax_no", "No. Fax - WP", ccsText, "", CCGetRequestParam("wp_fax_no", $Method, NULL), $this);
            $this->brand_address_name = & new clsControl(ccsTextArea, "brand_address_name", "Alamat", ccsText, "", CCGetRequestParam("brand_address_name", $Method, NULL), $this);
            $this->brand_address_name->Required = true;
            $this->p_private_question_id = & new clsControl(ccsListBox, "p_private_question_id", "Pilih Pertanyaan", ccsText, "", CCGetRequestParam("p_private_question_id", $Method, NULL), $this);
            $this->p_private_question_id->DSType = dsTable;
            $this->p_private_question_id->DataSource = new clsDBConnSIKP();
            $this->p_private_question_id->ds = & $this->p_private_question_id->DataSource;
            $this->p_private_question_id->DataSource->SQL = "SELECT * \n" .
"FROM p_private_question {SQL_Where} {SQL_OrderBy}";
            $this->p_private_question_id->DataSource->Order = "p_private_question_id";
            list($this->p_private_question_id->BoundColumn, $this->p_private_question_id->TextColumn, $this->p_private_question_id->DBFormat) = array("p_private_question_id", "question_pwd", "");
            $this->p_private_question_id->DataSource->Order = "p_private_question_id";
            $this->private_answer = & new clsControl(ccsTextBox, "private_answer", "Jawaban", ccsText, "", CCGetRequestParam("private_answer", $Method, NULL), $this);
            $this->private_answer->Required = true;
            $this->brand_mobile_no = & new clsControl(ccsTextBox, "brand_mobile_no", "No. Selular - Usaha", ccsText, "", CCGetRequestParam("brand_mobile_no", $Method, NULL), $this);
            $this->brand_fax_no = & new clsControl(ccsTextBox, "brand_fax_no", "No. Fax - Usaha", ccsText, "", CCGetRequestParam("brand_fax_no", $Method, NULL), $this);
            $this->p_vat_type_dtl_id = & new clsControl(ccsListBox, "p_vat_type_dtl_id", "Nama Ayat", ccsFloat, "", CCGetRequestParam("p_vat_type_dtl_id", $Method, NULL), $this);
            $this->p_vat_type_dtl_id->DSType = dsSQL;
            $this->p_vat_type_dtl_id->DataSource = new clsDBConnSIKP();
            $this->p_vat_type_dtl_id->ds = & $this->p_vat_type_dtl_id->DataSource;
            list($this->p_vat_type_dtl_id->BoundColumn, $this->p_vat_type_dtl_id->TextColumn, $this->p_vat_type_dtl_id->DBFormat) = array("p_vat_type_dtl_id", "nama_ayat", "");
            $this->p_vat_type_dtl_id->DataSource->Parameters["urlp_rqst_type_id"] = CCGetFromGet("p_rqst_type_id", NULL);
            $this->p_vat_type_dtl_id->DataSource->wp = new clsSQLParameters();
            $this->p_vat_type_dtl_id->DataSource->wp->AddParameter("1", "urlp_rqst_type_id", ccsFloat, "", "", $this->p_vat_type_dtl_id->DataSource->Parameters["urlp_rqst_type_id"], 0, false);
            $this->p_vat_type_dtl_id->DataSource->SQL = "select * from v_p_vat_type_dtl_rqst_type\n" .
            "where p_rqst_type_id = " . $this->p_vat_type_dtl_id->DataSource->SQLValue($this->p_vat_type_dtl_id->DataSource->wp->GetDBValue("1"), ccsFloat) . "";
            $this->p_vat_type_dtl_id->DataSource->Order = "";
            $this->p_vat_type_dtl_id->Required = true;
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
                if(!is_array($this->kota_code->Value) && !strlen($this->kota_code->Value) && $this->kota_code->Value !== false)
                    $this->kota_code->SetText('KOTA BANDUNG');
                if(!is_array($this->p_region_id->Value) && !strlen($this->p_region_id->Value) && $this->p_region_id->Value !== false)
                    $this->p_region_id->SetText(749);
                if(!is_array($this->kota_own_code->Value) && !strlen($this->kota_own_code->Value) && $this->kota_own_code->Value !== false)
                    $this->kota_own_code->SetText('KOTA BANDUNG');
                if(!is_array($this->p_region_id_owner->Value) && !strlen($this->p_region_id_owner->Value) && $this->p_region_id_owner->Value !== false)
                    $this->p_region_id_owner->SetText(749);
                if(!is_array($this->wp_kota->Value) && !strlen($this->wp_kota->Value) && $this->wp_kota->Value !== false)
                    $this->wp_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->brand_kota->Value) && !strlen($this->brand_kota->Value) && $this->brand_kota->Value !== false)
                    $this->brand_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->wp_p_region_id->Value) && !strlen($this->wp_p_region_id->Value) && $this->wp_p_region_id->Value !== false)
                    $this->wp_p_region_id->SetText(749);
                if(!is_array($this->brand_p_region_id->Value) && !strlen($this->brand_p_region_id->Value) && $this->brand_p_region_id->Value !== false)
                    $this->brand_p_region_id->SetText(749);
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

//Validate Method @94-5A340563
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if(strlen($this->email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email->GetText())) {
            $this->email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email - Pemilik"));
        }
        if(strlen($this->wp_email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->wp_email->GetText())) {
            $this->wp_email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email - WP"));
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
        $Validation = ($this->company_owner->Validate() && $Validation);
        $Validation = ($this->mobile_no_owner->Validate() && $Validation);
        $Validation = ($this->fax_no_owner->Validate() && $Validation);
        $Validation = ($this->zip_code_owner->Validate() && $Validation);
        $Validation = ($this->mobile_no->Validate() && $Validation);
        $Validation = ($this->address_name_owner->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->rqst_type_code->Validate() && $Validation);
        $Validation = ($this->email->Validate() && $Validation);
        $Validation = ($this->validation_code->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $Validation = ($this->wp_user_name->Validate() && $Validation);
        $Validation = ($this->wp_user_pwd->Validate() && $Validation);
        $Validation = ($this->phone_no_owner->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->wp_address_no->Validate() && $Validation);
        $Validation = ($this->wp_address_rt->Validate() && $Validation);
        $Validation = ($this->wp_address_rw->Validate() && $Validation);
        $Validation = ($this->wp_kota->Validate() && $Validation);
        $Validation = ($this->wp_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_kelurahan->Validate() && $Validation);
        $Validation = ($this->brand_kelurahan->Validate() && $Validation);
        $Validation = ($this->brand_kota->Validate() && $Validation);
        $Validation = ($this->brand_kecamatan->Validate() && $Validation);
        $Validation = ($this->brand_address_no->Validate() && $Validation);
        $Validation = ($this->brand_address_rt->Validate() && $Validation);
        $Validation = ($this->brand_address_rw->Validate() && $Validation);
        $Validation = ($this->brand_phone_no->Validate() && $Validation);
        $Validation = ($this->wp_phone_no->Validate() && $Validation);
        $Validation = ($this->wp_zip_code->Validate() && $Validation);
        $Validation = ($this->brand_zip_code->Validate() && $Validation);
        $Validation = ($this->wp_mobile_no->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id->Validate() && $Validation);
        $Validation = ($this->brand_p_region_id->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kecamatan->Validate() && $Validation);
        $Validation = ($this->brand_p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->brand_p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->wp_email->Validate() && $Validation);
        $Validation = ($this->wp_fax_no->Validate() && $Validation);
        $Validation = ($this->brand_address_name->Validate() && $Validation);
        $Validation = ($this->p_private_question_id->Validate() && $Validation);
        $Validation = ($this->private_answer->Validate() && $Validation);
        $Validation = ($this->brand_mobile_no->Validate() && $Validation);
        $Validation = ($this->brand_fax_no->Validate() && $Validation);
        $Validation = ($this->p_vat_type_dtl_id->Validate() && $Validation);
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
        $Validation =  $Validation && ($this->company_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fax_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->zip_code_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->address_name_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rqst_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->validation_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_user_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_user_pwd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no_owner->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_zip_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_private_question_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->private_answer->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_mobile_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->brand_fax_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_dtl_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-0D16BF26
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
        $errors = ($errors || $this->company_owner->Errors->Count());
        $errors = ($errors || $this->mobile_no_owner->Errors->Count());
        $errors = ($errors || $this->fax_no_owner->Errors->Count());
        $errors = ($errors || $this->zip_code_owner->Errors->Count());
        $errors = ($errors || $this->mobile_no->Errors->Count());
        $errors = ($errors || $this->address_name_owner->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->rqst_type_code->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->validation_code->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
        $errors = ($errors || $this->Label3->Errors->Count());
        $errors = ($errors || $this->wp_user_name->Errors->Count());
        $errors = ($errors || $this->wp_user_pwd->Errors->Count());
        $errors = ($errors || $this->pesan->Errors->Count());
        $errors = ($errors || $this->phone_no_owner->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->wp_address_no->Errors->Count());
        $errors = ($errors || $this->wp_address_rt->Errors->Count());
        $errors = ($errors || $this->wp_address_rw->Errors->Count());
        $errors = ($errors || $this->wp_kota->Errors->Count());
        $errors = ($errors || $this->wp_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_kelurahan->Errors->Count());
        $errors = ($errors || $this->brand_kelurahan->Errors->Count());
        $errors = ($errors || $this->brand_kota->Errors->Count());
        $errors = ($errors || $this->brand_kecamatan->Errors->Count());
        $errors = ($errors || $this->brand_address_no->Errors->Count());
        $errors = ($errors || $this->brand_address_rt->Errors->Count());
        $errors = ($errors || $this->brand_address_rw->Errors->Count());
        $errors = ($errors || $this->brand_phone_no->Errors->Count());
        $errors = ($errors || $this->wp_phone_no->Errors->Count());
        $errors = ($errors || $this->wp_zip_code->Errors->Count());
        $errors = ($errors || $this->brand_zip_code->Errors->Count());
        $errors = ($errors || $this->wp_mobile_no->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id->Errors->Count());
        $errors = ($errors || $this->brand_p_region_id->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kecamatan->Errors->Count());
        $errors = ($errors || $this->brand_p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->brand_p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->wp_email->Errors->Count());
        $errors = ($errors || $this->wp_fax_no->Errors->Count());
        $errors = ($errors || $this->brand_address_name->Errors->Count());
        $errors = ($errors || $this->p_private_question_id->Errors->Count());
        $errors = ($errors || $this->private_answer->Errors->Count());
        $errors = ($errors || $this->brand_mobile_no->Errors->Count());
        $errors = ($errors || $this->brand_fax_no->Errors->Count());
        $errors = ($errors || $this->p_vat_type_dtl_id->Errors->Count());
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

//InsertRow Method @94-FCBB0346
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->validation_code->SetValue($this->validation_code->GetValue(true));
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
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->p_vat_type_dtl_id->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        $this->DataSource->wp_user_name->SetValue($this->wp_user_name->GetValue(true));
        $this->DataSource->wp_user_pwd->SetValue($this->wp_user_pwd->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->wp_address_no->SetValue($this->wp_address_no->GetValue(true));
        $this->DataSource->wp_address_rt->SetValue($this->wp_address_rt->GetValue(true));
        $this->DataSource->wp_address_rw->SetValue($this->wp_address_rw->GetValue(true));
        $this->DataSource->wp_p_region_id_kelurahan->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        $this->DataSource->wp_p_region_id_kecamatan->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_phone_no->SetValue($this->wp_phone_no->GetValue(true));
        $this->DataSource->wp_mobile_no->SetValue($this->wp_mobile_no->GetValue(true));
        $this->DataSource->wp_fax_no->SetValue($this->wp_fax_no->GetValue(true));
        $this->DataSource->wp_zip_code->SetValue($this->wp_zip_code->GetValue(true));
        $this->DataSource->wp_email->SetValue($this->wp_email->GetValue(true));
        $this->DataSource->brand_address_name->SetValue($this->brand_address_name->GetValue(true));
        $this->DataSource->brand_address_no->SetValue($this->brand_address_no->GetValue(true));
        $this->DataSource->brand_address_rt->SetValue($this->brand_address_rt->GetValue(true));
        $this->DataSource->brand_address_rw->SetValue($this->brand_address_rw->GetValue(true));
        $this->DataSource->brand_p_region_id_kel->SetValue($this->brand_p_region_id_kel->GetValue(true));
        $this->DataSource->brand_p_region_id_kec->SetValue($this->brand_p_region_id_kec->GetValue(true));
        $this->DataSource->brand_p_region_id->SetValue($this->brand_p_region_id->GetValue(true));
        $this->DataSource->brand_phone_no->SetValue($this->brand_phone_no->GetValue(true));
        $this->DataSource->brand_mobile_no->SetValue($this->brand_mobile_no->GetValue(true));
        $this->DataSource->brand_fax_no->SetValue($this->brand_fax_no->GetValue(true));
        $this->DataSource->brand_zip_code->SetValue($this->brand_zip_code->GetValue(true));
        $this->DataSource->p_private_question_id->SetValue($this->p_private_question_id->GetValue(true));
        $this->DataSource->private_answer->SetValue($this->private_answer->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-D1714833
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
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
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->p_vat_type_dtl_id->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        $this->DataSource->wp_user_name->SetValue($this->wp_user_name->GetValue(true));
        $this->DataSource->wp_user_pwd->SetValue($this->wp_user_pwd->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->wp_address_no->SetValue($this->wp_address_no->GetValue(true));
        $this->DataSource->wp_address_rt->SetValue($this->wp_address_rt->GetValue(true));
        $this->DataSource->wp_address_rw->SetValue($this->wp_address_rw->GetValue(true));
        $this->DataSource->wp_p_region_id_kelurahan->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        $this->DataSource->wp_p_region_id_kecamatan->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_phone_no->SetValue($this->wp_phone_no->GetValue(true));
        $this->DataSource->wp_mobile_no->SetValue($this->wp_mobile_no->GetValue(true));
        $this->DataSource->wp_fax_no->SetValue($this->wp_fax_no->GetValue(true));
        $this->DataSource->wp_zip_code->SetValue($this->wp_zip_code->GetValue(true));
        $this->DataSource->wp_email->SetValue($this->wp_email->GetValue(true));
        $this->DataSource->brand_address_name->SetValue($this->brand_address_name->GetValue(true));
        $this->DataSource->brand_address_no->SetValue($this->brand_address_no->GetValue(true));
        $this->DataSource->brand_address_rt->SetValue($this->brand_address_rt->GetValue(true));
        $this->DataSource->brand_address_rw->SetValue($this->brand_address_rw->GetValue(true));
        $this->DataSource->brand_p_region_id_kel->SetValue($this->brand_p_region_id_kel->GetValue(true));
        $this->DataSource->brand_p_region_id_kec->SetValue($this->brand_p_region_id_kec->GetValue(true));
        $this->DataSource->brand_p_region_id->SetValue($this->brand_p_region_id->GetValue(true));
        $this->DataSource->brand_phone_no->SetValue($this->brand_phone_no->GetValue(true));
        $this->DataSource->brand_mobile_no->SetValue($this->brand_mobile_no->GetValue(true));
        $this->DataSource->brand_fax_no->SetValue($this->brand_fax_no->GetValue(true));
        $this->DataSource->brand_zip_code->SetValue($this->brand_zip_code->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->p_private_question_id->SetValue($this->p_private_question_id->GetValue(true));
        $this->DataSource->private_answer->SetValue($this->private_answer->GetValue(true));
        $this->DataSource->t_customer_order_id->SetValue($this->t_customer_order_id->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-8CCE79FB
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-6EBFA7E8
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

        $this->p_private_question_id->Prepare();
        $this->p_vat_type_dtl_id->Prepare();

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
                    $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
                    $this->mobile_no_owner->SetValue($this->DataSource->mobile_no_owner->GetValue());
                    $this->fax_no_owner->SetValue($this->DataSource->fax_no_owner->GetValue());
                    $this->zip_code_owner->SetValue($this->DataSource->zip_code_owner->GetValue());
                    $this->mobile_no->SetValue($this->DataSource->mobile_no->GetValue());
                    $this->address_name_owner->SetValue($this->DataSource->address_name_owner->GetValue());
                    $this->email->SetValue($this->DataSource->email->GetValue());
                    $this->t_vat_registration_id->SetValue($this->DataSource->t_vat_registration_id->GetValue());
                    $this->wp_user_name->SetValue($this->DataSource->wp_user_name->GetValue());
                    $this->wp_user_pwd->SetValue($this->DataSource->wp_user_pwd->GetValue());
                    $this->phone_no_owner->SetValue($this->DataSource->phone_no_owner->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->wp_address_no->SetValue($this->DataSource->wp_address_no->GetValue());
                    $this->wp_address_rt->SetValue($this->DataSource->wp_address_rt->GetValue());
                    $this->wp_address_rw->SetValue($this->DataSource->wp_address_rw->GetValue());
                    $this->wp_kota->SetValue($this->DataSource->wp_kota->GetValue());
                    $this->wp_kecamatan->SetValue($this->DataSource->wp_kecamatan->GetValue());
                    $this->wp_kelurahan->SetValue($this->DataSource->wp_kelurahan->GetValue());
                    $this->brand_kelurahan->SetValue($this->DataSource->brand_kelurahan->GetValue());
                    $this->brand_kota->SetValue($this->DataSource->brand_kota->GetValue());
                    $this->brand_kecamatan->SetValue($this->DataSource->brand_kecamatan->GetValue());
                    $this->brand_address_no->SetValue($this->DataSource->brand_address_no->GetValue());
                    $this->brand_address_rt->SetValue($this->DataSource->brand_address_rt->GetValue());
                    $this->brand_address_rw->SetValue($this->DataSource->brand_address_rw->GetValue());
                    $this->brand_phone_no->SetValue($this->DataSource->brand_phone_no->GetValue());
                    $this->wp_phone_no->SetValue($this->DataSource->wp_phone_no->GetValue());
                    $this->wp_zip_code->SetValue($this->DataSource->wp_zip_code->GetValue());
                    $this->brand_zip_code->SetValue($this->DataSource->brand_zip_code->GetValue());
                    $this->wp_mobile_no->SetValue($this->DataSource->wp_mobile_no->GetValue());
                    $this->wp_p_region_id->SetValue($this->DataSource->wp_p_region_id->GetValue());
                    $this->brand_p_region_id->SetValue($this->DataSource->brand_p_region_id->GetValue());
                    $this->wp_p_region_id_kecamatan->SetValue($this->DataSource->wp_p_region_id_kecamatan->GetValue());
                    $this->brand_p_region_id_kec->SetValue($this->DataSource->brand_p_region_id_kec->GetValue());
                    $this->wp_p_region_id_kelurahan->SetValue($this->DataSource->wp_p_region_id_kelurahan->GetValue());
                    $this->brand_p_region_id_kel->SetValue($this->DataSource->brand_p_region_id_kel->GetValue());
                    $this->wp_email->SetValue($this->DataSource->wp_email->GetValue());
                    $this->wp_fax_no->SetValue($this->DataSource->wp_fax_no->GetValue());
                    $this->brand_address_name->SetValue($this->DataSource->brand_address_name->GetValue());
                    $this->p_private_question_id->SetValue($this->DataSource->p_private_question_id->GetValue());
                    $this->private_answer->SetValue($this->DataSource->private_answer->GetValue());
                    $this->brand_mobile_no->SetValue($this->DataSource->brand_mobile_no->GetValue());
                    $this->brand_fax_no->SetValue($this->DataSource->brand_fax_no->GetValue());
                    $this->p_vat_type_dtl_id->SetValue($this->DataSource->p_vat_type_dtl_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->company_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fax_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->zip_code_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->address_name_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rqst_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->validation_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_vat_registration_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Label3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_user_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_user_pwd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pesan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no_owner->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_zip_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_private_question_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->private_answer->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_mobile_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->brand_fax_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_dtl_id->Errors->ToString());
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
        $this->company_owner->Show();
        $this->mobile_no_owner->Show();
        $this->fax_no_owner->Show();
        $this->zip_code_owner->Show();
        $this->mobile_no->Show();
        $this->address_name_owner->Show();
        $this->p_rqst_type_id->Show();
        $this->rqst_type_code->Show();
        $this->email->Show();
        $this->Button1->Show();
        $this->validation_code->Show();
        $this->t_vat_registration_id->Show();
        $this->Label3->Show();
        $this->wp_user_name->Show();
        $this->wp_user_pwd->Show();
        $this->pesan->Show();
        $this->phone_no_owner->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->wp_address_no->Show();
        $this->wp_address_rt->Show();
        $this->wp_address_rw->Show();
        $this->wp_kota->Show();
        $this->wp_kecamatan->Show();
        $this->wp_kelurahan->Show();
        $this->brand_kelurahan->Show();
        $this->brand_kota->Show();
        $this->brand_kecamatan->Show();
        $this->brand_address_no->Show();
        $this->brand_address_rt->Show();
        $this->brand_address_rw->Show();
        $this->brand_phone_no->Show();
        $this->wp_phone_no->Show();
        $this->wp_zip_code->Show();
        $this->brand_zip_code->Show();
        $this->wp_mobile_no->Show();
        $this->wp_p_region_id->Show();
        $this->brand_p_region_id->Show();
        $this->wp_p_region_id_kecamatan->Show();
        $this->brand_p_region_id_kec->Show();
        $this->wp_p_region_id_kelurahan->Show();
        $this->brand_p_region_id_kel->Show();
        $this->wp_email->Show();
        $this->wp_fax_no->Show();
        $this->brand_address_name->Show();
        $this->p_private_question_id->Show();
        $this->private_answer->Show();
        $this->brand_mobile_no->Show();
        $this->brand_fax_no->Show();
        $this->p_vat_type_dtl_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_registrationForm Class @94-FCB6E20C

class clst_vat_registrationFormDataSource extends clsDBConnSIKP {  //t_vat_registrationFormDataSource Class @94-5993B12E

//DataSource Variables @94-3E16AEAD
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
    var $company_owner;
    var $mobile_no_owner;
    var $fax_no_owner;
    var $zip_code_owner;
    var $mobile_no;
    var $address_name_owner;
    var $p_rqst_type_id;
    var $rqst_type_code;
    var $email;
    var $validation_code;
    var $t_vat_registration_id;
    var $Label3;
    var $wp_user_name;
    var $wp_user_pwd;
    var $pesan;
    var $phone_no_owner;
    var $wp_name;
    var $wp_address_name;
    var $wp_address_no;
    var $wp_address_rt;
    var $wp_address_rw;
    var $wp_kota;
    var $wp_kecamatan;
    var $wp_kelurahan;
    var $brand_kelurahan;
    var $brand_kota;
    var $brand_kecamatan;
    var $brand_address_no;
    var $brand_address_rt;
    var $brand_address_rw;
    var $brand_phone_no;
    var $wp_phone_no;
    var $wp_zip_code;
    var $brand_zip_code;
    var $wp_mobile_no;
    var $wp_p_region_id;
    var $brand_p_region_id;
    var $wp_p_region_id_kecamatan;
    var $brand_p_region_id_kec;
    var $wp_p_region_id_kelurahan;
    var $brand_p_region_id_kel;
    var $wp_email;
    var $wp_fax_no;
    var $brand_address_name;
    var $p_private_question_id;
    var $private_answer;
    var $brand_mobile_no;
    var $brand_fax_no;
    var $p_vat_type_dtl_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-0BADBDC8
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
        
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->mobile_no_owner = new clsField("mobile_no_owner", ccsText, "");
        
        $this->fax_no_owner = new clsField("fax_no_owner", ccsText, "");
        
        $this->zip_code_owner = new clsField("zip_code_owner", ccsText, "");
        
        $this->mobile_no = new clsField("mobile_no", ccsText, "");
        
        $this->address_name_owner = new clsField("address_name_owner", ccsText, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->rqst_type_code = new clsField("rqst_type_code", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->validation_code = new clsField("validation_code", ccsText, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        
        $this->Label3 = new clsField("Label3", ccsText, "");
        
        $this->wp_user_name = new clsField("wp_user_name", ccsText, "");
        
        $this->wp_user_pwd = new clsField("wp_user_pwd", ccsText, "");
        
        $this->pesan = new clsField("pesan", ccsText, "");
        
        $this->phone_no_owner = new clsField("phone_no_owner", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->wp_address_no = new clsField("wp_address_no", ccsText, "");
        
        $this->wp_address_rt = new clsField("wp_address_rt", ccsText, "");
        
        $this->wp_address_rw = new clsField("wp_address_rw", ccsText, "");
        
        $this->wp_kota = new clsField("wp_kota", ccsText, "");
        
        $this->wp_kecamatan = new clsField("wp_kecamatan", ccsText, "");
        
        $this->wp_kelurahan = new clsField("wp_kelurahan", ccsText, "");
        
        $this->brand_kelurahan = new clsField("brand_kelurahan", ccsText, "");
        
        $this->brand_kota = new clsField("brand_kota", ccsText, "");
        
        $this->brand_kecamatan = new clsField("brand_kecamatan", ccsText, "");
        
        $this->brand_address_no = new clsField("brand_address_no", ccsText, "");
        
        $this->brand_address_rt = new clsField("brand_address_rt", ccsText, "");
        
        $this->brand_address_rw = new clsField("brand_address_rw", ccsText, "");
        
        $this->brand_phone_no = new clsField("brand_phone_no", ccsText, "");
        
        $this->wp_phone_no = new clsField("wp_phone_no", ccsText, "");
        
        $this->wp_zip_code = new clsField("wp_zip_code", ccsText, "");
        
        $this->brand_zip_code = new clsField("brand_zip_code", ccsText, "");
        
        $this->wp_mobile_no = new clsField("wp_mobile_no", ccsText, "");
        
        $this->wp_p_region_id = new clsField("wp_p_region_id", ccsFloat, "");
        
        $this->brand_p_region_id = new clsField("brand_p_region_id", ccsFloat, "");
        
        $this->wp_p_region_id_kecamatan = new clsField("wp_p_region_id_kecamatan", ccsFloat, "");
        
        $this->brand_p_region_id_kec = new clsField("brand_p_region_id_kec", ccsFloat, "");
        
        $this->wp_p_region_id_kelurahan = new clsField("wp_p_region_id_kelurahan", ccsFloat, "");
        
        $this->brand_p_region_id_kel = new clsField("brand_p_region_id_kel", ccsFloat, "");
        
        $this->wp_email = new clsField("wp_email", ccsText, "");
        
        $this->wp_fax_no = new clsField("wp_fax_no", ccsText, "");
        
        $this->brand_address_name = new clsField("brand_address_name", ccsText, "");
        
        $this->p_private_question_id = new clsField("p_private_question_id", ccsText, "");
        
        $this->private_answer = new clsField("private_answer", ccsText, "");
        
        $this->brand_mobile_no = new clsField("brand_mobile_no", ccsText, "");
        
        $this->brand_fax_no = new clsField("brand_fax_no", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-91E1320A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_order_id", ccsFloat, "", "", $this->Parameters["urlt_customer_order_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-DF3AF697
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM v_vat_registration\n" .
        "WHERE t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-D0BA0D89
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
        $this->company_owner->SetDBValue($this->f("company_owner"));
        $this->mobile_no_owner->SetDBValue($this->f("mobile_no_owner"));
        $this->fax_no_owner->SetDBValue($this->f("fax_no_owner"));
        $this->zip_code_owner->SetDBValue($this->f("zip_code_owner"));
        $this->mobile_no->SetDBValue($this->f("mobile_no"));
        $this->address_name_owner->SetDBValue($this->f("address_name_owner"));
        $this->email->SetDBValue($this->f("email"));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->wp_user_name->SetDBValue($this->f("wp_user_name"));
        $this->wp_user_pwd->SetDBValue($this->f("wp_user_pwd"));
        $this->phone_no_owner->SetDBValue($this->f("phone_no_owner"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->wp_address_no->SetDBValue($this->f("wp_address_no"));
        $this->wp_address_rt->SetDBValue($this->f("wp_address_rt"));
        $this->wp_address_rw->SetDBValue($this->f("wp_address_rw"));
        $this->wp_kota->SetDBValue($this->f("wp_kota"));
        $this->wp_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->wp_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->brand_kelurahan->SetDBValue($this->f("brand_kelurahan"));
        $this->brand_kota->SetDBValue($this->f("brand_kota"));
        $this->brand_kecamatan->SetDBValue($this->f("brand_kecamatan"));
        $this->brand_address_no->SetDBValue($this->f("brand_address_no"));
        $this->brand_address_rt->SetDBValue($this->f("brand_address_rt"));
        $this->brand_address_rw->SetDBValue($this->f("brand_address_rw"));
        $this->brand_phone_no->SetDBValue($this->f("brand_phone_no"));
        $this->wp_phone_no->SetDBValue($this->f("wp_phone_no"));
        $this->wp_zip_code->SetDBValue($this->f("wp_zip_code"));
        $this->brand_zip_code->SetDBValue($this->f("brand_zip_code"));
        $this->wp_mobile_no->SetDBValue($this->f("wp_mobile_no"));
        $this->wp_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
        $this->brand_p_region_id->SetDBValue(trim($this->f("brand_p_region_id")));
        $this->wp_p_region_id_kecamatan->SetDBValue(trim($this->f("wp_p_region_id_kecamatan")));
        $this->brand_p_region_id_kec->SetDBValue(trim($this->f("brand_p_region_id_kec")));
        $this->wp_p_region_id_kelurahan->SetDBValue(trim($this->f("wp_p_region_id_kelurahan")));
        $this->brand_p_region_id_kel->SetDBValue(trim($this->f("brand_p_region_id_kel")));
        $this->wp_email->SetDBValue($this->f("wp_email"));
        $this->wp_fax_no->SetDBValue($this->f("wp_fax_no"));
        $this->brand_address_name->SetDBValue($this->f("brand_address_name"));
        $this->p_private_question_id->SetDBValue($this->f("p_private_question_id"));
        $this->private_answer->SetDBValue($this->f("private_answer"));
        $this->brand_mobile_no->SetDBValue($this->f("brand_mobile_no"));
        $this->brand_fax_no->SetDBValue($this->f("brand_fax_no"));
        $this->p_vat_type_dtl_id->SetDBValue(trim($this->f("p_vat_type_dtl_id")));
    }
//End SetValues Method

//Insert Method @94-F131EA98
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["o_res"] = new clsSQLParameter("urlo_res", ccsText, "", "", CCGetFromGet("o_res", NULL), "", false, $this->ErrorBlock);
        $this->cp["icode"] = new clsSQLParameter("ctrlvalidation_code", ccsText, "", "", $this->validation_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["iuser"] = new clsSQLParameter("exprKey900", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["cusorderid"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkel"] = new clsSQLParameter("ctrlp_region_id_kelurahan", ccsFloat, "", "", $this->p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkec"] = new clsSQLParameter("ctrlp_region_id_kecamatan", ccsFloat, "", "", $this->p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionid"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkelown"] = new clsSQLParameter("ctrlp_region_id_kel_owner", ccsFloat, "", "", $this->p_region_id_kel_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkecown"] = new clsSQLParameter("ctrlp_region_id_kec_owner", ccsFloat, "", "", $this->p_region_id_kec_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidown"] = new clsSQLParameter("ctrlp_region_id_owner", ccsFloat, "", "", $this->p_region_id_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["companyname"] = new clsSQLParameter("ctrlcompany_name", ccsText, "", "", $this->company_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressname"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["jobid"] = new clsSQLParameter("ctrlp_job_position_id", ccsFloat, "", "", $this->p_job_position_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["companybrand"] = new clsSQLParameter("ctrlcompany_brand", ccsText, "", "", $this->company_brand->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressno"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressnoown"] = new clsSQLParameter("ctrladdress_no_owner", ccsText, "", "", $this->address_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrtown"] = new clsSQLParameter("ctrladdress_rt_owner", ccsText, "", "", $this->address_rt_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrwown"] = new clsSQLParameter("ctrladdress_rw_owner", ccsText, "", "", $this->address_rw_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phoneno"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["faxno"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zipcode"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phonenoown"] = new clsSQLParameter("ctrlphone_no_owner", ccsText, "", "", $this->phone_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["companyown"] = new clsSQLParameter("ctrlcompany_owner", ccsText, "", "", $this->company_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobilenoown"] = new clsSQLParameter("ctrlmobile_no_owner", ccsText, "", "", $this->mobile_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["faxnoown"] = new clsSQLParameter("ctrlfax_no_owner", ccsText, "", "", $this->fax_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zipcodeown"] = new clsSQLParameter("ctrlzip_code_owner", ccsText, "", "", $this->zip_code_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobileno"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressnameown"] = new clsSQLParameter("ctrladdress_name_owner", ccsText, "", "", $this->address_name_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_email"] = new clsSQLParameter("ctrlemail", ccsText, "", "", $this->email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["vattypedtlid"] = new clsSQLParameter("ctrlp_vat_type_dtl_id", ccsFloat, "", "", $this->p_vat_type_dtl_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpusername"] = new clsSQLParameter("ctrlwp_user_name", ccsText, "", "", $this->wp_user_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpuserpwd"] = new clsSQLParameter("ctrlwp_user_pwd", ccsText, "", "", $this->wp_user_pwd->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpname"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpaddressname"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpaddressno"] = new clsSQLParameter("ctrlwp_address_no", ccsText, "", "", $this->wp_address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wprt"] = new clsSQLParameter("ctrlwp_address_rt", ccsText, "", "", $this->wp_address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wprw"] = new clsSQLParameter("ctrlwp_address_rw", ccsText, "", "", $this->wp_address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpkel"] = new clsSQLParameter("ctrlwp_p_region_id_kelurahan", ccsFloat, "", "", $this->wp_p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpkec"] = new clsSQLParameter("ctrlwp_p_region_id_kecamatan", ccsFloat, "", "", $this->wp_p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpkota"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpphoneno"] = new clsSQLParameter("ctrlwp_phone_no", ccsText, "", "", $this->wp_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpmobileno"] = new clsSQLParameter("ctrlwp_mobile_no", ccsText, "", "", $this->wp_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpfaxno"] = new clsSQLParameter("ctrlwp_fax_no", ccsText, "", "", $this->wp_fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpzipcode"] = new clsSQLParameter("ctrlwp_zip_code", ccsText, "", "", $this->wp_zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpemail"] = new clsSQLParameter("ctrlwp_email", ccsText, "", "", $this->wp_email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandaddress"] = new clsSQLParameter("ctrlbrand_address_name", ccsText, "", "", $this->brand_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandno"] = new clsSQLParameter("ctrlbrand_address_no", ccsText, "", "", $this->brand_address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandrt"] = new clsSQLParameter("ctrlbrand_address_rt", ccsText, "", "", $this->brand_address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandrw"] = new clsSQLParameter("ctrlbrand_address_rw", ccsText, "", "", $this->brand_address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandkel"] = new clsSQLParameter("ctrlbrand_p_region_id_kel", ccsFloat, "", "", $this->brand_p_region_id_kel->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandkec"] = new clsSQLParameter("ctrlbrand_p_region_id_kec", ccsFloat, "", "", $this->brand_p_region_id_kec->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandkota"] = new clsSQLParameter("ctrlbrand_p_region_id", ccsFloat, "", "", $this->brand_p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandphoneno"] = new clsSQLParameter("ctrlbrand_phone_no", ccsText, "", "", $this->brand_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandmobileno"] = new clsSQLParameter("ctrlbrand_mobile_no", ccsText, "", "", $this->brand_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandfaxno"] = new clsSQLParameter("ctrlbrand_fax_no", ccsText, "", "", $this->brand_fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandzipcode"] = new clsSQLParameter("ctrlbrand_zip_code", ccsText, "", "", $this->brand_zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idvat"] = new clsSQLParameter("urlidvat", ccsFloat, "", "", CCGetFromGet("idvat", NULL), "", false, $this->ErrorBlock);
        $this->cp["questionid"] = new clsSQLParameter("ctrlp_private_question_id", ccsFloat, "", "", $this->p_private_question_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["privateanswer"] = new clsSQLParameter("ctrlprivate_answer", ccsText, "", "", $this->private_answer->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_mode"] = new clsSQLParameter("exprKey963", ccsText, "", "", 'I', "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["o_res"]->GetValue()) and !strlen($this->cp["o_res"]->GetText()) and !is_bool($this->cp["o_res"]->GetValue())) 
            $this->cp["o_res"]->SetText(CCGetFromGet("o_res", NULL));
        if (!is_null($this->cp["icode"]->GetValue()) and !strlen($this->cp["icode"]->GetText()) and !is_bool($this->cp["icode"]->GetValue())) 
            $this->cp["icode"]->SetValue($this->validation_code->GetValue(true));
        if (!is_null($this->cp["iuser"]->GetValue()) and !strlen($this->cp["iuser"]->GetText()) and !is_bool($this->cp["iuser"]->GetValue())) 
            $this->cp["iuser"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["cusorderid"]->GetValue()) and !strlen($this->cp["cusorderid"]->GetText()) and !is_bool($this->cp["cusorderid"]->GetValue())) 
            $this->cp["cusorderid"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!is_null($this->cp["regionidkel"]->GetValue()) and !strlen($this->cp["regionidkel"]->GetText()) and !is_bool($this->cp["regionidkel"]->GetValue())) 
            $this->cp["regionidkel"]->SetValue($this->p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["regionidkec"]->GetValue()) and !strlen($this->cp["regionidkec"]->GetText()) and !is_bool($this->cp["regionidkec"]->GetValue())) 
            $this->cp["regionidkec"]->SetValue($this->p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["regionid"]->GetValue()) and !strlen($this->cp["regionid"]->GetText()) and !is_bool($this->cp["regionid"]->GetValue())) 
            $this->cp["regionid"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["regionidkelown"]->GetValue()) and !strlen($this->cp["regionidkelown"]->GetText()) and !is_bool($this->cp["regionidkelown"]->GetValue())) 
            $this->cp["regionidkelown"]->SetValue($this->p_region_id_kel_owner->GetValue(true));
        if (!is_null($this->cp["regionidkecown"]->GetValue()) and !strlen($this->cp["regionidkecown"]->GetText()) and !is_bool($this->cp["regionidkecown"]->GetValue())) 
            $this->cp["regionidkecown"]->SetValue($this->p_region_id_kec_owner->GetValue(true));
        if (!is_null($this->cp["regionidown"]->GetValue()) and !strlen($this->cp["regionidown"]->GetText()) and !is_bool($this->cp["regionidown"]->GetValue())) 
            $this->cp["regionidown"]->SetValue($this->p_region_id_owner->GetValue(true));
        if (!is_null($this->cp["companyname"]->GetValue()) and !strlen($this->cp["companyname"]->GetText()) and !is_bool($this->cp["companyname"]->GetValue())) 
            $this->cp["companyname"]->SetValue($this->company_name->GetValue(true));
        if (!is_null($this->cp["addressname"]->GetValue()) and !strlen($this->cp["addressname"]->GetText()) and !is_bool($this->cp["addressname"]->GetValue())) 
            $this->cp["addressname"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["jobid"]->GetValue()) and !strlen($this->cp["jobid"]->GetText()) and !is_bool($this->cp["jobid"]->GetValue())) 
            $this->cp["jobid"]->SetValue($this->p_job_position_id->GetValue(true));
        if (!is_null($this->cp["companybrand"]->GetValue()) and !strlen($this->cp["companybrand"]->GetText()) and !is_bool($this->cp["companybrand"]->GetValue())) 
            $this->cp["companybrand"]->SetValue($this->company_brand->GetValue(true));
        if (!is_null($this->cp["addressno"]->GetValue()) and !strlen($this->cp["addressno"]->GetText()) and !is_bool($this->cp["addressno"]->GetValue())) 
            $this->cp["addressno"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["addressrt"]->GetValue()) and !strlen($this->cp["addressrt"]->GetText()) and !is_bool($this->cp["addressrt"]->GetValue())) 
            $this->cp["addressrt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["addressrw"]->GetValue()) and !strlen($this->cp["addressrw"]->GetText()) and !is_bool($this->cp["addressrw"]->GetValue())) 
            $this->cp["addressrw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["addressnoown"]->GetValue()) and !strlen($this->cp["addressnoown"]->GetText()) and !is_bool($this->cp["addressnoown"]->GetValue())) 
            $this->cp["addressnoown"]->SetValue($this->address_no_owner->GetValue(true));
        if (!is_null($this->cp["addressrtown"]->GetValue()) and !strlen($this->cp["addressrtown"]->GetText()) and !is_bool($this->cp["addressrtown"]->GetValue())) 
            $this->cp["addressrtown"]->SetValue($this->address_rt_owner->GetValue(true));
        if (!is_null($this->cp["addressrwown"]->GetValue()) and !strlen($this->cp["addressrwown"]->GetText()) and !is_bool($this->cp["addressrwown"]->GetValue())) 
            $this->cp["addressrwown"]->SetValue($this->address_rw_owner->GetValue(true));
        if (!is_null($this->cp["phoneno"]->GetValue()) and !strlen($this->cp["phoneno"]->GetText()) and !is_bool($this->cp["phoneno"]->GetValue())) 
            $this->cp["phoneno"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["faxno"]->GetValue()) and !strlen($this->cp["faxno"]->GetText()) and !is_bool($this->cp["faxno"]->GetValue())) 
            $this->cp["faxno"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zipcode"]->GetValue()) and !strlen($this->cp["zipcode"]->GetText()) and !is_bool($this->cp["zipcode"]->GetValue())) 
            $this->cp["zipcode"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["phonenoown"]->GetValue()) and !strlen($this->cp["phonenoown"]->GetText()) and !is_bool($this->cp["phonenoown"]->GetValue())) 
            $this->cp["phonenoown"]->SetValue($this->phone_no_owner->GetValue(true));
        if (!is_null($this->cp["companyown"]->GetValue()) and !strlen($this->cp["companyown"]->GetText()) and !is_bool($this->cp["companyown"]->GetValue())) 
            $this->cp["companyown"]->SetValue($this->company_owner->GetValue(true));
        if (!is_null($this->cp["mobilenoown"]->GetValue()) and !strlen($this->cp["mobilenoown"]->GetText()) and !is_bool($this->cp["mobilenoown"]->GetValue())) 
            $this->cp["mobilenoown"]->SetValue($this->mobile_no_owner->GetValue(true));
        if (!is_null($this->cp["faxnoown"]->GetValue()) and !strlen($this->cp["faxnoown"]->GetText()) and !is_bool($this->cp["faxnoown"]->GetValue())) 
            $this->cp["faxnoown"]->SetValue($this->fax_no_owner->GetValue(true));
        if (!is_null($this->cp["zipcodeown"]->GetValue()) and !strlen($this->cp["zipcodeown"]->GetText()) and !is_bool($this->cp["zipcodeown"]->GetValue())) 
            $this->cp["zipcodeown"]->SetValue($this->zip_code_owner->GetValue(true));
        if (!is_null($this->cp["mobileno"]->GetValue()) and !strlen($this->cp["mobileno"]->GetText()) and !is_bool($this->cp["mobileno"]->GetValue())) 
            $this->cp["mobileno"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["addressnameown"]->GetValue()) and !strlen($this->cp["addressnameown"]->GetText()) and !is_bool($this->cp["addressnameown"]->GetValue())) 
            $this->cp["addressnameown"]->SetValue($this->address_name_owner->GetValue(true));
        if (!is_null($this->cp["i_email"]->GetValue()) and !strlen($this->cp["i_email"]->GetText()) and !is_bool($this->cp["i_email"]->GetValue())) 
            $this->cp["i_email"]->SetValue($this->email->GetValue(true));
        if (!is_null($this->cp["vattypedtlid"]->GetValue()) and !strlen($this->cp["vattypedtlid"]->GetText()) and !is_bool($this->cp["vattypedtlid"]->GetValue())) 
            $this->cp["vattypedtlid"]->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        if (!is_null($this->cp["wpusername"]->GetValue()) and !strlen($this->cp["wpusername"]->GetText()) and !is_bool($this->cp["wpusername"]->GetValue())) 
            $this->cp["wpusername"]->SetValue($this->wp_user_name->GetValue(true));
        if (!is_null($this->cp["wpuserpwd"]->GetValue()) and !strlen($this->cp["wpuserpwd"]->GetText()) and !is_bool($this->cp["wpuserpwd"]->GetValue())) 
            $this->cp["wpuserpwd"]->SetValue($this->wp_user_pwd->GetValue(true));
        if (!is_null($this->cp["wpname"]->GetValue()) and !strlen($this->cp["wpname"]->GetText()) and !is_bool($this->cp["wpname"]->GetValue())) 
            $this->cp["wpname"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["wpaddressname"]->GetValue()) and !strlen($this->cp["wpaddressname"]->GetText()) and !is_bool($this->cp["wpaddressname"]->GetValue())) 
            $this->cp["wpaddressname"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["wpaddressno"]->GetValue()) and !strlen($this->cp["wpaddressno"]->GetText()) and !is_bool($this->cp["wpaddressno"]->GetValue())) 
            $this->cp["wpaddressno"]->SetValue($this->wp_address_no->GetValue(true));
        if (!is_null($this->cp["wprt"]->GetValue()) and !strlen($this->cp["wprt"]->GetText()) and !is_bool($this->cp["wprt"]->GetValue())) 
            $this->cp["wprt"]->SetValue($this->wp_address_rt->GetValue(true));
        if (!is_null($this->cp["wprw"]->GetValue()) and !strlen($this->cp["wprw"]->GetText()) and !is_bool($this->cp["wprw"]->GetValue())) 
            $this->cp["wprw"]->SetValue($this->wp_address_rw->GetValue(true));
        if (!is_null($this->cp["wpkel"]->GetValue()) and !strlen($this->cp["wpkel"]->GetText()) and !is_bool($this->cp["wpkel"]->GetValue())) 
            $this->cp["wpkel"]->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["wpkec"]->GetValue()) and !strlen($this->cp["wpkec"]->GetText()) and !is_bool($this->cp["wpkec"]->GetValue())) 
            $this->cp["wpkec"]->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["wpkota"]->GetValue()) and !strlen($this->cp["wpkota"]->GetText()) and !is_bool($this->cp["wpkota"]->GetValue())) 
            $this->cp["wpkota"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!is_null($this->cp["wpphoneno"]->GetValue()) and !strlen($this->cp["wpphoneno"]->GetText()) and !is_bool($this->cp["wpphoneno"]->GetValue())) 
            $this->cp["wpphoneno"]->SetValue($this->wp_phone_no->GetValue(true));
        if (!is_null($this->cp["wpmobileno"]->GetValue()) and !strlen($this->cp["wpmobileno"]->GetText()) and !is_bool($this->cp["wpmobileno"]->GetValue())) 
            $this->cp["wpmobileno"]->SetValue($this->wp_mobile_no->GetValue(true));
        if (!is_null($this->cp["wpfaxno"]->GetValue()) and !strlen($this->cp["wpfaxno"]->GetText()) and !is_bool($this->cp["wpfaxno"]->GetValue())) 
            $this->cp["wpfaxno"]->SetValue($this->wp_fax_no->GetValue(true));
        if (!is_null($this->cp["wpzipcode"]->GetValue()) and !strlen($this->cp["wpzipcode"]->GetText()) and !is_bool($this->cp["wpzipcode"]->GetValue())) 
            $this->cp["wpzipcode"]->SetValue($this->wp_zip_code->GetValue(true));
        if (!is_null($this->cp["wpemail"]->GetValue()) and !strlen($this->cp["wpemail"]->GetText()) and !is_bool($this->cp["wpemail"]->GetValue())) 
            $this->cp["wpemail"]->SetValue($this->wp_email->GetValue(true));
        if (!is_null($this->cp["brandaddress"]->GetValue()) and !strlen($this->cp["brandaddress"]->GetText()) and !is_bool($this->cp["brandaddress"]->GetValue())) 
            $this->cp["brandaddress"]->SetValue($this->brand_address_name->GetValue(true));
        if (!is_null($this->cp["brandno"]->GetValue()) and !strlen($this->cp["brandno"]->GetText()) and !is_bool($this->cp["brandno"]->GetValue())) 
            $this->cp["brandno"]->SetValue($this->brand_address_no->GetValue(true));
        if (!is_null($this->cp["brandrt"]->GetValue()) and !strlen($this->cp["brandrt"]->GetText()) and !is_bool($this->cp["brandrt"]->GetValue())) 
            $this->cp["brandrt"]->SetValue($this->brand_address_rt->GetValue(true));
        if (!is_null($this->cp["brandrw"]->GetValue()) and !strlen($this->cp["brandrw"]->GetText()) and !is_bool($this->cp["brandrw"]->GetValue())) 
            $this->cp["brandrw"]->SetValue($this->brand_address_rw->GetValue(true));
        if (!is_null($this->cp["brandkel"]->GetValue()) and !strlen($this->cp["brandkel"]->GetText()) and !is_bool($this->cp["brandkel"]->GetValue())) 
            $this->cp["brandkel"]->SetValue($this->brand_p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["brandkec"]->GetValue()) and !strlen($this->cp["brandkec"]->GetText()) and !is_bool($this->cp["brandkec"]->GetValue())) 
            $this->cp["brandkec"]->SetValue($this->brand_p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["brandkota"]->GetValue()) and !strlen($this->cp["brandkota"]->GetText()) and !is_bool($this->cp["brandkota"]->GetValue())) 
            $this->cp["brandkota"]->SetValue($this->brand_p_region_id->GetValue(true));
        if (!is_null($this->cp["brandphoneno"]->GetValue()) and !strlen($this->cp["brandphoneno"]->GetText()) and !is_bool($this->cp["brandphoneno"]->GetValue())) 
            $this->cp["brandphoneno"]->SetValue($this->brand_phone_no->GetValue(true));
        if (!is_null($this->cp["brandmobileno"]->GetValue()) and !strlen($this->cp["brandmobileno"]->GetText()) and !is_bool($this->cp["brandmobileno"]->GetValue())) 
            $this->cp["brandmobileno"]->SetValue($this->brand_mobile_no->GetValue(true));
        if (!is_null($this->cp["brandfaxno"]->GetValue()) and !strlen($this->cp["brandfaxno"]->GetText()) and !is_bool($this->cp["brandfaxno"]->GetValue())) 
            $this->cp["brandfaxno"]->SetValue($this->brand_fax_no->GetValue(true));
        if (!is_null($this->cp["brandzipcode"]->GetValue()) and !strlen($this->cp["brandzipcode"]->GetText()) and !is_bool($this->cp["brandzipcode"]->GetValue())) 
            $this->cp["brandzipcode"]->SetValue($this->brand_zip_code->GetValue(true));
        if (!is_null($this->cp["idvat"]->GetValue()) and !strlen($this->cp["idvat"]->GetText()) and !is_bool($this->cp["idvat"]->GetValue())) 
            $this->cp["idvat"]->SetText(CCGetFromGet("idvat", NULL));
        if (!is_null($this->cp["questionid"]->GetValue()) and !strlen($this->cp["questionid"]->GetText()) and !is_bool($this->cp["questionid"]->GetValue())) 
            $this->cp["questionid"]->SetValue($this->p_private_question_id->GetValue(true));
        if (!is_null($this->cp["privateanswer"]->GetValue()) and !strlen($this->cp["privateanswer"]->GetText()) and !is_bool($this->cp["privateanswer"]->GetValue())) 
            $this->cp["privateanswer"]->SetValue($this->private_answer->GetValue(true));
        if (!is_null($this->cp["i_mode"]->GetValue()) and !strlen($this->cp["i_mode"]->GetText()) and !is_bool($this->cp["i_mode"]->GetValue())) 
            $this->cp["i_mode"]->SetValue('I');
        $this->SQL = "SELECT f_crud_vat_reg (" . $this->ToSQL($this->cp["icode"]->GetDBValue(), $this->cp["icode"]->DataType) . ", "
             . $this->ToSQL($this->cp["iuser"]->GetDBValue(), $this->cp["iuser"]->DataType) . ", "
             . $this->ToSQL($this->cp["cusorderid"]->GetDBValue(), $this->cp["cusorderid"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkel"]->GetDBValue(), $this->cp["regionidkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkec"]->GetDBValue(), $this->cp["regionidkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionid"]->GetDBValue(), $this->cp["regionid"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkelown"]->GetDBValue(), $this->cp["regionidkelown"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkecown"]->GetDBValue(), $this->cp["regionidkecown"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidown"]->GetDBValue(), $this->cp["regionidown"]->DataType) . ", "
             . $this->ToSQL($this->cp["companyname"]->GetDBValue(), $this->cp["companyname"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressname"]->GetDBValue(), $this->cp["addressname"]->DataType) . ", "
             . $this->ToSQL($this->cp["jobid"]->GetDBValue(), $this->cp["jobid"]->DataType) . ", "
             . $this->ToSQL($this->cp["companybrand"]->GetDBValue(), $this->cp["companybrand"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressno"]->GetDBValue(), $this->cp["addressno"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrt"]->GetDBValue(), $this->cp["addressrt"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrw"]->GetDBValue(), $this->cp["addressrw"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressnoown"]->GetDBValue(), $this->cp["addressnoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrtown"]->GetDBValue(), $this->cp["addressrtown"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrwown"]->GetDBValue(), $this->cp["addressrwown"]->DataType) . ", "
             . $this->ToSQL($this->cp["phoneno"]->GetDBValue(), $this->cp["phoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["faxno"]->GetDBValue(), $this->cp["faxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["zipcode"]->GetDBValue(), $this->cp["zipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["phonenoown"]->GetDBValue(), $this->cp["phonenoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["companyown"]->GetDBValue(), $this->cp["companyown"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobilenoown"]->GetDBValue(), $this->cp["mobilenoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["faxnoown"]->GetDBValue(), $this->cp["faxnoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["zipcodeown"]->GetDBValue(), $this->cp["zipcodeown"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobileno"]->GetDBValue(), $this->cp["mobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressnameown"]->GetDBValue(), $this->cp["addressnameown"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_email"]->GetDBValue(), $this->cp["i_email"]->DataType) . ", "
             . $this->ToSQL($this->cp["vattypedtlid"]->GetDBValue(), $this->cp["vattypedtlid"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpusername"]->GetDBValue(), $this->cp["wpusername"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpuserpwd"]->GetDBValue(), $this->cp["wpuserpwd"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpname"]->GetDBValue(), $this->cp["wpname"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpaddressname"]->GetDBValue(), $this->cp["wpaddressname"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpaddressno"]->GetDBValue(), $this->cp["wpaddressno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wprt"]->GetDBValue(), $this->cp["wprt"]->DataType) . ", "
             . $this->ToSQL($this->cp["wprw"]->GetDBValue(), $this->cp["wprw"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkel"]->GetDBValue(), $this->cp["wpkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkec"]->GetDBValue(), $this->cp["wpkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkota"]->GetDBValue(), $this->cp["wpkota"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpphoneno"]->GetDBValue(), $this->cp["wpphoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpmobileno"]->GetDBValue(), $this->cp["wpmobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpfaxno"]->GetDBValue(), $this->cp["wpfaxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpzipcode"]->GetDBValue(), $this->cp["wpzipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpemail"]->GetDBValue(), $this->cp["wpemail"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandaddress"]->GetDBValue(), $this->cp["brandaddress"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandno"]->GetDBValue(), $this->cp["brandno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandrt"]->GetDBValue(), $this->cp["brandrt"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandrw"]->GetDBValue(), $this->cp["brandrw"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkel"]->GetDBValue(), $this->cp["brandkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkec"]->GetDBValue(), $this->cp["brandkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkota"]->GetDBValue(), $this->cp["brandkota"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandphoneno"]->GetDBValue(), $this->cp["brandphoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandmobileno"]->GetDBValue(), $this->cp["brandmobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandfaxno"]->GetDBValue(), $this->cp["brandfaxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandzipcode"]->GetDBValue(), $this->cp["brandzipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["idvat"]->GetDBValue(), $this->cp["idvat"]->DataType) . ", "
             . $this->ToSQL($this->cp["questionid"]->GetDBValue(), $this->cp["questionid"]->DataType) . ", "
             . $this->ToSQL($this->cp["privateanswer"]->GetDBValue(), $this->cp["privateanswer"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_mode"]->GetDBValue(), $this->cp["i_mode"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
		if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
			while ($this->next_record()){
			$hasil = $this->f("f_crud_vat_reg");
			}
			
			if($hasil == "NOT OK"){
				$this->Errors->addError("Kode Verifikasi Salah");
				return;
			}
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-571EC9C6
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["o_res"] = new clsSQLParameter("urlo_res", ccsText, "", "", CCGetFromGet("o_res", NULL), "", false, $this->ErrorBlock);
        $this->cp["icode"] = new clsSQLParameter("urlicode", ccsText, "", "", CCGetFromGet("icode", NULL), "", false, $this->ErrorBlock);
        $this->cp["iuser"] = new clsSQLParameter("exprKey907", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["cusorderid"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkel"] = new clsSQLParameter("ctrlp_region_id_kelurahan", ccsFloat, "", "", $this->p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkec"] = new clsSQLParameter("ctrlp_region_id_kecamatan", ccsFloat, "", "", $this->p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionid"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkelown"] = new clsSQLParameter("ctrlp_region_id_kel_owner", ccsFloat, "", "", $this->p_region_id_kel_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidkecown"] = new clsSQLParameter("ctrlp_region_id_kec_owner", ccsFloat, "", "", $this->p_region_id_kec_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["regionidown"] = new clsSQLParameter("ctrlp_region_id_owner", ccsFloat, "", "", $this->p_region_id_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["companyname"] = new clsSQLParameter("ctrlcompany_name", ccsText, "", "", $this->company_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressname"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["jobid"] = new clsSQLParameter("ctrlp_job_position_id", ccsFloat, "", "", $this->p_job_position_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["companybrand"] = new clsSQLParameter("ctrlcompany_brand", ccsText, "", "", $this->company_brand->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressno"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressnoown"] = new clsSQLParameter("ctrladdress_no_owner", ccsText, "", "", $this->address_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrtown"] = new clsSQLParameter("ctrladdress_rt_owner", ccsText, "", "", $this->address_rt_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressrwown"] = new clsSQLParameter("ctrladdress_rw_owner", ccsText, "", "", $this->address_rw_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phoneno"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["faxno"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zipcode"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phonenoown"] = new clsSQLParameter("ctrlphone_no_owner", ccsText, "", "", $this->phone_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["companyown"] = new clsSQLParameter("ctrlcompany_owner", ccsText, "", "", $this->company_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobilenoown"] = new clsSQLParameter("ctrlmobile_no_owner", ccsText, "", "", $this->mobile_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["faxnoown"] = new clsSQLParameter("ctrlfax_no_owner", ccsText, "", "", $this->fax_no_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["zipcodeown"] = new clsSQLParameter("ctrlzip_code_owner", ccsText, "", "", $this->zip_code_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobileno"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["addressnameown"] = new clsSQLParameter("ctrladdress_name_owner", ccsText, "", "", $this->address_name_owner->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_email"] = new clsSQLParameter("ctrlemail", ccsText, "", "", $this->email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["vattypedtlid"] = new clsSQLParameter("ctrlp_vat_type_dtl_id", ccsFloat, "", "", $this->p_vat_type_dtl_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpusername"] = new clsSQLParameter("ctrlwp_user_name", ccsText, "", "", $this->wp_user_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpuserpwd"] = new clsSQLParameter("ctrlwp_user_pwd", ccsText, "", "", $this->wp_user_pwd->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpname"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpaddressname"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpaddressno"] = new clsSQLParameter("ctrlwp_address_no", ccsText, "", "", $this->wp_address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wprt"] = new clsSQLParameter("ctrlwp_address_rt", ccsText, "", "", $this->wp_address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wprw"] = new clsSQLParameter("ctrlwp_address_rw", ccsText, "", "", $this->wp_address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpkel"] = new clsSQLParameter("ctrlwp_p_region_id_kelurahan", ccsFloat, "", "", $this->wp_p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpkec"] = new clsSQLParameter("ctrlwp_p_region_id_kecamatan", ccsFloat, "", "", $this->wp_p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpkota"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpphoneno"] = new clsSQLParameter("ctrlwp_phone_no", ccsText, "", "", $this->wp_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpmobileno"] = new clsSQLParameter("ctrlwp_mobile_no", ccsText, "", "", $this->wp_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpfaxno"] = new clsSQLParameter("ctrlwp_fax_no", ccsText, "", "", $this->wp_fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpzipcode"] = new clsSQLParameter("ctrlwp_zip_code", ccsText, "", "", $this->wp_zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wpemail"] = new clsSQLParameter("ctrlwp_email", ccsText, "", "", $this->wp_email->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandaddress"] = new clsSQLParameter("ctrlbrand_address_name", ccsText, "", "", $this->brand_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandno"] = new clsSQLParameter("ctrlbrand_address_no", ccsText, "", "", $this->brand_address_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandrt"] = new clsSQLParameter("ctrlbrand_address_rt", ccsText, "", "", $this->brand_address_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandrw"] = new clsSQLParameter("ctrlbrand_address_rw", ccsText, "", "", $this->brand_address_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandkel"] = new clsSQLParameter("ctrlbrand_p_region_id_kel", ccsFloat, "", "", $this->brand_p_region_id_kel->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandkec"] = new clsSQLParameter("ctrlbrand_p_region_id_kec", ccsFloat, "", "", $this->brand_p_region_id_kec->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandkota"] = new clsSQLParameter("ctrlbrand_p_region_id", ccsFloat, "", "", $this->brand_p_region_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandphoneno"] = new clsSQLParameter("ctrlbrand_phone_no", ccsText, "", "", $this->brand_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandmobileno"] = new clsSQLParameter("ctrlbrand_mobile_no", ccsText, "", "", $this->brand_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandfaxno"] = new clsSQLParameter("ctrlbrand_fax_no", ccsText, "", "", $this->brand_fax_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["brandzipcode"] = new clsSQLParameter("ctrlbrand_zip_code", ccsText, "", "", $this->brand_zip_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["idvat"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["questionid"] = new clsSQLParameter("ctrlp_private_question_id", ccsFloat, "", "", $this->p_private_question_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["privateanswer"] = new clsSQLParameter("ctrlprivate_answer", ccsText, "", "", $this->private_answer->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["i_mode"] = new clsSQLParameter("exprKey970", ccsText, "", "", 'U', "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["o_res"]->GetValue()) and !strlen($this->cp["o_res"]->GetText()) and !is_bool($this->cp["o_res"]->GetValue())) 
            $this->cp["o_res"]->SetText(CCGetFromGet("o_res", NULL));
        if (!is_null($this->cp["icode"]->GetValue()) and !strlen($this->cp["icode"]->GetText()) and !is_bool($this->cp["icode"]->GetValue())) 
            $this->cp["icode"]->SetText(CCGetFromGet("icode", NULL));
        if (!is_null($this->cp["iuser"]->GetValue()) and !strlen($this->cp["iuser"]->GetText()) and !is_bool($this->cp["iuser"]->GetValue())) 
            $this->cp["iuser"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["cusorderid"]->GetValue()) and !strlen($this->cp["cusorderid"]->GetText()) and !is_bool($this->cp["cusorderid"]->GetValue())) 
            $this->cp["cusorderid"]->SetValue($this->t_customer_order_id->GetValue(true));
        if (!is_null($this->cp["regionidkel"]->GetValue()) and !strlen($this->cp["regionidkel"]->GetText()) and !is_bool($this->cp["regionidkel"]->GetValue())) 
            $this->cp["regionidkel"]->SetValue($this->p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["regionidkec"]->GetValue()) and !strlen($this->cp["regionidkec"]->GetText()) and !is_bool($this->cp["regionidkec"]->GetValue())) 
            $this->cp["regionidkec"]->SetValue($this->p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["regionid"]->GetValue()) and !strlen($this->cp["regionid"]->GetText()) and !is_bool($this->cp["regionid"]->GetValue())) 
            $this->cp["regionid"]->SetValue($this->p_region_id->GetValue(true));
        if (!is_null($this->cp["regionidkelown"]->GetValue()) and !strlen($this->cp["regionidkelown"]->GetText()) and !is_bool($this->cp["regionidkelown"]->GetValue())) 
            $this->cp["regionidkelown"]->SetValue($this->p_region_id_kel_owner->GetValue(true));
        if (!is_null($this->cp["regionidkecown"]->GetValue()) and !strlen($this->cp["regionidkecown"]->GetText()) and !is_bool($this->cp["regionidkecown"]->GetValue())) 
            $this->cp["regionidkecown"]->SetValue($this->p_region_id_kec_owner->GetValue(true));
        if (!is_null($this->cp["regionidown"]->GetValue()) and !strlen($this->cp["regionidown"]->GetText()) and !is_bool($this->cp["regionidown"]->GetValue())) 
            $this->cp["regionidown"]->SetValue($this->p_region_id_owner->GetValue(true));
        if (!is_null($this->cp["companyname"]->GetValue()) and !strlen($this->cp["companyname"]->GetText()) and !is_bool($this->cp["companyname"]->GetValue())) 
            $this->cp["companyname"]->SetValue($this->company_name->GetValue(true));
        if (!is_null($this->cp["addressname"]->GetValue()) and !strlen($this->cp["addressname"]->GetText()) and !is_bool($this->cp["addressname"]->GetValue())) 
            $this->cp["addressname"]->SetValue($this->address_name->GetValue(true));
        if (!is_null($this->cp["jobid"]->GetValue()) and !strlen($this->cp["jobid"]->GetText()) and !is_bool($this->cp["jobid"]->GetValue())) 
            $this->cp["jobid"]->SetValue($this->p_job_position_id->GetValue(true));
        if (!is_null($this->cp["companybrand"]->GetValue()) and !strlen($this->cp["companybrand"]->GetText()) and !is_bool($this->cp["companybrand"]->GetValue())) 
            $this->cp["companybrand"]->SetValue($this->company_brand->GetValue(true));
        if (!is_null($this->cp["addressno"]->GetValue()) and !strlen($this->cp["addressno"]->GetText()) and !is_bool($this->cp["addressno"]->GetValue())) 
            $this->cp["addressno"]->SetValue($this->address_no->GetValue(true));
        if (!is_null($this->cp["addressrt"]->GetValue()) and !strlen($this->cp["addressrt"]->GetText()) and !is_bool($this->cp["addressrt"]->GetValue())) 
            $this->cp["addressrt"]->SetValue($this->address_rt->GetValue(true));
        if (!is_null($this->cp["addressrw"]->GetValue()) and !strlen($this->cp["addressrw"]->GetText()) and !is_bool($this->cp["addressrw"]->GetValue())) 
            $this->cp["addressrw"]->SetValue($this->address_rw->GetValue(true));
        if (!is_null($this->cp["addressnoown"]->GetValue()) and !strlen($this->cp["addressnoown"]->GetText()) and !is_bool($this->cp["addressnoown"]->GetValue())) 
            $this->cp["addressnoown"]->SetValue($this->address_no_owner->GetValue(true));
        if (!is_null($this->cp["addressrtown"]->GetValue()) and !strlen($this->cp["addressrtown"]->GetText()) and !is_bool($this->cp["addressrtown"]->GetValue())) 
            $this->cp["addressrtown"]->SetValue($this->address_rt_owner->GetValue(true));
        if (!is_null($this->cp["addressrwown"]->GetValue()) and !strlen($this->cp["addressrwown"]->GetText()) and !is_bool($this->cp["addressrwown"]->GetValue())) 
            $this->cp["addressrwown"]->SetValue($this->address_rw_owner->GetValue(true));
        if (!is_null($this->cp["phoneno"]->GetValue()) and !strlen($this->cp["phoneno"]->GetText()) and !is_bool($this->cp["phoneno"]->GetValue())) 
            $this->cp["phoneno"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["faxno"]->GetValue()) and !strlen($this->cp["faxno"]->GetText()) and !is_bool($this->cp["faxno"]->GetValue())) 
            $this->cp["faxno"]->SetValue($this->fax_no->GetValue(true));
        if (!is_null($this->cp["zipcode"]->GetValue()) and !strlen($this->cp["zipcode"]->GetText()) and !is_bool($this->cp["zipcode"]->GetValue())) 
            $this->cp["zipcode"]->SetValue($this->zip_code->GetValue(true));
        if (!is_null($this->cp["phonenoown"]->GetValue()) and !strlen($this->cp["phonenoown"]->GetText()) and !is_bool($this->cp["phonenoown"]->GetValue())) 
            $this->cp["phonenoown"]->SetValue($this->phone_no_owner->GetValue(true));
        if (!is_null($this->cp["companyown"]->GetValue()) and !strlen($this->cp["companyown"]->GetText()) and !is_bool($this->cp["companyown"]->GetValue())) 
            $this->cp["companyown"]->SetValue($this->company_owner->GetValue(true));
        if (!is_null($this->cp["mobilenoown"]->GetValue()) and !strlen($this->cp["mobilenoown"]->GetText()) and !is_bool($this->cp["mobilenoown"]->GetValue())) 
            $this->cp["mobilenoown"]->SetValue($this->mobile_no_owner->GetValue(true));
        if (!is_null($this->cp["faxnoown"]->GetValue()) and !strlen($this->cp["faxnoown"]->GetText()) and !is_bool($this->cp["faxnoown"]->GetValue())) 
            $this->cp["faxnoown"]->SetValue($this->fax_no_owner->GetValue(true));
        if (!is_null($this->cp["zipcodeown"]->GetValue()) and !strlen($this->cp["zipcodeown"]->GetText()) and !is_bool($this->cp["zipcodeown"]->GetValue())) 
            $this->cp["zipcodeown"]->SetValue($this->zip_code_owner->GetValue(true));
        if (!is_null($this->cp["mobileno"]->GetValue()) and !strlen($this->cp["mobileno"]->GetText()) and !is_bool($this->cp["mobileno"]->GetValue())) 
            $this->cp["mobileno"]->SetValue($this->mobile_no->GetValue(true));
        if (!is_null($this->cp["addressnameown"]->GetValue()) and !strlen($this->cp["addressnameown"]->GetText()) and !is_bool($this->cp["addressnameown"]->GetValue())) 
            $this->cp["addressnameown"]->SetValue($this->address_name_owner->GetValue(true));
        if (!is_null($this->cp["i_email"]->GetValue()) and !strlen($this->cp["i_email"]->GetText()) and !is_bool($this->cp["i_email"]->GetValue())) 
            $this->cp["i_email"]->SetValue($this->email->GetValue(true));
        if (!is_null($this->cp["vattypedtlid"]->GetValue()) and !strlen($this->cp["vattypedtlid"]->GetText()) and !is_bool($this->cp["vattypedtlid"]->GetValue())) 
            $this->cp["vattypedtlid"]->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        if (!is_null($this->cp["wpusername"]->GetValue()) and !strlen($this->cp["wpusername"]->GetText()) and !is_bool($this->cp["wpusername"]->GetValue())) 
            $this->cp["wpusername"]->SetValue($this->wp_user_name->GetValue(true));
        if (!is_null($this->cp["wpuserpwd"]->GetValue()) and !strlen($this->cp["wpuserpwd"]->GetText()) and !is_bool($this->cp["wpuserpwd"]->GetValue())) 
            $this->cp["wpuserpwd"]->SetValue($this->wp_user_pwd->GetValue(true));
        if (!is_null($this->cp["wpname"]->GetValue()) and !strlen($this->cp["wpname"]->GetText()) and !is_bool($this->cp["wpname"]->GetValue())) 
            $this->cp["wpname"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["wpaddressname"]->GetValue()) and !strlen($this->cp["wpaddressname"]->GetText()) and !is_bool($this->cp["wpaddressname"]->GetValue())) 
            $this->cp["wpaddressname"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["wpaddressno"]->GetValue()) and !strlen($this->cp["wpaddressno"]->GetText()) and !is_bool($this->cp["wpaddressno"]->GetValue())) 
            $this->cp["wpaddressno"]->SetValue($this->wp_address_no->GetValue(true));
        if (!is_null($this->cp["wprt"]->GetValue()) and !strlen($this->cp["wprt"]->GetText()) and !is_bool($this->cp["wprt"]->GetValue())) 
            $this->cp["wprt"]->SetValue($this->wp_address_rt->GetValue(true));
        if (!is_null($this->cp["wprw"]->GetValue()) and !strlen($this->cp["wprw"]->GetText()) and !is_bool($this->cp["wprw"]->GetValue())) 
            $this->cp["wprw"]->SetValue($this->wp_address_rw->GetValue(true));
        if (!is_null($this->cp["wpkel"]->GetValue()) and !strlen($this->cp["wpkel"]->GetText()) and !is_bool($this->cp["wpkel"]->GetValue())) 
            $this->cp["wpkel"]->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        if (!is_null($this->cp["wpkec"]->GetValue()) and !strlen($this->cp["wpkec"]->GetText()) and !is_bool($this->cp["wpkec"]->GetValue())) 
            $this->cp["wpkec"]->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        if (!is_null($this->cp["wpkota"]->GetValue()) and !strlen($this->cp["wpkota"]->GetText()) and !is_bool($this->cp["wpkota"]->GetValue())) 
            $this->cp["wpkota"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!is_null($this->cp["wpphoneno"]->GetValue()) and !strlen($this->cp["wpphoneno"]->GetText()) and !is_bool($this->cp["wpphoneno"]->GetValue())) 
            $this->cp["wpphoneno"]->SetValue($this->wp_phone_no->GetValue(true));
        if (!is_null($this->cp["wpmobileno"]->GetValue()) and !strlen($this->cp["wpmobileno"]->GetText()) and !is_bool($this->cp["wpmobileno"]->GetValue())) 
            $this->cp["wpmobileno"]->SetValue($this->wp_mobile_no->GetValue(true));
        if (!is_null($this->cp["wpfaxno"]->GetValue()) and !strlen($this->cp["wpfaxno"]->GetText()) and !is_bool($this->cp["wpfaxno"]->GetValue())) 
            $this->cp["wpfaxno"]->SetValue($this->wp_fax_no->GetValue(true));
        if (!is_null($this->cp["wpzipcode"]->GetValue()) and !strlen($this->cp["wpzipcode"]->GetText()) and !is_bool($this->cp["wpzipcode"]->GetValue())) 
            $this->cp["wpzipcode"]->SetValue($this->wp_zip_code->GetValue(true));
        if (!is_null($this->cp["wpemail"]->GetValue()) and !strlen($this->cp["wpemail"]->GetText()) and !is_bool($this->cp["wpemail"]->GetValue())) 
            $this->cp["wpemail"]->SetValue($this->wp_email->GetValue(true));
        if (!is_null($this->cp["brandaddress"]->GetValue()) and !strlen($this->cp["brandaddress"]->GetText()) and !is_bool($this->cp["brandaddress"]->GetValue())) 
            $this->cp["brandaddress"]->SetValue($this->brand_address_name->GetValue(true));
        if (!is_null($this->cp["brandno"]->GetValue()) and !strlen($this->cp["brandno"]->GetText()) and !is_bool($this->cp["brandno"]->GetValue())) 
            $this->cp["brandno"]->SetValue($this->brand_address_no->GetValue(true));
        if (!is_null($this->cp["brandrt"]->GetValue()) and !strlen($this->cp["brandrt"]->GetText()) and !is_bool($this->cp["brandrt"]->GetValue())) 
            $this->cp["brandrt"]->SetValue($this->brand_address_rt->GetValue(true));
        if (!is_null($this->cp["brandrw"]->GetValue()) and !strlen($this->cp["brandrw"]->GetText()) and !is_bool($this->cp["brandrw"]->GetValue())) 
            $this->cp["brandrw"]->SetValue($this->brand_address_rw->GetValue(true));
        if (!is_null($this->cp["brandkel"]->GetValue()) and !strlen($this->cp["brandkel"]->GetText()) and !is_bool($this->cp["brandkel"]->GetValue())) 
            $this->cp["brandkel"]->SetValue($this->brand_p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["brandkec"]->GetValue()) and !strlen($this->cp["brandkec"]->GetText()) and !is_bool($this->cp["brandkec"]->GetValue())) 
            $this->cp["brandkec"]->SetValue($this->brand_p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["brandkota"]->GetValue()) and !strlen($this->cp["brandkota"]->GetText()) and !is_bool($this->cp["brandkota"]->GetValue())) 
            $this->cp["brandkota"]->SetValue($this->brand_p_region_id->GetValue(true));
        if (!is_null($this->cp["brandphoneno"]->GetValue()) and !strlen($this->cp["brandphoneno"]->GetText()) and !is_bool($this->cp["brandphoneno"]->GetValue())) 
            $this->cp["brandphoneno"]->SetValue($this->brand_phone_no->GetValue(true));
        if (!is_null($this->cp["brandmobileno"]->GetValue()) and !strlen($this->cp["brandmobileno"]->GetText()) and !is_bool($this->cp["brandmobileno"]->GetValue())) 
            $this->cp["brandmobileno"]->SetValue($this->brand_mobile_no->GetValue(true));
        if (!is_null($this->cp["brandfaxno"]->GetValue()) and !strlen($this->cp["brandfaxno"]->GetText()) and !is_bool($this->cp["brandfaxno"]->GetValue())) 
            $this->cp["brandfaxno"]->SetValue($this->brand_fax_no->GetValue(true));
        if (!is_null($this->cp["brandzipcode"]->GetValue()) and !strlen($this->cp["brandzipcode"]->GetText()) and !is_bool($this->cp["brandzipcode"]->GetValue())) 
            $this->cp["brandzipcode"]->SetValue($this->brand_zip_code->GetValue(true));
        if (!is_null($this->cp["idvat"]->GetValue()) and !strlen($this->cp["idvat"]->GetText()) and !is_bool($this->cp["idvat"]->GetValue())) 
            $this->cp["idvat"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!is_null($this->cp["questionid"]->GetValue()) and !strlen($this->cp["questionid"]->GetText()) and !is_bool($this->cp["questionid"]->GetValue())) 
            $this->cp["questionid"]->SetValue($this->p_private_question_id->GetValue(true));
        if (!is_null($this->cp["privateanswer"]->GetValue()) and !strlen($this->cp["privateanswer"]->GetText()) and !is_bool($this->cp["privateanswer"]->GetValue())) 
            $this->cp["privateanswer"]->SetValue($this->private_answer->GetValue(true));
        if (!is_null($this->cp["i_mode"]->GetValue()) and !strlen($this->cp["i_mode"]->GetText()) and !is_bool($this->cp["i_mode"]->GetValue())) 
            $this->cp["i_mode"]->SetValue('U');
        $this->SQL = "SELECT f_crud_vat_reg (" . $this->ToSQL($this->cp["icode"]->GetDBValue(), $this->cp["icode"]->DataType) . ", "
             . $this->ToSQL($this->cp["iuser"]->GetDBValue(), $this->cp["iuser"]->DataType) . ", "
             . $this->ToSQL($this->cp["cusorderid"]->GetDBValue(), $this->cp["cusorderid"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkel"]->GetDBValue(), $this->cp["regionidkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkec"]->GetDBValue(), $this->cp["regionidkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionid"]->GetDBValue(), $this->cp["regionid"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkelown"]->GetDBValue(), $this->cp["regionidkelown"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkecown"]->GetDBValue(), $this->cp["regionidkecown"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidown"]->GetDBValue(), $this->cp["regionidown"]->DataType) . ", "
             . $this->ToSQL($this->cp["companyname"]->GetDBValue(), $this->cp["companyname"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressname"]->GetDBValue(), $this->cp["addressname"]->DataType) . ", "
             . $this->ToSQL($this->cp["jobid"]->GetDBValue(), $this->cp["jobid"]->DataType) . ", "
             . $this->ToSQL($this->cp["companybrand"]->GetDBValue(), $this->cp["companybrand"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressno"]->GetDBValue(), $this->cp["addressno"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrt"]->GetDBValue(), $this->cp["addressrt"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrw"]->GetDBValue(), $this->cp["addressrw"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressnoown"]->GetDBValue(), $this->cp["addressnoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrtown"]->GetDBValue(), $this->cp["addressrtown"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrwown"]->GetDBValue(), $this->cp["addressrwown"]->DataType) . ", "
             . $this->ToSQL($this->cp["phoneno"]->GetDBValue(), $this->cp["phoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["faxno"]->GetDBValue(), $this->cp["faxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["zipcode"]->GetDBValue(), $this->cp["zipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["phonenoown"]->GetDBValue(), $this->cp["phonenoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["companyown"]->GetDBValue(), $this->cp["companyown"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobilenoown"]->GetDBValue(), $this->cp["mobilenoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["faxnoown"]->GetDBValue(), $this->cp["faxnoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["zipcodeown"]->GetDBValue(), $this->cp["zipcodeown"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobileno"]->GetDBValue(), $this->cp["mobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressnameown"]->GetDBValue(), $this->cp["addressnameown"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_email"]->GetDBValue(), $this->cp["i_email"]->DataType) . ", "
             . $this->ToSQL($this->cp["vattypedtlid"]->GetDBValue(), $this->cp["vattypedtlid"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpusername"]->GetDBValue(), $this->cp["wpusername"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpuserpwd"]->GetDBValue(), $this->cp["wpuserpwd"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpname"]->GetDBValue(), $this->cp["wpname"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpaddressname"]->GetDBValue(), $this->cp["wpaddressname"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpaddressno"]->GetDBValue(), $this->cp["wpaddressno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wprt"]->GetDBValue(), $this->cp["wprt"]->DataType) . ", "
             . $this->ToSQL($this->cp["wprw"]->GetDBValue(), $this->cp["wprw"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkel"]->GetDBValue(), $this->cp["wpkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkec"]->GetDBValue(), $this->cp["wpkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkota"]->GetDBValue(), $this->cp["wpkota"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpphoneno"]->GetDBValue(), $this->cp["wpphoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpmobileno"]->GetDBValue(), $this->cp["wpmobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpfaxno"]->GetDBValue(), $this->cp["wpfaxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpzipcode"]->GetDBValue(), $this->cp["wpzipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpemail"]->GetDBValue(), $this->cp["wpemail"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandaddress"]->GetDBValue(), $this->cp["brandaddress"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandno"]->GetDBValue(), $this->cp["brandno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandrt"]->GetDBValue(), $this->cp["brandrt"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandrw"]->GetDBValue(), $this->cp["brandrw"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkel"]->GetDBValue(), $this->cp["brandkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkec"]->GetDBValue(), $this->cp["brandkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkota"]->GetDBValue(), $this->cp["brandkota"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandphoneno"]->GetDBValue(), $this->cp["brandphoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandmobileno"]->GetDBValue(), $this->cp["brandmobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandfaxno"]->GetDBValue(), $this->cp["brandfaxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandzipcode"]->GetDBValue(), $this->cp["brandzipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["idvat"]->GetDBValue(), $this->cp["idvat"]->DataType) . ", "
             . $this->ToSQL($this->cp["questionid"]->GetDBValue(), $this->cp["questionid"]->DataType) . ", "
             . $this->ToSQL($this->cp["privateanswer"]->GetDBValue(), $this->cp["privateanswer"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_mode"]->GetDBValue(), $this->cp["i_mode"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-D91DDDA9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["icode"] = new clsSQLParameter("urlicode", ccsText, "", "", CCGetFromGet("icode", NULL), "", false, $this->ErrorBlock);
        $this->cp["iuser"] = new clsSQLParameter("urliuser", ccsText, "", "", CCGetFromGet("iuser", NULL), "", false, $this->ErrorBlock);
        $this->cp["cusorderid"] = new clsSQLParameter("urlcusorderid", ccsFloat, "", "", CCGetFromGet("cusorderid", NULL), "", false, $this->ErrorBlock);
        $this->cp["regionidkel"] = new clsSQLParameter("urlregionidkel", ccsFloat, "", "", CCGetFromGet("regionidkel", NULL), "", false, $this->ErrorBlock);
        $this->cp["regionidkec"] = new clsSQLParameter("urlregionidkec", ccsFloat, "", "", CCGetFromGet("regionidkec", NULL), "", false, $this->ErrorBlock);
        $this->cp["regionid"] = new clsSQLParameter("urlregionid", ccsFloat, "", "", CCGetFromGet("regionid", NULL), "", false, $this->ErrorBlock);
        $this->cp["regionidkelown"] = new clsSQLParameter("urlregionidkelown", ccsFloat, "", "", CCGetFromGet("regionidkelown", NULL), "", false, $this->ErrorBlock);
        $this->cp["regionidkecown"] = new clsSQLParameter("urlregionidkecown", ccsFloat, "", "", CCGetFromGet("regionidkecown", NULL), "", false, $this->ErrorBlock);
        $this->cp["regionidown"] = new clsSQLParameter("urlregionidown", ccsFloat, "", "", CCGetFromGet("regionidown", NULL), "", false, $this->ErrorBlock);
        $this->cp["companyname"] = new clsSQLParameter("urlcompanyname", ccsText, "", "", CCGetFromGet("companyname", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressname"] = new clsSQLParameter("urladdressname", ccsText, "", "", CCGetFromGet("addressname", NULL), "", false, $this->ErrorBlock);
        $this->cp["jobid"] = new clsSQLParameter("urljobid", ccsFloat, "", "", CCGetFromGet("jobid", NULL), "", false, $this->ErrorBlock);
        $this->cp["companybrand"] = new clsSQLParameter("urlcompanybrand", ccsText, "", "", CCGetFromGet("companybrand", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressno"] = new clsSQLParameter("urladdressno", ccsText, "", "", CCGetFromGet("addressno", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressrt"] = new clsSQLParameter("urladdressrt", ccsText, "", "", CCGetFromGet("addressrt", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressrw"] = new clsSQLParameter("urladdressrw", ccsText, "", "", CCGetFromGet("addressrw", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressnoown"] = new clsSQLParameter("urladdressnoown", ccsText, "", "", CCGetFromGet("addressnoown", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressrtown"] = new clsSQLParameter("urladdressrtown", ccsText, "", "", CCGetFromGet("addressrtown", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressrwown"] = new clsSQLParameter("urladdressrwown", ccsText, "", "", CCGetFromGet("addressrwown", NULL), "", false, $this->ErrorBlock);
        $this->cp["phoneno"] = new clsSQLParameter("urlphoneno", ccsText, "", "", CCGetFromGet("phoneno", NULL), "", false, $this->ErrorBlock);
        $this->cp["faxno"] = new clsSQLParameter("urlfaxno", ccsText, "", "", CCGetFromGet("faxno", NULL), "", false, $this->ErrorBlock);
        $this->cp["zipcode"] = new clsSQLParameter("urlzipcode", ccsText, "", "", CCGetFromGet("zipcode", NULL), "", false, $this->ErrorBlock);
        $this->cp["phonenoown"] = new clsSQLParameter("urlphonenoown", ccsText, "", "", CCGetFromGet("phonenoown", NULL), "", false, $this->ErrorBlock);
        $this->cp["companyown"] = new clsSQLParameter("urlcompanyown", ccsText, "", "", CCGetFromGet("companyown", NULL), "", false, $this->ErrorBlock);
        $this->cp["mobilenoown"] = new clsSQLParameter("urlmobilenoown", ccsText, "", "", CCGetFromGet("mobilenoown", NULL), "", false, $this->ErrorBlock);
        $this->cp["faxnoown"] = new clsSQLParameter("urlfaxnoown", ccsText, "", "", CCGetFromGet("faxnoown", NULL), "", false, $this->ErrorBlock);
        $this->cp["zipcodeown"] = new clsSQLParameter("urlzipcodeown", ccsText, "", "", CCGetFromGet("zipcodeown", NULL), "", false, $this->ErrorBlock);
        $this->cp["mobileno"] = new clsSQLParameter("urlmobileno", ccsText, "", "", CCGetFromGet("mobileno", NULL), "", false, $this->ErrorBlock);
        $this->cp["addressnameown"] = new clsSQLParameter("urladdressnameown", ccsText, "", "", CCGetFromGet("addressnameown", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_email"] = new clsSQLParameter("urli_email", ccsText, "", "", CCGetFromGet("i_email", NULL), "", false, $this->ErrorBlock);
        $this->cp["vattypedtlid"] = new clsSQLParameter("urlvattypedtlid", ccsFloat, "", "", CCGetFromGet("vattypedtlid", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpusername"] = new clsSQLParameter("urlwpusername", ccsText, "", "", CCGetFromGet("wpusername", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpuserpwd"] = new clsSQLParameter("urlwpuserpwd", ccsText, "", "", CCGetFromGet("wpuserpwd", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpname"] = new clsSQLParameter("urlwpname", ccsText, "", "", CCGetFromGet("wpname", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpaddressname"] = new clsSQLParameter("urlwpaddressname", ccsText, "", "", CCGetFromGet("wpaddressname", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpaddressno"] = new clsSQLParameter("urlwpaddressno", ccsText, "", "", CCGetFromGet("wpaddressno", NULL), "", false, $this->ErrorBlock);
        $this->cp["wprt"] = new clsSQLParameter("urlwprt", ccsText, "", "", CCGetFromGet("wprt", NULL), "", false, $this->ErrorBlock);
        $this->cp["wprw"] = new clsSQLParameter("urlwprw", ccsText, "", "", CCGetFromGet("wprw", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpkel"] = new clsSQLParameter("urlwpkel", ccsFloat, "", "", CCGetFromGet("wpkel", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpkec"] = new clsSQLParameter("urlwpkec", ccsFloat, "", "", CCGetFromGet("wpkec", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpkota"] = new clsSQLParameter("urlwpkota", ccsFloat, "", "", CCGetFromGet("wpkota", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpphoneno"] = new clsSQLParameter("urlwpphoneno", ccsText, "", "", CCGetFromGet("wpphoneno", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpmobileno"] = new clsSQLParameter("urlwpmobileno", ccsText, "", "", CCGetFromGet("wpmobileno", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpfaxno"] = new clsSQLParameter("urlwpfaxno", ccsText, "", "", CCGetFromGet("wpfaxno", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpzipcode"] = new clsSQLParameter("urlwpzipcode", ccsText, "", "", CCGetFromGet("wpzipcode", NULL), "", false, $this->ErrorBlock);
        $this->cp["wpemail"] = new clsSQLParameter("urlwpemail", ccsText, "", "", CCGetFromGet("wpemail", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandaddress"] = new clsSQLParameter("urlbrandaddress", ccsText, "", "", CCGetFromGet("brandaddress", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandno"] = new clsSQLParameter("urlbrandno", ccsText, "", "", CCGetFromGet("brandno", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandrt"] = new clsSQLParameter("urlbrandrt", ccsText, "", "", CCGetFromGet("brandrt", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandrw"] = new clsSQLParameter("urlbrandrw", ccsText, "", "", CCGetFromGet("brandrw", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandkel"] = new clsSQLParameter("urlbrandkel", ccsFloat, "", "", CCGetFromGet("brandkel", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandkec"] = new clsSQLParameter("urlbrandkec", ccsFloat, "", "", CCGetFromGet("brandkec", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandkota"] = new clsSQLParameter("urlbrandkota", ccsFloat, "", "", CCGetFromGet("brandkota", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandphoneno"] = new clsSQLParameter("urlbrandphoneno", ccsText, "", "", CCGetFromGet("brandphoneno", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandmobileno"] = new clsSQLParameter("urlbrandmobileno", ccsText, "", "", CCGetFromGet("brandmobileno", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandfaxno"] = new clsSQLParameter("urlbrandfaxno", ccsText, "", "", CCGetFromGet("brandfaxno", NULL), "", false, $this->ErrorBlock);
        $this->cp["brandzipcode"] = new clsSQLParameter("urlbrandzipcode", ccsText, "", "", CCGetFromGet("brandzipcode", NULL), "", false, $this->ErrorBlock);
        $this->cp["idvat"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["questionid"] = new clsSQLParameter("urlquestionid", ccsFloat, "", "", CCGetFromGet("questionid", NULL), "", false, $this->ErrorBlock);
        $this->cp["privateanswer"] = new clsSQLParameter("urlprivateanswer", ccsText, "", "", CCGetFromGet("privateanswer", NULL), "", false, $this->ErrorBlock);
        $this->cp["i_mode"] = new clsSQLParameter("exprKey970", ccsText, "", "", 'D', "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["icode"]->GetValue()) and !strlen($this->cp["icode"]->GetText()) and !is_bool($this->cp["icode"]->GetValue())) 
            $this->cp["icode"]->SetText(CCGetFromGet("icode", NULL));
        if (!is_null($this->cp["iuser"]->GetValue()) and !strlen($this->cp["iuser"]->GetText()) and !is_bool($this->cp["iuser"]->GetValue())) 
            $this->cp["iuser"]->SetText(CCGetFromGet("iuser", NULL));
        if (!is_null($this->cp["cusorderid"]->GetValue()) and !strlen($this->cp["cusorderid"]->GetText()) and !is_bool($this->cp["cusorderid"]->GetValue())) 
            $this->cp["cusorderid"]->SetText(CCGetFromGet("cusorderid", NULL));
        if (!is_null($this->cp["regionidkel"]->GetValue()) and !strlen($this->cp["regionidkel"]->GetText()) and !is_bool($this->cp["regionidkel"]->GetValue())) 
            $this->cp["regionidkel"]->SetText(CCGetFromGet("regionidkel", NULL));
        if (!is_null($this->cp["regionidkec"]->GetValue()) and !strlen($this->cp["regionidkec"]->GetText()) and !is_bool($this->cp["regionidkec"]->GetValue())) 
            $this->cp["regionidkec"]->SetText(CCGetFromGet("regionidkec", NULL));
        if (!is_null($this->cp["regionid"]->GetValue()) and !strlen($this->cp["regionid"]->GetText()) and !is_bool($this->cp["regionid"]->GetValue())) 
            $this->cp["regionid"]->SetText(CCGetFromGet("regionid", NULL));
        if (!is_null($this->cp["regionidkelown"]->GetValue()) and !strlen($this->cp["regionidkelown"]->GetText()) and !is_bool($this->cp["regionidkelown"]->GetValue())) 
            $this->cp["regionidkelown"]->SetText(CCGetFromGet("regionidkelown", NULL));
        if (!is_null($this->cp["regionidkecown"]->GetValue()) and !strlen($this->cp["regionidkecown"]->GetText()) and !is_bool($this->cp["regionidkecown"]->GetValue())) 
            $this->cp["regionidkecown"]->SetText(CCGetFromGet("regionidkecown", NULL));
        if (!is_null($this->cp["regionidown"]->GetValue()) and !strlen($this->cp["regionidown"]->GetText()) and !is_bool($this->cp["regionidown"]->GetValue())) 
            $this->cp["regionidown"]->SetText(CCGetFromGet("regionidown", NULL));
        if (!is_null($this->cp["companyname"]->GetValue()) and !strlen($this->cp["companyname"]->GetText()) and !is_bool($this->cp["companyname"]->GetValue())) 
            $this->cp["companyname"]->SetText(CCGetFromGet("companyname", NULL));
        if (!is_null($this->cp["addressname"]->GetValue()) and !strlen($this->cp["addressname"]->GetText()) and !is_bool($this->cp["addressname"]->GetValue())) 
            $this->cp["addressname"]->SetText(CCGetFromGet("addressname", NULL));
        if (!is_null($this->cp["jobid"]->GetValue()) and !strlen($this->cp["jobid"]->GetText()) and !is_bool($this->cp["jobid"]->GetValue())) 
            $this->cp["jobid"]->SetText(CCGetFromGet("jobid", NULL));
        if (!is_null($this->cp["companybrand"]->GetValue()) and !strlen($this->cp["companybrand"]->GetText()) and !is_bool($this->cp["companybrand"]->GetValue())) 
            $this->cp["companybrand"]->SetText(CCGetFromGet("companybrand", NULL));
        if (!is_null($this->cp["addressno"]->GetValue()) and !strlen($this->cp["addressno"]->GetText()) and !is_bool($this->cp["addressno"]->GetValue())) 
            $this->cp["addressno"]->SetText(CCGetFromGet("addressno", NULL));
        if (!is_null($this->cp["addressrt"]->GetValue()) and !strlen($this->cp["addressrt"]->GetText()) and !is_bool($this->cp["addressrt"]->GetValue())) 
            $this->cp["addressrt"]->SetText(CCGetFromGet("addressrt", NULL));
        if (!is_null($this->cp["addressrw"]->GetValue()) and !strlen($this->cp["addressrw"]->GetText()) and !is_bool($this->cp["addressrw"]->GetValue())) 
            $this->cp["addressrw"]->SetText(CCGetFromGet("addressrw", NULL));
        if (!is_null($this->cp["addressnoown"]->GetValue()) and !strlen($this->cp["addressnoown"]->GetText()) and !is_bool($this->cp["addressnoown"]->GetValue())) 
            $this->cp["addressnoown"]->SetText(CCGetFromGet("addressnoown", NULL));
        if (!is_null($this->cp["addressrtown"]->GetValue()) and !strlen($this->cp["addressrtown"]->GetText()) and !is_bool($this->cp["addressrtown"]->GetValue())) 
            $this->cp["addressrtown"]->SetText(CCGetFromGet("addressrtown", NULL));
        if (!is_null($this->cp["addressrwown"]->GetValue()) and !strlen($this->cp["addressrwown"]->GetText()) and !is_bool($this->cp["addressrwown"]->GetValue())) 
            $this->cp["addressrwown"]->SetText(CCGetFromGet("addressrwown", NULL));
        if (!is_null($this->cp["phoneno"]->GetValue()) and !strlen($this->cp["phoneno"]->GetText()) and !is_bool($this->cp["phoneno"]->GetValue())) 
            $this->cp["phoneno"]->SetText(CCGetFromGet("phoneno", NULL));
        if (!is_null($this->cp["faxno"]->GetValue()) and !strlen($this->cp["faxno"]->GetText()) and !is_bool($this->cp["faxno"]->GetValue())) 
            $this->cp["faxno"]->SetText(CCGetFromGet("faxno", NULL));
        if (!is_null($this->cp["zipcode"]->GetValue()) and !strlen($this->cp["zipcode"]->GetText()) and !is_bool($this->cp["zipcode"]->GetValue())) 
            $this->cp["zipcode"]->SetText(CCGetFromGet("zipcode", NULL));
        if (!is_null($this->cp["phonenoown"]->GetValue()) and !strlen($this->cp["phonenoown"]->GetText()) and !is_bool($this->cp["phonenoown"]->GetValue())) 
            $this->cp["phonenoown"]->SetText(CCGetFromGet("phonenoown", NULL));
        if (!is_null($this->cp["companyown"]->GetValue()) and !strlen($this->cp["companyown"]->GetText()) and !is_bool($this->cp["companyown"]->GetValue())) 
            $this->cp["companyown"]->SetText(CCGetFromGet("companyown", NULL));
        if (!is_null($this->cp["mobilenoown"]->GetValue()) and !strlen($this->cp["mobilenoown"]->GetText()) and !is_bool($this->cp["mobilenoown"]->GetValue())) 
            $this->cp["mobilenoown"]->SetText(CCGetFromGet("mobilenoown", NULL));
        if (!is_null($this->cp["faxnoown"]->GetValue()) and !strlen($this->cp["faxnoown"]->GetText()) and !is_bool($this->cp["faxnoown"]->GetValue())) 
            $this->cp["faxnoown"]->SetText(CCGetFromGet("faxnoown", NULL));
        if (!is_null($this->cp["zipcodeown"]->GetValue()) and !strlen($this->cp["zipcodeown"]->GetText()) and !is_bool($this->cp["zipcodeown"]->GetValue())) 
            $this->cp["zipcodeown"]->SetText(CCGetFromGet("zipcodeown", NULL));
        if (!is_null($this->cp["mobileno"]->GetValue()) and !strlen($this->cp["mobileno"]->GetText()) and !is_bool($this->cp["mobileno"]->GetValue())) 
            $this->cp["mobileno"]->SetText(CCGetFromGet("mobileno", NULL));
        if (!is_null($this->cp["addressnameown"]->GetValue()) and !strlen($this->cp["addressnameown"]->GetText()) and !is_bool($this->cp["addressnameown"]->GetValue())) 
            $this->cp["addressnameown"]->SetText(CCGetFromGet("addressnameown", NULL));
        if (!is_null($this->cp["i_email"]->GetValue()) and !strlen($this->cp["i_email"]->GetText()) and !is_bool($this->cp["i_email"]->GetValue())) 
            $this->cp["i_email"]->SetText(CCGetFromGet("i_email", NULL));
        if (!is_null($this->cp["vattypedtlid"]->GetValue()) and !strlen($this->cp["vattypedtlid"]->GetText()) and !is_bool($this->cp["vattypedtlid"]->GetValue())) 
            $this->cp["vattypedtlid"]->SetText(CCGetFromGet("vattypedtlid", NULL));
        if (!is_null($this->cp["wpusername"]->GetValue()) and !strlen($this->cp["wpusername"]->GetText()) and !is_bool($this->cp["wpusername"]->GetValue())) 
            $this->cp["wpusername"]->SetText(CCGetFromGet("wpusername", NULL));
        if (!is_null($this->cp["wpuserpwd"]->GetValue()) and !strlen($this->cp["wpuserpwd"]->GetText()) and !is_bool($this->cp["wpuserpwd"]->GetValue())) 
            $this->cp["wpuserpwd"]->SetText(CCGetFromGet("wpuserpwd", NULL));
        if (!is_null($this->cp["wpname"]->GetValue()) and !strlen($this->cp["wpname"]->GetText()) and !is_bool($this->cp["wpname"]->GetValue())) 
            $this->cp["wpname"]->SetText(CCGetFromGet("wpname", NULL));
        if (!is_null($this->cp["wpaddressname"]->GetValue()) and !strlen($this->cp["wpaddressname"]->GetText()) and !is_bool($this->cp["wpaddressname"]->GetValue())) 
            $this->cp["wpaddressname"]->SetText(CCGetFromGet("wpaddressname", NULL));
        if (!is_null($this->cp["wpaddressno"]->GetValue()) and !strlen($this->cp["wpaddressno"]->GetText()) and !is_bool($this->cp["wpaddressno"]->GetValue())) 
            $this->cp["wpaddressno"]->SetText(CCGetFromGet("wpaddressno", NULL));
        if (!is_null($this->cp["wprt"]->GetValue()) and !strlen($this->cp["wprt"]->GetText()) and !is_bool($this->cp["wprt"]->GetValue())) 
            $this->cp["wprt"]->SetText(CCGetFromGet("wprt", NULL));
        if (!is_null($this->cp["wprw"]->GetValue()) and !strlen($this->cp["wprw"]->GetText()) and !is_bool($this->cp["wprw"]->GetValue())) 
            $this->cp["wprw"]->SetText(CCGetFromGet("wprw", NULL));
        if (!is_null($this->cp["wpkel"]->GetValue()) and !strlen($this->cp["wpkel"]->GetText()) and !is_bool($this->cp["wpkel"]->GetValue())) 
            $this->cp["wpkel"]->SetText(CCGetFromGet("wpkel", NULL));
        if (!is_null($this->cp["wpkec"]->GetValue()) and !strlen($this->cp["wpkec"]->GetText()) and !is_bool($this->cp["wpkec"]->GetValue())) 
            $this->cp["wpkec"]->SetText(CCGetFromGet("wpkec", NULL));
        if (!is_null($this->cp["wpkota"]->GetValue()) and !strlen($this->cp["wpkota"]->GetText()) and !is_bool($this->cp["wpkota"]->GetValue())) 
            $this->cp["wpkota"]->SetText(CCGetFromGet("wpkota", NULL));
        if (!is_null($this->cp["wpphoneno"]->GetValue()) and !strlen($this->cp["wpphoneno"]->GetText()) and !is_bool($this->cp["wpphoneno"]->GetValue())) 
            $this->cp["wpphoneno"]->SetText(CCGetFromGet("wpphoneno", NULL));
        if (!is_null($this->cp["wpmobileno"]->GetValue()) and !strlen($this->cp["wpmobileno"]->GetText()) and !is_bool($this->cp["wpmobileno"]->GetValue())) 
            $this->cp["wpmobileno"]->SetText(CCGetFromGet("wpmobileno", NULL));
        if (!is_null($this->cp["wpfaxno"]->GetValue()) and !strlen($this->cp["wpfaxno"]->GetText()) and !is_bool($this->cp["wpfaxno"]->GetValue())) 
            $this->cp["wpfaxno"]->SetText(CCGetFromGet("wpfaxno", NULL));
        if (!is_null($this->cp["wpzipcode"]->GetValue()) and !strlen($this->cp["wpzipcode"]->GetText()) and !is_bool($this->cp["wpzipcode"]->GetValue())) 
            $this->cp["wpzipcode"]->SetText(CCGetFromGet("wpzipcode", NULL));
        if (!is_null($this->cp["wpemail"]->GetValue()) and !strlen($this->cp["wpemail"]->GetText()) and !is_bool($this->cp["wpemail"]->GetValue())) 
            $this->cp["wpemail"]->SetText(CCGetFromGet("wpemail", NULL));
        if (!is_null($this->cp["brandaddress"]->GetValue()) and !strlen($this->cp["brandaddress"]->GetText()) and !is_bool($this->cp["brandaddress"]->GetValue())) 
            $this->cp["brandaddress"]->SetText(CCGetFromGet("brandaddress", NULL));
        if (!is_null($this->cp["brandno"]->GetValue()) and !strlen($this->cp["brandno"]->GetText()) and !is_bool($this->cp["brandno"]->GetValue())) 
            $this->cp["brandno"]->SetText(CCGetFromGet("brandno", NULL));
        if (!is_null($this->cp["brandrt"]->GetValue()) and !strlen($this->cp["brandrt"]->GetText()) and !is_bool($this->cp["brandrt"]->GetValue())) 
            $this->cp["brandrt"]->SetText(CCGetFromGet("brandrt", NULL));
        if (!is_null($this->cp["brandrw"]->GetValue()) and !strlen($this->cp["brandrw"]->GetText()) and !is_bool($this->cp["brandrw"]->GetValue())) 
            $this->cp["brandrw"]->SetText(CCGetFromGet("brandrw", NULL));
        if (!is_null($this->cp["brandkel"]->GetValue()) and !strlen($this->cp["brandkel"]->GetText()) and !is_bool($this->cp["brandkel"]->GetValue())) 
            $this->cp["brandkel"]->SetText(CCGetFromGet("brandkel", NULL));
        if (!is_null($this->cp["brandkec"]->GetValue()) and !strlen($this->cp["brandkec"]->GetText()) and !is_bool($this->cp["brandkec"]->GetValue())) 
            $this->cp["brandkec"]->SetText(CCGetFromGet("brandkec", NULL));
        if (!is_null($this->cp["brandkota"]->GetValue()) and !strlen($this->cp["brandkota"]->GetText()) and !is_bool($this->cp["brandkota"]->GetValue())) 
            $this->cp["brandkota"]->SetText(CCGetFromGet("brandkota", NULL));
        if (!is_null($this->cp["brandphoneno"]->GetValue()) and !strlen($this->cp["brandphoneno"]->GetText()) and !is_bool($this->cp["brandphoneno"]->GetValue())) 
            $this->cp["brandphoneno"]->SetText(CCGetFromGet("brandphoneno", NULL));
        if (!is_null($this->cp["brandmobileno"]->GetValue()) and !strlen($this->cp["brandmobileno"]->GetText()) and !is_bool($this->cp["brandmobileno"]->GetValue())) 
            $this->cp["brandmobileno"]->SetText(CCGetFromGet("brandmobileno", NULL));
        if (!is_null($this->cp["brandfaxno"]->GetValue()) and !strlen($this->cp["brandfaxno"]->GetText()) and !is_bool($this->cp["brandfaxno"]->GetValue())) 
            $this->cp["brandfaxno"]->SetText(CCGetFromGet("brandfaxno", NULL));
        if (!is_null($this->cp["brandzipcode"]->GetValue()) and !strlen($this->cp["brandzipcode"]->GetText()) and !is_bool($this->cp["brandzipcode"]->GetValue())) 
            $this->cp["brandzipcode"]->SetText(CCGetFromGet("brandzipcode", NULL));
        if (!is_null($this->cp["idvat"]->GetValue()) and !strlen($this->cp["idvat"]->GetText()) and !is_bool($this->cp["idvat"]->GetValue())) 
            $this->cp["idvat"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!is_null($this->cp["questionid"]->GetValue()) and !strlen($this->cp["questionid"]->GetText()) and !is_bool($this->cp["questionid"]->GetValue())) 
            $this->cp["questionid"]->SetText(CCGetFromGet("questionid", NULL));
        if (!is_null($this->cp["privateanswer"]->GetValue()) and !strlen($this->cp["privateanswer"]->GetText()) and !is_bool($this->cp["privateanswer"]->GetValue())) 
            $this->cp["privateanswer"]->SetText(CCGetFromGet("privateanswer", NULL));
        if (!is_null($this->cp["i_mode"]->GetValue()) and !strlen($this->cp["i_mode"]->GetText()) and !is_bool($this->cp["i_mode"]->GetValue())) 
            $this->cp["i_mode"]->SetValue('D');
        $this->SQL = "SELECT f_crud_vat_reg (" . $this->ToSQL($this->cp["icode"]->GetDBValue(), $this->cp["icode"]->DataType) . ", "
             . $this->ToSQL($this->cp["iuser"]->GetDBValue(), $this->cp["iuser"]->DataType) . ", "
             . $this->ToSQL($this->cp["cusorderid"]->GetDBValue(), $this->cp["cusorderid"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkel"]->GetDBValue(), $this->cp["regionidkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkec"]->GetDBValue(), $this->cp["regionidkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionid"]->GetDBValue(), $this->cp["regionid"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkelown"]->GetDBValue(), $this->cp["regionidkelown"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidkecown"]->GetDBValue(), $this->cp["regionidkecown"]->DataType) . ", "
             . $this->ToSQL($this->cp["regionidown"]->GetDBValue(), $this->cp["regionidown"]->DataType) . ", "
             . $this->ToSQL($this->cp["companyname"]->GetDBValue(), $this->cp["companyname"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressname"]->GetDBValue(), $this->cp["addressname"]->DataType) . ", "
             . $this->ToSQL($this->cp["jobid"]->GetDBValue(), $this->cp["jobid"]->DataType) . ", "
             . $this->ToSQL($this->cp["companybrand"]->GetDBValue(), $this->cp["companybrand"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressno"]->GetDBValue(), $this->cp["addressno"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrt"]->GetDBValue(), $this->cp["addressrt"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrw"]->GetDBValue(), $this->cp["addressrw"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressnoown"]->GetDBValue(), $this->cp["addressnoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrtown"]->GetDBValue(), $this->cp["addressrtown"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressrwown"]->GetDBValue(), $this->cp["addressrwown"]->DataType) . ", "
             . $this->ToSQL($this->cp["phoneno"]->GetDBValue(), $this->cp["phoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["faxno"]->GetDBValue(), $this->cp["faxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["zipcode"]->GetDBValue(), $this->cp["zipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["phonenoown"]->GetDBValue(), $this->cp["phonenoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["companyown"]->GetDBValue(), $this->cp["companyown"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobilenoown"]->GetDBValue(), $this->cp["mobilenoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["faxnoown"]->GetDBValue(), $this->cp["faxnoown"]->DataType) . ", "
             . $this->ToSQL($this->cp["zipcodeown"]->GetDBValue(), $this->cp["zipcodeown"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobileno"]->GetDBValue(), $this->cp["mobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["addressnameown"]->GetDBValue(), $this->cp["addressnameown"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_email"]->GetDBValue(), $this->cp["i_email"]->DataType) . ", "
             . $this->ToSQL($this->cp["vattypedtlid"]->GetDBValue(), $this->cp["vattypedtlid"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpusername"]->GetDBValue(), $this->cp["wpusername"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpuserpwd"]->GetDBValue(), $this->cp["wpuserpwd"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpname"]->GetDBValue(), $this->cp["wpname"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpaddressname"]->GetDBValue(), $this->cp["wpaddressname"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpaddressno"]->GetDBValue(), $this->cp["wpaddressno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wprt"]->GetDBValue(), $this->cp["wprt"]->DataType) . ", "
             . $this->ToSQL($this->cp["wprw"]->GetDBValue(), $this->cp["wprw"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkel"]->GetDBValue(), $this->cp["wpkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkec"]->GetDBValue(), $this->cp["wpkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpkota"]->GetDBValue(), $this->cp["wpkota"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpphoneno"]->GetDBValue(), $this->cp["wpphoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpmobileno"]->GetDBValue(), $this->cp["wpmobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpfaxno"]->GetDBValue(), $this->cp["wpfaxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpzipcode"]->GetDBValue(), $this->cp["wpzipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["wpemail"]->GetDBValue(), $this->cp["wpemail"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandaddress"]->GetDBValue(), $this->cp["brandaddress"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandno"]->GetDBValue(), $this->cp["brandno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandrt"]->GetDBValue(), $this->cp["brandrt"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandrw"]->GetDBValue(), $this->cp["brandrw"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkel"]->GetDBValue(), $this->cp["brandkel"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkec"]->GetDBValue(), $this->cp["brandkec"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandkota"]->GetDBValue(), $this->cp["brandkota"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandphoneno"]->GetDBValue(), $this->cp["brandphoneno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandmobileno"]->GetDBValue(), $this->cp["brandmobileno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandfaxno"]->GetDBValue(), $this->cp["brandfaxno"]->DataType) . ", "
             . $this->ToSQL($this->cp["brandzipcode"]->GetDBValue(), $this->cp["brandzipcode"]->DataType) . ", "
             . $this->ToSQL($this->cp["idvat"]->GetDBValue(), $this->cp["idvat"]->DataType) . ", "
             . $this->ToSQL($this->cp["questionid"]->GetDBValue(), $this->cp["questionid"]->DataType) . ", "
             . $this->ToSQL($this->cp["privateanswer"]->GetDBValue(), $this->cp["privateanswer"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_mode"]->GetDBValue(), $this->cp["i_mode"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_registrationFormDataSource Class @94-FCB6E20C

//DEL      function Insert()
//DEL      {
//DEL          global $CCSLocales;
//DEL          global $DefaultDateFormat;
//DEL          $this->CmdExecution = true;
//DEL          $this->cp["o_res"] = new clsSQLParameter("urlo_res", ccsText, "", "", CCGetFromGet("o_res", NULL), "", false, $this->ErrorBlock);
//DEL          $this->cp["icode"] = new clsSQLParameter("ctrlvalidation_code", ccsText, "", "", $this->validation_code->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["iuser"] = new clsSQLParameter("exprKey900", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
//DEL          $this->cp["cusorderid"] = new clsSQLParameter("ctrlt_customer_order_id", ccsFloat, "", "", $this->t_customer_order_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["regionidkel"] = new clsSQLParameter("ctrlp_region_id_kelurahan", ccsFloat, "", "", $this->p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["regionidkec"] = new clsSQLParameter("ctrlp_region_id_kecamatan", ccsFloat, "", "", $this->p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["regionid"] = new clsSQLParameter("ctrlp_region_id", ccsFloat, "", "", $this->p_region_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["regionidkelown"] = new clsSQLParameter("ctrlp_region_id_kel_owner", ccsFloat, "", "", $this->p_region_id_kel_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["regionidkecown"] = new clsSQLParameter("ctrlp_region_id_kec_owner", ccsFloat, "", "", $this->p_region_id_kec_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["regionidown"] = new clsSQLParameter("ctrlp_region_id_owner", ccsFloat, "", "", $this->p_region_id_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["companyname"] = new clsSQLParameter("ctrlcompany_name", ccsText, "", "", $this->company_name->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressname"] = new clsSQLParameter("ctrladdress_name", ccsText, "", "", $this->address_name->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["jobid"] = new clsSQLParameter("ctrlp_job_position_id", ccsFloat, "", "", $this->p_job_position_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["companybrand"] = new clsSQLParameter("ctrlcompany_brand", ccsText, "", "", $this->company_brand->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressno"] = new clsSQLParameter("ctrladdress_no", ccsText, "", "", $this->address_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressrt"] = new clsSQLParameter("ctrladdress_rt", ccsText, "", "", $this->address_rt->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressrw"] = new clsSQLParameter("ctrladdress_rw", ccsText, "", "", $this->address_rw->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressnoown"] = new clsSQLParameter("ctrladdress_no_owner", ccsText, "", "", $this->address_no_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressrtown"] = new clsSQLParameter("ctrladdress_rt_owner", ccsText, "", "", $this->address_rt_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressrwown"] = new clsSQLParameter("ctrladdress_rw_owner", ccsText, "", "", $this->address_rw_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["phoneno"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["faxno"] = new clsSQLParameter("ctrlfax_no", ccsText, "", "", $this->fax_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["zipcode"] = new clsSQLParameter("ctrlzip_code", ccsText, "", "", $this->zip_code->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["phonenoown"] = new clsSQLParameter("ctrlphone_no_owner", ccsText, "", "", $this->phone_no_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["companyown"] = new clsSQLParameter("ctrlcompany_owner", ccsText, "", "", $this->company_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["mobilenoown"] = new clsSQLParameter("ctrlmobile_no_owner", ccsText, "", "", $this->mobile_no_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["faxnoown"] = new clsSQLParameter("ctrlfax_no_owner", ccsText, "", "", $this->fax_no_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["zipcodeown"] = new clsSQLParameter("ctrlzip_code_owner", ccsText, "", "", $this->zip_code_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["mobileno"] = new clsSQLParameter("ctrlmobile_no", ccsText, "", "", $this->mobile_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["addressnameown"] = new clsSQLParameter("ctrladdress_name_owner", ccsText, "", "", $this->address_name_owner->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["i_email"] = new clsSQLParameter("ctrlemail", ccsText, "", "", $this->email->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["hotelgradeid"] = new clsSQLParameter("ctrlp_hotel_grade_id", ccsFloat, "", "", $this->p_hotel_grade_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["servicetypeid"] = new clsSQLParameter("ctrlp_rest_service_type_id", ccsFloat, "", "", $this->p_rest_service_type_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["entertaintmenttypeid"] = new clsSQLParameter("ctrlp_entertaintment_type_id", ccsFloat, "", "", $this->p_entertaintment_type_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["parkingid"] = new clsSQLParameter("ctrlp_parking_classification_id", ccsFloat, "", "", $this->p_parking_classification_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpusername"] = new clsSQLParameter("ctrlwp_user_name", ccsText, "", "", $this->wp_user_name->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpuserpwd"] = new clsSQLParameter("ctrlwp_user_pwd", ccsText, "", "", $this->wp_user_pwd->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpname"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpaddressname"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpaddressno"] = new clsSQLParameter("ctrlwp_address_no", ccsText, "", "", $this->wp_address_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wprt"] = new clsSQLParameter("ctrlwp_address_rt", ccsText, "", "", $this->wp_address_rt->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wprw"] = new clsSQLParameter("ctrlwp_address_rw", ccsText, "", "", $this->wp_address_rw->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpkel"] = new clsSQLParameter("ctrlwp_p_region_id_kelurahan", ccsFloat, "", "", $this->wp_p_region_id_kelurahan->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpkec"] = new clsSQLParameter("ctrlwp_p_region_id_kecamatan", ccsFloat, "", "", $this->wp_p_region_id_kecamatan->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpkota"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpphoneno"] = new clsSQLParameter("ctrlwp_phone_no", ccsText, "", "", $this->wp_phone_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpmobileno"] = new clsSQLParameter("ctrlwp_mobile_no", ccsText, "", "", $this->wp_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpfaxno"] = new clsSQLParameter("ctrlwp_fax_no", ccsText, "", "", $this->wp_fax_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpzipcode"] = new clsSQLParameter("ctrlwp_zip_code", ccsText, "", "", $this->wp_zip_code->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["wpemail"] = new clsSQLParameter("ctrlwp_email", ccsText, "", "", $this->wp_email->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandaddress"] = new clsSQLParameter("ctrlbrand_address_name", ccsText, "", "", $this->brand_address_name->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandno"] = new clsSQLParameter("ctrlbrand_address_no", ccsText, "", "", $this->brand_address_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandrt"] = new clsSQLParameter("ctrlbrand_address_rt", ccsText, "", "", $this->brand_address_rt->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandrw"] = new clsSQLParameter("ctrlbrand_address_rw", ccsText, "", "", $this->brand_address_rw->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandkel"] = new clsSQLParameter("ctrlbrand_p_region_id_kel", ccsFloat, "", "", $this->brand_p_region_id_kel->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandkec"] = new clsSQLParameter("ctrlbrand_p_region_id_kec", ccsFloat, "", "", $this->brand_p_region_id_kec->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandkota"] = new clsSQLParameter("ctrlbrand_p_region_id", ccsFloat, "", "", $this->brand_p_region_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandphoneno"] = new clsSQLParameter("ctrlbrand_phone_no", ccsText, "", "", $this->brand_phone_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandmobileno"] = new clsSQLParameter("ctrlbrand_mobile_no", ccsText, "", "", $this->brand_mobile_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandfaxno"] = new clsSQLParameter("ctrlbrand_fax_no", ccsText, "", "", $this->brand_fax_no->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["brandzipcode"] = new clsSQLParameter("ctrlbrand_zip_code", ccsText, "", "", $this->brand_zip_code->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["idvat"] = new clsSQLParameter("urlidvat", ccsFloat, "", "", CCGetFromGet("idvat", NULL), "", false, $this->ErrorBlock);
//DEL          $this->cp["questionid"] = new clsSQLParameter("ctrlp_private_question_id", ccsFloat, "", "", $this->p_private_question_id->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["privateanswer"] = new clsSQLParameter("ctrlprivate_answer", ccsText, "", "", $this->private_answer->GetValue(true), "", false, $this->ErrorBlock);
//DEL          $this->cp["i_mode"] = new clsSQLParameter("exprKey963", ccsText, "", "", 'I', "", false, $this->ErrorBlock);
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
//DEL          if (!is_null($this->cp["o_res"]->GetValue()) and !strlen($this->cp["o_res"]->GetText()) and !is_bool($this->cp["o_res"]->GetValue())) 
//DEL              $this->cp["o_res"]->SetText(CCGetFromGet("o_res", NULL));
//DEL          if (!is_null($this->cp["icode"]->GetValue()) and !strlen($this->cp["icode"]->GetText()) and !is_bool($this->cp["icode"]->GetValue())) 
//DEL              $this->cp["icode"]->SetValue($this->validation_code->GetValue(true));
//DEL          if (!is_null($this->cp["iuser"]->GetValue()) and !strlen($this->cp["iuser"]->GetText()) and !is_bool($this->cp["iuser"]->GetValue())) 
//DEL              $this->cp["iuser"]->SetValue(CCGetUserLogin());
//DEL          if (!is_null($this->cp["cusorderid"]->GetValue()) and !strlen($this->cp["cusorderid"]->GetText()) and !is_bool($this->cp["cusorderid"]->GetValue())) 
//DEL              $this->cp["cusorderid"]->SetValue($this->t_customer_order_id->GetValue(true));
//DEL          if (!is_null($this->cp["regionidkel"]->GetValue()) and !strlen($this->cp["regionidkel"]->GetText()) and !is_bool($this->cp["regionidkel"]->GetValue())) 
//DEL              $this->cp["regionidkel"]->SetValue($this->p_region_id_kelurahan->GetValue(true));
//DEL          if (!is_null($this->cp["regionidkec"]->GetValue()) and !strlen($this->cp["regionidkec"]->GetText()) and !is_bool($this->cp["regionidkec"]->GetValue())) 
//DEL              $this->cp["regionidkec"]->SetValue($this->p_region_id_kecamatan->GetValue(true));
//DEL          if (!is_null($this->cp["regionid"]->GetValue()) and !strlen($this->cp["regionid"]->GetText()) and !is_bool($this->cp["regionid"]->GetValue())) 
//DEL              $this->cp["regionid"]->SetValue($this->p_region_id->GetValue(true));
//DEL          if (!is_null($this->cp["regionidkelown"]->GetValue()) and !strlen($this->cp["regionidkelown"]->GetText()) and !is_bool($this->cp["regionidkelown"]->GetValue())) 
//DEL              $this->cp["regionidkelown"]->SetValue($this->p_region_id_kel_owner->GetValue(true));
//DEL          if (!is_null($this->cp["regionidkecown"]->GetValue()) and !strlen($this->cp["regionidkecown"]->GetText()) and !is_bool($this->cp["regionidkecown"]->GetValue())) 
//DEL              $this->cp["regionidkecown"]->SetValue($this->p_region_id_kec_owner->GetValue(true));
//DEL          if (!is_null($this->cp["regionidown"]->GetValue()) and !strlen($this->cp["regionidown"]->GetText()) and !is_bool($this->cp["regionidown"]->GetValue())) 
//DEL              $this->cp["regionidown"]->SetValue($this->p_region_id_owner->GetValue(true));
//DEL          if (!is_null($this->cp["companyname"]->GetValue()) and !strlen($this->cp["companyname"]->GetText()) and !is_bool($this->cp["companyname"]->GetValue())) 
//DEL              $this->cp["companyname"]->SetValue($this->company_name->GetValue(true));
//DEL          if (!is_null($this->cp["addressname"]->GetValue()) and !strlen($this->cp["addressname"]->GetText()) and !is_bool($this->cp["addressname"]->GetValue())) 
//DEL              $this->cp["addressname"]->SetValue($this->address_name->GetValue(true));
//DEL          if (!is_null($this->cp["jobid"]->GetValue()) and !strlen($this->cp["jobid"]->GetText()) and !is_bool($this->cp["jobid"]->GetValue())) 
//DEL              $this->cp["jobid"]->SetValue($this->p_job_position_id->GetValue(true));
//DEL          if (!is_null($this->cp["companybrand"]->GetValue()) and !strlen($this->cp["companybrand"]->GetText()) and !is_bool($this->cp["companybrand"]->GetValue())) 
//DEL              $this->cp["companybrand"]->SetValue($this->company_brand->GetValue(true));
//DEL          if (!is_null($this->cp["addressno"]->GetValue()) and !strlen($this->cp["addressno"]->GetText()) and !is_bool($this->cp["addressno"]->GetValue())) 
//DEL              $this->cp["addressno"]->SetValue($this->address_no->GetValue(true));
//DEL          if (!is_null($this->cp["addressrt"]->GetValue()) and !strlen($this->cp["addressrt"]->GetText()) and !is_bool($this->cp["addressrt"]->GetValue())) 
//DEL              $this->cp["addressrt"]->SetValue($this->address_rt->GetValue(true));
//DEL          if (!is_null($this->cp["addressrw"]->GetValue()) and !strlen($this->cp["addressrw"]->GetText()) and !is_bool($this->cp["addressrw"]->GetValue())) 
//DEL              $this->cp["addressrw"]->SetValue($this->address_rw->GetValue(true));
//DEL          if (!is_null($this->cp["addressnoown"]->GetValue()) and !strlen($this->cp["addressnoown"]->GetText()) and !is_bool($this->cp["addressnoown"]->GetValue())) 
//DEL              $this->cp["addressnoown"]->SetValue($this->address_no_owner->GetValue(true));
//DEL          if (!is_null($this->cp["addressrtown"]->GetValue()) and !strlen($this->cp["addressrtown"]->GetText()) and !is_bool($this->cp["addressrtown"]->GetValue())) 
//DEL              $this->cp["addressrtown"]->SetValue($this->address_rt_owner->GetValue(true));
//DEL          if (!is_null($this->cp["addressrwown"]->GetValue()) and !strlen($this->cp["addressrwown"]->GetText()) and !is_bool($this->cp["addressrwown"]->GetValue())) 
//DEL              $this->cp["addressrwown"]->SetValue($this->address_rw_owner->GetValue(true));
//DEL          if (!is_null($this->cp["phoneno"]->GetValue()) and !strlen($this->cp["phoneno"]->GetText()) and !is_bool($this->cp["phoneno"]->GetValue())) 
//DEL              $this->cp["phoneno"]->SetValue($this->phone_no->GetValue(true));
//DEL          if (!is_null($this->cp["faxno"]->GetValue()) and !strlen($this->cp["faxno"]->GetText()) and !is_bool($this->cp["faxno"]->GetValue())) 
//DEL              $this->cp["faxno"]->SetValue($this->fax_no->GetValue(true));
//DEL          if (!is_null($this->cp["zipcode"]->GetValue()) and !strlen($this->cp["zipcode"]->GetText()) and !is_bool($this->cp["zipcode"]->GetValue())) 
//DEL              $this->cp["zipcode"]->SetValue($this->zip_code->GetValue(true));
//DEL          if (!is_null($this->cp["phonenoown"]->GetValue()) and !strlen($this->cp["phonenoown"]->GetText()) and !is_bool($this->cp["phonenoown"]->GetValue())) 
//DEL              $this->cp["phonenoown"]->SetValue($this->phone_no_owner->GetValue(true));
//DEL          if (!is_null($this->cp["companyown"]->GetValue()) and !strlen($this->cp["companyown"]->GetText()) and !is_bool($this->cp["companyown"]->GetValue())) 
//DEL              $this->cp["companyown"]->SetValue($this->company_owner->GetValue(true));
//DEL          if (!is_null($this->cp["mobilenoown"]->GetValue()) and !strlen($this->cp["mobilenoown"]->GetText()) and !is_bool($this->cp["mobilenoown"]->GetValue())) 
//DEL              $this->cp["mobilenoown"]->SetValue($this->mobile_no_owner->GetValue(true));
//DEL          if (!is_null($this->cp["faxnoown"]->GetValue()) and !strlen($this->cp["faxnoown"]->GetText()) and !is_bool($this->cp["faxnoown"]->GetValue())) 
//DEL              $this->cp["faxnoown"]->SetValue($this->fax_no_owner->GetValue(true));
//DEL          if (!is_null($this->cp["zipcodeown"]->GetValue()) and !strlen($this->cp["zipcodeown"]->GetText()) and !is_bool($this->cp["zipcodeown"]->GetValue())) 
//DEL              $this->cp["zipcodeown"]->SetValue($this->zip_code_owner->GetValue(true));
//DEL          if (!is_null($this->cp["mobileno"]->GetValue()) and !strlen($this->cp["mobileno"]->GetText()) and !is_bool($this->cp["mobileno"]->GetValue())) 
//DEL              $this->cp["mobileno"]->SetValue($this->mobile_no->GetValue(true));
//DEL          if (!is_null($this->cp["addressnameown"]->GetValue()) and !strlen($this->cp["addressnameown"]->GetText()) and !is_bool($this->cp["addressnameown"]->GetValue())) 
//DEL              $this->cp["addressnameown"]->SetValue($this->address_name_owner->GetValue(true));
//DEL          if (!is_null($this->cp["i_email"]->GetValue()) and !strlen($this->cp["i_email"]->GetText()) and !is_bool($this->cp["i_email"]->GetValue())) 
//DEL              $this->cp["i_email"]->SetValue($this->email->GetValue(true));
//DEL          if (!is_null($this->cp["hotelgradeid"]->GetValue()) and !strlen($this->cp["hotelgradeid"]->GetText()) and !is_bool($this->cp["hotelgradeid"]->GetValue())) 
//DEL              $this->cp["hotelgradeid"]->SetValue($this->p_hotel_grade_id->GetValue(true));
//DEL          if (!is_null($this->cp["servicetypeid"]->GetValue()) and !strlen($this->cp["servicetypeid"]->GetText()) and !is_bool($this->cp["servicetypeid"]->GetValue())) 
//DEL              $this->cp["servicetypeid"]->SetValue($this->p_rest_service_type_id->GetValue(true));
//DEL          if (!is_null($this->cp["entertaintmenttypeid"]->GetValue()) and !strlen($this->cp["entertaintmenttypeid"]->GetText()) and !is_bool($this->cp["entertaintmenttypeid"]->GetValue())) 
//DEL              $this->cp["entertaintmenttypeid"]->SetValue($this->p_entertaintment_type_id->GetValue(true));
//DEL          if (!is_null($this->cp["parkingid"]->GetValue()) and !strlen($this->cp["parkingid"]->GetText()) and !is_bool($this->cp["parkingid"]->GetValue())) 
//DEL              $this->cp["parkingid"]->SetValue($this->p_parking_classification_id->GetValue(true));
//DEL          if (!is_null($this->cp["wpusername"]->GetValue()) and !strlen($this->cp["wpusername"]->GetText()) and !is_bool($this->cp["wpusername"]->GetValue())) 
//DEL              $this->cp["wpusername"]->SetValue($this->wp_user_name->GetValue(true));
//DEL          if (!is_null($this->cp["wpuserpwd"]->GetValue()) and !strlen($this->cp["wpuserpwd"]->GetText()) and !is_bool($this->cp["wpuserpwd"]->GetValue())) 
//DEL              $this->cp["wpuserpwd"]->SetValue($this->wp_user_pwd->GetValue(true));
//DEL          if (!is_null($this->cp["wpname"]->GetValue()) and !strlen($this->cp["wpname"]->GetText()) and !is_bool($this->cp["wpname"]->GetValue())) 
//DEL              $this->cp["wpname"]->SetValue($this->wp_name->GetValue(true));
//DEL          if (!is_null($this->cp["wpaddressname"]->GetValue()) and !strlen($this->cp["wpaddressname"]->GetText()) and !is_bool($this->cp["wpaddressname"]->GetValue())) 
//DEL              $this->cp["wpaddressname"]->SetValue($this->wp_address_name->GetValue(true));
//DEL          if (!is_null($this->cp["wpaddressno"]->GetValue()) and !strlen($this->cp["wpaddressno"]->GetText()) and !is_bool($this->cp["wpaddressno"]->GetValue())) 
//DEL              $this->cp["wpaddressno"]->SetValue($this->wp_address_no->GetValue(true));
//DEL          if (!is_null($this->cp["wprt"]->GetValue()) and !strlen($this->cp["wprt"]->GetText()) and !is_bool($this->cp["wprt"]->GetValue())) 
//DEL              $this->cp["wprt"]->SetValue($this->wp_address_rt->GetValue(true));
//DEL          if (!is_null($this->cp["wprw"]->GetValue()) and !strlen($this->cp["wprw"]->GetText()) and !is_bool($this->cp["wprw"]->GetValue())) 
//DEL              $this->cp["wprw"]->SetValue($this->wp_address_rw->GetValue(true));
//DEL          if (!is_null($this->cp["wpkel"]->GetValue()) and !strlen($this->cp["wpkel"]->GetText()) and !is_bool($this->cp["wpkel"]->GetValue())) 
//DEL              $this->cp["wpkel"]->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
//DEL          if (!is_null($this->cp["wpkec"]->GetValue()) and !strlen($this->cp["wpkec"]->GetText()) and !is_bool($this->cp["wpkec"]->GetValue())) 
//DEL              $this->cp["wpkec"]->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
//DEL          if (!is_null($this->cp["wpkota"]->GetValue()) and !strlen($this->cp["wpkota"]->GetText()) and !is_bool($this->cp["wpkota"]->GetValue())) 
//DEL              $this->cp["wpkota"]->SetValue($this->wp_p_region_id->GetValue(true));
//DEL          if (!is_null($this->cp["wpphoneno"]->GetValue()) and !strlen($this->cp["wpphoneno"]->GetText()) and !is_bool($this->cp["wpphoneno"]->GetValue())) 
//DEL              $this->cp["wpphoneno"]->SetValue($this->wp_phone_no->GetValue(true));
//DEL          if (!is_null($this->cp["wpmobileno"]->GetValue()) and !strlen($this->cp["wpmobileno"]->GetText()) and !is_bool($this->cp["wpmobileno"]->GetValue())) 
//DEL              $this->cp["wpmobileno"]->SetValue($this->wp_mobile_no->GetValue(true));
//DEL          if (!is_null($this->cp["wpfaxno"]->GetValue()) and !strlen($this->cp["wpfaxno"]->GetText()) and !is_bool($this->cp["wpfaxno"]->GetValue())) 
//DEL              $this->cp["wpfaxno"]->SetValue($this->wp_fax_no->GetValue(true));
//DEL          if (!is_null($this->cp["wpzipcode"]->GetValue()) and !strlen($this->cp["wpzipcode"]->GetText()) and !is_bool($this->cp["wpzipcode"]->GetValue())) 
//DEL              $this->cp["wpzipcode"]->SetValue($this->wp_zip_code->GetValue(true));
//DEL          if (!is_null($this->cp["wpemail"]->GetValue()) and !strlen($this->cp["wpemail"]->GetText()) and !is_bool($this->cp["wpemail"]->GetValue())) 
//DEL              $this->cp["wpemail"]->SetValue($this->wp_email->GetValue(true));
//DEL          if (!is_null($this->cp["brandaddress"]->GetValue()) and !strlen($this->cp["brandaddress"]->GetText()) and !is_bool($this->cp["brandaddress"]->GetValue())) 
//DEL              $this->cp["brandaddress"]->SetValue($this->brand_address_name->GetValue(true));
//DEL          if (!is_null($this->cp["brandno"]->GetValue()) and !strlen($this->cp["brandno"]->GetText()) and !is_bool($this->cp["brandno"]->GetValue())) 
//DEL              $this->cp["brandno"]->SetValue($this->brand_address_no->GetValue(true));
//DEL          if (!is_null($this->cp["brandrt"]->GetValue()) and !strlen($this->cp["brandrt"]->GetText()) and !is_bool($this->cp["brandrt"]->GetValue())) 
//DEL              $this->cp["brandrt"]->SetValue($this->brand_address_rt->GetValue(true));
//DEL          if (!is_null($this->cp["brandrw"]->GetValue()) and !strlen($this->cp["brandrw"]->GetText()) and !is_bool($this->cp["brandrw"]->GetValue())) 
//DEL              $this->cp["brandrw"]->SetValue($this->brand_address_rw->GetValue(true));
//DEL          if (!is_null($this->cp["brandkel"]->GetValue()) and !strlen($this->cp["brandkel"]->GetText()) and !is_bool($this->cp["brandkel"]->GetValue())) 
//DEL              $this->cp["brandkel"]->SetValue($this->brand_p_region_id_kel->GetValue(true));
//DEL          if (!is_null($this->cp["brandkec"]->GetValue()) and !strlen($this->cp["brandkec"]->GetText()) and !is_bool($this->cp["brandkec"]->GetValue())) 
//DEL              $this->cp["brandkec"]->SetValue($this->brand_p_region_id_kec->GetValue(true));
//DEL          if (!is_null($this->cp["brandkota"]->GetValue()) and !strlen($this->cp["brandkota"]->GetText()) and !is_bool($this->cp["brandkota"]->GetValue())) 
//DEL              $this->cp["brandkota"]->SetValue($this->brand_p_region_id->GetValue(true));
//DEL          if (!is_null($this->cp["brandphoneno"]->GetValue()) and !strlen($this->cp["brandphoneno"]->GetText()) and !is_bool($this->cp["brandphoneno"]->GetValue())) 
//DEL              $this->cp["brandphoneno"]->SetValue($this->brand_phone_no->GetValue(true));
//DEL          if (!is_null($this->cp["brandmobileno"]->GetValue()) and !strlen($this->cp["brandmobileno"]->GetText()) and !is_bool($this->cp["brandmobileno"]->GetValue())) 
//DEL              $this->cp["brandmobileno"]->SetValue($this->brand_mobile_no->GetValue(true));
//DEL          if (!is_null($this->cp["brandfaxno"]->GetValue()) and !strlen($this->cp["brandfaxno"]->GetText()) and !is_bool($this->cp["brandfaxno"]->GetValue())) 
//DEL              $this->cp["brandfaxno"]->SetValue($this->brand_fax_no->GetValue(true));
//DEL          if (!is_null($this->cp["brandzipcode"]->GetValue()) and !strlen($this->cp["brandzipcode"]->GetText()) and !is_bool($this->cp["brandzipcode"]->GetValue())) 
//DEL              $this->cp["brandzipcode"]->SetValue($this->brand_zip_code->GetValue(true));
//DEL          if (!is_null($this->cp["idvat"]->GetValue()) and !strlen($this->cp["idvat"]->GetText()) and !is_bool($this->cp["idvat"]->GetValue())) 
//DEL              $this->cp["idvat"]->SetText(CCGetFromGet("idvat", NULL));
//DEL          if (!is_null($this->cp["questionid"]->GetValue()) and !strlen($this->cp["questionid"]->GetText()) and !is_bool($this->cp["questionid"]->GetValue())) 
//DEL              $this->cp["questionid"]->SetValue($this->p_private_question_id->GetValue(true));
//DEL          if (!is_null($this->cp["privateanswer"]->GetValue()) and !strlen($this->cp["privateanswer"]->GetText()) and !is_bool($this->cp["privateanswer"]->GetValue())) 
//DEL              $this->cp["privateanswer"]->SetValue($this->private_answer->GetValue(true));
//DEL          if (!is_null($this->cp["i_mode"]->GetValue()) and !strlen($this->cp["i_mode"]->GetText()) and !is_bool($this->cp["i_mode"]->GetValue())) 
//DEL              $this->cp["i_mode"]->SetValue('I');
//DEL          $this->SQL = "SELECT f_crud_vat_reg (" . $this->ToSQL($this->cp["icode"]->GetDBValue(), $this->cp["icode"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["iuser"]->GetDBValue(), $this->cp["iuser"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["cusorderid"]->GetDBValue(), $this->cp["cusorderid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["regionidkel"]->GetDBValue(), $this->cp["regionidkel"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["regionidkec"]->GetDBValue(), $this->cp["regionidkec"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["regionid"]->GetDBValue(), $this->cp["regionid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["regionidkelown"]->GetDBValue(), $this->cp["regionidkelown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["regionidkecown"]->GetDBValue(), $this->cp["regionidkecown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["regionidown"]->GetDBValue(), $this->cp["regionidown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["companyname"]->GetDBValue(), $this->cp["companyname"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressname"]->GetDBValue(), $this->cp["addressname"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["jobid"]->GetDBValue(), $this->cp["jobid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["companybrand"]->GetDBValue(), $this->cp["companybrand"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressno"]->GetDBValue(), $this->cp["addressno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressrt"]->GetDBValue(), $this->cp["addressrt"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressrw"]->GetDBValue(), $this->cp["addressrw"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressnoown"]->GetDBValue(), $this->cp["addressnoown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressrtown"]->GetDBValue(), $this->cp["addressrtown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressrwown"]->GetDBValue(), $this->cp["addressrwown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["phoneno"]->GetDBValue(), $this->cp["phoneno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["faxno"]->GetDBValue(), $this->cp["faxno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["zipcode"]->GetDBValue(), $this->cp["zipcode"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["phonenoown"]->GetDBValue(), $this->cp["phonenoown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["companyown"]->GetDBValue(), $this->cp["companyown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["mobilenoown"]->GetDBValue(), $this->cp["mobilenoown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["faxnoown"]->GetDBValue(), $this->cp["faxnoown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["zipcodeown"]->GetDBValue(), $this->cp["zipcodeown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["mobileno"]->GetDBValue(), $this->cp["mobileno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["addressnameown"]->GetDBValue(), $this->cp["addressnameown"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["i_email"]->GetDBValue(), $this->cp["i_email"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["hotelgradeid"]->GetDBValue(), $this->cp["hotelgradeid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["servicetypeid"]->GetDBValue(), $this->cp["servicetypeid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["entertaintmenttypeid"]->GetDBValue(), $this->cp["entertaintmenttypeid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["parkingid"]->GetDBValue(), $this->cp["parkingid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpusername"]->GetDBValue(), $this->cp["wpusername"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpuserpwd"]->GetDBValue(), $this->cp["wpuserpwd"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpname"]->GetDBValue(), $this->cp["wpname"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpaddressname"]->GetDBValue(), $this->cp["wpaddressname"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpaddressno"]->GetDBValue(), $this->cp["wpaddressno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wprt"]->GetDBValue(), $this->cp["wprt"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wprw"]->GetDBValue(), $this->cp["wprw"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpkel"]->GetDBValue(), $this->cp["wpkel"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpkec"]->GetDBValue(), $this->cp["wpkec"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpkota"]->GetDBValue(), $this->cp["wpkota"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpphoneno"]->GetDBValue(), $this->cp["wpphoneno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpmobileno"]->GetDBValue(), $this->cp["wpmobileno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpfaxno"]->GetDBValue(), $this->cp["wpfaxno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpzipcode"]->GetDBValue(), $this->cp["wpzipcode"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["wpemail"]->GetDBValue(), $this->cp["wpemail"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandaddress"]->GetDBValue(), $this->cp["brandaddress"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandno"]->GetDBValue(), $this->cp["brandno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandrt"]->GetDBValue(), $this->cp["brandrt"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandrw"]->GetDBValue(), $this->cp["brandrw"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandkel"]->GetDBValue(), $this->cp["brandkel"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandkec"]->GetDBValue(), $this->cp["brandkec"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandkota"]->GetDBValue(), $this->cp["brandkota"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandphoneno"]->GetDBValue(), $this->cp["brandphoneno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandmobileno"]->GetDBValue(), $this->cp["brandmobileno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandfaxno"]->GetDBValue(), $this->cp["brandfaxno"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["brandzipcode"]->GetDBValue(), $this->cp["brandzipcode"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["idvat"]->GetDBValue(), $this->cp["idvat"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["questionid"]->GetDBValue(), $this->cp["questionid"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["privateanswer"]->GetDBValue(), $this->cp["privateanswer"]->DataType) . ", "
//DEL               . $this->ToSQL($this->cp["i_mode"]->GetDBValue(), $this->cp["i_mode"]->DataType) . ");";
//DEL          $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
//DEL          if($this->Errors->Count() == 0 && $this->CmdExecution) {
//DEL              $this->query($this->SQL);
//DEL  			while ($this->next_record()){
//DEL  				$hasil = $this->f("f_crud_vat_reg");
//DEL  			}
//DEL  			
//DEL  			if($hasil == "NOT OK"){
//DEL  				$this->Errors->addError("Kode Verifikasi Salah");
//DEL  				return;
//DEL  			}
//DEL              $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
//DEL          }
//DEL      }



//Initialize Page @1-751D1644
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
$TemplateFileName = "t_vat_registration.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-685B6852
include_once("./t_vat_registration_events.php");
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
