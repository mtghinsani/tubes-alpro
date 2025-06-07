<?php
session_start();
require 'config.php';

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = "Username dan password tidak boleh kosong!";
    } else {
        $stmt = mysqli_prepare($db, "SELECT * FROM user WHERE username = ?");
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if ($password === $user['password']) {
                // Set session
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];

                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
        mysqli_stmt_close($stmt);
    }
}
mysqli_close($db); // Tutup koneksi setelah selesai
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - CoffeeRight</title>
    <link rel="icon" href="assets/icon/favicon.ico" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
                  Login ke Akun Anda
              </h1>

              <?php if (!empty($error)): ?>
                  <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-gray-800 dark:text-red-400 border border-red-300 dark:border-red-600" role="alert">
                      <span class="font-medium">Oops!</span> <?php echo htmlspecialchars($error); ?>
                  </div>
              <?php endif; ?>

              <form class="space-y-4 md:space-y-6" action="" method="POST">
                  <div>
                      <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username Anda</label>
                      <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" placeholder="Masukkan Username" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-amber-500 dark:focus:border-amber-500" required="">
                  </div>
                  <div class="flex items-center justify-between">
                      <div class="flex items-start">
                          <div class="flex items-center h-5">
                            <input id="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-amber-600 dark:ring-offset-gray-800">
                          </div>
                          <div class="ml-3 text-sm">
                            <label for="remember" class="text-gray-500 dark:text-gray-300">Ingat saya</label>
                          </div>
                      </div>
                      <a href="#" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Lupa password?</a>
                  </div>
                  <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 transition duration-150 ease-in-out">Login</button>
                  <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                      Belum punya akun? <a href="register.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Daftar di sini</a>
                  </p>
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
