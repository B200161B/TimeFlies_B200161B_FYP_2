<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'id';

    protected $fillable = [
        'company_name',
        'address',
        'phone_number',
        'email'
    ];

    public function users()
    {
        return $this->hasManyThrough(
          User::class,CompanyUser::class,
            'user_id','id'
        );
    }
}
