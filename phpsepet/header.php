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
<div class="header-bg"><img src="images/game1.jpg"></div>

<header>
<?php
   if (@$_SESSION["uye_id"]) {
    echo '<a href="index.php"><i class="fa-solid fa-house"></i> Ana Sayfa</a>
    <a href="profil.php?kadi='.@$_SESSION["uye_kadi"].'"><i class="fa-solid fa-user"></i> Profil</a>
    <a href="uyelik.php?p=cikis"><i class="fa-solid fa-right-to-bracket"></i> Çıkış Yap</a>';
   } else {
    echo'<a href="index.php"><i class="fa-solid fa-house"></i> Ana Sayfa</a>
    <a href="uyelik.php"><i class="fa-solid fa-door-open"></i> Giriş Yap</a>
    <a href="uyelik.php?p=kayit"><i class="fa-solid fa-user-plus"></i> Kayıt Ol</a>
    ';
   }
   if (@$_SESSION["uye_onay"] == 1) {
      echo'<a href="admin.php"><i class="fa-solid fa-screwdriver-wrench"></i> Admin</a>';
    }
   
   
   ?>
</header>
</body>
</html>