<?php
//Include Common Files @1-804A0C44
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_bsheet_exception.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_bsheet_exceptionGrid { //p_bsheet_exceptionGrid class @2-37CDEFEA

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

//Class_Initialize Event @2-9D56ACB0
    function clsGridp_bsheet_exceptionGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_bsheet_exceptionGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_bsheet_exceptionGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_bsheet_exceptionGridDataSource($this);
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

        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->full_account_code = & new clsControl(ccsLabel, "full_account_code", "full_account_code", ccsText, "", CCGetRequestParam("full_account_code", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "p_bsheet_exception.php";
        $this->p_bsheet_exception_id = & new clsControl(ccsHidden, "p_bsheet_exception_id", "Id", ccsFloat, "", CCGetRequestParam("p_bsheet_exception_id", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_bsheet_exception.php";
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

//Show Method @2-57FAC4A3
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_bsheet_source_id"] = CCGetFromGet("p_bsheet_source_id", NULL);
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
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["full_account_code"] = $this->full_account_code->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["p_bsheet_exception_id"] = $this->p_bsheet_exception_id->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->full_account_code->SetValue($this->DataSource->full_account_code->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_bsheet_exception_id", $this->DataSource->f("p_bsheet_exception_id"));
                $this->p_bsheet_exception_id->SetValue($this->DataSource->p_bsheet_exception_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->description->Show();
                $this->full_account_code->Show();
                $this->DLink->Show();
                $this->p_bsheet_exception_id->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_bsheet_exception_id", "s_keyword", "ccsForm"));
        $this->Insert_Link->Parameters = CCAddParam($this->Insert_Link->Parameters, "FLAG", "ADD");
        $this->Navigator->Show();
        $this->Insert_Link->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-18B7490F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->full_account_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_bsheet_exception_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_bsheet_exceptionGrid Class @2-FCB6E20C

class clsp_bsheet_exceptionGridDataSource extends clsDBConnSIKP {  //p_bsheet_exceptionGridDataSource Class @2-163D6076

//DataSource Variables @2-519D3573
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $valid_from;
    var $valid_to;
    var $description;
    var $full_account_code;
    var $p_bsheet_exception_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C1550CF1
    function clsp_bsheet_exceptionGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_bsheet_exceptionGrid";
        $this->Initialize();
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->full_account_code = new clsField("full_account_code", ccsText, "");
        
        $this->p_bsheet_exception_id = new clsField("p_bsheet_exception_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-6AF9D48A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "a.p_bsheet_exception_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-938565DE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_bsheet_source_id", ccsFloat, "", "", $this->Parameters["urlp_bsheet_source_id"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
    }
//End Prepare Method

//Open Method @2-25FC6570
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT a.p_bsheet_exception_id, a.p_bsheet_source_id, a.full_account_code, \n" .
        "to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to, a.description, \n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date,\n" .
        "a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by \n" .
        "FROM p_bsheet_exception a, p_bsheet_source b\n" .
        "WHERE a.p_bsheet_source_id = b.p_bsheet_source_id AND\n" .
        "a.p_bsheet_source_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " AND\n" .
        "upper(a.full_account_code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%') cnt";
        $this->SQL = "SELECT a.p_bsheet_exception_id, a.p_bsheet_source_id, a.full_account_code, \n" .
        "to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to, a.description, \n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date,\n" .
        "a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by \n" .
        "FROM p_bsheet_exception a, p_bsheet_source b\n" .
        "WHERE a.p_bsheet_source_id = b.p_bsheet_source_id AND\n" .
        "a.p_bsheet_source_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " AND\n" .
        "upper(a.full_account_code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "%' {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-EFDA0FD7
    function SetValues()
    {
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->description->SetDBValue($this->f("description"));
        $this->full_account_code->SetDBValue($this->f("full_account_code"));
        $this->p_bsheet_exception_id->SetDBValue(trim($this->f("p_bsheet_exception_id")));
    }
//End SetValues Method

} //End p_bsheet_exceptionGridDataSource Class @2-FCB6E20C

class clsRecordp_bsheet_exceptionSearch { //p_bsheet_exceptionSearch Class @3-B3CF9914

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

//Class_Initialize Event @3-53A50671
    function clsRecordp_bsheet_exceptionSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_bsheet_exceptionSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_bsheet_exceptionSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = & new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = & new clsButton("Button_DoSearch", $Method, $this);
            $this->p_balance_sheet_id = & new clsControl(ccsHidden, "p_balance_sheet_id", "p_balance_sheet_id", ccsText, "", CCGetRequestParam("p_balance_sheet_id", $Method, NULL), $this);
            $this->p_balance_sheetGridPage = & new clsControl(ccsHidden, "p_balance_sheetGridPage", "p_balance_sheetGridPage", ccsText, "", CCGetRequestParam("p_balance_sheetGridPage", $Method, NULL), $this);
            $this->balance_s_keyword = & new clsControl(ccsHidden, "balance_s_keyword", "balance_s_keyword", ccsText, "", CCGetRequestParam("balance_s_keyword", $Method, NULL), $this);
            $this->balance_code = & new clsControl(ccsHidden, "balance_code", "balance_code", ccsText, "", CCGetRequestParam("balance_code", $Method, NULL), $this);
            $this->p_bsheet_source_id = & new clsControl(ccsHidden, "p_bsheet_source_id", "p_bsheet_source_id", ccsText, "", CCGetRequestParam("p_bsheet_source_id", $Method, NULL), $this);
            $this->p_bsheet_sourceGridPage = & new clsControl(ccsHidden, "p_bsheet_sourceGridPage", "p_bsheet_sourceGridPage", ccsText, "", CCGetRequestParam("p_bsheet_sourceGridPage", $Method, NULL), $this);
            $this->bsheet_code = & new clsControl(ccsHidden, "bsheet_code", "bsheet_code", ccsText, "", CCGetRequestParam("bsheet_code", $Method, NULL), $this);
            $this->bsheet_s_keyword = & new clsControl(ccsHidden, "bsheet_s_keyword", "bsheet_s_keyword", ccsText, "", CCGetRequestParam("bsheet_s_keyword", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-79039BFB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_balance_sheet_id->Validate() && $Validation);
        $Validation = ($this->p_balance_sheetGridPage->Validate() && $Validation);
        $Validation = ($this->balance_s_keyword->Validate() && $Validation);
        $Validation = ($this->balance_code->Validate() && $Validation);
        $Validation = ($this->p_bsheet_source_id->Validate() && $Validation);
        $Validation = ($this->p_bsheet_sourceGridPage->Validate() && $Validation);
        $Validation = ($this->bsheet_code->Validate() && $Validation);
        $Validation = ($this->bsheet_s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_balance_sheet_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_balance_sheetGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->balance_s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->balance_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bsheet_source_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bsheet_sourceGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bsheet_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->bsheet_s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-5141AB07
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_balance_sheet_id->Errors->Count());
        $errors = ($errors || $this->p_balance_sheetGridPage->Errors->Count());
        $errors = ($errors || $this->balance_s_keyword->Errors->Count());
        $errors = ($errors || $this->balance_code->Errors->Count());
        $errors = ($errors || $this->p_bsheet_source_id->Errors->Count());
        $errors = ($errors || $this->p_bsheet_sourceGridPage->Errors->Count());
        $errors = ($errors || $this->bsheet_code->Errors->Count());
        $errors = ($errors || $this->bsheet_s_keyword->Errors->Count());
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

//Operation Method @3-C9F665CF
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
        $Redirect = "p_bsheet_exception.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_bsheet_exception.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-CCD2791F
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
            $Error = ComposeStrings($Error, $this->p_balance_sheet_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_balance_sheetGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->balance_s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->balance_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bsheet_source_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bsheet_sourceGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bsheet_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->bsheet_s_keyword->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $this->p_balance_sheet_id->Show();
        $this->p_balance_sheetGridPage->Show();
        $this->balance_s_keyword->Show();
        $this->balance_code->Show();
        $this->p_bsheet_source_id->Show();
        $this->p_bsheet_sourceGridPage->Show();
        $this->bsheet_code->Show();
        $this->bsheet_s_keyword->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End p_bsheet_exceptionSearch Class @3-FCB6E20C

class clsRecordp_bsheet_exceptionForm { //p_bsheet_exceptionForm Class @23-3D9CC19C

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

//Class_Initialize Event @23-8C41F2D1
    function clsRecordp_bsheet_exceptionForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_bsheet_exceptionForm/Error";
        $this->DataSource = new clsp_bsheet_exceptionFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_bsheet_exceptionForm";
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
            $this->p_bsheet_exception_id = & new clsControl(ccsHidden, "p_bsheet_exception_id", "Id", ccsFloat, "", CCGetRequestParam("p_bsheet_exception_id", $Method, NULL), $this);
            $this->full_account_code = & new clsControl(ccsTextBox, "full_account_code", "Akun Lunas", ccsText, "", CCGetRequestParam("full_account_code", $Method, NULL), $this);
            $this->full_account_code->Required = true;
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid From", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "p_bsheet_exceptionForm", "valid_from", $this);
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid To", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "p_bsheet_exceptionForm", "valid_to", $this);
            $this->p_bsheet_source_id = & new clsControl(ccsHidden, "p_bsheet_source_id", "p_bsheet_source_id", ccsText, "", CCGetRequestParam("p_bsheet_source_id", $Method, NULL), $this);
            $this->p_bsheet_exceptionGridPage = & new clsControl(ccsHidden, "p_bsheet_exceptionGridPage", "p_bsheet_exceptionGridPage", ccsText, "", CCGetRequestParam("p_bsheet_exceptionGridPage", $Method, NULL), $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->valid_from->Value) && !strlen($this->valid_from->Value) && $this->valid_from->Value !== false)
                    $this->valid_from->SetText(date("d-M-Y"));
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

//Initialize Method @23-021B2521
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_bsheet_exception_id"] = CCGetFromGet("p_bsheet_exception_id", NULL);
        $this->DataSource->Parameters["urlp_bsheet_source_id"] = CCGetFromGet("p_bsheet_source_id", NULL);
    }
//End Initialize Method

//Validate Method @23-482843BB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_bsheet_exception_id->Validate() && $Validation);
        $Validation = ($this->full_account_code->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $Validation = ($this->p_bsheet_source_id->Validate() && $Validation);
        $Validation = ($this->p_bsheet_exceptionGridPage->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_bsheet_exception_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->full_account_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bsheet_source_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_bsheet_exceptionGridPage->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-6EB5A718
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_bsheet_exception_id->Errors->Count());
        $errors = ($errors || $this->full_account_code->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
        $errors = ($errors || $this->p_bsheet_source_id->Errors->Count());
        $errors = ($errors || $this->p_bsheet_exceptionGridPage->Errors->Count());
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

//Operation Method @23-04B87EDB
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_bsheet_exception_id", "s_keyword", "FLAG", "p_bsheet_exceptionGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "p_bsheet_exception_id", "s_keyword", "FLAG", "p_bsheet_exceptionGridPage"));
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

//InsertRow Method @23-089D2784
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->p_bsheet_source_id->SetValue($this->p_bsheet_source_id->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->full_account_code->SetValue($this->full_account_code->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-E028242B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_bsheet_exception_id->SetValue($this->p_bsheet_exception_id->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->full_account_code->SetValue($this->full_account_code->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-DC105CB0
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_bsheet_exception_id->SetValue($this->p_bsheet_exception_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-0DBC8848
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
                    $this->p_bsheet_exception_id->SetValue($this->DataSource->p_bsheet_exception_id->GetValue());
                    $this->full_account_code->SetValue($this->DataSource->full_account_code->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                    $this->p_bsheet_source_id->SetValue($this->DataSource->p_bsheet_source_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_bsheet_exception_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->full_account_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bsheet_source_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_bsheet_exceptionGridPage->Errors->ToString());
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
        $this->p_bsheet_exception_id->Show();
        $this->full_account_code->Show();
        $this->valid_from->Show();
        $this->DatePicker_valid_from->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_to->Show();
        $this->p_bsheet_source_id->Show();
        $this->p_bsheet_exceptionGridPage->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_bsheet_exceptionForm Class @23-FCB6E20C

class clsp_bsheet_exceptionFormDataSource extends clsDBConnSIKP {  //p_bsheet_exceptionFormDataSource Class @23-490AF682

//DataSource Variables @23-FC411636
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
    var $p_bsheet_exception_id;
    var $full_account_code;
    var $valid_from;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $valid_to;
    var $p_bsheet_source_id;
    var $p_bsheet_exceptionGridPage;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-98FC98B9
    function clsp_bsheet_exceptionFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_bsheet_exceptionForm/Error";
        $this->Initialize();
        $this->p_bsheet_exception_id = new clsField("p_bsheet_exception_id", ccsFloat, "");
        
        $this->full_account_code = new clsField("full_account_code", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->p_bsheet_source_id = new clsField("p_bsheet_source_id", ccsText, "");
        
        $this->p_bsheet_exceptionGridPage = new clsField("p_bsheet_exceptionGridPage", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-785AC9E2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_bsheet_exception_id", ccsInteger, "", "", $this->Parameters["urlp_bsheet_exception_id"], 0, false);
        $this->wp->AddParameter("2", "urlp_bsheet_source_id", ccsInteger, "", "", $this->Parameters["urlp_bsheet_source_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-8AD537D0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT a.p_bsheet_exception_id, a.p_bsheet_source_id, a.full_account_code, \n" .
        "to_char(a.valid_from,'DD-MON-YYYY')as valid_from, to_char(a.valid_to,'DD-MON-YYYY')as valid_to, a.description, \n" .
        "to_char(a.creation_date,'DD-MON-YYYY')as creation_date,\n" .
        "a.created_by, to_char(a.updated_date,'DD-MON-YYYY')as updated_date, a.updated_by \n" .
        "FROM p_bsheet_exception a, p_bsheet_source b\n" .
        "WHERE a.p_bsheet_source_id = b.p_bsheet_source_id AND\n" .
        "a.p_bsheet_source_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " AND\n" .
        "a.p_bsheet_exception_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-46D43750
    function SetValues()
    {
        $this->p_bsheet_exception_id->SetDBValue(trim($this->f("p_bsheet_exception_id")));
        $this->full_account_code->SetDBValue($this->f("full_account_code"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->p_bsheet_source_id->SetDBValue($this->f("p_bsheet_source_id"));
    }
//End SetValues Method

//Insert Method @23-9AA02A03
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_bsheet_source_id"] = new clsSQLParameter("ctrlp_bsheet_source_id", ccsFloat, "", "", $this->p_bsheet_source_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr139", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr140", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["full_account_code"] = new clsSQLParameter("ctrlfull_account_code", ccsText, "", "", $this->full_account_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["p_bsheet_source_id"]->GetValue()) and !strlen($this->cp["p_bsheet_source_id"]->GetText()) and !is_bool($this->cp["p_bsheet_source_id"]->GetValue())) 
            $this->cp["p_bsheet_source_id"]->SetValue($this->p_bsheet_source_id->GetValue(true));
        if (!strlen($this->cp["p_bsheet_source_id"]->GetText()) and !is_bool($this->cp["p_bsheet_source_id"]->GetValue(true))) 
            $this->cp["p_bsheet_source_id"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["full_account_code"]->GetValue()) and !strlen($this->cp["full_account_code"]->GetText()) and !is_bool($this->cp["full_account_code"]->GetValue())) 
            $this->cp["full_account_code"]->SetValue($this->full_account_code->GetValue(true));
        $this->SQL = "INSERT INTO p_bsheet_exception(p_bsheet_exception_id, p_bsheet_source_id, valid_from, description, creation_date, created_by, updated_date, updated_by, valid_to, full_account_code) \n" .
        "VALUES(generate_id('sikp','p_bsheet_exception','p_bsheet_exception_id'), " . $this->SQLValue($this->cp["p_bsheet_source_id"]->GetDBValue(), ccsFloat) . ", to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','dd-mon-yyyy'), '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end, '" . $this->SQLValue($this->cp["full_account_code"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-C5670BF8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_bsheet_exception_id"] = new clsSQLParameter("ctrlp_bsheet_exception_id", ccsFloat, "", "", $this->p_bsheet_exception_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr64", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["full_account_code"] = new clsSQLParameter("ctrlfull_account_code", ccsText, "", "", $this->full_account_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_bsheet_exception_id"]->GetValue()) and !strlen($this->cp["p_bsheet_exception_id"]->GetText()) and !is_bool($this->cp["p_bsheet_exception_id"]->GetValue())) 
            $this->cp["p_bsheet_exception_id"]->SetValue($this->p_bsheet_exception_id->GetValue(true));
        if (!strlen($this->cp["p_bsheet_exception_id"]->GetText()) and !is_bool($this->cp["p_bsheet_exception_id"]->GetValue(true))) 
            $this->cp["p_bsheet_exception_id"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["full_account_code"]->GetValue()) and !strlen($this->cp["full_account_code"]->GetText()) and !is_bool($this->cp["full_account_code"]->GetValue())) 
            $this->cp["full_account_code"]->SetValue($this->full_account_code->GetValue(true));
        $this->SQL = "UPDATE p_bsheet_exception SET \n" .
        "full_account_code='" . $this->SQLValue($this->cp["full_account_code"]->GetDBValue(), ccsText) . "',\n" .
        "valid_from=to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','dd-mon-yyyy'), \n" .
        "valid_to=case when '" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "' = '' then null else to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','dd-mon-yyyy') end, \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE p_bsheet_exception_id = " . $this->SQLValue($this->cp["p_bsheet_exception_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-AA45D05E
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_bsheet_exception_id"] = new clsSQLParameter("ctrlp_bsheet_exception_id", ccsFloat, "", "", $this->p_bsheet_exception_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_bsheet_exception_id"]->GetValue()) and !strlen($this->cp["p_bsheet_exception_id"]->GetText()) and !is_bool($this->cp["p_bsheet_exception_id"]->GetValue())) 
            $this->cp["p_bsheet_exception_id"]->SetValue($this->p_bsheet_exception_id->GetValue(true));
        if (!strlen($this->cp["p_bsheet_exception_id"]->GetText()) and !is_bool($this->cp["p_bsheet_exception_id"]->GetValue(true))) 
            $this->cp["p_bsheet_exception_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_bsheet_exception \n" .
        "WHERE p_bsheet_exception_id = " . $this->SQLValue($this->cp["p_bsheet_exception_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_bsheet_exceptionFormDataSource Class @23-FCB6E20C

//Initialize Page @1-B8C6FA67
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
$TemplateFileName = "p_bsheet_exception.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8E1B4CCE
include_once("./p_bsheet_exception_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A6FD4599
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_bsheet_exceptionGrid = & new clsGridp_bsheet_exceptionGrid("", $MainPage);
$p_bsheet_exceptionSearch = & new clsRecordp_bsheet_exceptionSearch("", $MainPage);
$bsheet_code = & new clsControl(ccsLabel, "bsheet_code", "bsheet_code", ccsText, "", CCGetRequestParam("bsheet_code", ccsGet, NULL), $MainPage);
$p_bsheet_exceptionForm = & new clsRecordp_bsheet_exceptionForm("", $MainPage);
$MainPage->p_bsheet_exceptionGrid = & $p_bsheet_exceptionGrid;
$MainPage->p_bsheet_exceptionSearch = & $p_bsheet_exceptionSearch;
$MainPage->bsheet_code = & $bsheet_code;
$MainPage->p_bsheet_exceptionForm = & $p_bsheet_exceptionForm;
$p_bsheet_exceptionGrid->Initialize();
$p_bsheet_exceptionForm->Initialize();

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

//Execute Components @1-91B873DB
$p_bsheet_exceptionSearch->Operation();
$p_bsheet_exceptionForm->Operation();
//End Execute Components

//Go to destination page @1-7DACE228
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_bsheet_exceptionGrid);
    unset($p_bsheet_exceptionSearch);
    unset($p_bsheet_exceptionForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-577AA433
$p_bsheet_exceptionGrid->Show();
$p_bsheet_exceptionSearch->Show();
$p_bsheet_exceptionForm->Show();
$bsheet_code->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9BF16658
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_bsheet_exceptionGrid);
unset($p_bsheet_exceptionSearch);
unset($p_bsheet_exceptionForm);
unset($Tpl);
//End Unload Page


?>
