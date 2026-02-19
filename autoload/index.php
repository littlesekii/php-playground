<?php

include_once "autoload.php";

$account = new Account(1, "Davi");
echo '<hr>';
echo $account->getId() . ' - ' . $account->getName();