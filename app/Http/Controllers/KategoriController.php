<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $kategori = Kategori::all();
        confirmDelete('Delete','Are you sure?');
        return view('kategori.index', compact('kategori'));
    }


    public function create()
    {
        return view('kategori.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori' => 'required',

        ]);

        $kategori = new Kategori();
        $kategori->nama_kategori = $request->nama_kategori;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $kategori->save();

        return redirect()->route('kategori.index');
    }


    public function show(kategori $kategori)
    {
        //
    }


    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_kategori' => 'required',

        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama_kategori = $request->nama_kategori;


        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $kategori->save();
        return redirect()->route('kategori.index');
    }


    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('kategori.index');
    }
}
