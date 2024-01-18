<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Modules\Threads\Models\Thread;
use App\Modules\Topics\Models\Topic;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => bcrypt('test123'),
        ]);

        $topic = Topic::query()->create([
            'name' => 'Test Topic',
            'description' => 'Test Description',
        ]);

        $thread = Thread::query()->create([
            'user_id' => $user->id,
            'topic_id' => $topic->id,
            'name' => 'Test Thread',
        ]);

        $thread->posts()->create([
            'user_id' => $user->id,
            'content' => 'Test Content 1',
        ]);

        $thread->posts()->create([
            'user_id' => $user->id,
            'content' => 'Test Content 2',
        ]);

        $thread->posts()->create([
            'user_id' => $user->id,
            'content' => 'Test Content 3',
        ]);
    }
}
