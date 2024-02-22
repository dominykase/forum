<?php

declare(strict_types=1);

namespace App\Modules\Posts\UseCases;

use App\Models\User;
use App\Modules\Posts\Repositories\PostRepository;
use App\Modules\Threads\Repositories\ThreadRepository;

class CreatePostUseCase
{
    public function __construct(
        private PostRepository $postRepository,
        private ThreadRepository $threadRepository,
    ) {
    }

    public function handle(User $user, int $threadId, string $content): void
    {
        $this->postRepository->create([
            'user_id' => $user->id,
            'thread_id' => $threadId,
            'content' => $content,
        ]);

        $this->threadRepository->incrementPostsCount($threadId);
    }
}
