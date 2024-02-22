<?php

declare(strict_types=1);

namespace App\Modules\Threads\Repositories;

use App\Modules\Threads\Models\Thread;

class ThreadRepository
{
    public function findOrFailById(int $threadId): Thread
    {
        return Thread::query()->findOrFail($threadId);
    }

    public function incrementPostsCount(int $threadId): void
    {
        Thread::query()->where('id', $threadId)->increment('posts_count');
    }
}
