<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel conventions)
    protected $table = 'customers';

    protected $fillable = [
        'nama_customer',
        'alamat',
        'no_telpon',
        'nama_pic',
        'keterangan',
    ];
}
