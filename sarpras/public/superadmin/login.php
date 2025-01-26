<?php
session_start();
require '../../config/dbConn.php';  // Include the database connection

// Login process
if (isset($_POST['login'])) {
    $namaAdmin = mysqli_real_escape_string($conn, $_POST['namaAdmin']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);  // Encrypt password with md5

    // Query to check if user exists
    $query = "SELECT * FROM tb_admin WHERE namaAdmin = '$namaAdmin' AND email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Fetch user data
        $row = mysqli_fetch_assoc($result);

        // Successful login, store user data in session
        $_SESSION['loginadmin'] = true;
        $_SESSION['namaAdmin'] = $row['namaAdmin'];
        $_SESSION['email'] = $row['email'];

        // Redirect to admin dashboard
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
                    title: 'Berhasil Login',
                    text: 'Selamat datang Admin!',
                    confirmButtonText: 'OK'
                  }).then(function() {
                    window.location.href = 'admin_dashboard.php';  // Redirect ke halaman daftar barang
                  });
                </script>
              </body>
              </html>";
        exit(); 
    } else {
        // Failed login message
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
                    title: 'gagal login',
                    text: 'Username, Email atau Password salah',
                    confirmButtonText: 'OK'
                  }).then(function() {
                      // Redirect ke halaman daftar barang
        window.location.href = 'login.php'; 

                  });
                </script>
              </body>
              </html>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login Admin</title>
</head>

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-purple-600 to-blue-500">
    <div class="p-8 bg-white rounded-2xl shadow-2xl w-96 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-600 opacity-20"></div>
        <h2 class="mb-6 text-3xl font-extrabold text-center text-gray-800 relative z-10">Login Staff Admin</h2>

        <form action="" method="POST" class="relative z-10">
            <div class="mb-6">
                <label for="namaAdmin" class="block mb-2 text-lg font-semibold text-gray-700">Nama Pegawai</label>
                <input type="text" id="namaAdmin" name="namaAdmin" required
                    class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label for="email" class="block mb-2 text-lg font-semibold text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                    class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div class="mb-6">
                <label for="password" class="block mb-2 text-lg font-semibold text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button type="submit" name="login"
                class="w-full py-3 text-lg font-bold text-white bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-md hover:opacity-90 transition-all">Login</button>
        </form>

        <div class="mt-6 text-center relative z-10">
            <p class="text-gray-600">Belum punya akun?</p>
            <a href="register.php"
                class="text-blue-600 font-semibold hover:underline">Daftar</a>
        </div>

        <!-- Error Message -->
        <?php if (isset($error_message)) : ?>
            <p class="mt-4 text-center text-red-500 font-medium relative z-10">
                <?php echo $error_message; ?>
            </p>
        <?php endif; ?>
    </div>
</body>

</html>
