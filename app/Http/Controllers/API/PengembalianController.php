<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\p_barang;
use App\Models\pm_barang;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index()
    {
        $data = p_barang::with('peminjaman')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Pengembalian Barang',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_peminjaman' => 'required',
            'nama_pengembali' => 'required',
            'tanggal_pengembalian' => 'required|date',
            'keterangan' => 'nullable',
        ]);

        $pm_barang = pm_barang::where('code_peminjaman', $request->code_peminjaman)
                        ->with('peminjaman_details.barang')
                        ->first();

        if (!$pm_barang) {
            return response()->json([
                'success' => false,
                'message' => 'Kode peminjaman tidak ditemukan',
            ], 404);
        }

        // Simpan data pengembalian
        $p_barang = p_barang::create([
            'code_peminjaman' => $request->code_peminjaman,
            'nama_pengembali' => $request->nama_pengembali,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'keterangan' => $request->keterangan,
        ]);

        // Kembalikan stok barang
        foreach ($pm_barang->peminjaman_details as $detail) {
            $barang = $detail->barang;
            if ($barang) {
                $barang->jumlah += $detail->jumlah_pinjam;
                $barang->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dikembalikan',
            'data' => $p_barang
        ]);
    }

    public function show($id)
    {
        $pengembalian = p_barang::where('code_peminjaman', $id)->first();

        if (!$pengembalian) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengembalian tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $pengembalian
        ]);
    }

    public function destroy($id)
    {
        $p_barang = p_barang::findOrFail($id);
        $p_barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengembalian dihapus'
        ]);
    }

    // Untuk menampilkan detail peminjaman berdasarkan kode
    public function getPeminjamanDetails($code_peminjaman)
    {
        $pm_barang = pm_barang::where('code_peminjaman', $code_peminjaman)
            ->with('peminjaman_details.barang')
            ->first();

        if (!$pm_barang) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'peminjaman_details' => $pm_barang->peminjaman_details->map(function ($detail) {
                return [
                    'nama_barang' => optional($detail->barang)->nama_barang ?? 'Barang tidak ditemukan',
                    'jumlah_pinjam' => $detail->jumlah_pinjam
                ];
            })
        ]);
    }
}
