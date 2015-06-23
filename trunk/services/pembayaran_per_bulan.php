<?php
//Include Common Files @1-18F77197
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "pembayaran_per_bulan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridSELECT_target_amt_realisa { //SELECT_target_amt_realisa class @2-74319BF2

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

//Class_Initialize Event @2-64F04440
    function clsGridSELECT_target_amt_realisa($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "SELECT_target_amt_realisa";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid SELECT_target_amt_realisa";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsSELECT_target_amt_realisaDataSource($this);
        $this->ds = & $this->DataSource;

        $this->wp_name = & new clsControl(ccsLabel, "wp_name", "wp_name", ccsFloat, "", CCGetRequestParam("wp_name", ccsGet, NULL), $this);
        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsFloat, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->code = & new clsControl(ccsLabel, "code", "code", ccsText, "", CCGetRequestParam("code", ccsGet, NULL), $this);
        $this->p_finance_period_id = & new clsControl(ccsLabel, "p_finance_period_id", "p_finance_period_id", ccsText, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-C7E5AB3A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
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
            $this->ControlsVisible["wp_name"] = $this->wp_name->Visible;
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["code"] = $this->code->Visible;
            $this->ControlsVisible["p_finance_period_id"] = $this->p_finance_period_id->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
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
                $this->wp_name->SetValue($this->DataSource->wp_name->GetValue());
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->code->SetValue($this->DataSource->code->GetValue());
                $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->wp_name->Show();
                $this->npwd->Show();
                $this->code->Show();
                $this->p_finance_period_id->Show();
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

//GetErrors Method @2-656ECE64
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->wp_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_finance_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End SELECT_target_amt_realisa Class @2-FCB6E20C

class clsSELECT_target_amt_realisaDataSource extends clsDBConnSIKP {  //SELECT_target_amt_realisaDataSource Class @2-A6488CD8

//DataSource Variables @2-8134FA96
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $wp_name;
    var $npwd;
    var $code;
    var $p_finance_period_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-2784113E
    function clsSELECT_target_amt_realisaDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid SELECT_target_amt_realisa";
        $this->Initialize();
        $this->wp_name = new clsField("wp_name", ccsFloat, "");
        
        $this->npwd = new clsField("npwd", ccsFloat, "");
        
        $this->code = new clsField("code", ccsText, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-1264E3EB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $this->Parameters["urlp_finance_period_id"], 0, false);
        $this->wp->AddParameter("2", "urlp_vat_type_id", ccsInteger, "", "", $this->Parameters["urlp_vat_type_id"], 1, false);
    }
//End Prepare Method

//Open Method @2-AB3818A5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select to_char(i,'dd') as tanggal,nvl(realisasi_harian,0) as realisasi \n" .
        "from (select i::date from generate_series((select start_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "), \n" .
        "  (select end_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "), '1 day'::interval) i) as hari\n" .
        "left join \n" .
        "	(select \n" .
        "		trunc(b.payment_date)as tanggal_bayar,\n" .
        "		sum(b.payment_amount) as realisasi_harian \n" .
        "		from t_vat_setllement a\n" .
        "		left join t_payment_receipt b on a.t_vat_setllement_id=b.t_vat_setllement_id\n" .
        "		where a.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id=" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . ")\n" .
        "		and b.t_vat_setllement_id is not null\n" .
        "		and b.payment_date \n" .
        "			BETWEEN \n" .
        "				(select start_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "			and \n" .
        "				(select end_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "		GROUP BY tanggal_bayar\n" .
        "		ORDER BY tanggal_bayar) pembayaran\n" .
        "	ON pembayaran.tanggal_bayar=hari.i) cnt";
        $this->SQL = "select to_char(i,'dd') as tanggal,nvl(realisasi_harian,0) as realisasi \n" .
        "from (select i::date from generate_series((select start_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "), \n" .
        "  (select end_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "), '1 day'::interval) i) as hari\n" .
        "left join \n" .
        "	(select \n" .
        "		trunc(b.payment_date)as tanggal_bayar,\n" .
        "		sum(b.payment_amount) as realisasi_harian \n" .
        "		from t_vat_setllement a\n" .
        "		left join t_payment_receipt b on a.t_vat_setllement_id=b.t_vat_setllement_id\n" .
        "		where a.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id=" . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . ")\n" .
        "		and b.t_vat_setllement_id is not null\n" .
        "		and b.payment_date \n" .
        "			BETWEEN \n" .
        "				(select start_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "			and \n" .
        "				(select end_date from p_finance_period where p_finance_period_id=" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ")\n" .
        "		GROUP BY tanggal_bayar\n" .
        "		ORDER BY tanggal_bayar) pembayaran\n" .
        "	ON pembayaran.tanggal_bayar=hari.i";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D5F88E85
    function SetValues()
    {
        $this->wp_name->SetDBValue(trim($this->f("wp_name")));
        $this->npwd->SetDBValue(trim($this->f("npwd")));
        $this->code->SetDBValue($this->f("code"));
        $this->p_finance_period_id->SetDBValue($this->f("p_finance_period_id"));
    }
//End SetValues Method

} //End SELECT_target_amt_realisaDataSource Class @2-FCB6E20C

//Initialize Page @1-6A57FB0D
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
$TemplateFileName = "pembayaran_per_bulan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Include events file @1-16C09E12
include_once("./pembayaran_per_bulan_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-902FE2AD
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$SELECT_target_amt_realisa = & new clsGridSELECT_target_amt_realisa("", $MainPage);
$MainPage->SELECT_target_amt_realisa = & $SELECT_target_amt_realisa;
$SELECT_target_amt_realisa->Initialize();

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

//Go to destination page @1-5767AC72
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($SELECT_target_amt_realisa);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AB051230
$SELECT_target_amt_realisa->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-40136F99
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($SELECT_target_amt_realisa);
unset($Tpl);
//End Unload Page


?>
