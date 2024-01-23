<?php
include 'config.php';

// Check if the poll_id is set in both GET and POST requests
if (isset($_REQUEST['poll_id'])) {
    $pollId = $_REQUEST['poll_id'];

    // Fetch poll details
    $select_query = "SELECT * FROM poll WHERE poll_id = $pollId";
    $poll_result = mysqli_query($conn, $select_query);
    $poll = mysqli_fetch_assoc($poll_result);

    if ($poll) {
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
                echo '<script>alert("Vote submitted successfully!"); window.location.href = "home.php";</script>';
            } else {
                echo '<script>alert("Error submitting vote.");</script>';
            }
        }

        // Render HTML form
        ?>
        <!-- Your HTML form to vote on a poll -->
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Vote</title>
        </head>
        <body>
            <h2>Vote: <?php echo $poll['poll_title']; ?></h2>
            <form action="vote_poll.php" method="post" onsubmit="return submitVote();">
                <input type="hidden" name="poll_id" value="<?php echo $pollId; ?>">
                <label for="vote_option">Your Vote:</label>
                <select id="vote_option" name="vote_option" required>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>
                <br>
                <input type="submit" name="submit_vote" value="Submit Vote">
            </form>

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