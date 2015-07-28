
<form name="login" method="post">
<p>Login:</p>
<input type="text" name="name"/>
<p>Password: </p>
<input type="text" name="password"/>
<br />
</form>
<br />
Select language:
<br />
<form method="get" name="drop_down_box">
<select name="lang_id" size="1">
<?php foreach ($parametrs["language"] as $value) { ?>
<option value=1><?= $value["name"] ?></option>
<?php } ?>
</select>
</form>