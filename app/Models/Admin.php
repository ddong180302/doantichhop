<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'admin_email', 'admin_password', 'admin_name', 'admin_phone'
    ];
    public $timestamps = true;
    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
    protected $hidden = [];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Roles');
    }

    public function getAuthPassword()
    {
        return $this->admin_password;
    }
}
