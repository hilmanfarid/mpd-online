<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_surat_peringatan_pdf.php");
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
		
		$lkepada = $this->lengthCell / 5;
		$lkepada2 = $lkepada * 2;
		$lkepada3 = $lkepada * 3;

		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Kepada Yth,", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "", "R", 0, 'L');
		$this->Ln();
		
		$this->Cell($lkepada3, $this->height, "", "L", 0, 'L');
		$this->Cell($lkepada2, $this->height, "Di ", "R", 0, 'L');
		$this->newLine();
		
		$this->SetFont('Arial', 'UB', 10);
		$this->Cell($this->lengthCell, $this->height, "S U R A T  P E R I N G A T A N", "LR", 0, 'C');
		$this->Ln();
		
		$this->SetFont('Arial', '', 10);
		$this->Cell($this->lengthCell, $this->height, "Nomor: ", "LR", 0, 'C');
		$this->newLine();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "Berdasarkan pembukuan pada Dinas Pelayanan Pajak Kota Bandung, ternyata utang Pajak Saudara sampai", "", 0, 'J');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "saat ini belum disetor.", "", 0, 'J');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "Sebelum berakhirnya batas waktu penyetoran pajak sebagaimana dinyatakan pada Surat Ketetapan Pajak", "", 0, 'J');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "Daerah Kurang Bayar (SKPDKB), Saudara diminta segera menyetorkan Pajak Hotel ke Kas Daerah.", "", 0, 'J');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		
		$this->newLine();
		
		$lbodyx = $this->lengthCell / 8;
		$lbodyx1 = $lbodyx * 1;
		$lbodyx2 = $lbodyx * 2;
		$lbodyx3 = $lbodyx * 3;
		$lbodyx4 = $lbodyx * 4;
		$lbodyx5 = $lbodyx * 5;
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($lbodyx2, $this->height, "Jumlah utang Jenis Pajak", "", 0, 'L');
		$this->Cell($lbodyx1, $this->height, "Restoran", "", 0, 'C');
		$this->Cell($lbodyx5 - 20, $this->height, "Saudara, berdasarkan Surat Ketetapan Pajak Daerah Kurang", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($lbodyx3, $this->height, "Bayar yang telah diterima dengan Nomor", "", 0, 'L');
		$this->Cell($lbodyx1, $this->height, "123456789", "", 0, 'C');
		$this->Cell($lbodyx1, $this->height, "adalah  sebesar Rp", "", 0, 'L');
		$this->Cell($lbodyx3 - 20, $this->height, "15.563.000", "", 0, 'C');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "(Lima Belas Juta Lima Ratus Enam Puluh Tiga Ribu Rupiah)", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "Masa Pajak 2013", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "Apabila Saudara masih memerlukan penjelasan lebih lanjut maka saudara menghadap ke Dinas Pelayanan Pajak", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "pada jam kerja.", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->newLine();

		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "Demikian Surat Peringatan ini disampaikan, agar menjadi perhatian Saudara dan dapat dilaksanakan", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell(10, $this->height, "", "L", 0, 'C');
		$this->Cell($this->lengthCell - 20, $this->height, "sebagaimana mestinya.", "", 0, 'L');
		$this->Cell(10, $this->height, "", "R", 0, 'C');
		$this->Ln();

		$lbody = $this->lengthCell / 16;
		$lbody1 = $lbody * 1;
		$lbody2 = $lbody * 2;
		$lbody3 = $lbody * 3;
		$lbody4 = $lbody * 4;
		$lbody5 = $lbody * 5;
		$lbody7 = $lbody * 7;
		$lbody9 = $lbody * 9;

		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "Bandung, " . date("d F Y") /*. $data["tanggal"]*/, "", 0, 'C');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "Petugas,", "", 0, 'C');
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
		$this->Cell($lbody4 - 2, $this->height, "", "T", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "NIP. " . $data["nip_kadin"], "T", 0, 'L'); //isi nip
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4, $this->height, "Penerima,", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
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
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		
		$this->Cell($lbody2, $this->height, "", "L", 0, 'C');
		$this->Cell($lbody4 - 2, $this->height, "", "T", 0, 'L');
		$this->Cell(2, $this->height, "", "", 0, 'L');
		$this->Cell($lbody4, $this->height, "", "", 0, 'C');
		$this->Cell($lbody4, $this->height, "", "", 0, 'L');
		$this->Cell($lbody2, $this->height, "", "R", 0, 'C');
		$this->Ln();
		
		$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'L');
		$this->Ln();
		$this->Cell($this->lengthCell, $this->height, "", "LBR", 0, 'L');
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
