<ul class="group_link">
    <li><a href="/group/1" <?php if ($group == 1) echo "class='active'"; ?>><?= $lang->l("I группа") ?></a></li>
    <li><a href="/group/2" <?php if ($group == 2) echo "class='active'"; ?>><?= $lang->l("II группа") ?></a></li>
    <li><a href="/group/3" <?php if ($group == 3) echo "class='active'"; ?>><?= $lang->l("III группа") ?></a></li>
    <li><a href="/group/4" <?php if ($group == 4) echo "class='active'"; ?>><?= $lang->l("IV группа") ?></a></li>
    <li><a href="/group/5" <?php if ($group == 5) echo "class='active'"; ?>><?= $lang->l("V группа") ?></a></li>
</ul>
<?php
if (isset($_GET["group"]) && count($parametrs["breeds"])) {
    ?>
    <table class="content-table group" cellspacing="0">
        <tr>  
            <th><?= $lang->l("Код стандарт") ?></th>
            <th><?= $lang->l("Русское название") ?></th>
            <th><?= $lang->l("Международное название") ?></th>
            <th><?= $lang->l("Другие") ?></th>
            <th><?= $lang->l("Статус") ?></th>
            <th style="width: 200px;"><?= $lang->l("Документы") ?></th>
        </tr>
        <?php
        foreach ($parametrs["breeds"] as $value) {
            if (isset($value["desc"][$value["id"]][0]["rus_name"])) {
                $value_desc = $value["desc"][$value["id"]][0];
            } else {
                $value_desc = $value["desc"][1][0];
            }
            ?>
            <tr>          
                <td><?= $value["kode"] ?></td>
                <td><?= $value_desc["rus_name"] ?></td>
                <td><?= $value["ang_name"] ?></td>
                <td><?= $value_desc["another_name"] ?></td>
                <td><?= $value_desc["name"] ?></td>
                <td class="document">
                    <?php if ($value_desc["lang_id"]==$_SESSION["lang"]){?>
                    <a href="/document.php?breed=<?= $value["id"] ?>">
                        <img src="/images/doc_icon.png" alt="<?= $parametrs["lang"][$_SESSION["lang"]]["name"] ?>" height="50">
                        <?php } ?>
                    </a>         
                </td>
            </tr>
            <?php
        } 
        ?>
    </table>
    <?php
}
?>