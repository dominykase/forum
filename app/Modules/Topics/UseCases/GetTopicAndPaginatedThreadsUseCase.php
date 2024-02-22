<?php

declare(strict_types=1);

namespace App\Modules\Topics\UseCases;

use App\Modules\Topics\Repositories\TopicRepository;
use App\Services\PaginationService;

class GetTopicAndPaginatedThreadsUseCase
{
    public function __construct(
        private TopicRepository $topicRepository,
    ) {
    }

    public function handle(int $topicId, int $page = 1, int $perPage = 20): array
    {
        $topic = $this->topicRepository->findById($topicId);
        $threads = $topic
            ->threads()
            ->paginate($perPage, ['*'], 'page', $page);

        return [$topic, $threads, $threads->total(), $page, $perPage];
    }
}
