<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
  public function index(){
    $items = Application::latest()->get();
    $columns = Application::$columns;
    return view('Applications.index', compact('columns', 'items'));
  }
  public function store(StoreApplicationRequest $request){
    $info = $request->validated();
    Application::create($info);
    return redirect()->route('applications.index');
  }
}
