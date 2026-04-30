# Fase 1: Fondasi, Branding & Landing Page

Fase ini bertujuan membangun "akar" dari sistem IASPIG, memastikan arsitektur yang kuat untuk pengembangan jangka panjang.

## 1. Arsitektur & Teknologi (Scalable & Modular)
- **Framework**: Laravel 11 (Latest).
- **Frontend Architecture**: Blade Components + Tailwind CSS (Modular UI).
- **CSS Design System**:
  - `primary`: `#E67E22` (Orange)
  - `secondary`: `#5D4037` (Coklat)
  - `background`: `#FFFFFF` (Putih) / `#F9F9F9` (Light Grey)
  - `accent`: `#FFB347` (Soft Orange)
- **Pattern**: Penggunaan Service Pattern di Laravel untuk memisahkan logika bisnis dari Controller agar mudah di-maintenance.

## 2. Komponen Landing Page (Premium Design)
Landing page akan dibangun dengan struktur modular:
- **Navigation Bar**: Glassmorphism effect, sticky, dengan logo IASPIG.
- **Hero Section**:
  - Background: Animasi garis kontur topografi yang berdenyut halus.
  - Headline: "Koneksi Tanpa Batas, Kolaborasi Tanpa Jarak."
  - CTA: Tombol "Gabung IASPIG" (Orange).
- **Stats Section**: Grid 3 kolom (Total Alumni, Angkatan, Perusahaan).
- **Mission Section**: Penjelasan singkat visi IASPIG dengan ikon bertema geospasial.
- **Partner & Collaboration**: Section khusus untuk perusahaan luar yang ingin bekerja sama atau mencari talenta alumni.
- **Footer**: Warna coklat tua dengan link sosial media dan info kontak.

## 3. SEO & Global Assets
- **Metadata**: Optimasi OpenGraph dan SEO tags untuk visibilitas di Google & Social Media.
- **UI Kit**: Pembuatan reusable components (Buttons, Inputs, Alerts) dengan palet Orange/Coklat.
- **Typography**: Penggunaan font modern (Inter/Outfit) dan library ikon (Remix Icon).

## 3. Sistem Autentikasi & Level User
- **Multi-Auth**: Menggunakan Laravel Breeze atau Fortify sebagai basis.
- **Role Management**:
  - Middleware khusus untuk membatasi akses antar Role (Admin vs Alumni).
  - Sistem verifikasi status alumni (Draft -> Pending -> Verified).
- **Form Registrasi**:
  - Input data dasar (Nama, Email, Password).
  - Input data akademik (Angkatan, NIM).

## 4. Database Setup (Initial)
- Migrasi tabel `users`, `roles`, `permissions`.
- Seeder untuk User Admin pertama.

---
## Checklist Maintenance
- [ ] Dokumentasi kode menggunakan PHPDoc.
- [ ] Penggunaan Git untuk version control.
- [ ] Konfigurasi environment (.env) yang aman.
