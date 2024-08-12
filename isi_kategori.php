<h2>ISI KATEGORI</h2>
<form action="" method="post">
    Kode : <select name="kodekt" id="">
        <option value="">pilih </option>
        <option value="MAKANAN">MAKANAN</option>
        <option value="MINUMAN">MINUMAN</option>
    </select>
    <br>
    Nama Kategori : <input type="text" name="namakt" >
    <input type="submit" value="Simpan">
</form>

<?php
$kodekt=$_POST['kodekt'];
$namakt = $_POST['namakt'];

include "konek.php";
$sql = "insert into kategori
        (kodekt, namakt)
        values
        ('$kodekt','$namakt')";
        $hasil = mysqli_query($kon, $sql);
        if (!$hasil){
            echo "Gagal Simpan..".mysqli_error($kon);
        } else {
            echo "Berhasil Simpan";
        }
?>
