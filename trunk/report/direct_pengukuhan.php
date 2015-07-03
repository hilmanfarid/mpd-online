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
	$dbConn->query("select b.t_customer_order_id as order_id,c.code as jabatan,* from t_print_queue a
					left join t_vat_registration b on a.t_customer_order_id=b.t_customer_order_id
					left join p_job_position c on c.p_job_position_id=b.p_job_position_id
					where left(a.file_name,9)='print_pdf' and status='SAVED'");
	while ($dbConn->next_record()) {
		$item = $dbConn->Record;
		if(is_file('D:\work\list_pdf\\'.$item['file_name'])){
			if($item['p_doc_delivery_type_id']==3){
				
				if ($item['jenis_usaha']=='Badan'){
					$receiver = $item['email'];
					$receiver2 = $item['wp_email'];
					
					$html.= '<table width="100%">
						<tr>
							<td widtth = "60%"></td>
							<td>
								Yth. '.$item['wp_name'].' </br>
								'.$item['company_brand'].' </br>
								di Bandung
							</td>
						</tr>';
				}else{
					$receiver = $item['wp_email'];
					$receiver2 = '';
					
					$html.= '<table width="100%">
						<tr>
							<td widtth = "60%"></td>
							<td>
								Yth. '.$item['company_owner'].' </br>
								'.$item['jabatan'].' - '.$item['wp_name'].'</br>
								di Bandung
							</td>
						</tr>';
				}
				
				$html.= '<tr>
						<td colspan=2>
							</br>
							Terima kasih Anda telah terdaftar sebagai Wajib Pajak dengan NPWPD '.$item['npwpd'].'. 
							NPWPD ini merupakan tanda pengenal diri atau identitas Wajib Pajak dalam melakukan hak dan kewajiban perpajakan daerah di Kota Bandung.
							</br>
							</br>
							Terlampir kami sampaikan Surat Pengukuhan Wajib Pajak Daerah.
							Informasi tentang perpajakan daerah Kota Bandung dapat dilihat pada www.disyanjak.bandung.go.id .
							</br>
							</br>
							Hormat kami.
							</br>
							Dinas Pelayanan Pajak Kota Bandung.
						</td>
					</tr>
				</table>';
				
				$message = Swift_Message::newInstance('SURAT PENGUKUHAN NPWPD')//SUBJECT
				  ->setFrom(array($mailConfig['username'] => 'DINAS PELAYANAN PAJAK KOTA BANDUNG'))//NAME APPEAR IN INBOX (sender's name)
				  //->setTo($_GET['receiver'])
				  ->setTo($receiver)
				  //->setBody($_GET['message'], 'text/html');
				  ->setBody($html, 'text/html');
				  ->attach(
				Swift_Attachment::fromPath('D:\work\list_pdf\\'.$item['file_name'])->setFilename('surat_pengukuhan.pdf')
				);
				
				$result = $mailer->send($message);
				if ($result==1){
					$dbConn2->query("update t_print_queue set status='MAILED' where t_customer_order_id=".$item['order_id']);
					echo 'mail sent';
				}else{
					$dbConn2->query("update t_print_queue set status='SEND EMAIL FAILED' where t_customer_order_id=".$item['order_id']);
					echo 'failed sending email';
				}
				
				if ($receiver2 != ''){
					$message = Swift_Message::newInstance('SURAT PENGUKUHAN NPWPD')//SUBJECT
					  ->setFrom(array($mailConfig['username'] => 'DINAS PELAYANAN PAJAK KOTA BANDUNG'))//NAME APPEAR IN INBOX (sender's name)
					  //->setTo($_GET['receiver'])
					  ->setTo($receiver2)
					  //->setBody($_GET['message'], 'text/html');
					  ->setBody($html, 'text/html');
					  ->attach(
					Swift_Attachment::fromPath('D:\work\list_pdf\\'.$item['file_name'])->setFilename('surat_pengukuhan.pdf')
					);
					$result = $mailer->send($message);
					if ($result==1){
						$dbConn2->query("update t_print_queue set status='MAILED' where t_customer_order_id=".$item['order_id']);
						echo 'mail sent';
					}else{
						$dbConn2->query("update t_print_queue set status='SEND EMAIL FAILED' where t_customer_order_id=".$item['order_id']);
						echo 'failed sending email';
					}
				}		
			}else{
				shell_exec('AcroRd32.exe /n /t "D:\work\list_pdf\\'.$item['file_name'].'" "HP LaserJet 200 color M251 PCL 6" "HP LaserJet 200 color M251 PCL 6" "172.16.20.203"');
				//@unlink('D:\work\list_pdf\\'.$item);
				$dbConn2->query("update t_print_queue set status='PRINTED' where t_customer_order_id=".$item['order_id']);
			}
		}
	}
	// Have FPDF create and stream the auto-printing PDF to the browser  
	
	
	//echo 'AcroRd32.exe /t "D:\work\list_pdf'.$name_of_file.'" "HP LaserJet 200 color M251 PCL 6" "HP LaserJet 200 color M251 PCL 6" "172.16.20.203"';
?>