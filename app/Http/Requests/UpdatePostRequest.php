<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Rules\MaxByteSize;
use App\Services\PostService;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $postId = basename(request()->requestUri);
        $post = app(PostService::class)->find($postId);

        return auth('api')->check() && auth('api')->id() === $post->user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'string|max:255',
            'description' => ['string', new MaxByteSize(2048)],
            'contact_phone_number' => 'string|max:15',
        ];
    }
}
