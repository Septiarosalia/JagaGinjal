Rule 1:
IF gejala = "Nyeri pinggang hebat(kolik)" AND
   gejala = "Kencing sakit" AND
   gejala = "Demam" AND
   gejala = "Kencing Sedikit" AND
   gejala = "Kencing merah/darah" AND
   gejala = "Sering kencing"
THEN penyakit = "Gagal Ginjal Akut"
     solusi = [
        "Menjaga kesehatan ginjal",
        "Ikuti petunjuk pada kemasan obat, jika anda menggunakan obat tanpa resep yang dijual bebas",
        "Ikuti petunjuk dokter, jika anda memiliki penyakit ginjal atau kondisi lain yang meningkatkan risiko",
        "Lakukan teknik pernafasan dengan diafragma untuk membuat anda lebih tenang"
     ]

Rule 2:
IF gejala = "Hilang nafsu makan" AND
   gejala = "Lelah dan lemah" AND
   gejala = "Bermasalah dalam tidur" AND
   gejala = "Otot terkedutdan kejang" AND
   gejala = "Bengkak pada area kaki" AND
   gejala = "Timbul rasa gatal"
THEN penyakit = "Gagal Ginjal Kronis"
     solusi = [
        "Menjalani cuci darah",
        "Transplantasi ginjal",
        "Menjalankan diet khusus, yaitu dengan mengurangi konsumsi garam, serta membatasi asupan protein",
        "Berkonsultasi dan senantiasa mengamati kondisi kesehatan dengan memeriksakan diri ke dokter secara rutin"
     ]

Rule 3:
IF gejala = "Nyeri pada saat buang air kecil" AND
   gejala = "Urin berwarna pink, merah atau coklat" AND
   gejala = "Mual dan muntah" AND
   gejala = "Sering buang air kecil" AND
   gejala = "Nyeri punggung, pinggul atau pangkal paha"
THEN penyakit = "Batu Ginjal"
     solusi = [
        "Minum air putih sebanyak 6-8 gelas air setiap hari",
        "Mengonsumsi obat pereda nyeri, karena keluarnya batu ginjal melalui urine dapat menimbulkan rasa sakit"
     ]

Rule 4:
IF gejala = "Nyeri pada perut" AND
   gejala = "Nanah atau darah pada urin"
THEN penyakit = "Infeksi Ginjal"
     solusi = [
        "Perbanyak minum air putih untuk membuang bakteri dari ginjal, serta untuk mencegah dehidrasi",
        "Gunakan bantal hangat pada perut, punggung, atau pinggang untuk mengurangi rasa nyeri",
        "Khusus pasien wanita, jangan buang air kecil dalam posisi jongkok, melainkan dalam posisi duduk di atas toilet duduk",
        "Istirahat yang cukup"
     ]

Rule 5:
IF gejala = "Tubuh terasa sangat lelah sekali tanpa sebab apapun" AND
   gejala = "Rasa nyeri pada sisi yang tidak hilang" AND
   gejala = "Adanya darah dalam urin"
THEN penyakit = "Kanker Ginjal"
     solusi = [
        "Berhenti merokok",
        "Selalu menjaga tekanan darah",
        "Menjaga berat badan ideal untuk menghindari obesitas dengan perbanyak konsumsi buah dan sayuran"
     ]

Rule 6:
IF gejala = "Tekanan darah tinggi" AND
   gejala = "Darah dalam air kencing" AND
   gejala = "Rasa lemah serta sulit tidur" AND
   gejala = "Sakit kepala" AND
   gejala = "Sesak nafas"
THEN penyakit = "Gagal Ginjal"
     solusi = [
        "Menjaga pola makan sehat",
        "Mengurangi konsumsi garam",
        "Memastikan cukup minum air putih",
        "Berkonsultasi dengan dokter untuk penanganan lebih lanjut"
     ]
