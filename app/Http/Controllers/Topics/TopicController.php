<?php

declare(strict_types=1);

namespace App\Http\Controllers\Topics;

use App\Http\Controllers\Controller;
use App\Modules\Topics\UseCases\GetTopicAndPaginatedThreadsUseCase;
use App\Services\PaginationService;
use Illuminate\View\View;

class TopicController extends Controller
{
    public function get(
        GetTopicAndPaginatedThreadsUseCase $useCase,
        PaginationService $paginationService,
        int $topicId,
        int $page = 1,
    ): View {
        [$topic, $threads, $total, $page, $perPage] = $useCase->handle($topicId, $page);

        return view('topic', [
            'topic' => $topic,
            'threads' => $threads,
            'pagination' => $paginationService->getPageSwitcherNumbers($page, $total, $perPage),
        ]);
    }
}

