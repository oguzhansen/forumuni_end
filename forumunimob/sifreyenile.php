<?php

include "conn.php";


$uname = $_POST["username"];

$passuser = $conn->query("SELECT * FROM users WHERE username = '$uname'");
$usercek = $passuser->fetch(PDO::FETCH_ASSOC);

$usercekCount = $passuser->rowCount();

if($usercekCount == 1)
{
    $activationcode = uniqid("sifreyenile_");

    $uyeguncel = $conn->query("UPDATE users SET sifreyenile = '$activationcode' WHERE id = '".$usercek["id"]."'");

    if($uyeguncel)
    {
        require_once "mail/class.phpmailer.php";

        $mail = new PHPMailer();
        $mail->Host         = "smtp.gmail.com";
        $mail->Port         = 587;
        $mail->SMTPSecure   = 'tls';
        $mail->SMTPAuth     = true;
        $mail->Username     = 'oushansen@gmail.com';
        $mail->Password     = 'dzpjjnqsclkqbvxd';
        $mail->IsSMTP();
        $mail->AddAddress($usercek["email"]);
        $mail->From         = 'oushansen@gmail.com';
        $mail->FromName     = 'Şifre Yenileme';
        $mail->CharSet      = 'UTF-8';
        $mail->Subject      = 'Şifre Yenileme - ForumUni';

        $aktivasyonlinki    = 'http://www.forumuni.com/sifreyenileme.php?sifreyenile='.$activationcode.'';

        $mailicerik    = "
        <div>
            <p>Merhaba ".$usercek["adsoyad"].",</p>
            <p>
                Şifre yenileme isteği oluşturdunuz. Eğer bunu yapan siz değilseniz bunu bize bildirin!
            </p>
            <br/>
            <br/>
            <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">Şifre Yenile</a>
        </div>";

        $mail->MsgHTML($mailicerik);
        
        if($mail->Send())
        {
            echo json_encode("success");
        } 
        else 
        {
            echo json_encode("errorSend");
        }
    }
} 

else 
{
    echo json_encode("error");
}

?>