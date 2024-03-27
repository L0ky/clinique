<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'age',
        'diagnostic',
        'coordinates',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function diseases()
    {
        return $this->belongsToMany(Disease::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

}
