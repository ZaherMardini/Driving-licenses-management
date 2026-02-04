<?php


namespace App\Services;
use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use Illuminate\Support\Facades\Storage;

class PersonService{
  protected $request;
  protected $validInfo;

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
}