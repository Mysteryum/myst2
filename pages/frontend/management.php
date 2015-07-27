<table class="content-table" cellspacing="0">
    <tr>
        <th><?= $lang->l("Должность") ?></th>
        <th><?= $lang->l("Имя") ?></th>
        <th><?= $lang->l("Страна") ?></th>
        <th><?= $lang->l("Адрес") ?></th>
        <th><?= $lang->l("Телефон") ?></th>
        <th><?= $lang->l("E-mail") ?></th>
    </tr>
    <?php
    foreach ($parametrs["manadgment"] as $manadgment) {
        if (isset($manadgment["desc"][$_SESSION["lang"]][0]["post"])) {
            $manadgments_desc = $manadgment["desc"][$_SESSION["lang"]][0];
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
        </tr>
    <?php } ?>
</table>