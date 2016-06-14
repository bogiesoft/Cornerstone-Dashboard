<?php 
require('head.php');
require('sidebar.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
session_start();
$temp = $_SESSION["user"];



?>

<nav id="navbar">
<a href="dashboard.php"><img id="crst_logo" src="images/crstlogo.png"></a>
		<ul>
			<li><a href="customer_service.php">CUSTOMER SERVICE</a></li>
			<li><a href="production.php">PRODUCTION</a></li>
			<li><a href="project_management.php">PROJECT MANAGEMENT</a></li>
			<li><a href="sales.php">SALES</a></li>
			<li id="profile" class="dropdown">
				<a class="dropbtn"><i class="icon"><img src="images/web-icons/user.png"></i><?php echo $temp; ?></a>
				<div class="dropdown-content">
				<a href="index.php">Logout</a>
				</div>
				
			</li>
		</ul>
		
</nav>
