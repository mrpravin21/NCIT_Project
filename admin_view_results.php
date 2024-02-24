<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true || !isset($_SESSION['admin_username'])){
  echo '<script>alert("Admin access denied!"); window.location.href = "admin_signin.php";</script>';
  #header('location: signin.php');
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['poll_id'])) {
    $poll_id = $_GET['poll_id'];

    // Fetch poll details
    $select_query = "SELECT * FROM poll WHERE poll_id = $poll_id";
    $poll_result = mysqli_query($conn, $select_query);
    $poll = mysqli_fetch_assoc($poll_result);

    if ($poll) {
        // Display poll results with Bootstrap styling
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=2.0">
            <title>NCITArena</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
            <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
            <link rel="stylesheet" href="./style.css">
            <!-- Your custom styles -->
            <style>
                body {
                    overflow: hidden;
                }
                .poll-results {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    zoom: 130%;
                }
            </style>
          
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
                    <a class="nav-link" href="admin_view.php">View</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="admin_panel.php">Delete</a>
                    </li>
                </ul>
                <div class="d-lg-flex col-lg-3 justify-content-lg-end">
                    <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
                </div>
                </div>
            </div>
            </nav>
            <div class="poll-results">
                <div><h1 class="display-5 text-body-emphasis lh-1 mb-3"><span class="main-text1" style="color: rgb(0, 0, 150)">Poll Results of </span><span class="fw-bold main-text1" style="color: rgb(0, 0, 150)">'<?php echo $poll['poll_title']; ?>'</span></h1><div>
                <div><p style="margin-top: 3rem; color: green;" class="lead fw-bold">Yes Votes: <span class="main-text1 fw-bold" style="color: rgb(0, 0, 150)"><?php echo $poll['poll_yes_votes']; ?></span></p><div>
                <div><p style="margin-top: 3rem; color:red;" class="fw-bold">No Votes: <span class="main-text1 fw-bold" style="color: rgb(0, 0, 150)"><?php echo $poll['poll_no_votes']; ?></span></p><div>
            </div>
            <div class="container foot-div mt-5">
                <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                    <p class="col-md-4 mb-0 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">© 2024 NCITArena</span></p>
                
                    
                    <a href="https://ncit.edu.np" target="_blank"> <img src="https://upload.wikimedia.org/wikipedia/commons/c/cc/NCIT_LOGO.jpg" height="45" width="45" class="bi me-2"></a>
                
                    <ul class="nav col-md-4 justify-content-end">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary"><span class="main-text1" style="color: rgb(0, 0, 150)">Contact us</span></a></li>
                    
                    </ul>
                </footer>
            </div>
            <!-- Bootstrap JS and Popper.js -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-GLhlTQ8iK9t17F89ZL3J17dS9A1G0brEz0tZ+6u7FqU8fM+FFOhC6dFpxB+uI" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            <script src="./logic.js"></script>
        </body>
        </html>
        <?php
    } else {
        echo "Poll not found.";
    }
}
?>