<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workspaces extends Model
{
    use HasFactory;
    protected $table = 'workspaces';
    protected $primaryKey ='id';
    protected $fillable = ['workspace_name','in_charged_by'];

    public function inChargePerson(): HasOne
    {
        return $this->hasOne(User::class,'id');
    }

    public function workspaceusers(): HasMany
    {
        return $this->hasMany(WorkspaceUsers::class);
    }
    public function projects(): HasMany
    {
        return $this->hasMany(WorkspaceProject::class);
    }



}
