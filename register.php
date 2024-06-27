<?php
    include "core.php";
    head();

    if(isset($_SESSION["login"]))
    {
        echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
        exit;
    }

?>

<div class="container">
    <div class="row pt-5">
        <div class="col login">
                <h2 class="card-header">Üye Ol</h2><br/>
                <form class="form-group" method="post" autocomplete="off">
                    <?php
                    
                    if(isset($_POST["register"]))
                    {

                        require_once "mail/class.phpmailer.php";

                        $adsoyad    = $_POST["adsoyad"];
                        $username   = $_POST["username"];
                        $email      = $_POST["email"];
                        $password   = hash('sha256', $_POST['pass']);
                        $uni        = $_POST["MemberUni"];
                        $fak        = $_POST["MemberFak"];
                        $bol        = $_POST["MemberBolum"];
                        if(isset($_POST["skabul"]))
                        {
                            $skabul = $_POST["skabul"];
                        }
                        $zaman      = time();
                        $activationcode = uniqid("active_");


                        // KULLANICI ADI KONTROLÜ
                        $usernamecont = $conn->prepare("SELECT * FROM users WHERE username = '$username'");
                        $usernamecont->execute();
                        $usernCont = $usernamecont->fetch(PDO::FETCH_ASSOC);

                        if(!$usernCont)
                        {
                            // E POSTA KONTROLÜ
                            $usermailcont = $conn->prepare("SELECT * FROM users WHERE email = '$email'");
                            $usermailcont->execute();
                            $mailCont = $usermailcont->fetch(PDO::FETCH_ASSOC);
                            if(!$mailCont)
                            {
                                // ÜNİVERSİTE KONTROLÜ
                                if(!isset($_POST['unilidegil']))
								{
                                    if($uni == 0)
									{
										echo "<div class='alert alert-warning'>Üniversite seçimi yapmadınız.</div>";
									}
                                    else if($fak == 0)
                                    {
                                        echo "<div class='alert alert-warning'>Fakülte seçimi yapmadınız.</div>";
                                    }
                                    else if($bol == 0)
                                    {
                                        echo "<div class='alert alert-warning'>Bölüm seçimi yapmadınız.</div>";
                                    }
                                    else
                                    {
                                        if(!isset($skabul))
                                        {
                                            echo "<div class='alert alert-warning'>Sözleşmeleri onaylamadınız!</div>";
                                        }
                                        else
                                        {
                                            //ÜNİVERSİTELİ KAYIT
                                            $unilikayit = $conn->query("INSERT INTO users(adsoyad, username, password, email, activationcode, uni, uni_fakulte, uni_bolum, kayit_tarih, twt, insta, yt) values('$adsoyad', '$username', '$password', '$email', '$activationcode', '$uni', '$fak', '$bol', '$zaman', '', '', '')");


                                            if($unilikayit)
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
                                                $mail->FromName     = 'Üyelik Aktivasyonu';
                                                $mail->CharSet      = 'UTF-8';
                                                $mail->Subject      = 'Üyelik Aktivasyonu - ForumUni';

                                                $aktivasyonlinki    = 'http://www.forumuni.com/mailactivation.php?active='.$activationcode.'';

                                                $mailicerik    = "
                                                <div>
                                                    <p>Merhaba ".$adsoyad.",</p>
                                                    <p>
                                                        Tüm öğrenciler için oluşturduğumuz bu toplulukta sizi görmekten mutluluk duyuyoruz. Kayıt işleminizin başarıyla tamamlanması için lütfen üyeliğinizi onaylayın.
                                                    </p>
                                                    <br/>
                                                    <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">Üyeliği Onayla</a>
                                                </div>";

                                                $mail->MsgHTML($mailicerik);
                                                
                                                if($mail->Send())
                                                {
                                                    echo "<div class='alert alert-success'>Üyeliğiniz başarıyla oluşturuldu. Lütfen e-postanıza gönderilen linkten onay işlemini yapın.</div>";
                                                    echo '<meta http-equiv="refresh" content="5;url=girisyap">';
                                                } 
                                                else 
                                                {
                                                    echo "Mailer Error: " . $mail->ErrorInfo;
                                                }
                                            } 
                                            else 
                                            {
                                                echo "<div class='alert alert-warning'>Kayıt Hatası.</div>";
                                            }
                                            

                                        }
                                    }
                                }
                                else
                                {
                                    if(!isset($skabul))
                                    {
                                        echo "<div class='alert alert-warning'>Sözleşmeleri onaylamadınız!</div>";
                                    }
                                    else
                                    {
                                        //ÜNİVERSİTESİZ KAYIT
                                        $unilikayit = $conn->query("INSERT INTO users(adsoyad, username, password, email, activationcode, uni, uni_fakulte, uni_bolum, kayit_tarih, twt, insta, yt) values('$adsoyad', '$username', '$password', '$email', '$activationcode', '', '', '', '$zaman', '', '', '')");

                                            if($unilikayit)
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
                                                $mail->FromName     = 'Üyelik Aktivasyonu';
                                                $mail->CharSet      = 'UTF-8';
                                                $mail->Subject      = 'Üyelik Aktivasyonu - ForumUni';

                                                $aktivasyonlinki    = 'http://www.forumuni.com/mailactivation.php?active='.$activationcode.'';

                                                $mailicerik    = "
                                                <div>
                                                    <p>Merhaba ".$adsoyad.",</p>
                                                    <p>
                                                        Tüm öğrenciler için oluşturduğumuz bu toplulukta sizi görmekten mutluluk duyuyoruz. Kayıt işleminizin başarıyla tamamlanması için lütfen üyeliğinizi onaylayın.
                                                    </p>
                                                    <br/>
                                                    <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">Üyeliği Onayla</a>
                                                </div>";

                                                $mail->MsgHTML($mailicerik);
                                                
                                                if($mail->Send())
                                                {
                                                    echo "<div class='alert alert-success'>Üyeliğiniz başarıyla oluşturuldu. Lütfen e-postanıza gönderilen linkten onay işlemini yapın.</div>";
                                                    echo '<meta http-equiv="refresh" content="5;url=girisyap">';
                                                } 
                                                else 
                                                {
                                                    echo "Mailer Error: " . $mail->ErrorInfo;
                                                }
                                            } 
                                            else 
                                            {
                                                echo "<div class='alert alert-warning'>Kayıt Hatası.</div>";
                                            }
                                    }
                                }
                            }
                            else
                            {
                                echo "<span class='alert alert-danger'>Bu E-Posta Adresi Zaten Kullanımda!</span>";
                            }
                        }
                        else
                        {
                            echo "<span class='alert alert-danger'>Bu Kullanıcı Adı Zaten Kullanımda!</span>";
                        }
                    }
                    
                    ?>
                    <input class="forma" type="text" name="adsoyad" placeholder="Ad Soyad" <?php if(isset($_POST["register"])){echo "value='".$_POST["adsoyad"]."'";}?>" required/>
                    <input class="forma" type="text" id="unamecontrol" name="username" placeholder="Kullanıcı Adı" <?php if(isset($_POST["register"])){echo "value='".$_POST["username"]."'";}?>" required/>
                    <p class="ucontrol"></p>
                    <input class="forma" type="email" name="email" placeholder="E-Posta" <?php if(isset($_POST["register"])){echo "value='".$_POST["email"]."'";}?>" required/>

                        <input type="checkbox" style="width: 25px;" value="" name="unilidegil" id="unilidegil" />
                        <label for="unilidegil">  &nbsp;&nbsp;Üniversiteli Değilim</label>
                        
                    <div id="unidegil">
                        <select name="MemberUni" id="MemberUni" required>
                            <option value="0">Üniversite Seç</option>
                            <?php 
                                $unigetira = $conn->query("SELECT * FROM universite ORDER BY name");
                                while($unigetir = $unigetira->fetch(PDO::FETCH_ASSOC))
                                {
                            ?>
                            <option value="<?php echo $unigetir["universite_id"]; ?>"><?php echo $unigetir["name"]; ?> <?php }?></option>
                        </select>
                        <br/>
                        <select name="MemberFak" id="MemberFak" required>
                            <option value="0">Fakülte Seç</option>
                        </select>
                        <br/>
                        <select name="MemberBolum" id="MemberBolum" required>
                            <option value="0">Bölüm Seç</option>
                            <?php 
                                $bolumgetira = $conn->query("SELECT * FROM bolumler ORDER BY bolum_adi");
                                while($bolumgetir = $bolumgetira->fetch(PDO::FETCH_ASSOC))
                                {
                            ?>
                            <option value="<?php echo $bolumgetir["bolum_id"]; ?>"><?php echo $bolumgetir["bolum_adi"]; ?> <?php }?></option>
                        </select>
                    </div>

                    <div class="ui icon input">
                    <input class="form-control bg-dark text-light" value="" type="password" id="password-field" name="pass" placeholder="Şifre" required/>
                        <span toggle="#password-field" style="font-size:17px; float: right; margin-right: 5px; margin-top: -41px; position: relative; z-index: 2;" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="ml-3">
                        <input style="width: 25px;"  type="checkbox" name="skabul" id="skabul">
                        <label for="skabul">
                            <span type="button" class="ksozlesme" style="color: cornflowerblue; cursor: pointer;">Kullanıcı Sözleşmesi</span>
                             ve 
                            <span type="button" style="color: cornflowerblue; cursor: pointer;" class="gsozlesme">Gizlilik Politikası</span>
                            'nı okudum, kabul ediyorum.
                        </label>
                    </div>
                    <br/>
                    <br/>
                    <center>
                    <button class="buttonprf mt-3" name="register" >Üye Ol</button>
                    </center>
                </form>
                <br>
            <center>
                <span class="text-muted">Zaten Hesabın Var mı? Hemen <a rel="yukleme" href="girisyap">Giriş Yap</a></span>
            </center>
        </div>    
    </div>
</div>

<?php 

footer();

?>