<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'book_id',
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
  public function user()
  {
      return $this->belongsTo(User::class);
  }

  /**
   *
   */
  public function book()
  {
      return $this->belongsTo(Book::class);
  }
}
