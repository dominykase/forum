<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Users\Models;

use App\Models\User;
use App\Modules\Posts\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserHasManyPosts(): void
    {
        $user = User::query()->create([
            'name' => 'Test_User',
            'email' => 'test@user.com',
            'password' => 'password',
        ]);

        $post = Post::query()->create([
            'thread_id' => 1,
            'user_id' => $user->id,
            'content' => 'Test content',
        ]);

        $this->assertEquals($post->id, $user->posts[0]->id);
        $this->assertEquals($post->thread_id, $user->posts[0]->thread_id);
        $this->assertEquals($post->user_id, $user->id);
        $this->assertEquals($post->content, $user->posts[0]->content);
    }

    public function testUserCastsRoleCorrectly(): void
    {
        $user = User::query()->create([
            'name' => 'Test_User',
            'email' => 'test@example.com',
            'password' => 'password',
            'role' => 2,
        ]);

        $this->assertEquals(2, $user->role->id);
        $this->assertEquals('moderator', $user->role->name);
    }
}
