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
              <a class="navbar-brand" href="#"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">polls@NCIT</a>
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
                  <li class="nav-item">
                    <a class="nav-link" href="signout.php"><img src="./assets/images/logmeout.png" alt="logout" width="32" height="32" class="rounded-circle" id="logmeout"></a>
                  </li>
                </ul>
                <img src="./assets/images/icons8-moon-100.png" alt="moon" height="40" id="lightdark"/>
              </div>
            </div>
          </nav>

        <div class="container py-4 mt-5">
        <div class="p-5 mb-4 bg-body-tertiary rounded-3 mt-5 main-con">
          <div class="container-fluid py-5">
            <div class="polls-container" style="max-height: 350px; overflow-y: auto;">
              <?php include 'view_polls.php'; ?>
            </div>
          </div>
          <a href="create_poll.php"><button class="btn btn-primary btn-lg" type="button">Create New Poll</button></a>
            
        </div>
    
        <div class="row align-items-md-stretch sec-con">
          <div class="col-md-6">
            <div class="h-100 p-5 text-bg-dark rounded-3 sec-con1">
              <h2>Change the background</h2>
              <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
              <button class="btn btn-outline-light" type="button">Example button</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="h-100 p-5 bg-body-tertiary border rounded-3 sec-con2">
              <h2>Add borders</h2>
              <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
              <button class="btn btn-outline-secondary" type="button">Example button</button>
            </div>
          </div>
        </div>
        </div>
    
        <section id="footer-sec">
            <div class="container">
              <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <div class="col-md-4 d-flex align-items-center">
                  <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                    <img src="./assets/images/light_logo.png" alt="logo" height="40" id="footerlogo">
                  </a>
                  <span class="mb-3 mb-md-0 text-body-secondary">© 2024 polls@NCIT</span>
                </div>
            
                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                  <li class="ms-3"><a class="text-body-secondary" href="#"><img src="./assets/images/icons8-twitter-50.png" alt="twitter" id="twitter"/><use xlink:href="#twitter"></use></svg></a></li>
                  <li class="ms-3"><a class="text-body-secondary" href="#"><img src="./assets/images/icons8-instagram-50.png" alt="instagram" id="insta"/></use></svg></a></li>
                  <li class="ms-3"><a class="text-body-secondary" href="#"><img src="./assets/images/icons8-facebook-50.png" alt="facebook" id="facebook"/></use></svg></a></li>
                </ul>
              </footer>
            </div>
            </section>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="./logic.js"></script>
</body>
</html>
<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
  #echo '<script>window.location.href = "signin.php";</script>';
  header('location: signin.php');
}
?>