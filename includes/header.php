<?php

  include_once('C:\xampp\htdocs\Overture\includes\config.php');
  include_once('classes\Artist.php');
  include_once('classes\Album.php');
  include_once('classes\Song.php');

  // session_destroy(); LOGOUT

  if(isset($_SESSION['userLoggedIn'])) {
    $userLoggedIn = $_SESSION['userLoggedIn'];
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
  </head>
  <body>
    <?php echo $userLoggedIn; ?>
    <div class="mainContainer">

      <div class="topContainer">
        <?php include('includes\navBarContainer.php'); ?>

        <div id="mainViewContainer">
          <div id="mainContent">
