<?php

include "conn.php";

$username = $_POST["username"];
$activatecode = $_POST["activatecode"];

$activesql = $conn->query("SELECT * FROM users WHERE username = '$username' and activatemail = '$activatecode'");

if($activesql->rowCount() == 1)
{
    $activeupdate = $conn->query("UPDATE users SET activatemail = '0', activationcode = 'active', uyeonay = '1' WHERE username = '$username'");

    if($activeupdate)
    {
        echo json_encode("success");
    }
    else
    {
        echo json_encode("error");
    }
} 
else 
{
    echo json_encode("errorActivate");
}

?>
