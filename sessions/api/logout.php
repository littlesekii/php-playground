<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../../util/utils.php';

$_SESSION = [];

setcookie(
    session_name(), '', 
    [
        'expires' => time() - 3600,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]
);

session_destroy();

redirect("../index.php");
?>
