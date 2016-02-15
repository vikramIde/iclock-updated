<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LeadsheetRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
     public function rules()
    {
        return [
'company_name'=>'required',
'country'=>'required',
'website'=>'required|url'

        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Please enter company name',
            'country.required' => 'Please enter country name',
            'website.url' => 'A valid URL is required'
            
        
        ];
    }

}
