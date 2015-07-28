<?php
include '../config_iku.php';
spl_autoload_register('_autoload');

function _autoload($className) {
    $fileName = "../class/" . $className . '.php';
    include $fileName;
}

function isLoggedAdmin() {
    @session_start();
    if (isset($_SESSION['admin_id'])) {
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

function addadmin ($name,$pass,$langname){
    global $mysqli;
    $pass = md5($pass);
    $name = mysqli_real_escape_string($mysqli,$name);
    $pass = mysqli_real_escape_string($mysqli,$pass);
    $langname = mysqli_real_escape_string($mysqli,$langname);
    mysqli_query($mysqli, "INSERT INTO `iku_admin`(`adm_log`,`adm_pass`,`adm_lang`) VALUES ('$name','$pass','$langname')");
    
    return false;
}