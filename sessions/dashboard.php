<?php
require_once __DIR__ . '/config/session.php';
require_once __DIR__ . '/../util/utils.php';

if (empty($_SESSION['logged'])) {
    redirect("./login.php");
}

// if (!isset($_SESSION['last_regenerate'])) {
//     $_SESSION['last_regenerate'] = time();

$_SESSION['last_regenerate'] ??= time();

if (time() - $_SESSION['last_regenerate'] > 300) {

    session_regenerate_id(true);
    $_SESSION['last_regenerate'] = time();

    // echo "ID Refreshed!<br>";
}
    
$user = htmlspecialchars($_SESSION['user']);

// echo 'Cookie PHPSESSID: ' . session_id() . '<br><br>';
?>

<h3>Welcome, <?= $user ?></h3>

<a href="/api/logout.php">Logout</a>
