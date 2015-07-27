<table class="content-table commision" cellspacing="0">
    <tr>
        <th><?= $lang->l("Комиссия") ?></th>
        <th><?= $lang->l("Член комиссии") ?></th>
        <th><?= $lang->l("Имя") ?></th>
        <th><?= $lang->l("Телефона") ?></th>
        <th><?= $lang->l("Страна") ?></th>
        <th><?= $lang->l("Адрес") ?></th>
        <th><?= $lang->l("E-mail") ?></th>
        <th><?= $lang->l("Сайт") ?></th>
    </tr>
    <?php
    foreach ($parametrs["commision"] as $commision) {
        if (isset($commision["desc"][$_SESSION["lang"]][0]["name"])) {
            $commision_desc = $commision["desc"][$_SESSION["lang"]][0];
        } else {
            $commision_desc = $commision["desc"][1][0];
        }
        ?>
        <tr>
            <td style="text-align: left;"><?= $commision_desc["type"] ?></td>
            <td style="text-align: left;"><?= $commision["member"] ?></td>
            <td><?= $commision_desc["name"] ?></td>
            <td><?= $commision["phone"] ?></td>
            <td><?= $commision["country_name"] ?></td>
            <td><?= $commision_desc["adrres"] ?></td>
            <td><?= $commision["mail"] ?></td>
            <td><?= $commision["syte"] ?></td>   
            </td>
        </tr>
    <?php } ?>
</table>
