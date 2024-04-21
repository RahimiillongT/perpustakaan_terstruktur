<?php
$link = new mysqli("127.0.0.1", "root", "", "perpustakaan");

$query = "SELECT buku.id, buku.judul, riwayat.tanggal_peminjaman, riwayat.tanggal_pengembalian 
        FROM riwayat 
        JOIN buku ON riwayat.buku_id = buku.id";


$result = $link->query($query);


echo "<table border='1'>";
echo "<tr><td>No</td><td>ID Buku</td><td>Judul Buku</td><td>Tanggal Peminjaman</td><td>Tanggal Pengembalian</td></tr>";
$i = 1;
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>$i</td><td>{$row['id']}</td><td>{$row['judul']}</td><td>{$row['tanggal_peminjaman']}</td><td>{$row['tanggal_pengembalian']}</td></tr>";
    $i++;
}
echo "</table> <br>";

echo "<a href='./index.php'>KEMBALI KE DASHBOARD</a>";
$result->free_result();
$link->close();
?>
