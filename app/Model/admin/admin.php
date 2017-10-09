<?php

namespace App\Model\admin;

use Illuminate\Notifications\Notifiable; 
use Illuminate\Foundation\Auth\User as Authenticatable;
//кода от горните два реда се слагат при тази грешка - Type error: Argument 1 passed to Illuminate\Auth\EloquentUserProvider::validateCredentials() must be an instance of Illuminate\Contracts\Auth\Authenticatable, instance of App\Model\admin\admin given, called in D:\XAMP2\htdocs\composer\Bitfumes\vendor\laravel\framework\src\Illuminate\Auth\SessionGuard.php on line 381 
//при логване на админ панел  и в класа се пише наследява Authenticatable
class admin extends Authenticatable
{
    
     use Notifiable;
 
      public function roles(){

      	  return $this->belongsToMany('App\Model\admin\Role');
      }

      public function getNameAttribute($value){

           return ucfirst($value);
      }

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
