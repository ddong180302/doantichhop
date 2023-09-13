<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin_Roles extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'admin_id', 'id_roles'
    ];
    public $timestamps = true;
    protected $primaryKey = 'admin_roles_id';
    protected $table = 'tbl_admin_roles';
    protected $hidden = [];

    // public function roles()
    // {
    //     return $this->belongsToMany('App\Models\Roles');
    // }

    // public function getAuthPassword()
    // {
    //     return $this->admin_password;
    // }
}
