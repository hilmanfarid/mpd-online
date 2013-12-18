<?php
//Include Common Files @1-739A99AA
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "p_vat_penalty.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridp_vat_penaltyGrid { //p_vat_penaltyGrid class @2-32FD4C21

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

//Class_Initialize Event @2-AEEF1FDA
    function clsGridp_vat_penaltyGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "p_vat_penaltyGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid p_vat_penaltyGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsp_vat_penaltyGridDataSource($this);
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
        $this->DLink->Page = "p_vat_penalty.php";
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->updated_by = & new clsControl(ccsLabel, "updated_by", "updated_by", ccsText, "", CCGetRequestParam("updated_by", ccsGet, NULL), $this);
        $this->updated_date = & new clsControl(ccsLabel, "updated_date", "updated_date", ccsText, "", CCGetRequestParam("updated_date", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->p_vat_penalty_id = & new clsControl(ccsHidden, "p_vat_penalty_id", "p_vat_penalty_id", ccsFloat, "", CCGetRequestParam("p_vat_penalty_id", ccsGet, NULL), $this);
        $this->month_qty = & new clsControl(ccsLabel, "month_qty", "month_qty", ccsText, "", CCGetRequestParam("month_qty", ccsGet, NULL), $this);
        $this->penalty_amt = & new clsControl(ccsLabel, "penalty_amt", "penalty_amt", ccsText, "", CCGetRequestParam("penalty_amt", ccsGet, NULL), $this);
        $this->penalty_pct = & new clsControl(ccsLabel, "penalty_pct", "penalty_pct", ccsText, "", CCGetRequestParam("penalty_pct", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "p_vat_penalty.php";
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

//Show Method @2-5E7C8B2F
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
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["updated_by"] = $this->updated_by->Visible;
            $this->ControlsVisible["updated_date"] = $this->updated_date->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["p_vat_penalty_id"] = $this->p_vat_penalty_id->Visible;
            $this->ControlsVisible["month_qty"] = $this->month_qty->Visible;
            $this->ControlsVisible["penalty_amt"] = $this->penalty_amt->Visible;
            $this->ControlsVisible["penalty_pct"] = $this->penalty_pct->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_vat_penalty_id", $this->DataSource->f("p_vat_penalty_id"));
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->p_vat_penalty_id->SetValue($this->DataSource->p_vat_penalty_id->GetValue());
                $this->month_qty->SetValue($this->DataSource->month_qty->GetValue());
                $this->penalty_amt->SetValue($this->DataSource->penalty_amt->GetValue());
                $this->penalty_pct->SetValue($this->DataSource->penalty_pct->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->description->Show();
                $this->updated_by->Show();
                $this->updated_date->Show();
                $this->vat_code->Show();
                $this->p_vat_penalty_id->Show();
                $this->month_qty->Show();
                $this->penalty_amt->Show();
                $this->penalty_pct->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("p_vat_penalty_id", "s_keyword", "ccsForm"));
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

//GetErrors Method @2-13C43E4E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_by->Errors->ToString());
        $errors = ComposeStrings($errors, $this->updated_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_penalty_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->month_qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->penalty_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->penalty_pct->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End p_vat_penaltyGrid Class @2-FCB6E20C

class clsp_vat_penaltyGridDataSource extends clsDBConnSIKP {  //p_vat_penaltyGridDataSource Class @2-BDC294AD

//DataSource Variables @2-70C5D054
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $description;
    var $updated_by;
    var $updated_date;
    var $vat_code;
    var $p_vat_penalty_id;
    var $month_qty;
    var $penalty_amt;
    var $penalty_pct;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-93A89B80
    function clsp_vat_penaltyGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid p_vat_penaltyGrid";
        $this->Initialize();
        $this->description = new clsField("description", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->p_vat_penalty_id = new clsField("p_vat_penalty_id", ccsFloat, "");
        
        $this->month_qty = new clsField("month_qty", ccsText, "");
        
        $this->penalty_amt = new clsField("penalty_amt", ccsText, "");
        
        $this->penalty_pct = new clsField("penalty_pct", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-EA0AE2C2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_vat_penalty_id";
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

//Open Method @2-A8CE9541
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, b.vat_code, a.p_vat_penalty_id, \n" .
        "a.month_qty,\n" .
        "a.penalty_pct,\n" .
        "a.penalty_amt,\n" .
        "a.description,\n" .
        "a.updated_by\n" .
        "FROM p_vat_penalty a INNER JOIN p_vat_type b ON\n" .
        "a.p_vat_type_id = b.p_vat_type_id\n" .
        "WHERE upper(b.vat_code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(a.description) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%') cnt";
        $this->SQL = "SELECT to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, b.vat_code, a.p_vat_penalty_id, \n" .
        "a.month_qty,\n" .
        "a.penalty_pct,\n" .
        "a.penalty_amt,\n" .
        "a.description,\n" .
        "a.updated_by\n" .
        "FROM p_vat_penalty a INNER JOIN p_vat_type b ON\n" .
        "a.p_vat_type_id = b.p_vat_type_id\n" .
        "WHERE upper(b.vat_code) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR upper(a.description) LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'  {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-014F3D1B
    function SetValues()
    {
        $this->description->SetDBValue($this->f("description"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->p_vat_penalty_id->SetDBValue(trim($this->f("p_vat_penalty_id")));
        $this->month_qty->SetDBValue($this->f("month_qty"));
        $this->penalty_amt->SetDBValue($this->f("penalty_amt"));
        $this->penalty_pct->SetDBValue($this->f("penalty_pct"));
    }
//End SetValues Method

} //End p_vat_penaltyGridDataSource Class @2-FCB6E20C

class clsRecordp_vat_penaltySearch { //p_vat_penaltySearch Class @3-F7FA210E

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

//Class_Initialize Event @3-0E3AAB1B
    function clsRecordp_vat_penaltySearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_vat_penaltySearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_vat_penaltySearch";
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

//Operation Method @3-977425F7
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
        $Redirect = "p_vat_penalty.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "p_vat_penalty.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
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

} //End p_vat_penaltySearch Class @3-FCB6E20C

class clsRecordp_vat_penaltyForm { //p_vat_penaltyForm Class @23-C67B4232

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

//Class_Initialize Event @23-2EA87DB6
    function clsRecordp_vat_penaltyForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record p_vat_penaltyForm/Error";
        $this->DataSource = new clsp_vat_penaltyFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "p_vat_penaltyForm";
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
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "Kode", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->p_vat_penaltyGridPage = & new clsControl(ccsHidden, "p_vat_penaltyGridPage", "p_vat_penaltyGridPage", ccsText, "", CCGetRequestParam("p_vat_penaltyGridPage", $Method, NULL), $this);
            $this->month_qty = & new clsControl(ccsTextBox, "month_qty", "Kode", ccsText, "", CCGetRequestParam("month_qty", $Method, NULL), $this);
            $this->month_qty->Required = true;
            $this->penalty_pct = & new clsControl(ccsTextBox, "penalty_pct", "Description", ccsText, "", CCGetRequestParam("penalty_pct", $Method, NULL), $this);
            $this->penalty_amt = & new clsControl(ccsTextBox, "penalty_amt", "Description", ccsText, "", CCGetRequestParam("penalty_amt", $Method, NULL), $this);
            $this->p_vat_penalty_id = & new clsControl(ccsHidden, "p_vat_penalty_id", "p_vat_penalty_id", ccsFloat, "", CCGetRequestParam("p_vat_penalty_id", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "Id", ccsFloat, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
            $this->is_percentage = & new clsControl(ccsListBox, "is_percentage", "is_percentage", ccsText, "", CCGetRequestParam("is_percentage", $Method, NULL), $this);
            $this->is_percentage->DSType = dsListOfValues;
            $this->is_percentage->Values = array(array("Y", "YA"), array("N", "TIDAK"));
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

//Initialize Method @23-F59193F5
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlp_vat_penalty_id"] = CCGetFromGet("p_vat_penalty_id", NULL);
    }
//End Initialize Method

//Validate Method @23-65EB75B0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_vat_penaltyGridPage->Validate() && $Validation);
        $Validation = ($this->month_qty->Validate() && $Validation);
        $Validation = ($this->penalty_pct->Validate() && $Validation);
        $Validation = ($this->penalty_amt->Validate() && $Validation);
        $Validation = ($this->p_vat_penalty_id->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $Validation = ($this->is_percentage->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_penaltyGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->month_qty->Errors->Count() == 0);
        $Validation =  $Validation && ($this->penalty_pct->Errors->Count() == 0);
        $Validation =  $Validation && ($this->penalty_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_penalty_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->is_percentage->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-5FB850D0
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_vat_penaltyGridPage->Errors->Count());
        $errors = ($errors || $this->month_qty->Errors->Count());
        $errors = ($errors || $this->penalty_pct->Errors->Count());
        $errors = ($errors || $this->penalty_amt->Errors->Count());
        $errors = ($errors || $this->p_vat_penalty_id->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
        $errors = ($errors || $this->is_percentage->Errors->Count());
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

//Operation Method @23-EE31270E
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_vat_type_id", "p_vat_typeGridPage", "s_keyword"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "p_vat_type_id", "p_vat_typeGridPage", "s_keyword"));
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

//InsertRow Method @23-DA3D13C1
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->month_qty->SetValue($this->month_qty->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_vat_type_id->SetValue($this->p_vat_type_id->GetValue(true));
        $this->DataSource->is_percentage->SetValue($this->is_percentage->GetValue(true));
        $this->DataSource->penalty_pct->SetValue($this->penalty_pct->GetValue(true));
        $this->DataSource->penalty_amt->SetValue($this->penalty_amt->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-EF03FE02
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->p_vat_type_id->SetValue($this->p_vat_type_id->GetValue(true));
        $this->DataSource->p_vat_penalty_id->SetValue($this->p_vat_penalty_id->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->month_qty->SetValue($this->month_qty->GetValue(true));
        $this->DataSource->is_percentage->SetValue($this->is_percentage->GetValue(true));
        $this->DataSource->penalty_pct->SetValue($this->penalty_pct->GetValue(true));
        $this->DataSource->penalty_amt->SetValue($this->penalty_amt->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-4A0A2082
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->p_vat_penalty_id->SetValue($this->p_vat_penalty_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-22ADA0D1
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

        $this->is_percentage->Prepare();

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
                    $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->month_qty->SetValue($this->DataSource->month_qty->GetValue());
                    $this->penalty_pct->SetValue($this->DataSource->penalty_pct->GetValue());
                    $this->penalty_amt->SetValue($this->DataSource->penalty_amt->GetValue());
                    $this->p_vat_penalty_id->SetValue($this->DataSource->p_vat_penalty_id->GetValue());
                    $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                    $this->is_percentage->SetValue($this->DataSource->is_percentage->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_penaltyGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->month_qty->Errors->ToString());
            $Error = ComposeStrings($Error, $this->penalty_pct->Errors->ToString());
            $Error = ComposeStrings($Error, $this->penalty_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_penalty_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->is_percentage->Errors->ToString());
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
        $this->vat_code->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->p_vat_penaltyGridPage->Show();
        $this->month_qty->Show();
        $this->penalty_pct->Show();
        $this->penalty_amt->Show();
        $this->p_vat_penalty_id->Show();
        $this->p_vat_type_id->Show();
        $this->is_percentage->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End p_vat_penaltyForm Class @23-FCB6E20C

class clsp_vat_penaltyFormDataSource extends clsDBConnSIKP {  //p_vat_penaltyFormDataSource Class @23-E2F50259

//DataSource Variables @23-EA89D2FA
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
    var $vat_code;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $p_vat_penaltyGridPage;
    var $month_qty;
    var $penalty_pct;
    var $penalty_amt;
    var $p_vat_penalty_id;
    var $p_vat_type_id;
    var $is_percentage;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-50311FF3
    function clsp_vat_penaltyFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record p_vat_penaltyForm/Error";
        $this->Initialize();
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_vat_penaltyGridPage = new clsField("p_vat_penaltyGridPage", ccsText, "");
        
        $this->month_qty = new clsField("month_qty", ccsText, "");
        
        $this->penalty_pct = new clsField("penalty_pct", ccsText, "");
        
        $this->penalty_amt = new clsField("penalty_amt", ccsText, "");
        
        $this->p_vat_penalty_id = new clsField("p_vat_penalty_id", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsFloat, "");
        
        $this->is_percentage = new clsField("is_percentage", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-0F3235A0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_vat_penalty_id", ccsFloat, "", "", $this->Parameters["urlp_vat_penalty_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @23-10027E58
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT to_char(a.updated_date,'DD-MON-YYYY') AS updated_date, to_char(a.creation_date,'DD-MON-YYYY') AS creation_date, b.vat_code, a.p_vat_penalty_id, \n" .
        "a.is_percentage,\n" .
        "a.month_qty,\n" .
        "a.penalty_pct,\n" .
        "a.penalty_amt,\n" .
        "a.description,\n" .
        "a.updated_by,\n" .
        "a.created_by,\n" .
        "b.p_vat_type_id\n" .
        "FROM p_vat_penalty a INNER JOIN p_vat_type b ON\n" .
        "a.p_vat_type_id = b.p_vat_type_id\n" .
        "WHERE p_vat_penalty_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-935C5745
    function SetValues()
    {
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->month_qty->SetDBValue($this->f("month_qty"));
        $this->penalty_pct->SetDBValue($this->f("penalty_pct"));
        $this->penalty_amt->SetDBValue($this->f("penalty_amt"));
        $this->p_vat_penalty_id->SetDBValue(trim($this->f("p_vat_penalty_id")));
        $this->p_vat_type_id->SetDBValue(trim($this->f("p_vat_type_id")));
        $this->is_percentage->SetDBValue($this->f("is_percentage"));
    }
//End SetValues Method

//Insert Method @23-3D81A254
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["month_qty"] = new clsSQLParameter("ctrlmonth_qty", ccsFloat, "", "", $this->month_qty->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr197", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr199", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_vat_type_id"] = new clsSQLParameter("ctrlp_vat_type_id", ccsFloat, "", "", $this->p_vat_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["is_percentage"] = new clsSQLParameter("ctrlis_percentage", ccsText, "", "", $this->is_percentage->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["penalty_pct"] = new clsSQLParameter("ctrlpenalty_pct", ccsFloat, "", "", $this->penalty_pct->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["penalty_amt"] = new clsSQLParameter("ctrlpenalty_amt", ccsFloat, "", "", $this->penalty_amt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["month_qty"]->GetValue()) and !strlen($this->cp["month_qty"]->GetText()) and !is_bool($this->cp["month_qty"]->GetValue())) 
            $this->cp["month_qty"]->SetValue($this->month_qty->GetValue(true));
        if (!strlen($this->cp["month_qty"]->GetText()) and !is_bool($this->cp["month_qty"]->GetValue(true))) 
            $this->cp["month_qty"]->SetText(0);
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
        if (!is_null($this->cp["is_percentage"]->GetValue()) and !strlen($this->cp["is_percentage"]->GetText()) and !is_bool($this->cp["is_percentage"]->GetValue())) 
            $this->cp["is_percentage"]->SetValue($this->is_percentage->GetValue(true));
        if (!is_null($this->cp["penalty_pct"]->GetValue()) and !strlen($this->cp["penalty_pct"]->GetText()) and !is_bool($this->cp["penalty_pct"]->GetValue())) 
            $this->cp["penalty_pct"]->SetValue($this->penalty_pct->GetValue(true));
        if (!strlen($this->cp["penalty_pct"]->GetText()) and !is_bool($this->cp["penalty_pct"]->GetValue(true))) 
            $this->cp["penalty_pct"]->SetText(0);
        if (!is_null($this->cp["penalty_amt"]->GetValue()) and !strlen($this->cp["penalty_amt"]->GetText()) and !is_bool($this->cp["penalty_amt"]->GetValue())) 
            $this->cp["penalty_amt"]->SetValue($this->penalty_amt->GetValue(true));
        if (!strlen($this->cp["penalty_amt"]->GetText()) and !is_bool($this->cp["penalty_amt"]->GetValue(true))) 
            $this->cp["penalty_amt"]->SetText(0);
        $this->SQL = "INSERT INTO p_vat_penalty(p_vat_penalty_id, p_vat_type_id, month_qty, is_percentage, penalty_pct, penalty_amt, description, creation_date, created_by, updated_date, updated_by) \n" .
        "VALUES(generate_id('sikp','p_vat_penalty','p_vat_penalty_id'), " . $this->SQLValue($this->cp["p_vat_type_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["month_qty"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["is_percentage"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["penalty_pct"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["penalty_amt"]->GetDBValue(), ccsFloat) . ", '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-FB6E5B3B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_vat_type_id"] = new clsSQLParameter("ctrlp_vat_type_id", ccsFloat, "", "", $this->p_vat_type_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_vat_penalty_id"] = new clsSQLParameter("ctrlp_vat_penalty_id", ccsFloat, "", "", $this->p_vat_penalty_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr215", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["month_qty"] = new clsSQLParameter("ctrlmonth_qty", ccsFloat, "", "", $this->month_qty->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["is_percentage"] = new clsSQLParameter("ctrlis_percentage", ccsText, "", "", $this->is_percentage->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["penalty_pct"] = new clsSQLParameter("ctrlpenalty_pct", ccsFloat, "", "", $this->penalty_pct->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["penalty_amt"] = new clsSQLParameter("ctrlpenalty_amt", ccsFloat, "", "", $this->penalty_amt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["p_vat_type_id"]->GetValue()) and !strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue())) 
            $this->cp["p_vat_type_id"]->SetValue($this->p_vat_type_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_id"]->GetText()) and !is_bool($this->cp["p_vat_type_id"]->GetValue(true))) 
            $this->cp["p_vat_type_id"]->SetText(0);
        if (!is_null($this->cp["p_vat_penalty_id"]->GetValue()) and !strlen($this->cp["p_vat_penalty_id"]->GetText()) and !is_bool($this->cp["p_vat_penalty_id"]->GetValue())) 
            $this->cp["p_vat_penalty_id"]->SetValue($this->p_vat_penalty_id->GetValue(true));
        if (!strlen($this->cp["p_vat_penalty_id"]->GetText()) and !is_bool($this->cp["p_vat_penalty_id"]->GetValue(true))) 
            $this->cp["p_vat_penalty_id"]->SetText(0);
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["month_qty"]->GetValue()) and !strlen($this->cp["month_qty"]->GetText()) and !is_bool($this->cp["month_qty"]->GetValue())) 
            $this->cp["month_qty"]->SetValue($this->month_qty->GetValue(true));
        if (!strlen($this->cp["month_qty"]->GetText()) and !is_bool($this->cp["month_qty"]->GetValue(true))) 
            $this->cp["month_qty"]->SetText(0);
        if (!is_null($this->cp["is_percentage"]->GetValue()) and !strlen($this->cp["is_percentage"]->GetText()) and !is_bool($this->cp["is_percentage"]->GetValue())) 
            $this->cp["is_percentage"]->SetValue($this->is_percentage->GetValue(true));
        if (!is_null($this->cp["penalty_pct"]->GetValue()) and !strlen($this->cp["penalty_pct"]->GetText()) and !is_bool($this->cp["penalty_pct"]->GetValue())) 
            $this->cp["penalty_pct"]->SetValue($this->penalty_pct->GetValue(true));
        if (!strlen($this->cp["penalty_pct"]->GetText()) and !is_bool($this->cp["penalty_pct"]->GetValue(true))) 
            $this->cp["penalty_pct"]->SetText(0);
        if (!is_null($this->cp["penalty_amt"]->GetValue()) and !strlen($this->cp["penalty_amt"]->GetText()) and !is_bool($this->cp["penalty_amt"]->GetValue())) 
            $this->cp["penalty_amt"]->SetValue($this->penalty_amt->GetValue(true));
        if (!strlen($this->cp["penalty_amt"]->GetText()) and !is_bool($this->cp["penalty_amt"]->GetValue(true))) 
            $this->cp["penalty_amt"]->SetText(0);
        $this->SQL = "UPDATE p_vat_penalty SET \n" .
        "p_vat_type_id = " . $this->SQLValue($this->cp["p_vat_type_id"]->GetDBValue(), ccsFloat) . ",\n" .
        "month_qty = " . $this->SQLValue($this->cp["month_qty"]->GetDBValue(), ccsFloat) . ",\n" .
        "is_percentage = '" . $this->SQLValue($this->cp["is_percentage"]->GetDBValue(), ccsText) . "',\n" .
        "penalty_pct = " . $this->SQLValue($this->cp["penalty_pct"]->GetDBValue(), ccsFloat) . ",\n" .
        "penalty_amt = " . $this->SQLValue($this->cp["penalty_amt"]->GetDBValue(), ccsFloat) . ",\n" .
        "description = '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "',\n" .
        "updated_date = sysdate,\n" .
        "updated_by = '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "'\n" .
        "WHERE p_vat_penalty_id = " . $this->SQLValue($this->cp["p_vat_penalty_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-1498B93B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["p_vat_penalty_id"] = new clsSQLParameter("ctrlp_vat_penalty_id", ccsFloat, "", "", $this->p_vat_penalty_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["p_vat_penalty_id"]->GetValue()) and !strlen($this->cp["p_vat_penalty_id"]->GetText()) and !is_bool($this->cp["p_vat_penalty_id"]->GetValue())) 
            $this->cp["p_vat_penalty_id"]->SetValue($this->p_vat_penalty_id->GetValue(true));
        if (!strlen($this->cp["p_vat_penalty_id"]->GetText()) and !is_bool($this->cp["p_vat_penalty_id"]->GetValue(true))) 
            $this->cp["p_vat_penalty_id"]->SetText(0);
        $this->SQL = "DELETE FROM p_vat_penalty where p_vat_penalty_id = " . $this->SQLValue($this->cp["p_vat_penalty_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End p_vat_penaltyFormDataSource Class @23-FCB6E20C

//Initialize Page @1-290D838C
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
$TemplateFileName = "p_vat_penalty.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-7E17D268
include_once("./p_vat_penalty_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A04B6D19
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$p_vat_penaltyGrid = & new clsGridp_vat_penaltyGrid("", $MainPage);
$p_vat_penaltySearch = & new clsRecordp_vat_penaltySearch("", $MainPage);
$p_vat_penaltyForm = & new clsRecordp_vat_penaltyForm("", $MainPage);
$MainPage->p_vat_penaltyGrid = & $p_vat_penaltyGrid;
$MainPage->p_vat_penaltySearch = & $p_vat_penaltySearch;
$MainPage->p_vat_penaltyForm = & $p_vat_penaltyForm;
$p_vat_penaltyGrid->Initialize();
$p_vat_penaltyForm->Initialize();

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

//Execute Components @1-0FB8CCBB
$p_vat_penaltySearch->Operation();
$p_vat_penaltyForm->Operation();
//End Execute Components

//Go to destination page @1-639A9032
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($p_vat_penaltyGrid);
    unset($p_vat_penaltySearch);
    unset($p_vat_penaltyForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-33A117B7
$p_vat_penaltyGrid->Show();
$p_vat_penaltySearch->Show();
$p_vat_penaltyForm->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E4A66DCD
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($p_vat_penaltyGrid);
unset($p_vat_penaltySearch);
unset($p_vat_penaltyForm);
unset($Tpl);
//End Unload Page


?>
