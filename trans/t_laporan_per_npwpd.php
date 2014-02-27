<?php
//Include Common Files @1-9A62E39E
define("RelativePath", "..");
define("PathToCurrentPage", "/trans/");
define("FileName", "t_laporan_per_npwpd.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordt_laporan_per_npwpd { //t_laporan_per_npwpd Class @2-68C3DD27

//Variables @2-D6FF3E86

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

//Class_Initialize Event @2-8BB5DCAC
    function clsRecordt_laporan_per_npwpd($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record t_laporan_per_npwpd/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "t_laporan_per_npwpd";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button1 = & new clsButton("Button1", $Method, $this);
            $this->npwpd = & new clsControl(ccsTextBox, "npwpd", "npwpd", ccsText, "", CCGetRequestParam("npwpd", $Method, NULL), $this);
            $this->periode = & new clsControl(ccsTextBox, "periode", "Jenis Pajak", ccsText, "", CCGetRequestParam("periode", $Method, NULL), $this);
            $this->periode->Required = true;
            $this->periode1 = & new clsControl(ccsTextBox, "periode1", "Jenis Pajak", ccsText, "", CCGetRequestParam("periode1", $Method, NULL), $this);
            $this->periode1->Required = true;
            $this->p_finance_period_id = & new clsControl(ccsHidden, "p_finance_period_id", "p_finance_period_id", ccsFloat, "", CCGetRequestParam("p_finance_period_id", $Method, NULL), $this);
            $this->p_finance_period_id1 = & new clsControl(ccsHidden, "p_finance_period_id1", "p_finance_period_id1", ccsFloat, "", CCGetRequestParam("p_finance_period_id1", $Method, NULL), $this);
            $this->Button2 = & new clsButton("Button2", $Method, $this);
            $this->cetak_laporan = & new clsControl(ccsHidden, "cetak_laporan", "cetak_laporan", ccsText, "", CCGetRequestParam("cetak_laporan", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-17B06098
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->npwpd->Validate() && $Validation);
        $Validation = ($this->periode->Validate() && $Validation);
        $Validation = ($this->periode1->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id->Validate() && $Validation);
        $Validation = ($this->p_finance_period_id1->Validate() && $Validation);
        $Validation = ($this->cetak_laporan->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->npwpd->Errors->Count() == 0);
        $Validation =  $Validation && ($this->periode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->periode1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->p_finance_period_id1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cetak_laporan->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-AF27C681
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->npwpd->Errors->Count());
        $errors = ($errors || $this->periode->Errors->Count());
        $errors = ($errors || $this->periode1->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id->Errors->Count());
        $errors = ($errors || $this->p_finance_period_id1->Errors->Count());
        $errors = ($errors || $this->cetak_laporan->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-8BCA6B23
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
            $this->PressedButton = "Button1";
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            } else if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            }
        }
        $Redirect = "t_laporan_per_npwpd.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-485BCF2E
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
            $Error = ComposeStrings($Error, $this->npwpd->Errors->ToString());
            $Error = ComposeStrings($Error, $this->periode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->periode1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->p_finance_period_id1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cetak_laporan->Errors->ToString());
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

        $this->Button1->Show();
        $this->npwpd->Show();
        $this->periode->Show();
        $this->periode1->Show();
        $this->p_finance_period_id->Show();
        $this->p_finance_period_id1->Show();
        $this->Button2->Show();
        $this->cetak_laporan->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End t_laporan_per_npwpd Class @2-FCB6E20C

class clsGridHistoryGrid { //HistoryGrid class @29-8E77C6FA

//Variables @29-AC1EDBB9

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

//Class_Initialize Event @29-62BF11D0
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

        $this->company_name = & new clsControl(ccsLabel, "company_name", "company_name", ccsText, "", CCGetRequestParam("company_name", ccsGet, NULL), $this);
        $this->periode_pelaporan = & new clsControl(ccsLabel, "periode_pelaporan", "periode_pelaporan", ccsText, "", CCGetRequestParam("periode_pelaporan", ccsGet, NULL), $this);
        $this->periode_awal_laporan = & new clsControl(ccsLabel, "periode_awal_laporan", "periode_awal_laporan", ccsText, "", CCGetRequestParam("periode_awal_laporan", ccsGet, NULL), $this);
        $this->tgl_pelaporan = & new clsControl(ccsLabel, "tgl_pelaporan", "tgl_pelaporan", ccsText, "", CCGetRequestParam("tgl_pelaporan", ccsGet, NULL), $this);
        $this->total_transaksi = & new clsControl(ccsLabel, "total_transaksi", "total_transaksi", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_transaksi", ccsGet, NULL), $this);
        $this->total_pajak = & new clsControl(ccsLabel, "total_pajak", "total_pajak", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("total_pajak", ccsGet, NULL), $this);
        $this->kuitansi_pembayaran = & new clsControl(ccsLabel, "kuitansi_pembayaran", "kuitansi_pembayaran", ccsText, "", CCGetRequestParam("kuitansi_pembayaran", ccsGet, NULL), $this);
        $this->periode_akhir_laporan = & new clsControl(ccsLabel, "periode_akhir_laporan", "periode_akhir_laporan", ccsText, "", CCGetRequestParam("periode_akhir_laporan", ccsGet, NULL), $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->t_customer_id = & new clsControl(ccsHidden, "t_customer_id", "t_customer_id", ccsFloat, "", CCGetRequestParam("t_customer_id", ccsGet, NULL), $this);
        $this->customer_name = & new clsControl(ccsHidden, "customer_name", "customer_name", ccsText, "", CCGetRequestParam("customer_name", ccsGet, NULL), $this);
        $this->t_cust_acc_id = & new clsControl(ccsHidden, "t_cust_acc_id", "t_cust_acc_id", ccsFloat, "", CCGetRequestParam("t_cust_acc_id", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @29-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @29-84ED270D
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlt_cust_acc_id"] = CCGetFromGet("t_cust_acc_id", NULL);
        $this->DataSource->Parameters["urlnpwpd"] = CCGetFromGet("npwpd", NULL);
        $this->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $this->DataSource->Parameters["urlp_finance_period_id1"] = CCGetFromGet("p_finance_period_id1", NULL);

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
            $this->ControlsVisible["company_name"] = $this->company_name->Visible;
            $this->ControlsVisible["periode_pelaporan"] = $this->periode_pelaporan->Visible;
            $this->ControlsVisible["periode_awal_laporan"] = $this->periode_awal_laporan->Visible;
            $this->ControlsVisible["tgl_pelaporan"] = $this->tgl_pelaporan->Visible;
            $this->ControlsVisible["total_transaksi"] = $this->total_transaksi->Visible;
            $this->ControlsVisible["total_pajak"] = $this->total_pajak->Visible;
            $this->ControlsVisible["kuitansi_pembayaran"] = $this->kuitansi_pembayaran->Visible;
            $this->ControlsVisible["periode_akhir_laporan"] = $this->periode_akhir_laporan->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->company_name->SetValue($this->DataSource->company_name->GetValue());
                $this->periode_pelaporan->SetValue($this->DataSource->periode_pelaporan->GetValue());
                $this->periode_awal_laporan->SetValue($this->DataSource->periode_awal_laporan->GetValue());
                $this->tgl_pelaporan->SetValue($this->DataSource->tgl_pelaporan->GetValue());
                $this->total_transaksi->SetValue($this->DataSource->total_transaksi->GetValue());
                $this->total_pajak->SetValue($this->DataSource->total_pajak->GetValue());
                $this->kuitansi_pembayaran->SetValue($this->DataSource->kuitansi_pembayaran->GetValue());
                $this->periode_akhir_laporan->SetValue($this->DataSource->periode_akhir_laporan->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->company_name->Show();
                $this->periode_pelaporan->Show();
                $this->periode_awal_laporan->Show();
                $this->tgl_pelaporan->Show();
                $this->total_transaksi->Show();
                $this->total_pajak->Show();
                $this->kuitansi_pembayaran->Show();
                $this->periode_akhir_laporan->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @29-5076EB0B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->company_name->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_awal_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tgl_pelaporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_transaksi->Errors->ToString());
        $errors = ComposeStrings($errors, $this->total_pajak->Errors->ToString());
        $errors = ComposeStrings($errors, $this->kuitansi_pembayaran->Errors->ToString());
        $errors = ComposeStrings($errors, $this->periode_akhir_laporan->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End HistoryGrid Class @29-FCB6E20C

class clsHistoryGridDataSource extends clsDBConnSIKP {  //HistoryGridDataSource Class @29-7CE034AB

//DataSource Variables @29-435882C6
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $company_name;
    var $periode_pelaporan;
    var $periode_awal_laporan;
    var $tgl_pelaporan;
    var $total_transaksi;
    var $total_pajak;
    var $kuitansi_pembayaran;
    var $periode_akhir_laporan;
//End DataSource Variables

//DataSourceClass_Initialize Event @29-31A86774
    function clsHistoryGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid HistoryGrid";
        $this->Initialize();
        $this->company_name = new clsField("company_name", ccsText, "");
        
        $this->periode_pelaporan = new clsField("periode_pelaporan", ccsText, "");
        
        $this->periode_awal_laporan = new clsField("periode_awal_laporan", ccsText, "");
        
        $this->tgl_pelaporan = new clsField("tgl_pelaporan", ccsText, "");
        
        $this->total_transaksi = new clsField("total_transaksi", ccsFloat, "");
        
        $this->total_pajak = new clsField("total_pajak", ccsFloat, "");
        
        $this->kuitansi_pembayaran = new clsField("kuitansi_pembayaran", ccsText, "");
        
        $this->periode_akhir_laporan = new clsField("periode_akhir_laporan", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @29-FE07BE04
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "c.npwd , b.start_date desc";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @29-D17A335D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlt_cust_acc_id", ccsFloat, "", "", $this->Parameters["urlt_cust_acc_id"], 0, false);
        $this->wp->AddParameter("2", "urlnpwpd", ccsText, "", "", $this->Parameters["urlnpwpd"], "", false);
        $this->wp->AddParameter("3", "urlp_finance_period_id", ccsText, "", "", $this->Parameters["urlp_finance_period_id"], 0, false);
        $this->wp->AddParameter("4", "urlp_finance_period_id1", ccsText, "", "", $this->Parameters["urlp_finance_period_id1"], 0, false);
    }
//End Prepare Method

//Open Method @29-E7093CB9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (Select c.npwd , \n" .
        "	   a.t_vat_setllement_id,	\n" .
        "	   c.t_cust_account_id,\n" .
        "       c.company_name, \n" .
        "       b.code as Periode_pelaporan, \n" .
        "       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, \n" .
        "       a.total_trans_amount as total_transaksi,\n" .
        "       a.total_vat_amount as total_pajak ,\n" .
        "	   a.total_penalty_amount as total_denda,\n" .
        "       d.receipt_no as kuitansi_pembayaran,\n" .
        "       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,\n" .
        "       d.payment_amount,\n" .
        "       c.t_cust_account_id ,\n" .
        "       b.p_finance_period_id ,\n" .
        "       to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,\n" .
        "       to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan,\n" .
        "	   e.code as type_code\n" .
        "from t_vat_setllement a ,\n" .
        "     p_finance_period b,\n" .
        "     t_cust_account c,\n" .
        "     t_payment_receipt d,\n" .
        "	 p_settlement_type e\n" .
        "where a.p_finance_period_id = b.p_finance_period_id\n" .
        "      and a.t_cust_account_id = c.t_cust_account_id\n" .
        "	  and a.npwd = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'\n" .
        "	  and b.start_date >= (select start_date from p_finance_period where p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . ")\n" .
        "	  and b.end_date <= (select start_date from p_finance_period where p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . ")\n" .
        "      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) \n" .
        "	  and a.p_settlement_type_id = e.p_settlement_type_id) cnt";
        $this->SQL = "Select c.npwd , \n" .
        "	   a.t_vat_setllement_id,	\n" .
        "	   c.t_cust_account_id,\n" .
        "       c.company_name, \n" .
        "       b.code as Periode_pelaporan, \n" .
        "       to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, \n" .
        "       a.total_trans_amount as total_transaksi,\n" .
        "       a.total_vat_amount as total_pajak ,\n" .
        "	   a.total_penalty_amount as total_denda,\n" .
        "       d.receipt_no as kuitansi_pembayaran,\n" .
        "       to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,\n" .
        "       d.payment_amount,\n" .
        "       c.t_cust_account_id ,\n" .
        "       b.p_finance_period_id ,\n" .
        "       to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,\n" .
        "       to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan,\n" .
        "	   e.code as type_code\n" .
        "from t_vat_setllement a ,\n" .
        "     p_finance_period b,\n" .
        "     t_cust_account c,\n" .
        "     t_payment_receipt d,\n" .
        "	 p_settlement_type e\n" .
        "where a.p_finance_period_id = b.p_finance_period_id\n" .
        "      and a.t_cust_account_id = c.t_cust_account_id\n" .
        "	  and a.npwd = '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsText) . "'\n" .
        "	  and b.start_date >= (select start_date from p_finance_period where p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . ")\n" .
        "	  and b.end_date <= (select start_date from p_finance_period where p_finance_period_id = " . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . ")\n" .
        "      and a.t_vat_setllement_id = d.t_vat_setllement_id (+) \n" .
        "	  and a.p_settlement_type_id = e.p_settlement_type_id {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @29-528DA0E8
    function SetValues()
    {
        $this->company_name->SetDBValue($this->f("company_name"));
        $this->periode_pelaporan->SetDBValue($this->f("periode_pelaporan"));
        $this->periode_awal_laporan->SetDBValue($this->f("periode_awal_laporan"));
        $this->tgl_pelaporan->SetDBValue($this->f("tgl_pelaporan"));
        $this->total_transaksi->SetDBValue(trim($this->f("total_transaksi")));
        $this->total_pajak->SetDBValue(trim($this->f("total_pajak")));
        $this->kuitansi_pembayaran->SetDBValue($this->f("kuitansi_pembayaran"));
        $this->periode_akhir_laporan->SetDBValue($this->f("periode_akhir_laporan"));
    }
//End SetValues Method

} //End HistoryGridDataSource Class @29-FCB6E20C



//Initialize Page @1-529C63C0
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
$TemplateFileName = "t_laporan_per_npwpd.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "../";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-57371BBD
include_once("./t_laporan_per_npwpd_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-47696C3E
$DBConnSIKP = new clsDBConnSIKP();
$MainPage->Connections["ConnSIKP"] = & $DBConnSIKP;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$t_laporan_per_npwpd = & new clsRecordt_laporan_per_npwpd("", $MainPage);
$HistoryGrid = & new clsGridHistoryGrid("", $MainPage);
$MainPage->t_laporan_per_npwpd = & $t_laporan_per_npwpd;
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

//Execute Components @1-D71AB2AD
$t_laporan_per_npwpd->Operation();
//End Execute Components

//Go to destination page @1-3410962A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBConnSIKP->close();
    header("Location: " . $Redirect);
    unset($t_laporan_per_npwpd);
    unset($HistoryGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0BC53BD3
$t_laporan_per_npwpd->Show();
$HistoryGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8E9BB0B9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBConnSIKP->close();
unset($t_laporan_per_npwpd);
unset($HistoryGrid);
unset($Tpl);
//End Unload Page


?>
