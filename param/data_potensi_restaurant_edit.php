<?php
//Include Common Files @1-86F1CA40
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "data_potensi_restaurant_edit.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_reg_dtl_restaurantForm { //t_vat_reg_dtl_restaurantForm Class @94-069465AC

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

//Class_Initialize Event @94-D1DAF700
    function clsRecordt_vat_reg_dtl_restaurantForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_reg_dtl_restaurantForm/Error";
        $this->DataSource = new clst_vat_reg_dtl_restaurantFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_reg_dtl_restaurantForm";
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
            $this->t_cacc_dtl_restaurant_id = & new clsControl(ccsHidden, "t_cacc_dtl_restaurant_id", "Id", ccsFloat, "", CCGetRequestParam("t_cacc_dtl_restaurant_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", $Method, NULL), $this);
            $this->table_qty = & new clsControl(ccsTextBox, "table_qty", "Jumlah Meja", ccsText, "", CCGetRequestParam("table_qty", $Method, NULL), $this);
            $this->table_qty->Required = true;
            $this->seat_qty = & new clsControl(ccsTextBox, "seat_qty", "Jumlah Kursi", ccsFloat, "", CCGetRequestParam("seat_qty", $Method, NULL), $this);
            $this->seat_qty->Required = true;
            $this->max_service_qty = & new clsControl(ccsTextBox, "max_service_qty", "Daya Tampung", ccsFloat, "", CCGetRequestParam("max_service_qty", $Method, NULL), $this);
            $this->max_service_qty->Required = true;
            $this->service_type_desc = & new clsControl(ccsTextBox, "service_type_desc", "Jenis Pelayanan", ccsText, "", CCGetRequestParam("service_type_desc", $Method, NULL), $this);
            $this->service_type_desc->Required = true;
            $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", $Method, NULL), $this);
            $this->avg_subscription = & new clsControl(ccsTextBox, "avg_subscription", "Jumlah pengunjung rata-rata per Bulan", ccsFloat, "", CCGetRequestParam("avg_subscription", $Method, NULL), $this);
            $this->avg_subscription->Required = true;
            $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", $Method, NULL), $this);
            $this->p_rest_service_type_id = & new clsControl(ccsHidden, "p_rest_service_type_id", "p_rest_service_type_id", ccsText, "", CCGetRequestParam("p_rest_service_type_id", $Method, NULL), $this);
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "t_vat_reg_dtl_restaurantForm", "valid_from", $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "t_vat_reg_dtl_restaurantForm", "valid_to", $this);
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

//Initialize Method @94-6F76DD67
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_cacc_dtl_restaurant_id"] = CCGetFromGet("t_cacc_dtl_restaurant_id", NULL);
    }
//End Initialize Method

//Validate Method @94-2BA5ED6A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_cacc_dtl_restaurant_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->customer_name->Validate() && $Validation);
        $Validation = ($this->table_qty->Validate() && $Validation);
        $Validation = ($this->seat_qty->Validate() && $Validation);
        $Validation = ($this->max_service_qty->Validate() && $Validation);
        $Validation = ($this->service_type_desc->Validate() && $Validation);
        $Validation = ($this->t_customer_id->Validate() && $Validation);
        $Validation = ($this->avg_subscription->Validate() && $Validation);
        $Validation = ($this->t_cust_account_id->Validate() && $Validation);
        $Validation = ($this->p_rest_service_type_id->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_cacc_dtl_restaurant_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->customer_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->table_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->seat_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->max_service_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_type_desc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->avg_subscription->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_cust_account_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rest_service_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-5B671235
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_cacc_dtl_restaurant_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->customer_name->Errors->Count());
        $errors = ($errors || $this->table_qty->Errors->Count());
        $errors = ($errors || $this->seat_qty->Errors->Count());
        $errors = ($errors || $this->max_service_qty->Errors->Count());
        $errors = ($errors || $this->service_type_desc->Errors->Count());
        $errors = ($errors || $this->t_customer_id->Errors->Count());
        $errors = ($errors || $this->avg_subscription->Errors->Count());
        $errors = ($errors || $this->t_cust_account_id->Errors->Count());
        $errors = ($errors || $this->p_rest_service_type_id->Errors->Count());
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

//Operation Method @94-AAE4F942
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_reg_dtl_hotel_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_vat_reg_dtl_hotel_id"));
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

//InsertRow Method @94-D50AC8F1
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->table_qty->SetValue($this->table_qty->GetValue(true));
        $this->DataSource->avg_subscription->SetValue($this->avg_subscription->GetValue(true));
        $this->DataSource->seat_qty->SetValue($this->seat_qty->GetValue(true));
        $this->DataSource->max_service_qty->SetValue($this->max_service_qty->GetValue(true));
        $this->DataSource->service_type_desc->SetValue($this->service_type_desc->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-F25C5638
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_cacc_dtl_restaurant_id->SetValue($this->t_cacc_dtl_restaurant_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->t_cust_account_id->SetValue($this->t_cust_account_id->GetValue(true));
        $this->DataSource->table_qty->SetValue($this->table_qty->GetValue(true));
        $this->DataSource->avg_subscription->SetValue($this->avg_subscription->GetValue(true));
        $this->DataSource->seat_qty->SetValue($this->seat_qty->GetValue(true));
        $this->DataSource->max_service_qty->SetValue($this->max_service_qty->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @94-1D76859B
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
                    $this->t_cacc_dtl_restaurant_id->SetValue($this->DataSource->t_cacc_dtl_restaurant_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->table_qty->SetValue($this->DataSource->table_qty->GetValue());
                    $this->seat_qty->SetValue($this->DataSource->seat_qty->GetValue());
                    $this->max_service_qty->SetValue($this->DataSource->max_service_qty->GetValue());
                    $this->service_type_desc->SetValue($this->DataSource->service_type_desc->GetValue());
                    $this->avg_subscription->SetValue($this->DataSource->avg_subscription->GetValue());
                    $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                    $this->p_rest_service_type_id->SetValue($this->DataSource->p_rest_service_type_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->t_cacc_dtl_restaurant_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->customer_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->table_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->seat_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->max_service_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_type_desc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->avg_subscription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_cust_account_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rest_service_type_id->Errors->ToString());
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
        $this->t_cacc_dtl_restaurant_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->customer_name->Show();
        $this->table_qty->Show();
        $this->seat_qty->Show();
        $this->max_service_qty->Show();
        $this->service_type_desc->Show();
        $this->t_customer_id->Show();
        $this->avg_subscription->Show();
        $this->t_cust_account_id->Show();
        $this->p_rest_service_type_id->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_reg_dtl_restaurantForm Class @94-FCB6E20C

class clst_vat_reg_dtl_restaurantFormDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_restaurantFormDataSource Class @94-55268935

//DataSource Variables @94-19DDE1FC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $InsertParameters;
    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $t_cacc_dtl_restaurant_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $customer_name;
    var $table_qty;
    var $seat_qty;
    var $max_service_qty;
    var $service_type_desc;
    var $t_customer_id;
    var $avg_subscription;
    var $t_cust_account_id;
    var $p_rest_service_type_id;
    var $valid_from;
    var $valid_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-A9AF80C8
    function clst_vat_reg_dtl_restaurantFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_reg_dtl_restaurantForm/Error";
        $this->Initialize();
        $this->t_cacc_dtl_restaurant_id = new clsField("t_cacc_dtl_restaurant_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->customer_name = new clsField("customer_name", ccsText, "");
        
        $this->table_qty = new clsField("table_qty", ccsText, "");
        
        $this->seat_qty = new clsField("seat_qty", ccsFloat, "");
        
        $this->max_service_qty = new clsField("max_service_qty", ccsFloat, "");
        
        $this->service_type_desc = new clsField("service_type_desc", ccsText, "");
        
        $this->t_customer_id = new clsField("t_customer_id", ccsFloat, "");
        
        $this->avg_subscription = new clsField("avg_subscription", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->p_rest_service_type_id = new clsField("p_rest_service_type_id", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-B358C323
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cacc_dtl_restaurant_id", ccsFloat, "", "", $this->Parameters["urlt_cacc_dtl_restaurant_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-2569DF89
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.t_cacc_dtl_restaurant_id, a.t_cust_account_id, a.service_type_desc, \n" .
        "	 to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to,	\n" .
        "	 a.seat_qty, a.table_qty, a.max_service_qty, a.avg_subscription, a.description, to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date, \n" .
        "	 a.created_by, to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, a.updated_by\n" .
        "   FROM t_cacc_dtl_restaurant a, t_cust_account c\n" .
        "  WHERE a.t_cust_account_id = c.t_cust_account_id \n" .
        "  AND a.t_cacc_dtl_restaurant_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-4C38B4BC
    function SetValues()
    {
        $this->t_cacc_dtl_restaurant_id->SetDBValue(trim($this->f("t_cacc_dtl_restaurant_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->table_qty->SetDBValue($this->f("table_qty"));
        $this->seat_qty->SetDBValue(trim($this->f("seat_qty")));
        $this->max_service_qty->SetDBValue(trim($this->f("max_service_qty")));
        $this->service_type_desc->SetDBValue($this->f("service_type_desc"));
        $this->avg_subscription->SetDBValue(trim($this->f("avg_subscription")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->p_rest_service_type_id->SetDBValue($this->f("p_rest_service_type_id"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
    }
//End SetValues Method

//Insert Method @94-06F4F413
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr775", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr776", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["table_qty"] = new clsSQLParameter("ctrltable_qty", ccsText, "", "", $this->table_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["avg_subscription"] = new clsSQLParameter("ctrlavg_subscription", ccsFloat, "", "", $this->avg_subscription->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["seat_qty"] = new clsSQLParameter("ctrlseat_qty", ccsFloat, "", "", $this->seat_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["max_service_qty"] = new clsSQLParameter("ctrlmax_service_qty", ccsFloat, "", "", $this->max_service_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_type_desc"] = new clsSQLParameter("ctrlservice_type_desc", ccsText, "", "", $this->service_type_desc->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["table_qty"]->GetValue()) and !strlen($this->cp["table_qty"]->GetText()) and !is_bool($this->cp["table_qty"]->GetValue())) 
            $this->cp["table_qty"]->SetValue($this->table_qty->GetValue(true));
        if (!is_null($this->cp["avg_subscription"]->GetValue()) and !strlen($this->cp["avg_subscription"]->GetText()) and !is_bool($this->cp["avg_subscription"]->GetValue())) 
            $this->cp["avg_subscription"]->SetValue($this->avg_subscription->GetValue(true));
        if (!is_null($this->cp["seat_qty"]->GetValue()) and !strlen($this->cp["seat_qty"]->GetText()) and !is_bool($this->cp["seat_qty"]->GetValue())) 
            $this->cp["seat_qty"]->SetValue($this->seat_qty->GetValue(true));
        if (!is_null($this->cp["max_service_qty"]->GetValue()) and !strlen($this->cp["max_service_qty"]->GetText()) and !is_bool($this->cp["max_service_qty"]->GetValue())) 
            $this->cp["max_service_qty"]->SetValue($this->max_service_qty->GetValue(true));
        if (!is_null($this->cp["service_type_desc"]->GetValue()) and !strlen($this->cp["service_type_desc"]->GetText()) and !is_bool($this->cp["service_type_desc"]->GetValue())) 
            $this->cp["service_type_desc"]->SetValue($this->service_type_desc->GetValue(true));
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        $this->SQL = "INSERT INTO t_cacc_dtl_restaurant(t_cacc_dtl_restaurant_id, description, created_by, updated_by, creation_date, updated_date, t_cust_account_id, table_qty, avg_subscription, seat_qty, max_service_qty, service_type_desc, valid_from, valid_to) \n" .
        "VALUES(generate_id('sikp','t_cacc_dtl_restaurant','t_cacc_dtl_restaurant_id'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, " . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["table_qty"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["avg_subscription"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["seat_qty"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["max_service_qty"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["service_type_desc"]->GetDBValue(), ccsText) . "', to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end)";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-C859111E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_cacc_dtl_restaurant_id"] = new clsSQLParameter("ctrlt_cacc_dtl_restaurant_id", ccsFloat, "", "", $this->t_cacc_dtl_restaurant_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr804", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_cust_account_id"] = new clsSQLParameter("ctrlt_cust_account_id", ccsFloat, "", "", $this->t_cust_account_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["table_qty"] = new clsSQLParameter("ctrltable_qty", ccsText, "", "", $this->table_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["avg_subscription"] = new clsSQLParameter("ctrlavg_subscription", ccsFloat, "", "", $this->avg_subscription->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["seat_qty"] = new clsSQLParameter("ctrlseat_qty", ccsFloat, "", "", $this->seat_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["max_service_qty"] = new clsSQLParameter("ctrlmax_service_qty", ccsFloat, "", "", $this->max_service_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_cacc_dtl_restaurant_id"]->GetValue()) and !strlen($this->cp["t_cacc_dtl_restaurant_id"]->GetText()) and !is_bool($this->cp["t_cacc_dtl_restaurant_id"]->GetValue())) 
            $this->cp["t_cacc_dtl_restaurant_id"]->SetValue($this->t_cacc_dtl_restaurant_id->GetValue(true));
        if (!strlen($this->cp["t_cacc_dtl_restaurant_id"]->GetText()) and !is_bool($this->cp["t_cacc_dtl_restaurant_id"]->GetValue(true))) 
            $this->cp["t_cacc_dtl_restaurant_id"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_cust_account_id"]->GetValue()) and !strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue())) 
            $this->cp["t_cust_account_id"]->SetValue($this->t_cust_account_id->GetValue(true));
        if (!strlen($this->cp["t_cust_account_id"]->GetText()) and !is_bool($this->cp["t_cust_account_id"]->GetValue(true))) 
            $this->cp["t_cust_account_id"]->SetText(0);
        if (!is_null($this->cp["table_qty"]->GetValue()) and !strlen($this->cp["table_qty"]->GetText()) and !is_bool($this->cp["table_qty"]->GetValue())) 
            $this->cp["table_qty"]->SetValue($this->table_qty->GetValue(true));
        if (!is_null($this->cp["avg_subscription"]->GetValue()) and !strlen($this->cp["avg_subscription"]->GetText()) and !is_bool($this->cp["avg_subscription"]->GetValue())) 
            $this->cp["avg_subscription"]->SetValue($this->avg_subscription->GetValue(true));
        if (!is_null($this->cp["seat_qty"]->GetValue()) and !strlen($this->cp["seat_qty"]->GetText()) and !is_bool($this->cp["seat_qty"]->GetValue())) 
            $this->cp["seat_qty"]->SetValue($this->seat_qty->GetValue(true));
        if (!is_null($this->cp["max_service_qty"]->GetValue()) and !strlen($this->cp["max_service_qty"]->GetText()) and !is_bool($this->cp["max_service_qty"]->GetValue())) 
            $this->cp["max_service_qty"]->SetValue($this->max_service_qty->GetValue(true));
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        $this->SQL = "UPDATE t_cacc_dtl_restaurant\n" .
        "SET description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "t_cust_account_id=" . $this->SQLValue($this->cp["t_cust_account_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "table_qty='" . $this->SQLValue($this->cp["table_qty"]->GetDBValue(), ccsText) . "', \n" .
        "avg_subscription=" . $this->SQLValue($this->cp["avg_subscription"]->GetDBValue(), ccsFloat) . ", \n" .
        "seat_qty=" . $this->SQLValue($this->cp["seat_qty"]->GetDBValue(), ccsFloat) . ", \n" .
        "max_service_qty=" . $this->SQLValue($this->cp["max_service_qty"]->GetDBValue(), ccsFloat) . ",\n" .
        "valid_from = to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'),\n" .
        "valid_to=case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end\n" .
        "WHERE t_cacc_dtl_restaurant_id=" . $this->SQLValue($this->cp["t_cacc_dtl_restaurant_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End t_vat_reg_dtl_restaurantFormDataSource Class @94-FCB6E20C

//Initialize Page @1-102EE070
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
$TemplateFileName = "data_potensi_restaurant_edit.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C5B1FBDF
include_once("./data_potensi_restaurant_edit_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FDDD12EB
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_reg_dtl_restaurantForm = & new clsRecordt_vat_reg_dtl_restaurantForm("", $MainPage);
$MainPage->t_vat_reg_dtl_restaurantForm = & $t_vat_reg_dtl_restaurantForm;
$t_vat_reg_dtl_restaurantForm->Initialize();

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

//Execute Components @1-2E08F943
$t_vat_reg_dtl_restaurantForm->Operation();
//End Execute Components

//Go to destination page @1-1772E372
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_reg_dtl_restaurantForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B117CF81
$t_vat_reg_dtl_restaurantForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-04AA6B7F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_reg_dtl_restaurantForm);
unset($Tpl);
//End Unload Page


?>
