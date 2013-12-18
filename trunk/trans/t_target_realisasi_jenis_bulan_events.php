<?php
//BindEvents Method @1-00870C57
function BindEvents()
{
    global $t_target_realisasi_jenis_bulanForm;
    global $CCSEvents;
    $t_target_realisasi_jenis_bulanForm->CCSEvents["BeforeSelect"] = "t_target_realisasi_jenis_bulanForm_BeforeSelect";
}
//End BindEvents Method

//t_target_realisasi_jenis_bulanForm_BeforeSelect @726-FC201116
function t_target_realisasi_jenis_bulanForm_BeforeSelect(& $sender)
{
    $t_target_realisasi_jenis_bulanForm_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulanForm; //Compatibility
//End t_target_realisasi_jenis_bulanForm_BeforeSelect
	$t_target_realisasi_jenis_bulanForm->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_target_revenue_id", NULL);
//Close t_target_realisasi_jenis_bulanForm_BeforeSelect @726-D1C09105
    return $t_target_realisasi_jenis_bulanForm_BeforeSelect;
}
//End Close t_target_realisasi_jenis_bulanForm_BeforeSelect

//Page_BeforeInitialize @1-9D793094
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_target_realisasi_jenis_bulan; //Compatibility
//End Page_BeforeInitialize

//t_target_realisasi_jenis_bulanFlashjenis_bulan Initialization @891-5D7D9D5B
    if ('t_target_realisasi_jenis_bulant_target_realisasi_jenis_bulanFlashjenis_bulan' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_target_realisasi_jenis_bulant_target_realisasi_jenis_bulanFlashjenis_bulan.xml"));
        $Service->SetFormatter($formatter);
//End t_target_realisasi_jenis_bulanFlashjenis_bulan Initialization

//t_target_realisasi_jenis_bulanFlashjenis_bulan DataSource @891-D8156F1C
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlt_revenue_target_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlt_revenue_target_id"], 0, false);
        $Service->DataSource->SQL = "select * from v_revenue_target_vs_realisasi_month\n" .
        "where\n" .
        "	t_revenue_target_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . " {SQL_OrderBy}";
        $Service->DataSource->Order = "	start_date";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End t_target_realisasi_jenis_bulanFlashjenis_bulan DataSource

//t_target_realisasi_jenis_bulanFlashjenis_bulan Execution @891-EB3BD7CB
        $Service->AddDataSetValue("Title", "Target vs Realisasi Per Jenis Pajak Bulanan");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End t_target_realisasi_jenis_bulanFlashjenis_bulan Execution

//t_target_realisasi_jenis_bulanFlashjenis_bulan Tail @891-27890EF8
        exit;
    }
//End t_target_realisasi_jenis_bulanFlashjenis_bulan Tail

//t_target_realisasi_jenis_bulanFlashbulan Initialization @914-45D0EB2B
    if ('t_target_realisasi_jenis_bulant_target_realisasi_jenis_bulanFlashbulan' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_target_realisasi_jenis_bulant_target_realisasi_jenis_bulanFlashbulan.xml"));
        $Service->SetFormatter($formatter);
//End t_target_realisasi_jenis_bulanFlashbulan Initialization

//t_target_realisasi_jenis_bulanFlashbulan DataSource @914-21707D17
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlt_revenue_target_id"] = CCGetFromGet("t_revenue_target_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlt_revenue_target_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlt_revenue_target_id"], 0, false);
        $Service->DataSource->SQL = "SELECT bulan, sum(target_amount) AS Target, sum(realisasi_amt) AS Realisasi\n" .
        "FROM v_revenue_target_vs_realisasi_month\n" .
        "WHERE p_year_period_id = \n" .
        "	(select p_year_period_id from t_revenue_target\n" .
        "	where t_revenue_target_id = " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . "\n" .
        "	)\n" .
        "GROUP BY bulan, start_date  {SQL_OrderBy}";
        $Service->DataSource->Order = "start_date";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End t_target_realisasi_jenis_bulanFlashbulan DataSource

//t_target_realisasi_jenis_bulanFlashbulan Execution @914-FDDF12ED
        $Service->AddDataSetValue("Title", "Target vs Realisasi Bulanan");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End t_target_realisasi_jenis_bulanFlashbulan Execution

//t_target_realisasi_jenis_bulanFlashbulan Tail @914-27890EF8
        exit;
    }
//End t_target_realisasi_jenis_bulanFlashbulan Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
