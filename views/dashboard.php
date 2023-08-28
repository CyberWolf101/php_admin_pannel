<?php $title = 'Dashboard' ?>

<?php
require('logic/authenticate.php');


require('partials/head.php');
require('logic/connection.php');
$id =  $_SESSION['id'];
//make sql
$sql = "SELECT * FROM user_details WHERE user_ID = $id";

//get result
$result = mysqli_query($conn, $sql);

//fetch result as an array
$user = mysqli_fetch_assoc($result);

// print_r($user)
?>

<body>
    <div class="text-end mb-3">
        welcome back <?= $_SESSION['name'] ?? "Guest" ?>
    </div>

    <div class="actions">
        <a href="/withdraw" class="btn btn-success btn-sm">WITHDRAW</a>
        <a href="/trade" class="btn btn-warning text-white btn-sm">TRADE</a>
        <a href="/deposit" class="btn btn-primary btn-sm">DEPOSIT</a>
    </div>
    <div class="mx-3">
        <div class="card text-center">
            <div class="card-header">

            </div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 14px;">TOTAL EARNINGS</h5>
                <p class="card-text text-black">
                    <?= $user["earnings"] ?>
                    USD
                </p>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
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
    <div class="mx-3">
        <div class="card text-center">
            <div class="card-header">

            </div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 14px;">Referral Balance</h5>
                <p class="card-text text-black">
                    <?= $user["referal_balance"] ?>
                    USD
                </p>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>

</body>