<?php 
require '../config/dbConn.php';

if (isset($_POST['kembalikan'])) {
    $id = $_POST['id'];
    $queryUpdate = "UPDATE tb_peminjaman SET status='Telah dikembalikan' WHERE id=$id";
    
    mysqli_query($conn, $queryUpdate);
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
          icon: 'succes',
          title: 'barang dikembalikan',
          text: 'berhasil mengembalikan barang',
          confirmButtonText: 'Ok'
        }).then(function() {
            // Redirect ke halaman daftar barang
window.location.href = 'datapinjam.php'; 

        });
      </script>
    </body>
    </html>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard Peminjaman Sarpras</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
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

    <!-- main content -->
    <div class="container p-6">
        <h1 class="text-3xl font-semibold mb-6">Data Peminjaman Sarpras</h1>

        <table class="min-w-full table-auto bg-white shadow-lg rounded-lg">
            <thead class="bg-[#2E285B] text-white">
                <tr>
                    <th class="py-3 px-4 text-left">No</th>
                    <th class="py-3 px-4 text-left">Nama Peminjam</th>
                    <th class="py-3 px-4 text-left">Kelas</th>
                    <th class="py-3 px-4 text-left">Nama Barang</th>
                    <th class="py-3 px-4 text-left">Waktu Peminjaman</th>
                    <th class="py-3 px-4 text-left">Status</th>
                    <th class="py-3 px-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tb_peminjaman";
                $result = mysqli_query($conn, $query);
                
                if ($result && mysqli_num_rows($result) > 0) {
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='py-2 px-4'>" . $no++ . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($row['namaPeminjam']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($row['kelas']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($row['namaBarang']) . "</td>";
                        echo "<td class='py-2 px-4'>" . htmlspecialchars($row['WaktuPeminjaman']) . "</td>";
                        echo "<td class='py-2 px-4'>" . ($row['status'] == 'Telah dikembalikan' ? '<span class=\"text-green-600\">Telah dikembalikan</span>' : 'Dipinjam') . "</td>";
                        echo "<td class='py-2 px-4'>";
                        if ($row['status'] != 'Telah dikembalikan') {
                            echo "<button class='bg-red-500 text-white px-4 py-2 rounded-lg' onclick='openModal(" . $row['id'] . ")'>Kembalikan</button>";
                        } else {
                            echo "<button class='bg-blue-500 text-white px-4 py-2 rounded-lg ' onclick='openDetail'>Detail</button>";
                        }
                        echo "</td>";
                        echo "</tr>";   
                    }
                } else {
                    echo "<tr><td colspan='7' class='py-2 px-4 text-center'>Data tidak ditemukan</td></tr>";
                };
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Konfirmasi -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
            <h2 class="text-xl font-semibold mb-4">Konfirmasi Pengembalian</h2>
            <p>Apakah Anda yakin ingin mengembalikan barang ini?</p>
            <form action="" method="POST">
                <input type="hidden" id="itemId" name="id">
                <div class="mt-4 flex justify-end gap-4">
                    <button type="button" class="bg-gray-400 px-4 py-2 rounded-lg" onclick="closeModal()">Batal</button>
                    <button type="submit" name="kembalikan" class="bg-green-500 text-white px-4 py-2 rounded-lg">Kembalikan</button>
                </div>
            </form>
        </div>
    </div>
 

    <script>
        function openModal(id) {
            document.getElementById('itemId').value = id;
            document.getElementById('modal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>
</html>
