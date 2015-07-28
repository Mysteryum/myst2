<?php
if(isset($parametrs['error']))
	echo $parametrs['error'];
else 
	echo " ";
?>
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
<option value='0'>Выбрать</option>
<?php foreach ($parametrs["language"] as $value) { ?>
<option value=<?= $value["id"] ?>><?= $value["name"] ?></option>
<?php } ?>
</select>
<br />
<input name="" type="submit" value="Отправить"/>
</form>