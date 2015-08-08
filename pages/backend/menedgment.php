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
                    <th><?= $lang->l("Должность")?></th>
                    <th><?= $lang->l("Имя")?></th>
                    <th><?= $lang->l("Страна")?></th>
                    <th><?= $lang->l("Адрес")?></th>
                    <th><?= $lang->l("Телефон")?></th>
                    <th>E-mail</th>
                </tr>
                <?php
                foreach ($parametrs["manadgment"] as $manadgment) {
                    if (isset($manadgment["desc"][$value["id"]][0]["post"])) {
                        $manadgments_desc = $manadgment["desc"][$value["id"]][0];
                    } else {
                        $manadgments_desc = $manadgment["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $manadgments_desc["post"] ?></td>
                        <td><?= $manadgments_desc["name"] ?></td>
                        <td><?= $manadgment["country_name"] ?></td>
                        <td><?= $manadgments_desc["adrres"] ?></td>
                        <td><?= $manadgment["phone"] ?></td>
                        <td><?= $manadgment["mail"] ?></td>
                        <td>
                            <a href="/ukc_admin_iku/menedgment/edit/<?= $manadgment["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/menedgment/del/<?= $manadgment["id"] ?>">
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
