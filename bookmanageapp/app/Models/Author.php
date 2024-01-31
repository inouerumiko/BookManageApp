<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
  ];

    /**
     *
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }

    /**
     *
     */
    public function relatedPublishers()
    {
        return $this->belongsToMany(Publisher::class, 'books');
        // return $this->hasManyThrough(Book::class, Publisher::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function ($author) {
            $author->books()->delete();
        });
    }
}
