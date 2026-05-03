# Detail Implementasi Fase 3.1: Social Networking (Alumni Feed)

Dokumen ini merinci langkah-langkah teknis untuk membangun sistem interaksi sosial alumni yang scalable, modular, dan responsif.

## Sub-Fase 3.1: Fondasi Arsitektur & Database
Fokus pada struktur data yang kuat untuk mendukung ribuan interaksi.

### 1. Skema Database (Migrations)
*   **Table `posts`**:
    ```php
    Schema::create('posts', function (Blueprint $table) {
        $table->uuid('id')->primary();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->text('content');
        $table->enum('type', ['status', 'photo', 'job'])->default('status');
        $table->json('metadata')->nullable(); // Link previews, project coordinates
        $table->timestamps();
        $table->index(['user_id', 'created_at']);
    });
    ```
*   **Table `comments`**:
    ```php
    Schema::create('comments', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignUuid('post_id')->constrained()->onDelete('cascade');
        $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade');
        $table->text('body');
        $table->integer('depth')->default(0);
        $table->timestamps();
    });
    ```
*   **Table `likes`**:
    ```php
    Schema::create('likes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignUuid('post_id')->constrained()->onDelete('cascade');
        $table->unique(['user_id', 'post_id']); // Mencegah double like
        $table->timestamps();
    });
    ```

---

## Sub-Fase 3.2: Service Layer & Business Logic
Memastikan kode bersih (Clean Code) dan mudah dikelola.

*   **`PostService.php`**: Menangani logika pembuatan post, sanitasi konten, dan pemrosesan metadata (link scraping).
*   **`PostPolicy.php`**: Keamanan akses (hanya pemilik yang bisa delete/edit).
*   **`verified` Middleware**: Memastikan feed hanya bisa diakses oleh alumni yang status profilnya sudah 'Verified' oleh admin.

---

## Sub-Fase 3.3: Modular UI Components (Blade + Tailwind)
Membangun antarmuka premium yang konsisten.

*   **Komponen `PostCard`**: Terdiri dari `header`, `body` (multi-image grid), dan `footer` (action buttons).
*   **Responsive Design**:
    *   Mobile: Single column feed, sticky navigation bawah.
    *   Desktop: Two-column (Feed di kiri, Sidebar "Trending/Recommended Alumni" di kanan).
*   **Typography**: Menggunakan `Inter` atau `Outfit` untuk kejelasan teks.

---

## Sub-Fase 3.4: Fitur Interaktif (Livewire)
Pengalaman pengguna tanpa refresh halaman (SPA-like feel).

*   **`LikeButton` Component**: State-management instan (Warna orange aktif).
*   **`CommentSection` Component**: Menampilkan thread komentar dengan sistem indentasi yang rapi.
*   **Infinite Scrolling**: Memuat postingan lama secara otomatis saat user mencapai scroll bawah.
*   **Image Preview Modal**: Menggunakan Alpine.js untuk fitur lightbox/pop-up gambar.

---

## Sub-Fase 3.5: Real-time & Optimization
Sentuhan akhir untuk performa tinggi.

*   **Real-time Interaction**: Menggunakan Laravel Reverb/Pusher untuk broadcast jumlah like dan komentar baru secara live.
*   **Image Optimization**: Integrasi Spatie Media Library untuk otomatisasi resizing dan WebP conversion.
*   **Caching**: Cache query `trending_posts` atau `top_alumni` selama 15-30 menit untuk mengurangi beban database.
*   **Link Previewer**: Sistem otomatis mengambil Title, Description, dan Image dari link lowongan kerja yang ditempel alumni.

---

## Ringkasan Teknologi
| Layer | Teknologi |
| :--- | :--- |
| **Backend** | Laravel 11, PHP 8.3 |
| **Frontend** | Livewire 3, Alpine.js, Tailwind CSS |
| **Real-time** | Laravel Reverb |
| **Storage** | AWS S3 / Local Storage (with Optimization) |
| **Icons** | Remix Icon (untuk nuansa modern) |
