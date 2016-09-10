<?php
//For uploading to work, you have to modify php.ini according to your need, for example, the upload max size, the max timeout time
$target_dir = "../../mysql/data/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
/*if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}*/
// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    $sql = "LOAD DATA INFILE './". $_FILES["fileToUpload"]["name"]."' INTO TABLE sales 
   FIELDS TERMINATED BY '\t'
LINES TERMINATED BY '\r'
IGNORE 1 LINES
(rep, quickbooks, full_name, title, phone, fax, web_address, business, address_line_1, address_line_2, city, state, zipcode, status, @var1, priority, @var2, mailing_list, pie_day, second_contact, cell_phone, alt_phone, home_phone, email1, email2, vertical1, vertical2, vertical3, source, notes, _2014_pie_day, Non_Profit_Card_08_2013, Commercial_Card_08_2013, USPS_Post_Office_Mailing_03_2014, Contractor_Small_Business_Select_Mailing_03_2014, Contractor_SB_Select_Mailing_04_2014, USPS_EDDM_Regs_brochure_Mailing_04_2014, USPS_9Y9_EDDM_Marketing_Card, SEPT_2014_3_5Y11_CRST_Marketing_Card, Contractor_Mailing_2016, type) 
SET call_back_date = STR_TO_DATE(@var1, '%m/%d/%Y'), date_added = STR_TO_DATE(@var2, '%m/%d/%Y')";

    $result = $conn->query($sql) or die('Error querying database.');


$conn->close();
?>