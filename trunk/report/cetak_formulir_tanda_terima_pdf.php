<?php
define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "cetak_formulir_tanda_terima_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$t_customer_order_id = CCGetFromGet("CURR_DOC_ID", "");
//$t_customer_order_id = 1;
$data = array();
$dbConn = new clsDBConnSIKP();

$query = "begin;";
$dbConn->query($query);
$query = "SELECT * from(
SELECT
	 b.code || decode(a.legal_doc_desc,null,'',' ('||a.legal_doc_desc||')') as doc_name, c.order_no,A.t_customer_order_id
FROM
	t_cust_order_legal_doc A,
	p_legal_doc_type b,
	t_customer_order C
WHERE
	A .p_legal_doc_type_id = b.p_legal_doc_type_id
AND A .t_customer_order_id = ".$t_customer_order_id."
AND C .t_customer_order_id = A .t_customer_order_id) base_doc
LEFT JOIN	t_cust_account cust_account ON cust_account.t_customer_order_id = base_doc.t_customer_order_id
";
$dbConn->query($query);
$i=0;
while ($dbConn->next_record()) {
	$data["doc_name"][$i] = $dbConn->f("doc_name");
	
	if($i==0){
		$data["order_no"] = $dbConn->f("order_no");
		$data["wp_name"] = $dbConn->f("wp_name");
		$data["address_name"] = $dbConn->f("address_name");
	}
	$i++;
}

$dbConn->query("end;");
$dbConn->close();
// var_dump($data);
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
        $this->startY = $this->GetY();
		$this->startX = $this->paperWSize-42;
		$this->lengthCell = $this->startX+20;
		$this->FormCetak();
	}
	/*
	function Header() {

	}
	*/

    function printIsi($jenis, $isi = "", $data = null) {
        $this->SetFont('Arial', '', 10);
        $kolom1 = ($this->lengthCell * 3) / 8;
		$kolom2 = ($this->lengthCell * 5) / 8;
        $this->Cell($kolom1, $this->height, "       ".$jenis, "L", 0, 'L');

        if (is_numeric($isi)) {
			if ($data === null) {
				$this->Cell($kolom2, $this->height, ":  .......................................................................................................", "R", 0, 'L');
				$this->Ln();
				if ($isi > 1) {
					for ($index = 0; $index < $isi-1; $index++)
					{
						$this->Cell($kolom1, $this->height, "", "L", 0, 'L');
						$this->Cell($kolom2, $this->height, "   .......................................................................................................", "R", 0, 'L');
						$this->Ln();
					}
					$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
				}
			} else{
				for($i = 0; $i < count($data); $i++){
					if($i == 0){
						$this->Cell($kolom2, $this->height, ":  " . $data[$i], "R", 0, "L");
					} else {
						$this->Cell($kolom1, $this->height, "", "L", 0, 'L');
						$this->Cell($kolom2, $this->height, "   " . $data[$i], "R", 0, "L");
					}
					
					$this->Ln();
				}
				$this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
			}
        } else {
            $this->Cell($kolom2, $this->height, ":  ".$isi, "R", 0, 'L');
        }
        $this->Ln();
    }

    function seEnter() {
        $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
        $this->Ln();
    }

	function PageCetak($data) {
		$this->AliasNbPages();
		$this->AddPage("P");
		$this->SetFont('Arial', '', 10);

		$lengthJudul1 = ($this->lengthCell * 3) / 9;
		$lengthJudul2 = ($this->lengthCell * 3) / 9;
		$lengthJudul3 = ($this->lengthCell * 3) / 9;
		$batas1 = ($lengthJudul3 * 2) / 5;
		$batas2 = ($lengthJudul3 * 3) / 5;

		$this->Image('../images/logo_pemda.png',15,20,25,25);

		$length1 = ($this->lengthCell * 2) / 9;
		$length2 = ($this->lengthCell * 4) / 9;
		$length3 = ($this->lengthCell * 3) / 9;
		$kolom1 = ($length3 * 1) / 10;
		$kolom2 = ($length3 * 1) / 10;
		$kolom3 = ($length3 * 1) / 10;
		$kolom4 = ($length3 * 1) / 10;
		$kolom5 = ($length3 * 1) / 10;
		$kolom6 = ($length3 * 1) / 10;
		$kolom7 = ($length3 * 1) / 10;
		$kolom8 = ($length3 * 1) / 10;
		$penutup  = ($length3 * 2) / 10;

		$this->SetFont('Arial', '', 8);
		$this->Cell($length1, $this->height-4, "", "TL", 0, 'C');
		$this->Cell($length2, $this->height-4, "", "T", 0, 'C');
		$this->Cell($length3, $this->height-4, "", "TR", 0, 'L');
		$this->Ln();
        $this->seEnter();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "PEMERINTAH KOTA BANDUNG", 0, 0, 'C');
		$this->Cell($length3, $this->height, "  Nomor Formulir", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "DINAS PELAYANAN PAJAK", 0, 0, 'C');

		//nomor formulir
		$arr1 = str_split($data["order_no"]);
		$this->Cell($kolom1, $this->height, $arr1[0], 1, 0, 'C');
		$this->Cell($kolom2, $this->height, $arr1[1], 1, 0, 'C');
		$this->Cell($kolom3, $this->height, $arr1[2], 1, 0, 'C');
		$this->Cell($kolom4, $this->height, $arr1[3], 1, 0, 'C');
		$this->Cell($kolom5, $this->height, $arr1[4], 1, 0, 'C');
		$this->Cell($kolom6, $this->height, $arr1[5], 1, 0, 'C');
		$this->Cell($kolom7, $this->height, $arr1[6], 1, 0, 'C');
		$this->Cell($kolom8, $this->height, $arr1[7], 1, 0, 'C');
		$this->Cell($penutup, $this->height, "", "R", 0, 'C');
		//================
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "Jl. Wastukancana No. 2", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "Telp. (022) 4235052", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "Fax (022) 4208604", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height, "", "L", 0, 'C');
		$this->Cell($length2, $this->height, "BANDUNG", 0, 0, 'C');
		$this->Cell($length3, $this->height, "", "R", 0, 'L');
		$this->Ln();
		$this->Cell($length1, $this->height-4, "", "L", 0, 'C');
		$this->Cell($length2, $this->height-4, "", "", 0, 'C');
		$this->Cell($length3, $this->height-4, "", "R", 0, 'L');
		$this->Ln();

        //-------------- TANDA TERIMA
		$this->SetFont('Arial', 'BU', 12);
        $this->Cell($this->lengthCell, $this->height, "", "LR", 0, 'C');
        $this->Ln();
		$this->Cell($this->lengthCell, $this->height, "TANDA TERIMA", "LR", 0, 'C');
		$this->Ln();
        $this->seEnter();

        //--------------- ISI
        //$this->printIsi('Nama', 2);
        //$this->printIsi('Alamat', 3, $data);
	   	$this->SetFont('Arial', '', 10);
		$kolom1 = ($this->lengthCell * 3) / 8;
		$kolom2 = ($this->lengthCell * 5) / 8;
		$this->SetWidths(array($kolom1, $kolom2));
		$this->SetAligns(array("L", "L"));
		if(empty($data["wp_name"])){
			$this->printIsi('Nama', 2);
		}else{
	   		$this->RowMultiBorderWithHeight(array("       "."Nama",
											  ":  ".$data["wp_name"])
											  ,
										array('L',
										      'R')
											  ,$this->height*2);
		
	   	}
		if(empty($data["address_name"])){
			$this->printIsi('Alamat', 2);
		}else{
	   	$this->RowMultiBorderWithHeight(array("       "."Alamat",
											  ":  ".$data["address_name"])
											  ,
										array('L',
										      'R')
											  ,$this->height*2);
		
		}
		/*
        $this->printIsi('Telah Menerima', 4, $data);
		*/
		$kolom1 = ($this->lengthCell * 3) / 8;
		$kolom2 = ($this->lengthCell * 5) / 8;
		$this->SetWidths(array($kolom1, $kolom2));
		$this->SetAligns(array("L", "L"));
		for ($i=0; $i<count($data['doc_name']); $i++) {
			if($i==0){
				$this->RowMultiBorderWithHeight(array("       "."Dokumen",
													  ":  - ".$data["doc_name"][$i])
													  ,
												array('L',
												      'R')
													  ,$this->height*1.5);
			}else{
				$this->RowMultiBorderWithHeight(array("",
													  "   - ".$data["doc_name"][$i])
													  ,
												array('L',
												      'R')
													  ,$this->height*1.5);
			}
		}
		
        $this->seEnter();
        $this->seEnter();
        $this->seEnter();

        //---------------- TTD
        $ttdKolom1 = ($this->lengthCell * 5) / 8;
        $ttdKolom2 = ($this->lengthCell * 3) / 8;
        $this->cell($ttdKolom1, $this->height, '', 'L', 0,'L');
        $this->cell($ttdKolom2, $this->height, 'Bandung, '. date('d F Y').'           ', 'R', 0,'R');
        $this->Ln();
        $this->cell($ttdKolom1, $this->height, '', 'L', 0,'C');
        $this->cell($ttdKolom2, $this->height, '    Yang Menerima', 'R', 0,'C');
        $this->Ln();
        $this->seEnter();
        $this->seEnter();
        $this->seEnter();
        $this->seEnter();
        $this->seEnter();
        $this->seEnter();
        $this->cell($ttdKolom1, $this->height, '', 'L', 0,'C');
        $this->cell($ttdKolom2, $this->height, '(...................................................)', 'R', 0,'C');
        $this->Ln();
        $this->seEnter();
        $this->cell($this->lengthCell, $this->height, '', 'LBR', 0,'C');
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
$formulir->Output("","I");
// phpinfo();
?>
