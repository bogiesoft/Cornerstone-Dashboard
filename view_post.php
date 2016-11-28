<?php
require("connection.php");
require("header.php");
require("sidebar.php");
$id = $_GET['id'];
$sql = "select * from blog_posts where id = $id";
$result = mysqli_query($conn, $sql);
?>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="robots" content="noindex, nofollow" />
<link rel="stylesheet" type="text/css" href="blog.css">
</head>
<div id="blog">
<?php


if ($result->num_rows > 0){
    $row = mysqli_fetch_row($result);
    $title = $row[2];
    $content = $row[3];
	$postDate = $row[4];
	$postTime = $row[5];
	$username = $row[6];
	$editUser = $row[7];
	$editDate = $row[8];
	$editTime = $row[9];
    
?>

<html>
    <head>
    <title><?php echo $title?></title>
    </head>
    <body>
        <?php echo $title?>
		<?php
		 echo "<img src='images/".$row[1]."'/ height='auto' width='100%'>";
		?>
		<?php
echo "<br><a href='https://twitter.com/intent/tweet?url=https://www.politicalmailing.com&text=Share%20Post&original_referer=https://www.politicalmailing.com'><img src='images/twittershare.png'></a>";
?>


<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div class="fb-share-button" data-href="https://politicalmailing.com/" data-layout="button" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fpoliticalmailing.com%2F&amp;src=sdkpreparse">Share</a></div>
<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
<script type="IN/Share" data-url="politicalmailing.com"></script>
<a href="https://www.pinterest.com/pin/create/link/?url=http://www.politicalmailing.com&media=http%3A%2F%2Fcrst.net%2Farticles%2Fwp-content%2Fuploads%2F2016%2F07%2Fbizcardboard.png" class="pin-it-button"><img src="images/pintrest.png" alt="Pin it"></a>
<br>
		 
        <?php echo $content . "<br>"?>
<?php		
			if ($editUser != "")
			{
				echo "Edited on " . $editDate . " at " . $editTime . " by " . $editUser . "";
			}
			else
			{
					echo "Posted on " . $postDate . " at " . $postTime . " by " . $username . "";
			}
			
				
$sql = "SELECT tags FROM blog_posts WHERE id = $id";
$result = mysqli_query($conn,$sql);
$tagsArray = array();
if ($result)
{
    $row = mysqli_fetch_row($result);
    $tags = $row[0];
	$tagsArray = explode(",",$tags);
}
$index = 0;
$count = count($tagsArray);

?>

<br>
	<?php

while ($index < $count)
{
  echo "<a href='view_tags.php?p=1&tags=".$tagsArray[$index]."'>" . $tagsArray[$index] . "</a>";
  $index++;
}
}
else{
	echo "No results.";
}
if(isset($_SESSION["user"]))
				{
					echo "<br><a href='edit_post.php?id=$id'><button>Edit Post</button></a><br>";
				}
?>
</div>
    </body>
</html>