<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Aktivitas;
use App\User;
use App\Matkul;
use App\Kelas;

use Illuminate\Validation\Rule;

class MatkulController extends Controller
{

    public function add()
    {
        $matkul = Matkul::orderBy('nama_mk')->paginate(10);
        return view('admin.matkul.add', compact('matkul'));
    }

    public function edit($id)
    {
        $data = Matkul::findOrFail($id);
        $matkul = Matkul::orderBy('nama_mk')->paginate(10);

        return view('admin.matkul.add', compact('data', 'matkul'));
    }

    public function store(Request $req)
    {
        $this->validate($req, [
            'nama_mk' => 'required',
            'kd_mk' => 'required|unique:mata_kuliah',
        ]);

        $data = new Matkul;
        $data->nama_mk = $req->nama_mk;
        $data->kd_mk = $req->kd_mk;
        $data->save();

        return redirect()->route('admin.matkul.add')->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    public function update(Request $req, $id)
    {
        $this->validate($req, [
            'id_mk' => 'nama_mk',
            'kd_mk' => ['required', Rule::unique('mata_kuliah')->ignore($id)],
        ]);

        $data = Matkul::findOrFail($id);
        $data->nama_mk = $req->nama_mk;
        $data->kd_mk = $req->kd_mk;

        $data->save();

        return redirect()->route('admin.matkul.add')->with('success', 'Mata Kuliah berhasil diubah');
    }

    public function destroy($id)
    {
        $data = Matkul::findOrFail($id);

        $cek = Aktivitas::where('id_mk', $data->id)->count();
        if ($cek==0)
        {
            $data->delete();
            return redirect()->route('admin.matkul.add')->with('success', 'Mata kuliah berhasil dihapus');
        }else
        {
            return redirect()->route('admin.matkul.add')->with('fail', 'Tidak dapat menghapus mata kuliah karena data masih digunakan');
        }
    }
}
