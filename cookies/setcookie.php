<?php

function redirect(string $msg = ''): void {
    
    if (!empty($msg)) {
        header('Location: ./index.php?msg='.$msg);
        exit;
    }

    header('Location: ./index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        if (empty($_POST['name'])) {
            redirect("Invalid cookie name");
        }

        if (empty($_POST['value'])) {
            redirect("Invalid cookie value");
        }

        $cookieName = htmlspecialchars($_POST['name']);
        $cookieValue = htmlspecialchars($_POST['value']);  

        setcookie($cookieName, $cookieValue);
    } catch (Error $e) {
        redirect("Invalid cookie data");
    }
} 

redirect();



?>