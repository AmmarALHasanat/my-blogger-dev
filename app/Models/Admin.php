<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\AdminFactory;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class Admin extends Model
{
    use HasApiTokens,HasFactory,HasRoles;
    protected $guarded=[];
    protected static function newFactory():AdminFactory
    {
        return AdminFactory::new();
    }

}
