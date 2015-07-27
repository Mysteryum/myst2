<?php

class Admin {

    private $_aid;
    private $_mysqli;

    public function __construct($id, $mysqli) {
        $this->_aid = $id;
        $this->_mysqli = $mysqli;
    }

    static public function isLogerAdmin() {
        @session_start();
        if (isset($_SESSION['admin_id'])) {
            return true;
        } else {
            return false;
        }
    }
    //Авторизация администратора
    static public function verifyingAdmin($login, $pass, $mysqli) {
        $error = '';
        $login = mysqli_real_escape_string($mysqli, $login);
        $pass = md5($pass);
            $query = $mysqli->query("SELECT * FROM iku_admin WHERE adm_log='$login' AND adm_pass='$pass'");
        if (mysqli_num_rows($query) != 0) {
            @session_start();
            $res = mysqli_fetch_assoc($query);
            $_SESSION['admin_id'] = $res["adm_id"];
            return false;
        } else {
            return "Не верный лоин или пароль";
        }
    }
    static public function logoutAdmin(){
        $_SESSION['admin_id'] = "";
        session_destroy();
    }

}