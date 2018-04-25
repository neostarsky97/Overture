<?php
  include('../../config.php');

  if (isset($_POST['name']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $date = date("Y-m-d");
    $stmt = $con->query("SELECT id FROM users WHERE username = '$username'");
    while ($row = $stmt->fetch()) {
      $userId = $row['id'];
    }
    $stmt = $con->prepare("INSERT INTO playlists VALUES ('', ?, ?, ?)");
    $stmt->execute([$name, $userId, $date]);
    // if (!$stmt) { CHECK FOR ERRORS
    //   echo $stmt->errorInfo();
    // }
  } else {
    echo "playlist name or username not passed in";
  }
?>
