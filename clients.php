<?php
require ("header.php");
?>
<script src="sorttable.js"></script>
<style>
#table-scroll {
  height:auto;
  width:850px;
  overflow:auto;   
}

div.pager span {
    display: inline-block;
    width: 1.8em;
    height: 1.8em;
    line-height: 1.8;
    text-align: center;
    cursor: pointer;
    margin-right: 0.5em;
}

div.pager span.active {
    background: #c00;
}

</style>

<div class="content">
<div class="content-box">
<div class="topbar">
<h1>Clients</h1>
<a href="add_client.php" class="add_button">Add Client</a>
</div>
<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form action="client_search.php" method="post" >
				<label>Quick Search</label>
				<input id="search" name="frmSearch" type="text" placeholder="Search for a specific client">
				<input id="SubmitBtn" type="submit" value="SUBMIT" >
			</form>
		</div>
	</div>
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


$result = mysqli_query($conn,"SELECT * FROM client_info");


echo " <div id='table-scroll'><table id='table' border='1' cellspacing='2' cellpadding='2' class='sortable' >"; // start a table tag in the HTML
echo "<thead>";
echo "<tr><th>  </th><th> Client name </th><th> Contact name </th><th> Address </th><th> Contact Phone </th><th> Email </th><th> Website </th><th> Category </th><th> Title </th><th> Notes </th></tr>";
echo "</thead>";
echo "<tbody>";


if ($result->num_rows > 0) {
    // output data of each row
	
    while($row = $result->fetch_assoc()) {
		

		$foo=$row['client_name'];
		echo "<tr><th>"."<a href='edit_client.php?client_name=$foo'>"."Edit"."</a></th><td>".$row["client_name"]."</td><td>".  $row["contact_name"]."</td><td>". $row["client_add"]. "</td><td>". $row["contact_phone"]. "</td><td>". $row["contact_email"]."</td><td>". $row["website"]. "</td><td>". $row["category"]. "</td><td>". $row["title"]. "</td><td>". $row["notes"]. "</td></tr>";
    }
	echo "</tbody></table></div><br>";
} else {
    echo "0 results";
}

$conn->close();

?>

</div>
</div>		
</div>
<!--- script for making table sortable --->
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

	

	

						