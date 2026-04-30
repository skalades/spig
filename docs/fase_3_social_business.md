# Fase 3: Social Hub & Business Directory

Fase ini menghidupkan komunitas melalui interaksi harian dan pemberdayaan ekonomi antar alumni.

## 1. Social Networking (Alumni Feed)
- **Timeline System**: Feed publik khusus alumni terverifikasi.
- **Content Types**: Postingan teks, foto (proyek lapangan, reuni), dan link lowongan kerja.
- **Interaksi**:
  - Like/Love (Warna Orange).
  - Komentar bertingkat (Threaded comments).
- **Real-time Updates**: Menggunakan Laravel Reverb atau Pusher (optional) untuk notifikasi instan.

## 2. Business Directory (Alumni Companies)
- **Company Profile**: Form pendaftaran perusahaan (Nama, Logo, Deskripsi, Bidang Jasa).
- **Service Tags**: Kategorisasi perusahaan (e.g., Terrestrial Survey, Hydrography, GIS Developer, **Rental Alat**).
- **Rental Inventory (Khusus Persewaan)**: Modul bagi perusahaan alumni untuk menampilkan katalog alat yang tersedia untuk disewa (beserta status ketersediaan).
- **Company Map Layer**: Menambahkan filter pada peta utama untuk menampilkan lokasi kantor-kantor perusahaan alumni.
- **Partner/Collaboration Portal**: Dashboard bagi perusahaan eksternal untuk mengajukan kerjasama atau memposting lowongan secara resmi.
- **Contact Business**: Tombol hubungi langsung (WhatsApp/Email) untuk mempermudah transaksi bisnis antar alumni.

## 3. Career Hub (Job Board)
- **Post Job**: Fitur bagi alumni untuk berbagi lowongan kerja di instansi masing-masing.
- **Job Categories**: Mapping job categories (GIS, Surveying, Remote Sensing).

## 4. Fitur Tambahan: Komunitas & Ekonomi
- **Mentorship Program**: Menghubungkan alumni senior dengan fresh graduate untuk bimbingan karir.
- **Project Showcase**: Galeri portofolio untuk memamerkan hasil peta atau proyek lapangan alumni.
- **Alumni Marketplace**: Wadah jual-beli atau sewa alat survey bekas (Total Station, Drone, dll) antar alumni.

## 5. Estetika & Konsistensi
- Penggunaan kartu (card) yang seragam untuk postingan timeline dan profil perusahaan.
- Tipografi yang tegas dan modern (misal: Inter atau Roboto).

---
## Checklist Maintenance
- [ ] Image Compression: Otomatis mengompres foto yang diunggah agar hemat storage.
- [ ] Moderasi Konten: Fitur "Report" untuk melaporkan postingan yang tidak pantas.
