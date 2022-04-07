<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['selCand'])) {
  if ($_GET['selCand'] != "") {
    $selCand = explode("-", $_GET['selCand']);
    setcookie('selCandId',$selCand[0]);
    setcookie('selCandName',$selCand[1]);
    setcookie('uid',$_GET['uid']);
    setcookie('username',$_GET['username']);
    header("Location: result.php");
    exit();
  }
}
include "helper.php";
include "login.php";
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
        <a class="nav-link" href="changePass.php">Change Password</a>
        </li>
        <li class="nav-item active">
          <a class="btn btn-outline-danger my-2 my-sm-0" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <p class="display-5 text-center">Welcome <?php echo $_SESSION['username'] ?>, Vote Now</p>
  <div class="row d-flex justify-content-center align-items-center h-100 pt-3">
    <div class="col-lg-8 col-xl-6">
      <div class="card rounded-5">
        <div class="card-body p-4 p-md-5">
          <form action="">
          <h3 class="pb-2">Confirm your details</h3>

          <input type="hidden" name="uid" value="<?php echo $_SESSION['uid'] ?>" />
          <input type="hidden" name="username" value="<?php echo $_SESSION['username'] ?>" />

          <div class="row mb-4">
            <label class="col-2 py-2">Username</label>
            <input type="text" disabled class="col-10 py-2" value="<?php echo $_SESSION['username'] ?>" />
          </div>

          <div class="row mb-4">
            <label class="col-2 py-2">Email</label>
            <input type="text" disabled class="col-10 py-2" value="<?php echo $_SESSION['email'] ?>" />
          </div>
          <p class="text-muted">If details are incorrect then contact admin</p>

          <h3 class="pb-2">Vote</h3>
          <select name="selCand" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option selected value="">Open this menu to select Candidate</option>
            <?php 
            $sql = "select * from grp";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
              while($row = $result->fetch_assoc()){
                echo '<option value="'.$row['id'].'-'.$row['name'].'">'.$row['name'].'</option>';
              }
            }
            ?>
          </select>
          <div class="d-flex justify-content-end">
            <input type="submit" class="btn btn-success mb-3" value="Submit" />
          </div>
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