<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspaces extends Model
{
    use HasFactory;
    protected $table = 'workspaces';
    protected $primaryKey ='id';
    protected $fillable = ['workspace_name','in_charged_by'];

    public function workspaceusers()
    {
        return $this->hasMany(WorkspaceUsers::class);
    }
    public function workspaceProjects()
    {
        return $this->hasMany(WorkspaceProject::class);
    }
}
