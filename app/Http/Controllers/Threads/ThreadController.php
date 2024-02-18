<?php

declare(strict_types=1);

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Modules\Threads\UseCases\GetPaginatedThreadUseCase;
use App\Services\PaginationService;
use Illuminate\Contracts\View\View;

class ThreadController extends Controller
{
    public function view(
        GetPaginatedThreadUseCase $getPaginatedThreadUseCase,
        PaginationService $paginationService,
        int $threadId,
        int $page = 1,
    ): View {
        [$thread, $posts, $hasPages, $totalPosts] = $getPaginatedThreadUseCase->handle($threadId, $page);

        $pageNumbers = $paginationService->getPageSwitcherNumbers($page, $totalPosts);

        return view('threadview', [
            'thread' => $thread,
            'posts' => $posts,
            'pageNum' => $page,
            'pageNumbers' => $pageNumbers,
        ]);
    }
}
