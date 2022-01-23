<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Company extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRelationships;

    protected $primaryKey = 'id';

    protected $fillable = [
        'company_name',
        'address',
        'phone_number',
        'email'
    ];

    public function companyUsers()
    {
        return $this->hasMany(
            CompanyUser::class
        );
    }


}
