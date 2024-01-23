<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>polls@NCIT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-padd fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="./index.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">polls@NCIT</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#feature-section">Features</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="index.php#about-section">About Us</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  User
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Student</a></li>
                  <li><a class="dropdown-item" href="#">Administration</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="index.php#footer-sec">Contact Us</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="./assets/images/user-profile.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="./signout.php">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
            <img src="./assets/images/icons8-moon-100.png" alt="moon" height="40" id="lightdark"/>
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
      

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="./logic.js"></script>
</body>
</html>
<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
  header("location: signin.php");
  #echo '<script>window.location.href = "signin.php";</script>';
}

if (isset($_POST['submit_poll'])) {
    $title = $_POST['poll_title'];
    $description = $_POST['poll_description'];
    $endTime = $_POST['poll_end_time'];
    $creator = $_POST['poll_creator'];
    $createPollQuery = "INSERT INTO poll (poll_title, poll_description, poll_creator, poll_create_time, poll_end_time, poll_yes_votes, poll_no_votes) VALUES ('$title', '$description', '$creator', NOW(), '$endTime', 0, 0)";
    $createPollResult = mysqli_query($conn, $createPollQuery);

    if ($createPollResult) {
      echo '<script>alert("Poll created successfully!"); window.location.href = "home.php";</script>';
    } else {
        echo '<script>alert("Error creating poll.");</script>';
    }
}
?>