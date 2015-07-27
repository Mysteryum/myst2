<form method="post" action="/ukc_admin_iku/members/dsave/<?=$_GET["id"]?>" ENCTYPE="multipart/form-data">
    <table class="table-add-comission">
        <tr>
            <td>Документ (jpg, doc)</td>
            <td>
                <input type="file" name="path">
            </td>
        </tr>
        <tr>
            <td>Тип документа</td>
            <td>
                <select name="type">
                    <option value="1">Племенный (jpg)</option>
                    <option value="2">Регистрационный (doc)</option>
                </select>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <input type="submit" value="Добавить">
            </th>
        </tr>
    </table>
</form>