<?php

include 'function.inc.php';

$mysqli = Connect::conect($_host, $_user, $_password, $_database);
$parametrs = array();
if (isLoggedAdmin()) {
    if (!isset($_GET["page"])) {
        $_GET["page"] = "static_text";
        $_GET["action"] = "main";
    }
    $pages = new Pages($mysqli);
    if (!isset($_SESSION["lang"])) {
        $_SESSION["lang"] = 1;
    }
    $lang = new Language($_SESSION["lang"]);
    $parametrs["language"] = $lang->getLanguage();

    switch ($_GET["page"]) {
        case "labels":
            if (!empty($_POST)) {
                $lang->saveLang();
            }
            $parametrs["translate"] = $lang->getLangs();
            $parametrs["page"] = "labels.php";
            break;
        case "expert":
            if (isset($_GET["action"])) {
                $parametrs["country"] = $pages->getCoountry();
                switch ($_GET["action"]) {
                    case "add":
                        if (isset($_POST["name"])) {
                            $parametrs["error"] = $pages->addExpert();
                            if (!$parametrs["error"]) {
                                header("Location: /ukc_admin_iku/expert/");
                            }
                        }
                        $parametrs["page"] = "add_expert.php";
                        break;
                    case "edit":
                        if (isset($_POST["name"])) {
                            $parametrs["error"] = $pages->editExpert($_GET["id"]);
                            if (!$parametrs["error"]) {
                                header("Location: /ukc_admin_iku/expert/");
                            }
                        }
                        $parametrs["expert"] = $pages->getExpert($_GET["id"]);
                        $parametrs["expert"] = $parametrs["expert"][0];
                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_expert.php";
                        break;
                    case "del":
                        $pages->delExpert($_GET["id"]);
                        break;
                    default :
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["expert"] = $pages->getExpert();
                $parametrs["page"] = "expert.php";
            }
            break;
        case "comission":
            if (isset($_GET["action"])) {
                $parametrs["country"] = $pages->getCoountry();
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addComission();
                            Header("location: /ukc_admin_iku/comission/");
                        }
                        $parametrs["label"] = "Добавить";
                        $parametrs["page"] = "add_comission.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editComission($_GET["id"]);
                            Header("location: /ukc_admin_iku/comission/");
                        }
                        $parametrs["comission"] = $pages->getComission($_GET["id"]);
                        $parametrs["comission"] = $parametrs["comission"][0];
                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_comission.php";
                        break;
                    case "del" :
                        $pages->delRecord("iku_comission", $_GET["id"]);
                        break;
                }
            }
            $parametrs["commision"] = $pages->getComission();
            if (!isset($parametrs["page"])) {
                $parametrs["page"] = "comission.php";
            }
            break;
        case "provisions":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addProvision();
                            Header("Location: /ukc_admin_iku/provisions/");
                        }
                        $parametrs["page"] = "add_provisions.php";
                        $parametrs["label"] = "Добавить";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editProvision($_GET["id"]);
                            Header("Location: /ukc_admin_iku/provisions/");
                        }
                        $parametrs["provision"] = $pages->getProvision($_GET["id"]);
                        $parametrs["page"] = "add_provisions.php";
                        $parametrs["label"] = "Сохранить";
                        break;
                    case "del":
                        $pages->delProvision($_GET["id"], "iku_provisions", Pages::DOCUMENT_PROVISION);
                        break;
                    default :
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["provision"] = $pages->getProvision();
                $parametrs["lang"] = $lang->getFlagLanguage();
                $parametrs["page"] = "provisions.php";
            }
            break;
        case "menedgment":
            if (isset($_GET["action"])) {
                $parametrs["country"] = $pages->getCoountry();
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addMenedgment($_POST["post"], $_POST["name"], $_POST["country"], $_POST["adrres"], $_POST["mail"], $_POST["phone"]);
                            header("Location: /ukc_admin_iku/menedgment/");
                        }
                        $parametrs["label"] = "Добавить";
                        $parametrs["page"] = "add_menedgment.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editMenedgment($_GET["id"]);
                            header("Location: /ukc_admin_iku/menedgment/");
                        }
                        $parametrs["menedgment"] = $pages->getMenedgment($_GET["id"]);
                        $parametrs["menedgment"] = $parametrs["menedgment"][0];
                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_menedgment.php";
                        break;
                    case "del":
                        $pages->delRecord("iku_management", $_GET["id"]);
                        break;
                    default :
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["manadgment"] = $pages->getMenedgment();
                $parametrs["page"] = "menedgment.php";
            }
            break;
        case "breeds":
            $rus_literal = array(
                "А", "Б", "В", "Г", "Д", "Е", "Ё",
                "Ж", "З", "И", "Й", "К", "Л", "М",
                "Н", "О", "П", "Р", "С", "Т", "У",
                "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ",
                "Ы", "Ь", "Э", "Ю", "Я");
            if (isset($_GET["action"])) {
                $parametrs["lang"] = $lang->getLanguage();
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addBreed();
                        }
                        $parametrs["page"] = "add_breeds.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editBreed($_GET["id"]);
                        }
                        $parametrs["breed"] = $pages->getBreed($_GET["id"]);
                        $parametrs["breed"] = $parametrs["breed"][0];
                        $parametrs["page"] = "add_breeds.php";
                        break;
                    case "del":
                        $pages->delDocument($_GET["id"], "iku_breed_dogs", Pages::DOCUMENT_BREED);
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["lang"] = $lang->getFlagLanguage();
                if(!isset($_GET["group"])) {
                    $_GET["group"] = null;
                }
                if(!isset($_GET["symbol"])) {
                    $_GET["symbol"] = null;
                }
                $parametrs["breeds"] = $pages->getBreed(null, $_GET["group"], $_GET["symbol"]);
                $parametrs["page"] = "breeds.php";
            }
            break;
        case "language":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "del":
                        $lang->delLanguage($_GET["id"]);
                        Header("Location: /ukc_admin_iku/language/");
                        break;
                }
            }
            if (!empty($_POST)) {
                if ($_POST['lang_id'] == 0) {
                    $parametrs["error"] = $lang->addLanguage();
                } else {
                    $parametrs["error"] = $lang->editLanguage($_POST['lang_id']);
                }
                if (!$parametrs["error"]) {
                    Header("Location: /ukc_admin_iku/language/");
                }
            }
            $parametrs["language"] = $lang->getLanguage();
            $parametrs["page"] = "language.php";
            break;
        case "circulars":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addCirculars();
                            header("Location: /ukc_admin_iku/circulars/");
                        }
                        $parametrs["label"] = "Добавить";
                        $parametrs["page"] = "add_circulars.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editCirculars($_GET["id"]);
                            header("Location: /ukc_admin_iku/circulars/");
                        }
                        $parametrs["circular"] = $pages->getCirculars($_GET["id"]);
                        $parametrs["circular"] = $parametrs["circular"][0];
                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_circulars.php";
                        break;
                    case "del":
                        $pages->delRecord("iku_circulars", $_GET["id"]);
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["circulars"] = $pages->getCirculars();
                $parametrs["page"] = "circulars.php";
            }
            break;
        case "registration":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "add":
                        $pages->addRegistration($_FILES);
                        break;
                    case "del":
                        $pages->delRegistration($_GET["id"]);
                        break;
                }
            }
            $parametrs["registration"] = $pages->getRegistration();
            $parametrs["page"] = "registration.php";
            break;
        case "members":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addMembers();
                            Header("Location: /ukc_admin_iku/members/");
                        }
                        $parametrs["label"] = "Добавить";
                        $parametrs["page"] = "add_member.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editMember($_GET["id"]);
                            Header("Location: /ukc_admin_iku/members/");
                        }
                        $parametrs["member"] = $pages->getMember($_GET["id"]);
                        $parametrs["member"] = $parametrs["member"][0];

                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_member.php";
                        break;
                    case "del":
                        $pages->delRecord("iku_members", $_GET["id"]);
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["members"] = $pages->getMember();
                $parametrs["page"] = "member.php";
            }
            break;
        case "memberdocument":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "del":
                        $pages->delMemDocument($_GET["id2"]);
                        break;
                }
            }
            $parametrs["document"] = $pages->getMemeberDocument($_GET["id"]);
            $parametrs["page"] = "memberdocument.php";
            break;
        case "exibition":
            if (isset($_GET["action"])) {
                $parametrs["country"] = $pages->getCoountry();
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addExebition();
                            header("Location: /ukc_admin_iku/exibition/");
                        }
                        $parametrs["label"] = "Добавить";
                        $parametrs["page"] = "add_exibition.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editExebition($_GET["id"]);
                            header("Location: /ukc_admin_iku/exibition/");
                        }
                        $parametrs["exebition"] = $pages->getExebition($_GET["id"]);
                        $parametrs["exebition"] = $parametrs["exebition"][0];
                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_exibition.php";
                        break;
                    case "del":
                        $pages->delRecord("iku_exhibition", $_GET["id"]);
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["exebition"] = $pages->getExebition();
                $parametrs["page"] = "exibition.php";
            }
            break;
        case "lastexibition":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editLastExebition($_GET["id"]);
                            header("Location: /ukc_admin_iku/lastexibition/");
                        }
                        $parametrs["exebition"] = $pages->getLastExebition($_GET["id"]);
                        $parametrs["exebition"] = $parametrs["exebition"][0];
                        $parametrs["page"] = "add_lastexibition.php";
                        break;
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addLastExebition();
                            header("Location: /ukc_admin_iku/lastexibition/");
                        }
                        $parametrs["page"] = "add_lastexibition.php";
                        break;
                    case "del":
                        $pages->delRecord("iku_exhibition_last", $_GET["id"]);
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["exebition"] = $pages->getLastExebition();
                $parametrs["page"] = "lastexibition.php";
            }
            break;
        case "galery":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "del":
                        $pages->delGalery($_GET["id2"]);
                        break;
                }
            }
            if (!empty($_POST)) {
                $pages->addGaleryItem($_GET["id"], $_FILES);
            }
            $parametrs["galery"] = $pages->getGalerry($_GET["id"]);
            $parametrs["page"] = "galery.php";
            break;
        case "static_text":
            $staticPage = new StaticPage();
            if (!isset($_GET["action"])) {
                $_GET["action"] = "main";
            }
            if (isset($_POST["content"])) {
                $staticPage->setStaticText($_GET["action"], $_POST["content"]);
            }
            $content = $staticPage->getStaticPage($_GET["action"]);
            $parametrs["page"] = "static_text.php";
            break;
        case "news":
            if (isset($_GET["action"])) {
                switch ($_GET["action"]) {
                    case "add":
                        if (!empty($_POST)) {
                            $pages->addNews();
                            header("Location: /ukc_admin_iku/news/");
                        }
                        $parametrs["label"] = "Добавить";
                        $parametrs["page"] = "add_news.php";
                        break;
                    case "edit":
                        if (!empty($_POST)) {
                            $pages->editNews($_GET["id"]);
                            header("Location: /ukc_admin_iku/news/");
                        }
                        $parametrs["news"] = $pages->getNews($_GET["id"]);
                        $parametrs["news"] = $parametrs["news"][0];
                        $parametrs["label"] = "Сохранить";
                        $parametrs["page"] = "add_news.php";
                        break;
                    case "del":
                        $pages->delRecord("iku_news", $_GET["id"]);
                        break;
                }
            }
            if (!isset($parametrs["page"])) {
                $parametrs["news"] = $pages->getNews();
                $parametrs["page"] = "news.php";
            }
            break;
        case "logout":
            Admin::logoutAdmin();
            header("Location: /ukc_admin_iku/");
            break;
        case "admins":
            $parametrs["page"] = "admins.php";
            break;
        case "add_admin":
            $parametrs["page"] = "add_admin.php";
            break;
        case "main":
        default :
            $parametrs["page"] = "main.php";
            break;
    }
} else {
    if (isset($_POST["login"])) {
        $parametrs["error"] = Admin::verifyingAdmin($_POST["login"], $_POST["password"], $mysqli);
        if (!$parametrs["error"]) {
            header("Location: /ukc_admin_iku/");
        }
    }
    $parametrs["page"] = "admin_login.php";
}
include '../pages/backend/index.php';
?>
