<?php
include 'db_connect.php';

$bookId = $_POST['bookId'];

if (empty($bookId)) {
    echo "Data tidak lengkap.";
    exit;
}

// Hapus data peminjaman
$sql = "DELETE FROM pinjam WHERE buku_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bookId);

if ($stmt->execute()) {
    // Update status buku menjadi 'Tersedia'
    $updateSql = "UPDATE buku SET status = 'Tersedia' WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $bookId);
    $updateStmt->execute();

    echo "Buku berhasil dikembalikan.";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
