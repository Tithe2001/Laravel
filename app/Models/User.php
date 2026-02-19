<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    //accessor
    public function getNameAttribute($value){
        return ucfirst($value);
    }

    public function Name():Attribute{
        return Attribute::make(
            get:fn($value)=>ucfirst($value)
        );

    }



    //mutator
    //newVersion
public function setPasswordAttribute($value){
    $this->attributes['password']= bcrypt($value);
}


//oldVersion
public function Password():Attribute{
    return Attribute::make(
        set:fn($value)=>bcrypt($value)
    );

}



//query scope

 function scopeByRole($query,$id){
    return $query->where("role_id",$id);
 }







}
