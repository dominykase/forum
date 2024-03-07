<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Threads\UseCases;

use App\Models\User;
use App\Modules\Posts\Models\Post;
use App\Modules\Threads\Models\Thread;
use App\Modules\Threads\UseCases\CreateThreadUseCase;
use App\Modules\Topics\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateThreadUseCaseTest extends TestCase
{
    use RefreshDatabase;

    public function testGetPaginatedThreadUseCase(): void
    {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $topic = Topic::query()->create([
            'name' => 'Test Topic',
            'description' => 'Test Description',
        ]);

        $useCase = app(CreateThreadUseCase::class);

        $threadId = $useCase->handle('testName', $topic->id, $user->id, 'abcdef');

        $this->assertEquals('abcdef', Post::all()->first()->content);
        $this->assertEquals($user->id, Post::all()->first()->user_id);
        $this->assertEquals('testName', Thread::query()->where('id', $threadId)->first()->name);
        $this->assertEquals($topic->id, Thread::query()->where('id', $threadId)->first()->topic_id);
        $this->assertEquals($user->id, Thread::query()->where('id', $threadId)->first()->user_id);
    }
}
