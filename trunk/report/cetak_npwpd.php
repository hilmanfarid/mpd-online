<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_npwpd.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$npwpd		= CCGetFromGet("npwpd", "");
$p_awal_period	= CCGetFromGet("p_finance_period_id", "");
$p_akhir_period		= CCGetFromGet("p_finance_period_id1", "");

$data				= array();
$dbConn				= new clsDBConnSIKP(); 
$query = "Select c.npwd , 
        	   a.t_vat_setllement_id,	
        	   c.t_cust_account_id,
               c.company_name, 
               b.code as Periode_pelaporan, 
               to_char(a.settlement_date,'DD-MON-YYYY') tgl_pelaporan, 
               a.total_trans_amount as total_transaksi,
               a.total_vat_amount as total_pajak ,
        	   a.total_penalty_amount as total_denda,
               d.receipt_no as kuitansi_pembayaran,
               to_char(payment_date,'DD-MON-YYYY HH24:MI:SS') tgl_pembayaran ,
               d.payment_amount,
               c.t_cust_account_id ,
               b.p_finance_period_id ,
               to_char(b.start_date,'DD-MON-YYYY') as periode_awal_laporan,
               to_char(b.end_date,'DD-MON-YYYY') as periode_akhir_laporan,
        	   e.code as type_code
        from t_vat_setllement a ,
             p_finance_period b,
             t_cust_account c,
             t_payment_receipt d,
        	 p_settlement_type e
        where a.p_finance_period_id = b.p_finance_period_id
              and a.t_cust_account_id = c.t_cust_account_id
        	  and a.npwd='$npwpd'
			  and b.start_date >= (select start_date from p_finance_period where p_finance_period_id = $p_awal_period )
              and b.end_date <= (select end_date from p_finance_period where p_finance_period_id = $p_akhir_period )
			  and a.t_vat_setllement_id = d.t_vat_setllement_id (+) 
        	  and a.p_settlement_type_id = e.p_settlement_type_id 
			  order by b.start_date desc";
$dbConn->query($query);

while ($dbConn->next_record()) {
	$data[]= array(
	"company_name"	=> $dbConn->f("company_name"),
	"periode_awal_laporan"		=> $dbConn->f("periode_awal_laporan"),
	"periode_akhir_laporan"		=> $dbConn->f("periode_akhir_laporan"),
	"tgl_pelaporan"	=> $dbConn->f("tgl_pelaporan"),
	"total_pajak"		=> $dbConn->f("total_pajak"),
	"kuitansi_pembayaran"		=> $dbConn->f("kuitansi_pembayaran"),
	"type_code" => $dbConn->f("type_code")
	);
}
$dbConn->close();


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
	
	function PageCetak($data, $user, $tahun, $tgl_penerimaan, $tgl_penerimaan_last, $npwpd) {
		$this->AliasNbPages();
		$this->AddPage("L");
		$this->SetFont('Arial', 'B', 12);
		
		$lheader = $this->lengthCell / 8;
		$lheader1 = $lheader * 1;
		$lheader2 = $lheader-15;
		$lheader3 = $lheader * 3;
		$lheader4 = $lheader * 4;
		
		$dbConn				= new clsDBConnSIKP(); 
        $query = "SELECT a.*,
                    c.region_name AS nama_kota,
                    d.region_name AS nama_kecamatan,
                    e.region_name AS nama_kelurahan
                    FROM t_cust_account a
                    LEFT JOIN p_region c ON a.brand_p_region_id = c.p_region_id
                    LEFT JOIN p_region d ON a.brand_p_region_id_kec = d.p_region_id
                    LEFT JOIN p_region e ON a.brand_p_region_id_kel = e.p_region_id
                    where a.npwd = '".$npwpd."'";
        $dbConn->query($query);
        
        $alamat = '';
        while ($dbConn->next_record()) {
        	$alamat = $dbConn->f("brand_address_name")." .No ". $dbConn->f("brand_address_no")." RT/RW: ".$dbConn->f("brand_address_rt")."/".$dbConn->f("brand_address_rw"). ". KEC.".$dbConn->f("nama_kecamatan")." KEL.".$dbConn->f("nama_kelurahan");
        }
        $dbConn->close();
        
        
		$this->Cell($lheader2, $this->height, "NPWPD :");
		$this->Cell($lheader1, $this->height, $npwpd);
		$this->Ln();
		$this->Cell($lheader2, $this->height, "Alamat :");
		$this->Cell($lheader1, $this->height, $alamat);
		$this->SetFont('Arial', '', 10);
		$this->Ln();
		$this->Ln();
		
		$ltable = $this->lengthCell / 26;
		$ltable1 = $ltable * 1;
		$ltable2 = $ltable * 2;
		$ltable3 = $ltable * 3;
		$ltable4 = $ltable * 4;
		$ltable5 = $ltable * 5;
		$ltable6 = $ltable * 6;
		$ltable7 = $ltable * 7;
		$ltable8 = $ltable * 8;
		
		$this->Cell($ltable4, $this->height + 2, "NAMA BADAN", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "JENIS KETETAPAN", "TBLR", 0, 'C');
		$this->Cell($ltable6, $this->height + 2, "PERIODE TRANSAKSI", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "TGL PELAPORAN", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "TOTAL PAJAK", "TBLR", 0, 'C');
		$this->Cell($ltable5, $this->height + 2, "NO. KWITANSI", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom
		$this->SetWidths(array($ltable4, $ltable3, $ltable6, $ltable3, $ltable3, $ltable5));
		$this->SetAligns(array("L", "C", "C","C", "R", "L"));
		$no = 1;
		$jumlahperayat = array();
		$jumlahperwaktu = array();
		$jumlahtemp = 0;
		$i=0;
		$total=0;
		foreach($data as $item) {
			//print data
			$this->RowMultiBorderWithHeight(array(
												  $item["company_name"],
												  $item["type_code"],
												  $item["periode_awal_laporan"]." s.d ".$item["periode_akhir_laporan"],
												  $item["tgl_pelaporan"],
												  number_format($item["total_pajak"], 0, ',', '.'),
												  $item["kuitansi_pembayaran"],
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
			$no++;
				
			}
			
		
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
$formulir->PageCetak($data, $user, $tahun, $tgl_penerimaan, $tgl_penerimaan_last, $npwpd);
$formulir->Output();
?>
