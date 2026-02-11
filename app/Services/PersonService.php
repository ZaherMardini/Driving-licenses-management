<?php


namespace App\Services;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Storage;

class PersonService{
  protected $request;
  protected $validInfo;

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
    $people = Person::latest();
    $people = $people->get();
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
    return redirect()->route('person.index');
  }
  public function store(StorePersonRequest $request){
    $this->initStore($request);
    $request = $this->request;
    $info = $this->handlePersonInfo();
    Person::create($info);
    return redirect()->route('person.index');
  }
  public function filter(Request $request){
    $this->init($request);
    $request = $this->request;
    $prop = $request['prop'];
    $value = $request['value'];
    $people = null;
    if($prop === 'id' && $value != ''){
      $people = Person::where($prop, $value)->get();
    }
    else{
      $people = Person::where($request['prop'],'like', '%' . $request['value'] . '%')->get();
    }
    return response()->json($people);
  }
}