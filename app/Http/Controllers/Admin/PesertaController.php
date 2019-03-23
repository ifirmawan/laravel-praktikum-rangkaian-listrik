<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aktivitas;
use App\Peserta;

class PesertaController extends Controller
{
    public function index()
    {
        $peserta = Peserta::orderBy('id_aktivitas')->get();
        return view('admin.peserta.index', compact('peserta'));
    }
}
