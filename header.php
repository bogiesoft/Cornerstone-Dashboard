<?php 
require('head.php');
require('sidebar.php');
require("connection.php");
//session_start();
$temp = $_SESSION["user"];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT title FROM users WHERE user = '$temp'";
$result = mysqli_query($conn, $sql);

$row = $result->fetch_assoc();

$title = $row['title'];
$_SESSION['title'] = $title;

?>
<div class="dataconsulate-right">
	<div class="right-topmenu" style="top:0px;">
		<div class="righttop-leftmenu">
		<ul>
			<li><a href="customer_service.php">CUSTOMER SERVICE</a></li>
			<li><a href="production.php">PRODUCTION</a></li>
			<li><a href="project_management.php">PROJECT MANAGEMENT</a></li>
			<li><a href="sales.php">SALES</a></li>
		</ul>
		</div>
			<div class="righttop">
			<li class="dropdown">
				<a class="dropbtn"><i class="icon"><img src="images/web-icons/user.png"></i><?php echo $temp; ?></a>
					<div class="dropdown-content">
					<a href="logout.php">Log Out</a>
					<?php
					if($title == "ADMIN"){
						echo "<a href='admin.php'>Accounts</a>";
					}
					?>
					</div>
			</li>
			</div>
	</div>
