<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
  protected $table = "comment";
  protected $fillable = [
      'content',
  ];

  public function user()
{
  return $this->belongsTo('App\User');
}

public function menu()
{
return $this->belongsTo('App\MenuModel');
}



}
