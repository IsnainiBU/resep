<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host   = "localhost";
$user   = "root" ;
$pass   = "";
$db     = "resep";

$kon = mysqli_connect($host, $user, $pass);
if (!$kon)
    die("Gagal Koneksi..");
$hasil = mysqli_select_db($kon, $db);
if(!$hasil){
    $hasil = mysqli_query($kon, "CREATE DATABASE IF NOT EXISTS $db");
    if(!$hasil)
        die ("Gagal Buat Database");
    else
        $hasil = mysqli_select_db($kon, $db);
        if(!$hasil) die ("Gagal Konek Database..");
}
$sqlTabelResep = "CREATE table if not exists resep(
                idresep int auto_increment not null primary key,
                judul varchar(40) not null,
                gambar varchar(70) not null default '',
                bahan text not null,
                intruksi text not null,
                kategori varchar(50) not null)";
mysqli_query($kon, $sqlTabelResep) or die ("Gagal Buat Tabel Resep");

$sqlTabelkategori = "CREATE table kategori(
    idkt int auto_increment not null primary key,
    kodekt varchar(10) not null,
    namakt varchar(30) not null)";
mysqli_query($kon, $sqlTabelResep) or die ("Gagal Buat Tabel Kategori");

$sqlTabelUser ="CREATE TABLE IF NOT EXISTS pengguna (
    idpengguna int auto_increment not null primary key,
    user varchar(25) not null,
    pass varchar(50) not null,
    nama_lengkap varchar(50) not null
    )";

mysqli_query($kon, $sqlTabelUser) or die("Gagal Buat Tabel Pengguna");

$sql ="SELECT * FROM pengguna";
$hasil = mysqli_query($kon, $sql);
$jumlah = mysqli_num_rows($hasil);
if($jumlah == 0 ){
    $sql = "INSERT INTO pengguna (user, pass, nama_lengkap)
    values ('admin', md5('admin'),'administrator')";
    mysqli_query($kon, $sql);
}
?>