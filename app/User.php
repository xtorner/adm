<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\UserRole $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname',
        'username',
        'password',
        'role_id',
        'observations',
        'active',
    ];

    /**
     * The attributes defaults
     *
     * @var array
     */
    protected $attributes = [
        'active' => true,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo('App\UserRole');
    }

    public function hasRole($roles)
    {
        if (is_string($roles)) {
            return $this->role->name === $roles;
        }

        if (is_array($roles) && in_array($this->role->name, $roles)){
            return true;
        }

        return false;
    }

    public function isSuperAdmin()
    {
        return $this->role->name === 'SuperAdmin';
    }

    public function isAdmin()
    {
        return $this->role->name === 'Administrador';
    }

    public function isSummerMaker()
    {
        return $this->role->name === 'SummerMaker';
    }

    public function isUser()
    {
        return $this->role->name === 'Usuari';
    }

}
