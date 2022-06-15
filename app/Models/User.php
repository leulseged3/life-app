<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'username',
        'mobile_number',
        'password',
        'is_mhp',
        'profile_pic',
        'bios'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function articles(){
        return $this->morphMany(Article::class,'owner');
    }

   public function rating(){
       return $this->hasMany(Totalrating::class);
   }

   public function certificate(){
        return $this->hasOne(Certificate::class);
   }

   /**
    * The roles that belong to the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function followers()
   {
       return $this->belongsToMany(Self::class,'follows', 'following_id', 'user_id');
   }

   public function followings()
   {
       return $this->belongsToMany(Self::class,'follows', 'user_id', 'following_id');
   }
}
