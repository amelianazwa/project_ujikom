<?php

namespace App\Http\Controllers;

use App\Models\Kondisi;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class KondisiController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $kondisi = Kondisi::all();
        confirmDelete('Delete','Are you sure?');
        return view('kondisi.index', compact('kondisi'));
    }


    public function create()
    {
        return view('kondisi.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'kondisi' => 'required',

        ]);

        $kondisi = new Kondisi();
        $kondisi->kondisi = $request->kondisi;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $kondisi->save();

        return redirect()->route('kondisi.index');
    }


    public function show(kondisi $kondisi)
    {
        //
    }


    public function edit($id)
    {
        $kondisi = kondisi::findOrFail($id);
        return view('kondisi.edit', compact('kondisi'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kondisi' => 'required',

        ]);

        $kondisi = kondisi::findOrFail($id);
        $kondisi->kondisi = $request->kondisi;


        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $kondisi->save();
        return redirect()->route('kondisi.index');
    }


    public function destroy($id)
    {
        $kondisi = kondisi::findOrFail($id);
        $kondisi->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('kondisi.index');
    }
}
