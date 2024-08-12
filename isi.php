<?php
    include "konek.php";
    $sql = "select kodekt, namakt from kategori";
    $hasil =mysqli_query($kon, $sql);
    if(!$hasil)die("Gagal Query kategori");
?>
<fieldset>
    <h2 align="center">.:: ISI RESEP ::.</h2>
    <hr>
    <form action="resep_simpan.php" method="post" enctype="multipart/form-data" >
        <table align="center" cellspacing="20">
            <tr>
                <td>JUDUL</td>
                <td><input type="text" name="judul"></td>
            </tr>
            <tr>
                <td>GAMBAR [MAX. 1.5 MB]</td>
                <td><input type="file" name="gambar"></td>
            </tr>
            <tr>
                <td>BAHAN</td>                
                <td><textarea name="bahan" cols="30" rows="10" ></textarea></td>
            </tr>
            <tr>
                <td>INTRUKSI</td>
                <td><textarea name="intruksi" cols="30" rows="10"></textarea></td>
            </tr>
            <tr>
                <td>KATEGORI</td>
                <td><select name="kategori">
                    <?php
                    while($kt=mysqli_fetch_assoc($hasil)){
                        echo "<option value='".$kt['namakt']."'>".$kt['namakt']."</option>";
                        echo "</optgroup>";
                    }
                    ?>
                </select></td>
            </tr>
            <tr>
                <td colspan="2" align="center" >
                    <input type="submit" value="Simpan" name="proses">
                    <input type="reset" value="Reset" name="reset">
                    <input type="button" value="kembali" onclick="self.history.back()">
                </td>
            </tr>
        </table>
    </form>
</fieldset>