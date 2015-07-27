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
                    <th>число</th>
                    <th>номер</th>
                    <th>название</th>
                </tr>
                <?php
                foreach ($parametrs["circulars"] as $circulars) {                    
                    if (isset($circulars["desc"][$value["id"]][0]["name"])) {
                        $circulars_desc = $circulars["desc"][$value["id"]][0];
                    } else {
                        $circulars_desc = $circulars["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $circulars["chislo"] ?></td>
                        <td><?= $circulars["numer"] ?></td>
                        <td><?= $circulars_desc["name"] ?></td>
                        <td>
                            <a href="/ukc_admin_iku/circulars/edit/<?= $circulars["id"] ?>">
                                <button type="button" class="btn btn-default">
                                    Изменить
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/circulars/del/<?= $circulars["id"] ?>">
                                <button type="button" class="btn btn-danger">
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
