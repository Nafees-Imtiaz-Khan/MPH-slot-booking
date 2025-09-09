<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'sport_id',
        'date',
        'slot',
        'board_number',
    ];

    //  Relationship: Booking belongs to a Sport
    public function sport()
    {
        return $this->belongsTo(\App\Models\Sport::class);
    }
    public function student()
    {
        return $this->belongsTo(\App\Models\User::class, 'student_id');
    }

}


