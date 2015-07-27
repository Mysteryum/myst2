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
                    <th>Флаг</th>
                    <th>Страна</th>
                    <th>Партнер</th>
                    <th>Организация</th>
                    <th>Руководитель</th>
                    <th>Контакты</th>
                    <th>Договор</th>
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
                                    Изменить
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/members/del/<?= $member["id"] ?>">
                                <button type="Удалить" class="btn btn-danger">
                                    Удалить
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