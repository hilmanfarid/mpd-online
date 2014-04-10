<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_rep_realisasi_harian_per_jenis_pajak.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$tahun					= CCGetFromGet("tahun", "");

$user				= CCGetUserLogin();
$data				= array();
$dbConn				= new clsDBConnSIKP();


class FormCetak extends FPDF {
	var $fontSize = 10;
	var $fontFam = 'Arial';
	var $yearId = 0;
	var $yearCode="";
	var $paperWSize = 330;
	var $paperHSize = 215;
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
		$this->startX = $this->paperWSize-72;
		$this->lengthCell = $this->startX+20;
	}
	/*
	function Header() {
		
	}
	*/
	
	function PageCetak($data, $user, $tahun, $tgl_penerimaan, $tgl_penerimaan_last, $cetak) {
		$param_arr = array();				
		$param_arr['p_year_period_id'] = CCGetFromGet('p_year_period_id');
		$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
		$param_arr['status'] = CCGetFromGet('status');

		$status_code = CCGetFromGet('status_code');

		$arrBatas = array();
		$arrBatas = $this->getBatasPembayaran($param_arr['p_year_period_id'], $param_arr['p_vat_type_id'], $param_arr['status']);
		//echo $arrBatas;
		//exit;		

		$dbConn = new clsDBConnSIKP();

		$this->AliasNbPages();
		$this->AddPage("L");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);

		$tahun 					= CCGetFromGet("tahun", "");
		$pajak 					= strtoupper(CCGetFromGet("pajak", ""));
		
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
		$this->Cell($lheader4, $this->height, "INDEX KEPATUHAN WAJIB PAJAK", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "TAHUN " . $tahun, "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, $pajak, "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$code = "";
		if ($param_arr['status'] == 1){
			$code = "PATUH";
		}else{
			if ($param_arr['status'] == 2){
				$code = " KURANG PATUH";
			}else{
				$code = " TIDAK PATUH";
			}
		}
		$this->Cell($lheader4, $this->height, "STATUS ".$code, "R", 0, 'C');
		
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "BR", 0, 'L');
		$this->Cell($lheader3, $this->height, "", "B", 0, 'L');
		$this->Cell($lheader1, $this->height, "", "BR", 0, 'L');
		$this->Ln();
		
		$ltable = $this->lengthCell / 26;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable22 = $ltable * 22;
		
		//besar
		$this->newLine();
		$this->Cell($lheader1, $this->height, "I. RANKING BESAR", "", 0, 'L');
		$this->newLine();
		$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable5+$ltable2, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "RATA-RATA TANGGAL BAYAR", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "RATA-RATA PEMBAYARAN", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom

		$query = "select * from f_rep_index_kepatuhan(".$param_arr['p_year_period_id'].", ".$param_arr['p_vat_type_id'].", ".$param_arr['status'].") where rata_rata_pembayaran > ".$arrBatas['batas_atas']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
		$dbConn->query($query);
		//echo $query;
		//exit;

		$no = 1;
		$this->SetWidths(array($ltable1, $ltable5+$ltable2, $ltable5, $ltable3, $ltable5, $ltable5));
		$this->SetAligns(array("C", "L", "L", "L", "R", "R"));
		
		
		while ($dbConn->next_record()) {
			//print data
			$this->RowMultiBorderWithHeight(array($no,
												  $dbConn->f('nama'),
												  $dbConn->f('alamat'),
												  $dbConn->f('npwpd'),
												  $dbConn->f('rata_rata_tgl_byr'),
												  $dbConn->f('rata_rata_pembayaran')),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
		}
		
		//menengah
		$this->Ln();
		$this->newLine();
		$this->Cell($lheader1, $this->height, "II. RANKING MENENGAH", "", 0, 'L');
		$this->newLine();
		$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable5+$ltable2, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "RATA-RATA TANGGAL BAYAR", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "RATA-RATA PEMBAYARAN", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom

		$query = "select * from f_rep_index_kepatuhan(".$param_arr['p_year_period_id'].", ".$param_arr['p_vat_type_id'].", ".$param_arr['status'].") where rata_rata_pembayaran <= ".$arrBatas['batas_atas']." and rata_rata_pembayaran >= ".$arrBatas['batas_tengah']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
		$dbConn->query($query);
		//echo $query;
		//exit;

		$no = 1;
		$this->SetWidths(array($ltable1, $ltable5+$ltable2, $ltable5, $ltable3, $ltable5, $ltable5));
		$this->SetAligns(array("C", "L", "L", "L", "R", "R"));
		
		
		while ($dbConn->next_record()) {
			//print data
			$this->RowMultiBorderWithHeight(array($no,
												  $dbConn->f('nama'),
												  $dbConn->f('alamat'),
												  $dbConn->f('npwpd'),
												  $dbConn->f('rata_rata_tgl_byr'),
												  $dbConn->f('rata_rata_pembayaran')),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
		}
		
		//kecil
		$this->Ln();
		$this->newLine();
		$this->Cell($lheader1, $this->height, "III. RANKING KECIL", "", 0, 'L');
		$this->newLine();
		$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable5+$ltable2, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "ALAMAT", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "RATA-RATA TANGGAL BAYAR", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "RATA-RATA PEMBAYARAN", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom

		$query = "select * from f_rep_index_kepatuhan(".$param_arr['p_year_period_id'].", ".$param_arr['p_vat_type_id'].", ".$param_arr['status'].") where rata_rata_pembayaran < ".$arrBatas['batas_tengah']." order by rata_rata_pembayaran desc, rata_rata_tgl_byr asc";
		$dbConn->query($query);
		//echo $query;
		//exit;

		$no = 1;
		$this->SetWidths(array($ltable1, $ltable5+$ltable2, $ltable5, $ltable3, $ltable5, $ltable5));
		$this->SetAligns(array("C", "L", "L", "L", "R", "R"));
		
		
		while ($dbConn->next_record()) {
			//print data
			$this->RowMultiBorderWithHeight(array($no,
												  $dbConn->f('nama'),
												  $dbConn->f('alamat'),
												  $dbConn->f('npwpd'),
												  $dbConn->f('rata_rata_tgl_byr'),
												  $dbConn->f('rata_rata_pembayaran')),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
		}
		
		$this->Ln();
		$this->newLine();
		$this->newLine();
		$this->newLine();
		
		$this->SetAligns(array("C", "C"));
		$this->SetWidths(array(180, 120));
		$this->RowMultiBorderWithHeight( array("","Bandung, " . date("d F Y")."\n\n\n\n\n\n\n\n(....................................)"), array("",""), 5 );
	
	    
		/*$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
		$this->Ln();
		$this->Cell($lbody3 - 10, $this->height, "", "", 0, 'L');*/
		//$this->Cell($lbody1 + 10, $this->height, "Bandung, " . date("d F Y")."\n\n\n\n\n(....................................)" /*. $data["tanggal"]*/, "", 0, 'C');
    }

	function getBatasPembayaran($p_year_period_id, $p_vat_type_id, $flag) {
		$dbConn = new clsDBConnSIKP();
		$jumlah_total = 0;
		$result = array();

		$query = "select max(rata_rata_pembayaran), max(rata_rata_pembayaran) / 3 , max(rata_rata_pembayaran) - (max(rata_rata_pembayaran) / 3) as batas_atas, max(rata_rata_pembayaran) - (max(rata_rata_pembayaran) / 3) - (max(rata_rata_pembayaran) / 3) batas_tengah from f_rep_index_kepatuhan(".$p_year_period_id.", ".$p_vat_type_id.", ".$flag.")";
		$dbConn->query($query);
		while ($dbConn->next_record()) {
			$result['batas_tengah'] = $dbConn->f('batas_tengah');
			$result['batas_atas'] = $dbConn->f('batas_atas');
		}
		//echo $query;
		//exit;
		$dbConn->close();
		return $result;
	}


	function newLine(){
		$this->Cell($this->lengthCell, $this->height, "", "", 0, 'L');
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
$formulir->PageCetak($data, $user, $tahun, $tgl_penerimaan, $tgl_penerimaan_last, $cetak );
$formulir->Output();
?>
