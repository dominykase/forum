<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Threads\Models;

use App\Models\User;
use App\Modules\Posts\Models\Post;
use App\Modules\Threads\Models\Thread;
use App\Modules\Topics\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use RefreshDatabase;

    public function testThreadIsCreatedSuccessfully(): void
    {
        $thread = Thread::query()->create([
            'name' => 'Test Thread',
            'topic_id' => 1,
            'user_id' => 100,
        ]);

        $this->assertEquals('Test Thread', $thread->name);
        $this->assertEquals(1, $thread->topic_id);
        $this->assertEquals(100, $thread->user_id);
    }

    public function testCanRetrieveUserOfThreadSuccessfully(): void
    {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $thread = Thread::query()->create([
            'name' => 'Test Thread',
            'topic_id' => 1,
            'user_id' => $user->id,
        ]);

        $userDb = $thread->user;

        $this->assertEquals('Test User', $userDb->name);
        $this->assertEquals('test@test.com', $userDb->email);
    }

    public function testCanRetrieveTopicOfThreadSuccessfully(): void
    {
        $topic = Topic::query()->create([
            'name' => 'Test Topic',
            'description' => 'Test Description',
        ]);

        $thread = Thread::query()->create([
            'name' => 'Test Thread',
            'topic_id' => $topic->id,
            'user_id' => 1,
        ]);

        $topic = $thread->topic;

        $this->assertEquals('Test Topic', $topic->name);
        $this->assertEquals('Test Description', $topic->description);
    }

    public function testCanRetrievePostsOfThreadSuccessfully(): void
    {
        $thread = Thread::query()->create([
            'name' => 'Test Thread',
            'topic_id' => 1,
            'user_id' => 1,
        ]);

        Post::query()->create([
            'thread_id' => $thread->id,
            'user_id' => 1,
            'content' => 'Test Content 1',
        ]);

        Post::query()->create([
            'thread_id' => $thread->id,
            'user_id' => 1,
            'content' => 'Test Content 2',
        ]);

        $this->assertEquals(2, $thread->posts()->count());

        $posts = $thread->posts;

        $this->assertEquals('Test Content 1', $posts->get(0)->content);
        $this->assertEquals('Test Content 2', $posts->get(1)->content);
    }
}
