<?php
  class Dbh {
      private $servername;
      private $username;
      private $password;
      private $dbname;

    public function connect () {
      $this->servername = "localhost";
      $this->username = "root";
      $this->password = "phppassword";
      $this->dbname = "overture";

      $pdo;

      try {
        $dsn = "mysql:host={$this->servername}; dbname={$this->dbname}";
        $pdo = new PDO($dsn, $this->username, $this->password) ;
        return $pdo;
      } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
      }
    }
  }
?>
