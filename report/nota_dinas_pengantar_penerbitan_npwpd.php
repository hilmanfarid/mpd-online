<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "nota_dinas_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$dbConn = new clsDBConnSIKP();

$data = array();

$param_arr['p_vat_type_id'] = CCGetFromGet('p_vat_type_id');
$param_arr['date_start_laporan'] = CCGetFromGet('date_start_laporan');
$param_arr['date_end_laporan'] = CCGetFromGet('date_end_laporan');
$param_arr['nilai'] = CCGetFromGet('nilai');
$tgl = CCGetFromGet("tgl", "");

if (empty($param_arr['date_start_laporan']) && empty($param_arr['date_end_laporan']) && empty($param_arr['nilai'])) {
    echo "Data Tidak Ditemukan";
    exit;
}else {
    $sql = "SELECT COUNT (*)as jumlah , RTRIM(f_eja(COUNT (*)::VARCHAR)) as huruf
			FROM t_vat_registration a 
			left join p_vat_type_dtl b on a.p_vat_type_dtl_id=b.p_vat_type_dtl_id  
			left join t_customer_order c on a.t_customer_order_id = c. t_customer_order_id
			where trunc(a.creation_date) BETWEEN to_date('".$param_arr['date_start_laporan']."','dd-mm-yyyy') 
				and to_date('".$param_arr['date_end_laporan']."','dd-mm-yyyy')
			and case when ".$param_arr['p_vat_type_id']."=0 then true
					else a.p_vat_type_dtl_id in (select p_vat_type_dtl_id from p_vat_type_dtl where p_vat_type_id =".$param_arr['p_vat_type_id'].")
				end 
			and case when ".$param_arr['nilai']."=0 then true
					else c.p_order_status_id = ".$param_arr['nilai']."
				end ";

    $dbConn->query($sql);
    while ($dbConn->next_record()) {
        $data["jumlah"] = $dbConn->f("jumlah");
        $data["huruf"] = $dbConn->f("huruf");
    }
	$dbConn->close();
}

class FormCetak extends FPDF {

    var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode = "";
    var $paperWSize = 210;
    var $paperHSize = 297;
    var $height = 6;
    var $currX;
    var $currY;
    var $widths;
    var $aligns;

    function FormCetak() {
        //paper size diubah ke inchi: 203.2 = 8 inchi; 330.2 = 13 inchi.
        $this->FPDF();
    }

    function __construct() {
        $this->FormCetak();
    }

    /*
      function Header() {

      }
     */

    function PageCetak($data) {
        $this->AliasNbPages();
        $this->AddPage("P");
        $startY = $this->GetY();
        $startX = $this->paperWSize - 50;
        $lengthCell = $startX + 20;
        $this->SetFont('Arial', '', 10);

        $lengthJudul1 = ($lengthCell * 1) / 6;
        $lengthJudul2 = ($lengthCell * 5) / 6;

        $this->Image('../images/logo_pemda.png', 15, 14, 25, 25);
        // $this->Cell($lengthCell, $this->height, "2.	BENTUK SURAT PEMBERITAHUAN PAJAK DAERAH UNTUK PAJAK HIBURAN", 0, 0, 'L');
        // $this->Ln(6);
        $this->Ln(6);
        $this->SetFont('Times', 'B', 12);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "PEMERINTAH KOTA BANDUNG", "", 0, 'C');
        $this->Ln(10);
        $this->SetFont('Times', 'B', 22);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
        $this->Ln(8);
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "Jalan Wastukancana Nomor 2 Bandung", "", 0, 'C');
		$this->Ln(5);
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "", "B", 0, 'C');
		$this->Cell($lengthJudul2, $this->height, "Telp: (022)4232338 Faxs:(022)4236150", "B", 0, 'C');

        $this->Ln(10);
        $this->SetFont('Times', 'BU', 14);
        $this->Cell($lengthCell, $this->height, "NOTA DINAS", "", 0, 'C');
        $this->Ln(10);

        //header nota
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "Kepada         :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "Yth. Bapak Kepala Dinas Pelayanan Pajak Kota Bandung", "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Dari              :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'L');
        $this->Ln(6);

		$tgl = CCGetFromGet("tgl", "");
		//Format Tanggal
		$tanggal = date ('j');

		//Array Bulan
		$array_bulan = array(1=>'Januari','Februari','Maret', 'April', 'Mei', 'Juni','Juli','Agustus','September','Oktober', 'November','Desember');
		$bulan = $array_bulan[date('n')];

		//Format Tahun
		$tahun = date('Y');

		//Menampilkan hari dan tanggal
		//echo $hari . ',' . $tanggal . $bulan . $tahun;
        $this->Cell($lengthJudul1, $this->height, "Tanggal        :", "", 0, 'L');
        if ($tgl == ''){
			$this->Cell($lengthJudul2, $this->height, $tanggal." ".$bulan ." ". $tahun, "", 0, 'L');
		}else{
			$this->Cell($lengthJudul2, $this->height, $tgl, "", 0, 'L');
		}
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Nomor          :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "973/               -Jakdaf/" . $this->romanNumerals(date("m")) . "/" . date("Y"), "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Lampiran      :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "1 (satu) berkas", "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Perihal          :", "B", 0, 'L');
        $this->SetFont('Times', 'I', 12);
        $this->Cell($lengthJudul2, $this->height, "Permohonan Pengukuhan Wajib Pajak Daerah", "B", 0, 'L');
        $this->Ln(10);

        //Isi
		$param_arr['date_start_laporan'] = CCGetFromGet('date_start_laporan');
		$param_arr['date_end_laporan'] = CCGetFromGet('date_end_laporan');
		$periode='';
		if ($param_arr['date_start_laporan'] == $param_arr['date_end_laporan']){
			$periode=$param_arr['date_start_laporan'];
		}else{
			$periode=$param_arr['date_start_laporan']." s.d. ".$periode=$param_arr['date_end_laporan'];;
		}
        $this->SetFont('Times', '', 12);
        
		$this->SetWidths(array($lengthJudul1,10,$lengthJudul2-10));
		$this->SetAligns(array("J","J","J"));
		$this->RowMultiBorderWithHeight(
				array("",
					"",
					"Dipermaklumkan  dengan  hormat, sehubungan dengan permohonan pendaftaran"
				),
				array("",
					"",
					""
				),
				$this->height
			);
		$this->SetWidths(array($lengthJudul1,$lengthJudul2));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(
				array("",
					"Wajib Pajak Daerah yang diterima pada tanggal ".$periode." sebagaimana terlampir, bersama ini kami sampaikan draft Surat Pengukuhan Wajib Pajak Daerah sebanyak ".$data["jumlah"]." (".$data["huruf"].") lembar untuk kiranya berkenan Bapak tandatangani."
				),
				array("",
					""
				),
				$this->height
			);
		$this->Ln(6);
		
        $this->SetWidths(array($lengthJudul1,10,$lengthJudul2-10));
		$this->SetAligns(array("J","J","J"));
		$this->RowMultiBorderWithHeight(
				array("",
					"",
					"Demikian kami sampaikan, atas perhatian dan perkenan Bapak dihaturkan terima"
				),
				array("",
					"",
					""
				),
				$this->height
			);
		$this->SetWidths(array($lengthJudul1,$lengthJudul2));
		$this->SetAligns(array("J","J"));
		$this->RowMultiBorderWithHeight(
				array("",
					"kasih."
				),
				array("",
					""
				),
				$this->height
			);
			
		$this->Ln(6);

        //TTD
		$lengWP1 = $lengthJudul2 * 1/3;
        $lengWP2 = $lengthJudul2 * 2/3;
        $this->SetFont('Times', 'B', 12);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "KEPALA BIDANG", "", "", 'C');
        $this->Ln();

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "PAJAK PENDAFTARAN,", "", "", 'C');
        $this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();
		$this->Ln();

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "Drs. H. GUN GUN SUMARYANA", "", "", 'C');
        $this->Ln(6);
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "Pembina", "", "", 'C');
        $this->Ln(6);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "NIP. 19700806 199101 1 001", "", "", 'C');
        $this->Ln(6);
		
		$this->Ln(6);
		$this->Ln(6);
		
		$this->SetFont('Times', 'BU', 12);
        $this->Cell(19, $this->height, "Tembusan ", "", 0, 'L');
		$this->SetFont('Times', 'U', 12);
        $this->Cell($lengthCell, $this->height, " disampaikan kepada Yth. :", "", 0, 'L');
        $this->Ln(6);
		$this->SetFont('Times', '', 12);
		$this->Cell($lengthCell, $this->height, "1.	Sekretaris Dinas Pelayanan Pajak;", "", 0, 'L');
        $this->Ln(6);
		$this->Cell($lengthCell, $this->height, "2.	Kepala Bidang Perencanaan;", "", 0, 'L');
        $this->Ln(6);
		$this->Cell($lengthCell, $this->height, "3.	Kepala Bidang Pengendalian; dan", "", 0, 'L');
        $this->Ln(6);
		$this->Cell($lengthCell, $this->height, "4. Para Kepala Seksi di lingkungan Bidang Pajak Pendaftaran.", "", 0, 'L');
        $this->Ln(6);
    }

	function romanNumerals($num){ 
		$n = intval($num); 
		$res = ''; 

		/*** roman_numerals array  ***/ 
		$roman_numerals = array( 
			'M'  => 1000, 
			'CM' => 900, 
			'D'  => 500, 
			'CD' => 400, 
			'C'  => 100, 
			'XC' => 90, 
			'L'  => 50, 
			'XL' => 40, 
			'X'  => 10, 
			'IX' => 9, 
			'V'  => 5, 
			'IV' => 4, 
			'I'  => 1); 

		foreach ($roman_numerals as $roman => $number){ 
			/*** divide to get  matches ***/ 
			$matches = intval($n / $number); 

			/*** assign the roman char * $matches ***/ 
			$res .= str_repeat($roman, $matches); 

			/*** substract from the number ***/ 
			$n = $n % $number; 
		} 

		/*** return the res ***/ 
		return $res; 
	}
	
    function getNumberFormat($number, $dec) {
        if (!empty($number)) {
            return number_format($number, $dec);
        }
        else {
            return "";
        }
    }

    function SetWidths($w) {
        //Set the array of column widths
        $this->widths = $w;
    }

    function SetAligns($a) {
        //Set the array of column alignments
        $this->aligns = $a;
    }

    function Row($data) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
                $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = 5 * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            $this->Rect($x, $y, $w, $h);
            //Print the text
            $this->MultiCell($w, 5, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h) {
        //If the height h would cause an overflow, add a new page immediately
        if ($this->GetY() + $h > $this->PageBreakTrigger)
                $this->AddPage($this->CurOrientation);
    }

    function RowMultiBorderWithHeight($data, $border = array(), $height) {
        //Calculate the height of the row
        $nb = 0;
        for ($i = 0; $i < count($data); $i++)
                $nb = max($nb, $this->NbLines($this->widths[$i], $data[$i]));
        $h = $height * $nb;
        //Issue a page break first if needed
        $this->CheckPageBreak($h);
        //Draw the cells of the row
        for ($i = 0; $i < count($data); $i++) {
            $w = $this->widths[$i];
            $a = isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
            //Save the current position
            $x = $this->GetX();
            $y = $this->GetY();
            //Draw the border
            //$this->Rect($x,$y,$w,$h);
            $this->Cell($w, $h, '', isset($border[$i]) ? $border[$i] : 1, 0);
            $this->SetXY($x, $y);
            //Print the text
            $this->MultiCell($w, $height, $data[$i], 0, $a);
            //Put the position to the right of the cell
            $this->SetXY($x + $w, $y);
        }
        //Go to the next line
        $this->Ln($h);
    }

    function NbLines($w, $txt) {
        //Computes the number of lines a MultiCell of width w will take
        $cw = &$this->CurrentFont['cw'];
        if ($w == 0) $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2 * $this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r", '', $txt);
        $nb = strlen($s);
        if ($nb > 0 and $s[$nb - 1] == "\n") $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while ($i < $nb) {
            $c = $s[$i];
            if ($c == "\n") {
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if ($c == ' ') $sep = $i;
            $l+=$cw[$c];
            if ($l > $wmax) {
                if ($sep == -1) {
                    if ($i == $j) $i++;
                }
                else $i = $sep + 1;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            }
            else $i++;
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