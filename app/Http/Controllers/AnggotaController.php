<?php

namespace App\Http\Controllers;

use App\Models\anggota;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $anggota = anggota::all();
        confirmDelete('Delete','Are you sure?');
        return view('anggota.index', compact('anggota'));
    }


    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_anggota' => 'required',
            'nama_peminjam' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'instansi_lembaga' => 'required',

        ]);

        $anggota = new anggota();
        $anggota->code_anggota = $request->code_anggota;
        $anggota->nama_peminjam = $request->nama_peminjam;
        $anggota->email = $request->email;
        $anggota->no_telepon = $request->no_telepon;
        $anggota->instansi_lembaga = $request->instansi_lembaga;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $anggota->save();

        return redirect()->route('anggota.index');
    }

    public function show(anggota $anggota)
    {
        //
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
            'email' => 'required',
            'no_telepon' => 'required',
            'instansi_lembaga' => 'required',

        ]);

        $anggota = anggota::findOrFail($id);
        $anggota->code_anggota = $request->code_anggota;
        $anggota->nama_peminjam = $request->nama_peminjam;
        $anggota->email = $request->email;
        $anggota->no_telepon = $request->no_telepon;
        $anggota->instansi_lembaga = $request->instansi_lembaga;


        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $anggota->save();
        return redirect()->route('anggota.index');
    }
    public function destroy($id)
    {
        $anggota = anggota::findOrFail($id);
        $anggota->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('anggota.index');
    }
}