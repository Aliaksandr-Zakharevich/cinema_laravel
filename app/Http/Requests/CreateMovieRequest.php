<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovieRequest extends FormRequest
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
            'description' => 'nullable|min:2',
            'duration' => 'nullable|integer',
            'age_limit' => 'nullable|integer',
            'release_year' => 'nullable|integer',
            'film_director' => 'nullable|min:2',
            'poster' => 'nullable',
            'trailer' => 'nullable',
            'genres' => 'nullable'
        ];
    }
}
