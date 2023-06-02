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

        $validatedData = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            'nohp' => 'required',
            'email' => 'required',
            'fotobersamaid' => 'image|mimes:jpeg,png,jpg|max:2048', // validasi untuk tipe file gambar
            'fotoid' => 'image|mimes:jpeg,png,jpg|max:2048', // validasi untuk tipe file gambar
            'jenisid' => 'required',
            'password' => 'required',
            'active' => 'required',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->nik = $request->nik;
        $user->nohp = $request->nohp;
        $user->email = $request->email;
        $user->jenisid = $request->jenisid;
        // $user->role = 1; // isi dengan role nya
        $user->password = Hash::make($request->password);
        $user->active = $request->active;

        if ($request->hasFile('fotobersamaid')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images'); // simpan gambar di folder storage/app/public/images
            $user->fotobersamaid = basename($imagePath); // simpan nama file gambar ke dalam kolom 'image'
        }

        if ($request->hasFile('fotoid')) {
            $image = $request->file('image');
            $imagePath = $image->store('public/images'); // simpan gambar di folder storage/app/public/images
            $user->fotoid = basename($imagePath); // simpan nama file gambar ke dalam kolom 'image'
        }
        $user->save();
        session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/');
    }
}