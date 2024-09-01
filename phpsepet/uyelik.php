<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="CSS/kayit.css">
  <link rel="stylesheet" href="CSS/giris.css">
  <link rel="stylesheet" href="CSS/main.css">
  <link rel="stylesheet" href="CSS/cikisYapiliyor.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--GOOGLE FONTS-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
  <title>Üyelik</title>
</head>
<body>
<?php include 'header.php';?>
<?php
          session_start();
          include 'ayar.php';
          include 'ukas.php';

          $p = @$_GET["p"];


        switch ($p) {
            case 'cikis':
                if (@$_SESSION["uye_id"]) {
                    ukas_cikis("index.php");
                    echo'<div class="loader-container">
                    <div class="loader"></div>
                    <p class="loading-text">Çıkış Yapılıyor...</p>
                  </div>';
                }else{
                    header("LOCATION:index.php");
                }
                break;

                case 'kayit':
                    if (@$_SESSION["uye_id"]) {
                        header("LOCATION:index.php");
                    }else{
                        ukas_kayit("<p class='text-warning'>Lütfen boş bırakmayınız!</p>", "<p class='text-danger'>Böyle bir eposta mevcut! Lütfen başka bir tane deneyiniz!</p>", "<p class='text-warning'>Böyle bir kullanıcı adı mevcut! Lütfen başka bir tane deneyiniz!</p>", "<p class='text-success'>Başarıyla kaydoldun! :)</p>", "index.php", "<p class='text-danger'>Kullanıcı adı veya şifre hatalı!</p>", "<p class='text-danger'>Kayıt başarısız!</p>", "<p>Şifreniz bir birine eşleşmiyor!</p>", "<p>Lütfen gerçek bir eposta giriniz!</p>");
                        echo '<div class="container">
                        <h1>Kayıt Ol</h1>
                        <br>
                        <form action="" method="POST">
                          <label for="username">İsim Soyisim:</label>
                          <input type="text" class="form-control" name="adsoyad">
                    
                          <label for="username">Kullanıcı Adı:</label>
                          <input type="text" class="form-control" name="kadi">
                    
                          <label for="email">E Posta:</label>
                          <input type="text" class="form-control" name="eposta">
                          <span class="email-warning">⚠ Erişebildiğiniz geçerli bir e-posta adresi giriniz.</span>
                    
                          <label for="password">Şifre:</label>
                          <input type="password" class="form-control" name="sifre">
                    
                          <label for="password-confirm">Şifre (Tekrar):</label>
                          <input type="password" class="form-control" name="sifret">
                    
                          <p>Hesabın var mı? <a href="uyelik.php?p=giris">Giriş Yap</a></p>
                          <input type="submit" class="btn btn-block btn-dark" name="kayit" value="Kayıt Ol">
                        </form>
                      </div>';
                    }
                    break;
    
                default:
                    if (@$_SESSION["uye_id"]) {
                        header("LOCATION:index.php");
                    }else{
                        ukas_giris("index.php", "<p class='text-warning'>Lütfen boş bırakmayınız!</p>", "<p class='text-danger'>Kullanıcı adı veya şifre hatalı!</p>");
    
                        echo '<div class="container">
                        <h1>Giriş Yap</h1>
                        <form action="#" method="POST">
                          <label for="username">Kullanıcı Adı:</label>
                          <input type="text" class="form-control" name="kadi">
                    
                          <label for="password">Şifre:</label>
                          <input type="password" class="form-control" name="sifre">
                    
                          <p>Hesabın yok mu? <a href="uyelik.php?p=kayit">Kayıt Ol</a></p>
                          <p>Şifremi <a href="uyelik.php?p=sifremiunuttum">Unuttum</a></p>
                          <input type="submit" class="btn btn-block btn-dark" name="giris" value="Giriş Yap">
                        </form>
                      </div>';
                        }
                    break;
            }
    
          ?>
    <?php include 'footer.php';?>
</body>
</html>
    
