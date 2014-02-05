<?php
//Include Common Files @1-093A73DD
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "getRegistrationInfo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridf_SELECT_FROM_v_vat_regis { //f_SELECT_FROM_v_vat_regis class @2-99E628C0

//Variables @2-AC1EDBB9

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
//End Variables

//Class_Initialize Event @2-4BB81657
    function clsGridf_SELECT_FROM_v_vat_regis($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "f_SELECT_FROM_v_vat_regis";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid f_SELECT_FROM_v_vat_regis";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsf_SELECT_FROM_v_vat_regisDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->order_no = & new clsControl(ccsTextBox, "order_no", "Nomor Order", ccsText, "", CCGetRequestParam("order_no", ccsGet, NULL), $this);
        $this->order_no->Required = true;
        $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "Id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", ccsGet, NULL), $this);
        $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", ccsGet, NULL), $this);
        $this->t_vat_registration_id1 = & new clsControl(ccsHidden, "t_vat_registration_id1", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id1", ccsGet, NULL), $this);
        $this->registration_date = & new clsControl(ccsTextBox, "registration_date", "Tanggal Pendaftaran", ccsText, "", CCGetRequestParam("registration_date", ccsGet, NULL), $this);
        $this->registration_date->Required = true;
        $this->rqst_type_code = & new clsControl(ccsHidden, "rqst_type_code", "rqst_type_code", ccsText, "", CCGetRequestParam("rqst_type_code", ccsGet, NULL), $this);
        $this->p_vat_type_dtl_id = & new clsControl(ccsListBox, "p_vat_type_dtl_id", "Nama Ayat", ccsFloat, "", CCGetRequestParam("p_vat_type_dtl_id", ccsGet, NULL), $this);
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
        $this->wp_user_name = & new clsControl(ccsTextBox, "wp_user_name", "User Name", ccsText, "", CCGetRequestParam("wp_user_name", ccsGet, NULL), $this);
        $this->wp_user_name->Required = true;
        $this->wp_user_pwd = & new clsControl(ccsTextBox, "wp_user_pwd", "Password", ccsText, "", CCGetRequestParam("wp_user_pwd", ccsGet, NULL), $this);
        $this->wp_user_pwd->Required = true;
        $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "Nama Wajib Pajak", ccsText, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->wp_name->Required = true;
        $this->wp_address_name = & new clsControl(ccsTextArea, "wp_address_name", "Alamat Wajib Pajak", ccsText, "", CCGetRequestParam("wp_address_name", ccsGet, NULL), $this);
        $this->wp_address_name->Required = true;
        $this->wp_address_no = & new clsControl(ccsTextBox, "wp_address_no", "No - WP", ccsText, "", CCGetRequestParam("wp_address_no", ccsGet, NULL), $this);
        $this->wp_address_no->Required = true;
        $this->wp_address_rt = & new clsControl(ccsTextBox, "wp_address_rt", "Rt - WP", ccsText, "", CCGetRequestParam("wp_address_rt", ccsGet, NULL), $this);
        $this->wp_address_rw = & new clsControl(ccsTextBox, "wp_address_rw", "Rw - WP", ccsText, "", CCGetRequestParam("wp_address_rw", ccsGet, NULL), $this);
        $this->wp_kota = & new clsControl(ccsTextBox, "wp_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("wp_kota", ccsGet, NULL), $this);
        $this->wp_kota->Required = true;
        $this->wp_p_region_id = & new clsControl(ccsHidden, "wp_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id", ccsGet, NULL), $this);
        $this->wp_p_region_id->Required = true;
        $this->wp_kecamatan = & new clsControl(ccsTextBox, "wp_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("wp_kecamatan", ccsGet, NULL), $this);
        $this->wp_kecamatan->Required = true;
        $this->wp_p_region_id_kecamatan = & new clsControl(ccsHidden, "wp_p_region_id_kecamatan", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kecamatan", ccsGet, NULL), $this);
        $this->wp_p_region_id_kecamatan->Required = true;
        $this->wp_kelurahan = & new clsControl(ccsTextBox, "wp_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("wp_kelurahan", ccsGet, NULL), $this);
        $this->wp_kelurahan->Required = true;
        $this->wp_p_region_id_kelurahan = & new clsControl(ccsHidden, "wp_p_region_id_kelurahan", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kelurahan", ccsGet, NULL), $this);
        $this->wp_p_region_id_kelurahan->Required = true;
        $this->wp_phone_no = & new clsControl(ccsTextBox, "wp_phone_no", "No. Telephon - WP", ccsText, "", CCGetRequestParam("wp_phone_no", ccsGet, NULL), $this);
        $this->wp_mobile_no = & new clsControl(ccsTextBox, "wp_mobile_no", "No. Selular - WP", ccsText, "", CCGetRequestParam("wp_mobile_no", ccsGet, NULL), $this);
        $this->wp_email = & new clsControl(ccsTextBox, "wp_email", "Email - WP", ccsText, "", CCGetRequestParam("wp_email", ccsGet, NULL), $this);
        $this->wp_fax_no = & new clsControl(ccsTextBox, "wp_fax_no", "No. Fax - WP", ccsText, "", CCGetRequestParam("wp_fax_no", ccsGet, NULL), $this);
        $this->wp_zip_code = & new clsControl(ccsTextBox, "wp_zip_code", "Kode Pos - WP", ccsText, "", CCGetRequestParam("wp_zip_code", ccsGet, NULL), $this);
        $this->company_name = & new clsControl(ccsTextBox, "company_name", "Nama Badan/Perusahaan", ccsText, "", CCGetRequestParam("company_name", ccsGet, NULL), $this);
        $this->company_name->Required = true;
        $this->address_name = & new clsControl(ccsTextArea, "address_name", "Alamat Badan", ccsText, "", CCGetRequestParam("address_name", ccsGet, NULL), $this);
        $this->address_name->Required = true;
        $this->address_no = & new clsControl(ccsTextBox, "address_no", "No - Badan", ccsText, "", CCGetRequestParam("address_no", ccsGet, NULL), $this);
        $this->address_no->Required = true;
        $this->address_rt = & new clsControl(ccsTextBox, "address_rt", "Rt - Badan", ccsText, "", CCGetRequestParam("address_rt", ccsGet, NULL), $this);
        $this->address_rw = & new clsControl(ccsTextBox, "address_rw", "Rw - Badan", ccsText, "", CCGetRequestParam("address_rw", ccsGet, NULL), $this);
        $this->kota_code = & new clsControl(ccsTextBox, "kota_code", "Kota/Kabupaten - Badan", ccsText, "", CCGetRequestParam("kota_code", ccsGet, NULL), $this);
        $this->kota_code->Required = true;
        $this->p_region_id = & new clsControl(ccsHidden, "p_region_id", "Kota/Kabupaten - Badan", ccsFloat, "", CCGetRequestParam("p_region_id", ccsGet, NULL), $this);
        $this->p_region_id->Required = true;
        $this->kecamatan_code = & new clsControl(ccsTextBox, "kecamatan_code", "Kecamatan - Badan", ccsText, "", CCGetRequestParam("kecamatan_code", ccsGet, NULL), $this);
        $this->kecamatan_code->Required = true;
        $this->p_region_id_kecamatan = & new clsControl(ccsHidden, "p_region_id_kecamatan", "Kecamatan - Badan", ccsFloat, "", CCGetRequestParam("p_region_id_kecamatan", ccsGet, NULL), $this);
        $this->p_region_id_kecamatan->Required = true;
        $this->kelurahan_code = & new clsControl(ccsTextBox, "kelurahan_code", "Kelurahan - Badan", ccsText, "", CCGetRequestParam("kelurahan_code", ccsGet, NULL), $this);
        $this->kelurahan_code->Required = true;
        $this->p_region_id_kelurahan = & new clsControl(ccsHidden, "p_region_id_kelurahan", "Kelurahan - Badan", ccsFloat, "", CCGetRequestParam("p_region_id_kelurahan", ccsGet, NULL), $this);
        $this->p_region_id_kelurahan->Required = true;
        $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "No. Telephon - Badan", ccsText, "", CCGetRequestParam("phone_no", ccsGet, NULL), $this);
        $this->mobile_no = & new clsControl(ccsTextBox, "mobile_no", "No. Handphone", ccsText, "", CCGetRequestParam("mobile_no", ccsGet, NULL), $this);
        $this->fax_no = & new clsControl(ccsTextBox, "fax_no", "No. Fax - Badan", ccsText, "", CCGetRequestParam("fax_no", ccsGet, NULL), $this);
        $this->zip_code = & new clsControl(ccsTextBox, "zip_code", "Kode Pos - Badan", ccsText, "", CCGetRequestParam("zip_code", ccsGet, NULL), $this);
        $this->company_brand = & new clsControl(ccsTextBox, "company_brand", "Nama Merk Dagang", ccsText, "", CCGetRequestParam("company_brand", ccsGet, NULL), $this);
        $this->company_brand->Required = true;
        $this->brand_address_name = & new clsControl(ccsTextArea, "brand_address_name", "Alamat", ccsText, "", CCGetRequestParam("brand_address_name", ccsGet, NULL), $this);
        $this->brand_address_name->Required = true;
        $this->brand_address_no = & new clsControl(ccsTextBox, "brand_address_no", "No - Usaha", ccsText, "", CCGetRequestParam("brand_address_no", ccsGet, NULL), $this);
        $this->brand_address_no->Required = true;
        $this->brand_address_rt = & new clsControl(ccsTextBox, "brand_address_rt", "Rt - Usaha", ccsText, "", CCGetRequestParam("brand_address_rt", ccsGet, NULL), $this);
        $this->brand_address_rw = & new clsControl(ccsTextBox, "brand_address_rw", "Rw - Usaha", ccsText, "", CCGetRequestParam("brand_address_rw", ccsGet, NULL), $this);
        $this->brand_kota = & new clsControl(ccsTextBox, "brand_kota", "Kota/Kabupaten - Usaha", ccsText, "", CCGetRequestParam("brand_kota", ccsGet, NULL), $this);
        $this->brand_kota->Required = true;
        $this->brand_p_region_id = & new clsControl(ccsHidden, "brand_p_region_id", "Kota/Kabupaten - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id", ccsGet, NULL), $this);
        $this->brand_p_region_id->Required = true;
        $this->brand_kecamatan = & new clsControl(ccsTextBox, "brand_kecamatan", "Kecamatan - Usaha", ccsText, "", CCGetRequestParam("brand_kecamatan", ccsGet, NULL), $this);
        $this->brand_kecamatan->Required = true;
        $this->brand_p_region_id_kec = & new clsControl(ccsHidden, "brand_p_region_id_kec", "Kecamatan - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id_kec", ccsGet, NULL), $this);
        $this->brand_p_region_id_kec->Required = true;
        $this->brand_kelurahan = & new clsControl(ccsTextBox, "brand_kelurahan", "Kelurahan - Usaha", ccsText, "", CCGetRequestParam("brand_kelurahan", ccsGet, NULL), $this);
        $this->brand_kelurahan->Required = true;
        $this->brand_p_region_id_kel = & new clsControl(ccsHidden, "brand_p_region_id_kel", "Kelurahan - Usaha", ccsFloat, "", CCGetRequestParam("brand_p_region_id_kel", ccsGet, NULL), $this);
        $this->brand_p_region_id_kel->Required = true;
        $this->brand_phone_no = & new clsControl(ccsTextBox, "brand_phone_no", "No. Telephon - Usaha", ccsText, "", CCGetRequestParam("brand_phone_no", ccsGet, NULL), $this);
        $this->brand_mobile_no = & new clsControl(ccsTextBox, "brand_mobile_no", "No. Selular - Usaha", ccsText, "", CCGetRequestParam("brand_mobile_no", ccsGet, NULL), $this);
        $this->brand_fax_no = & new clsControl(ccsTextBox, "brand_fax_no", "No. Fax - Usaha", ccsText, "", CCGetRequestParam("brand_fax_no", ccsGet, NULL), $this);
        $this->brand_zip_code = & new clsControl(ccsTextBox, "brand_zip_code", "Kode Pos - Usaha", ccsText, "", CCGetRequestParam("brand_zip_code", ccsGet, NULL), $this);
        $this->company_owner = & new clsControl(ccsTextBox, "company_owner", "Nama Pemilik/Pengelola", ccsText, "", CCGetRequestParam("company_owner", ccsGet, NULL), $this);
        $this->company_owner->Required = true;
        $this->job_position_code = & new clsControl(ccsTextBox, "job_position_code", "Jabatan Pemilik", ccsText, "", CCGetRequestParam("job_position_code", ccsGet, NULL), $this);
        $this->job_position_code->Required = true;
        $this->p_job_position_id = & new clsControl(ccsHidden, "p_job_position_id", "p_order_status_id", ccsFloat, "", CCGetRequestParam("p_job_position_id", ccsGet, NULL), $this);
        $this->address_name_owner = & new clsControl(ccsTextArea, "address_name_owner", "Alamat Tempat Tinggal", ccsText, "", CCGetRequestParam("address_name_owner", ccsGet, NULL), $this);
        $this->address_name_owner->Required = true;
        $this->address_no_owner = & new clsControl(ccsTextBox, "address_no_owner", "No - Pemilik", ccsText, "", CCGetRequestParam("address_no_owner", ccsGet, NULL), $this);
        $this->address_no_owner->Required = true;
        $this->address_rt_owner = & new clsControl(ccsTextBox, "address_rt_owner", "Rt - Pemilik", ccsText, "", CCGetRequestParam("address_rt_owner", ccsGet, NULL), $this);
        $this->address_rw_owner = & new clsControl(ccsTextBox, "address_rw_owner", "Rw - Pemilik", ccsText, "", CCGetRequestParam("address_rw_owner", ccsGet, NULL), $this);
        $this->kota_own_code = & new clsControl(ccsTextBox, "kota_own_code", "Kota/Kabupaten - Pemilik", ccsText, "", CCGetRequestParam("kota_own_code", ccsGet, NULL), $this);
        $this->kota_own_code->Required = true;
        $this->p_region_id_owner = & new clsControl(ccsHidden, "p_region_id_owner", "Kota/Kabupaten - Pemilik", ccsFloat, "", CCGetRequestParam("p_region_id_owner", ccsGet, NULL), $this);
        $this->p_region_id_owner->Required = true;
        $this->kecamatan_own_code = & new clsControl(ccsTextBox, "kecamatan_own_code", "Kecamatan - Pemilik", ccsText, "", CCGetRequestParam("kecamatan_own_code", ccsGet, NULL), $this);
        $this->kecamatan_own_code->Required = true;
        $this->p_region_id_kec_owner = & new clsControl(ccsHidden, "p_region_id_kec_owner", "Kecamatan - Pemilik", ccsFloat, "", CCGetRequestParam("p_region_id_kec_owner", ccsGet, NULL), $this);
        $this->p_region_id_kec_owner->Required = true;
        $this->kelurahan_own_code = & new clsControl(ccsTextBox, "kelurahan_own_code", "Kelurahan - Pemilk", ccsText, "", CCGetRequestParam("kelurahan_own_code", ccsGet, NULL), $this);
        $this->kelurahan_own_code->Required = true;
        $this->p_region_id_kel_owner = & new clsControl(ccsHidden, "p_region_id_kel_owner", "Kelurahan - Pemilk", ccsFloat, "", CCGetRequestParam("p_region_id_kel_owner", ccsGet, NULL), $this);
        $this->p_region_id_kel_owner->Required = true;
        $this->email = & new clsControl(ccsTextBox, "email", "Email - Pemilik", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->phone_no_owner = & new clsControl(ccsTextBox, "phone_no_owner", "No. Telephon - Pemilk", ccsText, "", CCGetRequestParam("phone_no_owner", ccsGet, NULL), $this);
        $this->fax_no_owner = & new clsControl(ccsTextBox, "fax_no_owner", "No. Fax - Pemilk", ccsText, "", CCGetRequestParam("fax_no_owner", ccsGet, NULL), $this);
        $this->zip_code_owner = & new clsControl(ccsTextBox, "zip_code_owner", "Kode Pos - Pemilk", ccsText, "", CCGetRequestParam("zip_code_owner", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-952E60E5
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_customer_order_id"] = CCGetFromGet("t_customer_order_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->p_vat_type_dtl_id->Prepare();

        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        if(!is_array($this->registration_date->Value) && !strlen($this->registration_date->Value) && $this->registration_date->Value !== false)
            $this->registration_date->SetText(date("d-M-Y h:i:s"));
        if(!is_array($this->wp_kota->Value) && !strlen($this->wp_kota->Value) && $this->wp_kota->Value !== false)
            $this->wp_kota->SetText('KOTA BANDUNG');
        if(!is_array($this->wp_p_region_id->Value) && !strlen($this->wp_p_region_id->Value) && $this->wp_p_region_id->Value !== false)
            $this->wp_p_region_id->SetText(749);
        if(!is_array($this->kota_code->Value) && !strlen($this->kota_code->Value) && $this->kota_code->Value !== false)
            $this->kota_code->SetText('KOTA BANDUNG');
        if(!is_array($this->p_region_id->Value) && !strlen($this->p_region_id->Value) && $this->p_region_id->Value !== false)
            $this->p_region_id->SetText(749);
        if(!is_array($this->brand_kota->Value) && !strlen($this->brand_kota->Value) && $this->brand_kota->Value !== false)
            $this->brand_kota->SetText('KOTA BANDUNG');
        if(!is_array($this->brand_p_region_id->Value) && !strlen($this->brand_p_region_id->Value) && $this->brand_p_region_id->Value !== false)
            $this->brand_p_region_id->SetText(749);
        if(!is_array($this->kota_own_code->Value) && !strlen($this->kota_own_code->Value) && $this->kota_own_code->Value !== false)
            $this->kota_own_code->SetText('KOTA BANDUNG');
        if(!is_array($this->p_region_id_owner->Value) && !strlen($this->p_region_id_owner->Value) && $this->p_region_id_owner->Value !== false)
            $this->p_region_id_owner->SetText(749);
        $this->order_no->SetValue($this->DataSource->order_no->GetValue());
        $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
        $this->t_vat_registration_id1->SetValue($this->DataSource->t_vat_registration_id1->GetValue());
        $this->registration_date->SetValue($this->DataSource->registration_date->GetValue());
        $this->p_vat_type_dtl_id->SetValue($this->DataSource->p_vat_type_dtl_id->GetValue());
        $this->wp_user_name->SetValue($this->DataSource->wp_user_name->GetValue());
        $this->wp_user_pwd->SetValue($this->DataSource->wp_user_pwd->GetValue());
        $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
        $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
        $this->wp_address_no->SetValue($this->DataSource->wp_address_no->GetValue());
        $this->wp_address_rt->SetValue($this->DataSource->wp_address_rt->GetValue());
        $this->wp_address_rw->SetValue($this->DataSource->wp_address_rw->GetValue());
        $this->wp_kota->SetValue($this->DataSource->wp_kota->GetValue());
        $this->wp_p_region_id->SetValue($this->DataSource->wp_p_region_id->GetValue());
        $this->wp_kecamatan->SetValue($this->DataSource->wp_kecamatan->GetValue());
        $this->wp_p_region_id_kecamatan->SetValue($this->DataSource->wp_p_region_id_kecamatan->GetValue());
        $this->wp_kelurahan->SetValue($this->DataSource->wp_kelurahan->GetValue());
        $this->wp_p_region_id_kelurahan->SetValue($this->DataSource->wp_p_region_id_kelurahan->GetValue());
        $this->wp_phone_no->SetValue($this->DataSource->wp_phone_no->GetValue());
        $this->wp_mobile_no->SetValue($this->DataSource->wp_mobile_no->GetValue());
        $this->wp_email->SetValue($this->DataSource->wp_email->GetValue());
        $this->wp_fax_no->SetValue($this->DataSource->wp_fax_no->GetValue());
        $this->wp_zip_code->SetValue($this->DataSource->wp_zip_code->GetValue());
        $this->company_name->SetValue($this->DataSource->company_name->GetValue());
        $this->address_name->SetValue($this->DataSource->address_name->GetValue());
        $this->address_no->SetValue($this->DataSource->address_no->GetValue());
        $this->address_rt->SetValue($this->DataSource->address_rt->GetValue());
        $this->address_rw->SetValue($this->DataSource->address_rw->GetValue());
        $this->kota_code->SetValue($this->DataSource->kota_code->GetValue());
        $this->p_region_id->SetValue($this->DataSource->p_region_id->GetValue());
        $this->kecamatan_code->SetValue($this->DataSource->kecamatan_code->GetValue());
        $this->p_region_id_kecamatan->SetValue($this->DataSource->p_region_id_kecamatan->GetValue());
        $this->kelurahan_code->SetValue($this->DataSource->kelurahan_code->GetValue());
        $this->p_region_id_kelurahan->SetValue($this->DataSource->p_region_id_kelurahan->GetValue());
        $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
        $this->mobile_no->SetValue($this->DataSource->mobile_no->GetValue());
        $this->fax_no->SetValue($this->DataSource->fax_no->GetValue());
        $this->zip_code->SetValue($this->DataSource->zip_code->GetValue());
        $this->company_brand->SetValue($this->DataSource->company_brand->GetValue());
        $this->brand_address_name->SetValue($this->DataSource->brand_address_name->GetValue());
        $this->brand_address_no->SetValue($this->DataSource->brand_address_no->GetValue());
        $this->brand_address_rt->SetValue($this->DataSource->brand_address_rt->GetValue());
        $this->brand_address_rw->SetValue($this->DataSource->brand_address_rw->GetValue());
        $this->brand_kota->SetValue($this->DataSource->brand_kota->GetValue());
        $this->brand_p_region_id->SetValue($this->DataSource->brand_p_region_id->GetValue());
        $this->brand_kecamatan->SetValue($this->DataSource->brand_kecamatan->GetValue());
        $this->brand_p_region_id_kec->SetValue($this->DataSource->brand_p_region_id_kec->GetValue());
        $this->brand_kelurahan->SetValue($this->DataSource->brand_kelurahan->GetValue());
        $this->brand_p_region_id_kel->SetValue($this->DataSource->brand_p_region_id_kel->GetValue());
        $this->brand_phone_no->SetValue($this->DataSource->brand_phone_no->GetValue());
        $this->brand_mobile_no->SetValue($this->DataSource->brand_mobile_no->GetValue());
        $this->brand_fax_no->SetValue($this->DataSource->brand_fax_no->GetValue());
        $this->brand_zip_code->SetValue($this->DataSource->brand_zip_code->GetValue());
        $this->company_owner->SetValue($this->DataSource->company_owner->GetValue());
        $this->job_position_code->SetValue($this->DataSource->job_position_code->GetValue());
        $this->p_job_position_id->SetValue($this->DataSource->p_job_position_id->GetValue());
        $this->address_name_owner->SetValue($this->DataSource->address_name_owner->GetValue());
        $this->address_no_owner->SetValue($this->DataSource->address_no_owner->GetValue());
        $this->address_rt_owner->SetValue($this->DataSource->address_rt_owner->GetValue());
        $this->address_rw_owner->SetValue($this->DataSource->address_rw_owner->GetValue());
        $this->kota_own_code->SetValue($this->DataSource->kota_own_code->GetValue());
        $this->p_region_id_owner->SetValue($this->DataSource->p_region_id_owner->GetValue());
        $this->kecamatan_own_code->SetValue($this->DataSource->kecamatan_own_code->GetValue());
        $this->p_region_id_kec_owner->SetValue($this->DataSource->p_region_id_kec_owner->GetValue());
        $this->kelurahan_own_code->SetValue($this->DataSource->kelurahan_own_code->GetValue());
        $this->p_region_id_kel_owner->SetValue($this->DataSource->p_region_id_kel_owner->GetValue());
        $this->email->SetValue($this->DataSource->email->GetValue());
        $this->phone_no_owner->SetValue($this->DataSource->phone_no_owner->GetValue());
        $this->fax_no_owner->SetValue($this->DataSource->fax_no_owner->GetValue());
        $this->zip_code_owner->SetValue($this->DataSource->zip_code_owner->GetValue());
        $this->order_no->Show();
        $this->t_customer_order_id->Show();
        $this->p_rqst_type_id->Show();
        $this->t_vat_registration_id1->Show();
        $this->registration_date->Show();
        $this->rqst_type_code->Show();
        $this->p_vat_type_dtl_id->Show();
        $this->wp_user_name->Show();
        $this->wp_user_pwd->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->wp_address_no->Show();
        $this->wp_address_rt->Show();
        $this->wp_address_rw->Show();
        $this->wp_kota->Show();
        $this->wp_p_region_id->Show();
        $this->wp_kecamatan->Show();
        $this->wp_p_region_id_kecamatan->Show();
        $this->wp_kelurahan->Show();
        $this->wp_p_region_id_kelurahan->Show();
        $this->wp_phone_no->Show();
        $this->wp_mobile_no->Show();
        $this->wp_email->Show();
        $this->wp_fax_no->Show();
        $this->wp_zip_code->Show();
        $this->company_name->Show();
        $this->address_name->Show();
        $this->address_no->Show();
        $this->address_rt->Show();
        $this->address_rw->Show();
        $this->kota_code->Show();
        $this->p_region_id->Show();
        $this->kecamatan_code->Show();
        $this->p_region_id_kecamatan->Show();
        $this->kelurahan_code->Show();
        $this->p_region_id_kelurahan->Show();
        $this->phone_no->Show();
        $this->mobile_no->Show();
        $this->fax_no->Show();
        $this->zip_code->Show();
        $this->company_brand->Show();
        $this->brand_address_name->Show();
        $this->brand_address_no->Show();
        $this->brand_address_rt->Show();
        $this->brand_address_rw->Show();
        $this->brand_kota->Show();
        $this->brand_p_region_id->Show();
        $this->brand_kecamatan->Show();
        $this->brand_p_region_id_kec->Show();
        $this->brand_kelurahan->Show();
        $this->brand_p_region_id_kel->Show();
        $this->brand_phone_no->Show();
        $this->brand_mobile_no->Show();
        $this->brand_fax_no->Show();
        $this->brand_zip_code->Show();
        $this->company_owner->Show();
        $this->job_position_code->Show();
        $this->p_job_position_id->Show();
        $this->address_name_owner->Show();
        $this->address_no_owner->Show();
        $this->address_rt_owner->Show();
        $this->address_rw_owner->Show();
        $this->kota_own_code->Show();
        $this->p_region_id_owner->Show();
        $this->kecamatan_own_code->Show();
        $this->p_region_id_kec_owner->Show();
        $this->kelurahan_own_code->Show();
        $this->p_region_id_kel_owner->Show();
        $this->email->Show();
        $this->phone_no_owner->Show();
        $this->fax_no_owner->Show();
        $this->zip_code_owner->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-580C33D7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End f_SELECT_FROM_v_vat_regis Class @2-FCB6E20C

class clsf_SELECT_FROM_v_vat_regisDataSource extends clsDBConnSIKP {  //f_SELECT_FROM_v_vat_regisDataSource Class @2-B21B695B

//DataSource Variables @2-E69B7D11
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $order_no;
    var $t_customer_order_id;
    var $t_vat_registration_id1;
    var $registration_date;
    var $p_vat_type_dtl_id;
    var $wp_user_name;
    var $wp_user_pwd;
    var $wp_name;
    var $wp_address_name;
    var $wp_address_no;
    var $wp_address_rt;
    var $wp_address_rw;
    var $wp_kota;
    var $wp_p_region_id;
    var $wp_kecamatan;
    var $wp_p_region_id_kecamatan;
    var $wp_kelurahan;
    var $wp_p_region_id_kelurahan;
    var $wp_phone_no;
    var $wp_mobile_no;
    var $wp_email;
    var $wp_fax_no;
    var $wp_zip_code;
    var $company_name;
    var $address_name;
    var $address_no;
    var $address_rt;
    var $address_rw;
    var $kota_code;
    var $p_region_id;
    var $kecamatan_code;
    var $p_region_id_kecamatan;
    var $kelurahan_code;
    var $p_region_id_kelurahan;
    var $phone_no;
    var $mobile_no;
    var $fax_no;
    var $zip_code;
    var $company_brand;
    var $brand_address_name;
    var $brand_address_no;
    var $brand_address_rt;
    var $brand_address_rw;
    var $brand_kota;
    var $brand_p_region_id;
    var $brand_kecamatan;
    var $brand_p_region_id_kec;
    var $brand_kelurahan;
    var $brand_p_region_id_kel;
    var $brand_phone_no;
    var $brand_mobile_no;
    var $brand_fax_no;
    var $brand_zip_code;
    var $company_owner;
    var $job_position_code;
    var $p_job_position_id;
    var $address_name_owner;
    var $address_no_owner;
    var $address_rt_owner;
    var $address_rw_owner;
    var $kota_own_code;
    var $p_region_id_owner;
    var $kecamatan_own_code;
    var $p_region_id_kec_owner;
    var $kelurahan_own_code;
    var $p_region_id_kel_owner;
    var $email;
    var $phone_no_owner;
    var $fax_no_owner;
    var $zip_code_owner;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A6022567
    function clsf_SELECT_FROM_v_vat_regisDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid f_SELECT_FROM_v_vat_regis";
        $this->Initialize();
        $this->order_no = new clsField("order_no", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->t_vat_registration_id1 = new clsField("t_vat_registration_id1", ccsFloat, "");
        
        $this->registration_date = new clsField("registration_date", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsFloat, "");
        
        $this->wp_user_name = new clsField("wp_user_name", ccsText, "");
        
        $this->wp_user_pwd = new clsField("wp_user_pwd", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->wp_address_no = new clsField("wp_address_no", ccsText, "");
        
        $this->wp_address_rt = new clsField("wp_address_rt", ccsText, "");
        
        $this->wp_address_rw = new clsField("wp_address_rw", ccsText, "");
        
        $this->wp_kota = new clsField("wp_kota", ccsText, "");
        
        $this->wp_p_region_id = new clsField("wp_p_region_id", ccsFloat, "");
        
        $this->wp_kecamatan = new clsField("wp_kecamatan", ccsText, "");
        
        $this->wp_p_region_id_kecamatan = new clsField("wp_p_region_id_kecamatan", ccsFloat, "");
        
        $this->wp_kelurahan = new clsField("wp_kelurahan", ccsText, "");
        
        $this->wp_p_region_id_kelurahan = new clsField("wp_p_region_id_kelurahan", ccsFloat, "");
        
        $this->wp_phone_no = new clsField("wp_phone_no", ccsText, "");
        
        $this->wp_mobile_no = new clsField("wp_mobile_no", ccsText, "");
        
        $this->wp_email = new clsField("wp_email", ccsText, "");
        
        $this->wp_fax_no = new clsField("wp_fax_no", ccsText, "");
        
        $this->wp_zip_code = new clsField("wp_zip_code", ccsText, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->address_name = new clsField("address_name", ccsText, "");
        
        $this->address_no = new clsField("address_no", ccsText, "");
        
        $this->address_rt = new clsField("address_rt", ccsText, "");
        
        $this->address_rw = new clsField("address_rw", ccsText, "");
        
        $this->kota_code = new clsField("kota_code", ccsText, "");
        
        $this->p_region_id = new clsField("p_region_id", ccsFloat, "");
        
        $this->kecamatan_code = new clsField("kecamatan_code", ccsText, "");
        
        $this->p_region_id_kecamatan = new clsField("p_region_id_kecamatan", ccsFloat, "");
        
        $this->kelurahan_code = new clsField("kelurahan_code", ccsText, "");
        
        $this->p_region_id_kelurahan = new clsField("p_region_id_kelurahan", ccsFloat, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->mobile_no = new clsField("mobile_no", ccsText, "");
        
        $this->fax_no = new clsField("fax_no", ccsText, "");
        
        $this->zip_code = new clsField("zip_code", ccsText, "");
        
        $this->company_brand = new clsField("company_brand", ccsText, "");
        
        $this->brand_address_name = new clsField("brand_address_name", ccsText, "");
        
        $this->brand_address_no = new clsField("brand_address_no", ccsText, "");
        
        $this->brand_address_rt = new clsField("brand_address_rt", ccsText, "");
        
        $this->brand_address_rw = new clsField("brand_address_rw", ccsText, "");
        
        $this->brand_kota = new clsField("brand_kota", ccsText, "");
        
        $this->brand_p_region_id = new clsField("brand_p_region_id", ccsFloat, "");
        
        $this->brand_kecamatan = new clsField("brand_kecamatan", ccsText, "");
        
        $this->brand_p_region_id_kec = new clsField("brand_p_region_id_kec", ccsFloat, "");
        
        $this->brand_kelurahan = new clsField("brand_kelurahan", ccsText, "");
        
        $this->brand_p_region_id_kel = new clsField("brand_p_region_id_kel", ccsFloat, "");
        
        $this->brand_phone_no = new clsField("brand_phone_no", ccsText, "");
        
        $this->brand_mobile_no = new clsField("brand_mobile_no", ccsText, "");
        
        $this->brand_fax_no = new clsField("brand_fax_no", ccsText, "");
        
        $this->brand_zip_code = new clsField("brand_zip_code", ccsText, "");
        
        $this->company_owner = new clsField("company_owner", ccsText, "");
        
        $this->job_position_code = new clsField("job_position_code", ccsText, "");
        
        $this->p_job_position_id = new clsField("p_job_position_id", ccsFloat, "");
        
        $this->address_name_owner = new clsField("address_name_owner", ccsText, "");
        
        $this->address_no_owner = new clsField("address_no_owner", ccsText, "");
        
        $this->address_rt_owner = new clsField("address_rt_owner", ccsText, "");
        
        $this->address_rw_owner = new clsField("address_rw_owner", ccsText, "");
        
        $this->kota_own_code = new clsField("kota_own_code", ccsText, "");
        
        $this->p_region_id_owner = new clsField("p_region_id_owner", ccsFloat, "");
        
        $this->kecamatan_own_code = new clsField("kecamatan_own_code", ccsText, "");
        
        $this->p_region_id_kec_owner = new clsField("p_region_id_kec_owner", ccsFloat, "");
        
        $this->kelurahan_own_code = new clsField("kelurahan_own_code", ccsText, "");
        
        $this->p_region_id_kel_owner = new clsField("p_region_id_kel_owner", ccsFloat, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->phone_no_owner = new clsField("phone_no_owner", ccsText, "");
        
        $this->fax_no_owner = new clsField("fax_no_owner", ccsText, "");
        
        $this->zip_code_owner = new clsField("zip_code_owner", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-22392826
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_customer_order_id", ccsInteger, "", "", $this->Parameters["urlt_customer_order_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-7216C72B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "FROM v_vat_registration\n" .
        "WHERE t_customer_order_id =" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . ") cnt";
        $this->SQL = "SELECT * \n" .
        "FROM v_vat_registration\n" .
        "WHERE t_customer_order_id =" . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-3CAA3CFD
    function SetValues()
    {
        $this->order_no->SetDBValue($this->f("order_no"));
        $this->t_customer_order_id->SetDBValue(trim($this->f("t_customer_order_id")));
        $this->t_vat_registration_id1->SetDBValue(trim($this->f("t_vat_registration_id")));
        $this->registration_date->SetDBValue($this->f("registration_date"));
        $this->p_vat_type_dtl_id->SetDBValue(trim($this->f("p_vat_type_dtl_id")));
        $this->wp_user_name->SetDBValue($this->f("wp_user_name"));
        $this->wp_user_pwd->SetDBValue($this->f("wp_user_pwd"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->wp_address_no->SetDBValue($this->f("wp_address_no"));
        $this->wp_address_rt->SetDBValue($this->f("wp_address_rt"));
        $this->wp_address_rw->SetDBValue($this->f("wp_address_rw"));
        $this->wp_kota->SetDBValue($this->f("wp_kota"));
        $this->wp_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
        $this->wp_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->wp_p_region_id_kecamatan->SetDBValue(trim($this->f("wp_p_region_id_kecamatan")));
        $this->wp_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->wp_p_region_id_kelurahan->SetDBValue(trim($this->f("wp_p_region_id_kelurahan")));
        $this->wp_phone_no->SetDBValue($this->f("wp_phone_no"));
        $this->wp_mobile_no->SetDBValue($this->f("wp_mobile_no"));
        $this->wp_email->SetDBValue($this->f("wp_email"));
        $this->wp_fax_no->SetDBValue($this->f("wp_fax_no"));
        $this->wp_zip_code->SetDBValue($this->f("wp_zip_code"));
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->address_name->SetDBValue($this->f("address_name"));
        $this->address_no->SetDBValue($this->f("address_no"));
        $this->address_rt->SetDBValue($this->f("address_rt"));
        $this->address_rw->SetDBValue($this->f("address_rw"));
        $this->kota_code->SetDBValue($this->f("kota_code"));
        $this->p_region_id->SetDBValue(trim($this->f("p_region_id")));
        $this->kecamatan_code->SetDBValue($this->f("kecamatan_code"));
        $this->p_region_id_kecamatan->SetDBValue(trim($this->f("p_region_id_kecamatan")));
        $this->kelurahan_code->SetDBValue($this->f("kelurahan_code"));
        $this->p_region_id_kelurahan->SetDBValue(trim($this->f("p_region_id_kelurahan")));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->mobile_no->SetDBValue($this->f("mobile_no"));
        $this->fax_no->SetDBValue($this->f("fax_no"));
        $this->zip_code->SetDBValue($this->f("zip_code"));
        $this->company_brand->SetDBValue($this->f("company_brand"));
        $this->brand_address_name->SetDBValue($this->f("brand_address_name"));
        $this->brand_address_no->SetDBValue($this->f("brand_address_no"));
        $this->brand_address_rt->SetDBValue($this->f("brand_address_rt"));
        $this->brand_address_rw->SetDBValue($this->f("brand_address_rw"));
        $this->brand_kota->SetDBValue($this->f("brand_kota"));
        $this->brand_p_region_id->SetDBValue(trim($this->f("brand_p_region_id")));
        $this->brand_kecamatan->SetDBValue($this->f("brand_kecamatan"));
        $this->brand_p_region_id_kec->SetDBValue(trim($this->f("brand_p_region_id_kec")));
        $this->brand_kelurahan->SetDBValue($this->f("brand_kelurahan"));
        $this->brand_p_region_id_kel->SetDBValue(trim($this->f("brand_p_region_id_kel")));
        $this->brand_phone_no->SetDBValue($this->f("brand_phone_no"));
        $this->brand_mobile_no->SetDBValue($this->f("brand_mobile_no"));
        $this->brand_fax_no->SetDBValue($this->f("brand_fax_no"));
        $this->brand_zip_code->SetDBValue($this->f("brand_zip_code"));
        $this->company_owner->SetDBValue($this->f("company_owner"));
        $this->job_position_code->SetDBValue($this->f("job_position_code"));
        $this->p_job_position_id->SetDBValue(trim($this->f("p_job_position_id")));
        $this->address_name_owner->SetDBValue($this->f("address_name_owner"));
        $this->address_no_owner->SetDBValue($this->f("address_no_owner"));
        $this->address_rt_owner->SetDBValue($this->f("address_rt_owner"));
        $this->address_rw_owner->SetDBValue($this->f("address_rw_owner"));
        $this->kota_own_code->SetDBValue($this->f("kota_own_code"));
        $this->p_region_id_owner->SetDBValue(trim($this->f("p_region_id_owner")));
        $this->kecamatan_own_code->SetDBValue($this->f("kecamatan_own_code"));
        $this->p_region_id_kec_owner->SetDBValue(trim($this->f("p_region_id_kec_owner")));
        $this->kelurahan_own_code->SetDBValue($this->f("kelurahan_own_code"));
        $this->p_region_id_kel_owner->SetDBValue(trim($this->f("p_region_id_kel_owner")));
        $this->email->SetDBValue($this->f("email"));
        $this->phone_no_owner->SetDBValue($this->f("phone_no_owner"));
        $this->fax_no_owner->SetDBValue($this->f("fax_no_owner"));
        $this->zip_code_owner->SetDBValue($this->f("zip_code_owner"));
    }
//End SetValues Method

} //End f_SELECT_FROM_v_vat_regisDataSource Class @2-FCB6E20C

//Initialize Page @1-1ABC8D32
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
$TemplateFileName = "getRegistrationInfo.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7B7B79B4
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$f_SELECT_FROM_v_vat_regis = & new clsGridf_SELECT_FROM_v_vat_regis("", $MainPage);
$MainPage->f_SELECT_FROM_v_vat_regis = & $f_SELECT_FROM_v_vat_regis;
$f_SELECT_FROM_v_vat_regis->Initialize();

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

//Go to destination page @1-9DE25156
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($f_SELECT_FROM_v_vat_regis);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D3AC4E4A
$f_SELECT_FROM_v_vat_regis->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C03EC710
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($f_SELECT_FROM_v_vat_regis);
unset($Tpl);
//End Unload Page


?>
