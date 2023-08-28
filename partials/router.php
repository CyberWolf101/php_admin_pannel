<?php
$page = parse_url($_SERVER["REQUEST_URI"])['path'];


$routes = [
    '/' =>  'views/index.php',
    '/admin-page' => 'Admin/Admin.php',
    '/dashboard' => 'views/dashboard.php',
    '/withdraw' => 'views/withdraw.php',
    '/trade' => 'views/trade.php',
    '/trading' => 'views/trading.php',
    '/deposit' => 'views/deposit.php',
    '/about' => 'views/about.php',
    '/login' => 'views/login.php',
    '/signup' => 'views/signup.php',
    '/logout' => 'logic/logout.php',
    '/allusers' => 'Admin/allusers.php',
    '/details' => 'Admin/userDetail.php',
    '/depos' => 'Admin/depos.php',
    '/del' => 'Admin/deleteuser.php',
    '/edit' => 'Admin/edit.php',
];
if (array_key_exists($page, $routes)) {
    require($routes[$page]);
} else {
    http_response_code(404);
    require("./views/default.php");
    die();
}
