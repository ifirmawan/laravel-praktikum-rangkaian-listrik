<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Peserta;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'home']);
    }

    public function home(){
        $user = Auth::user();
        switch ($user->role){
            case '1':
                break;
            case '2':
                break;
            case '3':
                return redirect()->route('mahasiswa.index');
                break;
        }
    }

    public function login()
    {
        return view('akun.login');
    }

    public function logout()
    {
        if (Auth::check())
        {
            Auth::logout();
        }
        return redirect()->route('site.login');
    }

    public function authenticate(Request $request)
    {

        $this->validate($request, [
            'nim' => 'required|min:6',
            'password' => 'required|min:6'
        ]);

        $data = $request->only('nim', 'password');

        $remember = false;
        if(!empty($request->remember)){
            $remember = true;
        }

        if (Auth::attempt($data, $remember))
        {
            return redirect()->intended('/');
        }else
        {
            return redirect()->back()->with(['fail' => 'NIM atau password anda salah']);
        }
    }

    public function registerForm()
    {
        return view('akun.register');
    }

    public function register(Request $req)
    {
        $this->validate($req, [
            'email' => 'required|email|min:6|unique:users',
            'password' => 'required|min:6',
            'NIM' => 'required|digits_between:8,15|min:8|unique:users',
            'name' => 'required|string|min:10|max:50',
            'phone' => 'required|digits_between:3,15',
            'photo' => 'required|image|max:3074',
        ]);

        $filename = $req->NIM.'_'.rand(0,9999).'.'.$req->photo->getClientOriginalExtension();

        if ($req->photo->move(public_path('img/avatar'), $filename))
        {
            $data = new User;
            $data->name = strip_tags($req->name);
            $data->email = $req->email;

            $password = \Hash::make($req->password);
            $data->password = $password;

            $data->phone = '+62'.$req->phone;
            $data->role = 3;
            $data->NIM = $req->NIM;
            $data->photo = $filename;
            $data->save();

            return redirect()
                ->route('site.login')
                ->with('success', 'Akun anda berhasil dibuat');
        }else{
            return redirect()
                ->route('site.register')
                ->with('fail', 'Akun gagal dibuat karena terjadi kesalahan');
        }

    }

}
