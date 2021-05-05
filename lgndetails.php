<?php
    $sn = "localhost";
    $un = "root";
    $pw = "";
    $db = "webproject";

    $conn = new mysqli($sn,$un,$pw,$db);
    if($conn->connect_error){
        vardump($conn->connect_error);
        die();
    }
?>
