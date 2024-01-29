<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['college_id'])){
  echo '<script>alert("Please sign in first!"); window.location.href = "signin.php";</script>';
  #header('location: signin.php');
}
?>
<!DOCTYPE html>
<html lang="en" theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" theme="dark">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
    <link rel="stylesheet" href="style.css">
    <title>NCITArena</title>
    <style>
        .upload-pg {
            margin-top: 3rem;
            margin-right: 8rem;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
        }
        .mar-in-signin {
          margin-left: 2.5rem;
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
              <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
              </div>
            </div>
          </div>
        </nav>
    <div class="container signin-page upload-pg">
        <main class="form-signin m-auto">
                <div class="form-contain">
                    <form method="post" enctype="multipart/form-data" action="#">
                        <div class="form-floating">
                            <input type="text" class="form-control"  name="filename" placeholder="insert file in pdf format" required>
                            <label for="floatingInput">File Name</label>
                        </div>
                        
                        <div class="form-floating">
                            <input type="text" class="form-control" id="rollNumber" name="rollNumber" placeholder="Your Roll Number" required>
                            <label for="rollNumber">Roll Number</label>
                        </div>
                        <div class="form-floating">
                            <select class="form-select" aria-label="Default select example" name="academicYear">
                                <option selected>Select Acamedic Year </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="mt-5">
                            <input type="file" class="form-control"  name="file"  required>
                         
                        </div>

                      
                        <button class="btn btn-primary w-100 py-2 btn-size" type="submit" name="submit">Upload</button>
                        <p class="mt-4 mb-3 mar-in-signin">Want to try out something else? <a href="home.php" style="text-decoration:none;">Go Back</a></p>
                      
                        
                    </form>
                </div>
            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./logic.js"></script>

</body>
<?php
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form is submitted

    // Sanitize and validate the input data
    $fileTitle = mysqli_real_escape_string($conn, $_POST['filename']);
    $rollNumber = mysqli_real_escape_string($conn, $_POST['rollNumber']);
    $academicYear = mysqli_real_escape_string($conn, $_POST['academicYear']);
    
    // File upload logic
    $fileUploadDirectory = 'uploads/';
    
    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileDestination = $fileUploadDirectory . $fileName;

    // Move the uploaded file to the destination directory
    move_uploaded_file($fileTempName, $fileDestination);

    // Prepare and execute the SQL statement
    $query = "INSERT INTO resource (resource_title, rollno, uploaddate, year, _path) VALUES (?, ?, NOW(), ?, ?)";
    
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "siss", $fileTitle, $rollNumber, $academicYear, $fileDestination);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    #header("Location: home.php");
    echo '<script>alert("Insertion Successful"); window.location.href = "home.php#event-resource-sec";</script>';
     
    exit();
}
?>


