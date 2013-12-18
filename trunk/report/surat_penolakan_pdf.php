<?php

define("RelativePath", "..");
define("PathToCurrentPage", "/report/");
//define("FileName", "cetak_sptpd_hiburan_pdf.php");
include_once(RelativePath . "/Common.php");
include_once("../include/fpdf.php");

//$dbConn = new clsDBConnSIKP();
//
//$data = array();
//
//$idVatSS = CCGetFromGet("t_vat_setllement_id", "");
//if (empty($idVatSS)) {
//    echo "Data Tidak Ditemukan";
//    exit;
//}
//else {
//    $sql = "SELECT * "
//        . "FROM v_vat_setllement "
//        . "WHERE t_vat_setllement_id = " . $idVatSS;
//
//    $dbConn->query($sql);
//    while ($dbConn->next_record()) {
//        $data["npwd"] = $dbConn->f("npwd");
//        $data["t_vat_registration_id"] = $dbConn->f("t_vat_registration_id");
//        $data["start_date_txt"] = $dbConn->f("start_date_txt");
//        $data["end_date_txt"] = $dbConn->f("end_date_txt");
//        $data["total_trans_amount"] = $dbConn->f("total_trans_amount");
//        $data["total_vat_amount"] = $dbConn->f("total_vat_amount");
//    }
//    $dbConn->close();
//}

class FormCetak extends FPDF {

    var $fontSize = 10;
    var $fontFam = 'Arial';
    var $yearId = 0;
    var $yearCode = "";
    var $paperWSize = 210;
    var $paperHSize = 297;
    var $height = 5;
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

        $this->Image('../images/logo_pemda.png', 15, 15, 25, 25);
        // $this->Cell($lengthCell, $this->height, "2.	BENTUK SURAT PEMBERITAHUAN PAJAK DAERAH UNTUK PAJAK HIBURAN", 0, 0, 'L');
        // $this->Ln(6);
        $this->Ln(6);
        $this->SetFont('Times', 'B', 16);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "PEMERINTAHAN KOTA BANDUNG", "", 0, 'C');
        $this->Ln(10);
        $this->SetFont('Times', 'B', 24);
        $this->Cell($lengthJudul1, $this->height, "", "", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "DINAS PELAYANAN PAJAK", "", 0, 'C');
        $this->Ln(8);
        $this->SetFont('Times', '', 14);
        $this->Cell($lengthJudul1, $this->height, "", "B", 0, 'C');
        $this->Cell($lengthJudul2, $this->height, "Jalan Wastukancana No. 2 Telp. 022. 4232338 - Bandung", "B", 0, 'C');

        $this->Ln(10);
        $this->SetFont('Times', 'B', 16);
        $this->Cell($lengthCell, $this->height, "SURAT PENOLAKAN", "", 0, 'C');
        $this->Ln(10);
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