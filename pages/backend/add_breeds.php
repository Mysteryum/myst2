<form method="post" role="form" enctype="multipart/form-data">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        foreach ($parametrs["language"] as $value) {
            if (isset($parametrs["breed"]["desc"][1]) && !isset($parametrs["breed"]["desc"][$value["id"]])) {
                $breed_desc = $parametrs["breed"]["desc"][1][0];
            } elseif (isset($parametrs["breed"]["desc"][$value["id"]])) {
                $breed_desc = $parametrs["breed"]["desc"][$value["id"]][0];
            }
            ?>
            <div id="tabs-<?= $value["id"] ?>">
                <div class="form-group">
                    <label for="InputTitle">Символ</label>
                    <select name="symbol[<?= $value["id"] ?>]" class="form-control">    
                        <?php
                        for ($i = 0; $i < count($rus_literal); $i++) {
                            echo "<option value=\"$rus_literal[$i]\" ";
                            if (isset($breed_desc["symbol"])&&($rus_literal[$i] == $breed_desc["symbol"])) {
                                echo "selected";
                            }
                            echo " >$rus_literal[$i]</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="InputTitle">Русское название</label>
                    <input type="text" name="rus_name[<?= $value["id"] ?>]" value="<?= isset($breed_desc["rus_name"])?$breed_desc["rus_name"]:'' ?>" class="form-control">
                </div>                
                <div class="form-group">
                    <label for="InputTitle">Другие употребляемые названия</label>
                    <textarea name="another_name[<?= $value["id"] ?>]" class="form-control"><?= isset($breed_desc["another_name"])?$breed_desc["another_name"]:'' ?></textarea>
                </div>
                <div class="form-group">
                    <label for="InputTitle">Статус</label>
                    <input type="text" name="name[<?= $value["id"] ?>]" value="<?= isset($breed_desc["name"])?$breed_desc["name"]:'' ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="InputTitle">Документ</label>
                    <input type="file" name="document[<?= $value["id"] ?>]" class="form-control">
                </div>
            </div>
        <?php } ?>
    </div><br>
    <?php if ($value["id"] == 1){?>
    <div class="form-group">
        <label for="InputTitle">Международное название</label>
        <input type="text" name="ang_name" value="<?= isset($parametrs["breed"]["ang_name"])?$parametrs["breed"]["ang_name"]:'' ?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="InputTitle">Группа</label>
        <select name="group" class="form-control">
            <option value="1" <?php if (isset($parametrs["breed"]["group"])&&($parametrs["breed"]["group"] == 1)) echo "selected"; ?>>I Группа</option>
            <option value="2" <?php if (isset($parametrs["breed"]["group"])&&($parametrs["breed"]["group"] == 2)) echo "selected"; ?>>II Группа</option>
            <option value="3" <?php if (isset($parametrs["breed"]["group"])&&($parametrs["breed"]["group"] == 3)) echo "selected"; ?>>III Группа</option>
            <option value="4" <?php if (isset($parametrs["breed"]["group"])&&($parametrs["breed"]["group"] == 4)) echo "selected"; ?>>IV Группа</option>
            <option value="5" <?php if (isset($parametrs["breed"]["group"])&&($parametrs["breed"]["group"] == 5)) echo "selected"; ?>>V Группа</option>
        </select>
    </div>
    <div class="form-group">
        <label for="InputTitle">Код стандарта</label>
        <input type="text" name="kode" value="<?= isset($parametrs["breed"]["kode"])?$parametrs["breed"]["kode"]:'' ?>" class="form-control">
    </div>
    <?php } ?>
    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>