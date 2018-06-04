<?php
  include('../../config.php');

  if (isset($_POST['playlistId']) && isset($_POST['songId'])) {
    $playlistId = $_POST['playlistId'];
    $songId = $_POST['songId'];

    $orderQuery = $con->query("SELECT MAX(playlistOrder) + 1 as maxPlaylistOrder
      FROM playlistSongs WHERE playlistId = $playlistId");

    while ($row = $orderQuery->fetch()) {
      $order = $row['maxPlaylistOrder'];
    }

    $stmt = $con->query("SELECT * FROM playlistSongs WHERE playlistId = $playlistId and songId = $songId");
    if($stmt->rowCount() > 0) {
      echo "Song already exists in playlist";
      exit();
    }

    $stmt = $con->query("INSERT INTO playlistSongs VALUES ('', '$songId', '$playlistId', '$order')");

    if (!$stmt) { //CHECK FOR ERRORS
      echo $stmt->errorInfo();
    }
  } else {
    echo "playlist Id or songId not passed in to addToPlaylist";
  }

?>
