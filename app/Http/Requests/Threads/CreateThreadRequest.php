<?php

declare(strict_types=1);

namespace App\Http\Requests\Threads;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $name
 * @property int $topic_id
 * @property int $user_id
 * @property string $content
 */
class CreateThreadRequest extends FormRequest
{
    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'min:5'],
            'topic_id' => ['required', 'integer', 'exists:topics,id'],
            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
                Rule::in([request()->user()->id]),
            ],
            'content' => ['required', 'string', 'max:65535', 'min:1'],
        ];
    }
}
