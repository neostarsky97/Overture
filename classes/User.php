<?php

class User {
  private $con;
  private $id;
  private $username;
  private $firstName;
  private $lastName;
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

}

?>
