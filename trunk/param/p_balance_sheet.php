<?php
//Include Common Files @1-3642DBF7
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_balance_sheet.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_balance_sheetGrid { //p_balance_sheetGrid class @2-CEDCB5F7

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

//Class_Initialize Event @2-953E5A65
    function clsGridp_balance_sheetGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_balance_sheetGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_balance_sheetGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_balance_sheetGridDataSource($this);
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
        $this->DLink->Page = "p_balance_sheet.php";
        $this->report_label = & new clsControl(ccsLabel, "report_label", "report_label", ccsText, "", CCGetRequestParam("report_label", ccsGet, NULL), $this);
        $this->p_balance_sheet_id = & new clsControl(ccsHidden, "p_balance_sheet_id", "p_balance_sheet_id", ccsFloat, "", CCGetRequestParam("p_balance_sheet_id", ccsGet, NULL), $this);
        $this->report_level = & new clsControl(ccsLabel, "report_level", "report_level", ccsText, "", CCGetRequestParam("report_level", ccsGet, NULL), $this);
        $this->listing_no = & new clsControl(ccsLabel, "listing_no", "listing_no", ccsFloat, "", CCGetRequestParam("listing_no", ccsGet, NULL), $this);
        $this->is_detail = & new clsControl(ccsLabel, "is_detail", "is_detail", ccsText, "", CCGetRequestParam("is_detail", ccsGet, NULL), $this);
        $this->is_processed = & new clsControl(ccsLabel, "is_processed", "is_processed", ccsText, "", CCGetRequestParam("is_processed", ccsGet, NULL), $this);
        $this->sum_to_code = & new clsControl(ccsLabel, "sum_to_code", "sum_to_code", ccsText, "", CCGetRequestParam("sum_to_code", ccsGet, NULL), $this);
        $this->multiplicator = & new clsControl(ccsLabel, "multiplicator", "multiplicator", ccsText, "", CCGetRequestParam("multiplicator", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_balance_sheet.php";
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

//Show Method @2-7D14C2D3
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
            $this->ControlsVisible["report_label"] = $this->report_label->Visible;
            $this->ControlsVisible["p_balance_sheet_id"] = $this->p_balance_sheet_id->Visible;
            $this->ControlsVisible["report_level"] = $this->report_level->Visible;
            $this->ControlsVisible["listing_no"] = $this->listing_no->Visible;
            $this->ControlsVisible["is_detail"] = $this->is_detail->Visible;
            $this->ControlsVisible["is_processed"] = $this->is_processed->Visible;
            $this->ControlsVisible["sum_to_code"] = $this->sum_to_code->Visible;
            $this->ControlsVisible["multiplicator"] = $this->multiplicator->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_balance_sheet_id", $this->DataSource->f("p_balance_sheet_id"));
                $this->report_label->SetValue($this->DataSource->report_label->GetValue());
                $this->p_balance_sheet_id->SetValue($this->DataSource->p_balance_sheet_id->GetValue());
                $this->report_level->SetValue($this->DataSource->report_level->GetValue());
                $this->listing_no->SetValue($this->DataSource->listing_no->GetValue());
                $this->is_detail->SetValue($this->DataSource->is_detail->GetValue());
                $this->is_processed->SetValue($this->DataSource->is_processed->GetValue());
                $this->sum_to_code->SetValue($this->DataSource->sum_to_code->GetValue());
                $this->multiplicator->SetValue($this->DataSource->multiplicator->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->report_label->Show();
                $this->p_balance_sheet_id->Show();
                $this->report_level->Show();
                $this->listing_no->Show();
                $this->is_detail->Show();
                $this->is_processed->Show();
                $this->sum_to_code->Show();
                $this->multiplicator->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_balance_sheet_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-2318B3D0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->report_label->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_balance_sheet_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->report_level->Errors->ToString());
        $errors = ComposeStrings($errors, $this->listing_no->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_detail->Errors->ToString());
        $errors = ComposeStrings($errors, $this->is_processed->Errors->ToString());
        $errors = ComposeStrings($errors, $this->sum_to_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->multiplicator->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_balance_sheetGrid Class @2-FCB6E20C

class clsp_balance_sheetGridDataSource extends clsDBConnSIKP {  //p_balance_sheetGridDataSource Class @2-EB1ABA2D

//DataSource Variables @2-F41162AC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $report_label;
    var $p_balance_sheet_id;
    var $report_level;
    var $listing_no;
    var $is_detail;
    var $is_processed;
    var $sum_to_code;
    var $multiplicator;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5E964BF9
    function clsp_balance_sheetGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_balance_sheetGrid";
        $this->Initialize();
        $this->report_label = new clsField("report_label", ccsText, "");
        
        $this->p_balance_sheet_id = new clsField("p_balance_sheet_id", ccsFloat, "");
        
        $this->report_level = new clsField("report_level", ccsText, "");
        
        $this->listing_no = new clsField("listing_no", ccsFloat, "");
        
        $this->is_detail = new clsField("is_detail", ccsText, "");
        
        $this->is_processed = new clsField("is_processed", ccsText, "");
        
        $this->sum_to_code = new clsField("sum_to_code", ccsText, "");
        
        $this->multiplicator = new clsField("multiplicator", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-34582E48
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.listing_no";
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

//Open Method @2-49CCB4B6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.p_balance_sheet_id, a.listing_no, a.report_label, \n" .
        "a.left_righ_position, a.report_level, \n" .
        "decode(a.is_detail,'Y','YA','TIDAK')as is_detail, decode(a.is_processed,'Y','YA','TIDAK')as is_processed, \n" .
        "a.sum_to, decode(a.multiplicator,1,'POSITIF','NEGATIF')as multiplicator, a.description, \n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, \n" .
        "a.updated_by, b.report_label as sum_to_code \n" .
        "FROM p_balance_sheet a\n" .
        "LEFT OUTER JOIN p_balance_sheet b ON (b.listing_no=a.sum_to)\n" .
        "WHERE upper(a.report_label) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') cnt";
        $this->SQL = "SELECT a.p_balance_sheet_id, a.listing_no, a.report_label, \n" .
        "a.left_righ_position, a.report_level, \n" .
        "decode(a.is_detail,'Y','YA','TIDAK')as is_detail, decode(a.is_processed,'Y','YA','TIDAK')as is_processed, \n" .
        "a.sum_to, decode(a.multiplicator,1,'POSITIF','NEGATIF')as multiplicator, a.description, \n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, \n" .
        "a.updated_by, b.report_label as sum_to_code \n" .
        "FROM p_balance_sheet a\n" .
        "LEFT OUTER JOIN p_balance_sheet b ON (b.listing_no=a.sum_to)\n" .
        "WHERE upper(a.report_label) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-23C721AF
    function SetValues()
    {
        $this->report_label->SetDBValue($this->f("report_label"));
        $this->p_balance_sheet_id->SetDBValue(trim($this->f("p_balance_sheet_id")));
        $this->report_level->SetDBValue($this->f("report_level"));
        $this->listing_no->SetDBValue(trim($this->f("listing_no")));
        $this->is_detail->SetDBValue($this->f("is_detail"));
        $this->is_processed->SetDBValue($this->f("is_processed"));
        $this->sum_to_code->SetDBValue($this->f("sum_to_code"));
        $this->multiplicator->SetDBValue($this->f("multiplicator"));
    }
//End SetValues Method

} //End p_balance_sheetGridDataSource Class @2-FCB6E20C

class clsRecordp_balance_sheetSearch { //p_balance_sheetSearch Class @3-3C81EB03

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

//Class_Initialize Event @3-55C9B8A7
    function clsRecordp_balance_sheetSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_balance_sheetSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_balance_sheetSearch";
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

//Operation Method @3-27CFD02C
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
        $Redirect = "p_balance_sheet.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_balance_sheet.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_balance_sheetSearch Class @3-FCB6E20C

class clsRecordp_balance_sheetForm { //p_balance_sheetForm Class @94-652E8F26

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

//Class_Initialize Event @94-ABF8CED9
    function clsRecordp_balance_sheetForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_balance_sheetForm/Error";
        $this->DataSource = new clsp_balance_sheetFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_balance_sheetForm";
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
            $this->p_balance_sheet_id = & new clsControl(ccsHidden, "p_balance_sheet_id", "Id", ccsFloat, "", CCGetRequestParam("p_balance_sheet_id", $Method, NULL), $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->p_balance_sheetGridPage = & new clsControl(ccsHidden, "p_balance_sheetGridPage", "p_balance_sheetGridPage", ccsText, "", CCGetRequestParam("p_balance_sheetGridPage", $Method, NULL), $this);
            $this->listing_no = & new clsControl(ccsTextBox, "listing_no", "No Urut", ccsFloat, "", CCGetRequestParam("listing_no", $Method, NULL), $this);
            $this->listing_no->Required = true;
            $this->report_label = & new clsControl(ccsTextBox, "report_label", "Label Data", ccsText, "", CCGetRequestParam("report_label", $Method, NULL), $this);
            $this->is_detail = & new clsControl(ccsListBox, "is_detail", "Detail?", ccsText, "", CCGetRequestParam("is_detail", $Method, NULL), $this);
            $this->is_detail->DSType = dsListOfValues;
            $this->is_detail->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_detail->Required = true;
            $this->is_processed = & new clsControl(ccsListBox, "is_processed", "Diproses?", ccsText, "", CCGetRequestParam("is_processed", $Method, NULL), $this);
            $this->is_processed->DSType = dsListOfValues;
            $this->is_processed->Values = array(array("Y", "YA"), array("N", "TIDAK"));
            $this->is_processed->Required = true;
            $this->left_righ_position = & new clsControl(ccsListBox, "left_righ_position", "Posisi", ccsText, "", CCGetRequestParam("left_righ_position", $Method, NULL), $this);
            $this->left_righ_position->DSType = dsListOfValues;
            $this->left_righ_position->Values = array(array("KIRI", "KIRI"), array("KANAN", "KANAN"));
            $this->multiplicator = & new clsControl(ccsListBox, "multiplicator", "Faktor Pengali", ccsSingle, "", CCGetRequestParam("multiplicator", $Method, NULL), $this);
            $this->multiplicator->DSType = dsListOfValues;
            $this->multiplicator->Values = array(array("1", "POSITIF"), array("-1", "NEGATIF"));
            $this->report_level = & new clsControl(ccsListBox, "report_level", "Tingkat Laporan", ccsFloat, "", CCGetRequestParam("report_level", $Method, NULL), $this);
            $this->report_level->DSType = dsListOfValues;
            $this->report_level->Values = array(array("1", "1"), array("2", "2"), array("3", "3"), array("4", "4"), array("5", "5"));
            $this->sum_to_code = & new clsControl(ccsTextBox, "sum_to_code", "Dijumlahkan ke", ccsText, "", CCGetRequestParam("sum_to_code", $Method, NULL), $this);
            $this->sum_to = & new clsControl(ccsHidden, "sum_to", "Dijumlahkan ke", ccsText, "", CCGetRequestParam("sum_to", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->created_by->Value) && !strlen($this->created_by->Value) && $this->created_by->Value !== false)
                    $this->created_by->SetText(CCGetUserLogin());
                if(!is_array($this->updated_by->Value) && !strlen($this->updated_by->Value) && $this->updated_by->Value !== false)
                    $this->updated_by->SetText(CCGetUserLogin());
                if(!is_array($this->creation_date->Value) && !strlen($this->creation_date->Value) && $this->creation_date->Value !== false)
                    $this->creation_date->SetText(date("d-M-Y"));
                if(!is_array($this->updated_date->Value) && !strlen($this->updated_date->Value) && $this->updated_date->Value !== false)
                    $this->updated_date->SetText(date("d-M-Y"));
                if(!is_array($this->is_detail->Value) && !strlen($this->is_detail->Value) && $this->is_detail->Value !== false)
                    $this->is_detail->SetText("Y");
                if(!is_array($this->is_processed->Value) && !strlen($this->is_processed->Value) && $this->is_processed->Value !== false)
                    $this->is_processed->SetText("Y");
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @94-657EDE11
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_balance_sheet_id"] = CCGetFromGet("p_balance_sheet_id", NULL);
    }
//End Initialize Method

//Validate Method @94-0679614D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_balance_sheet_id->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->p_balance_sheetGridPage->Validate() && $Validation);
        $Validation = ($this->listing_no->Validate() && $Validation);
        $Validation = ($this->report_label->Validate() && $Validation);
        $Validation = ($this->is_detail->Validate() && $Validation);
        $Validation = ($this->is_processed->Validate() && $Validation);
        $Validation = ($this->left_righ_position->Validate() && $Validation);
        $Validation = ($this->multiplicator->Validate() && $Validation);
        $Validation = ($this->report_level->Validate() && $Validation);
        $Validation = ($this->sum_to_code->Validate() && $Validation);
        $Validation = ($this->sum_to->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_balance_sheet_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_balance_sheetGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->listing_no->Errors->Count() == 0);
        $Validation =  $Validation && ($this->report_label->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_detail->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_processed->Errors->Count() == 0);
        $Validation =  $Validation && ($this->left_righ_position->Errors->Count() == 0);
        $Validation =  $Validation && ($this->multiplicator->Errors->Count() == 0);
        $Validation =  $Validation && ($this->report_level->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sum_to_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sum_to->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @94-AEC4ACD4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_balance_sheet_id->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->p_balance_sheetGridPage->Errors->Count());
        $errors = ($errors || $this->listing_no->Errors->Count());
        $errors = ($errors || $this->report_label->Errors->Count());
        $errors = ($errors || $this->is_detail->Errors->Count());
        $errors = ($errors || $this->is_processed->Errors->Count());
        $errors = ($errors || $this->left_righ_position->Errors->Count());
        $errors = ($errors || $this->multiplicator->Errors->Count());
        $errors = ($errors || $this->report_level->Errors->Count());
        $errors = ($errors || $this->sum_to_code->Errors->Count());
        $errors = ($errors || $this->sum_to->Errors->Count());
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

//Operation Method @94-C7196606
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_balance_sheet_id", "s_keyword", "p_balance_sheetGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_balance_sheet_id", "s_keyword", "p_balance_sheetGridPage"));
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

//InsertRow Method @94-20867757
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->report_label->SetValue($this->report_label->GetValue(true));
        $this->DataSource->is_detail->SetValue($this->is_detail->GetValue(true));
        $this->DataSource->is_processed->SetValue($this->is_processed->GetValue(true));
        $this->DataSource->left_righ_position->SetValue($this->left_righ_position->GetValue(true));
        $this->DataSource->multiplicator->SetValue($this->multiplicator->GetValue(true));
        $this->DataSource->report_level->SetValue($this->report_level->GetValue(true));
        $this->DataSource->sum_to->SetValue($this->sum_to->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @94-25BC5C7E
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_balance_sheet_id->SetValue($this->p_balance_sheet_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->listing_no->SetValue($this->listing_no->GetValue(true));
        $this->DataSource->report_label->SetValue($this->report_label->GetValue(true));
        $this->DataSource->is_detail->SetValue($this->is_detail->GetValue(true));
        $this->DataSource->is_processed->SetValue($this->is_processed->GetValue(true));
        $this->DataSource->left_righ_position->SetValue($this->left_righ_position->GetValue(true));
        $this->DataSource->multiplicator->SetValue($this->multiplicator->GetValue(true));
        $this->DataSource->report_level->SetValue($this->report_level->GetValue(true));
        $this->DataSource->sum_to->SetValue($this->sum_to->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @94-38640A53
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_balance_sheet_id->SetValue($this->p_balance_sheet_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @94-196633B0
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

        $this->is_detail->Prepare();
        $this->is_processed->Prepare();
        $this->left_righ_position->Prepare();
        $this->multiplicator->Prepare();
        $this->report_level->Prepare();

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
                    $this->p_balance_sheet_id->SetValue($this->DataSource->p_balance_sheet_id->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->listing_no->SetValue($this->DataSource->listing_no->GetValue());
                    $this->report_label->SetValue($this->DataSource->report_label->GetValue());
                    $this->is_detail->SetValue($this->DataSource->is_detail->GetValue());
                    $this->is_processed->SetValue($this->DataSource->is_processed->GetValue());
                    $this->left_righ_position->SetValue($this->DataSource->left_righ_position->GetValue());
                    $this->multiplicator->SetValue($this->DataSource->multiplicator->GetValue());
                    $this->report_level->SetValue($this->DataSource->report_level->GetValue());
                    $this->sum_to_code->SetValue($this->DataSource->sum_to_code->GetValue());
                    $this->sum_to->SetValue($this->DataSource->sum_to->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_balance_sheet_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_balance_sheetGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->listing_no->Errors->ToString());
            $Error = ComposeStrings($Error, $this->report_label->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_detail->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_processed->Errors->ToString());
            $Error = ComposeStrings($Error, $this->left_righ_position->Errors->ToString());
            $Error = ComposeStrings($Error, $this->multiplicator->Errors->ToString());
            $Error = ComposeStrings($Error, $this->report_level->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sum_to_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sum_to->Errors->ToString());
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
        $this->p_balance_sheet_id->Show();
        $this->description->Show();
        $this->created_by->Show();
        $this->updated_by->Show();
        $this->creation_date->Show();
        $this->updated_date->Show();
        $this->p_balance_sheetGridPage->Show();
        $this->listing_no->Show();
        $this->report_label->Show();
        $this->is_detail->Show();
        $this->is_processed->Show();
        $this->left_righ_position->Show();
        $this->multiplicator->Show();
        $this->report_level->Show();
        $this->sum_to_code->Show();
        $this->sum_to->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_balance_sheetForm Class @94-FCB6E20C

class clsp_balance_sheetFormDataSource extends clsDBConnSIKP {  //p_balance_sheetFormDataSource Class @94-B42D2CD9

//DataSource Variables @94-B59C0461
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
    var $p_balance_sheet_id;
    var $description;
    var $created_by;
    var $updated_by;
    var $creation_date;
    var $updated_date;
    var $p_balance_sheetGridPage;
    var $listing_no;
    var $report_label;
    var $is_detail;
    var $is_processed;
    var $left_righ_position;
    var $multiplicator;
    var $report_level;
    var $sum_to_code;
    var $sum_to;
//End DataSource Variables

//DataSourceClass_Initialize Event @94-4AEF8E73
    function clsp_balance_sheetFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_balance_sheetForm/Error";
        $this->Initialize();
        $this->p_balance_sheet_id = new clsField("p_balance_sheet_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->p_balance_sheetGridPage = new clsField("p_balance_sheetGridPage", ccsText, "");
        
        $this->listing_no = new clsField("listing_no", ccsFloat, "");
        
        $this->report_label = new clsField("report_label", ccsText, "");
        
        $this->is_detail = new clsField("is_detail", ccsText, "");
        
        $this->is_processed = new clsField("is_processed", ccsText, "");
        
        $this->left_righ_position = new clsField("left_righ_position", ccsText, "");
        
        $this->multiplicator = new clsField("multiplicator", ccsSingle, "");
        
        $this->report_level = new clsField("report_level", ccsFloat, "");
        
        $this->sum_to_code = new clsField("sum_to_code", ccsText, "");
        
        $this->sum_to = new clsField("sum_to", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @94-B3862861
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_balance_sheet_id", ccsFloat, "", "", $this->Parameters["urlp_balance_sheet_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @94-49CDEA99
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.p_balance_sheet_id, a.listing_no, a.report_label, a.left_righ_position, a.report_level, a.is_detail, a.is_processed, a.sum_to, a.multiplicator,\n" .
        "a.description, to_char(a.creation_date,'DD-MON-YYYY')as creation_date, a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, \n" .
        "a.updated_by, b.report_label as sum_to_code \n" .
        "FROM p_balance_sheet a\n" .
        "LEFT OUTER JOIN p_balance_sheet b ON (b.listing_no=a.sum_to) \n" .
        "WHERE a.p_balance_sheet_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " ";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @94-A5938FAC
    function SetValues()
    {
        $this->p_balance_sheet_id->SetDBValue(trim($this->f("p_balance_sheet_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->listing_no->SetDBValue(trim($this->f("listing_no")));
        $this->report_label->SetDBValue($this->f("report_label"));
        $this->is_detail->SetDBValue($this->f("is_detail"));
        $this->is_processed->SetDBValue($this->f("is_processed"));
        $this->left_righ_position->SetDBValue($this->f("left_righ_position"));
        $this->multiplicator->SetDBValue(trim($this->f("multiplicator")));
        $this->report_level->SetDBValue(trim($this->f("report_level")));
        $this->sum_to_code->SetDBValue($this->f("sum_to_code"));
        $this->sum_to->SetDBValue($this->f("sum_to"));
    }
//End SetValues Method

//Insert Method @94-5FB4A84A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr661", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr662", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["report_label"] = new clsSQLParameter("ctrlreport_label", ccsText, "", "", $this->report_label->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_detail"] = new clsSQLParameter("ctrlis_detail", ccsText, "", "", $this->is_detail->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_processed"] = new clsSQLParameter("ctrlis_processed", ccsText, "", "", $this->is_processed->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["left_righ_position"] = new clsSQLParameter("ctrlleft_righ_position", ccsText, "", "", $this->left_righ_position->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["multiplicator"] = new clsSQLParameter("ctrlmultiplicator", ccsSingle, "", "", $this->multiplicator->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["report_level"] = new clsSQLParameter("ctrlreport_level", ccsFloat, "", "", $this->report_level->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["sum_to"] = new clsSQLParameter("ctrlsum_to", ccsText, "", "", $this->sum_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!is_null($this->cp["report_label"]->GetValue()) and !strlen($this->cp["report_label"]->GetText()) and !is_bool($this->cp["report_label"]->GetValue())) 
            $this->cp["report_label"]->SetValue($this->report_label->GetValue(true));
        if (!is_null($this->cp["is_detail"]->GetValue()) and !strlen($this->cp["is_detail"]->GetText()) and !is_bool($this->cp["is_detail"]->GetValue())) 
            $this->cp["is_detail"]->SetValue($this->is_detail->GetValue(true));
        if (!is_null($this->cp["is_processed"]->GetValue()) and !strlen($this->cp["is_processed"]->GetText()) and !is_bool($this->cp["is_processed"]->GetValue())) 
            $this->cp["is_processed"]->SetValue($this->is_processed->GetValue(true));
        if (!is_null($this->cp["left_righ_position"]->GetValue()) and !strlen($this->cp["left_righ_position"]->GetText()) and !is_bool($this->cp["left_righ_position"]->GetValue())) 
            $this->cp["left_righ_position"]->SetValue($this->left_righ_position->GetValue(true));
        if (!is_null($this->cp["multiplicator"]->GetValue()) and !strlen($this->cp["multiplicator"]->GetText()) and !is_bool($this->cp["multiplicator"]->GetValue())) 
            $this->cp["multiplicator"]->SetValue($this->multiplicator->GetValue(true));
        if (!is_null($this->cp["report_level"]->GetValue()) and !strlen($this->cp["report_level"]->GetText()) and !is_bool($this->cp["report_level"]->GetValue())) 
            $this->cp["report_level"]->SetValue($this->report_level->GetValue(true));
        if (!strlen($this->cp["report_level"]->GetText()) and !is_bool($this->cp["report_level"]->GetValue(true))) 
            $this->cp["report_level"]->SetText(0);
        if (!is_null($this->cp["sum_to"]->GetValue()) and !strlen($this->cp["sum_to"]->GetText()) and !is_bool($this->cp["sum_to"]->GetValue())) 
            $this->cp["sum_to"]->SetValue($this->sum_to->GetValue(true));
        $this->SQL = "INSERT INTO p_balance_sheet(p_balance_sheet_id,listing_no, report_label, is_detail, is_processed, description, creation_date, created_by, updated_by, updated_date, sum_to, multiplicator, report_level, left_righ_position) \n" .
        "VALUES(generate_id('sikp','p_balance_sheet','p_balance_sheet_id'),'" . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . "', '" . $this->SQLValue($this->cp["report_label"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_detail"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["is_processed"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["sum_to"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["multiplicator"]->GetDBValue(), ccsSingle) . "', decode('" . $this->SQLValue($this->cp["report_level"]->GetDBValue(), ccsFloat) . "',0,null,'" . $this->SQLValue($this->cp["report_level"]->GetDBValue(), ccsFloat) . "'), '" . $this->SQLValue($this->cp["left_righ_position"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @94-40F6C683
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_balance_sheet_id"] = new clsSQLParameter("ctrlp_balance_sheet_id", ccsFloat, "", "", $this->p_balance_sheet_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr692", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["listing_no"] = new clsSQLParameter("ctrllisting_no", ccsFloat, "", "", $this->listing_no->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["report_label"] = new clsSQLParameter("ctrlreport_label", ccsText, "", "", $this->report_label->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_detail"] = new clsSQLParameter("ctrlis_detail", ccsText, "", "", $this->is_detail->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["is_processed"] = new clsSQLParameter("ctrlis_processed", ccsText, "", "", $this->is_processed->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["left_righ_position"] = new clsSQLParameter("ctrlleft_righ_position", ccsText, "", "", $this->left_righ_position->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["multiplicator"] = new clsSQLParameter("ctrlmultiplicator", ccsSingle, "", "", $this->multiplicator->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["report_level"] = new clsSQLParameter("ctrlreport_level", ccsFloat, "", "", $this->report_level->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["sum_to"] = new clsSQLParameter("ctrlsum_to", ccsText, "", "", $this->sum_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_balance_sheet_id"]->GetValue()) and !strlen($this->cp["p_balance_sheet_id"]->GetText()) and !is_bool($this->cp["p_balance_sheet_id"]->GetValue())) 
            $this->cp["p_balance_sheet_id"]->SetValue($this->p_balance_sheet_id->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["listing_no"]->GetValue()) and !strlen($this->cp["listing_no"]->GetText()) and !is_bool($this->cp["listing_no"]->GetValue())) 
            $this->cp["listing_no"]->SetValue($this->listing_no->GetValue(true));
        if (!is_null($this->cp["report_label"]->GetValue()) and !strlen($this->cp["report_label"]->GetText()) and !is_bool($this->cp["report_label"]->GetValue())) 
            $this->cp["report_label"]->SetValue($this->report_label->GetValue(true));
        if (!is_null($this->cp["is_detail"]->GetValue()) and !strlen($this->cp["is_detail"]->GetText()) and !is_bool($this->cp["is_detail"]->GetValue())) 
            $this->cp["is_detail"]->SetValue($this->is_detail->GetValue(true));
        if (!is_null($this->cp["is_processed"]->GetValue()) and !strlen($this->cp["is_processed"]->GetText()) and !is_bool($this->cp["is_processed"]->GetValue())) 
            $this->cp["is_processed"]->SetValue($this->is_processed->GetValue(true));
        if (!is_null($this->cp["left_righ_position"]->GetValue()) and !strlen($this->cp["left_righ_position"]->GetText()) and !is_bool($this->cp["left_righ_position"]->GetValue())) 
            $this->cp["left_righ_position"]->SetValue($this->left_righ_position->GetValue(true));
        if (!is_null($this->cp["multiplicator"]->GetValue()) and !strlen($this->cp["multiplicator"]->GetText()) and !is_bool($this->cp["multiplicator"]->GetValue())) 
            $this->cp["multiplicator"]->SetValue($this->multiplicator->GetValue(true));
        if (!is_null($this->cp["report_level"]->GetValue()) and !strlen($this->cp["report_level"]->GetText()) and !is_bool($this->cp["report_level"]->GetValue())) 
            $this->cp["report_level"]->SetValue($this->report_level->GetValue(true));
        if (!strlen($this->cp["report_level"]->GetText()) and !is_bool($this->cp["report_level"]->GetValue(true))) 
            $this->cp["report_level"]->SetText(0);
        if (!is_null($this->cp["sum_to"]->GetValue()) and !strlen($this->cp["sum_to"]->GetText()) and !is_bool($this->cp["sum_to"]->GetValue())) 
            $this->cp["sum_to"]->SetValue($this->sum_to->GetValue(true));
        $this->SQL = "UPDATE p_balance_sheet SET\n" .
        "listing_no='" . $this->SQLValue($this->cp["listing_no"]->GetDBValue(), ccsFloat) . "', \n" .
        "report_label='" . $this->SQLValue($this->cp["report_label"]->GetDBValue(), ccsText) . "', \n" .
        "is_detail='" . $this->SQLValue($this->cp["is_detail"]->GetDBValue(), ccsText) . "', \n" .
        "is_processed='" . $this->SQLValue($this->cp["is_processed"]->GetDBValue(), ccsText) . "', \n" .
        "description=initcap(trim('" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "')),\n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate,\n" .
        "sum_to='" . $this->SQLValue($this->cp["sum_to"]->GetDBValue(), ccsText) . "', \n" .
        "multiplicator='" . $this->SQLValue($this->cp["multiplicator"]->GetDBValue(), ccsSingle) . "', \n" .
        "report_level=decode('" . $this->SQLValue($this->cp["report_level"]->GetDBValue(), ccsFloat) . "',0,null, '" . $this->SQLValue($this->cp["report_level"]->GetDBValue(), ccsFloat) . "'),\n" .
        "left_righ_position='" . $this->SQLValue($this->cp["left_righ_position"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE p_balance_sheet_id = " . $this->SQLValue($this->cp["p_balance_sheet_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @94-86C3157B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_balance_sheet_id"] = new clsSQLParameter("ctrlp_balance_sheet_id", ccsFloat, "", "", $this->p_balance_sheet_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_balance_sheet_id"]->GetValue()) and !strlen($this->cp["p_balance_sheet_id"]->GetText()) and !is_bool($this->cp["p_balance_sheet_id"]->GetValue())) 
            $this->cp["p_balance_sheet_id"]->SetValue($this->p_balance_sheet_id->GetValue(true));
        if (!strlen($this->cp["p_balance_sheet_id"]->GetText()) and !is_bool($this->cp["p_balance_sheet_id"]->GetValue(true))) 
            $this->cp["p_balance_sheet_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_balance_sheet \n" .
        "WHERE p_balance_sheet_id = " . $this->SQLValue($this->cp["p_balance_sheet_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_balance_sheetFormDataSource Class @94-FCB6E20C

//Initialize Page @1-D8C9E966
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
$TemplateFileName = "p_balance_sheet.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CF7CDE70
include_once("./p_balance_sheet_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7446C36F
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_balance_sheetGrid = & new clsGridp_balance_sheetGrid("", $MainPage);
$p_balance_sheetSearch = & new clsRecordp_balance_sheetSearch("", $MainPage);
$p_balance_sheetForm = & new clsRecordp_balance_sheetForm("", $MainPage);
$MainPage->p_balance_sheetGrid = & $p_balance_sheetGrid;
$MainPage->p_balance_sheetSearch = & $p_balance_sheetSearch;
$MainPage->p_balance_sheetForm = & $p_balance_sheetForm;
$p_balance_sheetGrid->Initialize();
$p_balance_sheetForm->Initialize();

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

//Execute Components @1-C88C80EB
$p_balance_sheetSearch->Operation();
$p_balance_sheetForm->Operation();
//End Execute Components

//Go to destination page @1-478F0DF9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_balance_sheetGrid);
    unset($p_balance_sheetSearch);
    unset($p_balance_sheetForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B9CEEE4D
$p_balance_sheetGrid->Show();
$p_balance_sheetSearch->Show();
$p_balance_sheetForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FE82E7FB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_balance_sheetGrid);
unset($p_balance_sheetSearch);
unset($p_balance_sheetForm);
unset($Tpl);
//End Unload Page


?>
