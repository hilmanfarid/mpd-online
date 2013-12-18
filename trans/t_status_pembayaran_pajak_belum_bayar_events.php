<?php
//BindEvents Method @1-C0C17D65
function BindEvents()
{
    global $t_status_pembayaran_pajak_belum_bayarGrid;
    global $CCSEvents;
    $t_status_pembayaran_pajak_belum_bayarGrid->CCSEvents["BeforeShowRow"] = "t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow";
    $t_status_pembayaran_pajak_belum_bayarGrid->CCSEvents["BeforeSelect"] = "t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

	global $selected_id;
	if ($selected_id<0) {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
	}

//t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow @2-DE2B44FC
function t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow(& $sender)
{
    $t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_belum_bayarGrid; //Compatibility
//End t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow

//Close t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow @2-100C9011
    return $t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow;
}
//End Close t_status_pembayaran_pajak_belum_bayarGrid_BeforeShowRow

//t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect @2-10A48C7A
function t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect(& $sender)
{
    $t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_belum_bayarGrid; //Compatibility
//End t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect

//Close t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect @2-BF74DBB4
    return $t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect;
}
//End Close t_status_pembayaran_pajak_belum_bayarGrid_BeforeSelect

//Page_OnInitializeView @1-9A5C6762
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_belum_bayar; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
		global $selected_id;
		$selected_id = -1;
		$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

		/*$status = strtolower(CCGetFromGet("status_bayar", ""));
		if(strcmp($status, "belum bayar") == 0){
			header("Location: ../report");
		}*/
  // -------------------------

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-49F427BB
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_belum_bayar; //Compatibility
//End Page_BeforeInitialize

//belum_bayar Initialization @704-B85EEDF8
    if ('t_status_pembayaran_pajak_belum_bayarbelum_bayar' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pembayaran_pajak_belum_bayarbelum_bayar.xml"));
        $Service->SetFormatter($formatter);
//End belum_bayar Initialization

//belum_bayar DataSource @704-592A3334
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select vat_code, jml_wp from f_status_belum_bayar(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End belum_bayar DataSource

//belum_bayar Execution @704-144EF446
        $Service->AddDataSetValue("Title", "Jumlah WP Belum Bayar");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End belum_bayar Execution

//belum_bayar Tail @704-27890EF8
        exit;
    }
//End belum_bayar Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
