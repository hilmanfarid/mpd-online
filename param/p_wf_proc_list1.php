<?php
//Include Common Files @1-9BEB662A
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_wf_proc_list1.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordp_workflowForm { //p_workflowForm Class @67-87F1157E

//Variables @67-D6FF3E86

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

//Class_Initialize Event @67-0A691EC2
    function clsRecordp_workflowForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_workflowForm/Error";
        $this->DataSource = new clsp_workflowFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_workflowForm";
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
            $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", $Method, NULL), $this);
            $this->update_by = & new clsControl(ccsTextBox, "update_by", "Updated By", ccsText, "", CCGetRequestParam("update_by", $Method, NULL), $this);
            $this->p_workflowGridPage = & new clsControl(ccsHidden, "p_workflowGridPage", "p_workflowGridPage", ccsText, "", CCGetRequestParam("p_workflowGridPage", $Method, NULL), $this);
            $this->update_date = & new clsControl(ccsTextBox, "update_date", "Updated Date", ccsText, "", CCGetRequestParam("update_date", $Method, NULL), $this);
            $this->create_by = & new clsControl(ccsTextBox, "create_by", "Created By", ccsText, "", CCGetRequestParam("create_by", $Method, NULL), $this);
            $this->create_by->Required = true;
            $this->create_date = & new clsControl(ccsTextBox, "create_date", "Creation Date", ccsText, "", CCGetRequestParam("create_date", $Method, NULL), $this);
            $this->create_date->Required = true;
            $this->pekerjaan_prev = & new clsControl(ccsTextBox, "pekerjaan_prev", "Pekerjaan Sebelum", ccsText, "", CCGetRequestParam("pekerjaan_prev", $Method, NULL), $this);
            $this->pekerjaan_prev->Required = true;
            $this->p_procedure_id_prev = & new clsControl(ccsHidden, "p_procedure_id_prev", "p_procedure_id_prev", ccsFloat, "", CCGetRequestParam("p_procedure_id_prev", $Method, NULL), $this);
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "p_workflowForm", "valid_from", $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "p_workflowForm", "valid_to", $this);
            $this->p_w_chart_proc_id = & new clsControl(ccsHidden, "p_w_chart_proc_id", "p_w_chart_proc_id", ccsFloat, "", CCGetRequestParam("p_w_chart_proc_id", $Method, NULL), $this);
            $this->importance_level = & new clsControl(ccsListBox, "importance_level", "Init Sub", ccsText, "", CCGetRequestParam("importance_level", $Method, NULL), $this);
            $this->importance_level->DSType = dsListOfValues;
            $this->importance_level->Values = array(array("O", "OPSIONAL"), array("M", "WAJIB"));
            $this->importance_level->Required = true;
            $this->pekerjaan_next = & new clsControl(ccsTextBox, "pekerjaan_next", "Pekerjaan Sesudah", ccsText, "", CCGetRequestParam("pekerjaan_next", $Method, NULL), $this);
            $this->p_procedure_id_next = & new clsControl(ccsHidden, "p_procedure_id_next", "p_procedure_id_next", ccsFloat, "", CCGetRequestParam("p_procedure_id_next", $Method, NULL), $this);
            $this->f_init = & new clsControl(ccsTextBox, "f_init", "Fungsi Init Sub", ccsText, "", CCGetRequestParam("f_init", $Method, NULL), $this);
            $this->pekerjaan_alt = & new clsControl(ccsTextBox, "pekerjaan_alt", "Alternate (Dispatcher)", ccsText, "", CCGetRequestParam("pekerjaan_alt", $Method, NULL), $this);
            $this->p_procedure_id_alt = & new clsControl(ccsHidden, "p_procedure_id_alt", "p_procedure_id_alt", ccsFloat, "", CCGetRequestParam("p_procedure_id_alt", $Method, NULL), $this);
            $this->sequence_no = & new clsControl(ccsTextBox, "sequence_no", "No. Sequence", ccsFloat, "", CCGetRequestParam("sequence_no", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->update_by->Value) && !strlen($this->update_by->Value) && $this->update_by->Value !== false)
                    $this->update_by->SetText(CCGetUserLogin());
                if(!is_array($this->update_date->Value) && !strlen($this->update_date->Value) && $this->update_date->Value !== false)
                    $this->update_date->SetText(date("d-M-Y"));
                if(!is_array($this->create_by->Value) && !strlen($this->create_by->Value) && $this->create_by->Value !== false)
                    $this->create_by->SetText(CCGetUserLogin());
                if(!is_array($this->create_date->Value) && !strlen($this->create_date->Value) && $this->create_date->Value !== false)
                    $this->create_date->SetText(date("d-M-Y"));
                if(!is_array($this->valid_from->Value) && !strlen($this->valid_from->Value) && $this->valid_from->Value !== false)
                    $this->valid_from->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @67-F70212F3
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_workflow_id"] = CCGetFromGet("p_workflow_id", NULL);
        $this->DataSource->Parameters["urlp_w_chart_proc_id"] = CCGetFromGet("p_w_chart_proc_id", NULL);
        $this->DataSource->Parameters["urlp_procedure_id_prev"] = CCGetFromGet("p_procedure_id_prev", NULL);
    }
//End Initialize Method

//Validate Method @67-34139240
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_workflow_id->Validate() && $Validation);
        $Validation = ($this->update_by->Validate() && $Validation);
        $Validation = ($this->p_workflowGridPage->Validate() && $Validation);
        $Validation = ($this->update_date->Validate() && $Validation);
        $Validation = ($this->create_by->Validate() && $Validation);
        $Validation = ($this->create_date->Validate() && $Validation);
        $Validation = ($this->pekerjaan_prev->Validate() && $Validation);
        $Validation = ($this->p_procedure_id_prev->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $Validation = ($this->p_w_chart_proc_id->Validate() && $Validation);
        $Validation = ($this->importance_level->Validate() && $Validation);
        $Validation = ($this->pekerjaan_next->Validate() && $Validation);
        $Validation = ($this->p_procedure_id_next->Validate() && $Validation);
        $Validation = ($this->f_init->Validate() && $Validation);
        $Validation = ($this->pekerjaan_alt->Validate() && $Validation);
        $Validation = ($this->p_procedure_id_alt->Validate() && $Validation);
        $Validation = ($this->sequence_no->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_workflow_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_workflowGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->update_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->create_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->create_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pekerjaan_prev->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id_prev->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_w_chart_proc_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->importance_level->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pekerjaan_next->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id_next->Errors->Count() == 0);
        $Validation =  $Validation && ($this->f_init->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pekerjaan_alt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id_alt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sequence_no->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @67-07B6F983
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_workflow_id->Errors->Count());
        $errors = ($errors || $this->update_by->Errors->Count());
        $errors = ($errors || $this->p_workflowGridPage->Errors->Count());
        $errors = ($errors || $this->update_date->Errors->Count());
        $errors = ($errors || $this->create_by->Errors->Count());
        $errors = ($errors || $this->create_date->Errors->Count());
        $errors = ($errors || $this->pekerjaan_prev->Errors->Count());
        $errors = ($errors || $this->p_procedure_id_prev->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
        $errors = ($errors || $this->p_w_chart_proc_id->Errors->Count());
        $errors = ($errors || $this->importance_level->Errors->Count());
        $errors = ($errors || $this->pekerjaan_next->Errors->Count());
        $errors = ($errors || $this->p_procedure_id_next->Errors->Count());
        $errors = ($errors || $this->f_init->Errors->Count());
        $errors = ($errors || $this->pekerjaan_alt->Errors->Count());
        $errors = ($errors || $this->p_procedure_id_alt->Errors->Count());
        $errors = ($errors || $this->sequence_no->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @67-ED598703
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

//Operation Method @67-DDC5F59A
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
            $Redirect = "p_wf_procedure.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "p_wf_procedure.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "p_wf_procedure.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "p_wf_procedure.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG"));
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

//InsertRow Method @67-6E5D0260
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->p_workflow_id->SetValue($this->p_workflow_id->GetValue(true));
        $this->DataSource->p_procedure_id_prev->SetValue($this->p_procedure_id_prev->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->p_w_chart_proc_id->SetValue($this->p_w_chart_proc_id->GetValue(true));
        $this->DataSource->importance_level->SetValue($this->importance_level->GetValue(true));
        $this->DataSource->p_procedure_id_next->SetValue($this->p_procedure_id_next->GetValue(true));
        $this->DataSource->f_init->SetValue($this->f_init->GetValue(true));
        $this->DataSource->p_procedure_id_alt->SetValue($this->p_procedure_id_alt->GetValue(true));
        $this->DataSource->sequence_no->SetValue($this->sequence_no->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @67-B4C58557
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_workflow_id->SetValue($this->p_workflow_id->GetValue(true));
        $this->DataSource->p_procedure_id_prev->SetValue($this->p_procedure_id_prev->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->p_w_chart_proc_id->SetValue($this->p_w_chart_proc_id->GetValue(true));
        $this->DataSource->importance_level->SetValue($this->importance_level->GetValue(true));
        $this->DataSource->p_procedure_id_next->SetValue($this->p_procedure_id_next->GetValue(true));
        $this->DataSource->f_init->SetValue($this->f_init->GetValue(true));
        $this->DataSource->p_procedure_id_alt->SetValue($this->p_procedure_id_alt->GetValue(true));
        $this->DataSource->sequence_no->SetValue($this->sequence_no->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @67-A58E121C
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_w_chart_proc_id->SetValue($this->p_w_chart_proc_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @67-5451A139
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

        $this->importance_level->Prepare();

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
                    $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                    $this->update_by->SetValue($this->DataSource->update_by->GetValue());
                    $this->update_date->SetValue($this->DataSource->update_date->GetValue());
                    $this->create_by->SetValue($this->DataSource->create_by->GetValue());
                    $this->create_date->SetValue($this->DataSource->create_date->GetValue());
                    $this->pekerjaan_prev->SetValue($this->DataSource->pekerjaan_prev->GetValue());
                    $this->p_procedure_id_prev->SetValue($this->DataSource->p_procedure_id_prev->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                    $this->p_w_chart_proc_id->SetValue($this->DataSource->p_w_chart_proc_id->GetValue());
                    $this->importance_level->SetValue($this->DataSource->importance_level->GetValue());
                    $this->pekerjaan_next->SetValue($this->DataSource->pekerjaan_next->GetValue());
                    $this->p_procedure_id_next->SetValue($this->DataSource->p_procedure_id_next->GetValue());
                    $this->f_init->SetValue($this->DataSource->f_init->GetValue());
                    $this->pekerjaan_alt->SetValue($this->DataSource->pekerjaan_alt->GetValue());
                    $this->p_procedure_id_alt->SetValue($this->DataSource->p_procedure_id_alt->GetValue());
                    $this->sequence_no->SetValue($this->DataSource->sequence_no->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_workflow_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_workflowGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->update_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->create_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->create_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pekerjaan_prev->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id_prev->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_w_chart_proc_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->importance_level->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pekerjaan_next->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id_next->Errors->ToString());
            $Error = ComposeStrings($Error, $this->f_init->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pekerjaan_alt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id_alt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sequence_no->Errors->ToString());
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
        $this->p_workflow_id->Show();
        $this->update_by->Show();
        $this->p_workflowGridPage->Show();
        $this->update_date->Show();
        $this->create_by->Show();
        $this->create_date->Show();
        $this->pekerjaan_prev->Show();
        $this->p_procedure_id_prev->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $this->p_w_chart_proc_id->Show();
        $this->importance_level->Show();
        $this->pekerjaan_next->Show();
        $this->p_procedure_id_next->Show();
        $this->f_init->Show();
        $this->pekerjaan_alt->Show();
        $this->p_procedure_id_alt->Show();
        $this->sequence_no->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_workflowForm Class @67-FCB6E20C

class clsp_workflowFormDataSource extends clsDBConnSIKP {  //p_workflowFormDataSource Class @67-630780E3

//DataSource Variables @67-AFF14896
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
    var $p_workflow_id;
    var $update_by;
    var $p_workflowGridPage;
    var $update_date;
    var $create_by;
    var $create_date;
    var $pekerjaan_prev;
    var $p_procedure_id_prev;
    var $valid_from;
    var $valid_to;
    var $p_w_chart_proc_id;
    var $importance_level;
    var $pekerjaan_next;
    var $p_procedure_id_next;
    var $f_init;
    var $pekerjaan_alt;
    var $p_procedure_id_alt;
    var $sequence_no;
//End DataSource Variables

//DataSourceClass_Initialize Event @67-EB2B2157
    function clsp_workflowFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_workflowForm/Error";
        $this->Initialize();
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->update_by = new clsField("update_by", ccsText, "");
        
        $this->p_workflowGridPage = new clsField("p_workflowGridPage", ccsText, "");
        
        $this->update_date = new clsField("update_date", ccsText, "");
        
        $this->create_by = new clsField("create_by", ccsText, "");
        
        $this->create_date = new clsField("create_date", ccsText, "");
        
        $this->pekerjaan_prev = new clsField("pekerjaan_prev", ccsText, "");
        
        $this->p_procedure_id_prev = new clsField("p_procedure_id_prev", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->p_w_chart_proc_id = new clsField("p_w_chart_proc_id", ccsFloat, "");
        
        $this->importance_level = new clsField("importance_level", ccsText, "");
        
        $this->pekerjaan_next = new clsField("pekerjaan_next", ccsText, "");
        
        $this->p_procedure_id_next = new clsField("p_procedure_id_next", ccsFloat, "");
        
        $this->f_init = new clsField("f_init", ccsText, "");
        
        $this->pekerjaan_alt = new clsField("pekerjaan_alt", ccsText, "");
        
        $this->p_procedure_id_alt = new clsField("p_procedure_id_alt", ccsFloat, "");
        
        $this->sequence_no = new clsField("sequence_no", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @67-D4C31493
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_workflow_id", ccsFloat, "", "", $this->Parameters["urlp_workflow_id"], "", false);
        $this->wp->AddParameter("2", "urlp_w_chart_proc_id", ccsFloat, "", "", $this->Parameters["urlp_w_chart_proc_id"], "", false);
        $this->wp->AddParameter("3", "urlp_procedure_id_prev", ccsFloat, "", "", $this->Parameters["urlp_procedure_id_prev"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "p_w_chart_proc_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "p_procedure_id_prev", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @67-BF2F92E0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_wf_chart_edit {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @67-6FCD5AAE
    function SetValues()
    {
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->update_by->SetDBValue($this->f("update_by"));
        $this->update_date->SetDBValue($this->f("update_date"));
        $this->create_by->SetDBValue($this->f("create_by"));
        $this->create_date->SetDBValue($this->f("create_date"));
        $this->pekerjaan_prev->SetDBValue($this->f("pekerjaan_prev"));
        $this->p_procedure_id_prev->SetDBValue(trim($this->f("p_procedure_id_prev")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->p_w_chart_proc_id->SetDBValue(trim($this->f("p_w_chart_proc_id")));
        $this->importance_level->SetDBValue($this->f("importance_level"));
        $this->pekerjaan_next->SetDBValue($this->f("pekerjaan_next"));
        $this->p_procedure_id_next->SetDBValue(trim($this->f("p_procedure_id_next")));
        $this->f_init->SetDBValue($this->f("f_init"));
        $this->pekerjaan_alt->SetDBValue($this->f("pekerjaan_alt"));
        $this->p_procedure_id_alt->SetDBValue(trim($this->f("p_procedure_id_alt")));
        $this->sequence_no->SetDBValue(trim($this->f("sequence_no")));
    }
//End SetValues Method

//Insert Method @67-1F3946C2
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_workflow_id"] = new clsSQLParameter("ctrlp_workflow_id", ccsFloat, "", "", $this->p_workflow_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("expr200", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["create_by"] = new clsSQLParameter("expr202", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id_prev"] = new clsSQLParameter("ctrlp_procedure_id_prev", ccsFloat, "", "", $this->p_procedure_id_prev->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_w_chart_proc_id"] = new clsSQLParameter("ctrlp_w_chart_proc_id", ccsFloat, "", "", $this->p_w_chart_proc_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["importance_level"] = new clsSQLParameter("ctrlimportance_level", ccsText, "", "", $this->importance_level->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id_next"] = new clsSQLParameter("ctrlp_procedure_id_next", ccsFloat, "", "", $this->p_procedure_id_next->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["f_init"] = new clsSQLParameter("ctrlf_init", ccsText, "", "", $this->f_init->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id_alt"] = new clsSQLParameter("ctrlp_procedure_id_alt", ccsFloat, "", "", $this->p_procedure_id_alt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["sequence_no"] = new clsSQLParameter("ctrlsequence_no", ccsFloat, "", "", $this->sequence_no->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["p_workflow_id"]->GetValue()) and !strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue())) 
            $this->cp["p_workflow_id"]->SetValue($this->p_workflow_id->GetValue(true));
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["create_by"]->GetValue()) and !strlen($this->cp["create_by"]->GetText()) and !is_bool($this->cp["create_by"]->GetValue())) 
            $this->cp["create_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_procedure_id_prev"]->GetValue()) and !strlen($this->cp["p_procedure_id_prev"]->GetText()) and !is_bool($this->cp["p_procedure_id_prev"]->GetValue())) 
            $this->cp["p_procedure_id_prev"]->SetValue($this->p_procedure_id_prev->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_prev"]->GetText()) and !is_bool($this->cp["p_procedure_id_prev"]->GetValue(true))) 
            $this->cp["p_procedure_id_prev"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["p_w_chart_proc_id"]->GetValue()) and !strlen($this->cp["p_w_chart_proc_id"]->GetText()) and !is_bool($this->cp["p_w_chart_proc_id"]->GetValue())) 
            $this->cp["p_w_chart_proc_id"]->SetValue($this->p_w_chart_proc_id->GetValue(true));
        if (!is_null($this->cp["importance_level"]->GetValue()) and !strlen($this->cp["importance_level"]->GetText()) and !is_bool($this->cp["importance_level"]->GetValue())) 
            $this->cp["importance_level"]->SetValue($this->importance_level->GetValue(true));
        if (!is_null($this->cp["p_procedure_id_next"]->GetValue()) and !strlen($this->cp["p_procedure_id_next"]->GetText()) and !is_bool($this->cp["p_procedure_id_next"]->GetValue())) 
            $this->cp["p_procedure_id_next"]->SetValue($this->p_procedure_id_next->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_next"]->GetText()) and !is_bool($this->cp["p_procedure_id_next"]->GetValue(true))) 
            $this->cp["p_procedure_id_next"]->SetText(0);
        if (!is_null($this->cp["f_init"]->GetValue()) and !strlen($this->cp["f_init"]->GetText()) and !is_bool($this->cp["f_init"]->GetValue())) 
            $this->cp["f_init"]->SetValue($this->f_init->GetValue(true));
        if (!is_null($this->cp["p_procedure_id_alt"]->GetValue()) and !strlen($this->cp["p_procedure_id_alt"]->GetText()) and !is_bool($this->cp["p_procedure_id_alt"]->GetValue())) 
            $this->cp["p_procedure_id_alt"]->SetValue($this->p_procedure_id_alt->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_alt"]->GetText()) and !is_bool($this->cp["p_procedure_id_alt"]->GetValue(true))) 
            $this->cp["p_procedure_id_alt"]->SetText(0);
        if (!is_null($this->cp["sequence_no"]->GetValue()) and !strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue())) 
            $this->cp["sequence_no"]->SetValue($this->sequence_no->GetValue(true));
        if (!strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue(true))) 
            $this->cp["sequence_no"]->SetText(0);
        $this->SQL = "INSERT INTO p_w_chart_proc(p_workflow_id, update_by, create_by, p_procedure_id_prev, valid_from, valid_to, p_w_chart_proc_id, importance_level, p_procedure_id_next, f_init, p_procedure_id_alt, create_date, update_date, sequence_no) \n" .
        "VALUES(" . $this->SQLValue($this->cp["p_workflow_id"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["update_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["create_by"]->GetDBValue(), ccsText) . "', decode(" . $this->SQLValue($this->cp["p_procedure_id_prev"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_procedure_id_prev"]->GetDBValue(), ccsFloat) . "), to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end, generate_id('sikp','p_w_chart_proc','p_w_chart_proc_id'), '" . $this->SQLValue($this->cp["importance_level"]->GetDBValue(), ccsText) . "', decode(" . $this->SQLValue($this->cp["p_procedure_id_next"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_procedure_id_next"]->GetDBValue(), ccsFloat) . "), '" . $this->SQLValue($this->cp["f_init"]->GetDBValue(), ccsText) . "', decode(" . $this->SQLValue($this->cp["p_procedure_id_alt"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_procedure_id_alt"]->GetDBValue(), ccsFloat) . "), sysdate, sysdate, decode(" . $this->SQLValue($this->cp["sequence_no"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["sequence_no"]->GetDBValue(), ccsFloat) . "))";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @67-B6D68FA2
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_workflow_id"] = new clsSQLParameter("ctrlp_workflow_id", ccsFloat, "", "", $this->p_workflow_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["update_by"] = new clsSQLParameter("expr232", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id_prev"] = new clsSQLParameter("ctrlp_procedure_id_prev", ccsFloat, "", "", $this->p_procedure_id_prev->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_w_chart_proc_id"] = new clsSQLParameter("ctrlp_w_chart_proc_id", ccsFloat, "", "", $this->p_w_chart_proc_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["importance_level"] = new clsSQLParameter("ctrlimportance_level", ccsText, "", "", $this->importance_level->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id_next"] = new clsSQLParameter("ctrlp_procedure_id_next", ccsFloat, "", "", $this->p_procedure_id_next->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["f_init"] = new clsSQLParameter("ctrlf_init", ccsText, "", "", $this->f_init->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id_alt"] = new clsSQLParameter("ctrlp_procedure_id_alt", ccsFloat, "", "", $this->p_procedure_id_alt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["sequence_no"] = new clsSQLParameter("ctrlsequence_no", ccsFloat, "", "", $this->sequence_no->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_workflow_id"]->GetValue()) and !strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue())) 
            $this->cp["p_workflow_id"]->SetValue($this->p_workflow_id->GetValue(true));
        if (!is_null($this->cp["update_by"]->GetValue()) and !strlen($this->cp["update_by"]->GetText()) and !is_bool($this->cp["update_by"]->GetValue())) 
            $this->cp["update_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_procedure_id_prev"]->GetValue()) and !strlen($this->cp["p_procedure_id_prev"]->GetText()) and !is_bool($this->cp["p_procedure_id_prev"]->GetValue())) 
            $this->cp["p_procedure_id_prev"]->SetValue($this->p_procedure_id_prev->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_prev"]->GetText()) and !is_bool($this->cp["p_procedure_id_prev"]->GetValue(true))) 
            $this->cp["p_procedure_id_prev"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["p_w_chart_proc_id"]->GetValue()) and !strlen($this->cp["p_w_chart_proc_id"]->GetText()) and !is_bool($this->cp["p_w_chart_proc_id"]->GetValue())) 
            $this->cp["p_w_chart_proc_id"]->SetValue($this->p_w_chart_proc_id->GetValue(true));
        if (!is_null($this->cp["importance_level"]->GetValue()) and !strlen($this->cp["importance_level"]->GetText()) and !is_bool($this->cp["importance_level"]->GetValue())) 
            $this->cp["importance_level"]->SetValue($this->importance_level->GetValue(true));
        if (!is_null($this->cp["p_procedure_id_next"]->GetValue()) and !strlen($this->cp["p_procedure_id_next"]->GetText()) and !is_bool($this->cp["p_procedure_id_next"]->GetValue())) 
            $this->cp["p_procedure_id_next"]->SetValue($this->p_procedure_id_next->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_next"]->GetText()) and !is_bool($this->cp["p_procedure_id_next"]->GetValue(true))) 
            $this->cp["p_procedure_id_next"]->SetText(0);
        if (!is_null($this->cp["f_init"]->GetValue()) and !strlen($this->cp["f_init"]->GetText()) and !is_bool($this->cp["f_init"]->GetValue())) 
            $this->cp["f_init"]->SetValue($this->f_init->GetValue(true));
        if (!is_null($this->cp["p_procedure_id_alt"]->GetValue()) and !strlen($this->cp["p_procedure_id_alt"]->GetText()) and !is_bool($this->cp["p_procedure_id_alt"]->GetValue())) 
            $this->cp["p_procedure_id_alt"]->SetValue($this->p_procedure_id_alt->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_alt"]->GetText()) and !is_bool($this->cp["p_procedure_id_alt"]->GetValue(true))) 
            $this->cp["p_procedure_id_alt"]->SetText(0);
        if (!is_null($this->cp["sequence_no"]->GetValue()) and !strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue())) 
            $this->cp["sequence_no"]->SetValue($this->sequence_no->GetValue(true));
        if (!strlen($this->cp["sequence_no"]->GetText()) and !is_bool($this->cp["sequence_no"]->GetValue(true))) 
            $this->cp["sequence_no"]->SetText(0);
        $this->SQL = "UPDATE p_w_chart_proc SET \n" .
        "p_workflow_id=" . $this->SQLValue($this->cp["p_workflow_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "update_by='" . $this->SQLValue($this->cp["update_by"]->GetDBValue(), ccsText) . "', \n" .
        "update_date=sysdate,\n" .
        "p_procedure_id_prev=decode(" . $this->SQLValue($this->cp["p_procedure_id_prev"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_procedure_id_prev"]->GetDBValue(), ccsFloat) . "), \n" .
        "valid_from=to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "valid_to=case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end,  \n" .
        "importance_level='" . $this->SQLValue($this->cp["importance_level"]->GetDBValue(), ccsText) . "', \n" .
        "p_procedure_id_next=decode(" . $this->SQLValue($this->cp["p_procedure_id_next"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_procedure_id_next"]->GetDBValue(), ccsFloat) . "), \n" .
        "f_init='" . $this->SQLValue($this->cp["f_init"]->GetDBValue(), ccsText) . "', \n" .
        "sequence_no=decode(" . $this->SQLValue($this->cp["sequence_no"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["sequence_no"]->GetDBValue(), ccsFloat) . "),\n" .
        "p_procedure_id_alt=decode(" . $this->SQLValue($this->cp["p_procedure_id_alt"]->GetDBValue(), ccsFloat) . ",0,null," . $this->SQLValue($this->cp["p_procedure_id_alt"]->GetDBValue(), ccsFloat) . ")\n" .
        "WHERE p_w_chart_proc_id=" . $this->SQLValue($this->cp["p_w_chart_proc_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @67-A00FC350
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_w_chart_proc_id"] = new clsSQLParameter("ctrlp_w_chart_proc_id", ccsFloat, "", "", $this->p_w_chart_proc_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_w_chart_proc_id"]->GetValue()) and !strlen($this->cp["p_w_chart_proc_id"]->GetText()) and !is_bool($this->cp["p_w_chart_proc_id"]->GetValue())) 
            $this->cp["p_w_chart_proc_id"]->SetValue($this->p_w_chart_proc_id->GetValue(true));
        if (!strlen($this->cp["p_w_chart_proc_id"]->GetText()) and !is_bool($this->cp["p_w_chart_proc_id"]->GetValue(true))) 
            $this->cp["p_w_chart_proc_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_w_chart_proc \n" .
        "WHERE  p_w_chart_proc_id = " . $this->SQLValue($this->cp["p_w_chart_proc_id"]->GetDBValue(), ccsFloat) . " ";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_workflowFormDataSource Class @67-FCB6E20C

//Initialize Page @1-31FEA0C2
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
$TemplateFileName = "p_wf_proc_list1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C90D306A
include_once("./p_wf_proc_list1_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5283F481
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_workflowForm = & new clsRecordp_workflowForm("", $MainPage);
$MainPage->p_workflowForm = & $p_workflowForm;
$p_workflowForm->Initialize();

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

//Execute Components @1-E1791A4F
$p_workflowForm->Operation();
//End Execute Components

//Go to destination page @1-5DB1D45D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_workflowForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-10621436
$p_workflowForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-37C81CC7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_workflowForm);
unset($Tpl);
//End Unload Page


?>
