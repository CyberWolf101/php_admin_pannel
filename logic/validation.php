<?php
$error = array('email' => "", 'pass' => '', 'name' => "");
$input = array('email' => "", 'pass' => '', 'name' => "");
require('logic/connection.php');

if (isset($_POST['signin'])) {
    $email = mysqli_real_escape_string($conn, $_POST["email"]);    // mysqli_real_escape_string is to prevent code injection, and we provide the connection to know the db we are working with
    $pass = mysqli_real_escape_string($conn, $_POST["password"]);
    $name = mysqli_real_escape_string($conn, $_POST["name"]);

   
// '->' is a php operator used for accessing methods and properties of an object

    if (empty($email)) {
        $error['email'] = 'Email is required! <br>';
    }
   if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = 'Email is Invalid! <br>';
        $input['email'] = $email;
    }
    if (!empty($email)) {
        //check if email exist already
        $query =  "SELECT * FROM user_details WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){  // a php function that that is used to retrieve the number of rows 
            $error['email'] = 'Email is already exist! <br>';
            $input['email'] = $email;
        }
    }
    if (strlen($pass) < 5) {
        $error['pass'] = 'Passowrd must contain atleast 5 characters! <br>';
        $input['pass'] = $pass;
        
    }
    if (strlen($name) < 3) {
        $error['name'] = 'username must contain atleast 3 characters! <br>';
        $input['name'] = $name;
      
    }
    if (strlen($name) > 3) {
        // check if name alreadt exist
        $query = "SELECT * FROM user_details WHERE name = '$name'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0){  // a php function that that is used to retrieve the number of rows 
            $error['name'] = 'userame  already exist! <br>';
            $input['name'] = $name;
        }
        if(!preg_match("/^[a-zA-Z0-9]*$/", $name)){  // checking if any value in the name variable is anything else apart from that 
            $error['name'] = 'Username can only contain letters and numbers <br>';
            $input['name'] = $name;
        }
      
    }
    
    if (array_filter($error)) {  //returns true if its empty
        return; //do nothing
    } else {
        //hash password
    //    $hashedpwd = password_hash($pass, PASSWORD_DEFAULT);


        $sql = "INSERT INTO user_details(email, password, name) VALUES ('$email',' $pass', '$name')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: /');

        } else {
            echo 'wahala';
        }
    }
}
