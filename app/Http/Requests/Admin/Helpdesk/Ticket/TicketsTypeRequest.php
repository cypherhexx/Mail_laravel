<?php namespace App\Http\Requests\Admin\Helpdesk\Ticket;

use App\Http\Requests\Request;

class TicketsTypeRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->segment(5);
		
		return [
            
            'name'                                     => 'required|max:30',
            'description'                                     => 'required|max:30',
            'status'                                        => 'required',            
            'ispublic'                                     => 'required',
            'admin_note'                                     => 'required'

		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
