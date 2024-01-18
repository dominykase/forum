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
}
