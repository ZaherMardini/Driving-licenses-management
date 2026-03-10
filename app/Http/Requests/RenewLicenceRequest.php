<?php

namespace App\Http\Requests;

use App\Models\Licence;
use Illuminate\Foundation\Http\FormRequest;

class RenewLicenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
          'licence_action' => ['required'],
          'licence_id' => ['required', 'exists:licences,id'],
        ];
    }
    public function withValidator($validator){
      $validator->after(function($validator){
        if($validator->errors()->has('licence_action')){
          return;
        }
        $licence = Licence::findOrFail($this->input('licence_id'));
        if($licence->isDetained()){
          $validator->errors()->add(
            'licence_action',
            'This licence is already detained.'
          );
        }
      });
    }
}
