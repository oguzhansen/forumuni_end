<?php

include "conn.php";

$send = $_GET["send"];

switch($send)
{
    case "unilist":

        $list = array();

        $uni = $conn->query("SELECT * FROM universite ORDER BY name");

        while($unilist = $uni->fetch(PDO::FETCH_ASSOC))
        {
            $list[] = $unilist;
        }

        echo json_encode($list);

    break;

    case "faklist":

        $list = array();

        $uniid = $_POST["uniid"];

        $fak = $conn->query("SELECT * FROM universite_fakulte WHERE universite_id = '$uniid' ORDER BY name");

        while($faklist = $fak->fetch(PDO::FETCH_ASSOC))
        {
            $list[] = $faklist;
        }

        if($uniid != null)
        {
            echo json_encode($list);
        }
        else
        {
            echo json_encode("a");
        }

    break;

    case "bollist":

        $list = array();

        $bol = $conn->query("SELECT * FROM bolumler ORDER BY bolum_adi");

        while($bollist = $bol->fetch(PDO::FETCH_ASSOC))
        {
            $list[] = $bollist;
        }

        echo json_encode($list);

    break;
}

?>