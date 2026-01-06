Judul Proyek	: “LabLoan – Inventory Sistem” 
Tujuan		: Membangun Sistem Sirkulasi Barang Lab Sederhana.

Deskripsi	:
Database Relasional: Kamu butuh minimal 3 tabel utama pada database, yaitu : users, items, dan loans

Inventori (Item) : Barang memiliki atribut nama, deskripsi, dan stok total.

Peminjaman :
User hanya bisa meminjam jika stok barang > 0
Saat dipinjam, stok barang di tabel items harus berkurang 1
Catat tanggal pinjam hari ini

4.	Pengembalian:
•	Saat dikembalikan, stok barang harus bertambah 1
•	Status peminjaman berubah menjadi ‘returned’

Tantangan	: Bagaimana cara menjamin data stok tetap akurat saat terjadi peminjaman dan pengembalian?
