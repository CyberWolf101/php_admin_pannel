<?php $title = 'Admin';

require('isadmin.php');

?>


<?php
require('partials/head.php');
require('logic/connection.php');

//make sql
$sql = "SELECT * FROM user_details ORDER BY created_AT";

//get result
$result = mysqli_query($conn, $sql);

//fetch result as an array
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);



?>

<body>
    <div class="mx-3">
        <?php
        if (isset($_SESSION['updated'])) {
            echo
            "
                 <div class='alert alert-success' role='alert'>
                     Balance updated successfully!
                 </div>
            ";
            sleep(1);
            unset($_SESSION['updated']);
        };
        if (isset($_SESSION['delete'])) {
            echo
            "
                 <div class='alert alert-danger' role='alert'>
                     User deleted!
                 </div>
            ";
            unset($_SESSION['delete']);
            sleep(1);
            unset($_SESSION['updated']);
        };
        ?>
    </div>

    <div class="grid mt-2">
        <?php

        foreach ($users as $user) : ?>
            <div class="shadow p-3">

                <?= "Username: " . "<b>" . $user['name'] . "</b>" . "<br> email:  " . "<b>" . $user['email'] . '</b>' ?>
                <div class="mt-2" style="display: flex;  align-items: center;">
                    <a href=" /details?id=<?= $user['user_ID'] ?>" class="btn btn-primary btn-sm">
                        <small> PROFILE</small>
                    </a>
                    &nbsp;&nbsp;
                    <a href=" /del?id=<?= $user['user_ID'] ?>" class=<?= $user['is_Admin'] == true ? 'd-none btn' : "  my-btn-danger" ?>>
                        <small>DELETE</small>
                    </a>
                    &nbsp;&nbsp;

                    <a href=" /edit?id=<?= $user['user_ID'] ?>" class="btn btn-success btn-sm" style="width: 60px;">
                        <small>EDIT</small>
                    </a>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</body>