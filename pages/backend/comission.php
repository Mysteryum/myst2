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
                    <th><?= $lang->l("Комиссия")?></th>
                    <th><?= $lang->l("Член комиссии")?></th>
                    <th><?= $lang->l("Имя")?></th>
                    <th><?= $lang->l("Телефон")?></th>
                    <th><?= $lang->l("Страна")?></th>
                    <th><?= $lang->l("Адрес")?></th>
                    <th>E-mail</th>
                    <th><?= $lang->l("Сайт")?></th>
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
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/comission/del/<?= $commision["id"] ?>">
                                <button type="Удалить" class="btn btn-danger">
                                    <?= $lang->l("Удалить")?>
                                </button>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } ?>
</div>