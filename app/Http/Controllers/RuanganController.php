<?php

namespace App\Http\Controllers;

use App\Models\ruangan;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $ruangan=ruangan::all();
        confirmDelete('Delete','Are you sure?');
        return view('ruangan.index',compact('ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ruangan=new ruangan;
        $ruangan->nama_ruangan=$request->nama_ruangan;
        $ruangan->nama_pic=$request->nama_pic;
        $ruangan->posisi_ruangan=$request->posisi_ruangan;
        Alert::success('Success','data berhasil disimpan')->autoClose(1000);
        $ruangan->save();
        return redirect()->route('ruangan.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ruangan = Ruangan::FindOrFail($id);
        return view('ruangan.edit', compact('ruangan'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ruangan = Ruangan::FindOrFail($id);
        $ruangan->nama_ruangan=$request->nama_ruangan;
        $ruangan->nama_pic=$request->nama_pic;
        $ruangan->posisi_ruangan=$request->posisi_ruangan;
        Alert::success('Success','data berhasil diubah')->autoClose(1000);
        $ruangan->save();
        return redirect()->route('ruangan.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::findOrFail($id);
    
        // Cek apakah ruangan sedang dipinjam dan belum dikembalikan
        $isDipinjam = $ruangan->peminjamandetailruangan()
            ->whereHas('pm_ruangan', function ($query) {
                $query->whereNotIn('id', function ($subQuery) {
                    $subQuery->select('id_pm_ruangan')->from('p_ruangans'); // id yang sudah dikembalikan
                });
            })->exists();
    
        if ($isDipinjam) {
            Alert::error('Error', 'Ruangan tidak bisa dihapus karena belum di kembalikan.');
            return redirect()->route('ruangan.index');
        }
    
        // Opsional: Cek apakah ruangan pernah dipinjam
        if ($ruangan->peminjamandetailruangan()->exists()) {
            Alert::error('Error', 'Ruangan tidak bisa dihapus karena pernah dipinjam.');
            return redirect()->route('ruangan.index');
        }
    
        $ruangan->delete();
        Alert::success('Success', 'Ruangan berhasil dihapus.');
        return redirect()->route('ruangan.index');
    }
    
}
