<?php
//Include Common Files @1-FD0CDC3A
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "t_target_realisasi_bulan_all.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridSELECT_MAX_p_finance_peri { //SELECT_MAX_p_finance_peri class @2-E6BCBD96

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

//Class_Initialize Event @2-0ECF9054
    function clsGridSELECT_MAX_p_finance_peri($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SELECT_MAX_p_finance_peri";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SELECT_MAX_p_finance_peri";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSELECT_MAX_p_finance_periDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->bulan = & new clsControl(ccsLabel, "bulan", "bulan", ccsMemo, "", CCGetRequestParam("bulan", ccsGet, NULL), $this);
        $this->target_amount = & new clsControl(ccsLabel, "target_amount", "target_amount", ccsFloat, "", CCGetRequestParam("target_amount", ccsGet, NULL), $this);
        $this->realisasi_amt = & new clsControl(ccsLabel, "realisasi_amt", "realisasi_amt", ccsFloat, "", CCGetRequestParam("realisasi_amt", ccsGet, NULL), $this);
        $this->penalty_amt = & new clsControl(ccsLabel, "penalty_amt", "penalty_amt", ccsFloat, "", CCGetRequestParam("penalty_amt", ccsGet, NULL), $this);
        $this->debt_amt = & new clsControl(ccsLabel, "debt_amt", "debt_amt", ccsFloat, "", CCGetRequestParam("debt_amt", ccsGet, NULL), $this);
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

//Show Method @2-0BDDA3D2
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

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
            $this->ControlsVisible["bulan"] = $this->bulan->Visible;
            $this->ControlsVisible["target_amount"] = $this->target_amount->Visible;
            $this->ControlsVisible["realisasi_amt"] = $this->realisasi_amt->Visible;
            $this->ControlsVisible["penalty_amt"] = $this->penalty_amt->Visible;
            $this->ControlsVisible["debt_amt"] = $this->debt_amt->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                // Parse Separator
                if($this->RowNumber) {
                    $this->Attributes->Show();
                    $Tpl->parseto("Separator", true, "Row");
                }
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->bulan->SetValue($this->DataSource->bulan->GetValue());
                $this->target_amount->SetValue($this->DataSource->target_amount->GetValue());
                $this->realisasi_amt->SetValue($this->DataSource->realisasi_amt->GetValue());
                $this->penalty_amt->SetValue($this->DataSource->penalty_amt->GetValue());
                $this->debt_amt->SetValue($this->DataSource->debt_amt->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->bulan->Show();
                $this->target_amount->Show();
                $this->realisasi_amt->Show();
                $this->penalty_amt->Show();
                $this->debt_amt->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
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

//GetErrors Method @2-B328EBCD
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->bulan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->target_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->realisasi_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->penalty_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SELECT_MAX_p_finance_peri Class @2-FCB6E20C

class clsSELECT_MAX_p_finance_periDataSource extends clsDBConnSIKP {  //SELECT_MAX_p_finance_periDataSource Class @2-243AE0DA

//DataSource Variables @2-B369E7A0
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
    var $realisasi_amt;
    var $penalty_amt;
    var $debt_amt;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-626F450F
    function clsSELECT_MAX_p_finance_periDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SELECT_MAX_p_finance_peri";
        $this->Initialize();
        $this->bulan = new clsField("bulan", ccsMemo, "");
        
        $this->target_amount = new clsField("target_amount", ccsFloat, "");
        
        $this->realisasi_amt = new clsField("realisasi_amt", ccsFloat, "");
        
        $this->penalty_amt = new clsField("penalty_amt", ccsFloat, "");
        
        $this->debt_amt = new clsField("debt_amt", ccsFloat, "");
        

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

//Prepare Method @2-B2A48663
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_year_period_id", ccsText, "", "", $this->Parameters["urlp_year_period_id"], "", false);
    }
//End Prepare Method

//Open Method @2-F42D00D8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT\n" .
        "	MAX(p_finance_period_id) as p_finance_period_id, \n" .
        "	MAX(p_year_period_id) as p_year_period_id,\n" .
        "	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,\n" .
        "	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,\n" .
        "	MAX(p_vat_type_id) as p_vat_type_id,\n" .
        "	MAX(bulan) as bulan,\n" .
        "	SUM (target_amount) as target_amount,\n" .
        "	SUM (realisasi_amt) as realisasi_amt,\n" .
        "	MAX (penalty_amt) as penalty_amt,\n" .
        "	SUM (debt_amt) as debt_amt\n" .
        "FROM\n" .
        "	f_target_vs_real_monthly_new(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . ",null)\n" .
        "GROUP BY p_finance_period_id) cnt";
        $this->SQL = "SELECT\n" .
        "	MAX(p_finance_period_id) as p_finance_period_id, \n" .
        "	MAX(p_year_period_id) as p_year_period_id,\n" .
        "	to_char(MAX(start_date),'dd-mm-yyyy') as start_date,\n" .
        "	to_char(MAX(end_date),'dd-mm-yyyy') as end_date,\n" .
        "	MAX(p_vat_type_id) as p_vat_type_id,\n" .
        "	MAX(bulan) as bulan,\n" .
        "	SUM (target_amount) as target_amount,\n" .
        "	SUM (realisasi_amt) as realisasi_amt,\n" .
        "	MAX (penalty_amt) as penalty_amt,\n" .
        "	SUM (debt_amt) as debt_amt\n" .
        "FROM\n" .
        "	f_target_vs_real_monthly_new(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . ",null)\n" .
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

//SetValues Method @2-B1C740BA
    function SetValues()
    {
        $this->bulan->SetDBValue($this->f("bulan"));
        $this->target_amount->SetDBValue(trim($this->f("target_amount")));
        $this->realisasi_amt->SetDBValue(trim($this->f("realisasi_amt")));
        $this->penalty_amt->SetDBValue(trim($this->f("penalty_amt")));
        $this->debt_amt->SetDBValue(trim($this->f("debt_amt")));
    }
//End SetValues Method

} //End SELECT_MAX_p_finance_periDataSource Class @2-FCB6E20C

//Initialize Page @1-CF0B3639
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
$TemplateFileName = "t_target_realisasi_bulan_all.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-72A316CE
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$SELECT_MAX_p_finance_peri = & new clsGridSELECT_MAX_p_finance_peri("", $MainPage);
$MainPage->SELECT_MAX_p_finance_peri = & $SELECT_MAX_p_finance_peri;
$SELECT_MAX_p_finance_peri->Initialize();

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

//Go to destination page @1-13F1A1EA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($SELECT_MAX_p_finance_peri);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-371BB7FF
$SELECT_MAX_p_finance_peri->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-007E8105
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($SELECT_MAX_p_finance_peri);
unset($Tpl);
//End Unload Page


?>
