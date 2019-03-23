<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aktivitas;
use App\User;
use App\Matkul;
use App\Kelas;

class AktivitasController extends Controller
{


    public function add()
    {
        $aktivitas = Aktivitas::paginate(10);
        $matkul = Matkul::orderBy('nama_mk')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();
        return view('admin.aktivitas.add', compact('aktivitas', 'matkul', 'kelas'));
    }

    public function edit($id_aktivitas)
    {
        $data = Aktivitas::findOrFail($id_aktivitas);
        $aktivitas = Aktivitas::paginate(10);
        $matkul = Matkul::orderBy('nama_mk')->get();
        $kelas = Kelas::orderBy('nama_kelas')->get();

        return view('admin.aktivitas.add', compact('aktivitas', 'matkul', 'kelas','data'));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
           'id_mk' => 'required',
            'id_kelas' => 'required',
            'password' => 'required|min:5',
        ]);

        $aktivitas = new Aktivitas;
        $aktivitas->id_mk = $req->id_mk;
        $aktivitas->id_kelas = $req->id_kelas;
        $aktivitas->password = $req->password;
        $aktivitas->save();

        return redirect()->route('admin.aktivitas.add')->with('success', 'Aktivitas berhasil ditambahkan');
    }

    public function update(Request $req, $id_aktivitas)
    {
        $this->validate($req, [
            'id_mk' => 'required',
            'id_kelas' => 'required',
            'password' => 'required|min:5',
        ]);

        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $aktivitas->id_mk = $req->id_mk;
        $aktivitas->id_kelas = $req->id_kelas;
        $aktivitas->password = $req->password;
        $aktivitas->save();

        return redirect()->route('admin.aktivitas.add')->with('success', 'Aktivitas berhasil diubah');
    }

    public function destroy($id_aktivitas)
    {
        $data = Aktivitas::findOrFail($id_aktivitas);
        $data->delete();
        return redirect()->route('admin.aktivitas.add')->with('success', 'Aktivitas berhasil dihapus');

    }
}
