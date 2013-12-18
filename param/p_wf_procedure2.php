<?php
//Include Common Files @1-F5D048F4
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_wf_procedure2.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_workflowGrid { //p_workflowGrid class @2-D59A58B0

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

//Class_Initialize Event @2-E0E15BE3
    function clsGridp_workflowGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_workflowGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_workflowGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_workflowGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_wf_procedure2.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->workflow_type_code = & new clsControl(ccsLabel, "workflow_type_code", "workflow_type_code", ccsText, "", CCGetRequestParam("workflow_type_code", ccsGet, NULL), $this);
        $this->document_name = & new clsControl(ccsLabel, "document_name", "document_name", ccsText, "", CCGetRequestParam("document_name", ccsGet, NULL), $this);
        $this->cproc = & new clsControl(ccsLabel, "cproc", "cproc", ccsText, "", CCGetRequestParam("cproc", ccsGet, NULL), $this);
        $this->is_active_code = & new clsControl(ccsLabel, "is_active_code", "is_active_code", ccsText, "", CCGetRequestParam("is_active_code", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "p_workflow_list.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button1 = & new clsButton("Button1", ccsGet, $this);
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

//Show Method @2-66758A3E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


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
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_workflow_id"] = $this->p_workflow_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["workflow_type_code"] = $this->workflow_type_code->Visible;
            $this->ControlsVisible["document_name"] = $this->document_name->Visible;
            $this->ControlsVisible["cproc"] = $this->cproc->Visible;
            $this->ControlsVisible["is_active_code"] = $this->is_active_code->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->workflow_type_code->SetValue($this->DataSource->workflow_type_code->GetValue());
                $this->document_name->SetValue($this->DataSource->document_name->GetValue());
                $this->cproc->SetValue($this->DataSource->cproc->GetValue());
                $this->is_active_code->SetValue($this->DataSource->is_active_code->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->p_workflow_id->Show();
                $this->description->Show();
                $this->workflow_type_code->Show();
                $this->document_name->Show();
                $this->cproc->Show();
                $this->is_active_code->Show();
                $this->ImageLink1->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Navigator->Show();
        $this->Button1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-1CE51199
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_workflow_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->workflow_type_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->document_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cproc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_active_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_workflowGrid Class @2-FCB6E20C

class clsp_workflowGridDataSource extends clsDBConnSIKP {  //p_workflowGridDataSource Class @2-3C301617

//DataSource Variables @2-A467B8A8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $p_workflow_id;
    var $description;
    var $workflow_type_code;
    var $document_name;
    var $cproc;
    var $is_active_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C1910F1B
    function clsp_workflowGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_workflowGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->workflow_type_code = new clsField("workflow_type_code", ccsText, "");
        
        $this->document_name = new clsField("document_name", ccsText, "");
        
        $this->cproc = new clsField("cproc", ccsText, "");
        
        $this->is_active_code = new clsField("is_active_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-23C74536
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_workflow_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-0DD16228
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("4", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "upper(code)", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "upper(workflow_type_code)", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "upper(cproc)", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "upper(document_name)", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opOR(
             true, $this->wp->opOR(
             false, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @2-3A2D267C
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_p_workflow";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_p_workflow {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C3DECA65
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->workflow_type_code->SetDBValue($this->f("workflow_type_code"));
        $this->document_name->SetDBValue($this->f("document_name"));
        $this->cproc->SetDBValue($this->f("cproc"));
        $this->is_active_code->SetDBValue($this->f("is_active_code"));
    }
//End SetValues Method

} //End p_workflowGridDataSource Class @2-FCB6E20C

class clsRecordp_workflowSearch { //p_workflowSearch Class @3-5E39A4DA

//Variables @3-D6FF3E86

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

//Class_Initialize Event @3-1D12E3E3
    function clsRecordp_workflowSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_workflowSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_workflowSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-D6729123
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-801C2405
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "p_wf_procedure2.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_wf_procedure2.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9830B7FB
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_DoSearch->Show();
        $this->s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_workflowSearch Class @3-FCB6E20C

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

//Class_Initialize Event @94-F754A3A4
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
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_workflowGridPage = & new clsControl(ccsHidden, "p_workflowGridPage", "p_workflowGridPage", ccsText, "", CCGetRequestParam("p_workflowGridPage", $Method, NULL), $this);
            $this->next_proc_code = & new clsControl(ccsTextBox, "next_proc_code", "Prosedur Sesudah", ccsText, "", CCGetRequestParam("next_proc_code", $Method, NULL), $this);
            $this->next_proc_code->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->prev_proc_code = & new clsControl(ccsTextBox, "prev_proc_code", "Prosedur Sebelum", ccsText, "", CCGetRequestParam("prev_proc_code", $Method, NULL), $this);
            $this->prev_procedure_id = & new clsControl(ccsHidden, "prev_procedure_id", "prev_procedure_id", ccsFloat, "", CCGetRequestParam("prev_procedure_id", $Method, NULL), $this);
            $this->next_procedure_id = & new clsControl(ccsHidden, "next_procedure_id", "next_procedure_id", ccsFloat, "", CCGetRequestParam("next_procedure_id", $Method, NULL), $this);
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "p_workflowForm", "valid_from", $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "p_workflowForm", "valid_to", $this);
            $this->p_wf_procedure_id = & new clsControl(ccsHidden, "p_wf_procedure_id", "p_wf_procedure_id", ccsFloat, "", CCGetRequestParam("p_wf_procedure_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->valid_from->Value) && !strlen($this->valid_from->Value) && $this->valid_from->Value !== false)
                    $this->valid_from->SetText(date("d-M-Y"));
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-AD31CEF0
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_workflow_id"] = CCGetFromGet("p_workflow_id", NULL);
        $this->DataSource->Parameters["urlprev_procedure_id"] = CCGetFromGet("prev_procedure_id", NULL);
    }
//End Initialize Method

//Validate Method @94-024E4E4C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_workflow_id->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_workflowGridPage->Validate() && $Validation);
        $Validation = ($this->next_proc_code->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->prev_proc_code->Validate() && $Validation);
        $Validation = ($this->prev_procedure_id->Validate() && $Validation);
        $Validation = ($this->next_procedure_id->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $Validation = ($this->p_wf_procedure_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_workflow_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_workflowGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->next_proc_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->prev_proc_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->prev_procedure_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->next_procedure_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_wf_procedure_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-EE7E9D60
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_workflow_id->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_workflowGridPage->Errors->Count());
        $errors = ($errors || $this->next_proc_code->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->prev_proc_code->Errors->Count());
        $errors = ($errors || $this->prev_procedure_id->Errors->Count());
        $errors = ($errors || $this->next_procedure_id->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
        $errors = ($errors || $this->p_wf_procedure_id->Errors->Count());
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

//Operation Method @94-3CCA1D60
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_workflow_id", "s_keyword", "p_workflowGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_workflow_id", "s_keyword", "p_workflowGridPage"));
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

//Show Method @94-9E059D9F
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
                    $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->next_proc_code->SetValue($this->DataSource->next_proc_code->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->prev_proc_code->SetValue($this->DataSource->prev_proc_code->GetValue());
                    $this->prev_procedure_id->SetValue($this->DataSource->prev_procedure_id->GetValue());
                    $this->next_procedure_id->SetValue($this->DataSource->next_procedure_id->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                    $this->p_wf_procedure_id->SetValue($this->DataSource->p_wf_procedure_id->GetValue());
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
            $Error = ComposeStrings($Error, $this->next_proc_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->prev_proc_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->prev_procedure_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->next_procedure_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_wf_procedure_id->Errors->ToString());
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
        $this->next_proc_code->Show();
        $this->updated_date->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->prev_proc_code->Show();
        $this->prev_procedure_id->Show();
        $this->next_procedure_id->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $this->p_wf_procedure_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_workflowForm Class @94-FCB6E20C

class clsp_workflowFormDataSource extends clsDBConnSIKP {  //p_workflowFormDataSource Class @94-630780E3

//DataSource Variables @94-8825290E
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
    var $next_proc_code;
    var $updated_date;
    var $created_by;
    var $creation_date;
    var $prev_proc_code;
    var $prev_procedure_id;
    var $next_procedure_id;
    var $valid_from;
    var $valid_to;
    var $p_wf_procedure_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-7CFAAB20
    function clsp_workflowFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_workflowForm/Error";
        $this->Initialize();
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_workflowGridPage = new clsField("p_workflowGridPage", ccsText, "");
        
        $this->next_proc_code = new clsField("next_proc_code", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->prev_proc_code = new clsField("prev_proc_code", ccsText, "");
        
        $this->prev_procedure_id = new clsField("prev_procedure_id", ccsFloat, "");
        
        $this->next_procedure_id = new clsField("next_procedure_id", ccsFloat, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->p_wf_procedure_id = new clsField("p_wf_procedure_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-B5AC3111
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_workflow_id", ccsFloat, "", "", $this->Parameters["urlp_workflow_id"], "", false);
        $this->wp->AddParameter("2", "urlprev_procedure_id", ccsFloat, "", "", $this->Parameters["urlprev_procedure_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "prev_procedure_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @94-7126FFBD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_p_wf_procedure {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-D534BC7A
    function SetValues()
    {
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->next_proc_code->SetDBValue($this->f("next_proc_code"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->prev_proc_code->SetDBValue($this->f("prev_proc_code"));
        $this->prev_procedure_id->SetDBValue(trim($this->f("prev_procedure_id")));
        $this->next_procedure_id->SetDBValue(trim($this->f("next_procedure_id")));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->p_wf_procedure_id->SetDBValue(trim($this->f("p_wf_procedure_id")));
    }
//End SetValues Method

//Insert Method @94-0FECBDB7
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr644", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr646", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
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

//Update Method @94-78C03E8C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_workflow_id"] = new clsSQLParameter("ctrlp_workflow_id", ccsFloat, "", "", $this->p_workflow_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr666", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
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

class clsGridp_wf_procmasterGrid { //p_wf_procmasterGrid class @688-231E5DA3

//Variables @688-AC1EDBB9

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

//Class_Initialize Event @688-BF381635
    function clsGridp_wf_procmasterGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_wf_procmasterGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_wf_procmasterGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_wf_procmasterGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->DLink2 = & new clsControl(ccsLink, "DLink2", "DLink2", ccsText, "", CCGetRequestParam("DLink2", ccsGet, NULL), $this);
        $this->DLink2->HTML = true;
        $this->DLink2->Page = "p_wf_procedure2.php";
        $this->prev_proc_code = & new clsControl(ccsLabel, "prev_proc_code", "prev_proc_code", ccsText, "", CCGetRequestParam("prev_proc_code", ccsGet, NULL), $this);
        $this->prev_procedure_id = & new clsControl(ccsHidden, "prev_procedure_id", "prev_procedure_id", ccsFloat, "", CCGetRequestParam("prev_procedure_id", ccsGet, NULL), $this);
        $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link2 = & new clsControl(ccsLink, "Insert_Link2", "Insert_Link2", ccsText, "", CCGetRequestParam("Insert_Link2", ccsGet, NULL), $this);
        $this->Insert_Link2->Page = "p_wf_proc_list1.php";
    }
//End Class_Initialize Event

//Initialize Method @688-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @688-DB07D924
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
		//edit asep 
		global $selected_id;
		//end asep
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr734"] = $selected_id;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


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
            $this->ControlsVisible["DLink2"] = $this->DLink2->Visible;
            $this->ControlsVisible["prev_proc_code"] = $this->prev_proc_code->Visible;
            $this->ControlsVisible["prev_procedure_id"] = $this->prev_procedure_id->Visible;
            $this->ControlsVisible["p_workflow_id"] = $this->p_workflow_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink2->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink2->Parameters = CCAddParam($this->DLink2->Parameters, "prev_procedure_id", $this->DataSource->f("prev_procedure_id"));
                $this->DLink2->Parameters = CCAddParam($this->DLink2->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->prev_proc_code->SetValue($this->DataSource->prev_proc_code->GetValue());
                $this->prev_procedure_id->SetValue($this->DataSource->prev_procedure_id->GetValue());
                $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink2->Show();
                $this->prev_proc_code->Show();
                $this->prev_procedure_id->Show();
                $this->p_workflow_id->Show();
                $this->description->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Insert_Link2->Parameters = CCAddParam($this->Insert_Link2->Parameters, "FLAG", "ADD");
        $this->Insert_Link2->Parameters = CCAddParam($this->Insert_Link2->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
        $this->Navigator->Show();
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @688-97FF496B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prev_proc_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prev_procedure_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_workflow_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_wf_procmasterGrid Class @688-FCB6E20C

class clsp_wf_procmasterGridDataSource extends clsDBConnSIKP {  //p_wf_procmasterGridDataSource Class @688-68825E76

//DataSource Variables @688-E1D47529
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $prev_proc_code;
    var $prev_procedure_id;
    var $p_workflow_id;
    var $description;
//End DataSource Variables

//DataSourceClass_Initialize Event @688-38F83FCF
    function clsp_wf_procmasterGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_wf_procmasterGrid";
        $this->Initialize();
        $this->prev_proc_code = new clsField("prev_proc_code", ccsText, "");
        
        $this->prev_procedure_id = new clsField("prev_procedure_id", ccsFloat, "");
        
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @688-23C74536
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_workflow_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @688-865BBC7A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr734", ccsFloat, "", "", $this->Parameters["expr734"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @688-EEF421AB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_p_wf_procmaster";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_p_wf_procmaster {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @688-6E09D116
    function SetValues()
    {
        $this->prev_proc_code->SetDBValue($this->f("prev_proc_code"));
        $this->prev_procedure_id->SetDBValue(trim($this->f("prev_procedure_id")));
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->description->SetDBValue($this->f("description"));
    }
//End SetValues Method

} //End p_wf_procmasterGridDataSource Class @688-FCB6E20C

class clsGridp_wf_procmasterGrid2 { //p_wf_procmasterGrid2 class @709-7B925F7A

//Variables @709-AC1EDBB9

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

//Class_Initialize Event @709-E0C0627A
    function clsGridp_wf_procmasterGrid2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_wf_procmasterGrid2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_wf_procmasterGrid2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_wf_procmasterGrid2DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 5;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->DLink3 = & new clsControl(ccsLink, "DLink3", "DLink3", ccsText, "", CCGetRequestParam("DLink3", ccsGet, NULL), $this);
        $this->DLink3->HTML = true;
        $this->DLink3->Page = "p_wf_procedure2.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_wf_procedure_id = & new clsControl(ccsHidden, "p_wf_procedure_id", "p_wf_procedure_id", ccsFloat, "", CCGetRequestParam("p_wf_procedure_id", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->next_proc_code = & new clsControl(ccsLabel, "next_proc_code", "next_proc_code", ccsText, "", CCGetRequestParam("next_proc_code", ccsGet, NULL), $this);
        $this->initiate_child_workflow = & new clsControl(ccsLabel, "initiate_child_workflow", "initiate_child_workflow", ccsText, "", CCGetRequestParam("initiate_child_workflow", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "p_workflow_list.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link3 = & new clsControl(ccsLink, "Insert_Link3", "Insert_Link3", ccsText, "", CCGetRequestParam("Insert_Link3", ccsGet, NULL), $this);
        $this->Insert_Link3->Page = "p_wf_procedure2.php";
    }
//End Class_Initialize Event

//Initialize Method @709-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @709-4106BE40
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
		//edit asep
		global $selected_id;
		//end asep
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr736"] = $selected_id;
        $this->DataSource->Parameters["expr737"] = $selected_id;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


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
            $this->ControlsVisible["DLink3"] = $this->DLink3->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_wf_procedure_id"] = $this->p_wf_procedure_id->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["next_proc_code"] = $this->next_proc_code->Visible;
            $this->ControlsVisible["initiate_child_workflow"] = $this->initiate_child_workflow->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink3->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink3->Parameters = CCAddParam($this->DLink3->Parameters, "p_wf_procedure_id", $this->DataSource->f("p_wf_procedure_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_wf_procedure_id->SetValue($this->DataSource->p_wf_procedure_id->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->next_proc_code->SetValue($this->DataSource->next_proc_code->GetValue());
                $this->initiate_child_workflow->SetValue($this->DataSource->initiate_child_workflow->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink3->Show();
                $this->code->Show();
                $this->p_wf_procedure_id->Show();
                $this->valid_to->Show();
                $this->next_proc_code->Show();
                $this->initiate_child_workflow->Show();
                $this->valid_from->Show();
                $this->ImageLink1->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Insert_Link3->Parameters = CCGetQueryString("QueryString", array("p_workflow_id", "s_keyword", "ccsForm"));
        $this->Insert_Link3->Parameters = CCAddParam($this->Insert_Link3->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @709-6DAFE33A
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_wf_procedure_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->next_proc_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->initiate_child_workflow->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_wf_procmasterGrid2 Class @709-FCB6E20C

class clsp_wf_procmasterGrid2DataSource extends clsDBConnSIKP {  //p_wf_procmasterGrid2DataSource Class @709-E2609889

//DataSource Variables @709-9C334E77
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $p_wf_procedure_id;
    var $valid_to;
    var $next_proc_code;
    var $initiate_child_workflow;
    var $valid_from;
//End DataSource Variables

//DataSourceClass_Initialize Event @709-603A8B7F
    function clsp_wf_procmasterGrid2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_wf_procmasterGrid2";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_wf_procedure_id = new clsField("p_wf_procedure_id", ccsFloat, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->next_proc_code = new clsField("next_proc_code", ccsText, "");
        
        $this->initiate_child_workflow = new clsField("initiate_child_workflow", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @709-23C74536
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_workflow_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @709-974BD4A3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr736", ccsFloat, "", "", $this->Parameters["expr736"], "", false);
        $this->wp->AddParameter("2", "expr737", ccsFloat, "", "", $this->Parameters["expr737"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "prev_procedure_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @709-C4FFBAB0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_p_wf_procedure";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_p_wf_procedure {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @709-649B96B2
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->p_wf_procedure_id->SetDBValue(trim($this->f("p_wf_procedure_id")));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->next_proc_code->SetDBValue($this->f("next_proc_code"));
        $this->initiate_child_workflow->SetDBValue($this->f("initiate_child_workflow"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
    }
//End SetValues Method

} //End p_wf_procmasterGrid2DataSource Class @709-FCB6E20C

//Initialize Page @1-429C0852
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
$TemplateFileName = "p_wf_procedure2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-814D5DD8
include_once("./p_wf_procedure2_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-62A57E59
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_workflowGrid = & new clsGridp_workflowGrid("", $MainPage);
$p_workflowSearch = & new clsRecordp_workflowSearch("", $MainPage);
$p_workflowForm = & new clsRecordp_workflowForm("", $MainPage);
$p_wf_procmasterGrid = & new clsGridp_wf_procmasterGrid("", $MainPage);
$p_wf_procmasterGrid2 = & new clsGridp_wf_procmasterGrid2("", $MainPage);
$MainPage->p_workflowGrid = & $p_workflowGrid;
$MainPage->p_workflowSearch = & $p_workflowSearch;
$MainPage->p_workflowForm = & $p_workflowForm;
$MainPage->p_wf_procmasterGrid = & $p_wf_procmasterGrid;
$MainPage->p_wf_procmasterGrid2 = & $p_wf_procmasterGrid2;
$p_workflowGrid->Initialize();
$p_workflowForm->Initialize();
$p_wf_procmasterGrid->Initialize();
$p_wf_procmasterGrid2->Initialize();

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

//Execute Components @1-90B8F142
$p_workflowSearch->Operation();
$p_workflowForm->Operation();
//End Execute Components

//Go to destination page @1-1D688709
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_workflowGrid);
    unset($p_workflowSearch);
    unset($p_workflowForm);
    unset($p_wf_procmasterGrid);
    unset($p_wf_procmasterGrid2);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F948617F
$p_workflowGrid->Show();
$p_workflowSearch->Show();
$p_workflowForm->Show();
$p_wf_procmasterGrid->Show();
$p_wf_procmasterGrid2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2E94F859
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_workflowGrid);
unset($p_workflowSearch);
unset($p_workflowForm);
unset($p_wf_procmasterGrid);
unset($p_wf_procmasterGrid2);
unset($Tpl);
//End Unload Page


?>
