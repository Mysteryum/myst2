<?php foreach ($parametrs["country"] as $country) { ?>
    <div style="padding: 10px 15px; text-transform: uppercase;">    
        <img src="/images/country_img/<?= $country["id_country"] ?>.png" style="height: 15px; float: left; margin-right: 10px;">
        <?= $country["name_country"] ?>

    </div>
    <table class="content-table commision" cellspacing="0">
        <?php
        $parametrs["experts"] = $pages->getExpert(null, $country["id_country"]);
        $i = 0;
        foreach ($parametrs["experts"] as $value) {
            if (isset($value["desc"][$value["id"]][0]["name"])) {
                $value_desc = $value["desc"][$value["id"]][0];
            } else {
                $value_desc = $value["desc"][1][0];
            }
            if ($i % 2 == 0) {
                echo "<tr>";
            }
            ?>        
            <td style="width: 50%;">
                <table id="expert_wrap">
                    <tr>
                        <td rowspan="3" class="photo">
                            <img src="/userfiles/expert/<?= $value["photo"] ?>" alt="<?= $value_desc["name"] ?>">
                        </td>
                        <td><?= $value_desc["name"] ?></td>
                    </tr>
                    <tr>
                        <td><?= $value_desc["group"] ?></td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </table>                
            </td>
            <?php
            if ($i % 2 == 1) {
                echo "</tr>";
            }
            $i++;
        }
        ?>
    </table>
<?php } ?>