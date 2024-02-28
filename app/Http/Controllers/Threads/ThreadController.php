<?php

declare(strict_types=1);

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Http\Requests\Threads\CreateThreadRequest;
use App\Modules\Threads\UseCases\CreateThreadUseCase;
use App\Modules\Threads\UseCases\GetPaginatedThreadUseCase;
use App\Services\PaginationService;
use Illuminate\Contracts\View\View;

class ThreadController extends Controller
{
    public function __construct(
        private GetPaginatedThreadUseCase $getPaginatedThreadUseCase,
        private PaginationService $paginationService,
        private CreateThreadUseCase $createThreadUseCase,
    ) {
    }

    public function view(
        int $threadId,
        int $page = 1,
    ): View {
        [$thread, $posts, $hasPages, $totalPosts] = $this->getPaginatedThreadUseCase->handle($threadId, $page);

        $pageNumbers = $this->paginationService->getPageSwitcherNumbers($page, $totalPosts);

        return view('threadview', [
            'thread' => $thread,
            'posts' => $posts,
            'pageNum' => $page,
            'pageNumbers' => $pageNumbers,
        ]);
    }

    public function create(
        CreateThreadRequest $request,
    ): View {
        [$thread, $posts] = $this->createThreadUseCase->handle(
            $request->name,
            intval($request->topic_id),
            intval($request->user_id),
            $request->content,
        );

        return view('threadview', [
            'thread' => $thread,
            'posts' => $posts,
            'pageNum' => 1,
            'pageNumbers' => [1],
        ]);
    }
}
