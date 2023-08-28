<?php $title = 'Home' ?>


<?php
//1693073885 shuld be replaced with time gotten from db which was gotten with the time() php function.
//then we added 3 hours to the seconds "1693073885" and converted it to milliseconds by multiplying by 1000.

$countdownMillisecondsFromDB = (1693073885 + (3 * 60 * 60)) * 1000; // Get the countdown time in milliseconds

// Calculate remaining time in milliseconds
$currentTimestampMilliseconds = time() * 1000; // Current timestamp in milliseconds
$remainingMilliseconds = $countdownMillisecondsFromDB - $currentTimestampMilliseconds;
?>

<?php
require('partials/head.php');
require('logic/connection.php');

?>


<body>
    <p id="countdown"></p>

    <a href="/dashboard" class="btn btn-primary ms-2">
        Get started
    </a>

</body>

<script>
    var countdownMilliseconds = <?php echo $remainingMilliseconds; ?>;

    function updateCountdown() {
        countdownMilliseconds -= 1000; // Decrease by 1 second (1000 milliseconds)

        var seconds = Math.floor(countdownMilliseconds / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);

        var remainingHours = hours % 24;
        var remainingMinutes = minutes % 60;
        var remainingSeconds = seconds % 60;
        var countdownDisplay = document.getElementById('countdown');
        // countdownDisplay.innerHTML = days + " days, " + remainingHours + " hours, " + remainingMinutes + " minutes, " + remainingSeconds + " seconds remaining.";
        countdownDisplay.innerHTML = remainingHours + " hours, " + remainingMinutes + " minutes, " + remainingSeconds + " seconds remaining.";
    }

    // Update countdown initially
    updateCountdown();

    // Update countdown every second
    setInterval(updateCountdown, 1000);
</script>

