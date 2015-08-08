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
                    <label for="InputTitle"><?= $lang->l("Место проведения")?></label>
                    <input type="text" name="place[<?= $value["id"] ?>]" value="<?= isset($exebition_desc['place'])?$exebition_desc['place']:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Название")?></label>
                    <input type="text" name="name_exhibition[<?= $value["id"] ?>]" value="<?= isset($exebition_desc['name_exhibition'])?htmlspecialchars($exebition_desc['name_exhibition']):''; ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Статус")?></label>
                    <input type="text" name="status[<?= $value["id"] ?>]" value="<?= isset($exebition_desc['status'])?$exebition_desc['status']:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Название клуба")?></label>
                    <input type="text" name="name_club[<?= $value["id"] ?>]" value="<?= isset($exebition_desc['name_club'])?htmlspecialchars($exebition_desc['name_club']):'' ?>" class="form-control">
                </div>
            </div>
        <?php } ?>
    </div><br>
   <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <?=$parametrs["exebition"]["country"]?><br>
        <label for="InputTitle"><?= $lang->l("Страна")?></label>
        <select name="country_id" class="form-control">
            <option value="0"><?= $lang->l("Выбрать")?></option>
            <?php foreach ($parametrs["country"] as $value) { ?>
                <option value="<?= $value["id_country"] ?>"
                        <?= (isset($parametrs["exebition"]["country_id"]) && ($parametrs["exebition"]["country_id"] == $value["id_country"])) ? "selected" : "" ?>
                        <?= (($parametrs["exebition"]["country"] == $value["name_country"])) ? "selected" : "" ?>
                        ><?= $value["name_country"] ?></option>
            <?php } ?>
        </select>        
    </div>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Дата")?></label>
        <input type="text" name="data" value="<?= isset($parametrs["exebition"]['data'])?$parametrs["exebition"]['data']:'' ?>" class="form-control date-picer">
    </div>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Телефон")?></label>
        <input type="text" name="phone" value="<?= isset($parametrs["exebition"]['phone'])?$parametrs["exebition"]['phone']:'' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">E-mail</label>
        <input type="text" name="mail" value="<?= isset($parametrs["exebition"]['mail'])?$parametrs["exebition"]['mail']:'' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Сайт")?></label>
        <input type="text" name="syte" value="<?= isset($parametrs["exebition"]['syte'])?$parametrs["exebition"]['syte']:'' ?>" class="form-control">
    </div>
      <?php } ?>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            <?= $lang->l("Сохранить")?>
        </button>        
    </div>
</form>
