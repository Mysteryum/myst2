<?php

@session_start();
include 'function.inc.php';
$mysqli = Connect::conect($_host, $_user, $_password, $_database);
$parametrs = array();
if (!isset($_GET["page"])) {
    $_GET["page"] = "main";
}
if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = 1;
}
$lang = new Language($_SESSION["lang"]);
$parametrs["lang"] = $lang->getLanguage();

if (isset($_GET["lang"])) {
    $lans = $lang->getLanguage(null, $_GET["lang"]);
    if (isset($lans["id"])) {
        $_SESSION["lang"] = $lans["id"];
        $lang = new Language($_SESSION["lang"]);
    }
}

$pages = new Pages();
$staticText = new StaticPage();
$parametrs["news"] = $pages->getNews();
switch ($_GET["page"]) {
    case "patent":
        $parametrs["label"] = $lang->l("Патент лого");
        $parametrs["page"] = "patent.php";
        break;
    case "experts":
        $parametrs["country"] = $pages->getExpertCoountry();
        $parametrs["label"] = $lang->l("Эксперты");
        $parametrs["page"] = "experts.php";
        break;
    case "news":
        $parametrs["news"] = $pages->getNews();
        $parametrs["label"] = $lang->l("Новости");
        $parametrs["page"] = "news.php";
        break;
    case "contacts":
        $parametrs["label"] = $lang->l("Контакты");
        $parametrs["page"] = "contacts.php";
        break;
    case "partners":
        $parametrs["label"] = $lang->l("Партнеры");
    case "party":
    case "members":
        if (!isset($parametrs["label"])) {
            $parametrs["label"] = $lang->l("Организации");
        }
        $parametrs["members"] = $pages->getMember(null, 0);
        $parametrs["partner"] = $pages->getMember(null, 1);
        $parametrs["page"] = "members.php";
        break;
    case "circulars":
        $parametrs["label"] = $lang->l("Циркуляры");
        $parametrs["circulars"] = $pages->getCirculars();
        $parametrs["page"] = "circulars.php";
        break;
    case "regulations":
        $parametrs["label"] = $lang->l("Устав");
        $parametrs["provision"] = $pages->getProvision();
        $parametrs["page"] = "regulations.php";
        break;
    case "charter":
        $parametrs["label"] = $lang->l("Устав");
        $parametrs["page"] = "charter.php";
        break;
    case "registration":
        $parametrs["label"] = $lang->l("Регистрация");
        $parametrs["registration"] = $pages->getRegistration();
        $parametrs["page"] = "registration.php";
        break;
    case "commission":
        $parametrs["label"] = $lang->l("Комиссии");
        $parametrs["commision"] = $pages->getComission();
        $parametrs["page"] = "commission.php";
        break;
    case "management":
        $parametrs["label"] = $lang->l("Руководство");
        $parametrs["manadgment"] = $pages->getMenedgment();
        $parametrs["page"] = "management.php";
        break;
    case "schedule":
        $parametrs["label"] = $lang->l("Рассписание выставок");
        $parametrs["exebition"] = $pages->getExebition();
        $parametrs["page"] = "schedule.php";
        break;
    case "last":
        $parametrs["label"] = $lang->l("Прошедшие выставки");
        $parametrs["exebition"] = $pages->getLastExebition();
        $parametrs["page"] = "last.php";
        break;
    case "classification":
        $parametrs["label"] = $lang->l("Классификация");
        $parametrs["page"] = "classification.php";
        break;
    case "group":
        $parametrs["label"] = $lang->l("Группы");
        $parametrs["page"] = "group.php";
        if (isset($_GET["group"])) {
            $group = $_GET["group"];
            $parametrs["breeds"] = $pages->getBreed(null, $_GET["group"]);
        } else {
            $group = 0;
        }
        break;
    case "breed":
        $rus_literal = array(
            "А", "Б", "В", "Г", "Д", "Е", "Ё",
            "Ж", "З", "И", "Й", "К", "Л", "М",
            "Н", "О", "П", "Р", "С", "Т", "У",
            "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ",
            "Ы", "Ь", "Э", "Ю", "Я");
        $parametrs["label"] = $lang->l("Породы собак");
        $parametrs["page"] = "breed.php";
        if (isset($_GET["symbol"])) {
            $parametrs["breeds"] = $pages->getBreedForUser($_GET["symbol"]);
        }
        break;

    case "main":
    default:
        $parametrs["label"] = $lang->l("Главная страница");
        $parametrs["page"] = "main.php";
        break;
}
include 'pages/frontend/index.php';
?>