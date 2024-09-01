<?php
// Oturumu başlat
session_start();

// Veritabanı ayarları
include 'ayar.php';

// Gelen veriyi al
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($_SESSION['uye_id'])) {
    echo "Satın alma işlemi için giriş yapmalısınız.";
    exit;
}

foreach ($data as $item) {
    $oyun_id = $item['id'];
    $adet = $item['adet'];

    // Stok kontrolü
    $oyun_sorgu = $db->prepare("SELECT oyun_stok FROM oyunlar WHERE oyun_id = :oyun_id");
    $oyun_sorgu->bindParam(':oyun_id', $oyun_id);
    $oyun_sorgu->execute();
    $oyun = $oyun_sorgu->fetch(PDO::FETCH_ASSOC);

    if ($oyun['oyun_stok'] < $adet) {
        echo "Stok yetersiz: {$item['ad']}";
        exit;
    }

    // Stok düş
    $stok_guncelle = $db->prepare("UPDATE oyunlar SET oyun_stok = oyun_stok - :adet WHERE oyun_id = :oyun_id");
    $stok_guncelle->bindParam(':adet', $adet);
    $stok_guncelle->bindParam(':oyun_id', $oyun_id);
    $stok_guncelle->execute();

    // Satış kaydı oluştur
    $satis_ekle = $db->prepare("INSERT INTO satislar (uye_id, oyun_id, adet) VALUES (:uye_id, :oyun_id, :adet)");
    $satis_ekle->bindParam(':uye_id', $_SESSION['uye_id']);
    $satis_ekle->bindParam(':oyun_id', $oyun_id);
    $satis_ekle->bindParam(':adet', $adet);
    $satis_ekle->execute();
}

echo "Satın alma işlemi başarıyla gerçekleşti.";
?>
