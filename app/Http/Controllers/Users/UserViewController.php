<?php

declare(strict_types=1);

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Modules\Users\UseCases\GetUserAndPaginatedPostsUseCase;
use App\Services\PaginationService;
use Illuminate\View\View;

class UserViewController extends Controller
{
    public function showProfile(
        GetUserAndPaginatedPostsUseCase $getUserAndPaginatedPostsUseCase,
        PaginationService $paginationService,
        string $username,
        int $postPage = 1
    ): View {
        [$user, $posts, $hasPages, $total] = $getUserAndPaginatedPostsUseCase->handle($username, $postPage);

        if (is_null($user)) {
            abort(404);
        }

        $pageNumbers = $paginationService->getPageSwitcherNumbers($postPage, $total);

        return view('user', [
            'user' => $user,
            'posts' => $posts,
            'hasPages' => $hasPages,
            'total' => $total,
            'pageNumbers' => $pageNumbers,
        ]);
    }
}
