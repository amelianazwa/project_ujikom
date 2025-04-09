<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\anggota;
use App\Models\Ruangan;
use App\Models\Kategori;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori = Kategori::count('id');
        $barang = Barang::count('id');
        $anggota = anggota::count('id');
        $ruangan = Ruangan::count('id');
        return view('home',compact('kategori','barang','anggota','ruangan'));
    }
}
