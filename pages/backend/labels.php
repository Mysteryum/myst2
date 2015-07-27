<form method="post">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php foreach ($parametrs["language"] as $lang_id => $value) { ?>
            <input type="hidden" name="lang[<?= $lang_id ?>]" value="0">
            <div id="tabs-<?= $value["id"] ?>">
                <table class="table" cellpadding="0" cellspacing="0" style="width: 800px; margin: 0px auto;">
                    <tr>
                        <th>
                            <a href="">Метка</a>
                        </th>
                        <th>
                            <a href="">Перевод</a>
                        </th>
                    </tr>
                    <?php foreach ($parametrs["translate"][$lang_id] as $key => $value2) { ?>
                        <tr>
                            <td>
                                <?= $key ?>
                            </td>
                            <td>
                                <input type="text" name="<?= $lang->formatKey($key) ?>[<?= $lang_id ?>]" value="<?= htmlspecialchars($value2) ?>" style="width: 100%;">
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Сохранить">
                        </td>
                    </tr>
                </table>
            </div>
        <?php } ?>
    </div>
</form>