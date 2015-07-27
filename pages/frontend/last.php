<table class="content-table last" cellspacing="0">
    <?php
    foreach ($parametrs["exebition"] as $value) {
        if (isset($value["desc"][$value["id"]][0]["name"])) {
            $value_desc = $value["desc"][$value["id"]][0];
        } else {
            $value_desc = $value["desc"][1][0];
        }
        ?>
        <tr>
            <th>
        <div class="scroller">
            <div class="galery-next galery-next_<?= $value["id"] ?>"></div>
            <div class="galery-prev galery-prev_<?= $value["id"] ?>"></div>
            <div class="galery galery_<?= $value["id"] ?>">
                <ul class="gal">
                    <?php
                    $galery = $pages->getGalerry($value["id"]);
                    for ($j = 0; $j < count($galery); $j++) {
                        ?>
                        <li>
                            <a href="/userfiles/galery/<?= $galery[$j]["path"] ?>" class="lbox">
                                <img class="galery-item" src="/userfiles/galery/<?= $galery[$j]["path"] ?>">
                            </a>  
                        </li> 
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <?php if (count($galery)>=6) { ?>
            <script type="text/javascript">
                $(".galery_<?= $value["id"] ?>").jCarouselLite({
                    btnNext: ".galery-next_<?= $value["id"] ?>",
                    btnPrev: ".galery-prev_<?= $value["id"] ?>",
                    visible: 6
                });
            </script>
        <?php } ?>
    </th>
    </tr>
    <tr>
        <td><?= $value_desc["content"] ?></td>
    </tr>
    <?php
}
?>
</table>