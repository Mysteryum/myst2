<table class="content-table shedule" cellspacing="0">
    <tr>
        <th><?=$lang->l("Дата")?></th>
        <th><?=$lang->l("Страна")?></th>
        <th><?=$lang->l("Место проведения")?></th>
        <th><?=$lang->l("Название")?></th>
        <th><?=$lang->l("Статус")?></th>
        <th><?=$lang->l("Название клуба")?></th>
        <th><?=$lang->l("Контакты")?></th>
    </tr>
    <?php
    foreach ($parametrs["exebition"] as $value) {
        if (isset($value["desc"][$value["id"]][0]["name"])) {
            $value_desc = $value["desc"][$value["id"]][0];
        } else {
            $value_desc = $value["desc"][1][0];
        }
        ?>
        <tr>
            <td><?= $value["data"] ?></td>
            <td><?= $value["country_name"] ?></td>
            <td><?= $value_desc["place"] ?></td>
            <td><?= $value_desc["name_exhibition"] ?></td>
            <td><?= $value_desc["status"] ?></td>
            <td><?= $value_desc["name_club"] ?></td>
            <td class="open-modal">
                смотреть
                <div class="modal-windows-wrap">
                    <div class="modal-windows-title">
                        <div class="close-modal"></div>
                        Контакты        
                    </div>
                    <div class="modal-windows-content">
                        <div class="modal-windows-text">
                            <?php if ($value["mail"]) { ?>
                                <a href="mailto:<?= $value["mail"] ?>">
                                    <?= $value["mail"] ?>
                                </a><br>
                            <?php } ?>
                            <?= $value["phone"] ?><br>
                            <?php if ($value["syte"]) { ?>
                                <a href="http://<?= $value["syte"] ?>"><?= $value["syte"] ?></a>
                            <?php } ?>
                        </div>    
                    </div>    
                </div>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
