<?php

    include "core.php";
    head();

    if(!isset($_SESSION["login"]))
    {
        echo '<meta http-equiv="refresh" content="0;url=anasayfa">';
        exit;
    }

    if(!isset($_GET["cat"]))
    {
        echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';
        exit;
    }
    
    $cat = $_GET["cat"];

    $uname = $_SESSION["username"];

    $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
    $user = $user->fetch(PDO::FETCH_ASSOC);

    $uniget = $conn->query("SELECT * FROM universite WHERE universite_id = '".$user["uni"]."'");
    $uniget = $uniget->fetch(PDO::FETCH_ASSOC);

    $fakget = $conn->query("SELECT * FROM universite_fakulte WHERE fakulte_id = '".$user["uni_fakulte"]."'");
    $fakget = $fakget->fetch(PDO::FETCH_ASSOC);

    $bolget = $conn->query("SELECT * FROM bolumler WHERE bolum_id = '".$user["uni_bolum"]."'");
    $bolget = $bolget->fetch(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row pt-5">
        <div class="col">
            <?php if($user["uyeonay"] == 2){ ?>
                <div style="width: 100%; background-color: brown; margin-top: 10px; padding: 5px; color: white;"> 
                <center><p>Lütfen e-Posta adresinizi gönderilen posta üzerinden onaylayın. Aksi takirde 1 Hafta içinde hesabınız bloke olacaktır.</p></center> </div><br/>
            <?php } ?>
            <center>
                <div class="hovercard pt-5 pl-5 pr-5 darkbg">
                    <div class="cardheader">
                    </div>
                    <div class="avatar">
                        <img alt="" class="rounded-circle" width="100px" height="100px" src="<?php echo $user["avatar"]; ?>">
                    </div>
                    <div class="info">
                        <div class="title pt-3">
                            <b><?php echo $user["username"]; ?></b>
                        </div>
                        <?php if (isset($uniget['universite_id'])) 
                        { ?>
                            <div class="desc pt-1"><?php echo $uniget['name']; ?></div>
                            <div class="desc pt-1"><?php echo $fakget['name']; ?></div>
                            <div class="desc pt-1 pb-3"><?php echo $bolget['bolum_adi']; ?></div>
                        <?php 
                        } 
                        
                        else
                        {
                        ?>
                        
                            <span id="uninfo" class="uninfo">Üniversite Bilgilerini Ekle</span>
                        
                        <?php } ?>

                    </div>
                    <?php if($user["twt"] != "" || $user["insta"] != "" || $user["yt"] != ""){ ?>
                        <div class="bottom">
                        <?php if($user["twt"] != ""){ ?>
                            <a class="text-white bg-primary btn" href="https://www.twitter.com/<?php echo $user["twt"]; ?>">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        <?php } ?>
                        <?php if($user["insta"] != ""){ ?>
                            <a class="text-white buttonprf btn" href="https://www.instagram.com/<?php echo $user["insta"]; ?>">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        <?php } ?>
                        <?php if($user["yt"] != ""){ ?>
                            <a class="text-white btn btn-danger" href="https://www.youtube.com/<?php echo $user["yt"]; ?>">
                                <i class="fa-brands fa-youtube"></i>
                            </a>
                        <?php } ?>
                        </div>
                    <?php } ?>
                    <br/>
                    <center>
                        <?php 
                            $unicom = $conn->query("SELECT count(*) as yorum_id FROM uni_comment WHERE id = '".$user["id"]."'")->fetch(PDO::FETCH_ASSOC);

                            if($unicom["yorum_id"] == 0 && isset($uniget['universite_id']))
                            { ?>

                            <button class="buttonprf" id="yorumac">Üniversiteni Yorumla</button>
                        <?php } ?>
                        <button id="duzenleac" class="buttonprf ml-1">Profili Düzenle</button>
                    <br>
                    <hr>
                    <a rel="yukleme" href="?cat=sorular"><button class="<?php if($cat == "sorular"){ ?>buttonprfactive<?php } else { ?>buttonprfunactive<?php } ?>">Sorularım</button></a>
                    <a rel="yukleme" href="?cat=anilar"><button class="<?php if($cat == "anilar"){ ?>buttonprfactive<?php } else { ?>buttonprfunactive<?php } ?> ml-1">Anılarım</button></a>
                    </center>
                </div>
            </center>
            <br/>
            <div id="proflist">
            <div class="acilisp darkbg">
                <img src="assets/img/loading.gif">
            </div>
                <?php if($cat == "sorular"){ ?>
                <div class="sorular">
                    <?php

                    $sorucek = $conn->query("SELECT * FROM sorular WHERE id = '".$user["id"]."' ORDER BY soru_id desc");
                    $sorucount = $sorucek->rowCount();

                    if($sorucount == 0)
                    {
                        echo "<div class='alert alert-primary'>Henüz soru paylaşmamışsın.</div>";
                    } 
                    else 
                    {
                        while($soru = $sorucek->fetch(PDO::FETCH_ASSOC))
                        {
                            // SORU KATEGORİSİ
                            $kat = $conn->query("SELECT * FROM sorucevapkat WHERE kat_id = '".$soru["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);
                            
                            // SORU CEVAP SAYISI
                            $cevap = $conn->query("SELECT count(*) as cevap_id FROM cevaplar WHERE soru_id = '".$soru["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            //SORU KATEGORİ ÜNİ, FAK, BOL
                            $soruni = $conn->query("SELECT * FROM universite WHERE universite_id = '".$soru["uni_id"]."'");
                            $soruuni = $soruni->fetch(PDO::FETCH_ASSOC);

                            $sorfak = $conn->query("SELECT * FROM universite_fakulte WHERE fakulte_id = '".$soru["fak_id"]."'");
                            $sorufak = $sorfak->fetch(PDO::FETCH_ASSOC);

                            $sorbol = $conn->query("SELECT * FROM bolumler WHERE bolum_id = '".$soru["bol_id"]."'");
                            $sorubol = $sorbol->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$soru["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$soru["soru_id"]."' and user_id = '".$user["id"]."'");
                                $rezuscount = $rezus->rowCount();
                            }

                    ?>
                    
                    <div class="post-wrap">
                        <div class="post-header">
                            <img src="<?php echo $user["avatar"]; ?>" alt="" class="avator">
                            <div class="post-header-info">
                                <div class="dropmenu" type="button" >
                                    <span class="dropmenuac">...</span>
                                    <div class="dropmenulist">
                                        <li><a class="duzenlea mb-2" type="button" id="duzenlea" title="<?php echo $soru["soru_id"]; ?>" value="<?php echo $soru["soru"]; ?>"> Düzenle</a></li>
                                        <li><a class="silbtn" type="button" id="silbtn" title="<?php echo $soru["soru_id"]; ?>"> Sil</a></li>
                                    </div>
                                </div>
                                <div class="post-location" onclick="location.href='soru.php?soruid=<?php echo $soru['soru_id']; ?>'">
                                    <div class="kisitla">
                                        <b><?php echo $user["username"]; ?></b> <span class="text-muted"> <?php echo zaman($soru["soru_tarih"]); ?> </span>

                                        <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                            <?php 
                                                if($katid["kat_id"] == 1){ echo "Genel Sorular"; }
                                                else if($katid["kat_id"] == 2){ echo $soruuni["name"]; }
                                                else if($katid["kat_id"] == 3){ echo $sorufak["name"];}
                                                else if($katid["kat_id"] == 4){ echo $sorubol["bolum_adi"];}
                                                else{ echo "Yurtlar Hakkında"; }
                                            ?>
                                        </span>
                                    </div>

                                    <p><?php echo $soru["soru"]; ?></p>
                                </div>
                                <?php if (isset($_SESSION["username"] )) { ?>
                                    <div style="float: left;" class="mr-5">
                                        <span class="rezle" id="rezle" type="button" title="<?php echo $soru["soru_id"]; ?>">
                                            <span class="col <?php if($rezuscount != 1){ echo "rezle"; } else{ echo "rezlendi"; } ?>"># <?php echo $rez["rez_id"]; ?></span>
                                        </span>
                                    </div>
                                    <div style="float: left;" class="mr-5">
                                        <a class="col" href="#cvp">
                                            <span>
                                                <i class="far fa-comment"></i> <?php echo $cevapcount["cevap_id"]; ?>
                                            </span>
                                        </a>
                                    </div>   
                                    <div style="float: left; position: relative;">
                                        <a type="button" class="col panoyakopyala" id="panoyakopyala" title="http://forumuni.com/soru.php?soruid=<?php echo $soru['soru_id']; ?>">
                                            <i class="fa-solid fa-share"></i>
                                            <div class="copyto">Kopyalandı</div>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <?php } }?>
                
                </div>
                <?php } else if($cat == "anilar"){ ?>
                <div class="anilar">
                    <?php
                    
                        $anicek = $conn->query("SELECT * FROM anilar WHERE id = '".$user["id"]."' ORDER BY ani_id desc");
                        $anicount = $anicek->rowCount();

                        if($anicount == 0)
                        {
                            echo "<div class='alert alert-primary'>Henüz anı paylaşmamışsın.</div>";
                        } 
                        else 
                        {
                            while ($ani = $anicek->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <div class="post-wrap">
                                <div class="post-header">
                                    <img src="<?php echo $user["avatar"]; ?>" alt="" class="avator">
                                    <div class="post-header-info">
                                        <div class="kisitla">
                                            <div class="dropmenu" type="button" >
                                                <span class="dropmenuac">...</span>
                                                <div class="dropmenulist">
                                                <li><a class="aniduzenle" type="button" id="aniduzenle" title="<?php echo $ani["ani_id"]; ?>" value="<?php echo $ani["ani"]; ?>">Düzenle</a></li>
                                                <li><a class="anisil" type="button" id="anisil" title="<?php echo $ani["ani_id"]; ?>">Sil</a></li>
                                                </div>
                                            </div>
                                            <b><?php echo $user["username"]; ?></b> <span class="text-muted"> <?php echo zaman($ani["ani_tarih"]); ?> </span>
                                        </div>
                                        <p><?php echo $ani["ani"]; ?></p>
                                    </div>
                                </div>
                            </div>
                                

                            <?php
                            }
                        }
                    
                    ?>
                </div>
                <?php } 
                else 
                {
                    echo '<meta http-equiv="refresh" content="0;url=profilim.php?cat=sorular">';
                    exit;
                }
                
                
                ?>
            </div>
        </div>
    </div>
</div>

<?php 

footer();

?>