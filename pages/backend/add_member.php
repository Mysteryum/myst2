<form method="post" role="form" enctype="multipart/form-data">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["member"]["desc"][1]) && !isset($parametrs["member"]["desc"][$value["id"]])) {
                $member_desc = $parametrs["member"]["desc"][1][0];
            } elseif (isset($parametrs["member"]["desc"][$value["id"]])) {
                $member_desc = $parametrs["member"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">
                <div class="form-group">
                    <label for="InputTitle">Страна</label>
                    <input type="text" name="country[<?= $value["id"] ?>]" value="<?= isset($member_desc["country"])?$member_desc["country"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Организация</label>
                    <input type="text" name="name_org[<?= $value["id"] ?>]" value="<?= isset($member_desc["name_org"])?$member_desc["name_org"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Руководитель</label>
                    <input type="text" name="menedger[<?= $value["id"] ?>]" value="<?= isset($member_desc["menedger"])?$member_desc["menedger"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Адрес</label>
                    <input type="text" name="adrres[<?= $value["id"] ?>]" value="<?= isset($member_desc["adrres"])?$member_desc["adrres"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Договор о членстве (название)</label>
                    <input type="text" name="contract[<?= $value["id"] ?>]" value="<?= isset($member_desc["contract"])?$member_desc["contract"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Договор о членстве (файл)</label>
                    <input type="file" name="dogovor_file[<?= $value["id"] ?>]" class="form-control">
                </div>
            </div>
        <?php } ?>
    </div><br>
     <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <label for="InputTitle">Флаг</label>
        <input type="file" name="flag" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">Партнер</label>
        <input type="checkbox" name="partner" value="1" <?= (isset($parametrs["member"]["partner"])&&($parametrs["member"]["partner"] == 1)) ? "checked" : "" ?> >
    </div>

    <div class="form-group">
        <label for="InputTitle">Телефон</label>
        <input type="text" name="phone" value="<?= isset($parametrs["member"]["phone"])?$parametrs["member"]["phone"]:'' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">E-mail</label>
        <textarea rows="6" cols="30" name="mail" class="form-control check_editor" style="height: 100px;"><?= isset($parametrs["member"]["mail"])?$parametrs["member"]["mail"]:''  ?></textarea>
    </div>
    <?php } ?>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>