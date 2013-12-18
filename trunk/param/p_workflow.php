<?php
//Include Common Files @1-209EBAD3
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_workflow.php");
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

//Class_Initialize Event @2-E41DA4F2
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
        $this->DLink->Page = "p_workflow.php";
        $this->doc_name = & new clsControl(ccsLabel, "doc_name", "doc_name", ccsText, "", CCGetRequestParam("doc_name", ccsGet, NULL), $this);
        $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", ccsGet, NULL), $this);
        $this->display_name = & new clsControl(ccsLabel, "display_name", "display_name", ccsText, "", CCGetRequestParam("display_name", ccsGet, NULL), $this);
        $this->document_type_code = & new clsControl(ccsLabel, "document_type_code", "document_type_code", ccsText, "", CCGetRequestParam("document_type_code", ccsGet, NULL), $this);
        $this->is_active = & new clsControl(ccsLabel, "is_active", "is_active", ccsText, "", CCGetRequestParam("is_active", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_workflow.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-DA32DF11
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
            $this->ControlsVisible["doc_name"] = $this->doc_name->Visible;
            $this->ControlsVisible["p_workflow_id"] = $this->p_workflow_id->Visible;
            $this->ControlsVisible["display_name"] = $this->display_name->Visible;
            $this->ControlsVisible["document_type_code"] = $this->document_type_code->Visible;
            $this->ControlsVisible["is_active"] = $this->is_active->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->doc_name->SetValue($this->DataSource->doc_name->GetValue());
                $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                $this->display_name->SetValue($this->DataSource->display_name->GetValue());
                $this->document_type_code->SetValue($this->DataSource->document_type_code->GetValue());
                $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->doc_name->Show();
                $this->p_workflow_id->Show();
                $this->display_name->Show();
                $this->document_type_code->Show();
                $this->is_active->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_workflow_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Insert_Link->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-74DE6E55
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->doc_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_workflow_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->display_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->document_type_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_active->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_workflowGrid Class @2-FCB6E20C

class clsp_workflowGridDataSource extends clsDBConnSIKP {  //p_workflowGridDataSource Class @2-3C301617

//DataSource Variables @2-E126AA53
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $doc_name;
    var $p_workflow_id;
    var $display_name;
    var $document_type_code;
    var $is_active;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-38D2B657
    function clsp_workflowGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_workflowGrid";
        $this->Initialize();
        $this->doc_name = new clsField("doc_name", ccsText, "");
        
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        
        $this->document_type_code = new clsField("document_type_code", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-2A2DB890
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.p_workflow_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-25AA94A2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-F835E7B2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT p_workflow_id, a.doc_name, a.display_name, a.p_document_type_id, p_procedure_id_start,\n" .
        "decode(a.is_active,'Y','YA','TIDAK')as is_active, a.description, to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, \n" .
        "a.updated_by, a.created_by,\n" .
        "to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.doc_name AS document_type_code , c.display_name AS procedure_code\n" .
        "FROM p_workflow a INNER JOIN p_document_type b ON a.p_document_type_id = b.p_document_type_id \n" .
        "INNER JOIN p_procedure c ON a.p_procedure_id_start = c.p_procedure_id \n" .
        "WHERE upper(a.doc_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "OR upper(a.display_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') \n" .
        "OR upper(b.doc_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')) cnt";
        $this->SQL = "SELECT p_workflow_id, a.doc_name, a.display_name, a.p_document_type_id, p_procedure_id_start,\n" .
        "decode(a.is_active,'Y','YA','TIDAK')as is_active, a.description, to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, \n" .
        "a.updated_by, a.created_by,\n" .
        "to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.doc_name AS document_type_code , c.display_name AS procedure_code\n" .
        "FROM p_workflow a INNER JOIN p_document_type b ON a.p_document_type_id = b.p_document_type_id \n" .
        "INNER JOIN p_procedure c ON a.p_procedure_id_start = c.p_procedure_id \n" .
        "WHERE upper(a.doc_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "OR upper(a.display_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') \n" .
        "OR upper(b.doc_name) like upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A1823CDA
    function SetValues()
    {
        $this->doc_name->SetDBValue($this->f("doc_name"));
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->display_name->SetDBValue($this->f("display_name"));
        $this->document_type_code->SetDBValue($this->f("document_type_code"));
        $this->is_active->SetDBValue($this->f("is_active"));
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

//Operation Method @3-AB04513F
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
        $Redirect = "p_workflow.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_workflow.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

//Class_Initialize Event @94-F0592E92
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
            $this->doc_name = & new clsControl(ccsTextBox, "doc_name", "Nama Workflow", ccsText, "", CCGetRequestParam("doc_name", $Method, NULL), $this);
            $this->doc_name->Required = true;
            $this->procedure_code = & new clsControl(ccsTextBox, "procedure_code", "Pekerjaan Awal", ccsText, "", CCGetRequestParam("procedure_code", $Method, NULL), $this);
            $this->procedure_code->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->document_type_code = & new clsControl(ccsTextBox, "document_type_code", "Jenis Dokumen Workflow", ccsText, "", CCGetRequestParam("document_type_code", $Method, NULL), $this);
            $this->document_type_code->Required = true;
            $this->is_active = & new clsControl(ccsListBox, "is_active", "Diaktifkan", ccsText, "", CCGetRequestParam("is_active", $Method, NULL), $this);
            $this->is_active->DSType = dsListOfValues;
            $this->is_active->Values = array(array("Y", "AKTIF"), array("N", "TIDAK AKTIF"));
            $this->is_active->Required = true;
            $this->p_document_type_id = & new clsControl(ccsHidden, "p_document_type_id", "p_document_type_id", ccsFloat, "", CCGetRequestParam("p_document_type_id", $Method, NULL), $this);
            $this->p_procedure_id_start = & new clsControl(ccsHidden, "p_procedure_id_start", "p_procedure_id_start", ccsFloat, "", CCGetRequestParam("p_procedure_id_start", $Method, NULL), $this);
            $this->display_name = & new clsControl(ccsTextBox, "display_name", "Nama Workflow Tercetak", ccsText, "", CCGetRequestParam("display_name", $Method, NULL), $this);
            $this->display_name->Required = true;
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

//Validate Method @94-A4C31C39
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_workflow_id->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_workflowGridPage->Validate() && $Validation);
        $Validation = ($this->doc_name->Validate() && $Validation);
        $Validation = ($this->procedure_code->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->document_type_code->Validate() && $Validation);
        $Validation = ($this->is_active->Validate() && $Validation);
        $Validation = ($this->p_document_type_id->Validate() && $Validation);
        $Validation = ($this->p_procedure_id_start->Validate() && $Validation);
        $Validation = ($this->display_name->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_workflow_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_workflowGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->doc_name->Errors->Count() == 0);
        $Validation =  $Validation && ($this->procedure_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->document_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_active->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_document_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_procedure_id_start->Errors->Count() == 0);
        $Validation =  $Validation && ($this->display_name->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-745F9E36
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_workflow_id->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_workflowGridPage->Errors->Count());
        $errors = ($errors || $this->doc_name->Errors->Count());
        $errors = ($errors || $this->procedure_code->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->document_type_code->Errors->Count());
        $errors = ($errors || $this->is_active->Errors->Count());
        $errors = ($errors || $this->p_document_type_id->Errors->Count());
        $errors = ($errors || $this->p_procedure_id_start->Errors->Count());
        $errors = ($errors || $this->display_name->Errors->Count());
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

//InsertRow Method @94-1C48C4C5
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->doc_name->SetValue($this->doc_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->p_procedure_id_start->SetValue($this->p_procedure_id_start->GetValue(true));
        $this->DataSource->display_name->SetValue($this->display_name->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-5DC132FB
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_workflow_id->SetValue($this->p_workflow_id->GetValue(true));
        $this->DataSource->doc_name->SetValue($this->doc_name->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->is_active->SetValue($this->is_active->GetValue(true));
        $this->DataSource->p_document_type_id->SetValue($this->p_document_type_id->GetValue(true));
        $this->DataSource->p_procedure_id_start->SetValue($this->p_procedure_id_start->GetValue(true));
        $this->DataSource->display_name->SetValue($this->display_name->GetValue(true));
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

//Show Method @94-3F035439
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
                    $this->doc_name->SetValue($this->DataSource->doc_name->GetValue());
                    $this->procedure_code->SetValue($this->DataSource->procedure_code->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->document_type_code->SetValue($this->DataSource->document_type_code->GetValue());
                    $this->is_active->SetValue($this->DataSource->is_active->GetValue());
                    $this->p_document_type_id->SetValue($this->DataSource->p_document_type_id->GetValue());
                    $this->p_procedure_id_start->SetValue($this->DataSource->p_procedure_id_start->GetValue());
                    $this->display_name->SetValue($this->DataSource->display_name->GetValue());
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
            $Error = ComposeStrings($Error, $this->doc_name->Errors->ToString());
            $Error = ComposeStrings($Error, $this->procedure_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->document_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_active->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_document_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_procedure_id_start->Errors->ToString());
            $Error = ComposeStrings($Error, $this->display_name->Errors->ToString());
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
        $this->doc_name->Show();
        $this->procedure_code->Show();
        $this->updated_date->Show();
        $this->created_by->Show();
        $this->creation_date->Show();
        $this->description->Show();
        $this->document_type_code->Show();
        $this->is_active->Show();
        $this->p_document_type_id->Show();
        $this->p_procedure_id_start->Show();
        $this->display_name->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_workflowForm Class @94-FCB6E20C

class clsp_workflowFormDataSource extends clsDBConnSIKP {  //p_workflowFormDataSource Class @94-630780E3

//DataSource Variables @94-A0A592B6
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
    var $doc_name;
    var $procedure_code;
    var $updated_date;
    var $created_by;
    var $creation_date;
    var $description;
    var $document_type_code;
    var $is_active;
    var $p_document_type_id;
    var $p_procedure_id_start;
    var $display_name;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-81E75154
    function clsp_workflowFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_workflowForm/Error";
        $this->Initialize();
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_workflowGridPage = new clsField("p_workflowGridPage", ccsText, "");
        
        $this->doc_name = new clsField("doc_name", ccsText, "");
        
        $this->procedure_code = new clsField("procedure_code", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->document_type_code = new clsField("document_type_code", ccsText, "");
        
        $this->is_active = new clsField("is_active", ccsText, "");
        
        $this->p_document_type_id = new clsField("p_document_type_id", ccsFloat, "");
        
        $this->p_procedure_id_start = new clsField("p_procedure_id_start", ccsFloat, "");
        
        $this->display_name = new clsField("display_name", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-C867E8C0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_workflow_id", ccsFloat, "", "", $this->Parameters["urlp_workflow_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-6A6C3502
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_workflow_id, a.doc_name, a.display_name, a.p_document_type_id, p_procedure_id_start,\n" .
        "decode(a.is_active,'Y','YA','TIDAK'), a.description, to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, \n" .
        "a.updated_by, a.created_by,\n" .
        "to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.doc_name AS document_type_code , c.display_name AS procedure_code\n" .
        "FROM p_workflow a INNER JOIN p_document_type b ON a.p_document_type_id = b.p_document_type_id \n" .
        "INNER JOIN p_procedure c ON a.p_procedure_id_start = c.p_procedure_id \n" .
        "WHERE a.p_workflow_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-36652124
    function SetValues()
    {
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->doc_name->SetDBValue($this->f("doc_name"));
        $this->procedure_code->SetDBValue($this->f("procedure_code"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->description->SetDBValue($this->f("description"));
        $this->document_type_code->SetDBValue($this->f("document_type_code"));
        $this->is_active->SetDBValue($this->f("is_active"));
        $this->p_document_type_id->SetDBValue(trim($this->f("p_document_type_id")));
        $this->p_procedure_id_start->SetDBValue(trim($this->f("p_procedure_id_start")));
        $this->display_name->SetDBValue($this->f("display_name"));
    }
//End SetValues Method

//Insert Method @94-B4AB0D9E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["updated_by"] = new clsSQLParameter("expr715", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["doc_name"] = new clsSQLParameter("ctrldoc_name", ccsText, "", "", $this->doc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr718", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_procedure_id_start"] = new clsSQLParameter("ctrlp_procedure_id_start", ccsFloat, "", "", $this->p_procedure_id_start->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["display_name"] = new clsSQLParameter("ctrldisplay_name", ccsText, "", "", $this->display_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["doc_name"]->GetValue()) and !strlen($this->cp["doc_name"]->GetText()) and !is_bool($this->cp["doc_name"]->GetValue())) 
            $this->cp["doc_name"]->SetValue($this->doc_name->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue(true))) 
            $this->cp["p_document_type_id"]->SetText(0);
        if (!is_null($this->cp["p_procedure_id_start"]->GetValue()) and !strlen($this->cp["p_procedure_id_start"]->GetText()) and !is_bool($this->cp["p_procedure_id_start"]->GetValue())) 
            $this->cp["p_procedure_id_start"]->SetValue($this->p_procedure_id_start->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_start"]->GetText()) and !is_bool($this->cp["p_procedure_id_start"]->GetValue(true))) 
            $this->cp["p_procedure_id_start"]->SetText(0);
        if (!is_null($this->cp["display_name"]->GetValue()) and !strlen($this->cp["display_name"]->GetText()) and !is_bool($this->cp["display_name"]->GetValue())) 
            $this->cp["display_name"]->SetValue($this->display_name->GetValue(true));
        $this->SQL = "INSERT INTO p_workflow(p_workflow_id, updated_by, doc_name, updated_date, created_by, creation_date, description, is_active, p_document_type_id, p_procedure_id_start, display_name) \n" .
        "VALUES(generate_id('sikp','p_workflow','p_workflow_id'), '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["doc_name"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_procedure_id_start"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["display_name"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-40E5C363
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_workflow_id"] = new clsSQLParameter("ctrlp_workflow_id", ccsFloat, "", "", $this->p_workflow_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr740", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["doc_name"] = new clsSQLParameter("ctrldoc_name", ccsText, "", "", $this->doc_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_active"] = new clsSQLParameter("ctrlis_active", ccsText, "", "", $this->is_active->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_document_type_id"] = new clsSQLParameter("ctrlp_document_type_id", ccsFloat, "", "", $this->p_document_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_procedure_id_start"] = new clsSQLParameter("ctrlp_procedure_id_start", ccsFloat, "", "", $this->p_procedure_id_start->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["display_name"] = new clsSQLParameter("ctrldisplay_name", ccsText, "", "", $this->display_name->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_workflow_id"]->GetValue()) and !strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue())) 
            $this->cp["p_workflow_id"]->SetValue($this->p_workflow_id->GetValue(true));
        if (!strlen($this->cp["p_workflow_id"]->GetText()) and !is_bool($this->cp["p_workflow_id"]->GetValue(true))) 
            $this->cp["p_workflow_id"]->SetText(0);
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["doc_name"]->GetValue()) and !strlen($this->cp["doc_name"]->GetText()) and !is_bool($this->cp["doc_name"]->GetValue())) 
            $this->cp["doc_name"]->SetValue($this->doc_name->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["is_active"]->GetValue()) and !strlen($this->cp["is_active"]->GetText()) and !is_bool($this->cp["is_active"]->GetValue())) 
            $this->cp["is_active"]->SetValue($this->is_active->GetValue(true));
        if (!is_null($this->cp["p_document_type_id"]->GetValue()) and !strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue())) 
            $this->cp["p_document_type_id"]->SetValue($this->p_document_type_id->GetValue(true));
        if (!strlen($this->cp["p_document_type_id"]->GetText()) and !is_bool($this->cp["p_document_type_id"]->GetValue(true))) 
            $this->cp["p_document_type_id"]->SetText(0);
        if (!is_null($this->cp["p_procedure_id_start"]->GetValue()) and !strlen($this->cp["p_procedure_id_start"]->GetText()) and !is_bool($this->cp["p_procedure_id_start"]->GetValue())) 
            $this->cp["p_procedure_id_start"]->SetValue($this->p_procedure_id_start->GetValue(true));
        if (!strlen($this->cp["p_procedure_id_start"]->GetText()) and !is_bool($this->cp["p_procedure_id_start"]->GetValue(true))) 
            $this->cp["p_procedure_id_start"]->SetText(0);
        if (!is_null($this->cp["display_name"]->GetValue()) and !strlen($this->cp["display_name"]->GetText()) and !is_bool($this->cp["display_name"]->GetValue())) 
            $this->cp["display_name"]->SetValue($this->display_name->GetValue(true));
        $this->SQL = "UPDATE p_workflow SET \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "doc_name='" . $this->SQLValue($this->cp["doc_name"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "is_active='" . $this->SQLValue($this->cp["is_active"]->GetDBValue(), ccsText) . "', \n" .
        "p_document_type_id=" . $this->SQLValue($this->cp["p_document_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "p_procedure_id_start=" . $this->SQLValue($this->cp["p_procedure_id_start"]->GetDBValue(), ccsFloat) . ", \n" .
        "display_name='" . $this->SQLValue($this->cp["display_name"]->GetDBValue(), ccsText) . "'\n" .
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

//Initialize Page @1-CEBF946C
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
$TemplateFileName = "p_workflow.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-920382DB
include_once("./p_workflow_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-391C7CD1
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_workflowGrid = & new clsGridp_workflowGrid("", $MainPage);
$p_workflowSearch = & new clsRecordp_workflowSearch("", $MainPage);
$p_workflowForm = & new clsRecordp_workflowForm("", $MainPage);
$MainPage->p_workflowGrid = & $p_workflowGrid;
$MainPage->p_workflowSearch = & $p_workflowSearch;
$MainPage->p_workflowForm = & $p_workflowForm;
$p_workflowGrid->Initialize();
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

//Execute Components @1-90B8F142
$p_workflowSearch->Operation();
$p_workflowForm->Operation();
//End Execute Components

//Go to destination page @1-D9567938
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_workflowGrid);
    unset($p_workflowSearch);
    unset($p_workflowForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F47B5DF9
$p_workflowGrid->Show();
$p_workflowSearch->Show();
$p_workflowForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9C6D0821
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_workflowGrid);
unset($p_workflowSearch);
unset($p_workflowForm);
unset($Tpl);
//End Unload Page


?>
