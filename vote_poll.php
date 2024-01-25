<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != true) {
    echo '<script>alert("Session not set"); window.location.href = "signin.php";</script>';
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
            <title>Vote</title>
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

                .vote-form {
                    width: 300px;
                }
            </style>
        </head>
        <body>
            <div class="vote-form">
                <h2 class="text-center">Vote: <?php echo $poll['poll_title']; ?></h2>
                <form action="vote_poll.php" method="post" onsubmit="return submitVote();">
                    <div class="form-floating">
                        <input type="hidden" name="poll_id" value="<?php echo $pollId; ?>">
                        <div class="mb-3">
                            <label for="vote_option" class="form-label">Your Vote:</label>
                            <select id="vote_option" name="vote_option" class="form-select form-control" required>
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

            <!-- Bootstrap JS and Popper.js -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-GLhlTQ8iK9t17F89ZL3J17dS9A1G0brEz0tZ+6u7FqU8fM+FFOhC6dFpxB+uI" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
