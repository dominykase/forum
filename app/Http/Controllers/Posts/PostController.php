<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Modules\Posts\UseCases\CreatePostUseCase;
use Illuminate\Http\RedirectResponse;

class PostController extends Controller
{
    public function store(
        CreatePostUseCase $createPostUseCase,
        CreatePostRequest $createPostRequest,
    ): RedirectResponse {
        $user = request()->user();

        $createPostUseCase->handle(
            $user,
            $createPostRequest->get('thread_id'),
            $createPostRequest->get('content'),
        );

        return redirect()->back();
    }
}
