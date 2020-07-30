<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->token = Str::random(30);
        });
    }
    // Возвращает 0-1 в зависимости от того, является ли пользователь админом
    public function isAdmin()
    {
        return $this->is_admin;
    }
    //обнулять ключ и устанавливать значение поля verified равным true, в случае, если пользователь успешно подтвердит свой e-mail адрес.
    public function confirmEmail()
    {
        $this->verified = true;
        $this->token = null;
        $this->save();
    }
}
