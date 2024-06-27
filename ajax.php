<?php

include "core.php";

$option = $_GET["option"];

if(isset($_SESSION["username"]))
{
    $uname = $_SESSION["username"];
            
    $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
    $user = $user->fetch(PDO::FETCH_ASSOC);

    $userid = $user["id"];
}

switch($option)
{
    case "kesfet":

        $value = $_POST["value"];
        
        $user = $conn->query("SELECT * FROM users where username LIKE '$value%'");
        $uni = $conn->query("SELECT * FROM universite where name LIKE '$value%'");

        while($useral = $user->fetch(PDO::FETCH_ASSOC))
        {
                
            ?>
            
            <div class="userlist pl-4 pr-4">
                <a rel="yukleme" href="<?php echo $useral['username']; ?>">
                    <div class="userpp float-left pr-3" style="overflow:hidden; margin: 0;">
                        <img class="rounded-circle" width="50px" height="50px" src="<?php echo $useral["avatar"]; ?>">
                    </div>
                    <div class="userinfo">
                        <span><?php echo "@".$useral["username"]; ?></span><br/>
                        <span class="text-muted" style="font-size:14px;"><?php echo $useral["adsoyad"]; ?></span>
                    </div>
                </a>
            </div><br/>

            <?php

        }


        while($unial = $uni->fetch(PDO::FETCH_ASSOC))
        {
                
            ?>
            
            <div class="userlist pl-4 pr-4">
                <a rel="yukleme" href="university.php?uniid=<?php echo $unial['universite_id']; ?>">
                    <div class="userpp float-left pr-3">
                        <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: fill;" src="<?php echo $unial["image"]; ?>">
                    </div>
                    <div class="userinfo">
                        <span style="overflow:hidden; -webkit-box-orient: vertical; -webkit-line-clamp: 1; display: -webkit-box;">
                            <?php echo $unial["name"]; ?>
                        </span>
                    </div>
                </a>
            </div><br/><br/>

            <?php
            
        }

        break;

        case "kesfetara":
            
            $value = $_POST["value"];
        
            $user = $conn->query("SELECT * FROM users where username LIKE '$value%'");
            $usercount = $user->rowCount();

            $uni = $conn->query("SELECT * FROM universite where name LIKE '$value%'");
            $unicount = $uni->rowCount();

            if($unicount < 1 && $usercount < 1)
            {
                echo "<div class='alert alert-danger'>Bu aramaya dair kayıtlarımız boş görünüyor.</div>";
            }

            while($useral = $user->fetch(PDO::FETCH_ASSOC))
            {
                    
                ?>
                
                <div class="userlist pl-4 pr-4">
                    <a rel="yukleme" href="<?php echo $useral['username']; ?>">
                        <div class="userpp float-left pr-3">
                            <img class="rounded-circle" width="50px" height="50px" src="<?php echo $useral["avatar"]; ?>">
                        </div>
                        <div class="userinfo">
                            <span><?php echo "@".$useral["username"]; ?></span><br/>
                            <span class="text-muted" style="font-size:14px;"><?php echo $useral["adsoyad"]; ?></span>
                        </div>
                    </a>
                </div><br/>

                <?php

            }


            while($unial = $uni->fetch(PDO::FETCH_ASSOC))
            {
                    
                ?>
                
                <div class="userlist pl-4 pr-4">
                    <a rel="yukleme" href="university.php?uniid=<?php echo $unial['universite_id']; ?>">
                        <div class="userpp float-left pr-3">
                            <img class="rounded-circle" style="width: 50px; height: 50px; object-fit: fill;" src="<?php echo $unial["image"]; ?>">
                        </div>
                        <div class="userinfo">
                            <span style="overflow:hidden; -webkit-box-orient: vertical; -webkit-line-clamp: 1; display: -webkit-box;">
                                <?php echo $unial["name"]; ?>
                            </span>
                        </div>
                    </a>
                </div><br/><br/>

                <?php
                
            }

        break;

        /**
         * FAKÜLTE LİSTE
         */

        case 'fakulteliste':

			$uniid = $_POST['uni'];
			$ekle = "<option value='0'>Fakülte Seç</option>";
			$uni = $conn->query("SELECT * FROM universite_fakulte WHERE universite_id = '$uniid' ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
			echo $ekle;
            foreach($uni as $items => $value){
				echo '<option value="'.$value['fakulte_id'].'">'.$value['name'].'</option>';
			}

		break;

        /**
         * REZLE
         */

         case 'rezle':
		    
			$zaman = time();
		
			$reza = $conn->query("select rez_id from rezler where soru_id = '".$_POST['soruid']."'");
			$rezcount = $reza->rowCount();
		
			$rezus = $conn->query("select * from rezler where soru_id = '".$_POST['soruid']."' and user_id = '".$user['id']."'");
			$rezuscount = $rezus->rowCount();
		
			
			if($rezuscount > 0)
			{
				$soru = $conn->query("DELETE FROM rezler where soru_id = '".$_POST['soruid']."' and user_id = '".$user['id']."'");
                
                echo "<span class='col rezlei'># ", $rezcount-1,"</span>";
			}
			else
			{
				$soru = $conn->query("INSERT INTO rezler(soru_id,user_id,rez_tarih) values('".$_POST['soruid']."','".$user['id']."','$zaman')");
				
                echo "<span class='col rezlendi'># ", $rezcount+1,"</span>";
			}
            

		break;

        case "bildirimlerdesk":

            ?>
            
            <div class="mb-3 ml-5" style="font-weight: bold; font-size: 20px;">Bildirimler <hr/></div>
            <?php
    
        $bildirimac = $conn->query("SELECT * FROM bildirimler WHERE kime_user = '".$user["id"]."' ORDER BY bildirim_id DESC");

        while($bildirim = $bildirimac->fetch(PDO::FETCH_ASSOC))
        {
            /**
             * BİLDİRİM KATEGORİSİ
             */
            $bildirimkat = $conn->query("SELECT * FROM bildirim_kat WHERE bildirim_katid = '".$bildirim["bildirim_katid"]."'");
            $kategori = $bildirimkat->fetch(PDO::FETCH_ASSOC);

            $katid = $kategori["bildirim_katid"];

            /**
             * BİLDİRİM USER
             */
            $bildirimuser = $conn->query("SELECT * FROM users WHERE id = '".$bildirim["user_id"]."'");
            $userbild = $bildirimuser->fetch(PDO::FETCH_ASSOC);

            ?>
            <div class="bildarka bildioku" title="<?php echo $bildirim["bildirim_id"]; ?>">
                <ul class="" style="padding: 0 35px; min-height: 60px; border: none;">
                    <a rel="yukleme" href="<?php echo $userbild["username"]; ?>">
                        <img src="<?php echo $userbild["avatar"]; ?>" class="float-left rounded-circle mr-3" width="50px">
                    </a>
                    <li style="list-style: none; padding-top: 11px; <?php if($bildirim["okundu"] == 0) { echo "color:white;"; } else { echo "color:#cec8d9;"; } ?>"  
                        <?php if($katid == 3 || $katid == 5){ ?>
                            onclick="location.href='university.php?uniid=<?php echo $bildirim['uni_id']; ?>'"
                        <?php } else if($katid == 6){ ?>
                            onclick="location.href='<?=$userbild['username']?>'"
                        <?php }else{ ?>
                            onclick="location.href='soru.php?soruid=<?php echo $bildirim['soru_id']; ?>'"
                        <?php } ?>>
                        <a rel="yukleme" href="<?php echo $userbild["username"]; ?>">
                            <b><?php echo $userbild["username"]." "; ?> </b>
                        </a>
                        <?php 
                            echo " ".$kategori["kat_name"]." "; 
                            if($katid == 1 || $katid == 2 || $katid == 4 )
                            {
                                echo $bildirim["cevap"];
                            }
                            else if($katid == 3)
                            {
                                echo substr($bildirim["yorum"],0,60);
                            }
                            echo "<span class='text-muted' style='font-size:13px;'> ".zaman($bildirim["bildirim_tarih"])."</span>";
                        ?>
                    </li>
                </ul>
            </div>
            <hr/>
        <?php } 

        break;

        case "oku":

            $soru = $conn->query("UPDATE bildirimler SET okundu = '1' WHERE kime_user = '$userid'")->fetchAll(PDO::FETCH_ASSOC);

        break;

        case "yanitla":
        
            $cevapid = $_POST["cid"];

            $cevap = $conn->query("SELECT * FROM cevaplar WHERE cevap_id = '$cevapid'")->fetch(PDO::FETCH_ASSOC);

            $cevapuser = $conn->query("SELECT * FROM users WHERE id = '".$cevap["id"]."'")->fetch(PDO::FETCH_ASSOC);

            $etktid = $cevapuser["id"];

            ?>
            
            <form method="post">
                <textarea name="cevapetiket" id="cevaptxt" rows="5" required placeholder="<?php echo $cevapuser["username"]; ?>'ne yanıt veriyorsun..."></textarea><br>
                <input type="hidden" value="<?php echo $etktid; ?>" name="etiketlenen" />
				<input type="hidden" value="<?php echo $cevapid; ?>" name="cevapid" />
                <button name="etiketbtn" id="cevapbtn" class="buttonprf">Yanıtla</button>
            </form>

            <?php

        break;

        case "bildirim":
            
            $bild = $conn->query("SELECT * FROM bildirimler WHERE kime_user = '$userid' and okundu = 0")->rowCount();

            if($bild == 0)
            {
                ?>
                
                <a rel="yukleme" href="bildirimler" class="nav-link bildioku">
                    <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'bildirimler.php') { ?>bi bi-bell-fill pagebtncolor <?php } else { ?> bi bi-bell<?php } ?>"></i>
                </a>

                <?php
            }
            else
            {

                ?>
                
                <span class="bildvar" style="background: red; width: 7px; border-radius: 100px; height: 7px; position: absolute; right: 23px; top: 0;"></span>

                <a rel="yukleme" href="bildirimler" class="nav-link bildioku">
                    <i style="font-size:20px;" class="<?php if (basename($_SERVER['SCRIPT_NAME']) == 'bildirimler.php') { ?>bi bi-bell-fill pagebtncolor <?php } else { ?> bi bi-bell<?php } ?>"></i>
                </a>

                <?php
            }

        break;

        case "sikayet":

            $soruid = $_POST["sid"];

            $sikayetet = $conn->query("INSERT INTO sikayetler(sikayet_tur, soru_id, ani_id, yorum_id, sikayeteden) values('1','$soruid','0','0','$userid')");

        break;

        case "sikayetani":

            $aniid = $_POST["asid"];

            $sikayetet = $conn->query("INSERT INTO sikayetler(sikayet_tur, soru_id, ani_id, yorum_id, sikayeteden) values('2','0','$aniid','0','$userid')");

        break;

        case "sikayetcevap":

            $cevapid = $_POST["csid"];

            $sikayetet = $conn->query("INSERT INTO sikayetler(sikayet_tur, soru_id, ani_id, yorum_id, cevap_id, sikayeteden) values('4','0','0','0','$cevapid','$userid')");

        break;

        case "sil":

            $silid = $_POST["silid"];

            $sikayetet = $conn->query("DELETE FROM sorular WHERE soru_id = '$silid'");
            $sorurezsil = $conn->query("DELETE FROM rezler WHERE soru_id = '$silid'");
            $bildsil = $conn->query("DELETE FROM bildirimler WHERE soru_id = '$silid'");
            $cevsil = $conn->query("DELETE FROM cevaplar WHERE soru_id = '$silid'");


            echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';

        break;

        case "anisil":

            $silid = $_POST["anisilid"];

            $sikayetet = $conn->query("DELETE FROM anilar WHERE ani_id = '$silid'");

            echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';

        break;

        case "duzenlesoru":

            $soruid = $_POST["duzenlesoru"];

            $soru = $conn->query("SELECT * FROM sorular WHERE soru_id = '$soruid'");
            $soru = $soru->fetch(PDO::FETCH_ASSOC);

            echo $soru["soru"];

        break;

        case "sikayetyorum":
            
            $yorumid = $_POST["yorumsikayetid"];

            $sikayetet = $conn->query("INSERT INTO sikayetler(sikayet_tur, soru_id, ani_id, yorum_id, sikayeteden) values('3','0','0','$yorumid','$userid')");

        break;

        case "unamecont":

            $username = $_POST["uname"];

            $usernamecont = $conn->prepare("SELECT * FROM users WHERE username = '$username'");
            $usernamecont->execute();
            $usernCont = $usernamecont->fetch(PDO::FETCH_ASSOC);

            if (!$usernCont) 
            {
                if($username == null)
                {
                    echo "<span class='text-success'>Boş bırakma cano</span>";
                }
                else
                {
                    echo "<span class='text-success'>Kullanılabilir</span>";
                }
            }
            else 
            {
                echo "<span class='text-danger'>Bu kullanıcı adı zaten kullanımda!</span>";
            }
        break;

        case "cevapsil":

            $silid = $_POST["cevapsilid"];

            $cevapsil = $conn->query("SELECT * FROM cevaplar WHERE cevap_id = '$silid'")->fetch(PDO::FETCH_ASSOC);

            $cevapsila = $conn->query("SELECT * FROM cevaplar WHERE cevapla_id = '$silid'");

            $cevapcnt = $cevapsila->rowCount();


            if($cevapsil["yanitvar"] == 1)
            {
                $cvpsil = $conn->query("DELETE FROM cevaplar WHERE cevap_id = '$silid'");

                $cvpsil = $conn->query("DELETE FROM bildirimler WHERE cevap = '".$cevapsil["cevap"]."'");

                $cvpsil = $conn->query("DELETE FROM cevaplar WHERE cevapla_id = '$silid'");
            }
            else
            {
                $cvpsil = $conn->query("DELETE FROM cevaplar WHERE cevap_id = '$silid'");

                $cvpsil = $conn->query("DELETE FROM bildirimler WHERE cevap = '".$cevapsil["cevap"]."'");
            }
            
            echo '<meta http-equiv="refresh" content="0;">';

        break;

        case "msgsend":

            $kime = $_POST["kime"];
            $mesaj = $_POST["mesaj"];
            $tarih = time();

            $odacontrol = $conn->query("SELECT * FROM messageroom WHERE (user1 = '$userid' AND user2 = '$kime') OR (user2 = '$userid' AND user1 = '$kime')")->rowCount();

            if($odacontrol == 1)
            {
                $msgekle = $conn->query("INSERT INTO messages(kimden, kime, message, tarih) VALUES('$userid','$kime','$mesaj','$tarih')");

                if($msgekle)
                {

                    $insrooma = $conn->query("DELETE FROM messageroom WHERE (user1 = '$userid' AND user2 = '$kime') OR (user1 = '$kime' AND user2 = '$userid')");

                    $insroom = $conn->query("INSERT INTO messageroom(user1, user2) VALUES('$userid','$kime')");

                    $usercek = $conn->query("SELECT * FROM users WHERE id = '$kime'")->fetch(PDO::FETCH_ASSOC);

                    $usermessage = $conn->query("SELECT * FROM messages WHERE (kimden = '".$user["id"]."' AND kime = '".$usercek["id"]."') OR (kimden = '".$usercek["id"]."' AND kime = '".$user["id"]."')");

                    $usermsgc = $usermessage->rowCount();

                    $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '".$usercek["id"]."' OR kime = '".$usercek["id"]."') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

                    while($usermsg = $usermessage->fetch(PDO::FETCH_ASSOC))
                    {

                        if($usermsg["kime"] != $user["id"])
                        {

                            echo '<div class="msgbody">
                                <div class="containera darker">
                                    <p class="float-right w-100">'.$usermsg["message"].'</p>
                                    <span class="text-muted float-right">'.zaman($usermsg["tarih"]).'</span>
                                </div>
                            </div>';
                            

                        }

                        else
                        {
                            echo '
                            <div class="msgbody">
                                <div class="containera">
                                    <img src='.$usercek["avatar"].' alt="Avatar">
                                    <p>'.$usermsg["message"].'</p>
                                    <span class="text-muted float-right">'.zaman($usermsg["tarih"]).'</span>
                                </div>
                            </div>';
                        }
                    }

                    if($usermsgya["seen"] == 0 && $usermsgya["kimden"] == $userid)
                    {
                        echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Gönderildi</span>";
                    }
                    
                    else if($usermsgya["kimden"] == $userid)
                    { 
                        echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Görüldü</span>"; 
                    }
                }
                else
                {
                    echo "eklenmedi";
                }

            }
            else
            {
                $insroom = $conn->query("INSERT INTO messageroom(user1, user2) VALUES('$userid','$kime')");

                $msgekle = $conn->query("INSERT INTO messages(kimden, kime, message, tarih) VALUES('$userid','$kime','$mesaj','$tarih')");

                if($msgekle)
                {

                    $usercek = $conn->query("SELECT * FROM users WHERE id = '$kime'")->fetch(PDO::FETCH_ASSOC);

                    $usermessage = $conn->query("SELECT * FROM messages WHERE (kimden = '".$user["id"]."' AND kime = '".$usercek["id"]."') OR (kimden = '".$usercek["id"]."' AND kime = '".$user["id"]."')");

                    $usermsgc = $usermessage->rowCount();

                    $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '".$usercek["id"]."' OR kime = '".$usercek["id"]."') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

                    while($usermsg = $usermessage->fetch(PDO::FETCH_ASSOC))
                    {

                        if($usermsg["kime"] != $user["id"])
                        {

                            echo '<div class="msgbody">
                                <div class="containera darker">
                                    <p class="float-right w-100">'.$usermsg["message"].'</p>
                                    <span class="text-muted float-right">'.zaman($usermsg["tarih"]).'</span>
                                </div>
                            </div>';
                            

                        }

                        else
                        {
                            echo '
                            <div class="msgbody">
                                <div class="containera">
                                    <img src='.$usercek["avatar"].' alt="Avatar">
                                    <p>'.$usermsg["message"].'</p>
                                    <span class="text-muted float-right">'.zaman($usermsg["tarih"]).'</span>
                                </div>
                            </div>';
                        }
                    }
                    if($usermsgya["seen"] == 0 && $usermsgya["kimden"] == $userid)
                    {
                        echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Gönderildi</span>";
                    }
                    
                    else if($usermsgya["kimden"] == $userid)
                    { 
                        echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Görüldü</span>"; 
                    }
                }
                else
                {
                    echo "eklenmedi";
                }
            }

        break;

        case "msgref":

            $kime = $_POST["kime"];

            $usercek = $conn->query("SELECT * FROM users WHERE id = '$kime'")->fetch(PDO::FETCH_ASSOC);

            $oku = $conn->query("UPDATE messages SET seen = '1' WHERE kimden = '".$usercek["id"]."' AND kime = '$userid'");

            $usermessage = $conn->query("SELECT * FROM messages WHERE (kimden = '".$user["id"]."' AND kime = '".$usercek["id"]."') OR (kimden = '".$usercek["id"]."' AND kime = '".$user["id"]."')");

            $usermsgc = $usermessage->rowCount();

            $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '".$usercek["id"]."' OR kime = '".$usercek["id"]."') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

            if($usermsgc == 0)
            {
                echo "<div class='alert alert-info'>Sohbet Yok</div>";
            }

            while($usermsg = $usermessage->fetch(PDO::FETCH_ASSOC))
            {

                if($usermsg["kime"] != $user["id"])
                {

                    echo '<div class="msgbody">
                        <div class="containera darker">
                            <p class="float-right w-100">'.$usermsg["message"].'</p>
                            <span class="text-muted float-right">'.zaman($usermsg["tarih"]).'</span>
                        </div>
                    </div>';
                    

                }

                else
                {
                    echo '
                    <div class="msgbody">
                        <div class="containera">
                            <img src='.$usercek["avatar"].' alt="Avatar">
                            <p>'.$usermsg["message"].'</p>
                            <span class="text-muted float-right">'.zaman($usermsg["tarih"]).'</span>
                        </div>
                    </div>';
                }
            }

            if($usermsgya["seen"] == 0 && $usermsgya["kimden"] == $userid)
            {
                echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Gönderildi</span>";
            }
            
            else if($usermsgya["kimden"] == $userid)
            { 
                echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Görüldü</span>"; 
            }

        break;

        case "msgvar":


            $usermsga = $conn->query("SELECT * FROM messages WHERE kime = '$userid' AND seen = 0")->rowCount();


            if($usermsga == 0)
            {
                echo '<a class="nav-link" rel="yukleme" href="messages.php"><i class="bi bi-chat-right pr-2"></i></a>';
            }
            else
            {
                echo '
                    <span class="msgvar" style="background: red; width: 7px; border-radius: 100px; height: 7px; position: absolute; right: 7px; top: 3px;"></span>
                    <a class="nav-link" rel="yukleme" href="messages.php"><i class="bi bi-chat-right pr-2"></i></a>';
            }

        break;

        case "takipet":

            $user = $_POST["userid"];

            $zaman = time();

            $uscek = $conn->query("SELECT * FROM users WHERE id = '$user'")->fetch(PDO::FETCH_ASSOC);

            $kontrol = $conn->query("SELECT * FROM follows WHERE eden = '$userid' AND edilen = '$user'")->rowCount();

            if($kontrol == 0)
            {
                $tekle = $conn->query("INSERT INTO follows(eden, edilen) VALUES('$userid','$user')");

                echo '<a href="messages.php?user='.$uscek["username"].'" class="buttonprf ml-1">Mesaj Gönder</a>
                    <span class="profilbtn"><i class="fa-solid fa-user-check"></i></span>';

                $bildekle = $conn->query("INSERT INTO bildirimler(bildirim_katid, kime_user, user_id, bildirim_tarih) VALUES('6', '$user', '$userid', '$zaman')");
            }
            else
            {
                $tsil = $conn->query("DELETE FROM follows WHERE eden = '$userid' AND edilen = '$user'");

                $kontrol2 = $conn->query("SELECT * FROM follows WHERE eden = '$user' AND edilen = '$userid'")->rowCount();

                $bildsil = $conn->query("DELETE FROM bildirimler WHERE kime_user = '$user' AND user_id = '$userid' AND bildirim_katid = '6'");

                if($kontrol2 == 1)
                {
                    echo '<span class="buttonprf" id="takipet">Geri Takip Et</span>';
                }
                else
                {
                    echo '<span class="buttonprf" id="takipet">Takip Et</span>';
                }
            }
            
        break;

        case "unitakip":

            $uniida = $_POST["uniida"];

            $controla = $conn->query("SELECT * FROM uni_follows WHERE edenuni = '$userid' AND edilenuni = '$uniida'")->rowCount();

            if($controla == 0)
            {
                $uniet = $conn->query("INSERT INTO uni_follows(edenuni, edilenuni) VALUES('$userid', '$uniida')");

                echo '<span class="buttonprf">Takip Ediliyor</span>';
            }
            else
            {
                $unisil = $conn->query("DELETE FROM uni_follows WHERE edenuni = '$userid' AND edilenuni = '$uniida'");

                $unibild = $conn->query("DELETE FROM bildirimler WHERE bildirim_katid = '5' AND uni_id = '$uniida' AND kime_user = '$userid'");

                echo '<span class="buttonprf">Takip Et</span>';
            }

        break;

        case "userlist":

            $users = $conn->query("SELECT * FROM messageroom WHERE user1 = '$userid' OR user2 = '$userid' ORDER BY room_id DESC");

            while($userlist = $users->fetch(PDO::FETCH_ASSOC))
            {
                
                $usernamemsg = "";

                if($userlist["user1"] == $userid)
                {
                    $kimden = $conn->query("SELECT * FROM users WHERE id = '".$userlist["user2"]."'")->fetch(PDO::FETCH_ASSOC);

                    $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '$userid' and kime = '".$kimden["id"]."') or (kimden = '".$kimden["id"]."' and kime = '$userid') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

                    $usernamemsg = $kimden["username"];
                }
                else
                {
                    $kimden = $conn->query("SELECT * FROM users WHERE id = '".$userlist["user1"]."'")->fetch(PDO::FETCH_ASSOC);

                    $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '$userid' and kime = '".$kimden["id"]."') or (kimden = '".$kimden["id"]."' and kime = '$userid') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

                    $usernamemsg = $kimden["username"];
                }

                ?>
                
                    <div class="userlista p-4 msgoku" >
                        <a href="?user=<?=$usernamemsg?>">
                            <div class="userpp float-left pr-3">
                                <input type="hidden" class="msgkim" value="<?=$kimden["id"]?>">
                                <img class="rounded-circle" width="50px" height="50px" src="<?=$kimden["avatar"]?>">
                            </div>
                            <div class="userinfo">
                                <span><?=$usernamemsg?></span><br/>
                                <span class="<?php if($usermsgya["seen"] == 1 || $usermsgya["kimden"] == $user["id"]){ echo "text-muted";} ?>" style="font-size:16px;">
                                    <?php 
                                        echo $usermsgya["message"]; 
                                        
                                        if($usermsgya["seen"] == 0 && $usermsgya["kimden"] == $user["id"])
                                        {
                                            echo " · Gönderildi";
                                        }
                                        
                                        else if($usermsgya["kimden"] == $user["id"])
                                        { 
                                            echo " · Görüldü"; 
                                        }
                                    ?>
                                </span>
                            </div>
                        </a>
                    </div>
                
                <?php
            }

        break;

}

?>