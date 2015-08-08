<table class="content-table" style="width: 300px; margin: 0 auto;">
    <th><?= $lang->l("Племенный документы")?></th>
    <?php
    for ($i = 0; $i < count($parametrs["document"]); $i++) {
        if ($parametrs["document"][$i]["type"] == 1) {
            ?>
            <tr>
                <td>
                    <a href="/userfiles/member_document/<?= $parametrs["document"][$i]["path"] ?>" class="lbox">
                        <img src="/userfiles/member_document/<?= $parametrs["document"][$i]["path"] ?>" style="max-width: 120px;">    
                    </a>
                </td>
                <td>
                    <a href="/ukc_admin_iku/memberdocument/del/<?= $_GET["id"] ?>/<?= $parametrs["document"][$i]["id"] ?>"><?= $lang->l("Удалить")?></a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>
<table class="content-table" style="width: 300px; margin: 0 auto;">
    <th><?= $lang->l("Регистрационные документы")?></th>
    <?php
    for ($i = 0; $i < count($parametrs["document"]); $i++) {
        if ($parametrs["document"][$i]["type"] == 2) {
            ?>
            <tr>
                <td>
                    <a href="/userfiles/member_document/<?= $parametrs["document"][$i]["path"] ?>">                    
                        <img src="/images/doc_icon.png">    
                    </a>
                </td>
                <td>
                    <a href="/ukc_admin_iku/memberdocument/del/<?= $_GET["id"] ?>/<?= $parametrs["document"][$i]["id"] ?>"><?= $lang->l("Удалить")?></a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
</table>