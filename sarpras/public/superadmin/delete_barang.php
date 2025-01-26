<?php
require '../../config/dbConn.php';

if ($conn === null) {
  die("Koneksi database gagal.");
}

// Pastikan ada parameter id di URL
if (isset($_GET['id'])) {
    $id_barang = $_GET['id'];

    // Query untuk menghapus barang berdasarkan ID
    $query = "DELETE FROM tb_barang WHERE id_barang = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_barang);
    
    if ($stmt->execute()) {
        // Jika berhasil, tampilkan SweetAlert sukses dan redirect kembali ke daftar barang
        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
                <script>
                  Swal.fire({
                    icon: 'success',
                    title: 'Barang Dihapus!',
                    text: 'Barang berhasil dihapus.',
                    confirmButtonText: 'OK'
                  }).then(function() {
                    window.location.href = 'databarang.php';  // Redirect ke halaman daftar barang
                  });
                </script>
              </body>
              </html>";
    } else {
        // Jika gagal, tampilkan SweetAlert dengan pesan error
        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              </head>
              <body>
                <script>
                  Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    text: 'Gagal menghapus barang.',
                    confirmButtonText: 'OK'
                  }).then(function() {
                    window.location.href = 'databarang.php';
                  });
                </script>
              </body>
              </html>";
    }

    $stmt->close();
} else {
    // Jika parameter id tidak ditemukan, redirect langsung ke daftar barang
    header("Location: databarang.php");
    exit;
}
?>
