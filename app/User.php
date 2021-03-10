<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'last_name', 'email', 'password', 'rol'];

    protected $hidden = ['password', 'remember_token'];

    public function maintenances()
    {
        return $this->hasMany('App\Maintenance');
    }

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function isSuperAdmin()
    {
      return $this->rol == 'superadmin' ? true : false;
    }

    public function isAdmin()
    {
      return $this->rol == 'admin' ? true : false;
    }

    public function isCompany()
    {
      return $this->rol == 'company' ? true : false;
    }

    public function isObserver()
    {
      return $this->rol == 'observer' ? true : false;
    }

}
