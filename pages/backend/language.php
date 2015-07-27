<form method="post" ENCTYPE="multipart/form-data" role="form">
    <input type="hidden" name="lang_id" value="<?= isset($_GET["id"]) ? $_GET["id"] : 0 ?>"> 
    <?php if (isset($parametrs["error"])) { ?>
    <div class="alert alert-danger"><?=$parametrs["error"]?></div>
    <?php } ?>
    <div class="form-group">
        <label for="InputTitle">Язык</label>
        <input type="text" name="name" class="form-control" value="<?= isset($_GET["id"]) ? $parametrs["language"][$_GET["id"]]["name"] : '' ?>">
    </div>
    <div class="form-group">
        <label for="InputTitle">Код</label>
        <input type="text" name="code" class="form-control" value="<?= isset($_GET["id"]) ? $parametrs["language"][$_GET["id"]]["code"] : '' ?>">
    </div>
    <div class="form-group">
        <label for="InputTitle">Флаг</label>
        <input type="file" name="flag" class="form-control">
    </div>

    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            <?php if (isset($_GET["action"]) && ($_GET["action"] == "edit")) { ?>
                Изменить                
            <?php } else { ?>
                Добавить
            <?php } ?>
        </button>        
    </div>
</form>
<table class="table">
    <tr class="top">
        <td>Флаг</td>
        <td>Язык</td>
        <td>Код</td>
        <td></td>
    </tr>
    <?php foreach ($parametrs["language"] as $value) { ?>
        <tr>
            <td><img src="/userfiles/lang_flag/<?= $value["flag"] ?>"></td>
            <td><?= $value["name"] ?></td>
            <td><?= $value["code"] ?></td>
            <td>
                <a href="/ukc_admin_iku/language/edit/<?= $value["id"] ?>">
                    <button type="Изменить" class="btn btn-default">
                        Изменить
                    </button>
                </a>
            </td>
            <td>
                <?php if ($value["id"] != 1) { ?>
                    <a href="/ukc_admin_iku/language/del/<?= $value["id"] ?>">
                        <button type="Удалить" class="btn btn-danger">
                            Удалить
                        </button>
                    </a>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>

</table>