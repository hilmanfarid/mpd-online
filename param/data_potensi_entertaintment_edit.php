<?php
//Include Common Files @1-5FEE867C
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "data_potensi_entertaintment_edit.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_reg_dtl_entertaintmentForm { //t_vat_reg_dtl_entertaintmentForm Class @94-F0CA1DDD

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

//Class_Initialize Event @94-123B9422
    function clsRecordt_vat_reg_dtl_entertaintmentForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_reg_dtl_entertaintmentForm/Error";
        $this->DataSource = new clst_vat_reg_dtl_entertaintmentFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_reg_dtl_entertaintmentForm";
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
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", $Method, NULL), $this);
            $this->clerk_qty = & new clsControl(ccsTextBox, "clerk_qty", "Jumlah PL/Pramuria/Pemijat", ccsFloat, "", CCGetRequestParam("clerk_qty", $Method, NULL), $this);
            $this->clerk_qty->Required = true;
            $this->seat_qty = & new clsControl(ccsTextBox, "seat_qty", "Jumlah Lembar Meja/Kursi", ccsFloat, "", CCGetRequestParam("seat_qty", $Method, NULL), $this);
            $this->seat_qty->Required = true;
            $this->service_charge_wd = & new clsControl(ccsTextBox, "service_charge_wd", "Cover Change/HTM/Tarif Weekend", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_wd", $Method, NULL), $this);
            $this->service_charge_wd->Required = true;
            $this->entertainment_desc = & new clsControl(ccsTextBox, "entertainment_desc", "Jenis Hiburan", ccsText, "", CCGetRequestParam("entertainment_desc", $Method, NULL), $this);
            $this->entertainment_desc->Required = true;
            $this->p_entertaintment_type_id = & new clsControl(ccsHidden, "p_entertaintment_type_id", "p_entertaintment_type_id", ccsFloat, "", CCGetRequestParam("p_entertaintment_type_id", $Method, NULL), $this);
            $this->t_cacc_dtl_entertaintment_id = & new clsControl(ccsHidden, "t_cacc_dtl_entertaintment_id", "t_cacc_dtl_entertaintment_id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_entertaintment_id", $Method, NULL), $this);
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->room_qty = & new clsControl(ccsTextBox, "room_qty", "Jumlah Lembar Meja/Kursi", ccsText, "", CCGetRequestParam("room_qty", $Method, NULL), $this);
            $this->room_qty->Required = true;
            $this->booking_hour = & new clsControl(ccsTextBox, "booking_hour", "Booking Jam", ccsFloat, "", CCGetRequestParam("booking_hour", $Method, NULL), $this);
            $this->f_and_b = & new clsControl(ccsTextBox, "f_and_b", "F & B", ccsFloat, "", CCGetRequestParam("f_and_b", $Method, NULL), $this);
            $this->portion_person = & new clsControl(ccsTextBox, "portion_person", "Porsi/Orang", ccsFloat, "", CCGetRequestParam("portion_person", $Method, NULL), $this);
            $this->service_charge_we = & new clsControl(ccsTextBox, "service_charge_we", "Cover Change/HTM/Tarif Non Weekend", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_we", $Method, NULL), $this);
            $this->service_charge_we->Required = true;
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "t_vat_reg_dtl_entertaintmentForm", "valid_from", $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "t_vat_reg_dtl_entertaintmentForm", "valid_to", $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->valid_from->Value) && !strlen($this->valid_from->Value) && $this->valid_from->Value !== false)
                    $this->valid_from->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-61236339
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cacc_dtl_entertaintment_id"] = CCGetFromGet("t_cacc_dtl_entertaintment_id", NULL);
    }
//End Initialize Method

//Validate Method @94-63C719D9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->customer_name->Validate() && $Validation);
        $Validation = ($this->clerk_qty->Validate() && $Validation);
        $Validation = ($this->seat_qty->Validate() && $Validation);
        $Validation = ($this->service_charge_wd->Validate() && $Validation);
        $Validation = ($this->entertainment_desc->Validate() && $Validation);
        $Validation = ($this->p_entertaintment_type_id->Validate() && $Validation);
        $Validation = ($this->t_cacc_dtl_entertaintment_id->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->room_qty->Validate() && $Validation);
        $Validation = ($this->booking_hour->Validate() && $Validation);
        $Validation = ($this->f_and_b->Validate() && $Validation);
        $Validation = ($this->portion_person->Validate() && $Validation);
        $Validation = ($this->service_charge_we->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->clerk_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->seat_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_charge_wd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->entertainment_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_entertaintment_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cacc_dtl_entertaintment_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->room_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->booking_hour->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f_and_b->Errors->Count() == 0);
        $Validation =  $Validation && ($this->portion_person->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_charge_we->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-6CD9A6CC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->customer_name->Errors->Count());
        $errors = ($errors || $this->clerk_qty->Errors->Count());
        $errors = ($errors || $this->seat_qty->Errors->Count());
        $errors = ($errors || $this->service_charge_wd->Errors->Count());
        $errors = ($errors || $this->entertainment_desc->Errors->Count());
        $errors = ($errors || $this->p_entertaintment_type_id->Errors->Count());
        $errors = ($errors || $this->t_cacc_dtl_entertaintment_id->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->room_qty->Errors->Count());
        $errors = ($errors || $this->booking_hour->Errors->Count());
        $errors = ($errors || $this->f_and_b->Errors->Count());
        $errors = ($errors || $this->portion_person->Errors->Count());
        $errors = ($errors || $this->service_charge_we->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
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

//Operation Method @94-EF0D40ED
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_reg_dtl_entertaintment_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_reg_dtl_entertaintment_id"));
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

//InsertRow Method @94-69991E5F
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->portion_person->SetValue($this->portion_person->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->room_qty->SetValue($this->room_qty->GetValue(true));
        $this->DataSource->clerk_qty->SetValue($this->clerk_qty->GetValue(true));
        $this->DataSource->f_and_b->SetValue($this->f_and_b->GetValue(true));
        $this->DataSource->booking_hour->SetValue($this->booking_hour->GetValue(true));
        $this->DataSource->seat_qty->SetValue($this->seat_qty->GetValue(true));
        $this->DataSource->service_charge_wd->SetValue($this->service_charge_wd->GetValue(true));
        $this->DataSource->entertainment_desc->SetValue($this->entertainment_desc->GetValue(true));
        $this->DataSource->service_charge_we->SetValue($this->service_charge_we->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-E48AFF81
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_cacc_dtl_entertaintment_id->SetValue($this->t_cacc_dtl_entertaintment_id->GetValue(true));
        $this->DataSource->portion_person->SetValue($this->portion_person->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->room_qty->SetValue($this->room_qty->GetValue(true));
        $this->DataSource->clerk_qty->SetValue($this->clerk_qty->GetValue(true));
        $this->DataSource->f_and_b->SetValue($this->f_and_b->GetValue(true));
        $this->DataSource->booking_hour->SetValue($this->booking_hour->GetValue(true));
        $this->DataSource->seat_qty->SetValue($this->seat_qty->GetValue(true));
        $this->DataSource->service_charge_wd->SetValue($this->service_charge_wd->GetValue(true));
        $this->DataSource->service_charge_we->SetValue($this->service_charge_we->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-61E9ABA4
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_cacc_dtl_entertaintment_id->SetValue($this->t_cacc_dtl_entertaintment_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-97EBD047
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
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->clerk_qty->SetValue($this->DataSource->clerk_qty->GetValue());
                    $this->seat_qty->SetValue($this->DataSource->seat_qty->GetValue());
                    $this->service_charge_wd->SetValue($this->DataSource->service_charge_wd->GetValue());
                    $this->entertainment_desc->SetValue($this->DataSource->entertainment_desc->GetValue());
                    $this->p_entertaintment_type_id->SetValue($this->DataSource->p_entertaintment_type_id->GetValue());
                    $this->t_cacc_dtl_entertaintment_id->SetValue($this->DataSource->t_cacc_dtl_entertaintment_id->GetValue());
                    $this->room_qty->SetValue($this->DataSource->room_qty->GetValue());
                    $this->booking_hour->SetValue($this->DataSource->booking_hour->GetValue());
                    $this->f_and_b->SetValue($this->DataSource->f_and_b->GetValue());
                    $this->portion_person->SetValue($this->DataSource->portion_person->GetValue());
                    $this->service_charge_we->SetValue($this->DataSource->service_charge_we->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
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
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->clerk_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->seat_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_charge_wd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->entertainment_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_entertaintment_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cacc_dtl_entertaintment_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->room_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->booking_hour->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f_and_b->Errors->ToString());
            $Error = ComposeStrings($Error, $this->portion_person->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_charge_we->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
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
        $this->t_cust_account_id->Show();
        $this->customer_name->Show();
        $this->clerk_qty->Show();
        $this->seat_qty->Show();
        $this->service_charge_wd->Show();
        $this->entertainment_desc->Show();
        $this->p_entertaintment_type_id->Show();
        $this->t_cacc_dtl_entertaintment_id->Show();
        $this->t_customer_id->Show();
        $this->room_qty->Show();
        $this->booking_hour->Show();
        $this->f_and_b->Show();
        $this->portion_person->Show();
        $this->service_charge_we->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_reg_dtl_entertaintmentForm Class @94-FCB6E20C

class clst_vat_reg_dtl_entertaintmentFormDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_entertaintmentFormDataSource Class @94-E5F4782D

//DataSource Variables @94-73AEEE76
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
    var $t_cust_account_id;
    var $customer_name;
    var $clerk_qty;
    var $seat_qty;
    var $service_charge_wd;
    var $entertainment_desc;
    var $p_entertaintment_type_id;
    var $t_cacc_dtl_entertaintment_id;
    var $t_customer_id;
    var $room_qty;
    var $booking_hour;
    var $f_and_b;
    var $portion_person;
    var $service_charge_we;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-69436B31
    function clst_vat_reg_dtl_entertaintmentFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_reg_dtl_entertaintmentForm/Error";
        $this->Initialize();
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->customer_name = new clsField("customer_name", ccsText, "");
        
        $this->clerk_qty = new clsField("clerk_qty", ccsFloat, "");
        
        $this->seat_qty = new clsField("seat_qty", ccsFloat, "");
        
        $this->service_charge_wd = new clsField("service_charge_wd", ccsFloat, "");
        
        $this->entertainment_desc = new clsField("entertainment_desc", ccsText, "");
        
        $this->p_entertaintment_type_id = new clsField("p_entertaintment_type_id", ccsFloat, "");
        
        $this->t_cacc_dtl_entertaintment_id = new clsField("t_cacc_dtl_entertaintment_id", ccsFloat, "");
        
        $this->t_customer_id = new clsField("t_customer_id", ccsFloat, "");
        
        $this->room_qty = new clsField("room_qty", ccsText, "");
        
        $this->booking_hour = new clsField("booking_hour", ccsFloat, "");
        
        $this->f_and_b = new clsField("f_and_b", ccsFloat, "");
        
        $this->portion_person = new clsField("portion_person", ccsFloat, "");
        
        $this->service_charge_we = new clsField("service_charge_we", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-F006A532
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cacc_dtl_entertaintment_id", ccsFloat, "", "", $this->Parameters["urlt_cacc_dtl_entertaintment_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-2A4F871E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.t_cacc_dtl_entertaintment_id, a.t_cust_account_id, a.entertainment_desc, a.service_charge_wd, a.service_charge_we, \n" .
        "       to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to,	\n" .
        "       a.seat_qty, a.room_qty, a.clerk_qty, a.booking_hour, a.f_and_b, a.portion_person, to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date, \n" .
        "       a.created_by, to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, a.updated_by\n" .
        "   FROM t_cacc_dtl_entertaintment a, t_cust_account c\n" .
        "  WHERE a.t_cust_account_id = c.t_cust_account_id \n" .
        "  AND a.t_cacc_dtl_entertaintment_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-BB1FDF56
    function SetValues()
    {
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->clerk_qty->SetDBValue(trim($this->f("clerk_qty")));
        $this->seat_qty->SetDBValue(trim($this->f("seat_qty")));
        $this->service_charge_wd->SetDBValue(trim($this->f("service_charge_wd")));
        $this->entertainment_desc->SetDBValue($this->f("entertainment_desc"));
        $this->p_entertaintment_type_id->SetDBValue(trim($this->f("p_entertaintment_type_id")));
        $this->t_cacc_dtl_entertaintment_id->SetDBValue(trim($this->f("t_cacc_dtl_entertaintment_id")));
        $this->room_qty->SetDBValue($this->f("room_qty"));
        $this->booking_hour->SetDBValue(trim($this->f("booking_hour")));
        $this->f_and_b->SetDBValue(trim($this->f("f_and_b")));
        $this->portion_person->SetDBValue(trim($this->f("portion_person")));
        $this->service_charge_we->SetDBValue(trim($this->f("service_charge_we")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

//Insert Method @94-645391B4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["portion_person"] = new clsSQLParameter("ctrlportion_person", ccsFloat, "", "", $this->portion_person->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr777", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr778", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["room_qty"] = new clsSQLParameter("ctrlroom_qty", ccsText, "", "", $this->room_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["clerk_qty"] = new clsSQLParameter("ctrlclerk_qty", ccsFloat, "", "", $this->clerk_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_and_b"] = new clsSQLParameter("ctrlf_and_b", ccsFloat, "", "", $this->f_and_b->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["booking_hour"] = new clsSQLParameter("ctrlbooking_hour", ccsFloat, "", "", $this->booking_hour->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["seat_qty"] = new clsSQLParameter("ctrlseat_qty", ccsFloat, "", "", $this->seat_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_wd"] = new clsSQLParameter("ctrlservice_charge_wd", ccsFloat, "", "", $this->service_charge_wd->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["entertainment_desc"] = new clsSQLParameter("ctrlentertainment_desc", ccsText, "", "", $this->entertainment_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_we"] = new clsSQLParameter("ctrlservice_charge_we", ccsFloat, "", "", $this->service_charge_we->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["portion_person"]->GetValue()) and !strlen($this->cp["portion_person"]->GetText()) and !is_bool($this->cp["portion_person"]->GetValue())) 
            $this->cp["portion_person"]->SetValue($this->portion_person->GetValue(true));
        if (!strlen($this->cp["portion_person"]->GetText()) and !is_bool($this->cp["portion_person"]->GetValue(true))) 
            $this->cp["portion_person"]->SetText(0);
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["room_qty"]->GetValue()) and !strlen($this->cp["room_qty"]->GetText()) and !is_bool($this->cp["room_qty"]->GetValue())) 
            $this->cp["room_qty"]->SetValue($this->room_qty->GetValue(true));
        if (!is_null($this->cp["clerk_qty"]->GetValue()) and !strlen($this->cp["clerk_qty"]->GetText()) and !is_bool($this->cp["clerk_qty"]->GetValue())) 
            $this->cp["clerk_qty"]->SetValue($this->clerk_qty->GetValue(true));
        if (!is_null($this->cp["f_and_b"]->GetValue()) and !strlen($this->cp["f_and_b"]->GetText()) and !is_bool($this->cp["f_and_b"]->GetValue())) 
            $this->cp["f_and_b"]->SetValue($this->f_and_b->GetValue(true));
        if (!strlen($this->cp["f_and_b"]->GetText()) and !is_bool($this->cp["f_and_b"]->GetValue(true))) 
            $this->cp["f_and_b"]->SetText(0);
        if (!is_null($this->cp["booking_hour"]->GetValue()) and !strlen($this->cp["booking_hour"]->GetText()) and !is_bool($this->cp["booking_hour"]->GetValue())) 
            $this->cp["booking_hour"]->SetValue($this->booking_hour->GetValue(true));
        if (!strlen($this->cp["booking_hour"]->GetText()) and !is_bool($this->cp["booking_hour"]->GetValue(true))) 
            $this->cp["booking_hour"]->SetText(0);
        if (!is_null($this->cp["seat_qty"]->GetValue()) and !strlen($this->cp["seat_qty"]->GetText()) and !is_bool($this->cp["seat_qty"]->GetValue())) 
            $this->cp["seat_qty"]->SetValue($this->seat_qty->GetValue(true));
        if (!is_null($this->cp["service_charge_wd"]->GetValue()) and !strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue())) 
            $this->cp["service_charge_wd"]->SetValue($this->service_charge_wd->GetValue(true));
        if (!strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue(true))) 
            $this->cp["service_charge_wd"]->SetText(0);
        if (!is_null($this->cp["entertainment_desc"]->GetValue()) and !strlen($this->cp["entertainment_desc"]->GetText()) and !is_bool($this->cp["entertainment_desc"]->GetValue())) 
            $this->cp["entertainment_desc"]->SetValue($this->entertainment_desc->GetValue(true));
        if (!is_null($this->cp["service_charge_we"]->GetValue()) and !strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue())) 
            $this->cp["service_charge_we"]->SetValue($this->service_charge_we->GetValue(true));
        if (!strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue(true))) 
            $this->cp["service_charge_we"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        $this->SQL = "INSERT INTO t_cacc_dtl_entertaintment(t_cacc_dtl_entertaintment_id, portion_person, created_by, updated_by, creation_date, updated_date, t_cust_account_id, room_qty, clerk_qty, f_and_b, booking_hour, seat_qty, service_charge_wd, service_charge_we, entertainment_desc, valid_from, valid_to) \n" .
        "VALUES(generate_id('sikp','t_cacc_dtl_entertaintment','t_cacc_dtl_entertaintment_id'), decode(" . $this->SQLValue($this->cp["portion_person"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["portion_person"]->GetDBValue(), ccsFloat) . "), '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, " . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["room_qty"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["clerk_qty"]->GetDBValue(), ccsFloat) . ", decode(" . $this->SQLValue($this->cp["f_and_b"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["f_and_b"]->GetDBValue(), ccsFloat) . "), decode(" . $this->SQLValue($this->cp["booking_hour"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["booking_hour"]->GetDBValue(), ccsFloat) . "), " . $this->SQLValue($this->cp["seat_qty"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["service_charge_wd"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["service_charge_we"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["entertainment_desc"]->GetDBValue(), ccsText) . "', to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-69B29EFF
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cacc_dtl_entertaintment_id"] = new clsSQLParameter("ctrlt_cacc_dtl_entertaintment_id", ccsFloat, "", "", $this->t_cacc_dtl_entertaintment_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["portion_person"] = new clsSQLParameter("ctrlportion_person", ccsFloat, "", "", $this->portion_person->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr808", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["room_qty"] = new clsSQLParameter("ctrlroom_qty", ccsText, "", "", $this->room_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["clerk_qty"] = new clsSQLParameter("ctrlclerk_qty", ccsFloat, "", "", $this->clerk_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["f_and_b"] = new clsSQLParameter("ctrlf_and_b", ccsFloat, "", "", $this->f_and_b->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["booking_hour"] = new clsSQLParameter("ctrlbooking_hour", ccsFloat, "", "", $this->booking_hour->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["seat_qty"] = new clsSQLParameter("ctrlseat_qty", ccsFloat, "", "", $this->seat_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_wd"] = new clsSQLParameter("ctrlservice_charge_wd", ccsFloat, "", "", $this->service_charge_wd->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["service_charge_we"] = new clsSQLParameter("ctrlservice_charge_we", ccsFloat, "", "", $this->service_charge_we->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_cacc_dtl_entertaintment_id"]->GetValue()) and !strlen($this->cp["t_cacc_dtl_entertaintment_id"]->GetText()) and !is_bool($this->cp["t_cacc_dtl_entertaintment_id"]->GetValue())) 
            $this->cp["t_cacc_dtl_entertaintment_id"]->SetValue($this->t_cacc_dtl_entertaintment_id->GetValue(true));
        if (!strlen($this->cp["t_cacc_dtl_entertaintment_id"]->GetText()) and !is_bool($this->cp["t_cacc_dtl_entertaintment_id"]->GetValue(true))) 
            $this->cp["t_cacc_dtl_entertaintment_id"]->SetText(0);
        if (!is_null($this->cp["portion_person"]->GetValue()) and !strlen($this->cp["portion_person"]->GetText()) and !is_bool($this->cp["portion_person"]->GetValue())) 
            $this->cp["portion_person"]->SetValue($this->portion_person->GetValue(true));
        if (!strlen($this->cp["portion_person"]->GetText()) and !is_bool($this->cp["portion_person"]->GetValue(true))) 
            $this->cp["portion_person"]->SetText(0);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["room_qty"]->GetValue()) and !strlen($this->cp["room_qty"]->GetText()) and !is_bool($this->cp["room_qty"]->GetValue())) 
            $this->cp["room_qty"]->SetValue($this->room_qty->GetValue(true));
        if (!is_null($this->cp["clerk_qty"]->GetValue()) and !strlen($this->cp["clerk_qty"]->GetText()) and !is_bool($this->cp["clerk_qty"]->GetValue())) 
            $this->cp["clerk_qty"]->SetValue($this->clerk_qty->GetValue(true));
        if (!is_null($this->cp["f_and_b"]->GetValue()) and !strlen($this->cp["f_and_b"]->GetText()) and !is_bool($this->cp["f_and_b"]->GetValue())) 
            $this->cp["f_and_b"]->SetValue($this->f_and_b->GetValue(true));
        if (!strlen($this->cp["f_and_b"]->GetText()) and !is_bool($this->cp["f_and_b"]->GetValue(true))) 
            $this->cp["f_and_b"]->SetText(0);
        if (!is_null($this->cp["booking_hour"]->GetValue()) and !strlen($this->cp["booking_hour"]->GetText()) and !is_bool($this->cp["booking_hour"]->GetValue())) 
            $this->cp["booking_hour"]->SetValue($this->booking_hour->GetValue(true));
        if (!strlen($this->cp["booking_hour"]->GetText()) and !is_bool($this->cp["booking_hour"]->GetValue(true))) 
            $this->cp["booking_hour"]->SetText(0);
        if (!is_null($this->cp["seat_qty"]->GetValue()) and !strlen($this->cp["seat_qty"]->GetText()) and !is_bool($this->cp["seat_qty"]->GetValue())) 
            $this->cp["seat_qty"]->SetValue($this->seat_qty->GetValue(true));
        if (!is_null($this->cp["service_charge_wd"]->GetValue()) and !strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue())) 
            $this->cp["service_charge_wd"]->SetValue($this->service_charge_wd->GetValue(true));
        if (!strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue(true))) 
            $this->cp["service_charge_wd"]->SetText(0);
        if (!is_null($this->cp["service_charge_we"]->GetValue()) and !strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue())) 
            $this->cp["service_charge_we"]->SetValue($this->service_charge_we->GetValue(true));
        if (!strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue(true))) 
            $this->cp["service_charge_we"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        $this->SQL = "UPDATE t_cacc_dtl_entertaintment SET \n" .
        "portion_person=decode(" . $this->SQLValue($this->cp["portion_person"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["portion_person"]->GetDBValue(), ccsFloat) . "),\n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "t_cust_account_id=" . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "room_qty='" . $this->SQLValue($this->cp["room_qty"]->GetDBValue(), ccsText) . "', \n" .
        "clerk_qty=" . $this->SQLValue($this->cp["clerk_qty"]->GetDBValue(), ccsFloat) . ", \n" .
        "f_and_b=decode(" . $this->SQLValue($this->cp["f_and_b"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["f_and_b"]->GetDBValue(), ccsFloat) . "),  \n" .
        "booking_hour=decode(" . $this->SQLValue($this->cp["booking_hour"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["booking_hour"]->GetDBValue(), ccsFloat) . "), \n" .
        "seat_qty=" . $this->SQLValue($this->cp["seat_qty"]->GetDBValue(), ccsFloat) . ", \n" .
        "service_charge_wd=" . $this->SQLValue($this->cp["service_charge_wd"]->GetDBValue(), ccsFloat) . ",\n" .
        "service_charge_we=" . $this->SQLValue($this->cp["service_charge_we"]->GetDBValue(), ccsFloat) . ",\n" .
        "valid_from = to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'),\n" .
        "valid_to=case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end\n" .
        "WHERE t_cacc_dtl_entertaintment_id=" . $this->SQLValue($this->cp["t_cacc_dtl_entertaintment_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-68F819CD
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cacc_dtl_entertaintment_id"] = new clsSQLParameter("ctrlt_cacc_dtl_entertaintment_id", ccsInteger, "", "", $this->t_cacc_dtl_entertaintment_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_cacc_dtl_entertaintment_id"]->GetValue()) and !strlen($this->cp["t_cacc_dtl_entertaintment_id"]->GetText()) and !is_bool($this->cp["t_cacc_dtl_entertaintment_id"]->GetValue())) 
            $this->cp["t_cacc_dtl_entertaintment_id"]->SetValue($this->t_cacc_dtl_entertaintment_id->GetValue(true));
        if (!strlen($this->cp["t_cacc_dtl_entertaintment_id"]->GetText()) and !is_bool($this->cp["t_cacc_dtl_entertaintment_id"]->GetValue(true))) 
            $this->cp["t_cacc_dtl_entertaintment_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_cacc_dtl_entertaintment\n" .
        "WHERE t_cacc_dtl_entertaintment_id = " . $this->SQLValue($this->cp["t_cacc_dtl_entertaintment_id"]->GetDBValue(), ccsInteger) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_reg_dtl_entertaintmentFormDataSource Class @94-FCB6E20C

//Initialize Page @1-3009009D
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
$TemplateFileName = "data_potensi_entertaintment_edit.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-025E6BD0
include_once("./data_potensi_entertaintment_edit_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AD9D688C
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_reg_dtl_entertaintmentForm = & new clsRecordt_vat_reg_dtl_entertaintmentForm("", $MainPage);
$MainPage->t_vat_reg_dtl_entertaintmentForm = & $t_vat_reg_dtl_entertaintmentForm;
$t_vat_reg_dtl_entertaintmentForm->Initialize();

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

//Execute Components @1-80F35A20
$t_vat_reg_dtl_entertaintmentForm->Operation();
//End Execute Components

//Go to destination page @1-8444A59D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_reg_dtl_entertaintmentForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C30B4D6D
$t_vat_reg_dtl_entertaintmentForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E9A17DF0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_reg_dtl_entertaintmentForm);
unset($Tpl);
//End Unload Page


?>
