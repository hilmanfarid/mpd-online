<?php
//Include Common Files @1-43B816AA
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_revenue_target_dtl.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridv_t_revenue_target_dtlGrid { //v_t_revenue_target_dtlGrid class @2-0E2F34E5

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

//Class_Initialize Event @2-D7A843E2
    function clsGridv_t_revenue_target_dtlGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "v_t_revenue_target_dtlGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid v_t_revenue_target_dtlGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsv_t_revenue_target_dtlGridDataSource($this);
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
        $this->DLink->Page = "t_revenue_target_dtl.php";
        $this->periode = & new clsControl(ccsLabel, "periode", "periode", ccsText, "", CCGetRequestParam("periode", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->t_revenue_target_dtl_id = & new clsControl(ccsHidden, "t_revenue_target_dtl_id", "t_revenue_target_dtl_id", ccsFloat, "", CCGetRequestParam("t_revenue_target_dtl_id", ccsGet, NULL), $this);
        $this->target_code = & new clsControl(ccsLabel, "target_code", "target_code", ccsText, "", CCGetRequestParam("target_code", ccsGet, NULL), $this);
        $this->target_amt = & new clsControl(ccsLabel, "target_amt", "target_amt", ccsText, "", CCGetRequestParam("target_amt", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->Insert_Link = & new clsControl(ccsLink, "Insert_Link", "Insert_Link", ccsText, "", CCGetRequestParam("Insert_Link", ccsGet, NULL), $this);
        $this->Insert_Link->Page = "t_revenue_target_dtl.php";
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->vat_type_code = & new clsControl(ccsLabel, "vat_type_code", "vat_type_code", ccsText, "", CCGetRequestParam("vat_type_code", ccsGet, NULL), $this);
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

//Show Method @2-D00019A4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);

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
            $this->ControlsVisible["periode"] = $this->periode->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["t_revenue_target_dtl_id"] = $this->t_revenue_target_dtl_id->Visible;
            $this->ControlsVisible["target_code"] = $this->target_code->Visible;
            $this->ControlsVisible["target_amt"] = $this->target_amt->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("FLAG", "ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "t_revenue_target_dtl_id", $this->DataSource->f("t_revenue_target_dtl_id"));
                $this->periode->SetValue($this->DataSource->periode->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->t_revenue_target_dtl_id->SetValue($this->DataSource->t_revenue_target_dtl_id->GetValue());
                $this->target_code->SetValue($this->DataSource->target_code->GetValue());
                $this->target_amt->SetValue($this->DataSource->target_amt->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DLink->Show();
                $this->periode->Show();
                $this->description->Show();
                $this->t_revenue_target_dtl_id->Show();
                $this->target_code->Show();
                $this->target_amt->Show();
                $this->vat_code->Show();
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
        $this->Insert_Link->Parameters = CCGetQueryString("QueryString", array("t_revenue_target_dtl_id", "s_keyword", "ccsForm"));
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
        $this->vat_type_code->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-D2C16B4F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_revenue_target_dtl_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End v_t_revenue_target_dtlGrid Class @2-FCB6E20C

class clsv_t_revenue_target_dtlGridDataSource extends clsDBConnSIKP {  //v_t_revenue_target_dtlGridDataSource Class @2-B1ACB4AF

//DataSource Variables @2-33A5C9E6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $periode;
    var $description;
    var $t_revenue_target_dtl_id;
    var $target_code;
    var $target_amt;
    var $vat_code;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-58C76D34
    function clsv_t_revenue_target_dtlGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid v_t_revenue_target_dtlGrid";
        $this->Initialize();
        $this->periode = new clsField("periode", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->t_revenue_target_dtl_id = new clsField("t_revenue_target_dtl_id", ccsFloat, "");
        
        $this->target_code = new clsField("target_code", ccsText, "");
        
        $this->target_amt = new clsField("target_amt", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-AF653260
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "p_vat_type_id desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-17B4E75C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlt_revenue_target_id", ccsFloat, "", "", $this->Parameters["urlt_revenue_target_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "upper(periode)", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "t_revenue_target_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsFloat),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-1600A97D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM v_t_revenue_target_dtl";
        $this->SQL = "SELECT * \n\n" .
        "FROM v_t_revenue_target_dtl {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-BC69E1F5
    function SetValues()
    {
        $this->periode->SetDBValue($this->f("periode"));
        $this->description->SetDBValue($this->f("description"));
        $this->t_revenue_target_dtl_id->SetDBValue(trim($this->f("t_revenue_target_dtl_id")));
        $this->target_code->SetDBValue($this->f("target_code"));
        $this->target_amt->SetDBValue($this->f("target_amt"));
        $this->vat_code->SetDBValue($this->f("vat_code"));
    }
//End SetValues Method

} //End v_t_revenue_target_dtlGridDataSource Class @2-FCB6E20C

class clsRecordv_t_revenue_target_dtlSearch { //v_t_revenue_target_dtlSearch Class @3-0C4A1DD4

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

//Class_Initialize Event @3-C2922731
    function clsRecordv_t_revenue_target_dtlSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record v_t_revenue_target_dtlSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "v_t_revenue_target_dtlSearch";
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
            $this->year_s_keyword = & new clsControl(ccsHidden, "year_s_keyword", "year_s_keyword", ccsText, "", CCGetRequestParam("year_s_keyword", $Method, NULL), $this);
            $this->rev_target_code = & new clsControl(ccsHidden, "rev_target_code", "rev_target_code", ccsText, "", CCGetRequestParam("rev_target_code", $Method, NULL), $this);
            $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsFloat, "", CCGetRequestParam("t_revenue_target_id", $Method, NULL), $this);
            $this->t_revenue_targetGridPage = & new clsControl(ccsHidden, "t_revenue_targetGridPage", "t_revenue_targetGridPage", ccsText, "", CCGetRequestParam("t_revenue_targetGridPage", $Method, NULL), $this);
            $this->year_code = & new clsControl(ccsHidden, "year_code", "year_code", ccsText, "", CCGetRequestParam("year_code", $Method, NULL), $this);
            $this->target_s_keyword = & new clsControl(ccsHidden, "target_s_keyword", "target_s_keyword", ccsText, "", CCGetRequestParam("target_s_keyword", $Method, NULL), $this);
            $this->vat_type_code = & new clsControl(ccsHidden, "vat_type_code", "vat_type_code", ccsText, "", CCGetRequestParam("vat_type_code", $Method, NULL), $this);
            $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-C148573D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->p_year_periodGridPage->Validate() && $Validation);
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->year_s_keyword->Validate() && $Validation);
        $Validation = ($this->rev_target_code->Validate() && $Validation);
        $Validation = ($this->t_revenue_target_id->Validate() && $Validation);
        $Validation = ($this->t_revenue_targetGridPage->Validate() && $Validation);
        $Validation = ($this->year_code->Validate() && $Validation);
        $Validation = ($this->target_s_keyword->Validate() && $Validation);
        $Validation = ($this->vat_type_code->Validate() && $Validation);
        $Validation = ($this->p_vat_type_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_periodGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->rev_target_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_revenue_target_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_revenue_targetGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->year_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->target_s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_type_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-1777E470
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->p_year_periodGridPage->Errors->Count());
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->year_s_keyword->Errors->Count());
        $errors = ($errors || $this->rev_target_code->Errors->Count());
        $errors = ($errors || $this->t_revenue_target_id->Errors->Count());
        $errors = ($errors || $this->t_revenue_targetGridPage->Errors->Count());
        $errors = ($errors || $this->year_code->Errors->Count());
        $errors = ($errors || $this->target_s_keyword->Errors->Count());
        $errors = ($errors || $this->vat_type_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_id->Errors->Count());
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

//Operation Method @3-92BEC525
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
        $Redirect = "t_revenue_target_dtl.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "t_revenue_target_dtl.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-A00A63A6
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
            $Error = ComposeStrings($Error, $this->year_s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rev_target_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_revenue_target_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_revenue_targetGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->year_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->target_s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_id->Errors->ToString());
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
        $this->year_s_keyword->Show();
        $this->rev_target_code->Show();
        $this->t_revenue_target_id->Show();
        $this->t_revenue_targetGridPage->Show();
        $this->year_code->Show();
        $this->target_s_keyword->Show();
        $this->vat_type_code->Show();
        $this->p_vat_type_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End v_t_revenue_target_dtlSearch Class @3-FCB6E20C

class clsRecordv_t_revenue_target_dtlForm { //v_t_revenue_target_dtlForm Class @23-DD6CDD2B

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

//Class_Initialize Event @23-74208189
    function clsRecordv_t_revenue_target_dtlForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record v_t_revenue_target_dtlForm/Error";
        $this->DataSource = new clsv_t_revenue_target_dtlFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "v_t_revenue_target_dtlForm";
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
            $this->t_revenue_target_dtl_id = & new clsControl(ccsHidden, "t_revenue_target_dtl_id", "Id", ccsFloat, "", CCGetRequestParam("t_revenue_target_dtl_id", $Method, NULL), $this);
            $this->target_code = & new clsControl(ccsTextBox, "target_code", "Kode", ccsText, "", CCGetRequestParam("target_code", $Method, NULL), $this);
            $this->target_code->Required = true;
            $this->periode = & new clsControl(ccsTextBox, "periode", "Jenis Pajak", ccsText, "", CCGetRequestParam("periode", $Method, NULL), $this);
            $this->periode->Required = true;
            $this->description = & new clsControl(ccsTextBox, "description", "Description", ccsText, "", CCGetRequestParam("description", $Method, NULL), $this);
            $this->creation_date = & new clsControl(ccsTextBox, "creation_date", "Creation Date", ccsText, "", CCGetRequestParam("creation_date", $Method, NULL), $this);
            $this->creation_date->Required = true;
            $this->created_by = & new clsControl(ccsTextBox, "created_by", "Created By", ccsText, "", CCGetRequestParam("created_by", $Method, NULL), $this);
            $this->created_by->Required = true;
            $this->updated_date = & new clsControl(ccsTextBox, "updated_date", "Updated Date", ccsText, "", CCGetRequestParam("updated_date", $Method, NULL), $this);
            $this->updated_date->Required = true;
            $this->updated_by = & new clsControl(ccsTextBox, "updated_by", "Updated By", ccsText, "", CCGetRequestParam("updated_by", $Method, NULL), $this);
            $this->updated_by->Required = true;
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
            $this->t_revenue_target_dtlGridPage = & new clsControl(ccsHidden, "t_revenue_target_dtlGridPage", "t_revenue_target_dtlGridPage", ccsText, "", CCGetRequestParam("t_revenue_target_dtlGridPage", $Method, NULL), $this);
            $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsFloat, "", CCGetRequestParam("t_revenue_target_id", $Method, NULL), $this);
            $this->target_amt = & new clsControl(ccsTextBox, "target_amt", "Jumlah", ccsFloat, array(False, 0, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("target_amt", $Method, NULL), $this);
            $this->vat_type_code = & new clsControl(ccsLabel, "vat_type_code", "vat_type_code", ccsText, "", CCGetRequestParam("vat_type_code", $Method, NULL), $this);
            $this->vat_code = & new clsControl(ccsTextBox, "vat_code", "Jenis Pajak", ccsText, "", CCGetRequestParam("vat_code", $Method, NULL), $this);
            $this->vat_code->Required = true;
            $this->p_vat_type_dtl_id = & new clsControl(ccsHidden, "p_vat_type_dtl_id", "p_vat_type_dtl_id", ccsFloat, "", CCGetRequestParam("p_vat_type_dtl_id", $Method, NULL), $this);
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

//Initialize Method @23-76CA5928
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_revenue_target_dtl_id"] = CCGetFromGet("t_revenue_target_dtl_id", NULL);
    }
//End Initialize Method

//Validate Method @23-9A26FCD5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->t_revenue_target_dtl_id->Validate() && $Validation);
        $Validation = ($this->target_code->Validate() && $Validation);
        $Validation = ($this->periode->Validate() && $Validation);
        $Validation = ($this->description->Validate() && $Validation);
        $Validation = ($this->creation_date->Validate() && $Validation);
        $Validation = ($this->created_by->Validate() && $Validation);
        $Validation = ($this->updated_date->Validate() && $Validation);
        $Validation = ($this->updated_by->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $Validation = ($this->t_revenue_target_dtlGridPage->Validate() && $Validation);
        $Validation = ($this->t_revenue_target_id->Validate() && $Validation);
        $Validation = ($this->target_amt->Validate() && $Validation);
        $Validation = ($this->vat_code->Validate() && $Validation);
        $Validation = ($this->p_vat_type_dtl_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->t_revenue_target_dtl_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->target_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->periode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->description->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creation_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->created_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->updated_by->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_revenue_target_dtlGridPage->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_revenue_target_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->target_amt->Errors->Count() == 0);
        $Validation =  $Validation && ($this->vat_code->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_type_dtl_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @23-34D3CD2B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->t_revenue_target_dtl_id->Errors->Count());
        $errors = ($errors || $this->target_code->Errors->Count());
        $errors = ($errors || $this->periode->Errors->Count());
        $errors = ($errors || $this->description->Errors->Count());
        $errors = ($errors || $this->creation_date->Errors->Count());
        $errors = ($errors || $this->created_by->Errors->Count());
        $errors = ($errors || $this->updated_date->Errors->Count());
        $errors = ($errors || $this->updated_by->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->t_revenue_target_dtlGridPage->Errors->Count());
        $errors = ($errors || $this->t_revenue_target_id->Errors->Count());
        $errors = ($errors || $this->target_amt->Errors->Count());
        $errors = ($errors || $this->vat_type_code->Errors->Count());
        $errors = ($errors || $this->vat_code->Errors->Count());
        $errors = ($errors || $this->p_vat_type_dtl_id->Errors->Count());
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

//Operation Method @23-3D0C8C77
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
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_revenue_target_dtl_id", "s_keyword", "t_revenue_target_dtlGridPage"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "FLAG", "t_revenue_target_dtl_id", "s_keyword", "t_revenue_target_dtlGridPage"));
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

//InsertRow Method @23-0DF483A9
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->target_code->SetValue($this->target_code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_finance_period_id->SetValue($this->p_finance_period_id->GetValue(true));
        $this->DataSource->t_revenue_target_id->SetValue($this->t_revenue_target_id->GetValue(true));
        $this->DataSource->target_amt->SetValue($this->target_amt->GetValue(true));
        $this->DataSource->p_vat_type_dtl_id->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @23-F8F6F724
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->t_revenue_target_dtl_id->SetValue($this->t_revenue_target_dtl_id->GetValue(true));
        $this->DataSource->target_code->SetValue($this->target_code->GetValue(true));
        $this->DataSource->description->SetValue($this->description->GetValue(true));
        $this->DataSource->p_finance_period_id->SetValue($this->p_finance_period_id->GetValue(true));
        $this->DataSource->t_revenue_target_id->SetValue($this->t_revenue_target_id->GetValue(true));
        $this->DataSource->target_amt->SetValue($this->target_amt->GetValue(true));
        $this->DataSource->p_vat_type_dtl_id->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @23-148A8FB1
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->t_revenue_target_dtl_id->SetValue($this->t_revenue_target_dtl_id->GetValue(true));
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @23-868C8551
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
                    $this->t_revenue_target_dtl_id->SetValue($this->DataSource->t_revenue_target_dtl_id->GetValue());
                    $this->target_code->SetValue($this->DataSource->target_code->GetValue());
                    $this->periode->SetValue($this->DataSource->periode->GetValue());
                    $this->description->SetValue($this->DataSource->description->GetValue());
                    $this->creation_date->SetValue($this->DataSource->creation_date->GetValue());
                    $this->created_by->SetValue($this->DataSource->created_by->GetValue());
                    $this->updated_date->SetValue($this->DataSource->updated_date->GetValue());
                    $this->updated_by->SetValue($this->DataSource->updated_by->GetValue());
                    $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                    $this->t_revenue_target_id->SetValue($this->DataSource->t_revenue_target_id->GetValue());
                    $this->target_amt->SetValue($this->DataSource->target_amt->GetValue());
                    $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                    $this->p_vat_type_dtl_id->SetValue($this->DataSource->p_vat_type_dtl_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->t_revenue_target_dtl_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->target_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->periode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->description->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creation_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->created_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->updated_by->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_revenue_target_dtlGridPage->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_revenue_target_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->target_amt->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_type_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->vat_code->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_type_dtl_id->Errors->ToString());
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
        $this->t_revenue_target_dtl_id->Show();
        $this->target_code->Show();
        $this->periode->Show();
        $this->description->Show();
        $this->creation_date->Show();
        $this->created_by->Show();
        $this->updated_date->Show();
        $this->updated_by->Show();
        $this->p_finance_period_id->Show();
        $this->t_revenue_target_dtlGridPage->Show();
        $this->t_revenue_target_id->Show();
        $this->target_amt->Show();
        $this->vat_type_code->Show();
        $this->vat_code->Show();
        $this->p_vat_type_dtl_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End v_t_revenue_target_dtlForm Class @23-FCB6E20C

class clsv_t_revenue_target_dtlFormDataSource extends clsDBConnSIKP {  //v_t_revenue_target_dtlFormDataSource Class @23-EE9B225B

//DataSource Variables @23-DEA0B04C
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
    var $t_revenue_target_dtl_id;
    var $target_code;
    var $periode;
    var $description;
    var $creation_date;
    var $created_by;
    var $updated_date;
    var $updated_by;
    var $p_finance_period_id;
    var $t_revenue_target_dtlGridPage;
    var $t_revenue_target_id;
    var $target_amt;
    var $vat_type_code;
    var $vat_code;
    var $p_vat_type_dtl_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @23-278B7E51
    function clsv_t_revenue_target_dtlFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record v_t_revenue_target_dtlForm/Error";
        $this->Initialize();
        $this->t_revenue_target_dtl_id = new clsField("t_revenue_target_dtl_id", ccsFloat, "");
        
        $this->target_code = new clsField("target_code", ccsText, "");
        
        $this->periode = new clsField("periode", ccsText, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->creation_date = new clsField("creation_date", ccsText, "");
        
        $this->created_by = new clsField("created_by", ccsText, "");
        
        $this->updated_date = new clsField("updated_date", ccsText, "");
        
        $this->updated_by = new clsField("updated_by", ccsText, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsFloat, "");
        
        $this->t_revenue_target_dtlGridPage = new clsField("t_revenue_target_dtlGridPage", ccsText, "");
        
        $this->t_revenue_target_id = new clsField("t_revenue_target_id", ccsFloat, "");
        
        $this->target_amt = new clsField("target_amt", ccsFloat, "");
        
        $this->vat_type_code = new clsField("vat_type_code", ccsText, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->p_vat_type_dtl_id = new clsField("p_vat_type_dtl_id", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @23-8ACFCB43
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_revenue_target_dtl_id", ccsFloat, "", "", $this->Parameters["urlt_revenue_target_dtl_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "t_revenue_target_dtl_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsFloat),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @23-582D08DD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM v_t_revenue_target_dtl {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @23-C70EE514
    function SetValues()
    {
        $this->t_revenue_target_dtl_id->SetDBValue(trim($this->f("t_revenue_target_dtl_id")));
        $this->target_code->SetDBValue($this->f("target_code"));
        $this->periode->SetDBValue($this->f("periode"));
        $this->description->SetDBValue($this->f("description"));
        $this->creation_date->SetDBValue($this->f("creation_date"));
        $this->created_by->SetDBValue($this->f("created_by"));
        $this->updated_date->SetDBValue($this->f("updated_date"));
        $this->updated_by->SetDBValue($this->f("updated_by"));
        $this->p_finance_period_id->SetDBValue(trim($this->f("p_finance_period_id")));
        $this->t_revenue_target_id->SetDBValue(trim($this->f("t_revenue_target_id")));
        $this->target_amt->SetDBValue(trim($this->f("target_amt")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->p_vat_type_dtl_id->SetDBValue(trim($this->f("p_vat_type_dtl_id")));
    }
//End SetValues Method

//Insert Method @23-B7F2D759
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["target_code"] = new clsSQLParameter("ctrltarget_code", ccsText, "", "", $this->target_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["created_by"] = new clsSQLParameter("expr165", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr167", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_finance_period_id"] = new clsSQLParameter("ctrlp_finance_period_id", ccsFloat, "", "", $this->p_finance_period_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["t_revenue_target_id"] = new clsSQLParameter("ctrlt_revenue_target_id", ccsFloat, "", "", $this->t_revenue_target_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["target_amt"] = new clsSQLParameter("ctrltarget_amt", ccsFloat, "", "", $this->target_amt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_vat_type_dtl_id"] = new clsSQLParameter("ctrlp_vat_type_dtl_id", ccsFloat, "", "", $this->p_vat_type_dtl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["target_code"]->GetValue()) and !strlen($this->cp["target_code"]->GetText()) and !is_bool($this->cp["target_code"]->GetValue())) 
            $this->cp["target_code"]->SetValue($this->target_code->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["created_by"]->GetValue()) and !strlen($this->cp["created_by"]->GetText()) and !is_bool($this->cp["created_by"]->GetValue())) 
            $this->cp["created_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_finance_period_id"]->GetValue()) and !strlen($this->cp["p_finance_period_id"]->GetText()) and !is_bool($this->cp["p_finance_period_id"]->GetValue())) 
            $this->cp["p_finance_period_id"]->SetValue($this->p_finance_period_id->GetValue(true));
        if (!strlen($this->cp["p_finance_period_id"]->GetText()) and !is_bool($this->cp["p_finance_period_id"]->GetValue(true))) 
            $this->cp["p_finance_period_id"]->SetText(0);
        if (!is_null($this->cp["t_revenue_target_id"]->GetValue()) and !strlen($this->cp["t_revenue_target_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_id"]->GetValue())) 
            $this->cp["t_revenue_target_id"]->SetValue($this->t_revenue_target_id->GetValue(true));
        if (!strlen($this->cp["t_revenue_target_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_id"]->GetValue(true))) 
            $this->cp["t_revenue_target_id"]->SetText(0);
        if (!is_null($this->cp["target_amt"]->GetValue()) and !strlen($this->cp["target_amt"]->GetText()) and !is_bool($this->cp["target_amt"]->GetValue())) 
            $this->cp["target_amt"]->SetValue($this->target_amt->GetValue(true));
        if (!strlen($this->cp["target_amt"]->GetText()) and !is_bool($this->cp["target_amt"]->GetValue(true))) 
            $this->cp["target_amt"]->SetText(0);
        if (!is_null($this->cp["p_vat_type_dtl_id"]->GetValue()) and !strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue())) 
            $this->cp["p_vat_type_dtl_id"]->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue(true))) 
            $this->cp["p_vat_type_dtl_id"]->SetText(0);
        $this->SQL = "INSERT INTO t_revenue_target_dtl(t_revenue_target_dtl_id, target_code, description, creation_date, created_by, updated_date, updated_by, p_finance_period_id, t_revenue_target_id, target_amt, p_vat_type_dtl_id) \n" .
        "VALUES(generate_id('sikp','t_revenue_target_dtl','t_revenue_target_dtl_id'), '" . $this->SQLValue($this->cp["target_code"]->GetDBValue(), ccsText) . "', '" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["created_by"]->GetDBValue(), ccsText) . "', sysdate, '" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', " . $this->SQLValue($this->cp["p_finance_period_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["t_revenue_target_id"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["target_amt"]->GetDBValue(), ccsFloat) . ", " . $this->SQLValue($this->cp["p_vat_type_dtl_id"]->GetDBValue(), ccsFloat) . ")";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @23-9FEB2B82
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_revenue_target_dtl_id"] = new clsSQLParameter("ctrlt_revenue_target_dtl_id", ccsFloat, "", "", $this->t_revenue_target_dtl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["target_code"] = new clsSQLParameter("ctrltarget_code", ccsText, "", "", $this->target_code->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["description"] = new clsSQLParameter("ctrldescription", ccsText, "", "", $this->description->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["updated_by"] = new clsSQLParameter("expr189", ccsText, "", "", CCGetUserLogin(), "", false, $this->ErrorBlock);
        $this->cp["p_finance_period_id"] = new clsSQLParameter("ctrlp_finance_period_id", ccsFloat, "", "", $this->p_finance_period_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["t_revenue_target_id"] = new clsSQLParameter("ctrlt_revenue_target_id", ccsFloat, "", "", $this->t_revenue_target_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["target_amt"] = new clsSQLParameter("ctrltarget_amt", ccsFloat, "", "", $this->target_amt->GetValue(true), 0, false, $this->ErrorBlock);
        $this->cp["p_vat_type_dtl_id"] = new clsSQLParameter("ctrlp_vat_type_dtl_id", ccsFloat, "", "", $this->p_vat_type_dtl_id->GetValue(true), 0, false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["t_revenue_target_dtl_id"]->GetValue()) and !strlen($this->cp["t_revenue_target_dtl_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_dtl_id"]->GetValue())) 
            $this->cp["t_revenue_target_dtl_id"]->SetValue($this->t_revenue_target_dtl_id->GetValue(true));
        if (!strlen($this->cp["t_revenue_target_dtl_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_dtl_id"]->GetValue(true))) 
            $this->cp["t_revenue_target_dtl_id"]->SetText(0);
        if (!is_null($this->cp["target_code"]->GetValue()) and !strlen($this->cp["target_code"]->GetText()) and !is_bool($this->cp["target_code"]->GetValue())) 
            $this->cp["target_code"]->SetValue($this->target_code->GetValue(true));
        if (!is_null($this->cp["description"]->GetValue()) and !strlen($this->cp["description"]->GetText()) and !is_bool($this->cp["description"]->GetValue())) 
            $this->cp["description"]->SetValue($this->description->GetValue(true));
        if (!is_null($this->cp["updated_by"]->GetValue()) and !strlen($this->cp["updated_by"]->GetText()) and !is_bool($this->cp["updated_by"]->GetValue())) 
            $this->cp["updated_by"]->SetValue(CCGetUserLogin());
        if (!is_null($this->cp["p_finance_period_id"]->GetValue()) and !strlen($this->cp["p_finance_period_id"]->GetText()) and !is_bool($this->cp["p_finance_period_id"]->GetValue())) 
            $this->cp["p_finance_period_id"]->SetValue($this->p_finance_period_id->GetValue(true));
        if (!strlen($this->cp["p_finance_period_id"]->GetText()) and !is_bool($this->cp["p_finance_period_id"]->GetValue(true))) 
            $this->cp["p_finance_period_id"]->SetText(0);
        if (!is_null($this->cp["t_revenue_target_id"]->GetValue()) and !strlen($this->cp["t_revenue_target_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_id"]->GetValue())) 
            $this->cp["t_revenue_target_id"]->SetValue($this->t_revenue_target_id->GetValue(true));
        if (!strlen($this->cp["t_revenue_target_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_id"]->GetValue(true))) 
            $this->cp["t_revenue_target_id"]->SetText(0);
        if (!is_null($this->cp["target_amt"]->GetValue()) and !strlen($this->cp["target_amt"]->GetText()) and !is_bool($this->cp["target_amt"]->GetValue())) 
            $this->cp["target_amt"]->SetValue($this->target_amt->GetValue(true));
        if (!strlen($this->cp["target_amt"]->GetText()) and !is_bool($this->cp["target_amt"]->GetValue(true))) 
            $this->cp["target_amt"]->SetText(0);
        if (!is_null($this->cp["p_vat_type_dtl_id"]->GetValue()) and !strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue())) 
            $this->cp["p_vat_type_dtl_id"]->SetValue($this->p_vat_type_dtl_id->GetValue(true));
        if (!strlen($this->cp["p_vat_type_dtl_id"]->GetText()) and !is_bool($this->cp["p_vat_type_dtl_id"]->GetValue(true))) 
            $this->cp["p_vat_type_dtl_id"]->SetText(0);
        $this->SQL = "UPDATE t_revenue_target_dtl SET  \n" .
        "target_code='" . $this->SQLValue($this->cp["target_code"]->GetDBValue(), ccsText) . "', \n" .
        "description='" . $this->SQLValue($this->cp["description"]->GetDBValue(), ccsText) . "', \n" .
        "updated_date=sysdate, \n" .
        "updated_by='" . $this->SQLValue($this->cp["updated_by"]->GetDBValue(), ccsText) . "', \n" .
        "p_finance_period_id=" . $this->SQLValue($this->cp["p_finance_period_id"]->GetDBValue(), ccsFloat) . ", \n" .
        "target_amt=" . $this->SQLValue($this->cp["target_amt"]->GetDBValue(), ccsFloat) . ",\n" .
        "p_vat_type_dtl_id = " . $this->SQLValue($this->cp["p_vat_type_dtl_id"]->GetDBValue(), ccsFloat) . "\n" .
        "WHERE t_revenue_target_dtl_id=" . $this->SQLValue($this->cp["t_revenue_target_dtl_id"]->GetDBValue(), ccsFloat) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @23-7108F346
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["t_revenue_target_dtl_id"] = new clsSQLParameter("ctrlt_revenue_target_dtl_id", ccsText, "", "", $this->t_revenue_target_dtl_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        if (!is_null($this->cp["t_revenue_target_dtl_id"]->GetValue()) and !strlen($this->cp["t_revenue_target_dtl_id"]->GetText()) and !is_bool($this->cp["t_revenue_target_dtl_id"]->GetValue())) 
            $this->cp["t_revenue_target_dtl_id"]->SetValue($this->t_revenue_target_dtl_id->GetValue(true));
        $this->SQL = "DELETE FROM t_revenue_target_dtl \n" .
        "WHERE  t_revenue_target_dtl_id = " . $this->SQLValue($this->cp["t_revenue_target_dtl_id"]->GetDBValue(), ccsText) . "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End v_t_revenue_target_dtlFormDataSource Class @23-FCB6E20C

//Initialize Page @1-02747BBD
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
$TemplateFileName = "t_revenue_target_dtl.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-06DCCAE3
include_once("./t_revenue_target_dtl_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-617F45DB
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$v_t_revenue_target_dtlGrid = & new clsGridv_t_revenue_target_dtlGrid("", $MainPage);
$v_t_revenue_target_dtlSearch = & new clsRecordv_t_revenue_target_dtlSearch("", $MainPage);
$v_t_revenue_target_dtlForm = & new clsRecordv_t_revenue_target_dtlForm("", $MainPage);
$rev_target_code = & new clsControl(ccsLabel, "rev_target_code", "rev_target_code", ccsText, "", CCGetRequestParam("rev_target_code", ccsGet, NULL), $MainPage);
$MainPage->v_t_revenue_target_dtlGrid = & $v_t_revenue_target_dtlGrid;
$MainPage->v_t_revenue_target_dtlSearch = & $v_t_revenue_target_dtlSearch;
$MainPage->v_t_revenue_target_dtlForm = & $v_t_revenue_target_dtlForm;
$MainPage->rev_target_code = & $rev_target_code;
$v_t_revenue_target_dtlGrid->Initialize();
$v_t_revenue_target_dtlForm->Initialize();

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

//Execute Components @1-458F60E9
$v_t_revenue_target_dtlSearch->Operation();
$v_t_revenue_target_dtlForm->Operation();
//End Execute Components

//Go to destination page @1-0544366F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($v_t_revenue_target_dtlGrid);
    unset($v_t_revenue_target_dtlSearch);
    unset($v_t_revenue_target_dtlForm);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DDF2C696
$v_t_revenue_target_dtlGrid->Show();
$v_t_revenue_target_dtlSearch->Show();
$v_t_revenue_target_dtlForm->Show();
$rev_target_code->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C7412C97
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($v_t_revenue_target_dtlGrid);
unset($v_t_revenue_target_dtlSearch);
unset($v_t_revenue_target_dtlForm);
unset($Tpl);
//End Unload Page


?>
