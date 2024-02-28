<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Threads\UseCases;

use App\Modules\Threads\Models\Thread;
use App\Modules\Threads\UseCases\GetPaginatedThreadUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetPaginatedThreadUseCaseTest extends TestCase
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

        for ($i = 0; $i < 2; $i++) {
            $thread->posts()->create([
                'user_id' => 1,
                'content' => "{$i}",
            ]);
        }

        $useCase = app(GetPaginatedThreadUseCase::class);

        [$thread, $posts, $hasPages, $totalPosts] = $useCase->handle($thread->id, 1, 1);

        $this->assertEquals('Test Thread', $thread->name);
        $this->assertEquals(2, $posts->total());
        $this->assertEquals(2, $totalPosts);
        $this->assertTrue($hasPages);
        $this->assertEquals(1, $posts->currentPage());
        $this->assertEquals("0", $posts->first()->content);
    }
}
