<form action="/ukc_admin_iku/static_text/<?= $_GET["action"] ?>" method="post" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?=$value["id"]?>"><?=$value["name"]?></a></li>
            <?php } ?>
        </ul>
        <?php foreach ($parametrs["language"] as $value) { ?>
            <div id="tabs-<?=$value["id"]?>">
                <div class="form-group">
                    <label for="InputTitle"><?= $content[0] ?></label>
                    <textarea style="height: 300px;" class="check_editor" name="content[<?=$value["id"]?>]"><?php StaticPage::getStaticText($_GET["action"], $value["id"]); ?></textarea>
                </div>
            </div>
        <?php } ?>
    </div>


    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>