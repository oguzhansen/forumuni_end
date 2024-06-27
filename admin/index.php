<?php

    include("../core.php");

    if(isset($_SESSION["login"]))
    {
        $uname = $_SESSION["username"];

        $user = $conn->query("SELECT * FROM users WHERE username = '$uname'");
        $user = $user->fetch(PDO::FETCH_ASSOC);
        if($user["role"] != "admin")
        {
            echo "<script>window.top.location='../profilim.php'</script>";
        }
    } 
    else 
    {
        echo "<script>window.top.location='../login.php'</script>";
    }

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />

</head>
<body>
    <div class="col users">
        <?php

        $users = $conn->query("SELECT * FROM users ORDER BY id DESC");
        
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PROFİL</th>
                    <th scope="col">ADSOYAD</th>
                    <th scope="col">USERNAME</th>
                    <th scope="col">E-MAİL</th>
                    <th scope="col">ÜNİVERSİTE</th>
                    <th scope="col">FAKÜLTE</th>
                    <th scope="col">BÖLÜM</th>
                    <th scope="col">KAYIT TARİH</th>
                </tr>
            </thead>
            <tbody>
            <?php while($cikti = $users->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                    <th scope="row"><?php echo $cikti["id"]; ?></th>
                        <td><img src="../<?php echo $cikti["avatar"]; ?>" width="35px" /></td>
                        <td><?php echo $cikti["adsoyad"]; ?></td>
                        <td><?php echo $cikti["username"]; ?></td>
                        <td><?php echo $cikti["email"]; ?></td>
                        <td><?php echo $cikti["uni"]; ?></td>
                        <td><?php echo $cikti["uni_fakulte"]; ?></td>
                        <td><?php echo $cikti["uni_bolum"]; ?></td>
                        <td><?php echo zaman($cikti["kayit_tarih"]); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="col sorular">
        <?php

        $sorular = $conn->query("SELECT * FROM sorular ORDER BY id DESC");
        
        ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">PAYLAŞAN</th>
                    <th scope="col">SORU</th>
                    <th scope="col">SORU KATEGORİ</th>
                    <th scope="col">SORU UNİ</th>
                    <th scope="col">SORU FAK</th>
                    <th scope="col">SORU BOL</th>
                    <th scope="col">SORU TARİH</th>
                </tr>
            </thead>
            <tbody>
            <?php while($cikti = $sorular->fetch(PDO::FETCH_ASSOC)){ ?>
                <tr>
                    <th scope="row"><?php echo $cikti["soru_id"]; ?></th>
                        <td><?php echo $cikti["id"]; ?></td>
                        <td><?php echo $cikti["soru"]; ?></td>
                        <td><?php echo $cikti["kat_id"]; ?></td>
                        <td><?php echo $cikti["uni_id"]; ?></td>
                        <td><?php echo $cikti["fak_id"]; ?></td>
                        <td><?php echo $cikti["bol_id"]; ?></td>
                        <td><?php echo zaman($cikti["soru_tarih"]); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>