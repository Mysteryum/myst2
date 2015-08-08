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
        if (isset($_SESSION['admin_id'])&&isset($_SESSION['admin_lang'])) {
                        $_SESSION['lang']= $_SESSION['admin_lang'];
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
            $_SESSION['admin_lang'] = $res["adm_lang"];
            return false;
        } else {
            return "Не верный лоин или пароль";
        }
    }
    static public function logoutAdmin(){
        $_SESSION['admin_id'] = "";
        session_destroy();
    }
    public function AddAdmin ($name,$pass,$langid,$mysqli){
        if (empty ($name)|| empty ($pass) || $langid == 0){
         $error = 'Заполните все поля!';
        return $error;}
        $pass = md5($pass);
        $name = mysqli_real_escape_string($mysqli,$name);
        $pass = mysqli_real_escape_string($mysqli,$pass);
        $langid = mysqli_real_escape_string($mysqli,$langid);
        $langid = (int)$langid;
        $query = $mysqli->query("INSERT INTO iku_admin(adm_log,adm_pass,adm_lang) VALUES ('$name','$pass','$langid')");   
        return false;
    }
    public function AdminList ($id = null) {
        global $mysqli;
        if ($id != null) {
            $id = (int) $id;
            $wh = "WHERE `adm_id`='$id'";
        } else {
            $wh = "";
        }
        $result = $mysqli->query("SELECT * FROM `iku_admin` $wh");

        $mas = array();
        while ($res = mysqli_fetch_assoc($result)) {
            $mas[] = $res;
        }
        return $mas;
    }
    public function delAdmin($id) {
        global $mysqli;
        $_aid = $this->AdminList($id);
        $id = (int) $id;
        $mysqli->query("DELETE FROM iku_admin WHERE `adm_id`='$id'");
        return false;
    }
}