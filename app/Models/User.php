<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRelationships;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'position'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        return $this->hasMany(Tasks::class, 'users_id');
    }

    public function taskHistories()
    {
        return $this->hasManyThrough(
            TaskHistory::class, Tasks::class,
            'users_id', ''
        );
    }


    public function workspace()
    {
        return $this->belongsTo(WorkspaceUsers::class, 'id', 'users_id');
    }


    public function projects()
    {
        return $this->hasManyDeep(Projects::class,
            [WorkspaceUsers::class,Workspaces::class,WorkspaceProject::class],
            ['users_id','id','workspaces_id','id'],
            ['id','workspaces_id','id','projects_id']
        );
    }


}
