<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
      return [
          'firstName' => 'required',
          'lastName' => 'required',
          'email' => 'example|email'
      ];
    }
    public function messages()
    {
        return [
            'firstName.required' => 'First name is required',
            'lastName.required' => 'Last name is required',
            'email.email' => 'Email address provided is not correct'
        ];
    }
}
