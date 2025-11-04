<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     * Required for Student::create($validated) to work without
     * throwing a MassAssignmentException.
     */
    protected $fillable = [
        'nama',
        'nim',
        'no_hp',
        'alamat',
    ];
}
