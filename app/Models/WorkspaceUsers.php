<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkspaceUsers extends Model
{
    use HasFactory;

//    protected $table = 'workspace_sers';
    protected $fillable = ['workspaces_id', 'users_id'];

    public function workspace()
    {
        return $this->belongsTo(Workspaces::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
