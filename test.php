<?php 
include 'function.php';
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 0) {
        header("location: indexAdmin.php");
    } else if ($_SESSION['role'] == 2) {
        header("location: indexPakar.php");
    }
}

if(!isset($_SESSION['persentase'])){
    $_SESSION['persentase'] = [];
}


$gejala = mysqli_query($koneksi, "SELECT * FROM gejala");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
    crossorigin="anonymous"/>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,700&display=swap"
    rel="stylesheet"/>
    <link rel="stylesheet" href="custom.css" />
    <title>Jaga Ginjal</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }
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

        footer {
        background-color: #2193b0;
        color: #fff;
        padding: 10px 0;
        text-align: center;
        margin-top: 50px;
      }
      footer a {
        color: #6dd5ed;
        text-decoration: none;
      }
        </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img src="gambar/JAGAGINJAL.png" alt="Logo Jaga Ginjal" class="img-fluid">
            </div>
            <div class="d-flex align-items-center">
                <h5 class="mr-3">Welcome, Septia Rosalia!</h5>
                <a href="logout.php" class="btn btn-danger" onclick="return confirmLogout();">Log Out</a>
            </div>
        </div>
    </div>


    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan : </h2>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                    <?php
                        $id_penyakit=1;
                        $id = gejala($id_penyakit);
                        $id_gejala = intval($id);
                        if(!isset($_SESSION['id_gejala'])){
                            $_SESSION['id_gejala'] = $id_gejala;
                        }else{
                            $id_gejala = $_SESSION['id_gejala'];
                        }
                        $data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
                        $row = mysqli_fetch_assoc($data);
                    ?>
                    <p class="mb-4">
                        Apakah anda mengalami <?= $row['gejala']; ?> ?
                    </p>
                    <?php 
                        echo'<input type="submit" class="btn btn-primary mr-2 px-4 py-2" name="ya" value="Ya">';
                        echo'<input type="submit" class="btn btn-danger px-3 py-2" name="tidak" value="Tidak">';
                        $persentase = $_SESSION['persentase'];
                        $temp = 0;
                        $_SESSION['id_gejala'] = $id_gejala;
                        $next_gejala = $_SESSION['id_gejala'];
                        if(isset($_POST['ya'])){
                            if(isset($id_gejala)){
                                $temp = $id_gejala;
                                array_push($persentase, $temp);
                            }
                            $_SESSION['persentase'] = $persentase;
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                        } 
                        else if(isset($_POST['tidak'])){
                            $next_gejala = $id_gejala + 1;
                            $_SESSION['id_gejala'] = $next_gejala;
                        }
                        if($_SESSION['id_gejala'] > 27) {
                        
                        $ginjalAkut = array(1,2,3,4,5,6);
                        $ginjalKronis = array(7,8,9,10,11,12);
                        $batuGinjal = array(13,14,15,16,17);
                        $infeksiGinjal = array(18,19);
                        $kankerGinjal = array(20,21,22);
                        $gagalGinjal = array(23,24,25,26,27); 
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $ginjalAkut)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            } 
                        }
                        $GinjalAkut = $nilai/count($ginjalAkut);
                        $Akut = number_format($GinjalAkut,3);
                        $hasilGinjalAkut = $Akut *100;
                        $_SESSION['ginjalAkut'] = $hasilGinjalAkut;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $ginjalKronis)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $GinjalKronis = $nilai/count($ginjalKronis);
                        $Kronis = number_format($GinjalKronis,3);
                        $hasilGinjalKronis = $Kronis *100;
                        $_SESSION['ginjalKronis'] = $hasilGinjalKronis;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $batuGinjal)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $BatuGinjal = $nilai/count($batuGinjal);
                        $Batu = number_format($BatuGinjal,3);
                        $hasilBatuGinjal = $Batu *100;
                        $_SESSION['batuGinjal'] = $hasilBatuGinjal;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $infeksiGinjal)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $InfeksiGinjal = $nilai/count($infeksiGinjal);
                        $Infeksi = number_format($InfeksiGinjal,3);
                        $hasilInfeksiGinjal = $Infeksi *100;
                        $_SESSION['infeksiGinjal'] = $hasilInfeksiGinjal;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $kankerGinjal)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $KankerGinjal = $nilai/count($kankerGinjal);
                        $Kanker = number_format($KankerGinjal,3);
                        $hasilKankerGinjal = $Kanker *100;
                        $_SESSION['kankerGinjal'] = $hasilKankerGinjal;
                        $nilai = 0;
                        foreach ($persentase as $value) {
                            if (in_array($value, $gagalGinjal)) {
                                $nilai += 1;
                            }else{
                                $nilai += 0;
                            }
                        }
                        $GagalGinjal = $nilai/count($gagalGinjal);
                        $Gagal = number_format($GagalGinjal,3);
                        $hasilGagalGinjal = $Gagal *100;
                        $_SESSION['gagalGinjal'] = $hasilGagalGinjal;
                        header('Location:hasil.php');
                    }
                    ?>
                    <br>
                    
                </div>
                    </form>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/jawab.png" alt="hero" />
                    <a href="dashboard.php" class="btn btn-primary back-button mt-3">Back</a>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- Footer -->
<footer>
        <div class="container">
            <p>&copy; 2024 Jaga Ginjal - All Rights Reserved</p>
            <p>
                <a href="privacy.php">Privacy Policy</a> |
                <a href="terms.php">Terms of Service</a>
            </p>
        </div>
    </footer>

<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"
></script>
<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"
></script>
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"
></script>
</html>