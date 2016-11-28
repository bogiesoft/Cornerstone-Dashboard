<?php
require ("header.php");
?>
<div class="dashboard-cont" style="padding-top:110px;">
	<div class="contacts-title">
	<h1 class="pull-left">Documentation</h1>
	<a class="pull-right" href="add_doc.php" class="add_button">Add Doc</a>
	</div>
<div class="dashboard-detail">
	<div class="search-cont">
	<div class="searchcont-detail">
		<div class="search-boxleft">
			<form id = "form-id" action="documentation_search.php" method="post">
				<label>Quick Search</label>
				<input id="searchbox" name="frmSearch" type="text" placeholder="Search documentation by user, title etc.">
			</form>
			<div class="search-boxright pull-right"><a href="#" onclick = "document.getElementById('form-id').submit()">Submit</a></div>
		</div>
	</div>
	</div>
<div class="clear"></div>
<div class="documentation-detail">
<?php
$page=$_REQUEST['p']; //page from URL
$limit=3; //limit of post on a page
if($page=='') //If no page selected , go to page 1
{
 $page=1;
 $start=0;
}
else //else find what page you need to be on
{
 $start=$limit*($page-1);
}
//Prints out blog posts in descending order with a limit of $limit per page
$query=mysqli_query($conn,"select * from documentation ORDER BY timestamp DESC limit $start, $limit"); 
$tot=mysqli_query($conn, "select * from documentation");
$total=mysqli_num_rows($tot);
$num_page=ceil($total/$limit);
if ($result->num_rows > 0)
{
	while($row=mysqli_fetch_array($query))
	{
		$temp = $row['title'];
		echo "<div class='doc-block'>";
		echo "<div class='search-boxright pull-right'><a href='edit_doc.php?title=$temp'>Edit</a></div>";
		echo "<a href='view_doc.php?title=$temp'><h2>".$row['title']."</h2></a>"."<p>Written by <b>".$row['user']."</b> on ".$row['timestamp']."</p><br>";
		echo "<p>".$row['description']."</p>";
		echo "</div>";
    }
} else {
    echo "0 results";
}

//Calls pagination function and prints pages on bottom of page
function pagination($page,$num_page)
{
  echo'<ul style="list-style-type:none;">';
  for($i=1;$i<=$num_page;$i++)
  {
     if($i==$page)
{
 echo'<li style="float:left;padding:5px;">'.$i.'</li>';
}
else
{
 echo'<li style="float:left;padding:5px;"><a href="documentation.php?p='.$i.'">'.$i.'</a></li>';
}
  }
  echo'</ul>';
}
if($num_page>1)
{
 pagination($page,$num_page);
}
$conn->close();
?>
</div>
</div>
</div>
<script>
	$(document).ready(function(){
		$("#searchbox").on("keyup input paste cut", function() {
			//searchbox value
			var search_val = $(this).val();
			//compare the searchbox value with each job id
			$("div.doc-block").each(function(){
				//if title.text OR username.text OR paragraphText.text contains the string in searchbox
				if($(this).children("a").text().toLowerCase().search(search_val)!=-1 || $(':nth-child(2)', this).children().text().toLowerCase().search(search_val)!=-1 || $(':nth-child(4)', this).text().toLowerCase().search(search_val)!=-1){
					//show div
					$(this).show();
				}
				else{
					//hide div
					$(this).hide();
				}
			});
		});
	});
</script>
