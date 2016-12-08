<?php
session_start();
require("connection.php");
require("head.php");
$data = array();
$handle = fopen($_FILES['fileUpload']["tmp_name"], 'r');
while($row = fgetcsv($handle , 100000 , ",")) {
   $data[] = $row;
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
	if($row['COLUMN_NAME'] != "mark" && $row['COLUMN_NAME'] != "import_date" && $row["COLUMN_NAME"] != "import_id" && $row["COLUMN_NAME"] != "import_name" && $row["COLUMN_NAME"] != "import_status")
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
$sql_statements = array();
$update_statements = array();


for($i = 1; $i < count($data); $i++) //goes through all rows in csv file
{
		$sql = 'INSERT INTO sales (rep, quickbooks, prefix, full_name, suffix, title, phone, fax, extension, web_address, business, country, address_line_1, address_line_2, address_line_3, city, state, zipcode, status, call_back_date, priority, date_added, 
				mailing_list, pie_day, second_contact, cell_phone, alt_phone, home_phone, email1, email2, vertical1, vertical2, vertical3, source, notes, _2014_pie_day, Non_Profit_Card_08_2013, 
				Commercial_Card_08_2013, USPS_Post_Office_Mailing_03_2014, Contractor_Small_Business_Select_Mailing_03_2014, Contractor_SB_Select_Mailing_04_2014, USPS_EDDM_Regs_brochure_Mailing_04_2014,
				USPS_9Y9_EDDM_Marketing_Card, SEPT_2014_3_5Y11_CRST_Marketing_Card, Contractor_Mailing_2016, type, import_id, import_name, import_status) VALUES (';
		
		$sql2 = 'UPDATE sales SET ';
		$full_name = "";
		$address_line_1 = "";
		$foreign_country = FALSE;
		
		for($j = 0; $j < count($array_indexes); $j++){ //goes through all corresponding indexes to headers and adds to sql statements for insert and update as specified
			$input = "";
			//quotes are read by replacing with \"
			if($array_indexes[$j] != -1){
				$input = str_replace('"', '\"', $data[$i][$array_indexes[$j]]);
				$input = str_replace("'", "\'", $input); 
			}
			//check if input is greater than 45
			if(strlen($input) > 45){
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
				if(count($call_back_date) != 3){ //checks if date has length 3 for day, month, and year
					array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>incorrect data format (e.g 1/23/2016)</b>");
				}
				else{ //checks if numerical characters are in date
					for($ii = 0; $ii < count($call_back_date); $ii++){
						if(!is_numeric($call_back_date[$ii])){
							array_push($error, "error in row " . ($i + 1) . " column header " . $_POST[$array_names[$j]] . " applied to " . $array_names[$j] . ": <b>unreadable date. Please check input</b>");
						}
					}
				}
				$timeConversion = strtotime($input);
				$input = date("Y-m-d", $timeConversion);
				
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
				$sql = $sql . $input . ',"' . $import_id . '", "' . $import_name . '", "Insert")';
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . ' = "' . $input . ', import_id = ' . $import_id . ', import_date = "' . $import_date . '", import_name = "' . $import_name .  '", import_status = "Update" WHERE full_name = "' . $full_name . '" AND address_line_1 = "' . $address_line_1 . '"';
				}
			}
			else if($array_indexes[$j] == -1 && $j != count($array_indexes) - 1){
				$sql = $sql . "' ',";
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . " = ' ', ";
				}
			}
			else{
				$sql = $sql . "'Prospect', " . $import_id . ", '" . $import_name . "', 'Insert')";
				if($array_names[$j] != "full_name" && $array_names[$j] != "address_line_1" && $array_names[$j] != "date_added"){
					$sql2 = $sql2 . $array_names[$j] . " = 'Prospect', import_id = " . $import_id . ", import_name = '" . $import_name . "', import_date = '" . $import_date .  "', import_status = 'Update' WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'";
				}
			}
		}
		
		//checks if already in database and will either update or insert
		//only does import if $error array is empty
		$result_match = mysqli_query($conn, "SELECT * FROM sales WHERE full_name = '$full_name' AND address_line_1 = '$address_line_1'");
		$rows = mysqli_num_rows($result_match);
		if($rows == 0){
			array_push($sql_statements, $sql);
		}
		else{
			//array_push($sql_statements, $sql2);
			array_push($update_statements, $sql2);
		}

}

if(count($error) == 0){
	for($i = 0; $i < count($sql_statements); $i++){
		mysqli_query($conn, $sql_statements[$i]) or die("error querying database");
	}
	$job = "CSV file uploaded to CRM";
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$sql_timestamp = "INSERT INTO timestamp (user, time, job, a_p) VALUES ('$user_name', '$today', '$job', '$a_p')";
	mysqli_query($conn, $sql_timestamp);
}
else{
	$_SESSION["import_errors"] = $error;
}
?>
<script>
//sweetalert error message displayed if more than 1 error or sucess message if 0 errors
	var error_string = "";
	var number_errors = 0;
	var update_statements = <?php echo json_encode($update_statements); ?>;
	window.onload = function(){
		var errors = <?php echo json_encode($error); ?>;
		number_errors = errors.length;
		number_updates = update_statements.length;
		for(var i = 0; i < errors.length; i++){
			error_string = error_string + errors[i] + "\n";
		}
		if(errors.length > 0){
			window.location.replace("uploadForm.php");
		}
		else if(number_updates > 0){
			warnBeforeRedirect();
		}
		else{
			showSuccessMessage();
		}
		
		function showSuccessMessage(){
		swal({   title: "Import Successful!",   text: "Redirecting...",   type: "success",      confirmButtonColor: "#4FD8FC",   closeOnConfirm: false }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});  
			 window.setTimeout(function () {
			location.href = "uploadForm.php";
			}, 2000);
		};
		function warnBeforeRedirect() {
		swal({   title: number_updates + " clients will be updated with inserted clients",   text: "Would you like to update duplicate clients?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, update all!",   closeOnConfirm: false }, 
			function(isConfirm){ if(isConfirm){ 
			 $.ajax({
                    type: "POST",
                    url: 'storeUpdatesSession.php',
                    data: {updates_array : update_statements},
                    success: function(data)
                    {
                        location.href = "uploadForm.php";
                    }
                });
	} 
		else{window.setTimeout(function () {
			location.href = "uploadForm.php";
			}, 1000);};  
		});
		};  
	}
	
</script>