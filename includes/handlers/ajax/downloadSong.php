<?php
  include('../../config.php');

  if (!isset($_POST['songId'])) {
    echo "SongId is not set";
    exit();
  } else {
    $songId = $_POST['songId'];

    $getSongpathQuery = $con->query("SELECT path FROM songs WHERE id = '$songId'");

    while($row = $getSongpathQuery->fetch()) {
      $path = $row['path'];
    }
    echo $path;
  }
?>
