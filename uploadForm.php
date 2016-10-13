
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>DataConsulate</title>

        <link href="//fonts.googleapis.com/css?family=Lato:300,400|Montserrat" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="/Cornerstone-Dashboard/media/dc.css" type="text/css" />
        <link rel="stylesheet" href="/Cornerstone-Dashboard/media/scrollbar.css" type="text/css" />
        <link href="/Cornerstone-Dashboard/thirdparty/toastr.css" rel="stylesheet"/>

        <script src="/Cornerstone-Dashboard/thirdparty/jquery.js"></script>
        <script src="/Cornerstone-Dashboard/thirdparty/toastr.js"></script>

        <script src="/Cornerstone-Dashboard/script/lib/require.js"></script>

<script>
var CodeVersion = '3.0.8';
</script>

    </head>
<body>

            <div id="content">

<div id="header">
<h2>Import Data</h2>
<div class="actions">
<a id="back" href="/Cornerstone-Dashboard/sales.php" class="action">Back To Sales</a>
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
			
			    $("#display").click(function() {                

					$.ajax({    //create an ajax request to load_page.php
						type: "GET",
						url: "uploadForm_database.php",             
						dataType: "html",   //expect html to be returned                
						success: function(response){                    
							$("#responsecontainer").html(response); 
							//alert(response);
						}

					});
				});
        });
    </script>
    <input type="file" id="fileUpload" />
    <input type="button" id="upload" value="Upload" />
    <hr />
	<fieldset>
		<div class="widget-corner-upper"></div>
			<div id="dvCSV">
			</div>
			<!--for database headers-->
			
			<table border="1" align="center">
				<tr>
					<td> <input type="button" id="display" value="Display All Data" /> </td>
				</tr>
			</table>
			<div id = "responsecontainer" style="height:100px; overflow:auto;">
			</div>
			<!--for database headers-->
		<div class="widget-corner-lower"></div>
	</fieldset>
<!--import complete-->

</form>
		

		
	<!--map the fields with tha database fields-->
  <div id="set_map">
	<fieldset>
      <div class="widget-corner-upper"></div>
      <legend>Map Fields</legend>

     <div id="map-actions">
         <button class="small" id="address-add">+ Address</button>
         <button class="small" id="contribution-add">+ Contribution</button>
         <button class="small" id="custom-add">+ Custom</button>
         <button class="small" id="campaign-add">+ Campaign</button>
     </div>

      <div id="map">
          <div id="data-fields"></div>
      <?php
require("connection.php");

$result = mysqli_query($conn,"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'sales'");

echo "<table id = 'import_table' border='1' >
<tr>
<td align=center> <b>Data Field</b></td><td>File Field</td>";
if($result -> num_rows>0){
while($data = $result->fetch_assoc())
{   
    echo "<tr>";
    echo "<td align=center>$data[COLUMN_NAME]</td><td><select class = 'import_dropdown'><option value = 'none' style = 'display: none'>Choose one provided</option></select></td>";
    echo "</tr>";
}
}else 
	echo "no result";
echo "</table>";
?>
</div>

      <h4>File Fields</h4>
      <div id="file-fields"><div class="list">    <div class="list-title"></div>    <ul><li>First Name</li><li>Last Name</li><li>Age</li></ul></div></div>

      <div class="widget-corner-lower"></div>
    </fieldset>

    <div id="instance-actions">
      <button id="import-accept">Import</button>
    </div>

   </div><!-- #set_map -->
   <div id="upload_file" class="hide">
<h3>Uploading...</h3>
<div class="bar-graph" id="import-progress">
  <div class="bar-value" style="width: 0%"></div>
  <span class="bar-value-label">0%</span>
</div>

    </body>
</html>
