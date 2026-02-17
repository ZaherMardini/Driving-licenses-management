<?php

namespace App\Http\Controllers;

use App\Enums\ApplicationStatus;
use App\Enums\ApplicationTypes;
use App\Http\Requests\StoreLocalLicenceRequest;
use App\Models\Application;
use App\Models\ApplicationType;
use App\Models\LocalLicence;
use App\Services\LocalLicenceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LocalLicenceController extends Controller
{
  protected $service;
  public function __construct(LocalLicenceService $service){
    $this->service = $service;
  }
  public function index(){
    return $this->service->index();
  }
  public function create(){
    return view('LocalLicence.create');  
  }
  public function store(StoreLocalLicenceRequest $request){
    return $this->service->store($request);
  }
  public function edit(){
    dd('not implemented');
  }
    public function update(){
    dd('not implemented');
    return view('LocalLicence.create');
  }
}
