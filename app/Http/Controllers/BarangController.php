<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;

use Storage;
use Illuminate\Http\Request;

class BarangController extends Controller
{

    public function index()
    {
        $barang =  Barang::all();
        confirmDelete('Delete','Are you sure?');
        return view('barang.index', compact('barang'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('barang.create', compact('kategori'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_barang' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'detail' => 'required',
            'jumlah' => 'required',

        ]);

        $barang = new barang();
        $barang->code_barang = $request->code_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->id_kategori = $request->id_kategori;
        $barang->detail = $request->detail;
        $barang->jumlah = $request->jumlah;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $barang->save();

        return redirect()->route('barang.index');
    }


    public function show(barang $barang)
    {
        //
    }


    public function edit($id)
    {
        $kategori = Kategori::all();
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang', 'kategori'));
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code_barang' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'detail' => 'required',
            'jumlah' => 'required',

        ]);

        $barang = Barang::findOrFail($id);
        $barang->code_barang = $request->code_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->id_kategori = $request->id_kategori;
        $barang->detail = $request->detail;
        $barang->jumlah = $request->jumlah;

        Alert::success('Success','data berhasil dirubah')->autoClose(1000);
        $barang->save();

        return redirect()->route('barang.index');
    }


    public function destroy($id)
    {
        $barang = barang::findOrFail($id);
        $barang->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('barang.index');
    }
}
