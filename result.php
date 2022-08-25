<?php
  session_start();
  include "helper.php";

  $sql = "INSERT INTO votes VALUES ({$_COOKIE['uid']}, {$_COOKIE['selCandId']}, '{$_COOKIE['selCandName']}', '{$_COOKIE['username']}')";

  if ($conn->query($sql) === FALSE) {
    header('Location: home.php');
    exit();
  } 
  $grpSql = "select * from grp where id = {$_COOKIE['selCandId']}";
  $result = $conn->query($grpSql);

  if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $count = $row['votes'] + 1;
    $grpSql = "update grp set votes = {$count} where id = {$_COOKIE['selCandId']}";

    if ($conn->query($grpSql) === FALSE) {
      header('Location: home.php');
      exit();
    } 
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
        <li class="nav-item active">
          <a class="btn btn-outline-danger my-2 my-sm-0" href="logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="row d-flex justify-content-center align-items-center h-100 pt-3">
    <div class="col-lg-10 col-xl-8">
      <div class="card rounded-5">
        <div class="card-body p-4 p-md-5">
          <h1 class="pb-2">Result</h1>
          <h3>You have voted for <?php echo $_COOKIE['selCandName'] ?></h3>
        </div>
      </div>
      <div class="card rounded-5">
        <div class="card-body p-4 p-md-5">
          <h1 class="pb-2">Share</h1>
          <h3>
            Get total voting counts on your mail 
            <a href="sendCounts.php?to=<?php echo $_SESSION['email'] ?>">Share</a>
          </h3>
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