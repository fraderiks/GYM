<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;

    // data program disimpan di table programs
    protected $table = 'programs';

    // kolom yang bisa di mass assign
    protected $fillable = [
        'hari',
        'program_name',
        'latihan_plan',
        'nutrisi_tips',
        'rekomendasi',
    ];

    public function programCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category', 'program_name');
    }
}