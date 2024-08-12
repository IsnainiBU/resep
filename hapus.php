<?php
$idresep = $_GET["idresep"];
include "konek.php";
$sql = "select * from resep where idresep like '%" . $idresep . "%'
        order by idresep desc ";
$hasil = mysqli_query($kon, $sql);
if (!$hasil)
    die("Gagal query.." . mysqli_error($kon));
?>
<fieldset>
    <h2 align="center">KONFIRMASI HAPUS RESEP</h2>
    <hr>
    <table align="center" border="1">
        <?php
        $no = 0;
        while ($row = mysqli_fetch_assoc($hasil)) {
            echo "<tr align='center'>";
            echo "<td colspan='2'><h2>" . $row['judul'] . "</h2></td>";
            echo "</tr>";
            echo "<tr align='center'>";
            echo "<td colspan='2'>";
            echo "<a href='gambar/{$row['gambar']}'/>
            <img src='thumb/t_{$row['gambar']}' width='200'/></a>";
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>BAHAN</td>";
            echo "<td>" . nl2br($row['bahan']) . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>LANGKAH-LANGKAH</td>";
            echo "<td>" . nl2br($row['intruksi']) . "</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td>KATEGORI</td>";
            echo "<td>" . $row['kategori'] . "</td>";
            echo "</tr>";
        }
        echo "</table> <br>";
        echo "<div colspan='2' align='center'>APAKAH RESEP INI AKAN DIHAPUS ?<br><br>";
        echo "<a href='hapus.php?idresep=$idresep?>&hapus=1'>YA</a>";
        echo "&nbsp; &nbsp;";
        echo "<a href='daftar_resep.php'>TIDAK</a> </div><br>";
        if (isset($_GET['hapus'])) {
            $sql = "delete from resep where idresep = '$idresep'";
            $hasil = mysqli_query($kon, $sql);
            if (!$hasil) {
                echo "Gagal Hapus Resep : $judul ..<br/>";
                echo "<a href='daftar_resep.php'>Kembali ke Daftar Resep</a>";
            } else {
                $gbr = "gambar/$gambar";
                if (file_exists($gbr))
                    unlink($gbr);
                $gbr = "thumb/t_$gambar";
                if (file_exists($gbr))
                    unlink($gbr);
                header('location:daftar_resep.php');
            }
        }
        ?>
</fieldset>