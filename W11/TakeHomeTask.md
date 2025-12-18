# TAKE HOME TASK MODUL 10

**Topik:** Laravel API Development (Relational Database & CRUD)  

---

## Skenario
Sebuah startup kuliner membutuhkan backend system untuk mengelola mitra restoran dan daftar menu mereka. Anda diminta untuk membangun REST API yang memungkinkan admin untuk mengelola data restoran dan menu makanan yang tersedia di restoran tersebut.

Sistem ini memiliki aturan: **Satu Restoran dapat memiliki banyak Menu.**

---

## Spesifikasi Database (Schema)

Berdasarkan rancangan ERD, buatlah Migration untuk dua tabel berikut:

### 1. Tabel `restorans`
Tabel ini menyimpan data induk mitra restoran.
* `id` (Primary Key, BigInt, Auto Increment)
* `nama` (String)
* `email` (String)
* `alamat` (Text)
* `no_telp` (String)
* `timestamps` (Created_at, Updated_at)

### 2. Tabel `menus`
Tabel ini menyimpan daftar makanan.
* `id` (Primary Key, BigInt, Auto Increment)
* `restoran_id` (Foreign Key -> mengacu ke tabel `restorans`)
* `nama` (String) - Contoh: "Nasi Goreng Spesial"
* `harga` (Integer)
* `jumlah` (Integer) - Representasi stok
* `timestamps` (Created_at, Updated_at)

> **Catatan:** Pastikan Foreign Key menggunakan `onDelete('cascade')`. Jika restoran dihapus, menunya harus hilang otomatis.

---

## Instruksi Pengerjaan

### Langkah 1: Setup & Models
1.  Buat project Laravel baru atau gunakan project yang sudah ada.
2.  Setup koneksi database di `.env`.
3.  Buat Model dan Migration untuk `Restoran` dan `Menu`.
4.  **Definisikan Relasi di Model:**
    * Model `Restoran`: Tambahkan fungsi `menus()` (HasMany).
    * Model `Menu`: Tambahkan fungsi `restoran()` (BelongsTo).
    * Pastikan properti `$guarded` atau `$fillable` sudah diatur agar bisa melakukan Mass Assignment.

### Langkah 2: Controller & Routing
Buatlah **MenuController** yang menangani logika CRUD berikut. Daftarkan route-nya di `routes/api.php`.

| Method | Endpoint | Deskripsi |
| :--- | :--- | :--- |
| **GET** | `/api/menus` | Menampilkan seluruh menu beserta **data restoran pemiliknya**. |
| **GET** | `/api/menus/{id}` | Menampilkan detail 1 menu beserta **data restoran pemiliknya**. |
| **POST** | `/api/menus` | Menambahkan menu baru ke database. |
| **PUT** | `/api/menus/{id}` | Mengupdate data menu (harga, stok, atau nama). |
| **DELETE** | `/api/menus/{id}` | Menghapus data menu. |

---

## Kriteria Pengujian (Postman / Platform Test lainnya)

Gunakan Postman untuk membuktikan API Anda berjalan.

### 1. Create Data (POST)
Pastikan Anda sudah memiliki minimal 1 data di tabel `restorans` (bisa input manual di database atau buat seeder). Saat melakukan POST Menu, gunakan format JSON berikut di **Body -> raw**:

```json
{
    "restoran_id": 1,
    "nama": "Ayam Bakar Madu",
    "harga": 25000,
    "jumlah": 50
}