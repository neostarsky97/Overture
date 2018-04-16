<?php

class Artist {

  private $con;
  private $id;

  public function __construct($con, $id) {
    $this->con = $con;
    $this->id = $id;
  }

  public function getName() {
    $stmt = $this->con->query("SELECT name FROM artists a WHERE a.id='$this->id'");
    $artistName = $stmt->fetch();
    return $artistName['name'];
  }

  public function getId() {
    return $this->id;
  }

  public function getSongIds() {
    $stmt = $this->con->query("SELECT s.id FROM songs s, artists a WHERE a.id = s.artist AND a.id='$this->id' ORDER BY s.plays DESC");
    $songsIdArr = array();

    while ($row = $stmt->fetch()) {
      array_push($songsIdArr, $row['id']);
    }

    return $songsIdArr;
  }
}
?>
