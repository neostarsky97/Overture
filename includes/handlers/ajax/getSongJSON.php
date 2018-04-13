<?php
  include('../../config.php');

  if(isset($_POST['songId'])) {
    $songId = $_POST['songId'];

    $stmt = $con->query("SELECT * FROM songs WHERE id='$songId'");
    $songData = $stmt->fetch();
    echo json_encode($songData);
  }
?>
