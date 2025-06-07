<?php
require 'config.php';

if (isset($_POST["submit"])){
    if( tambah_akun($_POST) > 0 ) {
        echo "
            <script>
                alert('data berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('data gagal ditambahkan!');
                document.location.href = 'register.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .bg-primary-600 { background-color: #D97706;  }
        .hover\:bg-primary-700:hover { background-color: #B45309;  }
        .focus\:ring-primary-300:focus { --tw-ring-color: #FCD34D; }
        .dark\:bg-primary-600 { background-color: #D97706;  }
        .dark\:hover\:bg-primary-700:hover { background-color: #B45309;  }
        .dark\:focus\:ring-primary-800:focus { --tw-ring-color: #92400E;  }
        .text-primary-600 { color: #D97706; }
        .dark\:text-primary-500 { color: #F59E0B;}
        .focus\:ring-primary-600:focus { --tw-ring-color: #D97706; }
        .focus\:border-primary-600:focus { border-color: #D97706; }

    </style>
</head>
<body class="bg-gradient-to-br from-yellow-50 via-orange-100 to-amber-200 dark:from-gray-800 dark:via-gray-900 dark:to-black">
<section>
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-3xl font-semibold text-amber-700 dark:text-amber-400">
          <img class="w-10 h-10 mr-3" src="assets/img/A_small_cup_of_coffee.jpg" alt="logo"> CoffeeRight
      </a>
      <div class="w-full bg-white rounded-lg shadow-xl dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white text-center">
                  Registrasi Akun Anda
              </h1>

              <?php if (!empty($error)): ?>
                  <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400 border border-red-300 dark:border-red-600" role="alert">
                      <span class="font-medium">Oops!</span> <?php echo htmlspecialchars($error); ?>
                  </div>
              <?php endif; ?>

              <form class="space-y-4 md:space-y-6" action="" method="POST">
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                      <input type="text" name="nama_lengkap" id="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Masukkan Nama Lengkap" required="">
                  </div>
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username Anda</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Masukkan Username" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" required="">
                  </div>
                  <div class="flex items-center justify-between">
                  <button type="submit" name="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-bold rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition duration-150 ease-in-out">Register</button>
              </div>
              </form>
          </div>
      </div>
      <p class="mt-6 text-xs text-center text-gray-600 dark:text-gray-400">
          &copy; <?php echo date("Y"); ?> CoffeeRight. All rights reserved.
      </p>
  </div>
</section>
</body>
</html>
