<?php
/*
Follow this tutorial for further clarification --> https://coderexample.com/datatable-demo-server-side-in-phpmysql-and-ajax/
*/
$sql = "";
$totalData = "";
$totalFiltered = "";
if($_POST['function'] ==1){
	// getting total number records without any search
	require("connection.php");
	global $sql, $totalData, $totalFiltered;
	$sql = "SELECT * FROM employee_data";
	$query=mysqli_query($conn, $sql);
	$totalData = mysqli_num_rows($query);
	$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


	$sql = "SELECT * FROM employee_data WHERE 1=1";
}


require("connection.php");
// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;
$columns = array(
// datatable column index  => database column name
	0 => 'record_id',
	1 => 'job_id',
	2 => 'sack_number',
	3 => 'employee_name',
	4 => 'recs_per_min',
	5 => 'hours',
	6 => 'task',

);

	if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND (record_id LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR job_id LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR sack_number LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR employee_name LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR recs_per_min LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR hours LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR task LIKE '%".$requestData['search']['value']."%' ";
	}

	//getting records as per search parameters
	for ($i = 0; $i < count($columns); $i++) {
		if( !empty($requestData['columns'][$i]['search']['value']) ){   //each column name search
		    $sql.=" AND ".$columns[$i]."  LIKE '%".$requestData['columns'][$i]['search']['value']."%' ";
		}
	}

	$jsonsql = $sql;

	$query=mysqli_query($conn, $sql) or die (mysqli_error($conn));
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";

	/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */
	$query=mysqli_query($conn, $sql);

	$data = array();
	while( $row=mysqli_fetch_array($query) ) {  // preparing an array
		$nestedData=array();
		$nestedData[] = $row["record_id"];
		$nestedData[] = $row["job_id"];
		$nestedData[] = $row["sack_number"];
		$user = explode("-", $row["employee_name"])[0];
		
		$result_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$user'");
		$fetched_name = $result_name->fetch_assoc();
		$full_name = $fetched_name["first_name"] . " " . $fetched_name["last_name"];
		
		$nestedData[] = $full_name;
		$nestedData[] = $row["recs_per_min"];
		$nestedData[] = $row["hours"];
		$nestedData[] = $row["task"];
		
		$data[] = $nestedData;
	}


$json_data = array(
			"sql"							=> $jsonsql,
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>