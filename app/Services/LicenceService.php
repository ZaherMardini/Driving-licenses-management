<?php

namespace App\Services;

use App\Enums\ApplicationStatus;
use App\Enums\ApplicationTypes;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\Licence;
use App\Models\LicenceOperationApplication;
use App\Models\LocalLicence;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LicenceService{
  public function createLicenceOperationApplication(Licence $licence, ApplicationType $type){
    DB::transaction(function() use($licence, $type){
      $applicaiton = 
      Application::create([
        'application_type_id' => $type['id'],
        'created_by_user' => Auth::id(),
        'person_id' => $licence['person_id'],
        'fees' => $type['base_application_fee'] + $type['fees'], 
        'status' => ApplicationStatus::New->value,
      ]);
      LicenceOperationApplication::
      create([
        'application_id' => $applicaiton['id'],
        'application_type_id' => $type['id'],
        'licence_id' => $licence['id'],
      ]);
    });
  }
}