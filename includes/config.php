<?php
  include_once('C:\xampp\htdocs\Overture\classes\Dbh.php');
  ob_start();
  session_start();

  $timezone = date_default_timezone_set("Asia/Dili");

  $conObj = new Dbh();
  $con = $conObj->connect();

?>
