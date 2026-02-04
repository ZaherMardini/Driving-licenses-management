<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Country;
use App\Models\Person;
use App\Global\Current;
use App\Http\Requests\UpdatePersonRequest;
use App\Services\PersonService;
use Illuminate\Http\Request;

class PersonController extends Controller
{
  protected $service;
  public function __construct(PersonService $service)
  {
    $this->service = $service;
  }
  public function index(){
    $people = Person::latest();
    $people = $people->get();
    return view('people.index', ['people' => $people, 'columns' => Person::$columns]);
    // $people = Person::latest()->simplePaginate(10);
  }
  public function show(Person $person){
    $countries = Country::get();
    return view('people.person', ['mode' => 'read', 'countries' => $countries]);
  }
  public function create(){
    $countries = Country::get();
    return view('people.person', ['person' => null,'countries' => $countries, 'mode' => 'new']);
  }
  public function edit(){
    $countries = Country::get();
    return view('people.person', ['countries' => $countries, 'mode' => 'edit']);
  }
public function store(StorePersonRequest $request){
  dd('store');
  $this->service->initStore($request);
  $info = $this->service->handlePersonInfo();
  $person = Person::create($info);
  Current::$person = $person;
  return redirect()->route('person.index');
  }
  public function update(UpdatePersonRequest $request, Person $person){
    $this->service->initUpdate($request);
    $person->deleteImage();
    $info = $this->service->handlePersonInfo();
    $person->update($info);
    return redirect()->route('person.index');
  }
  public function search(Request $request){
    $people = Person::where($request['prop'],'like', '%' . $request['search'] . '%')->get();
    return response()->json($people);
  }
  public function findFirst(Request $request){
    $person = Person::where($request['prop'],'like', '%' . $request['search'] . '%')->first();
    Current::$person = $person;
    return response()->json($person);
  }
}
