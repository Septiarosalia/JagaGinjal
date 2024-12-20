<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$koneksi = mysqli_connect('localhost', 'root', '', 'db_penyakitginjal');

if (mysqli_connect_errno()) {
    echo "Koneksi Database Gagal : " . mysqli_connect_error();
}

// Fungsi untuk mengambil data dari database
function getData($query) {
    global $koneksi;
    $result = mysqli_query($koneksi, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;

// Fungsi getData
if (!function_exists('getData')) {
    function getData($table) {
        global $koneksi;
        $query = "SELECT * FROM $table";
        $result = mysqli_query($koneksi, $query);

        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        return $data;
    }
}

// Fungsi lain yang dibutuhkan
if (!function_exists('insertData')) {
    function insertData($table, $data) {
        global $koneksi;

        $columns = implode(", ", array_keys($data));
        $values = implode("', '", array_map('mysqli_real_escape_string', array_values($data)));

        $query = "INSERT INTO $table ($columns) VALUES ('$values')";
        return mysqli_query($koneksi, $query);
    }
}

if (!function_exists('updateData')) {
    function updateData($table, $data, $condition) {
        global $koneksi;

        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "$key = '" . mysqli_real_escape_string($koneksi, $value) . "'";
        }
        $setClause = implode(", ", $set);

        $query = "UPDATE $table SET $setClause WHERE $condition";
        return mysqli_query($koneksi, $query);
    }
}

if (!function_exists('deleteData')) {
    function deleteData($table, $condition) {
        global $koneksi;
        $query = "DELETE FROM $table WHERE $condition";
        return mysqli_query($koneksi, $query);
    }
}
}




if (isset($_GET["act"])) {
    $act = $_GET["act"];
    if ($act == "register") {
        register();
    } else if ($act == "login") {
        login();
    } else if ($act == "registerPakar") {
        registerPakar();
    } else if ($act == "tambahGejala") {
        tambahGejala();
    } else if ($act == "tambahPenyakit") {
        tambahPenyakit();
    } else if ($act == "tambahSolusi") {
        tambahSolusi();
    } else if ($act == "hapusGejala") {
        $id_gejala = $_GET["id_gejala"];
        hapusGejala($id_gejala);
    } else if ($act == "hapusPenyakit") {
        $id_penyakit = $_GET["id_penyakit"];
        hapusPenyakit($id_penyakit);
    } else if ($act == "hapusPasien") {
        $id_user = $_GET["id_user"];
        hapusPasien($id_user);
    } else if ($act == "hapusPakar") {
        $id_user = $_GET["id_user"];
        hapusPakar($id_user);
    } else if ($act == "hapusSolusi") {
        $id_solusi = $_GET["id_solusi"];
        hapusSolusi($id_solusi);
    } else if ($act == "ubahGejala") {
        $id_gejala = $_GET["id_gejala"];
        ubahGejala($id_gejala);
    } else if ($act == "ubahPasien") {
        $id_user = $_GET["id_user"];
        ubahPasien($id_user);
    } else if ($act == "ubahPakar") {
        $id_user = $_GET["id_user"];
        ubahPakar($id_user);
    } else if ($act == "ubahPenyakit") {
        $id_penyakit = $_GET["id_penyakit"];
        ubahPenyakit($id_penyakit);
    } else if ($act == "ubahSolusi") {
        $id_solusi = $_GET["id_solusi"];
        ubahSolusi($id_solusi);
    } else if($act == "ulang"){
        ulang();
    }
}

function ulang(){
    session_unset();
    session_destroy();
    header("location: dashboard.php");
}

function register()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $query_user = "INSERT INTO user VALUES ('','1','$nama', '$email', '$alamat', '$tgl_lahir','$password')";
    $exe = mysqli_query($koneksi, $query_user);

    if (!$exe) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        echo "<script>
        alert('Berhasil Registrasi! Silahkan Login');
        document.location.href = 'index.php';
            </script>";
    }
}

function registerPakar()
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash(htmlspecialchars($_POST['password']), PASSWORD_DEFAULT);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = $_POST['tgl_lahir'];
    $query_pakar = "INSERT INTO user VALUES ('','2','$nama', '$email', '$alamat', '$tgl_lahir','$password')";
    $exe = mysqli_query($koneksi, $query_pakar);

    if (!$exe) {
        die('Query Error : ' . mysqli_errno($koneksi) . '-' . mysqli_error($koneksi));
    } else {
        echo "<script>
        alert('Berhasil Registrasi Pakar! Segera beritahu pakar Login');
        document.location.href = 'indexPakar.php';
            </script>";
    }
}

function login() {
    global $koneksi;
    $nama = htmlspecialchars($_POST["nama"]);
    $input_pass = htmlspecialchars($_POST['password']);
    $query = mysqli_query($koneksi, "SELECT * FROM user WHERE nama = '$nama'");
    $data = mysqli_fetch_assoc($query);
    
    if ($data) {
        $password = $data['password'];
        $role = (int)$data['role']; // Pastikan role disimpan sebagai integer
        
        if (password_verify($input_pass, $password)) {
            // Simpan data pengguna ke dalam session
            $_SESSION['id_user'] = $data['id_user'];
            $_SESSION['nama'] = $data['nama'];
            $_SESSION['logged_in'] = true;
            $_SESSION['role'] = $role; // Simpan role ke session
            
            // Redirect sesuai role
            if ($role === 1) {
                echo "<script>
                document.location.href = 'dashboard.php';
                </script>";
            } elseif ($role === 0) {
                echo "<script>
                document.location.href = 'indexAdmin.php';
                </script>";
            } elseif ($role === 2) {
                echo "<script>
                document.location.href = 'indexPakar.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Password salah!');
                document.location.href = 'index.php';
                </script>";
        }
    } else {
        echo "<script>
            alert('Username tidak ditemukan!');
            document.location.href = 'index.php';
            </script>";
    }
}

function tambahGejala()
{
    global $koneksi;
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $queryGejala = "INSERT INTO gejala VALUES ('','$gejala')";
    
    $exe = mysqli_query($koneksi, $queryGejala);
    
    if (!$exe) {
        die('Error pada database');
    }   
        $id_gejala = mysqli_insert_id($koneksi);
        $queryRelasi = "INSERT INTO relasi VALUES ('', '$id_gejala', '$id_penyakit')";
        $ex = mysqli_query($koneksi, $queryRelasi);

        if(!$ex){
            die('Error pada database');
        }
        echo "<script>
        alert('Gejala berhasil ditambahkan');
        document.location.href = 'indexGejala.php'</script>";
}

function tambahPenyakit()
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $queryPenyakit = "INSERT INTO penyakit VALUES ('','$penyakit')";
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Penyakit berhasil ditambahkan');
            document.location.href = 'indexPenyakit.php'</script>";
}

function tambahSolusi()
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $querySolusi = "INSERT INTO solusi VALUES ('', '$id_penyakit', '$solusi')";
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Solusi berhasil ditambahkan');
            document.location.href = 'indexSolusi.php'</script>";
}

function ubahGejala($id_gejala)
{
    global $koneksi;
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $gejala = htmlspecialchars($_POST['namaGejala']);
    $queryGejala = "UPDATE gejala SET gejala = '$gejala' WHERE id_gejala = '$id_gejala'";
    $exe = mysqli_query($koneksi, $queryGejala);
    if (!$exe) {
        die('Error pada database');
    }
        $queryRelasi = "UPDATE relasi SET id_gejala = '$id_gejala', id_penyakit = '$id_penyakit' WHERE id_gejala = '$id_gejala'";
        $ex = mysqli_query($koneksi, $queryRelasi);
        if(!$ex){
            die('Error pada database');
        }    
        echo "<script>
        alert('Data Gejala berhasil diubah');
        document.location.href = 'indexGejala.php'</script>";
}

function ubahSolusi($id_solusi)
{
    global $koneksi;
    $solusi = htmlspecialchars($_POST['namaSolusi']);
    $id_penyakit = htmlspecialchars($_POST['id_penyakit']);
    $querySolusi = "UPDATE solusi SET solusi = '$solusi', id_penyakit = '$id_penyakit' WHERE id_solusi = '$id_solusi'";
    $exe = mysqli_query($koneksi, $querySolusi);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Solusi berhasil diubah!');
            document.location.href = 'indexSolusi.php'</script>";
}

function ubahPenyakit($id_penyakit)
{
    global $koneksi;
    $penyakit = htmlspecialchars($_POST['namaPenyakit']);
    $queryPenyakit = "UPDATE penyakit SET penyakit = '$penyakit' WHERE id_penyakit = '$id_penyakit'";
    $exe = mysqli_query($koneksi, $queryPenyakit);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Penyakit berhasil diubah!');
            document.location.href = 'indexPenyakit.php'</script>";
}

function ubahPasien($id_user)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $queryUser = "UPDATE user SET nama = '$nama', email = '$email', alamat = '$alamat', tgl_lahir = '$tgl_lahir' WHERE id_user = '$id_user'";
    $exe = mysqli_query($koneksi, $queryUser);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pasien berhasil diubah!');
            document.location.href = 'indexAdmin.php'</script>";
}

function ubahPakar($id_user)
{
    global $koneksi;
    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $alamat = htmlspecialchars($_POST['alamat']);
    $tgl_lahir = htmlspecialchars($_POST['tgl_lahir']);
    $queryUser = "UPDATE user SET nama = '$nama', email = '$email', alamat = '$alamat', tgl_lahir = '$tgl_lahir' WHERE id_user = '$id_user'";
    $exe = mysqli_query($koneksi, $queryUser);
    if (!$exe) {
        die('Error pada database');
    }
            echo "<script>
            alert('Data Pakar berhasil diubah!');
            document.location.href = 'indexPakar.php'</script>";
}

function hapusGejala($id_gejala)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM gejala WHERE id_gejala = $id_gejala");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Gejala berhasil dihapus!');
                document.location.href = 'indexGejala.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                alert('Gejala gagal dihapus, karena masih terikat dengan penyakit!');
                document.location.href = 'indexGejala.php';
            </script>	
        ";
    }
}

function hapusPasien($id_user)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id_user");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Akun Pasien berhasil dihapus!');
                document.location.href = 'indexAdmin.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Akun Pasien gagal dihapus!');
                    document.location.href = 'indexAdmin.php';
            </script>	
        ";
    }
}

function hapusPakar($id_user)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM user WHERE id_user = $id_user");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Akun Pakar berhasil dihapus!');
                document.location.href = 'indexPakar.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Akun Pakar gagal dihapus!');
                    document.location.href = 'indexPakar.php';
            </script>	
        ";
    }
}

function hapusPenyakit($id_penyakit)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM penyakit WHERE id_penyakit = $id_penyakit");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Penyakit berhasil dihapus!');
                document.location.href = 'indexPenyakit.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Penyakit gagal dihapus, karena masih terikat dengan gejala!');
                    document.location.href = 'indexPenyakit.php';
            </script>	
        ";
    }
}

function hapusSolusi($id_solusi)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM solusi WHERE id_solusi = $id_solusi");
    $result = mysqli_affected_rows($koneksi);
    if ($result > 0) {
        echo "
        <script>
                alert('Solusi berhasil dihapus!');
                document.location.href = 'indexSolusi.php';
            </script>	
        ";
    } else {
        echo "
        <script>
                    alert('Solusi gagal dihapus!');
                    document.location.href = 'indexSolusi.php';
            </script>	
        ";
    }
}

function gejala($id_penyakit){
    global $koneksi;
    $query = "SELECT relasi.id_gejala as id_gejala FROM relasi 
              INNER JOIN gejala ON relasi.id_gejala = gejala.id_gejala 
              INNER JOIN penyakit ON relasi.id_penyakit = penyakit.id_penyakit 
              WHERE relasi.id_penyakit = '$id_penyakit'";
    $data = mysqli_query($koneksi, $query);
    $row = mysqli_fetch_assoc($data);
    return $row['id_gejala'];
}

function maximum($a, $b, $c, $d, $e, $f)
                    {
                        $max = $a;
                        $kode =1; 
                        if ($b> $max) { 
                            $max = $b;
                            $kode = 2;
                        } 
                        if ($c > $max) { 
                            $max = $c;
                            $kode = 3;
                        } 
                        if ($d > $max) { 
                            $max = $d;
                            $kode = 4;
                        } 
                        if ($e > $max) { 
                            $max = $e;
                            $kode = 5;
                        } 
                        if ($f > $max) { 
                            $max = $f;
                            $kode = 6;
                        } 
                        return $kode;
                    }


?>
