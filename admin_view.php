<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['admin_username'])){
  echo '<script>alert("Admin Access Denied!"); window.location.href = "admin_signin.php";</script>';
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
              <a class="navbar-brand col-lg-3 me-0" href="admin_panel.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">NCITArena</a>
              <ul class="navbar-nav col-lg-6 justify-content-lg-center">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="admin_panel.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">View</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="admin_delete.php">Delete</a>
                </li>
              </ul>
              <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
              </div>
            </div>
          </div>
        </nav>

        <div class="container py-4 mt-5">
        <section id="poll-sec">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3 mt-5 main-con">
          <div class="container-fluid py-5">
            <div class="polls-container" style="max-height: 350px; overflow-y: auto;">
              <?php include 'admin_view_poll.php'; ?>
                <style>
                    .vote-button {
                        display: none;
                    }
                </style>
            </div>
          </div>
            
        </div>
        </section>

        <section id="sec-con">
        <section id="event-resource-sec">
        <div class="row align-items-md-stretch mt-5">
          <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3 sec-con1">
            <?php include 'viewevent.php'; ?>
                <style>
                    .add-event-button {
                        display: none;
                    }
                </style>
                    
          </div>
          <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3 sec-con2">
            <?php include 'viewresource.php'; ?>
                <style>
                    .upload-button {
                        display: none;
                    }
                </style>
            </div>
          </div>
        </div>
        </div>
        </section>
        </section>
        
      </div>

      <div class="container foot-div">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">© 2024 NCITArena</span></p>
      
          
          <a href="https://ncit.edu.np" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/NCIT_LOGO.jpg" height="45" width="45" class="bi me-2"></a>
      
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">Contact us</span></a></li>
            
          </ul>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./logic.js"></script>
</body>
</html>

