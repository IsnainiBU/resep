<?php
session_start();
$pengguna = $_POST['pengguna'];
$kata_kunci = md5($_POST['kata_kunci']);
$dataValid = "YA";
if (strlen(trim($pengguna)) == 0) {
    echo "User harus diisi! <br>";
    $dataValid = "TIDAK";
}
if (strlen(trim($kata_kunci)) == 0) {
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

$sql = "SELECT * FROM pengguna WHERE 
        user='" . $pengguna . "' AND pass ='" . $kata_kunci . "' LIMIT 1";
$hasil = mysqli_query($kon, $sql) or die('Gagal Akses! <br/>');

$jumlah = mysqli_num_rows($hasil);
if ($jumlah > 0) {
    $row = mysqli_fetch_assoc($hasil);
    $_SESSION["user"] = $row["user"];
    $_SESSION["nama_lengkap"] = $row["nama_lengkap"];
    header("Location:daftar_resep.php");
} else {
    echo "User atau Password Salah! <br/>";
    echo "<input type='button' value='Kembali'
    onclick='self.history.back()'>";
}
?>