<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2014 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2014 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.8.0, 2014-03-02
 */

/** Error reporting */
error_reporting(E_ALL);
function createExcel($data){
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Europe/London');
    
    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
    
    /** Include PHPExcel */
    require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
    
    
    // Create new PHPExcel object
    $objPHPExcel = new PHPExcel();
    
    // Set document properties
    $objPHPExcel->getProperties()->setCreator("Disyanjak Bandung")
    							 ->setLastModifiedBy("Disyanjak Bandung")
    							 ->setTitle("Daftar SMS")
    							 ->setSubject("Daftar SMS")
    							 ->setDescription("Daftar SMS untuk ke WP")
    							 ->setKeywords("office PHPExcel php")
    							 ->setCategory("Test result file");
    
    $objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
    // Add some data
    $objPHPExcel->setActiveSheetIndex(0)
				->setCellValue('A1', 'No.')
                ->setCellValue('B1', 'Phone No.')
				->setCellValue('C1', 'Message');
                //->setCellValue('A2', $no_telp);
    $counter = 0;
	
	for($counter = 0;$counter < sizeof($data);$counter++){
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.(2+$counter), $counter+1)
	                ->setCellValue('B'.(2+$counter), $data[$counter]['mobile_no'])
					->setCellValue('C'.(2+$counter), $data[$counter]['message']);
		//echo $data[$counter]['mobile_no'].'  '.$data[$counter]['message'];
	}
                
    //$objPHPExcel->getActiveSheet()->getStyle('A1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
    
    
    //$objPHPExcel->getActiveSheet()->setCellValue('A8',"Hello\nWorld");
    //$objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
    //$objPHPExcel->getActiveSheet()->getStyle('A8')->getAlignment()->setWrapText(true);
    
    
    // Rename worksheet
    $objPHPExcel->getActiveSheet()->setTitle('Daftar SMS');
    
    
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    
    
    // Save Excel 2007 file
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $fileName = 'send_sms_'.date('Y-m-d-H-i-s');
    $objWriter->save($fileName.'.xlsx');
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($fileName.'.xls');
    
    return $fileName;
}