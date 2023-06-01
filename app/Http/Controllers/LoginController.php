<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return view('dashboard');
        } else {
            return view('login');
        }
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        // dd(Auth::user());

        if (Auth::attempt($data)) { // tadine A gede
            return redirect('/dashboard');
        } else {
            Session::flash('error', 'Email atau Password Salah');
            // return2 back()->with('loginError', 'Login Gagal');
            return redirect('/');
        }
    }

    public function actionlogout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function register()
    {
        return view('register');
    }

    // $data = [
    //     'email' => $request->input('email'),
    //     'password' => $request->input('password'),
    // ];

    public function actionregister(Request $request)
    {
        

        $user = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nik' => $request->nik,
            'nohp' => $request->nohp,
            'email' => $request->email,
            'fotobersamaid' => $request->fotobersamaid,
            'fotoid' => $request->fotoid,
            'jenisid' => $request->jenisid,
            'password' => $request->password,
            // 'role' => $request->role,
            'active' => 1
        ]);

        
        Session::flash('message', 'Register Berhasil. Akun Anda sudah Aktif silahkan Login menggunakan username dan password.');
        return redirect('/');
    }

}