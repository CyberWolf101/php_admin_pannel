<?php $title = 'deposits';

require('isadmin.php');

?>


<?php
require('partials/head.php');
require('logic/connection.php');

//make sql
$sql = "SELECT * FROM depos ORDER BY created_AT";


//get result
$result = mysqli_query($conn, $sql);

//fetch result as an array
$depos = mysqli_fetch_all($result, MYSQLI_ASSOC); //this gets all the results but 'mysqli_fetch_assoc' getches 1

require('logic/approveDepo.php');



?>

<body>

    <div class="grid mt-2">
        <?php

        foreach ($depos as $depo) : ?>
            <div class="shadow p-3">

                <?= "Username: " . "<b>" . $depo['username'] . "</b>" . "<br> email:  " . "<b>" . $depo['email'] . '</b>' ?>
                <div>
                    Amount:
                    <b>
                        <?=
                        $depo['amount']
                        ?>
                        USD
                    </b>
                </div>



                <div class="mt-2" style="display: flex;  align-items: center;">
                    <form action="/depos" method="POST">
                        <input type="hidden" name="depoID" value=<?= $depo['id'] ?>>
                        <input type="hidden" name="userID" value=<?= $depo['user_ID'] ?>>
                        <input type="submit" name='approve' class="btn btn-success btn-sm" value="APPROVE">
                    </form>
                    &nbsp;&nbsp;

                    <form action="/depos" method="POST">
                        <input type="hidden" name="depoID" value=<?= $depo['id'] ?>>
                        <input type="submit" name='decline' class="btn btn-danger btn-sm" value="DECLINE">
                    </form>


                   
                </div>
            </div>
        <?php endforeach
        ?>
    </div>
</body>