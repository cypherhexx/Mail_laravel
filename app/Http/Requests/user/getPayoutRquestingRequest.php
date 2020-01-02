<?php

namespace App\Http\Requests\user;

use App\Http\Requests\Request;

class getPayoutRquestingRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
              'req_amount'=>'required|numeric|min:3',
            //
    
        ];
    }
}
