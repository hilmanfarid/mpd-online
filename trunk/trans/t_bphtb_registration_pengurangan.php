<?php
//Include Common Files @1-56D9F845
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_registration_pengurangan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordt_bphtb_registrationForm { //t_bphtb_registrationForm Class @2-9C17DAB3

//Variables @2-D6FF3E86

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

//Class_Initialize Event @2-D9FCEA9D
    function clsRecordt_bphtb_registrationForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_bphtb_registrationForm/Error";
        $this->DataSource = new clst_bphtb_registrationFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_bphtb_registrationForm";
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
            $this->wp_kota = & new clsControl(ccsTextBox, "wp_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("wp_kota", $Method, NULL), $this);
            $this->wp_kota->Required = true;
            $this->wp_kelurahan = & new clsControl(ccsTextBox, "wp_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("wp_kelurahan", $Method, NULL), $this);
            $this->wp_kelurahan->Required = true;
            $this->wp_p_region_id = & new clsControl(ccsHidden, "wp_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id", $Method, NULL), $this);
            $this->wp_p_region_id->Required = true;
            $this->wp_p_region_id_kec = & new clsControl(ccsHidden, "wp_p_region_id_kec", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kec", $Method, NULL), $this);
            $this->wp_p_region_id_kec->Required = true;
            $this->wp_p_region_id_kel = & new clsControl(ccsHidden, "wp_p_region_id_kel", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kel", $Method, NULL), $this);
            $this->wp_p_region_id_kel->Required = true;
            $this->wp_kecamatan = & new clsControl(ccsTextBox, "wp_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("wp_kecamatan", $Method, NULL), $this);
            $this->wp_kecamatan->Required = true;
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextBox, "wp_address_name", "wp_address_name", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->npwp = & new clsControl(ccsTextBox, "npwp", "npwp", ccsText, "", CCGetRequestParam("npwp", $Method, NULL), $this);
            $this->object_kelurahan = & new clsControl(ccsTextBox, "object_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("object_kelurahan", $Method, NULL), $this);
            $this->object_kelurahan->Required = true;
            $this->object_p_region_id_kel = & new clsControl(ccsHidden, "object_p_region_id_kel", "Kelurahan - Object", ccsFloat, "", CCGetRequestParam("object_p_region_id_kel", $Method, NULL), $this);
            $this->object_p_region_id_kel->Required = true;
            $this->object_kecamatan = & new clsControl(ccsTextBox, "object_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("object_kecamatan", $Method, NULL), $this);
            $this->object_kecamatan->Required = true;
            $this->object_p_region_id_kec = & new clsControl(ccsHidden, "object_p_region_id_kec", "Kecamatan - Object", ccsFloat, "", CCGetRequestParam("object_p_region_id_kec", $Method, NULL), $this);
            $this->object_p_region_id_kec->Required = true;
            $this->object_kota = & new clsControl(ccsTextBox, "object_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("object_kota", $Method, NULL), $this);
            $this->object_kota->Required = true;
            $this->object_p_region_id = & new clsControl(ccsHidden, "object_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("object_p_region_id", $Method, NULL), $this);
            $this->object_p_region_id->Required = true;
            $this->land_area = & new clsControl(ccsTextBox, "land_area", "land_area", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("land_area", $Method, NULL), $this);
            $this->land_price_per_m = & new clsControl(ccsTextBox, "land_price_per_m", "land_price_per_m", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("land_price_per_m", $Method, NULL), $this);
            $this->land_total_price = & new clsControl(ccsTextBox, "land_total_price", "land_total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("land_total_price", $Method, NULL), $this);
            $this->building_area = & new clsControl(ccsTextBox, "building_area", "building_area", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("building_area", $Method, NULL), $this);
            $this->building_price_per_m = & new clsControl(ccsTextBox, "building_price_per_m", "building_price_per_m", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("building_price_per_m", $Method, NULL), $this);
            $this->building_total_price = & new clsControl(ccsTextBox, "building_total_price", "building_total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("building_total_price", $Method, NULL), $this);
            $this->wp_rt = & new clsControl(ccsTextBox, "wp_rt", "wp_rt", ccsText, "", CCGetRequestParam("wp_rt", $Method, NULL), $this);
            $this->wp_rw = & new clsControl(ccsTextBox, "wp_rw", "wp_rw", ccsText, "", CCGetRequestParam("wp_rw", $Method, NULL), $this);
            $this->object_rt = & new clsControl(ccsTextBox, "object_rt", "object_rt", ccsText, "", CCGetRequestParam("object_rt", $Method, NULL), $this);
            $this->object_rw = & new clsControl(ccsTextBox, "object_rw", "object_rw", ccsText, "", CCGetRequestParam("object_rw", $Method, NULL), $this);
            $this->njop_pbb = & new clsControl(ccsTextBox, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", $Method, NULL), $this);
            $this->object_address_name = & new clsControl(ccsTextBox, "object_address_name", "object_address_name", ccsText, "", CCGetRequestParam("object_address_name", $Method, NULL), $this);
            $this->npop = & new clsControl(ccsTextBox, "npop", "npop", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("npop", $Method, NULL), $this);
            $this->npop_tkp = & new clsControl(ccsTextBox, "npop_tkp", "npop_tkp", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("npop_tkp", $Method, NULL), $this);
            $this->npop_kp = & new clsControl(ccsTextBox, "npop_kp", "npop_kp", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("npop_kp", $Method, NULL), $this);
            $this->bphtb_amt = & new clsControl(ccsTextBox, "bphtb_amt", "bphtb_amt", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("bphtb_amt", $Method, NULL), $this);
            $this->bphtb_amt_final = & new clsControl(ccsTextBox, "bphtb_amt_final", "bphtb_amt_final", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("bphtb_amt_final", $Method, NULL), $this);
            $this->bphtb_discount = & new clsControl(ccsTextBox, "bphtb_discount", "bphtb_discount", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("bphtb_discount", $Method, NULL), $this);
            $this->bphtb_discount->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->market_price = & new clsControl(ccsTextBox, "market_price", "market_price", ccsFloat, array(True, 0, Null, Null, False, array("#", "#", "#"), "", 1, True, ""), CCGetRequestParam("market_price", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "phone_no", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->mobile_phone_no = & new clsControl(ccsTextBox, "mobile_phone_no", "mobile_phone_no", ccsText, "", CCGetRequestParam("mobile_phone_no", $Method, NULL), $this);
            $this->total_price = & new clsControl(ccsTextBox, "total_price", "total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_price", $Method, NULL), $this);
            $this->t_bphtb_registration_id = & new clsControl(ccsHidden, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsInteger, "", CCGetRequestParam("t_bphtb_registration_id", $Method, NULL), $this);
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
            $this->p_bphtb_legal_doc_type_id = & new clsControl(ccsListBox, "p_bphtb_legal_doc_type_id", "p_bphtb_legal_doc_type_id", ccsText, "", CCGetRequestParam("p_bphtb_legal_doc_type_id", $Method, NULL), $this);
            $this->p_bphtb_legal_doc_type_id->DSType = dsSQL;
            $this->p_bphtb_legal_doc_type_id->DataSource = new clsDBConnSIKP();
            $this->p_bphtb_legal_doc_type_id->ds = & $this->p_bphtb_legal_doc_type_id->DataSource;
            list($this->p_bphtb_legal_doc_type_id->BoundColumn, $this->p_bphtb_legal_doc_type_id->TextColumn, $this->p_bphtb_legal_doc_type_id->DBFormat) = array("p_bphtb_legal_doc_type_id", "code", "");
            $this->p_bphtb_legal_doc_type_id->DataSource->SQL = "select p_bphtb_legal_doc_type_id,code\n" .
            "from p_bphtb_legal_doc_type bphtb_legal\n" .
            "left join p_legal_doc_type legal on legal.p_legal_doc_type_id = bphtb_legal.p_legal_doc_type_id\n" .
            "";
            $this->p_bphtb_legal_doc_type_id->DataSource->Order = "";
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsText, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsText, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->registration_no = & new clsControl(ccsTextBox, "registration_no", "registration_no", ccsText, "", CCGetRequestParam("registration_no", $Method, NULL), $this);
            $this->jenis_harga_bphtb = & new clsControl(ccsListBox, "jenis_harga_bphtb", "jenis_harga_bphtb", ccsText, "", CCGetRequestParam("jenis_harga_bphtb", $Method, NULL), $this);
            $this->jenis_harga_bphtb->DSType = dsListOfValues;
            $this->jenis_harga_bphtb->Values = array(array("1", "Harga Transaksi"), array("2", "Harga Pasar"), array("3", "Harga Lelang"));
            $this->bphtb_legal_doc_description = & new clsControl(ccsTextBox, "bphtb_legal_doc_description", "bphtb_legal_doc_description", ccsText, "", CCGetRequestParam("bphtb_legal_doc_description", $Method, NULL), $this);
            $this->nilai_doc = & new clsControl(ccsHidden, "nilai_doc", "nilai_doc", ccsText, "", CCGetRequestParam("nilai_doc", $Method, NULL), $this);
            $this->add_disc_percent = & new clsControl(ccsListBox, "add_disc_percent", "add_disc_percent", ccsText, "", CCGetRequestParam("add_disc_percent", $Method, NULL), $this);
            $this->add_disc_percent->DSType = dsListOfValues;
            $this->add_disc_percent->Values = array(array("0", "0%"), array("0.25", "25%"), array("0.5", "50%"), array("0.75", "75%"), array("1", "100%"));
            $this->add_discount = & new clsControl(ccsTextBox, "add_discount", "add_discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("add_discount", $Method, NULL), $this);
            $this->p_bphtb_type_id = & new clsControl(ccsTextBox, "p_bphtb_type_id", "p_bphtb_type_id", ccsText, "", CCGetRequestParam("p_bphtb_type_id", $Method, NULL), $this);
            $this->t_bphtb_exemption_id = & new clsControl(ccsHidden, "t_bphtb_exemption_id", "t_bphtb_exemption_id", ccsInteger, "", CCGetRequestParam("t_bphtb_exemption_id", $Method, NULL), $this);
            $this->Button4 = & new clsButton("Button4", $Method, $this);
            $this->Button6 = & new clsButton("Button6", $Method, $this);
            $this->pilihan_lembar_cetak = & new clsControl(ccsListBox, "pilihan_lembar_cetak", "pilihan_lembar_cetak", ccsText, "", CCGetRequestParam("pilihan_lembar_cetak", $Method, NULL), $this);
            $this->pilihan_lembar_cetak->DSType = dsListOfValues;
            $this->pilihan_lembar_cetak->Values = array(array("1", "Waris"), array("2", "Fasos"), array("3", "Rumah Dinas"), array("4", "Waris Gono-Gini"), array("5", "Hibah"), array("6", "Peralihan Hak Baru"));
            $this->pilihan_lembar_cetak->Required = true;
            $this->opsi_a2 = & new clsControl(ccsListBox, "opsi_a2", "opsi_a2", ccsText, "", CCGetRequestParam("opsi_a2", $Method, NULL), $this);
            $this->opsi_a2->DSType = dsListOfValues;
            $this->opsi_a2->Values = "";
            $this->a2_val = & new clsControl(ccsHidden, "a2_val", "a2_val", ccsText, "", CCGetRequestParam("a2_val", $Method, NULL), $this);
            $this->opsi_a2_keterangan = & new clsControl(ccsTextBox, "opsi_a2_keterangan", "opsi_a2_keterangan", ccsText, "", CCGetRequestParam("opsi_a2_keterangan", $Method, NULL), $this);
            $this->opsi_b7 = & new clsControl(ccsListBox, "opsi_b7", "opsi_b7", ccsText, "", CCGetRequestParam("opsi_b7", $Method, NULL), $this);
            $this->opsi_b7->DSType = dsListOfValues;
            $this->opsi_b7->Values = "";
            $this->b7_val = & new clsControl(ccsHidden, "b7_val", "b7_val", ccsText, "", CCGetRequestParam("b7_val", $Method, NULL), $this);
            $this->opsi_b7_keterangan = & new clsControl(ccsTextBox, "opsi_b7_keterangan", "opsi_b7_keterangan", ccsText, "", CCGetRequestParam("opsi_b7_keterangan", $Method, NULL), $this);
            $this->tanggal_sk = & new clsControl(ccsTextBox, "tanggal_sk", "tanggal_sk", ccsText, "", CCGetRequestParam("tanggal_sk", $Method, NULL), $this);
            $this->DatePicker_tanggal_sk1 = & new clsDatePicker("DatePicker_tanggal_sk1", "t_bphtb_registrationForm", "tanggal_sk", $this);
            $this->dasar_pengurang = & new clsControl(ccsTextArea, "dasar_pengurang", "dasar_pengurang", ccsText, "", CCGetRequestParam("dasar_pengurang", $Method, NULL), $this);
            $this->analisa_penguranan = & new clsControl(ccsTextArea, "analisa_penguranan", "analisa_penguranan", ccsText, "", CCGetRequestParam("analisa_penguranan", $Method, NULL), $this);
            $this->keterangan_opsi_c = & new clsControl(ccsTextBox, "keterangan_opsi_c", "keterangan_opsi_c", ccsText, "", CCGetRequestParam("keterangan_opsi_c", $Method, NULL), $this);
            $this->keterangan_opsi_c_gono_gini = & new clsControl(ccsTextArea, "keterangan_opsi_c_gono_gini", "keterangan_opsi_c_gono_gini", ccsText, "", CCGetRequestParam("keterangan_opsi_c_gono_gini", $Method, NULL), $this);
            $this->Button5 = & new clsButton("Button5", $Method, $this);
            $this->Button7 = & new clsButton("Button7", $Method, $this);
            $this->administrator_id = & new clsControl(ccsListBox, "administrator_id", "administrator_id", ccsText, "", CCGetRequestParam("administrator_id", $Method, NULL), $this);
            $this->administrator_id->DSType = dsSQL;
            $this->administrator_id->DataSource = new clsDBConnSIKP();
            $this->administrator_id->ds = & $this->administrator_id->DataSource;
            list($this->administrator_id->BoundColumn, $this->administrator_id->TextColumn, $this->administrator_id->DBFormat) = array("t_bphtb_exemption_pemeriksa_id", "pemeriksa_nama", "");
            $this->administrator_id->DataSource->SQL = "SELECT * FROM t_bphtb_exemption_pemeriksa\n" .
            "WHERE pemeriksa_status = 'administrator'";
            $this->administrator_id->DataSource->Order = "";
            $this->pemeriksa_id = & new clsControl(ccsListBox, "pemeriksa_id", "pemeriksa_id", ccsText, "", CCGetRequestParam("pemeriksa_id", $Method, NULL), $this);
            $this->pemeriksa_id->DSType = dsSQL;
            $this->pemeriksa_id->DataSource = new clsDBConnSIKP();
            $this->pemeriksa_id->ds = & $this->pemeriksa_id->DataSource;
            list($this->pemeriksa_id->BoundColumn, $this->pemeriksa_id->TextColumn, $this->pemeriksa_id->DBFormat) = array("", "", "");
            $this->pemeriksa_id->DataSource->SQL = "SELECT * FROM t_bphtb_exemption_pemeriksa\n" .
            "WHERE pemeriksa_status = 'pemeriksa'";
            $this->pemeriksa_id->DataSource->Order = "";
            $this->tanggal_berita_acara = & new clsControl(ccsTextBox, "tanggal_berita_acara", "tanggal_berita_acara", ccsText, "", CCGetRequestParam("tanggal_berita_acara", $Method, NULL), $this);
            $this->DatePicker_tanggal_berita_acara1 = & new clsDatePicker("DatePicker_tanggal_berita_acara1", "t_bphtb_registrationForm", "tanggal_berita_acara", $this);
            $this->nomor_notaris = & new clsControl(ccsTextBox, "nomor_notaris", "nomor_notaris", ccsText, "", CCGetRequestParam("nomor_notaris", $Method, NULL), $this);
            $this->nomor_berita_acara = & new clsControl(ccsTextBox, "nomor_berita_acara", "nomor_berita_acara", ccsText, "", CCGetRequestParam("nomor_berita_acara", $Method, NULL), $this);
            $this->Button8 = & new clsButton("Button8", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->wp_kota->Value) && !strlen($this->wp_kota->Value) && $this->wp_kota->Value !== false)
                    $this->wp_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->wp_p_region_id->Value) && !strlen($this->wp_p_region_id->Value) && $this->wp_p_region_id->Value !== false)
                    $this->wp_p_region_id->SetText(749);
                if(!is_array($this->object_kota->Value) && !strlen($this->object_kota->Value) && $this->object_kota->Value !== false)
                    $this->object_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->object_p_region_id->Value) && !strlen($this->object_p_region_id->Value) && $this->object_p_region_id->Value !== false)
                    $this->object_p_region_id->SetText(749);
                if(!is_array($this->land_area->Value) && !strlen($this->land_area->Value) && $this->land_area->Value !== false)
                    $this->land_area->SetText(0);
                if(!is_array($this->land_price_per_m->Value) && !strlen($this->land_price_per_m->Value) && $this->land_price_per_m->Value !== false)
                    $this->land_price_per_m->SetText(0);
                if(!is_array($this->land_total_price->Value) && !strlen($this->land_total_price->Value) && $this->land_total_price->Value !== false)
                    $this->land_total_price->SetText(0);
                if(!is_array($this->building_area->Value) && !strlen($this->building_area->Value) && $this->building_area->Value !== false)
                    $this->building_area->SetText(0);
                if(!is_array($this->building_price_per_m->Value) && !strlen($this->building_price_per_m->Value) && $this->building_price_per_m->Value !== false)
                    $this->building_price_per_m->SetText(0);
                if(!is_array($this->building_total_price->Value) && !strlen($this->building_total_price->Value) && $this->building_total_price->Value !== false)
                    $this->building_total_price->SetText(0);
                if(!is_array($this->total_price->Value) && !strlen($this->total_price->Value) && $this->total_price->Value !== false)
                    $this->total_price->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-830DBF3E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlCURR_DOC_ID"] = CCGetFromGet("CURR_DOC_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-86BFD5B2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->wp_kota->Validate() && $Validation);
        $Validation = ($this->wp_kelurahan->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->wp_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->npwp->Validate() && $Validation);
        $Validation = ($this->object_kelurahan->Validate() && $Validation);
        $Validation = ($this->object_p_region_id_kel->Validate() && $Validation);
        $Validation = ($this->object_kecamatan->Validate() && $Validation);
        $Validation = ($this->object_p_region_id_kec->Validate() && $Validation);
        $Validation = ($this->object_kota->Validate() && $Validation);
        $Validation = ($this->object_p_region_id->Validate() && $Validation);
        $Validation = ($this->land_area->Validate() && $Validation);
        $Validation = ($this->land_price_per_m->Validate() && $Validation);
        $Validation = ($this->land_total_price->Validate() && $Validation);
        $Validation = ($this->building_area->Validate() && $Validation);
        $Validation = ($this->building_price_per_m->Validate() && $Validation);
        $Validation = ($this->building_total_price->Validate() && $Validation);
        $Validation = ($this->wp_rt->Validate() && $Validation);
        $Validation = ($this->wp_rw->Validate() && $Validation);
        $Validation = ($this->object_rt->Validate() && $Validation);
        $Validation = ($this->object_rw->Validate() && $Validation);
        $Validation = ($this->njop_pbb->Validate() && $Validation);
        $Validation = ($this->object_address_name->Validate() && $Validation);
        $Validation = ($this->npop->Validate() && $Validation);
        $Validation = ($this->npop_tkp->Validate() && $Validation);
        $Validation = ($this->npop_kp->Validate() && $Validation);
        $Validation = ($this->bphtb_amt->Validate() && $Validation);
        $Validation = ($this->bphtb_amt_final->Validate() && $Validation);
        $Validation = ($this->bphtb_discount->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->market_price->Validate() && $Validation);
        $Validation = ($this->phone_no->Validate() && $Validation);
        $Validation = ($this->mobile_phone_no->Validate() && $Validation);
        $Validation = ($this->total_price->Validate() && $Validation);
        $Validation = ($this->t_bphtb_registration_id->Validate() && $Validation);
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
        $Validation = ($this->p_bphtb_legal_doc_type_id->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->registration_no->Validate() && $Validation);
        $Validation = ($this->jenis_harga_bphtb->Validate() && $Validation);
        $Validation = ($this->bphtb_legal_doc_description->Validate() && $Validation);
        $Validation = ($this->nilai_doc->Validate() && $Validation);
        $Validation = ($this->add_disc_percent->Validate() && $Validation);
        $Validation = ($this->add_discount->Validate() && $Validation);
        $Validation = ($this->p_bphtb_type_id->Validate() && $Validation);
        $Validation = ($this->t_bphtb_exemption_id->Validate() && $Validation);
        $Validation = ($this->pilihan_lembar_cetak->Validate() && $Validation);
        $Validation = ($this->opsi_a2->Validate() && $Validation);
        $Validation = ($this->a2_val->Validate() && $Validation);
        $Validation = ($this->opsi_a2_keterangan->Validate() && $Validation);
        $Validation = ($this->opsi_b7->Validate() && $Validation);
        $Validation = ($this->b7_val->Validate() && $Validation);
        $Validation = ($this->opsi_b7_keterangan->Validate() && $Validation);
        $Validation = ($this->tanggal_sk->Validate() && $Validation);
        $Validation = ($this->dasar_pengurang->Validate() && $Validation);
        $Validation = ($this->analisa_penguranan->Validate() && $Validation);
        $Validation = ($this->keterangan_opsi_c->Validate() && $Validation);
        $Validation = ($this->keterangan_opsi_c_gono_gini->Validate() && $Validation);
        $Validation = ($this->administrator_id->Validate() && $Validation);
        $Validation = ($this->pemeriksa_id->Validate() && $Validation);
        $Validation = ($this->tanggal_berita_acara->Validate() && $Validation);
        $Validation = ($this->nomor_notaris->Validate() && $Validation);
        $Validation = ($this->nomor_berita_acara->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->wp_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id_kel->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id_kec->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->land_area->Errors->Count() == 0);
        $Validation =  $Validation && ($this->land_price_per_m->Errors->Count() == 0);
        $Validation =  $Validation && ($this->land_total_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->building_area->Errors->Count() == 0);
        $Validation =  $Validation && ($this->building_price_per_m->Errors->Count() == 0);
        $Validation =  $Validation && ($this->building_total_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_pbb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npop->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npop_tkp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npop_kp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_amt_final->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_discount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->market_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_bphtb_registration_id->Errors->Count() == 0);
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
        $Validation =  $Validation && ($this->p_bphtb_legal_doc_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->registration_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jenis_harga_bphtb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_legal_doc_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nilai_doc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->add_disc_percent->Errors->Count() == 0);
        $Validation =  $Validation && ($this->add_discount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bphtb_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_bphtb_exemption_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pilihan_lembar_cetak->Errors->Count() == 0);
        $Validation =  $Validation && ($this->opsi_a2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->a2_val->Errors->Count() == 0);
        $Validation =  $Validation && ($this->opsi_a2_keterangan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->opsi_b7->Errors->Count() == 0);
        $Validation =  $Validation && ($this->b7_val->Errors->Count() == 0);
        $Validation =  $Validation && ($this->opsi_b7_keterangan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tanggal_sk->Errors->Count() == 0);
        $Validation =  $Validation && ($this->dasar_pengurang->Errors->Count() == 0);
        $Validation =  $Validation && ($this->analisa_penguranan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->keterangan_opsi_c->Errors->Count() == 0);
        $Validation =  $Validation && ($this->keterangan_opsi_c_gono_gini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->administrator_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pemeriksa_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->tanggal_berita_acara->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nomor_notaris->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nomor_berita_acara->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-5B659E81
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->wp_kota->Errors->Count());
        $errors = ($errors || $this->wp_kelurahan->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->wp_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->npwp->Errors->Count());
        $errors = ($errors || $this->object_kelurahan->Errors->Count());
        $errors = ($errors || $this->object_p_region_id_kel->Errors->Count());
        $errors = ($errors || $this->object_kecamatan->Errors->Count());
        $errors = ($errors || $this->object_p_region_id_kec->Errors->Count());
        $errors = ($errors || $this->object_kota->Errors->Count());
        $errors = ($errors || $this->object_p_region_id->Errors->Count());
        $errors = ($errors || $this->land_area->Errors->Count());
        $errors = ($errors || $this->land_price_per_m->Errors->Count());
        $errors = ($errors || $this->land_total_price->Errors->Count());
        $errors = ($errors || $this->building_area->Errors->Count());
        $errors = ($errors || $this->building_price_per_m->Errors->Count());
        $errors = ($errors || $this->building_total_price->Errors->Count());
        $errors = ($errors || $this->wp_rt->Errors->Count());
        $errors = ($errors || $this->wp_rw->Errors->Count());
        $errors = ($errors || $this->object_rt->Errors->Count());
        $errors = ($errors || $this->object_rw->Errors->Count());
        $errors = ($errors || $this->njop_pbb->Errors->Count());
        $errors = ($errors || $this->object_address_name->Errors->Count());
        $errors = ($errors || $this->npop->Errors->Count());
        $errors = ($errors || $this->npop_tkp->Errors->Count());
        $errors = ($errors || $this->npop_kp->Errors->Count());
        $errors = ($errors || $this->bphtb_amt->Errors->Count());
        $errors = ($errors || $this->bphtb_amt_final->Errors->Count());
        $errors = ($errors || $this->bphtb_discount->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->market_price->Errors->Count());
        $errors = ($errors || $this->phone_no->Errors->Count());
        $errors = ($errors || $this->mobile_phone_no->Errors->Count());
        $errors = ($errors || $this->total_price->Errors->Count());
        $errors = ($errors || $this->t_bphtb_registration_id->Errors->Count());
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
        $errors = ($errors || $this->p_bphtb_legal_doc_type_id->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->registration_no->Errors->Count());
        $errors = ($errors || $this->jenis_harga_bphtb->Errors->Count());
        $errors = ($errors || $this->bphtb_legal_doc_description->Errors->Count());
        $errors = ($errors || $this->nilai_doc->Errors->Count());
        $errors = ($errors || $this->add_disc_percent->Errors->Count());
        $errors = ($errors || $this->add_discount->Errors->Count());
        $errors = ($errors || $this->p_bphtb_type_id->Errors->Count());
        $errors = ($errors || $this->t_bphtb_exemption_id->Errors->Count());
        $errors = ($errors || $this->pilihan_lembar_cetak->Errors->Count());
        $errors = ($errors || $this->opsi_a2->Errors->Count());
        $errors = ($errors || $this->a2_val->Errors->Count());
        $errors = ($errors || $this->opsi_a2_keterangan->Errors->Count());
        $errors = ($errors || $this->opsi_b7->Errors->Count());
        $errors = ($errors || $this->b7_val->Errors->Count());
        $errors = ($errors || $this->opsi_b7_keterangan->Errors->Count());
        $errors = ($errors || $this->tanggal_sk->Errors->Count());
        $errors = ($errors || $this->DatePicker_tanggal_sk1->Errors->Count());
        $errors = ($errors || $this->dasar_pengurang->Errors->Count());
        $errors = ($errors || $this->analisa_penguranan->Errors->Count());
        $errors = ($errors || $this->keterangan_opsi_c->Errors->Count());
        $errors = ($errors || $this->keterangan_opsi_c_gono_gini->Errors->Count());
        $errors = ($errors || $this->administrator_id->Errors->Count());
        $errors = ($errors || $this->pemeriksa_id->Errors->Count());
        $errors = ($errors || $this->tanggal_berita_acara->Errors->Count());
        $errors = ($errors || $this->DatePicker_tanggal_berita_acara1->Errors->Count());
        $errors = ($errors || $this->nomor_notaris->Errors->Count());
        $errors = ($errors || $this->nomor_berita_acara->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-EFE5C861
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
            } else if($this->Button6->Pressed) {
                $this->PressedButton = "Button6";
            } else if($this->Button5->Pressed) {
                $this->PressedButton = "Button5";
            } else if($this->Button7->Pressed) {
                $this->PressedButton = "Button7";
            } else if($this->Button8->Pressed) {
                $this->PressedButton = "Button8";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_registration_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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
            } else if($this->PressedButton == "Button6") {
                if(!CCGetEvent($this->Button6->CCSEvents, "OnClick", $this->Button6)) {
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
            } else if($this->PressedButton == "Button8") {
                if(!CCGetEvent($this->Button8->CCSEvents, "OnClick", $this->Button8)) {
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

//UpdateRow Method @2-B00EE110
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_bphtb_registration_id->SetValue($this->t_bphtb_registration_id->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_p_region_id_kel->SetValue($this->wp_p_region_id_kel->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->npwp->SetValue($this->npwp->GetValue(true));
        $this->DataSource->object_p_region_id_kec->SetValue($this->object_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id->SetValue($this->object_p_region_id->GetValue(true));
        $this->DataSource->land_area->SetValue($this->land_area->GetValue(true));
        $this->DataSource->land_price_per_m->SetValue($this->land_price_per_m->GetValue(true));
        $this->DataSource->land_total_price->SetValue($this->land_total_price->GetValue(true));
        $this->DataSource->building_area->SetValue($this->building_area->GetValue(true));
        $this->DataSource->building_price_per_m->SetValue($this->building_price_per_m->GetValue(true));
        $this->DataSource->building_total_price->SetValue($this->building_total_price->GetValue(true));
        $this->DataSource->wp_rt->SetValue($this->wp_rt->GetValue(true));
        $this->DataSource->wp_rw->SetValue($this->wp_rw->GetValue(true));
        $this->DataSource->object_rt->SetValue($this->object_rt->GetValue(true));
        $this->DataSource->object_rw->SetValue($this->object_rw->GetValue(true));
        $this->DataSource->njop_pbb->SetValue($this->njop_pbb->GetValue(true));
        $this->DataSource->object_address_name->SetValue($this->object_address_name->GetValue(true));
        $this->DataSource->p_bphtb_legal_doc_type_id->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        $this->DataSource->npop->SetValue($this->npop->GetValue(true));
        $this->DataSource->npop_tkp->SetValue($this->npop_tkp->GetValue(true));
        $this->DataSource->npop_kp->SetValue($this->npop_kp->GetValue(true));
        $this->DataSource->bphtb_amt->SetValue($this->bphtb_amt->GetValue(true));
        $this->DataSource->bphtb_amt_final->SetValue($this->bphtb_amt_final->GetValue(true));
        $this->DataSource->bphtb_discount->SetValue($this->bphtb_discount->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->market_price->SetValue($this->market_price->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->wp_p_region_id_kec->SetValue($this->wp_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id_kel->SetValue($this->object_p_region_id_kel->GetValue(true));
        $this->DataSource->bphtb_legal_doc_description->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        $this->DataSource->add_disc_percent->SetValue($this->add_disc_percent->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-70DEB9AF
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

        $this->p_bphtb_legal_doc_type_id->Prepare();
        $this->jenis_harga_bphtb->Prepare();
        $this->add_disc_percent->Prepare();
        $this->pilihan_lembar_cetak->Prepare();
        $this->opsi_a2->Prepare();
        $this->opsi_b7->Prepare();
        $this->administrator_id->Prepare();
        $this->pemeriksa_id->Prepare();

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
                    $this->wp_kota->SetValue($this->DataSource->wp_kota->GetValue());
                    $this->wp_kelurahan->SetValue($this->DataSource->wp_kelurahan->GetValue());
                    $this->wp_p_region_id->SetValue($this->DataSource->wp_p_region_id->GetValue());
                    $this->wp_p_region_id_kec->SetValue($this->DataSource->wp_p_region_id_kec->GetValue());
                    $this->wp_p_region_id_kel->SetValue($this->DataSource->wp_p_region_id_kel->GetValue());
                    $this->wp_kecamatan->SetValue($this->DataSource->wp_kecamatan->GetValue());
                    $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                    $this->wp_address_name->SetValue($this->DataSource->wp_address_name->GetValue());
                    $this->npwp->SetValue($this->DataSource->npwp->GetValue());
                    $this->object_kelurahan->SetValue($this->DataSource->object_kelurahan->GetValue());
                    $this->object_p_region_id_kel->SetValue($this->DataSource->object_p_region_id_kel->GetValue());
                    $this->object_kecamatan->SetValue($this->DataSource->object_kecamatan->GetValue());
                    $this->object_p_region_id_kec->SetValue($this->DataSource->object_p_region_id_kec->GetValue());
                    $this->object_kota->SetValue($this->DataSource->object_kota->GetValue());
                    $this->object_p_region_id->SetValue($this->DataSource->object_p_region_id->GetValue());
                    $this->land_area->SetValue($this->DataSource->land_area->GetValue());
                    $this->land_price_per_m->SetValue($this->DataSource->land_price_per_m->GetValue());
                    $this->land_total_price->SetValue($this->DataSource->land_total_price->GetValue());
                    $this->building_area->SetValue($this->DataSource->building_area->GetValue());
                    $this->building_price_per_m->SetValue($this->DataSource->building_price_per_m->GetValue());
                    $this->building_total_price->SetValue($this->DataSource->building_total_price->GetValue());
                    $this->wp_rt->SetValue($this->DataSource->wp_rt->GetValue());
                    $this->wp_rw->SetValue($this->DataSource->wp_rw->GetValue());
                    $this->object_rt->SetValue($this->DataSource->object_rt->GetValue());
                    $this->object_rw->SetValue($this->DataSource->object_rw->GetValue());
                    $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                    $this->object_address_name->SetValue($this->DataSource->object_address_name->GetValue());
                    $this->npop->SetValue($this->DataSource->npop->GetValue());
                    $this->npop_tkp->SetValue($this->DataSource->npop_tkp->GetValue());
                    $this->npop_kp->SetValue($this->DataSource->npop_kp->GetValue());
                    $this->bphtb_amt->SetValue($this->DataSource->bphtb_amt->GetValue());
                    $this->bphtb_amt_final->SetValue($this->DataSource->bphtb_amt_final->GetValue());
                    $this->bphtb_discount->SetValue($this->DataSource->bphtb_discount->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->market_price->SetValue($this->DataSource->market_price->GetValue());
                    $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
                    $this->mobile_phone_no->SetValue($this->DataSource->mobile_phone_no->GetValue());
                    $this->t_bphtb_registration_id->SetValue($this->DataSource->t_bphtb_registration_id->GetValue());
                    $this->p_bphtb_legal_doc_type_id->SetValue($this->DataSource->p_bphtb_legal_doc_type_id->GetValue());
                    $this->t_customer_order_id->SetValue($this->DataSource->t_customer_order_id->GetValue());
                    $this->p_rqst_type_id->SetValue($this->DataSource->p_rqst_type_id->GetValue());
                    $this->registration_no->SetValue($this->DataSource->registration_no->GetValue());
                    $this->jenis_harga_bphtb->SetValue($this->DataSource->jenis_harga_bphtb->GetValue());
                    $this->bphtb_legal_doc_description->SetValue($this->DataSource->bphtb_legal_doc_description->GetValue());
                    $this->add_disc_percent->SetValue($this->DataSource->add_disc_percent->GetValue());
                    $this->p_bphtb_type_id->SetValue($this->DataSource->p_bphtb_type_id->GetValue());
                    $this->t_bphtb_exemption_id->SetValue($this->DataSource->t_bphtb_exemption_id->GetValue());
                    $this->pilihan_lembar_cetak->SetValue($this->DataSource->pilihan_lembar_cetak->GetValue());
                    $this->opsi_a2->SetValue($this->DataSource->opsi_a2->GetValue());
                    $this->a2_val->SetValue($this->DataSource->a2_val->GetValue());
                    $this->opsi_a2_keterangan->SetValue($this->DataSource->opsi_a2_keterangan->GetValue());
                    $this->opsi_b7->SetValue($this->DataSource->opsi_b7->GetValue());
                    $this->b7_val->SetValue($this->DataSource->b7_val->GetValue());
                    $this->opsi_b7_keterangan->SetValue($this->DataSource->opsi_b7_keterangan->GetValue());
                    $this->tanggal_sk->SetValue($this->DataSource->tanggal_sk->GetValue());
                    $this->dasar_pengurang->SetValue($this->DataSource->dasar_pengurang->GetValue());
                    $this->analisa_penguranan->SetValue($this->DataSource->analisa_penguranan->GetValue());
                    $this->keterangan_opsi_c->SetValue($this->DataSource->keterangan_opsi_c->GetValue());
                    $this->keterangan_opsi_c_gono_gini->SetValue($this->DataSource->keterangan_opsi_c_gono_gini->GetValue());
                    $this->administrator_id->SetValue($this->DataSource->administrator_id->GetValue());
                    $this->pemeriksa_id->SetValue($this->DataSource->pemeriksa_id->GetValue());
                    $this->tanggal_berita_acara->SetValue($this->DataSource->tanggal_berita_acara->GetValue());
                    $this->nomor_notaris->SetValue($this->DataSource->nomor_notaris->GetValue());
                    $this->nomor_berita_acara->SetValue($this->DataSource->nomor_berita_acara->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
            $this->total_price->SetText($this->DataSource->land_total_price->GetValue()+$this->DataSource->building_total_price->GetValue());
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->wp_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id_kel->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id_kec->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->land_area->Errors->ToString());
            $Error = ComposeStrings($Error, $this->land_price_per_m->Errors->ToString());
            $Error = ComposeStrings($Error, $this->land_total_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->building_area->Errors->ToString());
            $Error = ComposeStrings($Error, $this->building_price_per_m->Errors->ToString());
            $Error = ComposeStrings($Error, $this->building_total_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_pbb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npop_tkp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npop_kp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_amt_final->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_discount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->market_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_bphtb_registration_id->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->p_bphtb_legal_doc_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->registration_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jenis_harga_bphtb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_legal_doc_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nilai_doc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->add_disc_percent->Errors->ToString());
            $Error = ComposeStrings($Error, $this->add_discount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bphtb_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_bphtb_exemption_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pilihan_lembar_cetak->Errors->ToString());
            $Error = ComposeStrings($Error, $this->opsi_a2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->a2_val->Errors->ToString());
            $Error = ComposeStrings($Error, $this->opsi_a2_keterangan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->opsi_b7->Errors->ToString());
            $Error = ComposeStrings($Error, $this->b7_val->Errors->ToString());
            $Error = ComposeStrings($Error, $this->opsi_b7_keterangan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tanggal_sk->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tanggal_sk1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->dasar_pengurang->Errors->ToString());
            $Error = ComposeStrings($Error, $this->analisa_penguranan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->keterangan_opsi_c->Errors->ToString());
            $Error = ComposeStrings($Error, $this->keterangan_opsi_c_gono_gini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->administrator_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pemeriksa_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->tanggal_berita_acara->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_tanggal_berita_acara1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nomor_notaris->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nomor_berita_acara->Errors->ToString());
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
        $this->wp_kota->Show();
        $this->wp_kelurahan->Show();
        $this->wp_p_region_id->Show();
        $this->wp_p_region_id_kec->Show();
        $this->wp_p_region_id_kel->Show();
        $this->wp_kecamatan->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->npwp->Show();
        $this->object_kelurahan->Show();
        $this->object_p_region_id_kel->Show();
        $this->object_kecamatan->Show();
        $this->object_p_region_id_kec->Show();
        $this->object_kota->Show();
        $this->object_p_region_id->Show();
        $this->land_area->Show();
        $this->land_price_per_m->Show();
        $this->land_total_price->Show();
        $this->building_area->Show();
        $this->building_price_per_m->Show();
        $this->building_total_price->Show();
        $this->wp_rt->Show();
        $this->wp_rw->Show();
        $this->object_rt->Show();
        $this->object_rw->Show();
        $this->njop_pbb->Show();
        $this->object_address_name->Show();
        $this->npop->Show();
        $this->npop_tkp->Show();
        $this->npop_kp->Show();
        $this->bphtb_amt->Show();
        $this->bphtb_amt_final->Show();
        $this->bphtb_discount->Show();
        $this->description->Show();
        $this->market_price->Show();
        $this->phone_no->Show();
        $this->mobile_phone_no->Show();
        $this->total_price->Show();
        $this->t_bphtb_registration_id->Show();
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
        $this->p_bphtb_legal_doc_type_id->Show();
        $this->t_customer_order_id->Show();
        $this->p_rqst_type_id->Show();
        $this->registration_no->Show();
        $this->jenis_harga_bphtb->Show();
        $this->bphtb_legal_doc_description->Show();
        $this->nilai_doc->Show();
        $this->add_disc_percent->Show();
        $this->add_discount->Show();
        $this->p_bphtb_type_id->Show();
        $this->t_bphtb_exemption_id->Show();
        $this->Button4->Show();
        $this->Button6->Show();
        $this->pilihan_lembar_cetak->Show();
        $this->opsi_a2->Show();
        $this->a2_val->Show();
        $this->opsi_a2_keterangan->Show();
        $this->opsi_b7->Show();
        $this->b7_val->Show();
        $this->opsi_b7_keterangan->Show();
        $this->tanggal_sk->Show();
        $this->DatePicker_tanggal_sk1->Show();
        $this->dasar_pengurang->Show();
        $this->analisa_penguranan->Show();
        $this->keterangan_opsi_c->Show();
        $this->keterangan_opsi_c_gono_gini->Show();
        $this->Button5->Show();
        $this->Button7->Show();
        $this->administrator_id->Show();
        $this->pemeriksa_id->Show();
        $this->tanggal_berita_acara->Show();
        $this->DatePicker_tanggal_berita_acara1->Show();
        $this->nomor_notaris->Show();
        $this->nomor_berita_acara->Show();
        $this->Button8->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_bphtb_registrationForm Class @2-FCB6E20C

class clst_bphtb_registrationFormDataSource extends clsDBConnSIKP {  //t_bphtb_registrationFormDataSource Class @2-BDFCC0BF

//DataSource Variables @2-993C2252
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $DeleteParameters;
    var $wp;
    var $AllParametersSet;

    var $UpdateFields = array();

    // Datasource fields
    var $wp_kota;
    var $wp_kelurahan;
    var $wp_p_region_id;
    var $wp_p_region_id_kec;
    var $wp_p_region_id_kel;
    var $wp_kecamatan;
    var $wp_name;
    var $wp_address_name;
    var $npwp;
    var $object_kelurahan;
    var $object_p_region_id_kel;
    var $object_kecamatan;
    var $object_p_region_id_kec;
    var $object_kota;
    var $object_p_region_id;
    var $land_area;
    var $land_price_per_m;
    var $land_total_price;
    var $building_area;
    var $building_price_per_m;
    var $building_total_price;
    var $wp_rt;
    var $wp_rw;
    var $object_rt;
    var $object_rw;
    var $njop_pbb;
    var $object_address_name;
    var $npop;
    var $npop_tkp;
    var $npop_kp;
    var $bphtb_amt;
    var $bphtb_amt_final;
    var $bphtb_discount;
    var $description;
    var $market_price;
    var $phone_no;
    var $mobile_phone_no;
    var $total_price;
    var $t_bphtb_registration_id;
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
    var $p_bphtb_legal_doc_type_id;
    var $t_customer_order_id;
    var $p_rqst_type_id;
    var $registration_no;
    var $jenis_harga_bphtb;
    var $bphtb_legal_doc_description;
    var $nilai_doc;
    var $add_disc_percent;
    var $add_discount;
    var $p_bphtb_type_id;
    var $t_bphtb_exemption_id;
    var $pilihan_lembar_cetak;
    var $opsi_a2;
    var $a2_val;
    var $opsi_a2_keterangan;
    var $opsi_b7;
    var $b7_val;
    var $opsi_b7_keterangan;
    var $tanggal_sk;
    var $dasar_pengurang;
    var $analisa_penguranan;
    var $keterangan_opsi_c;
    var $keterangan_opsi_c_gono_gini;
    var $administrator_id;
    var $pemeriksa_id;
    var $tanggal_berita_acara;
    var $nomor_notaris;
    var $nomor_berita_acara;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-307F75BF
    function clst_bphtb_registrationFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_bphtb_registrationForm/Error";
        $this->Initialize();
        $this->wp_kota = new clsField("wp_kota", ccsText, "");
        
        $this->wp_kelurahan = new clsField("wp_kelurahan", ccsText, "");
        
        $this->wp_p_region_id = new clsField("wp_p_region_id", ccsFloat, "");
        
        $this->wp_p_region_id_kec = new clsField("wp_p_region_id_kec", ccsFloat, "");
        
        $this->wp_p_region_id_kel = new clsField("wp_p_region_id_kel", ccsFloat, "");
        
        $this->wp_kecamatan = new clsField("wp_kecamatan", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->npwp = new clsField("npwp", ccsText, "");
        
        $this->object_kelurahan = new clsField("object_kelurahan", ccsText, "");
        
        $this->object_p_region_id_kel = new clsField("object_p_region_id_kel", ccsFloat, "");
        
        $this->object_kecamatan = new clsField("object_kecamatan", ccsText, "");
        
        $this->object_p_region_id_kec = new clsField("object_p_region_id_kec", ccsFloat, "");
        
        $this->object_kota = new clsField("object_kota", ccsText, "");
        
        $this->object_p_region_id = new clsField("object_p_region_id", ccsFloat, "");
        
        $this->land_area = new clsField("land_area", ccsFloat, "");
        
        $this->land_price_per_m = new clsField("land_price_per_m", ccsFloat, "");
        
        $this->land_total_price = new clsField("land_total_price", ccsFloat, "");
        
        $this->building_area = new clsField("building_area", ccsFloat, "");
        
        $this->building_price_per_m = new clsField("building_price_per_m", ccsFloat, "");
        
        $this->building_total_price = new clsField("building_total_price", ccsFloat, "");
        
        $this->wp_rt = new clsField("wp_rt", ccsText, "");
        
        $this->wp_rw = new clsField("wp_rw", ccsText, "");
        
        $this->object_rt = new clsField("object_rt", ccsText, "");
        
        $this->object_rw = new clsField("object_rw", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        
        $this->object_address_name = new clsField("object_address_name", ccsText, "");
        
        $this->npop = new clsField("npop", ccsFloat, "");
        
        $this->npop_tkp = new clsField("npop_tkp", ccsFloat, "");
        
        $this->npop_kp = new clsField("npop_kp", ccsFloat, "");
        
        $this->bphtb_amt = new clsField("bphtb_amt", ccsFloat, "");
        
        $this->bphtb_amt_final = new clsField("bphtb_amt_final", ccsFloat, "");
        
        $this->bphtb_discount = new clsField("bphtb_discount", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->market_price = new clsField("market_price", ccsFloat, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->mobile_phone_no = new clsField("mobile_phone_no", ccsText, "");
        
        $this->total_price = new clsField("total_price", ccsFloat, "");
        
        $this->t_bphtb_registration_id = new clsField("t_bphtb_registration_id", ccsInteger, "");
        
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
        
        $this->p_bphtb_legal_doc_type_id = new clsField("p_bphtb_legal_doc_type_id", ccsText, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsText, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsText, "");
        
        $this->registration_no = new clsField("registration_no", ccsText, "");
        
        $this->jenis_harga_bphtb = new clsField("jenis_harga_bphtb", ccsText, "");
        
        $this->bphtb_legal_doc_description = new clsField("bphtb_legal_doc_description", ccsText, "");
        
        $this->nilai_doc = new clsField("nilai_doc", ccsText, "");
        
        $this->add_disc_percent = new clsField("add_disc_percent", ccsText, "");
        
        $this->add_discount = new clsField("add_discount", ccsFloat, "");
        
        $this->p_bphtb_type_id = new clsField("p_bphtb_type_id", ccsText, "");
        
        $this->t_bphtb_exemption_id = new clsField("t_bphtb_exemption_id", ccsInteger, "");
        
        $this->pilihan_lembar_cetak = new clsField("pilihan_lembar_cetak", ccsText, "");
        
        $this->opsi_a2 = new clsField("opsi_a2", ccsText, "");
        
        $this->a2_val = new clsField("a2_val", ccsText, "");
        
        $this->opsi_a2_keterangan = new clsField("opsi_a2_keterangan", ccsText, "");
        
        $this->opsi_b7 = new clsField("opsi_b7", ccsText, "");
        
        $this->b7_val = new clsField("b7_val", ccsText, "");
        
        $this->opsi_b7_keterangan = new clsField("opsi_b7_keterangan", ccsText, "");
        
        $this->tanggal_sk = new clsField("tanggal_sk", ccsText, "");
        
        $this->dasar_pengurang = new clsField("dasar_pengurang", ccsText, "");
        
        $this->analisa_penguranan = new clsField("analisa_penguranan", ccsText, "");
        
        $this->keterangan_opsi_c = new clsField("keterangan_opsi_c", ccsText, "");
        
        $this->keterangan_opsi_c_gono_gini = new clsField("keterangan_opsi_c_gono_gini", ccsText, "");
        
        $this->administrator_id = new clsField("administrator_id", ccsText, "");
        
        $this->pemeriksa_id = new clsField("pemeriksa_id", ccsText, "");
        
        $this->tanggal_berita_acara = new clsField("tanggal_berita_acara", ccsText, "");
        
        $this->nomor_notaris = new clsField("nomor_notaris", ccsText, "");
        
        $this->nomor_berita_acara = new clsField("nomor_berita_acara", ccsText, "");
        

        $this->UpdateFields["updated_by"] = array("Name" => "updated_by", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["updated_date"] = array("Name" => "updated_date", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_p_region_id"] = array("Name" => "wp_p_region_id", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_p_region_id_kel"] = array("Name" => "wp_p_region_id_kel", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_name"] = array("Name" => "wp_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_address_name"] = array("Name" => "wp_address_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["npwp"] = array("Name" => "npwp", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_p_region_id_kec"] = array("Name" => "object_p_region_id_kec", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_p_region_id"] = array("Name" => "object_p_region_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["land_area"] = array("Name" => "land_area", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["land_price_per_m"] = array("Name" => "land_price_per_m", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["land_total_price"] = array("Name" => "land_total_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["building_area"] = array("Name" => "building_area", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["building_price_per_m"] = array("Name" => "building_price_per_m", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["building_total_price"] = array("Name" => "building_total_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_rt"] = array("Name" => "wp_rt", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_rw"] = array("Name" => "wp_rw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_rt"] = array("Name" => "object_rt", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_rw"] = array("Name" => "object_rw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["njop_pbb"] = array("Name" => "njop_pbb", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_address_name"] = array("Name" => "object_address_name", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["p_bphtb_legal_doc_type_id"] = array("Name" => "p_bphtb_legal_doc_type_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["npop"] = array("Name" => "npop", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["npop_tkp"] = array("Name" => "npop_tkp", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["npop_kp"] = array("Name" => "npop_kp", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_amt"] = array("Name" => "bphtb_amt", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_amt_final"] = array("Name" => "bphtb_amt_final", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_discount"] = array("Name" => "bphtb_discount", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["description"] = array("Name" => "description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["market_price"] = array("Name" => "market_price", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["mobile_phone_no"] = array("Name" => "mobile_phone_no", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["wp_p_region_id_kec"] = array("Name" => "wp_p_region_id_kec", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["object_p_region_id_kel"] = array("Name" => "object_p_region_id_kel", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["bphtb_legal_doc_description"] = array("Name" => "bphtb_legal_doc_description", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["add_disc_percent"] = array("Name" => "add_disc_percent", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-72CC4444
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlCURR_DOC_ID", ccsFloat, "", "", $this->Parameters["urlCURR_DOC_ID"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @2-CBCAF31F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select j.t_bphtb_exemption_id, j.exemption_amount, j.dasar_pengurang, j.analisa_penguranan, j.jenis_pensiunan, j.jenis_perolehan_hak, j.sk_bpn_no, to_char(j.tanggal_sk,'DD-MM-YYYY') as tanggal_sk, \n" .
        "j.pilihan_lembar_cetak, j.opsi_a2, j.opsi_a2_keterangan, j.opsi_b7, j.opsi_b7_keterangan, j.keterangan_opsi_c, j.keterangan_opsi_c_gono_gini,\n" .
        "to_char(j.tanggal_berita_acara,'DD-MM-YYYY') as tanggal_berita_acara, j.pemeriksa_id, j.administrator_id,\n" .
        "j.nomor_berita_acara, j.nomor_notaris,\n" .
        "k.pemeriksa_nama as nama_pemeriksa, k.pemeriksa_nip as nip_pemeriksa, k.pemeriksa_jabatan as jabatan_pemeriksa,\n" .
        "l.pemeriksa_nama as nama_operator, l.pemeriksa_nip as nip_operator, l.pemeriksa_jabatan as jabatan_operator,\n" .
        "a.*,\n" .
        "cust_order.p_rqst_type_id,\n" .
        "b.region_name as wp_kota,\n" .
        "c.region_name as wp_kecamatan,\n" .
        "d.region_name as wp_kelurahan,\n" .
        "e.region_name as object_region,\n" .
        "f.region_name as object_kecamatan,\n" .
        "g.region_name as object_kelurahan,\n" .
        "h.description as doc_name\n" .
        "\n" .
        "from t_bphtb_exemption as j\n" .
        "left join t_bphtb_registration as a  on j.t_bphtb_registration_id = a.t_bphtb_registration_id\n" .
        "left join p_region as b\n" .
        "	on a.wp_p_region_id = b.p_region_id\n" .
        "left join p_region as c\n" .
        "	on a.wp_p_region_id_kec = c.p_region_id\n" .
        "left join p_region as d\n" .
        "	on a.wp_p_region_id_kel = d.p_region_id\n" .
        "left join p_region as e\n" .
        "	on a.object_p_region_id = e.p_region_id\n" .
        "left join p_region as f\n" .
        "	on a.object_p_region_id_kec = f.p_region_id\n" .
        "left join p_region as g\n" .
        "	on a.object_p_region_id_kel = g.p_region_id\n" .
        "left join p_bphtb_legal_doc_type as h\n" .
        "	on a.p_bphtb_legal_doc_type_id = h.p_bphtb_legal_doc_type_id\n" .
        "left join t_customer_order as cust_order\n" .
        "	on cust_order.t_customer_order_id = a.t_customer_order_id\n" .
        "left join t_bphtb_exemption_pemeriksa as k\n" .
        "   on j.pemeriksa_id = k.t_bphtb_exemption_pemeriksa_id\n" .
        "left join t_bphtb_exemption_pemeriksa as l\n" .
        "	on j.administrator_id = l.t_bphtb_exemption_pemeriksa_id\n" .
        "where j.t_customer_order_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-024B193E
    function SetValues()
    {
        $this->wp_kota->SetDBValue($this->f("wp_kota"));
        $this->wp_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->wp_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
        $this->wp_p_region_id_kec->SetDBValue(trim($this->f("wp_p_region_id_kec")));
        $this->wp_p_region_id_kel->SetDBValue(trim($this->f("wp_p_region_id_kel")));
        $this->wp_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->wp_name->SetDBValue($this->f("wp_name"));
        $this->wp_address_name->SetDBValue($this->f("wp_address_name"));
        $this->npwp->SetDBValue($this->f("npwp"));
        $this->object_kelurahan->SetDBValue($this->f("object_kelurahan"));
        $this->object_p_region_id_kel->SetDBValue(trim($this->f("object_p_region_id_kel")));
        $this->object_kecamatan->SetDBValue($this->f("object_kecamatan"));
        $this->object_p_region_id_kec->SetDBValue(trim($this->f("object_p_region_id_kec")));
        $this->object_kota->SetDBValue($this->f("object_region"));
        $this->object_p_region_id->SetDBValue(trim($this->f("object_p_region_id")));
        $this->land_area->SetDBValue(trim($this->f("land_area")));
        $this->land_price_per_m->SetDBValue(trim($this->f("land_price_per_m")));
        $this->land_total_price->SetDBValue(trim($this->f("land_total_price")));
        $this->building_area->SetDBValue(trim($this->f("building_area")));
        $this->building_price_per_m->SetDBValue(trim($this->f("building_price_per_m")));
        $this->building_total_price->SetDBValue(trim($this->f("building_total_price")));
        $this->wp_rt->SetDBValue($this->f("wp_rt"));
        $this->wp_rw->SetDBValue($this->f("wp_rw"));
        $this->object_rt->SetDBValue($this->f("object_rt"));
        $this->object_rw->SetDBValue($this->f("object_rw"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
        $this->object_address_name->SetDBValue($this->f("object_address_name"));
        $this->npop->SetDBValue(trim($this->f("npop")));
        $this->npop_tkp->SetDBValue(trim($this->f("npop_tkp")));
        $this->npop_kp->SetDBValue(trim($this->f("npop_kp")));
        $this->bphtb_amt->SetDBValue(trim($this->f("bphtb_amt")));
        $this->bphtb_amt_final->SetDBValue(trim($this->f("bphtb_amt_final")));
        $this->bphtb_discount->SetDBValue(trim($this->f("bphtb_discount")));
        $this->description->SetDBValue($this->f("description"));
        $this->market_price->SetDBValue(trim($this->f("market_price")));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->mobile_phone_no->SetDBValue($this->f("mobile_phone_no"));
        $this->t_bphtb_registration_id->SetDBValue(trim($this->f("t_bphtb_registration_id")));
        $this->p_bphtb_legal_doc_type_id->SetDBValue($this->f("p_bphtb_legal_doc_type_id"));
        $this->t_customer_order_id->SetDBValue($this->f("t_customer_order_id"));
        $this->p_rqst_type_id->SetDBValue($this->f("p_rqst_type_id"));
        $this->registration_no->SetDBValue($this->f("registration_no"));
        $this->jenis_harga_bphtb->SetDBValue($this->f("jenis_harga_bphtb"));
        $this->bphtb_legal_doc_description->SetDBValue($this->f("bphtb_legal_doc_description"));
        $this->add_disc_percent->SetDBValue($this->f("add_disc_percent"));
        $this->p_bphtb_type_id->SetDBValue($this->f("p_bphtb_type_id"));
        $this->t_bphtb_exemption_id->SetDBValue(trim($this->f("t_bphtb_exemption_id")));
        $this->pilihan_lembar_cetak->SetDBValue($this->f("pilihan_lembar_cetak"));
        $this->opsi_a2->SetDBValue($this->f("opsi_a2"));
        $this->a2_val->SetDBValue($this->f("opsi_a2"));
        $this->opsi_a2_keterangan->SetDBValue($this->f("opsi_a2_keterangan"));
        $this->opsi_b7->SetDBValue($this->f("opsi_b7"));
        $this->b7_val->SetDBValue($this->f("opsi_b7"));
        $this->opsi_b7_keterangan->SetDBValue($this->f("opsi_b7_keterangan"));
        $this->tanggal_sk->SetDBValue($this->f("tanggal_sk"));
        $this->dasar_pengurang->SetDBValue($this->f("dasar_pengurang"));
        $this->analisa_penguranan->SetDBValue($this->f("analisa_penguranan"));
        $this->keterangan_opsi_c->SetDBValue($this->f("keterangan_opsi_c"));
        $this->keterangan_opsi_c_gono_gini->SetDBValue($this->f("keterangan_opsi_c_gono_gini"));
        $this->administrator_id->SetDBValue($this->f("administrator_id"));
        $this->pemeriksa_id->SetDBValue($this->f("pemeriksa_id"));
        $this->tanggal_berita_acara->SetDBValue($this->f("tanggal_berita_acara"));
        $this->nomor_notaris->SetDBValue($this->f("nomor_notaris"));
        $this->nomor_berita_acara->SetDBValue($this->f("nomor_berita_acara"));
    }
//End SetValues Method

//Update Method @2-0620F635
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), NULL, false, $this->ErrorBlock);
        $this->cp["updated_date"] = new clsSQLParameter("expr98", ccsText, "", "", date("Y-m-d H:i:s"), NULL, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kel", ccsFloat, "", "", $this->wp_p_region_id_kel->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kec", ccsText, "", "", $this->object_p_region_id_kec->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsText, "", "", $this->object_p_region_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["land_area"] = new clsSQLParameter("ctrlland_area", ccsFloat, "", "", $this->land_area->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["land_price_per_m"] = new clsSQLParameter("ctrlland_price_per_m", ccsFloat, "", "", $this->land_price_per_m->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["land_total_price"] = new clsSQLParameter("ctrlland_total_price", ccsFloat, "", "", $this->land_total_price->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["building_area"] = new clsSQLParameter("ctrlbuilding_area", ccsFloat, "", "", $this->building_area->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["building_price_per_m"] = new clsSQLParameter("ctrlbuilding_price_per_m", ccsFloat, "", "", $this->building_price_per_m->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["building_total_price"] = new clsSQLParameter("ctrlbuilding_total_price", ccsFloat, "", "", $this->building_total_price->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["p_bphtb_legal_doc_type_id"] = new clsSQLParameter("ctrlp_bphtb_legal_doc_type_id", ccsText, "", "", $this->p_bphtb_legal_doc_type_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npop"] = new clsSQLParameter("ctrlnpop", ccsFloat, "", "", $this->npop->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npop_tkp"] = new clsSQLParameter("ctrlnpop_tkp", ccsFloat, "", "", $this->npop_tkp->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["npop_kp"] = new clsSQLParameter("ctrlnpop_kp", ccsFloat, "", "", $this->npop_kp->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_amt"] = new clsSQLParameter("ctrlbphtb_amt", ccsFloat, "", "", $this->bphtb_amt->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_amt_final"] = new clsSQLParameter("ctrlbphtb_amt_final", ccsFloat, "", "", $this->bphtb_amt_final->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_discount"] = new clsSQLParameter("ctrlbphtb_discount", ccsFloat, "", "", $this->bphtb_discount->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["market_price"] = new clsSQLParameter("ctrlmarket_price", ccsFloat, "", "", $this->market_price->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kec", ccsFloat, "", "", $this->wp_p_region_id_kec->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kel", ccsFloat, "", "", $this->object_p_region_id_kel->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["bphtb_legal_doc_description"] = new clsSQLParameter("ctrlbphtb_legal_doc_description", ccsText, "", "", $this->bphtb_legal_doc_description->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["add_disc_percent"] = new clsSQLParameter("ctrladd_disc_percent", ccsFloat, "", "", $this->add_disc_percent->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "ctrlt_bphtb_registration_id", ccsFloat, "", "", $this->t_bphtb_registration_id->GetValue(true), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("2", "urlt_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_registration_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $wp->AddParameter("3", "urlt_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_registration_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["updated_date"]->GetValue()) and !strlen($this->cp["updated_date"]->GetText()) and !is_bool($this->cp["updated_date"]->GetValue())) 
            $this->cp["updated_date"]->SetValue(date("Y-m-d H:i:s"));
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id_kel"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue())) 
            $this->cp["wp_p_region_id_kel"]->SetValue($this->wp_p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!is_null($this->cp["land_area"]->GetValue()) and !strlen($this->cp["land_area"]->GetText()) and !is_bool($this->cp["land_area"]->GetValue())) 
            $this->cp["land_area"]->SetValue($this->land_area->GetValue(true));
        if (!is_null($this->cp["land_price_per_m"]->GetValue()) and !strlen($this->cp["land_price_per_m"]->GetText()) and !is_bool($this->cp["land_price_per_m"]->GetValue())) 
            $this->cp["land_price_per_m"]->SetValue($this->land_price_per_m->GetValue(true));
        if (!is_null($this->cp["land_total_price"]->GetValue()) and !strlen($this->cp["land_total_price"]->GetText()) and !is_bool($this->cp["land_total_price"]->GetValue())) 
            $this->cp["land_total_price"]->SetValue($this->land_total_price->GetValue(true));
        if (!is_null($this->cp["building_area"]->GetValue()) and !strlen($this->cp["building_area"]->GetText()) and !is_bool($this->cp["building_area"]->GetValue())) 
            $this->cp["building_area"]->SetValue($this->building_area->GetValue(true));
        if (!is_null($this->cp["building_price_per_m"]->GetValue()) and !strlen($this->cp["building_price_per_m"]->GetText()) and !is_bool($this->cp["building_price_per_m"]->GetValue())) 
            $this->cp["building_price_per_m"]->SetValue($this->building_price_per_m->GetValue(true));
        if (!is_null($this->cp["building_total_price"]->GetValue()) and !strlen($this->cp["building_total_price"]->GetText()) and !is_bool($this->cp["building_total_price"]->GetValue())) 
            $this->cp["building_total_price"]->SetValue($this->building_total_price->GetValue(true));
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!is_null($this->cp["p_bphtb_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_bphtb_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_bphtb_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_bphtb_legal_doc_type_id"]->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        if (!is_null($this->cp["npop"]->GetValue()) and !strlen($this->cp["npop"]->GetText()) and !is_bool($this->cp["npop"]->GetValue())) 
            $this->cp["npop"]->SetValue($this->npop->GetValue(true));
        if (!is_null($this->cp["npop_tkp"]->GetValue()) and !strlen($this->cp["npop_tkp"]->GetText()) and !is_bool($this->cp["npop_tkp"]->GetValue())) 
            $this->cp["npop_tkp"]->SetValue($this->npop_tkp->GetValue(true));
        if (!is_null($this->cp["npop_kp"]->GetValue()) and !strlen($this->cp["npop_kp"]->GetText()) and !is_bool($this->cp["npop_kp"]->GetValue())) 
            $this->cp["npop_kp"]->SetValue($this->npop_kp->GetValue(true));
        if (!is_null($this->cp["bphtb_amt"]->GetValue()) and !strlen($this->cp["bphtb_amt"]->GetText()) and !is_bool($this->cp["bphtb_amt"]->GetValue())) 
            $this->cp["bphtb_amt"]->SetValue($this->bphtb_amt->GetValue(true));
        if (!is_null($this->cp["bphtb_amt_final"]->GetValue()) and !strlen($this->cp["bphtb_amt_final"]->GetText()) and !is_bool($this->cp["bphtb_amt_final"]->GetValue())) 
            $this->cp["bphtb_amt_final"]->SetValue($this->bphtb_amt_final->GetValue(true));
        if (!is_null($this->cp["bphtb_discount"]->GetValue()) and !strlen($this->cp["bphtb_discount"]->GetText()) and !is_bool($this->cp["bphtb_discount"]->GetValue())) 
            $this->cp["bphtb_discount"]->SetValue($this->bphtb_discount->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["market_price"]->GetValue()) and !strlen($this->cp["market_price"]->GetText()) and !is_bool($this->cp["market_price"]->GetValue())) 
            $this->cp["market_price"]->SetValue($this->market_price->GetValue(true));
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id_kec"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue())) 
            $this->cp["wp_p_region_id_kec"]->SetValue($this->wp_p_region_id_kec->GetValue(true));
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kel->GetValue(true));
        if (!is_null($this->cp["bphtb_legal_doc_description"]->GetValue()) and !strlen($this->cp["bphtb_legal_doc_description"]->GetText()) and !is_bool($this->cp["bphtb_legal_doc_description"]->GetValue())) 
            $this->cp["bphtb_legal_doc_description"]->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        if (!is_null($this->cp["add_disc_percent"]->GetValue()) and !strlen($this->cp["add_disc_percent"]->GetText()) and !is_bool($this->cp["add_disc_percent"]->GetValue())) 
            $this->cp["add_disc_percent"]->SetValue($this->add_disc_percent->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsFloat),false);
        $wp->Criterion[2] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("2"), $this->ToSQL($wp->GetDBValue("2"), ccsFloat),false);
        $wp->Criterion[3] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("3"), $this->ToSQL($wp->GetDBValue("3"), ccsFloat),false);
        $Where = $wp->opAND(
             false, $wp->opAND(
             false, 
             $wp->Criterion[1], 
             $wp->Criterion[2]), 
             $wp->Criterion[3]);
        $this->UpdateFields["updated_by"]["Value"] = $this->cp["updated_by"]->GetDBValue(true);
        $this->UpdateFields["updated_date"]["Value"] = $this->cp["updated_date"]->GetDBValue(true);
        $this->UpdateFields["wp_p_region_id"]["Value"] = $this->cp["wp_p_region_id"]->GetDBValue(true);
        $this->UpdateFields["wp_p_region_id_kel"]["Value"] = $this->cp["wp_p_region_id_kel"]->GetDBValue(true);
        $this->UpdateFields["wp_name"]["Value"] = $this->cp["wp_name"]->GetDBValue(true);
        $this->UpdateFields["wp_address_name"]["Value"] = $this->cp["wp_address_name"]->GetDBValue(true);
        $this->UpdateFields["npwp"]["Value"] = $this->cp["npwp"]->GetDBValue(true);
        $this->UpdateFields["object_p_region_id_kec"]["Value"] = $this->cp["object_p_region_id_kec"]->GetDBValue(true);
        $this->UpdateFields["object_p_region_id"]["Value"] = $this->cp["object_p_region_id"]->GetDBValue(true);
        $this->UpdateFields["land_area"]["Value"] = $this->cp["land_area"]->GetDBValue(true);
        $this->UpdateFields["land_price_per_m"]["Value"] = $this->cp["land_price_per_m"]->GetDBValue(true);
        $this->UpdateFields["land_total_price"]["Value"] = $this->cp["land_total_price"]->GetDBValue(true);
        $this->UpdateFields["building_area"]["Value"] = $this->cp["building_area"]->GetDBValue(true);
        $this->UpdateFields["building_price_per_m"]["Value"] = $this->cp["building_price_per_m"]->GetDBValue(true);
        $this->UpdateFields["building_total_price"]["Value"] = $this->cp["building_total_price"]->GetDBValue(true);
        $this->UpdateFields["wp_rt"]["Value"] = $this->cp["wp_rt"]->GetDBValue(true);
        $this->UpdateFields["wp_rw"]["Value"] = $this->cp["wp_rw"]->GetDBValue(true);
        $this->UpdateFields["object_rt"]["Value"] = $this->cp["object_rt"]->GetDBValue(true);
        $this->UpdateFields["object_rw"]["Value"] = $this->cp["object_rw"]->GetDBValue(true);
        $this->UpdateFields["njop_pbb"]["Value"] = $this->cp["njop_pbb"]->GetDBValue(true);
        $this->UpdateFields["object_address_name"]["Value"] = $this->cp["object_address_name"]->GetDBValue(true);
        $this->UpdateFields["p_bphtb_legal_doc_type_id"]["Value"] = $this->cp["p_bphtb_legal_doc_type_id"]->GetDBValue(true);
        $this->UpdateFields["npop"]["Value"] = $this->cp["npop"]->GetDBValue(true);
        $this->UpdateFields["npop_tkp"]["Value"] = $this->cp["npop_tkp"]->GetDBValue(true);
        $this->UpdateFields["npop_kp"]["Value"] = $this->cp["npop_kp"]->GetDBValue(true);
        $this->UpdateFields["bphtb_amt"]["Value"] = $this->cp["bphtb_amt"]->GetDBValue(true);
        $this->UpdateFields["bphtb_amt_final"]["Value"] = $this->cp["bphtb_amt_final"]->GetDBValue(true);
        $this->UpdateFields["bphtb_discount"]["Value"] = $this->cp["bphtb_discount"]->GetDBValue(true);
        $this->UpdateFields["description"]["Value"] = $this->cp["description"]->GetDBValue(true);
        $this->UpdateFields["market_price"]["Value"] = $this->cp["market_price"]->GetDBValue(true);
        $this->UpdateFields["mobile_phone_no"]["Value"] = $this->cp["mobile_phone_no"]->GetDBValue(true);
        $this->UpdateFields["wp_p_region_id_kec"]["Value"] = $this->cp["wp_p_region_id_kec"]->GetDBValue(true);
        $this->UpdateFields["object_p_region_id_kel"]["Value"] = $this->cp["object_p_region_id_kel"]->GetDBValue(true);
        $this->UpdateFields["bphtb_legal_doc_description"]["Value"] = $this->cp["bphtb_legal_doc_description"]->GetDBValue(true);
        $this->UpdateFields["add_disc_percent"]["Value"] = $this->cp["add_disc_percent"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("t_bphtb_registration", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-AEEB9CE7
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlt_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("t_bphtb_registration_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "t_bphtb_registration_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsFloat),false);
        $Where = 
             $wp->Criterion[1];
        $this->SQL = "DELETE FROM t_bphtb_registration";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_bphtb_registrationFormDataSource Class @2-FCB6E20C

//Initialize Page @1-B6BAEF7D
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
$TemplateFileName = "t_bphtb_registration_pengurangan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F712265C
include_once("./t_bphtb_registration_pengurangan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3F674AC5
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_bphtb_registrationForm = & new clsRecordt_bphtb_registrationForm("", $MainPage);
$MainPage->t_bphtb_registrationForm = & $t_bphtb_registrationForm;
$t_bphtb_registrationForm->Initialize();

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

//Execute Components @1-8B4F87A8
$t_bphtb_registrationForm->Operation();
//End Execute Components

//Go to destination page @1-690DA1E3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_bphtb_registrationForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D5ACB031
$t_bphtb_registrationForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-58445FB2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_bphtb_registrationForm);
unset($Tpl);
//End Unload Page


?>
