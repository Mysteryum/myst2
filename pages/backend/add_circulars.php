<form method="post" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["circular"]["desc"][1]) && !isset($parametrs["circular"]["desc"][$value["id"]])) {
                $circular_desc = $parametrs["circular"]["desc"][1][0];
            } elseif (isset($parametrs["circular"]["desc"][$value["id"]])) {
                $circular_desc = $parametrs["circular"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">
                <div class="form-group">
                    <label for="InputTitle">Название</label>
                    <input type="text" name="name[<?= $value["id"] ?>]" value="<?= isset($circular_desc["name"])?$circular_desc["name"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Описание</label>
                    <textarea class="check_editor" name="content[<?= $value["id"] ?>]" style="height: 300px;"><?= isset($circular_desc["content"])?$circular_desc["content"]:'' ?></textarea>
                </div>      
            </div>
        <?php } ?>
    </div><br>
    <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <label for="InputTitle">Число</label>
        <input type="text" name="chislo" value="<?= isset($parametrs["circular"]["chislo"])?$parametrs["circular"]["chislo"]:'' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">Номер</label>
        <input type="text" name="numer" value="<?= isset($parametrs["circular"]["numer"])?$parametrs["circular"]["numer"]:'' ?>" class="form-control">
    </div>   
<?php } ?>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>