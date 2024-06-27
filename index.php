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

?>

<div class="container pt-5">
    <?php if(isset($_SESSION["login"])){ ?> 
        <div class="faba justify-content-center align-items-center mobmen">
            <a onclick="sorupopac()" class="item">Soru</a>
            <a onclick="anipopac()" class="item">Anı</a>
            <div class="plus"><i class="fas fa-plus text-light"></i></div>
        </div>
    <?php } ?>
    <div class="row pt-4" >
        <div class="col">
            <?php if (isset($_SESSION["username"])) { if ($user["uyeonay"] == 2) { ?>
                <div style="width: 100%; background-color: brown; margin-top: 10px; padding: 5px; color: white;"> <center><p>Lütfen e-Posta adresinizi gönderilen posta üzerinden onaylayın. Aksi takirde 1 Hafta içinde hesabınız bloke olacaktır.</p></center> </div><br/>
            <?php }} ?>
            
            <?php if(isset($_SESSION["login"])){ 
                
                $unimhak = $conn->query("select * from sorular where kat_id = '2' and uni_id = '".$user["uni"]."' order by soru_id desc");
                $unimbol = $conn->query("select * from sorular where kat_id = '4' and bol_id = '".$user["uni_bolum"]."' order by soru_id desc");
                
                ?>
                <form class="form-outline" method="post">
                    <select id="anafilter" class="mb-3">
                        <option value="1">Takip Edilenler</option>
                        <option value="2">Üniversitem Hakkında</option>
                        <option value="3">Bölümüm Hakkında</option>
                    </select>
                </form>
            <?php } else { ?>

                <div class="alert alert-primary">Sisteme tam erişim sağlamak için lütfen <a rel="yukleme" href="girisyap" class="text-primary">giriş yapın</a></div>

            <?php } ?>
            <div class="anafilter">
                <div class="enyeni">
                    <?php
                        $soru = $conn->query("SELECT * FROM sorular WHERE id in (SELECT edilen FROM follows WHERE eden = '$userid') OR id = '$userid' order by soru_id desc");

                        $sorucount = $soru->rowCount();
                        for ($i = 0; $i < $sorucount; $i++) {
                            if ($i % 4 == 0 && $i <> 0) {
                                ?>
                                <div class="ads">
                                    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5727447479671642"
                                        crossorigin="anonymous"></script>
                                    <ins class="adsbygoogle"
                                        style="display:block"
                                        data-ad-format="fluid"
                                        data-ad-layout-key="-gg-2s-44+6e+mv"
                                        data-ad-client="ca-pub-5727447479671642"
                                        data-ad-slot="5540151038"></ins>
                                    <script>
                                        (adsbygoogle = window.adsbygoogle || []).push({});
                                    </script>
                                </div>
                                <?php
                                $sorucount = $sorucount + 1;
                            } 
                            else {
                                $cikti = $soru->fetch(PDO::FETCH_ASSOC);

                                /** Soru Kategori */
                                $kat = $conn->query("select * from sorucevapkat where kat_id = '" . $cikti["kat_id"] . "'");
                                $katid = $kat->fetch(PDO::FETCH_ASSOC);


                                /** Cevap Count */
                                $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '" . $cikti["soru_id"] . "'");
                                $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);


                                /** User */
                                $user = $conn->query("select * from users where id = '" . $cikti["id"] . "'");
                                $userinfo = $user->fetch(PDO::FETCH_ASSOC);


                                /** Soru Üniversite */
                                $uni = $conn->query("select * from universite where universite_id = '" . $cikti["uni_id"] . "'");
                                $unial = $uni->fetch(PDO::FETCH_ASSOC);

                                /** Soru Fakülte */
                                $unifak = $conn->query("select * from universite_fakulte where fakulte_id = '" . $cikti["fak_id"] . "'");
                                $unifakal = $unifak->fetch(PDO::FETCH_ASSOC);

                                /** Soru Bölüm */
                                $unibol = $conn->query("select * from bolumler where bolum_id = '" . $cikti["bol_id"] . "'");
                                $unibolal = $unibol->fetch(PDO::FETCH_ASSOC);

                                if (isset($_SESSION["username"])) {
                                    $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '" . $cikti["soru_id"] . "'");
                                    $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                    $rezus = $conn->query("select * from rezler where soru_id = '" . $cikti["soru_id"] . "' and user_id = '$userid'");
                                    $rezuscount = $rezus->rowCount();
                                }

                                ?>
                                <div class="post-wrap">
                                    <div class="post-header">
                                        <a href="<?php echo $userinfo["username"]; ?>">
                                            <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                        </a>
                                        <div class="post-header-info">
                                            <?php if (isset($_SESSION["login"])) {
                                                if ($userinfo["id"] != $userid) { ?>
                                                <div class="dropmenu" type="button" >
                                                    <span class="dropmenuac">...</span>
                                                    <div class="dropmenulist">
                                                        <li> <a role="menuitem" class=" sikayet" type="button" id="sikayet" title="<?php echo $cikti["soru_id"]; ?>"> Şikayet Et</a></li>
                                                    </div>
                                                </div>
                                            <?php }
                                            } ?>
                                            <div class="post-location" onclick="location.href='soru.php?soruid=<?php echo $cikti['soru_id']; ?>'">
                                                <div class="kisitla">
                                                    <a href="<?php echo $userinfo["username"]; ?>">
                                                        <b><?php echo $userinfo["username"]; ?></b> 
                                                    </a>    
                                                    <span class="text-muted"> <?php echo zaman($cikti["soru_tarih"]); ?> </span>

                                                    <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                        <?php
                                                        if ($katid["kat_id"] == 1) {
                                                            echo "Genel Sorular";
                                                        } else if ($katid["kat_id"] == 2) {
                                                            echo $unial["name"];
                                                        } else if ($katid["kat_id"] == 3) {
                                                            echo $unifakal["name"];
                                                        } else if ($katid["kat_id"] == 4) {
                                                            echo $unibolal["bolum_adi"];
                                                        } else {
                                                            echo "Yurtlar Hakkında";
                                                        }
                                                        ?>
                                                    </span>
                                            </div>

                                                <p><?php echo $cikti["soru"]; ?></p>
                                            </div>
                                            <?php if (isset($_SESSION["username"])) { ?>
                                                <div style="float: left;" class="mr-5">
                                                    <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
                                                        <span class="col <?php if ($rezuscount != 1) {
                                                            echo "rezle";
                                                        } else {
                                                            echo "rezlendi";
                                                        } ?>"># <?php echo $rez["rez_id"]; ?></span>
                                                    </span>
                                                </div>
                                                <div style="float: left;" class="mr-5">
                                                    <a class="col" href="soru.php?soruid=<?php echo $cikti['soru_id']; ?>">
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
                        <?php }
                        } ?>
                </div>
                
                <?php if (isset($_SESSION["login"])) { ?>

                <div class="unimhak" style="display: none;">
                    <?php

                    $sorucount = $unimhak->rowCount();
                    for ($i = 0; $i < $sorucount; $i++) {
                        if ($i % 4 == 0 && $i <> 0) {
                            ?>
                            <div class="ads">
                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5727447479671642"
                                    crossorigin="anonymous"></script>
                                <ins class="adsbygoogle"
                                    style="display:block"
                                    data-ad-format="fluid"
                                    data-ad-layout-key="-gg-2s-44+6e+mv"
                                    data-ad-client="ca-pub-5727447479671642"
                                    data-ad-slot="5540151038"></ins>
                                <script>
                                    (adsbygoogle = window.adsbygoogle || []).push({});
                                </script>
                            </div>
                            <?php
                            $sorucount = $sorucount + 1;
                        } 
                        else {
                            $cikti = $unimhak->fetch(PDO::FETCH_ASSOC);

                        /** Soru Kategori */
                        $kat = $conn->query("select * from sorucevapkat where kat_id = '" . $cikti["kat_id"] . "'");
                        $katid = $kat->fetch(PDO::FETCH_ASSOC);

                        /** Cevap Count */
                        $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '" . $cikti["soru_id"] . "'");
                        $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                        /** User */
                        $user = $conn->query("select * from users where id = '" . $cikti["id"] . "'");
                        $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                        /** Soru Üniversite */
                        $uni = $conn->query("select * from universite where universite_id = '" . $cikti["uni_id"] . "'");
                        $unial = $uni->fetch(PDO::FETCH_ASSOC);

                        if (isset($_SESSION["username"])) {
                            $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '" . $cikti["soru_id"] . "'");
                            $rez = $rez->fetch(PDO::FETCH_ASSOC);

                            $rezus = $conn->query("select * from rezler where soru_id = '" . $cikti["soru_id"] . "' and user_id = '$userid'");
                            $rezuscount = $rezus->rowCount();
                        }

                    ?>
                   <div class="post-wrap">
                        <div class="post-header">
                            <a href="<?php echo $userinfo["username"]; ?>">
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
                                <div class="post-location" onclick="location.href='soru.php?soruid=<?php echo $cikti['soru_id']; ?>'">
                                    <div class="kisitla">
                                        <a href="<?php echo $userinfo["username"]; ?>">
                                            <b><?php echo $userinfo["username"]; ?></b> 
                                        </a>  
                                        <span class="text-muted"> <?php echo zaman($cikti["soru_tarih"]); ?> </span>

                                        <span class="text-muted">
                                            <?php 
                                                if($katid["kat_id"] == 1){ echo "Genel Sorular"; }
                                                else if($katid["kat_id"] == 2){ echo $unial["name"]; }
                                                else if($katid["kat_id"] == 3){ echo $unifakal["name"];}
                                                else if($katid["kat_id"] == 4){ echo $unibolal["bolum_adi"];}
                                                else{ echo "Yurtlar Hakkında"; }
                                            ?>
                                        </span>
                                    </div>
                                    <p><?php echo $cikti["soru"]; ?></p>
                                </div>
                                <?php if (isset($_SESSION["username"])) { ?>
                                    <div style="float: left;" class="mr-5">
                                        <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
                                            <span class="col <?php if($rezuscount != 1){ echo "rezle"; } else{ echo "rezlendi"; } ?>"># <?php echo $rez["rez_id"]; ?></span>
                                        </span>
                                    </div>
                                    <div style="float: left;" class="mr-5">
                                        <a class="col" href="soru.php?soruid=<?php echo $cikti['soru_id']; ?>">
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
                    <?php }
                        } ?>
                </div>


                <div class="unimbol" style="display: none;">
                    <?php
                   $sorucount = $unimbol->rowCount();
                   for ($i = 0; $i < $sorucount; $i++) {
                       if ($i % 4 == 0 && $i <> 0) {
                           ?>
                           <div class="ads">
                               <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5727447479671642"
                                   crossorigin="anonymous"></script>
                               <ins class="adsbygoogle"
                                   style="display:block"
                                   data-ad-format="fluid"
                                   data-ad-layout-key="-gg-2s-44+6e+mv"
                                   data-ad-client="ca-pub-5727447479671642"
                                   data-ad-slot="5540151038"></ins>
                               <script>
                                   (adsbygoogle = window.adsbygoogle || []).push({});
                               </script>
                           </div>
                           <?php
                           $sorucount = $sorucount + 1;
                       } 
                       else {
                           $cikti = $unimbol->fetch(PDO::FETCH_ASSOC);

                        /** Soru Kategori */
                        $kat = $conn->query("select * from sorucevapkat where kat_id = '" . $cikti["kat_id"] . "'");
                        $katid = $kat->fetch(PDO::FETCH_ASSOC);

                        /** Cevap Count */
                        $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '" . $cikti["soru_id"] . "'");
                        $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                        /** User */
                        $user = $conn->query("select * from users where id = '" . $cikti["id"] . "'");
                        $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                        /** Soru Bölüm */
                        $unibol = $conn->query("select * from bolumler where bolum_id = '" . $cikti["bol_id"] . "'");
                        $unibolal = $unibol->fetch(PDO::FETCH_ASSOC);

                        if (isset($_SESSION["username"])) {
                            $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '" . $cikti["soru_id"] . "'");
                            $rez = $rez->fetch(PDO::FETCH_ASSOC);

                            $rezus = $conn->query("select * from rezler where soru_id = '" . $cikti["soru_id"] . "' and user_id = '$userid'");
                            $rezuscount = $rezus->rowCount();
                        }

                    ?>
                    <div class="post-wrap">
                        <div class="post-header">
                            <a href="<?php echo $userinfo["username"]; ?>">
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
                                <div class="post-location" onclick="location.href='soru.php?soruid=<?php echo $cikti['soru_id']; ?>'">
                                    <div class="kisitla">
                                        <a href="<?php echo $userinfo["username"]; ?>">
                                            <b><?php echo $userinfo["username"]; ?></b> 
                                        </a>   
                                        <span class="text-muted"> <?php echo zaman($cikti["soru_tarih"]); ?> </span>

                                        <span class="text-muted">
                                            <?php 
                                                if($katid["kat_id"] == 1){ echo "Genel Sorular"; }
                                                else if($katid["kat_id"] == 2){ echo $unial["name"]; }
                                                else if($katid["kat_id"] == 3){ echo $unifakal["name"];}
                                                else if($katid["kat_id"] == 4){ echo $unibolal["bolum_adi"];}
                                                else{ echo "Yurtlar Hakkında"; }
                                            ?>
                                        </span>
                                    </div>
                                    <p><?php echo $cikti["soru"]; ?></p>
                                </div>
                                <?php if (isset($_SESSION["username"])) { ?>
                                    <div style="float: left;" class="mr-5">
                                        <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
                                            <span class="col <?php if($rezuscount != 1){ echo "rezle"; } else{ echo "rezlendi"; } ?>"># <?php echo $rez["rez_id"]; ?></span>
                                        </span>
                                    </div>
                                    <div style="float: left;" class="mr-5">
                                        <a class="col" href="soru.php?soruid=<?php echo $cikti['soru_id']; ?>">
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
                    <?php }} ?>
                </div>
            
            <?php } ?>

            </div>
        </div>
    </div>
</div>



<?php 

footer();

?>