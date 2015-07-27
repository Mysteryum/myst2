<?php if (($_GET["page"] == "party") || ($_GET["page"] == "members")) { ?>
    <table class="content-table members" cellspacing="0">
        <tr>
            <th><?= $lang->l("Флаг") ?></th>
            <th><?= $lang->l("Страна") ?></th>
            <th><?= $lang->l("Организация") ?></th>
            <th><?= $lang->l("Руководитель") ?></th>
            <th><?= $lang->l("Контакты") ?></th>
            <th><?= $lang->l("Договор") ?></th>
        </tr>
        <?php
        foreach ($parametrs["members"] as $value) {
            if (isset($value["desc"][$value["id"]][0]["name"])) {
                $value_desc = $value["desc"][$value["id"]][0];
            } else {
                $value_desc = $value["desc"][1][0];
            }
            ?>
            <tr>
                <td>
                    <img src="/userfiles/member_flag/<?= $value["flag"] ?>" style="max-height: 50px;">        
                </td>
                <td><?= $value_desc["country"] ?></td>
                <td><?= $value_desc["name_org"] ?></td>
                <td><?= $value_desc["menedger"] ?></td>
                <td>
                    <?= $value["phone"] ?><br>
                    <?= $value_desc["adrres"] ?><br>
                    <?= $value["mail"] ?>
                </td>
                <td>
                    <?php if ($value_desc["contract"]) { ?>
                        <a href="/userfiles/member_document/<?= $value_desc["document"] ?>" class="lbox"><?= $value_desc["contract"] ?></a>
                        <?php
                    } else {
                        echo "&nbsp;";
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php } ?>
<?php if (($_GET["page"] == "party") || ($_GET["page"] == "partners")) { ?>
    <?php if (!empty($parametrs["partner"])) { ?>
        <?php if (($_GET["page"] == "party")) { ?>
            <div class="main-content-title" style="margin: 15px auto;">
                <?= $lang->l("Партнеры") ?>
            </div>
        <?php } ?>
        <table class="content-table members" cellspacing="0">
            <tr>
                <th><?= $lang->l("Флаг") ?></th>
                <th><?= $lang->l("Страна") ?></th>
                <th><?= $lang->l("Организация") ?></th>
                <th><?= $lang->l("Руководитель") ?></th>
                <th><?= $lang->l("Контакты") ?></th>
                <th><?= $lang->l("Договор") ?></th>
            </tr>
            <?php
            foreach ($parametrs["partner"] as $value) {
                if (isset($value["desc"][$value["id"]][0]["name"])) {
                    $value_desc = $value["desc"][$value["id"]][0];
                } else {
                    $value_desc = $value["desc"][1][0];
                }
                ?>
                <tr>
                    <td>
                        <img src="/userfiles/member_flag/<?= $value["flag"] ?>" style="max-height: 50px;">        
                    </td>
                    <td><?= $value_desc["country"] ?></td>
                    <td><?= $value_desc["name_org"] ?></td>
                    <td><?= $value_desc["menedger"] ?></td>
                    <td>
                        <?= $value["phone"] ?><br>
                        <?= $value_desc["adrres"] ?><br>
                        <?= $value["mail"] ?>
                    </td>
                    <td>
                        <?php if ($value_desc["contract"]) { ?>
                            <a href="/userfiles/member_document/<?= $value_desc["document"] ?>" class="lbox"><?= $value_desc["contract"] ?></a>
                            <?php
                        } else {
                            echo "&nbsp;";
                        }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    <?php } ?>
<?php } ?>