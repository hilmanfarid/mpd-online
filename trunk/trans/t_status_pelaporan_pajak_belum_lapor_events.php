<?php
//BindEvents Method @1-574B009B
function BindEvents()
{
    global $t_status_pelaporan_pajak_belum_laporGrid;
    global $CCSEvents;
    $t_status_pelaporan_pajak_belum_laporGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow";
    $t_status_pelaporan_pajak_belum_laporGrid->CCSEvents["BeforeSelect"] = "t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow @2-1547037B
function t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_belum_laporGrid; //Compatibility
//End t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow
	
	global $selected_id;
	if ($selected_id<0) {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
	}
//Close t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow @2-5BFC3F28
    return $t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_pajak_belum_laporGrid_BeforeShowRow

//t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect @2-7B355022
function t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect(& $sender)
{
    $t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_belum_laporGrid; //Compatibility
//End t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect

//Close t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect @2-4B0FA591
    return $t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect;
}
//End Close t_status_pelaporan_pajak_belum_laporGrid_BeforeSelect

//Page_OnInitializeView @1-9EF5310E
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_belum_lapor; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
		global $selected_id;
		$selected_id = -1;
		$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

		/*$status = strtolower(CCGetFromGet("status_lapor", ""));
		if(strcmp($status, "belum lapor") == 0){
			header("Location: ../report");
		}*/
  // -------------------------

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-E0411369
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_belum_lapor; //Compatibility
//End Page_BeforeInitialize

//belum_lapor Initialization @678-460AFFAC
    if ('t_status_pelaporan_pajak_belum_laporbelum_lapor' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_pajak_belum_laporbelum_lapor.xml"));
        $Service->SetFormatter($formatter);
//End belum_lapor Initialization

//belum_lapor DataSource @678-FDD262AE
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->Parameters["urlactive"] = CCGetFromGet("active", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->wp->AddParameter("2", "urlactive", ccsFloat, "", "", $Service->DataSource->Parameters["urlactive"], 0, false);
        $Service->DataSource->SQL = "select * from f_status_belum_lapor(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ", " . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("2"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End belum_lapor DataSource

//belum_lapor Execution @678-9CB114EB
        $Service->AddDataSetValue("Title", "Jumlah Belum Lapor");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End belum_lapor Execution

//belum_lapor Tail @678-27890EF8
        exit;
    }
//End belum_lapor Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
