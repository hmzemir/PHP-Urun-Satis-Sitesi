import sys
import random
from PyQt5.QtWidgets import QApplication, QWidget, QVBoxLayout, QPushButton, QLabel, QMessageBox, QRadioButton, QProgressBar
from PyQt5.QtCore import QTimer

class BilgiYarismasi(QWidget):
    def __init__(self):
        super().__init__()

        self.setWindowTitle("Python Bilgi Yarışması")
        self.setGeometry(100, 100, 600, 400)  

        self.puan = 0
        self.soru_indeksi = 0
        self.sorular = [
            {"soru": "Python'un en temel veri tipi nedir?", "siklar": ["integer", "string", "list", "tuple"], "cevap": "integer", "puan": 10},
            {"soru": "Python'da liste oluşturmak için kullanılan parantez hangi türdendir?", "siklar": ["normal", "yuvarlak", "köşeli", "süslü"], "cevap": "köşeli", "puan": 20},
            {"soru": "Python'da bir değişkenin değerini ekrana yazdırmak için hangi fonksiyon kullanılır?", "siklar": ["print", "write", "echo", "display"], "cevap": "print", "puan": 30}
        ]

        random.shuffle(self.sorular)  # Soruları rastgele sırala

        self.soru_label = QLabel()
        self.soru_label.setStyleSheet("font-size: 20px;")  
        self.siklar = []
        self.devam_button = QPushButton("Devam")
        self.devam_button.setStyleSheet("font-size: 16px;")  
        self.devam_button.setEnabled(False)  

        self.devam_button.clicked.connect(self.devam_et)

        layout = QVBoxLayout()
        layout.addWidget(self.soru_label)

        for i in range(4):
            sik = QRadioButton()
            sik.setStyleSheet("font-size: 16px;")  
            sik.clicked.connect(self.cevap_secildi)
            self.siklar.append(sik)
            layout.addWidget(sik)

        layout.addWidget(self.devam_button)

        self.setLayout(layout)

        self.soruyu_goster()
        self.zamanlayici_baslat()

    def soruyu_goster(self):
        if self.soru_indeksi < len(self.sorular):
            soru_metni = self.sorular[self.soru_indeksi]["soru"]
            self.soru_label.setText(soru_metni)

            siklar = self.sorular[self.soru_indeksi]["siklar"]
            for i in range(4):
                self.siklar[i].setText(siklar[i])
                self.siklar[i].setChecked(False)
            self.devam_button.setEnabled(False)  
        else:
            self.sonuc_goster()

    def cevap_secildi(self):
        self.devam_button.setEnabled(True)  

    def devam_et(self):
        secilen_sik = None
        for sik in self.siklar:
            if sik.isChecked():
                secilen_sik = sik.text()
                break

        if secilen_sik == self.sorular[self.soru_indeksi]["cevap"]:
            self.puan += self.sorular[self.soru_indeksi]["puan"]
            QMessageBox.information(self, "Doğru Bildiniz", "Doğru Bildiniz!")
        else:
            self.sonuc_goster()

        self.soru_indeksi += 1
        self.soruyu_goster()

    def sonuc_goster(self):
        QMessageBox.information(self, "Oyun Bitti", f"Kaybettiniz!\nPuanınız: {self.puan}")
        self.soru_indeksi = 0
        self.puan = 0
        random.shuffle(self.sorular)  # Yeni bir oyun başlatmak için soruları tekrar karıştır
        self.soruyu_goster()

    def zamanlayici_baslat(self):
        self.zamanlayici = QTimer()
        self.zamanlayici.timeout.connect(self.zaman_bitti)
        self.zamanlayici.start(30000)  # Zamanlayıcıyı 30 saniye olarak ayarla

    def zaman_bitti(self):
        QMessageBox.information(self, "Zaman Bitti", "Zamanınız doldu!")
        self.sonuc_goster()

if __name__ == "__main__":
    app = QApplication(sys.argv)
    win = BilgiYarismasi()
    win.show()
    sys.exit(app.exec_())
