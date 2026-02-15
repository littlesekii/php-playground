<?php 

function redirect(string $urlPath): void {
    header('Location: ' . $urlPath);
    exit;
}
