<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
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

   public function certificates(){
        return $this->hasMany(Certificate::class);
   }

   public function categories(){
        return $this->belongsToMany(Category::class);
   }

   public function specialities(){
        return $this->belongsToMany(Speciality::class);
   }

   public function verifications(){
    return $this->hasMany(Verification::class);
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

   public function followingsId()
   {
       return $this->belongsToMany(Self::class,'follows', 'user_id', 'following_id')->select(['id']);
   }

   public function rooms(){
    return $this->hasMany(Room::class);
   }
   function delete()
    {
        $this->articles()->delete();
        
        parent::delete();
    }
}
