<?php
include 'db_connect.php';

$bookId = $_POST['bookId'];
$name = $_POST['name'];

if (empty($bookId) || empty($name)) {
    echo "Data tidak lengkap.";
    exit;
}

$sql = "INSERT INTO pinjam (buku_id, nama_peminjam) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $bookId, $name);

if ($stmt->execute()) {
    // Update status buku menjadi 'Dipinjam'
    $updateSql = "UPDATE buku SET status = 'Dipinjam' WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("i", $bookId);
    $updateStmt->execute();

    echo "Buku berhasil dipinjam.";
} else {
    echo "Terjadi kesalahan: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
