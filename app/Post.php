<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	 protected $fillable = [
      'title', 'des','category_id', 'user_id',
  	];
     protected $hidden = [
        'category_id', 'user_id',
    ];
     public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
