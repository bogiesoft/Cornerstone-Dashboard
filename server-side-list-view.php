<?php
/*
Follow this tutorial for further clarification --> https://coderexample.com/datatable-demo-server-side-in-phpmysql-and-ajax/
*/
require("connection.php");

$sql = "SELECT * FROM job_ticket";
// getting total number records without any search
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.
$sql = "SELECT * FROM job_ticket WHERE 1=1";
// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;
$columns = array(
// datatable column index  => database column name
	0 => 'job_id',
	1 => 'processed_by',
	2 => 'client_name',
	3 => 'project_name',
	4 => 'due_date',
	5 => 'records_total',
	6 => 'job_status'
);

	if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
		$search = $requestData['search']['value'];
		if(strpos($search, ' ') !== FALSE){
			$array_name = explode(" ", $search);
			$first_name = $array_name[0];
			$last_name = $array_name[1];
			$result_name = mysqli_query($conn, "SELECT user FROM users WHERE first_name LIKE '%$first_name%' OR last_name LIKE '%$last_name%'");
		}
		else{
			$result_name = mysqli_query($conn, "SELECT user FROM users WHERE first_name LIKE '%$search%' OR last_name LIKE '%$search%'");
		}
		$sql.=" AND (job_id LIKE '%".$requestData['search']['value']."%' ";
		while($row_name = $result_name->fetch_assoc()){
			$user = $row_name["user"];
			$sql.=" OR processed_by LIKE '%".$user."%' ";
		}
		$sql.=" OR client_name LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR project_name LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR due_date LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR records_total LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR job_status LIKE '%".$requestData['search']['value']."%' )";
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
		$nestedData[] = $row["job_id"];
		$processed_by = $row["processed_by"];
		$result_name = mysqli_query($conn, "SELECT first_name, last_name FROM users WHERE user = '$processed_by'");
		$row_name = $result_name->fetch_assoc();
		$nestedData[] = $row_name["first_name"] . " " . $row_name["last_name"];
		$nestedData[] = $row["client_name"];
		$nestedData[] = $row["project_name"];
		$nestedData[] = $row["due_date"];
		$nestedData[] = $row["records_total"];
		$nestedData[] = $row["job_status"];
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
