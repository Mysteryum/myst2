<div id="tabs">
    <ul>
        <?php foreach ($parametrs["language"] as $value) { ?>
            <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
        <?php } ?>
    </ul>
    <?php
    foreach ($parametrs["language"] as $value) {
        if (isset($parametrs["expert"]["desc"][1]) && !isset($parametrs["expert"]["desc"][$value["id"]])) {
            $expert_desc = $parametrs["expert"]["desc"][1][0];
        } elseif (isset($parametrs["expert"]["desc"][$value["id"]])) {
            $expert_desc = $parametrs["expert"]["desc"][$value["id"]][0];
        }
        ?>
        <div id="tabs-<?= $value["id"] ?>">
            <table class="table">
                <tr class="top">
                    <th><?= $lang->l("Фото")?></th>
                    <th><?= $lang->l("Имя")?></th>
                    <th><?= $lang->l("Страна")?></th>
                    <th><?= $lang->l("Группа")?></th>
                    <th></th>
                </tr>
                <?php
                foreach ($parametrs["expert"] as $expert) {
                    if (isset($expert["desc"][1]) && !isset($expert["desc"][$value["id"]])) {
                        $expert_desc = $expert["desc"][1][0];
                    } elseif (isset($expert["desc"][$value["id"]])) {
                        $expert_desc = $expert["desc"][$value["id"]][0];
                    }
                    ?>
                    <tr>
                        <td>
                            <img src="/userfiles/expert/<?= $expert["photo"] ?>" style="max-height: 150px; max-width: 150px;">
                        </td>
                        <td><?= $expert_desc["name"] ?></td>
                        <td><?= $expert["country_name"] ?></td>
                        <td><?= $expert_desc["group"] ?></td>
                        <td>
                            <a href="/ukc_admin_iku/expert/edit/<?= $expert["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/expert/del/<?= $expert["id"] ?>">
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
