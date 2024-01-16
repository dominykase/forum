<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Topics\Models;

use App\Modules\Threads\Models\Thread;
use App\Modules\Topics\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TopicTest extends TestCase
{
    use RefreshDatabase;

    public function testTopicIsCreatedSuccessfully(): void
    {
        $topic = Topic::query()->create([
            'name' => 'Test Topic',
            'description' => 'Test Description',
        ]);

        $this->assertEquals('Test Topic', $topic->name);
        $this->assertEquals('Test Description', $topic->description);
    }

    public function testCanRetrieveThreadsOfTopicSuccessfully(): void
    {
        $topic = Topic::query()->create([
            'name' => 'Test Topic',
            'description' => 'Test Description',
        ]);

        Thread::query()->create([
            'name' => 'Test Thread 1',
            'topic_id' => $topic->id,
            'user_id' => 1,
        ]);

        Thread::query()->create([
            'name' => 'Test Thread 2',
            'topic_id' => $topic->id,
            'user_id' => 1,
        ]);

        $this->assertEquals(2, $topic->threads()->count());

        $threads = $topic->threads;

        $this->assertEquals('Test Thread 1', $threads->get(0)->name);
        $this->assertEquals('Test Thread 2', $threads->get(1)->name);
    }
}
