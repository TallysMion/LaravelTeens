<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_activity extends Model
{
  protected $fillable = [
      'value', 'user', 'activity',
  ];
}
