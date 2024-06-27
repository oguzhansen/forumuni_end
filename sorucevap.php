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

    $genels     = $conn->query("select * from sorular where kat_id = 1 order by soru_id desc");
    $unis       = $conn->query("select * from sorular where kat_id = 2 order by soru_id desc");
    $faks       = $conn->query("select * from sorular where kat_id = 3 order by soru_id desc");
    $bols       = $conn->query("select * from sorular where kat_id = 4 order by soru_id desc");
    $yurtlars   = $conn->query("select * from sorular where kat_id = 5 order by soru_id desc");

    if (isset($_SESSION["login"])) {
        $unime      = $conn->query("select * from sorular where kat_id = '2' and uni_id = '".$user["uni"]."' order by soru_id desc");
        $fakima     = $conn->query("select * from sorular where kat_id = '3' and fak_id = '".$user["uni_fakulte"]."' order by soru_id desc");
        $bolume     = $conn->query("select * from sorular where kat_id = '4' and bol_id = '".$user["uni_bolum"]."' order by soru_id desc");
    }
?>

<div class="container pt-5">
    <div class="row pt-4">
        <div class="col">
            <?php if (isset($_SESSION["login"])) { ?>
                <form class="form-outline" method="post">
                    <select id="scfilter" class="mb-3">
                        <option value="1">Genel Sorular</option>
                        <option value="2">Üniversiteler Hakkında</option>
                        <option value="3">Fakülteler Hakkında</option>
                        <option value="4">Bölümler Hakkında</option>
                        <option value="5">Yurtlar Hakkında</option>
                    </select>
                </form>
                <div class="unicheck" style="display: none;">
                    <input type="checkbox" class="form-check-group" id="unim" />
                    <label for="unim">Kendi Üniversitem</label>
                </div>
                <div class="fakcheck" style="display: none;">
                    <input type="checkbox" class="form-check-group" id="fakm" />
                    <label for="fakm">Kendi Fakültem</label>
                </div>
                <div class="bolcheck" style="display: none;">
                    <input type="checkbox" class="form-check-group" id="bolm" />
                    <label for="bolm">Kendi Bölümüm</label>
                </div>
            <?php } ?>

            <?php if (!isset($_SESSION["login"])) { ?>
                <div class="alert alert-primary">Tüm kategorilere erişmek için lütfen <a rel="yukleme" class="text-primary" href="girisyap">giriş yapın.</a></div>
            <?php } ?>

            <div class="sorucevapfiltre">
                <div class="genel">
                    <?php
                        while($cikti = $genels->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo "Genel Sorular"; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>
            <?php if (isset($_SESSION["login"])) { ?>
                <div class="uni" style="display: none;">
                    <?php
                        while($cikti = $unis->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            /** Üniversite */
                            $unisoruu = $conn->query("select * from universite where universite_id = '".$cikti["uni_id"]."'");
                            $unisoru = $unisoruu->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo $unisoru["name"]; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>

                <div class="unimegore" style="display: none;">
                    <?php
                        while($cikti = $unime->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            /** Üniversite */
                            $unisoruu = $conn->query("select * from universite where universite_id = '".$cikti["uni_id"]."'");
                            $unisoru = $unisoruu->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo $unisoru["name"]; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>

                <div class="fak" style="display: none;">
                    <?php
                        while($cikti = $faks->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            /** Üniversite */
                            $faksoruu = $conn->query("select * from universite_fakulte where fakulte_id = '".$cikti["fak_id"]."'");
                            $faksoru = $faksoruu->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo $faksoru["name"]; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>

                <div class="fakimagore" style="display: none;">
                    <?php
                        while($cikti = $fakima->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            /** Üniversite */
                            $faksoruu = $conn->query("select * from universite_fakulte where fakulte_id = '".$cikti["fak_id"]."'");
                            $faksoru = $faksoruu->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo $faksoru["name"]; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>

                <div class="bol" style="display: none;">
                    <?php
                        while($cikti = $bols->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            /** Üniversite */
                            $bolsoruu = $conn->query("select * from bolumler where bolum_id = '".$cikti["bol_id"]."'");
                            $bolsoru = $bolsoruu->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo $bolsoru["bolum_adi"]; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>

                <div class="bolumegore" style="display: none;">
                    <?php
                        while($cikti = $bolume->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            /** Üniversite */
                            $bolsoruu = $conn->query("select * from bolumler where bolum_id = '".$cikti["bol_id"]."'");
                            $bolsoru = $bolsoruu->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php echo $bolsoru["bolum_adi"]; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>

                <div class="yurtlar" style="display: none;">
                    <?php
                        while($cikti = $yurtlars->fetch(PDO::FETCH_ASSOC)){

                            /** Soru Kategori */
                            $kat = $conn->query("select * from sorucevapkat where kat_id = '".$cikti["kat_id"]."'");
                            $katid = $kat->fetch(PDO::FETCH_ASSOC);

                            /** Cevap Count */
                            $cevap = $conn->query("select count(*) as cevap_id from cevaplar where soru_id = '".$cikti["soru_id"]."'");
                            $cevapcount = $cevap->fetch(PDO::FETCH_ASSOC);

                            /** User */
                            $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                            $userinfo = $user->fetch(PDO::FETCH_ASSOC);

                            if(isset($_SESSION["username"]))
                            {
                                $rez = $conn->query("select count(*) as rez_id from rezler where soru_id = '".$cikti["soru_id"]."'");
                                $rez = $rez->fetch(PDO::FETCH_ASSOC);

                                $rezus = $conn->query("select * from rezler where soru_id = '".$cikti["soru_id"]."' and user_id = '$userid'");
                                $rezuscount = $rezus->rowCount();
                            }   
                        ?>
                        <div class="post-wrap">
                            <div class="post-header">
                                <a href="<?php echo $userinfo["username"]; ?>">
                                    <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                                </a>
                                <div class="post-header-info">
                                    <?php if(isset($_SESSION["login"]) && $_SESSION["username"] != $userinfo["username"]){ ?>
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

                                            <span class="text-muted" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; width: 350px;" >
                                                <?php "Yurtlar Hakkında"; ?>
                                            </span>
                                        </div>
                                        <p><?php echo $cikti["soru"]; ?></p>
                                    </div>
                                    <?php if (isset($_SESSION["username"] )) { ?>
                                        <div style="float: left;" class="mr-5">
                                            <span class="rezle" id="rezle" type="button" title="<?php echo $cikti["soru_id"]; ?>">
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
                        <br/>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php sidebar(); ?>
    </div>
</div>

<?php 

footer();

?>