<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Models\Country;
use App\Models\Person;
use App\Global\Current;
use Illuminate\Http\Request;

class PersonController extends Controller
{
  public function index(){
    $people = Person::get();
    $columns = $people[0]->getColumns();
    return view('people.index', ['people' => $people, 'columns' => $columns]);
  }
  public function show(Person $person){
    return view('people.show', ['person' => $person, 'mode' => 'read']);
  }
  public function create(){
    $countries = Country::get();
    $person = null; // the model to view its id after inserting
    return view('people.create', ['countries' => $countries, 'mode' => 'new']);
  }
  public function edit(){
    $countries = Country::get();
    return view('people.edit', ['countries' => $countries, 'mode' => 'edit']);
  }
  public function store(StorePersonRequest $request){
    dump($request->toArray());
    $info = $request->validated();
    $path = "";
    if($request->file('file')){
      $path = $request->file('file')->store('images/people','public');
      unset($info['file']);
      $info['image_path'] = $path;
      }
      else{
        $info['gender'] === 'male' ? 
        $info['image_path'] = '/images/defaults/male.png'
        :$info['image_path'] = '/images/defaults/female.png';
      }

    // dd($info);
    $person = Person::create($info);
    return view('people.create', ['person' => $person]);
  }
  public function update(StorePersonRequest $request){
  //   dump($request->toArray());
  //   $info = $request->validated();
  //   $path = "";
  //   if($request->file('file')){
  //     $path = $request->file('file')->store('images/people','public');
  //     unset($info['file']);
  //     $info['image_path'] = $path;
  //     }
  //     else{
  //       $info['gender'] === 'male' ? 
  //       $info['image_path'] = '/images/defaults/male.png'
  //       :$info['image_path'] = '/images/defaults/female.png';
  //     }

  //   // dd($info);
  //   $person = Person::create($info);
  //   return view('people.create', ['person' => $person]);
  // }
  }
}
