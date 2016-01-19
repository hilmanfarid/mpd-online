<?php
//BindEvents Method @1-ECD04D6B
function BindEvents()
{
    global $grafik_pembayaran_form;
    global $CCSEvents;
    $grafik_pembayaran_form->Button2->CCSEvents["OnClick"] = "grafik_pembayaran_form_Button2_OnClick";
    $grafik_pembayaran_form->Button_DoSearch1->CCSEvents["OnClick"] = "grafik_pembayaran_form_Button_DoSearch1_OnClick";
    $grafik_pembayaran_form->CCSEvents["BeforeShow"] = "grafik_pembayaran_form_BeforeShow";
    $CCSEvents["OnInitializeView"] = "Page_OnInitializeView";
}
//End BindEvents Method

//grafik_pembayaran_form_Button2_OnClick @20-F6DB7EB7
function grafik_pembayaran_form_Button2_OnClick(& $sender)
{
    $grafik_pembayaran_form_Button2_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grafik_pembayaran_form; //Compatibility
//End grafik_pembayaran_form_Button2_OnClick

//Custom Code @71-2A29BDB7
// -------------------------
    // Write your own code here.
	$app_user_name = $grafik_pembayaran_form->app_user_name->GetValue();
	$mobile_no = $grafik_pembayaran_form->mobile_no->GetValue();
	$message = $grafik_pembayaran_form->message->GetValue();
	$message = str_replace('\n\r','|',$message);
	
	$dbConn = new clsDBConnSIKP();
	$query = 	"select * from t_wa_bot_number where status ='Y' limit 1";

	$dbConn->query($query);
	$dbConn->next_record();
	$username = $dbConn->f("number");
	$password = $dbConn->f("password");

	file_get_contents("http://localhost/chat-api/send_message.php?username=".$username.
			"&password=".urlencode($password)."&message=".urlencode($message).
			"&target=".$mobile_no);
	//exit;
	echo '<script>
				alert ("Pesan akan segera dikirim.");
			</script>			
			';
	return;
// -------------------------
//End Custom Code

//Close grafik_pembayaran_form_Button2_OnClick @20-8AF2D859
    return $grafik_pembayaran_form_Button2_OnClick;
}
//End Close grafik_pembayaran_form_Button2_OnClick

//grafik_pembayaran_form_Button_DoSearch1_OnClick @74-9D4A66DA
function grafik_pembayaran_form_Button_DoSearch1_OnClick(& $sender)
{
    $grafik_pembayaran_form_Button_DoSearch1_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grafik_pembayaran_form; //Compatibility
//End grafik_pembayaran_form_Button_DoSearch1_OnClick

//Custom Code @75-2A29BDB7
// -------------------------
    // Write your own code here.
	$grafik_pembayaran_form->message->SetValue('test bro');
// -------------------------
//End Custom Code

//Close grafik_pembayaran_form_Button_DoSearch1_OnClick @74-9D391FE9
    return $grafik_pembayaran_form_Button_DoSearch1_OnClick;
}
//End Close grafik_pembayaran_form_Button_DoSearch1_OnClick

//grafik_pembayaran_form_BeforeShow @2-FAF917CD
function grafik_pembayaran_form_BeforeShow(& $sender)
{
    $grafik_pembayaran_form_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grafik_pembayaran_form; //Compatibility
//End grafik_pembayaran_form_BeforeShow

//Custom Code @77-2A29BDB7
// -------------------------
    // Write your own code here.
	$doAction = CCGetFromGet('doAction');
	$tgl_penerimaan = CCGetFromGet('tgl_penerimaan');
	if ($doAction == 'get_data'){
		$dbConn	= new clsDBConnSIKP();
		$data 	= array();
		$message ='';

		$query	= "select * from f_rep_lap_harian_bdhr_mod_2('$tgl_penerimaan','') order by nomor_ayat";
		//echo $query;exit;
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$data["nomor_ayat"][]		= $dbConn->f("nomor_ayat");
			$data["nama_ayat"][]		= $dbConn->f("nama_ayat");
			$data["nama_jns_pajak"][]	= $dbConn->f("nama_jns_pajak");
			$data["kode_jns_pajak"][]	= $dbConn->f("kode_jns_pajak");
			$data["jns_pajak"][]		= $dbConn->f("jns_pajak");
			$data["type_ayat"][]		= $dbConn->f("type_ayat");
			$data["p_vat_type_id"][]	= $dbConn->f("p_vat_type_id");
			$data["p_vat_type_dtl_id"][]= $dbConn->f("p_vat_type_dtl_id");
			$data["bulan"][]			= $dbConn->f("bulan");
			$data["tahun"][]			= $dbConn->f("tahun");
			$data["jml_hari_ini"][]		= $dbConn->f("jml_hari_ini");
			$data["jml_sd_hari_lalu"][]	= $dbConn->f("jml_sd_hari_lalu");
			$data["jml_sd_hari_ini"][]	= $dbConn->f("jml_sd_hari_ini");
			$data["jml_transaksi"][]	= $dbConn->f("jml_transaksi");
			$data["jml_transaksi_sampai_kemarin"][]	= $dbConn->f("jml_transaksi_sampai_kemarin");
			$data["jml_transaksi_sampai_hari_ini"][]	= $dbConn->f("jml_transaksi_sampai_hari_ini");
		}

		$jumlahperjenis = array();
		$jumlahtotal = 0;
		$jumlahtemp = 0;
		$jumlahperjenis_harilalu = array();
		$jumlahtotal_harilalu = 0;
		$jumlahtemp_harilalu = 0;
		$jumlahperjenis_hariini = array();
		$jumlahtotal_hariini = 0;
		$jumlahtemp_hariini = 0;
		$jml_transaksi_per_jenis_pajak = 0;
		$jml_transaksi_semua_jenis_pajak = 0;
		$jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
		$jml_transaksi_sampai_kemarin_semua_jenis_pajak = 0;
		$jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
		$jml_transaksi_sampai_hari_ini_semua_jenis_pajak = 0;
		
		for ($i = 0; $i < count($data['nomor_ayat']); $i++) {
			$jumlahtemp += $data["jml_hari_ini"][$i];
			$jumlahtotal += $data["jml_hari_ini"][$i];
			$jumlahtemp_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtotal_harilalu += $data["jml_sd_hari_lalu"][$i];
			$jumlahtemp_hariini += $data["jml_sd_hari_ini"][$i];
			$jumlahtotal_hariini += $data["jml_sd_hari_ini"][$i];
			$jml_transaksi_per_jenis_pajak += $data["jml_transaksi"][$i];
			$jml_transaksi_semua_jenis_pajak += $data["jml_transaksi"][$i];
			
			$jml_transaksi_sampai_kemarin_per_jenis_pajak += $data["jml_transaksi_sampai_kemarin"][$i];
			$jml_transaksi_sampai_kemarin_semua_jenis_pajak += $data["jml_transaksi_sampai_kemarin"][$i];

			$jml_transaksi_sampai_hari_ini_per_jenis_pajak += $data["jml_transaksi_sampai_hari_ini"][$i];
			$jml_transaksi_sampai_hari_ini_semua_jenis_pajak += $data["jml_transaksi_sampai_hari_ini"][$i];

			$jenis = $data["nama_jns_pajak"][$i];
			$jenissesudah = $data["nama_jns_pajak"][$i + 1];
			if($jenis != $jenissesudah){
				$jumlahperjenis[] = $jumlahtemp;
				$jumlahperjenis_harilalu[] = $jumlahtemp_harilalu;
				$jumlahperjenis_hariini[] = $jumlahtemp_hariini;
				$jumlahtemp = 0;
				$jumlahtemp_harilalu = 0;
				$jumlahtemp_hariini = 0;
				$jml_transaksi_per_jenis_pajak = 0;
				$jml_transaksi_sampai_kemarin_per_jenis_pajak = 0;
				$jml_transaksi_sampai_hari_ini_per_jenis_pajak = 0;
			}
		}

		$query = "select sum(b.target_amt) as target, a.target_code , a.p_vat_type_id FROM t_revenue_target a, t_revenue_target_dtl b
				where
				a.t_revenue_target_id=b.t_revenue_target_id and
				a.p_year_period_id = (select p_year_period_id 
									from p_year_period 
									where to_date('".$tgl_penerimaan."') BETWEEN start_date and end_date)
				GROUP BY a.p_vat_type_id,a.target_code
				ORDER BY a.p_vat_type_id";
		
		$dbConn->query($query);
		$data_target 	= array();
		while ($dbConn->next_record()) {
			$data_target["target"][]		= $dbConn->f("target");
			$data_target["target_code"][]		= $dbConn->f("target_code");
			$data_target["p_vat_type_id"][]	= $dbConn->f("p_vat_type_id");
		}

		$query = "select sum(b.target_amt) as target
				FROM t_revenue_target a, t_revenue_target_dtl b
				where
				a.t_revenue_target_id=b.t_revenue_target_id and
				a.p_vat_type_id in (1,2,3,4,5,6) and
				a.p_year_period_id = (select p_year_period_id 
									from p_year_period 
									where to_date('".$tgl_penerimaan."') BETWEEN start_date and end_date)";
		//echo $query;exit;
		$dbConn->query($query);
		$dbConn->next_record();
		$target_setahun	= $dbConn->f("target");

		$message .= 
'Yth. Bapak Kadisyanjak izin lapor  Penerimaan tgl '.$tgl_penerimaan.' 
Hotel sebesar '.number_format($jumlahperjenis[0], 2, ',', '.').' 
Restoran sebesar. '.number_format($jumlahperjenis[1], 2, ',', '.').' 
Hiburan sebesar. '.number_format($jumlahperjenis[2], 2, ',', '.').' 
PPJ sebesar.  '.number_format($jumlahperjenis[4], 2, ',', '.').'
Parkir sebesar. '.number_format($jumlahperjenis[5], 2, ',', '.').'
Bphtb sbsar. '.number_format($jumlahperjenis[8], 2, ',', '.').'
sd jam 15.30
Denda sebesar '.number_format($jumlahperjenis[9], 2, ',', '.').'
Jumlah hari ini seb. '.number_format($jumlahtotal, 2, ',', '.').'
Total penerimaan  sampai dengan tgl '.$tgl_penerimaan.' sebesar '.number_format($jumlahtotal_hariini, 2, ',', '.').'('.number_format($jumlahtotal_hariini/$target_setahun*100, 2, ',', '.').'%)
terdiri dr
Hotel '.number_format($jumlahperjenis_hariini[0], 2, ',', '.').'('.number_format($jumlahperjenis_hariini[0]/$data_target["target"][0]*100, 2, ',', '.').'%)
Rest '.number_format($jumlahperjenis_hariini[1], 2, ',', '.').'('.number_format($jumlahperjenis_hariini[1]/$data_target["target"][1]*100, 2, ',', '.').'%)
Hib '.number_format($jumlahperjenis_hariini[2], 2, ',', '.').'('.number_format($jumlahperjenis_hariini[2]/$data_target["target"][2]*100, 2, ',', '.').'%)
Ppj. '.number_format($jumlahperjenis_hariini[4], 2, ',', '.').'('.number_format($jumlahperjenis_hariini[4]/$data_target["target"][4]*100, 2, ',', '.').'%)
Park. '.number_format($jumlahperjenis_hariini[5], 2, ',', '.').'('.number_format($jumlahperjenis_hariini[5]/$data_target["target"][3]*100, 2, ',', '.').'%)
BPHTB. '.number_format($jumlahperjenis_hariini[8], 2, ',', '.').'('.number_format($jumlahperjenis_hariini[8]/$data_target["target"][5]*100, 2, ',', '.').'%)
Denda. '.number_format($jumlahperjenis_hariini[9], 2, ',', '.').'';

		$grafik_pembayaran_form->message->SetValue($message);
		//echo '<pre>';print_r($data_target);exit;
	}

// -------------------------
//End Custom Code

//Close grafik_pembayaran_form_BeforeShow @2-DC6A68A9
    return $grafik_pembayaran_form_BeforeShow;
}
//End Close grafik_pembayaran_form_BeforeShow

//Page_OnInitializeView @1-C745B6A6
function Page_OnInitializeView(& $sender)
{
    $Page_OnInitializeView = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $t_send_sms_to_app_user_whatsapp; //Compatibility
//End Page_OnInitializeView

//Custom Code @66-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_OnInitializeView @1-81DF8332
    return $Page_OnInitializeView;
}
//End Close Page_OnInitializeView
 

?>
