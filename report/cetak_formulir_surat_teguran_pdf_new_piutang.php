<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_teguran_pdf_new.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$jenis_pajak		= CCGetFromGet("jenis_pajak", "");
$tahun 				= CCGetFromGet("tahun", "");
$npwd 				= CCGetFromGet("npwd", "");
$dbConn = new clsDBConnSIKP();
$nama_jenis_pajak = '';
if (empty($npwd)){
	if (empty($jenis_pajak)){
		echo "Jenis Pajak tidak boleh kosong";
		exit;
	}
	if (($jenis_pajak>=1) && ($jenis_pajak<=4)){
		if ($jenis_pajak==1){
			$nama_jenis_pajak = 'Pajak Hotel';
		}
		if ($jenis_pajak==2){
			$nama_jenis_pajak = 'Pajak Restoran';
		}
		if ($jenis_pajak==3){
			$nama_jenis_pajak = 'Pajak Hiburan';
		}
		if ($jenis_pajak==4){
			$nama_jenis_pajak = 'Pajak Parkir';
		}
	}else{
		echo "Jenis Pajak salah";
		exit;
	}

	if (empty($tahun)){
		$query="select distinct (a.npwd), b.address_name,b.company_name   
			from t_piutang_pajak_penetapan_final a
			left join t_cust_account b on a.t_cust_account_id = b.t_cust_account_id
			where  a.p_vat_type_id = '$jenis_pajak'
			and tgl_bayar is NULL
	    	and sisa_piutang >0";
	}else{
		$query="select distinct (a.npwd), b.address_name,b.company_name   
			from t_piutang_pajak_penetapan_final a
			left join t_cust_account b on a.t_cust_account_id = b.t_cust_account_id
			where  a.p_vat_type_id = '$jenis_pajak'
			and year_code ='$tahun'
			and tgl_bayar is NULL
	    	and sisa_piutang >0";
	}
}else{
	$query="select distinct (a.npwd), b.address_name,b.company_name   
			from t_piutang_pajak_penetapan_final a
			left join t_cust_account b on a.t_cust_account_id = b.t_cust_account_id
			where  a.npwd = '".$npwd."'";
}
//echo $query;
//exit;

$dbConn->query($query);
$data=array();
while ($dbConn->next_record()) {
	$data[]= array(
	"npwd"	=> $dbConn->f("npwd"),
	"company_name"		=> $dbConn->f("company_name"),
	"address_name"	=> $dbConn->f("address_name")
	);	
}
//echo '<pre>';
//print_r($data_new);
//echo '</pre>';
	
$dbConn->close();


class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId=0;
	var $yearCode="";
	var $paperWSize = 241.3;
	var $paperHSize = 279.4;
	var $height = 5;
	var $currX;
	var $currY;
	var $widths;
	var $aligns;
	
	function FormCetak() {
		$this->FPDF('P','mm',array($this->paperWSize, $this->paperHSize));
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
	
	function PageCetak($data,$no_urut) {
		$this->AliasNbPages();
		$this->SetLeftMargin(10);
		$this->AddPage("P");
		$this->AddFont('BKANT');
		
		$this->SetFont('BKANT', '', 12);
		
		// $this->Image('../images/logo_pemda.png',25,17,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->SetFont('BKANT', '', 12);
		
		// $this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		// $this->Cell($lheader7, $this->height, "", "TR", 0, 'C');
		// $this->Ln();
		// $this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		// $this->Cell($lheader7, $this->height, "", "R", 0, 'C');
		// $this->Ln();
		
		// $this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		// $this->Cell($lheader7, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		// $this->Ln();
		
		// $this->SetFont('BKANT', '', 16);
		// $this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		// $this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		// $this->Ln();
		
		// $this->SetFont('BKANT', '', 12);
		// $this->Cell($lheader1, $this->height + 3, "", "L", 0, 'L');
		// $this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		// $this->Ln();
		
		// $this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		// $this->Cell($lheader7, $this->height, "", "R", 0, 'C');
		// $this->Ln();
		// $this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		// $this->Cell($lheader7, $this->height, "", "BR", 0, 'C');
		// $this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "TLR", 0, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;

		$this->SetWidths(array(20,2,$this->lengthCell-22));
		$this->SetAligns(array("L","L","L"));
		$posy = $this->getY();
		$data["letter_no"]=trim($data["letter_no"]);
		if(!empty($data["letter_no"])){
			$this->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					/*$data["letter_no"]."-".$no_urut*/""
				),
				array("",
					"",
					""
				),
				3
			);
		}else{
			$this->RowMultiBorderWithHeight(
				array("Nomor",
					":",
					/*" - "*/""
				),
				array("",
					"",
					""
				),
				3
			);
		}
		$this->RowMultiBorderWithHeight(
			array("Perihal",
				":",
				"SURAT TEGURAN"
			),
			array("L",
				"",
				"R"
			),
			3
		);

		$this->setY($posy-3);
		$today = getdate();
		$lkepada = $this->lengthCell / 5;
		$lkepada2 = $lkepada * 2;
		$lkepada3 = $lkepada * 3;
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		//$this->Cell($lkepada2, $this->height, "Bandung, ".dateToString(date("Y-m-d")), "R", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "R", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Kepada Yth,", "R", 0, 'L');
		$this->Ln();

		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array($lkepada3,22,2,63.7));
		$this->RowMultiBorderWithHeight(
			array("",
				"Pimpinan",
				":",
				$data['company_name']
			),
			array("L",
				"",
				"",
				"R"
			),
			$this->height
		);
		
		$this->SetAligns(array("L","L","L","L"));
		$this->SetWidths(array($lkepada3,22,2,63.7));
		$this->RowMultiBorderWithHeight(
			array("",
				"NPWD",
				":",
				$data['npwd']
			),
			array("L",
				"",
				"",
				"R"
			),
			$this->height/2
		);
		
		$this->SetWidths(array($lkepada3,$lkepada2));
		$this->SetAligns(array("L","L"));
		$this->RowMultiBorderWithHeight(
			array("",
				$data["address_name"]
			),
			array("L",
				"R"
			),
			$this->height
		);
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Di ", "R", 0, 'L');
		$this->Ln();

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "          Tempat", "R", 0, 'L');
		$this->Ln();
		
		// $this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		// $this->Cell($lkepada2, $this->height, "", "R", 0, 'C');
		// $this->Ln();
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('BKANT', '', 12);
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
		// $this->newLine();
		$this->Cell($this->lengthCell, $this->height, "SURAT TEGURAN ", "LR", 0, 'C');
		$this->newLine();
		
		$this->SetFont('BKANT', '', 12);
		/*$this->Cell($this->lengthCell, $this->height, "Nomor: ".$data["letter_no"], "LR", 0, 'C');
		$this->newLine();*/
		$this->SetWidths(array(10,204.3, 5));
		$this->SetAligns(array("L", "J", "C"));
		$this->RowMultiBorderWithHeight(array("",
				"Menindaklanjuti hasil laporan pemeriksaan BPK-RI Provinsi Jawa Barat atas laporan Keuangan Pemerintah Kota Bandung Tahun 2012 No.2.B/LHP/XVIII.BDG/05/2013 tanggal 24 Mei 2013 tentang Laporan Keuangan Pemerintah Tahun Anggaran 2013 pada Pemerintah Kota Bandung serta data pembukuan pada Dinas Pelayanan Pajak Kota Bandung, bahwa perusahaan Saudara/i masih mempunyai tunggakan Pajak Daerah sebagaimana tercantum dalam lampiran surat ini.",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);

		$this->RowMultiBorderWithHeight(array("",
				"",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);

		$this->RowMultiBorderWithHeight(array("",
				"Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Undang - undang Nomor 28 Tahun 2009 dan Peraturan Daerah Nomor 20 Tahun 2011,  maka diminta kepada Saudara  agar melunasi jumlah Tunggakan dalam waktu 7 (tujuh)  hari setelah Surat Teguran/Konfirmasi ini. Setelah batas waktu tersebut tindakan penagihan akan ditindaklanjuti dengan penyerahan Surat Paksa.",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);

		$this->RowMultiBorderWithHeight(array("",
				"",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);

		$this->RowMultiBorderWithHeight(array("",
				"Dalam hal Saudara telah melunasi tunggakan di atas, diminta agar Saudara segera menginformasikan kepada Seksi Penyelesaian Piutang Dinas Pelayanan Kota Bandung pada waktu hari dan jam kerja.",
				""
			),
			array("L",
				"",
				"R"
			),
			$this->height
		);

		//$this->newLine();
		// Tabel
		$ltable = ($this->lengthCell - 15) / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;
		
		$tahun = explode(" ",$data["periode"]);

		$bulan_periode = explode(",",$data['debt_period_code']);
		$bulan_string='';
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell(20, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1 - 20,"", "", 0, 'L');	
		$this->Cell($lbody3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		/*
		$this->tulis("Untuk mencegah tindakan penagihan dengan Surat Paksa berdasarkan Undang-undang Nomor 28 Tahun", "FJ");
		$this->tulis("2009 dan Peraturan Daerah Nomor 20 Tahun 2011 Ps 70, maka diminta kepada Saudara agar melunasi", "FJ");
		$this->tulis("jumlah tunggakan dalam waktu 7 (tujuh) hari setelah Surat Teguran ini. Setelah batas waktu tersebut", "FJ");
		$this->tulis("tindakan penagihan akan ditindaklanjuti dengan penyerahan Surat Paksa.", "L");
		$this->tulis("", "L");
		$this->tulis("Apabila saudara telah melaksanakan pembayaran pajak tersebut, kami mohon untuk dapat memperlihatkan", "FJ");
		$this->tulis("SSPD yang telah divalidasi dengan melampirkan photo copy dokumen yang dimaksud.", "L");
		$this->tulis("", "L");
		*/
		$this->tulis("Demikian agar menjadi maklum, atas perhatian dan kerjasamanya diucapkan terimakasih.", "L");
		
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		// $this->Ln();
		// $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		// $this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Image('../images/ttd_pa_soni.jpg',$lbody4+$lbody4+$lbody2-15,165,$lbody4+48,20);

		$this->Image('http://'.$_SERVER['HTTP_HOST'].'/mpd/include/qrcode/generate-qr.php?param='.
		$data["npwd"]."_".
		str_replace(" ","-",dateToString(date("Y-m-d")))
		,15,165,25,25,'PNG');

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, ".dateToString(date("Y-m-d")) /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "an. KEPALA DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4-5, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4+10, $this->height, "H. SONI BAKHTIYAR, S.Sos, M.Si", "B", 0, 'C');
		$this->Cell($lbody2-5, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. 19750625 199403 1 001", "", 0, 'C'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "BL", 0, 'L');
		//$this->Cell($this->lengthCell - 10, $this->height, "*) Coret yang tidak perlu", "BR", 0, 'L');
		$this->Cell($this->lengthCell - 10, $this->height, "", "BR", 0, 'L');
	}

	function CellFJ($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='')
	{
		$k=$this->k;
		if($this->y+$h>$this->PageBreakTrigger and !$this->InFooter and $this->AcceptPageBreak())
		{
			$x=$this->x;
			$ws=$this->ws;
			if($ws>0)
			{
				$this->ws=0;
				$this->_out('0 Tw');
			}
			$this->AddPage($this->CurOrientation);
			$this->x=$x;
			if($ws>0)
			{
				$this->ws=$ws;
				$this->_out(sprintf('%.3f Tw', $ws*$k));
			}
		}
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$s='';
		if($fill==1 or $border==1)
		{
			if($fill==1)
				$op=($border==1) ? 'B' : 'f';
			else
				$op='S';
			$s=sprintf('%.2f %.2f %.2f %.2f re %s ', $this->x*$k, ($this->h-$this->y)*$k, $w*$k, -$h*$k, $op);
		}
		if(is_string($border))
		{
			$x=$this->x;
			$y=$this->y;
			if(is_int(strpos($border, 'L')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, $x*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'T')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-$y)*$k);
			if(is_int(strpos($border, 'R')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', ($x+$w)*$k, ($this->h-$y)*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
			if(is_int(strpos($border, 'B')))
				$s.=sprintf('%.2f %.2f m %.2f %.2f l S ', $x*$k, ($this->h-($y+$h))*$k, ($x+$w)*$k, ($this->h-($y+$h))*$k);
		}
		if($txt!='')
		{
			if($align=='R')
				$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
			elseif($align=='C')
				$dx=($w-$this->GetStringWidth($txt))/2;
			elseif($align=='FJ')
			{
				//Set word spacing
				$wmax=($w-2*$this->cMargin);
				$this->ws=($wmax-$this->GetStringWidth($txt))/substr_count($txt, ' ');
				$this->_out(sprintf('%.3f Tw', $this->ws*$this->k));
				$dx=$this->cMargin;
			}
			else
				$dx=$this->cMargin;
			$txt=str_replace(')', '\\)', str_replace('(', '\\(', str_replace('\\', '\\\\', $txt)));
			if($this->ColorFlag)
				$s.='q '.$this->TextColor.' ';
			$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET', ($this->x+$dx)*$k, ($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k, $txt);
			if($this->underline)
				$s.=' '.$this->_dounderline($this->x+$dx, $this->y+.5*$h+.3*$this->FontSize, $txt);
			if($this->ColorFlag)
				$s.=' Q';
			if($link)
			{
				if($align=='FJ')
					$wlink=$wmax;
				else
					$wlink=$this->GetStringWidth($txt);
				$this->Link($this->x+$dx, $this->y+.5*$h-.5*$this->FontSize, $wlink, $this->FontSize, $link);
			}
		}
		if($s)
			$this->_out($s);
		if($align=='FJ')
		{
			//Remove word spacing
			$this->_out('0 Tw');
			$this->ws=0;
		}
		$this->lasth=$h;
		if($ln>0)
		{
			$this->y+=$h;
			if($ln==1)
				$this->x=$this->lMargin;
		}
		else
			$this->x+=$w;
	}

	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->CellFJ(204.3, $this->height, $text, "", 0, $align);
		$this->Cell(5, $this->height, "", "R", 0, 'C');
		$this->Ln();
	}
	
	function newLine(){
		$this->Ln();
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
function dateToString($date){
	if(empty($date)) return "";
	
	$monthname = array(0  => '-',
	                   1  => 'Januari',
	                   2  => 'Februari',
	                   3  => 'Maret',
	                   4  => 'April',
	                   5  => 'Mei',
	                   6  => 'Juni',
	                   7  => 'Juli',
	                   8  => 'Agustus',
	                   9  => 'September',
	                   10 => 'Oktober',
	                   11 => 'November',
	                   12 => 'Desember');    
	
	$pieces = explode('-', $date);
	
	return ($pieces[2]-1).' '.$monthname[(int)$pieces[1]].' '.$pieces[0];
}


// A function to return the Roman Numeral, given an integer
 function numberToRoman($num)
 {
     // Make sure that we only use the integer portion of the value
     $n = intval($num);
     $result = '';
 
     // Declare a lookup array that we will use to traverse the number:
     $lookup = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400,
     'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40,
     'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 
     foreach ($lookup as $roman => $value)
     {
         // Determine the number of matches
         $matches = intval($n / $value);
 
         // Store that many characters
         $result .= str_repeat($roman, $matches);
 
         // Substract that from the number
         $n = $n % $value;
     }
 
     // The Roman numeral should be built, return it
     return $result;
 }


$formulir = new FormCetak();
$no_urut=0;
foreach($data as $item){
	$formulir->PageCetak($item,$no_urut);
	$no_urut++;
}
$formulir->Output();

?>
