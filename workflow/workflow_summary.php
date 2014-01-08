<?php
//Include Common Files @1-475B40EC
define("RelativePath", "..");
define("PathToCurrentPage", "/workflow/");
define("FileName", "workflow_summary.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);

class clsGridsumworkflow { //sumworkflow class @476-28D137CA

//Variables @476-AC1EDBB9

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

//Class_Initialize Event @476-1F65F0F4
    function clsGridsumworkflow($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "sumworkflow";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid sumworkflow";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssumworkflowDataSource($this);
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

        $this->DISPLAY_NAME = & new clsControl(ccsLabel, "DISPLAY_NAME", "DISPLAY_NAME", ccsText, "", CCGetRequestParam("DISPLAY_NAME", ccsGet, NULL), $this);
        $this->DISPLAY_NAME->HTML = true;
        $this->SCOUNT = & new clsControl(ccsLabel, "SCOUNT", "SCOUNT", ccsText, "", CCGetRequestParam("SCOUNT", ccsGet, NULL), $this);
        $this->STYPE = & new clsControl(ccsHidden, "STYPE", "STYPE", ccsText, "", CCGetRequestParam("STYPE", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "workflow_summary.php";
        $this->ADLink = & new clsControl(ccsLink, "ADLink", "ADLink", ccsText, "", CCGetRequestParam("ADLink", ccsGet, NULL), $this);
        $this->ADLink->HTML = true;
        $this->ADLink->Page = "workflow_summary.php";
        $this->ELEMENT_ID = & new clsControl(ccsHidden, "ELEMENT_ID", "ELEMENT_ID", ccsText, "", CCGetRequestParam("ELEMENT_ID", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @476-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @476-5A7C4A44
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr490"] = CCGetUserLogin();
        $this->DataSource->Parameters["urlP_W_DOC_TYPE_ID"] = CCGetFromGet("P_W_DOC_TYPE_ID", NULL);

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
            $this->ControlsVisible["DISPLAY_NAME"] = $this->DISPLAY_NAME->Visible;
            $this->ControlsVisible["SCOUNT"] = $this->SCOUNT->Visible;
            $this->ControlsVisible["STYPE"] = $this->STYPE->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["ADLink"] = $this->ADLink->Visible;
            $this->ControlsVisible["ELEMENT_ID"] = $this->ELEMENT_ID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DISPLAY_NAME->SetValue($this->DataSource->DISPLAY_NAME->GetValue());
                $this->SCOUNT->SetValue($this->DataSource->SCOUNT->GetValue());
                $this->STYPE->SetValue($this->DataSource->STYPE->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("IS_TAKEN", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "ELEMENT_ID", $this->DataSource->f("element_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "P_W_DOC_TYPE_ID", $this->DataSource->f("p_w_doc_type_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "P_W_PROC_ID", $this->DataSource->f("p_w_proc_id"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "PROFILE_TYPE", $this->DataSource->f("profile_type"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "P_APP_USER_ID", $this->DataSource->f("p_app_user_id"));
                $this->ADLink->Parameters = CCGetQueryString("QueryString", array("IS_TAKEN", "ccsForm"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "ELEMENT_ID", $this->DataSource->f("element_id"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "P_W_DOC_TYPE_ID", $this->DataSource->f("p_w_doc_type_id"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "P_W_PROC_ID", $this->DataSource->f("p_w_proc_id"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "PROFILE_TYPE", $this->DataSource->f("profile_type"));
                $this->ADLink->Parameters = CCAddParam($this->ADLink->Parameters, "P_APP_USER_ID", $this->DataSource->f("p_app_user_id"));
                $this->ELEMENT_ID->SetValue($this->DataSource->ELEMENT_ID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DISPLAY_NAME->Show();
                $this->SCOUNT->Show();
                $this->STYPE->Show();
                $this->DLink->Show();
                $this->ADLink->Show();
                $this->ELEMENT_ID->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @476-0F38F479
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DISPLAY_NAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SCOUNT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->STYPE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ADLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ELEMENT_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End sumworkflow Class @476-FCB6E20C

class clssumworkflowDataSource extends clsDBConnSIKP {  //sumworkflowDataSource Class @476-325303D6

//DataSource Variables @476-7BBB7090
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $DISPLAY_NAME;
    var $SCOUNT;
    var $STYPE;
    var $ELEMENT_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @476-F6FB80B1
    function clssumworkflowDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid sumworkflow";
        $this->Initialize();
        $this->DISPLAY_NAME = new clsField("DISPLAY_NAME", ccsText, "");
        
        $this->SCOUNT = new clsField("SCOUNT", ccsText, "");
        
        $this->STYPE = new clsField("STYPE", ccsText, "");
        
        $this->ELEMENT_ID = new clsField("ELEMENT_ID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @476-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @476-22577FD5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr490", ccsText, "", "", $this->Parameters["expr490"], "ADMIN", false);
        $this->wp->AddParameter("2", "urlP_W_DOC_TYPE_ID", ccsFloat, "", "", $this->Parameters["urlP_W_DOC_TYPE_ID"], -9, false);
    }
//End Prepare Method

//Open Method @476-D71F1AE3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from pack_task_profile.workflow_summary_list(" . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . ",'" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')\n" .
        "where p_w_doc_type_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . ") cnt";
        $this->SQL = "select * from pack_task_profile.workflow_summary_list(" . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . ",'" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "')\n" .
        "where p_w_doc_type_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @476-C52369D3
    function SetValues()
    {
        $this->DISPLAY_NAME->SetDBValue($this->f("display_name"));
        $this->SCOUNT->SetDBValue($this->f("scount"));
        $this->STYPE->SetDBValue($this->f("stype"));
        $this->ELEMENT_ID->SetDBValue($this->f("element_id"));
    }
//End SetValues Method

} //End sumworkflowDataSource Class @476-FCB6E20C

class clsRecordTaskSearch { //TaskSearch Class @19-99DDB752

//Variables @19-D6FF3E86

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

//Class_Initialize Event @19-0668E4E5
    function clsRecordTaskSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record TaskSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "TaskSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->sdonor_date = & new clsControl(ccsTextBox, "sdonor_date", "sdonor_date", ccsDate, array("dd", "-", "mmm", "-", "yyyy"), CCGetRequestParam("sdonor_date", $Method, NULL), $this);
            $this->P_W_DOC_TYPE_ID = & new clsControl(ccsTextBox, "P_W_DOC_TYPE_ID", "P_W_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("P_W_DOC_TYPE_ID", $Method, NULL), $this);
            $this->P_W_PROC_ID = & new clsControl(ccsTextBox, "P_W_PROC_ID", "P_W_PROC_ID", ccsText, "", CCGetRequestParam("P_W_PROC_ID", $Method, NULL), $this);
            $this->ELEMENT_ID = & new clsControl(ccsTextBox, "ELEMENT_ID", "ELEMENT_ID", ccsText, "", CCGetRequestParam("ELEMENT_ID", $Method, NULL), $this);
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->DatePicker_sdonor_date = & new clsDatePicker("DatePicker_sdonor_date", "TaskSearch", "sdonor_date", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @19-1AF3CBA2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->sdonor_date->Validate() && $Validation);
        $Validation = ($this->P_W_DOC_TYPE_ID->Validate() && $Validation);
        $Validation = ($this->P_W_PROC_ID->Validate() && $Validation);
        $Validation = ($this->ELEMENT_ID->Validate() && $Validation);
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->sdonor_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->P_W_DOC_TYPE_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->P_W_PROC_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ELEMENT_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @19-515A70FE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->sdonor_date->Errors->Count());
        $errors = ($errors || $this->P_W_DOC_TYPE_ID->Errors->Count());
        $errors = ($errors || $this->P_W_PROC_ID->Errors->Count());
        $errors = ($errors || $this->ELEMENT_ID->Errors->Count());
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->DatePicker_sdonor_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @19-ED598703
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

//Operation Method @19-D701F065
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
        $Redirect = "workflow_summary.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "workflow_summary.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @19-2FB3E0E5
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
            $Error = ComposeStrings($Error, $this->sdonor_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->P_W_DOC_TYPE_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->P_W_PROC_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ELEMENT_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_sdonor_date->Errors->ToString());
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

        $this->sdonor_date->Show();
        $this->P_W_DOC_TYPE_ID->Show();
        $this->P_W_PROC_ID->Show();
        $this->ELEMENT_ID->Show();
        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $this->DatePicker_sdonor_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End TaskSearch Class @19-FCB6E20C

class clsGridTask { //Task class @16-85D7B6DE

//Variables @16-451EA677

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
    var $Sorter_LTASK;
    var $Sorter_DOC_NO;
//End Variables

//Class_Initialize Event @16-FA47EF4E
    function clsGridTask($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Task";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Task";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsTaskDataSource($this);
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
        $this->SorterName = CCGetParam("TaskOrder", "");
        $this->SorterDirection = CCGetParam("TaskDir", "");

        $this->MESSAGE = & new clsControl(ccsLabel, "MESSAGE", "MESSAGE", ccsText, "", CCGetRequestParam("MESSAGE", ccsGet, NULL), $this);
        $this->Buka = & new clsButton("Buka", ccsGet, $this);
        $this->DOC_ID = & new clsControl(ccsTextBox, "DOC_ID", "DOC_ID", ccsText, "", CCGetRequestParam("DOC_ID", ccsGet, NULL), $this);
        $this->P_W_DOC_TYPE_ID = & new clsControl(ccsTextBox, "P_W_DOC_TYPE_ID", "P_W_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("P_W_DOC_TYPE_ID", ccsGet, NULL), $this);
        $this->P_W_PROC_ID = & new clsControl(ccsTextBox, "P_W_PROC_ID", "P_W_PROC_ID", ccsText, "", CCGetRequestParam("P_W_PROC_ID", ccsGet, NULL), $this);
        $this->PROFILE_TYPE = & new clsControl(ccsTextBox, "PROFILE_TYPE", "PROFILE_TYPE", ccsText, "", CCGetRequestParam("PROFILE_TYPE", ccsGet, NULL), $this);
        $this->FILENAME = & new clsControl(ccsTextBox, "FILENAME", "FILENAME", ccsText, "", CCGetRequestParam("FILENAME", ccsGet, NULL), $this);
        $this->LTASK = & new clsControl(ccsLabel, "LTASK", "LTASK", ccsText, "", CCGetRequestParam("LTASK", ccsGet, NULL), $this);
        $this->RECIPIENT = & new clsControl(ccsLabel, "RECIPIENT", "RECIPIENT", ccsText, "", CCGetRequestParam("RECIPIENT", ccsGet, NULL), $this);
        $this->SENDER = & new clsControl(ccsLabel, "SENDER", "SENDER", ccsText, "", CCGetRequestParam("SENDER", ccsGet, NULL), $this);
        $this->DONOR_DATE = & new clsControl(ccsLabel, "DONOR_DATE", "DONOR_DATE", ccsText, "", CCGetRequestParam("DONOR_DATE", ccsGet, NULL), $this);
        $this->TAKEOVER = & new clsControl(ccsLabel, "TAKEOVER", "TAKEOVER", ccsText, "", CCGetRequestParam("TAKEOVER", ccsGet, NULL), $this);
        $this->TAKEN_DATE = & new clsControl(ccsLabel, "TAKEN_DATE", "TAKEN_DATE", ccsText, "", CCGetRequestParam("TAKEN_DATE", ccsGet, NULL), $this);
        $this->CLOSER = & new clsControl(ccsLabel, "CLOSER", "CLOSER", ccsText, "", CCGetRequestParam("CLOSER", ccsGet, NULL), $this);
        $this->SUBMIT_DATE = & new clsControl(ccsLabel, "SUBMIT_DATE", "SUBMIT_DATE", ccsText, "", CCGetRequestParam("SUBMIT_DATE", ccsGet, NULL), $this);
        $this->LPROC_STS = & new clsControl(ccsLabel, "LPROC_STS", "LPROC_STS", ccsText, "", CCGetRequestParam("LPROC_STS", ccsGet, NULL), $this);
        $this->LDOC_NO = & new clsControl(ccsLabel, "LDOC_NO", "LDOC_NO", ccsText, "", CCGetRequestParam("LDOC_NO", ccsGet, NULL), $this);
        $this->PERIOD = & new clsControl(ccsLabel, "PERIOD", "PERIOD", ccsFloat, "", CCGetRequestParam("PERIOD", ccsGet, NULL), $this);
        $this->READ_DATE = & new clsControl(ccsLabel, "READ_DATE", "READ_DATE", ccsText, "", CCGetRequestParam("READ_DATE", ccsGet, NULL), $this);
        $this->LDOC_STS = & new clsControl(ccsLabel, "LDOC_STS", "LDOC_STS", ccsText, "", CCGetRequestParam("LDOC_STS", ccsGet, NULL), $this);
        $this->IS_READ = & new clsControl(ccsTextBox, "IS_READ", "IS_READ", ccsText, "", CCGetRequestParam("IS_READ", ccsGet, NULL), $this);
        $this->DOC_NO = & new clsControl(ccsTextBox, "DOC_NO", "DOC_NO", ccsText, "", CCGetRequestParam("DOC_NO", ccsGet, NULL), $this);
        $this->P_APP_USER_ID_DONOR = & new clsControl(ccsTextBox, "P_APP_USER_ID_DONOR", "P_APP_USER_ID_DONOR", ccsText, "", CCGetRequestParam("P_APP_USER_ID_DONOR", ccsGet, NULL), $this);
        $this->P_APP_USER_ID_TAKEOVER = & new clsControl(ccsTextBox, "P_APP_USER_ID_TAKEOVER", "P_APP_USER_ID_TAKEOVER", ccsText, "", CCGetRequestParam("P_APP_USER_ID_TAKEOVER", ccsGet, NULL), $this);
        $this->T_USER_CTL_ID = & new clsControl(ccsTextBox, "T_USER_CTL_ID", "T_USER_CTL_ID", ccsText, "", CCGetRequestParam("T_USER_CTL_ID", ccsGet, NULL), $this);
        $this->T_CTL_ID = & new clsControl(ccsTextBox, "T_CTL_ID", "T_CTL_ID", ccsText, "", CCGetRequestParam("T_CTL_ID", ccsGet, NULL), $this);
        $this->PREV_DOC_TYPE_ID = & new clsControl(ccsTextBox, "PREV_DOC_TYPE_ID", "PREV_DOC_TYPE_ID", ccsText, "", CCGetRequestParam("PREV_DOC_TYPE_ID", ccsGet, NULL), $this);
        $this->PREV_PROC_ID = & new clsControl(ccsTextBox, "PREV_PROC_ID", "PREV_PROC_ID", ccsText, "", CCGetRequestParam("PREV_PROC_ID", ccsGet, NULL), $this);
        $this->PREV_DOC_ID = & new clsControl(ccsTextBox, "PREV_DOC_ID", "PREV_DOC_ID", ccsText, "", CCGetRequestParam("PREV_DOC_ID", ccsGet, NULL), $this);
        $this->PREV_CTL_ID = & new clsControl(ccsTextBox, "PREV_CTL_ID", "PREV_CTL_ID", ccsText, "", CCGetRequestParam("PREV_CTL_ID", ccsGet, NULL), $this);
        $this->SLOT_1 = & new clsControl(ccsTextBox, "SLOT_1", "SLOT_1", ccsText, "", CCGetRequestParam("SLOT_1", ccsGet, NULL), $this);
        $this->SLOT_2 = & new clsControl(ccsTextBox, "SLOT_2", "SLOT_2", ccsText, "", CCGetRequestParam("SLOT_2", ccsGet, NULL), $this);
        $this->SLOT_3 = & new clsControl(ccsTextBox, "SLOT_3", "SLOT_3", ccsText, "", CCGetRequestParam("SLOT_3", ccsGet, NULL), $this);
        $this->SLOT_4 = & new clsControl(ccsTextBox, "SLOT_4", "SLOT_4", ccsText, "", CCGetRequestParam("SLOT_4", ccsGet, NULL), $this);
        $this->SLOT_5 = & new clsControl(ccsTextBox, "SLOT_5", "SLOT_5", ccsText, "", CCGetRequestParam("SLOT_5", ccsGet, NULL), $this);
        $this->DOC_STS = & new clsControl(ccsTextBox, "DOC_STS", "DOC_STS", ccsText, "", CCGetRequestParam("DOC_STS", ccsGet, NULL), $this);
        $this->EVENT_COLORING = & new clsControl(ccsLabel, "EVENT_COLORING", "EVENT_COLORING", ccsText, "", CCGetRequestParam("EVENT_COLORING", ccsGet, NULL), $this);
        $this->EVENT_COLORING->HTML = true;
        $this->PROC_STS = & new clsControl(ccsTextBox, "PROC_STS", "PROC_STS", ccsText, "", CCGetRequestParam("PROC_STS", ccsGet, NULL), $this);
        $this->CUST_INFO = & new clsControl(ccsLabel, "CUST_INFO", "CUST_INFO", ccsText, "", CCGetRequestParam("CUST_INFO", ccsGet, NULL), $this);
        $this->Sorter_LTASK = & new clsSorter($this->ComponentName, "Sorter_LTASK", $FileName, $this);
        $this->Sorter_DOC_NO = & new clsSorter($this->ComponentName, "Sorter_DOC_NO", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @16-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @16-7DB49700
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["expr497"] = CCGetUserLogin();
        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlsdonor_date"] = CCGetFromGet("sdonor_date", NULL);
        $this->DataSource->Parameters["urlP_W_DOC_TYPE_ID"] = CCGetFromGet("P_W_DOC_TYPE_ID", NULL);
        $this->DataSource->Parameters["urlP_W_PROC_ID"] = CCGetFromGet("P_W_PROC_ID", NULL);
        $this->DataSource->Parameters["urlPROFILE_TYPE"] = CCGetFromGet("PROFILE_TYPE", NULL);

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
            $this->ControlsVisible["MESSAGE"] = $this->MESSAGE->Visible;
            $this->ControlsVisible["Buka"] = $this->Buka->Visible;
            $this->ControlsVisible["DOC_ID"] = $this->DOC_ID->Visible;
            $this->ControlsVisible["P_W_DOC_TYPE_ID"] = $this->P_W_DOC_TYPE_ID->Visible;
            $this->ControlsVisible["P_W_PROC_ID"] = $this->P_W_PROC_ID->Visible;
            $this->ControlsVisible["PROFILE_TYPE"] = $this->PROFILE_TYPE->Visible;
            $this->ControlsVisible["FILENAME"] = $this->FILENAME->Visible;
            $this->ControlsVisible["LTASK"] = $this->LTASK->Visible;
            $this->ControlsVisible["RECIPIENT"] = $this->RECIPIENT->Visible;
            $this->ControlsVisible["SENDER"] = $this->SENDER->Visible;
            $this->ControlsVisible["DONOR_DATE"] = $this->DONOR_DATE->Visible;
            $this->ControlsVisible["TAKEOVER"] = $this->TAKEOVER->Visible;
            $this->ControlsVisible["TAKEN_DATE"] = $this->TAKEN_DATE->Visible;
            $this->ControlsVisible["CLOSER"] = $this->CLOSER->Visible;
            $this->ControlsVisible["SUBMIT_DATE"] = $this->SUBMIT_DATE->Visible;
            $this->ControlsVisible["LPROC_STS"] = $this->LPROC_STS->Visible;
            $this->ControlsVisible["LDOC_NO"] = $this->LDOC_NO->Visible;
            $this->ControlsVisible["PERIOD"] = $this->PERIOD->Visible;
            $this->ControlsVisible["READ_DATE"] = $this->READ_DATE->Visible;
            $this->ControlsVisible["LDOC_STS"] = $this->LDOC_STS->Visible;
            $this->ControlsVisible["IS_READ"] = $this->IS_READ->Visible;
            $this->ControlsVisible["DOC_NO"] = $this->DOC_NO->Visible;
            $this->ControlsVisible["P_APP_USER_ID_DONOR"] = $this->P_APP_USER_ID_DONOR->Visible;
            $this->ControlsVisible["P_APP_USER_ID_TAKEOVER"] = $this->P_APP_USER_ID_TAKEOVER->Visible;
            $this->ControlsVisible["T_USER_CTL_ID"] = $this->T_USER_CTL_ID->Visible;
            $this->ControlsVisible["T_CTL_ID"] = $this->T_CTL_ID->Visible;
            $this->ControlsVisible["PREV_DOC_TYPE_ID"] = $this->PREV_DOC_TYPE_ID->Visible;
            $this->ControlsVisible["PREV_PROC_ID"] = $this->PREV_PROC_ID->Visible;
            $this->ControlsVisible["PREV_DOC_ID"] = $this->PREV_DOC_ID->Visible;
            $this->ControlsVisible["PREV_CTL_ID"] = $this->PREV_CTL_ID->Visible;
            $this->ControlsVisible["SLOT_1"] = $this->SLOT_1->Visible;
            $this->ControlsVisible["SLOT_2"] = $this->SLOT_2->Visible;
            $this->ControlsVisible["SLOT_3"] = $this->SLOT_3->Visible;
            $this->ControlsVisible["SLOT_4"] = $this->SLOT_4->Visible;
            $this->ControlsVisible["SLOT_5"] = $this->SLOT_5->Visible;
            $this->ControlsVisible["DOC_STS"] = $this->DOC_STS->Visible;
            $this->ControlsVisible["EVENT_COLORING"] = $this->EVENT_COLORING->Visible;
            $this->ControlsVisible["PROC_STS"] = $this->PROC_STS->Visible;
            $this->ControlsVisible["CUST_INFO"] = $this->CUST_INFO->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->MESSAGE->SetValue($this->DataSource->MESSAGE->GetValue());
                $this->DOC_ID->SetValue($this->DataSource->DOC_ID->GetValue());
                $this->P_W_DOC_TYPE_ID->SetValue($this->DataSource->P_W_DOC_TYPE_ID->GetValue());
                $this->P_W_PROC_ID->SetValue($this->DataSource->P_W_PROC_ID->GetValue());
                $this->PROFILE_TYPE->SetValue($this->DataSource->PROFILE_TYPE->GetValue());
                $this->FILENAME->SetValue($this->DataSource->FILENAME->GetValue());
                $this->LTASK->SetValue($this->DataSource->LTASK->GetValue());
                $this->RECIPIENT->SetValue($this->DataSource->RECIPIENT->GetValue());
                $this->SENDER->SetValue($this->DataSource->SENDER->GetValue());
                $this->DONOR_DATE->SetValue($this->DataSource->DONOR_DATE->GetValue());
                $this->TAKEOVER->SetValue($this->DataSource->TAKEOVER->GetValue());
                $this->TAKEN_DATE->SetValue($this->DataSource->TAKEN_DATE->GetValue());
                $this->CLOSER->SetValue($this->DataSource->CLOSER->GetValue());
                $this->SUBMIT_DATE->SetValue($this->DataSource->SUBMIT_DATE->GetValue());
                $this->LPROC_STS->SetValue($this->DataSource->LPROC_STS->GetValue());
                $this->LDOC_NO->SetValue($this->DataSource->LDOC_NO->GetValue());
                $this->PERIOD->SetValue($this->DataSource->PERIOD->GetValue());
                $this->READ_DATE->SetValue($this->DataSource->READ_DATE->GetValue());
                $this->LDOC_STS->SetValue($this->DataSource->LDOC_STS->GetValue());
                $this->IS_READ->SetValue($this->DataSource->IS_READ->GetValue());
                $this->DOC_NO->SetValue($this->DataSource->DOC_NO->GetValue());
                $this->P_APP_USER_ID_DONOR->SetValue($this->DataSource->P_APP_USER_ID_DONOR->GetValue());
                $this->P_APP_USER_ID_TAKEOVER->SetValue($this->DataSource->P_APP_USER_ID_TAKEOVER->GetValue());
                $this->T_USER_CTL_ID->SetValue($this->DataSource->T_USER_CTL_ID->GetValue());
                $this->T_CTL_ID->SetValue($this->DataSource->T_CTL_ID->GetValue());
                $this->PREV_DOC_TYPE_ID->SetValue($this->DataSource->PREV_DOC_TYPE_ID->GetValue());
                $this->PREV_PROC_ID->SetValue($this->DataSource->PREV_PROC_ID->GetValue());
                $this->PREV_DOC_ID->SetValue($this->DataSource->PREV_DOC_ID->GetValue());
                $this->PREV_CTL_ID->SetValue($this->DataSource->PREV_CTL_ID->GetValue());
                $this->SLOT_1->SetValue($this->DataSource->SLOT_1->GetValue());
                $this->SLOT_2->SetValue($this->DataSource->SLOT_2->GetValue());
                $this->SLOT_3->SetValue($this->DataSource->SLOT_3->GetValue());
                $this->SLOT_4->SetValue($this->DataSource->SLOT_4->GetValue());
                $this->SLOT_5->SetValue($this->DataSource->SLOT_5->GetValue());
                $this->DOC_STS->SetValue($this->DataSource->DOC_STS->GetValue());
                $this->PROC_STS->SetValue($this->DataSource->PROC_STS->GetValue());
                $this->CUST_INFO->SetValue($this->DataSource->CUST_INFO->GetValue());
                $this->Buka->Attributes->SetValue("taskbuka", "");
                $this->Buka->Attributes->SetValue("read", "");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->MESSAGE->Show();
                $this->Buka->Show();
                $this->DOC_ID->Show();
                $this->P_W_DOC_TYPE_ID->Show();
                $this->P_W_PROC_ID->Show();
                $this->PROFILE_TYPE->Show();
                $this->FILENAME->Show();
                $this->LTASK->Show();
                $this->RECIPIENT->Show();
                $this->SENDER->Show();
                $this->DONOR_DATE->Show();
                $this->TAKEOVER->Show();
                $this->TAKEN_DATE->Show();
                $this->CLOSER->Show();
                $this->SUBMIT_DATE->Show();
                $this->LPROC_STS->Show();
                $this->LDOC_NO->Show();
                $this->PERIOD->Show();
                $this->READ_DATE->Show();
                $this->LDOC_STS->Show();
                $this->IS_READ->Show();
                $this->DOC_NO->Show();
                $this->P_APP_USER_ID_DONOR->Show();
                $this->P_APP_USER_ID_TAKEOVER->Show();
                $this->T_USER_CTL_ID->Show();
                $this->T_CTL_ID->Show();
                $this->PREV_DOC_TYPE_ID->Show();
                $this->PREV_PROC_ID->Show();
                $this->PREV_DOC_ID->Show();
                $this->PREV_CTL_ID->Show();
                $this->SLOT_1->Show();
                $this->SLOT_2->Show();
                $this->SLOT_3->Show();
                $this->SLOT_4->Show();
                $this->SLOT_5->Show();
                $this->DOC_STS->Show();
                $this->EVENT_COLORING->Show();
                $this->PROC_STS->Show();
                $this->CUST_INFO->Show();
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
        $this->Sorter_LTASK->Show();
        $this->Sorter_DOC_NO->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @16-219DBE3C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->MESSAGE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DOC_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->P_W_DOC_TYPE_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->P_W_PROC_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PROFILE_TYPE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FILENAME->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LTASK->Errors->ToString());
        $errors = ComposeStrings($errors, $this->RECIPIENT->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SENDER->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DONOR_DATE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TAKEOVER->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TAKEN_DATE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CLOSER->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SUBMIT_DATE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LPROC_STS->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LDOC_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PERIOD->Errors->ToString());
        $errors = ComposeStrings($errors, $this->READ_DATE->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LDOC_STS->Errors->ToString());
        $errors = ComposeStrings($errors, $this->IS_READ->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DOC_NO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->P_APP_USER_ID_DONOR->Errors->ToString());
        $errors = ComposeStrings($errors, $this->P_APP_USER_ID_TAKEOVER->Errors->ToString());
        $errors = ComposeStrings($errors, $this->T_USER_CTL_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->T_CTL_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PREV_DOC_TYPE_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PREV_PROC_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PREV_DOC_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PREV_CTL_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SLOT_1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SLOT_2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SLOT_3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SLOT_4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SLOT_5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DOC_STS->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EVENT_COLORING->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PROC_STS->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CUST_INFO->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Task Class @16-FCB6E20C

class clsTaskDataSource extends clsDBConnSIKP {  //TaskDataSource Class @16-7E9CB8F5

//DataSource Variables @16-06C345AC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $MESSAGE;
    var $DOC_ID;
    var $P_W_DOC_TYPE_ID;
    var $P_W_PROC_ID;
    var $PROFILE_TYPE;
    var $FILENAME;
    var $LTASK;
    var $RECIPIENT;
    var $SENDER;
    var $DONOR_DATE;
    var $TAKEOVER;
    var $TAKEN_DATE;
    var $CLOSER;
    var $SUBMIT_DATE;
    var $LPROC_STS;
    var $LDOC_NO;
    var $PERIOD;
    var $READ_DATE;
    var $LDOC_STS;
    var $IS_READ;
    var $DOC_NO;
    var $P_APP_USER_ID_DONOR;
    var $P_APP_USER_ID_TAKEOVER;
    var $T_USER_CTL_ID;
    var $T_CTL_ID;
    var $PREV_DOC_TYPE_ID;
    var $PREV_PROC_ID;
    var $PREV_DOC_ID;
    var $PREV_CTL_ID;
    var $SLOT_1;
    var $SLOT_2;
    var $SLOT_3;
    var $SLOT_4;
    var $SLOT_5;
    var $DOC_STS;
    var $PROC_STS;
    var $CUST_INFO;
//End DataSource Variables

//DataSourceClass_Initialize Event @16-54FF21DA
    function clsTaskDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Task";
        $this->Initialize();
        $this->MESSAGE = new clsField("MESSAGE", ccsText, "");
        
        $this->DOC_ID = new clsField("DOC_ID", ccsText, "");
        
        $this->P_W_DOC_TYPE_ID = new clsField("P_W_DOC_TYPE_ID", ccsText, "");
        
        $this->P_W_PROC_ID = new clsField("P_W_PROC_ID", ccsText, "");
        
        $this->PROFILE_TYPE = new clsField("PROFILE_TYPE", ccsText, "");
        
        $this->FILENAME = new clsField("FILENAME", ccsText, "");
        
        $this->LTASK = new clsField("LTASK", ccsText, "");
        
        $this->RECIPIENT = new clsField("RECIPIENT", ccsText, "");
        
        $this->SENDER = new clsField("SENDER", ccsText, "");
        
        $this->DONOR_DATE = new clsField("DONOR_DATE", ccsText, "");
        
        $this->TAKEOVER = new clsField("TAKEOVER", ccsText, "");
        
        $this->TAKEN_DATE = new clsField("TAKEN_DATE", ccsText, "");
        
        $this->CLOSER = new clsField("CLOSER", ccsText, "");
        
        $this->SUBMIT_DATE = new clsField("SUBMIT_DATE", ccsText, "");
        
        $this->LPROC_STS = new clsField("LPROC_STS", ccsText, "");
        
        $this->LDOC_NO = new clsField("LDOC_NO", ccsText, "");
        
        $this->PERIOD = new clsField("PERIOD", ccsFloat, "");
        
        $this->READ_DATE = new clsField("READ_DATE", ccsText, "");
        
        $this->LDOC_STS = new clsField("LDOC_STS", ccsText, "");
        
        $this->IS_READ = new clsField("IS_READ", ccsText, "");
        
        $this->DOC_NO = new clsField("DOC_NO", ccsText, "");
        
        $this->P_APP_USER_ID_DONOR = new clsField("P_APP_USER_ID_DONOR", ccsText, "");
        
        $this->P_APP_USER_ID_TAKEOVER = new clsField("P_APP_USER_ID_TAKEOVER", ccsText, "");
        
        $this->T_USER_CTL_ID = new clsField("T_USER_CTL_ID", ccsText, "");
        
        $this->T_CTL_ID = new clsField("T_CTL_ID", ccsText, "");
        
        $this->PREV_DOC_TYPE_ID = new clsField("PREV_DOC_TYPE_ID", ccsText, "");
        
        $this->PREV_PROC_ID = new clsField("PREV_PROC_ID", ccsText, "");
        
        $this->PREV_DOC_ID = new clsField("PREV_DOC_ID", ccsText, "");
        
        $this->PREV_CTL_ID = new clsField("PREV_CTL_ID", ccsText, "");
        
        $this->SLOT_1 = new clsField("SLOT_1", ccsText, "");
        
        $this->SLOT_2 = new clsField("SLOT_2", ccsText, "");
        
        $this->SLOT_3 = new clsField("SLOT_3", ccsText, "");
        
        $this->SLOT_4 = new clsField("SLOT_4", ccsText, "");
        
        $this->SLOT_5 = new clsField("SLOT_5", ccsText, "");
        
        $this->DOC_STS = new clsField("DOC_STS", ccsText, "");
        
        $this->PROC_STS = new clsField("PROC_STS", ccsText, "");
        
        $this->CUST_INFO = new clsField("CUST_INFO", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @16-B7BB2DFC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_LTASK" => array("LTASK", ""), 
            "Sorter_DOC_NO" => array("DOC_NO", "")));
    }
//End SetOrder Method

//Prepare Method @16-B5A69EEF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr497", ccsText, "", "", $this->Parameters["expr497"], "ADMIN", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("3", "urlsdonor_date", ccsText, "", "", $this->Parameters["urlsdonor_date"], "", false);
        $this->wp->AddParameter("4", "urlP_W_DOC_TYPE_ID", ccsText, "", "", $this->Parameters["urlP_W_DOC_TYPE_ID"], "", false);
        $this->wp->AddParameter("5", "urlP_W_PROC_ID", ccsText, "", "", $this->Parameters["urlP_W_PROC_ID"], "", false);
        $this->wp->AddParameter("6", "urlPROFILE_TYPE", ccsText, "", "", $this->Parameters["urlPROFILE_TYPE"], "INBOX", false);
    }
//End Prepare Method

//Open Method @16-826EC29D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select * from pack_task_profile.user_task_list (" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . "," . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . ",'" . $this->SQLValue($this->wp->GetDBValue("6"), ccsText) . "','" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "','{skeyword}') \n" .
        "where trunc(donor_date) = nvl(to_date('" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "','DD-MON-YYYY'),trunc(donor_date)) \n" .
        "and keyword like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' ) cnt";
        $this->SQL = "select * from pack_task_profile.user_task_list (" . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . "," . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . ",'" . $this->SQLValue($this->wp->GetDBValue("6"), ccsText) . "','" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "','{skeyword}') \n" .
        "where trunc(donor_date) = nvl(to_date('" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "','DD-MON-YYYY'),trunc(donor_date)) \n" .
        "and keyword like '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' ";
		$this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @16-000C47D6
    function SetValues()
    {
        $this->MESSAGE->SetDBValue($this->f("message"));
        $this->DOC_ID->SetDBValue($this->f("doc_id"));
        $this->P_W_DOC_TYPE_ID->SetDBValue($this->f("p_w_doc_type_id"));
        $this->P_W_PROC_ID->SetDBValue($this->f("p_w_proc_id"));
        $this->PROFILE_TYPE->SetDBValue($this->f("profile_type"));
        $this->FILENAME->SetDBValue($this->f("filename"));
        $this->LTASK->SetDBValue($this->f("ltask"));
        $this->RECIPIENT->SetDBValue($this->f("recipient"));
        $this->SENDER->SetDBValue($this->f("sender"));
        $this->DONOR_DATE->SetDBValue($this->f("donor_date"));
        $this->TAKEOVER->SetDBValue($this->f("takeover"));
        $this->TAKEN_DATE->SetDBValue($this->f("taken_date"));
        $this->CLOSER->SetDBValue($this->f("closer"));
        $this->SUBMIT_DATE->SetDBValue($this->f("submit_date"));
        $this->LPROC_STS->SetDBValue($this->f("proc_sts"));
        $this->LDOC_NO->SetDBValue($this->f("doc_no"));
        $this->PERIOD->SetDBValue(trim($this->f("period")));
        $this->READ_DATE->SetDBValue($this->f("read_date"));
        $this->LDOC_STS->SetDBValue($this->f("ldoc_sts"));
        $this->IS_READ->SetDBValue($this->f("is_read"));
        $this->DOC_NO->SetDBValue($this->f("doc_no"));
        $this->P_APP_USER_ID_DONOR->SetDBValue($this->f("p_app_user_id_donor"));
        $this->P_APP_USER_ID_TAKEOVER->SetDBValue($this->f("p_app_user_id_takeover"));
        $this->T_USER_CTL_ID->SetDBValue($this->f("t_user_ctl_id"));
        $this->T_CTL_ID->SetDBValue($this->f("t_ctl_id"));
        $this->PREV_DOC_TYPE_ID->SetDBValue($this->f("prev_doc_type_id"));
        $this->PREV_PROC_ID->SetDBValue($this->f("prev_proc_id"));
        $this->PREV_DOC_ID->SetDBValue($this->f("prev_doc_id"));
        $this->PREV_CTL_ID->SetDBValue($this->f("prev_ctl_id"));
        $this->SLOT_1->SetDBValue($this->f("slot_1"));
        $this->SLOT_2->SetDBValue($this->f("slot_2"));
        $this->SLOT_3->SetDBValue($this->f("slot_3"));
        $this->SLOT_4->SetDBValue($this->f("slot_4"));
        $this->SLOT_5->SetDBValue($this->f("slot_5"));
        $this->DOC_STS->SetDBValue($this->f("doc_sts"));
        $this->PROC_STS->SetDBValue($this->f("proc_sts"));
        $this->CUST_INFO->SetDBValue($this->f("cust_info"));
    }
//End SetValues Method

} //End TaskDataSource Class @16-FCB6E20C

class clsRecordBROAD { //BROAD Class @125-079A2A69

//Variables @125-D6FF3E86

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

//Class_Initialize Event @125-7A75AFB8
    function clsRecordBROAD($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record BROAD/Error";
        $this->DataSource = new clsBROADDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "BROAD";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->CASTER = & new clsControl(ccsTextArea, "CASTER", "CASTER", ccsText, "", CCGetRequestParam("CASTER", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @125-D3669897
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["sesUserLogin"] = CCGetSession("UserLogin", NULL);
    }
//End Initialize Method

//Validate Method @125-A1EDF98C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->CASTER->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->CASTER->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @125-EB5D887A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->CASTER->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @125-ED598703
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

//Operation Method @125-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @125-98F44376
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
                    $this->CASTER->SetValue($this->DataSource->CASTER->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->CASTER->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->CASTER->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End BROAD Class @125-FCB6E20C

class clsBROADDataSource extends clsDBConnSIKP {  //BROADDataSource Class @125-940D6CE7

//DataSource Variables @125-E0B12343
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $CASTER;
//End DataSource Variables

//DataSourceClass_Initialize Event @125-53D0D9F2
    function clsBROADDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record BROAD/Error";
        $this->Initialize();
        $this->CASTER = new clsField("CASTER", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @125-825AB464
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "sesUserLogin", ccsText, "", "", $this->Parameters["sesUserLogin"], "MO7002", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @125-5F7B41BF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "select postcast from pack_task_profile.broadcaster ('" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "') as tbl (ty_broadcast_ctl) \n" .
        "where ty_broadcast_ctl = -99999";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @125-1221D493
    function SetValues()
    {
        $this->CASTER->SetDBValue($this->f("POSTCAST"));
    }
//End SetValues Method

} //End BROADDataSource Class @125-FCB6E20C

//Initialize Page @1-AE918506
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
$TemplateFileName = "workflow_summary.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3AA08A77
include_once("./workflow_summary_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-51D8D791
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$sumworkflow = & new clsGridsumworkflow("", $MainPage);
$TaskSearch = & new clsRecordTaskSearch("", $MainPage);
$Task = & new clsGridTask("", $MainPage);
$BROAD = & new clsRecordBROAD("", $MainPage);
$MainPage->sumworkflow = & $sumworkflow;
$MainPage->TaskSearch = & $TaskSearch;
$MainPage->Task = & $Task;
$MainPage->BROAD = & $BROAD;
$sumworkflow->Initialize();
$Task->Initialize();
$BROAD->Initialize();

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

//Execute Components @1-88DB78B3
$TaskSearch->Operation();
$BROAD->Operation();
//End Execute Components

//Go to destination page @1-C8D74231
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($sumworkflow);
    unset($TaskSearch);
    unset($Task);
    unset($BROAD);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-458A2324
$sumworkflow->Show();
$TaskSearch->Show();
$Task->Show();
$BROAD->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6246F40F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($sumworkflow);
unset($TaskSearch);
unset($Task);
unset($BROAD);
unset($Tpl);
//End Unload Page


?>
