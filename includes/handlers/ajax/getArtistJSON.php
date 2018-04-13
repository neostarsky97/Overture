<?php
  include('../../config.php');

  if(isset($_POST['artistId'])) {
    $artistId = $_POST['artistId'];

    $stmt = $con->query("SELECT * FROM artists WHERE id='$artistId'");
    $artistData = $stmt->fetch();
    echo json_encode($artistData);
  }
?>
