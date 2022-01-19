<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [

        'task_name',
        'due_date',
        'details',
        'users_id',
        'projects_id',
        'status',
        'attachmentFiles',
    ];
    public function taskPriorities()
    {
        return $this->hasOne(TaskPriorities::class);
    }

}
