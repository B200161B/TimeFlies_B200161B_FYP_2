<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Projects extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $primaryKey ='id';
    protected $fillable = ['project_name','project_goal','due_date','users_id'];

    public function task() :HasMany
    {
        return $this->hasMany(Tasks::class);
    }

    public function createdBy() :HasOne
    {
        return $this->hasOne(User::class,'id');
    }
}
