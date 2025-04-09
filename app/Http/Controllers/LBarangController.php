<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use App\Models\pm_barang;
use App\Models\l_Barang;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class LBarangController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $l_barang =  l_barang::all();
        $pm_barang =  pm_barang::all();
        confirmDelete('Delete','Are you sure?');
        return view('l_barang.index', compact('l_barang','pm_barang'));
    }


    public function create()
    {
        $pm_barang =  pm_barang::all();
        $kondisi = Kondisi::all();
        return view('l_barang.create', compact('pm_barang', 'kondisi'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',

        ]);

        $l_barang = new l_barang();
        $l_barang->id_pm_barang = $request->id_pm_barang;
        $l_barang->id_kondisi = $request->id_kondisi;
        $l_barang->keterangan = $request->keterangan;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/l_barang', $name);
            $l_barang->cover = $name;
        }

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $l_barang->save();

        return redirect()->route('l_barang.index');
    }


    public function show(l_barang $barang)
    {
        //
    }


    public function edit($id)
    {
        $pm_barang =  pm_barang::all();
        $kondisi = Kondisi::all();
        $l_barang = l_barang::findOrFail($id);
        return view('l_barang.edit', compact('l_barang','pm_barang','kondisi'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'keterangan' => 'required',

        ]);

        $l_barang = l_barang::findOrFail($id);
        $l_barang->id_pm_barang = $request->id_pm_barang;
        $l_barang->id_kondisi = $request->id_kondisi;
        $l_barang->keterangan = $request->keterangan;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/l_barang', $name);
            $l_barang->cover = $name;
        }

        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $l_barang->save();
        return redirect()->route('l_barang.index');
    }


    public function destroy($id)
    {
        $l_barang = l_barang::findOrFail($id);
        $l_barang->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('l_barang.index');
    }
}
