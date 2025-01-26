

<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Dashboard Peminjaman
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
        .sidebar {
            height: 100vh;
        }
  </style>
 </head>
 <body class="bg-gray-100">
  <div class="flex flex-col md:flex-row">
   <!-- Sidebar -->
   <aside class="sidebar w-full md:w-64 bg-white shadow-md">
    <div class="p-6">
     <div class="flex items-center">
      <img alt="Logo of the dashboard, a simple geometric shape" class="h-10 w-10" src="https://placehold.co/40x40"/>
      <span class="ml-3 text-xl font-semibold">
       Dashboard Superadmin
      </span>
     </div>
     <nav class="mt-6">
      <a class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded-md" href="#">
       <i class="fas fa-tachometer-alt">
       </i>
       <span class="ml-3">
        MENU
       </span>
      </a>
      <a class="flex items-center p-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-md" href="#">
       <i class="fas fa-users">
       </i>
       <span class="ml-3">
        DATA PEMINJAMAN
       </span>
      </a>
      <a class="flex items-center p-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-md" href="#">
       <i class="fas fa-cogs">
       </i>
       <span class="ml-3">
        STOK BARANG
       </span>
      </a>
      <a class="flex items-center p-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-md" href="#">
       <i class="fas fa-chart-line">
       </i>
       <span class="ml-3">
        RIWAYAT PEMINJAMAN
       </span>
      </a>
   
      <a class="flex items-center p-2 mt-2 text-gray-700 hover:bg-gray-200 rounded-md" href="#">
       <i class="fas fa-sign-out-alt">
       </i>
       <span class="ml-3">
        Logout
       </span>
      </a>
     </nav>
    </div>
   </aside>
   <!-- Main Content -->
   <div class="flex-1 p-6">

    <h1 class="text-2xl font-semibold text-gray-700">
     Welcome to the Dashboard
    </h1>
    <p class="mt-4 text-gray-600">
     Here you can manage your data and settings.
    </p>

    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
     <div class="bg-white shadow-md rounded-lg p-6">
      <div class="flex items-center">
       <div class="flex-shrink-0">
        <i class="fas fa-redo-alt text-blue-500 text-3xl">
        </i>
       </div>
       <div class="ml-4">
        <h2 class="text-xl font-semibold text-gray-700">
         Attempt Number
        </h2>
        <p class="mt-2 text-gray-600 text-3xl font-bold">
         5
        </p>
       </div>
      </div>
     </div>
     <div class="bg-white shadow-md rounded-lg p-6">
      <div class="flex items-center">
       <div class="flex-shrink-0">
        <i class="fas fa-user-check text-green-500 text-3xl">
        </i>
       </div>
       <div class="ml-4">
        <h2 class="text-xl font-semibold text-gray-700">
         Successful Attempts
        </h2>
        <p class="mt-2 text-gray-600 text-3xl font-bold">
         3
        </p>
       </div>
      </div>
     </div>
     <div class="bg-white shadow-md rounded-lg p-6">
      <div class="flex items-center">
       <div class="flex-shrink-0">
        <i class="fas fa-user-times text-red-500 text-3xl">
        </i>
       </div>
       <div class="ml-4">
        <h2 class="text-xl font-semibold text-gray-700">
         Failed Attempts
        </h2>
        <p class="mt-2 text-gray-600 text-3xl font-bold">
         2
        </p>
       </div>
      </div>
     </div>
     </div>
    </div>


   </div>
  </div>
 </body>
</html>
