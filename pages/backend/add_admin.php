
<form name="login" method="post">
<p>Login:</p>
<input type="text" name="name"/>
<p>Password: </p>
<input type="text" name="password"/>
<br />
<br />
Select language:
<br />
<select name="lang_id" size="1">
<?php foreach ($parametrs["language"] as $value) { ?>
<option value=<?= $value["name"] ?>><?= $value["name"] ?></option>
<?php } ?>
</select>
<br />
<input name="" type="submit" value="Отправить"/>
</form>