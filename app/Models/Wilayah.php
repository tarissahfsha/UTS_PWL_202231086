<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wilayah extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'nama_wilayah',
        'kode_wilayah',
        'kecamatan',
        'kelurahan',
    ];

    // Relasi ke tabel pemadaman
    public function pemadamans()
    {
        return $this->hasMany(Pemadaman::class);
    }

    // Accessor untuk mendapatkan nama lengkap wilayah
    public function getFullNameAttribute()
    {
        return $this->kelurahan . ', ' . $this->kecamatan . ' - ' . $this->nama_wilayah;
    }

    // Scope untuk filter berdasarkan kecamatan
    public function scopeByKecamatan($query, $kecamatan)
    {
        return $query->where('kecamatan', $kecamatan);
    }

    // Mendapatkan jumlah pemadaman aktif
    public function getActivePemadamanCountAttribute()
    {
        return $this->pemadamans()
                    ->where('status', 'ongoing')
                    ->count();
    }
}