<?php
include 'db_connect.php'; // Menyertakan file untuk koneksi database

// Cek apakah data POST ada
if (isset($_POST['bookId']) && isset($_POST['name'])) {
    $bookId = $_POST['bookId']; // ID Buku yang dipinjam
    $borrowerName = $_POST['name']; // Nama peminjam

    // Query untuk memeriksa apakah buku yang dimaksud tersedia
    $sql = "SELECT * FROM buku WHERE id = $bookId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
        
        // Cek apakah status buku adalah 'Tersedia'
        if ($book['status'] === 'Tersedia') {
            // Update status buku menjadi 'Dipinjam'
            $updateSql = "UPDATE buku SET status = 'Dipinjam' WHERE id = $bookId";
            if ($conn->query($updateSql) === TRUE) {
                // Menyimpan peminjaman (opsional)
                $borrowSql = "INSERT INTO peminjaman (book_id, borrower_name) VALUES ($bookId, '$borrowerName')";
                $conn->query($borrowSql);
                
                echo "Buku '" . $book['judul'] . "' berhasil dipinjam oleh " . $borrowerName . ".";
            } else {
                echo "Terjadi kesalahan saat memperbarui status buku.";
            }
        } else {
            echo "Buku tidak tersedia untuk dipinjam.";
        }
    } else {
        echo "Buku tidak ditemukan.";
    }
} else {
    echo "Data tidak lengkap.";
}

$conn->close();
?>
