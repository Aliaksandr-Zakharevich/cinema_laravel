<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHallRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:2',
            'rows_count' => 'required|numeric',
            'seats_in_row' => 'required|numeric',
            'opening_time' => 'required|string',
            'closing_time' => 'required|string',
            'cleaning_time' => 'required|numeric',
        ];
    }
}
