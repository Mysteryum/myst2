<div class="breed_symbol">
    <?php
    for ($i = 0; $i < count($rus_literal); $i++) {
        echo '<a href="/breed/' . $rus_literal[$i] . '" ';
        if ((isset($_GET["symbol"])) && ($rus_literal[$i] == $_GET["symbol"]))
            echo 'class="active"';
        echo'>' . $rus_literal[$i] . "</a> ";
    }
    ?>
</div>
<?php
if (isset($_GET["symbol"]) && count($parametrs["breeds"])) {
    ?>
    <table class="content-table breed" cellspacing="0">
        <tr>
            <th><?= $lang->l("Порода") ?></th>
            <th><?= $lang->l("Документы") ?></th>
        </tr>
        <?php
        for ($i = 0; $i < count($parametrs["breeds"]); $i++) {
            ?>
            <tr>
                <td><?= $parametrs["breeds"][$i]["rus_name"] ?></td>
                <td class="document">
                    <a href="/document.php?breed=<?= $parametrs["breeds"][$i]["id"] ?>">
                        <img src="/images/doc_icon.png" alt="<?= $parametrs["lang"][$_SESSION["lang"]]["name"] ?>" height="50">
                    </a>          
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
<?php } ?>
