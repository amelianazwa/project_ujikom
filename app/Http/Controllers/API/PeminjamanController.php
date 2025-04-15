<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\pm_barang;
use App\Models\peminjaman_detail;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $data = pm_barang::with(['anggota', 'ruangan', 'peminjaman_details.barang'])->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar Peminjaman Barang',
            'data' => $data
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kegiatan' => 'required',
            'id_barang' => 'required|array',
            'jumlah_pinjam' => 'required|array',
            'jumlah_pinjam.*' => 'integer|min:1',
            'tanggal_peminjaman' => 'required|date',
            'waktu_peminjaman' => 'required',
        ]);

        $codePeminjaman = 'PM-' . date('Ymd') . '-' . mt_rand(1000, 9999);

        $pm_barang = pm_barang::create([
            'code_peminjaman' => $codePeminjaman,
            'id_anggota' => $request->id_anggota,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'id_ruangan' => $request->id_ruangan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'waktu_peminjaman' => $request->waktu_peminjaman,
        ]);

        foreach ($request->id_barang as $index => $id_barang) {
            $barang = Barang::findOrFail($id_barang);

            if ($barang->jumlah < $request->jumlah_pinjam[$index]) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok barang tidak mencukupi',
                ], 400);
            }

            $barang->jumlah -= $request->jumlah_pinjam[$index];
            $barang->save();

            peminjaman_detail::create([
                'id_pm_barang' => $pm_barang->id,
                'id_barang' => $id_barang,
                'jumlah_pinjam' => $request->jumlah_pinjam[$index],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil ditambahkan',
            'data' => $pm_barang->load('peminjaman_details')
        ]);
    }

    public function show($id)
    {
        $pm_barang = pm_barang::with(['anggota', 'ruangan', 'peminjaman_details.barang'])->where('code_peminjaman', $id)->first();

        if (!$pm_barang) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'data' => $pm_barang]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_kegiatan' => 'required',
            'id_barang' => 'required|array',
            'jumlah_pinjam' => 'required|array',
            'jumlah_pinjam.*' => 'integer|min:1',
            'tanggal_peminjaman' => 'required|date',
            'waktu_peminjaman' => 'required',
        ]);

        $pm_barang = pm_barang::where('code_peminjaman', $id)->firstOrFail();

        foreach ($pm_barang->peminjaman_details as $detail) {
            $barang = Barang::findOrFail($detail->id_barang);
            $barang->jumlah += $detail->jumlah_pinjam;
            $barang->save();
        }

        peminjaman_detail::where('id_pm_barang', $pm_barang->id)->delete();

        $pm_barang->update([
            'id_anggota' => $request->id_anggota,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'id_ruangan' => $request->id_ruangan,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'waktu_peminjaman' => $request->waktu_peminjaman,
        ]);

        foreach ($request->id_barang as $index => $id_barang) {
            $barang = Barang::findOrFail($id_barang);

            if ($barang->jumlah < $request->jumlah_pinjam[$index]) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stok barang tidak mencukupi',
                ], 400);
            }

            $barang->jumlah -= $request->jumlah_pinjam[$index];
            $barang->save();

            peminjaman_detail::create([
                'id_pm_barang' => $pm_barang->id,
                'id_barang' => $id_barang,
                'jumlah_pinjam' => $request->jumlah_pinjam[$index],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Peminjaman berhasil diperbarui',
            'data' => $pm_barang->load('peminjaman_details')
        ]);
    }

    public function destroy($id)
    {
        $pm_barang = pm_barang::findOrFail($id);

        foreach ($pm_barang->peminjaman_details as $detail) {
            $barang = Barang::findOrFail($detail->id_barang);
            $barang->jumlah += $detail->jumlah_pinjam;
            $barang->save();
        }

        peminjaman_detail::where('id_pm_barang', $pm_barang->id)->delete();
        $pm_barang->delete();

        return response()->json(['success' => true, 'message' => 'Peminjaman berhasil dihapus']);
    }
}