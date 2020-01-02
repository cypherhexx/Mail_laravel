<?php namespace App\Http\Requests\Admin\Helpdesk\Ticket;

use App\Http\Requests\Request;

class TicketDepartmentRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->segment(5);
		return [
            'name' => 'bail|required|max:20|unique:ticket_departments,name,' . $id,
            'description' => 'bail|required|max:20|unique:ticket_departments,description,' . $id,
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
