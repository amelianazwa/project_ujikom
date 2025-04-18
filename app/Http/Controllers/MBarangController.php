<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\m_Barang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class MBarangController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $m_barang =  m_barang::all();
        confirmDelete('Delete','Are you sure?');
        return view('m_barang.index', compact('m_barang'));
        return view('lm_barang.index', compact('m_barang'));
    }


    public function create()
    {
        $barang =  Barang::all();
        $ruangan =  Ruangan::all();
        return view('m_barang.create', compact('barang','ruangan'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_maintenance' => 'required',
            'tanggal_maintenance' => 'required',
            'waktu_pengerjaan' => 'required',
            'keterangan' => 'required',



        ]);

        $m_barang = new m_barang();
        $m_barang->code_maintenance = $request->code_maintenance;
        $m_barang->id_barang = $request->id_barang;
        $m_barang->id_ruangan = $request->id_ruangan;
        $m_barang->tanggal_maintenance = $request->tanggal_maintenance;
        $m_barang->waktu_pengerjaan = $request->waktu_pengerjaan;
        $m_barang->jumlah = $request->jumlah;
        $m_barang->keterangan = $request->keterangan;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $m_barang->save();

        return redirect()->route('m_barang.index');
    }


    public function show(m_barang $ruangan)
    {
        //
    }


    public function edit($id)
    {
        $ruangan =  Ruangan::all();
        $m_barang = m_barang::findOrFail($id);
        return view('m_barang.edit', compact('m_barang','ruangan'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code_maintenance' => 'required',
            'tanggal_maintenance' => 'required',
            'waktu_pengerjaan' => 'required',
            'keterangan' => 'required',


        ]);

        $m_barang = m_barang::findOrFail($id);
         $m_barang->code_maintenance = $request->code_maintenance;
        $m_barang->id_ruangan = $request->id_ruangan;
        $m_barang->tanggal_maintenance = $request->tanggal_maintenance;
        $m_barang->waktu_pengerjaan = $request->waktu_pengerjaan;
        $m_barang->keterangan = $request->keterangan;


        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $m_barang->save();
        return redirect()->route('m_barang.index');
    }


    public function destroy($id)
    {
        $m_barang = m_barang::findOrFail($id);
        $m_barang->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('m_barang.index');
    }
}