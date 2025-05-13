<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pemadaman extends Model
{
    use HasFactory;
    
    protected $table = 'pemadamans';

    protected $fillable = [
        'wilayah_id',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jenis_pemadaman',
        'alasan',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'date',
        // Hapus casting untuk jam_mulai dan jam_selesai
    ];

    // Relasi ke tabel wilayah
    public function wilayah()
    {
        return $this->belongsTo(Wilayah::class);
    }

    // Accessor untuk format jam mulai
    public function getFormattedStartTimeAttribute()
    {
        return date('H:i', strtotime($this->jam_mulai));
    }

    // Accessor untuk format jam selesai
    public function getFormattedEndTimeAttribute()
    {
        return date('H:i', strtotime($this->jam_selesai));
    }

    // Accessor untuk waktu lengkap
    public function getFormattedTimeAttribute()
    {
        return $this->formatted_start_time . ' - ' . $this->formatted_end_time;
    }

    // Accessor untuk mendapatkan durasi pemadaman
    public function getDurationAttribute()
    {
        $start = \Carbon\Carbon::parse($this->jam_mulai);
        $end = \Carbon\Carbon::parse($this->jam_selesai);
        
        $diff = $end->diffInMinutes($start);
        
        if ($diff >= 60) {
            $hours = floor($diff / 60);
            $minutes = $diff % 60;
            return $hours . ' jam ' . ($minutes > 0 ? $minutes . ' menit' : '');
        }
    }

    // Accessor untuk mendapatkan status badge color
    public function getStatusColorAttribute()
    {
        $colors = [
            'scheduled' => 'warning',
            'ongoing' => 'danger',
            'completed' => 'success',
            'cancelled' => 'secondary'
        ];

        return $colors[$this->status] ?? 'dark';
    }

    // Accessor untuk mendapatkan status label
     public function getStatusLabelAttribute()
    {
        $labels = [
            'scheduled' => 'Terjadwal',
            'ongoing' => 'Sedang Berlangsung',
            'completed' => 'Selesai',
            'cancelled' => 'Dibatalkan'
        ];

        return $labels[$this->status] ?? 'Unknown';
    }

    // Scope untuk pemadaman aktif
    public function scopeActive($query)
    {
        return $query->where('status', '!=', 'cancelled')
                    ->where('tanggal', '>=', now()->toDateString());
    }

    // Scope untuk pemadaman hari ini
    public function scopeToday($query)
    {
        return $query->whereDate('tanggal', today());
    }
}