<?php

  include_once('C:\xampp\htdocs\Overture\includes\config.php');
  include_once('classes\Artist.php');
  include_once('classes\Album.php');
  include_once('classes\Song.php');
  include_once('classes\User.php');
  include_once('classes\Playlist.php');

  // session_destroy(); LOGOUT

  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = new User($con, $_SESSION['userLoggedIn']);
    $username = $userLoggedIn->getUserName();
    echo "<script>userLoggedIn = '$username' </script>";
  } else {
    // $urlEncode = urlencode("Location: \Overture\register.php");
    header("Location: register.php");
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css"href="assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/script.js"></script>
  </head>
  <body>

    <script>

    </script>
    <div class="mainContainer">

      <div class="topContainer">
        <?php include('includes\navBarContainer.php'); ?>

        <div id="mainViewContainer">
          <div id="mainContent">
