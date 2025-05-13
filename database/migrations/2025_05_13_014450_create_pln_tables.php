<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tabel wilayah
        Schema::create('wilayahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wilayah');
            $table->string('kode_wilayah')->unique();
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->timestamps();
            
            $table->index(['kecamatan', 'kelurahan']);
        });

        // Tabel pemadaman
        Schema::create('pemadamans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wilayah_id')->constrained('wilayahs')->onDelete('restrict');
            $table->date('tanggal');
            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->enum('jenis_pemadaman', ['terencana', 'mendadak']);
            $table->text('alasan');
            $table->enum('status', ['scheduled', 'ongoing', 'completed', 'cancelled']);
            $table->timestamps();
            
            $table->index(['tanggal', 'status']);
            $table->index(['wilayah_id', 'tanggal']);
        });

        // Tabel admin (optional jika sudah ada sistem auth)
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pemadamans');
        Schema::dropIfExists('wilayahs');
        Schema::dropIfExists('admins');
    }
};