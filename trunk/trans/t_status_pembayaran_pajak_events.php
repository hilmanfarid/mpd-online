<?php
//BindEvents Method @1-6C5B75B5
function BindEvents()
{
    global $t_status_pembayaran_pajakGrid;
    global $CCSEvents;
    $t_status_pembayaran_pajakGrid->CCSEvents["BeforeShowRow"] = "t_status_pembayaran_pajakGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pembayaran_pajakGrid_BeforeShowRow @2-B4B17D9F
function t_status_pembayaran_pajakGrid_BeforeShowRow(& $sender)
{
    $t_status_pembayaran_pajakGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajakGrid; //Compatibility
//End t_status_pembayaran_pajakGrid_BeforeShowRow

//Close t_status_pembayaran_pajakGrid_BeforeShowRow @2-5C8128C3
    return $t_status_pembayaran_pajakGrid_BeforeShowRow;
}
//End Close t_status_pembayaran_pajakGrid_BeforeShowRow

//Page_OnInitializeView @1-DC1BFCC3
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak; //Compatibility
//End Page_OnInitializeView

	global $selected_id;
	$selected_id = -1;
	$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-93C0A217
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak; //Compatibility
//End Page_BeforeInitialize

//status_bayar Initialization @686-5476742C
    if ('t_status_pembayaran_pajakstatus_bayar' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pembayaran_pajakstatus_bayar.xml"));
        $Service->SetFormatter($formatter);
//End status_bayar Initialization

//status_bayar DataSource @686-E80AEE0A
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select STATUS_BAYAR , JML\n" .
        "from \n" .
        "(\n" .
        "  select 'SUDAH BAYAR' as STATUS_BAYAR , count(*) as JML\n" .
        "  from t_cust_account a\n" .
        "  where exists (select 1 \n" .
        "              from t_payment_receipt x\n" .
        "              where x.t_cust_account_id = a.t_cust_account_id\n" .
        "                    and x.p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "              )\n" .
        "        -- and trunc(a.registration_date) < (select end_date from p_finance_period where p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "        --                               )\n" .
        "  UNION ALL\n" .
        "  select 'BELUM BAYAR' as STATUS_BAYAR , count(*) as JML\n" .
        "  from t_cust_account a\n" .
        "  where not exists (select 1 \n" .
        "              from t_payment_receipt x\n" .
        "              where x.t_cust_account_id = a.t_cust_account_id\n" .
        "                    and x.p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "              )\n" .
        "        -- and trunc(a.registration_date) < (select end_date from p_finance_period where p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "        --                               )\n" .
        ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End status_bayar DataSource

//status_bayar Execution @686-31DF2758
        $Service->AddDataSetValue("Title", "Status Pembayaran Pajak");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End status_bayar Execution

//status_bayar Tail @686-27890EF8
        exit;
    }
//End status_bayar Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
