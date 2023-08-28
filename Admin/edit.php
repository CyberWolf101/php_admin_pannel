<?php
$title = 'Edit Details';
require('isadmin.php');
require('partials/head.php');
require('logic/connection.php');

$id = $_GET['id'];
$sql = "SELECT * FROM user_details WHERE user_ID = $id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
$depo = $user['active_deposits'];
$referral = $user['referal_balance'];
$earnings = $user['earnings'];


if (isset($_POST['update'])) {
    $newDepo = ($_POST['depo']);
    $newEarnings = ($_POST['earnings']);
    $newReferalBalance = ($_POST['referral']);

    $sql = "UPDATE user_details SET earnings='$newEarnings' , referal_balance='$newReferalBalance',active_deposits='$newDepo' WHERE user_ID = $id ";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo 'Balances have been updated successfully';
        header('location: /allusers');
        session_start();
        $_SESSION['updated'] = true;
      
    } else {
        echo 'An error occured';
        session_start();
        unset($_SESSION['updated']);
    }
}
?>



<body>
    <!-- NOTE THAT THE ACTION HAS TO BE TO THIS EXACT PAGE, HENCE WE HAVE TO DYNAMICALLY OUTPUT THE ID HENCE WE'LL GET AN ERROR -->
    <form action=<?= "/edit?id=" . $id ?> class="mx-4" method="POST">

        <label class="mt-3 fw-bold">Active Deposit:</label>
        <input type="number" name='depo' value=<?= $depo ?> class="form-control">

        <label class="mt-3 fw-bold">Earnings:</label>
        <input type="number" name='earnings' value=<?= $earnings ?> class="form-control">

        <label class="mt-3 fw-bold">Referral Balance:</label>
        <input type="number" name='referral' value=<?= $referral ?> class="form-control">

        <input type="submit" name="update" class="btn btn-primary w-100 mt-4" value="UPDATE" id="liveToastBtn">


    </form>


</body>