<form method="post" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["exebition"]["desc"][1]) && !isset($parametrs["exebition"]["desc"][$value["id"]])) {
                $exebition_desc = $parametrs["exebition"]["desc"][1][0];
            } elseif (isset($parametrs["exebition"]["desc"][$value["id"]])) {
                $exebition_desc = $parametrs["exebition"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">
                <div class="form-group">
                    <label for="InputTitle">Описание</label>
                    <textarea class="check_editor" name="content[<?= $value["id"] ?>]" style="height: 300px;"><?= isset($exebition_desc["content"])?$exebition_desc["content"]:'' ?></textarea>
                </div>                 
            </div>
        <?php } ?>
    </div><br>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>