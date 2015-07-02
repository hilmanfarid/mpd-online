<?php
	define("RelativePath", "..");
	define("PathToCurrentPage", "/report/");
	define("FileName", "cetak_surat_pengukuhan_pdf.php");
	include_once(RelativePath . "/Common2.php");
	include_once("../include/fpdf.php");
	require_once '../include/swift/lib/swift_required.php';

	$mailConfig = array(
		'host_smtp' => 'smtp.gmail.com',
		//'username' => 'helpdesk@disyanjak.net',
		//'password' => 'disyanjakbdg'
		'username' => 'testmpd2014@gmail.com',
		'password' => 'mpdonline'
	);
	
	$transport = Swift_SmtpTransport::newInstance($mailConfig['host_smtp'], 465, "ssl")
	  ->setUsername($mailConfig['username'])
	  ->setPassword($mailConfig['password']);
	
	$mailer = Swift_Mailer::newInstance($transport);
	
	/*include('../include/fpdf17/mc_table.php');
	$paperpdf = new PDF_MC_Table; 
	// Create a new FPDF instance and set parameters  
	$paperpdf->AddPage('P');  
	$paperpdf->SetMargins(0,0,0);  
	$paperpdf->SetFont('Arial','','10');  
	$paperpdf->SetXY(50,20);  
	$paperpdf->Write(5,'Test Print.');  
	$name_of_file = "\print_pdf_".time().".pdf";  
	$paperpdf->Output('D:\work\list_pdf'.$name_of_file,'F');  */
	// Add the javascript with parameters to the Adobe API print method to do silent printing  
	// $paperpdf->IncludeJS("this.print({bUI: false, bSilent: true, bShrinkToFit: true});");  
	$dbConn = new clsDBConnSIKP();
	$dbConn2 = new clsDBConnSIKP();
	$files1 = scandir('D:\work\list_pdf');  
	$dbConn->query("select * from t_print_queue where left(a.file_name,9)!='print_pdf' and status='SAVED'");
	while ($dbConn->next_record()) {
		$item = $dbConn->Record;
		if(is_file('D:\work\list_pdf\\'.$item['file_name'])){
			shell_exec('AcroRd32.exe /n /t "D:\work\list_pdf\\'.$item['file_name'].'" "HP LaserJet 200 color M251 PCL 6" "HP LaserJet 200 color M251 PCL 6" "172.16.20.203"');
			//@unlink('D:\work\list_pdf\\'.$item);
			$dbConn2->query("update t_print_queue set status='PRINTED' where t_customer_order_id=".$item['t_customer_order_id']);
		}
	}
	// Have FPDF create and stream the auto-printing PDF to the browser  
	
	
	//echo 'AcroRd32.exe /t "D:\work\list_pdf'.$name_of_file.'" "HP LaserJet 200 color M251 PCL 6" "HP LaserJet 200 color M251 PCL 6" "172.16.20.203"';
?>