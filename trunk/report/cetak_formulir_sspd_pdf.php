<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_sspd_pdf.php");
include_once(RelativePath . "/Common.php");
//include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$custId = CCGetFromGet("t_customer_order_id", "");
$user = CCGetUserLogin();
$data = array();
$dbConn = new clsDBConnSIKP();

$query="select a.order_no ,
       c.company_name ||'('||c.company_brand||')' as nama,
       c.address_name ||' no. '|| c.address_no as alamat,
       c.npwd,
       'SPTPD' as dasar_setoran ,
       e.code as masa_pajak,
       to_char(e.start_date,'YYYY') as tahun,
       d.receipt_no as no_urut ,
       f.code||h.code as ayat ,
	   f.penalty_code as penalty_ayat ,
       f.vat_code as jenis_pajak,
       b.total_vat_amount as jumlah,
       nvl(g.penalty_amt,0)as penalty_amt,
       b.no_kohir,
       replace(f_terbilang(to_char(round(nvl(b.total_vat_amount,0)+nvl(g.penalty_amt,0))),'IDR'), '  ', ' ') as dengan_huruf
from t_customer_order a,
     t_vat_setllement b,
     t_cust_account c ,
     t_payment_receipt d,
     p_finance_period e ,
     p_vat_type f,
     t_vat_penalty g,
	 p_vat_type_dtl h
where a.t_customer_order_id = b.t_customer_order_id 
      and b.t_cust_account_id = c.t_cust_account_id
	  and c.p_vat_type_dtl_id = h.p_vat_type_dtl_id	
      and b.t_vat_setllement_id = d.t_vat_setllement_id (+) 
      and b.p_finance_period_id = e.p_finance_period_id
      and c.p_vat_type_id = f.p_vat_type_id
      and b.t_vat_setllement_id = g.t_vat_setllement_id (+)
      and a.t_customer_order_id = ".$custId;
$dbConn->query($query);
while ($dbConn->next_record()) {
		$data["o_order_no"] = $dbConn->f("o_order_no");
		$data["nama"] = $dbConn->f("nama");
		$data["alamat"] = $dbConn->f("alamat");
		$data["npwd"] = $dbConn->f("npwd");
		$data["dasar_setoran"] = $dbConn->f("dasar_setoran");
		$data["masa_pajak"] = $dbConn->f("masa_pajak");
		$data["no_urut"] = $dbConn->f("no_urut");
		$data["ayat"] = $dbConn->f("ayat");
		$data["penalty_ayat"] = $dbConn->f("penalty_ayat");
		$data["jenis_pajak"] = $dbConn->f("jenis_pajak");
		$data["jumlah"] = $dbConn->f("jumlah");
		$data["penalty_amt"] = $dbConn->f("penalty_amt");
		$data["dengan_huruf"] = $dbConn->f("dengan_huruf");
		$data["tahun"] = $dbConn->f("tahun");
		$data["no_kohir"] = $dbConn->f("no_kohir");
		
}
	if ($data["no_urut"] != "") {
	//barcode
		$bcr = "select f_gen_barcode('".$data["no_urut"]."')";
		$dbConn->query($bcr);
		while($dbConn->next_record()){
			$data["barcode"] = $dbConn->f("f_gen_barcode");
		}
	}
	//end barcode

$dbConn->close();

class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 210;
	var $paperHSize = 297;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF();
	}
	
	function __construct() {
		$this->FormCetak();
		$this->startY = $this->GetY();
		$this->startX = $this->paperWSize-42;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);
		// $this->Cell($this->lengthCell, $this->height, "4.	BENTUK SURAT SETORAN PAJAK DAERAH", 0, 0, 'L');
		// $this->Ln(6);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "TR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "T", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "TR", 0, 'L');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "SSPD", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "(SURAT SETORAN PAJAK DAERAH)", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "Tahun ".$data["tahun"], "R", 0, 'C');		
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		
		$lbody = $this->lengthCell / 3;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 12);
		$this->Ln();
		$this->Cell($lbody3, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($lbody1, $this->height, "          Nama", "L", 0, 'L');
		$this->Cell($lbody2, $this->height, ": ".$data["nama"], "R", 0, 'L');
		$this->newLine();
		$this->newLine();
		$this->Cell($lbody1, $this->height, "          Alamat", "L", 0, 'L');
		$this->Cell($lbody2, $this->height, ": ".$data["alamat"], "R", 0, 'L');
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody1, $this->height + 2, "          NPWD", "L", 0, 'L');
		$this->Cell($lbody1, $this->height + 2, "", "", 0, 'L');
		$this->Cell($lbody1, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');
		$rep_npwd = str_replace(".","",$data["npwd"]);
		$arr1 = str_split($rep_npwd);
		
		$this->kotak(1, 34, 1,$arr1[0]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[1]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 1,$arr1[2]);
		$this->kotak(1, 34, 1,$arr1[3]);
		$this->kotak(1, 34, 1,$arr1[4]);
		$this->kotak(1, 34, 1,$arr1[5]);
		$this->kotak(1, 34, 1,$arr1[6]);
		$this->kotak(1, 34, 1,$arr1[7]);
		$this->kotak(1, 34, 1,$arr1[8]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 2,$arr1[9]);
		$this->kotakKosong(1, 34, 1);
		$this->kotak(1, 34, 2,$arr1[10]);
		
		$this->newLine();
		$this->newLine();
				
		
		//ceking menyetor
		$SKPDKB = "";
		$SPTPD = "";
		$SKPDKBT = "";
		$K_Pembetulan = "";
		$STPD = "";
		$K_Keberatan = "";
		$lain_lain = "";
		
		
		if ($data["dasar_setoran"] == "SKPDKB"){
		   $SKPDKB = "X";	
		}else if($data["dasar_setoran"] == "SPTPD"){
		   $SPTPD = "X";	
		}else if($data["dasar_setoran"] == "SKPDKBT"){
		   $SKPDKBT = "X";	
		}else if($data["dasar_setoran"] == "K Pembetulan"){
		   $K_Pembetulan = "X";	
		}else if($data["dasar_setoran"] == "STPD"){
		   $STPD = "X";
		}else if($data["dasar_setoran"] == "K Keberatan"){
		   $K_Keberatan = "X";	
		}else{
		   $lain_lain = "X";
		}

		if ($data["penalty_amt"] == 0){
			$STPD = "";
		}else{
			$STPD = "X";
		}	
				
		
		$this->Cell($lbody1, $this->height, "          (Menyetor berdasarkan *)", "L", 0, 'L');
		
		$lcek = $lbody2 / 3;
		$lcek1 = $lcek * 1;
		$this->Cell($lcek1, $this->height + 2, "     SKPDKB", "", 0, 'L');
		$this->Cell($lcek1, $this->height + 2, "          SPTPD", "", 0, 'L');
		$this->Cell($lcek1, $this->height + 2, "               Lain-lain", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 34, 1,$SKPDKB);
		$this->Cell($lcek1, $this->height, "", "", 0, 'C');
		$this->kotak(1, 34, 1,$SPTPD);
		$this->Cell($lcek1, $this->height, "", "", 0, 'C');
		$this->kotak(1, 34, 1,$lain_lain);
		
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');
		
		$this->Cell($lcek1, $this->height + 2, "     SKPDKBT", "", 0, 'L');
		$this->Cell($lcek1, $this->height + 2, "          K Pembetulan", "", 0, 'L');
		$this->Cell($lcek1, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 34, 1,$SKPDKBT);
		$this->Cell($lcek1, $this->height, "", "", 0, 'C');
		$this->kotak(1, 34, 1,$K_Pembetulan);

		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');

		$this->Cell($lcek1, $this->height + 2, "     STPD", "", 0, 'L');
		$this->Cell($lcek1, $this->height + 2, "          K Keberatan", "", 0, 'L');
		$this->Cell($lcek1, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height-4);
		
		$this->Cell($lbody1, $this->height, "", "L", 0, 'L');
		$this->kotak(1, 34, 1,$STPD);
		$this->Cell($lcek1, $this->height, "", "", 0, 'C');
		$this->kotak(1, 34, 1,$K_Keberatan);
		
		$this->newLine();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->Cell($lbody1, $this->height, " Masa Pajak : ".$data["masa_pajak"], "L", 0, 'L');
		$this->Cell($lcek1, $this->height, "          Tahun : ".$data["tahun"], "", 0, 'L');
		$this->Cell($lcek1, $this->height, "               No. Urut : ".$data["no_kohir"], "", 0, 'L');
		
		$this->Cell($lcek1, $this->height, "", "R", 0, 'L');
		
		$this->newLine();
		$this->newLine();
		
		$ltable = $this->lengthCell / 17;
		$ltable1 = $ltable * 1;
		$ltable4 = $ltable * 4;
		
		$this->Cell($ltable1, $this->height + 2, "No.", "TBLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, "Ayat", "TBLR", 0, 'C');
		$this->Cell($ltable4 * 2, $this->height + 2, "Jenis Pajak", "TBLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, "Jumlah (Rp)", "TBLR", 0, 'C');
		

		//$jumlahBaris = 5;
		//for($i = 0; $i < $jumlahBaris; $i++){
			$this->Ln();
			//$this->Cell($ltable1, $this->height + 2, "1", "TBLR", 0, 'C');
			//$this->Cell($ltable4, $this->height + 2, $data["ayat"], "TBLR", 0, 'L');
			//$this->Cell($ltable4 * 2, $this->height + 2, $data["jenis_pajak"], "TBLR", 0, 'L');
			//$this->Cell($ltable4, $this->height + 2, $data["jumlah"], "TBLR", 0, 'C');
		//}
										  
		
		//isi kolom
		$this->SetWidths(array($ltable1, $ltable4, $ltable4 * 2, $ltable4));
		$this->SetAligns(array("C", "L", "L", "R"));
		$no = 1;
		for ($i=0; $i<count($data['ayat']); $i++) {
		$this->RowMultiBorderWithHeight(array($no,
											  $data["ayat"],
											  $data["jenis_pajak"],
											  number_format($data["jumlah"],2,",",".")
											  ),
										array('TBLR',
										      'TBLR',
											  'TBLR',
											  'TBLR')
											  ,$this->height);
		$no = $no + 1;
		$tot = $tot + $data["jumlah"];	
		}
		//isi kolom
		if ($data["penalty_amt"] != 0){
		$this->SetWidths(array($ltable1, $ltable4, $ltable4 * 2, $ltable4));
		$this->SetAligns(array("C", "L", "L", "R"));
		for ($i=0; $i<count($data['penalty_ayat']); $i++) {
		$this->RowMultiBorderWithHeight(array($no,
											  $data["penalty_ayat"],
											  "Denda ".$data["jenis_pajak"],
											  number_format($data["penalty_amt"],2,",",".")
											  ),
										array('TBLR',
										      'TBLR',
											  'TBLR',
											  'TBLR')
											  ,$this->height);
		$no = $no + 1;
		$tot2 = $tot2 + $data["penalty_amt"];	
		}
		}
		
		$total_jum = $tot + $tot2;
		$this->Cell($ltable1, $this->height + 2, "", "L", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, "", "", 0, 'C');
		$this->Cell($ltable4 * 2, $this->height + 2, "Jumlah Setoran Pajak", "TBLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, number_format($total_jum,2,",","."), "TBLR", 0, 'R');
		
		$this->Ln();
		$this->newLine();
		
		$this->SetWidths(array($ltable1 + $ltable4, $ltable4 * 3));
		$this->SetAligns(array("C", "L"));
		$this->RowMultiBorderWithHeight(array("Dengan huruf", $data["dengan_huruf"]),
										array("L", "TBLR"),
										$this->height);
		$this->newLine();
		
		$lowTable = $this->lengthCell / 3;
		$lowTable1 = $lowTable * 1;
		
		$this->Cell($lowTable1, $this->height + 2, "Kode Register", "LTR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "Diterima oleh", "LTR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "............................. Tahun", "LTR", 0, 'C');
		
		$this->Ln();
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "Petugas Tempat Pembayaran", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, ".....................", "LR", 0, 'C');
		if ($data["no_urut"] != "") {
			$dbConn = new clsDBConnSIKP();
			$query = "select f_encrypt_str('".$data["no_urut"]."') AS enc_data";

			$dbConn->query($query);
			while ($dbConn->next_record()) {
				$encImageData = $dbConn->f("enc_data");
			}
			$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.$encImageData,30,$this->getY(),25,0,'PNG');
		}
		$this->Ln();
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "Tanggal :".date("d F Y"), "LR", 0, 'L');
		$this->Cell($lowTable1, $this->height + 2, "Penyetor", "LR", 0, 'C');
		
		$this->Ln();
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		
		$this->Ln();
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'L'); //$data["no_urut"]
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		
		$nomor_urut = explode("-",$data["no_urut"]);
		
		$this->Ln();
		$this->Cell($lowTable1, $this->height + 2, $nomor_urut[0], "LR", 0, 'L');
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		$this->Cell($lowTable1, $this->height + 2, "", "LR", 0, 'C');
		
		$this->Ln();
		$this->Cell($lowTable1, $this->height + 2, $nomor_urut[1], "BLR", 0, 'L');
		$this->Cell($lowTable1, $this->height + 2, "Nama Terang : ".$user, "BLR", 0, 'L');
		$this->Cell($lowTable1, $this->height + 2, "(.....................)", "BLR", 0, 'C');
		
		$this->Ln();
		$this->Ln();
		$this->Cell($lowTable1 - 15, $this->height + 2, "Beri tanda X pada kotak", "", 0, 'L');
		$this->kotak(1, 34, 1,"");
		$this->Cell($lowTable1, $this->height + 2, "sesuai dengan yang dimiliki.", "", 0, 'L');
	}

	function newLine(){
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
	}
	
	function kotakKosong($pembilang, $penyebut, $jumlahKotak){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, "", "LR", 0, 'L');
		}
	}
	
	function kotak($pembilang, $penyebut, $jumlahKotak, $isi){
		$lkotak = $pembilang / $penyebut * $this->lengthCell;
		for($i = 0; $i < $jumlahKotak; $i++){
			$this->Cell($lkotak, $this->height, $isi, "TBLR", 0, 'C');
		}
	}
	
	function getNumberFormat($number, $dec) {
			if (!empty($number)) {
				return number_format($number, $dec);
			} else {
				return "";
			}
	}
	
	function SetWidths($w)
	{
	    //Set the array of column widths
	    $this->widths=$w;
	}

	function SetAligns($a)
	{
	    //Set the array of column alignments
	    $this->aligns=$a;
	}

	function Row($data)
	{
	    //Calculate the height of the row
	    $nb=0;
	    for($i=0;$i<count($data);$i++)
	        $nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
	    $h=5*$nb;
	    //Issue a page break first if needed
	    $this->CheckPageBreak($h);
	    //Draw the cells of the row
	    for($i=0;$i<count($data);$i++)
	    {
	        $w=$this->widths[$i];
	        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
	        //Save the current position
	        $x=$this->GetX();
	        $y=$this->GetY();
	        //Draw the border
	        $this->Rect($x, $y, $w, $h);
	        //Print the text
	        $this->MultiCell($w, 5, $data[$i], 0, $a);
	        //Put the position to the right of the cell
	        $this->SetXY($x+$w, $y);
	    }
	    //Go to the next line
	    $this->Ln($h);
	}

	function CheckPageBreak($h)
	{
	    //If the height h would cause an overflow, add a new page immediately
	    if($this->GetY()+$h>$this->PageBreakTrigger)
	        $this->AddPage($this->CurOrientation);
	}
	
	function RowMultiBorderWithHeight($data, $border = array(),$height)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h=$height*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			//$this->Rect($x,$y,$w,$h);
			$this->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
			$this->SetXY($x,$y);
			//Print the text
			$this->MultiCell($w,$height,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}
	
	function NbLines($w, $txt)
	{
	    //Computes the number of lines a MultiCell of width w will take
	    $cw=&$this->CurrentFont['cw'];
	    if($w==0)
	        $w=$this->w-$this->rMargin-$this->x;
	    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
	    $s=str_replace("\r", '', $txt);
	    $nb=strlen($s);
	    if($nb>0 and $s[$nb-1]=="\n")
	        $nb--;
	    $sep=-1;
	    $i=0;
	    $j=0;
	    $l=0;
	    $nl=1;
	    while($i<$nb)
	    {
	        $c=$s[$i];
	        if($c=="\n")
	        {
	            $i++;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	            continue;
	        }
	        if($c==' ')
	            $sep=$i;
	        $l+=$cw[$c];
	        if($l>$wmax)
	        {
	            if($sep==-1)
	            {
	                if($i==$j)
	                    $i++;
	            }
	            else
	                $i=$sep+1;
	            $sep=-1;
	            $j=$i;
	            $l=0;
	            $nl++;
	        }
	        else
	            $i++;
	    }
	    return $nl;
	}
	
	function Footer() {
		
	}
	
	function __destruct() {
		return null;
	}
}

$formulir = new FormCetak();
$formulir->PageCetak($data, $user);
$formulir->Output();

?>
