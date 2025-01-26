<?php
require '../../config/dbConn.php';  // Memanggil koneksi database

// Proses penyimpanan data jika form di-submit
if (isset($_POST['daftar-btn'])) {
    $namaAdmin = $_POST['namaAdmin'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);  // Enkripsi password dengan md5

    // Query untuk menyimpan data ke database
    $query = "INSERT INTO tb_admin (namaAdmin, email, password) VALUES ('$namaAdmin', '$email', '$password')";
    if (mysqli_query($conn, $query)) {
        $success_message = "Pendaftaran berhasil!";
    } else {
        $error_message = "Pendaftaran gagal: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Daftar Pegawai</title>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-purple-500 to-blue-500">
    <div class="p-8 rounded-2xl shadow-2xl bg-white w-96">
        <h2 class="text-violet-900 text-3xl font-bold mb-6 text-center">Daftar Staff Admin</h2>
        <hr class="border-violet-900 mb-6">
        
        <!-- Form Pendaftaran -->
        <form action="" method="POST">
            <div class="mb-4">
                <label class="block text-violet-900 font-semibold mb-2" for="namaPegawai">Nama Admin</label>
                <input class="w-full p-3 rounded-lg bg-sky-100 focus:ring-2 focus:ring-violet-700" type="text" id="namaPegawai" name="namaAdmin" required>
            </div>
            <div class="mb-4">
                <label class="block text-violet-900 font-semibold mb-2" for="noPegawai">Email</label>
                <input class="w-full p-3 rounded-lg bg-sky-100 focus:ring-2 focus:ring-violet-700" type="text" id="noPegawai" name="email" required>
            </div>
            <div class="mb-4">
                <label class="block text-violet-900 font-semibold mb-2" for="password">Password</label>
                <input class="w-full p-3 rounded-lg bg-sky-100 focus:ring-2 focus:ring-violet-700" type="password" id="password" name="password" required>
            </div>
            <div class="flex flex-col space-y-3">
                <button class="w-full bg-violet-900 text-white p-3 rounded-lg text-lg font-semibold hover:bg-violet-700 transition-all duration-300" type="submit" name="daftar-btn" onclick="daftarConfirm()">Daftar</button>
                <a href="login.php" class="w-full">
                    <button class="w-full bg-yellow-300 text-black p-3 rounded-lg text-lg font-semibold hover:bg-yellow-400 transition-all duration-300" type="button">Kembali</button>
                </a>
            </div>
        </form>
        
        <!-- Menampilkan Pesan -->
        <?php if (isset($success_message)) : ?>
            <p class="text-green-600 font-semibold mt-4 text-center"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)) : ?>
            <p class="text-red-600 font-semibold mt-4 text-center"><?php echo $error_message; ?></p>
        <?php endif; ?>
    </div>

    <script>
        function daftarConfirm() {
            Swal.fire({
                title: 'Apakah Anda Yakin ingin mendaftar?',
                text: 'Anda akan mendaftar sebagai Admin',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Saya Yakin!',
                cancelButtonText: 'Tidak, Batalkan'
                }).then((result) => {
                    if (result.value) {
                        document.getElementById('form-daftar').submit();
                        }
                        })
                        }
    </script>
</body>
</html>