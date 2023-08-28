<?php
$title = 'ADMIN';
require('partials/head.php');
require('isadmin.php');

require('logic/connection.php');

//GET USERS
$sql = "SELECT * FROM user_details ORDER BY created_AT";
$result = mysqli_query($conn, $sql);
// Get the number of rows in the result set
$total = mysqli_num_rows($result);
// count($associativeArray) // you can get the length of an array with the count function


//GET DEPOSITS
$sqlOfDeposits = "SELECT * FROM depos ORDER BY created_AT";
$resultOfDeposits = mysqli_query($conn, $sqlOfDeposits); 
$totalDeposits = mysqli_num_rows($resultOfDeposits);


//GET TOTAL ACTIVE DEPOSITS
$totalACtiveDeposits = 0;  //make sure to initialize it as zero
$sqlOfActiveDeposits = "SELECT active_deposits FROM user_details ORDER BY created_AT";
$resultOfActiveDeposits = mysqli_query($conn, $sqlOfActiveDeposits); 
$allActiveDeposits = mysqli_fetch_all($resultOfActiveDeposits, MYSQLI_ASSOC);

foreach($allActiveDeposits as $deposits){
    $totalACtiveDeposits += $deposits['active_deposits'];
}
?>


<body>
    <div class="container">
    <a class="card text-center text-decoration-none text-black" href="/allusers">
            <div class="card-header">
            </div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 14px;">Registered users</h5>
                <p class="card-text text-black">
                    <?= $total ?>
                </p>
            </div>
            <div class="card-footer text-muted">
            </div>
        </a>

    <a class="card text-center text-decoration-none text-black mt-4" href="/depos">
            <div class="card-header">
            </div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 14px;">Pending Deposits</h5>
                <p class="card-text text-black">
                    <?= $totalDeposits ?>
                </p>
            </div>
            <div class="card-footer text-muted">
            </div>
        </a>

    <div class="card text-center text-decoration-none text-black mt-4" href="/depos">
            <div class="card-header">
            </div>
            <div class="card-body">
                <h5 class="card-title" style="font-size: 14px;">Active Deposits</h5>
                <p class="card-text text-black">
                    $<?= $totalACtiveDeposits ?>
                </p>
            </div>
            <div class="card-footer text-muted">
            </div>
</dib>



    </div>
</body>