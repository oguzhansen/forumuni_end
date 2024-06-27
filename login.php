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
            <center>
                <h2 class="card-header">Giriş Yap</h2><br/>
                <form class="form-group" method="post">
                    <?php
                    
                    if(isset($_POST["login"]))
                    {
                        $kadi = $_POST["username"];
                        $pass = hash('sha256', $_POST['pass']);

                        $user = $conn->query("select * from users where username = '$kadi' and password = '$pass'");
                        $user->execute(array($kadi, $pass));
                        $login = $user->fetch(PDO::FETCH_ASSOC);

                        if($login)
                        {
                            if($login["uyeonay"] == 1 || $login["uyeonay"] == 2)
                            {                            
                                $_SESSION['login'] = true;
                                $_SESSION['username'] = $kadi;

                                setcookie("kadi", $kadi, time() + (60*60*24*365));

                                echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';
                            }

                            else if($login["uyeonay"] == 0)
                            {
                                echo "<div class='alert alert-danger'>Lütfen kayıt olurken mailinize gönderilen linkten hesabınızı onaylayın.</div>";
                            }
                        }
                        
                        else
                        {
                            echo "<div class='alert alert-danger'>Hatalı kullanıcı adı veya şifre</div>";
                        }
                        
                    }
                    
                    ?>
                    <input class="forma" type="text" name="username" placeholder="Kullanıcı Adı" <?php if(isset($_POST["login"])){echo "value='".$_POST["username"]."'";}?>" />
                    <input class="forma" type="password" name="pass" placeholder="Şifre"/>
                    <a href="sifreyenile">Şifreni mi Unuttun?</a><br/>
                    <button class="buttonprf mt-3" name="login" >Giriş Yap</button>
                </form>
                <span class="text-muted">Hesabın Yok mu? Hemen <a rel="yukleme" href="kayitol">Üye Ol</a></span>
            </center>
        </div>
        <div class="sozles p-5">
        Forumuni'nin <a class="text-info" href="kullanimkosul">Kullanım Koşulları</a> ve <a class="text-info" href="gizlilik">Gizlilik Politikası</a>'na dair bilgilendirme belgelerini inceleyebilirsiniz.
        </div>
    </div>
</div>

<?php 

footer();

?>