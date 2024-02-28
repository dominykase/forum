<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Topics\UseCases;

use App\Modules\Threads\Models\Thread;
use App\Modules\Topics\Models\Topic;
use App\Modules\Topics\UseCases\GetTopicAndPaginatedThreadsUseCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetTopicAndPaginatedThreadsUseCaseTest extends TestCase
{
    use RefreshDatabase;

    public function testGet(): void
    {
        $topic = Topic::query()->create([
            'name' => 'Test Topic',
            'description' => 'Test Description',
        ]);

        $thread = Thread::query()->create([
            'name' => 'Test Thread 1',
            'user_id' => 1,
            'topic_id' => $topic->id,
            'posts_count' => 2,
        ]);

        Thread::query()->create([
            'name' => 'Test Thread',
            'user_id' => 1,
            'topic_id' => $topic->id,
            'posts_count' => 2,
        ]);

        $useCase = app(GetTopicAndPaginatedThreadsUseCase::class);

        [$topic, $threads, $totalThreads, $page, $perPage] = $useCase->handle($topic->id, 1, 1);

        $this->assertEquals('Test Topic', $topic->name);
        $this->assertEquals(2, $threads->total());
        $this->assertEquals(2, $totalThreads);
        $this->assertEquals(1, $threads->currentPage());
        $this->assertEquals('Test Thread 1', $threads->first()->name);
        $this->assertEquals(1, $page);
        $this->assertEquals(1, $perPage);
    }
}
