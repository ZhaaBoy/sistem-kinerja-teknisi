<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentAssignment extends Model
{
    protected $fillable = ['enrollment_assignment_id', 'no_resi', 'jasa_kirim'];
    protected $casts = ['shipped_at' => 'datetime'];

    public function penugasan()
    {
        return $this->belongsTo(EnrollmentAssignment::class, 'enrollment_assignment_id');
    }
}
