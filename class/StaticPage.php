<?php

class StaticPage {

    const PAGE_MAIN = 1;
    const PAGE_USTAV = 2;
    const PAGE_KLASIFICATION = 3;
    const PAGE_GROUP = 4;
    const PAGE_CIRCULAR = 5;
    const PAGE_PATENT = 6;

    public function getStaticPage($content) {
        switch ($content) {
            case "main":
                $pg = self::PAGE_MAIN;
                $label = "Главная страница";
                break;
            case "ustav":
                $pg = self::PAGE_USTAV;
                $label = "Устав";
                break;
            case "klasification":
                $pg = self::PAGE_KLASIFICATION;
                $label = "Классификация";
                break;
            case "group":
                $pg = self::PAGE_GROUP;
                $label = "Группы";
                break;
            case "circular":
                $pg = self::PAGE_CIRCULAR;
                $label = "Циркуляры";
                break;
            case "patent":
                $pg = self::PAGE_PATENT;
                $label = "Патент лого";
                break;
            case "contacts":
                $pg = 0;
                $label = "Контакты";
                break;
        }
        $pg = (int) $pg;
        $result = mysql_query("SELECT `content` FROM `iku_static_text` WHERE `page`='$pg'");
        $res = mysql_fetch_assoc($result);
        return array($label, $res["content"]);
    }

    public function setStaticText($page, $content) {
        foreach ($content as $key => $value) {
            $fp = fopen('../language/' . $key . '/' . $page . '.txt', 'w');
            $test = fwrite($fp, $value); // Запись в файл
            fclose($fp); //Закрытие файла
        }
    }
    
    public static function getStaticText($page, $lang){
        $path = 'language/' . $lang . '/' . $page . '.txt';
        if(!is_file($path)){
            $path = '../'.$path;
        }
        include $path;
    }

}
