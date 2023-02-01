<?php
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: index.php");
  exit;
}

if (isset($_POST['verificationCode'])) {
  // Step 4: Compare the codes
  if ($_POST['verificationCode'] == $_SESSION['verificationCode']) {
    // Step 5: Log the user in
    $_SESSION['loggedIn'] = true;
    header("Location: welcome.php");
    exit;
  } else {
    echo "Wrong verification code, please try again.";
  }
}
?>

<!-- The form for entering the verification code -->
<form method="post">
  <input type="text" name="verificationCode" required>
  <input type="submit" value="Verify">
</form>
