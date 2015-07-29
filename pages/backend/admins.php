<div id="tabs">
<table class="table">
<tr class="top">
<th>Имя</th>                   
<th>Язык</th>                    
 </tr> 
 
 <?php               
 foreach ($parametrs["list"] as $list) {               
 foreach ($parametrs["language"] as $value) { 
 if ($value["id"]==$list["adm_lang"]){?> 
 <tr>                   
 <td><?= $list["adm_log"] ?></td>                       
 <td><?= $value["name"] ?></td>
 <td>
<a href="/ukc_admin_iku/admins/del/<?= $list["adm_id"] ?>">
<button type="Удалить" class="btn btn-danger">
 Удалить
</button>
</a>
 </td>
 </tr>
 <?php } } }  ?>
</table>              
</div>                
<div style="text-align: left;">
<a href="/ukc_admin_iku/add_admin">
<button>Добавить админа</button>
</a>
</div>         
       
    



