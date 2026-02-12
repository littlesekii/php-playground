<?php

function redirect(string $msg = ''): void {
    
    if (!empty($msg)) {
        header('Location: ./index.php?msg='.$msg);
        exit;
    }

    header('Location: ./index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    try {

        if (empty($_GET['name'])) {
            redirect();
        }

        $cookieName = htmlspecialchars($_GET['name']);

        setcookie($cookieName, '', -1);
    } catch (Error $e) {}
} 

redirect();

?>