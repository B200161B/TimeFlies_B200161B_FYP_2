<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $primaryKey ='id';
    protected $fillable = [

        'event_name',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'details',
        'users_id',

    ];
}
