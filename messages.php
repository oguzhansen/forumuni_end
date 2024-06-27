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


$users = $conn->query("SELECT * FROM messageroom WHERE user1 = '".$user["id"]."' OR user2 = '".$user["id"]."' ORDER BY room_id DESC");




if(isset($_GET["user"]))
{
    $userchat = $_GET["user"];

    $kimea = $conn->query("SELECT * FROM users WHERE username = '$userchat'");

    $kime = $kimea->fetch(PDO::FETCH_ASSOC);

    $kimec = $kimea->rowCount();

    if($kimec == 0)
    {
        echo '<meta http-equiv="refresh" content="0;url=messages.php">';
    }
}


?>

<div class="container pt-5">
    <div class="row pt-3">
        <?php if(!isset($_GET["user"])){

        ?>

            <div class="col userlistfull">

            <?php
            
                while($userlist = $users->fetch(PDO::FETCH_ASSOC))
                {
                    
                    $usernamemsg = "";

                    if($userlist["user1"] == $user["id"])
                    {
                        $kimden = $conn->query("SELECT * FROM users WHERE id = '".$userlist["user2"]."'")->fetch(PDO::FETCH_ASSOC);

                        $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '".$user["id"]."' and kime = '".$kimden["id"]."') or (kimden = '".$kimden["id"]."' and kime = '".$user["id"]."') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

                        $usernamemsg = $kimden["username"];
                    }
                    else
                    {
                        $kimden = $conn->query("SELECT * FROM users WHERE id = '".$userlist["user1"]."'")->fetch(PDO::FETCH_ASSOC);

                        $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '".$user["id"]."' and kime = '".$kimden["id"]."') or (kimden = '".$kimden["id"]."' and kime = '".$user["id"]."') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

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

            ?>

            </div>

        <?php 
            } 

            else 
            { 
                $usercek = $conn->query("SELECT * FROM users WHERE username = '$userchat'")->fetch(PDO::FETCH_ASSOC);

                $usermessage = $conn->query("SELECT * FROM messages WHERE kimden = '".$user["id"]."' AND kime = '".$usercek["id"]."' OR kimden = '".$usercek["id"]."' AND kime = '".$user["id"]."'");

                $usermsgc = $usermessage->rowCount();

                $oku = $conn->query("UPDATE messages SET seen = '1' WHERE kimden = '".$usercek["id"]."' AND kime = '".$user["id"]."'");

                $usermsgya = $conn->query("SELECT * FROM messages WHERE (kimden = '".$usercek["id"]."' OR kime = '".$usercek["id"]."') ORDER BY id desc")->fetch(PDO::FETCH_ASSOC);

        ?>

        <div class="container">
            <div class="row">
                <div class="col"> 
                    <div class="chatbox mb-2">
                        <?php

                        if($usermsgc == 0)
                        {
                            echo "<div class='alert alert-info'>Sohbet Yok</div>";
                        }
                        
                        while($usermsg = $usermessage->fetch(PDO::FETCH_ASSOC))
                        {

                            if($usermsg["kime"] != $user["id"])
                            {

                                ?>
                                
                                <div class="msgbody">
                                    <div class="containera darker">
                                        <p class="float-right w-100"><?=$usermsg["message"]?></p>
                                        <span class="text-muted float-right"><?=zaman($usermsg["tarih"])?></span>
                                    </div>
                                </div>
                                
                                <?php

                            }

                            else
                            {
                                ?>
                                
                                <div class="msgbody">
                                    <div class="containera">
                                        <img src="<?=$usercek["avatar"]?>" alt="Avatar">
                                        <p><?=$usermsg["message"]?></p>
                                        <span class="text-muted float-right"><?=zaman($usermsg["tarih"])?></span>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        
                        if($usermsgya["seen"] == 0 && $usermsgya["kimden"] == $user["id"])
                        {
                            echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Gönderildi</span>";
                        }
                        
                        else if($usermsgya["kimden"] == $user["id"])
                        { 
                            echo "<span class='text-muted' style='position: absolute; right: 15px; bottom: 25px;'>Görüldü</span>"; 
                        }

                        ?>
                    </div>
                    <br>
                    <div class="input-group mt-4 msgform">
                        <input id="mesaj" type="text" class="form-control float-left" style="width: 75%;" placeholder="Mesajınız...">
                        <input id="kime" type="hidden" name="" value="<?=$usercek["id"]?>">
                        <input id="msggonder" disabled type="button" class="form-control btn btn-primary" style="width: 25%;" value="Gönder">
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function(){

        window.scrollTo(0,document.body.scrollHeight);

        setInterval(msgref, 1000);
        setInterval(sohbetler, 2000);

    });

    function sohbetler()
    {
        $.ajax({

            type: "POST",
            url: "ajax.php?option=userlist",
            timeout: 5000,
            success: function(e)
            {
                $(".userlistfull").html(e);
            }

        });
    }

    function msgref(){
        var kime = $("#kime").val();

        $.ajax({
            type: "POST",
            url: "ajax.php?option=msgref",
            timeout: 5000,
            data:{"kime":kime},
            success: function(e)
            {
                $(".chatbox").html(e);
            }
        });
    }

</script>

<?php

footer();

?>