<?php

class Playlist {
  private $con;
  private $id;
  private $name;
  private $userId;
  private $username;

  public function __construct($con, $data) {
    if (!is_array($data)) {
      //data is not a sql object
      $stmt = $con->query("SELECT * from playlists WHERE id = $data");
      $data = $stmt->fetch();
    }
    $this->con = $con;
    $this->id = $data['id'];
    $this->name = $data['name'];
    $this->userId = $data['user'];
  }

  public function getName() {
    return $this->name;
  }

  public function getUserName() {
    $userNameQuery = $this->con->query("SELECT username FROM users WHERE id=$this->userId");
    while ($row = $userNameQuery->fetch()) {
      $this->username = $row['username'];
    }
    return $this->username;
  }

  public function getId() {
    return $this->id;
  }

  public function getNumberOfSongs() {
    $numberOfSongs = $this->con->query("SELECT songId FROM playlistSongs WHERE playlistId = $this->id");
    return $numberOfSongs->rowCount();
  }

  public function getSongIds() {
    $stmt = $this->con->query("SELECT songId FROM playlistSongs WHERE playlistId='$this->id' ORDER BY playlistOrder ASC");

    $songsIdArr = array();

    while ($row = $stmt->fetch()) {
      array_push($songsIdArr, $row['songId']);
    }

    return $songsIdArr;
  }

  public static function getPLaylistsDropdown($con, $username) {
    $dropdown = '<select class="item playlist">
      <option value="">Add to playlist</option>';

    $stmt = $con->query("SELECT p.id, p.name from playlists p, users u
      WHERE p.user = u.id AND u.username='brandon'");

    while ($row = $stmt->fetch()) {
      $id = $row['id'];
      $name = $row['name'];

      $dropdown = $dropdown . "<option value='$id'>$name</option>" ;
    }


    return $dropdown . "</select>";
  }
}

?>
