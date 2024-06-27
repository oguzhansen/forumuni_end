<?php

    include "core.php";

    $activecode = $_GET["active"];

    $userceka = $conn->query("SELECT * FROM users WHERE activationcode = '$activecode'");
    $usercek = $userceka->fetch(PDO::FETCH_ASSOC);
    $usercekcount = $userceka->rowCount();

    if($usercekcount != 1)
    {
        ?>
            <div class="container pt-5">
                <div class="row">
                    <div class="col">
                        <center>
                            <div><img src="assets/img/danger.png" width="25%" /></div><br/>
                            <div class="alert alert-danger"> Kayıtlarımızda böyle bir aktivasyon koduna rastlanmadı. Lütfen Bizimle İletişime Geçin.</div>
                        </center>
                    </div>
                </div>
            </div>
        <?php
    } 

    else 
    {

        $useractive = $conn->query("UPDATE users SET uyeonay = '1', activationcode = 'active' WHERE id = '".$usercek["id"]."'");

        if($useractive)
        {
            ?>
                <div class="container pt-5">
                    <div class="row">
                        <div class="col">
                            <center>
                                <div><img src="assets/img/success.png" width="25%" /></div><br/>
                                <div class="alert alert-success"> Üyeliğiniz başarıyla onaylandı! Otomatik giriş yapılıyor...</div>
                            </center>
                        </div>
                    </div>
                </div>
            <?php

            $_SESSION['login'] = true;
            $_SESSION['username'] = $usercek["username"];

            setcookie("kadi", $usercek["username"], time() + (60*60*24*365));

            echo '<meta http-equiv="refresh" content="2;url=profilim.php?cat=sorular">';
        }

        else
        {
            ?>
                <div class="container pt-5">
                    <div class="row">
                        <div class="col">
                            <center>
                                <div><img src="assets/img/danger.png" width="25%" /></div><br/>
                                <div class="alert alert-danger"> Sistemsel Bir Sıkıntı Oldu. Lütfen Bizimle İletişime Geçin.</div>
                            </center>
                        </div>
                    </div>
                </div>
            <?php
        }
    }


?>