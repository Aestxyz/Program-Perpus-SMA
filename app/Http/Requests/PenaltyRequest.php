<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenaltyRequest extends FormRequest
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
            'name' => 'string|min:5',
            'amount' => 'required|numeric',
            'lates_day' => 'required|string',
            'payment_date' => 'required|date',
            'description' => 'string|min:5',
        ];
    }
}
