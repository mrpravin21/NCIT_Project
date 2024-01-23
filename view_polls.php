<?php
// view_polls.php

include 'config.php'; // Make sure to include your database configuration

$getPollsQuery = "SELECT * FROM poll";
$getPollsResult = mysqli_query($conn, $getPollsQuery);

$polls = [];

while ($row = mysqli_fetch_assoc($getPollsResult)) {
    $polls[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>polls@NCIT</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
  <link type="image/png" sizes="32x32" rel="icon" href="./assets/images/dark_fav.png">
  <link rel="stylesheet" href="./style.css">
</head>

<body>
        <div class="container">
        <h2 class="mb-4" style="color: grey;">Available Polls</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($polls as $poll) : ?>
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $poll['poll_title']; ?></h3>
                            <p class="card-text"><?php echo $poll['poll_description']; ?></p>
                            <p class="card-text">Created by: <?php echo $poll['poll_creator']; ?></p>
                            <p class="card-text">End Time: <?php echo $poll['poll_end_time']; ?></p>

                            <!-- Countdown Timer -->
                            <div id="countdown_<?php echo $poll['poll_id']; ?>"></div>

                            <!-- Always display both buttons -->
                            <a href="view_results.php?poll_id=<?php echo $poll['poll_id']; ?>" data-poll-id="<?php echo $poll['poll_id']; ?>" class="view-results-button">
                                <button class="btn btn-outline-secondary" type="button">View Status</button>
                            </a>
                            <a href="vote_poll.php?poll_id=<?php echo $poll['poll_id']; ?>" data-poll-id="<?php echo $poll['poll_id']; ?>" class="vote-button">
                                <button class="btn btn-primary" type="button">Vote</button>
                            </a>

                            <script>
                                // Function to update the countdown timer
                                function updateCountdownTimer(endTime, elementId, pollId) {
                                    var countDownDate = new Date(endTime).getTime();
                                    var x = setInterval(function () {
                                        var now = new Date().getTime();
                                        var distance = countDownDate - now;

                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                                        var timerElement = document.getElementById(elementId);
                                        var voteButton = document.querySelector('.vote-button[data-poll-id="' + pollId + '"]');
                                        var viewResultsButton = document.querySelector('.view-results-button[data-poll-id="' + pollId + '"]');

                                        if (timerElement) {
                                            timerElement.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                                        }

                                        if (distance < 0) {
                                            clearInterval(x);
                                            if (timerElement) {
                                                timerElement.innerHTML = "<span id='main-text'>Poll Ended</span>";
                                            }

                                            if (voteButton) {
                                                voteButton.style.display = "none";
                                            } else {
                                                console.error("Vote button not found for poll ID " + pollId);
                                            }

                                            if (viewResultsButton) {
                                                viewResultsButton.style.display = "inline-block";
                                            } else {
                                                console.error("View Results button not found for poll ID " + pollId);
                                            }
                                        }
                                    }, 1000);
                                }

                                // Call the function to update the countdown timer
                                updateCountdownTimer("<?php echo $poll['poll_end_time']; ?>", "countdown_<?php echo $poll['poll_id']; ?>", <?php echo $poll['poll_id']; ?>);
                            </script>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
