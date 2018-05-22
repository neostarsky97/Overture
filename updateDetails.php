<?php
  include("includes/includedFiles.php");
?>

<div class="userDetails">
  <div class="container borderBottom">
    <h1>EMAIL</h1>
    <input type="text" name="email" class="email"
      value="<?php echo $userLoggedIn->getEmail(); ?>">
    <span class="message"></span>
    <button type="button" class="button" onclick="updateEmail('email')">SAVE</button>
  </div>

  <div class="container">
    <h1>PASSWORD</h1>
    <input type="password" name="oldPassword" class="oldPassword" placeholder="Current Password">
    <input type="password" name="newPassword1" class="newPassword1" placeholder="New Password">
    <input type="password" name="newPassword2" class="newPassword2" placeholder="Confirm Password">
    <span class="message"></span>
    <button type="button" class="button"
      onclick="updatePassword('oldPassword', 'newPassword1', 'newPassword2')">SAVE</button>
  </div>
</div>
