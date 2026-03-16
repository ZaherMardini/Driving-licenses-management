<?php
namespace App\Rules;

use App\Models\Licence;

class LicenceOperatisonRules{
  public static function baseRules(){
    return [
      'licence_action' => ['required'],
      'licence_id' => ['required', 'exists:licences,id'],
    ];
  }
  public static function operationApplicationExists($request, $validator, $licence){
    $typeId = Licence::$action2TypeId[$request->input('licence_action')];
    $applicationExists = Licence::applicationExists($licence, $typeId);
    if(!$applicationExists){
      $errorMessage = 'You need an application for this service.';
      if($errorMessage){
        $validator->errors()->add('licence_action', $errorMessage);
      }
    }
  }
  public static function operationApplicationDuplicated($request, $validator, $licence){
    $typeId = Licence::$action2TypeId[$request->input('licence_action')];
    $applicationExists = Licence::applicationExists($licence, $typeId);
    if($applicationExists){
      $errorMessage = 'There is an application for this service.';
      if($errorMessage){
        $validator->errors()->add('licence_action', $errorMessage);
      }
    }
  }
}