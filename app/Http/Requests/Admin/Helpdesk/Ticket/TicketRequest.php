<?php namespace App\Http\Requests\Admin\Helpdesk\Ticket;

use App\Http\Requests\Request;

class TicketRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->segment(4);
		return [
            'subject' => 'bail|required|max:60000|unique:tickets,subject,'.$id,           
            'description' => 'bail|required|max:60000|unique:tickets,description,'.$id,           
            'priority' => 'bail|required',           
            'department' => 'bail|required',           
            'category' => 'bail|required',           
            'status' => 'bail|required',     
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
