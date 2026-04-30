# Fase 2: Core Alumni & Geospatial Mapping

Fase ini adalah inti dari database alumni, mengubah data pasif menjadi visualisasi spasial yang informatif.

## 1. Manajemen Profil Alumni (Self-Service)
- **Profile Dashboard**: UI bersih untuk mengisi data detail.
- **Field Data**:
  - Foto Profil.
  - Pekerjaan Saat Ini & Instansi.
  - Alamat Domisili (dengan integrasi Google Maps/OpenStreetMap API untuk pick koordinat).
  - Bio & Keahlian Khusus (Lidar, Drone, GIS Analyst, dll).
- **Privacy Setting**: Pilihan untuk menyembunyikan detail kontak dari publik.

## 2. Direktori Alumni (Searchable Database)
- **Advanced Filter**: Cari berdasarkan Angkatan, Nama, atau Instansi.
- **Modular Card Design**: Menampilkan kartu alumni dengan palet warna orange-putih yang elegan.
- **Pagination**: Menangani ribuan data alumni agar loading tetap cepat.

## 3. Fitur Peta Sebaran (The Star Feature)
- **Leaflet.js Integration**: Peta interaktif yang ringan.
- **Clustering**: Mengelompokkan titik alumni jika terlalu banyak dalam satu wilayah agar peta tidak berantakan.
- **Interactive Popup**: Klik titik di peta untuk melihat profil singkat alumni (Foto, Nama, Angkatan).
- **Theme Map**: Kustomisasi tile peta (Dark Mode atau Terrain) agar senada dengan estetika coklat-orange.

## 4. Backend Strategy
- **API Endpoints**: Membuat API khusus untuk menyuplai data koordinat ke peta (JSON format).
- **Caching**: Menggunakan Laravel Cache untuk data peta agar tidak terus-menerus menarik data berat dari database.

## 5. Fitur Tambahan: GIS Utility Tools
- **Coordinate Converter**: Integrasi alat sederhana untuk konversi sistem koordinat (Geografis <-> UTM) sebagai nilai tambah bagi user surveyor.

---
## Checklist Maintenance
- [ ] Validasi koordinat (Lat/Long) untuk mencegah error pada peta.
- [ ] Optimasi query database (Eager Loading) untuk profil alumni.
