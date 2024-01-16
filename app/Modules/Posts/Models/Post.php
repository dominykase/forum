<?php

declare(strict_types=1);

namespace App\Modules\Posts\Models;

use App\Models\User;
use App\Modules\Threads\Models\Thread;
use App\Modules\Topics\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * @property int $id
 * @property int $thread_id
 * @property int $user_id
 * @property string $content
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Post extends Model
{
    protected $table = 'posts';

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function thread(): HasOne
    {
        return $this->hasOne(Thread::class, 'id', 'thread_id');
    }
}
