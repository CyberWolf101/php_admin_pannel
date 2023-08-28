<?php
require('logic/connection.php');

$id = $_GET['id'];
$sql = "DELETE FROM user_details WHERE user_ID = $id";
$result = mysqli_query($conn, $sql);
header('location: /allusers');
session_start();
$_SESSION['delete'] = true;