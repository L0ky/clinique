<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'speciality',
        'coordinates',
    ];

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}
