<div id="tabs">
<table class="table">
<tr class="top">
<th><?=$lang->l("Логин")?></th>                   
<th><?= $lang->l("Язык") ?></th>                    
 </tr> 
 
 <?php               
 foreach ($parametrs["list"] as $list) {               
 foreach ($parametrs["language"] as $value) { 
 if ($value["id"]==$list["adm_lang"]){?> 
 <tr>
 <td><?= $list["adm_log"] ?></td>                       
 <td><img src="/userfiles/lang_flag/<?= $value["flag"] ?>"> <a><?= $value["name"] ?></a></td>
 <td>
<a href="/ukc_admin_iku/admins/del/<?= $list["adm_id"] ?>">
<button type="Удалить" class="btn btn-danger">
 <?=$lang->l("Удалить")?>
</button>
</a>
 </td>
 </tr>
 <?php } } }  ?>
</table>              
</div>

       
    



