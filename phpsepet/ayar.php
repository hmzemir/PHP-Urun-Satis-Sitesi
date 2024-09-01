<?php
	
	$host 		= "localhost";
	$dbname 	= "phpfinal";
	$charset 	= "utf8";
	$root 		= "root";
	$password 	= "";

	try {
		$db = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset;", $root, $password);
	} catch(PDOException $error) {
		echo "Veritabanı bağlantısı kurulurken bir hata oluştu: " . $error->getMessage();
	}
?>
