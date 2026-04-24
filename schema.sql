-- Supabase SQL Script untuk Bakmie Paman
-- Jalankan di SQL Editor Supabase

-- Buat tabel menus
CREATE TABLE public.menus (
    id BIGSERIAL PRIMARY KEY,
    name TEXT NOT NULL,
    category TEXT NOT NULL CHECK (category IN ('Bakmie', 'Minuman', 'Cemilan')),
    price INTEGER NOT NULL,
    description TEXT DEFAULT '',
    image_url TEXT DEFAULT '',
    available BOOLEAN DEFAULT true,
    created_at TIMESTAMPTZ DEFAULT now()
);

-- Buat tabel reviews
CREATE TABLE public.reviews (
    id BIGSERIAL PRIMARY KEY,
    customer_name TEXT NOT NULL,
    rating INTEGER NOT NULL CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT NOT NULL,
    approved BOOLEAN DEFAULT false,
    created_at TIMESTAMPTZ DEFAULT now()
);

-- Aktifkan Row Level Security
ALTER TABLE public.menus ENABLE ROW LEVEL SECURITY;
ALTER TABLE public.reviews ENABLE ROW LEVEL SECURITY;

-- Policy: Publik hanya bisa membaca menu yang tersedia
CREATE POLICY "Public read available menus" ON public.menus
    FOR SELECT USING (available = true);

-- Policy: Admin (email tertentu) bisa full akses ke menus
CREATE POLICY "Admin full access menus" ON public.menus
    FOR ALL
    USING (auth.role() = 'authenticated' AND auth.email() = 'bakmiepaman@bakmiepaman.com')
    WITH CHECK (auth.role() = 'authenticated' AND auth.email() = 'bakmiepaman@bakmiepaman.com');

-- Policy: Publik bisa mengirim review
CREATE POLICY "Public insert reviews" ON public.reviews
    FOR INSERT WITH CHECK (true);

-- Policy: Publik hanya membaca review yang sudah disetujui
CREATE POLICY "Public read approved reviews" ON public.reviews
    FOR SELECT USING (approved = true);

-- Policy: Admin bisa mengelola semua review
CREATE POLICY "Admin manage reviews" ON public.reviews
    FOR ALL
    USING (auth.role() = 'authenticated' AND auth.email() = 'bakmiepaman@bakmiepaman.com')
    WITH CHECK (auth.role() = 'authenticated' AND auth.email() = 'bakmiepaman@bakmiepaman.com');

-- Buat storage bucket (jalankan melalui dashboard atau SQL)
-- INSERT INTO storage.buckets (id, name, public) VALUES ('menu-images', 'menu-images', true);

-- Untuk user admin, buat melalui dashboard Authentication > Users dengan email:
-- bakmiepaman@bakmiepaman.com
-- password: larismanis