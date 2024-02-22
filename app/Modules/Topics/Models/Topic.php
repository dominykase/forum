<?php

declare(strict_types=1);

namespace App\Modules\Topics\Models;

use App\Modules\Threads\Models\Thread;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Topic extends Model
{
    protected $table = 'topics';

    protected $guarded = [];

    public function threads(): HasMany|Builder
    {
        return $this->hasMany(Thread::class);
    }
}
