<?php

declare(strict_types=1);

namespace App\Modules\Topics\Repositories;

use App\Modules\Topics\Models\Topic;

class TopicRepository
{
    public function findById(int $topicId): Topic
    {
        return Topic::query()->where('id', $topicId);
    }
}
