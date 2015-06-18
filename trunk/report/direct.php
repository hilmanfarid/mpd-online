<?php
	include('../include/fpdf17/mc_table.php');
	$paperpdf = new PDF_MC_Table; 
	// Create a new FPDF instance and set parameters  
	$paperpdf->AddPage('P');  
	$paperpdf->SetMargins(0,0,0);  
	$paperpdf->SetFont('Arial','','10');  
	$paperpdf->SetXY(50,20);  
	$paperpdf->Write(5,'I will print when opened.');  
	$name_of_file = "\print_pdf_".time().".pdf";  
	// Add the javascript with parameters to the Adobe API print method to do silent printing  
	// $paperpdf->IncludeJS("this.print({bUI: false, bSilent: true, bShrinkToFit: true});");  
	  
	// Have FPDF create and stream the auto-printing PDF to the browser  
	$paperpdf->Output('D:\work\list_pdf'.$name_of_file,'F');  
	shell_exec('AcroRd32.exe /t "D:\work\list_pdf'.$name_of_file.'" "Send To OneNote 2010" "Send To OneNote 2010" "127.0.0.1"');
	echo 'AcroRd32.exe /t "D:\work\list_pdf'.$name_of_file.'" "Send To OneNote 2010" "Send To OneNote 2010" "127.0.0.1"';
?>