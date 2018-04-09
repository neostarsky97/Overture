<?php

class Artist {

  private $con;
  private $id;

  public function __construct($con, $id) {
    $this->con = $con;
    $this->id = $id;
  }

  public function getName() {
    $stmt = $this->con->query("SELECT name FROM artists WHERE artists.id=$this->id");
    $artistName = $stmt->fetch();
    return $artistName['name'];
  }

}
?>
