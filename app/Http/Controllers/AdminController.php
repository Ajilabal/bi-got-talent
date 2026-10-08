<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lomba;           // Memanggil Model Lomba
use App\Models\Pendaftaran;     // Memanggil Model Pendaftaran
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //1.Menampilkan Halaman Dashboard Admin
    public function index()
     {
        return view('admin.dashboard'); 
    }
    //2. Halaman Khusus Lomba
    public function kelolaLomba()
    {
        //Ambil semua data lomba dari database
        $lombas = Lomba::all();
        return view('admin.kelola_lomba', compact('lombas'));
    }

    //3. Halaman Khusus Siswa
    public function kelolaSiswa()
    {
        // Ambil semua data user yang berstatus 'siswa'
        $siswas = User::where('role', 'siswa')->get();
        return view('admin.kelola_siswa', compact('siswas'));

    }

    //4. Halaman Khusus Status
    public function kelolaStatus()
    {
        // Ambil semua data pendaftaran beserta relasi lomba dan user
        $pendaftarans = Pendaftaran::with(['user', 'lomba'])->get();
        return view('admin.kelola_status', compact('pendaftarans'));
    }

    // --- BAGIAN PROSES DATA (CRUD LOMBA & STATUS) ---

     // Menyimpan Data Mata Lomba Baru (Create)
    public function storeLomba(Request $request)
    {
        // Simpan semua inputan dari form web ke tabel lomba
        Lomba::create($request->all());
        
        // Kembalikan admin ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Mata Lomba berhasil ditambahkan!');
    }

    // Mengubah Status Pendaftaran Siswa (Update)

    public function updateStatus(Request $request, $id)
    {
        // Cari data pendaftaran berdasarkan ID yang diklik
        
    }
}
