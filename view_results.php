<!-- view_results.php -->
<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['poll_id'])) {
    $poll_id = $_GET['poll_id'];

    // Fetch poll details
    $select_query = "SELECT * FROM poll WHERE poll_id = $poll_id";
    $poll_result = mysqli_query($conn, $select_query);
    $poll = mysqli_fetch_assoc($poll_result);

    if ($poll) {
        // Display poll results
        echo "<h2>Poll Results: {$poll['poll_title']}</h2>";
        echo "<p>Yes Votes: {$poll['poll_yes_votes']}</p>";
        echo "<p>No Votes: {$poll['poll_no_votes']}</p>";
    } else {
        echo "Poll not found.";
    }
}
?>
