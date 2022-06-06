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
        'is_mhp'
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

   /**
    * The roles that belong to the User
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function followers()
   {
       return $this->belongsToMany(Follow::class,'follows', 'following_id', 'follower_id');
   }

   public function followings()
   {
       return $this->belongsToMany(Follow::class,'follows', 'follower_id', 'following_id');
   }

    public function isSuperAdmin(): bool {
        return (bool) $this->is_super_admin;
    }

    public function createSuperAdmin(array $details): self {
        $user = new self($details);

        if(!$this->superAdminExists()){
            $user->is_super_admin = 1;
            $user->password = Hash::make($user->password);
            $user->save();
        } else {
            $user->email = "false";
        }
        return $user;
    }

    public function superAdminExists(): int {
        return self::where('is_super_admin', 1)->count();
    }
}
