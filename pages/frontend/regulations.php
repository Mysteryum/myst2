<table class="content-table" cellspacing="0">
    <tr>
        <th style="width: 300px;"><?=$lang->l("Название")?></th>
        <th><?=$lang->l("Документы")?></th>
    </tr>
    <?php
    foreach ($parametrs["provision"][$_SESSION["lang"]] as $value) {
        ?>
        <tr>
            <td><?= $value["name"] ?></td>
            <td class="document">
                <a href="/document.php?provision=<?= $value["provision_id"] ?>">
                    <img src="/images/doc_icon.png" alt="<?= $parametrs["lang"][$_SESSION["lang"]]["name"] ?>" height="50">
                </a>   
            </td>
        </tr>
        <?php
    }
    ?>
</table>