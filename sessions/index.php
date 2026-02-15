<?php
require_once __DIR__ . '/config/session.php';

$username = htmlspecialchars($_POST['username'] ?? '');
$msg = htmlspecialchars($_SESSION['login']['msg'] ?? '');

$_SESSION['login']['msg'] = '';
?>

<head>
    <style>
        form { 
            max-width: 150px; 
            width: 90%;
        }
        form > div {
            display: flex; 
            flex-direction: column; 
            margin-bottom: 5px;
        }
        form > div:last-of-type {
            margin-top: 10px;
        }

        p {
            padding: 0;
            margin: 0;
            width: 100%;
            font-size: 11pt;
            text-align: center;
            color: #EC0000;
        }
    </style>
</head>

<form action="./api/login.php" method="post">

    <div>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= $username ?>">
    </div>

    <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
    </div>

    <div>
        <button type="submit">Login</button>
    </div>

    <?php if (!empty($msg)): ?> 
        <p><?= $msg ?></p>
    <?php endif; ?>

</form>