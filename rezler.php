<?php


    include("core.php");

    head();

    if(isset($_SESSION["username"]))
    {
        $uname = $_SESSION["username"];
            
        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $user = $user->fetch(PDO::FETCH_ASSOC);

        $userid = $user["id"];
    }
    else
    {
        echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
        exit;
    }

    $rezler = $conn->query("SELECT * FROM rezler WHERE user_id = '$userid' ORDER BY soru_id DESC");
    ?>
    <div class="container pt-5">
        <div class="row pt-3">
            <div class="col">
                <?php
                    while($rezlerim = $rezler->fetch(PDO::FETCH_ASSOC))
                    {
                        $soruid = $rezlerim["soru_id"];
                        $ciktii = $conn->query("SELECT * FROM sorular WHERE soru_id = '$soruid'");
                        $cikti = $ciktii->fetch(PDO::FETCH_ASSOC);

                        /** Soru Kategori */
                        $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                        $katid = $kat->fetch(PDO::FETCH_ASSOC);

                        /** Cevap Count */
                        $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                        $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                        /** User */
                        $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                        $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                        /** Soru Üniversite */
                        $uni = $conn->query("select * from universite where universite_id = '".$cikti["uni_id"]."'");
                        $unial = $uni->fetch(PDO::FETCH_ASSOC);

                        /** Soru Fakülte */
                        $unifak = $conn->query("select * from universite_fakulte where fakulte_id = '".$cikti["fak_id"]."'");
                        $unifakal = $unifak->fetch(PDO::FETCH_ASSOC);

                        /** Soru Bölüm */
                        $unibol = $conn->query("select * from bolumler where bolum_id = '".$cikti["bol_id"]."'");
                        $unibolal = $unibol->fetch(PDO::FETCH_ASSOC);

                        $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                        $rez = $rez->fetch(PDO::FETCH_ASSOC);

                        $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                        $rezuscount = $rezus->rowCount();

                        ?>
                        
                    <div class="post-wrap">
                        <div class="post-header">
                            <a rel="yukleme" href="<?php echo $userinfo["username"]; ?>">
                                <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                            </a>    
                            <div class="post-header-info">
                                <?php if($userinfo["id"] != $userid){ ?>
                                    <div class="dropmenu" type="button" >
                                        <span class="dropmenuac">...</span>
                                        <div class="dropmenulist">
                                            <li> <a role="menuitem" class=" sikayet" type="button" id="sikayet" title="<?php echo $cikti["soru_id"]; ?>"> Şikayet Et</a></li>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="post-location kisitla">
                                    <a rel="yukleme" href="<?php echo $userinfo["username"]; ?>">
                                        <b><?php echo $userinfo["username"]; ?></b> 
                                    </a>    
                                    <span class="text-muted"> <?php echo zaman($cikti["soru_tarih"]); ?> </span>
                                <a rel="yukleme" href="soru.php?soruid=<?php echo $cikti['soru_id']; ?>">
                                    <span class="text-muted">
                                        <?php 
                                            if($katid["kat_id"] == 1){ echo "Genel Sorular"; }
                                            else if($katid["kat_id"] == 2){ echo $unial["name"]; }
                                            else if($katid["kat_id"] == 3){ echo $unifakal["name"];}
                                            else if($katid["kat_id"] == 4){ echo $unibolal["bolum_adi"];}
                                            else{ echo "Yurtlar Hakkında"; }
                                        ?>
                                    </span>
                                </a>
                                    <p><?php echo $cikti["soru"]; ?></p>
                                </div>
                                <?php if (isset($_SESSION["username"])) { ?>
                                    <div style="float: left;" class="mr-5">
                                        <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
                                            <span class="col <?php if($rezuscount != 1){ echo "rezle"; } else{ echo "rezlendi"; } ?>"># <?php echo $rez["rez_id"]; ?></span>
                                        </span>
                                    </div>
                                    <div style="float: left;" class="mr-5">
                                        <a class="col" rel="yukleme" href="soru.php?soruid=<?php echo $cikti['soru_id']; ?>">
                                            <span>
                                                <i class="far fa-comment"></i> <?php echo $cevapcount["cevap_id"]; ?>
                                            </span>
                                        </a>
                                    </div>   
                                    <div style="float: left; position: relative;">
                                        <a type="button" class="col panoyakopyala" id="panoyakopyala" title="http://forumuni.com/soru.php?soruid=<?php echo $cikti['soru_id']; ?>">
                                            <i class="fa-solid fa-share"></i>
                                            <div class="copyto">Kopyalandı</div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr>  
                    <?php } ?>
            </div>
        </div>
    </div>
    <?php

    footer();

?>

