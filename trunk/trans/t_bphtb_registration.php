<?php
//Include Common Files @1-78FC7641
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_registration.php");
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

//Class_Initialize Event @94-C3E7A413
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
        $this->InsertAllowed = true;
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
            $this->wp_p_region_id_kecamatan = & new clsControl(ccsHidden, "wp_p_region_id_kecamatan", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kecamatan", $Method, NULL), $this);
            $this->wp_p_region_id_kecamatan->Required = true;
            $this->wp_p_region_id_kelurahan = & new clsControl(ccsHidden, "wp_p_region_id_kelurahan", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("wp_p_region_id_kelurahan", $Method, NULL), $this);
            $this->wp_p_region_id_kelurahan->Required = true;
            $this->wp_kecamatan = & new clsControl(ccsTextBox, "wp_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("wp_kecamatan", $Method, NULL), $this);
            $this->wp_kecamatan->Required = true;
            $this->wp_name = & new clsControl(ccsTextBox, "wp_name", "wp_name", ccsText, "", CCGetRequestParam("wp_name", $Method, NULL), $this);
            $this->wp_address_name = & new clsControl(ccsTextBox, "wp_address_name", "wp_address_name", ccsText, "", CCGetRequestParam("wp_address_name", $Method, NULL), $this);
            $this->npwp = & new clsControl(ccsTextBox, "npwp", "npwp", ccsText, "", CCGetRequestParam("npwp", $Method, NULL), $this);
            $this->object_kelurahan = & new clsControl(ccsTextBox, "object_kelurahan", "Kelurahan - WP", ccsText, "", CCGetRequestParam("object_kelurahan", $Method, NULL), $this);
            $this->object_kelurahan->Required = true;
            $this->object_p_region_id_kelurahan = & new clsControl(ccsHidden, "object_p_region_id_kelurahan", "Kelurahan - WP", ccsFloat, "", CCGetRequestParam("object_p_region_id_kelurahan", $Method, NULL), $this);
            $this->object_p_region_id_kelurahan->Required = true;
            $this->object_kecamatan = & new clsControl(ccsTextBox, "object_kecamatan", "Kecamatan - WP", ccsText, "", CCGetRequestParam("object_kecamatan", $Method, NULL), $this);
            $this->object_kecamatan->Required = true;
            $this->object_p_region_id_kecamatan = & new clsControl(ccsHidden, "object_p_region_id_kecamatan", "Kecamatan - WP", ccsFloat, "", CCGetRequestParam("object_p_region_id_kecamatan", $Method, NULL), $this);
            $this->object_p_region_id_kecamatan->Required = true;
            $this->object_kota = & new clsControl(ccsTextBox, "object_kota", "Kota/Kabupaten - WP", ccsText, "", CCGetRequestParam("object_kota", $Method, NULL), $this);
            $this->object_kota->Required = true;
            $this->object_p_region_id = & new clsControl(ccsHidden, "object_p_region_id", "Kota/Kabupaten - WP", ccsFloat, "", CCGetRequestParam("object_p_region_id", $Method, NULL), $this);
            $this->object_p_region_id->Required = true;
            $this->land_area = & new clsControl(ccsTextBox, "land_area", "land_area", ccsFloat, "", CCGetRequestParam("land_area", $Method, NULL), $this);
            $this->land_price_per_m = & new clsControl(ccsTextBox, "land_price_per_m", "land_price_per_m", ccsFloat, "", CCGetRequestParam("land_price_per_m", $Method, NULL), $this);
            $this->land_total_price = & new clsControl(ccsTextBox, "land_total_price", "land_total_price", ccsFloat, "", CCGetRequestParam("land_total_price", $Method, NULL), $this);
            $this->building_area = & new clsControl(ccsTextBox, "building_area", "building_area", ccsFloat, "", CCGetRequestParam("building_area", $Method, NULL), $this);
            $this->building_price_per_m = & new clsControl(ccsTextBox, "building_price_per_m", "building_price_per_m", ccsFloat, "", CCGetRequestParam("building_price_per_m", $Method, NULL), $this);
            $this->building_total_price = & new clsControl(ccsTextBox, "building_total_price", "building_total_price", ccsFloat, "", CCGetRequestParam("building_total_price", $Method, NULL), $this);
            $this->wp_rt = & new clsControl(ccsTextBox, "wp_rt", "wp_rt", ccsText, "", CCGetRequestParam("wp_rt", $Method, NULL), $this);
            $this->wp_rw = & new clsControl(ccsTextBox, "wp_rw", "wp_rw", ccsText, "", CCGetRequestParam("wp_rw", $Method, NULL), $this);
            $this->object_rt = & new clsControl(ccsTextBox, "object_rt", "object_rt", ccsText, "", CCGetRequestParam("object_rt", $Method, NULL), $this);
            $this->object_rw = & new clsControl(ccsTextBox, "object_rw", "object_rw", ccsText, "", CCGetRequestParam("object_rw", $Method, NULL), $this);
            $this->njop_pbb = & new clsControl(ccsTextBox, "njop_pbb", "njop_pbb", ccsText, "", CCGetRequestParam("njop_pbb", $Method, NULL), $this);
            $this->object_address_name = & new clsControl(ccsTextBox, "object_address_name", "object_address_name", ccsText, "", CCGetRequestParam("object_address_name", $Method, NULL), $this);
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
            $this->npop = & new clsControl(ccsTextBox, "npop", "npop", ccsFloat, "", CCGetRequestParam("npop", $Method, NULL), $this);
            $this->npop_tkp = & new clsControl(ccsTextBox, "npop_tkp", "npop_tkp", ccsFloat, "", CCGetRequestParam("npop_tkp", $Method, NULL), $this);
            $this->npop_kp = & new clsControl(ccsTextBox, "npop_kp", "npop_kp", ccsFloat, "", CCGetRequestParam("npop_kp", $Method, NULL), $this);
            $this->bphtb_amt = & new clsControl(ccsTextBox, "bphtb_amt", "bphtb_amt", ccsFloat, "", CCGetRequestParam("bphtb_amt", $Method, NULL), $this);
            $this->bphtb_amt_final = & new clsControl(ccsTextBox, "bphtb_amt_final", "bphtb_amt_final", ccsFloat, "", CCGetRequestParam("bphtb_amt_final", $Method, NULL), $this);
            $this->bphtb_discount = & new clsControl(ccsTextBox, "bphtb_discount", "bphtb_discount", ccsFloat, "", CCGetRequestParam("bphtb_discount", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->market_price = & new clsControl(ccsTextBox, "market_price", "market_price", ccsFloat, "", CCGetRequestParam("market_price", $Method, NULL), $this);
            $this->phone_no = & new clsControl(ccsTextBox, "phone_no", "phone_no", ccsText, "", CCGetRequestParam("phone_no", $Method, NULL), $this);
            $this->mobile_phone_no = & new clsControl(ccsTextBox, "mobile_phone_no", "mobile_phone_no", ccsText, "", CCGetRequestParam("mobile_phone_no", $Method, NULL), $this);
            $this->total_price = & new clsControl(ccsTextBox, "total_price", "total_price", ccsFloat, "", CCGetRequestParam("total_price", $Method, NULL), $this);
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

//Initialize Method @94-E8596F60
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_customer_order_id"] = CCGetFromGet("t_customer_order_id", NULL);
    }
//End Initialize Method

//Validate Method @94-C5FDC5D9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->wp_kota->Validate() && $Validation);
        $Validation = ($this->wp_kelurahan->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->wp_kecamatan->Validate() && $Validation);
        $Validation = ($this->wp_name->Validate() && $Validation);
        $Validation = ($this->wp_address_name->Validate() && $Validation);
        $Validation = ($this->npwp->Validate() && $Validation);
        $Validation = ($this->object_kelurahan->Validate() && $Validation);
        $Validation = ($this->object_p_region_id_kelurahan->Validate() && $Validation);
        $Validation = ($this->object_kecamatan->Validate() && $Validation);
        $Validation = ($this->object_p_region_id_kecamatan->Validate() && $Validation);
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
        $Validation = ($this->p_bphtb_legal_doc_type_id->Validate() && $Validation);
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
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->wp_kota->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->wp_address_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->npwp->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id_kelurahan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_kecamatan->Errors->Count() == 0);
        $Validation =  $Validation && ($this->object_p_region_id_kecamatan->Errors->Count() == 0);
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
        $Validation =  $Validation && ($this->p_bphtb_legal_doc_type_id->Errors->Count() == 0);
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
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-4689E5D6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->wp_kota->Errors->Count());
        $errors = ($errors || $this->wp_kelurahan->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->wp_kecamatan->Errors->Count());
        $errors = ($errors || $this->wp_name->Errors->Count());
        $errors = ($errors || $this->wp_address_name->Errors->Count());
        $errors = ($errors || $this->npwp->Errors->Count());
        $errors = ($errors || $this->object_kelurahan->Errors->Count());
        $errors = ($errors || $this->object_p_region_id_kelurahan->Errors->Count());
        $errors = ($errors || $this->object_kecamatan->Errors->Count());
        $errors = ($errors || $this->object_p_region_id_kecamatan->Errors->Count());
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
        $errors = ($errors || $this->p_bphtb_legal_doc_type_id->Errors->Count());
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

//Operation Method @94-829B6C5D
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
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
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

//InsertRow Method @94-451CBBE8
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->wp_name->SetValue($this->wp_name->GetValue(true));
        $this->DataSource->npwp->SetValue($this->npwp->GetValue(true));
        $this->DataSource->wp_address_name->SetValue($this->wp_address_name->GetValue(true));
        $this->DataSource->wp_rt->SetValue($this->wp_rt->GetValue(true));
        $this->DataSource->wp_rw->SetValue($this->wp_rw->GetValue(true));
        $this->DataSource->wp_p_region_id->SetValue($this->wp_p_region_id->GetValue(true));
        $this->DataSource->wp_p_region_id_kecamatan->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        $this->DataSource->wp_p_region_id_kelurahan->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        $this->DataSource->phone_no->SetValue($this->phone_no->GetValue(true));
        $this->DataSource->mobile_phone_no->SetValue($this->mobile_phone_no->GetValue(true));
        $this->DataSource->njop_pbb->SetValue($this->njop_pbb->GetValue(true));
        $this->DataSource->object_address_name->SetValue($this->object_address_name->GetValue(true));
        $this->DataSource->object_rt->SetValue($this->object_rt->GetValue(true));
        $this->DataSource->object_rw->SetValue($this->object_rw->GetValue(true));
        $this->DataSource->object_p_region_id->SetValue($this->object_p_region_id->GetValue(true));
        $this->DataSource->object_p_region_id_kecamatan->SetValue($this->object_p_region_id_kecamatan->GetValue(true));
        $this->DataSource->object_p_region_id_kelurahan->SetValue($this->object_p_region_id_kelurahan->GetValue(true));
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

//Show Method @94-692E8E06
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
                    $this->wp_p_region_id_kecamatan->SetValue($this->DataSource->wp_p_region_id_kecamatan->GetValue());
                    $this->wp_p_region_id_kelurahan->SetValue($this->DataSource->wp_p_region_id_kelurahan->GetValue());
                    $this->wp_kecamatan->SetValue($this->DataSource->wp_kecamatan->GetValue());
                    $this->object_kelurahan->SetValue($this->DataSource->object_kelurahan->GetValue());
                    $this->object_p_region_id_kelurahan->SetValue($this->DataSource->object_p_region_id_kelurahan->GetValue());
                    $this->object_kecamatan->SetValue($this->DataSource->object_kecamatan->GetValue());
                    $this->object_p_region_id_kecamatan->SetValue($this->DataSource->object_p_region_id_kecamatan->GetValue());
                    $this->object_kota->SetValue($this->DataSource->object_kota->GetValue());
                    $this->object_p_region_id->SetValue($this->DataSource->object_p_region_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->wp_kota->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->wp_address_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->npwp->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id_kelurahan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_kecamatan->Errors->ToString());
            $Error = ComposeStrings($Error, $this->object_p_region_id_kecamatan->Errors->ToString());
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
            $Error = ComposeStrings($Error, $this->p_bphtb_legal_doc_type_id->Errors->ToString());
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
        $this->wp_p_region_id_kecamatan->Show();
        $this->wp_p_region_id_kelurahan->Show();
        $this->wp_kecamatan->Show();
        $this->wp_name->Show();
        $this->wp_address_name->Show();
        $this->npwp->Show();
        $this->object_kelurahan->Show();
        $this->object_p_region_id_kelurahan->Show();
        $this->object_kecamatan->Show();
        $this->object_p_region_id_kecamatan->Show();
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
        $this->p_bphtb_legal_doc_type_id->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_bphtb_registrationForm Class @94-FCB6E20C

class clst_bphtb_registrationFormDataSource extends clsDBConnSIKP {  //t_bphtb_registrationFormDataSource Class @94-BDFCC0BF

//DataSource Variables @94-050152EE
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
    var $wp_kota;
    var $wp_kelurahan;
    var $wp_p_region_id;
    var $wp_p_region_id_kecamatan;
    var $wp_p_region_id_kelurahan;
    var $wp_kecamatan;
    var $wp_name;
    var $wp_address_name;
    var $npwp;
    var $object_kelurahan;
    var $object_p_region_id_kelurahan;
    var $object_kecamatan;
    var $object_p_region_id_kecamatan;
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
    var $p_bphtb_legal_doc_type_id;
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
//End DataSource Variables

//DataSourceClass_Initialize Event @94-780A6612
    function clst_bphtb_registrationFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_bphtb_registrationForm/Error";
        $this->Initialize();
        $this->wp_kota = new clsField("wp_kota", ccsText, "");
        
        $this->wp_kelurahan = new clsField("wp_kelurahan", ccsText, "");
        
        $this->wp_p_region_id = new clsField("wp_p_region_id", ccsFloat, "");
        
        $this->wp_p_region_id_kecamatan = new clsField("wp_p_region_id_kecamatan", ccsFloat, "");
        
        $this->wp_p_region_id_kelurahan = new clsField("wp_p_region_id_kelurahan", ccsFloat, "");
        
        $this->wp_kecamatan = new clsField("wp_kecamatan", ccsText, "");
        
        $this->wp_name = new clsField("wp_name", ccsText, "");
        
        $this->wp_address_name = new clsField("wp_address_name", ccsText, "");
        
        $this->npwp = new clsField("npwp", ccsText, "");
        
        $this->object_kelurahan = new clsField("object_kelurahan", ccsText, "");
        
        $this->object_p_region_id_kelurahan = new clsField("object_p_region_id_kelurahan", ccsFloat, "");
        
        $this->object_kecamatan = new clsField("object_kecamatan", ccsText, "");
        
        $this->object_p_region_id_kecamatan = new clsField("object_p_region_id_kecamatan", ccsFloat, "");
        
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
        
        $this->p_bphtb_legal_doc_type_id = new clsField("p_bphtb_legal_doc_type_id", ccsText, "");
        
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

//SetValues Method @94-727B2ACF
    function SetValues()
    {
        $this->wp_kota->SetDBValue($this->f("wp_kota"));
        $this->wp_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->wp_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
        $this->wp_p_region_id_kecamatan->SetDBValue(trim($this->f("wp_p_region_id_kecamatan")));
        $this->wp_p_region_id_kelurahan->SetDBValue(trim($this->f("wp_p_region_id_kelurahan")));
        $this->wp_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->object_kelurahan->SetDBValue($this->f("wp_kelurahan"));
        $this->object_p_region_id_kelurahan->SetDBValue(trim($this->f("wp_p_region_id_kelurahan")));
        $this->object_kecamatan->SetDBValue($this->f("wp_kecamatan"));
        $this->object_p_region_id_kecamatan->SetDBValue(trim($this->f("wp_p_region_id_kecamatan")));
        $this->object_kota->SetDBValue($this->f("wp_kota"));
        $this->object_p_region_id->SetDBValue(trim($this->f("wp_p_region_id")));
    }
//End SetValues Method

//Insert Method @94-D60BE9B9
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["wp_name"] = new clsSQLParameter("ctrlwp_name", ccsText, "", "", $this->wp_name->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["npwp"] = new clsSQLParameter("ctrlnpwp", ccsText, "", "", $this->npwp->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_address_name"] = new clsSQLParameter("ctrlwp_address_name", ccsText, "", "", $this->wp_address_name->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_rt"] = new clsSQLParameter("ctrlwp_rt", ccsText, "", "", $this->wp_rt->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_rw"] = new clsSQLParameter("ctrlwp_rw", ccsText, "", "", $this->wp_rw->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["wp_p_region_id"] = new clsSQLParameter("ctrlwp_p_region_id", ccsFloat, "", "", $this->wp_p_region_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kec"] = new clsSQLParameter("ctrlwp_p_region_id_kecamatan", ccsFloat, "", "", $this->wp_p_region_id_kecamatan->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["wp_p_region_id_kel"] = new clsSQLParameter("ctrlwp_p_region_id_kelurahan", ccsFloat, "", "", $this->wp_p_region_id_kelurahan->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["phone_no"] = new clsSQLParameter("ctrlphone_no", ccsText, "", "", $this->phone_no->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["mobile_phone_no"] = new clsSQLParameter("ctrlmobile_phone_no", ccsText, "", "", $this->mobile_phone_no->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["njop_pbb"] = new clsSQLParameter("ctrlnjop_pbb", ccsText, "", "", $this->njop_pbb->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_address_name"] = new clsSQLParameter("ctrlobject_address_name", ccsText, "", "", $this->object_address_name->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_rt"] = new clsSQLParameter("ctrlobject_rt", ccsText, "", "", $this->object_rt->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_rw"] = new clsSQLParameter("ctrlobject_rw", ccsText, "", "", $this->object_rw->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_p_region_id"] = new clsSQLParameter("ctrlobject_p_region_id", ccsText, "", "", $this->object_p_region_id->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kec"] = new clsSQLParameter("ctrlobject_p_region_id_kecamatan", ccsText, "", "", $this->object_p_region_id_kecamatan->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["object_p_region_id_kel"] = new clsSQLParameter("ctrlobject_p_region_id_kelurahan", ccsText, "", "", $this->object_p_region_id_kelurahan->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["p_bphtb_legal_doc_type_id"] = new clsSQLParameter("ctrlp_bphtb_legal_doc_type_id", ccsFloat, "", "", $this->p_bphtb_legal_doc_type_id->GetValue(true), 0, false, $this->ErrorBlock);
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
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "-", false, $this->ErrorBlock);
        $this->cp["i_user"] = new clsSQLParameter("sesUserLogin", ccsText, "", "", CCGetSession("UserLogin", NULL), "", false, $this->ErrorBlock);
        $this->cp["o_t_bphtb_registration_id"] = new clsSQLParameter("urlo_t_bphtb_registration_id", ccsFloat, "", "", CCGetFromGet("o_t_bphtb_registration_id", NULL), "", false, $this->ErrorBlock);
        $this->cp["o_mess"] = new clsSQLParameter("urlo_mess", ccsText, "", "", CCGetFromGet("o_mess", NULL), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["wp_name"]->GetValue()) and !strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue())) 
            $this->cp["wp_name"]->SetValue($this->wp_name->GetValue(true));
        if (!strlen($this->cp["wp_name"]->GetText()) and !is_bool($this->cp["wp_name"]->GetValue(true))) 
            $this->cp["wp_name"]->SetText("-");
        if (!is_null($this->cp["npwp"]->GetValue()) and !strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue())) 
            $this->cp["npwp"]->SetValue($this->npwp->GetValue(true));
        if (!strlen($this->cp["npwp"]->GetText()) and !is_bool($this->cp["npwp"]->GetValue(true))) 
            $this->cp["npwp"]->SetText("-");
        if (!is_null($this->cp["wp_address_name"]->GetValue()) and !strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue())) 
            $this->cp["wp_address_name"]->SetValue($this->wp_address_name->GetValue(true));
        if (!strlen($this->cp["wp_address_name"]->GetText()) and !is_bool($this->cp["wp_address_name"]->GetValue(true))) 
            $this->cp["wp_address_name"]->SetText("-");
        if (!is_null($this->cp["wp_rt"]->GetValue()) and !strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue())) 
            $this->cp["wp_rt"]->SetValue($this->wp_rt->GetValue(true));
        if (!strlen($this->cp["wp_rt"]->GetText()) and !is_bool($this->cp["wp_rt"]->GetValue(true))) 
            $this->cp["wp_rt"]->SetText("-");
        if (!is_null($this->cp["wp_rw"]->GetValue()) and !strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue())) 
            $this->cp["wp_rw"]->SetValue($this->wp_rw->GetValue(true));
        if (!strlen($this->cp["wp_rw"]->GetText()) and !is_bool($this->cp["wp_rw"]->GetValue(true))) 
            $this->cp["wp_rw"]->SetText("-");
        if (!is_null($this->cp["wp_p_region_id"]->GetValue()) and !strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue())) 
            $this->cp["wp_p_region_id"]->SetValue($this->wp_p_region_id->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id"]->GetText()) and !is_bool($this->cp["wp_p_region_id"]->GetValue(true))) 
            $this->cp["wp_p_region_id"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kec"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue())) 
            $this->cp["wp_p_region_id_kec"]->SetValue($this->wp_p_region_id_kecamatan->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kec"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kec"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kec"]->SetText(0);
        if (!is_null($this->cp["wp_p_region_id_kel"]->GetValue()) and !strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue())) 
            $this->cp["wp_p_region_id_kel"]->SetValue($this->wp_p_region_id_kelurahan->GetValue(true));
        if (!strlen($this->cp["wp_p_region_id_kel"]->GetText()) and !is_bool($this->cp["wp_p_region_id_kel"]->GetValue(true))) 
            $this->cp["wp_p_region_id_kel"]->SetText(0);
        if (!is_null($this->cp["phone_no"]->GetValue()) and !strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue())) 
            $this->cp["phone_no"]->SetValue($this->phone_no->GetValue(true));
        if (!strlen($this->cp["phone_no"]->GetText()) and !is_bool($this->cp["phone_no"]->GetValue(true))) 
            $this->cp["phone_no"]->SetText("-");
        if (!is_null($this->cp["mobile_phone_no"]->GetValue()) and !strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue())) 
            $this->cp["mobile_phone_no"]->SetValue($this->mobile_phone_no->GetValue(true));
        if (!strlen($this->cp["mobile_phone_no"]->GetText()) and !is_bool($this->cp["mobile_phone_no"]->GetValue(true))) 
            $this->cp["mobile_phone_no"]->SetText("-");
        if (!is_null($this->cp["njop_pbb"]->GetValue()) and !strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue())) 
            $this->cp["njop_pbb"]->SetValue($this->njop_pbb->GetValue(true));
        if (!strlen($this->cp["njop_pbb"]->GetText()) and !is_bool($this->cp["njop_pbb"]->GetValue(true))) 
            $this->cp["njop_pbb"]->SetText("-");
        if (!is_null($this->cp["object_address_name"]->GetValue()) and !strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue())) 
            $this->cp["object_address_name"]->SetValue($this->object_address_name->GetValue(true));
        if (!strlen($this->cp["object_address_name"]->GetText()) and !is_bool($this->cp["object_address_name"]->GetValue(true))) 
            $this->cp["object_address_name"]->SetText("-");
        if (!is_null($this->cp["object_rt"]->GetValue()) and !strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue())) 
            $this->cp["object_rt"]->SetValue($this->object_rt->GetValue(true));
        if (!strlen($this->cp["object_rt"]->GetText()) and !is_bool($this->cp["object_rt"]->GetValue(true))) 
            $this->cp["object_rt"]->SetText("-");
        if (!is_null($this->cp["object_rw"]->GetValue()) and !strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue())) 
            $this->cp["object_rw"]->SetValue($this->object_rw->GetValue(true));
        if (!strlen($this->cp["object_rw"]->GetText()) and !is_bool($this->cp["object_rw"]->GetValue(true))) 
            $this->cp["object_rw"]->SetText("-");
        if (!is_null($this->cp["object_p_region_id"]->GetValue()) and !strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue())) 
            $this->cp["object_p_region_id"]->SetValue($this->object_p_region_id->GetValue(true));
        if (!strlen($this->cp["object_p_region_id"]->GetText()) and !is_bool($this->cp["object_p_region_id"]->GetValue(true))) 
            $this->cp["object_p_region_id"]->SetText("-");
        if (!is_null($this->cp["object_p_region_id_kec"]->GetValue()) and !strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue())) 
            $this->cp["object_p_region_id_kec"]->SetValue($this->object_p_region_id_kecamatan->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kec"]->GetText()) and !is_bool($this->cp["object_p_region_id_kec"]->GetValue(true))) 
            $this->cp["object_p_region_id_kec"]->SetText("-");
        if (!is_null($this->cp["object_p_region_id_kel"]->GetValue()) and !strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue())) 
            $this->cp["object_p_region_id_kel"]->SetValue($this->object_p_region_id_kelurahan->GetValue(true));
        if (!strlen($this->cp["object_p_region_id_kel"]->GetText()) and !is_bool($this->cp["object_p_region_id_kel"]->GetValue(true))) 
            $this->cp["object_p_region_id_kel"]->SetText("-");
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
        if (!strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue(true))) 
            $this->cp["description"]->SetText("-");
        if (!is_null($this->cp["i_user"]->GetValue()) and !strlen($this->cp["i_user"]->GetText()) and !is_bool($this->cp["i_user"]->GetValue())) 
            $this->cp["i_user"]->SetValue(CCGetSession("UserLogin", NULL));
        if (!is_null($this->cp["o_t_bphtb_registration_id"]->GetValue()) and !strlen($this->cp["o_t_bphtb_registration_id"]->GetText()) and !is_bool($this->cp["o_t_bphtb_registration_id"]->GetValue())) 
            $this->cp["o_t_bphtb_registration_id"]->SetText(CCGetFromGet("o_t_bphtb_registration_id", NULL));
        if (!is_null($this->cp["o_mess"]->GetValue()) and !strlen($this->cp["o_mess"]->GetText()) and !is_bool($this->cp["o_mess"]->GetValue())) 
            $this->cp["o_mess"]->SetText(CCGetFromGet("o_mess", NULL));
        $this->SQL = "SELECT f_bphtb_registration (" . $this->ToSQL($this->cp["wp_name"]->GetDBValue(), $this->cp["wp_name"]->DataType) . ", "
             . $this->ToSQL($this->cp["npwp"]->GetDBValue(), $this->cp["npwp"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_address_name"]->GetDBValue(), $this->cp["wp_address_name"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_rt"]->GetDBValue(), $this->cp["wp_rt"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_rw"]->GetDBValue(), $this->cp["wp_rw"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_p_region_id"]->GetDBValue(), $this->cp["wp_p_region_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_p_region_id_kec"]->GetDBValue(), $this->cp["wp_p_region_id_kec"]->DataType) . ", "
             . $this->ToSQL($this->cp["wp_p_region_id_kel"]->GetDBValue(), $this->cp["wp_p_region_id_kel"]->DataType) . ", "
             . $this->ToSQL($this->cp["phone_no"]->GetDBValue(), $this->cp["phone_no"]->DataType) . ", "
             . $this->ToSQL($this->cp["mobile_phone_no"]->GetDBValue(), $this->cp["mobile_phone_no"]->DataType) . ", "
             . $this->ToSQL($this->cp["njop_pbb"]->GetDBValue(), $this->cp["njop_pbb"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_address_name"]->GetDBValue(), $this->cp["object_address_name"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_rt"]->GetDBValue(), $this->cp["object_rt"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_rw"]->GetDBValue(), $this->cp["object_rw"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_p_region_id"]->GetDBValue(), $this->cp["object_p_region_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_p_region_id_kec"]->GetDBValue(), $this->cp["object_p_region_id_kec"]->DataType) . ", "
             . $this->ToSQL($this->cp["object_p_region_id_kel"]->GetDBValue(), $this->cp["object_p_region_id_kel"]->DataType) . ", "
             . $this->ToSQL($this->cp["p_bphtb_legal_doc_type_id"]->GetDBValue(), $this->cp["p_bphtb_legal_doc_type_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["land_area"]->GetDBValue(), $this->cp["land_area"]->DataType) . ", "
             . $this->ToSQL($this->cp["land_price_per_m"]->GetDBValue(), $this->cp["land_price_per_m"]->DataType) . ", "
             . $this->ToSQL($this->cp["land_total_price"]->GetDBValue(), $this->cp["land_total_price"]->DataType) . ", "
             . $this->ToSQL($this->cp["building_area"]->GetDBValue(), $this->cp["building_area"]->DataType) . ", "
             . $this->ToSQL($this->cp["building_price_per_m"]->GetDBValue(), $this->cp["building_price_per_m"]->DataType) . ", "
             . $this->ToSQL($this->cp["building_total_price"]->GetDBValue(), $this->cp["building_total_price"]->DataType) . ", "
             . $this->ToSQL($this->cp["market_price"]->GetDBValue(), $this->cp["market_price"]->DataType) . ", "
             . $this->ToSQL($this->cp["npop"]->GetDBValue(), $this->cp["npop"]->DataType) . ", "
             . $this->ToSQL($this->cp["npop_tkp"]->GetDBValue(), $this->cp["npop_tkp"]->DataType) . ", "
             . $this->ToSQL($this->cp["npop_kp"]->GetDBValue(), $this->cp["npop_kp"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_amt"]->GetDBValue(), $this->cp["bphtb_amt"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_discount"]->GetDBValue(), $this->cp["bphtb_discount"]->DataType) . ", "
             . $this->ToSQL($this->cp["bphtb_amt_final"]->GetDBValue(), $this->cp["bphtb_amt_final"]->DataType) . ", "
             . $this->ToSQL($this->cp["description"]->GetDBValue(), $this->cp["description"]->DataType) . ", "
             . $this->ToSQL($this->cp["i_user"]->GetDBValue(), $this->cp["i_user"]->DataType) . ", "
             . $this->ToSQL($this->cp["o_t_bphtb_registration_id"]->GetDBValue(), $this->cp["o_t_bphtb_registration_id"]->DataType) . ", "
             . $this->ToSQL($this->cp["o_mess"]->GetDBValue(), $this->cp["o_mess"]->DataType) . ");";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
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

} //End t_bphtb_registrationFormDataSource Class @94-FCB6E20C

//Initialize Page @1-655FBFAE
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
$TemplateFileName = "t_bphtb_registration.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-E05B1EA1
include_once("./t_bphtb_registration_events.php");
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
