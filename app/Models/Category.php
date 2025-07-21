<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = true;

    protected $fillable = [
        'program_name',
        'description',
    ];

    public function programs(): HasMany
    {
        return $this->hasMany(Program::class, 'category_id');
    }
}