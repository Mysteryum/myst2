<form method="post" ENCTYPE="multipart/form-data" role="form">
    <div id="tabs">
        <ul>
            <?php foreach ($parametrs["language"] as $value) { ?>
                <li><a href="#tabs-<?= $value["id"] ?>"><?= $value["name"] ?></a></li>
            <?php } ?>
        </ul>
        <?php
        
        foreach ($parametrs["language"] as $value) {
            if(isset($parametrs["provision"])&&(!isset($parametrs["provision"][$value["id"]]))){
                $parametrs["provision"][$value["id"]] = $parametrs["provision"][1];
            }
            ?>            
            <div id="tabs-<?= $value["id"] ?>">         
                <div class="form-group">
                    <label for="InputTitle">Название</label>
                    <textarea name="name[<?= $value["id"] ?>]" class="form-control"><?= isset($parametrs["provision"][$value["id"]][0]["name"])?$parametrs["provision"][$value["id"]][0]["name"]:"" ?></textarea>
                </div>
                <div class="form-group">
                    <label for="InputTitle"><?= $value["name"] ?></label>
                    <input type="file" name="lang[<?= $value["id"] ?>]" class="form-control">
                </div>    
            </div>
        <?php } ?>
    </div>


    <div style="text-align: right;">
        <button type="submit" class="btn btn-success">
            Сохранить
        </button>        
    </div>
</form>