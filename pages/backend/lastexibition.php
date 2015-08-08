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
                    <th><?= $lang->l("Дата")?></th>
                    <th><?= $lang->l("Название")?></th>
                </tr>
                <?php
                foreach ($parametrs["exebition"] as $exebition) {
                    if (isset($exebition["desc"][$value["id"]][0]["content"])) {
                        $exebition_desc = $exebition["desc"][$value["id"]][0];
                    } else {
                        $exebition_desc = $exebition["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $exebition["date"] ?></td> 
                        <td><?= $exebition_desc["content"] ?></td> 
                        <td>
                            <a href="/ukc_admin_iku/galery/<?= $exebition["id"] ?>">
                                <button type="Изменить" class="btn btn-success">
                                    <?= $lang->l("Галерея")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/lastexibition/edit/<?= $exebition["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/lastexibition/del/<?= $exebition["id"] ?>">
                                <button type="Удалить" class="btn btn-danger">
                                    <?= $lang->l("Удалить")?>
                                </button>
                            </a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    <?php } ?>
</div>