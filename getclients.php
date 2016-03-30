<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$result = mysqli_query($conn,"SELECT * FROM client_info");
echo "Results from clientinfo:"."<br>"."<br>";
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br>"."Client: " . $row["client_name"]. "<br>". "Address: " . $row["client_add"]. "<br>". "Contact Name: " . $row["contact_name"]. "<br>". "Contact Phobe: " . $row["contact_phone"]. "<br>". "Email: " . $row["contact_email"]. "<br>". "Website: " . $row["website"]. "<br>". "Category: " . $row["category"]. "<br>". "Title: " . $row["title"]. "<br>". "Notes: " . $row["notes"]. "<br>";
    }
	echo "<br>";
} else {
    echo "0 results";
}

$conn->close();

?>