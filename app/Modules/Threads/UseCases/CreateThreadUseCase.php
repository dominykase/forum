<?php

declare(strict_types=1);

namespace App\Modules\Threads\UseCases;

use App\Modules\Posts\Repositories\PostRepository;
use App\Modules\Threads\Repositories\ThreadRepository;

class CreateThreadUseCase
{
    const DEFAULT_PAGE = 1;
    const PER_PAGE = 10;

    public function __construct(
        private ThreadRepository $threadRepository,
        private PostRepository $postRepository,
    ) {
    }

    /**
     * @return array<int, mixed>
     */
    public function handle(
        string $name,
        int $topicId,
        int $userId,
        string $content,
    ): int {
        $thread = $this->threadRepository->create([
            'name' => $name,
            'topic_id' => $topicId,
            'user_id' => $userId,
        ]);

        $post = $this->postRepository->create([
            'thread_id' => $thread->id,
            'user_id' => $userId,
            'content' => $content,
        ]);

        $this->threadRepository->incrementPostsCount($thread->id);

        return $thread->id;
    }
}
