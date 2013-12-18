<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_paksa_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

// $custId = CCGetFromGet("t_customer_order_id", "");
$custId = 7;
$data = array();
// $dataArr = array();
// $dataBaru = array();

/*
$dbConn = new clsDBConnSIKP();

$query="select a.order_no ,
       c.company_name ||'('||c.company_brand||')' as nama ,
       c.address_name ||' no. '|| c.address_no as alamat,
       c.npwd,
       'SPTPD' as dasar_setoran ,
       e.code as masa_pajak,
       to_char(e.start_date,'YYYY') as tahun,
       d.receipt_no as no_urut ,
       f.code as ayat ,
       f.vat_code as jenis_pajak,
       b.total_vat_amount as jumlah,
	   replace(f_terbilang(to_char(round(b.total_vat_amount)),'IDR'), '  ', ' ') as dengan_huruf
from t_customer_order a,
     t_vat_setllement b,
     t_cust_account c ,
     t_payment_receipt d,
     p_finance_period e ,
     p_vat_type f
where a.t_customer_order_id = b.t_customer_order_id 
      and b.t_cust_account_id = c.t_cust_account_id 
      and b.t_vat_setllement_id = d.t_vat_setllement_id (+) 
      and b.p_finance_period_id = e.p_finance_period_id
      and c.p_vat_type_id = f.p_vat_type_id
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
		$data["jenis_pajak"] = $dbConn->f("jenis_pajak");
		$data["jumlah"] = $dbConn->f("jumlah");
		$data["dengan_huruf"] = $dbConn->f("dengan_huruf");
		$data["tahun"] = $dbConn->f("tahun");
}

	//nip & nama
	$ttd = "SELECT value as nama_kadin, value_2 as nip_kadin "
		  ."FROM p_global_param "
		  ."WHERE code = 'TTD KADIN'";
		  
	$dbConn->query($ttd);
	while($dbConn->next_record()){
		$data["nama_kadin"] = $dbConn->f("nama_kadin");
		$data["nip_kadin"] = $dbConn->f("nip_kadin");
	}
	
$dbConn->close();
*/

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
	
	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',25,12,25,25);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader * 2;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		$lheader7 = $lheader * 7;
		
		$this->Cell($lheader1, $this->height, "", "LT", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "TR", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 10);
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height, "PEMERINTAH KOTA BANDUNG", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', 'B', 14);
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($lheader1, $this->height + 3, "", "L", 0, 'L');
		$this->Cell($lheader7, $this->height + 3, "Jalan Wastukancana No. 2 Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lheader1, $this->height, "", "LB", 0, 'L');
		$this->Cell($lheader7, $this->height, "", "BR", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->SetFont('Arial', 'UB', 12);
		$this->Cell($this->lengthCell, $this->height, "S U R A T  -  P A K S A", "LR", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "Nomor: ", "LR", 0, 'C');
		$this->newLine();
		
		$this->tulis("DEMI KEADILAN BERDASARKAN KETUHANAN YANG MAHA ESA", "C");
		
		$lbody = $this->lengthCell / 4;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		// Nama Wajib Pajak
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1, $this->height, "Nama Wajib Pajak/", "", 0, 'L');
		$this->Cell($lbody3 - 20, $this->height, ": " . $data["nama"], "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1, $this->height, "Penanggung Pajak", "", 0, 'L');
		$this->Cell($lbody3 - 20, $this->height, "", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		// NPWPD
		$this->Cell(10, $this->height + 2, "", "L", 0, 'L');
		$this->Cell($lbody1, $this->height + 2, "NPWD", "", 0, 'L');
		$this->Cell($lbody3 - 20, $this->height + 2, ":", "", 0, 'L');
		$this->Cell(10, $this->height + 2, "", "R", 0, 'L');
		$this->Ln($this->height - 4);
		
		$this->Cell(10, $this->height, "", "", 0, 'L');
		$this->Cell($lbody1 + 3, $this->height, "", "", 0, 'L');
		$rep_npwd = str_replace(".", "", $data["npwd"]);
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
		$this->Ln();

		// Alamat
		$this->Cell(10, $this->height, "", "L", 0, 'L');
		$this->Cell($lbody1, $this->height, "Alamat", "", 0, 'L');
		$this->Cell($lbody3 - 20, $this->height, ": " . $data["alamat"], "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		// Baris atas
		$this->tulis("Menunggak Pajak sebagaimana tercantum dibawah ini:", "L");
		$ltable = $this->lengthCell / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;
		
		$this->SetWidths(array(5, $ltable2, $ltable1, $ltable6, $ltable1 + $ltable2 - 10, $ltable2, 5));
		$this->SetAligns(array("L", "C", "C", "C", "C", "C", "L"));
		
		$this->RowMultiBorderWithHeight(
			array("",
				"Jenis Pajak",
				"Tahun Pajak",
				"Nomor dan Tanggal  SKPDKB, SKPDKBT, STPD, Keputusan Keberatan, Keputusan Pembetulan, Keputusan  Banding*)",
				"Tanggal Jatuh Tempo",
				"Jumlah Tunggakan (Rp)",
				""
			),
			array("LR",
				"TBLR",
				"TBLR",
				"TBLR",
				"TBLR",
				"TBLR",
				"LR"
			),
			$this->height
		);
		
		// Baris bawah
		$ltable = $this->lengthCell / 14;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable6 = $ltable * 6;
		$ltable4 = $ltable * 4;
		
		$this->SetWidths(array(5, $ltable6 * 2 - 10, $ltable2, 5));
		$this->SetAligns(array("L", "C", "C", "L"));
		
		$this->RowMultiBorderWithHeight(
			array("",
				"Jumlah",
				"",
				""
			),
			array("LR",
				"TBLR",
				"TBLR",
				"LR"
			),
			$this->height
		);
		
		// Teks
		$this->tulis("Dengan ini:", "L");
		$this->tulis("1. Memerintahkan Wajib Pajak/Penanggung Pajak untuk membayar jumlah tunggakkan pajak tersebut", "L");
		$this->tulis("ke Kas Daerah ditambah dengan biaya-biaya penagihan dalam waktu 2 x 24 Jam setelah pemberitahuan", "L");
		$this->tulis("Surat Paksa ini.", "L");
		$this->tulis("2. Memerintahkan kepada Juru Sita Pajak yang melaksanakan Surat Paksa ini untuk melanjutkan", "L");
		$this->tulis("pelaksanaan Surat Paksa dengan melaksanakan penyitaan atas barang-barang milik Wajib Pajak/Penanggung", "L");
		$this->tulis("Pajak.", "L");
		
		$lbody = $this->lengthCell / 16;
		$lbody2 = $lbody * 2;
		$lbody4 = $lbody * 4;

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, ",", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "KEPALA DINAS PELAYANAN PAJAK", "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "KOTA BANDUNG", "", 0, 'C');
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
		$this->Cell($lbody4 - 2, $this->height, "", "", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, $data["nama_kadin"], "", 0, 'C'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. " . $data["nip_kadin"], "T", 0, 'L'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->tulis("Catatan", "L");
		$this->tulis("- Jumlah Tunggakan tersebut belum termasuk denda", "L");
		
		$this->Cell($this->lengthCell, $this->height, "", "LBR", 0, 'L');
	}
	
	function tulis($text, $align){
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, $text, "", 0, $align);
		$this->Cell(10, $this->height, "", "R", 0, 'C');
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

$formulir = new FormCetak();
$formulir->PageCetak($data);
$formulir->Output();

?>
