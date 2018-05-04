<?php
include("includes/includedFiles.php");
?>

<div class="entityInfo">
  <div class="centerSection">
    <div class="userInfo">
      <h1><?php echo $userLoggedIn->getFullName(); ?></h1>
    </div>
    <div class="buttonItems">
      <button class="button" name="button" onclick="openPage('updateDetails.php')">USER DETAILS</button>
      <button class="button" name="button" onclick="logout()">LOG OUT</button>
    </div>
  </div>
</div>
