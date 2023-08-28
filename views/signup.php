<?php $title = 'login' ?>

<?php

require('partials/head.php');

require('logic/validation.php')

?>

<body>
    <div class="mx-5">
        <center>
            <h5>Sign up</h5>
        </center>
        <form action="/signup" class="mx-5" method="POST" autocomplete="off">
            <label>Email: </label>
            <input type="text" class="form-control" name="email" value=<?= $input['email'] ?>>
            <small class="text-danger"><?= $error['email'] ?></small>

            <label> Password:</label>
            <input type="password" class="form-control" name="password"  value=<?= $input['pass'] ?>>
            <small class="text-danger"><?= $error['pass'] ?></small>

            <label>username: </label>
            <input type="text" class="form-control" name="name" value=<?= $input['name'] ?>>
            <small class="text-danger"><?= $error['name'] ?></small>

            <br>
            <input type="submit" name="signin" class="btn btn-primary w-100 rounded-pill">
        </form>
    </div>
</body>