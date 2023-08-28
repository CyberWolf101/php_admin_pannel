<?php
if (isset($_POST['LOGIN'])) {
    require('logic/connection.php');
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $password = $_POST['password'];


    if (empty($username) || empty($password)) {
        $error = 'Invalid inputs';
    } else {
        //there is a problem from here down cus we can't access the hashed password only the normal ones...BUT ALTERNATIVELY WE CAN JUST MAKE AN SQL TO GET THE DATA
        $query = "SELECT * FROM user_details WHERE name = '$username'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {  // a php function that that is used to retrieve the number of rows 
            $error = 'Incorrect username ';
            $usernameInput = $username;
        } else {
            $user = mysqli_fetch_assoc($result);
            $passwordInDb = $user['password'];  //user's password in db
            if ($passwordInDb == $password) {
                // $pwdChecked = password_verify($password, $pwd); // if we wanted to verify the hashed password
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['user_ID'];
                $_SESSION['joined'] = $user['created_AT'];
                $_SESSION['earnings'] = $user['earnings'];
                $_SESSION['referal_balance'] = $user['referal_balance'];
                $_SESSION['active_deposit'] = $user['active_deposits'];
                $_SESSION['is_Admin'] = $user['is_Admin'];
                header('location: /');
            } else {
                $error = 'Incorrect Password!';
                $usernameInput = $username;
            }
        }
    }
}
