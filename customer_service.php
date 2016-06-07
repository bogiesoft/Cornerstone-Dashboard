<?php
require ("header.php");
?>
<script src="sorttable.js"></script>
<div class="content">
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


$result = mysqli_query($conn,"SELECT * FROM invoice");


echo " <div id='table-scroll'><table id='table' border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th>  </th><th> Job Id </th><th> Client Name </th><th> Job Name </th><th> Postage </th><th> Invoice </th><th> Residual </th><th> Follow Up </th><th> Notes </th><th> Status </th><th> Reason </th></tr>";
echo "</thead>";
echo "<tbody>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		

		$foo=$row['job_id'];
		
		$result1 = mysqli_query($conn,"SELECT * FROM job_ticket WHERE job_id = $foo");
		$row1 = $result1->fetch_assoc();
		
		echo "<tr><th>"."<a href='http://localhost/crst_dashboard/edit_cs.php?job_id=$foo'>"."Edit"."</a></th><td>".$row["job_id"]."</td><td>". $row1["client_name"]. "</td><td>". $row1["project_name"]. "</td><td>".  $row["postage"]."</td><td>". $row["invoice_number"]. "</td><td>". $row["residual_returned"]. "</td><td>". $row["2week_followup"]."</td><td>". $row["notes"]. "</td><td>". $row["status"]. "</td><td>". $row["reason"]. "</td></tr>";
    }
	echo "</tbody></table></div><br>";
} else {
    echo "0 results";
}

$conn->close();

?>

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