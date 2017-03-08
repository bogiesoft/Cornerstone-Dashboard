<?php
session_start();
require("connection.php");
require("head.php");
$data = array();
$handle = fopen($_FILES['fileUpload']["tmp_name"], 'r');
while($row = fgetcsv($handle , 100000 , ",")) {
   $data[] = $row;
}
if(count($data) > 200001){
	$_SESSION["max_on_importer"] = "SET";
	header("location: uploadForm.php");
	die(count($data));
}

$key_search = array();
$result_sales_list = mysqli_query($conn, "SELECT DISTINCT full_name, address_line_1, business FROM sales");
while($row = $result_sales_list->fetch_assoc()){
	array_push($key_search, $row["full_name"] . "," . $row["address_line_1"] . "," . $row["business"]);
}
//Get all Column names in array
$array_names = array();
$result_highest_id = mysqli_query($conn, "SELECT MAX(import_id) AS max FROM sales");
$row = $result_highest_id->fetch_assoc();
$import_id = $row["max"] + 1;
$import_name = $_POST["import_name"];
date_default_timezone_set('America/New_York');
$import_date = date("Y-m-d H:i:s");
$result = mysqli_query($conn,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'sales'");
while($row = $result->fetch_assoc())
{
	if($row['COLUMN_NAME'] != "mark" && $row['COLUMN_NAME'] != "import_date" && $row["COLUMN_NAME"] != "import_id" && $row["COLUMN_NAME"] != "import_name" && $row["COLUMN_NAME"] != "import_status" && $row["COLUMN_NAME"] != "crid" && $row["COLUMN_NAME"] != "non_profit")
	array_push($array_names, $row['COLUMN_NAME']);
}
//checks if header in csv matches input from select drop down
$array_indexes = array();
for($i = 0; $i < count($array_names); $i++)
{
	$no_entry = TRUE;
	for($j = 0; $j < count($data[0]); $j++){
		$string = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $_POST[$array_names[$i]]);
		if($string == $data[0][$j]){
			array_push($array_indexes, $j);
			$no_entry = FALSE;
		}
	}
	if($no_entry == TRUE){
		array_push($array_indexes, -1);
	}
}
$error = array();
$insert_statements = array();
$update_statements = array();
$check = 0;
$test_count = 0;
$sql = 'INSERT INTO sales (rep, quickbooks, prefix, full_name, suffix, title, phone, fax, extension, web_address, business, country, address_line_1, address_line_2, address_line_3, city, state, zipcode, status, call_back_date, priority, date_added, 
				mailing_list, pie_day, second_contact, cell_phone, alt_phone, home_phone, email1, email2, vertical1, vertical2, vertical3, source, notes, _2014_pie_day, Non_Profit_Card_08_2013, 
				Commercial_Card_08_2013, USPS_Post_Office_Mailing_03_2014, Contractor_Small_Business_Select_Mailing_03_2014, Contractor_SB_Select_Mailing_04_2014, USPS_EDDM_Regs_brochure_Mailing_04_2014,
				USPS_9Y9_EDDM_Marketing_Card, SEPT_2014_3_5Y11_CRST_Marketing_Card, Contractor_Mailing_2016, type, import_id, import_name, import_status) VALUES ';
for($i = 1; $i < count($data); $i++) //goes through all rows in csv file
{
		$sql_add = "";
		if($test_count > 0){
			if($test_count == 0){
				echo "Here";
			}
			$sql_add .= "(";
		}
		else
		{
			$sql_add .= "(";
		}
		$sql2 = 'UPDATE sales SET ';
		$full_name = "";
		$address_line_1 = "";
		$business = "";
		$foreign_country = FALSE;
		$insert_values = array();
		
		for($j = 0; $j < count($array_indexes); $j++){ //goes through all corresponding indexes to headers and adds to sql statements for insert and update as specified
			$input = "";
			//quotes are read by replacing with \"
			if($array_indexes[$j] != -1){
				$input = str_replace('"', '\"', $data[$i][$array_indexes[$j]]);
				$input = str_replace("'", "\'", $input); 
			}
			//check if input is greater than 45
			/*if(strlen($input) > 45){
				array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>input size is greater than 45</b> -> " . strlen($input));
			}
			//check for numeric characters in full_name, prefix, suffix
			if(preg_match("/[0-9]+/", $input) && ($array_names[$j] == "full_name" || $array_names[$j] == "prefix" || $array_names[$j] == "suffix")){
				array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>Numeric character found</b>");
			}
			//check if all phone/fax fields are valid inputs
			if($input != "" && (strlen($input) != 10 || preg_match("/[a-z]/i", $input)) && ($array_names[$j] == "phone" || $array_names[$j] == "fax" || $array_names[$j] == "cell_phone" || $array_names[$j] == "alt_phone" || $array_names[$j] == "home_phone")){
				if($array_names[$j] == "phone"){
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>must have 10 digits and no other characters</b>");
				}
				else if($array_names[$j] == "fax"){
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>must have 10 digits and no other characters</b>");
				}
				else if($array_names[$j] == "cell_phone"){
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>must have 10 digits and no other characters</b>");
				}
				else if($array_names[$j] == "alt_phone"){
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>must have 10 digits and no other characters</b>");
				}
				else if($array_names[$j] == "home_phone"){
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>must have 10 digits and no other characters</b>");
				}	
			}
			//check if email input for email1 or email2 is incorrect
			if($input != "" && strpos($input, '@') === FALSE && ($array_names[$j] == "email1" || $array_names[$j] == "email2")){
				array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>email must include @ (e.g. james123@aol)</b>");
			}
			//check if extension is numerical
			if($input != "" && preg_match("/[a-z]/i", $input) && $array_names[$j] == "extension"){
				array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>extension must only be numerical (e.g. 123)</b>");
			}
			//check if call back date input field is readable or date added is readable
			if(($array_names[$j] == "call_back_date" || $array_names[$j] == "date_added") && $input != ""){
				$call_back_date = explode("/", $input);
				$default_date = explode("-", $input);
				if(count($default_date) == 3){
					if($default_date[0] == "0000" && $default_date[1] == "00" && $default_date[2] == "00"){
						$input = "0000-00-00";
					}
				}
				else if(count($call_back_date) != 3){ //checks if date has length 3 for day, month, and year
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>incorrect data format (e.g 1/23/2016)</b>");
				}
				else{ //checks if numerical characters are in date
					for($ii = 0; $ii < count($call_back_date); $ii++){
						if(!is_numeric($call_back_date[$ii])){
							array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>unreadable date. Please check input</b>");
						}
					}
					$timeConversion = strtotime($input);
					$input = date("Y-m-d", $timeConversion);
				}
			}
			//checks if address line 3 is allowed to be entered or if country field has input
			if($foreign_country == FALSE && $array_names[$j] == "address_line_3" && $input != ""){
				array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>address line 3 only used for foreign countries. Can't leave country field blank</b>");
			}
			if($array_names[$j] == "country" && $input != ""){
				$foreign_country = TRUE;
			}
			//checks if type is input Client or Prospect
			if($array_names[$j] == "type" && $input != "" && $input != "Prospect" && $input != "Client"){
				array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>Can only be input <i> Prospect </i> or <i> Client </i>. Can also be left blank as default <i> Prospect </i></b>");
			}*/
			//adds current date for date_added field
			if($array_names[$j] == "date_added" && $input == ""){
				date_default_timezone_set('America/New_York');
				$input = date("Y-m-d");
			}
			if($array_names[$j] == "full_name" && $array_indexes[$j] != -1){
				$full_name = $input;
			}
			if($array_names[$j] == "address_line_1" && $array_indexes[$j] != -1){
				$address_line_1 = $input;
			}
			if($array_names[$j] == "business" && $array_indexes[$j] != -1){
				$business = $input;
			}
			
			//creates UPDATE and INSERT statements similtaneously
			//For UPDATE string, excludes the full_name and address_line_1 fields because they are keys
			//Excludes date_added because this field can't be changed once added to the table
			if($array_indexes[$j] != -1 || $array_names[$j] == "date_added"){
				$sql_add = $sql_add . '"' . $input . '",';
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . ' = "' . $input . '", ';
				}
			}
			else if(($array_indexes[$j] != -1 || $array_names[$j] == "date_added") && $j == count($array_indexes) - 1){
				$sql_add = $sql_add . $input . ',"' . $import_id . '", "' . $import_name . '", "Insert")';
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . ' = "' . $input . ', import_id = ' . $import_id . ', import_date = "' . $import_date . '", import_name = "' . $import_name .  '", import_status = "Update" WHERE full_name = "' . $full_name . '" AND address_line_1 = "' . $address_line_1 . '"';
				}
			}
			else if($array_indexes[$j] == -1 && $j != count($array_indexes) - 1){
				$sql_add = $sql_add . "' ',";
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . " = ' ', ";
				}
			}
			else{
				$sql_add = $sql_add . "'Prospect', " . $import_id . ", '" . $import_name . "', 'Insert')";
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . " = 'Prospect', import_id = " . $import_id . ", import_name = '" . $import_name . "', import_date = '" . $import_date .  "', import_status = 'Update' WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'";
				}
			}
		}
		$value_to_search = $full_name . "," . $address_line_1 . "," . $business;
		if(array_search($value_to_search, $key_search)){
			array_push($update_statements, $sql2);
		}
		else{
			$sql .= $sql_add;
			if($test_count >= 830){
				array_push($insert_statements, $sql);
				$sql = 'INSERT INTO sales (rep, quickbooks, prefix, full_name, suffix, title, phone, fax, extension, web_address, business, country, address_line_1, address_line_2, address_line_3, city, state, zipcode, status, call_back_date, priority, date_added, 
				mailing_list, pie_day, second_contact, cell_phone, alt_phone, home_phone, email1, email2, vertical1, vertical2, vertical3, source, notes, _2014_pie_day, Non_Profit_Card_08_2013, 
				Commercial_Card_08_2013, USPS_Post_Office_Mailing_03_2014, Contractor_Small_Business_Select_Mailing_03_2014, Contractor_SB_Select_Mailing_04_2014, USPS_EDDM_Regs_brochure_Mailing_04_2014,
				USPS_9Y9_EDDM_Marketing_Card, SEPT_2014_3_5Y11_CRST_Marketing_Card, Contractor_Mailing_2016, type, import_id, import_name, import_status) VALUES ';
				$test_count = -1;
			}
		}
		$test_count++;
}
if(count($error) == 0){
	
	for($i = 0; $i < count($insert_statements); $i++){
		echo $insert_statements[0];
		mysqli_query($conn, $insert_statements[$i]) or die("error querying database 2");
	}
	
	for($i = 0; $i < count($update_statements); $i++){
		mysqli_query($conn, $update_statements[$i]) or die("error querying database 3");
	}
	$job = "CSV file uploaded to CRM";
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$sql_timestamp = "INSERT INTO timestamp (user, time, job, a_p) VALUES ('$user_name', '$today', '$job', '$a_p')";
	mysqli_query($conn, $sql_timestamp) or die("error");
	header("location: uploadForm.php");
}
else{
	$_SESSION["import_errors"] = $error;
	header("location: uploadForm.php");
}
?>