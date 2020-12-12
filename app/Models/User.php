<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'userable_id',
        'userable_type',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *  Polymorphic relationship to either Tenant or Employee.
     */
    public function userable()
    {
        return $this->morphTo();
    }

    /**
     *  Method to get some lease details
     */
    public function tenantDetails()
    {
        return collect($this->userable->lease->property)
            ->filter(function ($value, $key) {
                return $key === 'street' || 
                       $key === 'city' || 
                       $key === 'state' || 
                       $key === 'zipcode';
            })->put('unit', $this->userable->lease->unit);
    }

}
