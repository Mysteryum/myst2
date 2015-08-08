<form method="post" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["comission"]["desc"][1]) && !isset($parametrs["comission"]["desc"][$value["id"]])) {
                $comission_desc = $parametrs["comission"]["desc"][1][0];
            } elseif (isset($parametrs["comission"]["desc"][$value["id"]])) {
                $comission_desc = $parametrs["comission"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">         
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Комиссия")?></label>
                    <input type="text" name="type[<?= $value["id"] ?>]" value="<?= isset($comission_desc["type"]) ? $comission_desc["type"] : '' ?>" class="form-control">
                </div>   
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Имя")?></label>
                    <input type="text" name="name[<?= $value["id"] ?>]" value="<?= isset($comission_desc["name"]) ? $comission_desc["name"] : '' ?>" class="form-control">
                </div>           
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Страна")?></label>
                    <input type="text" name="country[<?= $value["id"] ?>]" value="<?= isset($comission_desc["country"]) ? $comission_desc["country"] : '' ?>" class="form-control">
                </div>           
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Адрес")?></label>
                    <input type="text" name="adrres[<?= $value["id"] ?>]" value="<?= isset($comission_desc["adrres"]) ? $comission_desc["adrres"] : '' ?>" class="form-control">
                </div>          
            </div>
        <?php } ?>
    </div>
    <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Страна")?></label>
        <select name="country_id" class="form-control">
            <option value="0"><?= $lang->l("Выбрать")?></option>
            <?php foreach ($parametrs["country"] as $value) { ?>
                <option value="<?= $value["id_country"] ?>" <?= (isset($parametrs["comission"]["country_id"]) && ($parametrs["comission"]["country_id"] == $value["id_country"])) ? "selected" : "" ?>><?= $value["name_country"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Участник комиссии")?></label>
        <select name="member" class="form-control">
            <option value="1" <?php if (isset($parametrs["comission"]["type_member"]) && ($parametrs["comission"]["type_member"] == 1)) echo "selected"; ?>>Председатель комиссии</option>
            <option value="2" <?php if (isset($parametrs["comission"]["type_member"]) && ($parametrs["comission"]["type_member"] == 2)) echo "selected"; ?>>Член комиссии</option>
        </select>
    </div>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Телефон")?></label>
        <input type="text" name="phone" value="<?= isset($parametrs["comission"]["phone"]) ? $parametrs["comission"]["phone"] : '' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">E-mail</label>
        <input type="text" name="mail" value="<?= isset($parametrs["comission"]["mail"]) ? $parametrs["comission"]["mail"] : '' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Сайт")?></label>
        <input type="text" name="syte" value="<?= isset($parametrs["comission"]["syte"]) ? $parametrs["comission"]["syte"] : '' ?>" class="form-control">
    </div> 
     <?php } ?>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>   
</form>