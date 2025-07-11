<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    // data Book disimpan di table books
    protected $table = 'books';

    // kolom yang bisa di mass assign
    protected $fillable = [
        'title',
        'author',
        'published_year',
        'category',
        'isbn',
        'excerpt',
    ];

    public function bookCategory(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category', 'name');
    }
}