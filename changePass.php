<?php
include 'helper.php';
session_start();

$pass = $confirmPass = $passErr = $confirmPassErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

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
// echo $_POST["confirmPass"];
  if (empty($_POST["confirmPass"])) {
    $confirmPassErr = "Confirm Password is required";
  } else {
    $confirmPass = test_input($_POST["confirmPass"]);
    if($confirmPass != $pass){
      $confirmPassErr = "Password doesn't match";
    }
  }

  if($passErr == "" && $confirmPassErr == ""){
    $sql = "update users set pass = ".$pass." where id = ".$_SESSION['uid'];
    $_SESSION['pass'] = $pass;
    if($conn->query($sql) == TRUE){
      header("Location: home.php");
      exit();
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
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
    <a class="navbar-brand" href="home.php">VotingHub</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse w-100" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item me-3">
        <a class="nav-link active" href="changePass.php">Change Password</a>
        </li>
        <li class="nav-item active">
          <a class="btn btn-outline-danger my-2 my-sm-0" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="row d-flex justify-content-center align-items-center h-100 pt-5">
    <div class="col-lg-8 col-xl-5">
      <div class="card rounded-5">
        <div class="card-body p-4 p-md-5">
          <form method="post" action="">
            <h2 class="pb-4 text-center">Change password</h2>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Username</label>
              <input type="email" class="col-9" value="<?php echo $_SESSION['username'] ?>" disabled/>
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Password</label>
              <input type="text" class="col-9" name="pass" value="<?php echo $pass ?>" placeholder="Enter Password" />
              <span class="text-danger mt-1"><?php echo $passErr; ?></span>
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Confirm Password</label>
              <input type="text" class="col-9" name="confirmPass" value="<?php echo $confirmPass ?>" placeholder="Enter Password Again" />
              <span class="text-danger mt-1"><?php echo $confirmPassErr; ?></span>
            </div>
            
            <input type="submit" class="btn btn-primary my-3 py-2 col-12" value="Update password" />
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
  </script>
</body>

</html>
<?php
$conn->close();
?>