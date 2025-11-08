<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public const ROLE_ADMIN         = 'admin';
    public const ROLE_KEPALA_GUDANG = 'kepala_gudang';
    public const ROLE_TEKNISI       = 'teknisi';
    public const ROLE_HELPER        = 'helper';

    protected $fillable = ['name', 'email', 'password', 'role', 'score'];
    protected $hidden   = ['password', 'remember_token'];

    public function getRoleLabelAttribute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN         => 'Admin',
            self::ROLE_KEPALA_GUDANG => 'Kepala Gudang',
            self::ROLE_TEKNISI       => 'Teknisi',
            self::ROLE_HELPER        => 'Helper',
            default                  => ucfirst($this->role),
        };
    }

    public function tugasTeknisi()
    {
        return $this->hasMany(EnrollmentAssignment::class, 'teknisi_id');
    }
}
