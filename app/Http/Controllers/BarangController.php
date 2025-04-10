<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        confirmDelete('Delete', 'Are you sure?');
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        // Auto generate kode barang
        $last = Barang::latest()->first();
        $nextNumber = $last ? ((int)substr($last->code_barang, 3)) + 1 : 1;
        $code_barang = 'BRG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return view('barang.create', compact('kategori', 'code_barang'));
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

        $barang = new Barang();
        $barang->code_barang = $request->code_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->merk = $request->merk;
        $barang->id_kategori = $request->id_kategori;
        $barang->detail = $request->detail;
        $barang->jumlah = $request->jumlah;
        $barang->save();

        Alert::success('Success', 'Data berhasil disimpan')->autoClose(1000);
        return redirect()->route('barang.index');
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
        $barang->save();

        Alert::success('Success', 'Data berhasil dirubah')->autoClose(1000);
        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->pm_barang()->count() > 0) {
            return redirect()->route('barang.index')->with('error', 'barang tidak bisa di hapus karena belum di kembalikan.');
        }
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'barang berhasil di hapus.');
    }
}