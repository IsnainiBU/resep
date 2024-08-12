<?php
session_start();
$pengguna = $_POST['pengguna'];
$nama_lengkap = $_POST['nama_lengkap'];
$kata_kunci = md5($_POST['kata_kunci']);
$ckata_kunci = md5($_POST['ckata_kunci']);
$dataValid = "YA";
if (strlen(trim($pengguna)) == 0) {
    echo "User harus diisi! <br>";
    $dataValid = "TIDAK";
}
if (strlen(trim($kata_kunci)) == 0) {
    echo "Password harus diisi! <br>";
    $dataValid = "TIDAK";
}
if (strlen(trim($ckata_kunci)) == 0) {
    echo "Password harus diisi! <br>";
    $dataValid = "TIDAK";
}
if ($dataValid == "TIDAK") {
    echo "Masih Ada Kesalahan, Silahkan Perbaiki!<br/>";
    echo "<input type='button' value='Kembali' 
    onclick='self.history.back()'>";
    exit;
}
include "konek.php";
if ($kata_kunci == $ckata_kunci) {
    $sql = "SELECT * FROM pengguna WHERE 
        user='" . $pengguna . "' AND pass ='" . $kata_kunci . "' LIMIT 1";
    $hasil = mysqli_query($kon, $sql) or die('Gagal Akses! <br/>');
    if (!$hasil->num_rows > 0) {
        $sql = " INSERT INTO pengguna (user,nama_lengkap, pass)
                VALUES ('$pengguna', '$nama_lengkap', '$kata_kunci')";
        $hasil = mysqli_query($kon, $sql);
        if ($hasil) {
            echo "Selamat Registrasi Berhasil! <br/>";
            echo "Silahkan Login! <br/>";
            $pengguna = "";
            $nama_lengkap = "";
            $_POST['kata_kunci'] = "";
            $_POST['ckata_kunci'] = "";
            echo " <a href='index.php'>Login</a>";
        } else {
            echo "<script>alert('Oops! Terjadi kesalahan.')</script>";
        }
    }
} else {
    echo "<script>alert('Password Tidak Sesuai')</script>";
}
?>