<?php

include "conn.php";

$adsoyad = $_POST["adsoyad"];
$username = $_POST["username"];
$password = hash('sha256', $_POST['password']);
$email = $_POST["email"];
$zaman      = time();
$activationcode = uniqid("active_");
$activemail = rand(1000,9999);

$ucontrol = $conn->query("SELECT * FROM users WHERE username = '$username'");

$ucontrolcount = $ucontrol->rowCount();

$emailcontrol = $conn->query("SELECT * FROM users WHERE email = '$email'");

$emailcontrolcount = $emailcontrol->rowCount();

if($ucontrolcount == 1)
{
    echo json_encode("unameerror");
} 
else 
{
    if($emailcontrolcount == 1)
    {
        echo json_encode("emailerror");
    }
    else
    {
        $kayit = $conn->query("INSERT INTO users(
            adsoyad, 
            username, 
            password, 
            email, 
            activationcode,
            activatemail, 
            kayit_tarih) 
            VALUES(
                '$adsoyad',
                '$username',
                '$password',
                '$email',
                '$activationcode',
                '$activemail',
                '$zaman'
            )");

            if($kayit)
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
                $mail->AddAddress($email);
                $mail->From         = 'oushansen@gmail.com';
                $mail->FromName     = 'Üyelik Aktivasyonu';
                $mail->CharSet      = 'UTF-8';
                $mail->Subject      = $activemail.' - Üyelik Aktivasyon Kodu - ForumUni';

                $aktivasyonlinki    = 'http://www.forumuni.com/mailactivation.php?active='.$activationcode.'';

                $mailicerik    = "
                <div>
                    <p>Merhaba ".$adsoyad.",</p>
                    <p>
                        Tüm öğrenciler için oluşturduğumuz bu toplulukta sizi görmekten mutluluk duyuyoruz. Kayıt işleminizin başarıyla tamamlanması için lütfen üyeliğinizi onaylayın.
                    </p>
                    <br/>
                    <h1>
                    ".$activemail."
                    </h1>
                    <br/><br/>
                    <p>
                        Onay ekranını kaçırdıysanız aşağıdaki butondan hesabınızı aktif hale getirebilirsiniz;
                    </p>
                    <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">Üyeliği Onayla</a>
                </div>";

                $mail->MsgHTML($mailicerik);
                
                if($mail->Send())
                {
                    echo json_encode("regsuccess");
                } 
                else 
                {
                    echo json_encode("mailError");
                }
            } 
            
            else 
            {
                echo json_encode("nullregister");
            }
    }
}

?>
