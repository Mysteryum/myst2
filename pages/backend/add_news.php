<form method="post" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["news"]["desc"][1]) && !isset($parametrs["news"]["desc"][$value["id"]])) {
                $news_desc = $parametrs["news"]["desc"][1][0];
            } elseif (isset($parametrs["news"]["desc"][$value["id"]])) {
                $news_desc = $parametrs["news"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">
                <div class="form-group">
                    <label for="InputTitle">Название</label>
                    <input type="text" name="name[<?= $value["id"] ?>]" value="<?= isset($news_desc["name"])?$news_desc["name"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Полное описание</label>
                    <textarea style="height: 300px;" name="content[<?= $value["id"] ?>]" class="check_editor" class="form-control"><?= isset($news_desc["content"])?$news_desc["content"]:'' ?></textarea>
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