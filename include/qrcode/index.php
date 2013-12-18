<?php
  require('fpdf17/fpdf.php');
  
  // -------------------------------------------------- //
  //                      USEFULL
  // -------------------------------------------------- //
  
  class eFPDF extends FPDF{
     //DO a modification here
  }

  // -------------------------------------------------- //
  //                  PROPERTIES
  // -------------------------------------------------- //
  
  $fontSize = 10;
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 200;  // barcode center
  $y        = 200;  // barcode center
  $height   = 50;   // barcode height in 1D ; module size in 2D
  $width    = 2;    // barcode height in 1D ; not use in 2D
  $angle    = 45;   // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
  $code     = 'FFFFFFFFFAAAA'; // barcode, of course ;)
  $type     = 'ean13';
  
  // -------------------------------------------------- //
  //            ALLOCATE FPDF RESSOURCE
  // -------------------------------------------------- //
  $param=$_GET['param'];
  $pdf = new eFPDF('P', 'pt');
  $pdf->AddPage();
  
   $black    = '000000'; // color in hexa
  
 
  $pdf->SetFont('Arial','B',$fontSize);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->Write(5,"String Test ".$param);
  $pdf->Image('http://localhost/qrtes/generate-qr.php?param='.$param,1,100,200,0,'PNG');
  $pdf->Write(5,"String Test ".$param);
  $pdf->Output();
?>