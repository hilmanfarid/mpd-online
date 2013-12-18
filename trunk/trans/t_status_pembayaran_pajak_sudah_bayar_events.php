<?php
//BindEvents Method @1-7A890D25
function BindEvents()
{
    global $t_status_pembayaran_pajak_sudah_bayarGrid;
    global $CCSEvents;
    $t_status_pembayaran_pajak_sudah_bayarGrid->CCSEvents["BeforeShowRow"] = "t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow";
    $t_status_pembayaran_pajak_sudah_bayarGrid->CCSEvents["BeforeSelect"] = "t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

	
	global $selected_id;
	if ($selected_id<0) {
    	$selected_id = $Component->DataSource->p_finance_period_id->GetValue();
	}

//t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow @2-016A92AF
function t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow(& $sender)
{
    $t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_sudah_bayarGrid; //Compatibility
//End t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow

//Close t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow @2-3CE059D0
    return $t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow;
}
//End Close t_status_pembayaran_pajak_sudah_bayarGrid_BeforeShowRow

//t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect @2-A00A8B27
function t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect(& $sender)
{
    $t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_sudah_bayarGrid; //Compatibility
//End t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect

//Close t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect @2-8A23910A
    return $t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect;
}
//End Close t_status_pembayaran_pajak_sudah_bayarGrid_BeforeSelect

//Page_OnInitializeView @1-A1BFB59C
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_sudah_bayar; //Compatibility
//End Page_OnInitializeView

  // -------------------------
      // Write your own code here.
		global $selected_id;
		$selected_id = -1;
		$selected_id=CCGetFromGet("p_finance_period_id", $selected_id);

		$status = strtolower(CCGetFromGet("status_bayar", ""));
		if(strpos($status, "belum") !== false){
			header("Location: t_status_pembayaran_pajak_belum_bayar.php?p_finance_period_id=" . $selected_id);
		}
  // -------------------------

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView

//Page_BeforeInitialize @1-7217F545
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_status_pembayaran_pajak_sudah_bayar; //Compatibility
//End Page_BeforeInitialize

//jml_wp_bayar Initialization @704-65F72402
    if ('t_status_pembayaran_pajak_sudah_bayarjml_wp_bayar' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pembayaran_pajak_sudah_bayarjml_wp_bayar.xml"));
        $Service->SetFormatter($formatter);
//End jml_wp_bayar Initialization

//jml_wp_bayar DataSource @704-41F1AB11
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, jml_wp_bayar from f_status_sudah_bayar(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End jml_wp_bayar DataSource

//jml_wp_bayar Execution @704-B290AEA6
        $Service->AddDataSetValue("Title", "Jumlah WP Bayar");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End jml_wp_bayar Execution

//jml_wp_bayar Tail @704-27890EF8
        exit;
    }
//End jml_wp_bayar Tail

//nilai_ketetapan Initialization @713-8C56F3BE
    if ('t_status_pembayaran_pajak_sudah_bayarnilai_ketetapan' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pembayaran_pajak_sudah_bayarnilai_ketetapan.xml"));
        $Service->SetFormatter($formatter);
//End nilai_ketetapan Initialization

//nilai_ketetapan DataSource @713-C7525F4D
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, nilai_ketetapan from f_status_sudah_bayar(2)";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_ketetapan DataSource

//nilai_ketetapan Execution @713-09450E0B
        $Service->AddDataSetValue("Title", "Nilai Ketetapan");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_ketetapan Execution

//nilai_ketetapan Tail @713-27890EF8
        exit;
    }
//End nilai_ketetapan Tail

//nilai_bayar Initialization @706-86231EDE
    if ('t_status_pembayaran_pajak_sudah_bayarnilai_bayar' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pembayaran_pajak_sudah_bayarnilai_bayar.xml"));
        $Service->SetFormatter($formatter);
//End nilai_bayar Initialization

//nilai_bayar DataSource @706-32F27338
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, nilai_bayar from f_status_sudah_bayar(" . $Service->DataSource->SQLValue($Service->DataSource->wp->GetDBValue("1"), ccsFloat) . ")";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_bayar DataSource

//nilai_bayar Execution @706-007551B3
        $Service->AddDataSetValue("Title", "Nilai Bayar");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_bayar Execution

//nilai_bayar Tail @706-27890EF8
        exit;
    }
//End nilai_bayar Tail

//nilai_denda Initialization @720-AFB7C068
    if ('t_status_pembayaran_pajak_sudah_bayarnilai_denda' == CCGetParam('callbackControl')) {
        global $CCSLocales;
        $Service = new Service();
        $formatter = new TemplateFormatter();
        $formatter->SetTemplate(file_get_contents(RelativePath . "/trans/" . "t_status_pembayaran_pajak_sudah_bayarnilai_denda.xml"));
        $Service->SetFormatter($formatter);
//End nilai_denda Initialization

//nilai_denda DataSource @720-9FC846E5
        $Service->DataSource = new clsDBConnSIKP();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->Parameters["urlp_finance_period_id"] = CCGetFromGet("p_finance_period_id", NULL);
        $Service->DataSource->wp = new clsSQLParameters();
        $Service->DataSource->wp->AddParameter("1", "urlp_finance_period_id", ccsFloat, "", "", $Service->DataSource->Parameters["urlp_finance_period_id"], 0, false);
        $Service->DataSource->SQL = "select tgl, nilai_denda from f_status_sudah_bayar(2)";
        $Service->DataSource->Order = "";
        $Service->DataSource->PageSize = 25;
        $Service->SetDataSourceQuery($Service->DataSource->OptimizeSQL(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order)));
//End nilai_denda DataSource

//nilai_denda Execution @720-F0889278
        $Service->AddDataSetValue("Title", "Nilai Denda");
        $Service->AddHttpHeader("Cache-Control", "cache, must-revalidate");
        $Service->AddHttpHeader("Pragma", "public");
        $Service->AddHttpHeader("Content-type", "text/xml");
        $Service->DisplayHeaders();
        echo $Service->Execute();
//End nilai_denda Execution

//nilai_denda Tail @720-27890EF8
        exit;
    }
//End nilai_denda Tail

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
