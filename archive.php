<script src="sorttable.js"></script>
<?php
require ("header.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname= "crst_dashboard";

// Create Connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$result = mysqli_query($conn,"SELECT * FROM archive_jobs");

echo "<div class='content'>";
echo " <div id='table-scroll'><table id='table' class='sortable' border='1' cellspacing='2' cellpadding='2'  >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th> Job Id </th><th> Client name </th><th> Project Name </th><th> Records Total </th><th> Invoice </th><th> Archived Date </th><th> Reason </th></tr>";
echo "</thead>";
echo "<tbody>";

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		
		$foo = $row["job_id"];
		
		echo "<tr><td><a href = 'edit_archive.php?job_id=$foo'>".$row["job_id"]."</a></td><td>".  $row["client_name"]."</td><td>". $row["project_name"]. "</td><td>". $row["records_total"]. "</td><td>". $row["invoice_number"]."</td><td>". $row["archive_date"]. "</td><td>". $row["reason"]. "</td></tr>";
    }
	echo "</tbody></table></div><br>";
} else {
    echo "0 results";
}
echo "</div>";
//class='paginated'
?>
<script>
$('table.sortable').each(function() {
    var currentPage = 0;
    var numPerPage = 50;
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
