<fieldset>
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION["user"])) {
        echo "Sesi Sudah Habis !<br/>
            <a href='login_form.php'>LOGIN LAGI</a>";
        exit;
    }
    echo "SELAMAT DATANG <br/>";
    echo "User &nbsp;&nbsp;&nbsp;: " . $_SESSION["user"] . "<br/>";
    echo "Nama &nbsp;: " . $_SESSION["nama_lengkap"] . "<br/><hr>";

    $cari = "";
    if (isset($_POST["cari"]))
        $cari = $_POST["cari"];

    include "konek.php";
    $sql = "select * from resep where judul like '%" . $cari . "%'
        OR kategori like '%" . $cari . "%'
        order by idresep desc ";
    $hasil = mysqli_query($kon, $sql);
    if (!$hasil)
        die("Gagal query.." . mysqli_error($kon));
    ?>
    <a href="isi.php">INPUT RESEP BARU</a>
    &nbsp; &nbsp; &nbsp;
    <a href="cari.php">CARI RESEP</a><br><hr>
    <table border="1">
        <tr>
            <th>JUDUL</th>
            <th>GAMBAR</th>
            <th>KATEGORI</th>
            <th>OPERASI</th>
        </tr>
        <?php
        $no = 0;
        while ($row = mysqli_fetch_assoc($hasil)) {
            echo "<tr>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td><a href='pict/{$row['gambar']}'/>
                    <img src='thumb/t_{$row['gambar']}' width='100'/>
                    </a></td>";
            echo "<td>" . $row['kategori'] . "</td>";
            echo "<td>";
            echo "<a href='lihat.php?idresep=" . $row['idresep'] . "'>
                    LIHAT </a>";
            echo "&nbsp; &nbsp;";
            echo "<a href='edit.php?idresep=" . $row['idresep'] . "'>
                    EDIT </a>";
            echo "&nbsp; &nbsp;";
            echo "<a href='hapus.php?idresep=" . $row['idresep'] . "'>
                    HAPUS </a>";
            echo "</tr>";
        }
        ?>
    </table>
</fieldset>