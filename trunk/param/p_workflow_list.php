<?php
//Include Common Files @1-0B76B4AE
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_workflow_list.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



class clsRecordp_workflowForm { //p_workflowForm Class @94-87F1157E

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

//Class_Initialize Event @94-D5909E59
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
            $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "Id", ccsFloat, "", CCGetRequestParam("p_workflow_id", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_workflowGridPage = & new clsControl(ccsHidden, "p_workflowGridPage", "p_workflowGridPage", ccsText, "", CCGetRequestParam("p_workflowGridPage", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Kode", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->cproc = & new clsControl(ccsTextBox, "cproc", "Prosedur", ccsText, "", CCGetRequestParam("cproc", $Method, NULL), $this);
            $this->cproc->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->document_name = & new clsControl(ccsTextBox, "document_name", "Tipe Dokumen", ccsText, "", CCGetRequestParam("document_name", $Method, NULL), $this);
            $this->is_active = & new clsControl(ccsListBox, "is_active", "Status", ccsText, "", CCGetRequestParam("is_active", $Method, NULL), $this);
            $this->is_active->DSType = dsListOfValues;
            $this->is_active->Values = array(array("Y", "AKTIF"), array("N", "TIDAK AKTIF"));
            $this->is_active->Required = true;
            $this->workflow_type = & new clsControl(ccsListBox, "workflow_type", "Kategori", ccsFloat, "", CCGetRequestParam("workflow_type", $Method, NULL), $this);
            $this->workflow_type->DSType = dsListOfValues;
            $this->workflow_type->Values = array(array("1", "PROCUREMENT & INVENTORY"), array("2", "NETWORK"));
            $this->workflow_type->Required = true;
            $this->p_document_type_id = & new clsControl(ccsHidden, "p_document_type_id", "p_document_type_id", ccsFloat, "", CCGetRequestParam("p_document_type_id", $Method, NULL), $this);
            $this->p_procedure_id = & new clsControl(ccsHidden, "p_procedure_id", "p_procedure_id", ccsFloat, "", CCGetRequestParam("p_procedure_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-1E4468C5
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_workflow_id"] = CCGetFromGet("p_workflow_id", NULL);
    }
//End Initialize Method

//Validate Method @94-5038F4D6
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_workflow_id->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_workflowGridPage->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->cproc->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->document_name->Validate() && $Validation);
        $Validation = ($this->is_active->Validate() && $Validation);
        $Validation = ($this->workflow_type->Validate() && $Validation);
        $Validation = ($this->p_document_type_id->Validate() && $Validation);
        $Validation = ($this->p_procedure_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_workflow_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_workflowGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cproc->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->document_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->workflow_type->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_document_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-C0798CC6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_workflow_id->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_workflowGridPage->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->cproc->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->document_name->Errors->Count());
        $errors = ($errors || $this->is_active->Errors->Count());
        $errors = ($errors || $this->workflow_type->Errors->Count());
        $errors = ($errors || $this->p_document_type_id->Errors->Count());
        $errors = ($errors || $this->p_procedure_id->Errors->Count());
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

//Operation Method @94-FEDBCE5C
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
            $Redirect = "p_wf_procedure.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_workflow_id", "s_keyword", "p_workflowGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "p_wf_procedure.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_workflow_id", "s_keyword", "p_workflowGridPage"));
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

//InsertRow Method @94-92450129
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->workflow_type->SetValue($this->workflow_type->GetValue(true));
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->p_procedure_id->SetValue($this->p_procedure_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-8D67D19C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_workflow_id->SetValue($this->p_workflow_id->GetValue(true));
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->workflow_type->SetValue($this->workflow_type->GetValue(true));
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->p_procedure_id->SetValue($this->p_procedure_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-2989BB9A
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_workflow_id->SetValue($this->p_workflow_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-EB2918EB
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

        $this->is_active->Prepare();
        $this->workflow_type->Prepare();

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
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->cproc->SetValue($this->DataSource->cproc->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->document_name->SetValue($this->DataSource->document_name->GetValue());
                    $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                    $this->workflow_type->SetValue($this->DataSource->workflow_type->GetValue());
                    $this->p_document_type_id->SetValue($this->DataSource->p_document_type_id->GetValue());
                    $this->p_procedure_id->SetValue($this->DataSource->p_procedure_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_workflowGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cproc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->document_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->workflow_type->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_document_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id->Errors->ToString());
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
        $this->updated_by->Show();
        $this->p_workflowGridPage->Show();
        $this->code->Show();
        $this->cproc->Show();
        $this->updated_date->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->description->Show();
        $this->document_name->Show();
        $this->is_active->Show();
        $this->workflow_type->Show();
        $this->p_document_type_id->Show();
        $this->p_procedure_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_workflowForm Class @94-FCB6E20C

class clsp_workflowFormDataSource extends clsDBConnSIKP {  //p_workflowFormDataSource Class @94-630780E3

//DataSource Variables @94-6FAFCCA5
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
    var $updated_by;
    var $p_workflowGridPage;
    var $code;
    var $cproc;
    var $updated_date;
    var $created_by;
    var $creation_date;
    var $description;
    var $document_name;
    var $is_active;
    var $workflow_type;
    var $p_document_type_id;
    var $p_procedure_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-D3982842
    function clsp_workflowFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_workflowForm/Error";
        $this->Initialize();
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_workflowGridPage = new clsField("p_workflowGridPage", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->cproc = new clsField("cproc", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->document_name = new clsField("document_name", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->workflow_type = new clsField("workflow_type", ccsFloat, "");
        
        $this->p_document_type_id = new clsField("p_document_type_id", ccsFloat, "");
        
        $this->p_procedure_id = new clsField("p_procedure_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-0DDB6937
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_workflow_id", ccsFloat, "", "", $this->Parameters["urlp_workflow_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @94-9ADCAD19
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_p_workflow {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-F912556A
    function SetValues()
    {
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->code->SetDBValue($this->f("code"));
        $this->cproc->SetDBValue($this->f("cproc"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->description->SetDBValue($this->f("description"));
        $this->document_name->SetDBValue($this->f("document_name"));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->workflow_type->SetDBValue(trim($this->f("workflow_type")));
        $this->p_document_type_id->SetDBValue(trim($this->f("p_document_type_id")));
        $this->p_procedure_id->SetDBValue(trim($this->f("p_procedure_id")));
    }
//End SetValues Method

//Insert Method @94-205A0BAC
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr657", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr661", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["workflow_type"] = new clsSQLParameter("ctrlworkflow_type", ccsFloat, "", "", $this->workflow_type->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id"] = new clsSQLParameter("ctrlp_procedure_id", ccsFloat, "", "", $this->p_procedure_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["workflow_type"]->GetValue()) and !strlen($this->cp["workflow_type"]->GetText()) and !is_bool($this->cp["workflow_type"]->GetValue())) 
            $this->cp["workflow_type"]->SetValue($this->workflow_type->GetValue(true));
        if (!strlen($this->cp["workflow_type"]->GetText()) and !is_bool($this->cp["workflow_type"]->GetValue(true))) 
            $this->cp["workflow_type"]->SetText(0);
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!is_null($this->cp["p_procedure_id"]->GetValue()) and !strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue())) 
            $this->cp["p_procedure_id"]->SetValue($this->p_procedure_id->GetValue(true));
        $this->SQL = "INSERT INTO p_workflow(p_workflow_id, updated_by, code, updated_date, created_by, creation_date, description, is_active, workflow_type, p_document_type_id, p_procedure_id) \n" .
        "VALUES(generate_id('sikp','p_workflow','p_workflow_id'), '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["workflow_type"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_procedure_id"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-06CB1877
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_workflow_id"] = new clsSQLParameter("ctrlp_workflow_id", ccsFloat, "", "", $this->p_workflow_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr683", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["workflow_type"] = new clsSQLParameter("ctrlworkflow_type", ccsFloat, "", "", $this->workflow_type->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_procedure_id"] = new clsSQLParameter("ctrlp_procedure_id", ccsFloat, "", "", $this->p_procedure_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_workflow_id"]->GetValue()) and !strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue())) 
            $this->cp["p_workflow_id"]->SetValue($this->p_workflow_id->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["workflow_type"]->GetValue()) and !strlen($this->cp["workflow_type"]->GetText()) and !is_bool($this->cp["workflow_type"]->GetValue())) 
            $this->cp["workflow_type"]->SetValue($this->workflow_type->GetValue(true));
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!is_null($this->cp["p_procedure_id"]->GetValue()) and !strlen($this->cp["p_procedure_id"]->GetText()) and !is_bool($this->cp["p_procedure_id"]->GetValue())) 
            $this->cp["p_procedure_id"]->SetValue($this->p_procedure_id->GetValue(true));
        $this->SQL = "UPDATE p_workflow SET  \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "is_active='" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', \n" .
        "workflow_type=" . $this->SQLValue($this->cp["workflow_type"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_document_type_id=" . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_procedure_id=" . $this->SQLValue($this->cp["p_procedure_id"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE p_workflow_id=" . $this->SQLValue($this->cp["p_workflow_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-990A7F3F
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_workflow_id"] = new clsSQLParameter("ctrlp_workflow_id", ccsFloat, "", "", $this->p_workflow_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_workflow_id"]->GetValue()) and !strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue())) 
            $this->cp["p_workflow_id"]->SetValue($this->p_workflow_id->GetValue(true));
        if (!strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue(true))) 
            $this->cp["p_workflow_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_workflow \n" .
        "WHERE  p_workflow_id = " . $this->SQLValue($this->cp["p_workflow_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_workflowFormDataSource Class @94-FCB6E20C

//Initialize Page @1-CD0635FD
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
$TemplateFileName = "p_workflow_list.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-97BA8668
include_once("./p_workflow_list_events.php");
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
