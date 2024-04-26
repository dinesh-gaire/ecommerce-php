<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include("partials/_dbconnect.php");
  $Name = $_POST["Name"];
  $Email = $_POST["Email"];
  $Passwrd = $_POST["Passwrd"];
  $CPasswrd = $_POST["CPasswrd"];

  $existSql = "SELECT * from users where Email='$Email'";
  $result = mysqli_query($conn, $existSql);
  if (mysqli_num_rows($result) > 0) {
    $showError = "This Email is already Registered.";
  } else {
    if ($Passwrd == $CPasswrd) {
      $sql = "INSERT INTO `users` (`Name`, `Email`, `Passwrd`, `dt`) VALUES ('$Name', '$Email', '$Passwrd', current_timestamp());";
      $result = mysqli_query($conn, $sql);
      if ($result == true) {
        $showAlert = true;
      }
    } else {
      $showError = "Entered Passwords do not match.";
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Sign Up</title>
  <link rel="stylesheet" href="styles/signup.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
  <?php require 'partials/_nav.php' ?>

  <?php
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Registration successful!</strong> You should be able to login now...
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>

  <?php
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error! </strong>' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>

  <div class="d-flex flex-row justify-content-center">
    <div class="container1">
      <h1>Sign Up</h1>
      <div class="d-flex flex-row justify-content-center">
        <!-- Sign-Up Form -->
        <form id="Form" action="/ecomweb/signup.php" method="post">
          <div class="form-group">
            <label for="signupName">Full Name:</label>
            <input type="text" maxlength="50" id="Name" name="Name" required>
          </div>
          <div class="form-group">
            <label for="Email">Email:</label>
            <input type="email" id="Email" name="Email" required>
          </div>
          <div class="form-group">
            <label for="Passwrd">Password:</label>
            <input type="password" maxlength="50" id="Passwrd" name="Passwrd" required>
          </div>
          <div class="form-group">
            <label for="CPasswrd">Confirm Password:</label>
            <input type="password" maxlength="50" id="CPasswrd" name="CPasswrd" required>
          </div>
          <div class="form-group d-flex flex-row justify-content-center">
            <input class="btn btn-primary" type="submit" value="Sign Up">
          </div>
        </form>
      </div>
      <div class="d-flex flex-row justify-content-center">
        <div class="switch-link">
          <p>Already have an account? <a href="login.php">Login now!</a></p>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
