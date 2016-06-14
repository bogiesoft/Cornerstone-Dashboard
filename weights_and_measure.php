<?php
require('header.php');
?>
<script src="sorttable.js"></script>
<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Weights and Measures</h1>
<a href="add_wm.php" class="add_button">Add Weights and Measure</a>
</div>

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
$result = mysqli_query($conn,"SELECT * FROM materials");
echo "<table  border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th> Job ID </th><th> Client Name </th><th> Job Name </th><th> Recieved Date </th><th> Location </th><th> Checked In </th><th> Material </th><th> Type </th><th> Quantity </th><th> Vendor </th><th> Height </th><th> Weight </th><th> Size </th><th> Based On </th></tr>";
echo "</thead>";
if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		
		$job_id = $row['job_id'];
		
		$result1 = mysqli_query($conn,"SELECT client_name,project_name FROM job_ticket WHERE job_id='$job_id' ");
		    while($row1 = $result1->fetch_assoc()){
				$client_name = $row1["client_name"];
				$project_name = $row1["project_name"];
			}
		
		
		
		
		echo "<tr><td><a href = 'edit_wm.php?job_id=$job_id'>".$row["job_id"]."</a></td><td>".$client_name."</td><td>".$project_name."</td><td>". $row["received"]. "</td><td>". $row["location"]."</td><td>". $row["checked_in"]. "</td><td>". $row["material"]. "</td><td>". $row["type"]. "</td><td>". $row["quantity"]. "</td><td>". $row["vendor"]. "</td><td>". $row["height"]. "</td><td>". $row["weight"]. "</td><td>". $row["size"]. "</td><td>". $row["based_on"]. "</td></tr>";
    }
	echo "<br>";
} else {
    echo "0 results";
}
$conn->close();
?>

</div>
</div>
<script>
$('table.sortable').each(function() {
    var currentPage = 0;
    var numPerPage = 10;
    var $table = $(this);
    $table.bind('repaginate', function() {
        $table.find('tbody tr').hide().slice(currentPage * numPerPage, (currentPage + 1) * numPerPage).show();
    });
    $table.trigger('repaginate');
    var numRows = $table.find('tbody tr').length;
    var numPages = Math.ceil(numRows / numPerPage);
    var $pager = $('<div class="pager"></div>');
    for (var page = 0; page < numPages; page++) {
        $('<span class="page-number"></span>').text(page + 1).bind('click', {
            newPage: page
        }, function(event) {
            currentPage = event.data['newPage'];
            $table.trigger('repaginate');
            $(this).addClass('active').siblings().removeClass('active');
        }).appendTo($pager).addClass('clickable');
    }
    $pager.insertBefore($table).find('span.page-number:first').addClass('active');
});

$("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
               $(this).hide();
            else
               $(this).show();                
        });
    }); 

</script>		