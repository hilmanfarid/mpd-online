<?php
//Include Common Files @1-D69E5B65
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_wf_procedure.php");
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

//Class_Initialize Event @2-2816D113
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

        $this->lworkflow = & new clsControl(ccsLabel, "lworkflow", "lworkflow", ccsText, "", CCGetRequestParam("lworkflow", ccsGet, NULL), $this);
        $this->lactive = & new clsControl(ccsLabel, "lactive", "lactive", ccsText, "", CCGetRequestParam("lactive", ccsGet, NULL), $this);
        $this->cabang = & new clsControl(ccsLabel, "cabang", "cabang", ccsText, "", CCGetRequestParam("cabang", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_wf_procedure.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "p_wf_procedure.php";
        $this->ldocument = & new clsControl(ccsLabel, "ldocument", "ldocument", ccsText, "", CCGetRequestParam("ldocument", ccsGet, NULL), $this);
        $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", ccsGet, NULL), $this);
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

//Show Method @2-D8F6422A
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
            $this->ControlsVisible["lworkflow"] = $this->lworkflow->Visible;
            $this->ControlsVisible["lactive"] = $this->lactive->Visible;
            $this->ControlsVisible["cabang"] = $this->cabang->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["ldocument"] = $this->ldocument->Visible;
            $this->ControlsVisible["p_workflow_id"] = $this->p_workflow_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->lworkflow->SetValue($this->DataSource->lworkflow->GetValue());
                $this->lactive->SetValue($this->DataSource->lactive->GetValue());
                $this->cabang->SetValue($this->DataSource->cabang->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->ldocument->SetValue($this->DataSource->ldocument->GetValue());
                $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lworkflow->Show();
                $this->lactive->Show();
                $this->cabang->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->ldocument->Show();
                $this->p_workflow_id->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-B01F4ABB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lworkflow->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lactive->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cabang->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ldocument->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_workflow_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_workflowGrid Class @2-FCB6E20C

class clsp_workflowGridDataSource extends clsDBConnSIKP {  //p_workflowGridDataSource Class @2-3C301617

//DataSource Variables @2-956A81D8
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $lworkflow;
    var $lactive;
    var $cabang;
    var $DLink;
    var $ADLink;
    var $ldocument;
    var $p_workflow_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-355AE718
    function clsp_workflowGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_workflowGrid";
        $this->Initialize();
        $this->lworkflow = new clsField("lworkflow", ccsText, "");
        
        $this->lactive = new clsField("lactive", ccsText, "");
        
        $this->cabang = new clsField("cabang", ccsText, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->ldocument = new clsField("ldocument", ccsText, "");
        
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
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

//Open Method @2-0871B261
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select w.*  from v_wf_workflow_list w \n" .
        "where exists ( \n" .
        "select distinct x.p_workflow_id \n" .
        "from v_wf_workflow_keyword x \n" .
        "where x.p_workflow_id = w.p_workflow_id   \n" .
        "and UPPER(x.skeyword) like '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        ") \n" .
        ") cnt";
        $this->SQL = "select w.*  from v_wf_workflow_list w \n" .
        "where exists ( \n" .
        "select distinct x.p_workflow_id \n" .
        "from v_wf_workflow_keyword x \n" .
        "where x.p_workflow_id = w.p_workflow_id   \n" .
        "and UPPER(x.skeyword) like '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        ") \n" .
        "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B27A88A4
    function SetValues()
    {
        $this->lworkflow->SetDBValue($this->f("lworkflow"));
        $this->lactive->SetDBValue($this->f("lactive"));
        $this->cabang->SetDBValue($this->f("cabang"));
        $this->DLink->SetDBValue($this->f("p_workflow_id"));
        $this->ADLink->SetDBValue($this->f("p_workflow_id"));
        $this->ldocument->SetDBValue($this->f("ldocument"));
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
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

//Operation Method @3-1A362926
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
        $Redirect = "p_wf_procedure.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_wf_procedure.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

//Class_Initialize Event @688-7648E7C3
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

        $this->proc_display_prev = & new clsControl(ccsLabel, "proc_display_prev", "proc_display_prev", ccsText, "", CCGetRequestParam("proc_display_prev", ccsGet, NULL), $this);
        $this->p_procedure_id_prev = & new clsControl(ccsHidden, "p_procedure_id_prev", "p_procedure_id_prev", ccsFloat, "", CCGetRequestParam("p_procedure_id_prev", ccsGet, NULL), $this);
        $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_wf_procedure.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "p_wf_procedure.php";
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

//Show Method @688-4F56FEF2
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_workflow_id"] = CCGetFromGet("p_workflow_id", NULL);

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
            $this->ControlsVisible["proc_display_prev"] = $this->proc_display_prev->Visible;
            $this->ControlsVisible["p_procedure_id_prev"] = $this->p_procedure_id_prev->Visible;
            $this->ControlsVisible["p_workflow_id"] = $this->p_workflow_id->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->proc_display_prev->SetValue($this->DataSource->proc_display_prev->GetValue());
                $this->p_procedure_id_prev->SetValue($this->DataSource->p_procedure_id_prev->GetValue());
                $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_procedure_id_prev", $this->DataSource->f("p_procedure_id_prev"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "p_procedure_id_prev", $this->DataSource->f("p_procedure_id_prev"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->proc_display_prev->Show();
                $this->p_procedure_id_prev->Show();
                $this->p_workflow_id->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
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
        $this->Insert_Link2->Parameters = CCGetQueryString("QueryString", array("p_wf_procedure_id", "prev_procedure_id", "ccsForm"));
        $this->Insert_Link2->Parameters = CCAddParam($this->Insert_Link2->Parameters, "FLAG", "ADD");
        $this->Insert_Link2->Parameters = CCAddParam($this->Insert_Link2->Parameters, "p_workflow_id", CCGetFromGet("p_workflow_id".""));
        $this->Navigator->Show();
        $this->Insert_Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @688-B248B921
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->proc_display_prev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_procedure_id_prev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_workflow_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_wf_procmasterGrid Class @688-FCB6E20C

class clsp_wf_procmasterGridDataSource extends clsDBConnSIKP {  //p_wf_procmasterGridDataSource Class @688-68825E76

//DataSource Variables @688-54C361F1
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $proc_display_prev;
    var $p_procedure_id_prev;
    var $p_workflow_id;
    var $DLink;
    var $ADLink;
//End DataSource Variables

//DataSourceClass_Initialize Event @688-B9419186
    function clsp_wf_procmasterGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_wf_procmasterGrid";
        $this->Initialize();
        $this->proc_display_prev = new clsField("proc_display_prev", ccsText, "");
        
        $this->p_procedure_id_prev = new clsField("p_procedure_id_prev", ccsFloat, "");
        
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @688-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @688-F44BE42E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_workflow_id", ccsFloat, "", "", $this->Parameters["urlp_workflow_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @688-053CA5D5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_wf_chart_prev";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_wf_chart_prev {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @688-0D8BCEAA
    function SetValues()
    {
        $this->proc_display_prev->SetDBValue($this->f("proc_display_prev"));
        $this->p_procedure_id_prev->SetDBValue(trim($this->f("p_procedure_id_prev")));
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->DLink->SetDBValue($this->f("p_procedure_id_prev"));
        $this->ADLink->SetDBValue($this->f("p_procedure_id_prev"));
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

//Class_Initialize Event @709-A46E6F6A
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

        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->proc_display_next = & new clsControl(ccsLabel, "proc_display_next", "proc_display_next", ccsText, "", CCGetRequestParam("proc_display_next", ccsGet, NULL), $this);
        $this->linitchild = & new clsControl(ccsLabel, "linitchild", "linitchild", ccsText, "", CCGetRequestParam("linitchild", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->ImageLink1 = & new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "p_wf_proc_list2.php";
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_wf_procedure.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "p_wf_procedure.php";
        $this->p_procedure_id_prev = & new clsControl(ccsHidden, "p_procedure_id_prev", "p_procedure_id_prev", ccsFloat, "", CCGetRequestParam("p_procedure_id_prev", ccsGet, NULL), $this);
        $this->p_w_chart_proc_id_next = & new clsControl(ccsHidden, "p_w_chart_proc_id_next", "p_w_chart_proc_id_next", ccsFloat, "", CCGetRequestParam("p_w_chart_proc_id_next", ccsGet, NULL), $this);
        $this->p_workflow_id = & new clsControl(ccsHidden, "p_workflow_id", "p_workflow_id", ccsFloat, "", CCGetRequestParam("p_workflow_id", ccsGet, NULL), $this);
        $this->ImageLink2 = & new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Page = "p_w_daemon_proc.php";
        $this->lvalid = & new clsControl(ccsLabel, "lvalid", "lvalid", ccsText, "", CCGetRequestParam("lvalid", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link3 = & new clsControl(ccsLink, "Insert_Link3", "Insert_Link3", ccsText, "", CCGetRequestParam("Insert_Link3", ccsGet, NULL), $this);
        $this->Insert_Link3->Page = "p_wf_proc_list1.php";
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

//Show Method @709-E075A5FA
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_procedure_id_prev"] = CCGetFromGet("p_procedure_id_prev", NULL);
        $this->DataSource->Parameters["urlp_workflow_id"] = CCGetFromGet("p_workflow_id", NULL);

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
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["proc_display_next"] = $this->proc_display_next->Visible;
            $this->ControlsVisible["linitchild"] = $this->linitchild->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["p_procedure_id_prev"] = $this->p_procedure_id_prev->Visible;
            $this->ControlsVisible["p_w_chart_proc_id_next"] = $this->p_w_chart_proc_id_next->Visible;
            $this->ControlsVisible["p_workflow_id"] = $this->p_workflow_id->Visible;
            $this->ControlsVisible["ImageLink2"] = $this->ImageLink2->Visible;
            $this->ControlsVisible["lvalid"] = $this->lvalid->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->proc_display_next->SetValue($this->DataSource->proc_display_next->GetValue());
                $this->linitchild->SetValue($this->DataSource->linitchild->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "p_w_chart_proc_id", $this->DataSource->f("p_w_chart_proc_id_next"));
                $this->DLink->SetValue($this->DataSource->DLink->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_w_chart_proc_id_next", $this->DataSource->f("p_w_chart_proc_id_next"));
                $this->ADLink->SetValue($this->DataSource->ADLink->GetValue());
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "p_w_chart_proc_id_next", $this->DataSource->f("p_w_chart_proc_id_next"));
                $this->p_procedure_id_prev->SetValue($this->DataSource->p_procedure_id_prev->GetValue());
                $this->p_w_chart_proc_id_next->SetValue($this->DataSource->p_w_chart_proc_id_next->GetValue());
                $this->p_workflow_id->SetValue($this->DataSource->p_workflow_id->GetValue());
                $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("s_keyword", "ccsForm"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "doc_name", $this->DataSource->f("doc_name"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "p_w_chart_proc_id", $this->DataSource->f("p_w_chart_proc_id_next"));
                $this->lvalid->SetValue($this->DataSource->lvalid->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->valid_to->Show();
                $this->proc_display_next->Show();
                $this->linitchild->Show();
                $this->valid_from->Show();
                $this->ImageLink1->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->p_procedure_id_prev->Show();
                $this->p_w_chart_proc_id_next->Show();
                $this->p_workflow_id->Show();
                $this->ImageLink2->Show();
                $this->lvalid->Show();
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
        $this->Insert_Link3->Parameters = CCGetQueryString("QueryString", array("p_w_chart_proc_id_next", "ccsForm"));
        $this->Insert_Link3->Parameters = CCAddParam($this->Insert_Link3->Parameters, "p_procedure_id_prev", $this->DataSource->f("p_procedure_id_prev"));
        $this->Insert_Link3->Parameters = CCAddParam($this->Insert_Link3->Parameters, "p_workflow_id", $this->DataSource->f("p_workflow_id"));
        $this->Insert_Link3->Parameters = CCAddParam($this->Insert_Link3->Parameters, "pekerjaan_prev", $this->DataSource->f("proc_display_prev"));
        $this->Navigator->Show();
        $this->Insert_Link3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @709-7A74F26F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->proc_display_next->Errors->ToString());
        $errors = ComposeStrings($errors, $this->linitchild->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_procedure_id_prev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_w_chart_proc_id_next->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_workflow_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lvalid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_wf_procmasterGrid2 Class @709-FCB6E20C

class clsp_wf_procmasterGrid2DataSource extends clsDBConnSIKP {  //p_wf_procmasterGrid2DataSource Class @709-E2609889

//DataSource Variables @709-E59DD344
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $valid_to;
    var $proc_display_next;
    var $linitchild;
    var $valid_from;
    var $DLink;
    var $ADLink;
    var $p_procedure_id_prev;
    var $p_w_chart_proc_id_next;
    var $p_workflow_id;
    var $lvalid;
//End DataSource Variables

//DataSourceClass_Initialize Event @709-8B4E67A2
    function clsp_wf_procmasterGrid2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_wf_procmasterGrid2";
        $this->Initialize();
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->proc_display_next = new clsField("proc_display_next", ccsText, "");
        
        $this->linitchild = new clsField("linitchild", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->DLink = new clsField("DLink", ccsText, "");
        
        $this->ADLink = new clsField("ADLink", ccsText, "");
        
        $this->p_procedure_id_prev = new clsField("p_procedure_id_prev", ccsFloat, "");
        
        $this->p_w_chart_proc_id_next = new clsField("p_w_chart_proc_id_next", ccsFloat, "");
        
        $this->p_workflow_id = new clsField("p_workflow_id", ccsFloat, "");
        
        $this->lvalid = new clsField("lvalid", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @709-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @709-F0B5CB80
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_procedure_id_prev", ccsFloat, "", "", $this->Parameters["urlp_procedure_id_prev"], "", false);
        $this->wp->AddParameter("2", "urlp_workflow_id", ccsFloat, "", "", $this->Parameters["urlp_workflow_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "p_procedure_id_prev", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "p_workflow_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @709-56152BDF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_wf_chart_next";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_wf_chart_next {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @709-A50C89C7
    function SetValues()
    {
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->proc_display_next->SetDBValue($this->f("proc_display_next"));
        $this->linitchild->SetDBValue($this->f("linitchild"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->DLink->SetDBValue($this->f("p_w_chart_proc_id_next"));
        $this->ADLink->SetDBValue($this->f("p_w_chart_proc_id_next"));
        $this->p_procedure_id_prev->SetDBValue(trim($this->f("p_procedure_id_prev")));
        $this->p_w_chart_proc_id_next->SetDBValue(trim($this->f("p_w_chart_proc_id_next")));
        $this->p_workflow_id->SetDBValue(trim($this->f("p_workflow_id")));
        $this->lvalid->SetDBValue($this->f("lvalid"));
    }
//End SetValues Method

} //End p_wf_procmasterGrid2DataSource Class @709-FCB6E20C

//Initialize Page @1-058C1205
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
$TemplateFileName = "p_wf_procedure.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B3B7A6EB
include_once("./p_wf_procedure_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D80AC135
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_workflowGrid = & new clsGridp_workflowGrid("", $MainPage);
$p_workflowSearch = & new clsRecordp_workflowSearch("", $MainPage);
$p_wf_procmasterGrid = & new clsGridp_wf_procmasterGrid("", $MainPage);
$p_wf_procmasterGrid2 = & new clsGridp_wf_procmasterGrid2("", $MainPage);
$MainPage->p_workflowGrid = & $p_workflowGrid;
$MainPage->p_workflowSearch = & $p_workflowSearch;
$MainPage->p_wf_procmasterGrid = & $p_wf_procmasterGrid;
$MainPage->p_wf_procmasterGrid2 = & $p_wf_procmasterGrid2;
$p_workflowGrid->Initialize();
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

//Execute Components @1-9C2DCB0E
$p_workflowSearch->Operation();
//End Execute Components

//Go to destination page @1-7FF40E47
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_workflowGrid);
    unset($p_workflowSearch);
    unset($p_wf_procmasterGrid);
    unset($p_wf_procmasterGrid2);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9645DBE9
$p_workflowGrid->Show();
$p_workflowSearch->Show();
$p_wf_procmasterGrid->Show();
$p_wf_procmasterGrid2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-10A8311E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_workflowGrid);
unset($p_workflowSearch);
unset($p_wf_procmasterGrid);
unset($p_wf_procmasterGrid2);
unset($Tpl);
//End Unload Page


?>
