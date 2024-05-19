<?php
        session_start();
        if (isset($_SESSION["user"])) {
            header('Location: bmi.php');
            exit();
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="register.css">
</head>
<body>
  <div class="container">
    <?php
    if (isset ($_POST["login"])) {
      $email = $_POST["email"];
      $password = $_POST["password"];
      require_once "database.php";
      $sql = "SELECT * FROM users WHERE email = '$email'";
      $result = mysqli_query($conn, $sql);
      $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
      if ($user) {
        if (password_verify($password, $user["password"])) {
          session_start();
          $_SESSION["user"] = "yes";
          header('Location: bmi.php');
          die();
        } else {
          echo "<div class='alert alert-danger'>Password does not match</div>";
        }
      } else {
        echo "<div class='alert alert-danger'>Email does not match</div>";
      }
    }

    ?>

    <form action="login.php" method="post">
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Email:">
      </div>
      <div class="form-group">
        <input type="password"  class="form-control" name="password" placeholder="Password:">
      </div>
      <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Login" name="login">
      </div>

      <p>Don't have an account?<a href="registration.php">Register here.</a></p>
      
    </form>
  </div>
</body>
</html>