<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskUser extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['tasks_id','users_id'];

    public function taskUser() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tasks::class);
    }

}
