# 🛍️ Backend API Online Shop

> **High-Performance RESTful JSON API for E-Commerce Product Management.**  
> *Solid architecture, strict validation, and optimized for production environments.*

---

## 🖥️ Environment Specifications

| Component | Specification |
| :--- | :--- |
| **Framework** | Laravel 13 (Latest Stable) |
| **Language** | PHP 8.3+ |
| **Database** | MySQL 8.0+ |
| **OS Environment** | Ubuntu 26.04 LTS |
| **Development Device** | ASUS Vivobook 14 |
| **Processor** | Intel® Core™ i3-1315U (10 Cores) |
| **API Format** | JSON (Stateless) |
| **Authentication** | None (Public Data API) |

---

## 📋 System Overview

Sistem ini adalah **Backend API berbasis REST** yang dirancang khusus untuk mengelola siklus data produk pada platform online shop. Dibangun di atas fondasi **Laravel 13**, sistem ini mengutamakan integritas data, kecepatan respons, dan kemudahan integrasi dengan frontend atau mobile app.

### Core Features:
*   **RESTful Standard:** Mengikuti prinsip HTTP methods standar untuk operasi CRUD.
*   **JSON Response:** Seluruh response dikembalikan dalam format JSON yang terstruktur dan konsisten.
*   **Strict Validation:** Menggunakan Laravel Request Validation untuk memastikan hanya data valid yang masuk ke database.
*   **Optimized Query:** Memanfaatkan Eloquent ORM dengan *eager loading* untuk meminimalisir masalah N+1 query.

> ⚠️ **Catatan Penting:**  
> Project ini adalah **sistem final** yang berfokus pada manajemen data produk. Sistem ini **tidak** mengimplementasikan fitur login/register (autentikasi pengguna) pada tahap ini, sehingga endpoint bersifat publik untuk keperluan demonstrasi logika backend dan manipulasi data.

---

## 🚀 API Endpoint Showcase

Berikut adalah daftar endpoint utama untuk manajemen produk. Semua endpoint mengembalikan response dalam format JSON.

| Method | Endpoint | Function | Description |
| :---: | :--- | :--- | :--- |
| `GET` | `/api/products` | `index()` | Mengambil daftar semua produk dengan dukungan pagination. |
| `POST` | `/api/products` | `store()` | Menyimpan data produk baru ke database. |
| `GET` | `/api/products/{id}` | `show()` | Mengambil detail spesifik satu produk berdasarkan ID. |
| `PUT` | `/api/products/{id}` | `update()` | Memperbarui data produk yang sudah ada secara keseluruhan. |
| `DELETE` | `/api/products/{id}` | `destroy()` | Menghapus data produk dari database secara permanen. |

---

## ❓ Technical Q&A: Implementation Details

Bagian ini menjawab pertanyaan teknis mengenai validasi, keamanan, dan performa sistem.

### 1. Bagaimana mekanisme validasi input pada formulir online shop?

Validasi adalah garis pertahanan pertama untuk menjaga kualitas data. Dalam sistem ini, kami menggunakan **Laravel Form Request Validation** yang dipisahkan dari Controller untuk menjaga kode tetap bersih (*clean code*).

*   **Rule Penerapan:**
    *   `required`: Memastikan field kritis seperti `name`, `price`, dan `stock` tidak kosong.
    *   `numeric` & `min:0`: Memastikan harga dan stok berupa angka positif.
    *   `string` & `max:255`: Membatasi panjang teks nama produk agar efisien di database.
    *   `unique:products`: Mencegah duplikasi data jika diperlukan (misalnya SKU).
*   **Dampak:** Jika validasi gagal, API akan langsung mengembalikan response `422 Unprocessable Entity` dengan pesan error yang spesifik, sehingga database terlindungi dari data sampah (*garbage data*).

### 2. Bagaimana mekanisme autentikasi dan keamanan akun diterapkan?

Sesuai dengan ruang lingkup project saat ini, **sistem ini tidak mengimplementasikan autentikasi (Login/Register)**. Fokus utama adalah pada penyediaan API data produk yang cepat dan andal.

Namun, keamanan tetap dijaga melalui pendekatan berikut:
*   **Strict Input Sanitization:** Semua input pengguna dibersihkan dan divalidasi ketat sebelum diproses, mencegah serangan *SQL Injection* dan *XSS* dasar.
*   **Mass Assignment Protection:** Menggunakan properti `$fillable` di Model Eloquent untuk memastikan hanya kolom yang diizinkan saja yang bisa diisi oleh user.
*   **HTTP Methods Enforcement:** Router hanya menerima method HTTP yang sesuai (misalnya, `DELETE` hanya bisa lewat method DELETE, bukan GET).

> 💡 **Future Development:**  
> Jika sistem ini dikembangkan ke tahap produksi penuh dengan user, kami siap mengintegrasikan **Laravel Sanctum** untuk autentikasi berbasis token (API Tokens) atau **JWT** untuk stateless authentication yang skalabel.

### 3. Bagaimana strategi searching, sorting, dan kelancaran CRUD?

Performa adalah kunci dalam aplikasi e-commerce. Berikut adalah teknik yang digunakan:

*   **Searching:** Menggunakan **Query Builder** dengan klausa `LIKE` untuk pencarian nama produk. Query dioptimasi agar tidak melakukan full-table scan pada dataset besar.
*   **Sorting:** Menggunakan metode `orderBy()` dinamis berdasarkan parameter request (misalnya: `sort=price&order=desc`), memungkinkan user mengurutkan produk dari termurah atau terbaru.
*   **CRUD Efficiency:** Seluruh operasi database ditangani oleh **Eloquent ORM**.
*   **Optimasi Query:** Untuk relasi (jika ada kategori atau review), kami menggunakan **Eager Loading** (`with()`) untuk memuat data relasi dalam satu query utama, menghindari masalah performa *N+1 query* yang umum terjadi pada aplikasi Laravel.

---

## 🧠 Clean Logic Explanation

Mengapa arsitektur ini dipilih?

1.  **Direct Database Interaction via Eloquent:**  
    Kami memilih Eloquent ORM daripada Raw SQL karena keterbacaan (*readability*) dan keamanan. Eloquent secara otomatis menangani *escaping* nilai input, mengurangi risiko human error dalam penulisan query.
2.  **Scalability:**  
    Struktur controller yang tipis (*Thin Controller*) dan logika bisnis yang terpusat memudahkan pengembang lain untuk memahami alur data. Jika traffic meningkat, struktur ini mudah di-cache menggunakan Redis atau Dioptimasi dengan Database Indexing.
3.  **Maintainability:**  
    Dengan memisahkan validasi ke dalam `FormRequest` dan logika database ke dalam `Model`, kode menjadi modular. Perubahan pada rule validasi tidak akan merusak logika controller.

---

## 🏁 Closing

Project **Backend API Online Shop** ini dibangun dengan prinsip **Clean Architecture** dan **Efficient Query Handling**. Meskipun saat ini berfokus pada manajemen data produk tanpa autentikasi, fondasi yang diletakkan sudah cukup kuat untuk skala produksi.

Sistem ini siap untuk:
*   Diintegrasikan dengan Frontend (Vue/React/Next.js).
*   Dikembangkan lebih lanjut dengan fitur Auth (Sanctum/JWT).
*   Diperluas dengan fitur Cart, Checkout, dan Payment Gateway.

*Dibuat dengan ❤️ menggunakan Laravel 13 & Ubuntu 26.04.*