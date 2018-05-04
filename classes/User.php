<?php

class User {
  private $con;
  private $id;
  private $username;
  private $name;
  //add more variables later

  public function __construct($con, $username) {
    $this->con = $con;
    $this->username = $username;
  }

  public function getUserID() {
    $stmt = $this->con->query("SELECT id FROM users WHERE username = '$this->username'");
    while($row = $stmt->fetch()){
      $this->id = $row['id'];
    }
    return $this->id;
  }

  public function getUserName() {
    return $this->username;
  }

  public function getFullName() {
    $stmt = $this->con->query("SELECT concat(firstName, ' ', lastName) as name FROM users
      WHERE username = '$this->username'");
    while ($row = $stmt->fetch()) {
      $name = $row['name'];
    }
    return $name;
  }

}

?>
