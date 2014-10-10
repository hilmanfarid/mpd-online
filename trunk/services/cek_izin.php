<?php
//Include Common Files @1-6176CD3A
define("RelativePath", "..");
define("PathToCurrentPage", "/services/");
define("FileName", "cek_izin.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridselect_from_f_trans_histo { //select_from_f_trans_histo class @2-0C13A4B4

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

//Class_Initialize Event @2-F093DA3F
    function clsGridselect_from_f_trans_histo($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "select_from_f_trans_histo";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid select_from_f_trans_histo";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsselect_from_f_trans_histoDataSource($this);
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

        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->t_vat_setllement_id = & new clsControl(ccsLabel, "t_vat_setllement_id", "t_vat_setllement_id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsLabel, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->company_name = & new clsControl(ccsLabel, "company_name", "company_name", ccsText, "", CCGetRequestParam("company_name", ccsGet, NULL), $this);
        $this->periode_pelaporan = & new clsControl(ccsLabel, "periode_pelaporan", "periode_pelaporan", ccsText, "", CCGetRequestParam("periode_pelaporan", ccsGet, NULL), $this);
        $this->tgl_pelaporan = & new clsControl(ccsLabel, "tgl_pelaporan", "tgl_pelaporan", ccsText, "", CCGetRequestParam("tgl_pelaporan", ccsGet, NULL), $this);
        $this->total_transaksi = & new clsControl(ccsLabel, "total_transaksi", "total_transaksi", ccsFloat, "", CCGetRequestParam("total_transaksi", ccsGet, NULL), $this);
        $this->total_pajak = & new clsControl(ccsLabel, "total_pajak", "total_pajak", ccsFloat, "", CCGetRequestParam("total_pajak", ccsGet, NULL), $this);
        $this->kuitansi_pembayaran = & new clsControl(ccsLabel, "kuitansi_pembayaran", "kuitansi_pembayaran", ccsText, "", CCGetRequestParam("kuitansi_pembayaran", ccsGet, NULL), $this);
        $this->tgl_pembayaran = & new clsControl(ccsLabel, "tgl_pembayaran", "tgl_pembayaran", ccsText, "", CCGetRequestParam("tgl_pembayaran", ccsGet, NULL), $this);
        $this->payment_amount = & new clsControl(ccsLabel, "payment_amount", "payment_amount", ccsFloat, "", CCGetRequestParam("payment_amount", ccsGet, NULL), $this);
        $this->p_finance_period_id = & new clsControl(ccsLabel, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", ccsGet, NULL), $this);
        $this->periode_awal_laporan = & new clsControl(ccsLabel, "periode_awal_laporan", "periode_awal_laporan", ccsText, "", CCGetRequestParam("periode_awal_laporan", ccsGet, NULL), $this);
        $this->periode_akhir_laporan = & new clsControl(ccsLabel, "periode_akhir_laporan", "periode_akhir_laporan", ccsText, "", CCGetRequestParam("periode_akhir_laporan", ccsGet, NULL), $this);
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

//Show Method @2-ABD77266
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urli_lic_type_id"] = CCGetFromGet("i_lic_type_id", NULL);
        $this->DataSource->Parameters["urli_lic_no"] = CCGetFromGet("i_lic_no", NULL);

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
            $this->ControlsVisible["npwd"] = $this->npwd->Visible;
            $this->ControlsVisible["t_vat_setllement_id"] = $this->t_vat_setllement_id->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["company_name"] = $this->company_name->Visible;
            $this->ControlsVisible["periode_pelaporan"] = $this->periode_pelaporan->Visible;
            $this->ControlsVisible["tgl_pelaporan"] = $this->tgl_pelaporan->Visible;
            $this->ControlsVisible["total_transaksi"] = $this->total_transaksi->Visible;
            $this->ControlsVisible["total_pajak"] = $this->total_pajak->Visible;
            $this->ControlsVisible["kuitansi_pembayaran"] = $this->kuitansi_pembayaran->Visible;
            $this->ControlsVisible["tgl_pembayaran"] = $this->tgl_pembayaran->Visible;
            $this->ControlsVisible["payment_amount"] = $this->payment_amount->Visible;
            $this->ControlsVisible["p_finance_period_id"] = $this->p_finance_period_id->Visible;
            $this->ControlsVisible["periode_awal_laporan"] = $this->periode_awal_laporan->Visible;
            $this->ControlsVisible["periode_akhir_laporan"] = $this->periode_akhir_laporan->Visible;
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
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                $this->periode_pelaporan->SetValue($this->DataSource->periode_pelaporan->GetValue());
                $this->tgl_pelaporan->SetValue($this->DataSource->tgl_pelaporan->GetValue());
                $this->total_transaksi->SetValue($this->DataSource->total_transaksi->GetValue());
                $this->total_pajak->SetValue($this->DataSource->total_pajak->GetValue());
                $this->kuitansi_pembayaran->SetValue($this->DataSource->kuitansi_pembayaran->GetValue());
                $this->tgl_pembayaran->SetValue($this->DataSource->tgl_pembayaran->GetValue());
                $this->payment_amount->SetValue($this->DataSource->payment_amount->GetValue());
                $this->p_finance_period_id->SetValue($this->DataSource->p_finance_period_id->GetValue());
                $this->periode_awal_laporan->SetValue($this->DataSource->periode_awal_laporan->GetValue());
                $this->periode_akhir_laporan->SetValue($this->DataSource->periode_akhir_laporan->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->npwd->Show();
                $this->t_vat_setllement_id->Show();
                $this->t_cust_account_id->Show();
                $this->company_name->Show();
                $this->periode_pelaporan->Show();
                $this->tgl_pelaporan->Show();
                $this->total_transaksi->Show();
                $this->total_pajak->Show();
                $this->kuitansi_pembayaran->Show();
                $this->tgl_pembayaran->Show();
                $this->payment_amount->Show();
                $this->p_finance_period_id->Show();
                $this->periode_awal_laporan->Show();
                $this->periode_akhir_laporan->Show();
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

//GetErrors Method @2-A9FC5548
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_setllement_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->company_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_transaksi->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_pajak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kuitansi_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->payment_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->p_finance_period_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_awal_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_akhir_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End select_from_f_trans_histo Class @2-FCB6E20C

class clsselect_from_f_trans_histoDataSource extends clsDBConnSIKP {  //select_from_f_trans_histoDataSource Class @2-8C31B40A

//DataSource Variables @2-293AD1D0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $t_vat_setllement_id;
    var $t_cust_account_id;
    var $company_name;
    var $periode_pelaporan;
    var $tgl_pelaporan;
    var $total_transaksi;
    var $total_pajak;
    var $kuitansi_pembayaran;
    var $tgl_pembayaran;
    var $payment_amount;
    var $p_finance_period_id;
    var $periode_awal_laporan;
    var $periode_akhir_laporan;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6C17EA50
    function clsselect_from_f_trans_histoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid select_from_f_trans_histo";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->periode_pelaporan = new clsField("periode_pelaporan", ccsText, "");
        
        $this->tgl_pelaporan = new clsField("tgl_pelaporan", ccsText, "");
        
        $this->total_transaksi = new clsField("total_transaksi", ccsFloat, "");
        
        $this->total_pajak = new clsField("total_pajak", ccsFloat, "");
        
        $this->kuitansi_pembayaran = new clsField("kuitansi_pembayaran", ccsText, "");
        
        $this->tgl_pembayaran = new clsField("tgl_pembayaran", ccsText, "");
        
        $this->payment_amount = new clsField("payment_amount", ccsFloat, "");
        
        $this->p_finance_period_id = new clsField("p_finance_period_id", ccsFloat, "");
        
        $this->periode_awal_laporan = new clsField("periode_awal_laporan", ccsText, "");
        
        $this->periode_akhir_laporan = new clsField("periode_akhir_laporan", ccsText, "");
        

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

//Prepare Method @2-2E2E8E3E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urli_lic_type_id", ccsFloat, "", "", $this->Parameters["urli_lic_type_id"], 0, false);
        $this->wp->AddParameter("2", "urli_lic_no", ccsText, "", "", $this->Parameters["urli_lic_no"], "", false);
    }
//End Prepare Method

//Open Method @2-5C4C34CE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (SELECT * \n" .
        "from f_trans_history_ws(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",'" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "')) cnt";
        $this->SQL = "SELECT * \n" .
        "from f_trans_history_ws(" . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . ",'" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "')";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4C58FD11
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->periode_pelaporan->SetDBValue($this->f("periode_pelaporan"));
        $this->tgl_pelaporan->SetDBValue($this->f("tgl_pelaporan"));
        $this->total_transaksi->SetDBValue(trim($this->f("total_transaksi")));
        $this->total_pajak->SetDBValue(trim($this->f("total_pajak")));
        $this->kuitansi_pembayaran->SetDBValue($this->f("kuitansi_pembayaran"));
        $this->tgl_pembayaran->SetDBValue($this->f("tgl_pembayaran"));
        $this->payment_amount->SetDBValue(trim($this->f("payment_amount")));
        $this->p_finance_period_id->SetDBValue(trim($this->f("p_finance_period_id")));
        $this->periode_awal_laporan->SetDBValue($this->f("periode_awal_laporan"));
        $this->periode_akhir_laporan->SetDBValue($this->f("periode_akhir_laporan"));
    }
//End SetValues Method

} //End select_from_f_trans_histoDataSource Class @2-FCB6E20C

//Initialize Page @1-3A85408F
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
$TemplateFileName = "cek_izin.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-585B949A
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$select_from_f_trans_histo = & new clsGridselect_from_f_trans_histo("", $MainPage);
$MainPage->select_from_f_trans_histo = & $select_from_f_trans_histo;
$select_from_f_trans_histo->Initialize();

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

//Go to destination page @1-54C38562
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($select_from_f_trans_histo);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6065425D
$select_from_f_trans_histo->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-00A87BE0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($select_from_f_trans_histo);
unset($Tpl);
//End Unload Page


?>
