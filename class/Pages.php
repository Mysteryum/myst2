<?php

class Pages {

    private $_mysqli;

    const DOCUMENT_PROVISION = 1;
    const DOCUMENT_BREED = 2;

    public function __construct(mysqli $mysqli = null) {
        $this->_mysqli = $mysqli;
    }
    
    public function getExpertCoountry() {
        $result = mysql_query("
            SELECT `iku_country`.*
            FROM `iku_country` INNER JOIN `iku_expert`  ON `iku_country`.`id_country`=`iku_expert`.`country`
            GROUP BY `iku_country`.`id_country`
            ");
        $mas = array();
        $i = 0;
        while ($res = mysql_fetch_assoc($result)) {
            $mas[] = $res;
            $i++;
        }
        return $mas;
    }

    public function addBreed() {

        $_POST["group"] = (int) $_POST["group"];
        $_POST["kode"] = mysql_escape_string($_POST["kode"]);
        $_POST["ang_name"] = mysql_escape_string($_POST["ang_name"]);

        mysql_query(" 
                INSERT INTO `iku_breed_dogs` 
                SET 
                    `group`='{$_POST["group"]}', `kode`='{$_POST["kode"]}', `ang_name`='{$_POST["ang_name"]}'
                ") or DIE(mysql_error());
        $id = mysql_insert_id();
        foreach ($_POST["symbol"] as $key => $value) {
            $key = (int) $key;

            if ($_FILES['document']["name"][$key]) {
                if ($member_desc[$key][0]['document']) {
                    unlink("../userfiles/provision/{$member_desc[$key][0]['document']}");
                }
                $apend2 = date('YmdHis') . rand(100, 1000);
                $uploaddir = '../userfiles/provision/';
                $raz = explode(".", $_FILES["document"]["name"][$key]);
                $raz = strtolower($raz[count($raz) - 1]);
                $apend2 = "$apend2.$raz";
                $uploadfile = "$uploaddir$apend2";
                move_uploaded_file($_FILES["document"]['tmp_name'][$key], $uploadfile);
            } else {
                $apend2 = '';
            }

            if ($_POST["symbol"][$key] == "") {
                $_POST["symbol"][$key] = $_POST["symbol"][1];
            }
            if ($_POST["rus_name"][$key] == "") {
                $_POST["rus_name"][$key] = $_POST["rus_name"][1];
            }

            if ($_POST["another_name"][$key] == "") {
                $_POST["another_name"][$key] = $_POST["another_name"][1];
            }
            if ($_POST["name"][$key] == "") {
                $_POST["name"][$key] = $_POST["name"][1];
            }
            $symbol = mysql_escape_string($_POST["symbol"][$key]);
            $rus_name = mysql_escape_string($_POST["rus_name"][$key]);
            $another_name = mysql_escape_string($_POST["another_name"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);

            mysql_query("
                        INSERT INTO `iku_breed_dogs_desc` 
                        SET 
                            `symbol`='$symbol', `rus_name`='$rus_name', 
                            `another_name`='$another_name', `name`='$name', `document`='$apend2', 
                            `breed_id`='$id', `lang_id`='$key'") or DIE(mysql_error());
        }
    }

    public function editBreed($id) {
        $member = $this->getMember($id);
        $_POST["group"] = (int) $_POST["group"];
        $_POST["kode"] = mysql_escape_string($_POST["kode"]);
        $_POST["ang_name"] = mysql_escape_string($_POST["ang_name"]);

        mysql_query(" 
                UPDATE `iku_breed_dogs` 
                SET 
                    `group`='{$_POST["group"]}', `kode`='{$_POST["kode"]}', `ang_name`='{$_POST["ang_name"]}'
                WHERE `id`='$id'");
        foreach ($_POST["symbol"] as $key => $value) {
            $key = (int) $key;

            $member_desc = $this->getRecord('iku_breed_dogs_desc', "`breed_id`='$id' AND `lang_id`='$key'");

            if (!isset($member_desc[$key][0]['document'])) {
                $member_desc[$key][0]['document'] = '';
            }
            if ($_FILES['document']["name"][$key]) {
                if ($member_desc[$key][0]['document']) {
                    unlink("../userfiles/provision/{$member_desc[$key][0]['document']}");
                }
                $apend2 = date('YmdHis') . rand(100, 1000);
                $uploaddir = '../userfiles/provision/';
                $raz = explode(".", $_FILES["document"]["name"][$key]);
                $raz = strtolower($raz[count($raz) - 1]);
                $apend2 = "$apend2.$raz";
                $uploadfile = "$uploaddir$apend2";
                move_uploaded_file($_FILES["document"]['tmp_name'][$key], $uploadfile);
            } else {
                $apend2 = $member_desc[$key][0]['document'];
            }

            if ($_POST["symbol"][$key] == "") {
                $_POST["symbol"][$key] = $_POST["symbol"][1];
            }
            if ($_POST["rus_name"][$key] == "") {
                $_POST["rus_name"][$key] = $_POST["rus_name"][1];
            }

            if ($_POST["another_name"][$key] == "") {
                $_POST["another_name"][$key] = $_POST["another_name"][1];
            }
            if ($_POST["name"][$key] == "") {
                $_POST["name"][$key] = $_POST["name"][1];
            }
            $symbol = mysql_escape_string($_POST["symbol"][$key]);
            $rus_name = mysql_escape_string($_POST["rus_name"][$key]);
            $another_name = mysql_escape_string($_POST["another_name"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);

            if (!empty($member_desc[$key])) {
                mysql_query("   
                            UPDATE `iku_breed_dogs_desc` 
                            SET 
                                `symbol`='$symbol', `rus_name`='$rus_name', 
                                `another_name`='$another_name', `name`='$name', `document`='$apend2'
                            WHERE `breed_id`='$id' AND `lang_id`='$key'") or DIE(mysql_error());
            } else {
                mysql_query("
                        INSERT INTO `iku_breed_dogs_desc` 
                        SET 
                            `symbol`='$symbol', `rus_name`='$rus_name', 
                            `another_name`='$another_name', `name`='$name', `document`='$apend2', 
                            `breed_id`='$id', `lang_id`='$key'") or DIE(mysql_error());
            }
        }
    }

    public function getBreed($id = null, $group = null, $symbol = null) {
        global $lang;
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } elseif (($group != null)||($symbol!=null)) {
            $wh_symb = "";
            $wh_grp = "";
                $symbol = mysql_escape_string($symbol);
                
            if (($symbol!=null)&&(($symbol!='0'))) {
                $wh_symb = " `iku_breed_dogs`.`symbol`='$symbol' ";                
            }
            
            if (($group!=null)&&($group!=0)) {
                $group = (int)$group;
                if ($wh_symb != "") {
                    $wh_grp = " AND ";
                }
                $wh_grp .= " `group`='$group' ";
            }
            
            $wh = " $wh_symb $wh_grp ORDER BY `iku_breed_dogs`.`kode` ASC ";
        } else {
            $wh = "";
        }
        
//        echo $wh;
//        DIE();
        $managments = $this->getRecord('iku_breed_dogs', $wh);

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            switch ($value["group"]) {
                case 1:
                    $mas[$i]["label_group"] = $lang->l("I группа");
                    break;
                case 2:
                    $mas[$i]["label_group"] = $lang->l("II группа");
                    break;
                case 3:
                    $mas[$i]["label_group"] = $lang->l("III группа");
                    break;
                case 4:
                    $mas[$i]["label_group"] = $lang->l("IV группа");
                    break;
                case 5:
                    $mas[$i]["label_group"] = $lang->l("V группа");
                    break;
                default :
                    $mas[$i]["label_group"] = "";
                    break;
            }
            $mas[$i]["desc"] = $this->getRecord('iku_breed_dogs_desc', 'breed_id=' . $value["id"]);
            $i++;
        }
        return $mas;
    }

    public function getBreedForUser($symbol) {
        $symbol = mysql_escape_string($symbol);
        $result = $this->getRecord("iku_breed_dogs", " `symbol`='$symbol' ORDER BY `rus_name` ASC ");
        return $result;
    }

    public function addLastExebition() {

        mysql_query("INSERT INTO `iku_exhibition_last` SET `date`=NOW()");

        $id = mysql_insert_id();
        foreach ($_POST["content"] as $key => $value) {
            if ($_POST["content"][$key] == "") {
                $_POST["content"][$key] = $_POST["content"][1];
            }
            $key = (int) $key;
            $content = mysql_escape_string($_POST["content"][$key]);
            mysql_query("INSERT INTO `iku_exhibition_last_desc` SET `content`='$content', `lang_id`='$key', `last_exebition_id`='$id'") or DIE(mysql_error());
        }
    }

    public function editLastExebition($id) {

        $id = (int) $id;
        foreach ($_POST["content"] as $key => $value) {
            if ($_POST["content"][$key] == "") {
                $_POST["content"][$key] = $_POST["content"][1];
            }
            $key = (int) $key;
            $content = mysql_escape_string($_POST["content"][$key]);
            $mang_desc = $this->getRecord('iku_exhibition_last_desc', "`last_exebition_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_exhibition_last_desc` SET `content`='$content' WHERE `lang_id`='$key' AND `last_exebition_id`='$id'");
            } else {
                mysql_query("INSERT INTO `iku_exhibition_last_desc` SET `content`='$content', `lang_id`='$key', `last_exebition_id`='$id'");
            }
        }
    }

    public function getLastExebition($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } else {
            $wh = "";
        }
        $managments = $this->getRecord('iku_exhibition_last', $wh);

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["desc"] = $this->getRecord('iku_exhibition_last_desc', 'last_exebition_id=' . $value["id"]);
            $i++;
        }
        return $mas;
    }

    public function editExebition($id) {
        $_POST["country_id"] = (int) $_POST["country_id"];
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        $_POST["syte"] = mysql_escape_string($_POST["syte"]);
        $_POST["data"] = mysql_escape_string($_POST["data"]);

        $id = (int) $id;
        mysql_query("
                UPDATE `iku_exhibition` 
                SET 
                    `data`='{$_POST["data"]}',
                    `mail`='{$_POST["mail"]}',
                    `phone`='{$_POST["phone"]}',
                    `syte`='{$_POST["syte"]}',
                    `country_id`='{$_POST["country_id"]}'
                WHERE `id`='$id'");
        foreach ($_POST["place"] as $key => $value) {
            if ($_POST["place"][$key] == "") {
                $_POST["place"][$key] = $_POST["place"][1];
            }
            if ($_POST["name_exhibition"][$key] == "") {
                $_POST["name_exhibition"][$key] = $_POST["name_exhibition"][1];
            }
            if ($_POST["status"][$key] == "") {
                $_POST["status"][$key] = $_POST["status"][1];
            }
            if ($_POST["name_club"][$key] == "") {
                $_POST["name_club"][$key] = $_POST["name_club"][1];
            }
            $place = mysql_escape_string($_POST["place"][$key]);
            $name_exhibition = mysql_escape_string($_POST["name_exhibition"][$key]);
            $status = mysql_escape_string($_POST["status"][$key]);
            $name_club = mysql_escape_string($_POST["name_club"][$key]);

            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_exhibition_desc', "`exebition_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_exhibition_desc` 
                      SET `place`='$place', `name_exhibition`='$name_exhibition', 
                      `status`='$status', `name_club`='$name_club'
                    WHERE `exebition_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_exhibition_desc` 
                      SET `place`='$place', `name_exhibition`='$name_exhibition', 
                      `status`='$status', `name_club`='$name_club',`exebition_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function addExebition() {
        $_POST["country_id"] = (int) $_POST["country_id"];
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        $_POST["syte"] = mysql_escape_string($_POST["syte"]);
        $_POST["data"] = mysql_escape_string($_POST["data"]);


        mysql_query("
                INSERT INTO `iku_exhibition` 
                SET 
                    `data`='{$_POST["data"]}',
                    `mail`='{$_POST["mail"]}',
                    `phone`='{$_POST["phone"]}',
                    `syte`='{$_POST["syte"]}',
                    `country_id`='{$_POST["country_id"]}'");
        $id = mysql_insert_id();
        foreach ($_POST["place"] as $key => $value) {
            if ($_POST["place"][$key] == "") {
                $_POST["place"][$key] = $_POST["place"][1];
            }
            if ($_POST["name_exhibition"][$key] == "") {
                $_POST["name_exhibition"][$key] = $_POST["name_exhibition"][1];
            }
            if ($_POST["status"][$key] == "") {
                $_POST["status"][$key] = $_POST["status"][1];
            }
            if ($_POST["name_club"][$key] == "") {
                $_POST["name_club"][$key] = $_POST["name_club"][1];
            }
            $place = mysql_escape_string($_POST["place"][$key]);
            $name_exhibition = mysql_escape_string($_POST["name_exhibition"][$key]);
            $status = mysql_escape_string($_POST["status"][$key]);
            $name_club = mysql_escape_string($_POST["name_club"][$key]);

            $key = (int) $key;
            mysql_query("INSERT INTO `iku_exhibition_desc` 
                      SET `place`='$place', `name_exhibition`='$name_exhibition', 
                      `status`='$status', `name_club`='$name_club',`exebition_id`='$id', `lang_id`='$key'");
        }
    }

    public function getExebition($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } else {
            $wh = " 1 ";
        }
        $managments = $this->getRecord('iku_exhibition', $wh." ORDER BY `iku_exhibition`.`data` DESC ");

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["country_name"] = $this->getCoountryName($value['country_id']);
            $mas[$i]["desc"] = $this->getRecord('iku_exhibition_desc', 'exebition_id=' . $value["id"]);
            $i++;
        }
        return $mas;
    }

    public function delMemDocument($id) {
        $ducoment = $this->getMemeberDocument(0, $id);
        $this->delRecord("iku_member_document", $id);
        unlink('../userfiles/member_document/' . $ducoment[0]["path"]);
    }

    public function getMember($id = null, $partner = -1) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " iku_members.`id`='$id'";
        } else {
            $wh = " 1 ";
        }
        if($partner!=-1){
            $wh .= " AND iku_members.`partner`='$partner'";
        }
        $managments = $this->getRecord(' 
                 iku_members INNER JOIN `iku_members_desc` ON iku_members.id=iku_members_desc.member_id ', $wh." 
                GROUP BY iku_members.id 
                ORDER BY `iku_members_desc`.`country` ASC 
                ", "iku_members.*");

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["desc"] = $this->getRecord('iku_members_desc', "member_id='{$value["id"]}'");
            $i++;
        }
        return $mas;
    }

    public function getMemeberDocument($mid, $id = null) {
        if ($id != null) {
            $wh = "OR `id`=$id";
        } else {
            $wh = "";
        }
        $stmt = $this->_mysqli->prepare("SELECT `id`, `path`, `type` FROM `iku_member_document` WHERE `mid`=? $wh");
        $stmt->bind_param("i", $mid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $path, $type);
        $mas = array();
        $i = 0;
        while ($stmt->fetch()) {
            $mas[$i]["id"] = $id;
            $mas[$i]["path"] = $path;
            $mas[$i]["type"] = $type;
            $i++;
        }
        return $mas;
    }

    public function addMemberDocument($file, $type, $id) {
        if ($file["path"]["name"]) {
            $apend = date('YmdHis') . rand(100, 1000);
            $uploaddir = '../userfiles/member_document/';
            $raz = explode(".", $file["path"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($file["path"]['tmp_name'], $uploadfile);
        }
        $stmt = $this->_mysqli->prepare("INSERT INTO `iku_member_document`(`mid`, `path`, `type`) VALUES (?,?,?)");
        $stmt->bind_param("isi", $id, $apend, $type);
        $stmt->execute();
        $stmt->close();
    }

    public function addMembers() {
        if ($_FILES["flag"]["name"]) {
            $apend = date('YmdHis') . rand(100, 1000);
            $uploaddir = '../userfiles/member_flag/';
            $raz = explode(".", $_FILES["flag"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES["flag"]['tmp_name'], $uploadfile);
        } else {
            $apend = $member[0]["flag"];
        }

        if (isset($_POST["partner"])) {
            $_POST["partner"] = 1;
        } else {
            $_POST["partner"] = 0;
        }
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        mysql_query(" 
                INSERT INTO `iku_members` 
                SET 
                    `flag`='$apend', `partner`='{$_POST["partner"]}', 
                    `mail`='{$_POST["mail"]}', `phone` ='{$_POST["phone"]}'
                ");
        $id = mysql_insert_id();
        foreach ($_POST["country"] as $key => $value) {
            $key = (int) $key;

            if ($_FILES['dogovor_file']["name"][$key]) {
                $apend2 = date('YmdHis') . rand(100, 1000);
                $uploaddir = '../userfiles/member_document/';
                $raz = explode(".", $_FILES["dogovor_file"]["name"][$key]);
                $raz = strtolower($raz[count($raz) - 1]);
                $apend2 = "$apend2.$raz";
                $uploadfile = "$uploaddir$apend2";
                move_uploaded_file($_FILES["dogovor_file"]['tmp_name'][$key], $uploadfile);
            } else {
                $apend2 = '';
            }

            if ($_POST["country"][$key] == "") {
                $_POST["country"][$key] = $_POST["country"][1];
            }
            if ($_POST["name_org"][$key] == "") {
                $_POST["name_org"][$key] = $_POST["name_org"][1];
            }
            if ($_POST["menedger"][$key] == "") {
                $_POST["menedger"][$key] = $_POST["menedger"][1];
            }
            if ($_POST["adrres"][$key] == "") {
                $_POST["adrres"][$key] = $_POST["adrres"][1];
            }
            if ($_POST["contract"][$key] == "") {
                $_POST["contract"][$key] = $_POST["contract"][1];
            }
            $country = mysql_escape_string($_POST["country"][$key]);
            $name_org = mysql_escape_string($_POST["name_org"][$key]);
            $menedger = mysql_escape_string($_POST["menedger"][$key]);
            $adrres = mysql_escape_string($_POST["adrres"][$key]);
            $contract = mysql_escape_string($_POST["contract"][$key]);

            mysql_query("
                        INSERT INTO `iku_members_desc` 
                        SET 
                            `country`='$country', `name_org`='$name_org', 
                            `menedger`='$menedger', `adrres`='$adrres', 
                            `contract`='$contract', `contract_file`='$apend2', 
                            `member_id`='$id', `lang_id`='$key'") or DIE(mysql_error());
        }
    }

    public function editMember($id) {

        $member = $this->getMember($id);
        if ($_FILES["flag"]["name"]) {
            if ($member[0]["flag"]) {
                unlink("../userfiles/member_flag/{$member[0]["flag"]}");
            }
            $apend = date('YmdHis') . rand(100, 1000);
            $uploaddir = '../userfiles/member_flag/';
            $raz = explode(".", $_FILES["flag"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES["flag"]['tmp_name'], $uploadfile);
        } else {
            $apend = $member[0]["flag"];
        }

        if (isset($_POST["partner"])) {
            $_POST["partner"] = 1;
        } else {
            $_POST["partner"] = 0;
        }
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        mysql_query(" 
                UPDATE `iku_members` 
                SET 
                    `flag`='$apend', `partner`='{$_POST["partner"]}', 
                    `mail`='{$_POST["mail"]}', `phone` ='{$_POST["phone"]}'
                WHERE `id`='$id'");
        foreach ($_POST["country"] as $key => $value) {
            $key = (int) $key;

            $member_desc = $this->getRecord('iku_members_desc', "`member_id`='$id' AND `lang_id`='$key'");
            if (!isset($member_desc[$key][0]['contract_file'])) {
                $member_desc[$key][0]['contract_file'] = '';
            }
            if ($_FILES['dogovor_file']["name"][$key]) {
                if ($member_desc[$key][0]['contract_file']) {
                    unlink("../userfiles/member_document/{$member_desc[$key][0]['contract_file']}");
                }
                $apend2 = date('YmdHis') . rand(100, 1000);
                $uploaddir = '../userfiles/member_document/';
                $raz = explode(".", $_FILES["dogovor_file"]["name"][$key]);
                $raz = strtolower($raz[count($raz) - 1]);
                $apend2 = "$apend2.$raz";
                $uploadfile = "$uploaddir$apend2";
                move_uploaded_file($_FILES["dogovor_file"]['tmp_name'][$key], $uploadfile);
            } else {
                $apend2 = $member_desc[$key][0]['contract_file'];
            }

            if ($_POST["country"][$key] == "") {
                $_POST["country"][$key] = $_POST["country"][1];
            }
            if ($_POST["name_org"][$key] == "") {
                $_POST["name_org"][$key] = $_POST["name_org"][1];
            }
            if ($_POST["menedger"][$key] == "") {
                $_POST["menedger"][$key] = $_POST["menedger"][1];
            }
            if ($_POST["adrres"][$key] == "") {
                $_POST["adrres"][$key] = $_POST["adrres"][1];
            }
            if ($_POST["contract"][$key] == "") {
                $_POST["contract"][$key] = $_POST["contract"][1];
            }
            $country = mysql_escape_string($_POST["country"][$key]);
            $name_org = mysql_escape_string($_POST["name_org"][$key]);
            $menedger = mysql_escape_string($_POST["menedger"][$key]);
            $adrres = mysql_escape_string($_POST["adrres"][$key]);
            $contract = mysql_escape_string($_POST["contract"][$key]);

            if (!empty($member_desc[$key])) {
                mysql_query("   
                            UPDATE `iku_members_desc` 
                            SET 
                                `country`='$country', `name_org`='$name_org', 
                                `menedger`='$menedger', `adrres`='$adrres', 
                                `contract`='$contract', `contract_file`='$apend2' 
                            WHERE `member_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("
                        INSERT INTO `iku_members_desc` 
                        SET 
                            `country`='$country', `name_org`='$name_org', 
                            `menedger`='$menedger', `adrres`='$adrres', 
                            `contract`='$contract', `contract_file`='$apend2', 
                            `member_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function addNews($name, $tittle, $content) {
        mysql_query("INSERT INTO `iku_news` SET `date`=NOW()");
        $id = mysql_insert_id();
        foreach ($_POST["content"] as $key => $value) {
            if ($_POST["content"][$key] == "") {
                $_POST["content"][$key] = $_POST["content"][1];
            }
            if ($_POST["name"][$key] == "") {
                $_POST["name"][$key] = $_POST["name"][1];
            }
            $content = mysql_escape_string($_POST["content"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);

            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_news_desc', "`news_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_news_desc` 
                      SET `name`='$name', `content`='$content'
                    WHERE `news_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_news_desc` 
                      SET `name`='$name', `content`='$content',`news_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function editNews($id) {
        foreach ($_POST["content"] as $key => $value) {
            if ($_POST["content"][$key] == "") {
                $_POST["content"][$key] = $_POST["content"][1];
            }
            if ($_POST["name"][$key] == "") {
                $_POST["name"][$key] = $_POST["name"][1];
            }
            $content = mysql_escape_string($_POST["content"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);

            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_news_desc', "`news_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_news_desc` 
                      SET `name`='$name', `content`='$content'
                    WHERE `news_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_news_desc` 
                      SET `name`='$name', `content`='$content',`news_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function getNews($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } else {
            $wh = " 1 ";
        }
        $managments = $this->getRecord('iku_news', $wh . " ORDER BY `iku_news`.`date` DESC");

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["desc"] = $this->getRecord('iku_news_desc', 'news_id=' . $value["id"]);
            $i++;
        }
        return $mas;
    }

    public function addCirculars() {
        $_POST["chislo"] = mysql_escape_string($_POST["chislo"]);
        $_POST["numer"] = mysql_escape_string($_POST["numer"]);


        mysql_query("INSERT INTO `iku_circulars` SET `chislo`='{$_POST["chislo"]}',`numer`='{$_POST["numer"]}'");
        $id = mysql_insert_id();
        foreach ($_POST["content"] as $key => $value) {
            if ($_POST["content"][$key] == "") {
                $_POST["content"][$key] = $_POST["content"][1];
            }
            if ($_POST["name"][$key] == "") {
                $_POST["name"][$key] = $_POST["name"][1];
            }
            $content = mysql_escape_string($_POST["content"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);

            $key = (int) $key;
            mysql_query("INSERT INTO `iku_circulars_desc` 
                      SET `name`='$name', `content`='$content',`circular_id`='$id', `lang_id`='$key'");
        }
    }

    public function editCirculars($id) {
        $_POST["chislo"] = mysql_escape_string($_POST["chislo"]);
        $_POST["numer"] = mysql_escape_string($_POST["numer"]);

        $id = (int) $id;
        mysql_query("UPDATE `iku_circulars` SET `chislo`='{$_POST["chislo"]}',`numer`='{$_POST["numer"]}' WHERE `id`='$id'");
        foreach ($_POST["content"] as $key => $value) {
            if ($_POST["content"][$key] == "") {
                $_POST["content"][$key] = $_POST["content"][1];
            }
            if ($_POST["name"][$key] == "") {
                $_POST["name"][$key] = $_POST["name"][1];
            }
            $content = mysql_escape_string($_POST["content"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);

            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_circulars_desc', "`circular_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_circulars_desc` 
                      SET `name`='$name', `content`='$content'
                    WHERE `circular_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_circulars_desc` 
                      SET `name`='$name', `content`='$content',`circular_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function getCirculars($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } else {
            $wh = "";
        }
        $managments = $this->getRecord('iku_circulars', $wh);

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["desc"] = $this->getRecord('iku_circulars_desc', 'circular_id=' . $value["id"]);
            $i++;
        }
        return $mas;
    }

    public function getProvision($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `provision_id`='$id'";
        } else {
            $wh = " 1 ";
        }
        $result = $this->getRecord('iku_provisions', $wh . " ORDER BY `provision_id`");
        return $result;
    }

    public function addProvision() {
        $result = mysql_query("SELECT MAX(`provision_id`) AS `id` FROM `iku_provisions`");
        $res = mysql_fetch_assoc($result);
        if (isset($res["id"])) {
            $id = $res["id"] + 1;
        } else {
            $id = 1;
        }
        foreach ($_POST["name"] as $key => $value) {
            if ($value == "") {
                $value = $_POST["name"][1];
            }
            $key = (int) $key;
            mysql_query("INSERT INTO `iku_provisions` SET `name`='{$value}', `provision_id`='$id', `lang_id`='$key'");
        }
        $this->updateDocument($id, self::DOCUMENT_PROVISION, $_FILES);
    }

    public function delProvision($id) {
        $id = (int) $id;
        $provisions = $this->getRecord("iku_provisions", "`provision_id`='$id'");
        foreach ($provisions as $value) {
            $value = $value[0];
            if ($value["document"]) {
                unlink("../userfiles/provision/" . $value["document"]);
            }
        }
        mysql_query("DELETE FROM `iku_provisions` WHERE `provision_id`='$id'");
    }

    public function delDocument($id, $table, $type) {
        $this->delRecord($table, $id);
        $document = $this->getDocument($id, $type);
        for ($i = 0; $i < count($document); $i++) {
            unlink("../userfiles/provision/" . $document[$i]["path"]);
            $this->delRecord($table, $document[$i]["id"]);
        }
    }

    public function editProvision($id) {
        foreach ($_POST["name"] as $key => $value) {
            if ($value == "") {
                $value = $_POST["name"][1];
            }
            $key = (int) $key;
            $provision = $this->getRecord("iku_provisions", "`provision_id`='$id' AND `lang_id`='$key'");

            if (isset($provision[$key])) {
                mysql_query("UPDATE `iku_provisions` SET `name`='{$value}' WHERE `provision_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_provisions` SET `name`='{$value}', `provision_id`='$id', `lang_id`='$key'");
            }
        }
        $this->updateDocument($id, self::DOCUMENT_PROVISION, $_FILES);
    }

    public function getExpert($id = null, $country = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `iku_expert`.`id`='$id'";
        } elseif ($country != null) {
            $id = (int) $country;
            $wh = " `iku_expert`.`country`='$id'";
        } else {
            $wh = "";
        }
        $managments = $this->getRecord('iku_expert', $wh);

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["country_name"] = $this->getCoountryName($value["country"]);
            $managments_desc = $this->getRecord('iku_expert_desc', 'expert_id=' . $value["id"]);
            $mas[$i]["desc"] = $managments_desc;
            $i++;
        }
        return $mas;
    }

    public function addExpert() {
        $country = (int) $_POST["country"];
        if ($country == 0) {
            return "Выберите страну";
        }
        if ($_FILES["photo"]['tmp_name'] != "") {
            $apend = date('YmdHis') . rand(100, 1000);
            $uploaddir = '../userfiles/expert/';
            $raz = explode(".", $_FILES["photo"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES["photo"]['tmp_name'], $uploadfile);
        } else {
            $apend = "";
        }
        mysql_query("INSERT INTO `iku_expert` SET `photo`='$apend', `country`='$country'");
        $id = (int) mysql_insert_id();
        foreach ($_POST["name"] as $key => $value) {
            $name = mysql_escape_string($_POST["name"][$key]);
            $group = mysql_escape_string($_POST["group"][$key]);

            $key = (int) $key;

            mysql_query("INSERT INTO `iku_expert_desc` 
                      SET `name`='$name', `group`='$group', `expert_id`='$id', `lang_id`='$key'") or DIE(mysql_error());
        }
        
        return false;
    }

    public function editExpert($id) {
        $_POST["country"] = (int) $_POST["country"];
        $expert = $this->getExpert($id);
        if ($_FILES["photo"]['tmp_name'] != "") {
            $uploaddir = '../userfiles/expert/';
            if (is_file($uploaddir . $expert[0]["photo"])) {
                unlink($uploaddir . $expert[0]["photo"]);
            }
            $apend = date('YmdHis') . rand(100, 1000);
            $raz = explode(".", $_FILES["photo"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($_FILES["photo"]['tmp_name'], $uploadfile);
        } else {
            $apend = $expert[0]["photo"];
        }
        $id = (int) $id;
        mysql_query("UPDATE `iku_expert` SET `photo`='$apend', `country`='{$_POST["country"]}' WHERE `id`='$id'");
        foreach ($_POST["name"] as $key => $value) {
            $name = mysql_escape_string($_POST["name"][$key]);
            $group = mysql_escape_string($_POST["group"][$key]);

            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_expert_desc', "`expert_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_expert_desc` 
                      SET `name`='$name', `group`='$group' 
                    WHERE `expert_id`='$id' AND `lang_id`='$key'") or DIE(mysql_error());
            } else {
                mysql_query("INSERT INTO `iku_expert_desc` 
                      SET `name`='$name', `group`='$group', `expert_id`='$id', `lang_id`='$key'") or DIE(mysql_error());
            }
        }
        return false;
    }

    public function addMenedgment() {
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["country_id"] = (int) $_POST["country_id"];

        mysql_query("INSERT INTO `iku_management` SET `mail`='{$_POST["mail"]}',`phone`='{$_POST["phone"]}', `country_id`='{$_POST["country_id"]}'");

        $id = mysql_insert_id();
        foreach ($_POST["post"] as $key => $value) {
            $post = mysql_escape_string($_POST["post"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);
            $country = mysql_escape_string($_POST["country"][$key]);
            $adrres = mysql_escape_string($_POST["adrres"][$key]);
            if ($post == "") {
                $post = $_POST["post"][1];
            }
            if ($name == "") {
                $name = $_POST["name"][1];
            }
            if ($country == "") {
                $country = $_POST["country"][1];
            }
            if ($adrres == "") {
                $adrres = $_POST["adrres"][1];
            }

            $key = (int) $key;
            mysql_query("INSERT INTO `iku_management_desc` SET `post`='$post', `name`='$name', `country`='$country', `adrres`='$adrres', `manag_id`='$id', `lang_id`='$key'");
        }
    }

    public function editMenedgment($id) {
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["country_id"] = (int) $_POST["country_id"];
        $id = (int) $id;
        mysql_query("UPDATE `iku_management` SET `mail`='{$_POST["mail"]}',`phone`='{$_POST["phone"]}', `country_id`='{$_POST["country_id"]}' WHERE `id`='$id'");
        foreach ($_POST["post"] as $key => $value) {
            $post = mysql_escape_string($_POST["post"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);
            $country = mysql_escape_string($_POST["country"][$key]);
            $adrres = mysql_escape_string($_POST["adrres"][$key]);
            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_management_desc', "`manag_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("UPDATE `iku_management_desc` 
                      SET `post`='$post', `name`='$name', `country`='$country', `adrres`='$adrres' 
                    WHERE `manag_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_management_desc` 
                      SET `post`='$post', `name`='$name', `country`='$country', `adrres`='$adrres', `manag_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function getMenedgment($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } else {
            $wh = "";
        }
        $managments = $this->getRecord('iku_management', $wh);

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["country_name"] = $this->getCoountryName($value["country_id"]);

            $managments_desc = $this->getRecord('iku_management_desc', 'manag_id=' . $value["id"]);
            $mas[$i]["desc"] = $managments_desc;
            $i++;
        }
        return $mas;
    }

    public function addComission() {
        $_POST["member"] = (int) $_POST["member"];
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["syte"] = mysql_escape_string($_POST["syte"]);
        $_POST["country_id"] = (int) $_POST["country_id"];
        mysql_query("INSERT INTO `iku_comission` SET 
                `mail`='{$_POST["mail"]}',`phone`='{$_POST["phone"]}', `country_id`='{$_POST["country_id"]}' 
                , `syte`='{$_POST["syte"]}', `type_member`='{$_POST["member"]}'");
        $id = mysql_insert_id();
        foreach ($_POST["type"] as $key => $value) {

            $type = mysql_escape_string($_POST["type"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);
            $country = mysql_escape_string($_POST["country"][$key]);
            $adrres = mysql_escape_string($_POST["adrres"][$key]);
            $key = (int) $key;
            if ($type == "") {
                $post = $_POST["type"][1];
            }
            if ($name == "") {
                $name = $_POST["name"][1];
            }
            if ($country == "") {
                $country = $_POST["country"][1];
            }
            if ($adrres == "") {
                $adrres = $_POST["adrres"][1];
            }
            mysql_query("INSERT INTO `iku_comission_description` 
                      SET `name`='$name', `country`='$country', 
                        `adrres`='$adrres', `type`='$type',
                        `comission_id`='$id', `lang_id`='$key'");
        }
    }

    public function getComission($id = null) {
        global $lang;
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id`='$id'";
        } else {
            $wh = "";
        }
        $managments = $this->getRecord('iku_comission', $wh);

        $mas = array();
        $i = 0;
        foreach ($managments as $value) {
            $mas[$i] = $value;
            $mas[$i]["country_name"] = $this->getCoountryName($value["country_id"]);
            switch ($value["type_member"]) {
                case 1:
                    $mas[$i]["member"] = $lang->l("Председатель комиссии");
                    break;
                case 2:
                    $mas[$i]["member"] = $lang->l("Член комиссии");
                    break;
                default :
                    $mas[$i]["member"] = "";
                    break;
            }
            $managments_desc = $this->getRecord('iku_comission_description', 'comission_id=' . $value["id"]);
            $mas[$i]["desc"] = $managments_desc;
            $i++;
        }
        return $mas;
    }

    public function editComission($id) {
        $_POST["member"] = (int) $_POST["member"];
        $_POST["mail"] = mysql_escape_string($_POST["mail"]);
        $_POST["phone"] = mysql_escape_string($_POST["phone"]);
        $_POST["syte"] = mysql_escape_string($_POST["syte"]);
        $_POST["country_id"] = (int) $_POST["country_id"];
        $id = (int) $id;
        mysql_query("UPDATE `iku_comission` SET 
                `mail`='{$_POST["mail"]}',`phone`='{$_POST["phone"]}', `country_id`='{$_POST["country_id"]}',
                 `syte`='{$_POST["syte"]}', `type_member`='{$_POST["member"]}'
                WHERE `id`='$id'");
        foreach ($_POST["type"] as $key => $value) {
            $type = mysql_escape_string($_POST["type"][$key]);
            $name = mysql_escape_string($_POST["name"][$key]);
            $country = mysql_escape_string($_POST["country"][$key]);
            $adrres = mysql_escape_string($_POST["adrres"][$key]);
            $key = (int) $key;
            $mang_desc = $this->getRecord('iku_comission_description', "`comission_id`='$id' AND `lang_id`='$key'");
            if (!empty($mang_desc)) {
                mysql_query("
                    UPDATE `iku_comission_description` 
                    SET 
                        `name`='$name', `country`='$country', 
                        `adrres`='$adrres', `type`='$type'                            
                    WHERE `comission_id`='$id' AND `lang_id`='$key'");
            } else {
                mysql_query("INSERT INTO `iku_comission_description` 
                      SET `name`='$name', `country`='$country', 
                        `adrres`='$adrres', `type`='$type',
                        `comission_id`='$id', `lang_id`='$key'");
            }
        }
    }

    public function delRecord($table, $id) {
        $id = (int) $id;
        mysql_query("DELETE FROM `$table` WHERE `id`='$id'");
    }

    public function addGaleryItem($id, $file) {
        $apend = date('YmdHis') . rand(100, 1000);
        $uploaddir = '../userfiles/galery/';
        $raz = explode(".", $file["galery"]["name"]);
        $raz = strtolower($raz[count($raz) - 1]);
        $apend = "$apend.$raz";
        $uploadfile = "$uploaddir$apend";
        move_uploaded_file($file["galery"]['tmp_name'], $uploadfile);

        $id = (int) $id;
        $apend = mysql_escape_string($apend);
        mysql_query("INSERT INTO `iku_exhibition_galery`(`exib_id`, `path`) VALUES ('$id','$apend')");
    }

    public function getGalerry($id) {
        if ($id != null) {
            $id = (int) $id;
            $wh = "OR `id`='$id'";
        } else {
            $wh = "";
        }
        $id = (int) $id;
        $result = mysql_query("SELECT * FROM `iku_exhibition_galery` WHERE `exib_id`='$id' $wh");
        $mas = array();
        $i = 0;
        while ($res = mysql_fetch_assoc($result)) {
            $mas[$i] = $res;
            $i++;
        }
        return $mas;
    }

    public function delGalery($id) {
        $gal = $this->getGalerry($id);
        unlink("../userfiles/galery/" . $gal[0]["path"]);
        $this->delRecord("iku_exhibition_galery", $id);
    }

    public function addRegistration($file) {
        if ($file["registration"]["name"]) {
            $apend = date('YmdHis') . rand(100, 1000);
            $uploaddir = '../userfiles/registration/';
            $raz = explode(".", $file["registration"]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($file["registration"]['tmp_name'], $uploadfile);
        }
        $stmt = $this->_mysqli->prepare("INSERT INTO `iku_registration`(`path`) VALUES (?)");
        $stmt->bind_param("s", $apend);
        $stmt->execute();
        $stmt->close();
    }

    public function getRegistration($id = null) {
        if ($id != null) {
            $wh = " `id`=$id";
        } else {
            $wh = "";
        }
        $mas = $this->getRecord("iku_registration", $wh);
        return $mas;
    }

    public function delRegistration($id) {
        $regist = $this->getRegistration($id);
        unlink('../userfiles/registration/' . $regist[0]["path"]);
        $this->delRecord("iku_registration", $id);
    }

    public function updateDocument($id, $type, $files) {
        $mas = array();
        $i = 0;
        foreach ($files["lang"]["name"] as $key => $value) {
            if ($value) {
                $mas[$i]["id"] = $key;
                $mas[$i]["name"] = $value;
                $i++;
            }
        }
        foreach ($files["lang"]["tmp_name"] as $key => $value) {
            if ($value) {
                for ($i = 0; $i < count($mas); $i++) {
                    if ($mas[$i]["id"] == $key) {
                        $mas[$i]["tmp_name"] = $value;
                    }
                }
            }
        }
        $document = $this->getDocument($id, $type);
        for ($i = 0; $i < count($document); $i++) {
            for ($j = 0; $j < count($mas); $j++) {
                if ($mas[$j]["id"] == $document[$i]["lang"]) {
                    unlink("../userfiles/provision/{$document[$i]["path"]}");
                }
            }
        }
        $uploaddir = '../userfiles/provision/';
        for ($i = 0; $i < count($mas); $i++) {
            $apend = date('YmdHis') . $mas[$i]["id"] . $id;
            $raz = explode(".", $mas[$i]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($mas[$i]['tmp_name'], $uploadfile);
            mysql_query("UPDATE `iku_provisions` SET `document`='$apend' WHERE `provision_id`='$id' AND `lang_id`='{$mas[$i]["id"]}'");
        }
    }

    public function getDocument($id_type, $type, $id = null) {
        if ($id != null) {
            $wh = " OR `id`=$id";
        } else {
            $wh = "";
        }
        $stmt = $this->_mysqli->prepare("SELECT `id`, `path`, `lang` FROM `iku_document` WHERE (`id_type`=? AND `type`=?) $wh");
        $stmt->bind_param("ii", $id_type, $type);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id, $path, $lang);
        $mas = array();
        $i = 0;
        while ($stmt->fetch()) {
            $mas[$i]["id"] = $id;
            $mas[$i]["lang"] = $lang;
            $mas[$i]["path"] = $path;
            $i++;
        }
        return $mas;
    }

    public function uploadDocument($id, $type, $files) {
        $mas = array();
        $i = 0;
        foreach ($files["lang"]["name"] as $key => $value) {
            if ($value) {
                $mas[$i]["id"] = $key;
                $mas[$i]["name"] = $value;
                $i++;
            }
        }
        foreach ($files["lang"]["tmp_name"] as $key => $value) {
            if ($value) {
                for ($i = 0; $i < count($mas); $i++) {
                    if ($mas[$i]["id"] == $key) {
                        $mas[$i]["tmp_name"] = $value;
                    }
                }
            }
        }
        $uploaddir = '../userfiles/provision/';
        $stmt = $this->_mysqli->prepare("INSERT INTO `iku_document`(`id_type`, `lang`, `type`, `path`) VALUES (?,?,?,?)");
        for ($i = 0; $i < count($mas); $i++) {
            $apend = date('YmdHis') . $mas[$i]["id"] . $id;
            $raz = explode(".", $mas[$i]["name"]);
            $raz = strtolower($raz[count($raz) - 1]);
            $apend = "$apend.$raz";
            $uploadfile = "$uploaddir$apend";
            move_uploaded_file($mas[$i]['tmp_name'], $uploadfile);
            $stmt->bind_param("iiis", $id, $mas[$i]["id"], $type, $apend);
            $stmt->execute();
        }
        $stmt->close();
    }

    public function makeClickableLinks($text) {
        $text = ereg_replace('(((f|ht){1}tp://)[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '<a href="\\1">\\1</a>', $text);
        $text = ereg_replace('([[:space:]()[{}])(www.[-a-zA-Z0-9@:%_\+.~#?&//=]+)', '\\1<a href="http://\\2">\\2</a>', $text);
        $text = ereg_replace('([_\.0-9a-z-]+@([0-9a-z][0-9a-z-]+\.)+[a-z]{2,3})', '<a href="mailto:\\1">\\1</a>', $text);
        return $text;
    }

    public function delExpert($id) {
        $id = (int) $id;
        $expert = $this->getExpert($id);
        $uploaddir = '../userfiles/expert/';
        if (is_file($uploaddir . $expert[0]["photo"])) {
            unlink($uploaddir . $expert[0]["photo"]);
        }
        mysqli_query($this->_mysqli, "DELETE FROM `iku_expert` WHERE `id`='$id'");
    }

    public function getCoountry($id = null) {
        if ($id != null) {
            $id = (int) $id;
            $wh = " `id_country`='$id'";
        } else {
            $wh = "";
        }
        $mas = $this->getRecord("iku_country", $wh);
        return $mas;
    }

    public function getCoountryName($id) {
        $country = $this->getCoountry($id);
        if (isset($country[0]["name_country"])) {
            return $country[0]["name_country"];
        } else {
            return '';
        }
    }

    public function getRecord($from, $wh = '', $select = "*") {
        if ($wh != "") {
            $wh = 'WHERE ' . $wh;
        }
        $result = mysql_query("SELECT $select FROM $from $wh");
        $mas = array();
        while ($res = mysql_fetch_assoc($result)) {
            if (isset($res["lang_id"])) {
                $mas[$res["lang_id"]][] = $res;
            } else {
                $mas[] = $res;
            }
        }
        return $mas;
    }

}

?>