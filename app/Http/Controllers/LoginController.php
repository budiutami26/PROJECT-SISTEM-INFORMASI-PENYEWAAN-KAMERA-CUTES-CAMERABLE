<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator; //memanggil fungsi validator
use Illuminate\Support\Facades\Hash;  //untuk membaca password hash
use Carbon\Carbon; //membaca class carbon
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

    public function actionregister(Request $request)
    {

        $validatedData = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
            'nik' => 'required|unique:users',
            'nohp' => 'required',
            'email' => 'required|unique:users',
            'fotobersamaid' => 'image|mimes:jpeg,png,jpg|max:2048', // validasi untuk tipe file gambar
            'fotoid' => 'image|mimes:jpeg,png,jpg|max:2048', // validasi untuk tipe file gambar
            'jenisid' => 'required',
            'password' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi.',
            'alamat.required' => 'Alamat harus diisi.',
            'nik.required' => 'NIK harus diisi.',
            'nik.unique' => 'NIK sudah pernah mendaftar.',
            'nohp.required' => 'Nomor HP harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.unique' => 'Email sudah digunakan.',
            'fotobersamaid.image' => 'Foto bersama ID harus berupa gambar.',
            'fotobersamaid.mimes' => 'Foto bersama ID harus dalam format jpeg, png, atau jpg.',
            'fotobersamaid.max' => 'Ukuran foto bersama ID tidak boleh melebihi 2MB.',
            'fotoid.image' => 'Foto ID harus berupa gambar.',
            'fotoid.mimes' => 'Foto ID harus dalam format jpeg, png, atau jpg.',
            'fotoid.max' => 'Ukuran foto ID tidak boleh melebihi 2MB.',
            'jenisid.required' => 'Jenis ID harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        if($validatedData->fails()){
            session::flash('error', $validatedData->messages()->first());
            return redirect()->back()->withInput();
        }

        $user = new User();
        $user->nama = $request->nama;
        $user->alamat = $request->alamat;
        $user->nik = $request->nik;
        $user->nohp = $request->nohp;
        $user->email = $request->email;
        $user->jenisid = $request->jenisid;
        // $user->role = 1; // isi dengan role nya
        $user->password = Hash::make($request->password);

        if ($request->hasFile('fotoid')) {
            $file = $request->file('fotoid');
            $fileName = $request['nama'] . Carbon::now()->locale('id')->translatedFormat('dHis') .'.'. $file->getClientOriginalExtension();
            $imagePath = $file->storeAs('public/images', $fileName); // simpan gambar di folder storage/app/public/images
        }
        $user->fotoid = basename($imagePath);

        if ($request->hasFile('fotobersamaid')) {
            $file = $request->file('fotobersamaid');
            $fileName = $request['nama'] . Carbon::now()->locale('id')->translatedFormat('dHis') . $file->getClientOriginalExtension(); //fungsi carbon untuk memanipulasi tanggal/jam 
            $filePathid = $file->storeAs('public/images', $fileName); // simpan gambar di folder storage/app/public/images
        }
        $user->fotobersamaid = basename($filePathid);

        $user->save();
        session::flash('success', 'Data berhasil ditambahkan');

        return redirect('/'); // jika registrasi berhasil akan diarahkan ke halaman login
    }
}