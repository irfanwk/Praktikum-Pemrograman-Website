<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /**
     * TODO 1: Implementasi fungsi index()
     * 
     * Fungsi ini untuk menampilkan SEMUA data menu beserta data restoran pemiliknya.
     * 
     * Langkah-langkah:
     * 1. Ambil semua data menu dari database menggunakan Menu::with('restoran')->get()
     *    - with('restoran') digunakan untuk Eager Loading agar data restoran ikut terambil
     * 2. Return response JSON dengan struktur:
     *    {
     *        "success": true,
     *        "data": [...]
     *    }
     * 
     * Hint: Gunakan return response()->json([...]);
     */
    public function index()
    {
        // TODO: Tulis kode di sini
        $menus = Menu::with('restoran')->get();
        
        return response()->json([
            'success' => true,
            'data' => $menus
        ]);
    }

    /**
     * TODO 2: Implementasi fungsi store()
     * 
     * Fungsi ini untuk menambahkan data menu baru ke database.
     * 
     * Langkah-langkah:
     * 1. Validasi input menggunakan $request->validate([...])
     *    Field yang harus divalidasi:
     *    - restoran_id: required, exists:restorans,id (cek apakah restoran_id ada di tabel restorans)
     *    - nama: required, string, max:255
     *    - harga: required, integer
     *    - jumlah: required, integer
     * 
     * 2. Simpan data ke database:
     *    $menu = Menu::create($request->all());
     * 
     * 3. Load relasi restoran:
     *    $menu->load('restoran');
     * 
     * 4. Return response JSON dengan status code 201 (Created):
     *    return response()->json([...], 201);
     */
    public function store(Request $request)
    {
        // TODO: Tulis kode validasi di sini
        $validatedData = $request->validate([
            'restoran_id' => 'required|exists:restorans,id',
            'nama' => 'required|string|max:255',
            'harga' => 'required|integer',
            'jumlah' => 'required|integer'
        ]);

        // TODO: Tulis kode untuk menyimpan data di sini
        $menu = Menu::create($validatedData);
        $menu->load('restoran');

        // TODO: Tulis kode return response di sini
        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil ditambahkan',
            'data' => $menu
        ], 201);
    }

    /**
     * TODO 3: Implementasi fungsi show()
     * 
     * Fungsi ini untuk menampilkan detail SATU menu berdasarkan ID.
     * 
     * Langkah-langkah:
     * 1. Cari menu berdasarkan ID dan load relasi restoran
     *    $menu = Menu::with('restoran')->find($id);
     * 
     * 2. Cek apakah menu ditemukan:
     *    if (!$menu) {
     *        return response()->json(['success' => false, 'message' => 'Menu tidak ditemukan'], 404);
     *    }
     * 
     * 3. Return response JSON berisi data menu
     */
    public function show($id)
    {
        // TODO: Tulis kode di sini
        $menu = Menu::with('restoran')->find($id);

        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $menu
        ]);
    }

    /**
     * TODO 4: Implementasi fungsi update()
     * 
     * Fungsi ini untuk mengupdate data menu yang sudah ada.
     * 
     * Langkah-langkah:
     * 1. Cari menu berdasarkan ID
     *    $menu = Menu::find($id);
     * 
     * 2. Cek apakah menu ditemukan (sama seperti show)
     * 
     * 3. Validasi input (sama seperti store, tapi semua field optional)
     *    Hint: Gunakan 'nullable' atau 'sometimes' untuk validasi
     * 
     * 4. Update data:
     *    $menu->update($request->all());
     * 
     * 5. Load ulang relasi restoran:
     *    $menu->load('restoran');
     * 
     * 6. Return response JSON
     */
    public function update(Request $request, $id)
    {
        // TODO: Cari menu
        $menu = Menu::find($id);

        // TODO: Cek apakah menu ditemukan
        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        // TODO: Validasi input
        $validatedData = $request->validate([
            'restoran_id' => 'sometimes|required|exists:restorans,id',
            'nama' => 'sometimes|required|string|max:255',
            'harga' => 'sometimes|required|integer',
            'jumlah' => 'sometimes|required|integer'
        ]);

        // TODO: Update data
        $menu->update($validatedData);
        $menu->load('restoran');

        // TODO: Return response
        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil diupdate',
            'data' => $menu
        ]);
    }

    /**
     * TODO 5: Implementasi fungsi destroy()
     * 
     * Fungsi ini untuk menghapus data menu dari database.
     * 
     * Langkah-langkah:
     * 1. Cari menu berdasarkan ID
     * 2. Cek apakah menu ditemukan
     * 3. Hapus menu menggunakan $menu->delete();
     * 4. Return response JSON dengan message sukses
     */
    public function destroy($id)
    {
        // TODO: Tulis kode di sini
        $menu = Menu::find($id);

        if (!$menu) {
            return response()->json([
                'success' => false,
                'message' => 'Menu tidak ditemukan'
            ], 404);
        }

        $menu->delete();

        return response()->json([
            'success' => true,
            'message' => 'Menu berhasil dihapus'
        ]);
    }
}
