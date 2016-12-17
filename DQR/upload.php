<?php
	//  Include PHPExcel_IOFactory
	include('Classes/PHPExcel/IOFactory.php');
	require_once dirname(__FILE__).'/Classes/PHPExcel.php';
	$color = array('Moved'=>'015aad','Moved Errors'=>'132a51', 'Fixed'=>'00F5FF','Duplicate'=>'2E8B57','Foreigns'=>'8B008B','Not Sent'=>'8A360F','Unknown'=>'FF0000');
	$colString;

	function setHeader(){
		//add headers first
		global $objPHPExcel;
		global $color;
		global $colString;
		$findEndDataColumn_header = PHPExcel_IOFactory::load($_FILES['file']['tmp_name'][0])->getActiveSheet()->getHighestDataColumn();
		$colNumber = PHPExcel_Cell::columnIndexFromString($findEndDataColumn_header)+2;
		$colString = PHPExcel_Cell::stringFromColumnIndex($colNumber);
		$header = PHPExcel_IOFactory::load($_FILES['file']['tmp_name'][0])->getActiveSheet()->rangeToArray('A1:' .$findEndDataColumn_header.'1');
		$objPHPExcel->getActiveSheet()->fromArray($header, null, 'B9');
		$objPHPExcel->getActiveSheet()->setCellValue('A1','Moved - These are people or businesses that have moved within the last 48 months; their addresses are automatically updated by our mailing software.')->getStyle('A1')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Moved']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A2','Moved Errors - These addresses were returned with an error message from the NCOA (National Change of Address) Database, usually because the addressees moved and did not leave a forwarding address, or closed their PO Box. These people are not sent mail.')->getStyle('A2')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Moved Errors']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A3','Fixed - We manually changed these addresses to conform to USPS standards.')->getStyle('A3')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Fixed']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A4','Duplicate - These records appeared in your mailing list more than once. Unless otherwise instructed, we remove all duplicates from every mailing.')->getStyle('A4')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Duplicate']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A5','Foreigns - If, as per your request, we combined the names of people living at the same address into a single record, we removed all single records going to that address.')->getStyle('A5')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Foreigns']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A6','Not Sent - These records were either removed per your request or didn\'t contain enough information to be mailed.')->getStyle('A6')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Not Sent']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A7','Unknown - These are addresses that we attempted to correct, but could not verify. We do send these pieces, but can\'t guarantee that they will be delivered to the intended addressee.')->getStyle('A7')->applyFromArray(array('font'  => array('bold'  => true,'color' => array('rgb' => $color['Unknown']),)));
		$objPHPExcel->getActiveSheet()->setCellValue('A8', '');
		$objPHPExcel->getActiveSheet()->setCellValue('A9', 'Status');
		//header cellColor
		$objPHPExcel->getActiveSheet()->getStyle('A9:Z9')->applyFromArray(array(
			'fill' => array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array(
						 'rgb' => '008cff'
				)
			),
			'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => 'FFFFFF')
  		)
		));
	}

	function cellColor($cells,$new_color){
	    global $objPHPExcel;
			//echo $cells;
			$objPHPExcel->getActiveSheet()->getStyle($cells)->applyFromArray(array(
				'font'  => array(
				'color' => array('rgb' => $new_color),
			)
			));
	}

//===========================================================
	if(isset($_FILES["file"]["name"])){
		$dropdown = 0;
		// Instantiate a new PHPExcel object
		$objPHPExcel = new PHPExcel();
		global $color;
		global $colString;
		setHeader();

		 $first_row = 10;

		for($i=0; $i<count($_FILES['file']['name']); $i++){

				$inputFileName = $_FILES['file']['tmp_name'][$i];

				// Files are loaded to PHPExcel using the IOFactory load() method
				$objPHPExcel1 = PHPExcel_IOFactory::load($inputFileName);

				// Find the last cell in the first spreadsheet
				$findEndDataRow = $objPHPExcel1->getActiveSheet()->getHighestDataRow();
				$findEndDataColumn = $objPHPExcel1->getActiveSheet()->getHighestDataColumn();
				$findEndData = $findEndDataColumn . $findEndDataRow;

				// Read all the data from first spreadsheet to a normal PHP array
				//    skipping the headers in row 1
				$beeData = $objPHPExcel1->getActiveSheet()->rangeToArray('A2:' . $findEndData);
				$appendStartRow = $objPHPExcel->getActiveSheet()->getHighestRow() + 1;


				$objPHPExcel->getActiveSheet()->fromArray($beeData, null, 'B' . $appendStartRow);

				$end_row = $first_row+$findEndDataRow-2;
				// Populate first column with data
				for ($j = $first_row; $j <= $end_row; $j++) {
					$objPHPExcel->getActiveSheet()->setCellValue('A' . $j, $_POST['chosen'.$dropdown]);			// Add bee data from the PHP array into the new file data. Skip first two rows
				}
				// echo "first row".$first_row;
				// echo "end row". $end_row;
				cellColor('A'.$first_row.':'.$colString.$end_row, $color[$_POST['chosen'.$dropdown]]);
				$first_row+=$findEndDataRow-1;
				$dropdown++;
		}
		// Save $objPHPExcel1 to browser as an .xls file
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
		header("Content-Type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename='Merged.xls'");
		header("Cache-Control: max-age=0");
		$objWriter->save('php://output');
	}
?>
