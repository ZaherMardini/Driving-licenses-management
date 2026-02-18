<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalLicence extends Model
{
    /** @use HasFactory<\Database\Factories\LocalLicenseFactory> */
    use HasFactory;

    public static $columns = [
      'Licence ID' => 'licence_id',
      'Person ID' => 'person_id', 
      'Person name' => 'name', 
      'Person national no' => 'national_no',
      'Licence Class ID' => 'licence_class_id', 
      'Licence Class' => 'licence_class', 
      'Application ID' => 'application_id', 
      'Passed tests' => '',
      'Status' => 'status',
    ];
    public static $searchRoutes = ['find'=>'localLicence.find', 'filter'=>'localLicence.filter'];
    public static function numericKeys() {
      return collect(self::$columns)->only('Licence ID', 'Person ID', 'Application ID', 'licence_class_id')->toArray();
    }
    public static function searchBy_desired(){
      return collect(self::$columns)->only('Licence ID', 'Person ID', 'Status')->toArray();
    }
    public static function searchBy(){
     return [
      'Licence ID' => 'local_licences.id',
      'Person ID' => 'people.id', 
      'Person name' => 'people.name', 
      'Person national no' => 'people.national_no',
      'Licence Class ID' => 'local_licences.licence_class_id', 
      'Licence Class' => 'licence_classes.title', 
      'Application ID' => 'applications.id', 
      'Passed tests' => '',
      'Status' => 'status',
      ];
    }
    public static function isUniqueApplication(int $person_id, int $class_id){
      $count = LocalLicence::
      join('applications', 'applications.id', '=', 'local_licences.application_id')
      ->join('people', 'people.id', '=', 'applications.person_id')
      ->select(
        'local_licences.id',
        'people.id as person_id',
        'local_licences.licence_class_id',
      )->where('people.id', $person_id)
      ->where('local_licences.licence_class_id', $class_id)
      ->count();
      return $count === 0;
    }
    protected $casts = [
      'created_at' => 'date:Y-m-d',
    ];
}
