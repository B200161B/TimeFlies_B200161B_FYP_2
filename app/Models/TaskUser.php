<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TaskUser extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = ['tasks_id','users_id'];

    public function taskUser() : \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Tasks::class);
    }

    public function addedUsers():HasOne
    {
        return $this->hasOne(User::class,'id','users_id');
    }

}
