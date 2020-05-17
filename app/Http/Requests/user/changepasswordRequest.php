<?php

namespace App\Http\Requests\user;

use App\Http\Requests\Request;

class changepasswordRequest extends Request
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
            //
              'oldpas'=>'required|min:6',
              'newpas'=>'required|min:6',
              'confpas'=>'required|min:6'
            //
    
        ];
    }
}
