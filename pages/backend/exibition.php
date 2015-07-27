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
                    <th>Дата</th>
                    <th>Страна</th>
                    <th>Место проведения</th>
                    <th>Название</th>
                    <th>Статус</th>
                    <th>Название клуба</th>
                    <th>Контакты</th>
                </tr>
                <?php
                foreach ($parametrs["exebition"] as $exebition) {
                    if (isset($exebition["desc"][$value["id"]][0]["country"])) {
                        $exebition_desc = $exebition["desc"][$value["id"]][0];
                    } else {
                        $exebition_desc = $exebition["desc"][1][0];
                    }
                    ?>
                    <tr>
                        <td><?= $exebition["data"] ?></td>
                        <td><?= $exebition["country_name"] ?></td>
                        <td><?= $exebition_desc["place"] ?></td>
                        <td><?= $exebition_desc["name_exhibition"] ?></td>
                        <td><?= $exebition_desc["status"] ?></td>
                        <td><?= $exebition_desc["name_club"] ?></td>
                        <td>
                            <?= $exebition["mail"] ?><br>
                            <?= $exebition["phone"] ?><br>
                            <?= $exebition["syte"] ?>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/exibition/edit/<?= $exebition["id"] ?>">
                                <button type="Изменить" class="btn btn-default">
                                    Изменить
                                </button>
                            </a>
                        </td>
                        <td>
                            <a href="/ukc_admin_iku/exibition/del/<?= $exebition["id"] ?>">
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








