<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Laporan;
use App\Matkul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Modul;
use App\User;
use App\Peserta;
use App\Aktivitas;
use Illuminate\Validation\Rule;


class ModulController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $aktivitas = $user->peserta()->get();

//        $aktivitas = User::whereHas('peserta', function($query)
//        {
//            $query->where('as_asisten', '0');
//        })->get();

        return view('mahasiswa.kelas', compact('user', 'aktivitas'));
    }


    public function kelas()
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::whereHas('matkul', function($query)
        {
                $query->orderBy('nama_mk');
        })->get();

        return view('mahasiswa.matkul', compact('aktivitas', 'user'));
    }

    public function joinClass(Request $req, $id_aktivitas)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $peserta = \App\Peserta::where('id_aktivitas', $id_aktivitas)
            ->where('id_user', $user->id)
            ->count();

        if ($peserta==0)
        {
            $password = $aktivitas->password;
            if($password==$req->password)
            {
                $data = new Peserta;
                $data->id_user = $user->id;
                $data->id_aktivitas = $id_aktivitas;
                $data->save();
                return redirect()
                    ->route('mahasiswa.matkul', $aktivitas->id);
            }else
            {
                return redirect()
                    ->route('mahasiswa.kelas')
                    ->with('fail', 'Kode akses untuk mata kuliah <b>'.$aktivitas->matkul->nama_mk.'</b> salah');
            }
        }else{
            abort(404);
        }
    }

    public function showMatkul($id_aktivitas)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $peserta = Peserta::where('id_user', $user->id)
                            ->where('id_aktivitas', $id_aktivitas)
                            ->firstOrFail();


        $matkul = Matkul::findOrFail($aktivitas->matkul->id);
        $modul = Modul::where('id_mk', $matkul->id)
            ->orderBy('id_mk')
            ->get();

        return view('mahasiswa.modul.index', compact('user','aktivitas','matkul','modul'));
    }

    public function peserta($id_aktivitas)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $matkul = Matkul::findOrFail($aktivitas->id_mk);

        //get all dosen for this matkul
        $dosen = Peserta::where('id_aktivitas', $aktivitas->id)
            ->whereHas('user', function($query)
            {
                $query->where('role','1')->orderBy('NIM');
            })->get();

        //get all assistent for this matkul
        $asisten = Peserta::where('id_aktivitas', $aktivitas->id)
            ->whereHas('user', function($query)
            {
                $query->where('is_asisten','1')->orderBy('NIM');
            })->get();

        //get all mahasiswa for this matkul
        $mahasiswa = Peserta::where('id_aktivitas', $aktivitas->id)
            ->whereHas('user', function($query)
            {
                $query->where('role','3')->orderBy('NIM')
                      ->where('is_asisten', '0');
            })->get();
        return view('mahasiswa.peserta', compact('user','matkul', 'aktivitas', 'dosen', 'asisten', 'mahasiswa'));
    }

    public function showModul($id_aktivitas, $id_modul)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $matkul = Matkul::findOrFail($aktivitas->matkul->id);
        $modul = Modul::where('id_mk', $matkul->id)
                        ->where('id', $id_modul)
                        ->firstOrFail();

        $laporan = Laporan::where('id_modul', $id_modul)
                            ->where('id_user', $user->id)
                            ->first();
        if($laporan)
        {
            return view('mahasiswa.modul.view', compact('user',
                        'aktivitas','matkul','modul','laporan'));
        }else
        {
            $asisten = Peserta::where('id_aktivitas', $id_aktivitas)
                            ->where('as_asisten', '1')
                            ->whereHas('user', function($query)
                            {
                                $query->where('is_asisten','1');
                            })->get();

            return view('mahasiswa.modul.add', compact('user',
                'aktivitas','matkul','modul','asisten'));
        }

    }

    public function editResume($id_aktivitas, $id_modul)
    {
        //get account information
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $matkul = Matkul::findOrFail($aktivitas->matkul->id);
        $modul = Modul::where('id_mk', $matkul->id)
            ->where('id', $id_modul)
            ->firstOrFail();

        //get the resume
        $laporan = Laporan::where('id_modul', $modul->id)
            ->where('id_user', $user->id)
            ->firstOrFail();

        //get all assistent for this matkul
        $asisten = Peserta::where('id_aktivitas', $id_aktivitas)
            ->where('as_asisten', '1')
            ->whereHas('user', function($query)
            {
                $query->where('is_asisten','1');
            })->get();

        return view('mahasiswa.modul.add', compact('user',
            'aktivitas','matkul','modul','asisten', 'laporan'));

    }

    public function storeResume(Request $req, $id_aktivitas, $id_modul)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $matkul = Matkul::findOrFail($aktivitas->matkul->id);
        $modul = Modul::findOrFail($id_modul);

        //check role first
        if ($user->role!=3)
        {
            abort(404);
        }

        //check is peserta ?
        $peserta = Peserta::where('id_user', $user->id)
                            ->where('id_aktivitas', $id_aktivitas)
                            ->firstOrFail();

        //get all valid assisten
        $asistenList = [];
        $asisten = Peserta::where('id_aktivitas', $id_aktivitas)
                        ->where('as_asisten', '1')
                        ->whereHas('user', function($query)
                        {
                            $query->where('is_asisten','1');
                        })->get();
        foreach ($asisten as $item)
        {
            array_push($asistenList, $item->user->id);
        }

        //validate
        $this->validate($req, [
            'file' => 'required|mimes:pdf|max:3074',
            'id_asisten' => ['required',Rule::in($asistenList)],
            'pesan' => 'nullable|min:20',
            'tgl_praktikum' => 'required|date',
        ]);

        $filename = $user->NIM.'_'.$matkul->kd_mk.'_'.$modul->id.'_'.rand(0,99999).'.pdf';

        if ($req->file->move(public_path('file'), $filename))
        {
            $data = new Laporan;
            $data->id_user = $user->id;
            $data->id_modul = $modul->id;
            $data->id_asisten = $req->id_asisten;
            $data->pdf = $filename;
            $data->pesan = $req->pesan;
            $data->tgl_praktikum = $req->tgl_praktikum;
            $data->save();

            return redirect()
                ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                ->with('success', 'Laporan berhasil dikumpulkan');
        }else{
            return redirect()
                ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                ->with('fail', 'Laporan gagal dikumpulkan karena terjadi kesalahan');
        }

    }

    public function updateResume(Request $req, $id_aktivitas, $id_modul)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $matkul = Matkul::findOrFail($aktivitas->matkul->id);
        $modul = Modul::findOrFail($id_modul);

        //get the resume
        $laporan = Laporan::where('id_modul', $modul->id)
            ->where('id_user', $user->id)
            ->firstOrFail();

        //check role first
        if ($user->role!=3)
        {
            abort(404);
        }

        //check is peserta ?
        $peserta = Peserta::where('id_user', $user->id)
            ->where('id_aktivitas', $id_aktivitas)
            ->firstOrFail();

        //get all valid assisten
        $asistenList = [];
        $asisten = Peserta::where('id_aktivitas', $id_aktivitas)
                        ->where('as_asisten', '1')
                        ->whereHas('user', function($query)
                        {
                            $query->where('is_asisten','1');
                        })->get();

        foreach ($asisten as $item)
        {
            array_push($asistenList, $item->user->id);
        }

        //validate
        $this->validate($req, [
            'file' => 'mimes:pdf|max:3074',
            'id_asisten' => ['required',Rule::in($asistenList)],
            'pesan' => 'nullable|min:20',
            'tgl_praktikum' => 'required|date',
        ]);

        //check if there is file
        if ($req->file)
        {
            $filename = $user->NIM.'_'.$matkul->kd_mk.'_'.$modul->id.'_'.rand(0,99999).'.pdf';
            if (!$req->file->move(public_path('file'), $filename))
            {
                return redirect()
                    ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                    ->with('fail', 'Laporan gagal diubah karena terjadi kesalahan');
            }else{
                File::delete(public_path('file/'.$laporan->pdf));
            }
        }

        $data = $laporan;
        $data->id_user = $user->id;
        $data->id_modul = $modul->id;
        $data->id_asisten = $req->id_asisten;
        $data->tgl_praktikum = $req->tgl_praktikum;

        if ($req->file) {
            $data->pdf = $filename;
        }

        $data->pesan = $req->pesan;
        if ($data->save())
        {
            return redirect()
                ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                ->with('success', 'Laporan berhasil diubah');
        }else{
            return redirect()
                ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                ->with('fail', 'Laporan gagal diubah karena terjadi kesalahan');
        }

    }


    public function deleteResume(Request $req, $id_aktivitas, $id_modul)
    {
        $user = Auth::user();
        $aktivitas = Aktivitas::findOrFail($id_aktivitas);
        $matkul = Matkul::findOrFail($aktivitas->matkul->id);
        $modul = Modul::findOrFail($id_modul);

        //get the resume
        $laporan = Laporan::where('id_modul', $modul->id)
            ->where('id_user', $user->id)
            ->firstOrFail();

        if ($laporan->delete())
        {
            File::delete(public_path('file/'.$laporan->pdf));
            return redirect()
                ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                ->with('success', 'Laporan berhasil dihapus');
        }else{
            return redirect()
                ->route('mahasiswa.modul.view', [$aktivitas->id, $modul->id])
                ->with('fail', 'Laporan gagal dihapus karena terjadi kesalahan');
        }
    }

    public function profil()
    {
        $user = Auth::user();
        return view('mahasiswa.profil', compact('user'));
    }

    public function saveProfile(Request $req)
    {
        
        $user = Auth::user();

        $this->validate($req, [
            'password' => 'nullable|min:6',
            'name' => 'required|string|min:10|max:50',
            'phone' => 'required|digits_between:3,15',
            'photo' => 'nullable|image|max:1024',
        ]);

        if ($req->photo)
        {
            $filename = $user->NIM.'_'.rand(0,9999).'.'.$req->photo->getClientOriginalExtension();
            if (!$req->photo->move(public_path('img/avatar'), $filename))
            {
                return redirect()
                    ->route('mahasiswa.profil')
                    ->with('fail', 'Perubahan gagal disimpan karena terjadi kesalahan');
            }else{
                File::delete(public_path('img/avatar/'.$user->photo));
            }
        }

        $data = $user;
        $data->name = strip_tags($req->name);
        $data->phone = '+62'.$req->phone;

        if ($req->password){
            $password = \Hash::make($req->password);
            $data->password = $password;
        }

        if ($req->photo) {
            $data->photo = $filename;
        }

        if($data->save()){
            return redirect()
                ->route('mahasiswa.index')
                ->with('success', 'Perubahan informasi profil berhasil disimpan');
        }else{
            return redirect()
                ->route('mahasiswa.profil')
                ->with('fail', 'Gagal menyimpan perubahan profil karena terjadi kesalahan');
        }


    }
}
