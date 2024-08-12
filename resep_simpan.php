<?php
if(isset($_POST["idresep"])){
    $idresep      = $_POST['idresep'];
    $gambar_lama  = $_POST['gambar_lama'];
    $simpan       = "EDIT";
}else{
    $simpan     = "BARU";
}

$judul     = $_POST['judul'];
$bahan     = $_POST['bahan'];
$intruksi  = $_POST['intruksi'];
$kategori  = $_POST['kategori'];

$gambar    = $_FILES['gambar']['name'];
$tmpName   = $_FILES['gambar']['tmp_name'];
$size      = $_FILES['gambar']['size'];
$type      = $_FILES['gambar']['type'];

$maxsize    = 1500000;
$typeYgBoleh= array("image/jpeg", "image/png", "image/pjpeg");

$dirFoto    = "gambar";
if(!is_dir($dirFoto))
    mkdir($dirFoto);
$fileTujuanFoto = $dirFoto."/".$gambar;

$dirThumb   = "thumb";
if(!is_dir($dirThumb))
    mkdir($dirThumb);
$fileTujuanThumb    = $dirThumb."/t_".$gambar;

$dataValid="YA";

if($size>0){
    if($size>$maxsize){
        echo " Ukuran File Terlalu Besar <br/>";
        $dataValid ="TIDAK";
    }
    if(!in_array($type, $typeYgBoleh)){
        echo " Type File Tidak Dikeknal <br/>";
        $dataValid ="TIDAK";
    }
}

if(strlen(trim($judul))==0){
    echo "Judul harus diisi! <br>";
    $dataValid = "TIDAK";
}
if(strlen(trim($bahan))==0){
    echo "Bahan harus diisi! <br>";
    $dataValid = "TIDAK";
}
if(strlen(trim($intruksi))==0){
    echo "Intruksi harus diisi! <br>";
    $dataValid = "TIDAK";
}
if(strlen(trim($kategori))==0){
    echo "Kategori harus diisi! <br>";
    $dataValid = "TIDAK";
}
if($dataValid=="TIDAK"){
    echo "Masih ada kesalahan, silahkan perbaiki!<br>";
    echo "<input type='button' value='kembali' 
    onclick='self.history.back()'>";
    exit;
}
include "konek.php";

if($simpan == "EDIT"){
    if($size == 0){
        $gambar = $gambar_lama;
    }
    $sql = "update resep set
            judul ='$judul',
            gambar ='$gambar',
            bahan ='$bahan',
            intruksi ='$intruksi', 
            kategori ='$kategori'
            where idresep = $idresep";
}else {
    $sql    = "insert into resep
            (judul, gambar, bahan, intruksi, kategori) 
            values
            ('$judul', '$gambar', '$bahan','$intruksi', '$kategori')";
}

$hasil  = mysqli_query($kon, $sql);

if (!$hasil){
    echo "Gagal Simpan, Silahkan Diulangi<br>";
    echo mysqli_error($kon);
    echo "<br> <input type='buttton' value='Kembali'
            onClick='self.history.back()'>";
    exit;
}else {
    echo "Simpan Data Berhasil";
}
if($size>0){
    if(!move_uploaded_file($tmpName, $fileTujuanFoto)){
        echo "Gagal Upload Gambar...<br/>";
        echo "<a href= 'daftar_resep.php'>Daftar Resep</a>";
        exit;
    } else {
        buat_thumbnail($fileTujuanFoto, $fileTujuanThumb);
    }
}

echo "<br/> File Sudah Diupload.<br/>";

function buat_thumbnail($file_src, $file_dst){
    //hapus jika thumbnail sebelumnya sudah ada
    list($w_src, $h_src, $type) = getImagesize($file_src);

    switch($type){
        case 1: //gif -> jpg
            $img_src = imagecreatefromgif($file_src);
            break;
        case 2 :  //jpeg -> jpg
            $img_src = imagecreatefromjpeg($file_src);
            break;
        case 3 : //png -> jpg
            $img_src = imagecreatefrompng($file_src);
            break;
    }

    $thumb =100; //max. size untuk thumb
    if ($w_src>$h_src){
        $w_dst = $thumb; //landscape
        $h_dst = round($thumb/$w_src*$h_src);
    } else {
        $w_dst = round($thumb/$h_src*$w_src); //potrait
        $h_dst = $thumb;
    }

    $img_dst = imagecreatetruecolor($w_dst, $h_dst); //resample

    imagecopyresampled($img_dst, $img_src, 0, 0, 0, 0, 
            $w_dst, $h_dst, $w_src, $h_src);
    imagejpeg($img_dst, $file_dst); //simpan thumbnail
    //bersikan memori
    imagedestroy($img_src);
    imagedestroy($img_dst);
}
?>

<hr>
<a href="daftar_resep.php">DAFTAR RESEP</a>
