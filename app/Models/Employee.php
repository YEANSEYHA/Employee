<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{

    protected $fillable = [
        'name_kh',
        'name_latin',
        'email',
        'phone',
        'birth_date',
        'address',
        'active',
        'role',
        'gender',
        'department_id',
        'related_user_id',
        'associated_roles_id'
    ];

    protected $fillters = ['name_kh', 'name_latin', 'role'];
}
