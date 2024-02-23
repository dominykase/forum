<?php

declare(strict_types=1);

namespace App\Modules\Topics\Repositories;

use App\Modules\Topics\Models\Topic;
use Illuminate\Database\Eloquent\Builder;

class TopicRepository
{
    public function findById(int $topicId): Topic
    {
        return Topic::query()->where('id', $topicId)->first();
    }
}
