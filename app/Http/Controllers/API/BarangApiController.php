<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangApiController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return response()->json([
            'success' => true,
            'message' => 'List semua barang',
            'data' => $barang
        ], 200);
    }

    public function createKode()
    {
        $last = Barang::latest()->first();
        $nextNumber = $last ? ((int)substr($last->code_barang, 3)) + 1 : 1;
        $code_barang = 'BRG' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return response()->json([
            'success' => true,
            'code_barang' => $code_barang
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code_barang' => 'required|unique:barangs,code_barang',
            'nama_barang' => 'required',
            'merk' => 'required',
            'id_kategori' => 'required|exists:kategoris,id',
            'detail' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $barang = Barang::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil disimpan',
            'data' => $barang
        ], 201);
    }

    public function show($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $barang
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'code_barang' => 'required|unique:barangs,code_barang,' . $id,
            'nama_barang' => 'required',
            'merk' => 'required',
            'id_kategori' => 'required|exists:kategoris,id',
            'detail' => 'required',
            'jumlah' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $barang->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil diperbarui',
            'data' => $barang
        ], 200);
    }

    public function destroy($id)
    {
        $barang = Barang::find($id);
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Barang tidak ditemukan'
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Barang berhasil dihapus'
        ], 200);
    }
}