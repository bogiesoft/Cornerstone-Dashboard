<!--Takes info from create_post.php and sends it to the database-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="robots" content="noindex, nofollow" />

<?php
$name = '';
if (isset($_FILES["file"]["name"])) {

    $name = $_FILES["file"]["name"];
    $tmp_name = $_FILES['file']['tmp_name'];
    $error = $_FILES['file']['error'];

    if (!empty($name)) {
        $location = 'C:\xampp\htdocs\political_mailing\images/';

        if  (move_uploaded_file($tmp_name, $location.$name)){
            echo 'Uploaded';
        }

    } else {
        echo 'please choose a file';
    }
}

require("connection.php");

$postTitle = $_POST['postTitle'];
$postImage= $name;
$postContent = $_POST['postContent'];
$postDate = $_POST['postDate'];
$postTime = $_POST['postTime'];
$user = $_POST['username'];
$sidebarMonth = $_POST['sidebarMonth'];
$sidebarYear = $_POST['sidebarYear'];
$postTags = $_POST['postTags'];

$sql = "INSERT INTO blog_posts(postImage, postTitle, postContent, postDate, postTime, username, sidebarMonth, sidebarYear, tags) VALUES ('$postImage','$postTitle', '$postContent', '$postDate', '$postTime', '$user', '$sidebarMonth', '$sidebarYear', '$postTags')";
$connect = $conn->query($sql) or die("Cannot connect.");

$conn->close();



?>
