<?php

declare(strict_types=1);

namespace App\Http\Controllers\Threads;

use App\Http\Controllers\Controller;
use App\Modules\Threads\UseCases\GetPaginatedThreadUseCase;
use Illuminate\Contracts\View\View;

class ThreadController extends Controller
{
    public function view(
        int $threadId,
        int $page = 1,
        GetPaginatedThreadUseCase $getPaginatedThreadUseCase,
    ): View {
        [$thread, $posts] = $getPaginatedThreadUseCase->handle($threadId, $page);

        return view('threadview', [
            'thread' => $thread,
            'posts' => $posts,
        ]);
    }
}