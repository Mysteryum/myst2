<?php
for ($i = 0; $i < count($parametrs["registration"]); $i++) {
    ?>
    <a href="/userfiles/registration/<?= $parametrs["registration"][$i]["path"] ?>" class="lbox">
        <img src="/userfiles/registration/<?= $parametrs["registration"][$i]["path"] ?>" class="registration">
    </a>
    <?php
}
?>