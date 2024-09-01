<?php
session_start();
include 'ayar.php';
include 'ukas.php';
include 'func.php';

if (@$_SESSION["uye_onay"] != 1) {
    include 'hataGoster.php';
    exit;
}

function oyunEkle($db) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['islem']) && $_POST['islem'] == 'ekle') {
        $oyun_adi = $_POST['oyun_adi'];
        $oyun_aciklama = $_POST['oyun_aciklama'];
        $oyun_resim_url = $_POST['oyun_resim_url'];
        $oyun_fiyat = $_POST['oyun_fiyat'];
        $oyun_yayinci = $_POST['oyun_yayinci'];
        $oyun_yayin_tarihi = $_POST['oyun_yayin_tarihi'];
        $oyun_platform = $_POST['oyun_platform'];
        $oyun_stok = $_POST['oyun_stok'];

        $sql = "INSERT INTO oyunlar (oyun_adi, oyun_aciklama, oyun_resim_url, oyun_fiyat, oyun_yayinci, oyun_yayin_tarihi, oyun_platform, oyun_stok) 
                VALUES (:oyun_adi, :oyun_aciklama, :oyun_resim_url, :oyun_fiyat, :oyun_yayinci, :oyun_yayin_tarihi, :oyun_platform, :oyun_stok)";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':oyun_adi', $oyun_adi);
        $stmt->bindParam(':oyun_aciklama', $oyun_aciklama);
        $stmt->bindParam(':oyun_resim_url', $oyun_resim_url);
        $stmt->bindParam(':oyun_fiyat', $oyun_fiyat);
        $stmt->bindParam(':oyun_yayinci', $oyun_yayinci);
        $stmt->bindParam(':oyun_yayin_tarihi', $oyun_yayin_tarihi);
        $stmt->bindParam(':oyun_platform', $oyun_platform);
        $stmt->bindParam(':oyun_stok', $oyun_stok);

        if ($stmt->execute()) {
            echo "Oyun başarıyla eklendi.";
        } else {
            echo "Hata: Oyun eklenemedi. Lütfen tekrar deneyin veya daha sonra tekrar deneyin.";
            print_r($stmt->errorInfo());
        }
    }
}

function oyunSil($db) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['islem']) && $_POST['islem'] == 'sil') {
        $oyun_id = $_POST['oyun_id'];

        $sql = "DELETE FROM oyunlar WHERE oyun_id = :oyun_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':oyun_id', $oyun_id);

        if ($stmt->execute()) {
            echo "Oyun başarıyla silindi.";
        } else {
            echo "Hata: Oyun silinemedi. Lütfen tekrar deneyin veya daha sonra tekrar deneyin.";
            print_r($stmt->errorInfo());
        }
    }
}

oyunEkle($db);
oyunSil($db);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yetkili Bölümü</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Play&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="CSS/admin.css">
    <link rel="stylesheet" href="CSS/main.css">
</head>
<body>
    <!-- Header dahil edin -->
    <?php include 'header.php';?>
    <!-- KATEGORİLER BAŞLANGIÇ -->
    <div class="container">
        <h2>Oyun Ekle</h2>
        <form action="admin.php" method="POST">
            <input type="hidden" name="islem" value="ekle">
            <label for="oyun_adi">Oyun Adı:</label><br>
            <input type="text" id="oyun_adi" name="oyun_adi" required><br><br>

            <label for="oyun_aciklama">Açıklama:</label><br>
            <textarea id="oyun_aciklama" name="oyun_aciklama" rows="4" cols="50" required></textarea><br><br>

            <label for="oyun_resim_url">Resim URL:</label><br>
            <input type="text" id="oyun_resim_url" name="oyun_resim_url" required><br><br>

            <label for="oyun_fiyat">Fiyat:</label><br>
            <input type="number" id="oyun_fiyat" name="oyun_fiyat" required><br><br>

            <label for="oyun_yayinci">Yayıncı:</label><br>
            <input type="text" id="oyun_yayinci" name="oyun_yayinci" required><br><br>

            <label for="oyun_yayin_tarihi">Yayın Tarihi:</label><br>
            <input type="date" id="oyun_yayin_tarihi" name="oyun_yayin_tarihi" required><br><br>

            <label for="oyun_platform">Platform:</label><br>
            <input type="text" id="oyun_platform" name="oyun_platform" required><br><br>

            <label for="oyun_stok">Stok:</label><br>
            <input type="number" id="oyun_stok" name="oyun_stok" required><br><br>

            <input type="submit" value="Oyun Ekle">
        </form>
    </div>
    <div class="container">
        <h2>Oyun Sil</h2>
        <form action="admin.php" method="POST">
            <input type="hidden" name="islem" value="sil">
            <label for="oyun_id">Oyun ID:</label><br>
            <input type="text" id="oyun_id" name="oyun_id" required><br><br>

            <input type="submit" value="Oyun Sil">
        </form>
    </div>
    <?php include 'footer.php';?>
</body>
</html>
