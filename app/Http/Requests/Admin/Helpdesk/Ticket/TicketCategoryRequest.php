<?php namespace App\Http\Requests\Admin\Helpdesk\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class TicketCategoryRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'category' => 'min:1',
            'description' => 'min:1',
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
