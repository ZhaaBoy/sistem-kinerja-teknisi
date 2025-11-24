<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentAssignment extends Model
{
    protected $fillable = [
        'kepala_gudang_id',
        'teknisi_id',
        'customer_id',
        'barang_id',
        'qty',
        'tingkat_kesulitan',
        'poin',
        'timeline',
        'status',
        'deskripsi_hasil',
        'completed_at',
    ];

    protected $casts = [
        'timeline' => 'datetime',
        'completed_at' => 'datetime',
    ];

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
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
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
