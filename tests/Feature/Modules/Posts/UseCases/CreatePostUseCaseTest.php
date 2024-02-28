<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Posts\UseCases;

use App\Models\User;
use App\Modules\Posts\UseCases\CreatePostUseCase;
use App\Modules\Threads\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePostUseCaseTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPaginatedThreadUseCase(): void
    {
        $thread = Thread::query()->create([
            'name' => 'Test Thread',
            'user_id' => 1,
            'topic_id' => 1,
            'posts_count' => 2,
        ]);

        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $useCase = app(CreatePostUseCase::class);

        $useCase->handle($user, $thread->id, 'abcdef');

        $newPost = $thread->posts()->first();
        $thread->refresh();

        $this->assertEquals('abcdef', $newPost->content);
        $this->assertEquals(3, $thread->posts_count);
    }
}
