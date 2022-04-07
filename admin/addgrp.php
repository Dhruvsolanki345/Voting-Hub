<?php
include '../helper.php';
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
      <ul class="navbar-nav mb-2 mb-lg-0 fs-5">
        <li class="nav-item px-2">
          <a class="nav-link" href="home.php">Users</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link" href="addUser.php">Add User</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link active" href="addgrp.php">Add Group</a>
        </li>
        <li class="nav-item px-2">
          <a class="nav-link" href="displaygrp.php">Group</a>
        </li>
       </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item active">
          <a class="btn btn-outline-danger my-2 my-sm-0" href="../logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <?php 
  if(isset($_GET['alert'])){
    $danger = isset($_GET['danger']) ? 'alert-danger' : 'alert-success';
    echo '<div class="alert '.$danger.'" role="alert">
            '.$_GET['alert'].'
          </div>';
  }

  $leader  =  $name = "";
  $label = "Add Group";

  if(isset($_GET['id'])){
    $label = "Update Group";
    $sql = "select * from grp where id = ".$_GET['id'];
    $result = $conn->query($sql);

    if($result->num_rows == 0){
      header("Location: home.php");
      exit();
    }

    $row = $result->fetch_assoc();
    $name = $row['name'];
    $leader = $row['leader'];
  }
?> 

  <div class="row d-flex justify-content-center align-items-center h-100 pt-5">
    <div class="col-lg-8 col-xl-5">
      <div class="card rounded-5">
        <div class="card-body p-4 p-md-5">
          <form method="post" action="helperAddGrp.php">
            <h2 class="pb-2 text-center">
              <?php echo $label ?>
            </h2>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Name</label>
              <input type="text" class="col-9" name="name" value="<?php echo $name ?>" placeholder="Enter Name" />
            </div>

            <div class="row mb-2">
              <label class="col-3 py-2 fs-5">Leader Name</label>
              <input type="leader" class="col-9" name="leader" value="<?php echo $leader ?>" placeholder="Enter Leader Name" required />
            </div>

            <div class="row mb-2">
            <?php if(!isset($_GET['id'])) { ?>              
              <input type="submit" class="btn btn-primary my-3 py-2" value="Add Group" />
            <?php  } else { ?>
              <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>" />
              <input type="submit" formaction="helperUpdGrp.php" class="btn btn-primary my-3 py-2" value="Update Group" />
            <?php } ?>
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