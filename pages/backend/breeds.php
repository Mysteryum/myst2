<div id="tabs">
    <form method="get">
        <table class="table" style="width: 900px; margin: 0px auto;">
            <tr>
                <td>
                    <?= $lang->l("Поиск по группе:") ?>
                </td>
                <td style="width: 250px;">
                    <select class="form-control" name="group">
                        <option value="0"><?= $lang->l("Выбрать") ?></option>
                        <option value="1" <?=(isset($_GET["group"])&&($_GET["group"]==1))?"selected":""?>><?= $lang->l("I Группа")?></option>
                        <option value="2" <?=(isset($_GET["group"])&&($_GET["group"]==2))?"selected":""?>><?= $lang->l("II Группа")?></option>
                        <option value="3" <?=(isset($_GET["group"])&&($_GET["group"]==3))?"selected":""?>><?= $lang->l("III Группа")?></option>
                        <option value="4" <?=(isset($_GET["group"])&&($_GET["group"]==4))?"selected":""?>><?= $lang->l("IV Группа")?></option>
                        <option value="5" <?=(isset($_GET["group"])&&($_GET["group"]==5))?"selected":""?>><?= $lang->l("V Группа")?></option>
                    </select>
                </td>
                <td>
                    <?= $lang->l("Поиск по символу:")?>
                </td>
                <td style="width: 250px;">
                    <select class="form-control" name="symbol">
                        <option value="0"><?= $lang->l("Выбрать")?></option>
                        <?php
                        for ($i = 0; $i < count($rus_literal); $i++) {
                            echo "<option value='{$rus_literal[$i]}' ".((isset($_GET["symbol"])&&($_GET["symbol"]==$rus_literal[$i]))?"selected":"").">{$rus_literal[$i]}</option>";
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <button type="submit" class="btn btn-primary"><?= $lang->l("Искать")?></button>
                </td>
                <td>
                    <button type="button" class="btn btn-success"><?= $lang->l("Все породы")?></button>
                </td>
            </tr>
        </table>
    </form>
    <ul>
        <?php foreach ($parametrs["language"] as $value) { ?>
            <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
        <?php } ?>
    </ul>
    <?php foreach ($parametrs["language"] as $value) { ?>
        <div id="tabs-<?= $value["id"] ?>">
            <table class="table">
                <tr class="top">
                    <th><?= $lang->l("Символ")?></th>
                    <th><?= $lang->l("Группа")?></th>        
                    <th><?= $lang->l("Код стандарта")?></th>
                    <th><?= $lang->l("Русское название")?></th>
                    <th><?= $lang->l("Международное название")?></th>
                    <th><?= $lang->l("Другие")?></th>
                    <th><?= $lang->l("Статус")?></th>
                    <th style="width: 200px;"><?= $lang->l("Документы")?></th>
                </tr>
                <?php
                foreach ($parametrs["breeds"] as $breeds) {
                    if (isset($breeds["desc"][$value["id"]][0]["rus_name"])) {
                        $breeds_desc = $breeds["desc"][$value["id"]][0];
                    } else {
                        $breeds_desc = $breeds["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $breeds_desc["symbol"] ?></td>
                        <td><?= $breeds["label_group"] ?></td>            
                        <td><?= $breeds["kode"] ?></td>
                        <td><?= $breeds_desc["rus_name"] ?></td>
                        <td><?= $breeds_desc["ang_name"] ?></td>
                        <td><?= $breeds_desc["another_name"] ?></td>
                        <td><?= $breeds_desc["name"] ?></td>
                        <td class="document">
                            <?php if ($breeds_desc["document"]) { ?>
                                <a href="/userfiles/provision/<?= $breeds_desc["document"] ?>">
                                    <?php if ($value["id"]==$breeds_desc["lang_id"]) { ?>
                                    <img src="/userfiles/lang_flag/<?= $parametrs["language"][$value["id"]]["flag"] ?>" alt="<?= $breeds_desc["document"] ?>">
                                </a>    
                            <?php } }?>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/breeds/edit/<?= $breeds["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/breeds/del/<?= $breeds["id"] ?>">
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
