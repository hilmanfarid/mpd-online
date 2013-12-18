<?php
//BindEvents Method @1-5EC6CB8A
function BindEvents()
{
    global $t_status_pelaporan_transaksiGrid;
    global $CCSEvents;
    $t_status_pelaporan_transaksiGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_transaksiGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_transaksiGrid_BeforeShowRow @2-CC865ADD
function t_status_pelaporan_transaksiGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_transaksiGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksiGrid; //Compatibility
//End t_status_pelaporan_transaksiGrid_BeforeShowRow

//Close t_status_pelaporan_transaksiGrid_BeforeShowRow @2-7E75DD17
    return $t_status_pelaporan_transaksiGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_transaksiGrid_BeforeShowRow

//Page_OnInitializeView @1-0F36F729
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksi; //Compatibility
//End Page_OnInitializeView

	global $selected_id;
	$selected_id = -1;
	$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-B08F110C
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksi; //Compatibility
//End Page_BeforeInitialize

//transaksi Initialization @686-17D9D5EC
    if ('t_status_pelaporan_transaksitransaksi' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_transaksitransaksi.xml"));
        $Service->SetFormatter($formatter);
//End transaksi Initialization

//transaksi DataSource @686-6D3BDEF8
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select STATUS_LAPOR , JML\n" .
        "from \n" .
        "(\n" .
        "select 'SUDAH LAPOR TRANSAKSI' as STATUS_LAPOR , count(*) as JML\n" .
        "from t_cust_account a\n" .
        "where exists (select 1 \n" .
        "  from t_cust_acc_dtl_trans x\n" .
        "  where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and exists (select 1 from p_finance_period y where (trunc(x.trans_date) between trunc(y.start_date) and y.end_date) and y.p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . " --:periode_id dari pilihan\n" .
        "				   ) \n" .
        "  )\n" .
        "UNION ALL\n" .
        "select 'BELUM LAPOR TRANSAKSI' as STATUS_LAPOR , count(*) as JML\n" .
        "from t_cust_account a\n" .
        "where not exists (select 1 \n" .
        "  from t_cust_acc_dtl_trans x\n" .
        "  where x.t_cust_account_id = a.t_cust_account_id\n" .
        "		and exists (select 1 from p_finance_period y where (trunc(x.trans_date) between trunc(y.start_date) and y.end_date) and y.p_finance_period_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . " --:periode_id dari pilihan\n" .
        "				   )\n" .
        "  )\n" .
        ")\n" .
        "";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End transaksi DataSource

//transaksi Execution @686-8C1C1AD2
        $Service->AddDataSetValue("Title", "Status Pelaporan Transaksi");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End transaksi Execution

//transaksi Tail @686-27890EF8
        exit;
    }
//End transaksi Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
