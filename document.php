<?php

@session_start();
if (!isset($_SESSION["lang"])) {
    $_SESSION["lang"] = 1;
}
include 'function.inc.php';
$mysqli = Connect::conect($_host, $_user, $_password, $_database);
$page = new Pages();

if(isset($_GET["provision"])){
    $_GET["provision"] = (int)$_GET["provision"];
    $document = $page->getRecord('iku_provisions', " `provision_id`='{$_GET["provision"]}'");
    if(isset($document[1][0]["id"])&&!isset($document[$_SESSION["lang"]][0]["id"])){
        $document[$_SESSION["lang"]] = $document[1];
    }
    if(!empty($document[$_SESSION["lang"]])){
        $document = $document[$_SESSION["lang"]];
        $file = $document[0]["document"];
        $name = $document[0]["name"];
        $path = "userfiles/provision/$file";
    }
} elseif($_GET["breed"]){
    $_GET["breed"] = (int)$_GET["breed"];
    $document = $page->getRecord('iku_breed_dogs_desc', " `breed_id`='{$_GET["breed"]}'");
    if(isset($document[1][0]["id"])&&!isset($document[$_SESSION["lang"]][0]["id"])){
        $document[$_SESSION["lang"]] = $document[1];
    }
    if(!empty($document[$_SESSION["lang"]])){
        $document = $document[$_SESSION["lang"]];
        $file = $document[0]["document"];
        $name = $document[0]["ang_name"];
        $path = "userfiles/provision/$file";
    }
}
if (isset($file)) {
    if (ob_get_level()) {
        ob_end_clean();
    }
    $type = explode(".", $file);

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $name . "." . $type[1]);
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path));

    readfile($path);
    exit;
} else {
    echo "Извините файл отсутствует или недоступен";
}