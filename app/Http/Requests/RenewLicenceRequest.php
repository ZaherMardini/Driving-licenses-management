<?php

namespace App\Http\Requests;

use App\Models\Licence;
use App\Rules\LicenceOperatisonRules;
use Illuminate\Foundation\Http\FormRequest;

class RenewLicenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      // dd($this->toArray());
      return LicenceOperatisonRules::baseRules();
    }
    public function detainedLicenceCase($validator, $licence){
      if($licence->isDetained()){
        $validator->errors()->add(
          'licence_service',
          'Release licence first.'
        );
      }
    }
    public function withValidator($validator){
      $validator->after(function($validator){
        if($validator->errors()->has('licence_action')){
          return;
        }
        $licence = Licence::findOrFail($this->input('licence_id'));
        LicenceOperatisonRules::operationApplicationExists($this, $validator, $licence);
        self::detainedLicenceCase($validator, $licence);
      });
    }
}
