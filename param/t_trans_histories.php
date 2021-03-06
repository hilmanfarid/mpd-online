<?php
//Include Common Files @1-2AD1EF68
define("RelativePath", "..");
define("PathToCurrentPage", "/param/");
define("FileName", "t_trans_histories.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridHistoryGrid { //HistoryGrid class @2-8E77C6FA

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

//Class_Initialize Event @2-E67FF0DA
    function clsGridHistoryGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "HistoryGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid HistoryGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsHistoryGridDataSource($this);
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

        $this->npwd = & new clsControl(ccsLabel, "npwd", "npwd", ccsText, "", CCGetRequestParam("npwd", ccsGet, NULL), $this);
        $this->company_name = & new clsControl(ccsLabel, "company_name", "company_name", ccsText, "", CCGetRequestParam("company_name", ccsGet, NULL), $this);
        $this->periode_pelaporan = & new clsControl(ccsLabel, "periode_pelaporan", "periode_pelaporan", ccsText, "", CCGetRequestParam("periode_pelaporan", ccsGet, NULL), $this);
        $this->periode_awal_laporan = & new clsControl(ccsLabel, "periode_awal_laporan", "periode_awal_laporan", ccsText, "", CCGetRequestParam("periode_awal_laporan", ccsGet, NULL), $this);
        $this->tgl_pelaporan = & new clsControl(ccsLabel, "tgl_pelaporan", "tgl_pelaporan", ccsText, "", CCGetRequestParam("tgl_pelaporan", ccsGet, NULL), $this);
        $this->total_transaksi = & new clsControl(ccsLabel, "total_transaksi", "total_transaksi", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_transaksi", ccsGet, NULL), $this);
        $this->total_pajak = & new clsControl(ccsLabel, "total_pajak", "total_pajak", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_pajak", ccsGet, NULL), $this);
        $this->kuitansi_pembayaran = & new clsControl(ccsLabel, "kuitansi_pembayaran", "kuitansi_pembayaran", ccsText, "", CCGetRequestParam("kuitansi_pembayaran", ccsGet, NULL), $this);
        $this->tgl_pembayaran = & new clsControl(ccsLabel, "tgl_pembayaran", "tgl_pembayaran", ccsText, "", CCGetRequestParam("tgl_pembayaran", ccsGet, NULL), $this);
        $this->payment_amount = & new clsControl(ccsLabel, "payment_amount", "payment_amount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("payment_amount", ccsGet, NULL), $this);
        $this->periode_akhir_laporan = & new clsControl(ccsLabel, "periode_akhir_laporan", "periode_akhir_laporan", ccsText, "", CCGetRequestParam("periode_akhir_laporan", ccsGet, NULL), $this);
        $this->t_vat_setllement_id = & new clsControl(ccsHidden, "t_vat_setllement_id", "t_vat_setllement_id", ccsFloat, "", CCGetRequestParam("t_vat_setllement_id", ccsGet, NULL), $this);
        $this->t_cust_account_id = & new clsControl(ccsHidden, "t_cust_account_id", "t_cust_account_id", ccsFloat, "", CCGetRequestParam("t_cust_account_id", ccsGet, NULL), $this);
        $this->total_denda = & new clsControl(ccsLabel, "total_denda", "total_denda", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_denda", ccsGet, NULL), $this);
        $this->type_code = & new clsControl(ccsLabel, "type_code", "type_code", ccsText, "", CCGetRequestParam("type_code", ccsGet, NULL), $this);
        $this->debt_vat_amt = & new clsControl(ccsLabel, "debt_vat_amt", "debt_vat_amt", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("debt_vat_amt", ccsGet, NULL), $this);
        $this->kenaikan = & new clsControl(ccsLabel, "kenaikan", "kenaikan", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("kenaikan", ccsGet, NULL), $this);
        $this->total_hrs_bayar = & new clsControl(ccsLabel, "total_hrs_bayar", "total_hrs_bayar", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_hrs_bayar", ccsGet, NULL), $this);
        $this->vat_code = & new clsControl(ccsLabel, "vat_code", "vat_code", ccsText, "", CCGetRequestParam("vat_code", ccsGet, NULL), $this);
        $this->kenaikan1 = & new clsControl(ccsLabel, "kenaikan1", "kenaikan1", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("kenaikan1", ccsGet, NULL), $this);
        $this->no_kohir = & new clsControl(ccsLabel, "no_kohir", "no_kohir", ccsText, "", CCGetRequestParam("no_kohir", ccsGet, NULL), $this);
        $this->jatuh_tempo = & new clsControl(ccsLabel, "jatuh_tempo", "jatuh_tempo", ccsText, "", CCGetRequestParam("jatuh_tempo", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", ccsGet, NULL), $this);
        $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", ccsGet, NULL), $this);
        $this->t_cust_acc_id = & new clsControl(ccsHidden, "t_cust_acc_id", "t_cust_acc_id", ccsFloat, "", CCGetRequestParam("t_cust_acc_id", ccsGet, NULL), $this);
        $this->Button_DoPrint1 = & new clsButton("Button_DoPrint1", ccsGet, $this);
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

//Show Method @2-BA4F582E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_acc_id"] = CCGetFromGet("t_cust_acc_id", NULL);

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
            $this->ControlsVisible["company_name"] = $this->company_name->Visible;
            $this->ControlsVisible["periode_pelaporan"] = $this->periode_pelaporan->Visible;
            $this->ControlsVisible["periode_awal_laporan"] = $this->periode_awal_laporan->Visible;
            $this->ControlsVisible["tgl_pelaporan"] = $this->tgl_pelaporan->Visible;
            $this->ControlsVisible["total_transaksi"] = $this->total_transaksi->Visible;
            $this->ControlsVisible["total_pajak"] = $this->total_pajak->Visible;
            $this->ControlsVisible["kuitansi_pembayaran"] = $this->kuitansi_pembayaran->Visible;
            $this->ControlsVisible["tgl_pembayaran"] = $this->tgl_pembayaran->Visible;
            $this->ControlsVisible["payment_amount"] = $this->payment_amount->Visible;
            $this->ControlsVisible["periode_akhir_laporan"] = $this->periode_akhir_laporan->Visible;
            $this->ControlsVisible["t_vat_setllement_id"] = $this->t_vat_setllement_id->Visible;
            $this->ControlsVisible["t_cust_account_id"] = $this->t_cust_account_id->Visible;
            $this->ControlsVisible["total_denda"] = $this->total_denda->Visible;
            $this->ControlsVisible["type_code"] = $this->type_code->Visible;
            $this->ControlsVisible["debt_vat_amt"] = $this->debt_vat_amt->Visible;
            $this->ControlsVisible["kenaikan"] = $this->kenaikan->Visible;
            $this->ControlsVisible["total_hrs_bayar"] = $this->total_hrs_bayar->Visible;
            $this->ControlsVisible["vat_code"] = $this->vat_code->Visible;
            $this->ControlsVisible["kenaikan1"] = $this->kenaikan1->Visible;
            $this->ControlsVisible["no_kohir"] = $this->no_kohir->Visible;
            $this->ControlsVisible["jatuh_tempo"] = $this->jatuh_tempo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->npwd->SetValue($this->DataSource->npwd->GetValue());
                $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                $this->periode_pelaporan->SetValue($this->DataSource->periode_pelaporan->GetValue());
                $this->periode_awal_laporan->SetValue($this->DataSource->periode_awal_laporan->GetValue());
                $this->tgl_pelaporan->SetValue($this->DataSource->tgl_pelaporan->GetValue());
                $this->total_transaksi->SetValue($this->DataSource->total_transaksi->GetValue());
                $this->total_pajak->SetValue($this->DataSource->total_pajak->GetValue());
                $this->kuitansi_pembayaran->SetValue($this->DataSource->kuitansi_pembayaran->GetValue());
                $this->tgl_pembayaran->SetValue($this->DataSource->tgl_pembayaran->GetValue());
                $this->payment_amount->SetValue($this->DataSource->payment_amount->GetValue());
                $this->periode_akhir_laporan->SetValue($this->DataSource->periode_akhir_laporan->GetValue());
                $this->t_vat_setllement_id->SetValue($this->DataSource->t_vat_setllement_id->GetValue());
                $this->t_cust_account_id->SetValue($this->DataSource->t_cust_account_id->GetValue());
                $this->total_denda->SetValue($this->DataSource->total_denda->GetValue());
                $this->type_code->SetValue($this->DataSource->type_code->GetValue());
                $this->debt_vat_amt->SetValue($this->DataSource->debt_vat_amt->GetValue());
                $this->kenaikan->SetValue($this->DataSource->kenaikan->GetValue());
                $this->total_hrs_bayar->SetValue($this->DataSource->total_hrs_bayar->GetValue());
                $this->vat_code->SetValue($this->DataSource->vat_code->GetValue());
                $this->kenaikan1->SetValue($this->DataSource->kenaikan1->GetValue());
                $this->no_kohir->SetValue($this->DataSource->no_kohir->GetValue());
                $this->jatuh_tempo->SetValue($this->DataSource->jatuh_tempo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->npwd->Show();
                $this->company_name->Show();
                $this->periode_pelaporan->Show();
                $this->periode_awal_laporan->Show();
                $this->tgl_pelaporan->Show();
                $this->total_transaksi->Show();
                $this->total_pajak->Show();
                $this->kuitansi_pembayaran->Show();
                $this->tgl_pembayaran->Show();
                $this->payment_amount->Show();
                $this->periode_akhir_laporan->Show();
                $this->t_vat_setllement_id->Show();
                $this->t_cust_account_id->Show();
                $this->total_denda->Show();
                $this->type_code->Show();
                $this->debt_vat_amt->Show();
                $this->kenaikan->Show();
                $this->total_hrs_bayar->Show();
                $this->vat_code->Show();
                $this->kenaikan1->Show();
                $this->no_kohir->Show();
                $this->jatuh_tempo->Show();
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
        $this->t_customer_id->Show();
        $this->customer_name->Show();
        $this->t_cust_acc_id->Show();
        $this->Button_DoPrint1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E4CB0122
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->npwd->Errors->ToString());
        $errors = ComposeStrings($errors, $this->company_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_awal_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_transaksi->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_pajak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kuitansi_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->payment_amount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_akhir_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_vat_setllement_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->t_cust_account_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_denda->Errors->ToString());
        $errors = ComposeStrings($errors, $this->type_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->debt_vat_amt->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kenaikan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_hrs_bayar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->vat_code->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kenaikan1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->no_kohir->Errors->ToString());
        $errors = ComposeStrings($errors, $this->jatuh_tempo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End HistoryGrid Class @2-FCB6E20C

class clsHistoryGridDataSource extends clsDBConnSIKP {  //HistoryGridDataSource Class @2-7CE034AB

//DataSource Variables @2-1D6602C0
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $npwd;
    var $company_name;
    var $periode_pelaporan;
    var $periode_awal_laporan;
    var $tgl_pelaporan;
    var $total_transaksi;
    var $total_pajak;
    var $kuitansi_pembayaran;
    var $tgl_pembayaran;
    var $payment_amount;
    var $periode_akhir_laporan;
    var $t_vat_setllement_id;
    var $t_cust_account_id;
    var $total_denda;
    var $type_code;
    var $debt_vat_amt;
    var $kenaikan;
    var $total_hrs_bayar;
    var $vat_code;
    var $kenaikan1;
    var $no_kohir;
    var $jatuh_tempo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0F2EE288
    function clsHistoryGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid HistoryGrid";
        $this->Initialize();
        $this->npwd = new clsField("npwd", ccsText, "");
        
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->periode_pelaporan = new clsField("periode_pelaporan", ccsText, "");
        
        $this->periode_awal_laporan = new clsField("periode_awal_laporan", ccsText, "");
        
        $this->tgl_pelaporan = new clsField("tgl_pelaporan", ccsText, "");
        
        $this->total_transaksi = new clsField("total_transaksi", ccsFloat, "");
        
        $this->total_pajak = new clsField("total_pajak", ccsFloat, "");
        
        $this->kuitansi_pembayaran = new clsField("kuitansi_pembayaran", ccsText, "");
        
        $this->tgl_pembayaran = new clsField("tgl_pembayaran", ccsText, "");
        
        $this->payment_amount = new clsField("payment_amount", ccsFloat, "");
        
        $this->periode_akhir_laporan = new clsField("periode_akhir_laporan", ccsText, "");
        
        $this->t_vat_setllement_id = new clsField("t_vat_setllement_id", ccsFloat, "");
        
        $this->t_cust_account_id = new clsField("t_cust_account_id", ccsFloat, "");
        
        $this->total_denda = new clsField("total_denda", ccsFloat, "");
        
        $this->type_code = new clsField("type_code", ccsText, "");
        
        $this->debt_vat_amt = new clsField("debt_vat_amt", ccsFloat, "");
        
        $this->kenaikan = new clsField("kenaikan", ccsFloat, "");
        
        $this->total_hrs_bayar = new clsField("total_hrs_bayar", ccsFloat, "");
        
        $this->vat_code = new clsField("vat_code", ccsText, "");
        
        $this->kenaikan1 = new clsField("kenaikan1", ccsFloat, "");
        
        $this->no_kohir = new clsField("no_kohir", ccsText, "");
        
        $this->jatuh_tempo = new clsField("jatuh_tempo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-94C6B779
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "npwd, start_date desc, t_vat_setllement_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-D3F6B1B1
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_acc_id", ccsFloat, "", "", $this->Parameters["urlt_cust_acc_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-E38F0F93
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (select \n" .
        "	nvl(nama,company_name)as new_company_name, masa_awal, masa_akhir,data_transaksi.* \n" .
        "from \n" .
        "	(select \n" .
        "	*\n" .
        "	from \n" .
        "		(Select c.npwd, \n" .
        "					 a.t_vat_setllement_id,	\n" .
        "						 c.company_name, \n" .
        "						 b.code as Periode_pelaporan, \n" .
        "						 to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, \n" .
        "						 a.total_trans_amount as total_transaksi,\n" .
        "						 a.total_vat_amount as total_pajak ,\n" .
        "					 nvl(a.total_penalty_amount,0) as total_denda,\n" .
        "						 d.receipt_no as kuitansi_pembayaran,\n" .
        "						 to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,\n" .
        "						 d.payment_amount,\n" .
        "						 c.t_cust_account_id ,\n" .
        "						 b.p_finance_period_id ,\n" .
        "						 to_char(a.start_period,'DD-MON-YYYY') as periode_awal_laporan,\n" .
        "						 to_char(a.end_period,'DD-MON-YYYY') as periode_akhir_laporan,\n" .
        "						 e.code as type_code,\n" .
        "						 nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) as debt_vat_amt,\n" .
        "						 nvl(a.db_increasing_charge,0) as db_increasing_charge,\n" .
        "						 nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) + nvl(a.db_increasing_charge,0) +nvl(a.db_interest_charge,0) + nvl(a.total_penalty_amount,0) as total_hrs_bayar,\n" .
        "						 nvl(a.db_increasing_charge,0) as kenaikan,\n" .
        "						 nvl(a.db_interest_charge,0) as kenaikan1,\n" .
        "						 a.p_vat_type_dtl_id,\n" .
        "						 a.no_kohir,\n" .
        "						 to_char(a.due_date,'DD-MON-YYYY') as jatuh_tempo,\n" .
        "						 settlement_date,\n" .
        "						 b.start_date\n" .
        "			from t_vat_setllement a,\n" .
        "					 p_finance_period b,\n" .
        "					 t_cust_account c,\n" .
        "					 t_payment_receipt d,\n" .
        "					 p_settlement_type e\n" .
        "			where a.p_finance_period_id = b.p_finance_period_id\n" .
        "						and a.t_cust_account_id = c.t_cust_account_id\n" .
        "					and a.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "						and a.t_vat_setllement_id = d.t_vat_setllement_id (+) \n" .
        "					and a.p_settlement_type_id = e.p_settlement_type_id) as hasil\n" .
        "	left join p_vat_type_dtl x on x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id) as data_transaksi\n" .
        "\n" .
        "left join t_cust_acc_masa_jab masa_jab\n" .
        "	on masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id\n" .
        "	and masa_awal <= settlement_date\n" .
        "	and\n" .
        "		case \n" .
        "			when masa_akhir is NULL\n" .
        "				then true\n" .
        "			when masa_akhir >= settlement_date\n" .
        "				then masa_akhir >= settlement_date\n" .
        "		end) cnt";
        $this->SQL = "select \n" .
        "	nvl(nama,company_name)as new_company_name, masa_awal, masa_akhir,data_transaksi.* \n" .
        "from \n" .
        "	(select \n" .
        "	*\n" .
        "	from \n" .
        "		(Select c.npwd, \n" .
        "					 a.t_vat_setllement_id,	\n" .
        "						 c.company_name, \n" .
        "						 b.code as Periode_pelaporan, \n" .
        "						 to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, \n" .
        "						 a.total_trans_amount as total_transaksi,\n" .
        "						 a.total_vat_amount as total_pajak ,\n" .
        "					 nvl(a.total_penalty_amount,0) as total_denda,\n" .
        "						 d.receipt_no as kuitansi_pembayaran,\n" .
        "						 to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,\n" .
        "						 d.payment_amount,\n" .
        "						 c.t_cust_account_id ,\n" .
        "						 b.p_finance_period_id ,\n" .
        "						 to_char(a.start_period,'DD-MON-YYYY') as periode_awal_laporan,\n" .
        "						 to_char(a.end_period,'DD-MON-YYYY') as periode_akhir_laporan,\n" .
        "						 e.code as type_code,\n" .
        "						 nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) as debt_vat_amt,\n" .
        "						 nvl(a.db_increasing_charge,0) as db_increasing_charge,\n" .
        "						 nvl((case when A.debt_vat_amt <= 0 then null else A.debt_vat_amt end)::numeric,a.total_vat_amount) + nvl(a.db_increasing_charge,0) +nvl(a.db_interest_charge,0) + nvl(a.total_penalty_amount,0) as total_hrs_bayar,\n" .
        "						 nvl(a.db_increasing_charge,0) as kenaikan,\n" .
        "						 nvl(a.db_interest_charge,0) as kenaikan1,\n" .
        "						 a.p_vat_type_dtl_id,\n" .
        "						 a.no_kohir,\n" .
        "						 to_char(a.due_date,'DD-MON-YYYY') as jatuh_tempo,\n" .
        "						 settlement_date,\n" .
        "						 b.start_date\n" .
        "			from t_vat_setllement a,\n" .
        "					 p_finance_period b,\n" .
        "					 t_cust_account c,\n" .
        "					 t_payment_receipt d,\n" .
        "					 p_settlement_type e\n" .
        "			where a.p_finance_period_id = b.p_finance_period_id\n" .
        "						and a.t_cust_account_id = c.t_cust_account_id\n" .
        "					and a.t_cust_account_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "						and a.t_vat_setllement_id = d.t_vat_setllement_id (+) \n" .
        "					and a.p_settlement_type_id = e.p_settlement_type_id) as hasil\n" .
        "	left join p_vat_type_dtl x on x.p_vat_type_dtl_id = hasil.p_vat_type_dtl_id) as data_transaksi\n" .
        "\n" .
        "left join t_cust_acc_masa_jab masa_jab\n" .
        "	on masa_jab.t_cust_account_id = data_transaksi.t_cust_account_id\n" .
        "	and masa_awal <= settlement_date\n" .
        "	and\n" .
        "		case \n" .
        "			when masa_akhir is NULL\n" .
        "				then true\n" .
        "			when masa_akhir >= settlement_date\n" .
        "				then masa_akhir >= settlement_date\n" .
        "		end {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method
 
//SetValues Method @2-5A9FC032
    function SetValues()
    {
        $this->npwd->SetDBValue($this->f("npwd"));
        $this->company_name->SetDBValue($this->f("new_company_name"));
        $this->periode_pelaporan->SetDBValue($this->f("periode_pelaporan"));
        $this->periode_awal_laporan->SetDBValue($this->f("periode_awal_laporan"));
        $this->tgl_pelaporan->SetDBValue($this->f("tgl_pelaporan"));
        $this->total_transaksi->SetDBValue(trim($this->f("total_transaksi")));
        $this->total_pajak->SetDBValue(trim($this->f("total_pajak")));
        $this->kuitansi_pembayaran->SetDBValue($this->f("kuitansi_pembayaran"));
        $this->tgl_pembayaran->SetDBValue($this->f("tgl_pembayaran"));
        $this->payment_amount->SetDBValue(trim($this->f("payment_amount")));
        $this->periode_akhir_laporan->SetDBValue($this->f("periode_akhir_laporan"));
        $this->t_vat_setllement_id->SetDBValue(trim($this->f("t_vat_setllement_id")));
        $this->t_cust_account_id->SetDBValue(trim($this->f("t_cust_account_id")));
        $this->total_denda->SetDBValue(trim($this->f("total_denda")));
        $this->type_code->SetDBValue($this->f("type_code"));
        $this->debt_vat_amt->SetDBValue(trim($this->f("debt_vat_amt")));
        $this->kenaikan->SetDBValue(trim($this->f("kenaikan")));
        $this->total_hrs_bayar->SetDBValue(trim($this->f("total_hrs_bayar")));
        $this->vat_code->SetDBValue($this->f("vat_code"));
        $this->kenaikan1->SetDBValue(trim($this->f("kenaikan1")));
        $this->no_kohir->SetDBValue($this->f("no_kohir"));
        $this->jatuh_tempo->SetDBValue($this->f("jatuh_tempo"));
    }
//End SetValues Method

} //End HistoryGridDataSource Class @2-FCB6E20C



//Initialize Page @1-07E17F0B
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
$TemplateFileName = "t_trans_histories.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-9D627EDE
include_once("./t_trans_histories_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FB01B106
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$HistoryGrid = & new clsGridHistoryGrid("", $MainPage);
$MainPage->HistoryGrid = & $HistoryGrid;
$HistoryGrid->Initialize();

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

//Go to destination page @1-17D965CC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($HistoryGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-83BCD176
$HistoryGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D2E02F93
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($HistoryGrid);
unset($Tpl);
//End Unload Page


?>
