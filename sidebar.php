
<div class="dataconsulate-left" style="top:0px;">
  <div class="logo"><a href="dashboard.php"><img id="crst_logo" src="images/crstlogo.png"></a></div>
  <div class="menu">
  <ul>
    <li><a href="post_offices.php"><i><img src="images/web-icons/postoffice.png"></i>Post Offices</a><div class="clear"></div></li>
    <li><a href="clients.php"><i><img src="images/web-icons/clients.png"></i>Clients<span></span></a><div class="clear"></div></li>
    <li><a href="vendors.php"><i><img src="images/web-icons/vendors.png"></i>Vendors</a><div class="clear"></div></li>
    <li><a href="documentation.php"><i><img src="images/web-icons/documentation.png"></i>Documentation</a><div class="clear"></div></li>
	<li><a href="reminders.php"><i><img src="images/web-icons/reminders.png"></i>Reminders</a><div class="clear"></div></li>
    <li><a href="weights_and_measure.php"><i><img src="images/web-icons/w_m.png"></i>Weights and Measures</a><div class="clear"></div></li>
	<li><a href="archive.php"><i><img src="images/web-icons/archive.png"></i>Archive Jobs</a><div class="clear"></div></li>
	<li><a href="job_ticket.php"><i><img src="images/web-icons/archive.png"></i>Job Ticket</a><div class="clear"></div></li>
  </ul>
  <?php
  require("connection.php");
  session_start();
  echo "<h3 style = 'text-align: center'>Live Updates</h3>";
  $user = $_SESSION['user'];
	$result = mysqli_query($conn,"SELECT * FROM timestamp WHERE processed_by='$user' ORDER BY time DESC LIMIT 5");
	echo " <ul id = 'edkoma'>";
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$time = strtotime($row['time']);
		$myFormatForView = date("M d, Y g:i", $time);
        echo "<li style = 'font-size: 11px'>" . $row['user'] . " " . $row['job'] ." on ".$myFormatForView. " ". $row['a_p']. "<li>"; 
    }
	
} else {
    echo "0 results from jobticket";
}
  ?>
  <div class="clear"></div>
  </div>
</div>

