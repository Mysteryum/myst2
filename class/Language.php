<?php

class Language {

    const LANG_RU = "ru";
    const LANG_ENG = "en";

    public $lang_id;
    public $lang;
    public $storeg;
    private $determinate = "%*%";
    private $determinate_spase = "%_%";
    private $path_lang_default = "language/";
    private $path_lang = "language/";

    public function __construct($id) {
        $this->lang_id = $id;
        $langs = $this->getLanguage($id);
        if ((!$id) || (empty($langs))) {
            $langs = $this->getLanguage();
            $_SESSION["lang"] = $langs[0]["id"];
        }

        $this->path_lang = $this->path_lang . $this->lang_id . "/";
        $this->lang = $_SESSION["lang"] . ".txt";

        if (!is_file($this->path_lang . $this->lang)) {
            $this->path_lang = "../" . $this->path_lang;
            $this->path_lang_default = "../" . $this->path_lang_default;
        }
        $this->read_lang();
    }

    public function addLanguage() {
        if (!$_FILES["flag"]["name"]) {
            return "Выберите флаг";
        }
        $name = $_POST["name"];
        $code = $_POST["code"];
        if (!$name) {
            return "Введите название";
        }
        if (!$code) {
            return "Введите код";
        }
        $apend = date('YmdHis') . rand(100, 1000);
        $uploaddir = '../userfiles/lang_flag/';
        $raz = explode(".", $_FILES["flag"]["name"]);
        $raz = strtolower($raz[count($raz) - 1]);
        $apend = "$apend.$raz";
        $uploadfile = "$uploaddir$apend";
        move_uploaded_file($_FILES["flag"]['tmp_name'], $uploadfile);

        $name = mysql_escape_string($name);
        $apend = mysql_escape_string($apend);
        $code = mysql_escape_string($code);
        mysql_query("INSERT INTO `iku_language`(`name`, `flag`, `code`) VALUES ('$name','$apend', '$code')");
        $lang_id = mysql_insert_id();
        mkdir("../language/$lang_id/", 755);
        return false;
    }

    public function editLanguage($id) {
        $id = (int) $id;
        $name = $_POST["name"];
        $code = $_POST["code"];
        if (!$name) {
            return "Введите название";
        }
        if (!$code) {
            return "Введите код";
        }
        if ($_FILES["flag"]["name"]) {
            $apend = date('YmdHis') . rand(100, 1000);
            $uploaddir = '../userfiles/lang_flag/';
            $raz = explode(".", $_FILES["flag"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES["flag"]['tmp_name'], $uploadfile);
            $flag = ", `flag`='$apend'";
        } else {
            $flag = "";
        }

        $name = mysql_escape_string($name);
        mysql_query("UPDATE `iku_language` SET `name`='$name', `code`='$code' $flag WHERE `id`='$id'");
        return false;
    }

    public function getLanguage($id = null, $code = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = "WHERE `id`='$id'";
        } elseif ($code != null) {
            $code = mysql_escape_string($code);
            $wh = "WHERE `code`='$code'";
        } else {
            $wh = "";
        }
        $result = mysql_query("SELECT * FROM `iku_language` $wh");

        $mas = array();
        $i = 0;
        while ($res = mysql_fetch_assoc($result)) {
            if ($code != null) {
                return $res;
            }
            $mas[$res["id"]] = $res;
            $i++;
        }
        return $mas;
    }

    public function getFlagLanguage($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = "WHERE `id`='$id'";
        } else {
            $wh = "";
        }
        $result = mysql_query("SELECT * FROM `iku_language` $wh");

        $mas = array();
        $i = 0;
        while ($res = mysql_fetch_assoc($result)) {
            $mas[] = $res;
            $i++;
        }
        return $mas;
    }

    public function delLanguage($id) {
        $pages = new Pages();
        $lang = $this->getLanguage($id);
        unlink("../userfiles/lang_flag/" . $lang[0]["flag"]);
        $pages->delRecord("iku_language", $id);
    }

    private function read_lang() {
        if (is_file($this->path_lang . $this->lang)) {
            $file_handle = fopen($this->path_lang . $this->lang, "r");
        } else {
            $file_handle = fopen($this->path_lang . $this->lang, "w");
        }

        $lang_mas = array();
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            $line = explode($this->determinate, $line);
            if (isset($line[1])) {
                $lang_mas[$line[0]] = $line[1];
            }
        }
        fclose($file_handle);
        $this->storeg = $lang_mas;
    }

    private function add_label($key, $label) {
        $langs = $this->getLanguage();
        foreach ($langs as $value) {
            if (is_file($this->path_lang_default . $value["id"] . "/" . $value["id"] . ".txt")) {
                $acces = "a";
            } else {
                $acces = "w";
            }
            $f = fopen($this->path_lang_default . $value["id"] . "/" . $value["id"] . ".txt", $acces);
            $line = $key . $this->determinate . $label;
            fwrite($f, $line . "\n");
            fclose($f);
        }
    }

    public function l($key) {
        if (isset($this->storeg[$key])) {
            return str_replace("\n", "", $this->storeg[$key]);
        } else {
            $this->add_label($key, $key);
            $this->storeg[$key] = $key;
            return $key;
        }
    }

    public function getLang($lang) {
        $file_handle = fopen($this->path_lang . $lang . ".txt", "r");
        $lang_mas = array();
        while (!feof($file_handle)) {
            $line = fgets($file_handle);
            $line = explode($this->determinate, $line);
            if (isset($line[1])) {
                $lang_mas[$line[0]] = $line[1];
            }
        }
        fclose($file_handle);
        return $lang_mas;
    }

    public function getLangs() {
        $langs = $this->getLanguage();
        $mas = array();
        foreach ($langs as $key => $value) {
            $file_handle = fopen($this->path_lang_default . $key . '/' . $key . '.txt', "r");
            $lang_mas = array();
            while (!feof($file_handle)) {
                $line = fgets($file_handle);
                $line = explode($this->determinate, $line);
                if (isset($line[1])) {
                    $lang_mas[$line[0]] = $line[1];
                }
            }
            fclose($file_handle);
            $mas[$key] = $lang_mas;
        }
        return $mas;
    }

    public function saveLang() {
        $langs = $_POST["lang"];
        unset($_POST["lang"]);
        foreach ($langs as $lang_id => $lang) {
            
            $file_handle = fopen($this->path_lang_default . $lang_id . '/' . $lang_id . ".txt", "w");
            foreach ($_POST as $key => $value) {
                $key = $this->formatKeyReturn($key);
                $line = $key . $this->determinate . $value[$lang_id];
                fwrite($file_handle, $line . "\n");
            }
            fclose($file_handle);
        }
    }

    public function formatKey($key) {
        while (strpos($key, ' ') !== false) {
            $key = str_replace(' ', $this->determinate_spase, $key);
        };
        return $key;
    }

    public function formatKeyReturn($key) {
        while (strpos($key, $this->determinate_spase) !== false) {
            $key = str_replace($this->determinate_spase, ' ', $key);
        };
        return $key;
    }

}

?>
