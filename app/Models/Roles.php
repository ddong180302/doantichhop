<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Roles extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'role_name',
    ];
    public $timestamps = true;
    protected $primaryKey = 'role_id';
    protected $table = 'tbl_roles';
    protected $hidden = [];

    public function admin()
    {
        return $this->belongsToMany('App\Models\Admin');
    }
}
