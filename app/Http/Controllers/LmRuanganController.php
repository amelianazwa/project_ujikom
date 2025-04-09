<?php

namespace App\Http\Controllers;

use App\Models\m_Ruangan;
use App\Models\lm_Ruangan;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;
use Illuminate\Http\Request;

class LmRuanganController extends Controller
{
    public function viewPDF()
    {
        $m_ruangan = m_ruangan::latest()->get();

        $data = [
            'title' => 'Data Produk',
            'date' => date('m/d/Y'),
            'm_ruangan' => $m_ruangan,
        ];

        $pdf = PDF::loadView('lm_ruangan.export-pdf', $data)
            ->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function __construct()
    {
        $this -> middleware('auth');
    }
    public function index()
    {

        $m_ruangan =  m_ruangan::all();
        confirmDelete('Delete','Are you sure?');
        return view('lm_ruangan.index', compact('m_ruangan',));
    }


    public function create()
    {

        $m_ruangan = m_ruangan::all();
        return view('lm_ruangan.create', compact('m_ruangan'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'keterangan' => 'required',

        ]);

        $lm_ruangan = new lm_ruangan();
        $lm_ruangan->id_m_ruangan = $request->id_m_ruangan;
        $lm_ruangan->keterangan = $request->keterangan;

        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $lm_ruangan->save();

        return redirect()->route('lm_ruangan.index');
    }


    public function show(lm_ruangan $lm_ruangan)
    {
        //
    }


    public function edit($id)
    {
        $m_ruangan =  m_ruangan::all();
        $lm_ruangan = lm_ruangan::findOrFail($id);
        return view('lm_ruangan.edit', compact('lm_ruangan','m_ruangan'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'keterangan' => 'required',

        ]);

        $lm_ruangan = lm_ruangan::findOrFail($id);
        $lm_ruangan->id_m_ruangan = $request->id_m_ruangan;
        $lm_ruangan->keterangan = $request->keterangan;

        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $lm_ruangan->save();
        return redirect()->route('lm_ruangan.index');
    }


    public function destroy($id)
    {
        $lm_ruangan = lm_ruangan::findOrFail($id);
        $lm_ruangan->delete();
        Alert::success('success','Data berhasil Dihapus');
        return redirect()->route('lm_ruangan.index');
    }
}
