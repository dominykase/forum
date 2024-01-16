<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Posts\Models;

use App\Models\User;
use App\Modules\Posts\Models\Post;
use App\Modules\Threads\Models\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testPostIsCreatedSuccessfully(): void
    {
        $post = Post::query()->create([
            'thread_id' => 1,
            'user_id' => 1,
            'content' => 'Test Content',
        ]);

        $this->assertEquals('Test Content', $post->content);
        $this->assertEquals(1, $post->thread_id);
        $this->assertEquals(1, $post->user_id);
    }

    public function testCanRetrieveUserOfPostSuccessfully(): void
    {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => 'password',
        ]);

        $post = Post::query()->create([
            'thread_id' => 1,
            'user_id' => 1,
            'content' => 'Test Content',
        ]);

        $userDb = $post->user;

        $this->assertEquals($user->id, $userDb->id);
        $this->assertEquals('Test User', $userDb->name);
        $this->assertEquals('test@test.com', $userDb->email);
    }

    public function testCanRetrieveThreadOfPostSuccessfully(): void
    {
        $thread = Thread::query()->create([
            'name' => 'Test Thread',
            'topic_id' => 1,
            'user_id' => 1,
        ]);

        $post = Post::query()->create([
            'thread_id' => 1,
            'user_id' => 1,
            'content' => 'Test Content',
        ]);

        $threadDb = $post->thread;

        $this->assertEquals($thread->id, $threadDb->id);
        $this->assertEquals('Test Thread', $threadDb->name);
    }
}
