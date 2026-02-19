<?php

function autoload($className) {

    $folders = ['classes/', 'traits/'];

    foreach($folders as $folder) {
        $classPath = "$folder$className.php";

        if (file_exists($classPath))
            include_once $classPath;
    }
}

spl_autoload_register('autoload');