<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
  protected $table = "menu";
  protected $fillable = [
      'name', 'image', 'price',
  ];

  public function user()
{
  return $this->belongsTo('App\User');
}

public function CommentModel() {
return $this->hasMany("App\CommentModel", 'menu_id', 'id');
}

}
