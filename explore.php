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
    <div class="row pt-4">
        <div class="col">
            <?php
                $ani = $conn->query("select * from anilar order by ani_id desc");

                while($cikti = $ani->fetch(PDO::FETCH_ASSOC)){

                    /** User */
                    $user = $conn->query("select * from users where id = '".$cikti["id"]."'");
                    $userinfo = $user->fetch(PDO::FETCH_ASSOC);
                    

                    /** Soru Üniversite */
                    $uni = $conn->query("select * from universite where universite_id = '".$userinfo['uni']."'");
                    $unial = $uni->fetch(PDO::FETCH_ASSOC);
            
            ?>
            <div class="post-wrap">
                <div class="post-header">
                    <a href="<?php echo $userinfo["username"]; ?>">
                        <img src="<?php echo $userinfo["avatar"]; ?>" alt="" class="avator">
                    </a>
                    <div class="post-header-info">
                        <?php if(isset($_SESSION["login"])){ ?>
                        <div class="dropmenu" type="button" >
                            <span class="dropmenuac">...</span>
                            <div class="dropmenulist">
                                <li> <a role="menuitem" class="sikayetani" type="button" id="sikayetani" title="<?php echo $cikti["ani_id"]; ?>"> Şikayet Et</a></li>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="kisitla">
                            <a href="<?php echo $userinfo["username"]; ?>">
                                <b><?php echo $userinfo["username"]; ?></b> 
                            </a>    
                            <span class="text-muted"> <?php echo zaman($cikti["ani_tarih"]); ?> </span>
                        </div>
                        <p><?php echo $cikti["ani"]; ?></p>
                    </div>
                </div>
            </div>
            <hr>
            <?php } ?>
        </div>
        <?php sidebar(); ?>
    </div>
</div>

<?php 

footer();

?>