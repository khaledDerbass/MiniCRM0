<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

  protected $fillable = [
      'firstName', 'lastName', 'company', 'email', 'phone'
  ];

  public function company()
  {
    return $this->belongsTo('App\Company', 'company');
  }
}
