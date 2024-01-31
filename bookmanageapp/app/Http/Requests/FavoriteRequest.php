<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteRequest extends FormRequest
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
            'user_id' => [
                'required',
                Rule::exists('users','id')->where(function ($query) {
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
        $this->merge(['user_id' => Auth::id()]);
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
