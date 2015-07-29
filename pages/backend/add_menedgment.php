<form method="post" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["menedgment"]["desc"][1]) && !isset($parametrs["menedgment"]["desc"][$value["id"]])) {
                $menedgment_desc = $parametrs["menedgment"]["desc"][1][0];
            } elseif (isset($parametrs["menedgment"]["desc"][$value["id"]])) {
                $menedgment_desc = $parametrs["menedgment"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">
                <div class="form-group">
                    <label for="InputTitle">Должность</label>
                    <input type="text" name="post[<?= $value["id"] ?>]" value="<?= isset($menedgment_desc["post"]) ? $menedgment_desc["post"] : '' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Имя</label>
                    <input type="text" name="name[<?= $value["id"] ?>]" value="<?= isset($menedgment_desc["name"]) ? $menedgment_desc["name"] : '' ?>" class="form-control">
                </div>
                <input type="hidden" name="country[<?= $value["id"] ?>]" value="" class="form-control">
                <div class="form-group">
                    <label for="InputTitle">Адрес</label>
                    <input type="text" name="adrres[<?= $value["id"] ?>]" value="<?= isset($menedgment_desc["adrres"]) ? $menedgment_desc["adrres"] : '' ?>" class="form-control">
                </div>                    
            </div>
        <?php } ?>
    </div><br>
    <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <label for="InputTitle">Страна</label>
        <select name="country_id" class="form-control">
            <option value="0">Выбрать</option>
            <?php foreach ($parametrs["country"] as $value) { ?>
                <option value="<?= $value["id_country"] ?>" <?= (isset($parametrs["menedgment"]["country_id"]) && ($parametrs["menedgment"]["country_id"] == $value["id_country"])) ? "selected" : "" ?>><?= $value["name_country"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="InputTitle">E-mail*</label>
        <input type="text" name="mail" value="<?= isset($parametrs["menedgment"]["mail"]) ? $parametrs["menedgment"]["mail"] : '' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">Телефон*</label>
        <input type="text" name="phone" value="<?= isset($parametrs["menedgment"]["phone"]) ? $parametrs["menedgment"]["phone"] : '' ?>" class="form-control">
    </div>
    <div style="text-align: right;">
        <?php } ?>
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>