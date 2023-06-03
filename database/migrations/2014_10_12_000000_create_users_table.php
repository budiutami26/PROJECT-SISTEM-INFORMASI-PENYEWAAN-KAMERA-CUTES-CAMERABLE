<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('nik'); //primary key nya
            $table->string('nama');
            $table->string('nohp');
            $table->string('alamat');
            $table->string('fotobersamaid');
            $table->string('fotoid');
            $table->enum('jenisid',['KTP','KK','KARTU PELAJAR/MAHASISWA','SIM']);
            $table->string('email')->unique(); //email harus unik tidak boleh sama
            $table->timestamp('email_verified_at')->nullable(); //data dibiarkan kosong
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};