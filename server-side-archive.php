<?php
/*
Follow this tutorial for further clarification --> https://coderexample.com/datatable-demo-server-side-in-phpmysql-and-ajax/
*/
require("connection.php");

// getting total number records without any search
$sql = "SELECT * FROM archive_jobs";
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM archive_jobs WHERE 1=1";

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;
$columns = array(
// datatable column index  => database column name
	0 =>'job_id',
	1 => 'client_name',
	2=> 'project_name',
	3=> 'records_total',
	4=> 'invoice_number',
	5=> 'archive_date',
	6=> 'reason'
);

	if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND (job_id LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR client_name LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR project_name LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR records_total LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR invoice_number LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR archive_date LIKE '%".$requestData['search']['value']."%' ";
		$sql.=" OR reason LIKE '%".$requestData['search']['value']."%' )";
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
		$nestedData[] = $row["client_name"];
		$nestedData[] = $row["project_name"];
		$nestedData[] = $row["records_total"];
		$nestedData[] = $row["invoice_number"];
		$nestedData[] = $row["archive_date"];
		$nestedData[] = $row["reason"];
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
