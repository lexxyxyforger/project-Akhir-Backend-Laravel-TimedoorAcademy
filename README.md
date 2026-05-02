# 🔴 ADASTORE

> *"She always escapes — and so does every bug, if you don't architect it right."*
> — Inspired by Ada Wong · Stealth Edition

**Adastore** adalah full-stack web application yang dibangun di atas fondasi **Manual Clean Architecture** — tanpa scaffolding, tanpa jalan pintas, tanpa kompromi. Backend API yang solid dengan **Laravel 13**, frontend reaktif via **Next.js**, dan UI bertema dark monochromatic glassmorphism dengan aksen merah kontras tinggi.

Bukan clone starter kit. Setiap layer dirancang, disusun, dan di-deploy dengan penuh kesadaran arsitektur.

---

## 🛡️ Tech Stack

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-v4-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![Next.js](https://img.shields.io/badge/Next.js-App_Router-000000?style=for-the-badge&logo=nextdotjs&logoColor=white)
![Ubuntu](https://img.shields.io/badge/Ubuntu-26.04_LTS-E95420?style=for-the-badge&logo=ubuntu&logoColor=white)

---

## ⚙️ Environment Specifications

| Komponen | Spesifikasi |
|---|---|
| **Operating System** | Ubuntu 26.04 LTS (Riced) |
| **Hardware** | ASUS Vivobook 14 |
| **Processor** | Intel Core i3-1315U |
| **Backend Framework** | Laravel 13 |
| **PHP Runtime** | PHP 8.5+ |
| **Database** | MySQL 8.0 |
| **Frontend Framework** | Next.js (App Router) |
| **CSS Framework** | Tailwind CSS v4 |
| **Arsitektur** | Manual Clean Architecture |
| **Auth Strategy** | Manual Token-Based Authentication |
| **API Protocol** | RESTful JSON API |
| **Image Handling** | Hybrid (URL Eksternal + Local Upload) |

---

## 🏗️ System Overview

### Mengapa Manual Architecture?

Kebanyakan developer langsung reach for **Laravel Breeze** atau **Jetstream** begitu project dimulai. Adastore sengaja tidak melakukan itu — dan ini bukan karena ketidaktahuan, melainkan keputusan teknis yang disengaja.

**Alasannya sederhana:**

- **Kontrol penuh** — Tidak ada magic method atau trait tersembunyi yang sulit di-debug saat production.
- **Tidak ada bloat** — Breeze membawa view stubs, Jetstream membawa Livewire/Inertia. Adastore tidak butuh itu.
- **Arsitektur yang bisa dijelaskan** — Setiap baris kode punya alasan. Tidak ada *"saya tidak tahu ini dari mana."*
- **Scalable by design** — Service Layer memungkinkan penggantian atau perluasan logic tanpa menyentuh Controller.

---

### Struktur Direktori

```
adastore/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php        # Register, Login, Logout
│   │   │   └── ProductController.php     # CRUD Product
│   │   ├── Requests/
│   │   │   ├── LoginRequest.php          # Validasi login
│   │   │   ├── RegisterRequest.php       # Validasi register
│   │   │   └── ProductRequest.php        # Validasi product (store & update)
│   │   └── Middleware/
│   │       └── AuthTokenMiddleware.php   # Guard token manual
│   ├── Models/
│   │   ├── User.php
│   │   └── Product.php
│   └── Services/
│       ├── AuthService.php               # Logic autentikasi
│       └── ProductService.php            # Logic produk + image handling
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php                           # Semua route API terdaftar di sini
└── frontend/ (Next.js)
    ├── app/                              # App Router pages
    ├── components/                       # UI components (Glassmorphism)
    └── lib/
        └── api.ts                        # Axios client + interceptor token
```

---

### Alur Sistem

```
Client (Next.js)
     │
     ▼
[ API Request + Bearer Token ]
     │
     ▼
[ AuthTokenMiddleware ]  ←── Tolak jika token tidak valid (401)
     │
     ▼
[ Controller ]           ←── Tipis. Hanya terima & teruskan.
     │
     ▼
[ FormRequest ]          ←── Validasi dideklarasikan di sini (422 jika gagal)
     │
     ▼
[ Service Layer ]        ←── Business logic murni ada di sini
     │
     ▼
[ Eloquent Model ]       ←── Query database yang aman & ekspresif
     │
     ▼
[ JSON Response ]        ←── Konsisten: { status, message, data }
```

---

## 🔌 API Endpoints

### 🔓 Auth Routes — `/api/auth`

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| `POST` | `/api/auth/register` | Registrasi user baru | Public |
| `POST` | `/api/auth/login` | Login & generate token | Public |
| `POST` | `/api/auth/logout` | Invalidate token aktif | 🔒 Private |
| `GET` | `/api/auth/me` | Data user yang sedang login | 🔒 Private |

---

### 📦 Product Routes — `/api/products`

| Method | Endpoint | Fungsi | Akses |
|--------|----------|--------|-------|
| `GET` | `/api/products` | Ambil semua produk | Public |
| `GET` | `/api/products/{id}` | Detail satu produk | Public |
| `POST` | `/api/products` | Tambah produk baru | 🔒 Private |
| `POST` | `/api/products/{id}` | Update produk (Method Spoofing) | 🔒 Private |
| `DELETE` | `/api/products/{id}` | Hapus produk | 🔒 Private |

> **Catatan:** Route update menggunakan `POST` bukan `PUT`/`PATCH` karena keterbatasan `multipart/form-data` dengan HTTP method tersebut. Penjelasan lengkap ada di bagian Technical Q&A.

---

### 📋 Contoh Response Format

**Success (200/201):**
```json
{
  "status": "success",
  "message": "Product berhasil ditambahkan.",
  "data": {
    "id": 7,
    "name": "Ada's Crimson Knife",
    "price": 1500000,
    "stock": 12,
    "image": "http://localhost:8000/storage/products/ada-knife.webp",
    "created_at": "2025-07-10T03:00:00.000000Z"
  }
}
```

**Validation Error (422):**
```json
{
  "status": "error",
  "message": "Validasi gagal.",
  "errors": {
    "name": ["Nama produk wajib diisi."],
    "price": ["Harga harus berupa angka positif."]
  }
}
```

**Unauthorized (401):**
```json
{
  "status": "error",
  "message": "Unauthenticated. Token tidak valid atau sudah kedaluwarsa."
}
```

---

## 🔬 Technical Q&A

### ❓ Bagaimana Validasi Data Ditangani?

Semua validasi dilakukan di lapisan **FormRequest** — bukan di Controller, bukan di Service. Ini bukan sekadar konvensi; ini adalah arsitektur yang memisahkan tanggung jawab secara tegas.

```php
// app/Http/Requests/ProductRequest.php

public function rules(): array
{
    return [
        'name'        => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'price'       => ['required', 'numeric', 'min:0'],
        'stock'       => ['required', 'integer', 'min:0'],
        'image_url'   => ['nullable', 'url'],
        'image_file'  => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
    ];
}

public function messages(): array
{
    return [
        'name.required'  => 'Nama produk wajib diisi.',
        'price.numeric'  => 'Harga harus berupa angka.',
        'price.min'      => 'Harga tidak boleh negatif.',
        'image_file.max' => 'Ukuran gambar maksimal 2MB.',
    ];
}
```

Ketika validasi gagal, Laravel secara otomatis mengembalikan **HTTP 422 Unprocessable Entity** dengan detail error per-field. Controller tidak perlu tahu apa-apa tentang kegagalan ini — separation of concerns berjalan bersih.

---

### ❓ Bagaimana Hybrid Image Handling Bekerja?

Adastore mendukung dua mode pengiriman gambar — URL eksternal (misal dari CDN atau link publik) dan upload file lokal. Logic ini ditangani sepenuhnya di **ProductService**.

```php
// app/Services/ProductService.php

public function resolveImage(Request $request): ?string
{
    // Prioritas 1: File upload lokal
    if ($request->hasFile('image_file')) {
        $path = $request->file('image_file')->store('products', 'public');
        return Storage::url($path); // Return URL publik yang bisa diakses frontend
    }

    // Prioritas 2: URL eksternal langsung
    if ($request->filled('image_url')) {
        return $request->input('image_url');
    }

    // Tidak ada gambar yang dikirim
    return null;
}
```

**Alur keputusan:**

```
Request masuk
    │
    ├─ Ada file upload?  → Simpan ke /storage/app/public/products/ → Return URL lokal
    │
    ├─ Ada image_url?    → Gunakan URL langsung tanpa download ke server
    │
    └─ Tidak ada?        → Set null, produk disimpan tanpa gambar
```

Pendekatan ini menghindari download ulang gambar eksternal ke server dan mengurangi beban storage secara signifikan — efisien untuk hardware dengan resource terbatas.

---

### ❓ Apa itu Method Spoofing dan Mengapa Dibutuhkan?

Browser dan beberapa HTTP client tidak mendukung method `PUT` atau `PATCH` saat mengirim data `multipart/form-data` — format yang wajib digunakan ketika ada file upload. Solusinya adalah **Method Spoofing**: kirim request `POST` biasa, tapi sertakan field tersembunyi `_method`.

**Dari sisi frontend (Next.js):**
```typescript
// lib/api.ts

const formData = new FormData();
formData.append('_method', 'PUT');   // ← Spoofing: Laravel akan baca ini
formData.append('name', productName);
formData.append('price', String(price));
formData.append('image_file', file); // ← File ini yang jadi alasan POST dipakai

await axios.post(`/api/products/${id}`, formData, {
  headers: {
    'Content-Type': 'multipart/form-data',
    'Authorization': `Bearer ${token}`,
  },
});
```

**Dari sisi backend (Laravel):**

Laravel membaca field `_method` secara otomatis melalui middleware `MethodSpoofing` dan me-route request ke handler `PUT` yang sesuai di `api.php`. Tidak ada konfigurasi tambahan — ini sudah built-in di framework Laravel.

```php
// routes/api.php
Route::put('/products/{id}', [ProductController::class, 'update'])
    ->middleware('auth.token');
// ↑ Route ini tetap ditulis PUT — Laravel yang handle spoofing-nya
```

---

### ❓ Bagaimana Manual Authentication Bekerja?

Tanpa Sanctum atau Passport, token dikelola secara manual dengan mekanisme berikut:

```php
// app/Services/AuthService.php

public function login(array $credentials): array
{
    $user = User::where('email', $credentials['email'])->first();

    if (! $user || ! Hash::check($credentials['password'], $user->password)) {
        throw new AuthenticationException('Kredensial tidak valid.');
    }

    // Hapus token lama, buat token baru
    $rawToken  = bin2hex(random_bytes(40)); // 80 karakter hex acak

    $user->update([
        'api_token'        => hash('sha256', $rawToken), // Hanya hash yang disimpan
        'token_expired_at' => now()->addDays(7),
    ]);

    return ['token' => $rawToken, 'user' => $user];
    // ↑ raw token dikirim ke client SEKALI — tidak pernah disimpan plain
}
```

**Middleware guard:**
```php
// app/Http/Middleware/AuthTokenMiddleware.php

public function handle(Request $request, Closure $next): Response
{
    $rawToken = $request->bearerToken();

    $user = User::where('api_token', hash('sha256', $rawToken))
                ->where('token_expired_at', '>', now())
                ->first();

    if (! $user) {
        return response()->json([
            'status'  => 'error',
            'message' => 'Unauthenticated. Token tidak valid atau sudah kedaluwarsa.',
        ], 401);
    }

    $request->setUserResolver(fn () => $user);
    return $next($request);
}
```

Token di-hash dengan **SHA-256** sebelum disimpan ke database — sehingga jika database bocor sekalipun, raw token yang dipegang client tetap tidak bisa diekstrak.

---

## 🧠 Clean Logic: Mengapa Eloquent ORM?

### Keamanan Query

Eloquent menggunakan **PDO prepared statements** secara default untuk setiap query yang dibangun melalui Query Builder-nya. SQL Injection secara struktural tertutup selama developer tidak menggunakan `DB::statement()` atau `whereRaw()` dengan input user secara langsung.

```php
// ✅ Aman — Eloquent auto-escape nilai input
Product::where('name', $request->name)->get();

// ⚠️ Berbahaya — string interpolation langsung ke SQL
DB::select("SELECT * FROM products WHERE name = '{$request->name}'");
```

### Eloquent vs Raw SQL — Perbandingan Jujur

| Aspek | Eloquent ORM | Raw SQL |
|---|---|---|
| **SQL Injection** | Terlindungi by default | Sanitasi manual wajib |
| **Readability** | Ekspresif & chainable | Verbose untuk query kompleks |
| **Relationship** | `hasMany`, `belongsTo` built-in | JOIN manual setiap kali |
| **Soft Delete** | `SoftDeletes` trait, 1 baris | Tambah kondisi `WHERE deleted_at IS NULL` di mana-mana |
| **Timestamps** | Auto-managed | Set manual di setiap query |
| **Scope Query** | Global & local scope | Tidak ada, duplikasi kondisi |
| **Raw Speed** | Sedikit lebih lambat | Marginally lebih cepat |

Untuk skala Adastore — CRUD + Auth + Relasi — overhead performa Eloquent tidak signifikan, sementara keuntungan keamanan dan maintainability-nya nyata. **Trade-off-nya masuk akal.**

---

## 🚀 Quick Start

### Prerequisites

```bash
php -v        # PHP 8.5+
composer -v   # Composer 2.x
node -v       # Node.js 20+
mysql -V      # MySQL 8.0
```

### Backend Setup

```bash
# Clone repository
git clone https://github.com/username/adastore.git
cd adastore

# Install dependencies
composer install

# Konfigurasi environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --seed

# Link storage untuk local image upload
php artisan storage:link

# Jalankan development server
php artisan serve
# → http://localhost:8000
```

### Frontend Setup

```bash
cd frontend

# Install dependencies
npm install

# Konfigurasi API base URL
cp .env.local.example .env.local
# Edit: NEXT_PUBLIC_API_URL=http://localhost:8000

# Development server
npm run dev
# → http://localhost:3000
```

### Environment Variables

```env
# .env (Laravel)
APP_NAME=Adastore
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=adastore_db
DB_USERNAME=root
DB_PASSWORD=

FILESYSTEM_DISK=public
```

---

## 📁 Database Schema

```sql
-- Tabel users
CREATE TABLE users (
  id               BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name             VARCHAR(255) NOT NULL,
  email            VARCHAR(255) UNIQUE NOT NULL,
  password         VARCHAR(255) NOT NULL,
  api_token        VARCHAR(255) NULL,
  token_expired_at TIMESTAMP NULL,
  created_at       TIMESTAMP NULL,
  updated_at       TIMESTAMP NULL
);

-- Tabel products
CREATE TABLE products (
  id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id     BIGINT UNSIGNED NOT NULL,
  name        VARCHAR(255) NOT NULL,
  description TEXT NULL,
  price       DECIMAL(15, 2) NOT NULL,
  stock       INT UNSIGNED NOT NULL DEFAULT 0,
  image       VARCHAR(500) NULL,
  created_at  TIMESTAMP NULL,
  updated_at  TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 🎨 Design System

| Token | Value | Penggunaan |
|---|---|---|
| `--bg-primary` | `#0a0a0a` | Background utama |
| `--bg-glass` | `rgba(255,255,255,0.04)` | Card glassmorphism |
| `--border-glass` | `rgba(255,255,255,0.08)` | Border card |
| `--accent-red` | `#dc2626` | CTA, error state, aksen utama |
| `--accent-red-hover` | `#b91c1c` | Hover state merah |
| `--text-primary` | `#f5f5f5` | Teks utama |
| `--text-muted` | `#737373` | Teks sekunder / placeholder |

```css
/* Glassmorphism card — utility class utama */
.glass-card {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.08);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 0.75rem;
}
```

---

## 🔒 Security Checklist

- [x] Password di-hash dengan `bcrypt` via `Hash::make()`
- [x] Token disimpan sebagai SHA-256 hash — tidak pernah plain text di database
- [x] Token expiry 7 hari, auto-invalidate saat logout
- [x] Semua input divalidasi via FormRequest sebelum menyentuh Service Layer
- [x] Eloquent prepared statements — SQL Injection by default tertutup
- [x] CORS dikonfigurasi manual, hanya izinkan origin frontend
- [x] File upload divalidasi: mime type, ekstensi, dan ukuran maksimal 2MB

---

## ✅ Mission Accomplished

```
╔══════════════════════════════════════════════════════════╗
║              [ ADASTORE · SYSTEM STATUS ]                ║
╠══════════════════════════════════════════════════════════╣
║                                                          ║
║  Backend API        ████████████████████  OPERATIONAL   ║
║  Auth Module        ████████████████████  LOCKED        ║
║  Product CRUD       ████████████████████  FULLY ARMED   ║
║  Image Handler      ████████████████████  HYBRID ACTIVE ║
║  Validation Layer   ████████████████████  STRICT · 422  ║
║  Frontend UI        ████████████████████  DARK · SHARP  ║
║                                                          ║
║  ARCHITECTURE  : Manual Clean · Zero Bloat              ║
║  ENVIRONMENT   : Ubuntu 26.04 LTS · Riced               ║
║  HARDWARE      : ASUS Vivobook 14 · i3-1315U            ║
║                                                          ║
║  ██ STATUS : DEPLOYED ██                                 ║
╚══════════════════════════════════════════════════════════╝
```

Adastore dibangun bukan untuk sekadar jalan — melainkan untuk **bertahan, skalabel, dan bisa dijelaskan dari layer pertama hingga terakhir**. Setiap keputusan teknis di sini punya alasan. Tidak ada magic yang tidak dipahami, tidak ada dependency yang tidak dibutuhkan.

**Mission accomplished. System is live. 🔴**

---

<div align="center">

Made with ❤️ using **Laravel 13** & **Ubuntu 26.04**

*Adastore — Stealth Edition · Built on precision, not assumption.*

</div>