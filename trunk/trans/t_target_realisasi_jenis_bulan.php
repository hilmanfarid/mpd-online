<?php
//Include Common Files @1-072AC6A0
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_target_realisasi_jenis_bulan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_target_realisasi_jenis_bulanForm { //t_target_realisasi_jenis_bulanForm Class @726-7303F36A

//Variables @726-D6FF3E86

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

//Class_Initialize Event @726-FB3410B9
    function clsRecordt_target_realisasi_jenis_bulanForm($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_target_realisasi_jenis_bulanForm/Error";
        $this->DataSource = new clst_target_realisasi_jenis_bulanFormDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_target_realisasi_jenis_bulanForm";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->p_year_period_id = & new clsControl(ccsHidden, "p_year_period_id", "p_year_period_id", ccsText, "", CCGetRequestParam("p_year_period_id", $Method, NULL), $this);
            $this->t_revenue_target_id = & new clsControl(ccsHidden, "t_revenue_target_id", "t_revenue_target_id", ccsText, "", CCGetRequestParam("t_revenue_target_id", $Method, NULL), $this);
            $this->p_vat_group_id = & new clsControl(ccsHidden, "p_vat_group_id", "p_vat_group_id", ccsText, "", CCGetRequestParam("p_vat_group_id", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @726-843CB29C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
    }
//End Initialize Method

//Validate Method @726-717347DD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->p_year_period_id->Validate() && $Validation);
        $Validation = ($this->t_revenue_target_id->Validate() && $Validation);
        $Validation = ($this->p_vat_group_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->p_year_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->t_revenue_target_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_vat_group_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @726-CA86D48B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->p_year_period_id->Errors->Count());
        $errors = ($errors || $this->t_revenue_target_id->Errors->Count());
        $errors = ($errors || $this->p_vat_group_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @726-ED598703
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

//Operation Method @726-17DC9883
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

//Show Method @726-46610EA9
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
                    $this->t_revenue_target_id->SetValue($this->DataSource->t_revenue_target_id->GetValue());
                    $this->p_vat_group_id->SetValue($this->DataSource->p_vat_group_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->p_year_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->t_revenue_target_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_vat_group_id->Errors->ToString());
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

        $this->p_year_period_id->Show();
        $this->t_revenue_target_id->Show();
        $this->p_vat_group_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End t_target_realisasi_jenis_bulanForm Class @726-FCB6E20C

class clst_target_realisasi_jenis_bulanFormDataSource extends clsDBConnSIKP {  //t_target_realisasi_jenis_bulanFormDataSource Class @726-820383E0

//DataSource Variables @726-208AA6FC
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $wp;
    var $AllParametersSet;


    // Datasource fields
    var $p_year_period_id;
    var $t_revenue_target_id;
    var $p_vat_group_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @726-4C2095B6
    function clst_target_realisasi_jenis_bulanFormDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record t_target_realisasi_jenis_bulanForm/Error";
        $this->Initialize();
        $this->p_year_period_id = new clsField("p_year_period_id", ccsText, "");
        
        $this->t_revenue_target_id = new clsField("t_revenue_target_id", ccsText, "");
        
        $this->p_vat_group_id = new clsField("p_vat_group_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @726-00F8EFCD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_revenue_target_id", ccsFloat, "", array(False, 0, Null, "", False, "", "", 1, True, ""), $this->Parameters["urlt_revenue_target_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
    }
//End Prepare Method

//Open Method @726-B273EC28
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n" .
        "FROM v_revenue_target_vs_realisasi_month\n" .
        "WHERE t_revenue_target_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "";
        $this->Order = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @726-1D5C6C81
    function SetValues()
    {
        $this->p_year_period_id->SetDBValue($this->f("p_year_period_id"));
        $this->t_revenue_target_id->SetDBValue($this->f("t_revenue_target_id"));
        $this->p_vat_group_id->SetDBValue($this->f("p_vat_group_id"));
    }
//End SetValues Method

} //End t_target_realisasi_jenis_bulanFormDataSource Class @726-FCB6E20C

class clsGridt_target_realisasiGrid { //t_target_realisasiGrid class @2-7DA52549

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

//Class_Initialize Event @2-7B70C9C8
    function clsGridt_target_realisasiGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_target_realisasiGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_target_realisasiGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_target_realisasiGridDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 12;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->bulan = & new clsControl(ccsLabel, "bulan", "bulan", ccsText, "", CCGetRequestParam("bulan", ccsGet, NULL), $this);
        $this->target_amount = & new clsControl(ccsLabel, "target_amount", "target_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount", ccsGet, NULL), $this);
        $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsText, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
        $this->percentage = & new clsControl(ccsLabel, "percentage", "percentage", ccsFloat, "", CCGetRequestParam("percentage", ccsGet, NULL), $this);
        $this->penalty_amt = & new clsControl(ccsLabel, "penalty_amt", "penalty_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("penalty_amt", ccsGet, NULL), $this);
        $this->debt_amt = & new clsControl(ccsLabel, "debt_amt", "debt_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("debt_amt", ccsGet, NULL), $this);
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->total_amt = & new clsControl(ccsLabel, "total_amt", "total_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_amt", ccsGet, NULL), $this);
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->start_date = & new clsControl(ccsHidden, "start_date", "start_date", ccsText, "", CCGetRequestParam("start_date", ccsGet, NULL), $this);
        $this->end_date = & new clsControl(ccsHidden, "end_date", "end_date", ccsText, "", CCGetRequestParam("end_date", ccsGet, NULL), $this);
        $this->DLink = & new clsControl(ccsLink, "DLink", "DLink", ccsText, "", CCGetRequestParam("DLink", ccsGet, NULL), $this);
        $this->DLink->HTML = true;
        $this->DLink->Page = "t_target_realisasi_jenis_bulan.php";
        $this->denda_pokok = & new clsControl(ccsLabel, "denda_pokok", "denda_pokok", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("denda_pokok", ccsGet, NULL), $this);
        $this->denda_piutang = & new clsControl(ccsLabel, "denda_piutang", "denda_piutang", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("denda_piutang", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->target_amount_sum = & new clsControl(ccsLabel, "target_amount_sum", "target_amount_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount_sum", ccsGet, NULL), $this);
        $this->realisasi_amt_sum = & new clsControl(ccsLabel, "realisasi_amt_sum", "realisasi_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt_sum", ccsGet, NULL), $this);
        $this->percentage_sum = & new clsControl(ccsLabel, "percentage_sum", "percentage_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("percentage_sum", ccsGet, NULL), $this);
        $this->penalty_amt_sum = & new clsControl(ccsLabel, "penalty_amt_sum", "penalty_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("penalty_amt_sum", ccsGet, NULL), $this);
        $this->debt_amt_sum = & new clsControl(ccsLabel, "debt_amt_sum", "debt_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("debt_amt_sum", ccsGet, NULL), $this);
        $this->total_amt_sum = & new clsControl(ccsLabel, "total_amt_sum", "total_amt_sum", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_amt_sum", ccsGet, NULL), $this);
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

//Show Method @2-C9AC34D4
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);
        $this->DataSource->Parameters["urlp_vat_type_id"] = CCGetFromGet("p_vat_type_id", NULL);

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
            $this->ControlsVisible["bulan"] = $this->bulan->Visible;
            $this->ControlsVisible["target_amount"] = $this->target_amount->Visible;
            $this->ControlsVisible["p_finance_period_id"] = $this->p_finance_period_id->Visible;
            $this->ControlsVisible["percentage"] = $this->percentage->Visible;
            $this->ControlsVisible["penalty_amt"] = $this->penalty_amt->Visible;
            $this->ControlsVisible["debt_amt"] = $this->debt_amt->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["total_amt"] = $this->total_amt->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["start_date"] = $this->start_date->Visible;
            $this->ControlsVisible["end_date"] = $this->end_date->Visible;
            $this->ControlsVisible["DLink"] = $this->DLink->Visible;
            $this->ControlsVisible["denda_pokok"] = $this->denda_pokok->Visible;
            $this->ControlsVisible["denda_piutang"] = $this->denda_piutang->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->bulan->SetValue($this->DataSource->bulan->GetValue());
                $this->target_amount->SetValue($this->DataSource->target_amount->GetValue());
                $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                $this->penalty_amt->SetValue($this->DataSource->penalty_amt->GetValue());
                $this->debt_amt->SetValue($this->DataSource->debt_amt->GetValue());
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->total_amt->SetValue($this->DataSource->total_amt->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->start_date->SetValue($this->DataSource->start_date->GetValue());
                $this->end_date->SetValue($this->DataSource->end_date->GetValue());
                $this->DLink->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DLink->Parameters = CCAddParam($this->DLink->Parameters, "p_finance_period_id", $this->DataSource->f("p_finance_period_id"));
                $this->denda_pokok->SetValue($this->DataSource->denda_pokok->GetValue());
                $this->denda_piutang->SetValue($this->DataSource->denda_piutang->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->bulan->Show();
                $this->target_amount->Show();
                $this->p_finance_period_id->Show();
                $this->percentage->Show();
                $this->penalty_amt->Show();
                $this->debt_amt->Show();
                $this->realisasi_amt->Show();
                $this->total_amt->Show();
                $this->p_vat_type_id->Show();
                $this->start_date->Show();
                $this->end_date->Show();
                $this->DLink->Show();
                $this->denda_pokok->Show();
                $this->denda_piutang->Show();
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
        $this->target_amount_sum->Show();
        $this->realisasi_amt_sum->Show();
        $this->percentage_sum->Show();
        $this->penalty_amt_sum->Show();
        $this->debt_amt_sum->Show();
        $this->total_amt_sum->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-A1C31A30
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->bulan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_finance_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->penalty_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->start_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->end_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DLink->Errors->ToString());
        $errors = ComposeStrings($errors, $this->denda_pokok->Errors->ToString());
        $errors = ComposeStrings($errors, $this->denda_piutang->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasiGrid Class @2-FCB6E20C

class clst_target_realisasiGridDataSource extends clsDBConnSIKP {  //t_target_realisasiGridDataSource Class @2-9A91A27E

//DataSource Variables @2-38519CCE
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $bulan;
    var $target_amount;
    var $p_finance_period_id;
    var $penalty_amt;
    var $debt_amt;
    var $realisasi_amt;
    var $total_amt;
    var $p_vat_type_id;
    var $start_date;
    var $end_date;
    var $denda_pokok;
    var $denda_piutang;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-886376C3
    function clst_target_realisasiGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasiGrid";
        $this->Initialize();
        $this->bulan = new clsField("bulan", ccsText, "");
        
        $this->target_amount = new clsField("target_amount", ccsFloat, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsText, "");
        
        $this->penalty_amt = new clsField("penalty_amt", ccsFloat, "");
        
        $this->debt_amt = new clsField("debt_amt", ccsFloat, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        
        $this->total_amt = new clsField("total_amt", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->start_date = new clsField("start_date", ccsText, "");
        
        $this->end_date = new clsField("end_date", ccsText, "");
        
        $this->denda_pokok = new clsField("denda_pokok", ccsFloat, "");
        
        $this->denda_piutang = new clsField("denda_piutang", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-13FF2B55
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "MAX(start_date) ASC";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-CFF5271D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_year_period_id", ccsFloat, "", "", $this->Parameters["urlp_year_period_id"], 0, false);
        $this->wp->AddParameter("2", "urlp_vat_type_id", ccsText, "", "", $this->Parameters["urlp_vat_type_id"], "", false);
    }
//End Prepare Method

//Open Method @2-96B869A6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT\n" .
        "	MAX(p_finance_period_id) as p_finance_period_id,\n" .
        "	MAX(p_year_period_id) as p_year_period_id,\n" .
        "	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,\n" .
        "	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,\n" .
        "	MAX(p_vat_type_id) as p_vat_type_id,\n" .
        "	MAX(bulan) as bulan,\n" .
        "	ROUND(SUM (target_amount)) as target_amount,\n" .
        "	ROUND(SUM (realisasi_amt)) as realisasi_amt,\n" .
        "	MAX (penalty_amt) as penalty_amt,\n" .
        "	ROUND(SUM (debt_amt)) as debt_amt,\n" .
        "	ROUND(SUM (denda_pokok)) as denda_pokok,\n" .
        "	ROUND(SUM (denda_piutang)) as denda_piutang\n" .
        "FROM\n" .
        "	f_target_vs_real_monthly_new3(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "," . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . ")\n" .
        "GROUP BY p_finance_period_id) cnt";
        $this->SQL = "SELECT\n" .
        "	MAX(p_finance_period_id) as p_finance_period_id,\n" .
        "	MAX(p_year_period_id) as p_year_period_id,\n" .
        "	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,\n" .
        "	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,\n" .
        "	MAX(p_vat_type_id) as p_vat_type_id,\n" .
        "	MAX(bulan) as bulan,\n" .
        "	ROUND(SUM (target_amount)) as target_amount,\n" .
        "	ROUND(SUM (realisasi_amt)) as realisasi_amt,\n" .
        "	MAX (penalty_amt) as penalty_amt,\n" .
        "	ROUND(SUM (debt_amt)) as debt_amt,\n" .
        "	ROUND(SUM (denda_pokok)) as denda_pokok,\n" .
        "	ROUND(SUM (denda_piutang)) as denda_piutang\n" .
        "FROM\n" .
        "	f_target_vs_real_monthly_new3(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "," . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . ")\n" .
        "GROUP BY p_finance_period_id {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-F85E65F6
    function SetValues()
    {
        $this->bulan->SetDBValue($this->f("bulan"));
        $this->target_amount->SetDBValue(trim($this->f("target_amount")));
        $this->p_finance_period_id->SetDBValue($this->f("p_finance_period_id"));
        $this->penalty_amt->SetDBValue(trim($this->f("penalty_amt")));
        $this->debt_amt->SetDBValue(trim($this->f("debt_amt")));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
        $this->total_amt->SetDBValue(trim($this->f("target_amount")));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->start_date->SetDBValue($this->f("start_date"));
        $this->end_date->SetDBValue($this->f("end_date"));
        $this->denda_pokok->SetDBValue(trim($this->f("denda_pokok")));
        $this->denda_piutang->SetDBValue(trim($this->f("denda_piutang")));
    }
//End SetValues Method

} //End t_target_realisasiGridDataSource Class @2-FCB6E20C

class clsGridt_target_realisasiGrid1 { //t_target_realisasiGrid1 class @900-103EBCA7

//Variables @900-AC1EDBB9

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

//Class_Initialize Event @900-08665D2A
    function clsGridt_target_realisasiGrid1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "t_target_realisasiGrid1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid t_target_realisasiGrid1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clst_target_realisasiGrid1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 12;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->ayat = & new clsControl(ccsLabel, "ayat", "ayat", ccsText, "", CCGetRequestParam("ayat", ccsGet, NULL), $this);
        $this->target_amount = & new clsControl(ccsLabel, "target_amount", "target_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("target_amount", ccsGet, NULL), $this);
        $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsText, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
        $this->percentage = & new clsControl(ccsLabel, "percentage", "percentage", ccsFloat, "", CCGetRequestParam("percentage", ccsGet, NULL), $this);
        $this->debt_amt = & new clsControl(ccsLabel, "debt_amt", "debt_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("debt_amt", ccsGet, NULL), $this);
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->total_amt = & new clsControl(ccsLabel, "total_amt", "total_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_amt", ccsGet, NULL), $this);
        $this->p_vat_type_id = & new clsControl(ccsHidden, "p_vat_type_id", "p_vat_type_id", ccsText, "", CCGetRequestParam("p_vat_type_id", ccsGet, NULL), $this);
        $this->start_date = & new clsControl(ccsHidden, "start_date", "start_date", ccsText, "", CCGetRequestParam("start_date", ccsGet, NULL), $this);
        $this->end_date = & new clsControl(ccsHidden, "end_date", "end_date", ccsText, "", CCGetRequestParam("end_date", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @900-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @900-E8350955
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_year_period_id"] = CCGetFromGet("p_year_period_id", NULL);
        $this->DataSource->Parameters["urlp_vat_type_id"] = CCGetFromGet("p_vat_type_id", NULL);
        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);

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
            $this->ControlsVisible["ayat"] = $this->ayat->Visible;
            $this->ControlsVisible["target_amount"] = $this->target_amount->Visible;
            $this->ControlsVisible["p_finance_period_id"] = $this->p_finance_period_id->Visible;
            $this->ControlsVisible["percentage"] = $this->percentage->Visible;
            $this->ControlsVisible["debt_amt"] = $this->debt_amt->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["total_amt"] = $this->total_amt->Visible;
            $this->ControlsVisible["p_vat_type_id"] = $this->p_vat_type_id->Visible;
            $this->ControlsVisible["start_date"] = $this->start_date->Visible;
            $this->ControlsVisible["end_date"] = $this->end_date->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ayat->SetValue($this->DataSource->ayat->GetValue());
                $this->target_amount->SetValue($this->DataSource->target_amount->GetValue());
                $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                $this->debt_amt->SetValue($this->DataSource->debt_amt->GetValue());
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->total_amt->SetValue($this->DataSource->total_amt->GetValue());
                $this->p_vat_type_id->SetValue($this->DataSource->p_vat_type_id->GetValue());
                $this->start_date->SetValue($this->DataSource->start_date->GetValue());
                $this->end_date->SetValue($this->DataSource->end_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ayat->Show();
                $this->target_amount->Show();
                $this->p_finance_period_id->Show();
                $this->percentage->Show();
                $this->debt_amt->Show();
                $this->realisasi_amt->Show();
                $this->total_amt->Show();
                $this->p_vat_type_id->Show();
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

//GetErrors Method @900-3CA2F0B6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ayat->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_finance_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->percentage->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_vat_type_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->start_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->end_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End t_target_realisasiGrid1 Class @900-FCB6E20C

class clst_target_realisasiGrid1DataSource extends clsDBConnSIKP {  //t_target_realisasiGrid1DataSource Class @900-25560BF8

//DataSource Variables @900-94395054
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ayat;
    var $target_amount;
    var $p_finance_period_id;
    var $debt_amt;
    var $realisasi_amt;
    var $total_amt;
    var $p_vat_type_id;
    var $start_date;
    var $end_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @900-424FDFF1
    function clst_target_realisasiGrid1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid t_target_realisasiGrid1";
        $this->Initialize();
        $this->ayat = new clsField("ayat", ccsText, "");
        
        $this->target_amount = new clsField("target_amount", ccsFloat, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsText, "");
        
        $this->debt_amt = new clsField("debt_amt", ccsFloat, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        
        $this->total_amt = new clsField("total_amt", ccsFloat, "");
        
        $this->p_vat_type_id = new clsField("p_vat_type_id", ccsText, "");
        
        $this->start_date = new clsField("start_date", ccsText, "");
        
        $this->end_date = new clsField("end_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @900-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @900-9F3576D7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_year_period_id", ccsFloat, "", "", $this->Parameters["urlp_year_period_id"], 0, false);
        $this->wp->AddParameter("2", "urlp_vat_type_id", ccsText, "", "", $this->Parameters["urlp_vat_type_id"], null, false);
        $this->wp->AddParameter("3", "urlp_finance_period_id", ccsText, "", "", $this->Parameters["urlp_finance_period_id"], 'null', false);
    }
//End Prepare Method

//Open Method @900-832603B5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM ((SELECT\n" .
        "	MAX(target.p_finance_period_id) as p_finance_period_id,\n" .
        "	MAX(target.p_year_period_id) as p_year_period_id,\n" .
        "	to_char(MAX(target.start_date),'dd-mm-yyyy') as start_date,\n" .
        "	to_char(MAX(target.end_date),'dd-mm-yyyy') as end_date,\n" .
        "	MAX(target.p_vat_type_id) as p_vat_type_id,\n" .
        "	MAX(target.bulan) as bulan,\n" .
        "	ROUND(SUM (target.target_amount)) as target_amount,\n" .
        "	ROUND(SUM (target.realisasi_amt)) as realisasi_amt,\n" .
        "	ROUND(SUM (target.penalty_amt)) as penalty_amt,\n" .
        "	ROUND(SUM (target.debt_amt)) as debt_amt,\n" .
        "	MAX(dtl.vat_code) as ayat\n" .
        "FROM\n" .
        "	f_target_vs_real_monthly_new(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "," . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . ") target,\n" .
        "	p_vat_type_dtl dtl\n" .
        "WHERE\n" .
        "	dtl.p_vat_type_dtl_id = target.p_vat_type_dtl_id\n" .
        "	AND (target.p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " or " . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " is null)\n" .
        "GROUP BY target.p_vat_type_dtl_id\n" .
        "\n" .
        "ORDER BY MAX(dtl.vat_code) ASC)\n" .
        "UNION\n" .
        "(select 999,\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",\n" .
        "	'',\n" .
        "	'',\n" .
        "	0,\n" .
        "	'',\n" .
        "	0,\n" .
        "	f_get_total_denda_ayat(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "," . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "," . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . ") as jumlah,\n" .
        "	0,\n" .
        "	0,\n" .
        "	'DENDA')) cnt";
        $this->SQL = "(SELECT\n" .
        "	MAX(target.p_finance_period_id) as p_finance_period_id,\n" .
        "	MAX(target.p_year_period_id) as p_year_period_id,\n" .
        "	to_char(MAX(target.start_date),'dd-mm-yyyy') as start_date,\n" .
        "	to_char(MAX(target.end_date),'dd-mm-yyyy') as end_date,\n" .
        "	MAX(target.p_vat_type_id) as p_vat_type_id,\n" .
        "	MAX(target.bulan) as bulan,\n" .
        "	ROUND(SUM (target.target_amount)) as target_amount,\n" .
        "	ROUND(SUM (target.realisasi_amt)) as realisasi_amt,\n" .
        "	ROUND(SUM (target.penalty_amt)) as penalty_amt,\n" .
        "	ROUND(SUM (target.debt_amt)) as debt_amt,\n" .
        "	MAX(dtl.vat_code) as ayat\n" .
        "FROM\n" .
        "	f_target_vs_real_monthly_new(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "," . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . ") target,\n" .
        "	p_vat_type_dtl dtl\n" .
        "WHERE\n" .
        "	dtl.p_vat_type_dtl_id = target.p_vat_type_dtl_id\n" .
        "	AND (target.p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " or " . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " is null)\n" .
        "GROUP BY target.p_vat_type_dtl_id\n" .
        "\n" .
        "ORDER BY MAX(dtl.vat_code) ASC)\n" .
        "UNION\n" .
        "(select 999,\n" .
        "	" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",\n" .
        "	'',\n" .
        "	'',\n" .
        "	0,\n" .
        "	'',\n" .
        "	0,\n" .
        "	f_get_total_denda_ayat(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "," . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "," . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . ") as jumlah,\n" .
        "	0,\n" .
        "	0,\n" .
        "	'DENDA')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @900-4DB832D8
    function SetValues()
    {
        $this->ayat->SetDBValue($this->f("ayat"));
        $this->target_amount->SetDBValue(trim($this->f("target_amount")));
        $this->p_finance_period_id->SetDBValue($this->f("p_finance_period_id"));
        $this->debt_amt->SetDBValue(trim($this->f("debt_amt")));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
        $this->total_amt->SetDBValue(trim($this->f("target_amount")));
        $this->p_vat_type_id->SetDBValue($this->f("p_vat_type_id"));
        $this->start_date->SetDBValue($this->f("start_date"));
        $this->end_date->SetDBValue($this->f("end_date"));
    }
//End SetValues Method

} //End t_target_realisasiGrid1DataSource Class @900-FCB6E20C



//Initialize Page @1-51B41586
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
$TemplateFileName = "t_target_realisasi_jenis_bulan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2AB1A43D
include_once("./t_target_realisasi_jenis_bulan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B8C3DA6A
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_target_realisasi_jenis_bulanForm = & new clsRecordt_target_realisasi_jenis_bulanForm("", $MainPage);
$t_target_realisasiGrid = & new clsGridt_target_realisasiGrid("", $MainPage);
$t_target_realisasiGrid1 = & new clsGridt_target_realisasiGrid1("", $MainPage);
$MainPage->t_target_realisasi_jenis_bulanForm = & $t_target_realisasi_jenis_bulanForm;
$MainPage->t_target_realisasiGrid = & $t_target_realisasiGrid;
$MainPage->t_target_realisasiGrid1 = & $t_target_realisasiGrid1;
$t_target_realisasi_jenis_bulanForm->Initialize();
$t_target_realisasiGrid->Initialize();
$t_target_realisasiGrid1->Initialize();

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

//Execute Components @1-C306FCA2
$t_target_realisasi_jenis_bulanForm->Operation();
//End Execute Components

//Go to destination page @1-6BA82625
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_target_realisasi_jenis_bulanForm);
    unset($t_target_realisasiGrid);
    unset($t_target_realisasiGrid1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7A2A6E69
$t_target_realisasi_jenis_bulanForm->Show();
$t_target_realisasiGrid->Show();
$t_target_realisasiGrid1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-3A294015
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_target_realisasi_jenis_bulanForm);
unset($t_target_realisasiGrid);
unset($t_target_realisasiGrid1);
unset($Tpl);
//End Unload Page


?>
