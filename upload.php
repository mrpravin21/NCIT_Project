<!DOCTYPE html>
<html lang="en" theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" theme="dark">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link type="image/png" sizes="96x96" rel="icon" href="./assets/images/icons8-complaint-96.png">
    <link rel="stylesheet" href="style.css">
    <title>NCITArena</title>
</head>
<body>

    <div class="container login-page">
        <main class="form-signin w-100 m-auto form-page">
            <div class="row">
           <h1 >  Upload Your Resources</h1>
           
                </div>
                <div class="col-md-6 form-contain">
                    <form method="post" enctype="multipart/form-data" action="#">
                        <div class="form-floating">
                            <input type="text" class="form-control"  name="filename" placeholder="insert file in pdf format" required>
                            <label for="floatingInput">File Name</label>
                        </div>
                        
                        <div class="form-group-resource form-floating">
            <input type="text" class="form-control" id="rollNumber" name="rollNumber" placeholder="Your Roll Number" required>
            <label for="rollNumber">Roll Number</label>
        </div>
        <div>
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

                      
                        <button class="btn btn-primary w-100 py-2 btn-size" type="submit" name="submit">upload</button>
                      
                        
                    </form>
                </div>
            </div>
        </main>
    </div>

   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<style>
h1 {
            color: blue; /* Change color to blue */
            text-align: left; /* Align to the left */
        }

    </style>
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


