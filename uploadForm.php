<?php
session_start();
$errors = array();

if(isset($_SESSION["import_errors"])){
	$errors = $_SESSION["import_errors"];
	$_SESSION["import_errors"] = array();
}
/*if(isset($_SESSION["test"])){
	die($_SESSION["test"][0]);
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Cornerstone Dashboard</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400|Montserrat" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="Upload-css/dc.css" type="text/css" />
        <link rel="stylesheet" href="Upload-css/scrollbar.css" type="text/css" />
        <link href="Upload-css/toastr.css" rel="stylesheet"/>
		<link rel="shortcut icon" type="image/png" href="images/favicon.ico">

        <script src="Upload-css/jquery.js"></script>
        <script src="Upload-css/toastr.js"></script>

        <script src="Upload-css/require.js"></script>
		<script src="sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" type="text/css" href="sweetalert/dist/sweetalert.css">

<script>
var CodeVersion = '3.0.8';
</script>

    </head>
<body>

            <div id="content">

<div id="header">
<h2>Import Data</h2>
<div class="actions">
<a id="back" href="CRM.php" class="action">Back To CRM</a>
</div>
</div>


<!--import files-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#upload").bind("click", function () {

                var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
                if (regex.test($("#fileUpload").val().toLowerCase())) {
                    if (typeof (FileReader) != "undefined") {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            var table = $("<table border='1' cellspacing='1' cellpadding='1'/>");
                            var rows = e.target.result.split("\n");

                                var row = $("<tr>");
                                var cells = rows[0].split(",");
                                //going through each cell name in CSV
                                for (var j = 0; j < cells.length; j++) {
                                    var cell = $('<tr td>');
                                    cell.html(cells[j]);
                                    row.append(cell);

									//add select options
									var selects = document.getElementsByClassName("import_dropdown");

									for(var i = 0; i < selects.length; i++){
										var option = document.createElement("option");
										option.text = cells[j];
										option.value = cells[j];
										option.name = cells[j];
										selects[i].add(option);
									}
                                }
                                table.append(row);

                            $("#dvCSV").html('');
                            $("#dvCSV").append(table);
							$('.selected').removeClass('selected');
							$(this).addClass("selected");
                        }
                        reader.readAsText($("#fileUpload")[0].files[0]);
                    } else {
                        alert("This browser does not support HTML5.");
                    }

                } else {
                    alert("Please upload a valid CSV file.");
                }
            });

        });
    </script>
    <input type="file" id="fileUpload" name = "fileUpload" form = "importForm"/>
    <input type="button" id="upload" value="Upload" onclick="this.disabled='disabled'"/>
    <hr />
	<ul style = "border: 2px solid #009966; border-radius: 5px; width: 70%; list-style-type: circle; list-style-position: inside; padding-left: 2%">
		<li>All input must not exceed max length of 45</li>
		<li><b>Full Name/Prefix/Suffix Fields:</b> No numerical characters allowed</li>
		<li><b>Phone/Fax Fields:</b> Must be 10 digit number with no other characters. (e.g 1234567899)</li>
		<li><b>Extension:</b> Can only be numerical(Do not include Ext. within)</li>
		<li><b>Call Back Date/Date Added:</b> Must be entered in correct date format as shown - month/day/year (e.g 3/31/2016)
			<ul style = "list-style-type: square; list-style-position: inside; padding-left: 2%">
				<li><i>Note - </i> Default for Date Added is current date</li>
			</ul>
		</li>
		<li><b>Email Fields: </b> Must include @gmail, @aol, @yahoo, etc. (e.g James123@gmail)</li>
		<li><b>Country: </b> Must only be used for a <u>FOREIGN</u> country or left blank. DO NOT enter United States in this field</li>
		<li><b>Address Line 3: </b> Only used for FOREIGN addresses and a Country field must be included</li>
		<li><b>Type: </b> Must either be <i> Prospect </i> or <i>Client</i>. Can also be left blank for default <i> Prospect </i></li>
	</ul>
	<fieldset>
		<div class="widget-corner-upper"></div>
			<div id="dvCSV">
			</div>
		<div class="widget-corner-lower"></div>
	</fieldset>
<!--import complete-->

</form>



	<!--map the fields with tha database fields-->
  <div id="set_map">
	<fieldset>
      <div class="widget-corner-upper"></div>

      <div id="map">
          <div id="data-fields"></div>
      <?php
		require("connection.php");
		
		$result = mysqli_query($conn,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'sales'");

		echo "<table id = 'import_table' border='1'>
		<tr>
			<td align=center> <b>Data Field</b></td><td>File Field</td>";
		if($result -> num_rows>0){
			while($data = $result->fetch_assoc()){
				if($data["COLUMN_NAME"] != "mark" && $data["COLUMN_NAME"] != "import_date" && $data["COLUMN_NAME"] != "import_id" && $data["COLUMN_NAME"] != "import_name" && $data["COLUMN_NAME"] != "import_status" && $data["COLUMN_NAME"] != "crid" && $data["COLUMN_NAME"] != "non_profit")
				{
					echo "<tr>";
					echo "<td align=center>$data[COLUMN_NAME]</td><td><select class = 'import_dropdown' name= $data[COLUMN_NAME] form = 'importForm' ><option value = 'none' style = 'display: none'>Choose one provided</option></select></td>";
					echo "</tr>";
				}
			}
		}else
			echo "no result";
		echo "</table>";
	?>
</div>
      <div class="widget-corner-lower"></div>
    </fieldset>

	<!--import button-->
	<form id = "importForm" action = "uploadForm_database.php" method = "POST" enctype="multipart/form-data">
	<label>Import Name</label><input name = "import_name">
    	<div id="instance-actions">
    	  <button id="import-accept" onclick = "displayLoading()">Import</button><img id = "loadImage" style = "display:none" src = "images/web-icons/loadingBar.gif" alt = "Smiley Face" height = "40" width = "40">
    	</div>
    </form>
	 <button id="import-accept" class = "import_history_button" onclick = "displayHistory()">Import History</button><img id = "loadImage" style = "display:none" src = "images/web-icons/loadingBar.gif" alt = "Smiley Face" height = "40" width = "40">
	<?php
		if(count($errors) > 0){
			echo "<h4>" . count($errors) . " error(s) found" . "</h4>";
			echo "<ul style = 'border: 2px solid #ff8080; border-radius: 5px; width: 68%; list-style-type: circle; list-style-position: inside; padding-left: 2%'>";
			for($i = 0; $i < count($errors); $i++){
				echo "<li>" . $errors[$i] . "</li>";
			}
			echo "</ul>";
		}
		
		echo "<div class = 'import_history_div' style = 'display: none'><br>";
		echo "<table id = 'import_history_table' border='1'>
		<tr>
			<td align=center><b>Import Name</b></td><td>Date</td><td>Delete</td><td>View</td>";
		
		$result_history = mysqli_query($conn, "SELECT DISTINCT import_id, import_date, import_name FROM sales WHERE import_id != 0 ORDER BY import_date DESC");
		
		if($result_history->num_rows>0){
			while($data = $result_history->fetch_assoc()){
				$id = $data["import_id"];
				echo "<tr>";
				echo "<td align=center>$data[import_name]</td><td>$data[import_date]</td><td><a onclick = 'return confirm(\"Are You Sure?\")' href = 'delete_import.php?id=$id'>Delete</a></td><td><a href = 'view_import.php?id=$id'>View</a></td>";
				echo "</tr>";
			}
		}else
			echo "no result";
		echo "</table>";
		echo "</div>";
	?>
   </div><!-- #set_map -->
   <div id="upload_file" class="hide">
<h3>Uploading...</h3>
<div class="bar-graph" id="import-progress">
  <div class="bar-value" style="width: 0%"></div>
  <span class="bar-value-label">0%</span>
</div>

    </body>
</html>
<script>

window.onload = function(){
		var errors = <?php echo json_encode($errors); ?>;
		number_errors = errors.length;
		
		if(number_errors > 0){
			showErrorMessage();
		}
		
		function showErrorMessage(){
		swal({   title: number_errors + " error(s) found",   text: "Errors listed below",   type: "warning",      confirmButtonColor: "#4FD8FC",   confirmButtonText: "OK",   closeOnConfirm: true }, 
			function(){ saveNotClicked=false; $( ".store-btn" ).click();});
		};
	}

function displayLoading()
{
	document.getElementById("loadImage").style.display = "block";
}
function displayHistory()
{
	if($(".import_history_button").text() == "Import History"){
		$(".import_history_div").show();
		$(".import_history_button").html("Hide History");
	}
	else{
		$(".import_history_div").hide();
		$(".import_history_button").html("Import History");
	}
}
</script>