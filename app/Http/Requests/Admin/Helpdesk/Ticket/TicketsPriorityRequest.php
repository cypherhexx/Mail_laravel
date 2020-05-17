<?php namespace App\Http\Requests\Admin\Helpdesk\Ticket;

use App\Http\Requests\Request;

class TicketsPriorityRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->segment(5);
		
		return [
            
            'priority'                                     => 'required|max:10',
            'status'                                        => 'required',
            'priority_desc'                                 => 'required|max:255',
            'priority_color'                                => 'required',
            'ispublic'                                     => 'required',
            'admin_note'                                     => 'required',
            'priority_successfully_updated'                => 'priority successfully updated',
            'priority_successfully_created!!!'=> 'priority successfully created',

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
