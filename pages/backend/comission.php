<div id="tabs">
    <ul>
        <?php foreach ($parametrs["language"] as $value) { ?>
            <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
        <?php } ?>
    </ul>
    <?php foreach ($parametrs["language"] as $value) { ?>
        <div id="tabs-<?= $value["id"] ?>">
            <table class="table">
                <tr class="top">
                    <th>Комиссия</th>
                    <th>Член комиссии</th>
                    <th>Имя</th>
                    <th>Телефона</th>
                    <th>Страна</th>
                    <th>Адрес</th>
                    <th>E-mail</th>
                    <th>Сайт</th>
                </tr>
                <?php
                foreach ($parametrs["commision"] as $commision) {      
                    if (isset($commision["desc"][$value["id"]][0]["name"])) {
                        $commision_desc = $commision["desc"][$value["id"]][0];
                    } else {
                        $commision_desc = $commision["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $commision_desc["type"] ?></td>
                        <td><?= $commision["member"] ?></td>
                        <td><?= $commision_desc["name"] ?></td>
                        <td><?= $commision["phone"] ?></td>
                        <td><?= $commision["country_name"] ?></td>
                        <td><?= $commision_desc["adrres"] ?></td>
                        <td><?= $commision["mail"] ?></td>
                        <td><?= $commision["syte"] ?></td>    
                        <td>
                            <a href="/ukc_admin_iku/comission/edit/<?= $commision["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    Изменить
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/comission/del/<?= $commision["id"] ?>">
                                <button type="Удалить" class="btn btn-danger">
                                    Удалить
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } ?>
</div>