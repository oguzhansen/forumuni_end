<?php

    include "core.php";
    head();

    if(isset($_SESSION["username"]))
    {
        $uname = $_SESSION["username"];
            
        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $user = $user->fetch(PDO::FETCH_ASSOC);

        $userid = $user["id"];
    }

    $soruid = $_GET["soruid"];

    $soruceka = $conn->query("SELECT * FROM sorular where soru_id = '$soruid'");
    $sorucek = $soruceka->fetch(PDO::FETCH_ASSOC);

    if($soruid != $sorucek["soru_id"])
    {
        echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
    }
    
    else
    {

    $userceka = $conn->query("SELECT * FROM users where id = '".$sorucek["id"]."'");
    $usercek = $userceka->fetch(PDO::FETCH_ASSOC);

    /** Soru Üniversite */
    $uni = $conn->query("select * from universite where universite_id = '".$sorucek["uni_id"]."'");
    $unial = $uni->fetch(PDO::FETCH_ASSOC);

    /** Soru Fakülte */
    $unifak = $conn->query("select * from universite_fakulte where fakulte_id = '".$sorucek["fak_id"]."'");
    $unifakal = $unifak->fetch(PDO::FETCH_ASSOC);

    /** Soru Bölüm */
    $unibol = $conn->query("select * from bolumler where bolum_id = '".$sorucek["bol_id"]."'");
    $unibolal = $unibol->fetch(PDO::FETCH_ASSOC);

    /** Soru Kategori */
    $kat = $conn->query("select * from sorucevapkat where kat_id = '".$sorucek["kat_id"]."'");
    $katid = $kat->fetch(PDO::FETCH_ASSOC);

    $cevapcount = $conn->query("SELECT count(*) as cevap_id FROM cevaplar where soru_id = '$soruid'");
    $cevapcount = $cevapcount->fetch(PDO::FETCH_ASSOC);

    $cevap = $conn->query("SELECT * FROM cevaplar where soru_id = '$soruid' and etiketlenen = '0' ORDER BY cevap_id DESC");
    
    if(isset($_SESSION["username"]))
    {
        $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '$soruid'");
        $rez = $rez->fetch(PDO::FETCH_ASSOC);

        $rezus = $conn->query("select * from rezler where soru_id = '$soruid' and user_id = '$userid'");
        $rezuscount = $rezus->rowCount();
    }

?>

<div class="container pt-5">
    <div class="row pt-2">
        <div class="col">
            <div class="post-wrap">
                <div class="post-header">
                    <a href="<?php echo $usercek["username"]; ?>">
                        <img src="<?php echo $usercek["avatar"]; ?>" alt="" class="avator">
                    </a>
                    <div class="post-header-info">
                        <div class="kisitla">
                                <?php if(isset($_SESSION["username"])) { ?>

                                <div class="dropmenu" type="button" >
                                    <span class="dropmenuac">...</span>
                                    <div class="dropmenulist">
                                        <?php if($sorucek["id"] != $userid){ ?>
                                            <li><a role="menuitem" class=" sikayet" type="button" id="sikayet" title="<?php echo $sorucek["soru_id"]; ?>"> Şikayet Et</a></li>
                                        <?php } else { ?>
                                            <li><a class="duzenlea mb-2" type="button" id="duzenlea" title="<?php echo $sorucek["soru_id"]; ?>" value="<?php echo $sorucek["soru"]; ?>"> Düzenle</a></li>
                                            <li><a class="silbtn" type="button" id="silbtn" title="<?php echo $sorucek["soru_id"]; ?>"> Sil</a></li>
                                        <?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <a href="<?php echo $usercek["username"]; ?>">
                                <b><?php echo $usercek["username"]; ?></b> 
                            </a>
                            <span class="text-muted"> <?php echo zaman($sorucek["soru_tarih"]); ?> </span>
                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                <?php 
                                    if($katid["kat_id"] == 1){ echo "Genel Sorular"; }
                                    else if($katid["kat_id"] == 2){ echo $unial["name"]; }
                                    else if($katid["kat_id"] == 3){ echo $unifakal["name"];}
                                    else if($katid["kat_id"] == 4){ echo $unibolal["bolum_adi"];}
                                    else{ echo "Yurtlar Hakkında"; }
                                ?>
                            </span>
                        </div>

                        <p><?php echo $sorucek["soru"]; ?></p>
                        <?php if (isset($_SESSION["username"] )) { ?>
                            <div style="float: left;" class="mr-5">
                                <span class="rezle" id="rezle" type="button" title="<?php echo $sorucek["soru_id"]; ?>">
                                    <span class="col <?php if($rezuscount != 1){ echo "rezle"; } else{ echo "rezlendi"; } ?>"># <?php echo $rez["rez_id"]; ?></span>
                                </span>
                            </div>
                            <div style="float: left;" class="mr-5">
                            <a class="yukarikaydir" style="cursor: pointer;">
                                <span>
                                    <i class="far fa-comment"></i> <?php echo $cevapcount["cevap_id"]; ?>
                                </span>
                            </a>
                            </div>   
                            <div style="float: left; position: relative;">
                                <a type="button" class="col panoyakopyala" id="panoyakopyala" title="http://forumuni.com/soru.php?soruid=<?php echo $sorucek['soru_id']; ?>">
                                    <i class="fa-solid fa-share"></i>
                                    <div class="copyto">Kopyalandı</div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <span id="cvp"></span>
            <br/>
            <p class="m-3 pb-2">Cevaplar <?php echo $cevapcount["cevap_id"]; ?></p>

            <?php if(isset($_SESSION["login"])){ ?>
                <div class="cevap" id="cevap">
                
                    <?php

                    if(isset($_POST["etiketbtn"]))
                    {
                        $cevapa      = $_POST["cevapetiket"];
                        $etiketlenen = $_POST["etiketlenen"];
                        $cevapid     = $_POST["cevapid"];
                        $zaman       = time();

                        $cevekle = $conn->query("INSERT INTO cevaplar(cevapla_id, soru_id, id, etiketlenen, cevap, cevap_tarih) VALUES   ('$cevapid','$soruid','$userid','$etiketlenen','$cevapa','$zaman')");

                        $cevguncelle = $conn->query("UPDATE cevaplar SET yanitvar = '1' WHERE cevap_id = '$cevapid' ");

                        $bildekle = $conn->query("INSERT INTO bildirimler(bildirim_katid, kime_user, user_id, soru_id, cevap, bildirim_tarih) VALUES('4','$etiketlenen','$userid','$soruid','$cevapa','$zaman')");


                        echo '<meta http-equiv="refresh" content="0;">';

                    }
                    
                    if(isset($_POST["cevapbtn"]))
                    {
                        $cevapa = $_POST["cevap"];
                        $zaman = time();

                        $cevekle = $conn->query("INSERT INTO cevaplar(soru_id, id, cevap, cevap_tarih) VALUES('$soruid','$userid','$cevapa','$zaman')");
                        
                        if($userid != $sorucek["id"])
                        {
                            $bildekle = $conn->query("INSERT INTO bildirimler(bildirim_katid, kime_user, user_id, soru_id, cevap, bildirim_tarih) VALUES('1','".$sorucek["id"]."','$userid','$soruid','$cevapa','$zaman')");
                        }

                        $rezbild = $conn->query("SELECT * FROM rezler WHERE soru_id = '$soruid'");

                        while($rezbildd = $rezbild->fetch(PDO::FETCH_ASSOC))
                        {
                            if($userid != $rezbildd["user_id"])
                            {
                                $user = $rezbildd["user_id"];
                                $bild = $conn->query("INSERT INTO bildirimler(bildirim_katid, kime_user, user_id, soru_id, cevap, bildirim_tarih) VALUES('2','$user','$userid','$soruid','$cevapa','$zaman')");
                            }
                        }

                        echo '<meta http-equiv="refresh" content="0;">';

                    }

                    ?>

                    <form method="post">
                        <textarea name="cevap" id="cevaptxt" rows="5" required></textarea><br>
                        <button name="cevapbtn" id="cevapbtn" disabled class="buttonprf">Cevapla</button>
                    </form>
                </div>
            <?php } ?>
            
            <?php if (!isset($_SESSION["login"])) { ?>
                <div class="alert alert-primary">Cevap verebilmek için lütfen <a rel="yukleme" class="text-primary" href="girisyap">giriş yapın.</a></div>
            <?php } ?>

            <?php
                while($cikti = $cevap->fetch(PDO::FETCH_ASSOC))
                {

                    $cevapcount = $conn->query("SELECT * FROM cevaplar WHERE cevapla_id = '".$cikti["cevap_id"]."'");

                    $cevapcnt = $cevapcount->rowCount();

                    if($cevapcnt == 0)
                    {
                        $cntguncelle = $conn->query("UPDATE cevaplar SET yanitvar = '0' WHERE cevap_id = '".$cikti["cevap_id"]."'");
                    }

                    $cevapyazan = $conn->query("SELECT * FROM users where id = '".$cikti["id"]."'");
                    $cevapyazan = $cevapyazan->fetch(PDO::FETCH_ASSOC);

                    $cevapuni = $conn->query("SELECT * FROM universite where universite_id = '".$cevapyazan["uni"]."'");
                    $cevapuni = $cevapuni->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <div class="post-wrap mt-4">
                        <div class="post-header">
                            <a href="<?php echo $cevapyazan["username"]; ?>">
                                <img src="<?php echo $cevapyazan["avatar"]; ?>" alt="" class="avator">
                            </a>
                            <div class="post-header-info">
                            <div class="kisitla">
                                <?php if(isset($_SESSION["username"])) { ?>
                                    <div class="dropmenu" type="button" >
                                        <span class="dropmenuac">...</span>
                                        <div class="dropmenulist">
                                            <?php if($cikti["id"] != $userid){ ?>
                                                <li><a role="menuitem" class="sikayetcevap" type="button" id="sikayetcevap" title="<?php echo $cikti["cevap_id"]; ?>"> Şikayet Et</a></li>
                                            <?php } else { ?>
                                                <li><a class="silcvpbtn" type="button" id="silcvpbtn" title="<?php echo $cikti["cevap_id"]; ?>"> Sil</a></li>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php } ?>
                                <a href="<?php echo $cevapyazan["username"]; ?>">
                                    <b><?php echo $cevapyazan["username"]; ?></b> 
                                </a>
                                <span class="text-muted"> <?php echo zaman($cikti["cevap_tarih"]); ?> </span>
                                <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                    <?php 
                                        if(isset($cevapuni["name"]))
                                        {
                                            echo $cevapuni["name"];
                                        }
                                    ?>
                                </span>
                            </div>
                                <p class="soruindex">
                                        <?php echo $cikti["cevap"]; ?>
                                </p>
                                <?php if(isset($_SESSION["username"])) { ?>
                                    <div class="d-flex flex-row align-items-center w-100">
                                        <div id="yanitbtn" style="margin-top: -10px;">
                                            <a class="yukarikaydir" style="cursor: pointer;">
                                                <span id="yanitla" title="<?php echo $cikti["cevap_id"]; ?>" class="yanitla float-right" type="button">
                                                    <b class="text-muted">Yanıtla</b>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if($cikti["yanitvar"] != 0){ ?>
                                    <div class="yanitlist">
                                        <p class="yanitac text-muted" style="cursor: pointer;">--- Yanıtları Gör (<?=$cevapcnt?>)
                                            <div class="yanitlar" style="display: none;">
                                                <?php

                                                $yanitlar = $conn->query("SELECT * FROM cevaplar WHERE cevapla_id = '".$cikti["cevap_id"]."'");

                                                while($yanitcikti = $yanitlar->fetch(PDO::FETCH_ASSOC))
                                                {

                                                    $yanityazan = $conn->query("SELECT * FROM users where id = '".$yanitcikti["id"]."'");
                                                    $yanityazan = $yanityazan->fetch(PDO::FETCH_ASSOC);

                                                    $yanituni = $conn->query("SELECT * FROM universite where universite_id = '".$yanityazan["uni"]."'");
                                                    $yanituni = $yanituni->fetch(PDO::FETCH_ASSOC);
                                                    
                                                    $cevapetiket = $conn->query("SELECT * FROM users WHERE id = '".$yanitcikti["etiketlenen"]."'")->fetch(PDO::FETCH_ASSOC);

                                                    ?>
                                                    
                                                    <div class="post-wrap mt-4">
                                                        <div class="post-header">
                                                            <a href="<?php echo $yanityazan["username"]; ?>">
                                                                <img src="<?php echo $yanityazan["avatar"]; ?>" alt="" class="avatora">
                                                            </a>
                                                            <div class="post-header-info">
                                                                <div class="kisitla">
                                                                <?php if(isset($_SESSION["username"])) { ?>
                                                                    <div class="dropmenu" type="button" >
                                                                        <span class="dropmenuac">...</span>
                                                                        <div class="dropmenulist">
                                                                            <?php if($yanitcikti["id"] != $userid){ ?>
                                                                                <li><a role="menuitem" class="sikayetcevap" type="button" id="sikayetcevap" title="<?php echo $yanitcikti["cevap_id"]; ?>"> Şikayet Et</a></li>
                                                                            <?php } else { ?>
                                                                                <li><a class="silcvpbtn" type="button" id="silcvpbtn" title="<?php echo $yanitcikti["cevap_id"]; ?>"> Sil</a></li>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                                    <a href="<?php echo $yanityazan["username"]; ?>">
                                                                        <b><?php echo $yanityazan["username"]; ?></b> 
                                                                    </a>
                                                                    <span class="text-muted"> <?php echo zaman($yanitcikti["cevap_tarih"]); ?> </span>
                                                                    <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                                        <?php 
                                                                            if(isset($yanituni["name"]))
                                                                            {
                                                                                echo $yanituni["name"];
                                                                            }
                                                                        ?>
                                                                    </span>
                                                                </div>
                                                                <p class="soruindex">
                                                                        <?php echo $yanitcikti["cevap"]; ?>
                                                                </p>
                                                                <?php if(isset($_SESSION["username"])) { ?>
                                                                    <div class="d-flex flex-row align-items-center w-100">
                                                                        <div id="yanitbtn" style="margin-top: -10px;">
                                                                            <a class="yukarikaydir" style="cursor: pointer;">
                                                                                <span id="yanitla" title="<?php echo $cikti["cevap_id"]; ?>" class="yanitla float-right" type="button">
                                                                                    <b class="text-muted">Yanıtla</b>
                                                                                </span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php

                                                } ?>
                                            </div>
                                        </>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php
                } 
            ?>
        </div>
        <?php sidebar();} ?>
    </div>
</div>

<?php 

footer();

?>