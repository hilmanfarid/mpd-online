<?php
//BindEvents Method @1-CA7DBD8C
function BindEvents()
{
    global $t_status_pelaporan_pajak_sudah_laporGrid;
    global $CCSEvents;
    $t_status_pelaporan_pajak_sudah_laporGrid->CCSEvents["BeforeShowRow"] = "t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow";
    $t_status_pelaporan_pajak_sudah_laporGrid->CCSEvents["BeforeSelect"] = "t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow @2-A5E90426
function t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow(& $sender)
{
    $t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_laporGrid; //Compatibility
//End t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow
	
	global $selected_id;
	if ($selected_id<0) {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
	}

//Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow @2-7710F6E9
    return $t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow;
}
//End Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeShowRow

//t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect @2-E6DAD2D4
function t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect(& $sender)
{
    $t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_laporGrid; //Compatibility
//End t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect

//Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect @2-7E58EF2F
    return $t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect;
}
//End Close t_status_pelaporan_pajak_sudah_laporGrid_BeforeSelect

//Page_OnInitializeView @1-A516E3F0
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_lapor; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
		global $selected_id;
		$selected_id = -1;
		$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

		$status = strtolower(CCGetFromGet("status_lapor", ""));
		if(strpos($status, "belum") !== false){
			header("Location: t_status_pelaporan_pajak_belum_lapor.php?p_finance_period_id=" . $selected_id);
		}
  // -------------------------

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-DBA2C197
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pelaporan_pajak_sudah_lapor; //Compatibility
//End Page_BeforeInitialize

//jml_lapor Initialization @678-C266F897
    if ('t_status_pelaporan_pajak_sudah_laporjml_lapor' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_pajak_sudah_laporjml_lapor.xml"));
        $Service->SetFormatter($formatter);
//End jml_lapor Initialization

//jml_lapor DataSource @678-7AE40728
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, jml_lapor from f_status_sudah_lapor(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End jml_lapor DataSource

//jml_lapor Execution @678-D9A734B1
        $Service->AddDataSetValue("Title", "Jumlah Lapor");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End jml_lapor Execution

//jml_lapor Tail @678-27890EF8
        exit;
    }
//End jml_lapor Tail

//nilai_lapor Initialization @684-84592850
    if ('t_status_pelaporan_pajak_sudah_lapornilai_lapor' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_pajak_sudah_lapornilai_lapor.xml"));
        $Service->SetFormatter($formatter);
//End nilai_lapor Initialization

//nilai_lapor DataSource @684-C598317E
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, nilai_lapor from f_status_sudah_lapor(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_lapor DataSource

//nilai_lapor Execution @684-243F3E7A
        $Service->AddDataSetValue("Title", "Nilai Lapor");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_lapor Execution

//nilai_lapor Tail @684-27890EF8
        exit;
    }
//End nilai_lapor Tail

//nilai_denda Initialization @690-3A462391
    if ('t_status_pelaporan_pajak_sudah_lapornilai_denda' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pelaporan_pajak_sudah_lapornilai_denda.xml"));
        $Service->SetFormatter($formatter);
//End nilai_denda Initialization

//nilai_denda DataSource @690-A1E231DE
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, nilai_denda from f_status_sudah_lapor(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_denda DataSource

//nilai_denda Execution @690-F0889278
        $Service->AddDataSetValue("Title", "Nilai Denda");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_denda Execution

//nilai_denda Tail @690-27890EF8
        exit;
    }
//End nilai_denda Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
