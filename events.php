<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['college_id'])){
  echo '<script>alert("Please sign in first!"); window.location.href = "signin.php";</script>';
  #header('location: signin.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NCITArena</title>
  <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="style.css">-->
  <style>
        .upload-pg {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh;
            width: 50%;
        }
        .foot-div {
            margin-top: 22rem;
        }
        .mar-in-signin {
          margin-left: 6.5rem;
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
              <a class="navbar-brand col-lg-3 me-0" href="home.php"><img src="./assets/images/light_logo.png" alt="logo" height="30" class="img-mar" id="logoimg" style="margin-right:1rem;">NCITArena</a>
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
                <a href="update.php"><button class="btn btn-outline-success rounded-pill me-md-2">Update</button></a>
                <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
              </div>
            </div>
          </div>
   </nav>
  <div class="container mt-5 upload-pg">
  <main class=" w-100 m-auto">
    <div class="form-contain">
    <form method="post" action="#" enctype="multipart/form-data" class="w-75 mx-auto">

      <div class="form-floating mb-5 mt-5">
        <input type="text" class="form-control" id="eid" name="eid" placeholder="Event ID" required>
        <label for="eid">Event ID</label>
      </div>

      <div class="form-floating mb-5">
        <input type="text" class="form-control" id="event_title" name="event_title" placeholder="Event Title" required>
        <label for="event_title">Event Title</label>
        
      </div>

      <div class="form-floating mb-5">
        <input type="text" class="form-control" id="location" name="location" placeholder="Event Coordinator" required>
        <label for="location">Event Coordinator</label>
      </div>

      <div class="mb-5 form-floating">
        <select class="form-select department-style" id="organizer" name="organizer">
          <option selected>Select Organizer</option>
          <option value="HULT">HULT</option>
          <option value="NOSK">NOSK</option>
          <option value="NTC">NTC</option>
          <option value="POLITICAL">Student Union</option>
          <option value="others">Others</option>
        </select>
      </div>

      <div class="form-floating mb-5">
        <textarea class="form-control" id="message" name="message" rows="5" style="height:5rem;" placeholder="Event Details" required></textarea>
        <label for="message">Event Details</label>
      </div>

      <div class="form-floating mb-5">
        <input type="date" class="form-control" id="date" name="date" placeholder="Event Date" required>
        <label for="date">Event Date</label>
      </div>

      <div class="mb-5">
        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
      </div>

      <button type="submit" class="btn btn-primary w-100 py-2 btn-size" name="submit">Submit</button>
      <p class="mt-4 mb-3 mar-in-signin">Want to try out something else? <a href="home.php" style="text-decoration:none;">Go Back</a></p>
      </div>
    </form>
    </div>
    </main>
  </div>
  <div class="container foot-div">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
            <p class="col-md-4 mb-0 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150);">© 2024 NCITArena</span></p>
        
            
            <a href="https://ncit.edu.np" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/NCIT_LOGO.jpg" height="45" width="45" class="bi me-2"></a>
        
            <ul class="nav col-md-4 justify-content-end">
              <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150);">Contact us</span></a></li>
              
            </ul>
        </footer>
      </div>

  <!-- Bootstrap JS (optional) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="./logic.js"></script>
</body>

</html>


<?php
include("config.php");

if (isset($_POST['submit'])) {
    $filename = $_FILES["image"]["name"];
    $tempname = $_FILES["image"]["tmp_name"];
    $folder = $_SERVER['DOCUMENT_ROOT'] . "/NCIT_Project/images/" . $filename;
    echo "Full Path: " . $folder;

    $selectedDate = $_POST['date'];
    $currentDate = date("Y-m-d");
    if ($selectedDate < $currentDate) {
        echo '<script>alert("Please select a date after the current date.");</script>';
    } else {

        if (move_uploaded_file($tempname, $folder)) {
            echo "File uploaded successfully.";

            $a = $_POST['eid'];
            $b = $_POST['event_title'];
            $c = $_POST['location'];
            $d = $_POST['organizer'];
            $e = $_POST['message'];
            $f = $_POST['date'];

            // Use prepared statement to prevent SQL injection
            $sql = "INSERT INTO events(eid, event_title, location, organizer, event_date, other_details, photo_path)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "issssss", $a, $b, $c, $d, $f, $e, $filename);

            if (mysqli_stmt_execute($stmt)) {
                echo "Data entered successfully";
                
                // Redirect only if the statement execution is successful
              
            } else {
                echo "Unsuccessful entry";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error moving the uploaded file to $folder. Check folder permissions and file paths.";
        }
        #header("Location: home.php"); 
        #exit();
      # <script><script>
      echo '<script>alert("Insertion Successful"); window.location.href = "home.php#event-resource-sec";</script>';
    }  

}
?>
