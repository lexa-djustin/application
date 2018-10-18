<?php
require_once 'Autoloader.php';

try {
    $loginObject = new \Components\Auth();

    $loginObject->logout();
} catch (Exception $exception) {
    echo 'Logout failed';
}