<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminders extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [
        'purpose',
        'date',
        'time',
        'users_id'
    ];

}
