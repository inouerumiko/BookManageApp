<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BookUpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                Rule::exists('books', 'id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'isbn' => 'max:255',
            'name' => 'max:255',
            'published_at' => 'date',
            'author_id' => [
                Rule::exists('authors','id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'publisher_id' => [
                Rule::exists('publishers','id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
        ];
    }

    /**
     * Handle prepare for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge(['id' => $this->route('id')]);
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
            'errors' => $validator->errors(),
        ],400);
        throw new HttpResponseException($res);
    }
}
