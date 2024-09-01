<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="CSS/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--GOOGLE FONTS-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet">
</head>
<body>
  <footer>
  <div class="footer">
  <div class="row">
    <a href="#"><i class="fa-brands fa-facebook"></i></a>
    <a href="#"><i class="fa-brands fa-instagram"></i></a>
    <a href="#"><i class="fa-brands fa-youtube"></i></a>
    <a href="#"><i class="fa-brands fa-x-twitter"></i></i></a>
<div class="row">
  <?php
   if (@$_SESSION["uye_id"]) {
    echo '<ul><li><a href="index.php">Ana Sayfa</a></li>
    <li><a href="profil.php?kadi='.@$_SESSION["uye_kadi"].'">Profil Sayfası</a></li>
    <li><a href="uyelik.php?p=cikis">Çıkış Yap</a></li></ul>';
   } else {
    echo'<ul><li><a href="index.php">Ana Sayfa</a></li>
    <li><a href="uyelik.php">Giriş Yap</a></li>
    <li><a href="uyelik.php?p=kayit">Kayıt Ol</a></li></ul>';
   }
   ?>
   <div class="row">
   &copy; 2024 AKü. Tüm hakları saklıdır. <br><i title="developer" class="fa-solid fa-laptop-code"></i> Geliştirici: Hamza Emir Gündoğdu
  </div>
   </div>
   </div>
   </div>
  </footer>
</body>
</html>