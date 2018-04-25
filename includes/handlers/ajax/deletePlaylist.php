<?php
  include('../../config.php');

  if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $playlistQuery= $con->query("DELETE FROM playlists WHERE id = $id");
    $songQuery = $con->query("DELETE FROM playlistSongs WHERE playlistId = $id");
    // if (!$stmt) { CHECK FOR ERRORS
    //   echo $stmt->errorInfo();
    // }
  } else {
    echo "playlist Id not passed in";
  }
?>
