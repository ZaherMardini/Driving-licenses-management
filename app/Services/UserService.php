<?php

namespace App\Services;

use App\Global\Methods;
use App\Models\User;
use Illuminate\Http\Request;

class UserService{
  public function baseQuery(){
    return User::join('people', 'people.id', '=', 'users.person_id')
              ->select(
              'users.id',
              'users.name',
              'users.email',
              'users.person_id',
              'users.isActive',
              'people.name as person_name'
          );
  }
  public function index(){
    $results = self::baseQuery();
    $results = $results->orderBy('users.created_at', 'desc')->get();
    return view('users.index',[
    'users' => $results,
    'columns' => User::$columns,
    'searchBy' => User::searchBy(),
    'searchRoutes' => User::$searchRoutes
    ]);
  }

  public function filter(Request $request){
    $searchBy = User::searchBy();
    $results = self::baseQuery();
    $numeric = User::numericKeys();
    return Methods::filter($results, $request, $searchBy, $numeric);
  }

}