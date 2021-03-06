<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
define("FileName", "nota_dinas_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

$dbConn = new clsDBConnSIKP();

$data = array();

$idVatSS = CCGetFromGet("CURR_DOC_ID", "");

if (empty($idVatSS)) {
    echo "Data Tidak Ditemukan";
    exit;
}else {
    $sql = "select to_char(status_request_date,'dd-mm-yyyy')as status_request_date_2,* from t_cust_acc_status_modif a
	left join t_cust_account b on a.t_cust_account_id=b.t_cust_account_id
	left join p_vat_type_dtl c on c.p_vat_type_dtl_id=b.p_vat_type_dtl_id
	left join t_customer d on d.t_customer_id = b.t_customer_id
	where a.t_customer_order_id = $idVatSS ";

    $dbConn->query($sql);
    while ($dbConn->next_record()) {
        $data["company_name"] = $dbConn->f("company_name");
        $data["company_owner"] = $dbConn->f("company_owner");
        $data["address_name"] = $dbConn->f("address_name");
        $data["company_brand"] = $dbConn->f("company_brand");
        $data["brand_address_name"] = $dbConn->f("brand_address_name");
        $data["brand_address_no"] = $dbConn->f("brand_address_no");
        $data["reg_letter_no"] = $dbConn->f("reg_letter_no");
		$data["wp_name"] = $dbConn->f("wp_name");
		$data["address_name_owner"] = $dbConn->f("address_name_owner");
		$data["address_no_owner"] = $dbConn->f("address_no_owner");
		$data["vat_code"] = $dbConn->f("vat_code");
		$data["npwd"] = $dbConn->f("npwd");
		$data["status_request_date"] = $dbConn->f("status_request_date_2");
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
        $this->Cell($lengthJudul2, $this->height, "PEMERINTAHAN KOTA BANDUNG", "", 0, 'C');
        $this->Ln(10);
        $this->SetFont('Times', 'B', 22);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
        $this->Ln(8);
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "", "B", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "Jalan Wastukancana No. 2 Telp. 022. 4232338 - Bandung", "B", 0, 'C');

        $this->Ln(10);
        $this->SetFont('Times', 'B', 14);
        $this->Cell($lengthCell, $this->height, "NOTA DINAS", "", 0, 'C');
        $this->Ln(10);

        //header nota
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "Kepada         :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "Yth. Bapak Kepala Dinas Pelayanan Pajak Kota Bandung", "", 0, 'L');
        $this->Ln(6);

        /*$this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "Melalui Kepala Bidang Pajak Pendaftaran", "", 0, 'L');
        $this->Ln(6);*/

        $this->Cell($lengthJudul1, $this->height, "Dari              :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "Kepala Bidang Pajak Pendaftaran", "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Tanggal        :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, '', "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Nomor          :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "973/               -Dafda/" . $this->romanNumerals(date("m")) . "/" . date("Y"), "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Lampiran      :", "", 0, 'L');
        $this->Cell($lengthJudul2, $this->height, "1 (satu) berkas", "", 0, 'L');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "Perihal          :", "B", 0, 'L');
        $this->SetFont('Times', 'I', 12);
        $this->Cell($lengthJudul2, $this->height, "Permohonan Pencabutan dan Penutupan Nomor Pokok Wajib Pajak Daerah", "B", 0, 'L');
        $this->Ln(10);

        //Isi
        $this->SetFont('Times', '', 12);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->MultiCell($lengthJudul2, $this->height, "Dipermaklumkan dengan hormat, berdasarkan Peraturan Walikota Bandung Nomor 016 Tahun 2014 tentang Standar Operasional Prosedur Tata Cara Pemungutan Pajak Daerah, atas permohonan dari Wajib Pajak / Berita Acara dapat diusulkan pencabutan dan penutupan NPWPD dengan persyaratan sesuai ketentuan yang berlaku.", "", 'J');
        $this->Ln(6);

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->MultiCell($lengthJudul2, $this->height, "Pada tanggal " .$data["status_request_date"]. ", telah diterima surat permohonan penutupan wajib pajak daerah / Berita Acara dengan data sebagai berikut : ", "", 'J');
        $this->Ln(6);

        //data wajib pajak
        $lengWP1 = $lengthJudul2 * 1/3;
        $lengWP2 = $lengthJudul2 * 2/3;
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "Nama Merk Dagang", "", "", 'L');
        $this->Cell($lengWP2, $this->height, ": ".$data["company_brand"], "", "", 'L');
        $this->Ln(5);
		
		$this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "Alamat Usaha", "", "", 'L');
        $this->Cell($lengWP2, $this->height, ": ".$data["brand_address_name"] . " ".$data["brand_address_no"], "", "", 'L');
        $this->Ln();

		$this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "NPWPD", "", "", 'L');
        $this->Cell($lengWP2, $this->height, ": ".$data["npwd"], "", "", 'L');
        $this->Ln();
		
        /*$this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "Penanggung Jawab", "", "", 'L');
        $this->Cell($lengWP2, $this->height, ": ".$data["company_owner"], "", "", 'L');
        $this->Ln(5);

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "Alamat", "", "", 'L');
        $this->Cell($lengWP2, $this->height, ": ".$data["address_name_owner"]. " " . $data["address_no_owner"], "", "", 'L');
        $this->Ln(5);*/

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "Jenis Usaha", "", "", 'L');
        $this->Cell($lengWP2, $this->height, ": ".$data["vat_code"], "", "", 'L');
        $this->Ln(5);
		$this->Ln();

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->MultiCell($lengthJudul2, $this->height, "Sehubungan dengan permohonan tersebut diatas mohon kiranya Bapak berkenan untuk menandatangani Surat Pencabutan dan Penutupan NPWPD.", "", 'J');
        $this->Ln();

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->MultiCell($lengthJudul2, $this->height, "Demikian permohonan ini kami sampaikan, atas perhatian Bapak kami mengucapkan terima kasih.", "", 'J');
        $this->Ln();

        //TTD
        $this->SetFont('Times', 'B', 12);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "KEPALA BIDANG", "", "", 'C');
        $this->Ln();

        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "PAJAK PENDAFTARAN", "", "", 'C');
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
        $this->Cell($lengWP2, $this->height, "Pembina IV/a", "", "", 'C');
        $this->Ln(6);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'L');
        $this->Cell($lengWP1, $this->height, "", "", "", 'L');
        $this->Cell($lengWP2, $this->height, "NIP. 19700806 199101 1 001", "", "", 'C');
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