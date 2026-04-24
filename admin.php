<?php
/**
 * Admin Dashboard - Bakmie Paman
 * Hanya bisa diakses oleh pemilik.
 */
session_start();
require_once 'functions.php';

// Konfigurasi admin email (hardcode)
$admin_email = 'bakmiepaman@bakmiepaman.com';

// Proses logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $token_data = supabase_login($email, $password);
    if ($token_data && $email === $admin_email) {
        $_SESSION['admin_token'] = $token_data['access_token'];
        $_SESSION['admin_refresh'] = $token_data['refresh_token'] ?? '';
        header('Location: admin.php');
        exit;
    } else {
        $login_error = 'Email atau password salah, atau bukan admin.';
    }
}

// Cek status login
$is_logged_in = is_admin_logged_in();
$admin_token = get_admin_token();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Bakmie Paman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'hijau-botol': '#1B3C35',
                        'krem': '#F5F5DC',
                        'merah-aksen': '#E53E3E',
                    }
                }
            }
        }
    </script>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
</head>
<body class="bg-gray-100 font-sans">

<?php if (!$is_logged_in): ?>
    <!-- ============ HALAMAN LOGIN ============ -->
    <div class="min-h-screen flex items-center justify-center bg-hijau-botol/90">
        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-md w-full" data-aos="zoom-in">
            <div class="text-center mb-6">
                <span class="text-5xl">🍜</span>
                <h1 class="text-2xl font-serif font-bold text-hijau-botol mt-2">Admin Bakmie Paman</h1>
            </div>
            <?php if (isset($login_error)): ?>
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-4 text-sm"><?= htmlspecialchars($login_error) ?></div>
            <?php endif; ?>
            <form method="POST">
                <input type="hidden" name="action" value="login">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Email</label>
                    <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-hijau-botol outline-none" placeholder="admin@email.com">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-1">Password</label>
                    <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-hijau-botol outline-none" placeholder="••••••••">
                </div>
                <button type="submit" class="w-full bg-hijau-botol hover:bg-green-900 text-white font-bold py-3 rounded-full transition">Masuk Dashboard</button>
                <p class="text-xs text-gray-400 mt-4 text-center">Kredensial hanya untuk pemilik Bakmie Paman.</p>
            </form>
        </div>
    </div>
<?php else: ?>
    <!-- ============ DASHBOARD ADMIN ============ -->
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-hijau-botol text-white shadow-lg sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center">
                <span class="text-xl font-bold">🍜 Admin Panel</span>
                <div class="flex space-x-4 items-center">
                    <span class="text-sm bg-white/20 px-3 py-1 rounded-full"><?= $admin_email ?></span>
                    <a href="?logout" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition">Logout</a>
                </div>
            </div>
        </nav>

        <div class="flex-1 max-w-7xl mx-auto w-full px-4 py-8">
            <!-- Statistik Singkat -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8" id="stats-container">
                <div class="bg-white p-5 rounded-xl shadow"><h3 class="text-sm text-gray-500">Total Menu</h3><p class="text-3xl font-bold text-hijau-botol" id="total-menu">0</p></div>
                <div class="bg-white p-5 rounded-xl shadow"><h3 class="text-sm text-gray-500">Review Pending</h3><p class="text-3xl font-bold text-yellow-600" id="pending-review">0</p></div>
                <div class="bg-white p-5 rounded-xl shadow"><h3 class="text-sm text-gray-500">Menu Aktif</h3><p class="text-3xl font-bold text-green-600" id="active-menu">0</p></div>
            </div>

            <!-- Tabs: Menu & Review -->
            <div class="flex space-x-2 mb-6">
                <button onclick="switchTab('menu')" id="tab-menu-btn" class="px-6 py-2 rounded-full bg-hijau-botol text-white font-semibold">Manajemen Menu</button>
                <button onclick="switchTab('review')" id="tab-review-btn" class="px-6 py-2 rounded-full bg-gray-200 text-gray-700 font-semibold">Moderasi Review</button>
            </div>

            <!-- Tab Menu Management -->
            <div id="tab-menu" class="bg-white rounded-2xl shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-serif font-bold text-hijau-botol">Daftar Menu</h2>
                    <button onclick="openAddModal()" class="bg-merah-aksen hover:bg-red-700 text-white px-5 py-2 rounded-full font-semibold transition">+ Tambah Menu</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-hijau-botol/10 text-hijau-botol">
                            <tr><th class="p-3">Gambar</th><th class="p-3">Nama</th><th class="p-3">Kategori</th><th class="p-3">Harga</th><th class="p-3">Tersedia</th><th class="p-3">Aksi</th></tr>
                        </thead>
                        <tbody id="menu-table-body"></tbody>
                    </table>
                </div>
            </div>

            <!-- Tab Review Moderation -->
            <div id="tab-review" class="bg-white rounded-2xl shadow p-6 hidden">
                <h2 class="text-2xl font-serif font-bold text-hijau-botol mb-6">Review Pelanggan</h2>
                <div id="review-table-body" class="space-y-4"></div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah/Edit Menu -->
    <div id="menu-modal" class="fixed inset-0 bg-black/70 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-6 w-full max-w-lg shadow-2xl">
            <h3 class="text-xl font-bold mb-4" id="modal-title">Tambah Menu</h3>
            <form id="menu-form" onsubmit="saveMenu(event)">
                <input type="hidden" id="edit-id">
                <div class="mb-3">
                    <label class="block text-sm font-medium">Nama</label>
                    <input type="text" id="menu-name" required class="w-full border px-3 py-2 rounded-lg">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Kategori</label>
                    <select id="menu-category" class="w-full border px-3 py-2 rounded-lg">
                        <option value="Bakmie">Bakmie</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Cemilan">Cemilan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Harga (Rp)</label>
                    <input type="number" id="menu-price" required class="w-full border px-3 py-2 rounded-lg">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Deskripsi</label>
                    <textarea id="menu-desc" class="w-full border px-3 py-2 rounded-lg"></textarea>
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium">Gambar</label>
                    <input type="file" id="menu-image" accept="image/*" class="w-full text-sm">
                    <img id="preview-image" class="mt-2 h-32 object-cover rounded hidden">
                </div>
                <div class="mb-3 flex items-center">
                    <input type="checkbox" id="menu-available" class="mr-2" checked> <label class="text-sm">Tersedia</label>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 border rounded-full">Batal</button>
                    <button type="submit" class="px-6 py-2 bg-hijau-botol text-white rounded-full font-semibold">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Konfigurasi Supabase dari Environment
        const SUPABASE_URL = "<?php echo getenv('SUPABASE_URL'); ?>";
        const SUPABASE_ANON_KEY = "<?php echo getenv('SUPABASE_ANON_KEY'); ?>";
        const supabaseClient = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

        // Set session token admin agar RLS bekerja
        const accessToken = "<?php echo addslashes($admin_token); ?>";
        supabaseClient.auth.setSession({ access_token: accessToken, refresh_token: "<?php echo addslashes($_SESSION['admin_refresh'] ?? ''); ?>" }).then(({error}) => {
            if (error) console.error("Gagal set session:", error);
        });

        let allMenusData = [];
        let allReviewsData = [];

        // ========== FETCH DATA ==========
        async function loadStats() {
            const { data: menus } = await supabaseClient.from('menus').select('*');
            const { data: reviews } = await supabaseClient.from('reviews').select('*');
            allMenusData = menus || [];
            allReviewsData = reviews || [];
            document.getElementById('total-menu').textContent = allMenusData.length;
            document.getElementById('active-menu').textContent = allMenusData.filter(m => m.available).length;
            document.getElementById('pending-review').textContent = allReviewsData.filter(r => !r.approved).length;
            renderMenuTable(allMenusData);
            renderReviewTable(allReviewsData);
        }

        function renderMenuTable(menus) {
            const tbody = document.getElementById('menu-table-body');
            if (menus.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="p-4 text-center text-gray-500">Belum ada menu.</td></tr>';
                return;
            }
            tbody.innerHTML = menus.map(m => `
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><img src="${m.image_url || 'https://via.placeholder.com/80'}" class="w-16 h-16 object-cover rounded"></td>
                    <td class="p-3 font-medium">${m.name}</td>
                    <td class="p-3 text-sm">${m.category}</td>
                    <td class="p-3">Rp${m.price.toLocaleString()}</td>
                    <td class="p-3"><span class="${m.available ? 'text-green-600' : 'text-red-500'}">${m.available ? '✔ Tersedia' : '✖ Habis'}</span></td>
                    <td class="p-3 space-x-2">
                        <button onclick="editMenu(${m.id})" class="text-blue-600 hover:underline text-sm">✏️ Edit</button>
                        <button onclick="deleteMenu(${m.id})" class="text-red-500 hover:underline text-sm">🗑 Hapus</button>
                    </td>
                </tr>
            `).join('');
        }

        function renderReviewTable(reviews) {
            const container = document.getElementById('review-table-body');
            if (reviews.length === 0) {
                container.innerHTML = '<p class="text-gray-500">Belum ada review.</p>';
                return;
            }
            container.innerHTML = reviews.map(r => `
                <div class="border rounded-lg p-4 flex justify-between items-start bg-gray-50">
                    <div>
                        <div class="font-semibold">${r.customer_name} (${'⭐'.repeat(r.rating)})</div>
                        <p class="text-sm text-gray-700 mt-1">${r.review_text}</p>
                        <span class="text-xs text-gray-400">${new Date(r.created_at).toLocaleDateString('id-ID')}</span>
                    </div>
                    <div class="flex space-x-2">
                        ${!r.approved ? `<button onclick="approveReview(${r.id})" class="bg-green-500 text-white px-3 py-1 rounded text-sm">Approve</button>` : `<span class="text-green-600 text-sm font-bold">✓ Disetujui</span>`}
                        <button onclick="deleteReview(${r.id})" class="bg-red-500 text-white px-3 py-1 rounded text-sm">Hapus</button>
                    </div>
                </div>
            `).join('');
        }

        // ========== CRUD MENU ==========
        let editingId = null;
        function openAddModal() {
            editingId = null;
            document.getElementById('modal-title').textContent = 'Tambah Menu';
            document.getElementById('menu-form').reset();
            document.getElementById('edit-id').value = '';
            document.getElementById('preview-image').classList.add('hidden');
            document.getElementById('menu-modal').classList.remove('hidden');
        }
        async function editMenu(id) {
            const menu = allMenusData.find(m => m.id === id);
            if (!menu) return;
            editingId = id;
            document.getElementById('modal-title').textContent = 'Edit Menu';
            document.getElementById('edit-id').value = id;
            document.getElementById('menu-name').value = menu.name;
            document.getElementById('menu-category').value = menu.category;
            document.getElementById('menu-price').value = menu.price;
            document.getElementById('menu-desc').value = menu.description || '';
            document.getElementById('menu-available').checked = menu.available;
            if (menu.image_url) {
                document.getElementById('preview-image').src = menu.image_url;
                document.getElementById('preview-image').classList.remove('hidden');
            } else {
                document.getElementById('preview-image').classList.add('hidden');
            }
            document.getElementById('menu-modal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('menu-modal').classList.add('hidden');
        }
        async function saveMenu(e) {
            e.preventDefault();
            const fileInput = document.getElementById('menu-image');
            let imageUrl = '';
            if (fileInput.files.length > 0) {
                const file = fileInput.files[0];
                const fileName = `menu-${Date.now()}-${file.name}`;
                const { data: uploadData, error: uploadError } = await supabaseClient.storage
                    .from('menu-images')
                    .upload(fileName, file);
                if (uploadError) {
                    alert('Gagal upload gambar: ' + uploadError.message);
                    return;
                }
                const { data: { publicUrl } } = supabaseClient.storage.from('menu-images').getPublicUrl(fileName);
                imageUrl = publicUrl;
            }

            const menuData = {
                name: document.getElementById('menu-name').value,
                category: document.getElementById('menu-category').value,
                price: parseInt(document.getElementById('menu-price').value),
                description: document.getElementById('menu-desc').value,
                available: document.getElementById('menu-available').checked,
            };
            if (imageUrl) menuData.image_url = imageUrl;

            let result;
            if (editingId) {
                result = await supabaseClient.from('menus').update(menuData).eq('id', editingId);
            } else {
                result = await supabaseClient.from('menus').insert([menuData]);
            }
            if (result.error) {
                alert('Gagal menyimpan: ' + result.error.message);
            } else {
                closeModal();
                loadStats();
            }
        }
        async function deleteMenu(id) {
            if (!confirm('Yakin hapus menu ini?')) return;
            const { error } = await supabaseClient.from('menus').delete().eq('id', id);
            if (error) alert(error.message);
            else loadStats();
        }

        // ========== REVIEW MODERATION ==========
        async function approveReview(id) {
            const { error } = await supabaseClient.from('reviews').update({ approved: true }).eq('id', id);
            if (error) alert(error.message);
            else loadStats();
        }
        async function deleteReview(id) {
            if (!confirm('Hapus review ini?')) return;
            const { error } = await supabaseClient.from('reviews').delete().eq('id', id);
            if (error) alert(error.message);
            else loadStats();
        }

        // ========== TAB SWITCH ==========
        function switchTab(tab) {
            document.getElementById('tab-menu').classList.toggle('hidden', tab !== 'menu');
            document.getElementById('tab-review').classList.toggle('hidden', tab !== 'review');
            document.getElementById('tab-menu-btn').classList.toggle('bg-hijau-botol', tab === 'menu');
            document.getElementById('tab-menu-btn').classList.toggle('text-white', tab === 'menu');
            document.getElementById('tab-menu-btn').classList.toggle('bg-gray-200', tab !== 'menu');
            document.getElementById('tab-review-btn').classList.toggle('bg-hijau-botol', tab === 'review');
            document.getElementById('tab-review-btn').classList.toggle('text-white', tab === 'review');
            document.getElementById('tab-review-btn').classList.toggle('bg-gray-200', tab !== 'review');
        }

        // ========== INIT ==========
        window.addEventListener('load', () => {
            AOS.init({ duration: 600, once: true });
            loadStats();
        });
    </script>
<?php endif; ?>
</body>
</html>