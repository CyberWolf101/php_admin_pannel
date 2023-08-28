<?php
$serverName = 'localhost';
$dbUser = 'root';
$dbPwd = '';
$dbName = 'recap';

$conn = mysqli_connect($serverName, $dbUser, $dbPwd, $dbName);

if(!$conn){
    die('connection error '. mysqli_connect_error());
}
