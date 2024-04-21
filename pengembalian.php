<?php
$link = new mysqli("127.0.0.1", "root", "", "perpustakaan");


if(isset($_GET['id'])) {
    $id_buku = $_GET['id'];

    $query_select_tanggal = "SELECT tanggal_peminjaman FROM dipinjam WHERE buku_id = ?";
    $stmt_tanggal = $link->prepare($query_select_tanggal);
    $stmt_tanggal->bind_param('i', $id_buku);
    $stmt_tanggal->execute();
    $result = $stmt_tanggal->get_result();
    $row_tanggal = $result->fetch_assoc();
    $tanggal_peminjaman = $row_tanggal['tanggal_peminjaman'];

    $query_delete = "DELETE FROM dipinjam WHERE buku_id = ?";
    $stmt_delete = $link->prepare($query_delete);
    $stmt_delete->bind_param("i", $id_buku);
    $stmt_delete->execute();

    $query_insert = "INSERT INTO pengembalian (buku_id, tanggal_pengembalian) SELECT id, NOW() FROM buku WHERE id = ?";
    $stmt_insert = $link->prepare($query_insert);
    $stmt_insert->bind_param("i", $id_buku);
    $stmt_insert->execute();

    $query_riwayat = "INSERT INTO riwayat (buku_id, tanggal_peminjaman, tanggal_pengembalian) VALUES (?, ?, NOW())";
    $stmt_riwayat = $link->prepare($query_riwayat);
    $stmt_riwayat->bind_param("is", $id_buku, $tanggal_peminjaman);
    $stmt_riwayat->execute();

    echo "Buku telah berhasil dikembalikan.<br><br>";

    echo "<a href='./history.php'>LIHAT HISTORY</a><br>";
    echo "<a href='pinjam/pinjam.php?fitur=display'>KEMBALI</a><br>";
    echo "<a href='./index.php'>KEMBALI KE DASHBOARD</a>";
} else {
    echo "ID buku tidak valid.";
}

$link->close();
?>
