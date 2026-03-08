<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Menampilkan daftar mahasiswa (Read)
     */
    public function index() 
    {
        // Mengambil semua data dari tabel mahasiswas
        $mahasiswas = Mahasiswa::all(); 
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    /**
     * Menampilkan form tambah mahasiswa (Create)
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Menyimpan data mahasiswa ke database (Store)
     */
    public function store(Request $request) 
    {     
        // 1. Validasi data: NIM harus unik, Nama, Kelas, dan MK wajib diisi
        $request->validate([
            'nim'        => 'required|unique:mahasiswas,nim|max:15',
            'nama'       => 'required|max:255',
            'kelas'      => 'required|max:50',
            'matakuliah' => 'required', 
        ]);

        // 2. Mengambil semua data input dari form
        $data = $request->all();

        // 3. Tambahkan user_id otomatis jika Anda menggunakan sistem Login
        if (auth()->check()) {
            $data['user_id'] = auth()->id();
        }

        // 4. Simpan ke database menggunakan Eloquent
        Mahasiswa::create($data);     
        
        // 5. Kembali ke halaman utama dengan pesan sukses
        return redirect()->route('mahasiswa.index')->with('msg', 'Data mahasiswa berhasil disimpan!'); 
    }

    /**
     * Menampilkan form untuk mengubah data (Edit)
     */
    public function edit($nim)
    {
        // Mencari data mahasiswa berdasarkan NIM (Primary Key)
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Menyimpan perubahan data ke database (Update)
     */
    public function update(Request $request, $nim)
    {
        // 1. Validasi data yang diubah
        $request->validate([
            'nama'       => 'required|max:255',
            'kelas'      => 'required|max:50',
            'matakuliah' => 'required',
        ]);

        // 2. Cari data berdasarkan NIM dan perbarui
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->update($request->all());

        // 3. Kembali ke halaman utama dengan pesan sukses
        return redirect()->route('mahasiswa.index')->with('msg', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data mahasiswa (Delete)
     */
    public function destroy($nim)
    {
        // Mencari data berdasarkan NIM, jika tidak ada akan muncul error 404
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('msg', 'Data berhasil dihapus!');
    }
}