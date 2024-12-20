<?php
include 'function.php';

// Cek session dari function.php sudah ada
if (!isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Penyakit Ginjal</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #6dd5ed, #2193b0); /* Gradient biru */
            padding: 15px 0;
            border-radius: 0 0 20px 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .header img {
            max-height: 50px;
        }

        .header h4 {
            font-weight: bold;
            color: white;
            margin-bottom: 0;
        }

        .header h5 {
            font-weight: normal;
            color: white;
            margin-bottom: 0;
        }

        /* Button Logout */
        .btn-logout {
            background-color: #dc3545;
            border: none;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-logout:hover {
            background-color: #c82333;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Artikel Kontainer */
        .artikel-container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin: 2rem auto;
        }

        .artikel-judul {
            color: #2c3e50;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .artikel-meta {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        /* Button Custom */
        .btn-custom {
            padding: 10px 25px;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-kembali {
            background-color: #007bff;
        }

        .btn-kembali:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }

        .btn-cek {
            background-color: #28a745;
        }

        .btn-cek:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="d-flex align-items-center">
                <img src="gambar/logo.png" alt="Logo Cek Ginjal Yuk!" class="img-fluid">
                <h4 class="ml-3">Cek Ginjal Yuk!</h4>
            </div>
            <!-- Welcome Text dan Logout -->
            <div>
                <h5 class="d-inline-block mb-0 mr-3">
                    Welcome, 
                    <?php
                    // Tampilkan nama pengguna yang login
                    echo htmlspecialchars($_SESSION['nama']);
                    ?>
                </h5>
                <a href="logout.php" class="btn btn-danger" onclick="return confirmLogout();">Log Out</a>
                </div>
        </div>
    </div>

    <!-- Konten Artikel -->
    <div class="container">
        <div class="artikel-container">
            <h1 class="artikel-judul">Memahami Penyakit Ginjal: Gejala, Penyebab, dan Pencegahan</h1>
            <div class="artikel-meta">
                <span class="mr-4">
                    <i class="fas fa-user"></i> Dr. Ahmad Syafiq
                </span>
                <span>
                    <i class="fas fa-calendar-alt"></i> 17 Desember 2024
                </span>
            </div>
            <div class="artikel-konten">
                <p>Penyakit ginjal merupakan kondisi yang terjadi ketika ginjal mengalami kerusakan dan tidak dapat berfungsi sebagaimana mestinya. Ginjal memiliki peran penting dalam tubuh sebagai organ yang memfiltrasi darah, mengatur tekanan darah, dan menghasilkan hormon penting.</p>

                <h2>Gejala Umum Penyakit Ginjal</h2>
                <p>Beberapa gejala umum yang perlu diwaspadai:</p>
                <ul>
                    <li>Pembengkakan pada kaki, pergelangan kaki, dan wajah</li>
                    <li>Perubahan pada urin (warna, jumlah, atau frekuensi)</li>
                    <li>Kelelahan dan lemah yang berkelanjutan</li>
                    <li>Mual dan muntah</li>
                    <li>Nyeri punggung bagian bawah</li>
                    <li>Tekanan darah tinggi yang sulit dikontrol</li>
                </ul>

                <h2>Penyebab Penyakit Ginjal</h2>
                <p>Penyakit ginjal dapat disebabkan oleh berbagai faktor, termasuk:</p>
                <ul>
                    <li>Diabetes mellitus yang tidak terkontrol</li>
                    <li>Hipertensi (tekanan darah tinggi)</li>
                    <li>Infeksi ginjal yang berulang</li>
                    <li>Batu ginjal</li>
                    <li>Penyakit autoimun</li>
                    <li>Penggunaan obat-obatan tertentu dalam jangka panjang</li>
                </ul>

                <h2>Pencegahan Penyakit Ginjal</h2>
                <p>Beberapa langkah pencegahan yang dapat dilakukan:</p>
                <ul>
                    <li>Menjaga pola makan sehat dengan membatasi garam dan protein</li>
                    <li>Rutin berolahraga minimal 30 menit sehari</li>
                    <li>Menjaga berat badan ideal</li>
                    <li>Berhenti merokok dan membatasi konsumsi alkohol</li>
                    <li>Mengontrol tekanan darah dan gula darah</li>
                    <li>Minum air putih yang cukup (minimal 8 gelas sehari)</li>
                    <li>Pemeriksaan kesehatan rutin</li>
                </ul>

                <p>Jika Anda mengalami gejala-gejala di atas atau memiliki faktor risiko penyakit ginjal, segera konsultasikan dengan dokter untuk mendapatkan penanganan yang tepat.</p>
            </div>
            <!-- Tombol Kembali dan Cek Sekarang -->
            <div class="text-center mt-5 d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-custom btn-kembali">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
                </a>
                <a href="test.php" class="btn btn-custom btn-cek">
                    <i class="fas fa-check-circle mr-2"></i>Cek Sekarang
                </a>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        function confirmLogout() {
            return confirm("Apakah Anda yakin ingin logout?");
        }
    </script>
</body>
</html>
