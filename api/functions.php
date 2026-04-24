<?php
/**
 * Helper functions untuk autentikasi admin via Supabase
 * Digunakan di admin.php
 */

session_start();

/**
 * Mencoba login ke Supabase Auth menggunakan email dan password
 * Mengembalikan array token atau false jika gagal
 */
function supabase_login(string $email, string $password): array|false {
    $url = getenv('SUPABASE_URL') . '/auth/v1/token?grant_type=password';
    $payload = json_encode([
        'email'    => $email,
        'password' => $password,
    ]);

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $payload,
        CURLOPT_HTTPHEADER     => [
            'apikey: ' . getenv('SUPABASE_ANON_KEY'),
            'Content-Type: application/json',
        ],
    ]);

    $response  = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code === 200) {
        $data = json_decode($response, true);
        if (isset($data['access_token'])) {
            return [
                'access_token'  => $data['access_token'],
                'refresh_token' => $data['refresh_token'] ?? '',
            ];
        }
    }

    return false;
}

/**
 * Periksa apakah pengguna sudah login sebagai admin
 */
function is_admin_logged_in(): bool {
    return isset($_SESSION['admin_token']);
}

/**
 * Ambil token akses admin dari session
 */
function get_admin_token(): ?string {
    return $_SESSION['admin_token'] ?? null;
}
