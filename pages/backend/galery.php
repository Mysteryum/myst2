<form method="post" ENCTYPE="multipart/form-data" role="form">
    <div class="form-group">
        <label for="InputTitle">Добавить фото</label>
        <input type="file" name="galery" class="form-control">
    </div>                 
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success" name="submit">
            Сохранить
        </button>        
    </div>
</form>
<table class="table">
    <?php
    for ($i = 0; $i < count($parametrs["galery"]); $i++) {
        ?>
        <tr>
            <th>
                <a href="/ukc_admin_iku/galery/del/<?= $_GET["id"] ?>/<?= $parametrs["galery"][$i]["id"] ?>">удалить</a>
            </th>
        </tr>
        <tr>
            <th>
                <img src="/userfiles/galery/<?= $parametrs["galery"][$i]["path"] ?>" style="max-width: 300px;">
            </th>
        </tr>
        <?php
    }
    ?>
</table>