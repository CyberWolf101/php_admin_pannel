<?php
$title = 'Trade';
require('partials/head.php');
require('logic/connection.php');

//Fetch user's Balance first

$id =  $_SESSION['id'];
$sql = "SELECT * FROM user_details WHERE user_ID = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$error = '';
$message = '';
$currentMillisecs = time() * 1000;
$countdownMillisecondsFromDB = ($user['trade_start'] + (3 * 60 * 60)) * 1000; // Get the countdown time in milliseconds
$timeDiff =  $countdownMillisecondsFromDB  - $currentMillisecs;
if ($timeDiff > 1) {
  header('location: /trading');
} else {
  // here is where we want to update the balance by adding to the current balance

  // $updateSql = "UPDATE user_details SET active_deposits='$newBalance',trade_start = '$time'  WHERE user_ID = $id";
  // $execute = mysqli_query($conn, $updateSql);
  $message = 'Balance Updated successfully';
}

// Trade logic
if (isset($_POST['trade'])) {
  $amount = $_POST['amount'];


  if (empty($amount)) {
    $error = "Invalid input!";
  } else if ($amount > $user['active_deposits']) {
    $error = "You cannot trade an amount greater than your balance";
  } else {
    $newBalance = $user['active_deposits'] - $amount;
    $time = time();
    $updateSql = "UPDATE user_details SET active_deposits='$newBalance',trade_start = '$time'  WHERE user_ID = $id";
    $execute = mysqli_query($conn, $updateSql);
    $message = 'TRADE STARTED';
    header('location: /trading');
  }
}
?>


<body>
  <?=$timeDiff?>
  <center><b class="text-uppercase">Enter Trade Amount</b></center>

  <div class="mx-3 my-4">
    <div class="card text-center">
      <div class="card-header">

      </div>
      <div class="card-body">
        <h5 class="card-title" style="font-size: 14px;">Active Deposits</h5>
        <p class="card-text text-black">
          <?= $user["active_deposits"] ?>
          USD
        </p>
      </div>
      <div class="card-footer text-muted">
      </div>
    </div>
  </div>
  <form action="/trade" class="mx-5" method="POST">
    <label>Amount: </label>
    <input type="number" class="form-control" name="amount" placeholder="Amount($)">
    <?php
    if (!empty($error)) {
      echo
      "
           <div class='alert alert-danger mt-3' role='alert'>
             $error
           </div>
      ";
    };
    if (!empty($message)) {
      echo
      "
           <div class='alert alert-success mt-3' role='alert'>
               Trade started successfully!
           </div>
      ";
    };
    ?>
    <input type="submit" name="trade" class="btn btn-primary w-100 rounded-pill mt-3" value="Start Trade">
  </form>
</body>