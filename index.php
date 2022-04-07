<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>VotingHub</title>
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
    <a class="navbar-brand" href="index.php">VotingHub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item ms-3">
          <a class="nav-link" href="displayVotes.php">View All Group</a>
        </li>
      </ul>
    </div>
  </nav>
  <?php
$email = $username = $pass = $loginMethod = $type = "";
$emailErr = $passErr = $usernameErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginMethod'])) {
  $loginMethod = $_POST['loginMethod'];
  $type = $_POST['type'];

  if ($loginMethod == "username") {
    if (empty($_POST["username"])) {
      $usernameErr = "Username is required";
    } else {
      $username = test_input($_POST["username"]);
      if (!preg_match("/^[0-9a-zA-Z-' ]*$/", $username)) {
        $usernameErr = "Only letters, numbers and white space are allowed";
      }
    }
  }

  if ($loginMethod == "email") {
    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email address";
      }
    }
  }

  if (empty($_POST["pass"])) {
    $passErr = "Password is required";
  } else {
    $pass = test_input($_POST["pass"]);
    if (!preg_match("/^.{1,}$/", $pass)) {
      $passErr = "Minimum 1 character required";
    } else if (preg_match("/^.{17,}$/", $pass)) {
      $passErr = "Maximum 16 character required";
    }
  }

  if ($emailErr == "" && $usernameErr == "" && $passErr == "" && isset($type)) {
    session_start();
    $_SESSION['loginMethod'] = $_POST["loginMethod"];
    $_SESSION['email'] = $_POST["email"];
    $_SESSION['username'] = $_POST["username"];
    $_SESSION['pass'] = $_POST["pass"];
    $_SESSION['type'] = $_POST["type"];

    if ($type == "admin") {
      header("Location: admin/home.php");
    } else if ($type == "voter") {
      header("Location: home.php");
    }

    exit();
  }
}

?>

<?php 
  if(isset($_GET['alert'])){
    echo '<div class="alert alert-danger" role="alert">
            '.$_GET['alert'].'
          </div>';
  }
?>

  <div class="row d-flex justify-content-center align-items-center h-100 pt-5">
    <div class="col-lg-8 col-xl-5">
      <div class="card rounded-5">
        <div class="card-body p-4 p-md-5">
          <form id="login" method="post" action="">
            <h2 class="pb-2 text-center">Login</h2>

            <div class="row mb-2 py-4">
              <label class="col-4 h4">Login Method</label>
              <div class="col-8">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="loginMethod" id="email" value="email"
                    <?php echo $loginMethod == "email" ? "checked" : "" ?>>
                  <label class="form-check-label" for="email">Using Email</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="loginMethod" id="username" value="username"
                    <?php echo $loginMethod == "username" ? "checked" : "" ?>>
                  <label class="form-check-label" for="username">Using Username</label>
                </div>
              </div>
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Email</label>
              <input type="text" class="col-9" name="email" value="<?php echo $email ?>" placeholder="Enter Email" />
              <span class="text-danger mt-1"><?php echo $emailErr; ?></span>
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Username</label>
              <input type="text" class="col-9" name="username" value="<?php echo $username ?>"
                placeholder="Enter Username" />
              <span class="text-danger mt-1"><?php echo $usernameErr; ?></span>
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Password</label>
              <input type="text" class="col-9" name="pass" value="<?php echo $pass ?>" placeholder="Enter Password" />
              <span class="text-danger mt-1"><?php echo $passErr; ?></span>
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Type</label>
              <select name="type" class="form-select col-9" aria-label="type">
                <option value="voter" <?php echo $type == "voter" ? "selected" : "" ?>>Voter</option>
                <option value="admin" <?php echo $type == "admin" ? "selected" : "" ?>>Admin</option>
              </select>
            </div>

            <input type="submit" name="loginBtn" value="Login" class="btn btn-primary my-3 py-2 col-12" />
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php

// if ($_SERVER["REQUEST_METHOD"] == "POST" && $nextPage != htmlspecialchars($_SERVER["PHP_SELF"])) {
//   if ($emailErr == "" && $usernameErr == "" && $passErr == "") {
//     echo '<script>document.getElementById("login").submit()</script>';
//   }
// }
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
</body>

</html>