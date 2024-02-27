<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true || !isset($_SESSION['college_id'])) {
    echo '<script>alert("Please sign in first!"); window.location.href = "signin.php";</script>';
    exit;
}

// Check if the poll_id is set in both GET and POST requests
if (isset($_REQUEST['poll_id'])) {
    $pollId = $_REQUEST['poll_id'];

    // Fetch poll details
    $select_query = "SELECT * FROM poll WHERE poll_id = $pollId";
    $poll_result = mysqli_query($conn, $select_query);
    $poll = mysqli_fetch_assoc($poll_result);

    if ($poll) {
        // Check if the user has already voted for this poll
        $college_id = $_SESSION['college_id']; // Assuming you have a user_id in your users table
        $checkVoteQuery = "SELECT * FROM votes WHERE college_id = $college_id AND poll_id = $pollId";
        $checkVoteResult = mysqli_query($conn, $checkVoteQuery);

        if (mysqli_num_rows($checkVoteResult) > 0) {
            echo '<script>alert("You have already voted for this poll."); window.location.href = "home.php";</script>';
            exit;
        }

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_vote'])) {
            $voteOption = $_POST['vote_option'];

            // Update the vote count in the database
            $votePollQuery = "UPDATE poll SET ";
            if ($voteOption === 'yes') {
                $votePollQuery .= "poll_yes_votes = poll_yes_votes + 1 ";
            } elseif ($voteOption === 'no') {
                $votePollQuery .= "poll_no_votes = poll_no_votes + 1 ";
            }
            $votePollQuery .= "WHERE poll_id = $pollId";

            $votePollResult = mysqli_query($conn, $votePollQuery);

            if ($votePollResult) {
                // Record the user's vote in the votes table
                $recordVoteQuery = "INSERT INTO votes (college_id, poll_id, vote_option) VALUES ($college_id, $pollId, '$voteOption')";
                $recordVoteResult = mysqli_query($conn, $recordVoteQuery);

                if ($recordVoteResult) {
                    echo '<script>alert("Vote submitted successfully!"); window.location.href = "home.php";</script>';
                    exit;
                } else {
                    echo '<script>alert("Error recording vote.");</script>';
                }
            } else {
                echo '<script>alert("Error submitting vote.");</script>';
            }
        }

        // Render HTML form with Bootstrap styling
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>NCITArena</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
            <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
            <link rel="stylesheet" href="./style.css">
            <!-- Your custom styles -->
            <style>
                .vote-form {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    zoom: 130%;
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
                    <a href="update.php"><button class="btn btn-outline-success rounded-pill me-md-2">Update</button></a>
                    <a href="signout.php"><button class="btn btn-outline-danger rounded-pill">Sign Out</button></a>
                </div>
                </div>
            </div>
            </nav>
            <div class="vote-form">
                <div><h1 class="text-center text-body-emphasis mb-3"><span class="main-text1" style="color: rgb(0, 0, 150)">Vote on </span><span class="main-text1 fw-bold" style="color: rgb(0, 0, 150)">'<?php echo $poll['poll_title']; ?>'</span></h1><div>
                <form action="vote_poll.php" method="post" onsubmit="return submitVote();">
                    <div class="form-floating">
                        <input type="hidden" name="poll_id" value="<?php echo $pollId; ?>">
                        <div class="mb-3">
                            <label for="vote_option" class="form-label">Your Vote:</label>
                            <select id="vote_option" name="vote_option" class="form-select form-control" required>
                                <option selected>Select Your Vote</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                        <div class="mb-3 text-center mt-5">
                            <input type="submit" name="submit_vote" value="Submit Vote" class="btn btn-primary">
                        </div>
                    </div>
                </form>
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
            <script>
                function submitVote() {
                    var voteOption = document.getElementById("vote_option").value;
                    if (voteOption !== 'yes' && voteOption !== 'no') {
                        alert("Invalid vote option. Please select 'yes' or 'no'.");
                        return false;
                    }
                    return true;
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Poll not found.";
    }
}
?>
