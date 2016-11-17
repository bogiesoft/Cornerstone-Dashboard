<?php
require("connection.php");
date_default_timezone_set('US/Eastern');
// output headers so that the file is downloaded rather than displayed
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename=Sales -'.date('Y-m-d H:i:s') .'.csv');
//header("Content-Transfer-Encoding: UTF-8");
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
$sql = $_GET['val'].'AND mark = 1';
// output the column headings
fputcsv($output, array('Client Name', 'business', 'Address','City', 'State', 'Zip code','Call back date', 'Priority', 'Title','Phone', 'Web Address', 'Email','Vertical1','Vertical2','Vertical3'));
$rows = mysqli_query($conn, $sql);

// loop over the rows, outputting them
while ($row = mysqli_fetch_assoc($rows)){
  $nestedData=array();
	$nestedData[] = $row["full_name"];
	$nestedData[] = $row["business"];
	$nestedData[] = $row["address_line_1"];
	$nestedData[] = $row["city"];
	$nestedData[] = $row["state"];
	$nestedData[] = $row["zipcode"];
	$nestedData[] = $row["call_back_date"];
	$nestedData[] = $row["priority"];
	$nestedData[] = $row["title"];
	$nestedData[] = $row["phone"];
	$nestedData[] = $row["web_address"];
	$nestedData[] = $row["email1"];
	$nestedData[] = $row["vertical1"];
	$nestedData[] = $row["vertical2"];
	$nestedData[] = $row["vertical3"];
  fputcsv($output, $nestedData);
}
fclose($output);
 ?>
