<?php

declare(strict_types=1);

namespace App\Modules\Posts\Repositories;

use App\Modules\Posts\Models\Post;

class PostRepository
{
    /**
     * @param array<string, mixed> $attributes
     */
    public function create(array $attributes = []): Post
    {
        return Post::query()->create($attributes);
    }
}
