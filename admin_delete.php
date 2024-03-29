<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['admin_username'])){
  echo '<script>alert("Admin access denied!"); window.location.href = "admin_signin.php";</script>';
  #header('location: signin.php');
}

if(isset($_POST['delete_poll']) && isset($_POST['poll_id'])){
    $pollIdToDelete = $_POST['poll_id'];
    $deletevotecount = "DELETE FROM votes WHERE poll_id = $pollIdToDelete";
    $deletePollQuery = "DELETE FROM poll WHERE poll_id = $pollIdToDelete";
    $deletevotecountres = mysqli_query($conn, $deletevotecount);
    $deletePollResult = mysqli_query($conn, $deletePollQuery);

    if($deletePollResult && $deletevotecountres) {
        echo '<script>alert("Poll deleted successfully!");</script>';
        // You might want to redirect or reload the page after deletion
        // header("Location: admin_panel.php");
        // exit;
    } else {
        echo '<script>alert("Error deleting poll.");</script>';
    }
}

// Check if a delete action is requested for events
if(isset($_POST['delete_event']) && isset($_POST['eid'])){
    $eventIdToDelete = $_POST['eid'];
    $deleteEventQuery = "DELETE FROM events WHERE eid = $eventIdToDelete";
    $deleteEventResult = mysqli_query($conn, $deleteEventQuery);

    if($deleteEventResult) {
        echo '<script>alert("Event deleted successfully!");</script>';
        // You might want to redirect or reload the page after deletion
        // header("Location: admin_panel.php");
        // exit;
    } else {
        echo '<script>alert("Error deleting event.");</script>';
    }
}

// Check if a delete action is requested for resources
if(isset($_POST['delete_resource']) && isset($_POST['rid'])){
    $resourceIdToDelete = $_POST['rid'];
    $deleteResourceQuery = "DELETE FROM resource WHERE rid = $resourceIdToDelete";
    $deleteResourceResult = mysqli_query($conn, $deleteResourceQuery);

    if($deleteResourceResult) {
        echo '<script>alert("Resource deleted successfully!");</script>';
        // You might want to redirect or reload the page after deletion
        // header("Location: admin_panel.php");
        // exit;
    } else {
        echo '<script>alert("Error deleting resource.");</script>';
    }
}

if(isset($_POST['delete_user']) && isset($_POST['college_id'])){
  $collegeIdToDelete = $_POST['college_id'];
  $deletevoteofusercount = "DELETE FROM votes WHERE college_id = $collegeIdToDelete";
  $deleteuserQuery = "DELETE FROM users WHERE college_id = $collegeIdToDelete";
  $deleteuservotequery = mysqli_query($conn, $deletevoteofusercount);
  $deleteuserResult = mysqli_query($conn, $deleteuserQuery);

  if($deleteuserResult && $deleteuservotequery) {
      echo '<script>alert("User deleted successfully!");</script>';
      // You might want to redirect or reload the page after deletion
      // header("Location: admin_panel.php");
      // exit;
  } else {
      echo '<script>alert("Error deleting User.");</script>';
  }
}


$pollsQuery = "SELECT * FROM poll";
$eventsQuery = "SELECT * FROM events";
$resourcesQuery = "SELECT * FROM resource";
$usersquery = "SELECT * FROM users";
$pollsResult = mysqli_query($conn, $pollsQuery);
$eventsResult = mysqli_query($conn, $eventsQuery);
$resourcesResult = mysqli_query($conn, $resourcesQuery);
$usersqueryresult = mysqli_query($conn, $usersquery);
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NCITArena</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
  <link rel="stylesheet" href="./style.css">
  <style>
    .main-del {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 82vh;
        zoom: 120%;
    }
    .del-but-siz {
      font-size: 1.2rem;
      margin-left: 2.2rem;
      margin-bottom: 1rem;
    }
    .del-bb {
      margin-top: 1rem;
    }
  </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded fixed-top p-3" aria-label="Thirteenth navbar example">
          <div class="container-fluid">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse d-lg-flex collapse" id="navbarsExample11" style="">
              <a class="navbar-brand col-lg-3 me-0" href="admin_panel.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">NCITArena</a>
              <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="admin_panel.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_view.php">View</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Delete</a>
                </li>
              </ul>
              <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
              </div>
            </div>
          </div>
        </nav>

    <div class="container mt-5 main-del">
    <div class="row">
      <div class="col">
        <h2 class="main-text del-but-siz">Delete Polls</h2>
        <ul class="list-group">
          <?php while ($poll = mysqli_fetch_assoc($pollsResult)) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $poll['poll_title']; ?>
              <form method="post" action="" onsubmit="return confirmDelete();">
                <input type="hidden" name="poll_id" value="<?php echo $poll['poll_id']; ?>">
                <button type="submit" name="delete_poll" class="btn btn-danger rounded-pill del-bb">Delete</button>
              </form>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

      <div class="col">
        <h2 class="main-text del-but-siz">Delete Events</h2>
        <ul class="list-group">
          <?php while ($event = mysqli_fetch_assoc($eventsResult)) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $event['event_title']; ?>
              <form method="post" action=""onsubmit="return confirmDelete();">
                <input type="hidden" name="eid" value="<?php echo $event['eid']; ?>">
                <button type="submit" name="delete_event" class="btn btn-danger rounded-pill del-bb">Delete</button>
              </form>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

      <div class="col">
        <h2 class="main-text del-but-siz">Delete Resource</h2>
        <ul class="list-group">
          <?php while ($resource = mysqli_fetch_assoc($resourcesResult)) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $resource['resource_title']; ?>
              <form method="post" action="" onsubmit="return confirmDelete();">
                <input type="hidden" name="rid" value="<?php echo $resource['rid']; ?>">
                <button type="submit" name="delete_resource" class="btn btn-danger rounded-pill del-bb">Delete</button>
              </form>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>

  <div class="col">
        <h2 class="main-text del-but-siz">Delete Users</h2>
        <ul class="list-group">
          <?php while ($user = mysqli_fetch_assoc($usersqueryresult)) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?php echo $user['full_name']; ?>
              <form method="post" action="" onsubmit="return confirmDelete();">
                <input type="hidden" name="college_id" value="<?php echo $user['college_id']; ?>">
                <button type="submit" name="delete_user" class="btn btn-danger rounded-pill del-bb">Delete</button>
              </form>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </div>

    <div class="container foot-div">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-body-secondary"><span class="main-text">© 2024 NCITArena</span></p>
      
          
          <a href="https://ncit.edu.np" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/NCIT_LOGO.jpg" height="45" width="45" class="bi me-2"></a>
      
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><span class="main-text">Contact us</span></a></li>
            
          </ul>
        </footer>
    </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="./logic.js"></script>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete?");
            }
        </script>
</body>
</html>