# 🚀 QUICK START GUIDE - RestoAPI Project

## Untuk Dosen/Asisten

Project ini sudah siap untuk dibagikan ke praktikan dalam bentuk ZIP file.

### 📦 Yang Sudah Disiapkan:

1. ✅ **Models** (Lengkap dengan relasi dan komentar)
   - `app/Models/Restoran.php`
   - `app/Models/Menu.php`

2. ✅ **Migrations** (Lengkap dengan struktur tabel)
   - `database/migrations/2024_01_01_000001_create_restorans_table.php`
   - `database/migrations/2024_01_01_000002_create_menus_table.php`

3. ✅ **Controller** (Lengkap dengan semua fungsi CRUD + komentar penjelasan)
   - `app/Http/Controllers/MenuController.php`

4. ✅ **Routes** (Lengkap dengan semua endpoint)
   - `routes/api.php`

5. ✅ **Seeder** (Data dummy untuk restoran)
   - `database/seeders/RestoranSeeder.php`
   - `database/seeders/DatabaseSeeder.php`

6. ✅ **Dokumentasi Lengkap**
   - `PETUNJUK_PENGERJAAN.md` - Panduan step-by-step untuk praktikan
   - `TakeHomeTask.md` - Soal praktikum original

---

## 📋 Instruksi untuk Praktikan

Praktikan hanya perlu mengikuti langkah-langkah di file **PETUNJUK_PENGERJAAN.md**:

1. Setup database di `.env`
2. Jalankan migration: `php artisan migrate`
3. Jalankan seeder: `php artisan db:seed`
4. Jalankan server: `php artisan serve`
5. Testing dengan Postman

---

## 🎯 Tujuan Pembelajaran

Praktikan akan belajar:
- ✅ Membuat relasi One-to-Many di Laravel
- ✅ Memahami konsep Model dan Migration
- ✅ Membuat REST API CRUD lengkap
- ✅ Validasi input data
- ✅ Error handling (404, validation errors)
- ✅ Eager Loading dengan `with()`
- ✅ Testing API dengan Postman

---

## 📁 Cara Distribusi ke Praktikan

### Opsi 1: ZIP File (Recommended)
1. Delete folder berikut sebelum di-zip:
   - `vendor/` (besar, akan di-install ulang via composer)
   - `node_modules/` (jika ada)
   - `.env` (praktikan harus setup sendiri)
   
2. Zip project ini

3. Instruksikan praktikan untuk:
   ```bash
   # Extract ZIP
   # Masuk ke folder project
   cd week11
   
   # Install dependencies
   composer install
   
   # Copy .env
   cp .env.example .env
   
   # Generate APP_KEY
   php artisan key:generate
   
   # Setup database di .env
   # Lalu jalankan migration & seeder
   php artisan migrate
   php artisan db:seed
   ```

### Opsi 2: Git Repository
Push project ini ke Git dan share link ke praktikan.

---

## ⚙️ Konfigurasi yang Perlu Disesuaikan Praktikan

### File `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=week11_resto  # Praktikan ubah sesuai kebutuhan
DB_USERNAME=root
DB_PASSWORD=              # Sesuaikan dengan setup masing-masing
```

---

## 🧪 Testing Checklist

Pastikan semua endpoint bekerja:

- [ ] GET `/api/menus` - List semua menu
- [ ] GET `/api/menus/1` - Detail 1 menu
- [ ] POST `/api/menus` - Tambah menu baru
- [ ] PUT `/api/menus/1` - Update menu
- [ ] DELETE `/api/menus/1` - Hapus menu

---

## 📝 Catatan Tambahan

### Kode Sudah Lengkap
Semua file sudah berisi kode yang lengkap dan berfungsi. Praktikan tinggal:
1. Memahami kode yang sudah ada
2. Setup database
3. Testing dengan Postman

### TODO Comments
Meskipun kode sudah lengkap, ada komentar `TODO` untuk:
- Membantu praktikan memahami bagian-bagian penting
- Memberikan konteks tentang apa yang dilakukan setiap bagian kode
- Sebagai panduan belajar

### Tantangan Tambahan
Untuk praktikan yang cepat selesai, ada tugas tambahan di `PETUNJUK_PENGERJAAN.md`:
- Buat API untuk Restoran
- Implementasi validasi custom
- Implementasi soft delete

---

## 🆘 FAQ & Troubleshooting

Semua troubleshooting umum sudah dijelaskan di `PETUNJUK_PENGERJAAN.md`.

---

**Project siap digunakan!** 🎉

Selamat mengajar! 👨‍🏫👩‍🏫
