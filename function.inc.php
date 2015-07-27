<?php
include 'config_iku.php';
spl_autoload_register('_autoload');

function _autoload($className) {
    $fileName = "class/" . $className . '.php';
    include $fileName;
}

function isLoggedUser() {
    @session_start();
    if (isset($_SESSION['userid'])) {
        return true;
    } else {
        return false;
    }
}

function debug($content) {
    echo "<pre>";
    print_r($content);
    echo "</pre>";
}
