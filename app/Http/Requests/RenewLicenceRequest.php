<?php

namespace App\Http\Requests;

use App\Enums\ApplicationTypes;
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
      // return LicenceOperatisonRules::baseRules();
    return [
      'licence_renew_service' => ['required'],
      'licence_id' => ['required', 'exists:licences,id'],
    ];

    }
    public function detainedLicenceCase($validator, $licence){
      if($licence->isDetained()){
        $validator->errors()->add(
          'licence_renew_service',
          'Release licence first.'
        );
      }
    }
    public function ExpiredLicenceCase($validator, $licence){
      if(!$licence->isExpired()){
        $validator->errors()->add(
          'licence_renew_service',
          'Licence is not expired.'
        );
      }
    }
    public function withValidator($validator){
      $validator->after(function($validator){
        if($validator->errors()->has('licence_renew_service')){
          return;
        }
        $licence = Licence::findOrFail($this->input('licence_id'));
        self::ExpiredLicenceCase($validator, $licence);
        self::detainedLicenceCase($validator, $licence);
        $this['licence_service'] = ApplicationTypes::RenewLicence->value;
        LicenceOperatisonRules::operationApplicationExists($this, $validator, $licence);
      });
    }
}
