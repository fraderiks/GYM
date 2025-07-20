<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;
    protected $table = 'programs'; // Ensure this matches your table name
    protected $fillable = [
        'hari',
        'program_name',
        'latihan_plan',
        'nutrisi_tips',
        'rekomendasi',
    ];
}