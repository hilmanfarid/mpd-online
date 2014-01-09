<?php
//BindEvents Method @1-02575EF9
function BindEvents()
{
    global $t_status_pelaporan_pajakGrid;
    global $CCSEvents;
    $t_status_pelaporan_pajakGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_pajakGrid_BeforeShowRow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_pajakGrid_BeforeShowRow @2-C7E70F22
function t_status_pelaporan_pajakGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_pajakGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajakGrid; //Compatibility
//End t_status_pelaporan_pajakGrid_BeforeShowRow

//Close t_status_pelaporan_pajakGrid_BeforeShowRow @2-E5A5F85A
    return $t_status_pelaporan_pajakGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_pajakGrid_BeforeShowRow

//Page_OnInitializeView @1-16B6BA17
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak; //Compatibility
//End Page_OnInitializeView

	global $selected_id;
	$selected_id = -1;
	$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);
	$status_lapor = CCGetFromGet("status_lapor", NULL);
	if(strpos(strtolower($status_lapor), "sudah lapor wp active") !== false){
		header("Location: ./t_status_pelaporan_pajak_sudah_lapor.php?active=1&p_finance_period_id=" . $selected_id);
	}
	if(strpos(strtolower($status_lapor), "sudah lapor wp non active") !== false){
		header("Location: ./t_status_pelaporan_pajak_sudah_lapor.php?active=0&p_finance_period_id=" . $selected_id);
	}
	if(strpos(strtolower($status_lapor), "belum lapor wp active") !== false){
		header("Location: ./t_status_pelaporan_pajak_belum_lapor.php?active=1&p_finance_period_id=" . $selected_id);
	}
	if(strpos(strtolower($status_lapor), "belum lapor wp non active") !== false){
		header("Location: ./t_status_pelaporan_pajak_belum_lapor.php?active=0&p_finance_period_id=" . $selected_id);
	}
//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-121A3CB4
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak; //Compatibility
//End Page_BeforeInitialize

//status_lapor Initialization @686-18A14D4E
    if ('t_status_pelaporan_pajakstatus_lapor' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_pajakstatus_lapor.xml"));
        $Service->SetFormatter($formatter);
//End status_lapor Initialization

//status_lapor DataSource @686-9D607CC4
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select * from f_rep_status_lapor_pajak(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End status_lapor DataSource

//status_lapor Execution @686-2B9497D8
        $Service->AddDataSetValue("Title", "Status Pelaporan Pajak");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End status_lapor Execution

//status_lapor Tail @686-27890EF8
        exit;
    }
//End status_lapor Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
