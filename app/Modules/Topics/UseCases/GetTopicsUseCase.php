<?php

declare(strict_types=1);

namespace App\Modules\Topics\UseCases;

use App\Modules\Topics\Repositories\TopicRepository;
use Illuminate\Database\Eloquent\Collection;

class GetTopicsUseCase
{
    public function __construct(
        private TopicRepository $topicRepository,
    ) {
    }

    /**
     * @return Collection<int, Topic>
     */
    public function handle(): Collection
    {
        return $this->topicRepository->getAll();
    }
}
