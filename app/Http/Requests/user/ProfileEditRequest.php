<?php

namespace App\Http\Requests\user;

use App\Http\Requests\Request;

class ProfileEditRequest extends Request
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
              // 'firstname'=>'required|min:3',
              // 'lastname'=>'required|min:1',
              // 'mobile'=>'required|min:10|numeric',
              // 'dd'=>'required',
              // 'mm'=>'required',
              // 'year'=>'required',
              'gender'=>'required',
              // 'zipcode'=>'required',
              'address1'=>'required',
               'email' => 'required|Email',
              //'city'=>'required',
              'country'=>'required',
              'prof_details'=>'',
            //
        ];
    }
}
