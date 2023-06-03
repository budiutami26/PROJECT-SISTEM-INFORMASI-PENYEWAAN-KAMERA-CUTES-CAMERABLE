<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void  //seeder atau data palsu 
    {
        User::truncate();
        User::create([
            'nik' => '210302035',
            'nama' => 'tami',
            'nohp' => '085878653934',
            'alamat' => 'kalisabuk',
            'jenisid' => 'KK',
            'fotoid' => 'default.jpg',
            'email' => 'tami@gmail.com',
            'fotobersamaid' => 'default.jpg',
            'password' => hash::make('tami'),
            'remember_token' => Str::random(60),
             ]);
    }
}