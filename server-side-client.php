<?php
/*
Follow this tutorial for further clarification --> https://coderexample.com/datatable-demo-server-side-in-phpmysql-and-ajax/
*/
require("connection.php");

// getting total number records without any search
$sql = "SELECT * FROM sales WHERE type = 'Client'";
$query=mysqli_query($conn, $sql);
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


$sql = "SELECT * FROM sales WHERE 1=1 AND type = 'Client'";

// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;
$columns = array(
// datatable column index  => database column name
	0 =>'full_name',
	1 => 'business',
	2=> 'address_line_1',
	3=> 'city',
	4=> 'state',
	5=> 'zipcode',
	6=> 'call_back_date',
	7=> 'priority',
	8=> 'title',
	9=> 'phone',
	10=> 'web_address',
	11=> 'email1',
	12=> 'vertical1',
	13=> 'vertical2',
	14=> 'vertical3',

);

	if( !empty($requestData['search']['value']) ) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
		$sql.=" AND ( full_name LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR business LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR address_line_1 LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR city LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR state LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR zipcode LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR call_back_date LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR priority LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR title LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR phone LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR web_address LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR email1 LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR vertical1 LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR vertical2 LIKE '".$requestData['search']['value']."%' ";
		$sql.=" OR vertical3 LIKE '".$requestData['search']['value']."%' )";
	}

	//getting records as per search parameters
	for ($i = 0; $i < count($columns); $i++) {
		if( !empty($requestData['columns'][$i]['search']['value']) && $i == 7){   //for Priority column only
				$sql.=" AND ".$columns[$i]." = '".$requestData['columns'][$i]['search']['value']."' ";
		}
		else if( !empty($requestData['columns'][$i]['search']['value']) ){   //each column name search
		    $sql.=" AND ".$columns[$i]."  LIKE '".$requestData['columns'][$i]['search']['value']."%' ";
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
