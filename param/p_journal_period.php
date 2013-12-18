<?php
//Include Common Files @1-D74F947E
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_journal_period.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_journal_periodGrid { //p_journal_periodGrid class @2-C515B8F9

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

//Class_Initialize Event @2-AD5DB77A
    function clsGridp_journal_periodGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_journal_periodGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_journal_periodGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_journal_periodGridDataSource($this);
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
        $this->DLink->Page = "p_journal_period.php";
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->p_journal_period_id = & new clsControl(ccsHidden, "p_journal_period_id", "p_journal_period_id", ccsFloat, "", CCGetRequestParam("p_journal_period_id", ccsGet, NULL), $this);
        $this->status_code = & new clsControl(ccsLabel, "status_code", "status_code", ccsText, "", CCGetRequestParam("status_code", ccsGet, NULL), $this);
        $this->start_date = & new clsControl(ccsLabel, "start_date", "start_date", ccsText, "", CCGetRequestParam("start_date", ccsGet, NULL), $this);
        $this->end_date = & new clsControl(ccsLabel, "end_date", "end_date", ccsText, "", CCGetRequestParam("end_date", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_journal_period.php";
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

//Show Method @2-8BA708AF
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlp_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);

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
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["p_journal_period_id"] = $this->p_journal_period_id->Visible;
            $this->ControlsVisible["status_code"] = $this->status_code->Visible;
            $this->ControlsVisible["start_date"] = $this->start_date->Visible;
            $this->ControlsVisible["end_date"] = $this->end_date->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_journal_period_id", $this->DataSource->f("p_journal_period_id"));
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->p_journal_period_id->SetValue($this->DataSource->p_journal_period_id->GetValue());
                $this->status_code->SetValue($this->DataSource->status_code->GetValue());
                $this->start_date->SetValue($this->DataSource->start_date->GetValue());
                $this->end_date->SetValue($this->DataSource->end_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->code->Show();
                $this->description->Show();
                $this->p_journal_period_id->Show();
                $this->status_code->Show();
                $this->start_date->Show();
                $this->end_date->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_journal_period_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-9F3B5DCB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_journal_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->status_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->start_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->end_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_journal_periodGrid Class @2-FCB6E20C

class clsp_journal_periodGridDataSource extends clsDBConnSIKP {  //p_journal_periodGridDataSource Class @2-F4905C86

//DataSource Variables @2-70EDB880
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $code;
    var $description;
    var $p_journal_period_id;
    var $status_code;
    var $start_date;
    var $end_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8AC2BBC9
    function clsp_journal_periodGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_journal_periodGrid";
        $this->Initialize();
        $this->code = new clsField("code", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->p_journal_period_id = new clsField("p_journal_period_id", ccsFloat, "");
        
        $this->status_code = new clsField("status_code", ccsText, "");
        
        $this->start_date = new clsField("start_date", ccsText, "");
        
        $this->end_date = new clsField("end_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-FF87C901
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.p_journal_period_id DESC ";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-7B3D8617
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlp_year_period_id", ccsFloat, "", "", $this->Parameters["urlp_year_period_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-E7385833
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.p_journal_period_id, a.p_year_period_id, a.code, to_char(a.start_date,'DD-MON-YYYY') start_date,\n" .
        "to_char(a.end_date,'DD-MON-YYYY') end_date, a.description,\n" .
        "to_char(a.updated_date,'DD-MON-YYYY') updated_date,\n" .
        "a.updated_by,to_char(a.creation_date,'DD-MON-YYYY') creation_date, a.created_by,\n" .
        "b.code status_code, a.p_status_list_id\n" .
        "FROM p_journal_period a, p_status_list b, p_year_period c \n" .
        "WHERE a.p_status_list_id = b.p_status_list_id AND \n" .
        "a.p_year_period_id = c.p_year_period_id AND\n" .
        "a.p_year_period_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " AND\n" .
        "(upper(a.code) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "OR upper(b.code) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') )) cnt";
        $this->SQL = "SELECT a.p_journal_period_id, a.p_year_period_id, a.code, to_char(a.start_date,'DD-MON-YYYY') start_date,\n" .
        "to_char(a.end_date,'DD-MON-YYYY') end_date, a.description,\n" .
        "to_char(a.updated_date,'DD-MON-YYYY') updated_date,\n" .
        "a.updated_by,to_char(a.creation_date,'DD-MON-YYYY') creation_date, a.created_by,\n" .
        "b.code status_code, a.p_status_list_id\n" .
        "FROM p_journal_period a, p_status_list b, p_year_period c \n" .
        "WHERE a.p_status_list_id = b.p_status_list_id AND \n" .
        "a.p_year_period_id = c.p_year_period_id AND\n" .
        "a.p_year_period_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsFloat) . " AND\n" .
        "(upper(a.code) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%')\n" .
        "OR upper(b.code) LIKE upper('%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') ){SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-6447797B
    function SetValues()
    {
        $this->code->SetDBValue($this->f("code"));
        $this->description->SetDBValue($this->f("description"));
        $this->p_journal_period_id->SetDBValue(trim($this->f("p_journal_period_id")));
        $this->status_code->SetDBValue($this->f("status_code"));
        $this->start_date->SetDBValue($this->f("start_date"));
        $this->end_date->SetDBValue($this->f("end_date"));
    }
//End SetValues Method

} //End p_journal_periodGridDataSource Class @2-FCB6E20C

class clsRecordp_journal_periodSearch { //p_journal_periodSearch Class @3-A568BB53

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

//Class_Initialize Event @3-F942A31E
    function clsRecordp_journal_periodSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_journal_periodSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_journal_periodSearch";
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
            $this->p_year_periodGridPage = & new clsControl(ccsHidden, "p_year_periodGridPage", "p_year_periodGridPage", ccsText, "", CCGetRequestParam("p_year_periodGridPage", $Method, NULL), $this);
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->periode_s_keyword = & new clsControl(ccsHidden, "periode_s_keyword", "periode_s_keyword", ccsText, "", CCGetRequestParam("periode_s_keyword", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-A5109C7D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_year_periodGridPage->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->periode_s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_periodGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->periode_s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-48767E7C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_year_periodGridPage->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->periode_s_keyword->Errors->Count());
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

//Operation Method @3-8C5C9AC8
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
        $Redirect = "p_journal_period.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_journal_period.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9D72DEBC
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
            $Error = ComposeStrings($Error, $this->p_year_periodGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->periode_s_keyword->Errors->ToString());
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
        $this->p_year_periodGridPage->Show();
        $this->p_year_period_id->Show();
        $this->periode_s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_journal_periodSearch Class @3-FCB6E20C

class clsRecordp_journal_periodForm { //p_journal_periodForm Class @23-B12D922C

//Variables @23-D6FF3E86

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

//Class_Initialize Event @23-8BC2A770
    function clsRecordp_journal_periodForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_journal_periodForm/Error";
        $this->DataSource = new clsp_journal_periodFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_journal_periodForm";
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
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "Id", ccsFloat, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->code = & new clsControl(ccsTextBox, "code", "Bulan", ccsText, "", CCGetRequestParam("code", $Method, NULL), $this);
            $this->code->Required = true;
            $this->status_code = & new clsControl(ccsTextBox, "status_code", "Status", ccsText, "", CCGetRequestParam("status_code", $Method, NULL), $this);
            $this->status_code->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_date->Required = true;
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_by->Required = true;
            $this->start_date = & new clsControl(ccsTextBox, "start_date", "Start Date", ccsText, "", CCGetRequestParam("start_date", $Method, NULL), $this);
            $this->start_date->Required = true;
            $this->end_date = & new clsControl(ccsTextBox, "end_date", "End Date", ccsText, "", CCGetRequestParam("end_date", $Method, NULL), $this);
            $this->end_date->Required = true;
            $this->DatePicker_start_date = & new clsDatePicker("DatePicker_start_date", "p_journal_periodForm", "start_date", $this);
            $this->DatePicker_valid_from1 = & new clsDatePicker("DatePicker_valid_from1", "p_journal_periodForm", "end_date", $this);
            $this->p_status_list_id = & new clsControl(ccsHidden, "p_status_list_id", "p_status_list_id", ccsFloat, "", CCGetRequestParam("p_status_list_id", $Method, NULL), $this);
            $this->p_journal_periodGridPage = & new clsControl(ccsHidden, "p_journal_periodGridPage", "p_journal_periodGridPage", ccsText, "", CCGetRequestParam("p_journal_periodGridPage", $Method, NULL), $this);
            $this->p_journal_period_id = & new clsControl(ccsHidden, "p_journal_period_id", "p_journal_period_id", ccsFloat, "", CCGetRequestParam("p_journal_period_id", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @23-44A9F49D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_journal_period_id"] = CCGetFromGet("p_journal_period_id", NULL);
    }
//End Initialize Method

//Validate Method @23-43BE1968
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->code->Validate() && $Validation);
        $Validation = ($this->status_code->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->start_date->Validate() && $Validation);
        $Validation = ($this->end_date->Validate() && $Validation);
        $Validation = ($this->p_status_list_id->Validate() && $Validation);
        $Validation = ($this->p_journal_periodGridPage->Validate() && $Validation);
        $Validation = ($this->p_journal_period_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->status_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->start_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->end_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_status_list_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_journal_periodGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_journal_period_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-885E2576
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->code->Errors->Count());
        $errors = ($errors || $this->status_code->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->start_date->Errors->Count());
        $errors = ($errors || $this->end_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_start_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from1->Errors->Count());
        $errors = ($errors || $this->p_status_list_id->Errors->Count());
        $errors = ($errors || $this->p_journal_periodGridPage->Errors->Count());
        $errors = ($errors || $this->p_journal_period_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @23-ED598703
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

//Operation Method @23-A4461356
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_journal_period_id", "s_keyword", "p_journal_periodGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_journal_period_id", "s_keyword", "p_journal_periodGridPage"));
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

//InsertRow Method @23-DA2C95A4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->p_status_list_id->SetValue($this->p_status_list_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->start_date->SetValue($this->start_date->GetValue(true));
        $this->DataSource->end_date->SetValue($this->end_date->GetValue(true));
        $this->DataSource->p_year_period_id->SetValue($this->p_year_period_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-48A9389D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->code->SetValue($this->code->GetValue(true));
        $this->DataSource->p_status_list_id->SetValue($this->p_status_list_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->start_date->SetValue($this->start_date->GetValue(true));
        $this->DataSource->end_date->SetValue($this->end_date->GetValue(true));
        $this->DataSource->p_journal_period_id->SetValue($this->p_journal_period_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-746B2D70
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_journal_period_id->SetValue($this->p_journal_period_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-F06A84D1
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
                    $this->p_year_period_id->SetValue($this->DataSource->p_year_period_id->GetValue());
                    $this->code->SetValue($this->DataSource->code->GetValue());
                    $this->status_code->SetValue($this->DataSource->status_code->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->start_date->SetValue($this->DataSource->start_date->GetValue());
                    $this->end_date->SetValue($this->DataSource->end_date->GetValue());
                    $this->p_status_list_id->SetValue($this->DataSource->p_status_list_id->GetValue());
                    $this->p_journal_period_id->SetValue($this->DataSource->p_journal_period_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->status_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->start_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->end_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_start_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_status_list_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_journal_periodGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_journal_period_id->Errors->ToString());
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
        $this->p_year_period_id->Show();
        $this->code->Show();
        $this->status_code->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->start_date->Show();
        $this->end_date->Show();
        $this->DatePicker_start_date->Show();
        $this->DatePicker_valid_from1->Show();
        $this->p_status_list_id->Show();
        $this->p_journal_periodGridPage->Show();
        $this->p_journal_period_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_journal_periodForm Class @23-FCB6E20C

class clsp_journal_periodFormDataSource extends clsDBConnSIKP {  //p_journal_periodFormDataSource Class @23-ABA7CA72

//DataSource Variables @23-ED522E96
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
    var $p_year_period_id;
    var $code;
    var $status_code;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $start_date;
    var $end_date;
    var $p_status_list_id;
    var $p_journal_periodGridPage;
    var $p_journal_period_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-E02CCF19
    function clsp_journal_periodFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_journal_periodForm/Error";
        $this->Initialize();
        $this->p_year_period_id = new clsField("p_year_period_id", ccsFloat, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->status_code = new clsField("status_code", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->start_date = new clsField("start_date", ccsText, "");
        
        $this->end_date = new clsField("end_date", ccsText, "");
        
        $this->p_status_list_id = new clsField("p_status_list_id", ccsFloat, "");
        
        $this->p_journal_periodGridPage = new clsField("p_journal_periodGridPage", ccsText, "");
        
        $this->p_journal_period_id = new clsField("p_journal_period_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-C262AD06
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_journal_period_id", ccsFloat, "", "", $this->Parameters["urlp_journal_period_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-6CC01B79
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.p_journal_period_id, a.p_year_period_id, a.code, to_char(a.start_date,'DD-MON-YYYY') start_date,\n" .
        "to_char(a.end_date,'DD-MON-YYYY') end_date, a.description,\n" .
        "to_char(a.updated_date,'DD-MON-YYYY') updated_date,\n" .
        "a.updated_by,to_char(a.creation_date,'DD-MON-YYYY') creation_date, a.created_by,\n" .
        "b.code status_code, a.p_status_list_id\n" .
        "FROM p_journal_period a, p_status_list b, p_year_period c \n" .
        "WHERE a.p_status_list_id = b.p_status_list_id AND\n" .
        "a.p_journal_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-98D55DB4
    function SetValues()
    {
        $this->p_year_period_id->SetDBValue(trim($this->f("p_year_period_id")));
        $this->code->SetDBValue($this->f("code"));
        $this->status_code->SetDBValue($this->f("status_code"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->start_date->SetDBValue($this->f("start_date"));
        $this->end_date->SetDBValue($this->f("end_date"));
        $this->p_status_list_id->SetDBValue(trim($this->f("p_status_list_id")));
        $this->p_journal_period_id->SetDBValue(trim($this->f("p_journal_period_id")));
    }
//End SetValues Method

//Insert Method @23-543428E5
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_status_list_id"] = new clsSQLParameter("ctrlp_status_list_id", ccsFloat, "", "", $this->p_status_list_id->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr87", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr89", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["start_date"] = new clsSQLParameter("ctrlstart_date", ccsText, "", "", $this->start_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["end_date"] = new clsSQLParameter("ctrlend_date", ccsText, "", "", $this->end_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_year_period_id"] = new clsSQLParameter("ctrlp_year_period_id", ccsFloat, "", "", $this->p_year_period_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["p_status_list_id"]->GetValue()) and !strlen($this->cp["p_status_list_id"]->GetText()) and !is_bool($this->cp["p_status_list_id"]->GetValue())) 
            $this->cp["p_status_list_id"]->SetValue($this->p_status_list_id->GetValue(true));
        if (!strlen($this->cp["p_status_list_id"]->GetText()) and !is_bool($this->cp["p_status_list_id"]->GetValue(true))) 
            $this->cp["p_status_list_id"]->SetText(NULL);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["start_date"]->GetValue()) and !strlen($this->cp["start_date"]->GetText()) and !is_bool($this->cp["start_date"]->GetValue())) 
            $this->cp["start_date"]->SetValue($this->start_date->GetValue(true));
        if (!is_null($this->cp["end_date"]->GetValue()) and !strlen($this->cp["end_date"]->GetText()) and !is_bool($this->cp["end_date"]->GetValue())) 
            $this->cp["end_date"]->SetValue($this->end_date->GetValue(true));
        if (!is_null($this->cp["p_year_period_id"]->GetValue()) and !strlen($this->cp["p_year_period_id"]->GetText()) and !is_bool($this->cp["p_year_period_id"]->GetValue())) 
            $this->cp["p_year_period_id"]->SetValue($this->p_year_period_id->GetValue(true));
        if (!strlen($this->cp["p_year_period_id"]->GetText()) and !is_bool($this->cp["p_year_period_id"]->GetValue(true))) 
            $this->cp["p_year_period_id"]->SetText(0);
        $this->SQL = "INSERT INTO p_journal_period(p_journal_period_id, code, p_status_list_id, start_date, end_date, description, creation_date, created_by, updated_date, updated_by, p_year_period_id) \n" .
        "VALUES(generate_id('sikp','p_journal_period','p_journal_period_id'), '" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["p_status_list_id"]->GetDBValue(), ccsFloat) . ", to_date('" . $this->SQLValue($this->cp["start_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), to_date('" . $this->SQLValue($this->cp["end_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["p_year_period_id"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-0D81A293
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["code"] = new clsSQLParameter("ctrlcode", ccsText, "", "", $this->code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_status_list_id"] = new clsSQLParameter("ctrlp_status_list_id", ccsFloat, "", "", $this->p_status_list_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr64", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["start_date"] = new clsSQLParameter("ctrlstart_date", ccsText, "", "", $this->start_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["end_date"] = new clsSQLParameter("ctrlend_date", ccsText, "", "", $this->end_date->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_journal_period_id"] = new clsSQLParameter("ctrlp_journal_period_id", ccsFloat, "", "", $this->p_journal_period_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["code"]->GetValue()) and !strlen($this->cp["code"]->GetText()) and !is_bool($this->cp["code"]->GetValue())) 
            $this->cp["code"]->SetValue($this->code->GetValue(true));
        if (!is_null($this->cp["p_status_list_id"]->GetValue()) and !strlen($this->cp["p_status_list_id"]->GetText()) and !is_bool($this->cp["p_status_list_id"]->GetValue())) 
            $this->cp["p_status_list_id"]->SetValue($this->p_status_list_id->GetValue(true));
        if (!strlen($this->cp["p_status_list_id"]->GetText()) and !is_bool($this->cp["p_status_list_id"]->GetValue(true))) 
            $this->cp["p_status_list_id"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["start_date"]->GetValue()) and !strlen($this->cp["start_date"]->GetText()) and !is_bool($this->cp["start_date"]->GetValue())) 
            $this->cp["start_date"]->SetValue($this->start_date->GetValue(true));
        if (!is_null($this->cp["end_date"]->GetValue()) and !strlen($this->cp["end_date"]->GetText()) and !is_bool($this->cp["end_date"]->GetValue())) 
            $this->cp["end_date"]->SetValue($this->end_date->GetValue(true));
        if (!is_null($this->cp["p_journal_period_id"]->GetValue()) and !strlen($this->cp["p_journal_period_id"]->GetText()) and !is_bool($this->cp["p_journal_period_id"]->GetValue())) 
            $this->cp["p_journal_period_id"]->SetValue($this->p_journal_period_id->GetValue(true));
        if (!strlen($this->cp["p_journal_period_id"]->GetText()) and !is_bool($this->cp["p_journal_period_id"]->GetValue(true))) 
            $this->cp["p_journal_period_id"]->SetText(0);
        $this->SQL = "UPDATE p_journal_period \n" .
        "SET code='" . $this->SQLValue($this->cp["code"]->GetDBValue(), ccsText) . "', \n" .
        "p_status_list_id=" . $this->SQLValue($this->cp["p_status_list_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "start_date=to_date('" . $this->SQLValue($this->cp["start_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'),\n" .
        "end_date=to_date('" . $this->SQLValue($this->cp["end_date"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'),\n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "' \n" .
        "WHERE p_journal_period_id = " . $this->SQLValue($this->cp["p_journal_period_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-263CEDC5
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_journal_period_id"] = new clsSQLParameter("ctrlp_journal_period_id", ccsFloat, "", "", $this->p_journal_period_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_journal_period_id"]->GetValue()) and !strlen($this->cp["p_journal_period_id"]->GetText()) and !is_bool($this->cp["p_journal_period_id"]->GetValue())) 
            $this->cp["p_journal_period_id"]->SetValue($this->p_journal_period_id->GetValue(true));
        if (!strlen($this->cp["p_journal_period_id"]->GetText()) and !is_bool($this->cp["p_journal_period_id"]->GetValue(true))) 
            $this->cp["p_journal_period_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_journal_period WHERE  p_journal_period_id = " . $this->SQLValue($this->cp["p_journal_period_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_journal_periodFormDataSource Class @23-FCB6E20C

//Initialize Page @1-5E8C4F28
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
$TemplateFileName = "p_journal_period.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-7171A9B5
include_once("./p_journal_period_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-540F72D1
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_journal_periodGrid = & new clsGridp_journal_periodGrid("", $MainPage);
$p_journal_periodSearch = & new clsRecordp_journal_periodSearch("", $MainPage);
$p_journal_periodForm = & new clsRecordp_journal_periodForm("", $MainPage);
$MainPage->p_journal_periodGrid = & $p_journal_periodGrid;
$MainPage->p_journal_periodSearch = & $p_journal_periodSearch;
$MainPage->p_journal_periodForm = & $p_journal_periodForm;
$p_journal_periodGrid->Initialize();
$p_journal_periodForm->Initialize();

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

//Execute Components @1-26074662
$p_journal_periodSearch->Operation();
$p_journal_periodForm->Operation();
//End Execute Components

//Go to destination page @1-9338C0F5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_journal_periodGrid);
    unset($p_journal_periodSearch);
    unset($p_journal_periodForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EDF9D394
$p_journal_periodGrid->Show();
$p_journal_periodSearch->Show();
$p_journal_periodForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F5767F55
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_journal_periodGrid);
unset($p_journal_periodSearch);
unset($p_journal_periodForm);
unset($Tpl);
//End Unload Page


?>
