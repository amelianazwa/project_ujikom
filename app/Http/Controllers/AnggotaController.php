<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $anggota = anggota::all();
        confirmDelete('Delete','Are you sure?');
        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        $last = anggota::latest()->first();
        $nextNumber = $last ? ((int)substr($last->code_anggota, 3)) + 1 : 1;
        $code_anggota = 'AGT' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('anggota.create', compact('code_anggota'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_anggota' => 'required',
            'nama_peminjam' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'instansi_lembaga' => 'required',
        ]);

        $anggota = new anggota();
        $anggota->code_anggota = $request->code_anggota;
        $anggota->nama_peminjam = $request->nama_peminjam;
        $anggota->email = $request->email;
        $anggota->no_telepon = $request->no_telepon;
        $anggota->instansi_lembaga = $request->instansi_lembaga;
        $anggota->save();

        Alert::success('Success', 'Data berhasil disimpan')->autoClose(1000);
        return redirect()->route('anggota.index');
    }

    public function edit($id)
    {
        $anggota = anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code_anggota' => 'required',
            'nama_peminjam' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'instansi_lembaga' => 'required',
        ]);

        $anggota = anggota::findOrFail($id);
        $anggota->code_anggota = $request->code_anggota;
        $anggota->nama_peminjam = $request->nama_peminjam;
        $anggota->email = $request->email;
        $anggota->no_telepon = $request->no_telepon;
        $anggota->instansi_lembaga = $request->instansi_lembaga;
        $anggota->save();

        Alert::success('Success', 'Data berhasil diubah')->autoClose(1000);
        return redirect()->route('anggota.index');
    }

    public function destroy($id)
    {
        $anggota = anggota::findOrFail($id);
        $anggota->delete();
        Alert::success('Success','Data berhasil dihapus');
        return redirect()->route('anggota.index');
    }
}