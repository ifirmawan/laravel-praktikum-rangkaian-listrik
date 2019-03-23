<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aktivitas;
use App\User;
use App\Matkul;
use App\Kelas;

use Illuminate\Validation\Rule;

class KelasController extends Controller
{

    public function add()
    {
        $kelas = Kelas::orderBy('nama_kelas')->paginate(10);
        return view('admin.kelas.add', compact('kelas'));
    }

    public function edit($id)
    {
        $data = Kelas::findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas')->paginate(10);

        return view('admin.kelas.add', compact('data', 'kelas'));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'nama_kelas' => 'required|unique:kelas',
        ]);

        $data = new Kelas;
        $data->nama_kelas = $req->nama_kelas;
        $data->save();

        return redirect()->route('admin.kelas.add')->with('success', 'Kelas berhasil ditambahkan');
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'nama_kelas' => ['required', Rule::unique('kelas')->ignore($id)],
        ]);

        $data = Kelas::findOrFail($id);
        $data->nama_kelas = $req->nama_kelas;

        $data->save();

        return redirect()->route('admin.kelas.add')->with('success', 'Kelas berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Kelas::findOrFail($id);

        $cek = Aktivitas::where('id_kelas', $data->id)->count();
        if ($cek==0)
        {
            $data->delete();
            return redirect()->route('admin.kelas.add')->with('success', 'Kelas berhasil dihapus');
        }else
        {
            return redirect()->route('admin.kelas.add')->with('fail', 'Tidak dapat menghapus kelas karena data kelas masih digunakan');
        }


    }
}
