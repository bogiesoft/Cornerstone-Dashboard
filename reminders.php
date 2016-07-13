<?php
require('header.php');
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Reminders</h1>
	<a class="pull-right" href="add_rem.php" class="add_button">Add Reminder</a>
	</div>
<div class="dashboard-detail">
<div class="clear"></div>
<div class="reminders">
<?php
require ("connection.php");
//session_start();


$result = mysqli_query($conn,"SELECT * FROM reminder WHERE date = CURDATE() AND occurence = 'Once'");
$result1 = mysqli_query($conn,"SELECT * FROM reminder WHERE date BETWEEN DATE_ADD(CURDATE(),INTERVAL 1 DAY) AND DATE_ADD(CURDATE(), INTERVAL 5 DAY) AND occurence = 'Once'");
date_default_timezone_set('America/New_York');
$day = date("D");
$result2 = mysqli_query($conn, "SELECT * FROM reminder WHERE occurence = 'Weekly' AND current_day = '$day'");
$result3 = mysqli_query($conn, "SELECT * FROM reminder WHERE occurence = 'Monthly'");
$result4 = mysqli_query($conn, "SELECT * FROM reminder WHERE occurence = 'Yearly'");

$count = 1;

if ($result->num_rows > 0) {
    // output data of each row
	echo "<h2>Today's Reminders:</h2>";
	
    while($row = $result->fetch_assoc()) {
		$text = $row['text'];
		if($row['user'] == $_SESSION['user'] ){
			if($row['text'] == ""){
				$text = "BLANK";
			}
			$foo = $row["id"];
			echo $count . ". " . "<a href = edit_reminder.php?id=$foo><u>" . $text."</u></a><br>";
			if($row["vendor_name"] != "None"){
				echo "<b style = 'font-size: 12px; margin-left: 16px'>Info:</b>";
				$foo = $row["vendor_name"];
				echo "<i style = 'font-size: 11px; margin-left: 5px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				
				if($row["client_name"] != "None"){
					$foo = $row['client_name'];
					echo "<i style = 'margin-left: 20px; font-size: 11px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				}
			}
			else if($row["client_name"] != "None"){
				echo "<b style = 'font-size: 12px; margin-left: 16px'>Info: </b>";
				$foo = $row['client_name'];
				echo "<i style = 'font-size: 11px; margin-left: 5px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				
				if($row["vendor_name"] != "None"){
					$foo = $row["vendor_name"];
					echo "<i style = 'margin-left: 20px; font-size: 11px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				}
			}
		}
		
		echo "<br>";
		
		$count = $count + 1;
		
    }
} 

echo "<br>";

if ($result1->num_rows > 0) {
    // output data of each row
	echo "<h2>Upcoming Reminders:</h2>";
	
    while($row = $result1->fetch_assoc()) {
		$text = $row['text'];
		if($row['user'] == $_SESSION['user'] ){
			if($row['text'] == ""){
				$text = "BLANK";
			}
			$foo = $row["id"];
			$time = strtotime($row['date']);
			$myFormatForView = date("M d, Y", $time);
			echo "<i>" . $myFormatForView."</i>: ". "<a href = 'edit_reminder.php?id=$foo'>" . $text."</a><br>";
			if($row["vendor_name"] != "None"){
				echo "<b style = 'font-size: 12px; margin-left: 16px'>Info:</b>";
				$foo = $row["vendor_name"];
				echo "<i style = 'font-size: 11px; margin-left: 5px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				
				if($row["client_name"] != "None"){
					$foo = $row['client_name'];
					echo "<i style = 'margin-left: 20px; font-size: 11px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				}
			}
			else if($row["client_name"] != "None"){
				echo "<b style = 'font-size: 12px; margin-left: 16px'>Info: </b>";
				$foo = $row['client_name'];
				echo "<i style = 'font-size: 11px; margin-left: 5px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				
				if($row["vendor_name"] != "None"){
					$foo = $row["vendor_name"];
					echo "<i style = 'margin-left: 20px; font-size: 11px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				}
			}
			
			echo "<br>";
		}
		
    }
}
echo "<br>";
$count = 1;
if($result2->num_rows > 0){
	echo "<h2>Weekly Reminders: </h2>";
	
	while($row = $result2->fetch_assoc()) {
		$text = $row['text'];
		if($row['user'] == $_SESSION['user'] ){
			if($row['text'] == ""){
				$text = "BLANK";
			}
			$foo = $row["id"];
			echo $count . ". " . "<a href = edit_reminder.php?id=$foo><u>" . $text."</u></a><br>";
			if($row["vendor_name"] != "None"){
				echo "<b style = 'font-size: 12px; margin-left: 16px'>Info:</b>";
				$foo = $row["vendor_name"];
				echo "<i style = 'font-size: 11px; margin-left: 5px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				
				if($row["client_name"] != "None"){
					$foo = $row['client_name'];
					echo "<i style = 'margin-left: 20px; font-size: 11px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				}
			}
			else if($row["client_name"] != "None"){
				echo "<b style = 'font-size: 12px; margin-left: 16px'>Info: </b>";
				$foo = $row['client_name'];
				echo "<i style = 'font-size: 11px; margin-left: 5px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				
				if($row["vendor_name"] != "None"){
					$foo = $row["vendor_name"];
					echo "<i style = 'margin-left: 20px; font-size: 11px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				}
			}
		}
		
		echo "<br>";
		
		$count = $count + 1;
		
    }
}
echo "<br>";

if(date("j") >= 1 && date("j") <= 4)
{
	if($result3->num_rows > 0){
		echo "<h2>Monthly Reminders: </h2>";
		
		while($row = $result3->fetch_assoc()) {
			$text = $row['text'];
			if($row['user'] == $_SESSION['user'] ){
				if($row['text'] == ""){
					$text = "BLANK";
				}
				$foo = $row["id"];
				echo $count . ". " . "<a href = edit_reminder.php?id=$foo><u>" . $text."</u></a><br>";
				if($row["vendor_name"] != "None"){
					echo "<b style = 'font-size: 12px; margin-left: 16px'>Info:</b>";
					$foo = $row["vendor_name"];
					echo "<i style = 'font-size: 11px; margin-left: 5px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				
					if($row["client_name"] != "None"){
						$foo = $row['client_name'];
						echo "<i style = 'margin-left: 20px; font-size: 11px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
					}
				}
				else if($row["client_name"] != "None"){
					echo "<b style = 'font-size: 12px; margin-left: 16px'>Info: </b>";
					$foo = $row['client_name'];
					echo "<i style = 'font-size: 11px; margin-left: 5px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				
					if($row["vendor_name"] != "None"){
						$foo = $row["vendor_name"];
						echo "<i style = 'margin-left: 20px; font-size: 11px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
					}
				}
			}
		
			echo "<br>";
		
			$count = $count + 1;
		
		}
	}
}

echo "<br>";

if(date("n") == 1 && date("j") >= 1 && date("j") <= 4){
	if($result4->num_rows > 0){
		echo "<h2>Yearly Reminders: </h2>";
		
		while($row = $result4->fetch_assoc()) {
			$text = $row['text'];
			if($row['user'] == $_SESSION['user'] ){
				if($row['text'] == ""){
					$text = "BLANK";
				}
				$foo = $row["id"];
				echo $count . ". " . "<a href = edit_reminder.php?id=$foo><u>" . $text."</u></a><br>";
				if($row["vendor_name"] != "None"){
					echo "<b style = 'font-size: 12px; margin-left: 16px'>Info:</b>";
					$foo = $row["vendor_name"];
					echo "<i style = 'font-size: 11px; margin-left: 5px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
				
					if($row["client_name"] != "None"){
						$foo = $row['client_name'];
						echo "<i style = 'margin-left: 20px; font-size: 11px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
					}
				}
				else if($row["client_name"] != "None"){
					echo "<b style = 'font-size: 12px; margin-left: 16px'>Info: </b>";
					$foo = $row['client_name'];
					echo "<i style = 'font-size: 11px; margin-left: 5px'>Client Name: </i><a style = 'font-size: 12px' href = 'edit_client.php?client_name=$foo'>" . $row["client_name"] . "</a>";
				
					if($row["vendor_name"] != "None"){
						$foo = $row["vendor_name"];
						echo "<i style = 'margin-left: 20px; font-size: 11px'>Vendor Name: </i><a style = 'font-size: 12px' href = 'search_vendor.php?vendor_name=$foo'>" . $row["vendor_name"] . "</a>";
					}
				}
			}
		
			echo "<br>";
		
			$count = $count + 1;
		
		}
	}
}

$conn->close();
?>
</div>
</div>
</div>		