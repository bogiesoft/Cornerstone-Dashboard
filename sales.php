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

$result = mysqli_query($conn,"SELECT job_ticket.job_id, job_ticket.client_name, job_ticket.project_name, job_ticket.due_date, job_ticket.estimate_number, mail_data.records_total FROM job_ticket INNER JOIN mail_data ON job_ticket.job_id = mail_data.job_id AND mail_data.processed_by = ''");

echo "<div class='content'>";
echo " <div id='table-scroll'><table id='table' class='sortable' border='1' cellspacing='2' cellpadding='2'  >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th></th><th> Job Id </th><th> Client name </th><th> Project Name </th><th> Due Date </th><th> Estimate Number </th><th> Records Total </th></tr>";
echo "</thead>";
echo "<tbody>";

if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		$foo = $row['job_id'];
		echo "<tr><th>"."<a href='http://localhost/crst_dashboard/edit_job.php?job_id=$foo'>"."Edit"."</a></th><td>".$row["job_id"]."</td><td>".  $row["client_name"]."</td><td>". $row["project_name"]. "</td><td>". $row["due_date"]. "</td><td>". $row["estimate_number"]."</td><td>". $row["records_total"]. "</td></tr>";
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