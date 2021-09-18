<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'img',
        'pub_date',
        'no_pages',
        'lang'
    ];


    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id','id');
    }

}
