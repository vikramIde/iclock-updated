<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends Request
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
             
     
        foreach($this->request->get('eventcode') as $key => $val)
                      {
                        $rules['eventcode.'.$key] = 'required';
                      }
        foreach($this->request->get('date') as $key => $val)
                      {
                        $rules['date.'.$key] = 'required';
                      }

         foreach($this->request->get('city') as $key => $val)
                      {
                        $rules['city.'.$key] = 'required';
                      }
       foreach($this->request->get('country') as $key => $val)
                      {
                        $rules['country.'.$key] = 'required';
                      }
         foreach($this->request->get('eventname') as $key => $val)
                      {
                        $rules['eventname.'.$key] = 'required';
                      }


        return $rules;


    }



}
