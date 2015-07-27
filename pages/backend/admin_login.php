<form method="post" action="/ukc_admin_iku/">
    <table class="login-content" border=1>
        <?php
        if (isset($error)) {
            ?>
            <tr>
                <td colspan="2" class="login_error">{$error}</td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td>Login</td>                
            <td><input type="text" name="login"></td>
        </tr>
        <tr>
            <td>Password</td>             
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td style="text-align: center;" colspan="2">
                <input type=submit value="Login"
            </td>
        </tr>    
    </table>
</form>