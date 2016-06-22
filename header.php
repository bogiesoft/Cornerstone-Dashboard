<?php 
require('head.php');
require('sidebar.php');
require("connection.php");
session_start();
$temp = $_SESSION["user"];



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
					<a href="#">Log Out</a>
					</div>
			</li>
			</div>
	</div>
