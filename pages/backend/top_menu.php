<?php
if (isLoggedAdmin()) {
    ?>
    <div class="header" style="height: auto;">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    WKU
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex5-collapse">
                <ul class="nav navbar-nav" id="navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle <?= ($_GET["page"] == "main") ? 'active' : '' ?>" data-toggle="dropdown">
                            <?= $lang->l("Главная")?><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/ukc_admin_iku/static_text/main"><?= $lang->l("Главная")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/menedgment/"><?= $lang->l("Руководство")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/comission/"><?= $lang->l("Комиссии")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/expert/"><?= $lang->l("Эксперты")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/registration/"><?= $lang->l("Регистрация")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/static_text/ustav"><?= $lang->l("Устав")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/provisions/"><?= $lang->l("Положения")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/circulars"><?= $lang->l("Циркуляры")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/static_text/patent"><?= $lang->l("Патент лого")?></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/news/"><?= $lang->l("Новости")?></a>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/members/"><?= $lang->l("Члены ИКУ")?></a>    
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/exibition/" class="dropdown-toggle" data-toggle="dropdown">
                            <?= $lang->l("Выставки")?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/ukc_admin_iku/exibition/"><?= $lang->l("Расписание")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/lastexibition/"><?= $lang->l("Прошедшие")?></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/breeds/" class="dropdown-toggle" data-toggle="dropdown">
                            <?= $lang->l("Породы собак")?> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/ukc_admin_iku/static_text/klasification"><?= $lang->l("Классификация")?></a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/breeds/"><?= $lang->l("Породы собак")?></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/static_text/contacts"><?= $lang->l("Контакты")?></a>
                    </li>
                    <li> 
                        <a href="/ukc_admin_iku/language/"><?= $lang->l("Языки")?></a>
                    </li>
                    <li> 
                        <a href="/ukc_admin_iku/labels/"><?= $lang->l("Подписи")?></a>
                    </li>
                    <li> 
                        <a href="/ukc_admin_iku/admins/"><?= $lang->l("Администраторы")?></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/" target="_blank"><?= $lang->l("На сайт")?></a></li>
                    <li><a href="/ukc_admin_iku/logout/"><?= $lang->l("Выход")?></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
    <?php if (!isset($_GET["action"])) { ?>
        <ul>
            <li style="float: none; margin: 0 auto; width: 70px; list-style: none;">
                <a href="/ukc_admin_iku/<?= $_GET["page"] ?>/add"><input type="button" value="<?= $lang->l("Добавить")?>" class="btn btn-success"></a>
            </li>
        </ul>
    <?php } ?>
<?php } ?>
