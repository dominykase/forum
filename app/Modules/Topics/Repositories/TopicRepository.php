<?php

declare(strict_types=1);

namespace App\Modules\Topics\Repositories;

use App\Modules\Topics\Models\Topic;
use Illuminate\Database\Eloquent\Collection;

class TopicRepository
{
    public function findById(int $topicId): Topic
    {
        return Topic::query()->where('id', $topicId)->first();
    }

    /**
     * @return Collection<int, Topic>
     */
    public function getAll(): Collection
    {
        return Topic::all();
    }
}
