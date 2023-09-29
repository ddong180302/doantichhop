<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Users extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_name',
        'user_email',
        'user_password',
        'user_address',
        'user_phone',
        'user_avatar',
        'user_status',
        'user_role',
        'user_token',
    ];

    public $timestamps = true;
    protected $primaryKey = 'user_id';
    protected $table = 'tbl_users';
    protected $hidden = [];

    public function getAuthPassword()
    {
        return $this->user_password;
    }
}