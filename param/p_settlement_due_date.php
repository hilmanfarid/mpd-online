<?php
//Include Common Files @1-E87E157A
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_settlement_due_date.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_settlement_due_dateGrid { //p_settlement_due_dateGrid class @2-FD3DB55B

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

//Class_Initialize Event @2-605C1511
    function clsGridp_settlement_due_dateGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_settlement_due_dateGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_settlement_due_dateGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_settlement_due_dateGridDataSource($this);
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
        $this->DLink->Page = "p_settlement_due_date.php";
        $this->due_in_day = & new clsControl(ccsLabel, "due_in_day", "due_in_day", ccsText, "", CCGetRequestParam("due_in_day", ccsGet, NULL), $this);
        $this->p_settlement_due_date_id = & new clsControl(ccsHidden, "p_settlement_due_date_id", "p_settlement_due_date_id", ccsFloat, "", CCGetRequestParam("p_settlement_due_date_id", ccsGet, NULL), $this);
        $this->debt_letter1_in_day = & new clsControl(ccsLabel, "debt_letter1_in_day", "debt_letter1_in_day", ccsText, "", CCGetRequestParam("debt_letter1_in_day", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->debt_letter2_in_day = & new clsControl(ccsLabel, "debt_letter2_in_day", "debt_letter2_in_day", ccsText, "", CCGetRequestParam("debt_letter2_in_day", ccsGet, NULL), $this);
        $this->debt_letter3_in_day = & new clsControl(ccsLabel, "debt_letter3_in_day", "debt_letter3_in_day", ccsText, "", CCGetRequestParam("debt_letter3_in_day", ccsGet, NULL), $this);
        $this->a_description = & new clsControl(ccsLabel, "a_description", "a_description", ccsText, "", CCGetRequestParam("a_description", ccsGet, NULL), $this);
        $this->valid_from = & new clsControl(ccsLabel, "valid_from", "valid_from", ccsText, "", CCGetRequestParam("valid_from", ccsGet, NULL), $this);
        $this->valid_to = & new clsControl(ccsLabel, "valid_to", "valid_to", ccsText, "", CCGetRequestParam("valid_to", ccsGet, NULL), $this);
        $this->a_updated_by = & new clsControl(ccsLabel, "a_updated_by", "a_updated_by", ccsText, "", CCGetRequestParam("a_updated_by", ccsGet, NULL), $this);
        $this->a_updated_date = & new clsControl(ccsLabel, "a_updated_date", "a_updated_date", ccsText, "", CCGetRequestParam("a_updated_date", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_settlement_due_date.php";
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

//Show Method @2-09858C0B
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
            $this->ControlsVisible["due_in_day"] = $this->due_in_day->Visible;
            $this->ControlsVisible["p_settlement_due_date_id"] = $this->p_settlement_due_date_id->Visible;
            $this->ControlsVisible["debt_letter1_in_day"] = $this->debt_letter1_in_day->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["debt_letter2_in_day"] = $this->debt_letter2_in_day->Visible;
            $this->ControlsVisible["debt_letter3_in_day"] = $this->debt_letter3_in_day->Visible;
            $this->ControlsVisible["a_description"] = $this->a_description->Visible;
            $this->ControlsVisible["valid_from"] = $this->valid_from->Visible;
            $this->ControlsVisible["valid_to"] = $this->valid_to->Visible;
            $this->ControlsVisible["a_updated_by"] = $this->a_updated_by->Visible;
            $this->ControlsVisible["a_updated_date"] = $this->a_updated_date->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_settlement_due_date_id", $this->DataSource->f("p_settlement_due_date_id"));
                $this->due_in_day->SetValue($this->DataSource->due_in_day->GetValue());
                $this->p_settlement_due_date_id->SetValue($this->DataSource->p_settlement_due_date_id->GetValue());
                $this->debt_letter1_in_day->SetValue($this->DataSource->debt_letter1_in_day->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->debt_letter2_in_day->SetValue($this->DataSource->debt_letter2_in_day->GetValue());
                $this->debt_letter3_in_day->SetValue($this->DataSource->debt_letter3_in_day->GetValue());
                $this->a_description->SetValue($this->DataSource->a_description->GetValue());
                $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                $this->a_updated_by->SetValue($this->DataSource->a_updated_by->GetValue());
                $this->a_updated_date->SetValue($this->DataSource->a_updated_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->due_in_day->Show();
                $this->p_settlement_due_date_id->Show();
                $this->debt_letter1_in_day->Show();
                $this->vat_code->Show();
                $this->p_vat_type_id->Show();
                $this->debt_letter2_in_day->Show();
                $this->debt_letter3_in_day->Show();
                $this->a_description->Show();
                $this->valid_from->Show();
                $this->valid_to->Show();
                $this->a_updated_by->Show();
                $this->a_updated_date->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_settlement_due_date_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-AF17C930
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->due_in_day->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_settlement_due_date_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_letter1_in_day->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_letter2_in_day->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_letter3_in_day->Errors->ToString());
        $errors = ComposeStrings($errors, $this->a_description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_from->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valid_to->Errors->ToString());
        $errors = ComposeStrings($errors, $this->a_updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->a_updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_settlement_due_dateGrid Class @2-FCB6E20C

class clsp_settlement_due_dateGridDataSource extends clsDBConnSIKP {  //p_settlement_due_dateGridDataSource Class @2-A2186D0B

//DataSource Variables @2-6A77DAD1
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $due_in_day;
    var $p_settlement_due_date_id;
    var $debt_letter1_in_day;
    var $vat_code;
    var $p_vat_type_id;
    var $debt_letter2_in_day;
    var $debt_letter3_in_day;
    var $a_description;
    var $valid_from;
    var $valid_to;
    var $a_updated_by;
    var $a_updated_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-82939E82
    function clsp_settlement_due_dateGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_settlement_due_dateGrid";
        $this->Initialize();
        $this->due_in_day = new clsField("due_in_day", ccsText, "");
        
        $this->p_settlement_due_date_id = new clsField("p_settlement_due_date_id", ccsFloat, "");
        
        $this->debt_letter1_in_day = new clsField("debt_letter1_in_day", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->debt_letter2_in_day = new clsField("debt_letter2_in_day", ccsText, "");
        
        $this->debt_letter3_in_day = new clsField("debt_letter3_in_day", ccsText, "");
        
        $this->a_description = new clsField("a_description", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->a_updated_by = new clsField("a_updated_by", ccsText, "");
        
        $this->a_updated_date = new clsField("a_updated_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-D83B1A2C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_settlement_due_date_id";
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

//Open Method @2-FDC0CDF5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT p_settlement_due_date_id, a.p_vat_type_id AS a_p_vat_type_id, due_in_day, debt_letter1_in_day, debt_letter2_in_day, debt_letter3_in_day,\n" .
        "a.description AS a_description, a.updated_by AS a_updated_by, vat_code, to_char(valid_from, 'DD-MON-YYYY') AS valid_from,\n" .
        "to_char(valid_to, 'DD-MON-YYYY') AS valid_to, to_char(a.updated_date, 'DD-MON-YYYY') AS a_updated_date \n" .
        "FROM p_settlement_due_date a INNER JOIN p_vat_type b ON\n" .
        "a.p_vat_type_id = b.p_vat_type_id\n" .
        "WHERE ( vat_code LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR a.description LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )) cnt";
        $this->SQL = "SELECT p_settlement_due_date_id, a.p_vat_type_id AS a_p_vat_type_id, due_in_day, debt_letter1_in_day, debt_letter2_in_day, debt_letter3_in_day,\n" .
        "a.description AS a_description, a.updated_by AS a_updated_by, vat_code, to_char(valid_from, 'DD-MON-YYYY') AS valid_from,\n" .
        "to_char(valid_to, 'DD-MON-YYYY') AS valid_to, to_char(a.updated_date, 'DD-MON-YYYY') AS a_updated_date \n" .
        "FROM p_settlement_due_date a INNER JOIN p_vat_type b ON\n" .
        "a.p_vat_type_id = b.p_vat_type_id\n" .
        "WHERE ( vat_code LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR a.description LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-F3783BE4
    function SetValues()
    {
        $this->due_in_day->SetDBValue($this->f("due_in_day"));
        $this->p_settlement_due_date_id->SetDBValue(trim($this->f("p_settlement_due_date_id")));
        $this->debt_letter1_in_day->SetDBValue($this->f("debt_letter1_in_day"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->debt_letter2_in_day->SetDBValue($this->f("debt_letter2_in_day"));
        $this->debt_letter3_in_day->SetDBValue($this->f("debt_letter3_in_day"));
        $this->a_description->SetDBValue($this->f("a_description"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->a_updated_by->SetDBValue($this->f("a_updated_by"));
        $this->a_updated_date->SetDBValue($this->f("a_updated_date"));
    }
//End SetValues Method

} //End p_settlement_due_dateGridDataSource Class @2-FCB6E20C

class clsRecordp_settlement_due_dateSearch { //p_settlement_due_dateSearch Class @3-B4F19928

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

//Class_Initialize Event @3-15523AF8
    function clsRecordp_settlement_due_dateSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_settlement_due_dateSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_settlement_due_dateSearch";
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

//Operation Method @3-745DC445
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
        $Redirect = "p_settlement_due_date.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_settlement_due_date.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_settlement_due_dateSearch Class @3-FCB6E20C

class clsRecordp_settlement_due_dateForm { //p_settlement_due_dateForm Class @23-4A2AF56E

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

//Class_Initialize Event @23-62D13681
    function clsRecordp_settlement_due_dateForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_settlement_due_dateForm/Error";
        $this->DataSource = new clsp_settlement_due_dateFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_settlement_due_dateForm";
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
            $this->p_settlement_due_date_id = & new clsControl(ccsHidden, "p_settlement_due_date_id", "Id", ccsFloat, "", CCGetRequestParam("p_settlement_due_date_id", $Method, NULL), $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "Jenis Pajak", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_date->Required = true;
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_by->Required = true;
            $this->valid_from = & new clsControl(ccsTextBox, "valid_from", "Valid Sejak", ccsText, "", CCGetRequestParam("valid_from", $Method, NULL), $this);
            $this->valid_from->Required = true;
            $this->valid_to = & new clsControl(ccsTextBox, "valid_to", "Valid Hingga", ccsText, "", CCGetRequestParam("valid_to", $Method, NULL), $this);
            $this->DatePicker_valid_from = & new clsDatePicker("DatePicker_valid_from", "p_settlement_due_dateForm", "valid_from", $this);
            $this->DatePicker_valid_to = & new clsDatePicker("DatePicker_valid_to", "p_settlement_due_dateForm", "valid_to", $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->p_settlement_due_dateGridPage = & new clsControl(ccsHidden, "p_settlement_due_dateGridPage", "p_settlement_due_dateGridPage", ccsText, "", CCGetRequestParam("p_settlement_due_dateGridPage", $Method, NULL), $this);
            $this->due_in_day = & new clsControl(ccsTextBox, "due_in_day", "Jatuh Tempo (Hari)", ccsText, "", CCGetRequestParam("due_in_day", $Method, NULL), $this);
            $this->due_in_day->Required = true;
            $this->debt_letter1_in_day = & new clsControl(ccsTextBox, "debt_letter1_in_day", "Description", ccsText, "", CCGetRequestParam("debt_letter1_in_day", $Method, NULL), $this);
            $this->debt_letter2_in_day = & new clsControl(ccsTextBox, "debt_letter2_in_day", "Description", ccsText, "", CCGetRequestParam("debt_letter2_in_day", $Method, NULL), $this);
            $this->debt_letter3_in_day = & new clsControl(ccsTextBox, "debt_letter3_in_day", "Description", ccsText, "", CCGetRequestParam("debt_letter3_in_day", $Method, NULL), $this);
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

//Initialize Method @23-4B1BEC5B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_settlement_due_date_id"] = CCGetFromGet("p_settlement_due_date_id", NULL);
    }
//End Initialize Method

//Validate Method @23-B47F7714
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_settlement_due_date_id->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->valid_from->Validate() && $Validation);
        $Validation = ($this->valid_to->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->p_settlement_due_dateGridPage->Validate() && $Validation);
        $Validation = ($this->due_in_day->Validate() && $Validation);
        $Validation = ($this->debt_letter1_in_day->Validate() && $Validation);
        $Validation = ($this->debt_letter2_in_day->Validate() && $Validation);
        $Validation = ($this->debt_letter3_in_day->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_settlement_due_date_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_from->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valid_to->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_settlement_due_dateGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->due_in_day->Errors->Count() == 0);
        $Validation =  $Validation && ($this->debt_letter1_in_day->Errors->Count() == 0);
        $Validation =  $Validation && ($this->debt_letter2_in_day->Errors->Count() == 0);
        $Validation =  $Validation && ($this->debt_letter3_in_day->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-DA238351
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_settlement_due_date_id->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->valid_from->Errors->Count());
        $errors = ($errors || $this->valid_to->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_from->Errors->Count());
        $errors = ($errors || $this->DatePicker_valid_to->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->p_settlement_due_dateGridPage->Errors->Count());
        $errors = ($errors || $this->due_in_day->Errors->Count());
        $errors = ($errors || $this->debt_letter1_in_day->Errors->Count());
        $errors = ($errors || $this->debt_letter2_in_day->Errors->Count());
        $errors = ($errors || $this->debt_letter3_in_day->Errors->Count());
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

//Operation Method @23-141BFE8C
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_settlement_due_date_id", "s_keyword", "p_settlement_due_dateGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_settlement_due_date_id", "s_keyword", "p_settlement_due_dateGridPage"));
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

//InsertRow Method @23-A955858D
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_vat_type_id->SetValue($this->p_vat_type_id->GetValue(true));
        $this->DataSource->due_in_day->SetValue($this->due_in_day->GetValue(true));
        $this->DataSource->debt_letter1_in_day->SetValue($this->debt_letter1_in_day->GetValue(true));
        $this->DataSource->debt_letter2_in_day->SetValue($this->debt_letter2_in_day->GetValue(true));
        $this->DataSource->debt_letter3_in_day->SetValue($this->debt_letter3_in_day->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-BB24A384
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_vat_type_id->SetValue($this->p_vat_type_id->GetValue(true));
        $this->DataSource->due_in_day->SetValue($this->due_in_day->GetValue(true));
        $this->DataSource->debt_letter1_in_day->SetValue($this->debt_letter1_in_day->GetValue(true));
        $this->DataSource->debt_letter2_in_day->SetValue($this->debt_letter2_in_day->GetValue(true));
        $this->DataSource->debt_letter3_in_day->SetValue($this->debt_letter3_in_day->GetValue(true));
        $this->DataSource->valid_from->SetValue($this->valid_from->GetValue(true));
        $this->DataSource->valid_to->SetValue($this->valid_to->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->updated_by->SetValue($this->updated_by->GetValue(true));
        $this->DataSource->p_settlement_due_date_id->SetValue($this->p_settlement_due_date_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-D01BC042
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_settlement_due_date_id->SetValue($this->p_settlement_due_date_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-8FC25C17
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
                    $this->p_settlement_due_date_id->SetValue($this->DataSource->p_settlement_due_date_id->GetValue());
                    $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->valid_from->SetValue($this->DataSource->valid_from->GetValue());
                    $this->valid_to->SetValue($this->DataSource->valid_to->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->due_in_day->SetValue($this->DataSource->due_in_day->GetValue());
                    $this->debt_letter1_in_day->SetValue($this->DataSource->debt_letter1_in_day->GetValue());
                    $this->debt_letter2_in_day->SetValue($this->DataSource->debt_letter2_in_day->GetValue());
                    $this->debt_letter3_in_day->SetValue($this->DataSource->debt_letter3_in_day->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_settlement_due_date_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_from->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_valid_to->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_settlement_due_dateGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->due_in_day->Errors->ToString());
            $Error = ComposeStrings($Error, $this->debt_letter1_in_day->Errors->ToString());
            $Error = ComposeStrings($Error, $this->debt_letter2_in_day->Errors->ToString());
            $Error = ComposeStrings($Error, $this->debt_letter3_in_day->Errors->ToString());
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
        $this->p_settlement_due_date_id->Show();
        $this->vat_code->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->valid_from->Show();
        $this->valid_to->Show();
        $this->DatePicker_valid_from->Show();
        $this->DatePicker_valid_to->Show();
        $this->p_vat_type_id->Show();
        $this->p_settlement_due_dateGridPage->Show();
        $this->due_in_day->Show();
        $this->debt_letter1_in_day->Show();
        $this->debt_letter2_in_day->Show();
        $this->debt_letter3_in_day->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_settlement_due_dateForm Class @23-FCB6E20C

class clsp_settlement_due_dateFormDataSource extends clsDBConnSIKP {  //p_settlement_due_dateFormDataSource Class @23-FD2FFBFF

//DataSource Variables @23-FC28521E
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
    var $p_settlement_due_date_id;
    var $vat_code;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $valid_from;
    var $valid_to;
    var $p_vat_type_id;
    var $p_settlement_due_dateGridPage;
    var $due_in_day;
    var $debt_letter1_in_day;
    var $debt_letter2_in_day;
    var $debt_letter3_in_day;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-FE19BE87
    function clsp_settlement_due_dateFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_settlement_due_dateForm/Error";
        $this->Initialize();
        $this->p_settlement_due_date_id = new clsField("p_settlement_due_date_id", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->valid_from = new clsField("valid_from", ccsText, "");
        
        $this->valid_to = new clsField("valid_to", ccsText, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->p_settlement_due_dateGridPage = new clsField("p_settlement_due_dateGridPage", ccsText, "");
        
        $this->due_in_day = new clsField("due_in_day", ccsText, "");
        
        $this->debt_letter1_in_day = new clsField("debt_letter1_in_day", ccsText, "");
        
        $this->debt_letter2_in_day = new clsField("debt_letter2_in_day", ccsText, "");
        
        $this->debt_letter3_in_day = new clsField("debt_letter3_in_day", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-B64BD480
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_settlement_due_date_id", ccsFloat, "", "", $this->Parameters["urlp_settlement_due_date_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-4D877BE8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT p_settlement_due_date_id, \n" .
        "a.p_vat_type_id, \n" .
        "due_in_day, \n" .
        "debt_letter1_in_day, \n" .
        "debt_letter2_in_day, \n" .
        "debt_letter3_in_day,\n" .
        "a.description, \n" .
        "a.updated_by, \n" .
        "a.created_by, \n" .
        "vat_code, \n" .
        "to_char(valid_from, 'DD-MON-YYYY') AS valid_from,\n" .
        "to_char(valid_to, 'DD-MON-YYYY') AS valid_to, \n" .
        "to_char(a.updated_date, 'DD-MON-YYYY') AS updated_date, \n" .
        "to_char(a.creation_date, 'DD-MON-YYYY') AS creation_date\n" .
        "\n" .
        "FROM p_settlement_due_date a INNER JOIN p_vat_type b ON\n" .
        "a.p_vat_type_id = b.p_vat_type_id\n" .
        "WHERE p_settlement_due_date_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . " {SQL_OrderBy}";
        $this->Order = "p_settlement_due_date_id";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-D6C551E0
    function SetValues()
    {
        $this->p_settlement_due_date_id->SetDBValue(trim($this->f("p_settlement_due_date_id")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->valid_from->SetDBValue($this->f("valid_from"));
        $this->valid_to->SetDBValue($this->f("valid_to"));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->due_in_day->SetDBValue($this->f("due_in_day"));
        $this->debt_letter1_in_day->SetDBValue($this->f("debt_letter1_in_day"));
        $this->debt_letter2_in_day->SetDBValue($this->f("debt_letter2_in_day"));
        $this->debt_letter3_in_day->SetDBValue($this->f("debt_letter3_in_day"));
    }
//End SetValues Method

//Insert Method @23-85292CAF
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr87", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr89", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_vat_type_id"] = new clsSQLParameter("ctrlp_vat_type_id", ccsFloat, "", "", $this->p_vat_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["due_in_day"] = new clsSQLParameter("ctrldue_in_day", ccsText, "", "", $this->due_in_day->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["debt_letter1_in_day"] = new clsSQLParameter("ctrldebt_letter1_in_day", ccsFloat, "", "", $this->debt_letter1_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["debt_letter2_in_day"] = new clsSQLParameter("ctrldebt_letter2_in_day", ccsFloat, "", "", $this->debt_letter2_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["debt_letter3_in_day"] = new clsSQLParameter("ctrldebt_letter3_in_day", ccsFloat, "", "", $this->debt_letter3_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_vat_type_id"]->GetValue()) and !strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue())) 
            $this->cp["p_vat_type_id"]->SetValue($this->p_vat_type_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue(true))) 
            $this->cp["p_vat_type_id"]->SetText(0);
        if (!is_null($this->cp["due_in_day"]->GetValue()) and !strlen($this->cp["due_in_day"]->GetText()) and !is_bool($this->cp["due_in_day"]->GetValue())) 
            $this->cp["due_in_day"]->SetValue($this->due_in_day->GetValue(true));
        if (!is_null($this->cp["debt_letter1_in_day"]->GetValue()) and !strlen($this->cp["debt_letter1_in_day"]->GetText()) and !is_bool($this->cp["debt_letter1_in_day"]->GetValue())) 
            $this->cp["debt_letter1_in_day"]->SetValue($this->debt_letter1_in_day->GetValue(true));
        if (!strlen($this->cp["debt_letter1_in_day"]->GetText()) and !is_bool($this->cp["debt_letter1_in_day"]->GetValue(true))) 
            $this->cp["debt_letter1_in_day"]->SetText(0);
        if (!is_null($this->cp["debt_letter2_in_day"]->GetValue()) and !strlen($this->cp["debt_letter2_in_day"]->GetText()) and !is_bool($this->cp["debt_letter2_in_day"]->GetValue())) 
            $this->cp["debt_letter2_in_day"]->SetValue($this->debt_letter2_in_day->GetValue(true));
        if (!strlen($this->cp["debt_letter2_in_day"]->GetText()) and !is_bool($this->cp["debt_letter2_in_day"]->GetValue(true))) 
            $this->cp["debt_letter2_in_day"]->SetText(0);
        if (!is_null($this->cp["debt_letter3_in_day"]->GetValue()) and !strlen($this->cp["debt_letter3_in_day"]->GetText()) and !is_bool($this->cp["debt_letter3_in_day"]->GetValue())) 
            $this->cp["debt_letter3_in_day"]->SetValue($this->debt_letter3_in_day->GetValue(true));
        if (!strlen($this->cp["debt_letter3_in_day"]->GetText()) and !is_bool($this->cp["debt_letter3_in_day"]->GetValue(true))) 
            $this->cp["debt_letter3_in_day"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        $this->SQL = "INSERT INTO p_settlement_due_date(\n" .
        "p_settlement_due_date_id, \n" .
        "p_vat_type_id, \n" .
        "due_in_day,\n" .
        "debt_letter1_in_day,\n" .
        "debt_letter2_in_day,\n" .
        "debt_letter3_in_day,\n" .
        "valid_from,\n" .
        "valid_to,\n" .
        "description, \n" .
        "creation_date, \n" .
        "created_by, \n" .
        "updated_date, \n" .
        "updated_by) \n" .
        "VALUES(\n" .
        "generate_id('sikp','p_settlement_due_date','p_settlement_due_date_id'), \n" .
        "" . $this->SQLValue($this->cp["p_vat_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "" . $this->SQLValue($this->cp["due_in_day"]->GetDBValue(), ccsText) . ",\n" .
        "" . $this->SQLValue($this->cp["debt_letter1_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["debt_letter2_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "" . $this->SQLValue($this->cp["debt_letter3_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "'" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "sysdate, \n" .
        "'" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', \n" .
        "sysdate, \n" .
        "'" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-E7666E29
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_vat_type_id"] = new clsSQLParameter("ctrlp_vat_type_id", ccsFloat, "", "", $this->p_vat_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["due_in_day"] = new clsSQLParameter("ctrldue_in_day", ccsFloat, "", "", $this->due_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["debt_letter1_in_day"] = new clsSQLParameter("ctrldebt_letter1_in_day", ccsFloat, "", "", $this->debt_letter1_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["debt_letter2_in_day"] = new clsSQLParameter("ctrldebt_letter2_in_day", ccsFloat, "", "", $this->debt_letter2_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["debt_letter3_in_day"] = new clsSQLParameter("ctrldebt_letter3_in_day", ccsFloat, "", "", $this->debt_letter3_in_day->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["valid_from"] = new clsSQLParameter("ctrlvalid_from", ccsText, "", "", $this->valid_from->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valid_to"] = new clsSQLParameter("ctrlvalid_to", ccsText, "", "", $this->valid_to->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("ctrlupdated_by", ccsText, "", "", $this->updated_by->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["p_settlement_due_date_id"] = new clsSQLParameter("ctrlp_settlement_due_date_id", ccsFloat, "", "", $this->p_settlement_due_date_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_vat_type_id"]->GetValue()) and !strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue())) 
            $this->cp["p_vat_type_id"]->SetValue($this->p_vat_type_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue(true))) 
            $this->cp["p_vat_type_id"]->SetText(0);
        if (!is_null($this->cp["due_in_day"]->GetValue()) and !strlen($this->cp["due_in_day"]->GetText()) and !is_bool($this->cp["due_in_day"]->GetValue())) 
            $this->cp["due_in_day"]->SetValue($this->due_in_day->GetValue(true));
        if (!strlen($this->cp["due_in_day"]->GetText()) and !is_bool($this->cp["due_in_day"]->GetValue(true))) 
            $this->cp["due_in_day"]->SetText(0);
        if (!is_null($this->cp["debt_letter1_in_day"]->GetValue()) and !strlen($this->cp["debt_letter1_in_day"]->GetText()) and !is_bool($this->cp["debt_letter1_in_day"]->GetValue())) 
            $this->cp["debt_letter1_in_day"]->SetValue($this->debt_letter1_in_day->GetValue(true));
        if (!strlen($this->cp["debt_letter1_in_day"]->GetText()) and !is_bool($this->cp["debt_letter1_in_day"]->GetValue(true))) 
            $this->cp["debt_letter1_in_day"]->SetText(0);
        if (!is_null($this->cp["debt_letter2_in_day"]->GetValue()) and !strlen($this->cp["debt_letter2_in_day"]->GetText()) and !is_bool($this->cp["debt_letter2_in_day"]->GetValue())) 
            $this->cp["debt_letter2_in_day"]->SetValue($this->debt_letter2_in_day->GetValue(true));
        if (!strlen($this->cp["debt_letter2_in_day"]->GetText()) and !is_bool($this->cp["debt_letter2_in_day"]->GetValue(true))) 
            $this->cp["debt_letter2_in_day"]->SetText(0);
        if (!is_null($this->cp["debt_letter3_in_day"]->GetValue()) and !strlen($this->cp["debt_letter3_in_day"]->GetText()) and !is_bool($this->cp["debt_letter3_in_day"]->GetValue())) 
            $this->cp["debt_letter3_in_day"]->SetValue($this->debt_letter3_in_day->GetValue(true));
        if (!strlen($this->cp["debt_letter3_in_day"]->GetText()) and !is_bool($this->cp["debt_letter3_in_day"]->GetValue(true))) 
            $this->cp["debt_letter3_in_day"]->SetText(0);
        if (!is_null($this->cp["valid_from"]->GetValue()) and !strlen($this->cp["valid_from"]->GetText()) and !is_bool($this->cp["valid_from"]->GetValue())) 
            $this->cp["valid_from"]->SetValue($this->valid_from->GetValue(true));
        if (!is_null($this->cp["valid_to"]->GetValue()) and !strlen($this->cp["valid_to"]->GetText()) and !is_bool($this->cp["valid_to"]->GetValue())) 
            $this->cp["valid_to"]->SetValue($this->valid_to->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue($this->updated_by->GetValue(true));
        if (!is_null($this->cp["p_settlement_due_date_id"]->GetValue()) and !strlen($this->cp["p_settlement_due_date_id"]->GetText()) and !is_bool($this->cp["p_settlement_due_date_id"]->GetValue())) 
            $this->cp["p_settlement_due_date_id"]->SetValue($this->p_settlement_due_date_id->GetValue(true));
        if (!strlen($this->cp["p_settlement_due_date_id"]->GetText()) and !is_bool($this->cp["p_settlement_due_date_id"]->GetValue(true))) 
            $this->cp["p_settlement_due_date_id"]->SetText(0);
        $this->SQL = "UPDATE p_settlement_due_date SET\n" .
        "p_vat_type_id = " . $this->SQLValue($this->cp["p_vat_type_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "due_in_day = " . $this->SQLValue($this->cp["due_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "debt_letter1_in_day = " . $this->SQLValue($this->cp["debt_letter1_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "debt_letter2_in_day = " . $this->SQLValue($this->cp["debt_letter2_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "debt_letter3_in_day = " . $this->SQLValue($this->cp["debt_letter3_in_day"]->GetDBValue(), ccsFloat) . ",\n" .
        "valid_from = to_date('" . $this->SQLValue($this->cp["valid_from"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "valid_to = to_date('" . $this->SQLValue($this->cp["valid_to"]->GetDBValue(), ccsText) . "','DD-MON-YYYY'), \n" .
        "description = '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date = sysdate, \n" .
        "updated_by = '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE p_settlement_due_date_id = " . $this->SQLValue($this->cp["p_settlement_due_date_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-30CE82BC
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_settlement_due_date_id"] = new clsSQLParameter("ctrlp_settlement_due_date_id", ccsFloat, "", "", $this->p_settlement_due_date_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_settlement_due_date_id"]->GetValue()) and !strlen($this->cp["p_settlement_due_date_id"]->GetText()) and !is_bool($this->cp["p_settlement_due_date_id"]->GetValue())) 
            $this->cp["p_settlement_due_date_id"]->SetValue($this->p_settlement_due_date_id->GetValue(true));
        if (!strlen($this->cp["p_settlement_due_date_id"]->GetText()) and !is_bool($this->cp["p_settlement_due_date_id"]->GetValue(true))) 
            $this->cp["p_settlement_due_date_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_settlement_due_date WHERE  p_settlement_due_date_id = " . $this->SQLValue($this->cp["p_settlement_due_date_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_settlement_due_dateFormDataSource Class @23-FCB6E20C

//Initialize Page @1-4C1C1ADA
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
$TemplateFileName = "p_settlement_due_date.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-64114988
include_once("./p_settlement_due_date_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D55FC045
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_settlement_due_dateGrid = & new clsGridp_settlement_due_dateGrid("", $MainPage);
$p_settlement_due_dateSearch = & new clsRecordp_settlement_due_dateSearch("", $MainPage);
$p_settlement_due_dateForm = & new clsRecordp_settlement_due_dateForm("", $MainPage);
$MainPage->p_settlement_due_dateGrid = & $p_settlement_due_dateGrid;
$MainPage->p_settlement_due_dateSearch = & $p_settlement_due_dateSearch;
$MainPage->p_settlement_due_dateForm = & $p_settlement_due_dateForm;
$p_settlement_due_dateGrid->Initialize();
$p_settlement_due_dateForm->Initialize();

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

//Execute Components @1-2E66E045
$p_settlement_due_dateSearch->Operation();
$p_settlement_due_dateForm->Operation();
//End Execute Components

//Go to destination page @1-B1CDA335
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_settlement_due_dateGrid);
    unset($p_settlement_due_dateSearch);
    unset($p_settlement_due_dateForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7B6AD599
$p_settlement_due_dateGrid->Show();
$p_settlement_due_dateSearch->Show();
$p_settlement_due_dateForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0CB5E522
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_settlement_due_dateGrid);
unset($p_settlement_due_dateSearch);
unset($p_settlement_due_dateForm);
unset($Tpl);
//End Unload Page


?>
