<?php

declare(strict_types=1);

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'thread_id' => ['required', 'integer', 'exists:threads,id'],
            'content' => ['required', 'string', 'max:65535', 'min:1'],
        ];
    }
}
