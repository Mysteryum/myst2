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
                    <th><?= $lang->l("Название")?></th>
                    <th><?= $lang->l("Документы")?></th>
                    <th></th>
                </tr>
                <?php
                if (!isset($parametrs["provision"][$value["id"]])) {
                    $parametrs["provision"][$value["id"]] = $parametrs["provision"][1];
                }
                foreach ($parametrs["provision"][$value["id"]] as $key => $provision) {
                    ?>
                    <tr>
                        <td><?= $provision["name"] ?></td>
                        <td class="document">
                            <?php if ($provision["document"]) { ?>
                                <a href="/userfiles/provision/<?= $provision["document"] ?>">
                                    <img src="/userfiles/lang_flag/<?= $parametrs["language"][$value["id"]]["flag"] ?>" alt="<?= $parametrs["language"][$value["id"]]["name"] ?>">
                                </a>             
                            <?php } ?>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/provisions/edit/<?= $provision["provision_id"] ?>">
                                <button type="button" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/provisions/del/<?= $provision["provision_id"] ?>">
                                <button type="button" class="btn btn-danger">
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