<?php

require ("connection.php");
session_start();
$rep = $_POST["rep"];
	$quickbooks = $_POST["quickbooks"];
	$full_name = $_POST['full_name'];
	$address_line_1 = $_POST['address_line_1'];
	$address_line_2 = $_POST['address_line_2'];
	$business = $_POST['business'];
	$phone = $_POST['phone'];
	$email1 = $_POST['email1'];
	$source = $_POST['source'];
	$city = $_POST['city'];
	$web_address = $_POST['web_address'];
	$notes = $_POST['notes'];
	$title = $_POST['title'];
	$state = $_POST['state'];
	$zipcode = $_POST['zipcode'];
	$fax = $_POST['fax'];
	$status = $_POST['status'];
	$call_back_date = $_POST['call_back_date'];
	$priority = $_POST['priority'];
	$date_added = $_POST['date_added'];
	$second_contact = $_POST['second_contact'];
	$cell_phone = $_POST['cell_phone'];
	$pie_day = isset($_POST['pie_day']) ? $_POST['pie_day'] : '';
	$mailing_list = isset($_POST['mailing_list']) ? $_POST['mailing_list'] : '';
	$alt_phone = $_POST['alt_phone'];
	$home_phone = $_POST['home_phone'];
	$email2 = $_POST['email2'];
	$vertical1 = $_POST['vertical1'];
	$vertical2 = $_POST['vertical2'];
	$vertical3 = $_POST['vertical3'];
	$_2014_pie_day = isset($_POST['_2014_pie_day']) ? $_POST['_2014_pie_day'] : '';
	$Non_Profit_Card_08_2013 = isset($_POST['Non_Profit_Card_08_2013']) ? $_POST['Non_Profit_Card_08_2013'] : '';
	$Commercial_Card_08_2013 = isset($_POST['Commercial_Card_08_2013']) ? $_POST['Commercial_Card_08_2013'] : '';
	$USPS_Post_Office_Mailing_03_2014 = isset($_POST['USPS_Post_Office_Mailing_03_2014']) ? $_POST['USPS_Post_Office_Mailing_03_2014'] : '';
	$Contractor_Small_Business_Select_Mailing_03_2014 = isset($_POST['Contractor_Small_Business_Select_Mailing_03_2014']) ? $_POST['Contractor_Small_Business_Select_Mailing_03_2014'] : '';
	$Contractor_SB_Select_Mailing_04_2014 = isset($_POST['Contractor_SB_Select_Mailing_04_2014']) ? $_POST['Contractor_SB_Select_Mailing_04_2014'] : '';
	$USPS_EDDM_Regs_brochure_Mailing_04_2014 = isset($_POST['USPS_EDDM_Regs_brochure_Mailing_04_2014']) ? $_POST['USPS_EDDM_Regs_brochure_Mailing_04_2014'] : '';
	$USPS_9Y9_EDDM_Marketing_Card = isset($_POST['USPS_9Y9_EDDM_Marketing_Card']) ? $_POST['USPS_9Y9_EDDM_Marketing_Card'] : '';
	$SEPT_2014_3_5Y11_CRST_Marketing_Card = isset($_POST['SEPT_2014_3_5Y11_CRST_Marketing_Card']) ? $_POST['SEPT_2014_3_5Y11_CRST_Marketing_Card'] : '';
	$Contractor_Mailing_2016 = isset($_POST['Contractor_Mailing_2016']) ? $_POST['Contractor_Mailing_2016'] : '';
	$type = $_POST['type'];
	$user_name = $_SESSION['user'];
	date_default_timezone_set('America/New_York');
	$today = date("Y-m-d G:i:s");
	$a_p = date("A");
	$_SESSION['date'] = $today;
	$job = "added new client ";
	$sql = "INSERT INTO sales  (rep, quickbooks, full_name, address_line_1, address_line_2, phone,email1,source,web_address,notes,business,title, cell_phone, city, state, zipcode, fax, second_contact, status , call_back_date, priority, date_added, mailing_list, pie_day, alt_phone, home_phone, email2, vertical1, vertical2, vertical3, _2014_pie_day, Non_Profit_Card_08_2013 , Commercial_Card_08_2013 , USPS_Post_Office_Mailing_03_2014 , Contractor_Small_Business_Select_Mailing_03_2014 , Contractor_SB_Select_Mailing_04_2014, USPS_EDDM_Regs_brochure_Mailing_04_2014 , USPS_9Y9_EDDM_Marketing_Card, SEPT_2014_3_5Y11_CRST_Marketing_Card , Contractor_Mailing_2016,type) VALUES ('$rep','$quickbooks','$full_name','$address_line_1','$address_line_2','$phone','$email1','$source','$web_address','$notes','$business','$title' , '$cell_phone' , '$city' , '$state' , '$zipcode' , '$fax' , '$second_contact', '$status' , '$call_back_date' , '$priority'  , '$date_added' , '$mailing_list' , '$pie_day' , '$alt_phone' , '$home_phone'  , '$email2' , '$vertical1' , '$vertical2', '$vertical3' , '$_2014_pie_day', '$Non_Profit_Card_08_2013' , '$Commercial_Card_08_2013' , '$USPS_Post_Office_Mailing_03_2014' , '$Contractor_Small_Business_Select_Mailing_03_2014', '$Contractor_SB_Select_Mailing_04_2014', '$USPS_EDDM_Regs_brochure_Mailing_04_2014' , '$USPS_9Y9_EDDM_Marketing_Card' , '$SEPT_2014_3_5Y11_CRST_Marketing_Card' , '$Contractor_Mailing_2016', '$type')";
	$sql6 = "INSERT INTO timestamp (user,time,job, a_p) VALUES ('$user_name', '$today','$job', '$a_p')";
	$result7 = $conn->query($sql6) or die('Error querying database 5.');
	$result = $conn->query($sql) or die('Error querying database.');
	$conn->close();
	header("location:clients.php");
	exit();

?>


