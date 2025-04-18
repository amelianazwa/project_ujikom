<?php

namespace App\Http\Controllers;

use App\Models\p_ruangan;
use App\Models\pm_ruangan;
use App\Models\peminjamandetailruangan;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PRuanganController extends Controller
{
    public function index()
{
    // Menampilkan list pengembalian ruangan yang telah dilakukan
    $p_ruangan = p_ruangan::with('pm_ruangan')->get(); // Hapus tanda kurung siku
    return view('p_ruangan.index', compact('p_ruangan'));
}

    public function create()
    {
        $pm_ruangan = pm_ruangan::all();
        return view('p_ruangan.create', compact('pm_ruangan'));
    }


    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'id_pm_ruangan' => 'required|exists:pm__ruangans,id',
            'tanggal_selesai' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        // Ambil data peminjaman ruangan
        $pm_ruangan = pm_ruangan::findOrFail($request->id_pm_ruangan);

        $tanggal_kembali = Carbon::parse($pm_ruangan->tanggal_pengembalian);
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
        p_ruangan::create([
            'id_pm_ruangan' => $request->id_pm_ruangan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'keterangan' => $request->keterangan,
        ]);

        // Ambil semua ruangan yang dipinjam dan ubah statusnya jadi "Tersedia"
        $detailRuangan = peminjamandetailruangan::where('id_pm_ruangan', $pm_ruangan->id)->get();

        foreach ($detailRuangan as $detail) {
            $ruangan = Ruangan::find($detail->id_ruangan);
            if ($ruangan) {
                $ruangan->status = 'Tersedia';
                $ruangan->save();
            }
        }

        return redirect()->route('p_ruangan.index')->with('success', "Pengembalian berhasil dengan denda Rp. " . number_format($denda, 0, ',', '.'));
    }


    public function show($id)
    {
        $pengembalian = p_ruangan::findOrFail($id);
        return view('pengembalian.show', compact('pengembalian'));
    }
}
