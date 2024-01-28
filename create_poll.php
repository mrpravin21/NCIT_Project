<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['college_id'])){
  echo '<script>alert("Please sign in first!"); window.location.href = "signin.php";</script>';
  #header('location: signin.php');
}
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
</head>

<body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary rounded fixed-top p-3" aria-label="Thirteenth navbar example">
          <div class="container-fluid">
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse d-lg-flex collapse" id="navbarsExample11" style="">
              <a class="navbar-brand col-lg-3 me-0" href="home.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">NCITArena</a>
              <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home.php#poll-sec">Polls</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home.php#event-resource-sec">Events</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="home.php#event-resource-sec">Resources</a>
                </li>
              </ul>
              <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
              </div>
            </div>
          </div>
        </nav>

      <div class="container sign-in-page">
      <main class="form-signin w-100 m-auto">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <!--<img class="mb-4 mar-in-signin" src="./assets/images/poll-img.png" alt="" width="57" height="57" id="signinlogo"><br><br>-->
          <!--<h1 class="h3 mb-4 fw-normal">Please sign in</h1>-->
          <div class="form-floating">
            <input type="text" class="form-control" id="poll_title" name="poll_title" placeholder="Poll title" required>
            <label for="poll_title">Poll title</label>
          </div>
          <div class="form-floating">
            <textarea class="form-control" id="poll_description" name="poll_description" placeholder="Poll title" style="height:5rem;" required></textarea>
            <label for="poll_description">Poll description</label>
          </div>
          <div class="form-floating">
            <input type="text" class="form-control" id="poll_creator" name="poll_creator" placeholder="Poll creator" required>
            <label for="poll_creator">Poll creator</label>
          </div>
          <div class="form-floating">
            <input type="datetime-local" class="form-control" id="poll_end_time" name="poll_end_time" placeholder="Poll end time" required>
            <label for="poll_end_time">Poll end time</label>
          </div>  
          <input type="submit" name="submit_poll" value="Create Poll" class="btn btn-primary w-100 py-2 btn-size">
          <p class="mt-4 mb-3 mar-in-signin">Want to try out something else? <a href="home.php" style="text-decoration:none;">Go Back</a></p>
        </form>
      </main>
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
</body>
</html>
<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['college_id'])){
  header("location: signin.php");
  #echo '<script>window.location.href = "signin.php";</script>';
}

if (isset($_POST['submit_poll'])) {
    $title = $_POST['poll_title'];
    $description = $_POST['poll_description'];
    $endTime = $_POST['poll_end_time'];
    $creator = $_POST['poll_creator'];

    $currentDateTime = date("Y-m-d H:i:s");
    if ($endTime <= $currentDateTime) {
        echo '<script>alert("Please select a date and time after the current date and time.");</script>';
    } else {
        $createPollQuery = "INSERT INTO poll (poll_title, poll_description, poll_creator, poll_create_time, poll_end_time, poll_yes_votes, poll_no_votes) VALUES ('$title', '$description', '$creator', NOW(), '$endTime', 0, 0)";
        $createPollResult = mysqli_query($conn, $createPollQuery);
    

        if ($createPollResult) {
            echo '<script>alert("Poll created successfully!"); window.location.href = "home.php";</script>';
        } else {
            echo '<script>alert("Error creating poll.");</script>';
        }
    }
}
?>