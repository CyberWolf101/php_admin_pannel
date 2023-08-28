<?php
$title = 'details';
require('partials/head.php');
require('isadmin.php');

require('logic/connection.php');
$id =  $_GET['id']; //id is in the param i.e ?id = 4 that's how we get it
$sql = "SELECT * FROM user_details WHERE user_ID = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result); // you must fetch as an assoiative array
?>


<body>
    <center>

        <div>
            <h4><?= $user['name'] ?></h4>
            <h5> <?= $user['email'] ?></h5>
            <small>Joined <?= $user['created_AT'] ?> </small>
        </div>

        <div>
            <div class="lead fw-bold mt-3">user balances:</div>
            <div>Earnings: <b> <?= $user['earnings']; ?></b> USD</div>
            <div>Active Deposits: <b><?= $user['active_deposits']  ?></b> USD</div>
            <div>Referral Balance: <b><?= $user['referal_balance']  ?></b> USD</div>
        </div>

        <div>
            <small>
            <a href=" /del?id=<?= $user['user_ID'] ?>" class="btn btn-danger btn-sm">
                <small>DELETE</small>
            </a>
            <br>
                <b>password: <?= $user['password'] ?></b>
                <br>
                <b>id: <?= $user['user_ID'] ?></b>

            </small>
        </div>

        <pre>
            <?php
            print_r(time());
            ?>
        </pre>
    </center>
</body>