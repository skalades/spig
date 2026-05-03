# Detailed Implementation Plan: Phase 3 (Business & Career Hub)

Dokumen ini mendetailkan spesifikasi teknis untuk sisa fitur Fase 3 dengan prinsip **Scalable, Modular, dan Maintainable**.

## 1. Arsitektur Data (Database Design)
Untuk menjaga modularitas, kita akan menggunakan relasi yang fleksibel.

### A. Business & Rental Module
- **Model: `Company`**
  - `user_id` (Owner/Alumni)
  - `name`, `slug`, `logo`, `description`
  - `industry_type` (Enum: Surveying, GIS, Hydrography, etc.)
  - `website`, `whatsapp_number`, `email`
  - `address`, `latitude`, `longitude` (Untuk Map Layer)
  - `is_verified` (Boolean)
- **Model: `CompanyService`** (Pivot/Tagging)
  - `company_id`, `name` (e.g., Rental Alat, Pemetaan Drone)
- **Model: `RentalInventory`**
  - `company_id`
  - `item_name`, `category` (Total Station, Drone, etc.)
  - `description`, `daily_rate`
  - `status` (Available, Rented, Maintenance)
  - `image_path`

### B. Career Hub Module
- **Model: `JobPost`**
  - `user_id` (Poster)
  - `company_id` (Optional, jika diposting atas nama perusahaan)
  - `title`, `slug`, `description`, `requirements`
  - `location`, `job_type` (Full-time, Contract, Freelance)
  - `salary_range` (Optional, hidden by default)
  - `deadline`, `status` (Open, Closed)

### C. Maintenance & Moderation
- **Model: `Report`** (Polymorphic)
  - `user_id` (Reporter)
  - `reportable_id`, `reportable_type` (Post, Comment, Job, Company)
  - `reason`, `status` (Pending, Reviewed, Dismissed)

---

## 2. Komponen Modular (Livewire)
Setiap fitur akan dipecah menjadi komponen kecil agar mudah di-reuse.

### Business Directory
- `Business.DirectoryIndex`: Grid view dengan filter industri dan lokasi.
- `Business.CompanyCard`: Kartu profil perusahaan (konsisten dengan User Card).
- `Business.RegistrationForm`: Multi-step form untuk pendaftaran perusahaan.
- `Business.InventoryList`: Katalog alat yang bisa disewa.

### Career Hub
- `Career.JobBoard`: List lowongan dengan filter kategori GIS/Survey.
- `Career.JobDetail`: Halaman detail lowongan dengan tombol "Hubungi Poster".

---

## 3. Strategi Implementasi (Scalability & Quality)

### A. Image Management & Compression
- **Spatie Media Library**: Digunakan untuk semua upload (Logo, Foto Proyek, Alat).
- **Auto-Conversion**: Implementasi `registerMediaConversions` pada model untuk otomatis mengompres gambar ke format WebP dan resize sesuai kebutuhan UI (Thumbnail vs Full).

### B. Map Layer Integration
- **Unified Map Service**: Membuat satu service Javascript/Livewire yang bisa menerima data `Company` atau `AlumniProfile` secara dinamis.
- **Marker Clustering**: Menggunakan clustering pada peta jika jumlah kantor perusahaan sudah banyak (>100) untuk menjaga performa.

### C. Responsivitas & UI Konsistensi
- **Mobile First**: Bottom navigation untuk akses cepat ke Feed, Directory, dan Jobs.
- **Shared Components**: Menggunakan Blade Components (`x-iaspig-card`, `x-iaspig-button`) yang sudah didefinisikan agar perubahan desain di satu tempat berdampak ke seluruh sistem.

---

## 4. Rencana Kerja (Task Breakdown)

### Tahap 1: Fondasi Bisnis (Minggu 1)
- [ ] Migrasi tabel `companies`, `company_services`, `rental_inventories`.
- [ ] Model & Relationship setup (User hasMany Companies).
- [ ] CRUD Company Profile di Dashboard Alumni.

### Tahap 2: Career Hub & Jobs (Minggu 2)
- [ ] Migrasi tabel `job_posts`.
- [ ] Dashboard posting lowongan kerja.
- [ ] Integrasi ke Social Feed (Auto-post ke feed saat lowongan dibuat).

### Tahap 3: Map & Discovery (Minggu 3)
- [ ] Implementasi Filter "Company Layer" di Map Dashboard.
- [ ] Halaman Direktori Bisnis publik.
- [ ] Fitur "Contact via WhatsApp" (Direct API integration).

### Tahap 4: Moderasi & Polish (Minggu 4)
- [ ] Sistem Report (Polymorphic).
- [ ] Image Compression setup.
- [ ] SEO Meta Tags untuk halaman Perusahaan & Lowongan.
