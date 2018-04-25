<?php

if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
  include_once('C:\xampp\htdocs\Overture\includes\config.php');
  include_once('classes\Artist.php');
  include_once('classes\Album.php');
  include_once('classes\Song.php');
  include_once('classes\User.php');
  include_once('classes\Playlist.php');

  if (isset($_GET['userLoggedIn'])) {
    $userLoggedIn = new User($con, $_GET['userLoggedIn']);
  } else {
    echo "Username variable was not passed into page. Check openPage JS file";
    exit();
  }
} else {
  include('includes/header.php');
  include('includes/footer.php');

  $url = $_SERVER['REQUEST_URI'];
  echo "<script>openPage('$url')</script>";
  exit();
}


?>
