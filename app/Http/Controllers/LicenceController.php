<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Enums\LicenceStatus;
use App\Http\Requests\StoreLicenceRequest;
use App\Models\Application;
use App\Models\Driver;
use App\Models\Licence;
use App\Models\LocalLicence;
use Carbon\Carbon;
use Database\Seeders\LocalLicenceSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LicenceController extends Controller
{
  public function store(LocalLicence $localLicence, StoreLicenceRequest $request){
    $info = $request->validated();
    $licence = DB::transaction(function() use($info, $localLicence) {
      $localLicence->load(['person', 'licenceClass']);
      $driver = Driver::create(['person_id' => $localLicence['person_id']]);
      $info['driver_id'] = $driver['id'];
      $info['licence_number'] = Licence::generateNumber();
      $info['status'] = LicenceStatus::new->value;
      $info['image'] = $localLicence['person']['image_path'];
      $info['licence_class_id'] = $localLicence['licenceClass']['id'];
      $info['issue_date'] = now();
      $issue_date = Carbon::parse($info['issue_date']);
      $info['expiry_date'] = $issue_date->addYears($localLicence['licenceClass']['valid_years']);
      $licence = Licence::create($info);
      $licence->load(['local_licence','person']);
      $local_licence = LocalLicence::
      where('person_id', $licence['person_id'])
      ->where('licence_class_id', $licence['licence_class_id'])
      ->first();
      Application::find($local_licence['application_id'])->update(['status' => ApplicationStatus::Completed->value]);
      return $licence;
      });
      return redirect()->route('licence.show', compact('licence'));
      }
  public function show(Licence $licence){
    $licence->load(['local_licence','person', 'licence_class']);
    return view('licence.show', compact( 'licence'));
  }
}
