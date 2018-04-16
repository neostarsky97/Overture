<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
  include_once('C:\xampp\htdocs\Overture\includes\config.php');
  include_once('classes\Artist.php');
  include_once('classes\Album.php');
  include_once('classes\Song.php');
} else {
  include('includes/header.php');
  include('includes/footer.php');

  $url = $_SERVER['REQUEST_URI'];
  echo "<script>openPage('$url')</script>";
  exit();
}


?>
