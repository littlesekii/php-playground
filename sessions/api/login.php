<?php
require_once __DIR__ . '/../config/session.php';
require_once __DIR__ . '/../../util/utils.php';

define('RATE_LIMIT_MAX_ATTEMPTS', 5);
define('RATE_LIMIT_SECONDS', 10);

define('LOGIN_MESSAGE_RATE_LIMIT', 'Too many requests');
define('LOGIN_MESSAGE_EMPTY_USERNAME', 'Please fill out username');
define('LOGIN_MESSAGE_EMPTY_PASSWORD', 'Please fill out password');
define('LOGIN_MESSAGE_INVALID_CREDENTIALS', 'Invalid credentials');

if (!isset($_SESSION['logged'])) {
    session_regenerate_id(true);
}

// echo 'Cookie PHPSESSID: ' . session_id() . '<br><br>';


$_SESSION['login']['rateLimit'] ??= [
    'attempts' => 0,
    'limitedAt' => null
];

$rateLimit = &$_SESSION['login']['rateLimit'];

if (!empty($rateLimit['limitedAt'])) {

    if (time() < $rateLimit['limitedAt'] + RATE_LIMIT_SECONDS) {
        $_SESSION['login']['msg'] = LOGIN_MESSAGE_RATE_LIMIT;
        redirect('../index.php');
    }

    $rateLimit['attempts'] = 0;
    $rateLimit['limitedAt'] = null;
}

function checkLoginAttempt(array &$rateLimit): void {
    if ($rateLimit['attempts'] >= RATE_LIMIT_MAX_ATTEMPTS) {
        $rateLimit['limitedAt'] = time();
        $_SESSION['login']['msg'] = LOGIN_MESSAGE_RATE_LIMIT;
        redirect('../index.php');
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {  

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username)) {

        $rateLimit['attempts']++;
        checkLoginAttempt($rateLimit);
        $_SESSION['login']['msg'] = LOGIN_MESSAGE_EMPTY_USERNAME;
        redirect('../index.php');

    }

    if (empty($password)) {

        $rateLimit['attempts']++;
        checkLoginAttempt($rateLimit);
        $_SESSION['login']['msg'] = LOGIN_MESSAGE_EMPTY_PASSWORD;
        redirect('../index.php');

    }

    if (!($username == 'admin' && $password == 'admin')) {

        $rateLimit['attempts']++;
        checkLoginAttempt($rateLimit);
        $_SESSION['login']['msg'] = LOGIN_MESSAGE_INVALID_CREDENTIALS;
        redirect('../index.php');
        
    }

    $_SESSION['logged'] = true;
    $_SESSION['user'] = $username;

    session_regenerate_id(true);
    redirect('../dashboard.php');
}


?>