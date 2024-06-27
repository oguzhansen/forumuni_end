<?php

    include "core.php";
    head();

    $username = $_GET["username"];

    $userget = $conn->query("SELECT * FROM users WHERE username = '$username'")->fetch(PDO::FETCH_ASSOC);

    if(isset($_SESSION["username"]))
    {
        $uname = $_SESSION["username"];
            
        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $user = $user->fetch(PDO::FETCH_ASSOC);

        $userid = $user["id"];

        if($uname == $username)
        {
            echo "<script>window.top.location='profilim'</script>";
        }
    }


    $uniget = $conn->query("SELECT * FROM universite WHERE universite_id = '".$userget["uni"]."'")->fetch(PDO::FETCH_ASSOC);

    $fakget = $conn->query("SELECT * FROM universite_fakulte WHERE fakulte_id = '".$userget["uni_fakulte"]."'")->fetch(PDO::FETCH_ASSOC);

    $bolget = $conn->query("SELECT * FROM bolumler WHERE bolum_id = '".$userget["uni_bolum"]."'")->fetch(PDO::FETCH_ASSOC);

    $takip = $conn->query("SELECT * FROM follows WHERE eden = '$userid' AND edilen = '".$userget["id"]."'")->rowCount();
    
    $takip2 = $conn->query("SELECT * FROM follows WHERE eden = '".$userget["id"]."' AND edilen = '$userid'")->rowCount();

?>

<div class="container">
    <div class="row pt-5">
        <div class="col">
            <center>
                <div class="card pcard hovercard pt-2 pl-5 pr-5 darkbg">
                    <div class="avatar">
                        <img alt="" class="rounded-circle" width="100px" src="<?php echo $userget["avatar"]; ?>">
                    </div>

                    <div class="info">
                        <div class="title pt-3">
                            <b>@<?php echo $userget["username"]; ?></b>
                        </div>
                    </div>

                    <div class="numbers justify-content-center align-items-center d-flex mt-3">

                        <div class="takip w-50" style="white-space: nowrap; overflow: hidden;">

                            <?php $takipa = $conn->query("SELECT * FROM follows WHERE eden = '".$userget["id"]."'")->rowCount(); ?>

                            <h5>
                                <?=$takipa?>
                                <br> 
                                <p class="text-muted  mt-2" style="font-size: 13px;">Takip Edilen</p>
                            </h5>

                        </div>

                        <div class="takipci w-50" style="white-space: nowrap; overflow: hidden;">
                            
                            <?php $takipet = $conn->query("SELECT * FROM follows WHERE edilen = '".$userget["id"]."'")->rowCount(); ?>

                            <h5>
                                <?=$takipet?>
                                <br> 
                                <p class="text-muted mt-2" style="font-size: 13px;">Takipçi</p>
                            </h5>

                        </div>

                        <div class="unibilgi w-50" style="white-space: nowrap; overflow: hidden;">

                            <span class="bilbtn">
                                <i class="fa-solid fa-building-columns"></i>
                                <br> 
                                <p class="text-muted mt-2" style="font-size: 13px;">Üniversite Bilgileri</p>
                            </span>

                            <div class="unibilgibac">
                                <div class="unibilgipop">
                                    <div>
                                        <?php if(isset($uniget['universite_id'])){ ?>
                                            <div class="desc pt-1"><?php echo $uniget['name']; ?></div>
                                            <div class="desc pt-1"><?php echo $fakget['name']; ?></div>
                                            <div class="desc pt-1 pb-3"><?php echo $bolget['bolum_adi']; ?></div>
                                        <?php } else { ?>
                                            <p>Üniversite Bilgisi Eklenmemiş.</p>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="islme pt-3">

                        <?php 
                        
                        if(isset($_SESSION["username"]))
                        {

                            ?>
                            
                            <span class="msggo">

                                <?php
                                    if($takip == 1)
                                    {
                                        echo '<a href="messages.php?user='.$username.'" class="buttonprf ml-1">Mesaj Gönder</a>';
                                    }
                                ?>
                            
                            </span>

                            <span class="takipet" title="<?=$userget["id"]?>">
                                <?php 
                                
                                    if($takip == 1)
                                    {
                                        echo '<span class="profilbtn" id="takipet"><i class="fa-solid fa-user-check"></i></span>';
                                    }
                                    else if($takip2 == 1)
                                    {
                                        echo '<span class="buttonprf" id="takipet">Geri Takip Et</span>';
                                    }
                                    else
                                    {
                                        echo '<span class="buttonprf" id="takipet">Takip Et</span>';
                                    }
                                
                                ?>
                            </span>

                            <?
                        }

                        ?>
                        <?php if($userget["twt"] != "" || $userget["insta"] != "" || $userget["yt"] != ""){ ?>
                        <span class="profilbtn sociacya">
                            <?php
                            
                            if($userget["insta"] != null)
                            {
                                echo '<i class="fa-brands fa-instagram"></i>';
                            }
                            else if($userget["twt"] != null)
                            {
                                echo '<i class="fa-brands fa-twitter"></i>';
                            }
                            else if($userget["yt"] != null)
                            {
                                echo '<i class="fa-brands fa-youtube"></i>';
                            }
                            
                            ?>
                        </span>
                        <div class="profilpopbac">
                            <div class="profilpop">
                                <h5 class="mt-3 mb-3">Sosyal Medya</h5>
                                    <div class="bottom">
                                        <?php if($userget["twt"] != ""){ ?>
                                            <div>
                                                <a class="text-white btn btn-primary w-100 pt-2 pb-2" href="https://www.twitter.com/<?php echo $userget["twt"]; ?>">
                                                    <i class="fa-brands fa-twitter"></i> <?php echo $userget["twt"]; ?>
                                                </a>
                                            </div>
                                        <?php } ?>

                                        <?php if($userget["insta"] != ""){ ?>
                                            <div>
                                                <a class="text-white btn btn-dark w-100 pt-2 pb-2" href="https://www.instagram.com/<?php echo $userget["insta"]; ?>">
                                                    <i class="fa-brands fa-instagram"></i> <?php echo $userget["insta"]; ?>
                                                </a>
                                            </div>
                                        <?php } ?>

                                        <?php if($userget["yt"] != ""){ ?>
                                            <div>
                                                <a class="text-white btn btn-danger w-100 pt-2 pb-2" href="https://www.youtube.com/<?php echo $userget["yt"]; ?>">
                                                    <i class="fa-brands fa-youtube"></i> <?php echo $userget["yt"]; ?>
                                                </a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                

                            </div>
                        </div>
                        <?php } ?>
                    </div>

                    <br>
                    <center>
                        <button class="sr buttonprfactive" id="sorularuser">Sorular</button>
                        <button class="an buttonprfunactive" id="anilaruser">Anılar</button>
                    </center>
                </div><br>
            </center>
            <div id="proflistuser">
                <div class="sorularuser">
                    <?php

                    $sorucek = $conn->query("SELECT * FROM sorular WHERE id = '".$userget["id"]."' ORDER BY soru_id desc");
                    $sorucount = $sorucek->rowCount();

                    if($sorucount == 0)
                    {
                        echo "<div class='alert alert-primary'>Kullanıcı henüz soru paylaşmamış.</div>";
                    } else {
                        while ($soru = $sorucek->fetch(PDO::FETCH_ASSOC)) {
                            // SORU KATEGORİSİ
                            $kat = $conn->query("SELECT * FROM sorucevapkat WHERE kat_id = '" . $soru["kat_id"] . "'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            // SORU CEVAP SAYISI
                            $cevap = $conn->query("SELECT count(*) as cevap_id FROM cevaplar WHERE soru_id = '" . $soru["soru_id"] . "'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            //SORU KATEGORİ ÜNİ, FAK, BOL
                            $soruni = $conn->query("SELECT * FROM universite WHERE universite_id = '" . $soru["uni_id"] . "'");
                            $soruuni = $soruni->fetch(PDO::FETCH_ASSOC);

                            $sorfak = $conn->query("SELECT * FROM universite_fakulte WHERE fakulte_id = '" . $soru["fak_id"] . "'");
                            $sorufak = $sorfak->fetch(PDO::FETCH_ASSOC);

                            $sorbol = $conn->query("SELECT * FROM bolumler WHERE bolum_id = '" . $soru["bol_id"] . "'");
                            $sorubol = $sorbol->fetch(PDO::FETCH_ASSOC);


                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$soru["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$soru["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }
                    ?>
                        
                    <div class="post-wrap">
                        <div class="post-header">
                            <img src="<?php echo $userget["avatar"]; ?>" alt="" class="avator">
                            <div class="post-header-info">
                                <?php if (isset($_SESSION["login"])) { ?>
                                    <div class="dropmenu" type="button" >
                                        <span class="dropmenuac">...</span>
                                        <div class="dropmenulist">
                                        <li><a role="menuitem" class=" sikayet" type="button" id="sikayet" title="<?php echo $soru["soru_id"]; ?>"> Şikayet Et</a></li>
                                        </div>
                                    </div>
                                <?php } ?>
                                <div class="post-location" onclick="location.href='soru.php?soruid=<?php echo $soru['soru_id']; ?>'">
                                    <b><?php echo $userget["username"]; ?></b> <span class="text-muted"> <?php echo zaman($soru["soru_tarih"]); ?> </span>

                                    <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                        <?php 
                                            if($katid["kat_id"] == 1){ echo "Genel Sorular"; }
                                            else if($katid["kat_id"] == 2){ echo $soruuni["name"]; }
                                            else if($katid["kat_id"] == 3){ echo $sorufak["name"];}
                                            else if($katid["kat_id"] == 4){ echo $sorubol["bolum_adi"];}
                                            else{ echo "Yurtlar Hakkında"; }
                                        ?>
                                    </span>

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

                <?php } } ?>
                
                </div>
                <div class="anilaruser">
                    <?php

                    $anicek = $conn->query("SELECT * FROM anilar WHERE id = '".$userget["id"]."' ORDER BY ani_id desc");
                    $anicount = $anicek->rowCount();

                    if($anicount == 0)
                    {
                        echo "<div class='alert alert-primary'>Kullanıcı henüz anı paylaşmamış.</div>";
                    } 
                    
                    else 
                    {
                        while ($ani = $anicek->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        
                        <div class="post-wrap">
                            <div class="post-header">
                                <img src="<?php echo $userget["avatar"]; ?>" alt="" class="avator">
                                <div class="post-header-info">
                                    <?php if (isset($_SESSION["login"])) { ?>
                                        <div class="dropmenu" type="button" >
                                            <span class="dropmenuac">...</span>
                                            <div class="dropmenulist">
                                                <li> <a role="menuitem" class="sikayetani" type="button" id="sikayetani" title="<?php echo $ani["ani_id"]; ?>"> Şikayet Et</a></li>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <b><?php echo $userget["username"]; ?></b> <span class="text-muted"> <?php echo zaman($ani["ani_tarih"]); ?> </span>

                                    <p><?php echo $ani["ani"]; ?></p>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php sidebar() ?>
    </div>
</div>


<?php 

footer();

?>