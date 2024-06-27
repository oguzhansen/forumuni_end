<?php

    include("core.php");
    head();

?>

<div class="container">
    <div class="row pt-5">
        <div class="col login">
            <?php
            
            if(isset($_POST["sifreyenile"]))
            {

                $sifreyenile = $_GET["sifreyenile"];
  
                $sifre   = hash('sha256', $_POST['sifre']);

                $guncelle = $conn->query("UPDATE users SET password = '$sifre' WHERE sifreyenile = '$sifreyenile'");

                if($guncelle)
                {
                    $guncelle = $conn->query("UPDATE users SET sifreyenile = 'sifre' WHERE sifreyenile = '$sifreyenile'");

                    echo "<div class='alert alert-success'>Şifreniz başarıyla güncellendi. Giriş sekmesine yönlendiriliyorsunuz...</div>";
                    echo '<meta http-equiv="refresh" content="2;url=girisyap">';
                }

            }
            
            ?>
            <form action="" method="post">
                <center><h3 class="h3">Şifreni Yenile</h3></center><br/>
                <input class="form-control" type="password" name="sifre" placeholder="Yeni Şifre"><br/>
                <button class="form-control btn btn-primary" name="sifreyenile">Şifreni Yenile</button>
            </form>
        </div>
    </div>
</div>

<?php

footer();

?>