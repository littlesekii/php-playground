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

        form > p {
            padding: 0;
            margin: 0;
            width: 100%;
            font-size: 11pt;
            text-align: center;
            color: #EC0000;
        }
    </style>
</head>

<form action="./setcookie.php" method="post" >
    <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
    </div>
    <div>
        <label for="value">Value</label>
        <input type="text" id="value" name="value">
    </div>
    <div>
        <button type="submit">Set Cookie</button>
    </div>
    <p> <?= htmlspecialchars($_GET['msg'] ?? ''); ?> </p>
</form>

<p><strong>Active cookies:</strong></p>
<ul>
    <?php foreach ($_COOKIE as $key => $val): ?>
        <li><?= $key . ' - ' . $val . ' | ' ?> <a href=<?= './removecookie.php?name='.$key ?>>Remove</a></li>
    <? endforeach; ?>
</ul>