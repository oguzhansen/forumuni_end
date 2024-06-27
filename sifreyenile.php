<?php

include("core.php");
head();

?>

<div class="container">
    <div class="row pt-5">
        <div class="col login">
            <?php
            
            if(isset($_POST["sifreyenile"]))
            {

                require_once "mail/class.phpmailer.php";

                $email = $_POST["eposta"];

                $userceka = $conn->query("SELECT * FROM users WHERE email = '$email'");
                $usercek = $userceka->fetch(PDO::FETCH_ASSOC);

                $usercekCount = $userceka->rowCount();


                if($usercekCount == 1)
                {
                    $activationcode = uniqid("sifreyenile_");

                    $uyeguncel = $conn->query("UPDATE users SET sifreyenile = '$activationcode' WHERE id = '".$usercek["id"]."'");

                    if($uyeguncel)
                    {
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
                            <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">Şifre Yenile</a>
                        </div>";

                        $mail->MsgHTML($mailicerik);
                        
                        if($mail->Send())
                        {
                            echo "<div class='alert alert-success'>Şifre yenileme bağlantınız e-posta adresinize gönderildi.</div>";
                        } 
                        else 
                        {
                            echo "Mailer Error: " . $mail->ErrorInfo;
                        }
                    }
                } 

                else 
                {
                    echo "<div class='alert alert-danger'>Bu e-posta adresine sahip bir kullanıcı bulunamadı. Lütfen bilgileri kontrol edin.</div>";
                }

            }
            
            ?>
            <form action="" method="post">
                <center><h3 class="h3">Şifreni Yenile</h3></center><br/>
                <input class="form-control" type="text" name="eposta" placeholder="E-Posta Adresi"><br/>
                <button class="form-control btn btn-primary" name="sifreyenile">Yenileme Linki Gönder</button>
            </form>
        </div>
    </div>
</div>

<?php

footer();

?>