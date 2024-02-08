<?php

declare(strict_types=1);

namespace App\Modules\Users\UseCases;

use App\Modules\Posts\Repositories\PostRepository;
use App\Modules\Users\Repositories\UserRepository;

class GetUserAndPaginatedPostsUseCase
{
    public function __construct(
        private UserRepository $userRepository,
        private PostRepository $postRepository,
    ) {
    }

    /**
     * @return array<int, mixed>
     */
    public function handle($username, $postPage, $perPage = 20): mixed
    {
        $user = $this->userRepository->findByUsername($username);

        $posts = $user->posts()
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $postPage);

        return [$user, $posts, $posts->hasPages(), $posts->total()];
    }
}
