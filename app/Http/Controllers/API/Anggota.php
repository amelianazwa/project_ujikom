<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota as ModelAnggota;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Anggota extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json([
            'message' => 'Data anggota berhasil diambil',
            'data' => ModelAnggota::all()
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code_anggota' => 'required',
            'nama_peminjam' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'instansi_lembaga' => 'required',
        ]);

        $anggota = ModelAnggota::create($validated);
        return response()->json([
            'message' => 'Data anggota berhasil ditambahkan',
            'data' => $anggota
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $anggota = ModelAnggota::findOrFail($id);
        return response()->json([
            'message' => 'Data anggota ditemukan',
            'data' => $anggota
        ], Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code_anggota' => 'required',
            'nama_peminjam' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required',
            'instansi_lembaga' => 'required',
        ]);

        $anggota = ModelAnggota::findOrFail($id);
        $anggota->update($validated);

        return response()->json([
            'message' => 'Data anggota berhasil diperbarui',
            'data' => $anggota
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $anggota = ModelAnggota::findOrFail($id);
        $anggota->delete();

        return response()->json([
            'message' => 'Data anggota berhasil dihapus'
        ], Response::HTTP_OK);
    }
}
