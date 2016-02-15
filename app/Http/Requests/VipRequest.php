<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class VipRequest extends Request
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
'pname'=>'required',
'pdesg'=>'required',
'check'=>'required',
'agreedname'=>'required',
'checkindate'=>'required'


        ];
    }
    public function messages()
    {
        return [
            'pname.required' => 'Please enter primary deleagate name',
            'pdesg.required' => 'Please enter primary delegate designation',
            'check.required'=>'Please Accept the Terms & Conditions' ,          
          'agreedname.required' => 'Please enter agreed by name',
            'checkindate.required'=>'Please enter date of agreement'           
        
        ];
    }

}
