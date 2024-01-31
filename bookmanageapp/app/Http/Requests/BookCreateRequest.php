<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class BookCreateRequest extends FormRequest
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
            'isbn' => 'required|max:255',
            'name' => 'required|max:255',
            'published_at' => 'required|date',
            'author_id' => [
                'required',
                Rule::exists('authors','id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'publisher_id' => [
                'required',
                Rule::exists('publishers','id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
        ];
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
