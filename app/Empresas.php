<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model
{
    protected $fillable = [
        'name', 'email', 'logo', 'website'
    ];
}
