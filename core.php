<?php
    session_start();
    ob_start();
    include "config.php";

    if(isset($_COOKIE['kadi']))
    {
        $_SESSION['login'] = true;
        $_SESSION["username"] = $_COOKIE['kadi'];
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="tr-TR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="forumuni, forum uni, forum uni net, forumuni-net, universite, ogrenci, ogretmen, tercih, tercih dönemi, üniversite tercih, yks, üniversite sınavı, üniversite, sınav, yks sınavı">
    <meta name="description" content="forumuni'nin amacı üniversiteye başlamamış veya hazırlanan öğrencilerin üniversitede eğitim gören veya mezun olmuş öğrencilerden aldıkları bilgiler doğrultusunda kendilerine en yakın hissettikleri üniversiteler için tercih oluşturabilecekleri bir sistemdir.">
    <meta name="author" content="Shenlik Team">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/img/faviconn.png">

    <!--- Twitter Card --->
    <meta name="twitter:card" content="summary" />

    <meta name="twitter:title" content="Forum Uni" />

    <meta name="twitter:description" content="forumuni, universite, ogrenci, ogretmen, tercih, tercih dönemi, üniversite tercih, yks, üniversite sınavı, üniversite, sınav, yks sınavı" />

    <meta name="twitter:url" content="http://forumuni.com" />

    <meta name="twitter:image" content="https://forumuni.com/assets/img/logo.png" />
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5727447479671642"
     crossorigin="anonymous"></script>

    <?php
    
    if (basename($_SERVER['SCRIPT_NAME']) == 'login.php') 
    {
        $pagetitle = 'Giriş Yap';
    } 

    else if (basename($_SERVER['SCRIPT_NAME']) == 'register.php') 
    {
        $pagetitle = 'Kayıt Ol';
    } 

    else if (basename($_SERVER['SCRIPT_NAME']) == 'profilim.php')
    {
        $pagetitle = 'Profilim';
    } 

    else if (basename($_SERVER['SCRIPT_NAME']) == 'bildirimler.php') 
    {
        $pagetitle = 'Bildirimler';
    } 

    else if (basename($_SERVER['SCRIPT_NAME']) == 'sorucevap.php') 
    {
        $pagetitle = 'Soru Cevap';
    }

    else if (basename($_SERVER['SCRIPT_NAME']) == 'explore.php') 
    {
        $pagetitle = 'Keşfet';
    }

    else if (basename($_SERVER['SCRIPT_NAME']) == 'ajax.php') 
    {
        $pagetitle = 'çalışıyor...';
    }

    else if (basename($_SERVER['SCRIPT_NAME']) == 'university.php') 
    {
        $unicek = $conn->query("SELECT * FROM universite WHERE universite_id = '".$_GET["uniid"]."'")->fetch(PDO::FETCH_ASSOC);
        $pagetitle = $unicek["name"];
    }
    
    else if (basename($_SERVER['SCRIPT_NAME']) == 'user.php') 
    {
    
        $pagetitle = $_GET["username"];
    } 

    else if (basename($_SERVER['SCRIPT_NAME']) == 'soru.php') 
    {
        $sorucek = $conn->query("SELECT * FROM sorular WHERE soru_id = '".$_GET["soruid"]."'")->fetch(PDO::FETCH_ASSOC);
        $pagetitle = $sorucek["soru"];
    }

    else if (basename($_SERVER['SCRIPT_NAME']) == 'rezler.php') 
    {
        $pagetitle = "Rezlerim";
    }

    else 
    {
        $pagetitle = "Diğer";
    }

    if(basename($_SERVER['SCRIPT_NAME']) == 'index.php')
    {
        echo '<title>Forum Uni</title>';
    }
    else
    {
        echo '<title>' . $pagetitle . '</title>';
    }

    ?>

    <!----- BOOTSTRAP ----->
    <link rel="stylesheet" href="assets/css/bootstrap.css" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <!----- STYLE FILE ----->
    <link rel="stylesheet" href="assets/css/stil.css" />

    <!----- JQUERY ----->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!----- BOOTSRAP JS ----->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"></script>

    <!----- FONT AWESOME ----->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

<?php 
function zaman($zaman)
    {
        $zaman_farki = time() - $zaman;
        $saniye = $zaman_farki;
        $dakika = round($zaman_farki/60);
        $saat = round($zaman_farki/3600);
        $gun = round($zaman_farki/86400);
        $hafta = round($zaman_farki/604800);
        $ay = round($zaman_farki/2419200);
        $yil = round($zaman_farki/29030400);

        if($saniye <= 59)
        {
            return $saniye." saniye önce";
        }
        else if($dakika <= 59)
        {
            return $dakika." dakika önce";
        }
        else if($saat <= 23)
        {
            return $saat." saat önce";
        }
        else if($gun <= 6)
        {
            return $gun." gün önce";
        }
        else if($hafta <= 3)
        {
            return $hafta." hafta önce";
        }
        else if($ay <= 11)
        {
            return $ay." ay önce";
        }
        else 
        {
            return $yil." yıl önce";
        }
    }

    function GetIP()  
	{  
		if (!empty($_SERVER['HTTP_CLIENT_IP']))  
		{  
			$ip	= $_SERVER['HTTP_CLIENT_IP'];  
		}  
		elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){  
			$ip	= $_SERVER['HTTP_X_FORWARDED_FOR'];  
		}  
		else{  
			$ip	= $_SERVER['REMOTE_ADDR'];  
		}  
		return $ip;  
	}

?>

</head>
<body class="darkbg">

<?php function head() { 
    
    include "config.php";
    include "mLogger.php";

    $ip_adresi = GetIP();

    mLogger::insert($ip_adresi." ip adresli kullanıcı ".$_SERVER['SCRIPT_NAME']." sayfasına giriş yaptı.");
    mLogger::insert($ip_adresi." ip adresli kullanıcının cihaz bilgileri-> ".$_SERVER['HTTP_USER_AGENT']);

    if(isset($_SESSION["login"]))
    {
        $uname = $_SESSION["username"];

        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $user = $user->fetch(PDO::FETCH_ASSOC);

        if($user["uyeonay"] == 0)
        {
            session_destroy();
            echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
        }
    }

    if (basename($_SERVER['SCRIPT_NAME']) != 'profilim.php') {
        ?>

        <div class="acilis darkbg">
            <img alt="yukleniyor" src="assets/img/loading.gif">
        </div>

    <?php } ?>

    <nav class="col-2 navdesk nav flex-column position-fixed p-4 h-100 darkbg">
            <img class="navbar-brand pb-5 logo" alt="forumuni" src="assets/img/logo.png" width="45px" alt="">
            <a class="navbar-brand pb-5 logo-text" rel="yukleme" href="anasayfa">FORUMUNI</a>
        <div class="nav flex-column">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item p-2">
                    <a class="nav-link" rel="yukleme" href="anasayfa"><i class="fas fa-home pr-2"></i> <span>Anasayfa</span></a>
                </li>
                <li class="nav-item p-2 araac">
                    <a class="nav-link" style="cursor:pointer;" onclick="araac()">
                        <i class="fas fa-search pr-2"></i> <span>Ara</span>
                    </a>
                </li>
                <li class="nav-item p-2 arakapa" style="display:none;">
                    <a class="nav-link" style="cursor:pointer;" onclick="arakapa()">
                        <i class="fas fa-search pr-2"></i> <span>Ara</span>
                    </a>
                </li>
                <li class="nav-item p-2">
                    <a rel="yukleme" class="nav-link" href="kesfet"><i class="fas fa-compass pr-2"></i> <span>Keşfet</span></a>
                </li>
                <li class="nav-item p-2">
                    <a class="nav-link" rel="yukleme" href="sorucevap"><i class="fas fa-comment pr-2"></i> <span>Soru | Cevap</span></a>
                </li>
                <?php if(isset($_SESSION["login"])){ ?>
                    <li class="nav-item p-2 bildirimac">
                        <a class="nav-link bildioku" style="cursor:pointer;" onclick="bildirimac()">
                            <i class="fas fa-heart pr-2"></i> 
                            <span>Bildirimler 
                                <span id="noti_number">

                                </span>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link" rel="yukleme" href="messages.php"><i class="bi bi-chat-right pr-2"></i> <span>Mesajlar</span></a>
                    </li>
                    <li class="nav-item p-2 bildirimkapa" style="display: none;">
                        <a class="nav-link bildarka" style="cursor:pointer;" onclick="bildirimkapa()">
                            <i class="fas fa-heart pr-2"></i> 
                            <span>Bildirimler</span>
                        </a>
                    </li>
                    <li class="nav-item p-2">
                        <a type="button" class="nav-link" id="sendPostPopup"><i class="fas fa-plus pr-2"></i> <span>Oluştur</span></a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link" rel="yukleme" href="profilim.php?cat=sorular"><img class="rounded-circle" src="<?php echo $user["avatar"]; ?>" width="25" height="25" /> <span>Profil</span></a>
                    </li>
                    <div class="position-absolute w-100" style="bottom:0;">
                        <li class="nav-item">
                            <a class="nav-link" rel="yukleme" href="rezlerim"><i class="pr-1" style="font-size: 18px; font-weight: 900; font-family: 'Font Awesome 6 Free';">#</i> <span>Rezler</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" rel="yukleme" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> <span>Çıkış Yap</span></a>
                        </li>
                    </div>
                <?php }else{ ?>
                    <li class="nav-item p-1">
                        <a class="nav-link" rel="yukleme" href="girisyap"> <span>Giriş Yap</span></a>
                    </li>
                    <li class="nav-item p-1">
                        <a class="nav-link" rel="yukleme" href="kayitol"> <span>Üye Ol</span></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
    
    
    

    <div class="bodya">
        <div class="pop-container darkbg" id="pop-container">
            <div class="pop darkbg">
            <?php if(isset($_SESSION["login"])){ ?> 
                <div class="paylasim w-100">
                    <div class="postButton position-absolute float-right w-100" style="margin-top:-17px; right:-170px;">
                        <button onclick="sorupopac()" class="buttonprf">Soru Sor</button>
                        <button onclick="anipopac()" class="buttonprf mr-2">Anı Paylaş</button>
                    </div>
                    <!--- SORU PAYLAŞMA --->
                    <div class="soruPop mt-3">
                        <?php
                        
                        if(isset($_POST["sorupaylas"]))
                        {
                            $sorukat    = $_POST["kategori"];
                            $userid     = $user["id"];
                            $uni        = $_POST["MemberUni"];
                            $fak        = $_POST["MemberFak"];
                            $bol        = $_POST["MemberBolum"];
                            $soru       = $_POST["soru"];
                            $zaman      = time();

                            if($sorukat != 0)
                            {
                                $soruekle = $conn->query("INSERT INTO sorular(kat_id, id, uni_id, fak_id, bol_id, soru, soru_tarih) values('$sorukat', '$userid', '$uni', '$fak', '$bol', '$soru', '$zaman')");
                                echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
                            }
                        }

                        ?>
                        <form method="post">
                        
                        <h2>Soru Paylaş</h1>
                            <div class="alert alert-danger hata">Lütfen Seçim Yapın</div>
                            <select class="" name="kategori" id="kategori">
                                <option value="0">Seçiniz</option>
                                <?php
                                
                                $sorukat = $conn->query("SELECT * FROM sorucevapkat");

                                while($cikti = $sorukat->fetch(PDO::FETCH_ASSOC)) { 
                                    
                                ?>

                                <option value="<?php echo $cikti["kat_id"]; ?>"><?php echo $cikti["kat_adi"]; ?></option>

                                <?php } ?>
                            </select>
                            
                            <div class="uniac pt-2 pb-2">
                                <select  class="" name="MemberUni" id="MemberUnis">
                                    <option value="0">Üniversite Seç</option>
                                    <?php 
                                        $unigetira = $conn->query("SELECT * FROM universite ORDER BY name");
                                        while($unigetir = $unigetira->fetch(PDO::FETCH_ASSOC))
                                        {
                                    ?>
                                    <option value="<?php echo $unigetir["universite_id"]; ?>"><?php echo $unigetir["name"]; ?> <?php }?></option>
                                </select>
                            </div>

                            <div class="fakac pt-2 pb-2">
                                <select  class="" name="MemberFak" id="MemberFaks">
                                    <option value="0">Fakülte Seç</option>
                                </select>
                            </div>

                            <div class="bolac pt-2 pb-2">
                                <select  class="" name="MemberBolum" id="MemberBolums">
                                    <option value="0">Bölüm Seç</option>
                                    <?php 
                                        $bolumgetira = $conn->query("SELECT * FROM bolumler ORDER BY bolum_adi");
                                        while($bolumgetir = $bolumgetira->fetch(PDO::FETCH_ASSOC))
                                        {
                                    ?>
                                    <option value="<?php echo $bolumgetir["bolum_id"]; ?>"><?php echo $bolumgetir["bolum_adi"]; ?> <?php }?></option>
                                </select>
                            </div>
                            <textarea name="soru" id="soru" class=" soru" rows="10"></textarea>
                            <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" id="paylas" disabled name="sorupaylas">Paylaş</button>

                        </form>
                    </div>

                    <!--- ANI PAYLAŞMA --->
                    <div class="aniPop mt-3">
                        <?php
                        
                        if(isset($_POST["anipaylas"]))
                        {
                            $userid = $user["id"];
                            $ani    = $_POST["ani"];
                            $zaman  = time();

                            $aniekle = $conn->query("INSERT INTO anilar(ani, id, ani_tarih) values('$ani', '$userid', '$zaman')");

                            echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
                        }

                        ?>
                        <form method="POST">
                            
                            <h2>Anı Paylaş</h2><br/>
                            <textarea name="ani" id="ani" class=" ani" rows="10"></textarea>
                            <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" id="anipaylas" disabled name="anipaylas">Paylaş</button>
                            
                        </form>
                    </div>
                </div>

                <div class="sikayetpop" style="display: none;">
                <br/>
                    <h4>Şikayetiniz İletildi!</h4>
                    <br/>
                    <button class="btn btn-outline-danger sikayetkapat" id="sikayetkapat">Kapat</button>
                </div>
            
                
                <div class="silpop" style="display: none;">
                <br/>
                    <div><h6>Silmek istediğinize emin misiniz?</h6></div>
                    <input type="hidden" value="" />
                    <br/>
                    <button class="btn btn-outline-danger sillkapat" id="sillkapat">Kapat</button>
                    <button class="btn btn-outline-danger sil" id="sil">Sil</button>
                </div>

                <div class="cevapsilpop" style="display: none;">
                <br/>
                    <div><h6>Silmek istediğinize emin misiniz?</h6></div>
                    <input type="hidden" value="" />
                    <br/>
                    <button class="btn btn-outline-danger sillkapat" id="sillkapat">Kapat</button>
                    <button class="btn btn-outline-danger cevapsil" id="cevapsil">Sil</button>
                </div>


                <div class="silindipop" style="display: none;">
                <br/>
                    <h6>Başarıyla silindi!</h6>
                    <br/>
                    <button class="btn btn-outline-danger silkapat" id="silkapat">Kapat</button>
                </div>
            <?php } ?>


                <div class="kullanicisozlesme" style="display: none;">
                    
                    <embed src="documents/kullanım.pdf" type="application/pdf" height="650px" width="100%"><br/><br/>
                    <button class="btn btn-outline-danger sozkapat" id="sozkapat">Kapat</button>

                </div>


                    
                <div class="gizliliksozlesme" style="display: none;">
                    
                    <embed src="documents/gizlilik-politikasi.pdf" type="application/pdf" height="650px" width="100%"><br/><br/>
                    <button class="btn btn-outline-danger sozkapat" id="sozkapat">Kapat</button>

                </div>


            <?php if(isset($_SESSION["login"])){ ?> 
                <div class="soruduzenlepop" style="display: none;">
                    <?php 
                    
                    if(isset($_POST["soruduzenle"]))
                    {
                        $sorutext = $_POST["sorutext"];
                        $dznid = $_POST["dznid"];

                        $ekle = $conn->query("UPDATE sorular SET soru = '$sorutext' WHERE soru_id = '$dznid'");
                    }
                    
                    ?>
                    <form method="post" id="uniyor">
                        
                        <h2>Soru Düzenle</h2><br/>
                        <input type="hidden" class="dznhidden" name="dznid" value="" />
                        <textarea name="sorutext" id="sorutext" class=" sorutext" rows="10"></textarea>
                        <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" id="soruduzenle" name="soruduzenle">Düzenle</button>

                    </form>
                </div>

                <div class="aniduzenlepop" style="display: none;">
                <?php 
                    
                    if(isset($_POST["aniduz"]))
                    {
                        $anitext = $_POST["anitext"];
                        $anidznid = $_POST["anidznid"];

                        $ekle = $conn->query("UPDATE anilar SET ani = '$anitext' WHERE ani_id = '$anidznid'");
                    }
                    
                    ?>
                    <form method="post" id="uniyor">
                        <h2>Anı Düzenle</h2><br/>
                        <input type="hidden" class="anidznhidden" name="anidznid" value="" />
                        <textarea name="anitext" id="anitext" class=" anitext" rows="10"></textarea>
                        <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" id="aniduz" name="aniduz">Düzenle</button>
                    </form>
                </div>

                <div class="uniinfoekle" style="display: none;">
                    <?php
                        
                        if(isset($_POST["uniekle"]))
                        {
                            $userid = $user["id"];
                            $uni    = $_POST["uni"];
                            $fak    = $_POST["fak"];
                            $bol    = $_POST["bol"];
                            
                            $uniekle = $conn->query("UPDATE users SET uni = '$uni', uni_fakulte = '$fak', uni_bolum = '$bol' WHERE id = '$userid'");
                            
                            echo '<meta http-equiv="refresh" content="0;url=profilim?cat=sorular">';
                        }
                        
                        ?>
                    <form method="post">
                        
                        <br>
                        <br>
                        <div class="alert alert-primary">Üniversite Bilgileri Bir Daha Değiştirilemez!</div>
                        <select  class="" name="uni" id="MemberUnia">
                            <option value="0">Üniversite Seç</option>
                            <?php 
                                $unigetira = $conn->query("SELECT * FROM universite ORDER BY name");
                                while($unigetir = $unigetira->fetch(PDO::FETCH_ASSOC))
                                {
                            ?>
                            <option value="<?php echo $unigetir["universite_id"]; ?>"><?php echo $unigetir["name"]; ?> <?php }?></option>
                        </select>

                        <br/>

                        <select  class="" name="fak" id="MemberFaka">
                            <option value="0">Fakülte Seç</option>
                        </select>

                        <br/>

                        <select  class="" name="bol" id="MemberBoluma">
                            <option value="0">Bölüm Seç</option>
                            <?php 
                                $bolumgetira = $conn->query("SELECT * FROM bolumler ORDER BY bolum_adi");
                                while($bolumgetir = $bolumgetira->fetch(PDO::FETCH_ASSOC))
                                {
                            ?>
                            <option value="<?php echo $bolumgetir["bolum_id"]; ?>"><?php echo $bolumgetir["bolum_adi"]; ?> <?php }?></option>
                        </select>
                        <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" id="uniekleinfo" disabled name="uniekle">Kaydet</button>
                    </form>
                </div>

                <!---- ÜNİVERSİTE YORUM ---->
                <div class="uniyorum mt-3" style="display: none;">
                    <?php
                    
                    $uni = $conn->query("SELECT * FROM universite WHERE universite_id = '".$user["uni"]."'")->fetch(PDO::FETCH_ASSOC);
                    
                    if(isset($_POST["uniyorumpaylas"]))
                    {
                        $userid     = $user["id"];
                        $uniid      = $uni["universite_id"];
                        $uniyorum   = $_POST["uniyorumtext"];
                        $memnuniyet = $_POST["mem"];
                        $zaman      = time();
                        
                        $yorumekle = $conn->query("INSERT INTO uni_comment(universite_id, id, memnuniyet, yorum, yorum_tarih) values('$uniid', '$userid', '$memnuniyet', '$uniyorum', '$zaman')");
                        
                        $bild = $conn->query("SELECT * FROM users WHERE uni = '$uniid'");

                        while($unibild = $bild->fetch(PDO::FETCH_ASSOC))
                        {
                            if($userid != $unibild["id"])
                            {
                                $bildekle = $conn->query("INSERT INTO bildirimler(bildirim_katid, kime_user, user_id, yorum, uni_id, bildirim_tarih) VALUES('3','".$unibild["id"]."','$userid','$uniyorum','$uniid','$zaman')");
                            }
                        }

                        $bildyor = $conn->query("SELECT * FROM uni_follows WHERE edilenuni = '$uniid'");

                        while($bildyorekle = $bildyor->fetch(PDO::FETCH_ASSOC))
                        {
                            if($userid != $bildyorekle["edenuni"])
                            {
                                $bildekle = $conn->query("INSERT INTO bildirimler(bildirim_katid, kime_user, user_id, yorum, uni_id, bildirim_tarih) VALUES('5','".$bildyorekle["edenuni"]."','$userid','$uniyorum','$uniid','$zaman')");
                            }
                        }
                        
                    }

                    ?>
                    <form method="post" id="uniyor">

                        <h2>Üniversiteni Yorumla<p><?php echo $uni["name"]; ?></p></h2>
                        <div class="ratingp">
                            <input type="radio" class="mem" name="mem" value="5" id="5" required><label for="5">☆</label> 
                            <input type="radio" class="mem" name="mem" value="4" id="4"><label for="4">☆</label> 
                            <input type="radio" class="mem" name="mem" value="3" id="3"><label for="3">☆</label>
                            <input type="radio" class="mem" name="mem" value="2" id="2"><label for="2">☆</label> 
                            <input type="radio" class="mem" name="mem" value="1" id="1"><label for="1">☆</label>
                        </div>
                        <textarea name="uniyorumtext" id="uniyorumtext" class=" uniyorumtext" rows="10"></textarea>
                        <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" id="uniyorumpaylas" disabled name="uniyorumpaylas">Yorumla</button>
                    </form>
                </div>

                <div class="duzenle" style="display: none;">
                    <?php
                    
                    if(isset($_POST["profilguncelle"]))
                    {
                        $userid     = $user["id"];
                        $adsoyad    = $_POST['adsoyad'];
                        $email      = $_POST['email'];
                        $username   = $_POST['username'];
                        $avatar     = $user['avatar'];
                        $password   = $_POST['pass'];
                        

                        
                        // KULLANICI ADI KONTROLÜ
                        $usernamecont = $conn->prepare("SELECT * FROM users WHERE username = '$username' && id != $userid ");
                        $usernamecont->execute();
                        $usernCont = $usernamecont->fetch(PDO::FETCH_ASSOC);

                        if(!$usernCont)
                        {
                            $emused = 'No';
            
                            $susere  = $conn->query("SELECT * FROM `users` WHERE email='$email' && id != $userid LIMIT 1");
                            $countue = $susere->rowCount();
                            if ($countue > 0) {
                                $emused = 'Yes';
                            }

                            if (@$_FILES['avatar']['name'] != '') {
                                $target_dir    = "uploads/avatars/";
                                $target_file   = $target_dir . basename($_FILES["avatar"]["name"]);
                                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                $filename      = $uname . '.' . $imageFileType;
                                
                                $uploadOk = 1;
                                
                                // Check file size
                                if ($_FILES["avatar"]["size"] > 10000000) {
                                    echo '<div class="alert alert-warning">Üzgünüz, dosyanız çok büyük.</div>';
                                    $uploadOk = 0;
                                }
                                
                                if ($uploadOk == 1) {
                                    move_uploaded_file($_FILES["avatar"]["tmp_name"], "uploads/avatars/" . $filename);
                                    $avatar = "uploads/avatars/" . $filename;
                                }
                            }
                            
                            if (filter_var($email, FILTER_VALIDATE_EMAIL) && $emused == 'No') {
                                if($user["email"] == $email)
                                {
                                    if ($password != "") 
                                    {
                                        $_SESSION['username'] = $username;
                                        setcookie("kadi", $username, time() + (60*60*24*365));

                                        $password   = hash('sha256', $_POST['pass']);
                                        $guncelle   = $conn->query("UPDATE users SET adsoyad = '$adsoyad', username = '$username', avatar = '$avatar', password = '$password' WHERE id = '$userid'");
                                    } 
                                    
                                    else
                                    {
                                        $_SESSION['username'] = $username;
                                        setcookie("kadi", $username, time() + (60*60*24*365));

                                        $guncelle   = $conn->query("UPDATE users SET adsoyad = '$adsoyad', username = '$username', avatar = '$avatar' WHERE id = '$userid'");
                                    }
                                } 
                                
                                else 
                                {
                                    $activationcode = uniqid("active_");

                                    if ($password != "") 
                                    {

                                        $_SESSION['username'] = $username;
                                        setcookie("kadi", $username, time() + (60*60*24*365));

                                        $password   = hash('sha256', $_POST['pass']);
                                        $guncelle   = $conn->query("UPDATE users SET adsoyad = '$adsoyad', email = '$email', activationcode = '$activationcode', uyeonay = '2', username = '$username', avatar = '$avatar', password = '$password' WHERE id = '$userid'");

                                        require_once "mail/class.phpmailer.php";

                                        if($guncelle)
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
                                            $mail->FromName     = 'E-Posta Onayı';
                                            $mail->CharSet      = 'UTF-8';
                                            $mail->Subject      = 'E-Posta Onayı - ForumUni';

                                            $aktivasyonlinki    = 'http://localhost/forumuni-bastan/mailactivation.php?active='.$activationcode.'';

                                            $mailicerik    = "
                                            <div>
                                                <p>Merhaba ".$adsoyad.",</p>
                                                <p>
                                                    E-posta değişikliği yaptınız. Bunu yapan siz değilseniz bizi bilgilendirin.
                                                </p>
                                                <br/>
                                                <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">E-Postayı Onayla</a>
                                            </div>";

                                            $mail->MsgHTML($mailicerik);
                                            
                                            if($mail->Send())
                                            {
                                                echo '<meta http-equiv="refresh" content="5;url=profilim.php?cat=sorular">';
                                            } 
                                            else 
                                            {
                                                echo "Mailer Error: " . $mail->ErrorInfo;
                                            }
                                        }
                                        echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';
                                    } 
                                    
                                    else
                                    {
                                        $_SESSION['username'] = $username;
                                        setcookie("kadi", $username, time() + (60*60*24*365));

                                        $guncelle   = $conn->query("UPDATE users SET adsoyad = '$adsoyad', email = '$email', activationcode = '$activationcode', uyeonay = '2', username = '$username', avatar = '$avatar' WHERE id = '$userid'");
                                        require_once "mail/class.phpmailer.php";

                                        if($guncelle)
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
                                            $mail->FromName     = 'E-Posta Onayı';
                                            $mail->CharSet      = 'UTF-8';
                                            $mail->Subject      = 'E-Posta Onayı - ForumUni';

                                            $aktivasyonlinki    = 'https://www.forumuni.com/mailactivation.php?active='.$activationcode.'';

                                            $mailicerik    = "
                                            <div>
                                                <p>Merhaba ".$adsoyad.",</p>
                                                <p>
                                                    E-posta değişikliği yaptınız. Bunu yapan siz değilseniz bizi bilgilendirin.
                                                </p>
                                                <br/>
                                                <a style='padding:15px; background-color: #9472de; color: white;'; href=".$aktivasyonlinki.">E-Postayı Onayla</a>
                                            </div>";

                                            $mail->MsgHTML($mailicerik);
                                            
                                            if($mail->Send())
                                            {
                                                echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';
                                            } 
                                            else 
                                            {
                                                echo "Mailer Error: " . $mail->ErrorInfo;
                                            }
                                        }
                                        echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';
                                    }
                                }
                            } 
                            else 
                            {
                                echo "<br><br><br><span class='alert alert-danger'>Bu E-Posta Zaten Kullanımda!</span>";
                            }
                        }
                        else
                        {
                            echo "<br><br><br><span class='alert alert-danger'>Bu Kullanıcı Adı Zaten Kullanımda!</span>";
                        }
                        
                    }

                    ?>
                    <form method="post" enctype="multipart/form-data">
                        <br/>
                        <?php
                        
                        $userinfo = $conn->query("SELECT * FROM users WHERE id = '".$user["id"]."'")->fetch(PDO::FETCH_ASSOC);
                        
                        ?>
                        
                        <br/>
                        <label class="custom-file-upload mt-2">
                            <center><img src="<?php echo $userinfo["avatar"]; ?>" class="rounded-circle" width="97px" height="97px" alt=""></center>
                            <input type="file" class="form-control" name="avatar" accept=".png,.jpeg,.jpg" id="avatarfile">
                            <p style="color: cornflowerblue; margin-top: 10px;">Fotoğrafı Düzenle</p>
                        </label>
                        <br/>
                        <br/>
                        <input class="forma mb-1" placeholder="Adın, Soyadın" name="adsoyad" type="text" value="<?php echo $userinfo["adsoyad"]; ?>"/>
                        <p></p>
                        <input class="forma mb-1" placeholder="Kullanıcı Adın" name="username" id="unamecontrol" type="text" value="<?php echo $userinfo["username"]; ?>"/>
                        <p class="ucontrol"></p>
                        <input class="forma mb-1" placeholder="E-Posta Adresin" name="email" type="email" value="<?php echo $userinfo["email"]; ?>"/><br/>
                        <br>
                        <h3 class="form-control darkbg">Şifre: <i class="text-muted">(Değiştirmek istiyorsanız doldurun.)</i></h3>
                        <input class="forma mb-1" name="pass" type="password" placeholder="Şifre"/>
                        <button class="buttonprf" style="right: 35px; top:23px; position: absolute;" type="submit" id="profilguncelle" name="profilguncelle">Güncelle</button>
                    </form>
                </div>
                
                <div class="profilayar" style="display:none; justify-content: center; align-items: center;">
                    <br>
                    <a rel="yukleme" href="rezler.php"><li style="border: none; list-style: none; padding: 10px;">Rezler</li></a>
                    <a rel="yukleme" href="gizlilik">Gizlilik Politikamız</a>
                    <a rel="yukleme" href="logout.php"><li style="border: none; list-style: none; padding: 10px;">Çıkış Yap</li></a><br/>
                    <button class="btn btn-outline-danger silkapat" id="silkapat">Kapat</button>
                </div>

                <br/>
                <?php } ?>
                <button id="closePostPopup" class="btn btn-outline-danger" style="left: 35px; top:23px; position: absolute;">İptal Et</button>
            </div>
        </div>
    </div>
    


    <div class="aradeskdiv ml-5 pl-5 col-5 pt-3 h-100 position-fixed darkbg" style="z-index:1000;">
        <div class="mb-3" style="font-weight: bold; font-size: 20px;">Ara <br/></div>
        <form method="post">
            <input class="forma aradesk" type="search" placeholder="Üniversite veya Kullanıcı Ara" />
        </form>
        <hr>
        <div id="sonuclar" class="w-100 darkbg" style="z-index: 999; max-height: 700px; left:1; margin-right:10px; overflow-y: scroll;">
            <center><p>Sonuçlar burada gözükecek.</p></center>      
        </div>
    </div>

    <?php if(isset($_SESSION["login"])){ 
        
        $bildirim = $conn->query("SELECT * FROM bildirimler WHERE kime_user = '".$user["id"]."'")->fetch(PDO::FETCH_ASSOC);

    ?>
    <div class="bildirim">
        <div id="bildirimpanel" class="ml-5 bildirimlerpanel col-3 pt-3 h-100 position-fixed darkbg" style="z-index:1000; overflow-y: scroll; height: 100%; margin-right:10px;">
            
        </div>
    </div>
    <?php } ?>

    <nav class="navmob navbar navbar-expand position-fixed w-100 darkbg" style=" z-index:9998; bottom:0;">
        <ul class="navbar-nav text-light nav-justified">
            <li class="nav-item">
                <a rel="yukleme" href="anasayfa" class="nav-link">
                    
                    <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') { ?>bi bi-house-door-fill pagebtncolor <?php } else { ?> bi bi-house-door<?php } ?>"></i>
                
                </a>
            </li>
            <li class="nav-item">
                <a rel="yukleme" href="kesfet" class="nav-link">
                    
                    <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'explore.php') { ?>bi bi-binoculars-fill pagebtncolor <?php } else { ?> bi bi-search<?php } ?>"></i>

                </a>
            </li>
            <li class="nav-item">
                <a rel="yukleme" href="sorucevap" class="nav-link">
                    
                    <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'sorucevap.php') { ?>bi bi-question-square-fill pagebtncolor <?php } else { ?> bi bi-question-square<?php } ?>"></i>

                </a>
            </li>
            <?php if(isset($_SESSION["login"])){ ?>
                <li style="position: relative;" class="nav-item bildarka noti_numbera">
                        
                        <a rel="yukleme" href="bildirimler" class="nav-link bildioku">
                            
                            <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'bildirimler.php') { ?>bi bi-bell-fill pagebtncolor <?php } else { ?> bi bi-bell<?php } ?>"></i>

                        </a>

                </li>
                <li class="nav-item">
                    <a rel="yukleme" class="nav-link" href="profilim.php?cat=sorular">

                        <img class="rounded-circle" style="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'profilim.php') { ?> border:2px solid #5F4B8B; <?php } ?> padding:1px;" src="<?php echo $user["avatar"]; ?>" width="25" height="25" />
                    
                    </a>
                </li>
            <?php }else{ ?>
                <li class="nav-item">
                    <a rel="yukleme" href="girisyap" class="nav-link">

                        <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'login.php') { ?>bi bi-person-fill pagebtncolor <?php } else { ?> bi bi-person<?php } ?>"></i>

                    </a>
                </li>
            <?php } ?>
        </ul>
    </nav>

    <nav class="navmobust navbar navbar-expand w-100 position-fixed darkbg" style="max-height: 100%; top:0;">
        <?php if(basename($_SERVER['SCRIPT_NAME']) == 'explore.php'){ ?>
        <ul class="navbar-nav w-100 p-1">
            <div class="aramob w-100">
                <form method="post">
                    <input class="aramoba float-left" type="search" placeholder="Üniversite veya Kullanıcı Ara" />
                </form>
                <div class="p-2 ml-2">
                    <span class="aramobiptal darkbg">İptal Et</span>
                </div>
            </div>
            <div id="sonuclarmob" class="p-3 darkbg">
                <center><p>Sonuçlar burada gözükecek.</p></center>
            </div>
        </ul>
        <?php }  else if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){ ?>
        <ul class="navbar-nav w-100">
            <li class="nav-item darkbg">
                <a rel="yukleme" class="navbar-brand" href="anasayfa">FORUMUNI</a>
            </li>
            <?php if (!isset($_SESSION["login"])) { ?>
            <li style="position: absolute; right: 15px; top: 10px;">
                <a rel="yukleme" style="font-size: 13px;" class="btn btn-primary" href="girisyap">Giriş Yap</a>
                <a rel="yukleme" style="font-size: 13px;" class="btn btn-outline-primary" href="kayitol">Üye Ol</a>
            </li>
            <?php } else{ ?>
            <li class="msgvar" style="position: absolute; right: 15px; top: 10px;">
                <span style="display: none; background: red; width: 7px; border-radius: 100px; height: 7px; position: absolute; right: 7px; top: 3px;"></span>
                <a class="nav-link" rel="yukleme" href="messages.php"><i class="bi bi-chat-right pr-2"></i></a>
            </li>
            <?php } ?>
        </ul>
        <?php }  else if(basename($_SERVER['SCRIPT_NAME']) == 'messages.php'){ ?>
        <ul class="navbar-nav" style="height: 35px;">
            <a rel="yukleme" href="javascript:history.back()" class="nav-item p-1 darkbg">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <?php 
            
            if(isset($_GET["user"]))
            {
                ?>
                
                <ul class="navbar-nav w-100 justify-content-center align-items-center d-flex">
                    <li class="nav-item darkbg">
                        <a class="w-100"><?=$_GET["user"]?></a>
                    </li>
                </ul>
                
                <?php
            }
            
            else
            {
                ?>
                
                <ul class="navbar-nav w-100 justify-content-center align-items-center d-flex">
                    <li class="nav-item darkbg">
                        <a class="w-100">Sohbetler</a>
                    </li>
                </ul>
                
                <?php
            }
            
            ?>
        </ul>
        <?php }  else if(basename($_SERVER['SCRIPT_NAME']) == 'user.php'){ ?>
        <ul class="navbar-nav">
            <a rel="yukleme" href="javascript:history.back()" class="nav-item p-1 darkbg">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <ul class="navbar-nav w-100 justify-content-center align-items-center d-flex">
                <li class="nav-item darkbg">
                    <a class="w-100"><?php echo $_GET["username"]; ?></a>
                </li>
            </ul>
        </ul>
        <?php }  else if(basename($_SERVER['SCRIPT_NAME']) == 'sorucevap.php'){ ?>
        <ul class="navbar-nav w-100">
            <li class="nav-item darkbg">
                <a class="navbar-brand">SORU CEVAP</a>
            </li>
        </ul>
        <?php }  else if(basename($_SERVER['SCRIPT_NAME']) == 'rezler.php'){ ?>
            <ul class="navbar-nav">
                <a rel="yukleme" href="javascript:history.back()" class="nav-item p-1 darkbg">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <ul class="navbar-nav w-100 justify-content-center align-items-center d-flex">
                    <li class="nav-item darkbg">
                        <a class="w-100">Rezlerim</a>
                    </li>
                </ul>
            </ul>
        <?php }  else if(basename($_SERVER['SCRIPT_NAME']) == 'bildirimler.php'){ ?>
        <ul class="navbar-nav w-100">
            <li class="nav-item darkbg">
                <a class="navbar-brand">BİLDİRİMLER</a>
            </li>
        </ul>
        <?php } else if (basename($_SERVER['SCRIPT_NAME']) == 'profilim.php') { ?>
        <ul class="navbar-nav w-100">
            <li class="nav-item darkbg">
                <a class="navbar-brand" href="#"><?php echo $_SESSION["username"]; ?></a>
                <a class="profilayarac"><i class="fas fa-bars position-absolute" style="right:23px; top:23px; cursor: pointer;"></i></a>
            </li>
        </ul>
        <?php }  else{ ?>
        <ul class="navbar-nav w-100">
            <a rel="yukleme" href="javascript:history.back()" class="nav-item p-1 darkbg">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
        </ul>
        <?php } ?>
    </nav>

<?php } ?>

<?php function sidebar() { ?>

<div class="col-3 sidebar">
    <div class="col-3 sidebar ads">
        <p>Advertisiment</p>
        <img src="https://img.webme.com/pic/i/isacotur/160x600banner_laptop.png" alt="">
    </div>
</div>

<?php } ?>

<?php function footer() { ?>

    <div class="container p-3 mt-5 mb-2 darkbg">
        <div class="row">
            <footer class="text-white foot">
                <!-- Copyright -->
                    <div>
                        © 2022 Copyright
                        <a class="text-info" href="https://forumuni.com/">forumuni</a>
                    </div>
                    <div>
                        <a rel="yukleme" href="gizlilik">Gizlilik Politikamız</a>
                    </div>
                <!-- Copyright -->
            </footer>
            
            <script>
                $(document).ready(function(){

                    $(".sociacya").on('click', function(){

                        $(".profilpopbac").css("opacity", "100");
                        $(".profilpopbac").css("pointer-events","auto");

                    });

                    $('.profilpopbac').on('click', function(){

                        $(".profilpopbac").css("opacity", "0");
                        $(".profilpopbac").css("pointer-events","none");

                    });

                    $(".bilbtn").on('click', function(){

                        $(".unibilgibac").css("opacity", "100");
                        $(".unibilgibac").css("pointer-events","auto");

                    });

                    $('.unibilgibac').on('click', function(){

                        $(".unibilgibac").css("opacity", "0");
                        $(".unibilgibac").css("pointer-events","none");

                    });

                    $("#msggonder").on('click', function(){

                        var kime = $("#kime").val();
                        var mesaj = $("#mesaj").val();

                        $.ajax({
                            type: "POST",
                            url: "ajax.php?option=msgsend",
                            timeout: 5000,
                            data:{"kime":kime, "mesaj":mesaj},
                            success: function(e)
                            {
                                $(".chatbox").html(e);
                                $("#mesaj").val("");
                                $('#msggonder').prop('disabled', true);
                                window.scrollTo(0,document.body.scrollHeight);
                            }
                        });

                    });


                    $("#mesaj").keyup(function(){
                        
                        var box = $(this).val();
                        
                        if(box == "")
                        {
                            $('#msggonder').prop('disabled', true);
                        }
                        else
                        {
                            $('#msggonder').prop('disabled', false);
                        }
                    });
                    

                    $("#unamecontrol").keyup(function(){
                        var uname = $(this).val();
                        $.ajax({
                            type: "POST",
                            url: "ajax.php?option=unamecont",
                            timeout: 5000,
                            data:{"uname":uname},
                            success: function(e)
                            {
                                $(".ucontrol").html(e);
                            }
                        });
                    });

                    $('.plus').click(function() {
                        $('.faba').toggleClass("active");
                    });

                    $('a[rel="yukleme"]').click(function(e){
                        $(".acilis").css("opacity", "100");
                        $(".acilis").css("pointer-events","auto");
                        pageurl = $(this).attr('href');
                        $.ajax({url:pageurl,success: function(data){
                            $('body').html(data).find("body").html();
                            setTimeout(function() { 
                                $(".acilis").css("opacity", "0");
                                $(".acilis").css("pointer-events","none");
                            }, 300);
                        }});        
                        if(pageurl!=window.location){
                            window.history.pushState({path:pageurl},'',pageurl);    
                        }
                        return false;  
                    });

                    $(window).bind('popstate', function() {
                        $.ajax({url:location.pathname,success: function(data){
                            $('body').html(data).find("body").html();
                        }});
                    });

                    $('.yukarikaydir').click(function () {
                        $("html, body").animate({
                            scrollTop: 175
                        }, 600);
                        return false;
                    });

                    setTimeout(function() { 
                        $(".acilis").css("opacity", "0");
                        $(".acilis").css("pointer-events","none");
                    }, 300);

                    setTimeout(function() { 
                        $(".acilisp").css("opacity", "0");
                        $(".acilisp").css("pointer-events","none");
                    }, 500);

                    /**
                     * BİLDİRİM OKU
                     */
                    $(".bildioku").click(function(){
                        $.ajax({
                        url: "ajax.php?option=oku",
                        timeout: 5000,
                        success: function(e)
                        {
                            
                        }
                    });
                    });

                    /**
                     * SORU CEVAP FİLTRE
                     */
                    $("#scfilter").change(function(){
                        var filter = $("#scfilter").val();
                        
                        if(filter == 1)
                        {
                            $(".genel").css("display","block");
                            $(".uni").css("display","none");
                            $(".bol").css("display","none");
                            $(".fak").css("display","none");
                            $(".yurtlar").css("display","none");
                            $(".unicheck").css("display","none");
                            $(".fakcheck").css("display","none");
                            $(".bolcheck").css("display","none");
                        }

                        else if(filter == 2)
                        {
                            $(".genel").css("display","none");
                            $(".uni").css("display","block");
                            $(".bol").css("display","none");
                            $(".fak").css("display","none");
                            $(".yurtlar").css("display","none");
                            $(".unicheck").css("display","block");
                            $(".fakcheck").css("display","none");
                            $(".bolcheck").css("display","none");
                            $("#unim").change(function(){
                                if ($(this).is(":checked")) 
                                {
                                    $(".uni").css("display","none");
                                    $(".unimegore").css("display","block");
                                }
                                else
                                {
                                    $(".uni").css("display","block");
                                    $(".unimegore").css("display","none");
                                }
                            });
                        }

                        else if(filter == 3)
                        {
                            $(".genel").css("display","none");
                            $(".uni").css("display","none");
                            $(".fak").css("display","block");
                            $(".bol").css("display","none");
                            $(".yurtlar").css("display","none");
                            $(".unicheck").css("display","none");
                            $(".fakcheck").css("display","block");
                            $(".bolcheck").css("display","none");
                            $("#fakm").change(function(){
                                if ($(this).is(":checked")) 
                                {
                                    $(".fak").css("display","none");
                                    $(".fakimagore").css("display","block");
                                }
                                else
                                {
                                    $(".fak").css("display","block");
                                    $(".fakimagore").css("display","none");
                                }
                            });
                        }

                        else if(filter == 4)
                        {
                            $(".genel").css("display","none");
                            $(".uni").css("display","none");
                            $(".fak").css("display","none");
                            $(".bol").css("display","block");
                            $(".yurtlar").css("display","none");
                            $(".unicheck").css("display","none");
                            $(".fakcheck").css("display","none");
                            $(".bolcheck").css("display","block");
                            $("#bolm").change(function(){
                                if ($(this).is(":checked")) 
                                {
                                    $(".bol").css("display","none");
                                    $(".bolumegore").css("display","block");
                                }
                                else
                                {
                                    $(".bol").css("display","block");
                                    $(".bolumegore").css("display","none");
                                }
                            });
                        }

                        else if(filter == 5)
                        {
                            $(".genel").css("display","none");
                            $(".uni").css("display","none");
                            $(".bol").css("display","none");
                            $(".fak").css("display","none");
                            $(".yurtlar").css("display","block");
                            $(".unicheck").css("display","none");
                            $(".fakcheck").css("display","none");
                            $(".bolcheck").css("display","none");
                        }
                    });


                    /**
                    * ANA SAYFA FİLTRE
                    */
                    $("#anafilter").change(function(){
                        var value = $(this).val();

                        switch(value)
                        {
                            case "1":
                                $(".enyeni").css("display","block");
                                $(".unimbol").css("display","none");
                                $(".unimhak").css("display","none");
                            break;

                            case "2":
                                $(".enyeni").css("display","none");
                                $(".unimbol").css("display","none");
                                $(".unimhak").css("display","block");
                            break;

                            case "3":
                                $(".enyeni").css("display","none");
                                $(".unimbol").css("display","block");
                                $(".unimhak").css("display","none");
                            break;
                        }
                    });


                    /**
                    * SORU PAYLAŞIM KATEGORİ
                    */
                    $("#kategori").change(function(){
                        var val = $(this).val();
                        switch(val)
                        {
                            case "0":
                                $(".uniac").css("display","none");
                                if($(".soru").val() != "")
                                {
                                    $('#paylas').prop('disabled', true);
                                }
                                $(".hata").css("display","block");
                                $(".fakac").css("display","none");
                                $(".bolac").css("display","none");
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                                $("#MemberBolums").val(0);
                            break;

                            case "1":
                                $(".uniac").css("display","none");
                                $(".hata").css("display","none");
                                $(".fakac").css("display","none");
                                $(".bolac").css("display","none");
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                                $("#MemberBolums").val(0);
                            break;

                            case "2":
                                $(".uniac").css("display","block");
                                $(".hata").css("display","none");
                                $(".fakac").css("display","none");
                                $(".bolac").css("display","none");
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                                $("#MemberBolums").val(0);
                            break;

                            case "3":
                                $(".uniac").css("display","block");
                                $(".hata").css("display","none");
                                $(".fakac").css("display","block");
                                $(".bolac").css("display","none");
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                                $("#MemberBolums").val(0);
                            break;

                            case "4":
                                $(".uniac").css("display","none");
                                $(".hata").css("display","none");
                                $(".fakac").css("display","none");
                                $(".bolac").css("display","block");
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                                $("#MemberBolums").val(0);
                            break;

                            case "5":
                                $(".uniac").css("display","none");
                                $(".hata").css("display","none");
                                $(".fakac").css("display","none");
                                $(".bolac").css("display","none");
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                                $("#MemberBolums").val(0);
                            break;
                        }
                    });


                    /**
                    * PAYLAŞIM YAPMA
                    */

                    $("#sendPostMob").on('click',function(){
                        $(".uniac").css("display","none");
                        $(".hata").css("display","none");
                        $(".uniyorum").css("display","none");
                        $(".fakac").css("display","none");
                        $(".bolac").css("display","none");
                        $(".postButton").css("display","block");
                        $(".paylasim").css("display","block");
                        $(".pop").css("display","flex");
                        $(".pop").css("align-items","center");
                        $(".pop").css("justify-content","center");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                        $("#sendPostMob").css("display","none");
                    });

                    $("#sendPostPopup").on('click',function(){
                        $(".uniac").css("display","none");
                        $(".hata").css("display","none");
                        $(".uniyorum").css("display","none");
                        $(".fakac").css("display","none");
                        $(".bolac").css("display","none");
                        $(".paylasim").css("display","block");
                        $(".postButton").css("display","block");
                        bildirimkapa();
                        arakapa();
                        $(".pop").css("display","flex");
                        $(".pop").css("align-items","center");
                        $(".pop").css("justify-content","center");
                        $("#pop-container").css("opacity","1");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("pointer-events","auto");
                    });

                    $("#closePostPopup").on('click',function(){
                        $("#kategori").val(0);
                        $("#pop-container").css("opacity","0");
                        $(".uniyorum").css("display","none");
                        $("#pop-container").css("pointer-events","none");
                        $(".soruPop").css("display","none");
                        $(".paylasim").css("display","none");
                        $(".duzenle").css("display","none");
                        $(".postButton").css("display","none");
                        $(".soruduzenlepop").css("display","none");
                        $(".aniduzenlepop").css("display","none");
                        $(".silpop").css("display","none");
                        $("#sendPostMob").css("display","block");
                        $(".uniinfoekle").css("display","none");
                        $(".sikayetpop").css("display","none");
                        $("#MemberUnis").val(0);
                        $("#MemberFaks").val(0);
                        $("#MemberBolums").val(0);
                        $(".postButton").css("display","block");
                        $(".silpop").css("display","none");
                        $(".aniPop").css("display","none");
                        $('html, body').css({overflow: 'auto',height: 'auto'});
                        $(".aniButton").css("display","block");
                        $('#uniyor input[type="radio"]').prop('checked', false);
                        $("#uniyorumtext").val(null);
                    });

                    /**
                    * PORFİL AYAR
                    */
                    $(".profilayarac").click(function(){
                        $("#closePostPopup").css("display","none");
                        $(".profilayar").css("display","block");
                        $("#pop-container").css("opacity","1");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("pointer-events","auto");
                    });

                    /**
                    * ŞİKAYET
                    */


                    $(".sikayet").click(function(){
                        const sikayetbtn = this;
                        var sikayetid = $(sikayetbtn).attr("title");

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=sikayet",
                            timeout: 5000,
                            data:{"sid":sikayetid},
                            success: function(e)
                            {
                                $(".sikayetpop").css("display","block");
                                $("#closePostPopup").css("display","none");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".sikayetcevap").click(function(){
                        const sikayetbtn = this;
                        var sikayetid = $(sikayetbtn).attr("title");

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=sikayetcevap",
                            timeout: 5000,
                            data:{"csid":sikayetid},
                            success: function(e)
                            {
                                $(".sikayetpop").css("display","block");
                                $("#closePostPopup").css("display","none");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".silcvpbtn").click(function()
                    {
                        const silbtn = this;
                        var silid = $(silbtn).attr("title");

                        $(".cevapsil").val(silid);
                        $("#closePostPopup").css("display","none");
                        $(".cevapsilpop").css("display","block");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                    });

                    $(".silbtn").click(function()
                    {
                        const silbtn = this;
                        var silid = $(silbtn).attr("title");

                        $(".sil").val(silid);
                        $("#closePostPopup").css("display","none");
                        $(".silpop").css("display","block");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                    });

                    $(".cevapsil").click(function(){
                        const silindibtn = this;
                        var silindiid = $(silindibtn).val();

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=cevapsil",
                            timeout: 5000,
                            data:{"cevapsilid":silindiid},
                            success: function(e)
                            {
                                $("#closePostPopup").css("display","none");
                                $(".cevapsilpop").css("display","none");
                                $(".silindipop").css("display","block");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".sil").click(function(){
                        const silindibtn = this;
                        var silindiid = $(silindibtn).val();

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=sil",
                            timeout: 5000,
                            data:{"silid":silindiid},
                            success: function(e)
                            {
                                $("#closePostPopup").css("display","none");
                                $(".silpop").css("display","none");
                                $(".silindipop").css("display","block");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".silkapat").click(function(){
                        $(".silindipop").css("display","none");
                        $(".profilayar").css("display","none");
                        $('html, body').css({overflow: 'auto',height: 'auto'});
                        $("#pop-container").css("opacity","0");
                        $("#closePostPopup").css("display","block");
                        $("#pop-container").css("pointer-events","none");
                        window.location.reload();
                    });

                    $(".sozkapat").click(function(){
                        $(".kullanicisozlesme").css("display","none");
                        $(".gizliliksozlesme").css("display","none");
                        $("#closePostPopup").css("display","block");
                        $('html, body').css({overflow: 'auto',height: 'auto'});
                        $("#pop-container").css("opacity","0");
                        $("#pop-container").css("pointer-events","none");
                    });

                    $(".sillkapat").click(function(){
                        $(".silpop").css("display","none");
                        $('html, body').css({overflow: 'auto',height: 'auto'});
                        $("#pop-container").css("opacity","0");
                        $("#closePostPopup").css("display","block");
                        $("#pop-container").css("pointer-events","none");
                    });

                    $(".sikayetkapat").click(function(){
                        $(".sikayetpop").css("display","none");
                        $('html, body').css({overflow: 'auto',height: 'auto'});
                        $("#pop-container").css("opacity","0");
                        $("#closePostPopup").css("display","block");
                        $("#pop-container").css("pointer-events","none");
                        window.location.reload();
                    });

                    $(".anisil").click(function(){
                        const silbtn = this;
                        var anisilid = $(silbtn).attr("title");

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=anisil",
                            timeout: 5000,
                            data:{"anisilid":anisilid},
                            success: function(e)
                            {
                                $("#closePostPopup").css("display","none");
                                $(".silpop").css("display","block");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".duzenlea").click(function(){
                        const dznbtn = this;
                        var dznbtnid = $(dznbtn).attr("title");

                        var dznbtnsoru = $(dznbtn).attr("value");

                        $(".dznhidden").val(dznbtnid);
                        $(".sorutext").val(dznbtnsoru);

                        $(".soruduzenlepop").css("display","block");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");

                    });

                    $(".aniduzenle").click(function(){
                        
                        const anidznbtn = this;
                        var anidznbtnid = $(anidznbtn).attr("title");

                        var dznbtnani = $(anidznbtn).attr("value");

                        $(".anidznhidden").val(anidznbtnid);
                        $(".anitext").val(dznbtnani);

                        $(".aniduzenlepop").css("display","block");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");

                    });

                    $(".sikayetani").click(function(){
                        const sikayetbtn = this;
                        var sikayetid = $(sikayetbtn).attr("title");

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=sikayetani",
                            timeout: 5000,
                            data:{"asid":sikayetid},
                            success: function(e)
                            {
                                $("#closePostPopup").css("display","none");
                                $(".sikayetpop").css("display","block");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".ksozlesme").click(function(){

                        $(".kullanicisozlesme").css("display","block");
                        
                        $("#closePostPopup").css("display","none");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");

                    });

                    $(".gsozlesme").click(function(){

                        $(".gizliliksozlesme").css("display","block");
                        
                        $("#closePostPopup").css("display","none");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");

                    });

                    $(".sikayetyorum").click(function(){
                        const sikayetbtn = this;
                        var sikayetid = $(sikayetbtn).attr("title");

                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=sikayetyorum",
                            timeout: 5000,
                            data:{"yorumsikayetid":sikayetid},
                            success: function(e)
                            {
                                $("#closePostPopup").css("display","none");
                                $(".sikayetpop").css("display","block");
                                $('html, body').css({overflow: 'hidden',height: '100%'});
                                $("#pop-container").css("opacity","1");
                                $("#pop-container").css("pointer-events","auto");
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });

                    $(".chat").niceScroll();

                    $(".ani").keyup(function(){
                        if($(".ani").val() != ""){
                            $('#anipaylas').prop('disabled', false);
                        }
                        else
                        {
                            $('#anipaylas').prop('disabled', true);
                        }
                    });

                    $(".soru").keyup(function(){
                        if($(".soru").val() != "" && $("#kategori").val() == 1 || $("#kategori").val() == 5)
                        {
                            $('#paylas').prop('disabled', false);
                        }

                        else if($("#kategori").val() == 2)
                        {
                            if($("#MemberUnis").val() != 0)
                            {
                                if($(".soru").val() != "" && $("#kategori").val() != 0){
                                    $('#paylas').prop('disabled', false);
                                }
                                else
                                {
                                    $('#paylas').prop('disabled', true);
                                }
                            }
                            else
                            {
                                $('#paylas').prop('disabled', true);
                            }
                        }

                        else if($("#kategori").val() == 3)
                        {
                            if($("#MemberFaks").val() != 0)
                            {
                                if($(".soru").val() != "" && $("#kategori").val() != 0){
                                    $('#paylas').prop('disabled', false);
                                }
                                else
                                {
                                    $('#paylas').prop('disabled', true);
                                }
                            }
                            else
                            {
                                $('#paylas').prop('disabled', true);
                                $("#MemberUnis").val(0);
                                $("#MemberFaks").val(0);
                            }
                        }

                        else if($("#kategori").val() == 4)
                        {
                            if($("#MemberBolums").val() != 0)
                            {
                                if($(".soru").val() != "" && $("#kategori").val() != 0){
                                    $('#paylas').prop('disabled', false);
                                }
                                else
                                {
                                    $('#paylas').prop('disabled', true);
                                }
                            }
                            else
                            {
                                $('#paylas').prop('disabled', true);
                            }
                        }

                        else
                        {
                            $('#paylas').prop('disabled', true);
                        }
                    });


                    /**
                    * YANIT LİSTELEME
                    */

                    $('.yanitac').click(function() { 
                        $(this).next('.yanitlar').css("display","block");
                    });

                    /**
                    * REZLEME
                    */
                    $('.rezle').click(function(){
                        const rezle_button = this;
                        var soruid = $(this).attr("title");
                        
                        $.ajax({
                            type:"POST",
                            url:"ajax.php?option=rezle",
                            timeout: 5000,
                            data:{"soruid":soruid},
                            success: function(e)
                            {
                                $(rezle_button).html(e);
                            }
                        })
                    });

                    /**
                     * TAKİP ETME
                     */
                    $('.takipet').click(function(){
                        var userid = $(this).attr("title");
                        var tkpbtn = this;
                        
                        $.ajax({
                            type:"POST",
                            url:"ajax.php?option=takipet",
                            timeout: 5000,
                            data:{"userid":userid},
                            success: function(e)
                            {
                                $(tkpbtn).html(e);
                                $(".msggo").css("display", "none");
                            }
                        })
                    });

                    /**
                     * ÜNİVERSİTE TAKİP ETME
                     */

                    $(".unitakipet").on('click', function(){

                        var uniida = $(this).attr("title");
                        var unitkp = this;
                        
                        $.ajax({
                            type:"POST",
                            url:"ajax.php?option=unitakip",
                            timeout: 5000,
                            data:{"uniida":uniida},
                            success: function(e)
                            {
                                $(unitkp).html(e);
                            }
                        })
                        
                    });



                    $("#MemberBoluma").change(function(){
                        if($("#MemberUnia").val() != 0 && $("#MemberFaka").val() != 0 && $("#MemberBoluma").val() != 0)
                        {
                            $("#uniekleinfo").prop("disabled", false);
                        }
                        else
                        {
                            $("#uniekleinfo").prop("disabled", true);
                        }
                    });

                    /**
                    * ÜNİVERSİTE YORUM
                    */

                    $("#yorumac").on('click', function(){
                        $(".uniyorum").css("display","block");
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                    });

                    $("#uninfo").on('click', function(){
                        $(".uniinfoekle").css("display","block");
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                    });

                    $("#uniyorumtext").keyup(function(){
                        if($("#uniyorumtext").val() != "" && ("input[name=mem]:checked").length > 0){
                            $('#uniyorumpaylas').prop('disabled', false);
                        }
                        else
                        {
                            $('#uniyorumpaylas').prop('disabled', true);
                        }
                    });

                    /**
                    * PROFİLİ DÜZENLE
                    */

                    $("#duzenleac").on('click', function(){
                        $(".duzenle").css("display","block");
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");


                        if (window.matchMedia('(max-width: 1300px)').matches) 
                        {
                            $('.duzenle').css({overflow: 'auto', height: 'auto'});
                        } 
                        
                        else 
                        {
                            $('html, body').css({overflow: 'hidden',height: '100%'});
                        }

                        bildirimkapa();
                        arakapa();
                    });


                    /**
                    * ARAMA
                    */
                    $(".aradesk").keyup(function(){
                        var value = $(this).val()
                        var data = "value="+value	
                        $.ajax({
                            
                            type: "POST",
                            url: "ajax.php?option=kesfet",
                            timeout: 5000,
                            data: data,
                            success: function(e){
                            
                                if(value == '')
                                {
                                    $("#sonuclar").html("<center><p>Sonuçlar burada gözükecek.</p></center>");
                                    
                                }
                                
                                else
                                {
                                    $("#sonuclar").css("display","block");
                                    $('#sonuclar').html(e);
                                }
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        })
                    });

                    $(".aramoba").click(function(){
                        $(".aramoba").css("width","85%");
                        $(".aramobiptal").css("opacity","1");
                        $(".aramobiptal").css("visibility","visible");
                        $("#sonuclarmob").css("display","block");
                    });

                    $(".aramobiptal").click(function(){
                        $(".aramoba").css("width","100%");
                        $(".aramobiptal").css("opacity","0");
                        $(".aramobiptal").css("visibility","hidden");
                        $("#sonuclarmob").css("display","none");
                        $(".aramoba").val("");
                        $("#sonuclarmob").html("<center><p>Sonuçlar burada gözükecek.</p></center>");
                    });

                    $(".aramoba").keyup(function(){
                        var value = $(this).val()
                        var data = "value="+value	
                        $.ajax({
                            
                            type: "POST",
                            url: "ajax.php?option=kesfetara",
                            timeout: 5000,
                            data: data,
                            success: function(e){
                            
                                if(value == '')
                                {
                                    $("#sonuclarmob").html("<center><p>Sonuçlar burada gözükecek.</p></center>");
                                }
                                
                                else
                                {
                                    $("#sonuclarmob").css("display","block");
                                    $('#sonuclarmob').html(e);
                                }
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        })
                    });


                    /**
                    * FAKÜLTE ÇEKME
                    */

                    $('#MemberUni').change(function(){
                        var uniid = $(this).val();
                        $.ajax(
                        {
                            type:"POST",
                            url:"ajax.php?option=fakulteliste",
                            timeout: 1000,
                            data:{"uni":uniid},
                            success: function(e)
                            {
                                $('#MemberFak').html(e);
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        })
                    });

                    $('#MemberUnia').change(function(){
                        var uniid = $(this).val();
                        $.ajax(
                        {
                            type:"POST",
                            url:"ajax.php?option=fakulteliste",
                            data:{"uni":uniid},
                            success: function(e)
                            {
                                $('#MemberFaka').html(e);
                            }
                        });
                    });

                    $('#MemberUnis').change(function(){
                        var uniid = $(this).val();
                        $.ajax(
                        {
                            type:"POST",
                            url:"ajax.php?option=fakulteliste",
                            data:{"uni":uniid},
                            success: function(e)
                            {
                                $('#MemberFaks').html(e);
                            }
                        });
                    });


                    /**
                    * ÜNİLİ DEĞİL
                    */

                    $("#unilidegil").change(function(){
                        if ($(this).is(':checked')) {
                            $("#unidegil").css("display","none");
                            $("#MemberUni").val(0);
                            $("#MemberFak").val(0);
                            $("#MemberBolum").val(0);
                        }
                        else
                        {
                            $("#unidegil").css("display","block");
                        }
                    })

                    /**
                    * ANI / SORU LİSTELEME
                    */

                    $("#sorularuser").on('click',function(){
                        $(".anilaruser").css("display","none");
                        $(".sr").addClass("buttonprfactive");
                        $(".sr").removeClass("buttonprfunactive");
                        $(".an").addClass("buttonprfunactive");
                        $(".an").removeClass("buttonprfactive");
                        $(".sorularuser").css("display","block");
                    });

                    $("#anilaruser").on('click',function(){
                        $(".anilaruser").css("display","block");
                        $(".an").addClass("buttonprfactive");
                        $(".an").removeClass("buttonprfunactive");
                        $(".sr").addClass("buttonprfunactive");
                        $(".sr").removeClass("buttonprfactive");
                        $(".sorularuser").css("display","none");
                    });


                    /**
                    * YANITLAMA
                    */
                    $(".yanitla").click(function(){
                        var cevapid = $(this).attr("title");
                        $.ajax({
                            type: "POST",
                            url:"ajax.php?option=yanitla",
                            timeout: 5000,
                            data:{"cid":cevapid},
                            success: function(e)
                            {
                                $("#cevap").html(e);
                            },
                            error: function( objAJAXRequest, strError ){
                                alert("Hata! Tip: " + strError);
                            }
                        });
                    });


                    $("#cevaptxt").keyup(function(){
                        if($("#cevaptxt").val() != ""){
                            $('#cevapbtn').prop('disabled', false);
                        }
                        else
                        {
                            $('#cevapbtn').prop('disabled', true);
                        }
                    });


                    $(".toggle-password").click(function() {
                        $(this).toggleClass("fa-eye fa-eye-slash");

                        var input = $($(this).attr("toggle"));

                        if (input.attr("type") == "password") {
                            input.attr("type", "text");
                        } else {
                            input.attr("type", "password");
                        }
                        
                    });


                    /**
                    * KOPYALAMA
                    */

                    $(".panoyakopyala").on('click',function(){
                        var title = $(this).attr("title");
                        $(this).children(".copyto").css("opacity","1");
                        setTimeout(function() { 
                            $(".copyto").css("opacity","0");
                        }, 1000);
                        var temp = $("<input>")
                        $("body").append(temp);
                        temp.val(title).select();
                        document.execCommand("copy");
                        temp.remove();
                    });

                    setInterval(loadDoc, 2000);
                    setInterval(msgvar, 2000);

                    });

                    function msgvar()
                    {
                        $.ajax({

                            type: "POST",
                            url: "ajax.php?option=msgvar",
                            timeout: 5000,
                            success: function(e)
                            {
                                $(".msgvar").html(e);
                            }

                        });
                    }

                    function loadDoc() {
                        $.ajax({
                            type: "POST",
                            url: "ajax.php?option=bildirim",
                            timeout: 5000,
                            success: function(e)
                            {
                                $(".noti_numbera").html(e);
                            }
                        });
                    }

                    $(function() { // Dropdown toggle
                    $('.dropmenuac').click(function() { 
                        $(this).next('.dropmenulist').slideToggle();
                    });

                    $(document).click(function(e) 
                    { 
                        var target = e.target; 
                        if (!$(target).is('.dropmenuac') && !$(target).parents().is('.dropmenuac')) 
                        //{ $('.dropdown').hide(); }
                        { $('.dropmenulist').slideUp(); }
                    });
                    });

                    

                    function bildirimac(){
                    arakapa();
                    $(".bildirimlerpanel").css("width","25%");
                    $(".bildirimlerpanel").css("opacity","100");
                    $(".nav-link span").addClass("spandisplay");
                    $(".logo").addClass("logodisplayb");
                    $(".logo").removeClass("logo");
                    $(".logo-text").addClass("logodisplay");
                    $(".bildirimkapa").css("display","block");
                    $(".bildirimac").css("display","none");
                    $(".nav").addClass("navwidth");
                    $(".bildirimlerpanel").css("transition","0.3s");
                    $('html, body').css({overflow: 'hidden',height: '100%'});
                    $.ajax({
                        url: "ajax.php?option=bildirimlerdesk",
                        timeout: 5000,
                        success: function(e)
                        {
                            $(".bildirimlerpanel").html(e);
                        }
                    });
                    $.ajax({
                        url: "ajax.php?option=oku",
                        timeout: 5000,
                        success: function(e)
                        {
                            
                        }
                    });
                    }

                    function bildirimkapa(){
                    $(".bildirimlerpanel").css("width","0");
                    $(".bildirimlerpanel").css("opacity","0");
                    $(".nav-link span").removeClass("spandisplay");
                    $(".logodisplayb").addClass("logo");
                    $(".logo").removeClass("logodisplayb");
                    $(".logo-text").removeClass("logodisplay");
                    $(".nav").removeClass("navwidth");
                    $(".bildirimac").css("display","block");
                    $(".bildirimkapa").css("display","none");
                    $('html, body').css({overflow: 'auto',height: 'auto'});
                    }

                    function araac(){
                    bildirimkapa();
                    $(".aradeskdiv").css("opacity","100");
                    $(".aradeskdiv").css("width","25%");
                    $(".nav-link span").addClass("spandisplay");
                    $(".arakapa").css("display","block");
                    $(".logo").addClass("logodisplayb");
                    $(".logo").removeClass("logo");
                    $(".logo-text").addClass("logodisplay");
                    $(".araac").css("display","none");
                    $(".nav").addClass("navwidth");
                    $('html, body').css({overflow: 'hidden',height: '100%'});
                    $(".aradeskdiv").css("transition","0.3s");
                    }

                    function arakapa(){
                    $(".aradeskdiv").css("width","0");
                    $(".aradeskdiv").css("opacity","0");
                    $(".nav-link span").removeClass("spandisplay");
                    $(".araac").css("display","block");
                    $(".logodisplayb").addClass("logo");
                    $(".logo").removeClass("logodisplayb");
                    $(".logo-text").removeClass("logodisplay");
                    $(".arakapa").css("display","none");
                    $(".nav").removeClass("navwidth");
                    $(".aradesk").val("");
                    $('html, body').css({overflow: 'auto',height: 'auto'});
                    $("#sonuclar").css("display","none");
                    }

                    function sorupopac()
                    {
                        $(".paylasim").css("display","block");
                        $(".soruPop").css("display","block");
                        $(".uniac").css("display","none");
                        $(".hata").css("display","none");
                        $(".uniyorum").css("display","none");
                        $(".fakac").css("display","none");
                        $(".bolac").css("display","none");
                        $(".pop").css("display","block");
                        $(".pop").css("align-items","start");
                        $(".pop").css("justify-content","flex-start");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $(".postButton").css("display","none");
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                    
                    }

                    function anipopac() {
                        $(".paylasim").css("display","block");
                        $(".aniPop").css("display","block");
                        $(".pop").css("display","block");
                        $(".pop").css("align-items","start");
                        $(".pop").css("justify-content","flex-start");
                        $('html, body').css({overflow: 'hidden',height: '100%'});
                        $(".postButton").css("display","none");
                        $("#pop-container").css("opacity","1");
                        $("#pop-container").css("pointer-events","auto");
                    }
            </script>
        </div>
    </div>

<?php } ?>


</body>
</html>