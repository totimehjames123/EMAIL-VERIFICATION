<?php
session_start();

if (isset($_POST['email'])) {
  // Step 1: Store the email address
  $_SESSION['email'] = $_POST['email'];

  // Step 2: Generate a verification code
  $verificationCode = rand(10000, 99999);
  $_SESSION['verificationCode'] = $verificationCode;

  // Step 3: Send the email
  $to = $_SESSION['email'];
  $subject = "Email Verification Code";
  $message = "Your verification code is: $verificationCode";
  $headers = "From: no-reply@example.com\r\n";
  mail($to, $subject, $message, $headers);

  // Redirect to the verification page
  header("Location: verify.php");
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

<!-- The form for entering the email address -->
<form method="post">
  <input type="email" name="email" required>
  <input type="submit" value="Get Verification Code">
</form>
