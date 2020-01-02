<?php namespace App\Http\Requests\Admin\Helpdesk\Ticket;

use App\Http\Requests\Request;

class TicketCannedResponseRequest extends Request {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->segment(5);
		return [
            'title' => 'required|max:20|unique:ticket_canned_responses,title,' . $id,
            'subject' => 'required|max:100|unique:ticket_canned_responses,subject,' . $id,
            'message' => 'required|unique:ticket_canned_responses,message,' . $id,
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
