# Fase 2: Core Alumni & Geospatial Mapping

Fase ini adalah inti dari database alumni, mengubah data pasif menjadi visualisasi spasial yang informatif dan fungsional.

## 1. Manajemen Profil Alumni (Self-Service)
- **Profile Dashboard**: UI bersih untuk mengisi data detail.
- **Field Data**:
  - Foto Profil.
  - Pekerjaan Saat Ini & Instansi.
  - Alamat Domisili (dengan integrasi Google Maps/OpenStreetMap API untuk pick koordinat).
  - Bio & Keahlian Khusus (Lidar, Drone, GIS Analyst, dll).
- **Expertise Badges**: Sistem lencana verifikasi untuk keahlian tertentu (contoh: Licensed Surveyor, Remote Sensing Expert).
- **Availability Status**: Toggle status "Open for Collaboration" atau "Available for Freelance" untuk memudahkan networking bisnis.
- **Privacy Setting**: Pilihan untuk menyembunyikan detail kontak dari publik.

## 2. Direktori Alumni (Searchable Database)
- **Advanced Filter**: Cari berdasarkan Angkatan, Nama, Instansi, atau Keahlian (Expertise).
- **Modular Card Design**: Menampilkan kartu alumni dengan palet warna orange-putih yang elegan.
- **Availability Indicator**: Label visual pada kartu alumni yang sedang mencari kolaborasi.
- **Pagination**: Menangani ribuan data alumni agar loading tetap cepat.

## 3. Fitur Peta Sebaran (The Star Feature)
- **Leaflet.js Integration**: Peta interaktif yang ringan.
- **Multi-Layer Support**:
  - **Alumni Layer**: Lokasi domisili alumni.
  - **Project Layer**: Lokasi proyek-proyek yang pernah dikerjakan alumni (Portfolio Mapping).
- **Advanced Basemaps**: Pilihan peta dasar dari OSM, Google Maps, atau **Ina-Geoportal (WMS/WMTS)**.
- **Clustering**: Mengelompokkan titik alumni jika terlalu banyak dalam satu wilayah.
- **Interactive Popup**: Klik titik di peta untuk melihat profil singkat alumni (Foto, Nama, Angkatan).

## 4. Alumni Analytics Dashboard (New)
- **Real-time Stats**: Grafik distribusi alumni berdasarkan:
  - Wilayah (Provinsi/Negara).
  - Bidang Pekerjaan (Pemerintahan, Swasta, Freelance).
  - Tahun Angkatan.
- **Growth Chart**: Tren pertumbuhan anggota IASPIG.

## 5. Backend Strategy
- **API Endpoints**: Membuat API khusus untuk menyuplai data koordinat ke peta (JSON format).
- **Caching**: Menggunakan Laravel Cache untuk data peta agar tidak terus-menerus menarik data berat dari database.

## 6. Fitur Tambahan: GIS Utility Tools
- **Coordinate Converter**: Alat sederhana untuk konversi sistem koordinat (Geografis <-> UTM).
- **Digital Portfolio Export**: Fitur untuk mengunduh profil alumni dalam format PDF yang didesain secara profesional.

## 7. Design & Development Principles
Untuk memastikan kualitas premium dan keberlanjutan platform, seluruh pengembangan Fase 2 wajib mengikuti prinsip berikut:

### A. Visual Identity (Color Palette)
- **Primary Orange**: Digunakan untuk elemen aksi (buttons, active links, highlights).
- **Deep Brown (Coklat)**: Digunakan untuk tipografi utama, footer, dan elemen profesional/serius.
- **Clean White (Putih)**: Sebagai background utama untuk kesan bersih, modern, dan luas.
- **Consistent**: Penggunaan token warna dan spasi yang seragam di seluruh komponen UI.

### B. Technical Architecture
- **Modular**: Komponen (seperti kartu alumni, popup peta) dibangun secara independen agar bisa digunakan kembali (reusable).
- **Scalable**: Struktur database dan API dirancang untuk menangani pertumbuhan ribuan data alumni tanpa penurunan performa.
- **Easy Maintenance**: Kode harus bersih, terdokumentasi, dan mengikuti standar Laravel/Vite agar mudah diperbarui di masa depan.
- **Responsive Design**: Tampilan wajib optimal di berbagai perangkat, mulai dari smartphone (untuk surveyor di lapangan) hingga desktop (untuk admin/perusahaan).

---
## Checklist Maintenance
- [ ] Validasi koordinat (Lat/Long) untuk mencegah error pada peta.
- [ ] Optimasi query database (Eager Loading) untuk profil alumni.
- [ ] Integrasi API Ina-Geoportal untuk basemap spesifik pemetaan.
- [ ] Uji responsivitas pada perangkat mobile.
