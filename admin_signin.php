<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ob_start();
include 'config.php';
session_start();
if(isset($_POST['submit'])){
  $admin_username=$_POST['admin_username'];
  $admin_user_pass=$_POST['admin_user_pass'];
  if(!empty($admin_username) && !empty($admin_user_pass)){
    $match_query = "SELECT * FROM admin WHERE admin_username = '$admin_username' AND admin_user_pass = '$admin_user_pass'";
    $match_query_res = mysqli_query($conn, $match_query);
    $match_count = mysqli_num_rows($match_query_res);
    if($match_count>0){
      $_SESSION['admin_username']=$admin_username;
      $_SESSION['loggedIn']=true;
      echo '<script>window.location.href = "./admin_panel.php";</script>';
      #header("location:./home.html");
      exit;
    }
    else{
      ?>
      <script>
        alert("Invalid Credentials");
      </script>
      <?php
    }
  }
  else{
    ?>
    <script>
      alert("Enter your credentials");
    </script>
    <?php
  }
}
ob_end_flush();
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
    .sign-in-page {
      height: 62vh;
    }
  </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary nav-padd fixed-top">
        <div class="container-fluid">
          <a class="navbar-brand" href="./index.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">NCITArena</a>
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
                  <li><a class="dropdown-item" href="signin.php">Student</a></li>
                  <li><a class="dropdown-item" href="#">Administration</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="index.php#footer-sec">Contact Us</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <div class="container sign-in-page">
      <main class="form-signin w-100 m-auto">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <img class="mb-4 mar-in-signin" src="./assets/images/register-logo.png" alt="" width="57" height="57" id="signinlogo"><br><br>
          <!--<h1 class="h3 mb-4 fw-normal">Please sign in</h1>-->
      
          <div class="form-floating">
            <input type="text" class="form-control" id="admin_username" name="admin_username" placeholder="Admin Username" required>
            <label for="admin_username">Admin Username</label>
          </div>
          <div class="form-floating mb-5">
            <input type="password" class="form-control" id="admin_user_pass" name="admin_user_pass" placeholder="Admin Password" required>
            <label for="admin_user_pass">Admin Password</label>
            <div class="form-check text-start">
                <input class="form-check-input" type="checkbox" id="showPassword">
                <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
          </div>
      
          <input type="submit" name="submit" value="Sign In" class="btn btn-primary w-100 py-2 btn-size">
          <p class="mt-4 mar-in-signin">Sign in as a student instead? <a href="signin.php" style="text-decoration:none;">Sign In</a></p>
        </form>
      </main>
      </div>
      
      <div class="container foot-div">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">© 2024 NCITArena</span></p>
      
          
          <a href="https://ncit.edu.np" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/NCIT_LOGO.jpg" height="45" width="45" class="bi me-2"></a>
      
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="index.php#footer-sec" class="nav-link px-2 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">Contact us</span></a></li>
            
          </ul>
        </footer>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
      <script src="./logic.js"></script>
      <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            var passwordInput = document.getElementById('admin_user_pass');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
</body>
</html>
