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
                foreach ($parametrs["news"] as $news) {
                    if (isset($news["desc"][$value["id"]][0]["name"])) {
                        $news_desc = $news["desc"][$value["id"]][0];
                    } else {
                        $news_desc = $news["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $news["date"] ?></td>   
                        <td><?= $news_desc["name"] ?></td>   
                        <td>
                            <a href="/ukc_admin_iku/news/edit/<?= $news["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    <?= $lang->l("Изменить")?>
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/news/del/<?= $news["id"] ?>">
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


