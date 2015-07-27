<div id="tabs">
    <form method="get">
        <table class="table" style="width: 900px; margin: 0px auto;">
            <tr>
                <td>
                    Поиск по группе:
                </td>
                <td style="width: 250px;">
                    <select class="form-control" name="group">
                        <option value="0">Выбрать</option>
                        <option value="1" <?=(isset($_GET["group"])&&($_GET["group"]==1))?"selected":""?>>I Группа</option>
                        <option value="2" <?=(isset($_GET["group"])&&($_GET["group"]==2))?"selected":""?>>II Группа</option>
                        <option value="3" <?=(isset($_GET["group"])&&($_GET["group"]==3))?"selected":""?>>III Группа</option>
                        <option value="4" <?=(isset($_GET["group"])&&($_GET["group"]==4))?"selected":""?>>IV Группа</option>
                        <option value="5" <?=(isset($_GET["group"])&&($_GET["group"]==5))?"selected":""?>>V Группа</option>
                    </select>
                </td>
                <td>
                    Поиск по символу:
                </td>
                <td style="width: 250px;">
                    <select class="form-control" name="symbol">
                        <option value="0">Выбрать</option>
                        <?php
                        for ($i = 0; $i < count($rus_literal); $i++) {
                            echo "<option value='{$rus_literal[$i]}' ".((isset($_GET["symbol"])&&($_GET["symbol"]==$rus_literal[$i]))?"selected":"").">{$rus_literal[$i]}</option>";
                        }
                        ?>
                    </select>
                </td>

                <td>
                    <button type="submit" class="btn btn-primary">Искать</button>
                </td>
                <td>
                    <button type="button" class="btn btn-success">Все породы</button>
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
                    <th>Символ</th>
                    <th>Группа</th>        
                    <th>Код стандарт</th>
                    <th>Русское название</th>
                    <th>Международное название</th>
                    <th>Другие</th>
                    <th>Статус</th>
                    <th style="width: 200px;">Документы</th>
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
                                    <img src="/userfiles/lang_flag/<?= $parametrs["language"][$value["id"]]["flag"] ?>" alt="<?= $breeds_desc["document"] ?>">
                                </a>    
                            <?php } ?>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/breeds/edit/<?= $breeds["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    Изменить
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/breeds/del/<?= $breeds["id"] ?>">
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
