<?php
/**
 * Bakmie Paman - Halaman Utama
 * Pelopor Bakmie Ayam Charsiu & Bakmie Sapi di Gandrungmangu
 */

// Mulai session jika diperlukan untuk pesan singkat
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <!-- Meta Dasar -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakmie Paman | Pelopor Bakmie Ayam Charsiu & Bakmie Sapi di Gandrungmangu</title>
    <meta name="description" content="Bakmie Paman, pelopor Bakmie Ayam Charsiu dan Bakmie Sapi di Gandrungmangu, Cilacap. Nikmati bakmie premium dengan cita rasa khas, harga terjangkau. Pesan via WhatsApp atau GoFood!">
    <meta name="keywords" content="bakmie paman, bakmie ayam charsiu, bakmie sapi, gandrungmangu, cilacap, bakmie enak, kuliner cilacap">
    <meta name="author" content="Bakmie Paman">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="Bakmie Paman | Pelopor Bakmie Ayam Charsiu & Bakmie Sapi">
    <meta property="og:description" content="Kuliner bakmie legendaris di Gandrungmangu. Ayam Charsiu & Sapi, rasa juara!">
    <meta property="og:type" content="restaurant">
    <meta property="og:url" content="https://bakmiepaman.vercel.app/">
    <meta property="og:image" content="https://bakmiepaman.vercel.app/og-image.jpg">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Bakmie Paman | Pelopor Bakmie Ayam Charsiu & Bakmie Sapi">
    <meta name="twitter:description" content="Bakmie premium khas Gandrungmangu. Pesan sekarang!">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🍜</text></svg>">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hijau-botol': '#1B3C35',
                        'krem': '#F5F5DC',
                        'merah-aksen': '#E53E3E',
                    },
                    fontFamily: {
                        'serif': ['Merriweather', 'Georgia', 'serif'],
                        'sans': ['Open Sans', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@700;900&family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Supabase JS SDK -->
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

    <!-- Structured Data JSON-LD for Local Business -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Restaurant",
            "name": "Bakmie Paman",
            "description": "Pelopor Bakmie Ayam Charsiu & Bakmie Sapi di Gandrungmangu, Cilacap.",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "RT.01/RW.04, Gandrungmanis Lor, Gandrungmanis",
                "addressLocality": "Gandrungmangu",
                "addressRegion": "Jawa Tengah",
                "postalCode": "53254",
                "addressCountry": "ID"
            },
            "telephone": "+6281290145963",
            "servesCuisine": "Bakmie, Indonesian",
            "priceRange": "Rp15.000 - Rp25.000",
            "url": "https://bakmiepaman.vercel.app",
            "sameAs": [
                "https://instagram.com/bakmiepaman"
            ]
        }
    </script>
</head>
<body class="bg-krem font-sans text-gray-800">

<!-- ============ NAVBAR ============ -->
<nav class="bg-hijau-botol text-white shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <span class="text-3xl">🍜</span>
            <h1 class="text-2xl font-serif font-bold tracking-tight">Bakmie Paman</h1>
        </div>
        <div class="hidden md:flex space-x-8">
            <a href="#menu" class="hover:text-yellow-300 transition">Menu</a>
            <a href="#review" class="hover:text-yellow-300 transition">Review</a>
            <a href="#kontak" class="hover:text-yellow-300 transition">Kontak</a>
        </div>
        <a href="#wa-order" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-full text-sm font-semibold transition flex items-center space-x-1">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 2.214.606 4.286 1.656 6.067L0 24l6.333-1.656A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22.5c-2.071 0-3.992-.543-5.654-1.484l-.387-.231-3.943 1.025 1.043-3.829-.255-.41A9.97 9.97 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10.5-10 10.5z"/></svg>
            <span>WhatsApp</span>
        </a>
    </div>
</nav>

<!-- ============ HERO SECTION ============ -->
<header class="relative bg-hijau-botol text-white overflow-hidden min-h-[500px] flex items-center">
    <!-- Pola latar opsional -->
    <div class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_bottom_right,_#fff_0%,_transparent_60%)]"></div>
    <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 grid md:grid-cols-2 gap-8 items-center relative z-10">
        <div data-aos="fade-right" class="space-y-6">
            <h2 class="text-4xl md:text-6xl font-serif font-black leading-tight">
                Pelopor<br><span class="text-yellow-300">Bakmie Ayam Charsiu</span> & <span class="text-yellow-300">Bakmie Sapi</span>
            </h2>
            <p class="text-lg md:text-xl font-light opacity-90">Pertama di Gandrungmangu dengan resep turun-temurun, disajikan dengan bahan segar pilihan.</p>
            <div class="flex flex-wrap gap-4">
                <a href="#menu" class="bg-merah-aksen hover:bg-red-700 text-white px-8 py-3 rounded-full font-bold text-lg transition transform hover:scale-105 shadow-lg">Lihat Menu</a>
                <a href="https://wa.me/6281290145963?text=Halo%20Bakmie%20Paman%2C%20saya%20mau%20pesan%20nih!" target="_blank" class="bg-green-500 hover:bg-green-600 text-white px-8 py-3 rounded-full font-bold text-lg transition flex items-center space-x-2 shadow-lg">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 2.214.606 4.286 1.656 6.067L0 24l6.333-1.656A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22.5c-2.071 0-3.992-.543-5.654-1.484l-.387-.231-3.943 1.025 1.043-3.829-.255-.41A9.97 9.97 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10.5-10 10.5z"/></svg>
                    <span>Pesan Sekarang</span>
                </a>
            </div>
            <div class="flex items-center space-x-2 text-sm opacity-80">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Gandrungmanis, Gandrungmangu, Cilacap</span>
            </div>
        </div>
        <div data-aos="zoom-in" class="flex justify-center">
            <div class="w-72 h-72 md:w-96 md:h-96 bg-yellow-100 rounded-full border-4 border-yellow-300 shadow-2xl flex items-center justify-center overflow-hidden">
                <!-- Placeholder gambar mangkuk bakmie, nanti bisa diganti upload via admin -->
                <img src="https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=400" alt="Bakmie Paman" class="object-cover w-full h-full rounded-full">
            </div>
        </div>
    </div>
</header>

<!-- ============ MENU SECTION ============ -->
<section id="menu" class="max-w-7xl mx-auto px-4 py-20">
    <h2 class="text-4xl font-serif font-bold text-center text-hijau-botol mb-4" data-aos="fade-up">Menu Kami</h2>
    <p class="text-center text-gray-600 mb-10 max-w-xl mx-auto" data-aos="fade-up" data-aos-delay="100">Pilih dari berbagai varian bakmie, minuman segar, hingga cemilan lezat.</p>

    <!-- Filter Kategori -->
    <div id="filter-buttons" class="flex justify-center gap-3 mb-12 flex-wrap" data-aos="fade-up">
        <button onclick="filterMenu('All')" class="category-btn px-6 py-2 rounded-full border-2 border-hijau-botol bg-hijau-botol text-white font-semibold transition duration-300 hover:bg-opacity-90">Semua</button>
        <button onclick="filterMenu('Bakmie')" class="category-btn px-6 py-2 rounded-full border-2 border-hijau-botol text-hijau-botol font-semibold transition duration-300 hover:bg-hijau-botol hover:text-white">Bakmie</button>
        <button onclick="filterMenu('Minuman')" class="category-btn px-6 py-2 rounded-full border-2 border-hijau-botol text-hijau-botol font-semibold transition duration-300 hover:bg-hijau-botol hover:text-white">Minuman</button>
        <button onclick="filterMenu('Cemilan')" class="category-btn px-6 py-2 rounded-full border-2 border-hijau-botol text-hijau-botol font-semibold transition duration-300 hover:bg-hijau-botol hover:text-white">Cemilan</button>
    </div>

    <!-- Grid Menu -->
    <div id="menu-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 min-h-[300px]">
        <!-- Loading state -->
        <div class="col-span-full flex justify-center items-center py-20" id="menu-loading">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-hijau-botol"></div>
        </div>
    </div>
</section>

<!-- ============ REVIEW SECTION ============ -->
<section id="review" class="bg-hijau-botol/5 py-20">
    <div class="max-w-4xl mx-auto px-4">
        <h2 class="text-4xl font-serif font-bold text-center text-hijau-botol mb-4" data-aos="fade-up">Apa Kata Mereka?</h2>
        <p class="text-center text-gray-600 mb-10" data-aos="fade-up">Pengalaman pelanggan setia Bakmie Paman.</p>

        <!-- Review Cards -->
        <div id="review-list" class="space-y-6 mb-16" data-aos="fade-up">
            <!-- Diisi oleh JavaScript -->
        </div>

        <!-- Form Kirim Review -->
        <div class="bg-white rounded-2xl shadow-xl p-8 max-w-lg mx-auto" data-aos="zoom-in" data-aos-delay="200">
            <h3 class="text-2xl font-serif font-bold text-hijau-botol mb-2">Beri Review</h3>
            <p class="text-sm text-gray-500 mb-4">Bagikan pengalaman Anda, ya!</p>
            <form id="review-form" onsubmit="submitReview(event)">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Nama</label>
                    <input type="text" id="customer_name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-botol focus:border-transparent outline-none" placeholder="Nama Anda">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Rating</label>
                    <div class="flex space-x-1 text-3xl" id="star-rating">
                        <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="1">★</span>
                        <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="2">★</span>
                        <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="3">★</span>
                        <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="4">★</span>
                        <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="5">★</span>
                    </div>
                    <input type="hidden" name="rating" id="rating-value" value="0">
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Pesan</label>
                    <textarea id="review_text" rows="3" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-hijau-botol focus:border-transparent outline-none" placeholder="Ceritakan pengalaman Anda..."></textarea>
                </div>
                <button type="submit" class="w-full bg-hijau-botol hover:bg-green-900 text-white font-bold py-3 rounded-full transition duration-300 transform hover:scale-[1.02]">Kirim Review</button>
                <p id="review-feedback" class="mt-2 text-sm text-center hidden"></p>
            </form>
        </div>
    </div>
</section>

<!-- ============ FOOTER ============ -->
<footer id="kontak" class="bg-hijau-botol text-white py-12">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-3 gap-8">
        <div>
            <h4 class="text-xl font-serif font-bold mb-3">Bakmie Paman</h4>
            <p class="text-sm opacity-80">Pelopor Bakmie Ayam Charsiu & Bakmie Sapi pertama di Gandrungmangu. Resep autentik, rasa istimewa!</p>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-3">Alamat</h4>
            <p class="text-sm opacity-80">RT.01/RW.04, Gandrungmanis Lor,<br>Gandrungmanis, Gandrungmangu,<br>Cilacap, Jawa Tengah 53254</p>
            <a href="https://goo.gl/maps/..." target="_blank" class="text-yellow-300 text-sm hover:underline mt-2 inline-block">📍 Lihat di Google Maps</a>
        </div>
        <div>
            <h4 class="text-lg font-semibold mb-3">Kontak & Pesan</h4>
            <p class="text-sm opacity-80 mb-2">☎️ <a href="tel:+6281290145963" class="hover:text-yellow-300">0812-9014-5963</a></p>
            <p class="text-sm opacity-80 mb-4">📧 bakmiepaman@gmail.com</p>
            <a href="https://wa.me/6281290145963?text=Halo%20Bakmie%20Paman%2C%20saya%20mau%20pesan!" target="_blank" class="inline-flex items-center space-x-2 bg-green-500 hover:bg-green-600 text-white px-5 py-2 rounded-full text-sm font-semibold transition">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 2.214.606 4.286 1.656 6.067L0 24l6.333-1.656A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22.5c-2.071 0-3.992-.543-5.654-1.484l-.387-.231-3.943 1.025 1.043-3.829-.255-.41A9.97 9.97 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10.5-10 10.5z"/></svg>
                <span>Chat WhatsApp</span>
            </a>
        </div>
    </div>
    <div class="border-t border-white/20 mt-8 pt-6 text-center text-sm opacity-70 max-w-7xl mx-auto px-4">
        © 2026 Bakmie Paman. All rights reserved. | Dibuat dengan ❤️ di Gandrungmangu.
    </div>
</footer>

<!-- Floating WhatsApp Button -->
<div id="wa-order" class="fixed bottom-6 right-6 z-50 flex flex-col items-end space-y-3">
    <div id="wa-bubble" class="bg-white text-gray-800 p-3 rounded-xl shadow-lg text-sm max-w-[200px] hidden transition-opacity duration-300">
        Pesan sekarang, kami siap antar! 🛵
    </div>
    <a href="https://wa.me/6281290145963?text=Halo%20Bakmie%20Paman%2C%20saya%20mau%20pesan!" target="_blank" class="bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-2xl transition transform hover:scale-110">
        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 2.214.606 4.286 1.656 6.067L0 24l6.333-1.656A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22.5c-2.071 0-3.992-.543-5.654-1.484l-.387-.231-3.943 1.025 1.043-3.829-.255-.41A9.97 9.97 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10.5-10 10.5z"/></svg>
    </a>
</div>

<script>
    // ==================== CONFIGURASI SUPABASE ====================
    const SUPABASE_URL = "<?php echo getenv('SUPABASE_URL'); ?>";
    const SUPABASE_ANON_KEY = "<?php echo getenv('SUPABASE_ANON_KEY'); ?>";
    const supabase = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

    // ==================== DATA MENU ====================
    let allMenus = [];

    async function fetchMenus() {
        const { data, error } = await supabase
            .from('menus')
            .select('*')
            .eq('available', true)
            .order('category')
            .order('price');
        if (error) {
            console.error('Gagal mengambil menu:', error);
            document.getElementById('menu-loading').innerHTML = '<p class="text-red-500">Gagal memuat menu.</p>';
            return;
        }
        allMenus = data || [];
        renderMenuGrid(allMenus);
    }

    function renderMenuGrid(menus) {
        const grid = document.getElementById('menu-grid');
        document.getElementById('menu-loading')?.classList.add('hidden');
        if (menus.length === 0) {
            grid.innerHTML = '<p class="col-span-full text-center text-gray-500">Belum ada menu tersedia.</p>';
            return;
        }
        grid.innerHTML = menus.map(menu => {
            const imageUrl = menu.image_url || 'https://via.placeholder.com/400x300/F5F5DC/1B3C35?text=🍜';
            return `
            <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-category="${menu.category}">
                <div class="h-48 bg-cover bg-center" style="background-image:url('${imageUrl}')"></div>
                <div class="p-5">
                    <span class="text-xs font-bold text-merah-aksen bg-red-100 px-2 py-1 rounded-full">${menu.category}</span>
                    <h3 class="text-xl font-serif font-bold mt-2 text-hijau-botol">${menu.name}</h3>
                    <p class="text-gray-600 text-sm mt-1">${menu.description || ''}</p>
                    <div class="flex justify-between items-center mt-4">
                        <span class="text-lg font-extrabold text-hijau-botol">Rp${menu.price.toLocaleString('id-ID')}</span>
                        <a href="https://wa.me/6281290145963?text=Halo%20Bakmie%20Paman%2C%20saya%20mau%20pesan%20${encodeURIComponent(menu.name)}%20seharga%20Rp${menu.price.toLocaleString('id-ID')}%20ya!" target="_blank" class="bg-green-500 hover:bg-green-600 text-white text-sm px-3 py-1.5 rounded-full flex items-center space-x-1 transition">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.373 0 12c0 2.214.606 4.286 1.656 6.067L0 24l6.333-1.656A11.94 11.94 0 0012 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 22.5c-2.071 0-3.992-.543-5.654-1.484l-.387-.231-3.943 1.025 1.043-3.829-.255-.41A9.97 9.97 0 012 12C2 6.486 6.486 2 12 2s10 4.486 10 10-4.486 10.5-10 10.5z"/></svg>
                            <span>Pesan</span>
                        </a>
                    </div>
                </div>
            </div>`;
        }).join('');
    }

    function filterMenu(category) {
        // Update active button style
        document.querySelectorAll('.category-btn').forEach(btn => {
            if (btn.textContent.trim() === category || (category === 'All' && btn.textContent.trim() === 'Semua')) {
                btn.classList.add('bg-hijau-botol', 'text-white');
                btn.classList.remove('text-hijau-botol');
            } else {
                btn.classList.remove('bg-hijau-botol', 'text-white');
                btn.classList.add('text-hijau-botol');
            }
        });
        const filtered = category === 'All' ? allMenus : allMenus.filter(m => m.category === category);
        renderMenuGrid(filtered);
        // Re-init AOS untuk item baru
        AOS.refresh();
    }

    // ==================== REVIEW SYSTEM ====================
    async function fetchReviews() {
        const { data, error } = await supabase
            .from('reviews')
            .select('*')
            .eq('approved', true)
            .order('created_at', { ascending: false });
        if (error) {
            console.error(error);
            return;
        }
        const container = document.getElementById('review-list');
        if (!data || data.length === 0) {
            container.innerHTML = '<p class="text-center text-gray-500">Belum ada review. Jadilah yang pertama!</p>';
            return;
        }
        container.innerHTML = data.map(r => `
        <div class="bg-white p-6 rounded-xl shadow-md flex space-x-4" data-aos="fade-up">
            <div class="flex-shrink-0 w-12 h-12 bg-hijau-botol rounded-full flex items-center justify-center text-white font-bold text-lg">${r.customer_name.charAt(0).toUpperCase()}</div>
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h4 class="font-bold text-lg">${r.customer_name}</h4>
                        <div class="text-yellow-500">${'★'.repeat(r.rating)}${'☆'.repeat(5-r.rating)}</div>
                    </div>
                    <span class="text-xs text-gray-400">${new Date(r.created_at).toLocaleDateString('id-ID')}</span>
                </div>
                <p class="mt-2 text-gray-700">${r.review_text}</p>
            </div>
        </div>`).join('');
    }

    let selectedRating = 0;
    document.querySelectorAll('#star-rating .star').forEach(star => {
        star.addEventListener('click', function() {
            selectedRating = parseInt(this.dataset.value);
            document.getElementById('rating-value').value = selectedRating;
            document.querySelectorAll('#star-rating .star').forEach((s, idx) => {
                s.classList.toggle('text-yellow-400', idx < selectedRating);
                s.classList.toggle('text-gray-300', idx >= selectedRating);
            });
        });
        star.addEventListener('mouseenter', function() {
            const val = parseInt(this.dataset.value);
            document.querySelectorAll('#star-rating .star').forEach((s, idx) => {
                s.classList.toggle('text-yellow-300', idx < val);
                s.classList.toggle('text-gray-300', idx >= val);
            });
        });
        star.addEventListener('mouseleave', () => {
            document.querySelectorAll('#star-rating .star').forEach((s, idx) => {
                s.classList.toggle('text-yellow-400', idx < selectedRating);
                s.classList.toggle('text-gray-300', idx >= selectedRating);
            });
        });
    });

    async function submitReview(e) {
        e.preventDefault();
        const name = document.getElementById('customer_name').value.trim();
        const rating = parseInt(document.getElementById('rating-value').value);
        const text = document.getElementById('review_text').value.trim();
        const feedback = document.getElementById('review-feedback');

        if (!name || !rating || !text) {
            feedback.textContent = 'Mohon isi semua field.';
            feedback.classList.remove('hidden', 'text-green-600');
            feedback.classList.add('text-red-500');
            return;
        }
        if (rating === 0) {
            feedback.textContent = 'Pilih rating bintang.';
            feedback.classList.remove('hidden', 'text-green-600');
            feedback.classList.add('text-red-500');
            return;
        }

        const { error } = await supabase
            .from('reviews')
            .insert([{ customer_name: name, rating, review_text: text }]);

        if (error) {
            feedback.textContent = 'Gagal mengirim review.';
            feedback.classList.remove('hidden', 'text-green-600');
            feedback.classList.add('text-red-500');
        } else {
            feedback.textContent = 'Review terkirim! Menunggu moderasi.';
            feedback.classList.remove('hidden', 'text-red-500');
            feedback.classList.add('text-green-600');
            document.getElementById('review-form').reset();
            selectedRating = 0;
            document.getElementById('rating-value').value = 0;
            document.querySelectorAll('#star-rating .star').forEach(s => {
                s.classList.remove('text-yellow-400');
                s.classList.add('text-gray-300');
            });
        }
    }

    // ==================== FLOATING WHATSAPP BUBBLE ====================
    setTimeout(() => {
        const bubble = document.getElementById('wa-bubble');
        bubble.classList.remove('hidden');
        setTimeout(() => bubble.classList.add('hidden'), 8000);
    }, 3000);

    // ==================== INIT ====================
    window.addEventListener('DOMContentLoaded', () => {
        AOS.init({ duration: 800, once: true });
        fetchMenus();
        fetchReviews();
    });
</script>
</body>
</html>
