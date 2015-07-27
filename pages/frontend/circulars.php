<table class="content-table circulars" cellspacing="0">
    <tr>
        <th><?=$lang->l("число")?></th>
        <th><?=$lang->l("номер")?></th>
        <th><?=$lang->l("название")?></th>
        <th style="width: 200px;"></th>
    </tr>
    <?php
    foreach ($parametrs["circulars"] as $value) {
        if (isset($value["desc"][$value["id"]][0]["content"])) {
            $value_desc = $value["desc"][$value["id"]][0];
        } else {
            $value_desc = $value["desc"][1][0];
        }
        ?>
        <tr>
            <td><?= $value["chislo"] ?></td>
            <td><?= $value["numer"] ?></td>
            <td><?= $value_desc["name"] ?></td>
            <td class="open-modal">
                <?=$lang->l("Читать описание")?>
                <div class="modal-windows-wrap">
                    <div class="modal-windows-title">
                        <div class="close-modal"></div>
                        <?=$lang->l("Описание")?>        
                    </div>
                    <div class="modal-windows-content">
                        <div class="modal-windows-text">
                            <?= $value_desc["content"] ?>
                        </div>    
                    </div>    
                </div>
            </td>
        </tr>
        <?php
    }
    ?>
</table>