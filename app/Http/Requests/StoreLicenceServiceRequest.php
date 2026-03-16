<?php

namespace App\Http\Requests;

use App\Models\Licence;
use App\Rules\LicenceOperatisonRules;

use Illuminate\Foundation\Http\FormRequest;

class StoreLicenceServiceRequest extends FormRequest
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
      return [
        // LicenceOperatisonRules::baseRules()
      'service_type' => ['required'],
      'licence_id' => ['required', 'exists:licences,id'],

      ];
    }
    public function withValidator($validator){
      $validator->after(function($validator){
        $licence = Licence::findOrFail($this->input('licence_id'));
        LicenceOperatisonRules::operationApplicationDuplicated($this, $validator, $licence);
      });
    }
}
