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
    <title>Cek Ginjal Yuk!</title>
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
        </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <div class="d-flex align-items-center">
                <img src="gambar/logo.png" alt="Logo Cek Ginjal Yuk!" class="img-fluid">
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


    <section class="test mt-5">
        <div class="container">
            <div class="row">
                <div class="col align-self-center">
                    <h2 class="mb-4">Pertanyaan : </h2>
                    <form action="" method="post" enctype="multipart/form-data" role="form">
                    <?php
                        $id_penyakit=1;
                        // if(!isset($_SESSION['id_penyakit'])){
                        //     $_SESSION['id_penyakit'] = $id_penyakit;
                        // }else{
                        //     $id_penyakit = $_SESSION['id_penyakit'];
                        // }
                        $id = gejala($id_penyakit);
                        $id_gejala = intval($id);
                        if(!isset($_SESSION['id_gejala'])){
                            $_SESSION['id_gejala'] = $id_gejala;
                        }else{
                            $id_gejala = $_SESSION['id_gejala'];
                        }
                        $data = mysqli_query($koneksi, "SELECT gejala FROM gejala WHERE id_gejala = '$id_gejala'");
                        // var_dump($data);
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
                        // $next_penyakit = $_SESSION['id_penyakit'];
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
                            // $next_penyakit = $id_penyakit += 1;
                            // $_SESSION['id_penyakit'] = $next_penyakit;
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
                        // echo $hasilGinjalAkut;
                        // echo '<br>';
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
                        // echo $hasilGinjalKronis;
                        // echo '<br>';
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
                        // echo $hasilBatuGinjal;
                        // echo '<br>';
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
                        // echo $hasilInfeksiGinjal;
                        // echo '<br>';
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
                        // echo $hasilKankerGinjal;
                        // echo '<br>';
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
                        // echo $hasilGagalGinjal;
                        // echo '<br>';
                        $_SESSION['gagalGinjal'] = $hasilGagalGinjal;
                        header('Location:hasil.php');
                    }
                    ?>
                    <br>
                    
                </div>
                    </form>
                <div class="col d-none d-sm-block">
                    <img width="500" src="gambar/jawab.png" alt="hero" />
                </div>
            </div>
        </div>
    </section>
</body>

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
<script>
    function confirmLogout() {
        return confirm("Apakah Anda yakin ingin logout?");
    }
    </script>
</html>
