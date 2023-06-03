<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi - Cutes Camerable</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container"><br>
        <div class="col-md-4 col-md-offset-4">
            <h2 class="text-center"><br>Selamat Datang</h3>
            <hr>
            @if(session('error'))
            <div class="alert alert-danger">
                <b>Opps!</b> {{session('error')}}
            </div>
            @endif
            <form action="{{ route('actionregister') }}" method="post" enctype="multipart/form-data"> 
            @csrf
            <div class="form-group">
                    <label>NIK</label>
                    <input type="text" name="nik" class="form-control" placeholder="NIK" required>
                </div>
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required value="{{ old('nama') }}">
                </div>
                <div class="form-group">
                    <label>Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" required value="{{ old('alamat') }}">
                </div>
                <div class="form-group">
                    <label>Nomor Handphone</label>
                    <input type="text" name="nohp" class="form-control" placeholder="Nomor Handphone" required value="{{ old('nohp') }}">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email" required value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <div class=" form-group">
                    <label for="fotobersamaid" class="form-label">Foto Bersama Identitas</label>
                    <input class="form-control" type="file" name="fotobersamaid" id="fotobersamaid" required>
                  </div>
                <div class=" form-group">
                    <label for="fotoid" class="form-label">Foto Identitas</label>
                    <input class="form-control" type="file" name="fotoid" id="fotoid" required>
                  </div>
                  <div class=" form-group">
                    <label for="jenisid" class="form-label">Jenis Identitas</label>
                    <select class="form-select" id="jenisid" name="jenisid"
                        value="{{ Session::get('jenisid') }}">
                        <option selected disabled value>Pilih Jenis Identitas</option>
                        <option value="KTP">KTP</option>
                        <option value="KK">KK</option>
                        <option value="KARTU PELAJAR/MAHASISWA">KARTU PELAJAR/MAHASISWA</option>
                        <option value="SIM">SIM</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                <hr>
                <p class="text-center">Sudah punya akun? <a href="/">Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
