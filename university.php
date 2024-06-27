<?php

    include "core.php";
    head();
    $uniid = $_GET["uniid"];

    $uniget = $conn->query("SELECT * FROM universite where universite_id = '$uniid'");
    $uniget = $uniget->fetch(PDO::FETCH_ASSOC);

    if(isset($_SESSION["username"]))
    {
        $uname = $_SESSION["username"];
                
        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $user = $user->fetch(PDO::FETCH_ASSOC);

        $userid = $user["id"];
    }
    $rating = $conn->query("SELECT AVG(memnuniyet) FROM uni_comment WHERE universite_id = '$uniid'")->fetch(PDO::FETCH_ASSOC);

    $kacrate = $conn->query("SELECT * FROM uni_comment WHERE universite_id = '$uniid'")->rowCount();

    $tkpcontuni = $conn->query("SELECT * FROM uni_follows WHERE edenuni = '$userid' AND edilenuni = '$uniid'")->rowCount();
?>
<div class="container">
    <div class="row pt-5">
        <div class="col">
                <div class="card hovercard p-2 darkbg">
                    <center>
                        <div class="cardheader">

                        </div>
                        <div class="avatar">
                            <img alt="" class="rounded-circle" width="100px" src="<?php echo $uniget["image"]; ?>">
                        </div>
                        <div class="info">
                            <div class="title pt-3">
                                <b><?php echo $uniget["name"]; ?></b>
                            </div>
                            <?php if($rating["AVG(memnuniyet)"] != 0){ ?>
                                    <i style="color: orange; font-size: 14px;" class="bi bi-star-fill"></i><span style="color: orange; font-size: 14px; margin-top: 10px;" class="mt-5"> <?php echo substr($rating["AVG(memnuniyet)"], 0, 3); ?> / 5 (<?=$kacrate." Değerlendirme"?>)</span>
                                <?php } ?>
                        </div>
                    </center>
                </div>

                <?php if(isset($_SESSION["username"])) { ?>

                    <div class="justify-content-center align-items-center d-flex mt-4">

                        <span class="unitakipet" title="<?=$uniid?>">
                            <?php 

                            if($tkpcontuni == 1)
                            {
                                echo '<span class="buttonprf">Takip Ediliyor</span>';
                            }

                            else
                            {
                                echo '<span class="buttonprf">Takip Et</span>';
                            }
                            
                            ?>
                        </span>
                    </div>
                
                <?php } ?>

                <center>
                    <h5 class="mt-4">Yorumlar</h5>
                    <hr class="bg-light">
                </center>

                <div id="uniprofil">
                    <div class="uniyorum">
                        <?php

                        $yorumcek = $conn->query("SELECT * FROM uni_comment WHERE universite_id = '$uniid' ORDER BY yorum_id desc");

                        $yorumcount = $yorumcek->rowCount();

                        if($yorumcount != 0)
                        {
                            while($yorum = $yorumcek->fetch(PDO::FETCH_ASSOC))
                            {
                                $yorumUser = $conn->query("SELECT * FROM users WHERE id = '".$yorum["id"]."'")->fetch(PDO::FETCH_ASSOC);

                                //USER FAK, BOL
                                $yorfak = $conn->query("SELECT * FROM universite_fakulte WHERE fakulte_id = '".$yorumUser["uni_fakulte"]."'");
                                $yorumfak = $yorfak->fetch(PDO::FETCH_ASSOC);

                        ?>
                        
                        <div class="card mb-3 gon">
                        <div class="card-body darkbg">
                            <div>
                                <span class="soruindex"><?php echo $yorum["yorum"]; ?></span>
                                <br/><span style="font-size:13px; font-weight:200; color:#9ca7b4;"> 
                                <?php 
                                if(isset($yorumfak["name"]))
                                {
                                    echo $yorumfak["name"];
                                }
                                ?>
                            </div>
                            <div class="d-flex justify-content-between">
                                <div class="d-flex flex-row align-items-center">
                                    <a class="card-subtitl" href="<?php echo $yorumUser["username"]; ?>" >
                                        <img src="<?php echo $yorumUser["avatar"]; ?>" alt="avatar" class="rounded-circle" width="30" height="30" />
                                    </a>
                                    <p class="small ml-2 mt-3"><a class="card-subtitle" href="<?php echo $yorumUser["username"]; ?>"> <?php echo $yorumUser["username"]; ?> </a> 
                                        <small style="font-size:12px; font-weight:200; color: #9ca7b4;"> &nbsp;<?php echo zaman($yorum["yorum_tarih"]); ?></small>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($_SESSION["username"]) && $yorum["id"] != $userid) { ?>
                            <div class="dropmenu" type="button" >
                                    <span class="dropmenuac">...</span>
                                    <div class="dropmenulist">
                                        <li><a role="menuitem" class="sikayetyorum" type="button" id="sikayetyorum" title="<?php echo $yorum["yorum_id"]; ?>"> Şikayet Et</a></li>
                                    </div>
                                </div>
                        <?php } ?>
                    </div>
                    <hr>
                <?php } } else { ?>

                    <div class="alert alert-primary">Bu üniversite henüz değerlendirilmemiş.</div>

                <?php } ?>
                </div>
            </div>
        </div>
        <?php sidebar() ?>
    </div>
</div>


<?php 

footer();

?>