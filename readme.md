Penjelasan & Panduan Deployment

1. Supabase:
   · Buat project, dapatkan SUPABASE_URL dan SUPABASE_ANON_KEY.
   · Jalankan schema.sql di SQL Editor.
   · Buat user admin dengan email bakmiepaman@bakmiepaman.com dan password larismanis melalui Authentication > Users.
   · Buat bucket menu-images di Storage, atur menjadi public (atau sesuaikan policy).
2. Vercel:
   · Pasang environment variables: SUPABASE_URL, SUPABASE_ANON_KEY.
   · Deploy dari repository yang berisi semua file di atas.
   · Root direktori adalah / (tanpa subfolder).
3. Custom Domain: Dapat ditautkan melalui Vercel Domains.

Semua kode siap pakai, tanpa dummy data – menu dan review akan langsung terhubung ke Supabase Anda. Dashboard admin lengkap untuk mengelola menu, gambar, dan moderasi review