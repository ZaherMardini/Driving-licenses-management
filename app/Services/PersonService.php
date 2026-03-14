<?php


namespace App\Services;

use App\Global\Methods;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonService{
  protected $request;
  protected $validInfo;
  protected $results;
  public function baseQuery()
  {
   return Person::orderBy('created_at', 'desc');
  }

  public function init(Request $request){
    $this->request = $request;
  }
  public function initStore(StorePersonRequest $request){
    $this->request = $request;
    $this->validInfo = $request->validated();
  }
  public function initUpdate(UpdatePersonRequest $request){
    $this->request = $request;
    $this->validInfo = $request->validated();
  }
  public function handlePersonInfo(){
    $info = $this->validInfo;
    $path = "";
    if($this->request->file('file')){
      $path = $this->request->file('file')->store('images/people','public');
      unset($info['file']);
      $info['image_path'] = $path;
      }
      else{
        $info['gender'] === 'male' ? 
        $info['image_path'] = '/images/defaults/male.png'
        :$info['image_path'] = '/images/defaults/female.png';
      }
    return $info;
  }

  public function index(){
    $people = self::baseQuery()->get();
    $columns = Person::$columns;
    $searchBy = Person::searchBy();
    $searchRoutes = ['filter' => 'person.filter', 'find' => 'person.find'];
    return view('people.index', compact('people', 'columns', 'searchBy', 'searchRoutes'));
  }
  public function update(UpdatePersonRequest $request, Person $person){
    $this->initUpdate($request);
    $person->deleteImage();
    $info = $this->handlePersonInfo();
    $person->update($info);
  }
  public function store(StorePersonRequest $request){
    $this->initStore($request);
    $request = $this->request;
    $info = $this->handlePersonInfo();
    Person::create($info);
  }
  public function filter(Request $request){
    return Methods::filter(self::baseQuery(), $request, Person::searchBy(), Person::numericKeys());
  }
  public function filter_old(Request $request){
    $this->init($request);
    $request = $this->request;
    $searchKey = $request['searchKey'];
    $value = $request['value'];
    $people = null;
    if($searchKey === 'id' && $value != ''){
      $people = Person::where($searchKey, $value)->get();
    }
    else{
      $people = Person::where($request['searchKey'],'like', '%' . $request['value'] . '%')->get();
    }
    return response()->json($people);
  }
}