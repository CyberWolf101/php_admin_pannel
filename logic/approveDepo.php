<?php

require('connection.php');

if (isset($_POST['approve'])) {
    $depo_id = $_POST['depoID']; //id of the deposit details
    $user_id = $_POST['userID']; //id of user who made deposit

    //get values of each of them
    $get_DEPOSITOR = "SELECT * FROM user_details WHERE user_ID = $user_id";
    $get_user_depo =  "SELECT * FROM depos WHERE id = $depo_id";

    // make query
    $depositorResult = mysqli_query($conn, $get_DEPOSITOR);
    $dopositDetailsResult =  mysqli_query($conn, $get_user_depo);

    // Turn them into associative array else you can't reference the values, DO NOT FETCH ALL
    $depositor_array = mysqli_fetch_assoc($depositorResult);
    $depositor_details_array = mysqli_fetch_assoc($dopositDetailsResult);


    // print_r($depositor_array['active_deposits']);
    // print_r($depositor_details_array['amount']);
    $newDepo = $depositor_array['active_deposits'] + $depositor_details_array['amount'];

    $sql = "UPDATE user_details SET active_deposits='$newDepo' WHERE user_ID = $user_id ";
    $execute =  mysqli_query($conn, $sql);

    if ($execute) {
        $delete_sql = "DELETE FROM depos WHERE id = $depo_id";
        mysqli_query($conn, $delete_sql);
        header('location: /dashboard');
    }else{
        echo"AN error occured";
    }
}

if (isset($_POST['decline'])) {
    $depo_id = $_POST['depoID']; 
    $delete_sql = "DELETE FROM depos WHERE id = $depo_id";
    mysqli_query($conn, $delete_sql);
    header('location: /dashboard');
}