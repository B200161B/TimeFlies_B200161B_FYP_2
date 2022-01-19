<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPriorities extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [

        'complexity_lvl',
        'important_lvl',
        'urgency_lvl',
        'duration_h',
        'duration_m',
        'tasks_id',
    ];
    public function task()
    {
        return $this->belongsTo(Tasks::class);
    }
}
