<form method="post" ENCTYPE="multipart/form-data" role="form">
    <?php if (isset($parametrs["error"])) { ?>
        <div class="alert alert-danger"><?= $parametrs["error"] ?></div>
    <?php } ?>  
    <?php if (isset($parametrs["expert"]["photo"])) { ?>
        <div class="form-group">
            <img src="/userfiles/expert/<?= $parametrs["expert"]["photo"] ?>" style="max-width: 150px; max-height: 150px;">
        </div>
    <?php } ?>
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["expert"]["desc"][1]) && !isset($parametrs["expert"]["desc"][$value["id"]])) {
                $expert_desc = $parametrs["expert"]["desc"][1][0];
            } elseif (isset($parametrs["expert"]["desc"][$value["id"]])) {
                $expert_desc = $parametrs["expert"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">         
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Имя")?></label>
                    <input type="text" value="<?= isset($expert_desc["name"]) ? $expert_desc["name"] : "" ?>" name="name[<?= $value["id"] ?>]" class="form-control">        
                </div>
                <div class="form-group">
                    <label for="InputTitle"><?= $lang->l("Группы")?></label>
                    <input type="text" value="<?= isset($expert_desc["group"]) ? $expert_desc["group"] : "" ?>" name="group[<?= $value["id"] ?>]" class="form-control"> 
                </div>        
            </div>
        <?php } ?>
    </div>
 <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <label for="InputTitle"><?= $lang->l("Страна")?></label>
        <select name="country" class="form-control">
            <option value="0"><?= $lang->l("Выбрать")?></option>
            <?php foreach ($parametrs["country"] as $value) { ?>
                <option value="<?= $value["id_country"] ?>" <?= (isset($parametrs["expert"]["country"]) && ($parametrs["expert"]["country"] == $value["id_country"])) ? "selected" : "" ?>><?= $value["name_country"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">        
        <label for="InputTitle"><?= $lang->l("Фото")?></label>
        <input type="file" value="" name="photo" class="form-control">
    </div>
        <?php } ?>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>