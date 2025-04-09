<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Kondisi;
use App\Models\m_Ruangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class MRuanganController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $m_ruangan =  m_ruangan::all();
        confirmDelete('Delete','Are you sure?');
        return view('m_ruangan.index', compact('m_ruangan'));
        return view('lm_ruangan.index', compact('m_ruangan'));
    }


    public function create()
    {
        $ruangan =  Ruangan::all();
        $kondisi = Kondisi::all();
        return view('m_ruangan.create', compact('ruangan', 'kondisi'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_perbaikan' => 'required',
            'waktu_pengerjaan' => 'required',

        ]);

        $m_ruangan = new m_ruangan();
        $m_ruangan->id_ruangan = $request->id_ruangan;
        $m_ruangan->jenis_perbaikan = $request->jenis_perbaikan;
        $m_ruangan->waktu_pengerjaan = $request->waktu_pengerjaan;
        $m_ruangan->id_kondisi = $request->id_kondisi;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $m_ruangan->save();

        return redirect()->route('m_ruangan.index');
    }


    public function show(m_ruangan $ruangan)
    {
        //
    }


    public function edit($id)
    {
        $ruangan =  Ruangan::all();
        $kondisi = Kondisi::all();
        $m_ruangan = m_ruangan::findOrFail($id);
        return view('m_ruangan.edit', compact('m_ruangan','ruangan','kondisi'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jenis_perbaikan' => 'required',
            'waktu_pengerjaan' => 'required',

        ]);

        $m_ruangan = m_ruangan::findOrFail($id);
        $m_ruangan->id_ruangan = $request->id_ruangan;
        $m_ruangan->jenis_perbaikan = $request->jenis_perbaikan;
        $m_ruangan->waktu_pengerjaan = $request->waktu_pengerjaan;
        $m_ruangan->id_kondisi = $request->id_kondisi;


        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $m_ruangan->save();
        return redirect()->route('m_ruangan.index');
    }


    public function destroy($id)
    {
        $m_ruangan = m_ruangan::findOrFail($id);
        $m_ruangan->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('m_ruangan.index');
    }
}
