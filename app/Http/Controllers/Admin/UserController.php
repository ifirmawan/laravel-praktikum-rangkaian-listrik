<?php

namespace App\Http\Controllers\Admin;

use App\Peserta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function pengguna(Request $req)
    {
        if ($req->get('search'))
        {
            $data = User::where('name', 'LIKE', '%'.$req->get('search').'%')
                        ->orderBy('role')
                        ->orderBy('name')
                        ->paginate(10);
            $data->withPath('?search='.$req->get('search'));
        }else
        {
            $data = User::orderBy('role')
                        ->orderBy('NIM')
                        ->orderBy('name')
                        ->paginate(10);
        }

        return view('admin.pengguna.index', compact('data'));
    }

    public function destroy($id_user)
    {
        $user = User::findOrFail($id_user);
        $cek = Peserta::where('id_user', $id_user)->count();

        $route = 'admin.pengguna';

        if ($cek==0)
        {
            $user->delete();
            return redirect()->route($route)->with('success', 'Pengguna berhasil dihapus');
        }else
        {
            return redirect()->route($route)->with('fail', 'Tidak dapat menghapus pengguna karena data masih digunakan');
        }
    }
}
