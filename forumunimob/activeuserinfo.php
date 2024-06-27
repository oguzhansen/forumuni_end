<?php

include "conn.php";

$uname = $_POST["username"];

$send = $_GET["send"];

switch($send)
{
    case "userinfo":

        $userinfo = array();

        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");

        while($userbilgi = $user->fetch(PDO::FETCH_ASSOC))
        {
            $userinfo[] = $userbilgi;
        }

        echo json_encode($userinfo);

    break;

    case "uniinfo":

        $uniinfo = array();

        $user = $conn->query("SELECT * FROM users WHERE username = 'oguzunbiri'")->fetch(PDO::FETCH_ASSOC);

        $uni = $conn->query("SELECT * FROM universite WHERE universite_id = '".$user["uni"]."'");

        while($unibilgi = $uni->fetch(PDO::FETCH_ASSOC))
        {
            $uniinfo[] = $unibilgi;
        }

        echo json_encode($uniinfo);

    break;

    case "fakinfo":

        $uniinfo = array();

        $user = $conn->query("SELECT * FROM users WHERE username = 'oguzunbiri'")->fetch(PDO::FETCH_ASSOC);

        $uni = $conn->query("SELECT * FROM universite_fakulte WHERE fakulte_id = '".$user["uni_fakulte"]."'");

        while($unibilgi = $uni->fetch(PDO::FETCH_ASSOC))
        {
            $uniinfo[] = $unibilgi;
        }

        echo json_encode($uniinfo);

    break;

    case "bolinfo":

        $uniinfo = array();

        $user = $conn->query("SELECT * FROM users WHERE username = 'oguzunbiri'")->fetch(PDO::FETCH_ASSOC);

        $uni = $conn->query("SELECT * FROM bolumler WHERE bolum_id = '".$user["uni_bolum"]."'");

        while($unibilgi = $uni->fetch(PDO::FETCH_ASSOC))
        {
            $uniinfo[] = $unibilgi;
        }

        echo json_encode($uniinfo);

    break;
}

?>