<?php

require('logic/authenticate.php');

if( $_SESSION['is_Admin']== false){
    header("location: /login");
}
