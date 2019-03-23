<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Peserta;
use App\Kelas;


class PesertaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
//        $kelas = Kelas::where()
    }
}
