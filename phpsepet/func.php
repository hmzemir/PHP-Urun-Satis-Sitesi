<?php

// Türkçe karakter gibi özel karakterleri linklere göre uyumlu haline getirilir.

function permalink($str, $options = array()){
    $str = iconv(mb_detect_encoding($str), 'UTF-8//IGNORE', $str);
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => true
    );
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    $str = trim($str, $options['delimiter']);
    return @$options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function uye_ID_den_isme($id){
    global $db;
    $data = $db -> prepare("SELECT * FROM uyeler WHERE
    uye_id=?
    ");
    $data -> execute([
    $id
    ]);
    $_data = $data -> fetch(PDO::FETCH_ASSOC);
    return @$_data["uye_kadi"];
    }

function kategori_linkten_kategori_adi($link){
    global $db;
    $data = $db -> prepare("SELECT * FROM kategoriler WHERE
    k_kategori_link=?
    ");
    $data -> execute([
    $link
    ]);
    $_data = $data -> fetch(PDO::FETCH_ASSOC);
    return @$_data["k_kategori"];
    }

    function tumUyeSayisi($db){
        $sorgu = $db->prepare("SELECT COUNT(*) FROM uyeler");
        $sorgu->execute();
        $say = $sorgu->fetchColumn();
       
        return $say;
    }

    function tumKonuSayisi($db){
        $sorgu = $db->prepare("SELECT COUNT(*) FROM konular");
        $sorgu->execute();
        $say = $sorgu->fetchColumn();
       
        return $say;
    }

    function tumYorumSayisi($db){
        $sorgu = $db->prepare("SELECT COUNT(*) FROM yorumlar");
        $sorgu->execute();
        $say = $sorgu->fetchColumn();
       
        return $say;
    }

    function sonEklenenUyeKadi($db){
        $sorgu = $db->prepare("SELECT uye_kadi FROM uyeler ORDER BY uye_id DESC LIMIT 1");
        $sorgu->execute();
        $uye_kadi = $sorgu->fetchColumn();
       
        return $uye_kadi;
    }

    function enCokYorumYapanKullanici($db){
        $sorgu = $db->prepare("SELECT y_uye_id, COUNT(*) AS yorum_sayisi FROM yorumlar GROUP BY y_uye_id ORDER BY yorum_sayisi DESC LIMIT 1");
        $sorgu->execute();
        $en_cok_yorum_yapan = $sorgu->fetch(PDO::FETCH_ASSOC);
       
        return $en_cok_yorum_yapan;
    }

    function enCokKonuAcanKullanici($db){
        $sorgu = $db->prepare("SELECT konu_uye_id, COUNT(*) AS konu_sayisi FROM konular GROUP BY konu_uye_id ORDER BY konu_sayisi DESC LIMIT 1");
        $sorgu->execute();
        $en_cok_yorum_yapan = $sorgu->fetch(PDO::FETCH_ASSOC);
       
        return $en_cok_yorum_yapan;
    }

    function enCokYorumYapanBesKullanici($db){
        // Prepare the SQL query to select the top 5 users with the most comments
        $sorgu = $db->prepare("
            SELECT y_uye_id, COUNT(*) AS yorum_sayisi 
            FROM yorumlar 
            GROUP BY y_uye_id 
            ORDER BY yorum_sayisi DESC 
            LIMIT 5
        ");
        
        // Execute the query
        $sorgu->execute();
        
        // Fetch all results as an associative array
        $en_cok_yorum_yapanlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the list of top 5 users
        return $en_cok_yorum_yapanlar;
    }

    function kategoriKonuYorumSayisi($db) {
        // SQL query to get the number of topics and comments for each category
        $sorgu = $db->prepare("
            SELECT k.k_id, k.k_kategori, k.k_kategori_link, COUNT(DISTINCT c.konu_id) AS konu_sayisi, COUNT(y.y_id) AS yorum_sayisi 
            FROM kategoriler k
            LEFT JOIN konular c ON k.k_kategori_link = c.konu_kategori_link
            LEFT JOIN yorumlar y ON c.konu_id = y.y_konu_id
            GROUP BY k.k_id
            ORDER BY k.k_id DESC
            LIMIT 10
        ");
        
        // Execute the query
        $sorgu->execute();
        
        // Fetch all results as an associative array
        $kategori_verileri = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the list of categories with their topic and comment counts
        return $kategori_verileri;
    }

    
    function getUserRecentCommentsTopics($db, $uyeKadi, $limit = 10) {
        // SQL query to get the user's recent comments
        $sorgu = $db->prepare("
            SELECT y.y_id, y.y_konu_id, y.y_yorum, k.konu_ad, k.konu_link
            FROM yorumlar y
            LEFT JOIN konular k ON y.y_konu_id = k.konu_id
            WHERE y.y_uye_id = :uyeKadi
            ORDER BY y.y_id DESC
            LIMIT :limit
        ");
        
        // Bind the username and limit parameters
        $sorgu->bindParam(':uyeKadi', $uyeKadi, PDO::PARAM_STR);
        $sorgu->bindParam(':limit', $limit, PDO::PARAM_INT);
        
        // Execute the query
        $sorgu->execute();
        
        // Fetch all results as an associative array
        $sonYorumlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        
        // Return the recent comments and their related topics
        return $sonYorumlar;
    }

    
    function getTopicsWithTimeAgo($db, $limit = 5) {
        // SQL sorgusuyla son 5 konuyu getir
        $sorgu = $db->prepare("
            SELECT konu_id, konu_ad, konu_uye_id, konu_tarih, konu_link 
            FROM konular 
            ORDER BY konu_id DESC 
            LIMIT :limit
        ");
        
        // Limit parametresini bağla
        $sorgu->bindParam(':limit', $limit, PDO::PARAM_INT);
        
        // Sorguyu çalıştır
        $sorgu->execute();
        
        // Sonuçları al ve hesaplamayı yap
        $konular = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        foreach ($konular as &$konu) {
            // Konunun açılış zamanını al
            $konu_tarih = new DateTime($konu['konu_tarih']);
            // Şuanki zamanı al
            $simdiki_zaman = new DateTime();
            // Açılış zamanı ile şuanki zaman arasındaki farkı hesapla
            $fark = $konu_tarih->diff($simdiki_zaman);
            // Farkı dakika cinsine çevir ve string olarak formatla
            $fark_str = $fark->format('%i dakika önce');
            // Sonucu konu dizisine ekle
            $konu['acilis_zamani'] = $fark_str;
        }
        
        // Düzenlenmiş konu dizisini döndür
        return $konular;
    }

    function sonBesYorumaZamanlar($db, $limit = 5) {
        // SQL sorgusuyla son 5 yorumu getir
        $sorgu = $db->prepare("
            SELECT y.y_yorum, y.y_uye_id, y.y_tarih, y.y_id, y.y_konu_id, c.konu_link 
            FROM yorumlar y
            LEFT JOIN konular c ON y.y_konu_id = c.konu_id
            ORDER BY y.y_id DESC 
            LIMIT :limit
        ");
        
        // Limit parametresini bağla
        $sorgu->bindParam(':limit', $limit, PDO::PARAM_INT);
        
        // Sorguyu çalıştır
        $sorgu->execute();
        
        // Sonuçları al ve hesaplamayı yap
        $yorumlar = $sorgu->fetchAll(PDO::FETCH_ASSOC);
        foreach ($yorumlar as &$yorum) {
            // Yorumun tarihini al
            $yorum_tarih = new DateTime($yorum['y_tarih']);
            // Şuanki zamanı al
            $simdiki_zaman = new DateTime();
            // Yorum tarihi ile şuanki zaman arasındaki farkı dakika cinsine çevir
            $fark_dakika = $yorum_tarih->diff($simdiki_zaman)->days * 24 * 60 * 60 + 
                           $yorum_tarih->diff($simdiki_zaman)->h * 60 * 60 + 
                           $yorum_tarih->diff($simdiki_zaman)->i * 60 + 
                           $yorum_tarih->diff($simdiki_zaman)->s;
            
            // Dakika cinsine çevir
            $fark_dakika = round($fark_dakika / 60);
            
            // Hesaplanan değeri doğrudan yorum dizisine ekle
            $yorum['yorum_tarihi'] = $fark_dakika;
        }
        
        // Düzenlenmiş yorum dizisini döndür
        return $yorumlar;
    }
    
    
    
    
    
    