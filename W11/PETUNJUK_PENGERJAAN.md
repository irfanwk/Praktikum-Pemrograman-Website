# 📚 PETUNJUK PENGERJAAN PRAKTIKUM
# Sistem Manajemen Menu Restoran (RestoAPI)

---

## 🎯 Tujuan Pembelajaran
Membuat REST API dengan dua tabel yang berelasi (One-to-Many) menggunakan Laravel.

---

## 📋 CHECKLIST PENGERJAAN

### ✅ LANGKAH 1: Setup Database
1. Buka file `.env` di root project
2. Sesuaikan konfigurasi database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database_anda
   DB_USERNAME=root
   DB_PASSWORD=
   ```
3. Buat database baru di phpMyAdmin/MySQL dengan nama yang sama dengan `DB_DATABASE`

---

### ✅ LANGKAH 2: Jalankan Migration
Migration sudah disediakan di folder `database/migrations/`:
- `2024_01_01_000001_create_restorans_table.php`
- `2024_01_01_000002_create_menus_table.php`

**Cara menjalankan:**
```bash
php artisan migrate
```

**Catatan:** Jika ada error "Nothing to migrate", pastikan database sudah dibuat dan konfigurasi `.env` sudah benar.

---

### ✅ LANGKAH 3: Jalankan Seeder (Isi Data Restoran)
Seeder sudah disediakan untuk mengisi data restoran awal di `database/seeders/RestoranSeeder.php`

**Cara menjalankan:**
```bash
php artisan db:seed --class=RestoranSeeder
```

Atau jalankan semua seeder:
```bash
php artisan db:seed
```

**Hasil:** Akan ada 3 data restoran di database yang siap digunakan untuk testing.

---

### ✅ LANGKAH 4: Pahami Struktur File yang Sudah Disediakan

#### 📁 **Models** (app/Models/)
- ✅ `Restoran.php` - Model untuk tabel restorans (SUDAH LENGKAP)
- ✅ `Menu.php` - Model untuk tabel menus (SUDAH LENGKAP)

**Yang perlu dipahami:**
- Relasi `hasMany()` di Model Restoran
- Relasi `belongsTo()` di Model Menu
- Properti `$fillable` untuk mass assignment

---

#### 📁 **Migrations** (database/migrations/)
- ✅ `2024_01_01_000001_create_restorans_table.php` (SUDAH LENGKAP)
- ✅ `2024_01_01_000002_create_menus_table.php` (SUDAH LENGKAP)

**Yang perlu dipahami:**
- Struktur kolom tabel
- Foreign key dengan `onDelete('cascade')`
- Cascade delete: jika restoran dihapus, menu ikut terhapus

---

#### 📁 **Controller** (app/Http/Controllers/)
- ✅ `MenuController.php` (SUDAH LENGKAP DENGAN KOMENTAR TODO)

**Fungsi yang sudah dibuat:**
1. `index()` - Menampilkan semua menu + data restoran
2. `store()` - Menambah menu baru
3. `show($id)` - Menampilkan 1 menu berdasarkan ID
4. `update($id)` - Update data menu
5. `destroy($id)` - Hapus menu

**Catatan:** Semua fungsi sudah lengkap dengan kode dan komentar penjelasan!

---

#### 📁 **Routes** (routes/api.php)
- ✅ `api.php` (SUDAH LENGKAP)

**Route yang sudah didaftarkan:**
| Method | Endpoint | Fungsi |
|--------|----------|--------|
| GET | /api/menus | Tampil semua menu |
| GET | /api/menus/{id} | Tampil 1 menu |
| POST | /api/menus | Tambah menu baru |
| PUT | /api/menus/{id} | Update menu |
| DELETE | /api/menus/{id} | Hapus menu |

---

### ✅ LANGKAH 5: Jalankan Server Laravel
```bash
php artisan serve
```

**PENTING:** Jangan tutup terminal ini selama testing API!

---

### ✅ LANGKAH 6: Testing API dengan Postman

#### 🔹 1. Test GET All Menus
- Method: `GET`
- URL: `http://localhost:8000/api/menus`
- Klik **Send**

**Expected Response:**
```json
{
    "success": true,
    "data": []
}
```
(Kosong karena belum ada data menu)

---

#### 🔹 2. Test POST - Tambah Menu Baru
- Method: `POST`
- URL: `http://localhost:8000/api/menus`
- Body: Pilih **raw** dan **JSON**

**JSON Body:**
```json
{
    "restoran_id": 1,
    "nama": "Ayam Bakar Madu",
    "harga": 25000,
    "jumlah": 50
}
```

**Expected Response:**
```json
{
    "success": true,
    "message": "Menu berhasil ditambahkan",
    "data": {
        "id": 1,
        "restoran_id": 1,
        "nama": "Ayam Bakar Madu",
        "harga": 25000,
        "jumlah": 50,
        "created_at": "...",
        "updated_at": "...",
        "restoran": {
            "id": 1,
            "nama": "Restoran Padang Sederhana",
            "email": "padang@example.com",
            "alamat": "Jl. Sudirman No. 123, Jakarta",
            "no_telp": "081234567890"
        }
    }
}
```

---

#### 🔹 3. Test GET Single Menu
- Method: `GET`
- URL: `http://localhost:8000/api/menus/1`
- Klik **Send**

**Expected Response:** Detail 1 menu beserta data restorannya

---

#### 🔹 4. Test PUT - Update Menu
- Method: `PUT`
- URL: `http://localhost:8000/api/menus/1`
- Body: **raw** dan **JSON**

**JSON Body:**
```json
{
    "harga": 30000,
    "jumlah": 40
}
```

**Expected Response:** Data menu ter-update

---

#### 🔹 5. Test DELETE - Hapus Menu
- Method: `DELETE`
- URL: `http://localhost:8000/api/menus/1`
- Klik **Send**

**Expected Response:**
```json
{
    "success": true,
    "message": "Menu berhasil dihapus"
}
```

---

## 🎓 TUGAS TAMBAHAN (OPTIONAL)

Jika sudah selesai testing dasar, coba tantangan berikut:

### 1. Buat API untuk Restoran
Buat `RestoranController` dengan endpoint:
- GET `/api/restorans` - List semua restoran
- GET `/api/restorans/{id}` - Detail 1 restoran **beserta semua menunya**
- POST `/api/restorans` - Tambah restoran baru
- PUT `/api/restorans/{id}` - Update restoran
- DELETE `/api/restorans/{id}` - Hapus restoran

**Hint:** Gunakan eager loading: `Restoran::with('menus')->get()`

---

### 2. Validasi Custom
Tambahkan validasi di `MenuController`:
- Harga minimal 1000
- Jumlah stok minimal 1
- Nama menu minimal 3 karakter

**Contoh:**
```php
$request->validate([
    'harga' => 'required|integer|min:1000',
    'jumlah' => 'required|integer|min:1',
    'nama' => 'required|string|min:3|max:255'
]);
```

---

### 3. Soft Delete
Implementasi soft delete pada Menu:
- Tambahkan kolom `deleted_at` di migration
- Gunakan trait `SoftDeletes` di Model Menu
- Menu yang dihapus tidak benar-benar hilang, hanya di-mark sebagai deleted

---

## 🔍 TROUBLESHOOTING

### ❌ Error: "SQLSTATE[HY000] [1049] Unknown database"
**Solusi:** Database belum dibuat. Buat database di phpMyAdmin dengan nama sesuai `.env`

### ❌ Error: "Class 'App\Models\Menu' not found"
**Solusi:** 
```bash
composer dump-autoload
```

### ❌ Error: "Route [api/menus] not defined"
**Solusi:** Cek apakah route sudah didaftarkan di `routes/api.php`

### ❌ Error: "SQLSTATE[23000]: Integrity constraint violation"
**Solusi:** `restoran_id` yang diinput tidak ada di tabel restorans. Pastikan menggunakan ID yang valid.

### ❌ Postman menampilkan HTML instead of JSON
**Solusi:** 
- Pastikan URL menggunakan `/api/menus` (bukan `/menus`)
- Cek apakah server Laravel masih running

---

## 📝 KRITERIA PENILAIAN

- ✅ Migration berhasil dijalankan (Tabel terbuat)
- ✅ Seeder berhasil (Ada data restoran)
- ✅ GET All Menus berfungsi
- ✅ POST Menu berfungsi (Data ter-insert ke database)
- ✅ GET Single Menu berfungsi
- ✅ PUT Update Menu berfungsi
- ✅ DELETE Menu berfungsi
- ✅ Relasi One-to-Many berfungsi (Menu menampilkan data restoran)
- ✅ Validasi input berfungsi (Coba kirim data kosong/invalid)
- ✅ Error handling berfungsi (404 saat menu tidak ditemukan)

---


**Selamat Mengerjakan! 🚀**
