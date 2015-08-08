<form method="post" action="/ukc_admin_iku/registration/add" ENCTYPE="multipart/form-data" role="form">
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Добавить регистрацию")?></label>
        <input type="file" name="registration" class="form-control">
    </div>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            <?= $lang->l("Сохранить")?>
        </button>        
    </div>
</form>
<ul class="registration-wrap">
    <?php for ($i = 0; $i < count($parametrs["registration"]); $i++) { ?>
        <li>
            <a href="/ukc_admin_iku/registration/del/<?= $parametrs["registration"][$i]["id"] ?>"><?= $lang->l("Удалить")?></a><br>
            <img src="/userfiles/registration/<?= $parametrs["registration"][$i]["path"] ?>" style="max-width: 300px;">
        </li>
    <?php } ?>
</ul>