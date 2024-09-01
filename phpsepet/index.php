<?php
// Oturumu başlat
session_start();
// Veritabanı ayarları
include 'ayar.php';
// Ukas php
include 'ukas.php';
// Fonksiyonlar
include 'func.php';

// Oyunları veritabanından al
$oyunlar_sorgu = $db->query("SELECT * FROM oyunlar");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ana Sayfa</title>
    <link rel="stylesheet" href="CSS/index.css">
    <script>
        var sepet = [];
        var toplamFiyat = 0;
        var kullaniciGirisYapti = <?php echo isset($_SESSION['uye_id']) ? 'true' : 'false'; ?>;

        function sepeteEkle(oyunId, oyunAdi, oyunFiyati, stok) {
            if (!kullaniciGirisYapti) {
                alert('Sepete ürün eklemek için giriş yapmalısınız.');
                return;
            }
            var index = sepet.findIndex(item => item.id === oyunId);
            if (index > -1) {
                // Ürün zaten sepette var, stok kontrolü yap
                if (sepet[index].adet < stok) {
                    sepet[index].adet += 1;
                    toplamFiyat += parseFloat(oyunFiyati);
                } else {
                    alert('Stok adedinden fazla ürün ekleyemezsiniz.');
                }
            } else {
                // Ürünü sepette ekle
                if (stok > 0) {
                    sepet.push({ id: oyunId, ad: oyunAdi, fiyat: oyunFiyati, adet: 1 });
                    toplamFiyat += parseFloat(oyunFiyati);
                } else {
                    alert('Stokta yeterli ürün yok.');
                }
            }
            sepetiGuncelle();
        }

        function urunSil(oyunId) {
            var index = sepet.findIndex(item => item.id === oyunId);
            if (index > -1) {
                toplamFiyat -= sepet[index].fiyat * sepet[index].adet;
                sepet.splice(index, 1);
                sepetiGuncelle();
            }
        }

        function sepetiGuncelle() {
            var sepetElement = document.getElementById('sepet');
            var toplamFiyatElement = document.getElementById('toplamFiyat');
            sepetElement.innerHTML = '';

            sepet.forEach(function(urun) {
                var urunElement = document.createElement('div');
                var urunAdetElement = document.createElement('span');
                var silButton = document.createElement('button');
                var icon = document.createElement('i');

                urunElement.textContent = urun.ad + " - " + urun.fiyat + " TL ";
                urunAdetElement.textContent = "Adet: " + urun.adet + " ";
                silButton.className = "sil-button";
                icon.className = "fa-solid fa-trash";

                silButton.onclick = function() {
                    urunSil(urun.id);
                };

                silButton.appendChild(icon);
                urunElement.appendChild(urunAdetElement);
                urunElement.appendChild(silButton);
                sepetElement.appendChild(urunElement);
            });

            toplamFiyatElement.textContent = "Toplam: " + toplamFiyat.toFixed(2) + " TL";
        }

        function satinAl() {
            var sepetData = JSON.stringify(sepet);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "satinAl.php", true);
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    alert(xhr.responseText);
                    sepet = [];
                    toplamFiyat = 0;
                    sepetiGuncelle();
                    location.reload();  // Sayfayı yenile
                }
            };
            xhr.send(sepetData);
        }
    </script>
</head>
<body>
    <?php include 'header.php';?>

    <!-- Sepet Kısmı -->
    <div class="sepet-container">
        <h2>Sepet</h2>
        <div id="sepet"></div>
        <p id="toplamFiyat">Toplam: 0.00 TL</p>
        <button class="satin-al-button" onclick="satinAl()">Satın Al</button>
    </div>

    <!-- Oyunlar Kategorisi Başlangıç -->
    <div class="container">
        <h1 class="kategoriler"><i class="fa-solid fa-gamepad" style="margin-right:10px; margin-left:-20px"></i> Oyunlar</h1>
        <div class="oyunlar">
            <?php
            // Üye onay durumu kontrolü
            $uye_id = @$_SESSION['uye_id'];
            $uye_sorgu = $db->prepare("SELECT uye_onay FROM uyeler WHERE uye_id = :uye_id");
            $uye_sorgu->bindParam(':uye_id', $uye_id);
            $uye_sorgu->execute();
            $uye = $uye_sorgu->fetch(PDO::FETCH_ASSOC);

            // Oyunları ekrana yazdır
            while ($oyun = $oyunlar_sorgu->fetch(PDO::FETCH_ASSOC)) {
                echo "
                    <div class='oyun'>
                        <img src='{$oyun['oyun_resim_url']}' alt='{$oyun['oyun_adi']}'>
                        <h2>{$oyun['oyun_adi']}";

                        if ($uye && $uye['uye_onay'] == 1) {
                            echo " (ID: {$oyun['oyun_id']})";
                        }

                        echo "</h2>
                        <p>{$oyun['oyun_aciklama']}</p>
                        <hr>
                        <p>Yapımcı: {$oyun['oyun_yayinci']}</p>
                        <p>Platform: {$oyun['oyun_platform']}</p>
                        <p>Yayın Tarihi: {$oyun['oyun_yayin_tarihi']}</p>
                        <p>Stok: {$oyun['oyun_stok']}</p>
                        <p class='fiyat'>{$oyun['oyun_fiyat']} TL</p>
                        <button class='sepete-ekle' onclick='sepeteEkle({$oyun['oyun_id']}, \"{$oyun['oyun_adi']}\", {$oyun['oyun_fiyat']}, {$oyun['oyun_stok']})'><i class='fa-solid fa-plus'></i> Sepete Ekle</button>
                    </div>
                ";
            }
            ?>
        </div>
    </div>
    <!-- Oyunlar Kategorisi Bitiş -->

    <?php include 'footer.php';?>
</body>
</html>
