<?php
//Include Common Files @1-BDF50F88
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "getPembayaranBolong.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridSELECT_x_receipt_no_x_p_f { //SELECT_x_receipt_no_x_p_f class @2-B1486A93

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

//Class_Initialize Event @2-3033C34D
    function clsGridSELECT_x_receipt_no_x_p_f($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SELECT_x_receipt_no_x_p_f";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SELECT_x_receipt_no_x_p_f";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSELECT_x_receipt_no_x_p_fDataSource($this);
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

        $this->p_finance_period_id = & new clsControl(ccsLabel, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
        $this->description = & new clsControl(ccsLabel, "description", "description", ccsText, "", CCGetRequestParam("description", ccsGet, NULL), $this);
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->activation_date = & new clsControl(ccsLabel, "activation_date", "activation_date", ccsText, "", CCGetRequestParam("activation_date", ccsGet, NULL), $this);
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

//Show Method @2-35E58274
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $this->DataSource->Parameters["urlt_cust_account_id"] = CCGetFromGet("t_cust_account_id", NULL);
        $this->DataSource->Parameters["expr189"] = $this->activation_date;

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
            $this->ControlsVisible["p_finance_period_id"] = $this->p_finance_period_id->Visible;
            $this->ControlsVisible["description"] = $this->description->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["activation_date"] = $this->activation_date->Visible;
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
                $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                $this->description->SetValue($this->DataSource->description->GetValue());
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->activation_date->SetValue($this->DataSource->activation_date->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->p_finance_period_id->Show();
                $this->description->Show();
                $this->code->Show();
                $this->activation_date->Show();
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

//GetErrors Method @2-FCFEF8E0
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->p_finance_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->activation_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SELECT_x_receipt_no_x_p_f Class @2-FCB6E20C

class clsSELECT_x_receipt_no_x_p_fDataSource extends clsDBConnSIKP {  //SELECT_x_receipt_no_x_p_fDataSource Class @2-B4104131

//DataSource Variables @2-77A3D91D
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $p_finance_period_id;
    var $description;
    var $code;
    var $activation_date;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-169B9B23
    function clsSELECT_x_receipt_no_x_p_fDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SELECT_x_receipt_no_x_p_f";
        $this->Initialize();
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsFloat, "");
        
        $this->description = new clsField("description", ccsText, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->activation_date = new clsField("activation_date", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-C1FF34B8
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "f_per.start_date";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-500FAB5E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_finance_period_id", ccsText, "", "", $this->Parameters["urlp_finance_period_id"], "", false);
        $this->wp->AddParameter("2", "urlt_cust_account_id", ccsText, "", "", $this->Parameters["urlt_cust_account_id"], "", false);
        $this->wp->AddParameter("3", "expr189", ccsText, "", "", $this->Parameters["expr189"], "", false);
    }
//End Prepare Method

//Open Method @2-DD975FEB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT x.receipt_no,\n" .
        "x.p_finance_period_id,\n" .
        "x.description,\n" .
        "f_per.*\n" .
        "FROM p_finance_period f_per,\n" .
        "(select sett.p_finance_period_id,\n" .
        "receipt_no,sett_type.description\n" .
        "						from\n" .
        "							t_vat_setllement sett,\n" .
        "							p_settlement_type sett_type,\n" .
        "t_payment_receipt rec\n" .
        "							WHERE sett.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "\n" .
        "							and sett.p_settlement_type_id = sett_type.p_settlement_type_id\n" .
        "							and sett.t_vat_setllement_id = rec.t_vat_setllement_id (+)\n" .
        "							and sett.p_settlement_type_id <> 7) as x\n" .
        "					where f_per.p_finance_period_id = x.p_finance_period_id(+)\n" .
        "					and f_per.end_date < (select start_date from p_finance_period where p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . ")\n" .
        "					and f_per.start_date >= '01-01-2013'\n" .
        "					and (receipt_no is null or receipt_no ='')\n" .
        "					and f_per.start_date >= '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "') cnt";
        $this->SQL = "SELECT x.receipt_no,\n" .
        "x.p_finance_period_id,\n" .
        "x.description,\n" .
        "f_per.*\n" .
        "FROM p_finance_period f_per,\n" .
        "(select sett.p_finance_period_id,\n" .
        "receipt_no,sett_type.description\n" .
        "						from\n" .
        "							t_vat_setllement sett,\n" .
        "							p_settlement_type sett_type,\n" .
        "t_payment_receipt rec\n" .
        "							WHERE sett.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "\n" .
        "							and sett.p_settlement_type_id = sett_type.p_settlement_type_id\n" .
        "							and sett.t_vat_setllement_id = rec.t_vat_setllement_id (+)\n" .
        "							and sett.p_settlement_type_id <> 7) as x\n" .
        "					where f_per.p_finance_period_id = x.p_finance_period_id(+)\n" .
        "					and f_per.end_date < (select start_date from p_finance_period where p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . ")\n" .
        "					and f_per.start_date >= '01-01-2013'\n" .
        "					and (receipt_no is null or receipt_no ='')\n" .
        "					and f_per.start_date >= '" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "'\n" .
        "					 {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-026CBEDE
    function SetValues()
    {
        $this->p_finance_period_id->SetDBValue(trim($this->f("p_finance_period_id")));
        $this->description->SetDBValue($this->f("description"));
        $this->code->SetDBValue($this->f("code"));
        $this->activation_date->SetDBValue($this->f("activation_date"));
    }
//End SetValues Method

} //End SELECT_x_receipt_no_x_p_fDataSource Class @2-FCB6E20C

//Initialize Page @1-89026620
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
$TemplateFileName = "getPembayaranBolong.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Include events file @1-DFDE3FA3
include_once("./getPembayaranBolong_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F7E4AADA
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$SELECT_x_receipt_no_x_p_f = & new clsGridSELECT_x_receipt_no_x_p_f("", $MainPage);
$MainPage->SELECT_x_receipt_no_x_p_f = & $SELECT_x_receipt_no_x_p_f;
$SELECT_x_receipt_no_x_p_f->Initialize();

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

//Go to destination page @1-6E80FE88
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($SELECT_x_receipt_no_x_p_f);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4D6AA5C4
$SELECT_x_receipt_no_x_p_f->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-57A767AA
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($SELECT_x_receipt_no_x_p_f);
unset($Tpl);
//End Unload Page


?>
