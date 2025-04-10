<?php

namespace App\Http\Controllers;

use App\Models\p_barang;
use App\Models\pm_barang;
use App\Models\peminjaman_detail;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PBarangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $p_barang = p_barang::all();
        return view('p_barang.index', compact('p_barang'));
    }

    public function create()
    {
        $pm_barang = pm_barang::all();
        return view('p_barang.create', compact('pm_barang'));
    }

    public function store(Request $request)
    {
        // Simpan data pengembalian barang
        $p_barang = new p_barang();
        $p_barang->code_peminjaman = $request->code_peminjaman;
        $p_barang->nama_pengembali = $request->nama_pengembali;
        $p_barang->tanggal_pengembalian = $request->tanggal_pengembalian;
        $p_barang->keterangan = $request->keterangan;
        $p_barang->save();

        // Ambil data peminjaman berdasarkan kode peminjaman
        $pm_barang = pm_barang::where('code_peminjaman', $request->code_peminjaman)->first();

        if ($pm_barang) {
            foreach ($pm_barang->peminjaman_details as $detail) {
                $barang = $detail->barang;
                if ($barang) {
                    $barang->jumlah += $detail->jumlah_pinjam;
                    $barang->save();
                }
            }
        }

        Alert::success('Success', 'Barang berhasil dikembalikan')->autoClose(1000);
        return redirect()->route('p_barang.index');
    }

    public function edit($id)
    {
        $p_barang = p_barang::findOrFail($id);
        return view('p_barang.edit', compact('p_barang'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_pengembali' => 'required',
            'tanggal_pengembalian' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $p_barang = p_barang::findOrFail($id);
        $p_barang->nama_pengembali = $request->nama_pengembali;
        $p_barang->tanggal_pengembalian = $request->tanggal_pengembalian;
        $p_barang->keterangan = $request->keterangan;
        $p_barang->save();

        Alert::success('Success', 'Data pengembalian diperbarui')->autoClose(1000);
        return redirect()->route('p_barang.index');
    }

    public function destroy($id)
    {
        $p_barang = p_barang::findOrFail($id);
        $p_barang->delete();
        Alert::success('Success', 'Data pengembalian dihapus');
        return redirect()->route('p_barang.index');
    }

    // ✅ Tambahan fungsi getPeminjamanDetails
    public function getPeminjamanDetails($code_peminjaman)
    {
        $pm_barang = pm_barang::where('code_peminjaman', $code_peminjaman)
                    ->with('peminjaman_details.barang') // Pastikan relasi barang di-load
                    ->first();

        if (!$pm_barang) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'peminjaman_details' => $pm_barang->peminjaman_details->map(function ($detail) {
                return [
                    'nama_barang' => optional($detail->barang)->nama_barang ?? 'Barang tidak ditemukan',
                    'jumlah_pinjam' => $detail->jumlah_pinjam
                ];
            })
        ]);
    }
}
