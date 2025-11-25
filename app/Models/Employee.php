<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'role',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function leaves() {
        return $this->hasMany(Leave::class);
    }
}
