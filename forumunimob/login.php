<?php

include "conn.php";

$uname = $_POST["username"];
$pass = hash('sha256', $_POST['password']);

$login = $conn->query("SELECT * FROM users WHERE username = '$uname' and password = '$pass'");

$loginsql = $login->fetch(PDO::FETCH_ASSOC);

$logincount = $login->rowCount();

if($logincount == 1)
{
    if($loginsql["uyeonay"] == 1)
    {
        echo json_encode("success");
    } 
    else 
    {
        echo json_encode("errorOnay");
    }
} 
else 
{
    echo json_encode("error");
}

?>
