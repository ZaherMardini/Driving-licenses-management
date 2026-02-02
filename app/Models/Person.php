<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
  use HasFactory;

  public $columns = [
    'ID' => 'id',
    'Name' => 'name',
    'Phone' => 'phone',
    'Email' => 'email',
    'Gender' => 'gender',
    'National No' => 'national_no',
    'Date of birth' => 'date_of_birth',
  ];
  protected $guarded = [];
  public function getColumns(){
    return $this->columns;
  }
  public function applications(){
    return $this->hasMany(Application::class);
  }
}
