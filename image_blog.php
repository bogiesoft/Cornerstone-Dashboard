
<?php
  $name = '';
  $name = $_POST["file"];
  echo $name;
  $tmp_name = $_POST['file'];
  if (!empty($name)) {
      $location = '/Applications/XAMPP/xamppfiles/htdocs/Cornerstone1/images/';
      if  (move_uploaded_file($tmp_name, $location.$name)){
          echo 'Uploaded';
      }
  } else {
      echo 'please choose a file';
  }

?>
