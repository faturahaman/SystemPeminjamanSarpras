<?php
require '../config/dbConn.php';

if (isset($_POST['btn-pinjam'])) {
    $namaPeminjaman = mysqli_real_escape_string($conn, $_POST['namaPeminjam']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);
    $barang = mysqli_real_escape_string($conn, $_POST['namaBarang']);

    // Ambil stok barang yang dipilih
    $queryStok = "SELECT stokBarang, namaBarang FROM tb_barang WHERE namaBarang = '$barang'";
    $resultStok = mysqli_query($conn, $queryStok);
    $rowStok = mysqli_fetch_assoc($resultStok);

    if ($rowStok) {
        $stokBarang = $rowStok['stokBarang'];
        $namaBarang = $rowStok['namaBarang'];

        // Pastikan stok lebih dari 0
        if ($stokBarang > 0) {
            $stokBarangUpdate = $stokBarang - 1;
            $updateStokQuery = "UPDATE tb_barang SET stokBarang = $stokBarangUpdate WHERE namaBarang = '$namaBarang'";
            $updateStokResult = mysqli_query($conn, $updateStokQuery);

            if ($updateStokResult) {
                $queryPinjam = "INSERT INTO tb_peminjaman (namaPeminjam, kelas, namaBarang) 
                                VALUES ('$namaPeminjaman', '$kelas', '$barang')";
                if (mysqli_query($conn, $queryPinjam)) {
                    $message = "Peminjaman berhasil! Stok barang berhasil dikurangi.";
                    $status = "success";
                } else {
                    $message = "Terjadi kesalahan saat menyimpan data peminjaman.";
                    $status = "error";
                }
            } else {
                $message = "Gagal memperbarui stok barang.";
                $status = "error";
            }
        } else {
            $message = "Stok barang tidak mencukupi untuk peminjaman.";
            $status = "warning";
        }
    } else {
        $message = "Barang tidak ditemukan.";
        $status = "error";
    }

    mysqli_close($conn);
    echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Informasi',
                    text: '$message',
                    icon: '$status',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = window.location.href;
                    }
                });
            };
          </script>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Dashboard Peminjaman Sarpras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .sidebar {
            height: 100vh;
        }
    </style>
</head>

<body>
<div class="flex flex-col md:flex-row min-h-screen bg-gradient-to-r from-purple-400">
    <?php include '../asset/sidebar.php'; ?>

    <div class="flex-1 p-8">
        <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-xl p-10 border border-gray-200">
            <h2 class="text-4xl font-extrabold text-center text-[#2E285B] mb-8">Form Peminjaman Barang</h2>

            <form action="" method="POST" class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label for="nama_siswa" class="block text-xl font-semibold text-gray-700">Nama Siswa</label>
                        <div class="relative mt-2">
                            <input type="text" name="namaPeminjam" id="nama_siswa" required
                                class="block w-full rounded-lg bg-gray-50 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 shadow-md p-4 pl-12 transition-all duration-300 hover:border-indigo-400" placeholder="Masukkan nama siswa">
                            <i class="fas fa-user absolute left-4 top-4 text-gray-400"></i>
                        </div>
                    </div>

                    <div>
                        <label for="kelas" class="block text-xl font-semibold text-gray-700">Kelas</label>
                        <div class="relative mt-2">
                            <input type="text" name="kelas" id="kelas" required
                                class="block w-full rounded-lg bg-gray-50 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 shadow-md p-4 pl-12 transition-all duration-300 hover:border-indigo-400" placeholder="Masukkan kelas">
                            <i class="fas fa-school absolute left-4 top-4 text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="barang" class="block text-xl font-semibold text-gray-700">Nama Barang</label>
                    <div class="relative mt-2">
                        <select id="barang" name="namaBarang" required
                            class="block w-full rounded-lg bg-gray-50 border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 shadow-md p-4 pl-12 transition-all duration-300 hover:border-indigo-400">
                            <?php
                            $query = "SELECT * FROM tb_barang";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) :
                            ?>
                                <option value="<?= htmlspecialchars($row['namaBarang']); ?>">
                                    <?= htmlspecialchars($row['namaBarang']); ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                        <i class="fas fa-box absolute left-4 top-4 text-gray-400"></i>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" name="btn-pinjam"
                        class="bg-[#2E285B] hover:bg-[#1F1A3E] text-white font-bold py-3 px-8 rounded-lg shadow-xl transition-transform transform hover:scale-105">
                        <i class="fas fa-paper-plane mr-2"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
