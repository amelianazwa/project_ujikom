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
        // Menggunakan eager loading untuk menghindari query berulang
        $barang = Barang::with('kategori')->get();
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
            'id_kategori' => 'required',
        ]);

        Barang::create($validated);

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
            'id_kategori' => 'required',
        ]);

        Barang::where('id', $id)->update($validated);

        Alert::success('Success', 'Data berhasil dirubah')->autoClose(1000);
        return redirect()->route('barang.index');
    }

    public function destroy($id)
{
    $barang = Barang::findOrFail($id);

    // Cek apakah barang ini masih punya relasi peminjaman yang belum dikembalikan
    $isDipinjam = $barang->peminjaman_details()
        ->whereHas('pm_barang', function ($query) {
            $query->whereNotIn('id', function ($subQuery) {
                $subQuery->select('id_pm_barang')->from('p_barangs'); // id peminjaman yang sudah dikembalikan
            });
        })->exists();

    if ($isDipinjam) {
        return redirect()->route('barang.index')->with('error', 'Barang tidak bisa dihapus karena masih dipinjam.');
    }

    // Opsional: Cek relasi lain seperti detail pengembalian juga
    if ($barang->peminjaman_details()->exists()) {
        return redirect()->route('barang.index')->with('error', 'Barang tidak bisa dihapus karena pernah dipinjam.');
    }

    $barang->delete();
    return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
}

}
