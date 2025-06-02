<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CoffeRight</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    [x-cloak] { display: none; }
  </style>
</head>
<body class="bg-gray-100">

  <header class="w-full bg-gradient-to-r from-slate-900 to-slate-800 shadow-lg sticky top-0 z-50">
    <nav class="container mx-auto flex flex-wrap items-center justify-between py-4 px-4 md:px-6">
      <a href="/" class="flex items-center text-white text-2xl font-bold tracking-wide hover:text-yellow-400 transition duration-300">
        <span class="mr-1 text-3xl">☕</span> Coffe<span class="text-yellow-400 ml-1">Right</span>
      </a>
      <button id="nav-toggle" class="text-white lg:hidden focus:outline-none hover:text-yellow-400 transition duration-300">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
          <path d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>
      <div id="nav-menu" class="hidden lg:flex flex-col lg:flex-row items-center w-full lg:w-auto mt-4 lg:mt-0 space-y-4 lg:space-y-0 lg:space-x-8 transition-all duration-300">
        <div class="w-full max-w-md lg:mx-4 relative">
          <form action="dashboard.php" method="GET" class="relative">
            <input
              type="text"
              name="search"
              id="search-bar"
              placeholder="Cari menu favorit..."
              value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
              class="w-full px-4 py-2 pl-10 rounded-lg bg-slate-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 border border-slate-700 transition"
            />
            <button type="submit" class="absolute left-3 top-2.5 text-gray-400 hover:text-yellow-400 transition">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </form>
        </div>

        <ul class="flex flex-col lg:flex-row lg:items-center space-y-3 lg:space-y-0 lg:space-x-6 text-white font-medium w-full lg:w-auto">
          <li><a href="/tentang-kami-page" class="block py-2 px-3 lg:px-0 hover:text-yellow-400 transition hover:scale-105 transform">Tentang Kami</a></li>
          <li><a href="/menu" class="block py-2 px-3 lg:px-0 hover:text-yellow-400 transition hover:scale-105 transform">Menu</a></li>
          <li><a href="/kontak" class="block py-2 px-3 lg:px-0 hover:text-yellow-400 transition hover:scale-105 transform">Kontak</a></li>
        </ul>
        <a href="customer/cart.php" class="flex items-center space-x-2 bg-yellow-400 text-slate-900 px-4 py-2 rounded-lg font-medium hover:bg-yellow-300 transition transform hover:scale-105 w-full lg:w-auto justify-center">
          <i class="bi bi-cart-fill"></i>
          <span>Keranjang</span>
        </a>
        <div class="flex flex-col lg:flex-row items-center space-y-3 lg:space-y-0 lg:space-x-4 mt-4 lg:mt-0 w-full lg:w-auto">
          <span class="text-white bg-slate-800 px-4 py-2 rounded-lg w-full lg:w-auto text-center">Hai,<?= htmlspecialchars($nama_lengkap) ?></span>
          <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-red-600 transition w-full lg:w-auto text-center">Logout</a>
        </div>
      </div>
    </nav>
  </header>

  <script>
    const toggle = document.getElementById('nav-toggle');
    const menu = document.getElementById('nav-menu');

    toggle.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>

</body>
</html>
