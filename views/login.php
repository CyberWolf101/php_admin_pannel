<?php
$title = 'Login';
require('partials/head.php');
$error = '';
$usernameInput = '';

require('logic/login.php');
?>

<body>
  <div class="mx-5">
    <center>
      <h5>Login</h5>
    </center>
    <form action="/login" class="mx-5" method="POST" autocomplete="off">
      <input type="text" class="form-control" name="name" placeholder="Username..." value=<?= $usernameInput ?>>

      <input type="password" class="form-control mt-3" name="password" placeholder="Password...">
      <br>
      <input type="submit" name="LOGIN" class="btn btn-primary w-100 rounded-pill mb-3">
      <div class=<?= $error == '' ? "d-none" : "error-bg " ?>>
        <center> <small class="text-danger"><?= $error ?></small></center>
      </div>
    </form>


  </div>
</body>