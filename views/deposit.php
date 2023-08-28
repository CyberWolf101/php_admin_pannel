<?php
$title = 'deposit';
require('partials/head.php');
require('logic/authenticate.php');

//form logic
$error = '';

if (isset($_POST['deposit'])) {
    $amount = $_POST['amount'];
    if ($amount < 30) {
        $error = 'Amount must be atleast $30';
    } else {
        require("logic/connection.php");
        // Check if the table exists
        $tableExistsQuery = "SHOW TABLES LIKE 'depos'";
        $tableExistsResult = mysqli_query($conn, $tableExistsQuery);

        //sql to auto create table
        // int makes it a number and auto increment will make it to be adding 1 over time
        // varchar mean it's astring and the number in the bracket is the total values allowed
        //if you say not null the db will not accept the data without the value as it will raise an error
        if (mysqli_num_rows($tableExistsResult) == 0) {
            $sql = "CREATE TABLE depos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            user_ID INT NOT NULL,
            amount INT NOT NULL,
            millisec INT,
            created_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        //always remove the comma from the last insertion
            mysqli_query($conn, $sql);
        }
        $time = time();
        $id = $_SESSION['id'];
        $email =  $_SESSION['email'];
        $name =  $_SESSION['name'];
        //add to db
        $depoSql = "INSERT INTO depos(amount, username, email, user_ID, millisec) VALUES('$amount','$name','$email','$id', '$time')";
        $added = mysqli_query($conn, $depoSql);

        if ($added) {
            $_SESSION['added'] = true;
        } else {
            $_SESSION['failed'] = true;
        }
    }
}
?>


<body>
    <form action="/deposit" class="mx-5" method="POST">
        <label>Amount: </label>
        <input type="number" class="form-control" name="amount" placeholder="Amount($)">
        <small class="text-danger"><?= $error . "<br>" ?></small>
        <label>Address: </label>
        <input type="text" class="form-control" disabled value="shsbhbhshbhbshhsbhshysuusugsgu">
        <br>
        <input type="submit" name="deposit" class="btn btn-primary w-100 rounded-pill" value="I've made payment">
    </form>
    <div class="mx-3">
        <?php
        if (isset($_SESSION['added'])) {
            echo
            "
                 <div class='alert alert-success' role='alert'>
                    Your balance will be updated once payment is confirmed
                 </div>
            ";
            sleep(1);
            unset($_SESSION['added']);

            echo '<center><small><a href="/dashboard">back to main page</a></small></center>';
        };

        if (isset($_SESSION['failed'])) {
            echo
            "
                 <div class='alert alert-danger' role='alert'>
                    Your request was not processed, try again
                 </div>
            ";
            sleep(1);
            unset($_SESSION['failed']);
        };
        ?>
    </div>

</body>