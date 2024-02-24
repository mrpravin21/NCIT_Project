<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['college_id'])){
  echo '<script>alert("Please Sign In First!"); window.location.href = "signin.php";</script>';
  #header('location: signin.php');
}

$college_id = $_SESSION['college_id'];

// Fetch existing user details
$user_query = "SELECT * FROM users WHERE college_id = '$college_id'";
$user_result = mysqli_query($conn, $user_query);

if ($user_result) {
    $user_data = mysqli_fetch_assoc($user_result);

    // Handle form submission for updating user details
    if (isset($_POST['update'])) {
        $full_name = $_POST['full_name'];
        $email_id = $_POST['email_id'];
        $department = $_POST['department'];
        $user_pass = $_POST['user_pass'];
        $current_pass = $_POST['current_pass'];

        $passwordRegex = '/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/';

        if (preg_match($passwordRegex, $user_pass)) {

          $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);
        // Update user details in the database

          echo '<script>';
          echo 'console.log("Entered Password: ' . $current_pass . '");';
          echo 'console.log("Database Password: ' . $user_data['user_pass'] . '");';
          echo '</script>';

          if(password_verify($current_pass, $user_data['user_pass'])) {
              $update_query = "UPDATE users SET full_name = '$full_name', department = '$department', email_id = '$email_id', user_pass = '$hashed_password' WHERE college_id = '$college_id'";
              $update_result = mysqli_query($conn, $update_query);

              if ($update_result) {
                  echo '<script>alert("Update Successful"); window.location.href = "./home.php";</script>';
                  exit();
              } else {
                  echo '<script>alert("Update unsuccessful");</script>';
              }
          } else {
              echo '<script>alert("Incorrect current password");</script>';
          }
        } else {
          echo "A password should be a combination of cap and small letters, numbers and characters!";
        }
    }
} else {
    echo '<script>alert("Error fetching user data");</script>';
    exit();
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
  <style>
    .show-pass {
      margin-top: 0;
      margin-bottom: 1rem;
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
              <div class="d-lg-flex col-lg-3 justify-content-lg-end nav-btn-sec">
                <a href="#"><button class="btn btn-outline-success rounded-pill me-md-2">Update</button></a>
                <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
              </div>
        
            </div>
          </div>
        </nav>

      <div class="container sign-up-page update-pg">
        <main class="form-signin w-100 m-auto form-page">
            <div class="row">
                <div class="col-md-6 image-style">
                    <img src="./assets/images/group.png" class="mb-4" alt="" height="100" width="100" id="img-logo">
                    <h1 class="h3 mb-3 fw-normal mt-3" id="head-logo"><span class="main-text1" style="color: rgb(0, 0, 150)">Update Information</span></h1>
                </div>
                <div class="col-md-6 form-contain">
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" id="updateForm">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full Name" value="<?php echo $user_data['full_name']; ?>" required>
                            <label for="full_name">Change Full Name</label>
                        </div>

                         
                        <div>
                          <select id="department" name="department" class="form-control form-select department-style">
                          <option selected>Change Department</option>
                            <option value="IT" <?php if ($user_data['department'] == 'IT') echo 'selected'; ?>>IT</option>
                            <option value="Software" <?php if ($user_data['department'] == 'Software') echo 'selected'; ?>>Software</option>
                            <option value="Civil" <?php if ($user_data['department'] == 'Civil') echo 'selected'; ?>>Civil</option>
                            <option value="Computer" <?php if ($user_data['department'] == 'Computer') echo 'selected'; ?>>Computer</option>
                            <option value="ELX" <?php if ($user_data['department'] == 'ELX') echo 'selected'; ?>>ELX</option>
                            <option value="BCA" <?php if ($user_data['department'] == 'BCA') echo 'selected'; ?>>BCA</option>
                          </select>
                        </div>

                        <div class="form-floating">
                            <input type="email" class="form-control" id="email_id" name="email_id" placeholder="name@example.com" value="<?php echo $user_data['email_id']; ?>" required>
                            <label for="email_id">Change College email address</label>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control show-pass" id="current_pass" name="current_pass" placeholder="Current Password" required>
                            <label for="current_pass">Current Password</label>
                            <div class="form-check text-start mb-3">
                                <input class="form-check-input" type="checkbox" id="showcurrentPassword">
                                <label class="form-check-label" for="showcurrentPassword">Show Password</label>
                            </div>
                        </div>

                        <div class="form-floating">
                            <input type="password" class="form-control show-pass" id="user_pass" name="user_pass" placeholder="Password" required>
                            <label for="user_pass">New Password</label>
                            <div class="form-check text-start mb-3">
                                <input class="form-check-input" type="checkbox" id="showPassword">
                                <label class="form-check-label" for="showPassword">Show Password</label>
                            </div>
                        </div>
                        <input type="submit" name="update" value="Update" class="btn btn-primary w-100 py-2 btn-size">
                        <p class="mt-4 mb-3 mar-in-signin">Want to try out something else? <a href="home.php" style="text-decoration:none;">Go Back</a></p>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <div class="container foot-div mt-5">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <p class="col-md-4 mb-0 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">© 2024 NCITArena</span></p>
                
                    
                    <a href="https://ncit.edu.np" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/NCIT_LOGO.jpg" height="45" width="45" class="bi me-2"></a>
                
                    <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="https://ncit.edu.np" target="_blank" class="nav-link px-2 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">Contact us</span></a></li>
                    
                    </ul>
                </footer>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.getElementById('showPassword').addEventListener('change', function () {
            var passwordInput = document.getElementById('user_pass');
            passwordInput.type = this.checked ? 'text' : 'password';
        });

        document.getElementById('showcurrentPassword').addEventListener('change', function () {
            var passwordInput = document.getElementById('current_pass');
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
    <script>
        document.getElementById('updateForm').addEventListener('submit', function (event) {
            var emailInput = document.getElementById('email_id').value;
            var collegeId = '<?php echo $_SESSION['college_id']; ?>';

            // Modify the regex to allow some data in front of the dot, followed by the college_id, and ending with @ncit.edu.np
            var emailRegex = new RegExp('^.+\\.' + collegeId + '.*@ncit\\.edu\\.np$');

            if (!emailRegex.test(emailInput)) {
                alert('Please enter a valid NCIT registered email address!');
                event.preventDefault(); // Prevent form submission if the entered email is not valid
            }

            var passwordInput = document.getElementById('user_pass').value;
            var currentPasswordInput = document.getElementById('current_pass').value;

            // Check if the password meets the criteria
            var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]+$/;

            if (!passwordRegex.test(passwordInput)) {
                alert('A password should be a combination of cap and small letters, numbers and characters!');
                event.preventDefault(); // Prevent form submission if the password is not valid
            }

        });
    </script>
  </body>
</html>
