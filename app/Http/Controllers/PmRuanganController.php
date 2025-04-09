<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\pm_Ruangan;
use App\Models\anggota;
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
        $validated = $request->validate([
            'code_peminjaman' => 'required',
            'tanggal_peminjaman' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_peminjaman' => 'required',
            'cover' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:1024',
        ]);

        $pm_ruangan = new pm_ruangan();
        $pm_ruangan->code_peminjaman = $request->code_peminjaman;
        $pm_ruangan->id_anggota = $request->id_anggota;
        $pm_ruangan->id_ruangan = $request->id_ruangan;
        $pm_ruangan->jenis_kegiatan = $request->jenis_kegiatan;
        $pm_ruangan->tanggal_peminjaman = $request->tanggal_peminjaman;
        $pm_ruangan->waktu_peminjaman = $request->waktu_peminjaman;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/pm_ruangan', $name);
            $pm_ruangan->cover = $name;
        }

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $pm_ruangan->save();

        return redirect()->route('pm_ruangan.index');
    }


    public function show(pm_ruangan $barang)
    {
        //
    }


    public function edit($id)
    {
        $anggota =  anggota::all();
        $ruangan =  Ruangan::all();
        $pm_ruangan = pm_ruangan::findOrFail($id);
        return view('pm_ruangan.edit', compact('pm_ruangan','anggota','ruangan'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code_peminjaman' => 'required',
            'tanggal_peminjaman' => 'required',
            'jenis_kegiatan' => 'required',
            'waktu_peminjaman' => 'required',
            'cover' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:1024',
        ]);

        $pm_ruangan = pm_ruangan::findOrFail($id);
        $pm_ruangan->code_peminjaman = $request->code_peminjaman;
        $pm_ruangan->id_anggota = $request->id_anggota;
        $pm_ruangan->id_ruangan = $request->id_ruangan;
        $pm_ruangan->jenis_kegiatan = $request->jenis_kegiatan;
        $pm_ruangan->tanggal_peminjaman = $request->tanggal_peminjaman;
        $pm_ruangan->waktu_peminjaman = $request->waktu_peminjaman;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/pm_ruangan', $name);
            $pm_ruangan->cover = $name;
        }

        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $pm_ruangan->save();
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
