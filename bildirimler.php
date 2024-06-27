<?php

    include "core.php";
    head();

    if(!isset($_SESSION["login"]))
    {
        echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
        exit;
    }

    $uname = $_SESSION["username"];

    $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
    $user = $user->fetch(PDO::FETCH_ASSOC);

?>

<div class="mt-5 pt-4">
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
        <?php } ?>
    </div>

<?php

footer();

?>