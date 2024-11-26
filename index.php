<!DOCTYPE html>
<html>
<head>
    <title>Perpustakaan - Pinjam Buku</title>
</head>
<body>
    <h1>Form Peminjaman Buku</h1>
    <form method="POST" action="koneksi.php">
        <label for="id_buku">ID Buku:</label><br>
        <input type="number" id="id_buku" name="id_buku" required><br><br>

        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Pinjam Buku</button>
    </form>
</body>
</html>
