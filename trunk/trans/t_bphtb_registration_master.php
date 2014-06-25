<?php
//Include Common Files @1-B27AE5C3
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_bphtb_registration_master.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
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

//Class_Initialize Event @94-9D5125E3
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
            if(!$this->FormSubmitted) {
                if(!is_array($this->wp_kota->Value) && !strlen($this->wp_kota->Value) && $this->wp_kota->Value !== false)
                    $this->wp_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->wp_p_region_id->Value) && !strlen($this->wp_p_region_id->Value) && $this->wp_p_region_id->Value !== false)
                    $this->wp_p_region_id->SetText(749);
                if(!is_array($this->object_kota->Value) && !strlen($this->object_kota->Value) && $this->object_kota->Value !== false)
                    $this->object_kota->SetText('KOTA BANDUNG');
                if(!is_array($this->object_p_region_id->Value) && !strlen($this->object_p_region_id->Value) && $this->object_p_region_id->Value !== false)
                    $this->object_p_region_id->SetText(749);
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

//Validate Method @94-59032D05
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
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-523712CD
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

//Operation Method @94-63666852
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
                $Redirect = "t_bphtb_registration_list.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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

//UpdateRow Method @94-62309483
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_bphtb_registration_id->SetValue($this->t_bphtb_registration_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @94-54399D51
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_bphtb_registrationForm Class @94-FCB6E20C

class clst_bphtb_registrationFormDataSource extends clsDBConnSIKP {  //t_bphtb_registrationFormDataSource Class @94-BDFCC0BF

//DataSource Variables @94-F068DFD5
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
//End DataSource Variables

//DataSourceClass_Initialize Event @94-B9CE19FD
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

//Open Method @94-AA4D91C0
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
        "from t_bphtb_registration as a \n" .
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

//SetValues Method @94-40A70204
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
    }
//End SetValues Method

//Update Method @94-E7C0A197
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->SQL = "t_bphtb_registration";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_bphtb_registrationFormDataSource Class @94-FCB6E20C

//Initialize Page @1-D098BEE6
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
$TemplateFileName = "t_bphtb_registration_master.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-6D1BD197
include_once("./t_bphtb_registration_master_events.php");
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
