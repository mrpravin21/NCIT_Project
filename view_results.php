<?php
include 'config.php';
session_start();
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn']!=true){
  echo '<script>alert("session not set"); window.location.href = "signin.php";</script>';
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
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Poll Results</title>
            <!-- Bootstrap CSS -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">

            <!-- Your custom styles -->
            <style>
                body {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                }

                .poll-results {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <div class="poll-results">
                <h2>Poll Results: <?php echo $poll['poll_title']; ?></h2>
                <p>Yes Votes: <?php echo $poll['poll_yes_votes']; ?></p>
                <p>No Votes: <?php echo $poll['poll_no_votes']; ?></p>
            </div>

            <!-- Bootstrap JS and Popper.js -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-GLhlTQ8iK9t17F89ZL3J17dS9A1G0brEz0tZ+6u7FqU8fM+FFOhC6dFpxB+uI" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
            
        </body>
        </html>
        <?php
    } else {
        echo "Poll not found.";
    }
}
?>

