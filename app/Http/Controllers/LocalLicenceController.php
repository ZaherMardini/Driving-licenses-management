<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Enums\ApplicationTypes;
use App\Http\Requests\StoreLocalLicenceRequest;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\LocalLicence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LocalLicenceController extends Controller
{
  public function index(){
    $items = LocalLicence::
    join('applications', 'applications.id', '=', 'local_licences.application_id')
    ->join('licence_classes', 'licence_classes.id', '=', 'local_licences.licence_class_id')
    ->join('people', 'people.id', '=', 'applications.person_id')
    ->select(
      'local_licences.id as licence_id',
      'people.id as person_id',
      'people.name',
      'people.national_no',
      'applications.id as application_id',
      'licence_classes.id as licence_class_id',
      'licence_classes.title as licence_class',
      'local_licences.created_at'
    )->get();
    foreach ($items as $item) {
      $item->created_at = $item->created_at->format('Y-m-d');
    }
    // dd($items->get());
    $columns = LocalLicence::$columns;
    return view('localLicence.index', ['columns' => $columns, 'items' => $items]);
  }
  public function create(){
    return view('LocalLicence.create');  
  }
  public function store(StoreLocalLicenceRequest $request){
    DB::transaction(function () use($request) {
      $type = ApplicationType::findOrFail(ApplicationTypes::newlicence->value);
      $info = $request->validated();
      $applicationProps = [
        'application_type_id' => $type['id'],
        'created_by_user' => Auth::id(),
        'person_id' => $info['person_id'],
        'fees' => $type['fees'],
        'status' => ApplicationStatus::New->value,
      ];
      $application = Application::create($applicationProps);
      $info['application_id'] = $application['id'];
      unset($info['person_id']);
      LocalLicence::create($info);
      });
      return redirect()->route('applications.index');
  }
  public function edit(){
    dd('not implemented');
  }
    public function update(){
    dd('not implemented');
    return view('LocalLicence.create');
  }
}
