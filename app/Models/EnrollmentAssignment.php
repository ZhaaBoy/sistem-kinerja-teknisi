<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentAssignment extends Model
{
    protected $fillable = [
        'kepala_gudang_id',
        'teknisi_id',
        'nama_barang',
        'kode_barang',
        'qty',
        'tingkat_kesulitan',
        'poin',
        'status',
        'deskripsi_hasil',
        'completed_at',
    ];

    protected $casts = ['completed_at' => 'datetime'];

    // 🔹 Relasi
    public function kepalaGudang()
    {
        return $this->belongsTo(User::class, 'kepala_gudang_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function pengiriman()
    {
        return $this->hasOne(ShipmentAssignment::class);
    }

    // 🔹 Scopes (HARUS pakai public function)
    public function scopePending($query)
    {
        return $query->where('status', 'dikerjakan_teknisi');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }
}
