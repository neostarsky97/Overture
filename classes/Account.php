<?php

  class Account {

    private $con;
    private $errorArray;

    public function __construct($con) {
      $this->con = $con;
      $this->errorArray = array();
    }

    public function login($un, $pw) {
      $pw = md5($pw);
      $loginAndPasswordQuery = "SELECT * FROM users WHERE username='$un' AND password='$pw'";
      $stmt = $this->con->query($loginAndPasswordQuery);
      if ($stmt->rowCount() == 1) {
        return true;
      } else {
        array_push($this->errorArray, Constants::$error_loginUnsuccessful);
        return false;
      }
    }

    public function register($un, $fn, $ln, $ge, $dob, $em, $pw, $cpw) {
          $this->validateUserName($un);
          $this->validateNames($fn, $ln);
          $this->validateEmail($em);
          $this->validateDOB($dob);
          $this->validatePasswords($pw, $cpw);

          if (empty($this->errorArray)) {
            return $this->insertUserDetails($un, $fn, $ln, $ge, $dob, $em, $pw);
          } else {
            return false;
          }
    }

    public function insertUserDetails ($un, $fn, $ln, $ge, $dob, $em, $pw) {
      $encryptedPw = md5($pw);
      $profilePic = "Overture\assets\images\me.JPG";
      $stmt = $this->con->prepare('INSERT INTO users VALUES (?,?,?,?,?,?,?,?,?)');
      $stmt->execute(['',$un, $fn, $ln, $ge, $dob, $em, $encryptedPw, $profilePic]);
      return $stmt;
    }

    public function getError($error)  {
      if (!in_array($error, $this->errorArray)) {
        $error="";
      }
      return "<span class='errorMessage'>$error</span>";
    }

    private function validateUserName($un) {
      if(strlen($un) > 25 || strlen($un) < 5) {
        array_push($this->errorArray, Constants::$error_usernameCharacters);
        return;
      }
      $checkIfUsernameExists = "SELECT username FROM users WHERE username='$un'";
      $stmt = $this->con->query($checkIfUsernameExists);
      $resultSet = $stmt->fetchAll();
      if(!empty($resultSet)) {
        array_push($this->errorArray, Constants::$error_usernameExists);
        return;
      }
    }

    private function validateNames($fname, $lname) {

    }

    private function validateEmail($email) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($this->errorArray, Constants::$error_emailNotValid);
        return;
      }
      $checkIfEmailExists = "SELECT email from users WHERE email='$email'";
      $stmt = $this->con->query($checkIfEmailExists);
      $resultSet = $stmt->fetchAll();
      if(!empty($resultSet)) {
        array_push($this->errorArray, Constants::$error_emailExists);
        return;
      }
    }

    private function validatePasswords($fpw, $cpw) {
      if ($fpw != $cpw) {
        array_push($this->errorArray, Constants::$error_passwordsDoNotMatch);
        return;
      }

      if (preg_match("/[^A-Za-z0-9]/", $fpw)) {
        array_push($this->errorArray, Constants::$error_passwordsOnlyAlpha);
        return;
      }

      if(strlen($fpw) < 7) {
        array_push($this->errorArray, Constants::$error_passwordTooWeak);
        return;
      }
    }

    private function validateDOB($date) {
      $dateArray = explode("-", $date);
      if ($dateArray[0] > 2018 || $dateArray[0] < 1990) {
        array_push($this->errorArray, Constants::$error_dateNotValid);
      }
      return;
    }


  }

?>
