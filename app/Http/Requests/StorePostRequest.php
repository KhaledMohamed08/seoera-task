<?php

namespace App\Http\Requests;

use App\Rules\MaxByteSize;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'user_id' => 'exists:users,id',
            'title' => 'required|string|max:255',
            'description' => ['required', 'string', new MaxByteSize(2048)],
            'contact_phone_number' => 'required|string|max:15',
        ];
    }
}
