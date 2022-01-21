<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'tasks_id', 'start', 'end', 'note'
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(
            Tasks::class, 'tasks_id'
        );
    }

}
