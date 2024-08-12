<?php
$idresep = $_GET["idresep"];
include "konek.php";
$sql = "select*from resep where idresep = '$idresep'";
$hasil = mysqli_query($kon, $sql);
if (!$hasil)
    die("Gagal query...");

$data = mysqli_fetch_array($hasil);
$judul = $data["judul"];
$gambar = $data["gambar"];
$bahan = $data["bahan"];
$intruksi = $data["intruksi"];
$kategori = $data["kategori"];
?>
<fieldset>
    <h2 align="center">.:: EDIT RESEP ::.</h2>
    <hr>
    <form action="resep_simpan.php" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="idresep" value="<?php echo $idresep; ?>">
        <table align="center" cellspacing="20">
            <tr>
                <td>JUDUL</td>
                <td><input type="text" name="judul" value="<?php echo $judul;?> "></td>
            </tr>
            <tr>
                <td>GAMBAR [MAX. 1.5 MB]</td>
                <td>
                <input type="file" name="gambar">
                <input type="hidden" name="gambar_lama" value="<?php echo $gambar;?>">
                <img src="<?php echo "thumb/t_".$gambar;?>" width="100px">    
                </td>
            </tr>
            <tr>
                <td>BAHAN</td>
                <td><textarea name="bahan" cols="30" rows="10" ><?php echo $bahan;?></textarea></td>
            </tr>
            <tr>
                <td>INTRUKSI</td>
                <td><textarea name="intruksi" cols="30" rows="10" ><?php echo $intruksi;?></textarea></td>
            </tr>
            <tr>
                <td>KATEGORI</td>
                <td><input type="text" name="kategori" value="<?php echo $kategori;?>" ></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Simpan" name="proses">
                    <input type="reset" value="Reset" name="reset">
                    <input type="button" value="kembali" onclick="self.history.back()">
                </td>
            </tr>
        </table>
    </form>
</fieldset>