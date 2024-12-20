<?php
include 'function.php'; // session_start() sudah ada di function.php

// Cek jika pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data history diagnosa dari database
$query = "SELECT * FROM history_diagnosa WHERE id_user = '$id_user' ORDER BY tanggal DESC";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Diagnosa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            padding: 15px 0;
            color: #fff;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        .header .logo {
            position: absolute;
            left: 20px; /* Geser logo ke kiri */
            top: 7%;
            transform: translateY(-50%);
            max-height: 50px;

        }
        .header h1 {
            font-weight: bold;
            margin-left: 300px;
        }
        .header .btn-logout {
            position: absolute;
            right: 100px; /* Geser tombol logout ke kanan */
            top: 7%;
            transform: translateY(-50%);
            background-color: #dc3545;
            color: #fff;
            border: none;
            transition: all 0.3s ease;
        }

        .header .btn-logout:hover {
            background-color: #c82333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        /* Table Container */
        .table-container {
            background: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 25px;
            margin-top: 30px;
        }

        .table th {
            background: #6dd5ed;
            color: #fff;
            border: none;
        }
        .table td, .table th {
            text-align: center;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f1f9ff;
        }

        /* Button */
        .btn-back {
            background: #2193b0;
            color: #fff;
            border-radius: 20px;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: #6dd5ed;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
        <!-- Header -->
        <div class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Bagian Kiri Header -->
            <div class="d-flex align-items-center">
                <img src="gambar/logo.png" alt="Logo" class="logo">
                <div class="ml-3">
                    <h1 class="mb-0">History Diagnosa Anda</h1>
                    <p class="mt-2 mb-0" style="font-size: 1rem; font-weight: 300; margin-left: 260px;">
                        Riwayat diagnosa lengkap beserta solusi untuk kesehatan ginjal Anda
                    </p>
                </div>
            </div>
            <!-- Tombol Logout -->
            <a href="logout.php" class="btn btn-danger" onclick="return confirmLogout();">Log Out</a>

        </div>
    </div>

    <!-- Table Content -->
    <div class="container table-container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Hasil Diagnosa</th>
                    <th>Solusi</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td><strong>" . nl2br($row['hasil_diagnosa']) . "</strong></td>";
                    echo "<td class='text-left'>" . nl2br($row['solusi']) . "</td>";
                    echo "<td>" . date("d-m-Y H:i", strtotime($row['tanggal'])) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="text-center mt-4">
            <a href="dashboard.php" class="btn btn-back px-4 py-2">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
    function confirmLogout() {
        return confirm("Apakah Anda yakin ingin logout?");
    }
    </script>
</body>
</html>