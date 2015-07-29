<?php
if (isLoggedAdmin()) {
    ?>

    <div class="header" style="height: auto;">
        <nav class="navbar navbar-default" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="/">
                    International Kennel Union
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-ex5-collapse">
                <ul class="nav navbar-nav" id="navbar-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle <?= ($_GET["page"] == "main") ? 'active' : '' ?>" data-toggle="dropdown">
                            Главная <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/ukc_admin_iku/static_text/main">Главная</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/menedgment/">Руководство</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/comission/">Комиссии</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/expert/">Эксперты</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/registration/">Регитсрация</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/static_text/ustav">Устав</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/provisions/">Положения</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/circulars">Циркуляры</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/static_text/patent">Патент лого</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/news/">Новости</a>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/members/">Члены ИКУ</a>    
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/exibition/" class="dropdown-toggle" data-toggle="dropdown">
                            Выставки <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/ukc_admin_iku/exibition/">Расписание</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/lastexibition/">Прошедшие</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/breeds/" class="dropdown-toggle" data-toggle="dropdown">
                            Породы собак <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="/ukc_admin_iku/static_text/klasification">Классификация</a>
                            </li>
                            <li>
                                <a href="/ukc_admin_iku/breeds/">Породы собак</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="/ukc_admin_iku/static_text/contacts">Контакты</a>
                    </li>
                    <li> 
                        <a href="/ukc_admin_iku/language/">Языки</a>
                    </li>
                    <li> 
                        <a href="/ukc_admin_iku/labels/">Подписи</a>
                    </li>
                    <li> 
                        <a href="/ukc_admin_iku/admins/">Администраторы</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/" target="_blank">На сайт</a></li>
                    <li><a href="/ukc_admin_iku/logout/">Выход</a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
    <?php if (!isset($_GET["action"])) { ?>
        <ul>
            <li style="float: none; margin: 0 auto; width: 70px; list-style: none;">
                <a href="/ukc_admin_iku/<?= $_GET["page"] ?>/add"><input type="button" value="Добавить" class="btn btn-success"></a>
            </li>
        </ul>
    <?php } ?>
<?php } ?>
