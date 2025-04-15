<?php

namespace App\Http\Controllers;

use App\Models\p_barang;
use App\Models\pm_barang;
use App\Models\peminjaman_detail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PBarangController extends Controller
{
    public function index()
{
    // Menampilkan list pengembalian ruangan yang telah dilakukan
    $p_barang = p_barang::with('pm_barang')->get(); // Hapus tanda kurung siku
    return view('p_barang.index', compact('p_barang'));
}

    public function create()
    {
        $pm_barang = pm_barang::all();
        return view('p_barang.create', compact('pm_barang'));
    }


    public function store(Request $request)
{
    // Validasi input dari form
    $validated = $request->validate([
        'id_pm_barang' => 'required|exists:pm__barangs,id',
        'tanggal_selesai' => 'required|date',
        'keterangan' => 'nullable|string',
    ]);

    // Ambil data peminjaman barang
    $pm_barang = pm_barang::findOrFail($request->id_pm_barang);

    // Perbaikan: gunakan nama kolom yang benar
    $tanggal_kembali = Carbon::parse($pm_barang->tanggal_pengembalian);
    $tanggal_selesai = Carbon::parse($request->tanggal_selesai);

    $denda = 0;

    // Denda karena kerusakan
    if ($request->keterangan && strpos(strtolower($request->keterangan), 'rusak') !== false) {
        $denda += 5000;
    }

    // Denda karena keterlambatan
    if ($tanggal_selesai->greaterThan($tanggal_kembali)) {
        $daysLate = $tanggal_kembali->diffInDays($tanggal_selesai);
        $denda += $daysLate * 10000;
    }

    // Simpan data pengembalian
    p_barang::create([
        'id_pm_barang' => $request->id_pm_barang,
        'tanggal_selesai' => $request->tanggal_selesai,
        'keterangan' => $request->keterangan,
    ]);

    // Contoh update status jika diperlukan
    
    $pm_barang->save();

    return redirect()->route('p_barang.index')->with('success', "Pengembalian berhasil dengan denda Rp. " . number_format($denda, 0, ',', '.'));
}

    public function show($id)
    {
        $pengembalian = p_barang::findOrFail($id);
        return view('pengembalian.show', compact('pengembalian'));
    }
}
