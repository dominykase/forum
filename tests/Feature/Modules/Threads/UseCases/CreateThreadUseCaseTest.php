<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Threads\UseCases;

use App\Models\User;
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

        [$thread, $posts] = $useCase->handle('testName', $topic->id, $user->id, 'abcdef');

        $this->assertEquals('abcdef', $posts->first()->content);
        $this->assertEquals($user->id, $posts->first()->user_id);
        $this->assertEquals('testName', $thread->name);
        $this->assertEquals($topic->id, $thread->topic_id);
        $this->assertEquals($user->id, $thread->user_id);
    }
}
