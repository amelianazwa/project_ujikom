<?php

namespace App\Http\Controllers;

use App\Models\pm_Ruangan;
use App\Models\l_Ruangan;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class LRuanganController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {
        $l_ruangan =  l_ruangan::all();
        $pm_ruangan =  pm_ruangan::all();

        confirmDelete('Delete','Are you sure?');
        return view('l_ruangan.index', compact('l_ruangan','pm_ruangan'));
    }


    public function create()
    {
        $pm_ruangan =  pm_ruangan::all();
        return view('l_ruangan.create', compact('pm_ruangan'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',

        ]);

        $l_ruangan = new l_ruangan();
        $l_ruangan->id_pm_ruangan = $request->id_pm_ruangan;
        $l_ruangan->keterangan = $request->keterangan;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/l_ruangan', $name);
            $l_ruangan->cover = $name;
        }

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $l_ruangan->save();

        return redirect()->route('l_ruangan.index');
    }


    public function show(l_ruangan $ruangan)
    {
        //
    }


    public function edit($id)
    {
        $pm_ruangan =  pm_ruangan::all();
        $l_ruangan = l_ruangan::findOrFail($id);
        return view('l_ruangan.edit', compact('l_ruangan','pm_ruangan'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'keterangan' => 'required',

        ]);

        $l_ruangan = l_ruangan::findOrFail($id);
        $l_ruangan->id_pm_ruangan = $request->id_pm_ruangan;
        $l_ruangan->keterangan = $request->keterangan;

        if ($request->hasFile('cover')) {
            $img = $request->file('cover');
            $name = rand(1000, 9999) . $img->getClientOriginalName();
            $img->move('images/l_ruangan', $name);
            $l_ruangan->cover = $name;
        }

        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $l_ruangan->save();
        return redirect()->route('l_ruangan.index');
    }


    public function destroy($id)
    {
        $l_ruangan = l_ruangan::findOrFail($id);
        $l_ruangan->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('l_ruangan.index');
    }
}
