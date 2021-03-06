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

    public function createdBy() : \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class,'id','users_id');
    }
    public function taskPriorities()
    {
        return $this->hasOne(TaskPriorities::class);
    }

    public function taskUser() :HasMany
    {
        return $this->hasMany(TaskUser::class);
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

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Projects::class,'projects_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }

}
