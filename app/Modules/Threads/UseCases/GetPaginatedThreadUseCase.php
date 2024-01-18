<?php

declare(strict_types=1);

namespace App\Modules\Threads\UseCases;

use App\Modules\Threads\Repositories\ThreadRepository;

class GetPaginatedThreadUseCase
{
    public function __construct(
        private ThreadRepository $threadRepository,
    ) {
    }

    /**
     * @return array<int, mixed>
     */
    public function handle(int $threadId, int $page = 1): array
    {
        $thread = $this->threadRepository->findOrFailById($threadId);

        $posts = $thread->posts()
            ->orderBy('created_at', 'asc')
            ->paginate(20, ['*'], 'page', $page);

        return [$thread, $posts];
    }
}
