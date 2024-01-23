<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
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
          <a class="navbar-brand" href="index.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg">polls@NCIT</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
            </ul>
            <img src="./assets/images/icons8-moon-100.png" alt="moon" height="40" id="lightdark"/>
          </div>
        </div>
      </nav>


      <div class="container">
        <main class="form-signin w-100 m-auto form-page">
            <div class="row">
                <div class="col-md-6 image-style">
                    <img src="./assets/images/register-logo.png" class="mb-4" alt="" height="200" width="200" id="img-logo">
                    <h1 class="h3 mb-3 fw-normal mt-3" id="head-logo"><span id="main-text">User Registration</span></h1>
                </div>
                <div class="col-md-6 form-contain">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" required>
                            <label for="full_name">Full Name</label>
                        </div>


                        <div class="form-floating">
                            <input type="text" class="form-control" id="college_id" name="college_id" placeholder="College Roll Number" required>
                            <label for="college_id">College Roll Number</label>
                        </div>
                         
                        <div>
                          <label for="department">Department:</label>
                          <select id="department" name="department" class="form-control department-style">
                            <option value="IT">IT</option>
                            <option value="Software">Software</option>
                            <option value="Civil">Civil</option>
                            <option value="Computer">Computer</option>
                            <option value="ELX">ELX</option>
                            <option value="BCA">BCA</option>
                          </select>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email_id" name="email_id" placeholder="name@example.com" required>
                            <label for="email_id">College email address</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Password" required>
                            <label for="user_pass">Password</label>
                        </div>
                        <input type="submit" name="submit" value="Sign Up" class="btn btn-primary w-100 py-2 btn-size">
                        <p class="mt-4 mb-3 mar-in-signin">Already have an account? <a href="signin.php" style="text-decoration:none;">Sign In</a></p>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./logic.js"></script>
  </body>
</html>
<?php
include 'config.php';
if(isset($_POST['submit'])){
  $full_name=$_POST['full_name'];
  $college_id=$_POST['college_id'];
  $department=$_POST['department'];
  $email_id=$_POST['email_id'];
  $user_pass=$_POST['user_pass'];


  if(!empty($full_name) && !empty($college_id) && !empty($department) && !empty($email_id) && !empty($user_pass)){

    $email_query = " SELECT * FROM users WHERE email_id = '$email_id' ";
    $email_query_res = mysqli_query($conn, $email_query);
    $email_count = mysqli_num_rows($email_query_res);

    if($email_count>0){
      ?>
      <script>
        alert("Email already exists");
      </script>
      <?php
    }
    else{
      $insert_query = "INSERT INTO users(college_id, full_name, department, email_id, user_pass) VALUES('$college_id', '$full_name', '$department', '$email_id', '$user_pass')";
      $insert_query_res = mysqli_query($conn, $insert_query);
      #if($insert_query_res){
      if ($insert_query_res) {
        setcookie('email_id', $email_id, time() + (86400*4), "/");
        echo '<script>alert("Insertion Successful"); window.location.href = "./signin.php";</script>';
        #header("location:signin.php");
        exit;
      }
      
        #<script>
            #alert("Insertion Succesfull");
        #</script>
        #<?php
        #setcookie('email_id', $email_id, time() + (86400*4), "/");
        #setcookie('user_pass', $user_pass, time() + (86400*4), "/");
        #header("location: signin.php");
      #}
      else{
        ?>
        <script>
          alert("data insertion unsucessful");
        </script>
        <?php
      }
    }
  }
  else{
    echo "empty field";
  }
}
?>
