<table class="content-table" cellspacing="0">
    <tr>
        <th><?=$lang->l("Символ")?></th>
        <th><?=$lang->l("Порода")?></th>
        <th><?=$lang->l("Документы")?></th>
    </tr>
    <?php
    for ($i = 0; $i < count($parametrs["breeds"]); $i++) {
        ?>
        <tr>
            <td><?= $parametrs["breeds"][$i]["symbol"] ?></td>
            <td><?= $parametrs["breeds"][$i]["name"] ?></td>
            <td class="document">
                <?php
                for ($j = 0; $j < count($parametrs["breeds"][$i]["document"]); $j++) {
                    ?>
                    <a href="/userfiles/breeds/<?= $parametrs["breeds"][$i]["document"][$j]["path"] ?>">
                        <img src="/userfiles/lang_flag/<?= $parametrs["lang"][$parametrs["breeds"][$i]["document"][$j]["lang"]]["flag"] ?>" alt="<?= $parametrs["lang"][$parametrs["breeds"][$i]["document"][$j]["lang"]]["name"] ?>">
                    </a> 
                    <?php
                }
                ?>            
            </td>
        </tr>
        <?php
    }
    ?>
</table>