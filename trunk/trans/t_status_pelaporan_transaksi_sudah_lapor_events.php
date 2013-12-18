<?php
//BindEvents Method @1-B741AAB5
function BindEvents()
{
    global $t_status_pelaporan_transaksi_sudah_laporGrid;
    global $CCSEvents;
    $t_status_pelaporan_transaksi_sudah_laporGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow";
    $t_status_pelaporan_transaksi_sudah_laporGrid->CCSEvents["BeforeSelect"] = "t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow @2-0381151B
function t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksi_sudah_laporGrid; //Compatibility
//End t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow
	global $selected_id;
	if ($selected_id<0) {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
	}
//Close t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow @2-39C630C8
    return $t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_transaksi_sudah_laporGrid_BeforeShowRow

//t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect @2-0FA4FCB5
function t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect(& $sender)
{
    $t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksi_sudah_laporGrid; //Compatibility
//End t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect

//Close t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect @2-AC1D9ACD
    return $t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect;
}
//End Close t_status_pelaporan_transaksi_sudah_laporGrid_BeforeSelect

//Page_OnInitializeView @1-A3B4AF29
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksi_sudah_lapor; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
		global $selected_id;
		$selected_id = -1;
		$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

		$status = strtolower(CCGetFromGet("status_lapor", ""));
		if(strpos($status, "belum") !== false){
			header("Location: t_status_pelaporan_transaksi_belum_lapor.php?p_finance_period_id=" . $selected_id);
		}
  // -------------------------

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-0998C59A
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_transaksi_sudah_lapor; //Compatibility
//End Page_BeforeInitialize

//jml_lapor Initialization @703-768D0E02
    if ('t_status_pelaporan_transaksi_sudah_laporjml_lapor' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_transaksi_sudah_laporjml_lapor.xml"));
        $Service->SetFormatter($formatter);
//End jml_lapor Initialization

//jml_lapor DataSource @703-D5D090C8
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select * from f_status_sudah_transaksi(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End jml_lapor DataSource

//jml_lapor Execution @703-D9A734B1
        $Service->AddDataSetValue("Title", "Jumlah Lapor");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End jml_lapor Execution

//jml_lapor Tail @703-27890EF8
        exit;
    }
//End jml_lapor Tail

//nilai_lapor Initialization @705-287E77A8
    if ('t_status_pelaporan_transaksi_sudah_lapornilai_lapor' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_transaksi_sudah_lapornilai_lapor.xml"));
        $Service->SetFormatter($formatter);
//End nilai_lapor Initialization

//nilai_lapor DataSource @705-D5D090C8
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select * from f_status_sudah_transaksi (" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_lapor DataSource

//nilai_lapor Execution @705-63CC0B5D
        $Service->AddDataSetValue("Title", "Nilai Pajak");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_lapor Execution

//nilai_lapor Tail @705-27890EF8
        exit;
    }
//End nilai_lapor Tail

//nilai_denda Initialization @707-0F4AFEA6
    if ('t_status_pelaporan_transaksi_sudah_lapornilai_denda' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_transaksi_sudah_lapornilai_denda.xml"));
        $Service->SetFormatter($formatter);
//End nilai_denda Initialization

//nilai_denda DataSource @707-D5D090C8
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select * from f_status_sudah_transaksi(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_denda DataSource

//nilai_denda Execution @707-F0889278
        $Service->AddDataSetValue("Title", "Nilai Denda");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_denda Execution

//nilai_denda Tail @707-27890EF8
        exit;
    }
//End nilai_denda Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
