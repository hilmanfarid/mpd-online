<?php
//Include Common Files @1-C05030E7
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_registration_master_expired.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordt_bphtb_registrationForm { //t_bphtb_registrationForm Class @94-9C17DAB3

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

//Class_Initialize Event @94-6FE4DECE
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
            $this->wp_rt = & new clsControl(ccsTextBox, "wp_rt", "wp_rt", ccsText, "", CCGetRequestParam("wp_rt", $Method, NULL), $this);
            $this->wp_rw = & new clsControl(ccsTextBox, "wp_rw", "wp_rw", ccsText, "", CCGetRequestParam("wp_rw", $Method, NULL), $this);
            $this->object_rt = & new clsControl(ccsTextBox, "object_rt", "object_rt", ccsText, "", CCGetRequestParam("object_rt", $Method, NULL), $this);
            $this->object_rw = & new clsControl(ccsTextBox, "object_rw", "object_rw", ccsText, "", CCGetRequestParam("object_rw", $Method, NULL), $this);
            $this->njop_pbb = & new clsControl(ccsTextBox, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", $Method, NULL), $this);
            $this->object_address_name = & new clsControl(ccsTextBox, "object_address_name", "object_address_name", ccsText, "", CCGetRequestParam("object_address_name", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "phone_no", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->mobile_phone_no = & new clsControl(ccsTextBox, "mobile_phone_no", "mobile_phone_no", ccsText, "", CCGetRequestParam("mobile_phone_no", $Method, NULL), $this);
            $this->t_bphtb_registration_id = & new clsControl(ccsHidden, "t_bphtb_registration_id", "t_bphtb_registration_id", ccsInteger, "", CCGetRequestParam("t_bphtb_registration_id", $Method, NULL), $this);
            $this->Button3 = & new clsButton("Button3", $Method, $this);
            $this->alasan = & new clsControl(ccsTextArea, "alasan", "alasan", ccsText, "", CCGetRequestParam("alasan", $Method, NULL), $this);
            $this->alasan->Required = true;
            $this->land_area = & new clsControl(ccsTextBox, "land_area", "land_area", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("land_area", $Method, NULL), $this);
            $this->land_price_per_m = & new clsControl(ccsTextBox, "land_price_per_m", "land_price_per_m", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("land_price_per_m", $Method, NULL), $this);
            $this->land_total_price = & new clsControl(ccsTextBox, "land_total_price", "land_total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("land_total_price", $Method, NULL), $this);
            $this->building_area = & new clsControl(ccsTextBox, "building_area", "building_area", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("building_area", $Method, NULL), $this);
            $this->building_price_per_m = & new clsControl(ccsTextBox, "building_price_per_m", "building_price_per_m", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("building_price_per_m", $Method, NULL), $this);
            $this->building_total_price = & new clsControl(ccsTextBox, "building_total_price", "building_total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("building_total_price", $Method, NULL), $this);
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
            $this->npop = & new clsControl(ccsTextBox, "npop", "npop", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("npop", $Method, NULL), $this);
            $this->npop_tkp = & new clsControl(ccsTextBox, "npop_tkp", "npop_tkp", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("npop_tkp", $Method, NULL), $this);
            $this->npop_kp = & new clsControl(ccsTextBox, "npop_kp", "npop_kp", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("npop_kp", $Method, NULL), $this);
            $this->bphtb_amt = & new clsControl(ccsTextBox, "bphtb_amt", "bphtb_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("bphtb_amt", $Method, NULL), $this);
            $this->market_price = & new clsControl(ccsTextBox, "market_price", "market_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("market_price", $Method, NULL), $this);
            $this->total_price = & new clsControl(ccsTextBox, "total_price", "total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_price", $Method, NULL), $this);
            $this->jenis_harga_bphtb = & new clsControl(ccsListBox, "jenis_harga_bphtb", "jenis_harga_bphtb", ccsInteger, "", CCGetRequestParam("jenis_harga_bphtb", $Method, NULL), $this);
            $this->jenis_harga_bphtb->DSType = dsListOfValues;
            $this->jenis_harga_bphtb->Values = array(array("1", "Harga Transaksi"), array("2", "Harga Pasar"), array("3", "Harga Lelang"));
            $this->nilai_doc = & new clsControl(ccsHidden, "nilai_doc", "nilai_doc", ccsFloat, "", CCGetRequestParam("nilai_doc", $Method, NULL), $this);
            $this->bphtb_legal_doc_description = & new clsControl(ccsTextBox, "bphtb_legal_doc_description", "bphtb_legal_doc_description", ccsText, "", CCGetRequestParam("bphtb_legal_doc_description", $Method, NULL), $this);
            $this->add_disc_percent = & new clsControl(ccsListBox, "add_disc_percent", "add_disc_percent", ccsText, "", CCGetRequestParam("add_disc_percent", $Method, NULL), $this);
            $this->add_disc_percent->DSType = dsListOfValues;
            $this->add_disc_percent->Values = array(array("0", "0%"), array("0.25", "25%"), array("0.5", "50%"), array("0.75", "75%"), array("1", "100%"));
            $this->add_discount = & new clsControl(ccsTextBox, "add_discount", "add_discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("add_discount", $Method, NULL), $this);
            $this->bphtb_discount = & new clsControl(ccsTextBox, "bphtb_discount", "bphtb_discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("bphtb_discount", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->bphtb_amt_final = & new clsControl(ccsTextBox, "bphtb_amt_final", "bphtb_amt_final", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("bphtb_amt_final", $Method, NULL), $this);
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
                if(!is_array($this->jenis_harga_bphtb->Value) && !strlen($this->jenis_harga_bphtb->Value) && $this->jenis_harga_bphtb->Value !== false)
                    $this->jenis_harga_bphtb->SetText(0);
                if(!is_array($this->nilai_doc->Value) && !strlen($this->nilai_doc->Value) && $this->nilai_doc->Value !== false)
                    $this->nilai_doc->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-ED145515
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_bphtb_registration_id"] = CCGetFromGet("t_bphtb_registration_id", NULL);
    }
//End Initialize Method

//Validate Method @94-BE1FFF2C
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
        $Validation = ($this->wp_rt->Validate() && $Validation);
        $Validation = ($this->wp_rw->Validate() && $Validation);
        $Validation = ($this->object_rt->Validate() && $Validation);
        $Validation = ($this->object_rw->Validate() && $Validation);
        $Validation = ($this->njop_pbb->Validate() && $Validation);
        $Validation = ($this->object_address_name->Validate() && $Validation);
        $Validation = ($this->phone_no->Validate() && $Validation);
        $Validation = ($this->mobile_phone_no->Validate() && $Validation);
        $Validation = ($this->t_bphtb_registration_id->Validate() && $Validation);
        $Validation = ($this->alasan->Validate() && $Validation);
        $Validation = ($this->land_area->Validate() && $Validation);
        $Validation = ($this->land_price_per_m->Validate() && $Validation);
        $Validation = ($this->land_total_price->Validate() && $Validation);
        $Validation = ($this->building_area->Validate() && $Validation);
        $Validation = ($this->building_price_per_m->Validate() && $Validation);
        $Validation = ($this->building_total_price->Validate() && $Validation);
        $Validation = ($this->p_bphtb_legal_doc_type_id->Validate() && $Validation);
        $Validation = ($this->npop->Validate() && $Validation);
        $Validation = ($this->npop_tkp->Validate() && $Validation);
        $Validation = ($this->npop_kp->Validate() && $Validation);
        $Validation = ($this->bphtb_amt->Validate() && $Validation);
        $Validation = ($this->market_price->Validate() && $Validation);
        $Validation = ($this->total_price->Validate() && $Validation);
        $Validation = ($this->jenis_harga_bphtb->Validate() && $Validation);
        $Validation = ($this->nilai_doc->Validate() && $Validation);
        $Validation = ($this->bphtb_legal_doc_description->Validate() && $Validation);
        $Validation = ($this->add_disc_percent->Validate() && $Validation);
        $Validation = ($this->add_discount->Validate() && $Validation);
        $Validation = ($this->bphtb_discount->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->bphtb_amt_final->Validate() && $Validation);
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
        $Validation =  $Validation && ($this->wp_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_rt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_rw->Errors->Count() == 0);
        $Validation =  $Validation && ($this->njop_pbb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->mobile_phone_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_bphtb_registration_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->alasan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->land_area->Errors->Count() == 0);
        $Validation =  $Validation && ($this->land_price_per_m->Errors->Count() == 0);
        $Validation =  $Validation && ($this->land_total_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->building_area->Errors->Count() == 0);
        $Validation =  $Validation && ($this->building_price_per_m->Errors->Count() == 0);
        $Validation =  $Validation && ($this->building_total_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bphtb_legal_doc_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npop->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npop_tkp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npop_kp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->market_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->total_price->Errors->Count() == 0);
        $Validation =  $Validation && ($this->jenis_harga_bphtb->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nilai_doc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_legal_doc_description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->add_disc_percent->Errors->Count() == 0);
        $Validation =  $Validation && ($this->add_discount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_discount->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bphtb_amt_final->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-F27A46F5
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
        $errors = ($errors || $this->wp_rt->Errors->Count());
        $errors = ($errors || $this->wp_rw->Errors->Count());
        $errors = ($errors || $this->object_rt->Errors->Count());
        $errors = ($errors || $this->object_rw->Errors->Count());
        $errors = ($errors || $this->njop_pbb->Errors->Count());
        $errors = ($errors || $this->object_address_name->Errors->Count());
        $errors = ($errors || $this->phone_no->Errors->Count());
        $errors = ($errors || $this->mobile_phone_no->Errors->Count());
        $errors = ($errors || $this->t_bphtb_registration_id->Errors->Count());
        $errors = ($errors || $this->alasan->Errors->Count());
        $errors = ($errors || $this->land_area->Errors->Count());
        $errors = ($errors || $this->land_price_per_m->Errors->Count());
        $errors = ($errors || $this->land_total_price->Errors->Count());
        $errors = ($errors || $this->building_area->Errors->Count());
        $errors = ($errors || $this->building_price_per_m->Errors->Count());
        $errors = ($errors || $this->building_total_price->Errors->Count());
        $errors = ($errors || $this->p_bphtb_legal_doc_type_id->Errors->Count());
        $errors = ($errors || $this->npop->Errors->Count());
        $errors = ($errors || $this->npop_tkp->Errors->Count());
        $errors = ($errors || $this->npop_kp->Errors->Count());
        $errors = ($errors || $this->bphtb_amt->Errors->Count());
        $errors = ($errors || $this->market_price->Errors->Count());
        $errors = ($errors || $this->total_price->Errors->Count());
        $errors = ($errors || $this->jenis_harga_bphtb->Errors->Count());
        $errors = ($errors || $this->nilai_doc->Errors->Count());
        $errors = ($errors || $this->bphtb_legal_doc_description->Errors->Count());
        $errors = ($errors || $this->add_disc_percent->Errors->Count());
        $errors = ($errors || $this->add_discount->Errors->Count());
        $errors = ($errors || $this->bphtb_discount->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->bphtb_amt_final->Errors->Count());
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

//Operation Method @94-8C34A409
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
            } else if($this->Button3->Pressed) {
                $this->PressedButton = "Button3";
            }
        }
        $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_registration_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "t_bphtb_registration_list_update_master.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button3") {
                if(!CCGetEvent($this->Button3->CCSEvents, "OnClick", $this->Button3)) {
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

//UpdateRow Method @94-753164FB
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_bphtb_registration_id->SetValue($this->t_bphtb_registration_id->GetValue(true));
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->npwp->SetValue($this->npwp->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->wp_rt->SetValue($this->wp_rt->GetValue(true));
        $this->DataSource->wp_rw->SetValue($this->wp_rw->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_p_region_id_kec->SetValue($this->wp_p_region_id_kec->GetValue(true));
        $this->DataSource->wp_p_region_id_kel->SetValue($this->wp_p_region_id_kel->GetValue(true));
        $this->DataSource->njop_pbb->SetValue($this->njop_pbb->GetValue(true));
        $this->DataSource->object_address_name->SetValue($this->object_address_name->GetValue(true));
        $this->DataSource->object_rt->SetValue($this->object_rt->GetValue(true));
        $this->DataSource->object_rw->SetValue($this->object_rw->GetValue(true));
        $this->DataSource->object_p_region_id->SetValue($this->object_p_region_id->GetValue(true));
        $this->DataSource->object_p_region_id_kec->SetValue($this->object_p_region_id_kec->GetValue(true));
        $this->DataSource->object_p_region_id_kel->SetValue($this->object_p_region_id_kel->GetValue(true));
        $this->DataSource->alasan->SetValue($this->alasan->GetValue(true));
        $this->DataSource->p_bphtb_legal_doc_type_id->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        $this->DataSource->land_area->SetValue($this->land_area->GetValue(true));
        $this->DataSource->land_price_per_m->SetValue($this->land_price_per_m->GetValue(true));
        $this->DataSource->land_total_price->SetValue($this->land_total_price->GetValue(true));
        $this->DataSource->building_area->SetValue($this->building_area->GetValue(true));
        $this->DataSource->building_price_per_m->SetValue($this->building_price_per_m->GetValue(true));
        $this->DataSource->building_total_price->SetValue($this->building_total_price->GetValue(true));
        $this->DataSource->market_price->SetValue($this->market_price->GetValue(true));
        $this->DataSource->npop->SetValue($this->npop->GetValue(true));
        $this->DataSource->npop_tkp->SetValue($this->npop_tkp->GetValue(true));
        $this->DataSource->npop_kp->SetValue($this->npop_kp->GetValue(true));
        $this->DataSource->bphtb_amt->SetValue($this->bphtb_amt->GetValue(true));
        $this->DataSource->bphtb_discount->SetValue($this->bphtb_discount->GetValue(true));
        $this->DataSource->bphtb_amt_final->SetValue($this->bphtb_amt_final->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->jenis_harga_bphtb->SetValue($this->jenis_harga_bphtb->GetValue(true));
        $this->DataSource->bphtb_legal_doc_description->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        $this->DataSource->add_disc_percent->SetValue($this->add_disc_percent->GetValue(true));
        $this->DataSource->t_bphtb_registration_id->SetValue($this->t_bphtb_registration_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @94-EC73A1DD
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
                    $this->wp_rt->SetValue($this->DataSource->wp_rt->GetValue());
                    $this->wp_rw->SetValue($this->DataSource->wp_rw->GetValue());
                    $this->object_rt->SetValue($this->DataSource->object_rt->GetValue());
                    $this->object_rw->SetValue($this->DataSource->object_rw->GetValue());
                    $this->njop_pbb->SetValue($this->DataSource->njop_pbb->GetValue());
                    $this->object_address_name->SetValue($this->DataSource->object_address_name->GetValue());
                    $this->phone_no->SetValue($this->DataSource->phone_no->GetValue());
                    $this->mobile_phone_no->SetValue($this->DataSource->mobile_phone_no->GetValue());
                    $this->t_bphtb_registration_id->SetValue($this->DataSource->t_bphtb_registration_id->GetValue());
                    $this->land_area->SetValue($this->DataSource->land_area->GetValue());
                    $this->land_price_per_m->SetValue($this->DataSource->land_price_per_m->GetValue());
                    $this->land_total_price->SetValue($this->DataSource->land_total_price->GetValue());
                    $this->building_area->SetValue($this->DataSource->building_area->GetValue());
                    $this->building_price_per_m->SetValue($this->DataSource->building_price_per_m->GetValue());
                    $this->building_total_price->SetValue($this->DataSource->building_total_price->GetValue());
                    $this->p_bphtb_legal_doc_type_id->SetValue($this->DataSource->p_bphtb_legal_doc_type_id->GetValue());
                    $this->npop->SetValue($this->DataSource->npop->GetValue());
                    $this->npop_tkp->SetValue($this->DataSource->npop_tkp->GetValue());
                    $this->npop_kp->SetValue($this->DataSource->npop_kp->GetValue());
                    $this->bphtb_amt->SetValue($this->DataSource->bphtb_amt->GetValue());
                    $this->market_price->SetValue($this->DataSource->market_price->GetValue());
                    $this->jenis_harga_bphtb->SetValue($this->DataSource->jenis_harga_bphtb->GetValue());
                    $this->bphtb_legal_doc_description->SetValue($this->DataSource->bphtb_legal_doc_description->GetValue());
                    $this->add_disc_percent->SetValue($this->DataSource->add_disc_percent->GetValue());
                    $this->bphtb_discount->SetValue($this->DataSource->bphtb_discount->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->bphtb_amt_final->SetValue($this->DataSource->bphtb_amt_final->GetValue());
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
            $Error = ComposeStrings($Error, $this->wp_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_rt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_rw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->njop_pbb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->mobile_phone_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_bphtb_registration_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->alasan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->land_area->Errors->ToString());
            $Error = ComposeStrings($Error, $this->land_price_per_m->Errors->ToString());
            $Error = ComposeStrings($Error, $this->land_total_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->building_area->Errors->ToString());
            $Error = ComposeStrings($Error, $this->building_price_per_m->Errors->ToString());
            $Error = ComposeStrings($Error, $this->building_total_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bphtb_legal_doc_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npop->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npop_tkp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npop_kp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->market_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->total_price->Errors->ToString());
            $Error = ComposeStrings($Error, $this->jenis_harga_bphtb->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nilai_doc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_legal_doc_description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->add_disc_percent->Errors->ToString());
            $Error = ComposeStrings($Error, $this->add_discount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_discount->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bphtb_amt_final->Errors->ToString());
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
        $this->wp_rt->Show();
        $this->wp_rw->Show();
        $this->object_rt->Show();
        $this->object_rw->Show();
        $this->njop_pbb->Show();
        $this->object_address_name->Show();
        $this->phone_no->Show();
        $this->mobile_phone_no->Show();
        $this->t_bphtb_registration_id->Show();
        $this->Button3->Show();
        $this->alasan->Show();
        $this->land_area->Show();
        $this->land_price_per_m->Show();
        $this->land_total_price->Show();
        $this->building_area->Show();
        $this->building_price_per_m->Show();
        $this->building_total_price->Show();
        $this->p_bphtb_legal_doc_type_id->Show();
        $this->npop->Show();
        $this->npop_tkp->Show();
        $this->npop_kp->Show();
        $this->bphtb_amt->Show();
        $this->market_price->Show();
        $this->total_price->Show();
        $this->jenis_harga_bphtb->Show();
        $this->nilai_doc->Show();
        $this->bphtb_legal_doc_description->Show();
        $this->add_disc_percent->Show();
        $this->add_discount->Show();
        $this->bphtb_discount->Show();
        $this->description->Show();
        $this->bphtb_amt_final->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_bphtb_registrationForm Class @94-FCB6E20C

class clst_bphtb_registrationFormDataSource extends clsDBConnSIKP {  //t_bphtb_registrationFormDataSource Class @94-BDFCC0BF

//DataSource Variables @94-30B84624
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


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
    var $wp_rt;
    var $wp_rw;
    var $object_rt;
    var $object_rw;
    var $njop_pbb;
    var $object_address_name;
    var $phone_no;
    var $mobile_phone_no;
    var $t_bphtb_registration_id;
    var $alasan;
    var $land_area;
    var $land_price_per_m;
    var $land_total_price;
    var $building_area;
    var $building_price_per_m;
    var $building_total_price;
    var $p_bphtb_legal_doc_type_id;
    var $npop;
    var $npop_tkp;
    var $npop_kp;
    var $bphtb_amt;
    var $market_price;
    var $total_price;
    var $jenis_harga_bphtb;
    var $nilai_doc;
    var $bphtb_legal_doc_description;
    var $add_disc_percent;
    var $add_discount;
    var $bphtb_discount;
    var $description;
    var $bphtb_amt_final;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-A08E3A76
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
        
        $this->wp_rt = new clsField("wp_rt", ccsText, "");
        
        $this->wp_rw = new clsField("wp_rw", ccsText, "");
        
        $this->object_rt = new clsField("object_rt", ccsText, "");
        
        $this->object_rw = new clsField("object_rw", ccsText, "");
        
        $this->njop_pbb = new clsField("njop_pbb", ccsText, "");
        
        $this->object_address_name = new clsField("object_address_name", ccsText, "");
        
        $this->phone_no = new clsField("phone_no", ccsText, "");
        
        $this->mobile_phone_no = new clsField("mobile_phone_no", ccsText, "");
        
        $this->t_bphtb_registration_id = new clsField("t_bphtb_registration_id", ccsInteger, "");
        
        $this->alasan = new clsField("alasan", ccsText, "");
        
        $this->land_area = new clsField("land_area", ccsFloat, "");
        
        $this->land_price_per_m = new clsField("land_price_per_m", ccsFloat, "");
        
        $this->land_total_price = new clsField("land_total_price", ccsFloat, "");
        
        $this->building_area = new clsField("building_area", ccsFloat, "");
        
        $this->building_price_per_m = new clsField("building_price_per_m", ccsFloat, "");
        
        $this->building_total_price = new clsField("building_total_price", ccsFloat, "");
        
        $this->p_bphtb_legal_doc_type_id = new clsField("p_bphtb_legal_doc_type_id", ccsText, "");
        
        $this->npop = new clsField("npop", ccsFloat, "");
        
        $this->npop_tkp = new clsField("npop_tkp", ccsFloat, "");
        
        $this->npop_kp = new clsField("npop_kp", ccsFloat, "");
        
        $this->bphtb_amt = new clsField("bphtb_amt", ccsFloat, "");
        
        $this->market_price = new clsField("market_price", ccsFloat, "");
        
        $this->total_price = new clsField("total_price", ccsFloat, "");
        
        $this->jenis_harga_bphtb = new clsField("jenis_harga_bphtb", ccsInteger, "");
        
        $this->nilai_doc = new clsField("nilai_doc", ccsFloat, "");
        
        $this->bphtb_legal_doc_description = new clsField("bphtb_legal_doc_description", ccsText, "");
        
        $this->add_disc_percent = new clsField("add_disc_percent", ccsText, "");
        
        $this->add_discount = new clsField("add_discount", ccsFloat, "");
        
        $this->bphtb_discount = new clsField("bphtb_discount", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->bphtb_amt_final = new clsField("bphtb_amt_final", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-A34FC581
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_bphtb_registration_id", ccsText, "", "", $this->Parameters["urlt_bphtb_registration_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-7E353CEE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select a.*,\n" .
        "b.region_name as wp_kota,\n" .
        "c.region_name as wp_kecamatan,\n" .
        "d.region_name as wp_kelurahan,\n" .
        "e.region_name as object_region,\n" .
        "f.region_name as object_kecamatan,\n" .
        "g.region_name as object_kelurahan,\n" .
        "h.description as doc_name\n" .
        "\n" .
        "from t_bphtb_registration_expired as a \n" .
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
        "where a.t_bphtb_registration_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-EB469F4F
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
        $this->wp_rt->SetDBValue($this->f("wp_rt"));
        $this->wp_rw->SetDBValue($this->f("wp_rw"));
        $this->object_rt->SetDBValue($this->f("object_rt"));
        $this->object_rw->SetDBValue($this->f("object_rw"));
        $this->njop_pbb->SetDBValue($this->f("njop_pbb"));
        $this->object_address_name->SetDBValue($this->f("object_address_name"));
        $this->phone_no->SetDBValue($this->f("phone_no"));
        $this->mobile_phone_no->SetDBValue($this->f("mobile_phone_no"));
        $this->t_bphtb_registration_id->SetDBValue(trim($this->f("t_bphtb_registration_id")));
        $this->land_area->SetDBValue(trim($this->f("land_area")));
        $this->land_price_per_m->SetDBValue(trim($this->f("land_price_per_m")));
        $this->land_total_price->SetDBValue(trim($this->f("land_total_price")));
        $this->building_area->SetDBValue(trim($this->f("building_area")));
        $this->building_price_per_m->SetDBValue(trim($this->f("building_price_per_m")));
        $this->building_total_price->SetDBValue(trim($this->f("building_total_price")));
        $this->p_bphtb_legal_doc_type_id->SetDBValue($this->f("p_bphtb_legal_doc_type_id"));
        $this->npop->SetDBValue(trim($this->f("npop")));
        $this->npop_tkp->SetDBValue(trim($this->f("npop_tkp")));
        $this->npop_kp->SetDBValue(trim($this->f("npop_kp")));
        $this->bphtb_amt->SetDBValue(trim($this->f("bphtb_amt")));
        $this->market_price->SetDBValue(trim($this->f("market_price")));
        $this->jenis_harga_bphtb->SetDBValue(trim($this->f("jenis_harga_bphtb")));
        $this->bphtb_legal_doc_description->SetDBValue($this->f("bphtb_legal_doc_description"));
        $this->add_disc_percent->SetDBValue($this->f("add_disc_percent"));
        $this->bphtb_discount->SetDBValue(trim($this->f("bphtb_discount")));
        $this->description->SetDBValue($this->f("description"));
        $this->bphtb_amt_final->SetDBValue(trim($this->f("bphtb_amt_final")));
    }
//End SetValues Method

//Update Method @94-5DD59841
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_bphtb_registration_id"] = new clsSQLParameter("ctrlt_bphtb_registration_id", ccsFloat, "", "", $this->t_bphtb_registration_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kec", ccsFloat, "", "", $this->wp_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kel", ccsFloat, "", "", $this->wp_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsFloat, "", "", $this->object_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kec", ccsFloat, "", "", $this->object_p_region_id_kec->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kel", ccsFloat, "", "", $this->object_p_region_id_kel->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["alasan"] = new clsSQLParameter("ctrlalasan", ccsText, "", "", $this->alasan->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["user_name"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->cp["p_bphtb_legal_doc_type_id"] = new clsSQLParameter("ctrlp_bphtb_legal_doc_type_id", ccsInteger, "", "", $this->p_bphtb_legal_doc_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["land_area"] = new clsSQLParameter("ctrlland_area", ccsFloat, "", "", $this->land_area->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["land_price_per_m"] = new clsSQLParameter("ctrlland_price_per_m", ccsFloat, "", "", $this->land_price_per_m->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["land_total_price"] = new clsSQLParameter("ctrlland_total_price", ccsFloat, "", "", $this->land_total_price->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["building_area"] = new clsSQLParameter("ctrlbuilding_area", ccsFloat, "", "", $this->building_area->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["building_price_per_m"] = new clsSQLParameter("ctrlbuilding_price_per_m", ccsFloat, "", "", $this->building_price_per_m->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["building_total_price"] = new clsSQLParameter("ctrlbuilding_total_price", ccsFloat, "", "", $this->building_total_price->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["market_price"] = new clsSQLParameter("ctrlmarket_price", ccsFloat, "", "", $this->market_price->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["npop"] = new clsSQLParameter("ctrlnpop", ccsFloat, "", "", $this->npop->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["npop_tkp"] = new clsSQLParameter("ctrlnpop_tkp", ccsFloat, "", "", $this->npop_tkp->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["npop_kp"] = new clsSQLParameter("ctrlnpop_kp", ccsFloat, "", "", $this->npop_kp->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_amt"] = new clsSQLParameter("ctrlbphtb_amt", ccsFloat, "", "", $this->bphtb_amt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_discount"] = new clsSQLParameter("ctrlbphtb_discount", ccsFloat, "", "", $this->bphtb_discount->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_amt_final"] = new clsSQLParameter("ctrlbphtb_amt_final", ccsFloat, "", "", $this->bphtb_amt_final->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["jenis_harga_bphtb"] = new clsSQLParameter("ctrljenis_harga_bphtb", ccsInteger, "", "", $this->jenis_harga_bphtb->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["bphtb_legal_doc_description"] = new clsSQLParameter("ctrlbphtb_legal_doc_description", ccsText, "", "", $this->bphtb_legal_doc_description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["add_disc_percent"] = new clsSQLParameter("ctrladd_disc_percent", ccsFloat, "", "", $this->add_disc_percent->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_bphtb_registration_id"]->GetValue()) and !strlen($this->cp["t_bphtb_registration_id"]->GetText()) and !is_bool($this->cp["t_bphtb_registration_id"]->GetValue())) 
            $this->cp["t_bphtb_registration_id"]->SetValue($this->t_bphtb_registration_id->GetValue(true));
        if (!strlen($this->cp["t_bphtb_registration_id"]->GetText()) and !is_bool($this->cp["t_bphtb_registration_id"]->GetValue(true))) 
            $this->cp["t_bphtb_registration_id"]->SetText(0);
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue(true))) 
            $this->cp["wp_p_region_id"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kec"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue())) 
            $this->cp["wp_p_region_id_kec"]->SetValue($this->wp_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kel"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue())) 
            $this->cp["wp_p_region_id_kel"]->SetValue($this->wp_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue(true))) 
            $this->cp["object_p_region_id"]->SetText(0);
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kec->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue(true))) 
            $this->cp["object_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kel->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue(true))) 
            $this->cp["object_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["alasan"]->GetValue()) and !strlen($this->cp["alasan"]->GetText()) and !is_bool($this->cp["alasan"]->GetValue())) 
            $this->cp["alasan"]->SetValue($this->alasan->GetValue(true));
        if (!is_null($this->cp["user_name"]->GetValue()) and !strlen($this->cp["user_name"]->GetText()) and !is_bool($this->cp["user_name"]->GetValue())) 
            $this->cp["user_name"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["p_bphtb_legal_doc_type_id"]->GetValue()) and !strlen($this->cp["p_bphtb_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_bphtb_legal_doc_type_id"]->GetValue())) 
            $this->cp["p_bphtb_legal_doc_type_id"]->SetValue($this->p_bphtb_legal_doc_type_id->GetValue(true));
        if (!strlen($this->cp["p_bphtb_legal_doc_type_id"]->GetText()) and !is_bool($this->cp["p_bphtb_legal_doc_type_id"]->GetValue(true))) 
            $this->cp["p_bphtb_legal_doc_type_id"]->SetText(0);
        if (!is_null($this->cp["land_area"]->GetValue()) and !strlen($this->cp["land_area"]->GetText()) and !is_bool($this->cp["land_area"]->GetValue())) 
            $this->cp["land_area"]->SetValue($this->land_area->GetValue(true));
        if (!strlen($this->cp["land_area"]->GetText()) and !is_bool($this->cp["land_area"]->GetValue(true))) 
            $this->cp["land_area"]->SetText(0);
        if (!is_null($this->cp["land_price_per_m"]->GetValue()) and !strlen($this->cp["land_price_per_m"]->GetText()) and !is_bool($this->cp["land_price_per_m"]->GetValue())) 
            $this->cp["land_price_per_m"]->SetValue($this->land_price_per_m->GetValue(true));
        if (!strlen($this->cp["land_price_per_m"]->GetText()) and !is_bool($this->cp["land_price_per_m"]->GetValue(true))) 
            $this->cp["land_price_per_m"]->SetText(0);
        if (!is_null($this->cp["land_total_price"]->GetValue()) and !strlen($this->cp["land_total_price"]->GetText()) and !is_bool($this->cp["land_total_price"]->GetValue())) 
            $this->cp["land_total_price"]->SetValue($this->land_total_price->GetValue(true));
        if (!strlen($this->cp["land_total_price"]->GetText()) and !is_bool($this->cp["land_total_price"]->GetValue(true))) 
            $this->cp["land_total_price"]->SetText(0);
        if (!is_null($this->cp["building_area"]->GetValue()) and !strlen($this->cp["building_area"]->GetText()) and !is_bool($this->cp["building_area"]->GetValue())) 
            $this->cp["building_area"]->SetValue($this->building_area->GetValue(true));
        if (!strlen($this->cp["building_area"]->GetText()) and !is_bool($this->cp["building_area"]->GetValue(true))) 
            $this->cp["building_area"]->SetText(0);
        if (!is_null($this->cp["building_price_per_m"]->GetValue()) and !strlen($this->cp["building_price_per_m"]->GetText()) and !is_bool($this->cp["building_price_per_m"]->GetValue())) 
            $this->cp["building_price_per_m"]->SetValue($this->building_price_per_m->GetValue(true));
        if (!strlen($this->cp["building_price_per_m"]->GetText()) and !is_bool($this->cp["building_price_per_m"]->GetValue(true))) 
            $this->cp["building_price_per_m"]->SetText(0);
        if (!is_null($this->cp["building_total_price"]->GetValue()) and !strlen($this->cp["building_total_price"]->GetText()) and !is_bool($this->cp["building_total_price"]->GetValue())) 
            $this->cp["building_total_price"]->SetValue($this->building_total_price->GetValue(true));
        if (!strlen($this->cp["building_total_price"]->GetText()) and !is_bool($this->cp["building_total_price"]->GetValue(true))) 
            $this->cp["building_total_price"]->SetText(0);
        if (!is_null($this->cp["market_price"]->GetValue()) and !strlen($this->cp["market_price"]->GetText()) and !is_bool($this->cp["market_price"]->GetValue())) 
            $this->cp["market_price"]->SetValue($this->market_price->GetValue(true));
        if (!strlen($this->cp["market_price"]->GetText()) and !is_bool($this->cp["market_price"]->GetValue(true))) 
            $this->cp["market_price"]->SetText(0);
        if (!is_null($this->cp["npop"]->GetValue()) and !strlen($this->cp["npop"]->GetText()) and !is_bool($this->cp["npop"]->GetValue())) 
            $this->cp["npop"]->SetValue($this->npop->GetValue(true));
        if (!strlen($this->cp["npop"]->GetText()) and !is_bool($this->cp["npop"]->GetValue(true))) 
            $this->cp["npop"]->SetText(0);
        if (!is_null($this->cp["npop_tkp"]->GetValue()) and !strlen($this->cp["npop_tkp"]->GetText()) and !is_bool($this->cp["npop_tkp"]->GetValue())) 
            $this->cp["npop_tkp"]->SetValue($this->npop_tkp->GetValue(true));
        if (!strlen($this->cp["npop_tkp"]->GetText()) and !is_bool($this->cp["npop_tkp"]->GetValue(true))) 
            $this->cp["npop_tkp"]->SetText(0);
        if (!is_null($this->cp["npop_kp"]->GetValue()) and !strlen($this->cp["npop_kp"]->GetText()) and !is_bool($this->cp["npop_kp"]->GetValue())) 
            $this->cp["npop_kp"]->SetValue($this->npop_kp->GetValue(true));
        if (!strlen($this->cp["npop_kp"]->GetText()) and !is_bool($this->cp["npop_kp"]->GetValue(true))) 
            $this->cp["npop_kp"]->SetText(0);
        if (!is_null($this->cp["bphtb_amt"]->GetValue()) and !strlen($this->cp["bphtb_amt"]->GetText()) and !is_bool($this->cp["bphtb_amt"]->GetValue())) 
            $this->cp["bphtb_amt"]->SetValue($this->bphtb_amt->GetValue(true));
        if (!strlen($this->cp["bphtb_amt"]->GetText()) and !is_bool($this->cp["bphtb_amt"]->GetValue(true))) 
            $this->cp["bphtb_amt"]->SetText(0);
        if (!is_null($this->cp["bphtb_discount"]->GetValue()) and !strlen($this->cp["bphtb_discount"]->GetText()) and !is_bool($this->cp["bphtb_discount"]->GetValue())) 
            $this->cp["bphtb_discount"]->SetValue($this->bphtb_discount->GetValue(true));
        if (!strlen($this->cp["bphtb_discount"]->GetText()) and !is_bool($this->cp["bphtb_discount"]->GetValue(true))) 
            $this->cp["bphtb_discount"]->SetText(0);
        if (!is_null($this->cp["bphtb_amt_final"]->GetValue()) and !strlen($this->cp["bphtb_amt_final"]->GetText()) and !is_bool($this->cp["bphtb_amt_final"]->GetValue())) 
            $this->cp["bphtb_amt_final"]->SetValue($this->bphtb_amt_final->GetValue(true));
        if (!strlen($this->cp["bphtb_amt_final"]->GetText()) and !is_bool($this->cp["bphtb_amt_final"]->GetValue(true))) 
            $this->cp["bphtb_amt_final"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["jenis_harga_bphtb"]->GetValue()) and !strlen($this->cp["jenis_harga_bphtb"]->GetText()) and !is_bool($this->cp["jenis_harga_bphtb"]->GetValue())) 
            $this->cp["jenis_harga_bphtb"]->SetValue($this->jenis_harga_bphtb->GetValue(true));
        if (!strlen($this->cp["jenis_harga_bphtb"]->GetText()) and !is_bool($this->cp["jenis_harga_bphtb"]->GetValue(true))) 
            $this->cp["jenis_harga_bphtb"]->SetText(0);
        if (!is_null($this->cp["bphtb_legal_doc_description"]->GetValue()) and !strlen($this->cp["bphtb_legal_doc_description"]->GetText()) and !is_bool($this->cp["bphtb_legal_doc_description"]->GetValue())) 
            $this->cp["bphtb_legal_doc_description"]->SetValue($this->bphtb_legal_doc_description->GetValue(true));
        if (!is_null($this->cp["add_disc_percent"]->GetValue()) and !strlen($this->cp["add_disc_percent"]->GetText()) and !is_bool($this->cp["add_disc_percent"]->GetValue())) 
            $this->cp["add_disc_percent"]->SetValue($this->add_disc_percent->GetValue(true));
        if (!strlen($this->cp["add_disc_percent"]->GetText()) and !is_bool($this->cp["add_disc_percent"]->GetValue(true))) 
            $this->cp["add_disc_percent"]->SetText(0);
        $this->SQL = "select * from f_update_master_bphtb (\n" .
        "" . $this->SQLValue($this->cp["t_bphtb_registration_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "'" . $this->SQLValue($this->cp["wp_name"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["npwp"]->GetDBValue(), ccsText) . "',\n" .
        "'" . $this->SQLValue($this->cp["wp_address_name"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["phone_no"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["mobile_phone_no"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["wp_rt"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["wp_rw"]->GetDBValue(), ccsText) . "' ,\n" .
        "" . $this->SQLValue($this->cp["wp_p_region_id"]->GetDBValue(), ccsFloat) . " ,\n" .
        "" . $this->SQLValue($this->cp["wp_p_region_id_kec"]->GetDBValue(), ccsFloat) . " ,\n" .
        "" . $this->SQLValue($this->cp["wp_p_region_id_kel"]->GetDBValue(), ccsFloat) . " ,\n" .
        "'" . $this->SQLValue($this->cp["njop_pbb"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["object_address_name"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["object_rt"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["object_rw"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["object_p_region_id"]->GetDBValue(), ccsFloat) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["object_p_region_id_kec"]->GetDBValue(), ccsFloat) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["object_p_region_id_kel"]->GetDBValue(), ccsFloat) . "' ,\n" .
        "" . $this->SQLValue($this->cp["p_bphtb_legal_doc_type_id"]->GetDBValue(), ccsInteger) . ", \n" .
        "" . $this->SQLValue($this->cp["land_area"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["land_price_per_m"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["land_total_price"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["building_area"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["building_price_per_m"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["building_total_price"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["market_price"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["npop"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["npop_tkp"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["npop_kp"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["bphtb_amt"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["bphtb_discount"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["bphtb_amt_final"]->GetDBValue(), ccsFloat) . ", \n" .
        "'" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["jenis_harga_bphtb"]->GetDBValue(), ccsInteger) . ", \n" .
        "'" . $this->SQLValue($this->cp["bphtb_legal_doc_description"]->GetDBValue(), ccsText) . "', \n" .
        "" . $this->SQLValue($this->cp["add_disc_percent"]->GetDBValue(), ccsFloat) . ",\n" .
        "'" . $this->SQLValue($this->cp["alasan"]->GetDBValue(), ccsText) . "' ,\n" .
        "'" . $this->SQLValue($this->cp["user_name"]->GetDBValue(), ccsText) . "' \n" .
        ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_bphtb_registrationFormDataSource Class @94-FCB6E20C

//Initialize Page @1-6808EB9F
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
$TemplateFileName = "t_bphtb_registration_master_expired.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-24514E8F
include_once("./t_bphtb_registration_master_expired_events.php");
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
