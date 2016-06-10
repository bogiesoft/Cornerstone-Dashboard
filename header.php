<?php 
require('head.php');
require('sidebar.php');
require ("connection.php");
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
