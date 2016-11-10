<?php
session_start();
require("connection.php");
$data = array();
$handle = fopen($_FILES['fileUpload']["tmp_name"], 'r');
while($row = fgetcsv($handle , 100000 , ",")) {
   $data[] = $row;
}

//Get all Column names in array
$array_names = array();
$result = mysqli_query($conn,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'sales'");
while($row = $result->fetch_assoc())
{
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

for($i = 1; $i < count($data); $i++) //goes through all rows in csv file
{
		$sql = 'INSERT INTO sales (rep, quickbooks, prefix, full_name, suffix, title, phone, fax, extension, web_address, business, address_line_1, address_line_2, address_line_3, city, state, zipcode, status, call_back_date, priority, date_added, 
				mailing_list, pie_day, second_contact, cell_phone, alt_phone, home_phone, email1, email2, vertical1, vertical2, vertical3, source, notes, _2014_pie_day, Non_Profit_Card_08_2013, 
				Commercial_Card_08_2013, USPS_Post_Office_Mailing_03_2014, Contractor_Small_Business_Select_Mailing_03_2014, Contractor_SB_Select_Mailing_04_2014, USPS_EDDM_Regs_brochure_Mailing_04_2014,
				USPS_9Y9_EDDM_Marketing_Card, SEPT_2014_3_5Y11_CRST_Marketing_Card, Contractor_Mailing_2016, type) VALUES (';
		
		$sql2 = 'UPDATE sales SET ';
		$full_name = "";
		$address_line_1 = "";
		
		for($j = 0; $j < count($array_indexes); $j++){ //goes through all corresponding indexes to headers and adds to sql statements for insert and update as specified
			$input = "";
			//quotes are read by replacing with \"
			if($array_indexes[$j] != -1){
				$input = str_replace('"', '\"', $data[$i][$array_indexes[$j]]);
				$input = str_replace("'", "\'", $input); 
			}
			//check if all phone/fax fields are valid inputs
			if($input != "" && (strlen($input) != 10 || preg_match("/[a-z]/i", $input)) && ($array_names[$j] == "phone" || $array_names[$j] == "fax" || $array_names[$j] == "cell_phone" || $array_names[$j] == "alt_phone" || $array_names[$j] == "home_phone")){
				if($array_names[$j] == "phone"){
					die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Phone number not valid(eg: 8452555722)");
				}
				else if($array_names[$j] == "fax"){
					die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Fax number not valid(eg: 8452555722)");
				}
				else if($array_names[$j] == "cell_phone"){
					die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Cell Phone number not valid(eg: 8452555722)");
				}
				else if($array_names[$j] == "alt_phone"){
					die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Alternate Phone number not valid(eg: 8452555722)");
				}
				else if($array_names[$j] == "home_phone"){
					die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Home Phone number not valid(eg: 8452555722)");
				}
					
			}
			//check if email input for email1 or email2 is incorrect
			if($input != "" && strpos($input, '@') === FALSE && ($array_names[$j] == "email1" || $array_names[$j] == "email2")){
				die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": @ symbol needed in email(eg stevo123@gmail)");
			}
			//check if extension is numerical
			if($input != "" && preg_match("/[a-z]/i", $input) && $array_names[$j] == "extension"){
				die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Extension number not valid(eg: 123)");
			}
			//check if call back date input field is readable or date added is readable
			if(($array_names[$j] == "call_back_date" || $array_names[$j] == "date_added") && $input != ""){
				$call_back_date = explode("/", $input);
				if(count($call_back_date) != 3){ //checks if date has length 3 for day, month, and year
					die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Date might be missing day, month, or year(eg: 1/23/2016) or must be left blank");
				}
				else{ //checks if numerical characters are in date
					for($ii = 0; $ii < count($call_back_date); $ii++){
						if(!is_numeric($call_back_date[$ii])){
							die("error in row " . ($i + 1) . " column header " . $array_names[$j] . ": Date might have non numerical character(eg: 1/23/2016)");
						}
					}
				}
				$timeConversion = strtotime($input);
				$input = date("Y-m-d", $timeConversion);
				
			}
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
			
			//creates UPDATE and INSERT statements similtaneously
			//For UPDATE string, excludes the full_name and address_line_1 fields because they are keys
			//Excludes date_added because this field can't be changed once added to the table
			if($array_indexes[$j] != -1 || $array_names[$j] == "date_added"){
				$sql = $sql . '"' . $input . '",';
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . ' = "' . $input . '", ';
				}
			}
			else if(($array_indexes[$j] != -1 || $array_names[$j] == "date_added") && $j == count($array_indexes) - 1){
				$sql = $sql . $input . ')';
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . ' = "' . $input . '" WHERE full_name = "' . $full_name . '" AND address_line_1 = "' . $address_line_1 . '"';
				}
			}
			else if($array_indexes[$j] == -1 && $j != count($array_indexes) - 1){
				$sql = $sql . "' ',";
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . " = ' ', ";
				}
			}
			else{
				$sql = $sql . "'Prospect')";
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . " = ' ' WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'";
				}
			}
		}
		
		//checks if already in database and will either update or insert
		$result_match = mysqli_query($conn, "SELECT * FROM sales WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'");
		$rows = mysqli_num_rows($result_match);
		if($rows == 0){
			mysqli_query($conn, $sql) or die("error");
		}
		else{
			mysqli_query($conn, $sql2) or die("error");
		}

}

$job = "CSV file uploaded to CRM";
$user_name = $_SESSION['user'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d G:i:s");
$a_p = date("A");
$sql_timestamp = "INSERT INTO timestamp (user, time, job, a_p) VALUES ('$user_name', '$today', '$job', '$a_p')";
mysqli_query($conn, $sql_timestamp);
header("location: uploadForm.php");
?>
