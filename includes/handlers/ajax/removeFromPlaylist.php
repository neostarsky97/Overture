<?php
  include('../../config.php');

  if (isset($_POST['playlistId']) && isset($_POST['songId'])) {
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];

    $stmt = $con->query("DELETE FROM playlistSongs WHERE playlistId = '$playlistId'
      AND songId = '$songId'");

    if (!$stmt) { //CHECK FOR ERRORS
      echo $stmt->errorInfo();
    }
  } else {
    echo "playlist Id or songId not passed in to addToPlaylist";
  }

?>
