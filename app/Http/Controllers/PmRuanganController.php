<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\pm_ruangan;
use App\Models\anggota;
use App\Models\PeminjamanDetailRuangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use PDF;

class PmRuanganController extends Controller
{
    public function viewPDF(Request $request)
    {
        $pm_ruangan = pm_ruangan::findOrFail($request->idPeminjaman);

        $data = [
            'title' => 'Data Produk',
            'date' => date('m/d/Y'),
            'pm_ruangan' => $pm_ruangan,
        ];

        $pdf = PDF::loadView('pm_ruangan.export-pdf', $data)
            ->setPaper('a4', 'portrait');
            return response($pdf->stream(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="document.pdf"');
   }

    public function viewRUANGAN(Request $request)
    {
        $pm_ruangan = pm_ruangan::findOrFail($request->idPeminjaman);

        $isi = [
            'date' => date('m/d/Y'),
            'pm_ruangan' => $pm_ruangan,

        ];

        $pdf = PDF::loadView('pm_ruangan.export-ruangan', $isi)
            ->setPaper('a4', 'portrait');
            return response($pdf->stream(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="document.pdf"');
  }

    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $pm_ruangan =  pm_ruangan::all();

        confirmDelete('Delete','Are you sure?');
        return view('pm_ruangan.index', compact('pm_ruangan'));
    }


    public function create()
    {
        $anggota =  anggota::all();
        $ruangan =  Ruangan::all();
        return view('pm_ruangan.create', compact('anggota','ruangan'));
    }


    public function store(Request $request)
{

    $pm_ruangan = new pm_ruangan();
    $pm_ruangan->code_peminjaman = $request->code_peminjaman;
    $pm_ruangan->id_anggota = $request->id_anggota;
    $pm_ruangan->jenis_kegiatan = $request->jenis_kegiatan;
    $pm_ruangan->tanggal_peminjaman = $request->tanggal_peminjaman;
    $pm_ruangan->waktu_peminjaman = $request->waktu_peminjaman;

    $pm_ruangan->save();

    // Simpan ke tabel detail ruangan
    foreach ($request->id_ruangan as $id_ruangan) {
        $detail = new PeminjamanDetailRuangan();
        $detail->id_pm_ruangan = $pm_ruangan->id;
        $detail->id_ruangan = $id_ruangan;
        $detail->save();
    }

    Alert::success('Success', 'Data berhasil disimpan')->autoClose(1000);
    return redirect()->route('pm_ruangan.index');
}


    public function show(pm_ruangan $barang)
    {
        //
    }


    public function edit($code_peminjaman)
{
    $pm_ruangan = pm_ruangan::where('code_peminjaman', $code_peminjaman)->first();
    if (!$pm_ruangan) {
        return redirect()->route('pm_ruangan.index')->with('error', 'Data peminjaman tidak ditemukan');
    }

    // Ambil detail ruangan yang dipinjam
    $details = PeminjamanDetailRuangan::where('id_pm_ruangan', $pm_ruangan->id)->get();
    $ruangan = Ruangan::all();
    $anggota = Anggota::all();

    return view('pm_ruangan.edit', compact('pm_ruangan', 'details', 'ruangan', 'anggota'));
}
    
public function update(Request $request, $code_peminjaman)
{
    $pm_ruangan = pm_ruangan::where('code_peminjaman', $code_peminjaman)->firstOrFail();
    
    // Hapus detail lama
    PeminjamanDetailRuangan::where('id_pm_ruangan', $pm_ruangan->id)->delete();
    
    // Update data peminjaman
    $pm_ruangan->update([
        'id_anggota' => $request->id_anggota,
        'jenis_kegiatan' => $request->jenis_kegiatan,
        'tanggal_peminjaman' => $request->tanggal_peminjaman,
        'waktu_peminjaman' => $request->waktu_peminjaman,
    ]);
    
    // Simpan detail ruangan baru
    foreach ($request->id_ruangan as $id_ruangan) {
        PeminjamanDetailRuangan::create([
            'id_pm_ruangan' => $pm_ruangan->id,
            'id_ruangan' => $id_ruangan,
        ]);
    }
    
    Alert::success('Success', 'Data berhasil diperbarui')->autoClose(1000);
    return redirect()->route('pm_ruangan.index');
}

    


    public function destroy($id)
    {
        $pm_ruangan = pm_ruangan::findOrFail($id);
        $pm_ruangan->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('pm_ruangan.index');
    }
}