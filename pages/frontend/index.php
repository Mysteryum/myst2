<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8;charset=utf-8" />
		<meta property="og:image" content="http://worldkennel.org/images/logo.png" />		
        <title><?= $lang->l("World Kennel Union") ?></title>
        <meta name="description" content="Международный кинологический союз   World  kennel  union -  международная кинологическая организация объединяющая ведущие кинологические организации мира.  На сайте размещена информация о развитии кинологии во многих странах мира. Расписание выставок собак, спортивных соревнований и чемпионатов с собаками, перечислены  породы собак признанные в организации. На сайте находятся признанные положения, инструкции, циркуляры.  Список экспертов организации. Постоянно обновляются мировые кинологические новости." />
        <meta name="Keywords" content="World kennel  union, International  kennel  union,  собака, выставки собак, щенки, расписание выставок, породы собак, Международный кинологический союз, кинологический альянс, кинологический союз, кинологическое содружество, дрессура, стандарты, кинологический клуб Украины, кинологический клуб России, Европейские кинологические клубы, питомники, кинологические новости, племенные положения, правила проведения выставок, эксперты, судьи, разведение собак, International kennel union, dog, Dog, Puppy, schedule of exhibitions, dog breeds, the International Union of Dog Training, Dog Alliance, Kennel Union, Dog community, taming, standards, kennel club of Ukraine, Russia kennel club, canine European clubs, kennels, canine news , Tribal, regulations exhibitions, experts, judges, dog breeding" />
        <meta name='yandex-verification' content='4e9a319269d2aa51' />		
		
        <link rel="shortcut icon" href="/images/wku_logo.png" type="image/x-icon" />
        <link href="/style/jquery.lightbox-0.5.css" rel="stylesheet" type="text/css">      
        <link href="/style/style.css" rel="stylesheet" type="text/css">      

        <script type="text/javascript" src="/script/jquery-1.7.1.js"></script>
        <script type="text/javascript" src="/script/jcarousellite_1.0.1.js"></script>
        <script type="text/javascript" src="/script/jquery.lightbox-0.5.js"></script>
        <script type="text/javascript" src="/script/script.js"></script>
        <meta name="google-translate-customization" content="ce8d09febb66993e-4133a8c58cd4ae15-g1b7f8eb51c661ac1-13"></meta>
    </head>
    <body>        
        <div class="warp">
            <div class="header">
                <ul class="lang_head">
                    <li>
                        <?php
                        foreach ($parametrs["lang"] as $value) {
                            if ($value["status"]) {
                                ?>
                                <a href="/<?= $value["code"] ?>/">
                                    <img src="/userfiles/lang_flag/<?= $value["flag"] ?>" alt="<?= $value["name"] ?>" title="<?= $value["name"] ?>">
                                </a>
                                <?php
                            }
                        }
                        ?>
                    </li>
                    <!--div id="google_translate_element"></div>
                    <script type="text/javascript">
                        function googleTranslateElementInit() {
                            new google.translate.TranslateElement({pageLanguage: 'ru', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                            DeleteGoogleIframe();
                        }
                    </script>
                    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script-->
                </ul>
                <div class="wku_logotip">
                    <img src="/images/logo.png" class="new_logo" alt="logo">                 
                </div>
                <div class="iku_logotip"></div>
                <!--internacional kennel union-->
            </div>
            <div class="top-menu">
                <ul>
                    <li class="main-menu" style="width: 135px;">
                        <a href="/main.html"><?= $lang->l("Главная") ?></a>    
                        <div class="sub-menu-wrap">
                            <div class="sb-menu-top"></div>
                            <div class="sb-menu-center">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="/management.html"><?= $lang->l("Руководство") ?></a>
                                    </li>
                                    <li>
                                        <a href="/commission.html"><?= $lang->l("Комисии") ?></a>
                                    </li>
                                    <li>
                                        <a href="/experts.html"><?= $lang->l("Эксперты") ?></a>
                                    </li>
                                    <li>
                                        <a href="/registration.html"><?= $lang->l("Регистрация") ?></a>
                                    </li>
                                    <li>
                                        <a href="/charter.html"><?= $lang->l("Устав") ?></a>
                                    </li>
                                    <li>
                                        <a href="/regulations.html"><?= $lang->l("Положения") ?></a>
                                    </li>
                                    <li>
                                        <a href="/circulars.html"><?= $lang->l("Циркуляры") ?></a>
                                    </li>
                                    <li>
                                        <a href="/patent.html"><?= $lang->l("Патент лого") ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sb-menu-bottom"></div>
                        </div> 
                    </li>
                    <li style="width: 115px;">
                        <a href="/news.html"><?= $lang->l("Новости") ?></a>
                    </li>
                    <li class="main-menu" style="width: 174px;">
                        <a href="/party.html"><?= $lang->l("Члены и Партнеры") ?></a>
                        <div class="sub-menu-wrap">
                            <div class="sb-menu-top"></div>
                            <div class="sb-menu-center">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="/members.html"><?= $lang->l("Члены") ?></a>
                                    </li>
                                    <li>
                                        <a href="/partners.html"><?= $lang->l("Партнеры") ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sb-menu-bottom"></div>
                        </div> 
                    </li>
                    <li class="main-menu" style="width: 125px;">
                        <a href="/schedule.html"><?= $lang->l("Выставки") ?></a>
                        <div class="sub-menu-wrap">
                            <div class="sb-menu-top"></div>
                            <div class="sb-menu-center">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="/schedule.html"><?= $lang->l("Расписание") ?></a>
                                    </li>
                                    <li>
                                        <a href="/last.html"><?= $lang->l("Прошедшие") ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sb-menu-bottom"></div>
                        </div>   
                    </li>
                    <li class="main-menu" style="width: 203px;">
                        <a href="/breed.html"><?= $lang->l("Породы собак") ?></a>                        
                        <div class="sub-menu-wrap">
                            <div class="sb-menu-top"></div>
                            <div class="sb-menu-center">
                                <ul class="sub-menu">
                                    <li>
                                        <a href="/classification.html"><?= $lang->l("Классификация") ?></a>
                                    </li>
                                    <li>
                                        <a href="/group.html"><?= $lang->l("Группы") ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="sb-menu-bottom"></div>
                        </div>   
                    </li>
                    <li style="width: 118px;">
                        <a href="http://puppies.co.ua/"><?= $lang->l("Форум") ?></a>
                    </li>
                    <li style="text-align: center; width: 154px;">
                        <a href="/contacts.html"><?= $lang->l("Контакты") ?></a>
                    </li>
                </ul>
            </div>
            <div class="content-wrap">
                <?php
                if ($_GET["page"] == "main") {
                    ?>
                    <div class="mini-news">
                        <div class="news-top"></div>
                        <div class="news-center">
                            <?php
                            $i = 0;
                            foreach ($parametrs["news"] as $value) {
                                if ($i == 5) {
                                    break;
                                }
                                if (!isset($value["desc"][$_SESSION["lang"]][0]["name"])) {
                                    $news_desc = $value["desc"][1][0];
                                } else {
                                    $news_desc = $value["desc"][$_SESSION["lang"]][0];
                                }
                                ?>
                                <a href="/news/<?= $value["id"] ?> " class="news-href">
                                    <div class="news">
                                        <div class="list_news"></div>
                                        <div class="text">
                                            <?= $news_desc["name"] ?>
                                        </div>
                                        <div class="date" style="width: 255px; padding: 0px 0px 5px 0px">
                                            <?php
                                            $date = explode(" ", $value["date"]);
                                            echo $date[0];
                                            ?>
                                        </div>
                                    </div>
                                </a>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                        <div class="news-bottom"></div>
                    </div>
                    <div class="main-content">
                        <div class="main-content-title">
                            <?= $parametrs["label"] ?>
                        </div>
                        <div class="main-content-text">
                            <?php include $parametrs["page"]; ?>
                        </div>
                    </div>
                    <?php
                } else {
                    ?>
                    <div class="content">
                        <div class="content-title">
                            <?= $parametrs["label"] ?>
                        </div>
                        <div class="content-text">
                            <?php include $parametrs["page"]; ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </body>
</html>