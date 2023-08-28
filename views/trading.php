<?php
$title = 'Trading';


require('logic/connection.php');

$id =  $_SESSION['id'];
$sql = "SELECT * FROM user_details WHERE user_ID = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

$countdownMillisecondsFromDB = ($user['trade_start'] + (3 * 60 * 60)) * 1000; // Get the countdown time in milliseconds

// Calculate remaining time in milliseconds
$currentTimestampMilliseconds = time() * 1000; // Current timestamp in milliseconds
$remainingMilliseconds = $countdownMillisecondsFromDB - $currentTimestampMilliseconds;

if($remainingMilliseconds < 1){
    header('location: /trade');
}


require('partials/head.php');

?>


<body>
    <center>
        <b class="text-uppercase"> Time remaining</b>
        <h5 id="countdown"></h5>
    </center>
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