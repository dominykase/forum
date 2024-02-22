<?php

declare(strict_types=1);

namespace App\Modules\Threads\Models;

use App\Models\User;
use App\Modules\Posts\Models\Post;
use App\Modules\Topics\Models\Topic;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $topic_id
 * @property string $user_id
 * @property int $posts_count
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Thread extends Model
{
    protected $table = 'threads';

    protected $guarded = [];

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function topic(): HasOne
    {
        return $this->hasOne(Topic::class, 'id', 'topic_id');
    }

    public function posts(): HasMany|Builder
    {
        return $this->hasMany(Post::class);
    }
}
