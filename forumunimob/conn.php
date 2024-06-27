<?php

    $sunucu = "localhost";
    $kadi   = "xcuforum";
    $sifre  = "X[ZT{Kj9";
    $db     = "xcuforum_unifor";

    try 
    {
        $conn = new PDO("mysql:host=$sunucu;dbname=$db;charset=utf8",$kadi,$sifre);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    catch(PDOException $e)
    {
        echo "Sunucu Hatası: " . $e->getMessage();
    }

?>