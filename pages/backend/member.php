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
                    <th><?= $lang->l("Флаг")?></th>
                    <th><?= $lang->l("Страна")?></th>
                    <th><?= $lang->l("Партнер")?></th>
                    <th><?= $lang->l("Организация")?></th>
                    <th><?= $lang->l("Руководитель")?></th>
                    <th><?= $lang->l("Контакты")?></th>
                    <th><?= $lang->l("Договор")?></th>
                </tr>
                <?php
                foreach ($parametrs["members"] as $member) {
                    if (isset($member["desc"][$value["id"]][0]["id"])) {
                        $members_desc = $member["desc"][$value["id"]][0];
                    } else {
                        $members_desc = $member["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td>
                            <img src="/userfiles/member_flag/<?= $member["flag"] ?>" style="max-height: 50px;">        
                        </td>
                        <td><?= $members_desc["country"] ?></td>
                        <td>
                            <?= ($member["partner"] == 1) ? "Да" : "Нет" ?>
                        </td>
                        <td><?= $members_desc["name_org"] ?></td>
                        <td><?= $members_desc["menedger"] ?></td>
                        <td>
                            <?= $member["phone"] ?><br>
                            <?= $members_desc["adrres"] ?><br>
                            <?= $member["mail"] ?>
                        </td>
                        <td>
                            <a href="/userfiles/member_document/<?= $members_desc["contract_file"] ?>" class="lbox"><?= $members_desc["contract"] ?></a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/members/edit/<?= $member["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/members/del/<?= $member["id"] ?>">
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