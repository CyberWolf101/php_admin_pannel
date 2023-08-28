<?php
$title = 'Not Found';
require('partials/head.php');
$page = $_SERVER['REQUEST_URI'];
?>

<body>
    <center>
        <h3>
            <?= "The page '" . $page . "' was not found" ?>
        </h3>
    </center>
</body>