<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
      return [
          'name' => 'required',
          'email' => 'exmple|email',
          'url' => 'example|url',
          'logo' => 'dimensions:min_width=100,min_height=100',
      ];
    }
    public function messages()
    {
      return [
          'name.required' => 'Name of company is required',
          'email.email' => 'Email address provided is not correct',
          'website.url' => 'URL provided is not valid',
          'logo.dimensions' => 'Logo dimensions minimum 100x100 Pixels'
      ];
    }
}
