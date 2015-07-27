<?php
if (!isset($_GET["group"])) {
    $_GET["group"] = 0;
}
foreach ($parametrs["news"] as $value) {
    if (!isset($value["desc"][$_SESSION["lang"]][0]["name"])) {
        $news_desc = $value["desc"][1][0];
    } else {
        $news_desc = $value["desc"][$_SESSION["lang"]][0];
    }
    if ($value["id"] == $_GET["group"]) {
        ?>
        <div class="news_wrap">
            <div class="news_title">
                <div class="date"><?= $value["date"] ?></div>
                <div class="name"><?= $news_desc["name"] ?></div>        
            </div>
            <div class="news-content" style="height: auto;">
                <div class="news-test">
                    <?= $news_desc["content"] ?>
                </div>
            </div>
            <div class="bottom-news active">
                <div class="arrow-open"></div>
                <div class="label-arrow-news"><?=$lang->l("Свернуть")?></div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="news_wrap">
            <div class="news_title">
                <div class="date"><?= $value["date"] ?></div>
                <div class="name"><?= $news_desc["name"] ?></div>        
            </div>
            <div class="news-content">
                <div class="news-test">
                    <?= $news_desc["content"] ?>
                </div>
            </div>
            <div class="bottom-news">
                <div class="arrow-open"></div>
                <div class="label-arrow-news"><?=$lang->l("Читать далее")?></div>
            </div>
        </div>
        <?php
    }
}
?>
