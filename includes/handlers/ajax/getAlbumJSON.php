<?php
  include('../../config.php');

  if(isset($_POST['albumId'])) {
    $albumId = $_POST['albumId'];

    $stmt = $con->query("SELECT * FROM albums WHERE id='$albumId'");
    $albumData = $stmt->fetch();
    echo json_encode($albumData);
  }
?>
