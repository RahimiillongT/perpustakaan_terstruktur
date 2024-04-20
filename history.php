<?php
$link = new mysqli("127.0.0.1", "root", "", "perpustakaan_terstruktur");

$query = "SELECT buku.id, buku.judul, dipinjam.tanggal_peminjaman, pengembalian.tanggal_pengembalian 
          FROM buku 
          JOIN dipinjam ON buku.id = dipinjam.buku_id 
          JOIN pengembalian ON dipinjam.buku_id = pengembalian.buku_id";

$result = $link->query($query);
?>

<table border="1">
<tr><td>No</td><td>ID Buku</td><td>Judul Buku</td><td>Tanggal Peminjaman</td><td>Tanggal Pengembalian</td></tr>
<?php
$i = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>$i</td><td>{$row['id buku']}</td><td>{$row['judul']}</td><td>{$row['tanggal_peminjaman']}</td><td>{$row['tanggal_pengembalian']}</td></tr>";
    $i++;
}
?>
</table> <br>

<a href='./index.php'>KEMBALI KE DASHBOARD</a>

<?php
$result->free_result();
$link->close();
?>
