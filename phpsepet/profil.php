<?php
    //oturumu başlat
    session_start();
    // veritabanı ayarları
    include 'ayar.php';
    // ukas php
    include 'ukas.php';
    //fonksiyonlar
    include 'func.php';

    //kullanıcı adı
    $kadi = @$_GET["kadi"];

    // uye bilgilerini cek
    $data = $db -> prepare("SELECT * FROM uyeler WHERE
        uye_kadi=?
    ");
    $data -> execute([
        $kadi
    ]);
    $_data = $data -> fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$_data["uye_kadi"]?> Profil</title>
    <link rel="stylesheet" href="CSS/profil.css">
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--GOOGLE FONTS-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
  
<body>
<?php include 'header.php';?>

   <div class="container">
   <table class="container-profil">
        <tr>
            <td>
                <strong>Profil Bilgileri</strong>
                <ol>
                    <li>İsim Soyisim: <a href=""><?=$_data["uye_adsoyad"]?></a></li>
                    <li>Kullanıcı Adı: <a href=""><?=$_data["uye_kadi"]?></a></li>
                    <li>E-Posta Adresi: <a href=""><?=$_data["uye_eposta"]?></a></li>
                    <li>Kayıt Tarihi: <a href=""><?=$_data["uye_tarih"]?></a></li>
                    <p></p>
                </ol>
            </td>
        </tr>
    </table>
    </div>

   <?php include 'footer.php';?>
</body>
</html>