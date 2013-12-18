<?php
//Include Common Files @1-A45EE5F2
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_vat_reg_dtl_hotel_edit.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_vat_reg_dtl_hotelForm { //t_vat_reg_dtl_hotelForm Class @94-710C0A40

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

//Class_Initialize Event @94-139B3D08
    function clsRecordt_vat_reg_dtl_hotelForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_vat_reg_dtl_hotelForm/Error";
        $this->DataSource = new clst_vat_reg_dtl_hotelFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_vat_reg_dtl_hotelForm";
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
            $this->t_vat_reg_dtl_hotel_id = & new clsControl(ccsHidden, "t_vat_reg_dtl_hotel_id", "Id", ccsFloat, "", CCGetRequestParam("t_vat_reg_dtl_hotel_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->p_room_type_id = & new clsControl(ccsListBox, "p_room_type_id", "Golongan Kamar", ccsFloat, "", CCGetRequestParam("p_room_type_id", $Method, NULL), $this);
            $this->p_room_type_id->DSType = dsSQL;
            $this->p_room_type_id->DataSource = new clsDBConnSIKP();
            $this->p_room_type_id->ds = & $this->p_room_type_id->DataSource;
            list($this->p_room_type_id->BoundColumn, $this->p_room_type_id->TextColumn, $this->p_room_type_id->DBFormat) = array("p_room_type_id", "code", "");
            $this->p_room_type_id->DataSource->SQL = "SELECT p_room_type_id, code \n" .
            "FROM p_room_type ";
            $this->p_room_type_id->DataSource->Order = "";
            $this->p_room_type_id->Required = true;
            $this->rqst_type_code = & new clsControl(ccsHidden, "rqst_type_code", "rqst_type_code", ccsText, "", CCGetRequestParam("rqst_type_code", $Method, NULL), $this);
            $this->p_rqst_type_id = & new clsControl(ccsHidden, "p_rqst_type_id", "p_rqst_type_id", ccsFloat, "", CCGetRequestParam("p_rqst_type_id", $Method, NULL), $this);
            $this->t_customer_order_id = & new clsControl(ccsHidden, "t_customer_order_id", "t_customer_order_id", ccsFloat, "", CCGetRequestParam("t_customer_order_id", $Method, NULL), $this);
            $this->service_charge_wd = & new clsControl(ccsTextBox, "service_charge_wd", "Tarif Kamar", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_wd", $Method, NULL), $this);
            $this->service_charge_wd->Required = true;
            $this->service_charge_we = & new clsControl(ccsTextBox, "service_charge_we", "Tarif Kamar", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_charge_we", $Method, NULL), $this);
            $this->service_charge_we->Required = true;
            $this->service_qty = & new clsControl(ccsTextBox, "service_qty", "Frekwensi Penggunaan Layanan", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("service_qty", $Method, NULL), $this);
            $this->service_qty->Required = true;
            $this->room_qty = & new clsControl(ccsTextBox, "room_qty", "Jumlah Kamr", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("room_qty", $Method, NULL), $this);
            $this->room_qty->Required = true;
            $this->t_vat_registration_id = & new clsControl(ccsHidden, "t_vat_registration_id", "t_vat_registration_id", ccsFloat, "", CCGetRequestParam("t_vat_registration_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-48A6E6DA
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_vat_reg_dtl_hotel_id"] = CCGetFromGet("t_vat_reg_dtl_hotel_id", NULL);
    }
//End Initialize Method

//Validate Method @94-BCE269E1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_vat_reg_dtl_hotel_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->p_room_type_id->Validate() && $Validation);
        $Validation = ($this->rqst_type_code->Validate() && $Validation);
        $Validation = ($this->p_rqst_type_id->Validate() && $Validation);
        $Validation = ($this->t_customer_order_id->Validate() && $Validation);
        $Validation = ($this->service_charge_wd->Validate() && $Validation);
        $Validation = ($this->service_charge_we->Validate() && $Validation);
        $Validation = ($this->service_qty->Validate() && $Validation);
        $Validation = ($this->room_qty->Validate() && $Validation);
        $Validation = ($this->t_vat_registration_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_vat_reg_dtl_hotel_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_room_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rqst_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_rqst_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_customer_order_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_charge_wd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_charge_we->Errors->Count() == 0);
        $Validation =  $Validation && ($this->service_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->room_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_vat_registration_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-F3CEC298
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_vat_reg_dtl_hotel_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->p_room_type_id->Errors->Count());
        $errors = ($errors || $this->rqst_type_code->Errors->Count());
        $errors = ($errors || $this->p_rqst_type_id->Errors->Count());
        $errors = ($errors || $this->t_customer_order_id->Errors->Count());
        $errors = ($errors || $this->service_charge_wd->Errors->Count());
        $errors = ($errors || $this->service_charge_we->Errors->Count());
        $errors = ($errors || $this->service_qty->Errors->Count());
        $errors = ($errors || $this->room_qty->Errors->Count());
        $errors = ($errors || $this->t_vat_registration_id->Errors->Count());
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

//Operation Method @94-7DE29AD7
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
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
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

//InsertRow Method @94-D353F279
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->p_room_type_id->SetValue($this->p_room_type_id->GetValue(true));
        $this->DataSource->room_qty->SetValue($this->room_qty->GetValue(true));
        $this->DataSource->service_charge_wd->SetValue($this->service_charge_wd->GetValue(true));
        $this->DataSource->service_qty->SetValue($this->service_qty->GetValue(true));
        $this->DataSource->service_charge_we->SetValue($this->service_charge_we->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-D17A9C47
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_vat_reg_dtl_hotel_id->SetValue($this->t_vat_reg_dtl_hotel_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->t_vat_registration_id->SetValue($this->t_vat_registration_id->GetValue(true));
        $this->DataSource->p_room_type_id->SetValue($this->p_room_type_id->GetValue(true));
        $this->DataSource->room_qty->SetValue($this->room_qty->GetValue(true));
        $this->DataSource->service_charge_wd->SetValue($this->service_charge_wd->GetValue(true));
        $this->DataSource->service_qty->SetValue($this->service_qty->GetValue(true));
        $this->DataSource->service_charge_we->SetValue($this->service_charge_we->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-9ED04198
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_vat_reg_dtl_hotel_id->SetValue($this->t_vat_reg_dtl_hotel_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-484EBF9E
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

        $this->p_room_type_id->Prepare();

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
                    $this->t_vat_reg_dtl_hotel_id->SetValue($this->DataSource->t_vat_reg_dtl_hotel_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->p_room_type_id->SetValue($this->DataSource->p_room_type_id->GetValue());
                    $this->service_charge_wd->SetValue($this->DataSource->service_charge_wd->GetValue());
                    $this->service_charge_we->SetValue($this->DataSource->service_charge_we->GetValue());
                    $this->service_qty->SetValue($this->DataSource->service_qty->GetValue());
                    $this->room_qty->SetValue($this->DataSource->room_qty->GetValue());
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
            $Error = ComposeStrings($Error, $this->t_vat_reg_dtl_hotel_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_room_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rqst_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_rqst_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_customer_order_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_charge_wd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_charge_we->Errors->ToString());
            $Error = ComposeStrings($Error, $this->service_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->room_qty->Errors->ToString());
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
        $this->t_vat_reg_dtl_hotel_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->p_room_type_id->Show();
        $this->rqst_type_code->Show();
        $this->p_rqst_type_id->Show();
        $this->t_customer_order_id->Show();
        $this->service_charge_wd->Show();
        $this->service_charge_we->Show();
        $this->service_qty->Show();
        $this->room_qty->Show();
        $this->t_vat_registration_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_vat_reg_dtl_hotelForm Class @94-FCB6E20C

class clst_vat_reg_dtl_hotelFormDataSource extends clsDBConnSIKP {  //t_vat_reg_dtl_hotelFormDataSource Class @94-9DEB1C05

//DataSource Variables @94-7EBB01FE
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
    var $t_vat_reg_dtl_hotel_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $p_room_type_id;
    var $rqst_type_code;
    var $p_rqst_type_id;
    var $t_customer_order_id;
    var $service_charge_wd;
    var $service_charge_we;
    var $service_qty;
    var $room_qty;
    var $t_vat_registration_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-DF18A938
    function clst_vat_reg_dtl_hotelFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_vat_reg_dtl_hotelForm/Error";
        $this->Initialize();
        $this->t_vat_reg_dtl_hotel_id = new clsField("t_vat_reg_dtl_hotel_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->p_room_type_id = new clsField("p_room_type_id", ccsFloat, "");
        
        $this->rqst_type_code = new clsField("rqst_type_code", ccsText, "");
        
        $this->p_rqst_type_id = new clsField("p_rqst_type_id", ccsFloat, "");
        
        $this->t_customer_order_id = new clsField("t_customer_order_id", ccsFloat, "");
        
        $this->service_charge_wd = new clsField("service_charge_wd", ccsFloat, "");
        
        $this->service_charge_we = new clsField("service_charge_we", ccsFloat, "");
        
        $this->service_qty = new clsField("service_qty", ccsFloat, "");
        
        $this->room_qty = new clsField("room_qty", ccsFloat, "");
        
        $this->t_vat_registration_id = new clsField("t_vat_registration_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-F4DD64C8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_vat_reg_dtl_hotel_id", ccsFloat, "", "", $this->Parameters["urlt_vat_reg_dtl_hotel_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_vat_reg_dtl_hotel_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @94-AE6B0845
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_vat_reg_dtl_hotel {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-B7F97233
    function SetValues()
    {
        $this->t_vat_reg_dtl_hotel_id->SetDBValue(trim($this->f("t_vat_reg_dtl_hotel_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->p_room_type_id->SetDBValue(trim($this->f("p_room_type_id")));
        $this->service_charge_wd->SetDBValue(trim($this->f("service_charge_wd")));
        $this->service_charge_we->SetDBValue(trim($this->f("service_charge_we")));
        $this->service_qty->SetDBValue(trim($this->f("service_qty")));
        $this->room_qty->SetDBValue(trim($this->f("room_qty")));
        $this->t_vat_registration_id->SetDBValue(trim($this->f("t_vat_registration_id")));
    }
//End SetValues Method

//Insert Method @94-A81A3801
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr712", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr713", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_vat_registration_id"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_room_type_id"] = new clsSQLParameter("ctrlp_room_type_id", ccsFloat, "", "", $this->p_room_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["room_qty"] = new clsSQLParameter("ctrlroom_qty", ccsFloat, "", "", $this->room_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_wd"] = new clsSQLParameter("ctrlservice_charge_wd", ccsFloat, "", "", $this->service_charge_wd->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["service_qty"] = new clsSQLParameter("ctrlservice_qty", ccsFloat, "", "", $this->service_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_we"] = new clsSQLParameter("ctrlservice_charge_we", ccsFloat, "", "", $this->service_charge_we->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_vat_registration_id"]->GetValue()) and !strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue())) 
            $this->cp["t_vat_registration_id"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!is_null($this->cp["p_room_type_id"]->GetValue()) and !strlen($this->cp["p_room_type_id"]->GetText()) and !is_bool($this->cp["p_room_type_id"]->GetValue())) 
            $this->cp["p_room_type_id"]->SetValue($this->p_room_type_id->GetValue(true));
        if (!is_null($this->cp["room_qty"]->GetValue()) and !strlen($this->cp["room_qty"]->GetText()) and !is_bool($this->cp["room_qty"]->GetValue())) 
            $this->cp["room_qty"]->SetValue($this->room_qty->GetValue(true));
        if (!is_null($this->cp["service_charge_wd"]->GetValue()) and !strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue())) 
            $this->cp["service_charge_wd"]->SetValue($this->service_charge_wd->GetValue(true));
        if (!strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue(true))) 
            $this->cp["service_charge_wd"]->SetText(0);
        if (!is_null($this->cp["service_qty"]->GetValue()) and !strlen($this->cp["service_qty"]->GetText()) and !is_bool($this->cp["service_qty"]->GetValue())) 
            $this->cp["service_qty"]->SetValue($this->service_qty->GetValue(true));
        if (!is_null($this->cp["service_charge_we"]->GetValue()) and !strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue())) 
            $this->cp["service_charge_we"]->SetValue($this->service_charge_we->GetValue(true));
        if (!strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue(true))) 
            $this->cp["service_charge_we"]->SetText(0);
        $this->SQL = "INSERT INTO t_vat_reg_dtl_hotel(t_vat_reg_dtl_hotel_id, description, created_by, updated_by, creation_date, updated_date, t_vat_registration_id, p_room_type_id, room_qty, service_charge_wd, service_charge_we, service_qty) \n" .
        "VALUES(generate_id('sikp','t_vat_reg_dtl_hotel','t_vat_reg_dtl_hotel_id'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, sysdate, " . $this->SQLValue($this->cp["t_vat_registration_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_room_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["room_qty"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["service_charge_wd"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["service_charge_we"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["service_qty"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-89D74681
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_reg_dtl_hotel_id"] = new clsSQLParameter("ctrlt_vat_reg_dtl_hotel_id", ccsFloat, "", "", $this->t_vat_reg_dtl_hotel_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr741", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["t_vat_registration_id"] = new clsSQLParameter("ctrlt_vat_registration_id", ccsFloat, "", "", $this->t_vat_registration_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_room_type_id"] = new clsSQLParameter("ctrlp_room_type_id", ccsFloat, "", "", $this->p_room_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["room_qty"] = new clsSQLParameter("ctrlroom_qty", ccsFloat, "", "", $this->room_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_wd"] = new clsSQLParameter("ctrlservice_charge_wd", ccsFloat, "", "", $this->service_charge_wd->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["service_qty"] = new clsSQLParameter("ctrlservice_qty", ccsFloat, "", "", $this->service_qty->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["service_charge_we"] = new clsSQLParameter("ctrlservice_charge_we", ccsFloat, "", "", $this->service_charge_we->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_vat_reg_dtl_hotel_id"]->GetValue()) and !strlen($this->cp["t_vat_reg_dtl_hotel_id"]->GetText()) and !is_bool($this->cp["t_vat_reg_dtl_hotel_id"]->GetValue())) 
            $this->cp["t_vat_reg_dtl_hotel_id"]->SetValue($this->t_vat_reg_dtl_hotel_id->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["t_vat_registration_id"]->GetValue()) and !strlen($this->cp["t_vat_registration_id"]->GetText()) and !is_bool($this->cp["t_vat_registration_id"]->GetValue())) 
            $this->cp["t_vat_registration_id"]->SetValue($this->t_vat_registration_id->GetValue(true));
        if (!is_null($this->cp["p_room_type_id"]->GetValue()) and !strlen($this->cp["p_room_type_id"]->GetText()) and !is_bool($this->cp["p_room_type_id"]->GetValue())) 
            $this->cp["p_room_type_id"]->SetValue($this->p_room_type_id->GetValue(true));
        if (!is_null($this->cp["room_qty"]->GetValue()) and !strlen($this->cp["room_qty"]->GetText()) and !is_bool($this->cp["room_qty"]->GetValue())) 
            $this->cp["room_qty"]->SetValue($this->room_qty->GetValue(true));
        if (!is_null($this->cp["service_charge_wd"]->GetValue()) and !strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue())) 
            $this->cp["service_charge_wd"]->SetValue($this->service_charge_wd->GetValue(true));
        if (!strlen($this->cp["service_charge_wd"]->GetText()) and !is_bool($this->cp["service_charge_wd"]->GetValue(true))) 
            $this->cp["service_charge_wd"]->SetText(0);
        if (!is_null($this->cp["service_qty"]->GetValue()) and !strlen($this->cp["service_qty"]->GetText()) and !is_bool($this->cp["service_qty"]->GetValue())) 
            $this->cp["service_qty"]->SetValue($this->service_qty->GetValue(true));
        if (!is_null($this->cp["service_charge_we"]->GetValue()) and !strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue())) 
            $this->cp["service_charge_we"]->SetValue($this->service_charge_we->GetValue(true));
        if (!strlen($this->cp["service_charge_we"]->GetText()) and !is_bool($this->cp["service_charge_we"]->GetValue(true))) 
            $this->cp["service_charge_we"]->SetText(0);
        $this->SQL = "UPDATE t_vat_reg_dtl_hotel SET \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "p_room_type_id=" . $this->SQLValue($this->cp["p_room_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "room_qty=" . $this->SQLValue($this->cp["room_qty"]->GetDBValue(), ccsFloat) . ", \n" .
        "service_charge_wd=" . $this->SQLValue($this->cp["service_charge_wd"]->GetDBValue(), ccsFloat) . ",\n" .
        "service_charge_we=" . $this->SQLValue($this->cp["service_charge_we"]->GetDBValue(), ccsFloat) . ", \n" .
        "service_qty=" . $this->SQLValue($this->cp["service_qty"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE t_vat_reg_dtl_hotel_id=" . $this->SQLValue($this->cp["t_vat_reg_dtl_hotel_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-569143E8
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_vat_reg_dtl_hotel_id"] = new clsSQLParameter("ctrlt_vat_reg_dtl_hotel_id", ccsFloat, "", "", $this->t_vat_reg_dtl_hotel_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_vat_reg_dtl_hotel_id"]->GetValue()) and !strlen($this->cp["t_vat_reg_dtl_hotel_id"]->GetText()) and !is_bool($this->cp["t_vat_reg_dtl_hotel_id"]->GetValue())) 
            $this->cp["t_vat_reg_dtl_hotel_id"]->SetValue($this->t_vat_reg_dtl_hotel_id->GetValue(true));
        if (!strlen($this->cp["t_vat_reg_dtl_hotel_id"]->GetText()) and !is_bool($this->cp["t_vat_reg_dtl_hotel_id"]->GetValue(true))) 
            $this->cp["t_vat_reg_dtl_hotel_id"]->SetText(0);
        $this->SQL = "DELETE FROM t_vat_reg_dtl_hotel\n" .
        "WHERE t_vat_reg_dtl_hotel_id = " . $this->SQLValue($this->cp["t_vat_reg_dtl_hotel_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End t_vat_reg_dtl_hotelFormDataSource Class @94-FCB6E20C

//Initialize Page @1-0DFB2A09
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
$TemplateFileName = "t_vat_reg_dtl_hotel_edit.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-186540D0
include_once("./t_vat_reg_dtl_hotel_edit_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C4335DEE
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_vat_reg_dtl_hotelForm = & new clsRecordt_vat_reg_dtl_hotelForm("", $MainPage);
$MainPage->t_vat_reg_dtl_hotelForm = & $t_vat_reg_dtl_hotelForm;
$t_vat_reg_dtl_hotelForm->Initialize();

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

//Execute Components @1-9E3D8E86
$t_vat_reg_dtl_hotelForm->Operation();
//End Execute Components

//Go to destination page @1-356B0F77
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_vat_reg_dtl_hotelForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0CD9A042
$t_vat_reg_dtl_hotelForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9C03B505
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_vat_reg_dtl_hotelForm);
unset($Tpl);
//End Unload Page


?>
