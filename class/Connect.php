<?php

class Connect {

    //put your code here
    public static function conect($_host, $_user, $_password, $_database) {

        $mysqli = mysqli_connect($_host, $_user, $_password, $_database);
        if (mysqli_connect_errno())
            echo "Извените база данных временно недоступна";
        $mysqli->set_charset("utf8");
        
        $dbh = mysql_connect($_host, $_user, $_password) or die("Не могу соединиться с MySQL.");
        mysql_select_db($_database) or die("Не могу подключиться к базе.");
        mysql_query("SET CHARACTER SET utf8");
        
        return $mysqli;
    }

}

?>
