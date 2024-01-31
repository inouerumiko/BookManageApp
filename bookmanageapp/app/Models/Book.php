<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'isbn',
        'name',
        'published_at',
        'author_id',
        'publisher_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
  ];

    /**
     *
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     *
     */
    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     *
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

}
