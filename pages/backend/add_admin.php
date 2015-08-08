<?php
if(isset($parametrs['error']))
	echo $parametrs['error'];
else 
	echo " ";
?>

<form name="login" method="post" role="form">
<div class="form-group">
<p><label for="InputTitle"><?=$lang->l("Логин:")?></label></p>
<input type="text" name="name" class="form-control"/>
</div>
<div class="form-group">
<p><label for="InputTitle"><?=$lang->l("Пароль:")?></label></p>
<input type="text" name="password" class="form-control"/>
<br />
<br />
</div>
<div class="form-group">
<label for="InputTitle"><?=$lang->l("Выбрать язык")?></label>
<br />
<select name="lang_id" size="1" class="form-control">
<option value='0'><?=$lang->l("Выбрать")?></option>
<?php foreach ($parametrs["language"] as $value) { ?>
<option value=<?= $value["id"] ?>><?= $value["name"] ?></option>
<?php } ?>
</select>
</div>
<br />
<input name="" type="submit" value="<?=$lang->l("Отправить")?>"/>
<br />
</form>