<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_lap_harian_teller.php");
include_once(RelativePath . "/Common.php");
// include_once("../include/fpdf.php");
require("../include/qrcode/fpdf17/fpdf.php");

$tgl_penerimaan = CCGetFromGet('tgl_penerimaan');
$nama_teller = CCGetFromGet('nama_teller');
$param_arr = array();
$param_arr['tgl_penerimaan'] = CCGetFromGet('tgl_penerimaan');
$param_arr['nama_teller'] = CCGetFromGet('nama_teller');
		
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
	
	function PageCetak($param_arr) {
		
		$dbConn = new clsDBConnSIKP();

		$this->AliasNbPages();
		$this->AddPage("L");
		$this->SetFont('Arial', '', 10);
		
		$this->Image('../images/logo_pemda.png',15,13,25,25);

				
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
		$this->Cell($lheader4, $this->height, "LAPORAN HARIAN TELLER", "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "DINAS PELAYANAN PAJAK", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "TANGGAL : ".$param_arr['tgl_penerimaan'], "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Jalan Wastukancana no. 2", "R", 0, 'C');
		$this->Cell($lheader4, $this->height, "USER TELLER : ".$param_arr['nama_teller'], "R", 0, 'C');
		$this->Ln();
		$this->Cell($lheader1, $this->height, "", "L", 0, 'L');
		$this->Cell($lheader3, $this->height, "Telp. 022. 4235052 - Bandung", "R", 0, 'C');
		
		$this->Cell($lheader4, $this->height, "", "R", 0, 'C');
		//$this->Cell($lheader4, $this->height, "STATUS ".$code, "R", 0, 'C');
		
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
		$this->Cell($ltable1, $this->height + 2, "NO.", "TBLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, "NAMA WP", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NPWPD", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "TGL BAYAR", "TBLR", 0, 'C');
		$this->Cell($ltable4, $this->height + 2, "PERIODE", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "AYAT PAJAK", "TBLR", 0, 'C');
		$this->Cell($ltable2, $this->height + 2, "NO KOHIR", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NILAI DENDA", "TBLR", 0, 'C');
		$this->Cell($ltable3, $this->height + 2, "NILAI PAJAK", "TBLR", 0, 'C');
		$this->Ln();

		//isi kolom

		$query = "SELECT f.t_payment_receipt_id, f.p_cg_terminal_id, f.npwd, d.wp_name, f.receipt_no, f.payment_date, 
					a.no_kohir, f.finance_period_code, f.payment_amount, f.payment_vat_amount,
						c.vat_code as ayat_pajak
						FROM t_payment_receipt f, t_vat_setllement a, p_vat_type_dtl c, t_cust_account d
						WHERE 
						f.t_vat_setllement_id = a.t_vat_setllement_id AND
						f.p_vat_type_dtl_id = c.p_vat_type_dtl_id AND
						a.t_cust_account_id = d.t_cust_account_id AND
						( upper(f.p_cg_terminal_id) LIKE upper('%".$param_arr['nama_teller']."%')
						) 
						AND trunc(f.payment_date) = '".$param_arr['tgl_penerimaan']."'
						ORDER BY c.vat_code ASC, f.payment_date DESC";
        $dbConn->query($query);

			
		$this->SetWidths(array($ltable1, $ltable4, $ltable3, $ltable3, $ltable4, $ltable3, $ltable2, $ltable3, $ltable3));
		$this->SetAligns(array("C", "L", "L", "C", "L", "L", "C", "R", "R"));
		
		$data = array();
		while ($dbConn->next_record()) {
		    
		    $data["t_payment_receipt_id"][]= $dbConn->f("t_payment_receipt_id");
		    $data["p_cg_terminal_id"][] = $dbConn->f("p_cg_terminal_id");
		    $data["npwd"][] = $dbConn->f("npwd");
		    $data["wp_name"][] = $dbConn->f("wp_name");
		    $data["receipt_no"][] = $dbConn->f("receipt_no");
		    $data["payment_date"][] = $dbConn->f("payment_date");
		    $data["no_kohir"][] = $dbConn->f("no_kohir");
		    $data["finance_period_code"][] = $dbConn->f("finance_period_code");
		    $data["payment_vat_amount"][] = $dbConn->f("payment_vat_amount");
		    $data["denda"][] = ($dbConn->f("payment_amount")-$dbConn->f("payment_vat_amount"));
		    $data["ayat_pajak"][] = $dbConn->f("ayat_pajak");
		
			
		}
	    
	    $no = 1;
		$total_payment = 0;
	    $total_denda = 0;
	    $ayat_pajak = $data['ayat_pajak'][0];
	    
	    $total_per_ayat = 0;
	    $total_denda_per_ayat = 0;
	    
	    for($i = 0; $i < count($data['t_payment_receipt_id']); $i++) {

		    $total_payment += $data['payment_vat_amount'][$i];
		    $total_denda += $data['denda'][$i];

    		if($ayat_pajak != $data['ayat_pajak'][$i]) {
                $this->SetWidths(array($ltable1+$ltable4+$ltable3+$ltable3+$ltable4+$ltable3+$ltable2, $ltable3, $ltable3));
		        $this->SetAligns(array("C", "R", "R"));      
    			$this->SetFont('Arial', 'B', 10);
    			$this->RowMultiBorderWithHeight(array('TOTAL '.$ayat_pajak,
												  'Rp. '.number_format($total_denda_per_ayat, 0, ',', '.'),
												  'Rp. '.number_format($total_per_ayat, 0, ',', '.')
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
												  
    			$this->SetFont('Arial', '', 10);
    			$this->SetWidths(array($ltable1, $ltable4, $ltable3, $ltable3, $ltable4, $ltable3, $ltable2, $ltable3, $ltable3));
		        $this->SetAligns(array("C", "L", "L", "C", "L", "L", "C", "R", "R"));
		        
		        $this->RowMultiBorderWithHeight(array($no,
												  $data["wp_name"][$i],
												  $data["npwd"][$i],
												  $data["payment_date"][$i],
												  $data["finance_period_code"][$i],
												  $data["ayat_pajak"][$i],
												  $data["no_kohir"][$i],
												  number_format($data["denda"][$i], 0, ',', '.'),
												  number_format($data["payment_vat_amount"][$i], 0, ',', '.')
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
    			
    			$ayat_pajak = $data['ayat_pajak'][$i];
    			$total_per_ayat = 0;
    			$total_denda_per_ayat = 0;
    
    			$total_per_ayat += $data['payment_vat_amount'][$i];
    			$total_denda_per_ayat += $data['denda'][$i];
    			
    		}else {
    
    			$total_per_ayat += $data['payment_vat_amount'][$i];
    			$total_denda_per_ayat += $data['denda'][$i];
                
                $this->SetFont('Arial', '', 10);
                $this->SetWidths(array($ltable1, $ltable4, $ltable3, $ltable3, $ltable4, $ltable3, $ltable2, $ltable3, $ltable3));
		        $this->SetAligns(array("C", "L", "L", "C", "L", "L", "C", "R", "R"));
		        $this->RowMultiBorderWithHeight(array($no,
												  $data["wp_name"][$i],
												  $data["npwd"][$i],
												  $data["payment_date"][$i],
												  $data["finance_period_code"][$i],
												  $data["ayat_pajak"][$i],
												  $data["no_kohir"][$i],
												  number_format($data["denda"][$i], 0, ',', '.'),
												  number_format($data["payment_vat_amount"][$i], 0, ',', '.')
												  ),
											array('TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR',
												  'TBLR')
												  ,$this->height);
												  
    		}
    		
    		$no++;
	    }	
	    
	    $this->SetWidths(array($ltable1+$ltable4+$ltable3+$ltable3+$ltable4+$ltable3+$ltable2, $ltable3, $ltable3));
		$this->SetAligns(array("C", "R", "R"));                
    	
    	$this->SetFont('Arial', 'B', 10);
    	$this->RowMultiBorderWithHeight(array('TOTAL '.$ayat_pajak,
										  'Rp. '.number_format($total_denda_per_ayat, 0, ',', '.'),
										  'Rp. '.number_format($total_per_ayat, 0, ',', '.')
										  ),
									array('TBLR',
										  'TBLR',
										  'TBLR')
										  ,$this->height);
	    
	    $this->RowMultiBorderWithHeight(array('TOTAL',
										  'Rp. '.number_format($total_denda, 0, ',', '.'),
										  'Rp. '.number_format($total_payment, 0, ',', '.')
										  ),
									array('TBLR',
										  'TBLR',
										  'TBLR')
										  ,$this->height);
										  
		$this->SetFont('Arial', '', 10);
		$this->Ln();
        $this->Ln();
        
		$this->SetAligns(array("C", "C"));
		$this->SetWidths(array(180, 120));
		$this->RowMultiBorderWithHeight( array("","Bandung, " . date("d F Y")."\n\n\n\n\n\n\n\n(....................................)"), array("",""), 5 );
	
	    
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
$formulir->PageCetak($param_arr);
$formulir->Output();
?>
