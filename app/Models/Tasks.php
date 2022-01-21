<?php

namespace App\Models;

use App\Traits\WithWhereHas;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class   Tasks extends Model
{
    use HasFactory,WithWhereHas;

    protected $primaryKey = 'id';
    protected $fillable = [

        'task_name',
        'due_date',
        'details',
        'users_id',
        'projects_id',
        'status',
        'attachmentFiles',
    ];

    public function taskPriorities(): HasOne
    {
        return $this->hasOne(TaskPriorities::class);
    }

    public static function latestHistory($taskId): Builder
    {
        return TaskHistory::query()
            ->where('tasks_id', $taskId)
            ->where('end', null)
            ->latest();
    }

    public function history(): HasMany
    {
        return $this->hasMany(TaskHistory::class);
    }
}
