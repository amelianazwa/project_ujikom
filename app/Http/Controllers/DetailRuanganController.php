<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Ruangan;
use App\Models\Detail_ruangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class DetailRuanganController extends Controller
{
    public function index()
    {
        $detail_ruangan =  detail_ruangan::all();
        confirmDelete('Delete','Are you sure?');
        return view('detail_ruangan.index', compact('detail_ruangan'));
    }


    public function create()
    {
        $barang =  Barang::all();
        $ruangan = Ruangan::all();
        return view('detail_ruangan.create', compact('barang', 'ruangan'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_maintenance' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);

        $detail_ruangan = new detail_ruangan();
        $detail_ruangan->code_maintenance = $request->code_maintenance;
        $detail_ruangan->id_barang = $request->id_barang;
        $detail_ruangan->id_ruangan = $request->id_ruangan;
        $detail_ruangan->kondisi = $request->kondisi;
        $detail_ruangan->keterangan = $request->keterangan;
        $detail_ruangan->jumlah = $request->jumlah;



        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $detail_ruangan->save();

        return redirect()->route('detail_ruangan.index');
    }


    public function show(detail_ruangan $detail_ruangan)
    {
        //
    }


    public function edit($id)
    {
        $barang =  Barang::all();
        $ruangan = Ruangan::all();
        $detail_ruangan = detail_ruangan::findOrFail($id);
        return view('detail_ruangan.edit', compact('detail_ruangan', 'barang', 'ruangan'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code_maintenance' => 'required',
            'kondisi' => 'required',
            'keterangan' => 'required',
            'jumlah' => 'required',
        ]);

        $detail_ruangan = detail_ruangan::findOrFail($id);
        $detail_ruangan->code_maintenance = $request->code_maintenance;
        $detail_ruangan->id_barang = $request->id_barang;
        $detail_ruangan->id_ruangan = $request->id_ruangan;
        $detail_ruangan->kondisi = $request->kondisi;
        $detail_ruangan->keterangan = $request->keterangan;
        $detail_ruangan->jumlah = $request->jumlah;


        Alert::success('Success','data berhasil dirubah')->autoClose(1000);
        $detail_ruangan->save();

        return redirect()->route('detail_ruangan.index');
    }


    public function destroy($id)
    {
        $detail_ruangan = detail_ruangan::findOrFail($id);
        $detail_ruangan->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('detail_ruangan.index');
    }
}
