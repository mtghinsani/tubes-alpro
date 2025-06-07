<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        .team-card:hover {
            transform: scale(1.05);
            transition: all 0.3s ease;
        }
        .floating-animation {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        .fade-in {
            animation: fadeIn 1s ease-in;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <section class="py-20 bg-gradient-to-b from-[#667eea] to-[#764ba2] md:px-20 lg:px-20">
  <div class="floating-animation container mx-auto px-4">
    <div class="flex items-center justify-between">
        <a href="dashboard.php" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-6 py-3 rounded-lg font-semibold transition duration-300 flex items-center gap-2">
           <i class="bi bi-house-door"></i> Kembali ke Dashboard
        </a>
    </div>
    <div class="text-center fade-in mb-12">
      <h2 class="text-3xl font-bold text-white mb-4 section-title" data-aos="fade-down">
        Sosial Media Kami
      </h2>
      <p class="text-gray-300 max-w-2xl mx-auto" data-aos="fade-down">
        Sosial media kami sebagai sarana untuk berinteraksi dengan pelanggan, berbagi informasi terbaru, dan memberikan dukungan. Ikuti kami di Instagram dan YouTube untuk mendapatkan update terkini, tips, dan konten menarik lainnya.
      </p>
    </div>

    <div class="flex flex-col sm:flex-row justify-center items-center gap-6" data-aos="fade-up">
      <!-- IG Salsa -->
      <a
        href="https://www.instagram.com/salsaa_ln/"
        target="_blank"
        rel="noopener noreferrer"
        class="flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-8 rounded-full hover:from-pink-600 hover:to-purple-600 transition duration-900 ease-in-out shadow-lg hover:shadow-xl fade-in"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 11-10 10 10 10 0 0110-10zm0 14a4 4 0 100-8 4 4 0 000 8zm4-8a4 4 0 10-8 0 4 4 0 008 0z" />
        </svg>
        <span>Salsa Lian Nabila</span>
      </a>
      <!-- IG Payme -->
      <a
        href="https://www.instagram.com/paymerisky/"
        target="_blank"
        rel="noopener noreferrer"
        class="flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-8 rounded-full hover:from-pink-600 hover:to-purple-600 transition duration-900 ease-in-out shadow-lg hover:shadow-xl fade-in"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 11-10 10 10 10 0 0110-10zm0 14a4 4 0 100-8 4 4 0 000 8zm4-8a4 4 0 10-8 0 4 4 0 008 0z" />
        </svg>
        <span>Payme Riski Aulia Pulungan</span>
      </a>
            <!-- IG Insan -->
      <a
        href="https://www.instagram.com/mtghinsanii_/"
        target="_blank"
        rel="noopener noreferrer"
        class="flex items-center justify-center gap-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white py-3 px-8 rounded-full hover:from-pink-600 hover:to-purple-600 transition duration-900 ease-in-out shadow-lg hover:shadow-xl fade-in"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 11-10 10 10 10 0 0110-10zm0 14a4 4 0 100-8 4 4 0 000 8zm4-8a4 4 0 10-8 0 4 4 0 008 0z" />
        </svg>
        <span>Muhammad Teguh Insani</span>
      </a>
</section>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="floating-animation">
        <path fill="#764ba2" fill-opacity="1" d="M0,96L60,117.3C120,139,240,181,360,170.7C480,160,600,96,720,90.7C840,85,960,139,1080,138.7C1200,139,1320,85,1380,58.7L1440,32L1440,0L1380,0C1320,0,1200,0,1080,0C960,0,840,0,720,0C600,0,480,0,360,0C240,0,120,0,60,0L0,0Z">
        </path>
      </svg>

<!-- kontak -->
<div class="container my-12 mx-auto px-2 md:px-4">
    <section class="mb-32">
        <div class="flex justify-center">
            <div class="text-center md:max-w-xl lg:max-w-3xl fade-in">
                <h2 class="mb-12 px-6 text-3xl font-bold">
                    Kontak Kami
                </h2>
            </div>
        </div>
        <div class="flex flex-wrap">
            <form class="mb-12 w-full shrink-0 grow-0 basis-auto md:px-3 lg:mb-0 lg:w-5/12 lg:px-6 fade-in">
                <div class="mb-3 w-full">
                    <label class="block font-medium mb-[2px] text-violet-700" htmlFor="exampleInput90">
                            Nama Lengkap
                    </label>
                    <input type="text" class="px-2 py-2 border w-full outline-none rounded-md" id="exampleInput90" placeholder="Masukkan Nama Lengkap" />
                </div>
                <div class="mb-3 w-full">
                    <label class="block font-medium mb-[2px] text-violet-700" htmlFor="exampleInput90">
                            Alamat Email
                    </label>
                    <input type="email" class="px-2 py-2 border w-full outline-none rounded-md" id="exampleInput90"
                            placeholder="Masukkan Alamat Email" />
                </div>
                <div class="mb-3 w-full">
                    <label class="block font-medium mb-[2px] text-violet-700" htmlFor="exampleInput90">
                            Pesan
                    </label>
                    <textarea class="px-2 py-2 border rounded-[5px] w-full outline-none" name="" id=""></textarea>
                </div>
                <button type="button"
                        class="mb-6 inline-block w-full rounded bg-violet-400 px-6 py-2.5 font-medium uppercase leading-normal text-white hover:shadow-md hover:bg-violet-500">
                        Kirim Pesan
                </button>
            </form>
            <div class="w-full shrink-0 grow-0 basis-auto lg:w-7/12">
                <div class="flex flex-wrap fade-in">
                    <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:w-6/12 md:px-3 lg:px-6">
                        <div class="flex items-start">
                            <div class="shrink-0">
                                <div class="inline-block rounded-md bg-purple-400-100 p-4 text-purple-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6 grow">
                                <p class="mb-2 font-bold">
                                    Bantuan Teknis
                                </p>
                                <p class="text-neutral-500 ">
                                    coffeeright@mail.com
                                </p>
                                <p class="text-neutral-500 ">
                                    +62 8103062400099  
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:w-6/12 md:px-3 lg:px-6">
                        <div class="flex items-start">
                            <div class="shrink-0">
                                <div class="inline-block rounded-md bg-violet-400-100 p-4 text-violet-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6 grow">
                                <p class="mb-2 font-bold ">
                                    Pertanyaan Penjualan
                                </p>
                                <p class="text-neutral-500 ">
                                    coffeeright@mail.com
                                </p>
                                <p class="text-neutral-500 ">
                                    +62 8103062400099  
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:w-6/12 md:px-3 lg:px-6">
                        <div class="align-start flex">
                            <div class="shrink-0">
                                <div class="inline-block rounded-md bg-violet-400-100 p-4 text-violet-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6 grow">
                                <p class="mb-2 font-bold ">Dukungan Sponsor</p>
                                <p class="text-neutral-500 ">
                                    coffeeright@mail.com
                                </p>
                                <p class="text-neutral-500 ">
                                    +62 8103062400099  
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mb-12 w-full shrink-0 grow-0 basis-auto md:w-6/12 md:px-3 lg:px-6">
                        <div class="align-start flex">
                            <div class="shrink-0">
                                <div class="inline-block rounded-md bg-violet-400-100 p-4 text-violet-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 12.75c1.148 0 2.278.08 3.383.237 1.037.146 1.866.966 1.866 2.013 0 3.728-2.35 6.75-5.25 6.75S6.75 18.728 6.75 15c0-1.046.83-1.867 1.866-2.013A24.204 24.204 0 0112 12.75zm0 0c2.883 0 5.647.508 8.207 1.44a23.91 23.91 0 01-1.152 6.06M12 12.75c-2.883 0-5.647.508-8.208 1.44.125 2.104.52 4.136 1.153 6.06M12 12.75a2.25 2.25 0 002.248-2.354M12 12.75a2.25 2.25 0 01-2.248-2.354M12 8.25c.995 0 1.971-.08 2.922-.236.403-.066.74-.358.795-.762a3.778 3.778 0 00-.399-2.25M12 8.25c-.995 0-1.97-.08-2.922-.236-.402-.066-.74-.358-.795-.762a3.734 3.734 0 01.4-2.253M12 8.25a2.25 2.25 0 00-2.248 2.146M12 8.25a2.25 2.25 0 012.248 2.146M8.683 5a6.032 6.032 0 01-1.155-1.002c.07-.63.27-1.222.574-1.747m.581 2.749A3.75 3.75 0 0115.318 5m0 0c.427-.283.815-.62 1.155-.999a4.471 4.471 0 00-.575-1.752M4.921 6a24.048 24.048 0 00-.392 3.314c1.668.546 3.416.914 5.223 1.082M19.08 6c.205 1.08.337 2.187.392 3.314a23.882 23.882 0 01-5.223 1.082" />
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-6 grow">
                                <p class="mb-2 font-bold">
                                    Laporkan Bug
                                </p>
                                <p class="text-neutral-500 ">
                                    coffeeright@mail.com
                                </p>
                                <p class="text-neutral-500">
                                    +62 8103062400099  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'template/footer.php'; ?>
</body>
</html>