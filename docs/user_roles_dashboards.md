# User Roles & Dashboard Strategy

Dokumen ini merinci pembagian peran user, hak akses, dan fitur spesifik pada masing-masing dashboard dalam sistem IASPIG. Seluruh antarmuka mengikuti prinsip desain **Premium, Modern, dan Geospatial-focused**.

---

## 1. Role: Guest (Public/Unauthenticated)
User yang belum login atau baru mengunjungi landing page.

- **Akses Halaman**:
  - Landing Page (Home).
  - Public Alumni Map (Versi terbatas: hanya menampilkan sebaran, tanpa detail nama/kontak).
  - Halaman Registrasi & Login.
- **Fitur Utama**:
  - Melihat statistik umum alumni (Total anggota, persebaran provinsi).
  - Membaca berita/pengumuman publik.
  - Melakukan registrasi dengan validasi data akademik (NIM/Angkatan).

---

## 2. Role: Alumni (Verified User)
User inti platform. Setelah registrasi, user akan masuk ke status *Pending* hingga diverifikasi admin.

- **Akses Dashboard**: Dashboard Alumni (Self-Service).
- **Fitur Utama**:
  - **Profile Management**: Update foto, data pekerjaan, dan bio profesional.
  - **Geospatial Pinning**: Menentukan koordinat lokasi domisili dan lokasi proyek (Portfolio).
  - **Expertise & Badges**: Klaim keahlian (GIS, Drone, Lidar) dan pengajuan badge verifikasi.
  - **Availability Toggle**: Mengatur status "Open for Collaboration" atau "Available for Freelance".
  - **Alumni Directory**: Mencari dan melihat profil alumni lain (jika diizinkan oleh pemilik profil).
  - **Digital CV Export**: Mengunduh rangkuman profil dalam format PDF desain premium.
  - **Social Feed**: Melihat update aktivitas atau lowongan dari alumni lain.

---

## 3. Role: Admin (The Brain/Moderator)
Pengurus organisasi IASPIG yang bertanggung jawab atas keberlangsungan data dan sistem.

- **Akses Dashboard**: Admin Control Center.
- **Fitur Utama**:
  - **User Verification Queue**: Meninjau dan menyetujui pendaftar baru berdasarkan validitas data alumni.
  - **Role & Permission Management**: Mengatur hak akses user (misal: menambah admin baru).
  - **Content Moderation**: Mengelola/menghapus konten postingan, profil perusahaan, atau komentar yang melanggar aturan.
  - **Advanced Analytics Dashboard**:
    - Grafik pertumbuhan anggota.
    - Peta panas (Heatmap) sebaran alumni global.
    - Statistik keahlian yang paling banyak dimiliki alumni.
  - **System Settings**: Mengubah konten landing page, link sosial media, dan konfigurasi API (Google Maps/Ina-Geoportal).
  - **Notification Center**: Mengirim broadcast pengumuman ke seluruh alumni.

---

## 4. Matriks Hak Akses (Privileges)

| Fitur | Guest | Alumni (Pending) | Alumni (Verified) | Admin |
| :--- | :---: | :---: | :---: | :---: |
| Lihat Landing Page | ✅ | ✅ | ✅ | ✅ |
| Update Profil Sendiri | ❌ | ✅ | ✅ | ✅ |
| Pin Lokasi di Peta | ❌ | ❌ | ✅ | ✅ |
| Lihat Detail Alumni Lain | ❌ | ❌ | ✅ | ✅ |
| Verifikasi User Baru | ❌ | ❌ | ❌ | ✅ |
| Kelola Pengaturan Sistem | ❌ | ❌ | ❌ | ✅ |

---

## 5. Prinsip Implementasi Dashboard
- **Consistent**: Menggunakan komponen Blade/Tailwind yang sama untuk semua dashboard (Orange-Coklat-Putih).
- **Modular**: Dashboard dibangun dengan widget-widget yang bisa ditambah/kurang tanpa merusak tata letak.
- **Responsive**: Sidebar navigasi otomatis berubah menjadi menu bawah (Bottom Nav) pada perangkat mobile.
- **Scalable**: Data dashboard ditarik melalui API internal untuk memastikan performa tetap stabil saat user bertambah.
