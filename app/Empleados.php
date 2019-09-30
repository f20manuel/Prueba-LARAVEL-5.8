<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone'
    ];
}
