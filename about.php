<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - CoffeeRight</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
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
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="gradient-bg text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center fade-in">
                <div class="floating-animation inline-block mb-6">
                    <i class="bi bi-people-fill text-6xl text-white opacity-90"></i>
                </div>
                <h1 class="text-5xl font-bold mb-4">Tentang Kami</h1>
                <p class="text-xl text-purple-100 max-w-2xl mx-auto">
                    Mengenal lebih dekat tim di balik CoffeeRight dan visi kami dalam menghadirkan solusi digital terbaik
                </p>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-16">
        <!-- Project Overview -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-16 card-hover fade-in">
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-purple-500 to-purple-600 rounded-full mb-4">
                    <i class="bi bi-cup-hot text-2xl text-white"></i>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">CoffeeRight</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-purple-600 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                <div>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        <strong>Coffee Right</strong> adalah aplikasi web e-commerce yang dirancang khusus untuk memudahkan proses jual beli produk kopi secara daring. Melalui sistem ini, pelanggan dapat dengan mudah menelusuri katalog produk, melakukan pemesanan, serta memantau status pesanan secara real-time.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Aplikasi ini juga menyediakan dashboard admin yang memungkinkan pengelolaan produk, stok, transaksi, dan pesanan secara efisien. Kami berharap aplikasi ini dapat menjadi contoh nyata pemanfaatan teknologi dalam meningkatkan efisiensi bisnis dan kenyamanan pelanggan dalam berbelanja.
                    </p>
                </div>
                <div class="text-center">
                    <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-8 shadow-lg">
                        <div class="relative mb-6">
                            <img src="uploads/coffee-latte-art.jpg"
                                 alt="Beautiful Coffee Latte Art"
                                 class="w-full h-64 object-cover rounded-xl shadow-lg"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <div class="w-full h-64 bg-gradient-to-br from-amber-100 to-orange-100 rounded-xl flex items-center justify-center" style="display:none;">
                                <div class="text-center">
                                    <i class="bi bi-cup-hot text-6xl text-amber-600 mb-4"></i>
                                    <p class="text-amber-700 font-semibold">Beautiful Coffee Art</p>
                                </div>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tugas Akhir</h3>
                        <p class="text-gray-600">Algoritma dan Pemrograman</p>
                        <p class="text-purple-600 font-semibold">Telkom University Jakarta</p>
                        <div class="mt-4 text-sm text-amber-700 italic">
                            "Menghadirkan pengalaman kopi terbaik melalui teknologi"
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="text-center mb-12 fade-in">
            <h2 class="text-4xl font-bold text-gray-800 mb-4">Tim Pengembang</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Kami adalah tim mahasiswa yang bersemangat menghadirkan solusi digital yang fungsional dan aplikatif di dunia nyata
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-purple-600 mx-auto rounded-full mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden team-card fade-in">
                <div class="gradient-bg h-32 relative">
                    <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <i class="bi bi-person-fill text-3xl text-purple-600"></i>
                        </div>
                    </div>
                </div>
                <div class="pt-12 pb-8 px-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Salsa Lian Nabila</h3>
                    <p class="text-purple-600 font-semibold mb-4">Frontend Developer</p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Bertanggung jawab dalam pengembangan antarmuka pengguna yang menarik dan responsif, memastikan pengalaman pengguna yang optimal.
                    </p>
                    <div class="flex justify-center space-x-3 mt-6">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-code-slash text-purple-600"></i>
                        </div>
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-palette text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 2 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden team-card fade-in">
                <div class="gradient-bg h-32 relative">
                    <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <i class="bi bi-person-fill text-3xl text-purple-600"></i>
                        </div>
                    </div>
                </div>
                <div class="pt-12 pb-8 px-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Payme Risky Aulia</h3>
                    <p class="text-purple-600 font-semibold mb-4">Backend Developer</p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Mengembangkan logika bisnis dan sistem database, memastikan keamanan dan performa aplikasi yang optimal.
                    </p>
                    <div class="flex justify-center space-x-3 mt-6">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-server text-purple-600"></i>
                        </div>
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-database text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Member 3 -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden team-card fade-in">
                <div class="gradient-bg h-32 relative">
                    <div class="absolute -bottom-8 left-1/2 transform -translate-x-1/2">
                        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-lg">
                            <i class="bi bi-person-fill text-3xl text-purple-600"></i>
                        </div>
                    </div>
                </div>
                <div class="pt-12 pb-8 px-6 text-center">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Muhammad Teguh Insani</h3>
                    <p class="text-purple-600 font-semibold mb-4">Full Stack Developer</p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Mengoordinasikan pengembangan keseluruhan sistem dan memastikan integrasi yang sempurna antara frontend dan backend.
                    </p>
                    <div class="flex justify-center space-x-3 mt-6">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-gear text-purple-600"></i>
                        </div>
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="bi bi-lightning text-purple-600"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-8 mb-16 fade-in">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Fitur Unggulan</h2>
                <p class="text-gray-600">Teknologi dan fitur yang kami hadirkan dalam CoffeeRight</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-xl p-6 text-center card-hover">
                    <i class="bi bi-cart-check text-3xl text-purple-600 mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">E-Commerce</h3>
                    <p class="text-sm text-gray-600">Sistem jual beli online yang lengkap</p>
                </div>
                <div class="bg-white rounded-xl p-6 text-center card-hover">
                    <i class="bi bi-speedometer2 text-3xl text-purple-600 mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">Real-time</h3>
                    <p class="text-sm text-gray-600">Pemantauan status pesanan secara langsung</p>
                </div>
                <div class="bg-white rounded-xl p-6 text-center card-hover">
                    <i class="bi bi-shield-check text-3xl text-purple-600 mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">Keamanan</h3>
                    <p class="text-sm text-gray-600">Sistem keamanan data yang terjamin</p>
                </div>
                <div class="bg-white rounded-xl p-6 text-center card-hover">
                    <i class="bi bi-phone text-3xl text-purple-600 mb-3"></i>
                    <h3 class="font-bold text-gray-800 mb-2">Responsive</h3>
                    <p class="text-sm text-gray-600">Dapat diakses di berbagai perangkat</p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="text-center fade-in">
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <i class="bi bi-heart-fill text-4xl text-red-500 mb-4"></i>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Terima Kasih!</h2>
                <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                    Kami berharap CoffeeRight dapat memberikan manfaat dan menjadi inspirasi dalam pengembangan aplikasi web yang lebih baik di masa depan.
                </p>
                <a href="dashboard.php" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-300 inline-flex items-center gap-2">
                    <i class="bi bi-house-door"></i> Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
<?php include 'template/footer.php'; ?>


    <script>
        // Add scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all fade-in elements
        document.querySelectorAll('.fade-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });
    </script>
</body>
</html>
