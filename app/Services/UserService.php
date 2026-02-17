<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UserService{
  public function index(){
    $results = User::join('people', 'people.id', '=', 'users.person_id')
    ->select(
        'users.id',
        'users.name',
        'users.email',
        'users.person_id',
        'users.isActive',
        'people.name as person_name'
    )
    ->orderBy('users.created_at', 'desc')
    ->get();
    return view('users.index',[
    'users' => $results,
    'columns' => User::$columns,
    'searchBy' => User::searchBy(),
    'searchRoutes' => User::$searchRoutes
    ]);
  }

  public function filter(Request $request){
    $prop = $request['prop'];
    $value = $request['value'];
    $searchBy = User::searchBy();
    $numeric = collect($searchBy)->only(['User ID', 'Person ID'])->toArray();
    if(!in_array($prop, $searchBy, true)){
        return response()->json(abort('401','Invalid filter'));
      };
      $results = User::join('people', 'people.id', '=', 'users.person_id')
      ->select(
          'users.id',
          'users.name',
          'users.email',
          'users.person_id',
          'users.isActive',
          'people.name as person_name'
      );
    if(in_array($prop, $numeric, true) && $value != ''){
      $results->where($prop, $value);
    }
    else{
      $results->where($prop, 'like', "%{$value}%");
    };
    return response()->json($results->get());
  }

}